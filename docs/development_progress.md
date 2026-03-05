# Development Progress (Checkpoint)

Dokumen ini adalah checkpoint wajib. Jika pengembangan berhenti, baca file ini dan lanjutkan dari langkah berikutnya.

## Status
- Tanggal: **2026-03-05** (Asia/Singapore)
- Fase aktif: **PHASE 5 — Authentication system** (berikutnya)

## Log progres

### PHASE 1 — Initialize project
- [x] Membuat folder `docs/` dan seluruh file dokumentasi awal.
- [x] Menetapkan arsitektur deterministik awal (backend/frontend/mobile/performance/realtime/security) di dokumen.
- [x] PHASE 1 selesai.

### PHASE 2 — Install CodeIgniter 4
- [x] Setup CodeIgniter 4 via Composer dan struktur standar.
- [x] Versi terpasang: CodeIgniter `v4.7.0` (composer.lock).
- [x] Verifikasi lokal: `php spark --version` berjalan.
- [x] PHASE 2 selesai.

### PHASE 3 — Install Tailwind + DaisyUI
- [x] Siapkan pipeline build asset (lokal) dan output `public/assets/`.
- [x] Integrasi DaisyUI + AlpineJS + HTMX (self-hosted di `public/assets/vendor/`).
- [x] Output statis tersedia: `public/assets/app.css` dan `public/assets/app.js`.
- [x] PHASE 3 selesai.

### PHASE 4 — Admin panel layout
- [x] Implement `layouts/main` dan `layouts/auth` berbasis DaisyUI.
- [x] Implement partials (navbar/sidebar/footer/breadcrumbs/flash/modal/notification).
- [x] Implement drawer sidebar state cache via localStorage.
- [x] Tambah route & halaman stub untuk verifikasi UI shell (`/admin`, `/admin/login`).
- [x] PHASE 4 selesai.

### PHASE 5 — Authentication system
- [x] Implement login/logout admin berbasis session (sementara via `.env`).
- [x] CSRF aktif global + form login memakai token.
- [x] Filter guard: `adminauth` + `role` (role siap untuk “Medics Only” nanti).
- [x] Session/cookie hardening dasar (cookie name, secure in production).
- [x] PHASE 5 selesai (sementara; DB-based auth menunggu SQL schema).

### PHASE 6 — SQL schema analysis
- [ ] Import SQL schema dari user dan update `docs/database_structure.md`.
