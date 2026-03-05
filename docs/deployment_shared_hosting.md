# Deployment di Shared Hosting (Apache + PHP + MySQL)

Dokumen ini akan memandu deployment ke cPanel/DirectAdmin/Apache hosting standar tanpa SSH.

## Prasyarat
- PHP 8+ aktif
- MySQL database tersedia
- Domain/subdomain sudah mengarah ke folder hosting

## Strategi struktur upload
Target struktur umum:
- `public_html/` (atau document root)
  - berisi konten folder `public/` dari CodeIgniter 4
- Folder aplikasi di luar webroot (direkomendasikan bila hosting mendukung):
  - `app/`, `system/`, `writable/`, `.env`, vendor (Composer)

Catatan: detail final mengikuti struktur CI4 yang akan dipasang pada PHASE 2.

## Konfigurasi `.env`
Wajib mengatur:
- `CI_ENVIRONMENT = production`
- Database credentials
- Base URL
- Session & security settings yang sesuai

## `.htaccess`
Harus memastikan:
- Rewrite ke `index.php`
- Deny akses ke file sensitif (mis. `.env`)
- Cache-control untuk assets `public/assets/*`

## Database setup
- Import SQL schema (single source of truth).
- Pastikan collation/charset sesuai SQL file.

## File permissions
- `writable/` harus dapat ditulis oleh PHP.
- Folder upload dokumen harus aman dan memiliki aturan akses yang jelas.

