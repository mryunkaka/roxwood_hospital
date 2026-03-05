# Aturan Database (Schema Protection)

SQL schema adalah **SINGLE SOURCE OF TRUTH**.

## Aturan utama
- Wajib membaca file SQL schema yang diberikan user sebelum membuat Model.
- Dilarang:
  - Membuat tabel baru
  - Mengubah tipe/kolom
  - Rename field
  - Menambah index
  - Mengubah constraint
- Pengecualian hanya jika user secara eksplisit memerintahkan: **ADD COLUMN** atau **ADD TABLE**.

## Implikasi implementasi
- Model CodeIgniter 4 dibuat 1:1 berdasarkan tabel.
- Field list di Model harus mengikuti kolom asli, tanpa abstraksi yang merusak kompatibilitas.
- Migrasi CI4 tidak digunakan untuk mengubah schema (karena schema berasal dari SQL file).

## Status saat ini
- File SQL belum tersedia di repository saat dokumen ini dibuat (2026-03-05).
- Setelah SQL diberikan, isi `docs/database_structure.md` harus diperbarui dengan daftar tabel dan kolom, lalu fase “SQL schema analysis” dijalankan.

