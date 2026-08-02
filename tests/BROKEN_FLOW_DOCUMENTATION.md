# Dokumentasi Broken Flow & Security Test Suite - Graduance

Dokumen ini berisi panduan, filosofi pengujian, dan struktur skenario **Broken Flow & Security Test Suite** pada aplikasi Graduance.

---

## 🎯 Tujuan Broken Flow Test Suite
Broken Flow Test Suite dirancang khusus untuk menguji ketahanan aplikasi saat menghadapi kondisi tidak ideal, percobaan peretasan, manipulasi URL, serta kesalahan masukan pengguna.

Fokus utama pengujian ini meliputi:
1. **Pengujian Otorisasi & Celah IDOR (Insecure Direct Object Reference)**.
2. **Pengujian Akses Lintas Peran (Role-Based Access Control / Role Bypass)**.
3. **Pengujian Keamanan Upload File Berbahaya (Malicious File Uploads)**.
4. **Pengujian Validasi Form & Negatif Input (Negative Form Validation)**.
5. **Pengujian Edge Cases & Mencegah Application Crash (HTTP 500)**.

---

## 🚀 Perintah Eksekusi Broken Flow Test Suite

### 1. Eksekusi via Docker Container:
```bash
docker compose exec app php artisan test --testsuite=BrokenFlow
```

---

## 📋 Struktur File Test Cases Broken Flow

### 1. `SecurityAndAuthorizationTest.php` (Pengujian Keamanan Otorisasi & IDOR)
- **Fokus**: Memastikan pengguna tidak dapat membaca, merubah, atau menghapus data milik pengguna lain meskipun mengetahui ID parameternya.
- **Skenario Teruji**:
  - Mahasiswa B mencoba membuka detail bimbingan Mahasiswa A (`GET /admin/your-questions/{id_A}`).
  - Mahasiswa B mencoba mengedit bimbingan Mahasiswa A (`GET /admin/your-questions/{id_A}/edit`).
  - Mahasiswa B mencoba memperbarui bimbingan Mahasiswa A (`PUT /admin/your-questions/{id_A}`).
  - Mahasiswa B mencoba menghapus bimbingan Mahasiswa A (`DELETE /admin/your-questions/{id_A}`).
  - Dosen B mencoba menyetujui (*approve*) bimbingan milik Dosen A (`POST /questions/{id_A}/approve`).
  - Mahasiswa & Dosen mencoba membypass rute khusus peran lain (Admin / Teacher).

### 2. `InvalidInputValidationTest.php` (Pengujian Validasi Form & Input Salah)
- **Fokus**: Memastikan sistem menolak pengiriman form yang tidak lengkap atau tidak valid dengan pesan error yang jelas.
- **Skenario Teruji**:
  - Mengirim form bimbingan tanpa mengisi field wajib (*title*, *body*, *teacher_id*, *topic_id*, *file*).
  - Pendaftaran pengguna baru dengan email yang sudah terdaftar di sistem.
  - Pembaruan profil dengan format email yang salah (`bukan-email`).
  - Pembaruan profil dengan password di bawah batas minimum (< 8 karakter).

### 3. `FileUploadSecurityTest.php` (Pengujian Proteksi Upload File Berbahaya)
- **Fokus**: Memastikan aplikasi menolak pengunggahan file skrip eksekusi berbahaya (*webshell* / *malware*).
- **Skenario Teruji**:
  - Mengunggah file `.php` berkedok dokumen.
  - Mengunggah file executable `.exe`.

### 4. `BusinessLogicEdgeCasesTest.php` (Pengujian Resource Tidak Ada & Edge Cases)
- **Fokus**: Memastikan sistem memberikan respon HTTP 404 yang ramah pengguna saat membuka ID acak yang tidak ada, dan menolak pengiriman pesan massal tanpa penerima.
- **Skenario Teruji**:
  - Mengakses ID pertanyaan bimbingan yang tidak ada di database (`/admin/your-questions/9999999`).
  - Dosen mengirim pesan massal tanpa memilih mahasiswa bimbingan.
