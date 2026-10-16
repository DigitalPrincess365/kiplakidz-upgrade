<!-- LOVABLE:BEGIN -->
> [!IMPORTANT]
> This project is connected to [Lovable](https://lovable.dev). Avoid rewriting
> published git history — force pushing, or rebasing/amending/squashing commits
> that are already pushed — as it rewrites history on Lovable's side and the
> user will likely lose their project history.
>
> Commits you push to the connected branch sync back to Lovable and show up in the
> editor, so keep the branch in a working state.
<!-- LOVABLE:END -->

# Base44 Dev Environment

## Stack
- Frontend only: Vite 8 + TanStack Start (SSR) + React 19 + Tailwind 4.
- Package manager: **Bun** (bun.lock, bunfig.toml). Use `bun install` / `bun run dev`.
- No backend, database, or external services. No secrets required.

## Running
```
docker compose -f docker-compose.base44.yml up -d
```
- Dev server runs `vite dev --host 0.0.0.0 --port 5173`, mapped to host port 3000.
- Source is bind-mounted; edits hot-reload without rebuilding the image.
- `node_modules` lives in a named volume (not the bind mount) to avoid host/platform conflicts.

## What the app renders
- `/` (src/routes/index.tsx) renders an `<iframe>` pointing at `/kipla-preview/index.html`.
- `/registration` (src/routes/registration.tsx + src/components/PdfFormFiller.tsx) is an online
  fillable PDF form. It loads `public/kipla-preview/KIPLA_Standard_Enrollment_Application_Fillable.pdf`
  with `pdfjs-dist` (renders pages + overlays native HTML inputs on the AcroForm fields), then on
  submit fills the real PDF with `pdf-lib` and emails the completed PDF to
  kiplafoundationinc@gmail.com via FormSubmit.co (no online storage). Both libs are client-only
  (dynamically imported in effects) so SSR never loads them.
- The static KIPLA WordPress theme preview lives in `public/kipla-preview/` (HTML, CSS, JS, program pages).
- `kipla-theme/` is the deliverable WordPress theme (also zipped as `kipla-theme.zip`) — not used by the Vite app.
  Standard structure: `header.php`/`footer.php` (wp_head/wp_footer), `index.php` (the Loop), `front-page.php` + `template-parts/home/*` (homepage sections),
  `page-templates/tour.php` + `page-templates/enrollment.php` (plugin-ready HTML forms), `archive-kipla_media.php` (full gallery), `style.css` (theme header + all styles),
  `functions.php` (enqueues; CPTs: kipla_program/kipla_media/kipla_update/kipla_testimonial in `inc/post-types.php`), assets in `assets/{images,media,docs,js}`.
  Verified via a dockerized WordPress instance (lint all PHP with `docker run php:8.2-cli` + activate theme + curl each template).

## Vite config note
- vite.config.ts uses `@lovable.dev/vite-tanstack-config`, which already registers
  TanStack Start, React, Tailwind, tsconfig paths, nitro, and sandbox host/port detection.
  Do NOT re-add those plugins manually (causes duplicate-plugin errors).

## Gallery API ("See KIPLA in Action" section)
- `src/routes/api.gallery.ts` is a TanStack Start server route at `/api/gallery`:
  GET (paged records, 50/page, newest first), POST (admin-only multipart upload),
  PUT (admin login with `GALLERY_ADMIN_PASSWORD` → HMAC cookie), DELETE (logout).
- Uploaded files are stored publicly in `public/kipla-preview/gallery/uploads/`; the record
  list is `public/kipla-preview/gallery/records.json` (format: `{ items: [...] }`).
- The static page's gallery UI lives in `public/kipla-preview/gallery.js`; the admin bar /
  login panel / pager / uploader are toggled via the `hidden` attribute, so any new
  `display:*` rule for those classes MUST be paired with a `[hidden]{display:none!important}`
  guard (theme.css has one) or the controls leak to the public view.
- In the WordPress theme, gate the upload button with a PHP admin-capability check instead
  of the password gate (the preview's password login is sandbox-only).
