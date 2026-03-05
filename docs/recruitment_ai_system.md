# Sistem AI Recruitment (Internal, Tanpa API Eksternal)

Dokumen ini mendefinisikan mesin penilaian internal untuk ujian kandidat, termasuk fraud detection, anomaly detection, dan integrasi interview stage.

## Tujuan
- Menilai jawaban ujian kandidat (30 pertanyaan) ke dalam trait:
  - discipline
  - responsibility
  - honesty
  - teamwork
  - stress tolerance
  - leadership
  - communication
  - empathy
- Menghasilkan skor per trait + skor total + klasifikasi:
  - Highly Recommended
  - Recommended
  - Neutral
  - Risk Candidate
  - Not Recommended
- Menyimpan hasil untuk HR review.

## Model penilaian (konsep deterministik)
Catatan: detail bobot per pertanyaan akan ditetapkan saat definisi bank soal tersedia.

Minimal engine harus mendukung:
- Mapping pertanyaan → trait (bisa multi-trait).
- Skoring jawaban (mis. skala 1–5) → normalisasi per trait.
- Kalkulasi skor total.
- Klasifikasi berdasarkan threshold yang terdokumentasi.

## Auto fraud detection (wajib)
Flag perilaku mencurigakan, contoh:
- Submission sangat cepat (durasi tidak wajar).
- Pola jawaban identik (kesamaan tinggi).
- Multiple account attempts.
- IP duplication.
- Pola device mencurigakan (fingerprint sederhana).

## Behavioral anomaly detection (wajib)
Flag pola tidak biasa, contoh:
- Respons kontradiktif antar trait.
- Distribusi jawaban acak/flat.
- Inkonstistensi ekstrem dibanding baseline.

## Interview scoring system (wajib)
- Multi interviewer menilai:
  - communication
  - confidence
  - professionalism
  - attitude
  - honesty
- Final score:
  - 40% AI exam score
  - 60% interview score
- HR dapat override final decision (dengan audit log).

## Final recruitment flow (wajib)
1. Candidate Registration
2. Document Upload
3. 30 Question Exam
4. AI Evaluation
5. HR Review
6. Interview Stage
7. Final Decision
8. Register ke `user_rh`

Dokumen kandidat dipindahkan ke storage dokumen medis, dokumen lama kandidat dihapus sesuai kebijakan retensi yang ditetapkan.

