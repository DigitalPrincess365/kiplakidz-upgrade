import { createFileRoute } from "@tanstack/react-router";
import { createHmac, timingSafeEqual, randomUUID } from "node:crypto";
import { promises as fs } from "node:fs";
import path from "node:path";

/*
 * Gallery API for the "See KIPLA in Action" section.
 * - GET    /api/gallery?page=N&limit=M  → one page of records (50 per page, or M featured) + admin flag
 * - POST   /api/gallery         → admin-only multipart upload, saves file + record
 * - PUT    /api/gallery         → admin login (password → session cookie)
 * - DELETE /api/gallery         → admin logout
 *
 * Files are stored publicly in public/kipla-preview/gallery/uploads/ and the
 * record list lives in public/kipla-preview/gallery/records.json.
 */

const DATA_DIR = path.join(process.cwd(), "public", "kipla-preview", "gallery");
const RECORDS_FILE = path.join(DATA_DIR, "records.json");
const UPLOADS_DIR = path.join(DATA_DIR, "uploads");
const COOKIE_NAME = "kipla_gallery_admin";
const PAGE_SIZE = 50;

type GalleryRecord = {
  id: string;
  type: "photo" | "video";
  url: string;
  filename: string;
  uploadedAt: string;
};

const adminPassword = () => process.env.GALLERY_ADMIN_PASSWORD || "";

const sessionToken = () => {
  const pw = adminPassword();
  if (!pw) return "";
  return createHmac("sha256", pw).update("kipla-gallery-admin-v1").digest("hex");
};

const safeEqual = (a: string, b: string) => {
  if (!a || a.length !== b.length) return false;
  try {
    return timingSafeEqual(Buffer.from(a), Buffer.from(b));
  } catch {
    return false;
  }
};

const isAdmin = (request: Request) => {
  const token = sessionToken();
  if (!token) return false;
  const cookies = request.headers.get("cookie") || "";
  const match = cookies.match(new RegExp(`(?:^|;\\s*)${COOKIE_NAME}=([^;]+)`));
  return !!match && safeEqual(match[1], token);
};

async function readRecords(): Promise<{ items: GalleryRecord[] }> {
  try {
    const raw = await fs.readFile(RECORDS_FILE, "utf8");
    const data = JSON.parse(raw);
    return Array.isArray(data?.items) ? data : { items: [] };
  } catch {
    return { items: [] };
  }
}

async function writeRecords(data: { items: GalleryRecord[] }) {
  await fs.mkdir(DATA_DIR, { recursive: true });
  await fs.writeFile(RECORDS_FILE, JSON.stringify(data, null, 2));
}

const jsonError = (message: string, status: number) =>
  Response.json({ error: message }, { status });

export const Route = createFileRoute("/api/gallery")({
  server: {
    handlers: {
      GET: async ({ request }: any) => {
        const url = new URL(request.url);
        const requested = Math.max(1, parseInt(url.searchParams.get("page") || "1", 10) || 1);
        const limitParam = parseInt(url.searchParams.get("limit") || "", 10);
        const pageSize = limitParam > 0 && limitParam < PAGE_SIZE ? limitParam : PAGE_SIZE;
        const data = await readRecords();
        const sorted = [...data.items].sort((a, b) => (a.uploadedAt < b.uploadedAt ? 1 : -1));
        const total = sorted.length;
        const totalPages = Math.max(1, Math.ceil(total / pageSize));
        const page = Math.min(requested, totalPages);
        const items = sorted.slice((page - 1) * pageSize, page * pageSize);
        return Response.json({
          items,
          page,
          pageSize,
          totalPages,
          total,
          admin: isAdmin(request),
        });
      },
      POST: async ({ request }: any) => {
        if (!isAdmin(request)) return jsonError("Unauthorized", 401);
        let form: FormData;
        try {
          form = await request.formData();
        } catch {
          return jsonError("Could not read the upload", 400);
        }
        const file = form.get("file");
        if (!(file instanceof File)) return jsonError("No file was attached", 400);
        const mime = file.type || "";
        const isVideo = mime.startsWith("video/");
        if (!isVideo && !mime.startsWith("image/")) {
          return jsonError("Only photos and videos can be uploaded", 415);
        }
        const extMatch = (file.name || "").match(/\.([A-Za-z0-9]{1,5})$/);
        const ext = extMatch ? extMatch[1].toLowerCase() : isVideo ? "mp4" : "jpg";
        const filename = `${Date.now()}-${randomUUID().slice(0, 8)}.${ext}`;
        await fs.mkdir(UPLOADS_DIR, { recursive: true });
        await fs.writeFile(path.join(UPLOADS_DIR, filename), Buffer.from(await file.arrayBuffer()));
        const record: GalleryRecord = {
          id: randomUUID(),
          type: isVideo ? "video" : "photo",
          url: `/kipla-preview/gallery/uploads/${filename}`,
          filename: file.name || filename,
          uploadedAt: new Date().toISOString(),
        };
        const data = await readRecords();
        data.items.push(record);
        await writeRecords(data);
        return Response.json({ record });
      },
      PUT: async ({ request }: any) => {
        const expected = adminPassword();
        let password = "";
        try {
          password = (JSON.parse(await request.text()) || {}).password || "";
        } catch {
          /* fall through to failure */
        }
        if (!expected || !safeEqual(password, expected)) {
          return jsonError("Incorrect password", 401);
        }
        return new Response(JSON.stringify({ ok: true }), {
          headers: {
            "content-type": "application/json",
            "set-cookie": `${COOKIE_NAME}=${sessionToken()}; Path=/; HttpOnly; SameSite=Lax; Max-Age=${60 * 60 * 24 * 7}`,
          },
        });
      },
      DELETE: async () => {
        return new Response(JSON.stringify({ ok: true }), {
          headers: {
            "content-type": "application/json",
            "set-cookie": `${COOKIE_NAME}=; Path=/; HttpOnly; SameSite=Lax; Max-Age=0`,
          },
        });
      },
    },
  },
});
