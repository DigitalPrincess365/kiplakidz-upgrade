import { createFileRoute } from "@tanstack/react-router";
import PdfFormFiller from "../components/PdfFormFiller";

export const Route = createFileRoute("/registration")({
  head: () => ({
    meta: [
      {
        title: "Registration Form | KIPLA — Keeping It Positive Learning Academy",
      },
      {
        name: "description",
        content:
          "Fill out the KIPLA Standard Enrollment Application online and submit it directly to KIPLA Foundation Inc.",
      },
    ],
    links: [
      { rel: "preconnect", href: "https://fonts.googleapis.com" },
      {
        rel: "preconnect",
        href: "https://fonts.gstatic.com",
        crossOrigin: "anonymous",
      },
      {
        rel: "stylesheet",
        href: "https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,600;9..144,700&family=Outfit:wght@400;500;600;700&display=swap",
      },
      { rel: "stylesheet", href: "/kipla-preview/theme.css" },
      { rel: "icon", href: "/kipla-preview/logo.png", type: "image/png" },
    ],
  }),
  component: RegistrationPage,
});

function RegistrationPage() {
  return (
    <div className="reg-page">
      <style>{REG_CSS}</style>
      <header className="reg-header">
        <div className="container reg-header__inner">
          <a className="brand" href="/">
            <img
              src="/kipla-preview/logo.png"
              alt="KIPLA — Keeping It Positive Learning Academy"
              loading="eager"
              style={{ maxHeight: "72px" }}
            />
          </a>
          <a className="btn btn--ghost btn--sm" href="/">
            ← Back to Home
          </a>
        </div>
      </header>

      <main className="reg-main">
        <div className="container">
          <div className="reg-intro">
            <span className="eyebrow">Standard Enrollment Application</span>
            <h1>Online Registration Form</h1>
            <p>
              Type directly into the form below — it’s the official KIPLA
              enrollment application. When you submit, your completed PDF is
              emailed straight to KIPLA Foundation Inc. Nothing is stored
              online.
            </p>
          </div>

          <PdfFormFiller />
        </div>
      </main>

      <footer className="reg-footer">
        <div className="container">
          <p>
            © {new Date().getFullYear()} Keeping It Positive Learning Academy ·
            KIPLA Foundation Inc.
          </p>
          <p>
            <a href="tel:+17706727800">(770) 672-7800</a> (Main Campus) ·{" "}
            <a href="tel:+16784835160">(678) 483-5160</a> (Lithia Springs) ·{" "}
            <a href="mailto:kiplafoundationinc@gmail.com">
              kiplafoundationinc@gmail.com
            </a>
          </p>
        </div>
      </footer>
    </div>
  );
}

