# KIPLA — Static Site (WPConvert export)

A standalone **static HTML/CSS/JavaScript** recreation of the KIPLA website
(Keeping It Positive Learning Academy). No PHP, no build step, no dependencies —
open `index.html` in a browser, or zip this folder and upload it to WPConvert.

## Pages
- `index.html` — homepage (hero, welcome, locations, programs, KIPLA difference, culture,
  founder, testimonials, gallery, news, CTA)
- `programs/` — six program detail pages (Infants, Toddlers, Preschool, Georgia Pre-K,
  Before & After School, Summer Camp)
- `schedule-tour.html` — tour request form (submits via FormSubmit.co to
  kiplafoundationinc@gmail.com)
- `enrollment.html` — enrollment inquiry form (same FormSubmit.co wiring) + printable
  enrollment application PDF
- `full-gallery.html` — full photo gallery, 48 photos per page (client-side pager)
- `404.html` — not-found page

## Notes
- Forms submit via FormSubmit.co's AJAX endpoint. The first submission from a new site
  requires a one-time activation click on the confirmation email FormSubmit sends to
  kiplafoundationinc@gmail.com.
- The gallery is baked in statically: the 12 newest photos on the homepage, all 148
  items on the full gallery page. To add photos later, add `<figure>` items to the grids.
- All media is optimized (WebP images, compressed JPEGs and video) so the whole site
  stays small.
- `assets/docs/` holds the printable PDFs (enrollment application, campus calendars,
  Sunflower Curriculum newsletter).
