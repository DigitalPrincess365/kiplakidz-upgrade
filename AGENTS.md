<!-- LOVABLE:BEGIN -->
> [!IMPORTANT]
> This project is connected to [Lovable](https://lovable.dev). Avoid rewriting
> published git history — force pushing, or rebasing/amending/squashing commits
> that are already pushed — as it rewrites history on Lovable's side and
> the user will likely lose their project history.
>
> Commits you push to the connected branch sync back to the editor, so keep
> the branch in a working state.
<!-- LOVABLE:END -->

# Base44 Dev Environment

## Stack
- Frontend only: Vite 8 + TanStack Start (SSR) + React 19 + Tailwind 4. No backend/database.
- Package manager: **Bun** (bun.lock, bunfig.toml). Compose runs `bun install --frozen-lockfile && bun run dev` on port 5173 → host 3000.
- `node_modules` lives in a named volume; source is bind-mounted (hot reload, no rebuilds).

## Running
```
docker compose -f docker-compose.base44.yml up -d
```
- Compose healthcheck fetches `/kipla-site/index.html` and checks for KIPLA content.

## What the app renders
- `/` (src/routes/index.tsx) server-redirects (302) to `/kipla-site/index.html` so URL
  importers (WPConvert) land on the real static HTML instead of an empty SPA shell.
- `/registration` (src/routes/registration.tsx + src/components/PdfFormFiller.tsx) is an online
  fillable PDF form (pdfjs-dist renders, pdf-lib fills, emails via FormSubmit.co).
- `public/kipla-preview/` is the older design preview, browsable directly.

## Static site export (WPConvert)
- `public/kipla-site/` is the standalone static HTML/CSS/JS recreation of the whole site
  (index, schedule-tour, enrollment, full-gallery with 148 baked photos, 404, six program pages).
  Forms submit via FormSubmit.co AJAX. Relative asset paths — must stay under `/kipla-site/`.
- `public/kipla-site.zip` is the upload-ready export for WPConvert (files at ZIP root).
- Vite dev quirk: brand-new files in `public/` may 404 until `docker compose ... restart web`.

## WordPress theme deliverable
- `kipla-theme/` is a classic PHP theme (header/footer/index/front-page.php + template-parts/home/*,
  page-templates/{tour,enrollment}.php, CPTs in inc/post-types.php). No React/Vite build needed.
- `kipla-theme/screenshot.png` (1200×900) is REQUIRED for the theme card in Appearance → Themes;
  without it WordPress shows a completely blank preview card (the reported "blank preview").
  It was captured from the homepage rendered by a real WordPress instance.
- Both `kipla-theme.zip` (repo root) and `public/kipla-theme-installable.zip` must stay in sync
  with `kipla-theme/`: `kipla-theme/` at the ZIP root, `style.css` + `index.php` directly inside.
  `assets/css/theme.css` is an unreferenced leftover (nothing loads it) but is included so the
  ZIP mirrors the folder.
- Verification recipe (used successfully): `docker network create` + `mysql:8` + `wordpress:php8.2`
  containers, install WP with wp-cli (`curl wp-cli.phar` inside the wp container), activate the
  theme, curl the homepage — expect 200 with all 11 sections and 0 PHP warnings; lint all PHP
  with `php:7.4-cli` and `php:8.2-cli`. To screenshot the rendered homepage headlessly:
  `alpine:3.20` + `apk add chromium`, run `chromium --headless=new --no-sandbox --screenshot
  --window-size=1200,900 --virtual-time-budget=30000 --run-all-compositor-stages-before-draw`
  — and first point the WP `home`/`siteurl` options at the container hostname, or the canonical
  redirect breaks headless fetching.
