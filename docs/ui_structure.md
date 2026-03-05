# Struktur UI (DaisyUI Enforcement)

Aturan ini bersifat wajib: **semua komponen UI harus menggunakan DaisyUI**.

## Komponen yang diizinkan
Hanya menggunakan komponen DaisyUI berikut sebagai building blocks:
- `btn`
- `card`
- `navbar`
- `drawer`
- `table`
- `badge`
- `alert`
- `dropdown`
- `modal`
- `tabs`
- `stats`

## Larangan
- Tidak membuat design system custom.
- Tidak membuat komponen UI “mirip DaisyUI” dengan styling manual yang menjadi standar baru.

## Layout structure (wajib)
Folder target:
- `app/Views/layouts/`
  - `main` layout
  - `auth` layout
- `app/Views/partials/`
  - `navbar`
  - `sidebar`
  - `footer`
  - `breadcrumbs`
  - `flash messages`
  - `modal dialogs`
  - `notification system`

Status implementasi:
- PHASE 4: layout dan seluruh partial di atas sudah dibuat sebagai UI shell awal.

## Mobile-first
- Prioritas tampilan: mobile → tablet → desktop.
- Sidebar admin menggunakan DaisyUI `drawer`.

## Struktur halaman (daftar wajib)
Admin panel harus memiliki halaman:
- Dashboard
- Event: Event Management
- Medical Services: Medical Service Regulations
- Pharmacy Recap: Pharmacy Regulations, Pharmacy Consumer Recap
- Finance: Reimbursement, Restaurant Consumption, Pharmacy Salary Recap
- Medical Operations: Plastic Surgery (Medics Only)
- Analytics: Duty Hour Ranking, Transaction Ranking, Website Usage Hours
- User Management: User Validation, User Management, Account Settings
- Recruitment: Medical Register, Medical Login, Candidate Registration, Candidate Exam, Candidate Evaluation, Interview Stage, Final Decision

Public pages:
- Candidate Registration
- Candidate Login
- Candidate Document Upload
- Candidate Exam
- Application Status
