(() => {
  const safeJsonParse = (value, fallback) => {
    try {
      return JSON.parse(value);
    } catch {
      return fallback;
    }
  };

  const storage = {
    get(key, fallback = null) {
      const raw = window.localStorage.getItem(key);
      if (raw === null) return fallback;
      return safeJsonParse(raw, fallback);
    },
    set(key, value) {
      window.localStorage.setItem(key, JSON.stringify(value));
    },
    remove(key) {
      window.localStorage.removeItem(key);
    },
  };

  window.ROXWOOD = window.ROXWOOD ?? {};
  window.ROXWOOD.storage = storage;

  const themeKey = "roxwood.ui.theme";
  const applyTheme = (theme) => {
    if (!theme) return;
    document.documentElement.setAttribute("data-theme", theme);
  };

  const getTheme = () => {
    const saved = storage.get(themeKey, null);
    if (saved) return saved;
    // Default theme for medical UI: calm green (DaisyUI "emerald")
    return "emerald";
  };

  const setTheme = (theme) => {
    storage.set(themeKey, theme);
    applyTheme(theme);
  };

  window.ROXWOOD.theme = {
    get: getTheme,
    set: setTheme,
    toggle() {
      const next = getTheme() === "emerald" ? "light" : "emerald";
      setTheme(next);
    },
    apply() {
      applyTheme(getTheme());
    },
  };

  // Apply ASAP (in case layouts didn't inline-apply)
  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", () => window.ROXWOOD.theme.apply());
  } else {
    window.ROXWOOD.theme.apply();
  }
})();

(() => {
  const rootId = "roxwood-toast-root";
  const flashId = "roxwood-flash";

  const ensureRoot = () => {
    let el = document.getElementById(rootId);
    if (el) return el;
    el = document.createElement("div");
    el.id = rootId;
    el.className = "fixed top-4 right-4 left-4 sm:left-auto sm:w-96 z-50 space-y-2 pointer-events-none";
    document.body.appendChild(el);
    return el;
  };

  const typeToAlertClass = (type) => {
    switch (type) {
      case "success":
        return "alert-success";
      case "warning":
        return "alert-warning";
      case "error":
        return "alert-error";
      case "info":
      default:
        return "alert-info";
    }
  };

  const show = (type, message, opts = {}) => {
    const timeoutMs = Number.isFinite(opts.timeoutMs) ? opts.timeoutMs : 3000;
    if (!message) return;

    const root = ensureRoot();
    const item = document.createElement("div");
    item.className = `alert ${typeToAlertClass(type)} shadow-sm pointer-events-auto cursor-pointer`;
    item.setAttribute("role", "alert");
    item.innerHTML = `<span>${String(message)
      .replaceAll("&", "&amp;")
      .replaceAll("<", "&lt;")
      .replaceAll(">", "&gt;")}</span>`;

    // Click to dismiss
    item.addEventListener("click", () => item.remove());
    root.appendChild(item);

    window.setTimeout(() => {
      item.remove();
    }, timeoutMs);
  };

  const flushFlash = () => {
    const node = document.getElementById(flashId);
    if (!node) return;

    let payload = null;
    try {
      payload = JSON.parse(node.textContent || "{}");
    } catch {
      payload = null;
    }

    if (!payload || typeof payload !== "object") return;
    const order = ["error", "warning", "success", "info"];
    for (const type of order) {
      const msg = payload[type];
      if (typeof msg === "string" && msg.trim() !== "") {
        show(type, msg.trim(), { timeoutMs: type === "error" ? 5000 : 3000 });
      }
    }
  };

  window.ROXWOOD = window.ROXWOOD ?? {};
  window.ROXWOOD.toast = { show };

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", flushFlash);
  } else {
    flushFlash();
  }
})();

