# 🟢 Laporan Hasil Pengujian Happy Flow (Happy Path Test Results)

Dokumen ini berisi rincian lengkap skenario pengujian alur utama (*Happy Flow*) untuk aplikasi **Graduance**. Pengujian ini memastikan seluruh fungsi aplikasi berjalan normal sesuai dengan alur bisnis (*business logic*) yang diharapkan.

---

## 📊 Ringkasan Eksekusi Happy Flow

* **Total Test Suite**: 6 File Test Cases
* **Total Skrip Pengujian**: 20 Method Tests
* **Total Assertion**: 70 Assertions
* **Status**: 🟢 **100% PASSED**
* **Lingkungan Pengujian**: PHPUnit 10, SQLite In-Memory Database, PHP 8.2 Docker Container
* **Waktu Eksekusi**: ~17.58 Detik
* **Perintah Eksekusi**:
  ```bash
  docker compose exec app php artisan test --testsuite=HappyFlow
  ```

---

## 📋 Rincian Skenario & Hasil Pengujian Happy Flow

### 1. `AuthenticationTest.php` (Fitur Otentikasi & Sesi Pengguna)

| Kode Skenario | Nama Skenario Uji | Deskripsi & Input Data | Hasil Harapan | Status |
| :--- | :--- | :--- | :--- | :---: |
| **AUTH-01** | `test_login_screen_can_be_rendered` | Membuka rute `/login` via HTTP GET. | Halaman login memuat status `200 OK`. | 🟢 **PASS** |
| **AUTH-02** | `test_users_can_authenticate_using_the_login_screen` | Mengirimkan form login dengan email & password valid (`robert@gmail.com` / `1234`). | Pengguna berhasil diautentikasi dan diarahkan ke `/admin/home`. | 🟢 **PASS** |
| **AUTH-03** | `test_users_can_not_authenticate_with_invalid_password` | Mengirimkan email valid dengan password salah (`wrong-password`). | Sesi otentikasi gagal dan mengembalikan error validasi. | 🟢 **PASS** |
| **AUTH-04** | `test_unauthenticated_user_is_redirected_to_login` | Pengguna tanpa sesi mencoba mengakses `/admin/home`. | Pengguna otomatis diarahkan (*redirect*) ke `/login`. | 🟢 **PASS** |

---

### 2. `ProfileTest.php` (Pengelolaan Profil Pengguna)

| Kode Skenario | Nama Skenario Uji | Deskripsi & Input Data | Hasil Harapan | Status |
| :--- | :--- | :--- | :--- | :---: |
| **PROF-01** | `test_profile_page_can_be_rendered` | Mengakses halaman `/admin/profile` sebagai pengguna terautentikasi. | Tampilan profil memuat status `200 OK`. | 🟢 **PASS** |
| **PROF-02** | `test_profile_information_can_be_updated` | Memperbarui Nama, Email, NIM, Jurusan, dan mengunggah foto profil (`avatar.jpg`). | Database ter-update dengan data baru dan foto tersimpan di storage `public/photos`. | 🟢 **PASS** |

---

### 3. `TopicManagementTest.php` (Manajemen Topik Bimbingan Dosen)

| Kode Skenario | Nama Skenario Uji | Deskripsi & Input Data | Hasil Harapan | Status |
| :--- | :--- | :--- | :--- | :---: |
| **TOPIC-01** | `test_teacher_can_view_topics_index` | Dosen membuka halaman daftar topik di `/admin/topics`. | Memuat tabel topik bimbingan dosen tersebut dengan status `200 OK`. | 🟢 **PASS** |
| **TOPIC-02** | `test_teacher_can_create_topic` | Dosen menambahkan topik baru (Judul & Deskripsi). | Data topik baru tersimpan di database dan tampil di daftar. | 🟢 **PASS** |
| **TOPIC-03** | `test_teacher_can_update_topic` | Dosen mengubah judul/deskripsi topik yang telah dibuat. | Data topik di database ter-update dengan data terbaru. | 🟢 **PASS** |
| **TOPIC-04** | `test_teacher_can_delete_topic` | Dosen menghapus salah satu topik bimbingannya. | Record topik terhapus dari database `topics`. | 🟢 **PASS** |

---

### 4. `GuidanceFlowTest.php` (Alur Utama Bimbingan & Revisi Skripsi)

| Kode Skenario | Nama Skenario Uji | Deskripsi & Input Data | Hasil Harapan | Status |
| :--- | :--- | :--- | :--- | :---: |
| **GUIDE-01** | `test_student_can_view_their_questions` | Mahasiswa membuka menu `/admin/your-questions`. | Memuat seluruh riwayat bimbingan milik mahasiswa tersebut. | 🟢 **PASS** |
| **GUIDE-02** | `test_student_can_submit_guidance_question` | Mahasiswa mengirim draf revisi baru + dokumen PDF. | Record `questions` bertambah dan file terunggah di `storage/app/public/file-questions`. | 🟢 **PASS** |
| **GUIDE-03** | `test_teacher_can_view_and_answer_guidance_question` | Dosen membuka pertanyaan mahasiswa dan mengirimkan ulasan/balasan. | Record `answers` bertambah dan terhubung dengan `question_id`. | 🟢 **PASS** |
| **GUIDE-04** | `test_teacher_can_approve_guidance_question` | Dosen menyetujui bimbingan mahasiswa (`status = accepted`). | Status pertanyaan menjadi `accepted` dan masuk ke menu **Arsip**. | 🟢 **PASS** |

---

### 5. `AdminManagementTest.php` (Fungsi Kelola Sistem oleh Admin)

| Kode Skenario | Nama Skenario Uji | Deskripsi & Input Data | Hasil Harapan | Status |
| :--- | :--- | :--- | :--- | :---: |
| **ADM-01** | `test_admin_can_manage_teachers` | Admin mengelola data Dosen Pembimbing (Tambah/Edit/Hapus). | Data dosen pada tabel `users` (`role_id = 2`) ter-update. | 🟢 **PASS** |
| **ADM-02** | `test_admin_can_manage_classrooms` | Admin mengelola kelas mahasiswa (`TI-4A`, `SI-4A`). | Data kelas pada tabel `class_rooms` ter-update. | 🟢 **PASS** |
| **ADM-03** | `test_admin_can_manage_notifications` | Admin membuat pengumuman fakultas baru. | Data pengumuman terbuat pada tabel `notifications`. | 🟢 **PASS** |

---

### 6. `CommunicationTest.php` (Fitur Pesan Massal & Pendaftaran)

| Kode Skenario | Nama Skenario Uji | Deskripsi & Input Data | Hasil Harapan | Status |
| :--- | :--- | :--- | :--- | :---: |
| **COMM-01** | `test_teacher_can_send_mass_message_to_mentored_students` | Dosen memilih mahasiswa bimbingannya dan mengirim pesan pengumuman. | Record `messages` bertambah untuk setiap mahasiswa target. | 🟢 **PASS** |
| **COMM-02** | `test_student_can_view_incoming_messages` | Mahasiswa melihat kotak masuk pengumuman dari dosen. | Tampilan memuat daftar pesan bimbingan dari dosen. | 🟢 **PASS** |
| **COMM-03** | `test_student_can_register_for_a_topic` | Mahasiswa baru memilih dan mendaftar topik bimbingan dosen. | Record `registrations` terbuat dan menghubungkan Mahasiswa, Topik, & Dosen. | 🟢 **PASS** |
