/**
 * Fillable enrollment application (static port of the React PdfFormFiller).
 *
 * Loads the official fillable AcroForm PDF with pdf.js, renders each page to
 * a canvas, and overlays native HTML inputs/checkboxes positioned over the
 * real form fields (percentage coordinates keep the layout correct at any
 * screen size). On submit, pdf-lib fills the actual PDF form fields with the
 * entered values, produces a completed PDF blob, and emails it via
 * FormSubmit.co — nothing is stored online.
 *
 * Libraries are loaded from CDN (same versions the app pins):
 *   pdfjs-dist@4.10.38, pdf-lib@1.17.1 (classic script on the page).
 */

const SUBMIT_EMAIL = 'kiplafoundationinc@gmail.com';
const AUTO_REPLY =
  'Thank you for submitting your enrollment application to Keeping It Positive Learning Academy! We have received your completed form and will contact you within 1-2 business days to confirm enrollment. If you have questions, call us at 770-672-7800 (Main Campus) or 678-483-5160 (Lithia Springs). — KIPLA Foundation Inc.';

const root = document.getElementById('pff-root');
// The hosting page can pass the PDF location (WordPress theme uses its theme
// URI); otherwise default to the static-site relative path.
const FILLABLE_PDF =
  (root && root.dataset.pdf) ||
  'assets/docs/KIPLA_Standard_Enrollment_Application_Fillable.pdf';
if (root) main();

async function main() {
  showLoading();
  let pages;
  try {
    const pdfjs = await import('https://cdn.jsdelivr.net/npm/pdfjs-dist@4.10.38/build/pdf.min.mjs');
    pdfjs.GlobalWorkerOptions.workerSrc =
      'https://cdn.jsdelivr.net/npm/pdfjs-dist@4.10.38/build/pdf.worker.min.mjs';

    const doc = await pdfjs.getDocument({ url: FILLABLE_PDF }).promise;
    const scale = 1.5;
    pages = [];

    for (let i = 1; i <= doc.numPages; i++) {
      const page = await doc.getPage(i);
      const viewport = page.getViewport({ scale });
      const annotations = await page.getAnnotations();
      const fields = [];

      for (const a of annotations) {
        if (!a.fieldName || !a.fieldType) continue;
        const rect = viewport.convertToViewportRectangle(a.rect);
        const left = Math.min(rect[0], rect[2]);
        const top = Math.min(rect[1], rect[3]);
        const w = Math.abs(rect[2] - rect[0]);
        const h = Math.abs(rect[3] - rect[1]);

        const flags = a.fieldFlags;
        const isMultiline =
          (typeof flags === 'number' && (flags & 0x1000) !== 0) ||
          (Array.isArray(flags) && flags.includes('Multiline'));

        fields.push({
          name: a.fieldName,
          type: a.fieldType === 'Btn' ? 'checkbox' : 'text',
          left: (left / viewport.width) * 100,
          top: (top / viewport.height) * 100,
          width: (w / viewport.width) * 100,
          height: (h / viewport.height) * 100,
          multiline: isMultiline,
        });
      }
      pages.push({ page, scale, fields });
    }
  } catch (err) {
    showError(err && err.message ? err.message : 'Could not load the enrollment form.');
    return;
  }
  renderForm(pages);
}

function showLoading() {
  root.innerHTML =
    '<div class="pff-loading"><div class="pff-spinner" aria-hidden></div><p>Loading the enrollment form\u2026</p></div>';
}

function showError(msg) {
  root.innerHTML =
    '<div class="pff-error"><h3>Couldn\u2019t load the form</h3><p></p>' +
    '<a class="btn btn--primary" href="' + FILLABLE_PDF + '" download>Download the PDF instead</a></div>';
  root.querySelector('p').textContent = msg;
}

function showThanks(name, email) {
  root.innerHTML =
    '<div class="pff-thanks"><div class="pff-thanks__icon" aria-hidden>\u2713</div>' +
    '<h2></h2><p></p>' +
    '<p class="pff-thanks__note">First submission only: FormSubmit may send a one-time activation link to ' +
    SUBMIT_EMAIL + ' \u2014 once confirmed, all future submissions arrive automatically.</p>' +
    '<a class="btn btn--primary" href="index.html">Back to Home</a></div>';
  const first = (name || '').split(' ')[0] || 'friend';
  root.querySelector('h2').textContent = 'Thank you, ' + first + '!';
  const p = root.querySelectorAll('p')[0];
  p.textContent = '';
  p.append(
    'Your completed enrollment application has been emailed directly to KIPLA Foundation Inc. A confirmation email is on its way to '
  );
  const b = document.createElement('strong');
  b.textContent = email;
  p.append(b);
  p.append('. We\u2019ll be in touch within 1\u20132 business days.');
}

