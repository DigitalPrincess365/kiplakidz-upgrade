/* KIPLA dedicated full gallery page — every photo, paged for fast loading */
(function () {
  "use strict";

  var API = window.KIPLA_GALLERY_API || "/api/gallery";

  var els = {
    grid: document.getElementById("action-gallery"),
    empty: document.getElementById("gallery-empty"),
    pager: document.getElementById("gallery-pager"),
    pagePrev: document.getElementById("gallery-prev"),
    pageNext: document.getElementById("gallery-next"),
    pageInfo: document.getElementById("gallery-page-info"),
  };
  if (!els.grid) return;

  var state = { page: 1, totalPages: 1, total: 0 };

  function load(page) {
    fetch(API + "?page=" + page, { credentials: "include" })
      .then(function (r) { return r.json(); })
      .then(function (data) {
        state.page = Math.min(data.page, data.totalPages);
        state.totalPages = data.totalPages;
        state.total = data.total;
        renderItems(data.items);
        renderPager();
      })
      .catch(function () {
        els.empty.hidden = false;
        els.empty.textContent = "Could not load the gallery right now. Please refresh the page.";
      });
  }

  function renderItems(items) {
    els.grid.innerHTML = "";
    els.empty.hidden = state.total > 0;
    if (state.total === 0) els.empty.textContent = "No photos yet — check back soon!";
    items.forEach(function (item) {
      var fig = document.createElement("figure");
      fig.className = "frame frame--square";
      if (item.type === "video") {
        var video = document.createElement("video");
        video.controls = true;
        video.muted = true;
        video.loop = true;
        video.playsInline = true;
        video.preload = "metadata";
        video.src = item.url;
        fig.appendChild(video);
      } else {
        var img = document.createElement("img");
        img.loading = "lazy";
        img.decoding = "async";
        img.src = item.url;
        img.alt = "KIPLA scholars in action";
        img.style.cursor = "zoom-in";
        img.addEventListener("click", function () { window.open(item.url, "_blank"); });
        fig.appendChild(img);
      }
      els.grid.appendChild(fig);
    });
  }

  function renderPager() {
    els.pager.hidden = state.totalPages <= 1;
    els.pagePrev.disabled = state.page <= 1;
    els.pageNext.disabled = state.page >= state.totalPages;
    els.pageInfo.textContent =
      "Page " + state.page + " of " + state.totalPages + " · " + state.total +
      (state.total === 1 ? " item" : " items");
  }

  els.pagePrev.addEventListener("click", function () {
    if (state.page > 1) { load(state.page - 1); els.grid.scrollIntoView({ behavior: "smooth", block: "start" }); }
  });
  els.pageNext.addEventListener("click", function () {
    if (state.page < state.totalPages) { load(state.page + 1); els.grid.scrollIntoView({ behavior: "smooth", block: "start" }); }
  });

  load(1);
})();
