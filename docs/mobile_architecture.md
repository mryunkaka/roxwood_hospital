# Arsitektur Mobile-First

Target perangkat:
- 320px
- 360px
- 480px

## Aturan
- Mulai dari layout mobile, baru tambahkan breakpoint untuk tablet/desktop.
- Gunakan utilitas responsive Tailwind (mis. `sm:`, `md:`, `lg:`) secara minimal dan terukur.
- Sidebar admin menggunakan pola **drawer** (DaisyUI) agar nyaman di mobile.

## Checklist UI mobile
- Semua tabel memiliki strategi mobile (scroll-x, ringkasan card, atau pagination).
- Touch target tombol memadai.
- Form mudah diisi, label jelas (UI text English).
- Notifikasi dan flash message tidak menutupi konten penting.

