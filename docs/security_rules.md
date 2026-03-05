# Aturan Keamanan

Target: aman untuk lingkungan shared hosting dan aman terhadap serangan umum web.

## Wajib diterapkan
- CSRF protection (gunakan mekanisme CI4).
- Input validation di server untuk semua form dan endpoint API.
- SQL injection prevention (Query Builder + binding).
- XSS protection (escape output view).
- Secure session management:
  - session cookie flags (HttpOnly, Secure jika HTTPS)
  - session regeneration pada login
  - timeout/idle expiry yang jelas
- Password hashing:
  - gunakan `password_hash()` (default bcrypt/argon sesuai PHP)
  - verifikasi dengan `password_verify()`
- Access control:
  - role/permission untuk akses halaman admin (termasuk “Medics Only” untuk Plastic Surgery)
- Audit log untuk keputusan HR dan perubahan sensitif.

## Hygiene tambahan
- Rate limiting untuk login dan endpoint sensitif (soft limit yang cocok di shared hosting).
- Validasi upload dokumen: tipe file, ukuran, dan penyimpanan aman di luar webroot jika memungkinkan.
- Error handling: jangan bocorkan stack trace di production.

