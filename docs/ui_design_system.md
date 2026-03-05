# UI Design System — ROXWOOD HOSPITAL SYSTEM

Dokumen ini menjadi standar tunggal untuk desain UI (admin + public) agar konsisten, modern, mobile-first, dan cocok untuk sistem medis.

## Filosofi desain
- **SaaS dashboard**: hierarki jelas, fokus pada data, dan navigasi cepat.
- **Medical-friendly**: tampilan bersih, warna tenang, kontras nyaman untuk pemakaian lama.
- **Konsistensi**: spacing, typography, dan komponen tidak berubah-ubah antar halaman.
- **Mobile-first**: prioritas pengalaman 320px/360px/480px; desktop mengikuti tanpa “ruang kosong berlebihan”.
- **Ringan**: tanpa framework berat; hanya AlpineJS + HTMX untuk interaksi.

## Library & aturan wajib
- **DaisyUI wajib** untuk komponen UI.
- Tailwind dipakai untuk **utility** (spacing/responsive/layout) tanpa membuat design system baru.
- Komponen yang digunakan harus dari daftar yang diizinkan:
  `navbar`, `drawer`, `menu`, `btn`, `card`, `table`, `badge`, `alert`, `tabs`, `stats`, `dropdown`, `modal`,
  `input`, `select`, `textarea`.

## Struktur layout global
Admin layout menggunakan pola:
- **Top Navbar**
- **Sidebar Drawer** (DaisyUI `drawer`)
- **Main Content** (container + cards)
- **Footer**

File:
- `app/Views/layouts/main.php` (admin)
- `app/Views/layouts/auth.php` (login/halaman auth)
- `app/Views/partials/navbar.php`
- `app/Views/partials/sidebar.php`
- `app/Views/partials/footer.php`
- `app/Views/partials/breadcrumbs.php`
- `app/Views/partials/flash_messages.php` (flash → toast)
- `app/Views/partials/modal_dialogs.php`
- `app/Views/partials/notification_system.php`

## Navbar (admin)
Wajib memuat:
- **Kiri**: tombol toggle sidebar (mobile), logo, nama sistem
- **Kanan**: theme switcher, dropdown akun (account settings, logout)

Aturan:
- Navbar sticky (tetap di atas saat scroll).
- Tidak menampilkan informasi berlebihan; nama/role user cukup sebagai label ringkas.

## Sidebar (admin)
Wajib:
- Menggunakan DaisyUI `menu`
- **Scrollable**
- Highlight menu aktif (`active`)
- Memiliki ikon pada setiap item menu
- Group sesuai modul:
  Dashboard, Events, Medical Services, Pharmacy, Finance, Medical Operations, Analytics, Recruitment, User Management

UX:
- Mobile: sidebar menjadi drawer (overlay).
- Desktop: sidebar dapat toggle (hide/show) dan state disimpan di localStorage.

## Dashboard
Pola SaaS:
- **Stats** (DaisyUI `stats`) untuk KPI ringkas.
- **Cards** untuk quick actions, recent activity, alert.
- Semua blok konten **dibungkus card**.

## Card system (wajib)
Semua konten harus berada di dalam `card`:
- Form
- Table
- Panel informasi
- Analytics

Padding standar:
- Card body: `p-4` (mobile) → `sm:p-6` (tablet/desktop)
Spacing antar card:
- `gap-3` (mobile) / `gap-4` (desktop)

## Table system
Standar:
- DaisyUI `table table-zebra`
- `overflow-x-auto` untuk mobile
- Hover (`table-hover`) jika cocok
- Pagination untuk dataset besar (di fase modul)

## Form system
Standar:
- Gunakan DaisyUI `input/select/textarea` + `input-bordered`
- Lebar penuh di mobile (`w-full`)
- Touch-friendly (hindari tombol kecil untuk aksi utama)

## Sistem warna (tema)
Tema default: **`roxwood`** (DaisyUI theme) dengan token:
- primary: biru
- secondary: teal
- accent: cyan
- neutral: abu gelap
- base: putih + abu lembut untuk background

Aturan:
- Jangan gunakan warna acak; selalu pakai token DaisyUI (mis. `btn-primary`, `bg-base-200`, `text-base-content`).

## Typography
- Judul halaman: `text-2xl font-bold`
- Subjudul: `text-sm opacity-70`
- Body: `text-sm`–`text-base`

## Spacing system
Gunakan skala Tailwind secara konsisten:
- padding: `p-4`, `p-6`
- jarak: `gap-3`, `gap-4`, `gap-6`
- hindari padding “random” (mis. `p-5.5`)

## Mobile-first checklist
- Sidebar drawer berfungsi baik di 320/360/480.
- Tombol utama minimal `btn-sm` (atau `btn` di mobile) dan tidak terlalu rapat.
- Table selalu aman dengan scroll-x.
- Toast tidak menutupi konten penting.

## Performance UI
- Tidak ada animasi berat.
- Toast auto-dismiss ringan.
- Theme + drawer state disimpan di localStorage untuk load cepat.

