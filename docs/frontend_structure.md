# Struktur Frontend (Tailwind + DaisyUI + AlpineJS + HTMX)

Dokumen ini menetapkan bagaimana frontend dibangun tanpa NodeJS runtime di server.

## Prinsip
- DaisyUI wajib untuk komponen UI (lihat `docs/ui_structure.md`).
- Tailwind dipakai untuk utilities dan responsive.
- AlpineJS untuk state UI lokal.
- HTMX untuk interaksi HTML (partial render, pagination, form submit).
- Tidak membuat design system custom.

## Asset strategy (shared hosting)
- Asset CSS/JS dibangun lokal (atau via pipeline saat develop) dan hasilnya berupa file statis:
  - `public/assets/app.css`
  - `public/assets/app.js`
- Vendor JS (self-hosted, wajib untuk shared hosting):
  - `public/assets/vendor/alpine.min.js`
  - `public/assets/vendor/htmx.min.js`
- Versioning query param (wajib):
  - `app.css?v=1`
  - `app.js?v=1`
- Cache-control agresif di `.htaccess` / header Apache (lihat `docs/performance_architecture.md`).

## Pipeline build (dev-only)
NodeJS hanya digunakan di mesin developer untuk menghasilkan file statis yang kemudian di-upload ke hosting.

Perintah standar:
- `npm install`
- `npm run build`

Script di `package.json` akan:
1) Menyalin AlpineJS + HTMX dari `node_modules` ke `public/assets/vendor/`
2) Build Tailwind + DaisyUI ke `public/assets/app.css` (minified)

## Integrasi HTMX + AlpineJS
- HTMX untuk request/swap HTML
- AlpineJS untuk:
  - state menu/sidebar
  - caching form inputs
  - caching table state
  - menampilkan data polling secara ringan
