/* KIPLA dedicated full gallery page — every photo, paged for fast loading */
(function () {
  "use strict";

  var API = window.KIPLA_GALLERY_API || "/api/gallery";
  var PAGE_SIZE = window.KIPLA_GALLERY_PAGE_SIZE || 14;

  var els = {
    grid: document.getElementById("action-gallery"),
    empty: document.getElementById("gallery-empty"),
    pager: document.getElementById("gallery-pager"),
    pagePrev: document.getElementById("gallery-prev"),
    pageNext: document.getElementById("gallery-next"),
    pageInfo: document.getElementById("gallery-page-info"),
    adminLink: document.getElementById("gallery-admin-link"),
    adminPanel: document.getElementById("gallery-admin-panel"),
    adminPassword: document.getElementById("gallery-admin-password"),
    adminError: document.getElementById("gallery-admin-error"),
    adminBar: document.getElementById("gallery-admin-bar"),
    signout: document.getElementById("gallery-signout"),
  };
  if (!els.grid) return;

  var state = { page: 1, totalPages: 1, total: 0, admin: false };

  function load(page) {
    fetch(API + "?page=" + page + "&limit=" + PAGE_SIZE, { credentials: "include" })
      .then(function (r) { return r.json(); })
      .then(function (data) {
        state.page = Math.min(data.page, data.totalPages);
        state.totalPages = data.totalPages;
        state.total = data.total;
        state.admin = !!data.admin;
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
    els.adminLink.hidden = state.admin;
    if (!state.admin) els.adminPanel.hidden = true;
    els.adminBar.hidden = !state.admin;
    items.forEach(function (item) {
      var fig = document.createElement("figure");
      fig.className = "frame frame--square";
      if (state.admin) fig.appendChild(deleteButton(item));
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

  function deleteButton(item) {
    var btn = document.createElement("button");
    btn.type = "button";
    btn.className = "gallery-delete";
    btn.textContent = "Delete";
    btn.addEventListener("click", function () {
      if (!window.confirm("Delete this photo from the gallery? This cannot be undone.")) return;
      fetch(API + "?id=" + encodeURIComponent(item.id), { method: "DELETE", credentials: "include" })
        .then(function (r) {
          if (r.ok) { load(state.page); }
        });
    });
    return btn;
  }

  /* --- admin login / sign out --- */
  els.adminLink.addEventListener("click", function () {
    els.adminPanel.hidden = !els.adminPanel.hidden;
    if (!els.adminPanel.hidden) els.adminPassword.focus();
  });

  els.adminPanel.addEventListener("submit", function (e) {
    e.preventDefault();
    els.adminError.hidden = true;
    fetch(API, {
      method: "PUT",
      credentials: "include",
      headers: { "content-type": "application/json" },
      body: JSON.stringify({ password: els.adminPassword.value }),
    })
      .then(function (r) {
        if (r.ok) {
          els.adminPassword.value = "";
          load(state.page);
        } else {
          els.adminError.hidden = false;
        }
      })
      .catch(function () { els.adminError.hidden = false; });
  });

  els.signout.addEventListener("click", function () {
    fetch(API, { method: "DELETE", credentials: "include" }).then(function () { load(state.page); });
  });

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