function renderForm(pages) {
  const values = {};
  root.innerHTML = '';

  const form = document.createElement('form');
  form.className = 'pff-form';
  form.noValidate = true;

  // Parent/guardian contact block (used for the email subject + auto-reply)
  const submitter = document.createElement('div');
  submitter.className = 'pff-submitter';
  submitter.innerHTML =
    '<div class="pff-field"><label for="pff-name">Parent / Guardian Name *</label>' +
    '<input id="pff-name" type="text" required autocomplete="name"></div>' +
    '<div class="pff-field"><label for="pff-email">Email Address *</label>' +
    '<input id="pff-email" type="email" required autocomplete="email"></div>' +
    '<p class="pff-submitter__hint">Fill in the form below, then submit \u2014 your completed PDF is emailed straight to KIPLA. Nothing is stored online.</p>';
  form.appendChild(submitter);
  const nameInput = submitter.querySelector('#pff-name');
  const emailInput = submitter.querySelector('#pff-email');

  // Toolbar: page count + print
  const toolbar = document.createElement('div');
  toolbar.className = 'pff-toolbar';
  const label = document.createElement('span');
  label.className = 'pff-toolbar__label';
  label.textContent = pages.length + '-page enrollment packet';
  const printBtn = document.createElement('button');
  printBtn.type = 'button';
  printBtn.className = 'btn btn--gold btn--sm';
  printBtn.textContent = 'Print Form';
  toolbar.append(label, printBtn);
  form.appendChild(toolbar);

  // Pages: canvas render + absolutely positioned overlays
  const pagesEl = document.createElement('div');
  pagesEl.className = 'pff-pages';
  for (const pg of pages) {
    const wrap = document.createElement('div');
    wrap.className = 'pff-page';
    wrap.setAttribute('aria-label', 'Page ' + pg.page.pageNumber);

    const canvas = document.createElement('canvas');
    canvas.className = 'pff-canvas';
    wrap.appendChild(canvas);

    for (const f of pg.fields) {
      let el;
      if (f.type === 'checkbox') {
        el = document.createElement('input');
        el.type = 'checkbox';
        el.className = 'pff-check';
        el.style.fontSize = Math.max(f.width, 1.6) + 'cqw';
        el.addEventListener('change', () => { values[f.name] = el.checked; });
      } else if (f.multiline) {
        el = document.createElement('textarea');
        el.className = 'pff-input pff-textarea';
        el.addEventListener('input', () => { values[f.name] = el.value; });
      } else {
        el = document.createElement('input');
        el.type = 'text';
        el.className = 'pff-input';
        el.addEventListener('input', () => { values[f.name] = el.value; });
      }
      el.setAttribute('aria-label', f.name);
      el.style.left = f.left + '%';
      el.style.top = f.top + '%';
      el.style.width = f.width + '%';
      el.style.height = f.height + '%';
      wrap.appendChild(el);
    }
    pagesEl.appendChild(wrap);

    const viewport = pg.page.getViewport({ scale: pg.scale });
    canvas.width = viewport.width;
    canvas.height = viewport.height;
    pg.page.render({ canvasContext: canvas.getContext('2d'), viewport });
  }
  form.appendChild(pagesEl);

  // Actions
  const actions = document.createElement('div');
  actions.className = 'pff-actions';
  const submitBtn = document.createElement('button');
  submitBtn.type = 'submit';
  submitBtn.className = 'btn btn--primary';
  submitBtn.textContent = 'Submit Application';
  const errorP = document.createElement('p');
  errorP.className = 'pff-errortext';
  errorP.hidden = true;
  actions.append(submitBtn, errorP);
  form.appendChild(actions);

  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    if (!form.checkValidity()) {
      form.reportValidity();
      return;
    }
    submitBtn.disabled = true;
    submitBtn.textContent = 'Submitting\u2026';
    errorP.hidden = true;
    try {
      const blob = await buildFilledPdf(pages, values);
      const fd = new FormData();
      fd.append('parentName', nameInput.value);
      fd.append('email', emailInput.value);
      fd.append('attachment', blob, 'KIPLA_Enrollment_Application.pdf');
      fd.append('_subject', 'New Enrollment Application - ' + nameInput.value);
      fd.append('_captcha', 'false');
      fd.append('_autoresponse', AUTO_REPLY);

      const res = await fetch('https://formsubmit.co/ajax/' + SUBMIT_EMAIL, {
        method: 'POST',
        body: fd,
      });
      if (!res.ok) throw new Error('Submission failed. Please try again.');
      showThanks(nameInput.value, emailInput.value);
    } catch (err) {
      errorP.textContent = err && err.message ? err.message : 'Something went wrong. Please try again.';
      errorP.hidden = false;
      submitBtn.disabled = false;
      submitBtn.textContent = 'Submit Application';
    }
  });

  printBtn.addEventListener('click', async () => {
    // Open the tab synchronously (inside the click) so popup blockers allow it
    const tab = window.open('', '_blank');
    printBtn.disabled = true;
    printBtn.textContent = 'Preparing\u2026';
    try {
      const blob = await buildFilledPdf(pages, values);
      const url = URL.createObjectURL(blob);
      if (tab) tab.location.href = url;
      else window.open(url, '_blank');
    } catch {
      if (tab) tab.location.href = FILLABLE_PDF;
      else window.open(FILLABLE_PDF, '_blank');
    } finally {
      printBtn.disabled = false;
      printBtn.textContent = 'Print Form';
    }
  });

  root.appendChild(form);
}

async function buildFilledPdf(pages, values) {
  const { PDFDocument } = window.PDFLib;
  const bytes = await fetch(FILLABLE_PDF).then((r) => r.arrayBuffer());
  const doc = await PDFDocument.load(bytes, { updateMetadata: false });
  const form = doc.getForm();

  for (const page of pages) {
    for (const f of page.fields) {
      try {
        if (f.type === 'text') {
          form.getTextField(f.name).setText(String(values[f.name] ?? ''));
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
  form.updateFieldAppearances();
  const out = await doc.save();
  return new Blob([out], { type: 'application/pdf' });
}
