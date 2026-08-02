# 🛡️ Laporan Hasil Pengujian Broken Flow & Keamanan (Broken Flow & Security Test Results)

Dokumen ini berisi rincian pengujian **Broken Flow, Negative Testing, Celah Keamanan (IDOR), dan Pengujian Edge Cases** untuk aplikasi **Graduance**. Pengujian ini dilakukan untuk memastikan sistem tangguh (*robust*) terhadap percobaan peretasan, manipulasi URL, pengunggahan file eksekusi terlarang, dan input data tidak valid.

---

## 📊 Ringkasan Eksekusi Broken Flow

* **Total Test Suite**: 4 File Test Cases Keamanan & Broken Flow
* **Total Skrip Pengujian**: 16 Method Tests
* **Total Assertion**: 30 Assertions
* **Status**: 🟢 **100% PASSED** *(Setelah perbaikan otorisasi & scope query)*
* **Lingkungan Pengujian**: PHPUnit 10, SQLite In-Memory Database, PHP 8.2 Docker Container
* **Waktu Eksekusi**: ~14.70 Detik
* **Perintah Eksekusi**:
  ```bash
  docker compose exec app php artisan test --testsuite=BrokenFlow
  ```

---

## 📋 Rincian Skenario & Hasil Pengujian Broken Flow

### 1. `SecurityAndAuthorizationTest.php` (Pengujian IDOR & Role Bypass)

> **Latar Belakang Audit**: Pengujian ini mensimulasikan penyerang yang mencoba membypass hak akses atau mengakses data pengguna lain melalui manipulasi URL langsung (*Direct Object Reference*).

| Kode Skenario | Nama Skenario Uji | Deskripsi Serangan / Vektor Uji | Hasil Harapan Sistem | Respon HTTP | Status |
| :--- | :--- | :--- | :--- | :---: | :---: |
| **SEC-01** | `test_student_cannot_view_other_student_question_detail` | **Mahasiswa B** mencoba membuka URL detail bimbingan **Mahasiswa A** (`GET /admin/your-questions/{id_A}`). | Akses ditolak/dibatasi. Sistem mengembalikan status 404 karena data di luar scope. | `404 Not Found` | 🟢 **PASS** |
| **SEC-02** | `test_student_cannot_edit_other_student_question` | **Mahasiswa B** mencoba membuka form edit bimbingan **Mahasiswa A** (`GET /admin/your-questions/{id_A}/edit`). | Form tidak dibuka. Sistem mengembalikan 404. | `404 Not Found` | 🟢 **PASS** |
| **SEC-03** | `test_student_cannot_update_other_student_question` | **Mahasiswa B** mengirimkan request `PUT` untuk mengubah judul & isi bimbingan **Mahasiswa A**. | Perubahan ditolak. Data di database tidak berubah. | `404 Not Found` | 🟢 **PASS** |
| **SEC-04** | `test_student_cannot_delete_other_student_question` | **Mahasiswa B** mengirimkan request `DELETE` untuk menghapus bimbingan **Mahasiswa A**. | Penghapusan ditolak. Record di database aman. | `404 Not Found` | 🟢 **PASS** |
| **SEC-05** | `test_teacher_cannot_approve_other_teacher_guidance_question` | **Dosen B** mencoba menyetujui (*approve*) pertanyaan bimbingan **Dosen A** (`POST /questions/{id_A}/approve`). | Approval diblokir. Status bimbingan tidak berubah. | `404 Not Found` | 🟢 **PASS** |
| **SEC-06** | `test_student_cannot_access_teacher_routes` | Mahasiswa mencoba mengakses rute Dosen (`/admin/questions-to-answer`, `/admin/mass-messaging`). | Middleware Role melarang akses. | `403 Forbidden` | 🟢 **PASS** |
| **SEC-07** | `test_student_cannot_access_admin_routes` | Mahasiswa mencoba mengakses rute Admin (`/admin/teachers`, `/admin/students`). | Middleware Role melarang akses. | `403 Forbidden` | 🟢 **PASS** |
| **SEC-08** | `test_teacher_cannot_access_admin_routes` | Dosen mencoba mengakses rute kelola Dosen & Kelas Admin. | Middleware Role melarang akses. | `403 Forbidden` | 🟢 **PASS** |

