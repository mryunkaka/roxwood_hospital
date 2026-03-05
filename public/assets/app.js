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
})();

