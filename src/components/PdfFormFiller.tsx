import { useEffect, useRef, useState } from "react";

/**
 * PdfFormFiller
 *
 * Loads a fillable AcroForm PDF with pdf.js, renders each page to a canvas,
 * and overlays native HTML inputs/checkboxes positioned over the real form
 * fields (using percentage coordinates so the layout stays correct at any
 * screen size). On submit, pdf-lib fills the actual PDF form fields with the
 * entered values, produces a completed PDF blob, and emails it via
 * FormSubmit.co — nothing is stored online.
 */

type FieldType = "text" | "checkbox";
type Field = {
  name: string;
  type: FieldType;
  left: number; // % of page width
  top: number; // % of page height
  width: number; // % of page width
  height: number; // % of page height
  multiline: boolean;
};
type PageData = {
  page: any; // pdf.js page proxy
  scale: number;
  fields: Field[];
};

const FILLABLE_PDF =
  "/kipla-preview/KIPLA_Standard_Enrollment_Application_Fillable.pdf";
const SUBMIT_EMAIL = "kiplafoundationinc@gmail.com";

const AUTO_REPLY =
  "Thank you for submitting your enrollment application to Keeping It Positive Learning Academy! We have received your completed form and will contact you within 1-2 business days to confirm enrollment. If you have questions, call us at 770-672-7800 (Main Campus) or 678-483-5160 (Lithia Springs). — KIPLA Foundation Inc.";

type Status = "loading" | "ready" | "submitting" | "submitted" | "error";

export default function PdfFormFiller() {
  const [status, setStatus] = useState<Status>("loading");
  const [pages, setPages] = useState<PageData[]>([]);
  const [values, setValues] = useState<Record<string, string | boolean>>({});
  const [name, setName] = useState("");
  const [email, setEmail] = useState("");
  const [errorMsg, setErrorMsg] = useState("");

  // Load + parse the PDF on the client only (pdf.js needs the DOM).
  useEffect(() => {
    let cancelled = false;
    (async () => {
      try {
        const pdfjs: any = await import("pdfjs-dist");
        const workerUrl = (
          await import("pdfjs-dist/build/pdf.worker.min.mjs?url")
        ).default;
        pdfjs.GlobalWorkerOptions.workerSrc = workerUrl;

        const doc = await pdfjs.getDocument({ url: FILLABLE_PDF }).promise;
        const scale = 1.5;
        const out: PageData[] = [];

        for (let i = 1; i <= doc.numPages; i++) {
          const page = await doc.getPage(i);
          const viewport = page.getViewport({ scale });
          const annotations = await page.getAnnotations();
          const fields: Field[] = [];

          for (const a of annotations) {
            if (!a.fieldName || !a.fieldType) continue;
            const rect = viewport.convertToViewportRectangle(a.rect);
            const left = Math.min(rect[0], rect[2]);
            const top = Math.min(rect[1], rect[3]);
            const w = Math.abs(rect[2] - rect[0]);
            const h = Math.abs(rect[3] - rect[1]);

            const flags = a.fieldFlags;
            const isMultiline =
              (typeof flags === "number" && (flags & 0x1000) !== 0) ||
              (Array.isArray(flags) && flags.includes("Multiline"));

            fields.push({
              name: a.fieldName,
              type: a.fieldType === "Btn" ? "checkbox" : "text",
              left: (left / viewport.width) * 100,
              top: (top / viewport.height) * 100,
              width: (w / viewport.width) * 100,
              height: (h / viewport.height) * 100,
              multiline: isMultiline,
            });
          }

          out.push({ page, scale, fields });
        }

        if (!cancelled) {
          setPages(out);
          setStatus("ready");
        }
      } catch (err: any) {
        if (!cancelled) {
          setErrorMsg(err?.message || "Could not load the enrollment form.");
          setStatus("error");
        }
      }
    })();
    return () => {
      cancelled = true;
    };
  }, []);

  async function handleSubmit(e: React.FormEvent) {
    e.preventDefault();
    const form = e.currentTarget as HTMLFormElement;
    if (!form.checkValidity()) {
      form.reportValidity();
      return;
    }
    setStatus("submitting");
    setErrorMsg("");
    try {
      const { PDFDocument } = await import("pdf-lib");
      const bytes = await fetch(FILLABLE_PDF).then((r) => r.arrayBuffer());
      const doc = await PDFDocument.load(bytes, { updateMetadata: false });
      const form = doc.getForm();

      for (const page of pages) {
        for (const f of page.fields) {
          try {
            if (f.type === "text") {
              const field = form.getTextField(f.name);
              field.setText(String(values[f.name] ?? ""));
            } else {
              const cb = form.getCheckBox(f.name);
              if (values[f.name]) cb.check();
              else cb.uncheck();
            }
          } catch {
            // Skip any field that pdf-lib can't resolve by name.
          }
        }
      }
      form.updateFieldAppearances(true);
      const out = await doc.save();
      const blob = new Blob([out as BlobPart], { type: "application/pdf" });

      const fd = new FormData();
      fd.append("parentName", name);
      fd.append("email", email);
      fd.append("attachment", blob, "KIPLA_Enrollment_Application.pdf");
      fd.append("_subject", "New Enrollment Application - " + name);
      fd.append("_captcha", "false");
      fd.append("_autoresponse", AUTO_REPLY);

      const res = await fetch(
        `https://formsubmit.co/ajax/${SUBMIT_EMAIL}`,
        { method: "POST", body: fd },
      );
      if (!res.ok) throw new Error("Submission failed. Please try again.");
      setStatus("submitted");
    } catch (err: any) {
      setErrorMsg(err?.message || "Something went wrong. Please try again.");
      setStatus("ready");
    }
  }

  if (status === "loading") {
    return (
      <div className="pff-loading">
        <div className="pff-spinner" aria-hidden />
        <p>Loading the enrollment form…</p>
      </div>
    );
  }

  if (status === "error" && pages.length === 0) {
    return (
      <div className="pff-error">
        <h3>Couldn’t load the form</h3>
        <p>{errorMsg}</p>
        <a className="btn btn--primary" href={FILLABLE_PDF} download>
          Download the PDF instead
        </a>
      </div>
    );
  }

  if (status === "submitted") {
    return (
      <div className="pff-thanks">
        <div className="pff-thanks__icon" aria-hidden>
          ✓
        </div>
        <h2>Thank you, {name.split(" ")[0] || "friend"}!</h2>
        <p>
          Your completed enrollment application has been emailed directly to
          KIPLA Foundation Inc. A confirmation email is on its way to{" "}
          <strong>{email}</strong>. We’ll be in touch within 1–2 business days.
        </p>
        <p className="pff-thanks__note">
          First submission only: FormSubmit may send a one-time activation link
          to {SUBMIT_EMAIL} — once confirmed, all future submissions arrive
          automatically.
        </p>
        <a className="btn btn--primary" href="/">
          Back to Home
        </a>
      </div>
    );
  }

  return (
    <form className="pff-form" onSubmit={handleSubmit} noValidate>
      <div className="pff-submitter">
        <div className="pff-field">
          <label htmlFor="pff-name">Parent / Guardian Name *</label>
          <input
            id="pff-name"
            type="text"
            value={name}
            onChange={(e) => setName(e.target.value)}
            required
            autoComplete="name"
          />
        </div>
        <div className="pff-field">
          <label htmlFor="pff-email">Email Address *</label>
          <input
            id="pff-email"
            type="email"
            value={email}
            onChange={(e) => setEmail(e.target.value)}
            required
            autoComplete="email"
          />
        </div>
        <p className="pff-submitter__hint">
          Fill in the form below, then submit — your completed PDF is emailed
          straight to KIPLA. Nothing is stored online.
        </p>
      </div>

      <div className="pff-pages">
        {pages.map((page, i) => (
          <PdfPage key={i} page={page} values={values} setValues={setValues} />
        ))}
      </div>

      <div className="pff-actions">
        <button
          type="submit"
          className="btn btn--primary"
          disabled={status === "submitting"}
        >
          {status === "submitting" ? "Submitting…" : "Submit Application"}
        </button>
        {errorMsg && <p className="pff-errortext">{errorMsg}</p>}
      </div>
    </form>
  );
}

