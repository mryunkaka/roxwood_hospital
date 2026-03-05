# AI Task Planner (Fase Pengembangan)

Dokumen ini adalah rencana fase yang harus diikuti. Setiap fase:
1) Implementasi
2) Self review (cek arsitektur, database rules, DaisyUI, mobile, docs)
3) Update `docs/development_progress.md`
4) Commit: `[ROXWOOD] PHASE X COMPLETED`

## PHASE 1 — Initialize project
- Buat sistem dokumentasi (`docs/`) sebagai memori proyek.
- Tetapkan arsitektur deterministik (struktur backend/frontend, mobile, performa, realtime, security).

## PHASE 2 — Install CodeIgniter 4
- Pasang CI4 (Composer) dan struktur folder standar.
- Konfigurasi environment dev/prod.

## PHASE 3 — Install Tailwind + DaisyUI
- Siapkan pipeline build assets (lokal), output ke `public/assets/`.
- Pastikan DaisyUI digunakan untuk komponen.
- Pasang AlpineJS + HTMX.

## PHASE 4 — Admin panel layout
- Implement `layouts/main`, `layouts/auth`.
- Implement partials: navbar, sidebar, footer, breadcrumbs, flash messages, modal dialogs, notification system.
- Semua komponen DaisyUI.

## PHASE 5 — Authentication system
- Login/logout, session, role guard.
- Admin vs kandidat (public) access separation.

## PHASE 6 — SQL schema analysis
- Load SQL schema (user-provided).
- Update `docs/database_structure.md`.

## PHASE 7 — Model generation
- Generate Model CI4 dari tabel yang ada (tanpa mengubah schema).

## PHASE 8 — Dashboard
- Dashboard admin dengan cache localStorage + refresh server.
- Statistik realtime (polling).

## PHASE 9 — Recruitment system
- Full flow kandidat (registrasi, dokumen, ujian 30 soal, status).
- HR review + interview stage + final decision.

## PHASE 10 — Realtime system
- Polling endpoints untuk transaksi/aplikasi/status/stats.
- Optimasi payload dan query.

## PHASE 11 — Analytics system
- Duty hour ranking, transaction ranking, website usage hours.
- Pagination dan query optimized.

## PHASE 12 — Deployment preparation
- Hardening security & caching.
- Dokumentasi deployment shared hosting final.

