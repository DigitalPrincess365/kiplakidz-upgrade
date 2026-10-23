import { createFileRoute, redirect } from "@tanstack/react-router";

// The KIPLA site is served as static files from public/kipla-site/.
// Redirect the SPA root there server-side so crawlers/importers (WPConvert)
// land on real HTML content instead of an empty SPA shell.
export const Route = createFileRoute("/")({
  beforeLoad: () => {
    throw redirect({ href: "/kipla-site/index.html", statusCode: 302 });
  },
});
