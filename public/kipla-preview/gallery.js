/* KIPLA "See KIPLA in Action" gallery — paginated records + admin upload */
(function () {
  "use strict";

  var API = window.KIPLA_GALLERY_API || "/api/gallery";
  var FEATURED = (window.KIPLA_GALLERY_FEATURED | 0) || 0;

  var els = {
    grid: document.getElementById("action-gallery"),
    empty: document.getElementById("action-gallery-empty"),
    pager: document.getElementById("action-gallery-pager"),
    pagePrev: document.getElementById("gallery-prev"),
    pageNext: document.getElementById("gallery-next"),
    pageInfo: document.getElementById("gallery-page-info"),
    adminLink: document.getElementById("gallery-admin-link"),
    adminPanel: document.getElementById("gallery-admin-panel"),
    adminPassword: document.getElementById("gallery-admin-password"),
    adminError: document.getElementById("gallery-admin-error"),
    adminBar: document.getElementById("gallery-admin-bar"),
    signout: document.getElementById("gallery-signout"),
    uploadBtn: document.getElementById("gallery-upload-btn"),
    uploadInput: document.getElementById("gallery-upload-input"),
    uploader: document.getElementById("gallery-uploader"),
    queueTitle: document.getElementById("gallery-queue-title"),
    queue: document.getElementById("gallery-queue"),
    seeAll: document.getElementById("gallery-see-all"),
  };
  if (!els.grid) return;

  var state = { page: 1, totalPages: 1, total: 0, admin: false, queue: [], uploading: false };

  function load(page) {
    var target = page || state.page || 1;
    fetch(API + "?page=" + target + (FEATURED ? "&limit=" + FEATURED : ""), { credentials: "include" })
      .then(function (r) { return r.json(); })
      .then(function (data) {
        state.page = data.page;
        state.totalPages = data.totalPages;
        state.total = data.total;
        state.admin = !!data.admin;
        renderItems(data.items);
        renderPager();
        renderAdmin();
      })
      .catch(function () {
        els.empty.hidden = false;
        els.empty.textContent = "Could not load the gallery right now. Please refresh the page.";
      });
  }

  function renderItems(items) {
    els.grid.innerHTML = "";
    els.empty.hidden = state.total > 0;
    if (els.seeAll) els.seeAll.hidden = state.total <= FEATURED;
    if (state.total === 0) {
      els.empty.textContent = state.admin
        ? "No photos yet — click “Upload to Gallery” to add some."
        : "No photos yet — check back soon!";
    }
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

  function renderPager() {
    els.pager.hidden = !!FEATURED || state.totalPages <= 1;
    els.pagePrev.disabled = state.page <= 1;
    els.pageNext.disabled = state.page >= state.totalPages;
    els.pageInfo.textContent =
      "Page " + state.page + " of " + state.totalPages + " · " + state.total +
      (state.total === 1 ? " item" : " items");
  }

  function renderAdmin() {
    els.adminLink.hidden = state.admin;
    if (!state.admin) els.adminPanel.hidden = true;
    els.adminBar.hidden = !state.admin;
    if (!state.admin) els.uploader.hidden = true;
  }

  /* --- admin login --- */
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
          load(1);
        } else {
          els.adminError.hidden = false;
        }
      })
      .catch(function () { els.adminError.hidden = false; });
  });

  els.signout.addEventListener("click", function () {
    fetch(API, { method: "DELETE", credentials: "include" }).then(function () { load(state.page); });
  });

  /* --- uploads: many files, one after another, with progress + retry --- */
  els.uploadBtn.addEventListener("click", function () { els.uploadInput.click(); });

  els.uploadInput.addEventListener("change", function () {
    var files = Array.prototype.slice.call(els.uploadInput.files || []);
    if (!files.length) return;
    files.forEach(function (file) { addToQueue(file); });
    els.uploadInput.value = "";
    startQueue();
  });

  function addToQueue(file) {
    var entry = { file: file, status: "pending", row: null };
    state.queue.push(entry);
    var row = document.createElement("div");
    row.className = "gallery-queue-row";
    var name = document.createElement("span");
    name.className = "gallery-queue-name";
    name.textContent = file.name;
    name.title = file.name;
    var progress = document.createElement("span");
    progress.className = "gallery-progress";
    var fill = document.createElement("span");
    fill.className = "gallery-progress__fill";
    progress.appendChild(fill);
    var status = document.createElement("span");
    status.className = "gallery-queue-status";
    status.textContent = "Waiting…";
    var retry = document.createElement("button");
    retry.type = "button";
    retry.className = "btn btn--ghost btn--sm gallery-queue-retry";
    retry.textContent = "Retry";
    retry.hidden = true;
    retry.addEventListener("click", function () {
      entry.status = "pending";
      status.textContent = "Waiting…";
      row.classList.remove("is-failed");
      retry.hidden = true;
      startQueue();
    });
    row.appendChild(name);
    row.appendChild(progress);
    row.appendChild(status);
    row.appendChild(retry);
    entry.row = row;
    entry.fill = fill;
    entry.statusEl = status;
    entry.retryEl = retry;
    els.queue.appendChild(row);
    els.uploader.hidden = false;
  }

  function startQueue() {
    if (state.uploading) return;
    var next = state.queue.filter(function (e) { return e.status === "pending"; })[0];
    if (!next) { finishQueue(); return; }
    state.uploading = true;
    next.status = "uploading";
    next.statusEl.textContent = "Uploading…";
    uploadOne(next).then(function (ok) {
      state.uploading = false;
      if (!ok) {
        next.status = "failed";
        next.row.classList.add("is-failed");
        next.statusEl.textContent = "Failed";
        next.retryEl.hidden = false;
      }
      startQueue();
    });
  }

  function uploadOne(entry) {
    return new Promise(function (resolve) {
      var xhr = new XMLHttpRequest();
      xhr.open("POST", API);
      xhr.withCredentials = true;
      var form = new FormData();
      form.append("file", entry.file);
      xhr.upload.onprogress = function (e) {
        if (e.lengthComputable) {
          var pct = Math.round((e.loaded / e.total) * 100);
          entry.fill.style.width = pct + "%";
          entry.statusEl.textContent = pct + "%";
        }
      };
      xhr.onload = function () {
        if (xhr.status >= 200 && xhr.status < 300) {
          entry.fill.style.width = "100%";
          entry.statusEl.textContent = "Done ✓";
          resolve(true);
        } else {
          entry.statusEl.textContent = "Failed";
          resolve(false);
        }
      };
      xhr.onerror = function () {
        entry.statusEl.textContent = "Failed";
        resolve(false);
      };
      xhr.send(form);
    });
  }

  function finishQueue() {
    var pending = state.queue.filter(function (e) { return e.status === "pending" || e.status === "uploading"; });
    if (pending.length) return;
    var failed = state.queue.filter(function (e) { return e.status === "failed"; });
    var done = state.queue.length - failed.length;
    els.queueTitle.textContent = failed.length
      ? "Uploaded " + done + " — " + failed.length + " failed. Retry below."
      : "Uploaded " + done + (done === 1 ? " file" : " files") + " ✓";
    state.queue = [];
    if (!failed.length) {
      els.uploader.hidden = true;
      els.queue.innerHTML = "";
      load(1);
    }
  }

  els.pagePrev.addEventListener("click", function () { if (state.page > 1) load(state.page - 1); });
  els.pageNext.addEventListener("click", function () { if (state.page < state.totalPages) load(state.page + 1); });

  load(1);
})();
