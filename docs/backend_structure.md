# Struktur Backend (CodeIgniter 4)

Dokumen ini menetapkan struktur backend yang akan dibangun setelah CodeIgniter 4 terpasang.

## Folder inti (target)
- `app/Controllers/`
  - `Admin/` halaman admin panel
  - `Public/` halaman publik recruitment
  - `Api/` endpoint JSON untuk polling/realtime
- `app/Models/` model per tabel (generated dari SQL)
- `app/Services/` logika bisnis
  - AI scoring engine
  - fraud & anomaly detection
  - monitoring/performance logging
- `app/Filters/` autentikasi, role guard, dsb.
- `app/Config/` konfigurasi routes, filters, session, security
- `app/Views/` layout dan UI (DaisyUI-only)
- `app/Commands/` utilitas CLI (khusus lokal/dev)
  - `roxwood:pin-hash` untuk generate hash bcrypt PIN
  - `roxwood:pin-set` untuk reset PIN `user_rh` via CLI (jangan digunakan di production shared hosting)

## Pola implementasi (wajib)
- Controller:
  - Validasi input
  - Panggil Service/Model
  - Render View atau JSON response
- Service:
  - Semua perhitungan skor, klasifikasi, rules fraud/anomali
  - Query orchestration (hindari N+1)
- Model:
  - Sesuai tabel dan kolom
  - Menggunakan Query Builder CI4 (anti SQL injection)

## Routing (konsep)
- Admin: prefix `/admin/...`
- Public recruitment: `/candidate/...`
- API polling: `/api/...`
