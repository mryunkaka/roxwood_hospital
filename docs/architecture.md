# Arsitektur Sistem (Deterministik)

Dokumen ini menetapkan keputusan arsitektur yang wajib diikuti agar struktur proyek konsisten, mudah dipelihara, dan cocok untuk shared hosting.

## Target runtime
- Apache + PHP 8+
- MySQL
- CodeIgniter 4

## Prinsip arsitektur
1. **Separation of Concerns (MVC)**: Controller tipis, logika domain di Service, akses data di Model.
2. **DaisyUI-only UI**: komponen UI harus berasal dari DaisyUI (lihat `docs/ui_structure.md`).
3. **Mobile-first**: layout dan komponen diprioritaskan untuk 320/360/480 px.
4. **Realtime tanpa WebSocket**: hanya AJAX polling + endpoint JSON.
5. **Database immutable**: schema mengikuti SQL file yang diberikan, tanpa perubahan.
6. **Dokumentasi sebagai memori**: setiap fase menambah/menyempurnakan docs.

## Struktur tinggi (high-level modules)
- **Admin Panel**: seluruh halaman admin yang ditentukan (dashboard, event, medical services, pharmacy, finance, operations, analytics, user management, recruitment).
- **Public Recruitment**: registrasi kandidat, login, upload dokumen, ujian, status aplikasi.
- **Realtime Layer**: endpoint polling + cache ringan di sisi client (localStorage) + optimasi query.
- **Monitoring**: logging performa (page load, slow query, API latency, error).
- **Security**: CSRF, validasi input, session hardening, hashing password.

## Konvensi penamaan (wajib)
- Namespace controller:
  - `App\\Controllers\\Admin\\...` untuk admin panel
  - `App\\Controllers\\Public\\...` untuk halaman publik
  - `App\\Controllers\\Api\\...` untuk endpoint JSON/polling
- Views:
  - `app/Views/layouts/` untuk layout
  - `app/Views/partials/` untuk partial
  - `app/Views/admin/` untuk halaman admin
  - `app/Views/public/` untuk halaman publik
- Services:
  - `app/Services/` untuk logika bisnis (AI scoring, fraud detection, monitoring, dsb.)
- Models:
  - `app/Models/` dihasilkan dari SQL schema (lihat `docs/database_rules.md`)

## Arsitektur front-end (ringkas)
- Tailwind + DaisyUI: styling dan komponen
- AlpineJS: state ringan dan interaksi UI lokal
- HTMX: partial updates, form submit, pagination tanpa SPA
- localStorage: caching state & data ringkas (lihat `docs/performance_architecture.md`)

## Arsitektur realtime (ringkas)
- Polling 1–2 detik ke endpoint `Api/*`
- Response JSON minimal; gunakan ETag/last_updated jika diperlukan untuk mengurangi payload
- Update UI via HTMX swap atau AlpineJS render

