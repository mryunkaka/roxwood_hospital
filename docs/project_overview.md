# ROXWOOD HOSPITAL SYSTEM — Project Overview

Dokumen ini adalah ringkasan tujuan, batasan, dan ruang lingkup sistem. Seluruh dokumentasi di folder `docs/` berfungsi sebagai *project memory* yang wajib diikuti selama pengembangan.

## Tujuan akhir
Membangun sistem produksi bernama **ROXWOOD HOSPITAL SYSTEM** yang:
- Berjalan di **shared hosting** (Apache + PHP 8+ + MySQL).
- Menggunakan **CodeIgniter 4** (backend) dengan pola **MVC** yang rapi.
- Menggunakan **Tailwind CSS + DaisyUI (wajib) + AlpineJS + HTMX** (frontend).
- Menerapkan **mobile-first** (320/360/480 px sebagai prioritas).
- Memiliki **admin panel** dan **public pages** sesuai daftar halaman yang ditetapkan.
- Memiliki **realtime tanpa WebSocket** (AJAX polling interval 1–2 detik).
- Memiliki **AI recruitment scoring engine internal** (tanpa API eksternal), termasuk deteksi fraud dan anomali.
- Mengutamakan keamanan, performa, dan *query efficiency*.
- Mengikuti aturan **Database Schema Protection**: SQL schema adalah single source of truth.

## Batasan hosting (non-negotiable)
- Tidak ada SSH / terminal server.
- Tidak ada NodeJS runtime, Docker, Redis, WebSocket server.
- Semua proses build harus dapat dilakukan lokal dan hasilnya diunggah (assets statis).

## Aturan bahasa
- **UI text**: selalu **ENGLISH**.
- **Dokumentasi & penjelasan developer**: selalu **INDONESIAN**.

## Prinsip pengembangan
- Deterministik: struktur folder, modul, dan konvensi harus mengikuti `docs/architecture.md` dan `docs/*_structure.md`.
- Dokumentasi mendahului implementasi: jika belum tertulis di docs, tulis dulu.
- Setelah tiap fase selesai: update `docs/development_progress.md` lalu buat commit dengan format:
  - `[ROXWOOD] PHASE X COMPLETED`

