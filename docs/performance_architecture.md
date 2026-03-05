# Arsitektur Performa

## localStorage performance system (wajib)
Simpan dan pulihkan state berikut:
- UI state (tema/state global jika dipakai)
- Dashboard cache
- Form inputs (draft)
- Menu state (drawer/sidebar)
- Table state (filter, sort, page)

## Pola load (wajib)
1. Saat page load: render UI dari cache localStorage **secepat mungkin**.
2. Setelah itu: refresh data dari server (HTMX/AJAX), lalu update UI dan cache.

## Optimasi asset statis
- Versioning: `app.css?v=1`, `app.js?v=1`
- Browser caching agresif untuk `public/assets/*`
- Hindari download berulang (ubah `v=` hanya saat release)

## Monitoring performa (wajib)
Log yang harus tersedia untuk admin:
- Page load time (client-reported + server timing jika memungkinkan)
- Slow queries
- API response time
- System errors/exceptions

Catatan: detail implementasi monitoring akan didefinisikan pada fase “Performance Monitoring”.

