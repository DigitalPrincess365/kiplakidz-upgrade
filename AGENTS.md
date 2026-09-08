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
- The static KIPLA WordPress theme preview lives in `public/kipla-preview/` (HTML, CSS, JS, program pages).
- `kipla-theme/` and `kipla-theme.zip` are the raw WordPress PHP theme — not used by the Vite app.

## Vite config note
- vite.config.ts uses `@lovable.dev/vite-tanstack-config`, which already registers
  TanStack Start, React, Tailwind, tsconfig paths, nitro, and sandbox host/port detection.
  Do NOT re-add those plugins manually (causes duplicate-plugin errors).
