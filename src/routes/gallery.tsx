import { createFileRoute } from "@tanstack/react-router";

export const Route = createFileRoute("/gallery")({
  component: FullGallery,
  head: () => ({
    meta: [
      { title: "Full Gallery | Keeping It Positive Learning Academy" },
      {
        name: "description",
        content:
          "Browse every classroom photo and video from Keeping It Positive Learning Academy — real moments from our two campuses.",
      },
      { property: "og:title", content: "KIPLA Full Gallery" },
      {
        property: "og:description",
        content: "Every classroom photo and video from KIPLA — all in one place.",
      },
      { property: "og:type", content: "website" },
      { name: "twitter:card", content: "summary_large_image" },
    ],
  }),
});

function FullGallery() {
  return (
    <iframe
      src="/kipla-preview/full-gallery.html"
      title="KIPLA full photo gallery"
      style={{ width: "100%", height: "100vh", border: 0, display: "block" }}
    />
  );
}