const REG_CSS = `
.reg-page{background:var(--cream);min-height:100vh;display:flex;flex-direction:column}
.reg-header{background:var(--white);border-bottom:1px solid rgba(27,67,50,.12);position:sticky;top:0;z-index:10}
.reg-header__inner{display:flex;align-items:center;justify-content:space-between;gap:1rem;padding-block:.85rem}
.reg-main{flex:1;padding-block:clamp(2rem,5vw,3rem)}
.reg-intro{text-align:center;max-width:42rem;margin:0 auto 2.5rem}
.reg-intro .eyebrow{display:inline-block;font-family:var(--font-body);font-size:.78rem;font-weight:600;letter-spacing:.18em;text-transform:uppercase;color:var(--deep-red);background:rgba(164,22,26,.08);padding:.35rem .9rem;border-radius:999px;margin-bottom:.75rem}
.reg-intro h1{font-size:clamp(1.8rem,4vw,2.6rem);margin-bottom:.5rem}
.reg-intro p{color:rgba(38,38,38,.72);font-size:.95rem;line-height:1.6}

.reg-footer{background:var(--hunter);color:var(--cream);text-align:center;padding-block:1.5rem;font-size:.85rem}
.reg-footer a{color:var(--sunflower)}
.reg-footer p{margin:.15rem 0}

/* ---- PdfFormFiller ---- */
.pff-loading,.pff-error,.pff-thanks{text-align:center;padding:3.5rem 1rem;max-width:34rem;margin:0 auto}
.pff-spinner{width:42px;height:42px;margin:0 auto 1rem;border:4px solid rgba(27,67,50,.15);border-top-color:var(--hunter);border-radius:50%;animation:pffspin .8s linear infinite}
@keyframes pffspin{to{transform:rotate(360deg)}}
.pff-error h3,.pff-thanks h2{color:var(--hunter);margin-bottom:.5rem}
.pff-thanks__icon{width:64px;height:64px;margin:0 auto 1rem;border-radius:50%;background:var(--kelly);color:#fff;font-size:2rem;display:flex;align-items:center;justify-content:center}
.pff-thanks__note{font-size:.82rem;color:rgba(38,38,38,.6);margin-top:1rem}

.pff-form{max-width:820px;margin:0 auto}
.pff-submitter{background:var(--white);border:1px solid rgba(27,67,50,.12);border-radius:.75rem;padding:1.25rem 1.25rem 1rem;display:grid;grid-template-columns:1fr 1fr;gap:1rem;row-gap:.5rem;margin-bottom:2rem}
.pff-submitter__hint{grid-column:1/-1;color:rgba(38,38,38,.65);font-size:.82rem;margin:0}
.pff-field{display:flex;flex-direction:column;gap:.3rem}
.pff-field label{font-size:.78rem;font-weight:600;color:var(--hunter);letter-spacing:.02em}
.pff-field input,.pff-field textarea{font-family:var(--font-body);font-size:.95rem;padding:.6rem .75rem;border:1px solid rgba(27,67,50,.2);border-radius:.5rem;background:var(--white);color:var(--charcoal)}
.pff-field input:focus{outline:none;border-color:var(--kelly);box-shadow:0 0 0 3px rgba(45,106,79,.18)}

.pff-pages{display:flex;flex-direction:column;gap:1.25rem}
.pff-page{position:relative;width:100%;container-type:inline-size;background:#525659;border-radius:6px;overflow:hidden;box-shadow:0 8px 28px -16px rgba(0,0,0,.45)}
.pff-canvas{display:block;width:100%;height:auto}
.pff-input{position:absolute;border:none;background:rgba(255,247,205,.32);font-family:var(--font-body);color:#111;font-size:1.85cqw;line-height:1.1;padding:0 .4cqw;margin:0;box-sizing:border-box;border-radius:2px;box-shadow:inset 0 0 0 1px rgba(255,195,0,.25)}
.pff-input:focus{outline:none;background:rgba(255,247,205,.85);box-shadow:inset 0 0 0 1.5px var(--sunflower);z-index:2}
.pff-textarea{resize:none;overflow:hidden;line-height:1.2}
.pff-check{position:absolute;appearance:none;-webkit-appearance:none;border:1.5px solid var(--hunter);border-radius:3px;background:rgba(255,255,255,.85);box-sizing:border-box;margin:0;cursor:pointer;display:flex;align-items:center;justify-content:center}
.pff-check:checked{background:var(--hunter)}
.pff-check:checked::after{content:"";display:block;width:.55em;height:.28em;border-left:.14em solid #fff;border-bottom:.14em solid #fff;transform:translateY(-1px) rotate(-45deg)}
.pff-check:focus{outline:none;box-shadow:0 0 0 2px var(--sunflower)}

.pff-actions{text-align:center;margin-top:2rem;display:flex;flex-direction:column;align-items:center;gap:.75rem}
.pff-errortext{color:var(--deep-red);font-size:.9rem;margin:0}

@media (max-width:560px){
  .pff-submitter{grid-template-columns:1fr}
  .reg-header__inner .brand img{max-height:54px}
}
.pff-toolbar{display:flex;align-items:center;justify-content:space-between;gap:1rem;background:var(--white);border:1px solid rgba(27,67,50,.12);border-radius:.75rem;padding:.7rem 1.1rem;margin-bottom:1.25rem}
.pff-toolbar__label{font-size:.85rem;color:rgba(38,38,38,.65)}
`;
