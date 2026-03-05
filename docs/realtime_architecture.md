# Arsitektur Realtime (AJAX Polling)

## Larangan
Tidak menggunakan WebSocket server, SSE server, atau layanan realtime eksternal yang membutuhkan daemon.

## Mekanisme (wajib)
- Polling interval: **1–2 detik**.
- Endpoint JSON di `/api/...`.
- Payload ringkas dan terstruktur.

## Contoh fitur realtime (wajib didukung)
- Pharmacy transactions
- Inventory updates
- Candidate status
- Dashboard statistics

## Strategi penghematan beban
- Batasi field yang dikirim (select minimal).
- Pagination untuk data list besar.
- Gunakan parameter `since`/`last_id` atau `updated_after` jika schema menyediakan kolom timestamp.
- Jika memungkinkan, gunakan ETag/If-None-Match untuk menghindari payload yang sama.

