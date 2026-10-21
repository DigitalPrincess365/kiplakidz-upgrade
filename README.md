# Kiplakidz Upgrade

I am upgrading this site kiplakidz.com

## Installing the KIPLA WordPress theme

Use **`public/kipla-theme-installable.zip`** for WordPress (served at
`/kipla-theme-installable.zip` by the development preview). Download that file
itself, not GitHub's **Code → Download ZIP**, which wraps the entire repository.
In WordPress go to **Appearance → Themes → Add New → Upload Theme**, select the
ZIP without unzipping it, and install.

The archive contains a single `kipla-theme/` folder, with `style.css` (KIPLA
1.1.0 theme header), `index.php`, `functions.php`, and the other templates
directly inside it. It includes every file from `kipla-theme/` unchanged,
including the images, video, documents, CSS, and JavaScript. This is a classic
PHP theme; the development preview's React/Vite wrapper is not needed to install
it. Repackage from `kipla-theme/` after future theme edits; this ZIP is a snapshot,
not a live link to the source.

The existing `kipla-theme.zip` also has the required top-level stylesheet. The
reported missing-stylesheet error was not reproduced with that archive; the
cause of the rejected upload cannot be confirmed without the rejected file or
hosting logs.

Validation on October 20, 2026: the new archive was inspected directly and all
59 source files matched byte-for-byte. It was installed and activated through
WordPress's theme installer in an isolated WordPress 6.9.4 instance, and all 30
packaged PHP files passed syntax checks. This does not test the upload limits
or configuration of a separate hosting account, or every theme interaction.

## Static site export (for WPConvert)

`public/kipla-site/` is a standalone static HTML/CSS/JS recreation of the site — no PHP,
no build step. Zip that folder (or use `public/kipla-site.zip`, which has `index.html` at
the ZIP root) and upload it to WPConvert. It is also browsable in the dev preview at
`/kipla-site/index.html`.

This project was built with [Lovable](https://lovable.dev).

## Build with Lovable

Continue developing this project in the [Lovable editor](https://lovable.dev/projects/60ea5923-2d6b-499b-a5d4-fae0bd6a5b38).

- **Ship faster**: describe what you want to build and Lovable handles the code.
- **Stay in sync**: every change made in Lovable is committed straight to this repository.
- **Full ownership**: this code is yours. Push to `main` on GitHub and your changes sync back into Lovable, ready for your next prompt.

## Development

Prefer working locally? You need Node.js and npm — [install with nvm](https://github.com/nvm-sh/nvm#installing-and-updating).

```sh
git clone <this-repository-url>
cd <repository-name>
npm i
npm run dev
```
