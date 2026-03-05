/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./app/Views/**/*.php",
    "./app/Controllers/**/*.php",
    "./app/Config/**/*.php",
    "./public/**/*.html",
    "./resources/**/*.{js,css}",
  ],
  theme: {
    extend: {},
  },
  plugins: [require("daisyui")],
  daisyui: {
    themes: [
      {
        roxwood: {
          primary: "#2563eb", // blue-600
          secondary: "#14b8a6", // teal-500
          accent: "#06b6d4", // cyan-500
          neutral: "#111827", // gray-900
          "base-100": "#ffffff",
          "base-200": "#f8fafc", // slate-50
          "base-300": "#e2e8f0", // slate-200
          "base-content": "#0f172a", // slate-900
          info: "#0ea5e9", // sky-500
          success: "#16a34a", // green-600
          warning: "#f59e0b", // amber-500
          error: "#ef4444", // red-500
        },
      },
      "light",
    ],
  },
};

