# Deployment di Shared Hosting (Apache + PHP + MySQL)

Dokumen ini akan memandu deployment ke cPanel/DirectAdmin/Apache hosting standar tanpa SSH.

## Prasyarat
- PHP 8+ aktif
- MySQL database tersedia
- Domain/subdomain sudah mengarah ke folder hosting

## Strategi struktur upload (CodeIgniter 4)
CodeIgniter 4 menggunakan `public/` sebagai webroot.

Opsi A (direkomendasikan): document root diarahkan ke `public/`
- Atur domain/subdomain agar document root menunjuk ke folder `public/`.
- Upload seluruh project ke hosting, pastikan hanya `public/` yang terbuka ke web.

Opsi B (fallback jika document root tidak bisa diubah)
- Pindahkan isi `public/` ke `public_html/`.
- Pastikan file `index.php` tetap menunjuk ke path `app/Config/Paths.php` dengan benar (sesuaikan relative path bila perlu).
- Lindungi file sensitif (`.env`, `writable/`, `app/`, `system/`) dari akses langsung melalui `.htaccess`.

## Konfigurasi `.env`
Wajib mengatur:
- `CI_ENVIRONMENT = production`
- Database credentials
- Base URL
- Session & security settings yang sesuai

Catatan:
- Repository menyediakan file template `env` (bawaan CI4). Untuk dipakai, salin menjadi `.env` lalu ubah nilainya.

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
