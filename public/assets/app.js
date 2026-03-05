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
    return window.matchMedia && window.matchMedia("(prefers-color-scheme: dark)").matches
      ? "dark"
      : "light";
  };

  const setTheme = (theme) => {
    storage.set(themeKey, theme);
    applyTheme(theme);
  };

  window.ROXWOOD.theme = {
    get: getTheme,
    set: setTheme,
    toggle() {
      const next = getTheme() === "dark" ? "light" : "dark";
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