function PdfPage({
  page,
  values,
  setValues,
}: {
  page: PageData;
  values: Record<string, string | boolean>;
  setValues: React.Dispatch<
    React.SetStateAction<Record<string, string | boolean>>
  >;
}) {
  const canvasRef = useRef<HTMLCanvasElement>(null);

  useEffect(() => {
    let renderTask: any;
    (async () => {
      const canvas = canvasRef.current;
      if (!canvas) return;
      const ctx = canvas.getContext("2d");
      if (!ctx) return;
      const viewport = page.page.getViewport({ scale: page.scale });
      canvas.width = viewport.width;
      canvas.height = viewport.height;
      renderTask = page.page.render({ canvasContext: ctx, viewport });
      try {
        await renderTask.promise;
      } catch {
        /* render can be cancelled on unmount */
      }
    })();
    return () => {
      if (renderTask?.cancel) renderTask.cancel();
    };
  }, [page]);

  return (
    <div className="pff-page" aria-label={`Page ${page.page.pageNumber}`}>
      <canvas ref={canvasRef} className="pff-canvas" />
      {page.fields.map((f) =>
        f.type === "checkbox" ? (
          <input
            key={f.name}
            type="checkbox"
            className="pff-check"
            style={{
              left: `${f.left}%`,
              top: `${f.top}%`,
              width: `${f.width}%`,
              height: `${f.height}%`,
              fontSize: `${Math.max(f.width, 1.6)}cqw`,
            }}
            checked={!!values[f.name]}
            onChange={(e) =>
              setValues((v) => ({ ...v, [f.name]: e.target.checked }))
            }
            aria-label={f.name}
          />
        ) : f.multiline ? (
          <textarea
            key={f.name}
            className="pff-input pff-textarea"
            style={{
              left: `${f.left}%`,
              top: `${f.top}%`,
              width: `${f.width}%`,
              height: `${f.height}%`,
            }}
            value={(values[f.name] as string) ?? ""}
            onChange={(e) =>
              setValues((v) => ({ ...v, [f.name]: e.target.value }))
            }
            aria-label={f.name}
          />
        ) : (
          <input
            key={f.name}
            type="text"
            className="pff-input"
            style={{
              left: `${f.left}%`,
              top: `${f.top}%`,
              width: `${f.width}%`,
              height: `${f.height}%`,
            }}
            value={(values[f.name] as string) ?? ""}
            onChange={(e) =>
              setValues((v) => ({ ...v, [f.name]: e.target.value }))
            }
            aria-label={f.name}
          />
        ),
      )}
    </div>
  );
}
