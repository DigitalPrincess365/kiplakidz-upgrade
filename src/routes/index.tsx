import { createFileRoute } from "@tanstack/react-router";

export const Route = createFileRoute("/")({
  component: ThemePreview,
  head: () => ({
    meta: [
      { title: "KIPLA WordPress Theme Preview | Keeping It Positive" },
      {
        name: "description",
        content:
          "Static design preview of the KIPLA WordPress theme for Keeping It Positive Learning Academy — two campuses, programs, culture, founder and news sections.",
      },
      { property: "og:title", content: "KIPLA WordPress Theme Preview" },
      {
        property: "og:description",
        content:
          "See the KIPLA theme design: hero, two-campus cards, programs, culture, founder, testimonials and newsletters.",
      },
      { property: "og:type", content: "website" },
      { name: "twitter:card", content: "summary_large_image" },
    ],
  }),
});

function ThemePreview() {
  return (
    <iframe
      src="/kipla-preview/index.html"
      title="KIPLA WordPress theme design preview"
      style={{ width: "100%", height: "100vh", border: 0, display: "block" }}
    />
  );
}