---

### 2. `InvalidInputValidationTest.php` (Pengujian Validasi Form & Input Salah)

| Kode Skenario | Nama Skenario Uji | Deskripsi & Vektor Input | Hasil Harapan Sistem | Respon | Status |
| :--- | :--- | :--- | :--- | :---: | :---: |
| **VAL-01** | `test_submit_guidance_question_fails_without_required_fields` | Mengirimkan form pertanyaan bimbingan kosong tanpa menyertakan judul, isi, dosen, & file. | Sesi mengembalikan error validasi pada seluruh field wajib. | `302 Session Errors` | 🟢 **PASS** |
| **VAL-02** | `test_create_user_fails_with_duplicate_email` | Membuat pengguna baru menggunakan alamat email yang sudah terdaftar di database. | Pendaftaran ditolak dengan pesan error *"email has already been taken"*. | `302 Session Errors` | 🟢 **PASS** |
| **VAL-03** | `test_profile_update_fails_with_invalid_email_format` | Memperbarui profil menggunakan format string email palsu (`bukan-email-valid`). | Update ditolak oleh aturan validasi email. | `302 Session Errors` | 🟢 **PASS** |
| **VAL-04** | `test_profile_update_fails_with_short_password` | Memperbarui password dengan panjang di bawah batas minimum (`12345` < 8 karakter). | Update ditolak oleh aturan validasi `min:8`. | `302 Session Errors` | 🟢 **PASS** |

---

### 3. `FileUploadSecurityTest.php` (Pengujian File Upload Eksekusi Terlarang)

| Kode Skenario | Nama Skenario Uji | Deskripsi & File Uji | Hasil Harapan Sistem | Respon | Status |
| :--- | :--- | :--- | :--- | :---: | :---: |
| **FILE-01** | `test_student_cannot_upload_executable_file_for_guidance` | Mengunggah file webshell PHP berkedok dokumen (`malware.php`, MIME: `text/x-php`). | Upload diblokir total oleh aturan validasi `mimes:docx,doc,pdf`. File tidak tersimpan. | `302 Session Errors` | 🟢 **PASS** |
| **FILE-02** | `test_student_cannot_upload_exe_file` | Mengunggah file executable Windows (`payload.exe`, MIME: `application/x-msdownload`). | Upload diblokir total. | `302 Session Errors` | 🟢 **PASS** |

---

### 4. `BusinessLogicEdgeCasesTest.php` (Pengujian Resource Tidak Ada & Rule Bisnis)

| Kode Skenario | Nama Skenario Uji | Deskripsi Pengujian | Hasil Harapan Sistem | Respon HTTP | Status |
| :--- | :--- | :--- | :--- | :---: | :---: |
| **EDGE-01** | `test_accessing_non_existent_question_returns_not_found` | Mengakses URL pertanyaan dengan ID acak tidak terdaftar (`GET /admin/your-questions/9999999`). | Sistem menangani dengan `findOrFail` dan mengembalikan `404 Not Found` (mencegah Crash 500). | `404 Not Found` | 🟢 **PASS** |
| **EDGE-02** | `test_sending_mass_message_fails_without_selecting_students` | Dosen mengirimkan pesan massal tanpa memilih target mahasiswa bimbingan. | Form ditolak dengan error validasi `student_id`. | `302 Session Errors` | 🟢 **PASS** |

---

## 🛠️ Ringkasan Perbaikan Keamanan yang Telah Diterapkan

1. **Penanganan IDOR (Query Scoping)**:
   * Seluruh method di `YourQuestionsController`, `QuestionsToAnswer`, `TopicsController`, `ArchiveController`, dan `MentoredStudentsController` telah ditambahkan batas scope kepemilikan data (`where('user_id', auth()->id())` dan `where('teacher_id', auth()->id())`).
2. **Pencegahan Application Crash (HTTP 500)**:
   * Mengganti seluruh fungsi `find($id)` dengan `findOrFail($id)` untuk mengembalikan standar HTTP 404 saat data tidak ada.
3. **Filter Jenis File Khusus Dokumen**:
   * Pengetatan aturan validasi unggah file menjadi `mimes:docx,doc,pdf|max:10240` untuk mencegah eksekusi file berbahaya (*Webshell / Malware Execution*).
