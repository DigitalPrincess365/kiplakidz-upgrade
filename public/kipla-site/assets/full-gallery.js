/* KIPLA full gallery — client-side pager over the statically rendered photos (48 per page) */
(function () {
  "use strict";
  var PAGE_SIZE = window.KIPLA_GALLERY_PAGE_SIZE || 48;
  var items = Array.prototype.slice.call(document.querySelectorAll("#action-gallery > figure"));
  var pager = document.getElementById("gallery-pager");
  var prev = document.getElementById("gallery-prev");
  var next = document.getElementById("gallery-next");
  var info = document.getElementById("gallery-page-info");
  if (!items.length) return;

  var totalPages = Math.max(1, Math.ceil(items.length / PAGE_SIZE));
  var page = 1;

  function render() {
    items.forEach(function (fig, i) {
      fig.hidden = Math.floor(i / PAGE_SIZE) + 1 !== page;
    });
    pager.hidden = totalPages <= 1;
    prev.disabled = page <= 1;
    next.disabled = page >= totalPages;
    info.textContent = "Page " + page + " of " + totalPages + " · " + items.length +
      (items.length === 1 ? " item" : " items");
  }

  prev.addEventListener("click", function () {
    if (page > 1) { page--; render(); document.getElementById("gallery-page").scrollIntoView({ behavior: "smooth", block: "start" }); }
  });
  next.addEventListener("click", function () {
    if (page < totalPages) { page++; render(); document.getElementById("gallery-page").scrollIntoView({ behavior: "smooth", block: "start" }); }
  });

  render();
})();
