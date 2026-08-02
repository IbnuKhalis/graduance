# Dokumentasi Happy Flow Test Suite - Graduance

Happy Flow Test Suite ini dirancang untuk memastikan seluruh alur utama (*end-to-end happy path*) aplikasi Graduance berjalan 100% sukses tanpa kegagalan.

---

## 🚀 Perintah Eksekusi Happy Flow Test Suite

### 1. Eksekusi via Docker Container:
```bash
docker compose exec app php artisan test --testsuite=HappyFlow
```

---

## 📋 Daftar Test Suite & Skenario Happy Flow

### 1. `AuthenticationTest.php` (Autentikasi & Akses)
- `test_login_screen_can_be_rendered`: Memastikan halaman login dapat dimuat.
- `test_users_can_authenticate_using_the_login_screen`: Memastikan pengguna (Admin, Dosen, Mahasiswa) dapat login dengan credential valid dan diarahkan ke `/admin/home`.
- `test_users_can_not_authenticate_with_invalid_password`: Memastikan login dengan password salah ditolak.
- `test_unauthenticated_user_is_redirected_to_login`: Memastikan pengguna tanpa session diarahkan ke halaman login.

### 2. `ProfileTest.php` (Pengelolaan Profil)
- `test_profile_page_can_be_rendered`: Memastikan halaman edit profil pengguna dapat dibuka.
- `test_profile_information_can_be_updated`: Memastikan pembaruan nama, email, NIM/NIP, jurusan, dan pengunggahan foto profil berhasil tersimpan.

### 3. `TopicManagementTest.php` (Pengelolaan Topik Bimbingan Dosen)
- `test_teacher_can_view_topics_index`: Memastikan dosen dapat melihat daftar topik bimbingannya.
- `test_teacher_can_create_topic`: Memastikan dosen dapat membuat topik bimbingan baru.
- `test_teacher_can_update_topic`: Memastikan dosen dapat memperbarui judul & deskripsi topik.
- `test_teacher_can_delete_topic`: Memastikan dosen dapat menghapus topik bimbingannya.

### 4. `GuidanceFlowTest.php` (Alur Utama Bimbingan & Revisi Skripsi)
- `test_student_can_view_their_questions`: Memastikan mahasiswa dapat melihat daftar pertanyaan/revisi miliknya.
- `test_student_can_submit_guidance_question`: Memastikan mahasiswa dapat mengajukan revisi bimbingan baru (+ pengunggahan dokumen PDF).
- `test_teacher_can_view_and_answer_guidance_question`: Memastikan dosen dapat membuka pertanyaan bimbingan dan memberikan balasan ulasan.
- `test_teacher_can_approve_guidance_question`: Memastikan dosen dapat menyetujui (*approve*) bimbingan hingga berstatus *accepted* dan dipindahkan ke sistem **Arsip**.

### 5. `AdminManagementTest.php` (Manajemen Admin)
- `test_admin_can_manage_teachers`: Memastikan admin dapat menambah, mengedit, dan menghapus akun Dosen Pembimbing.
- `test_admin_can_manage_classrooms`: Memastikan admin dapat mengelola daftar Kelas mahasiswa (`TI-4A`, `SI-4A`, dll.).
- `test_admin_can_manage_notifications`: Memastikan admin dapat membuat pengumuman/notifikasi sistem untuk seluruh pengguna.

### 6. `CommunicationTest.php` (Komunikasi & Pendaftaran Topik)
- `test_teacher_can_send_mass_message_to_mentored_students`: Memastikan dosen dapat mengirimkan pesan massal ke mahasiswa bimbingannya.
- `test_student_can_view_incoming_messages`: Memastikan mahasiswa dapat membaca pesan masuk dari dosen.
- `test_student_can_register_for_a_topic`: Memastikan mahasiswa baru dapat mengonfirmasi pendaftaran topik bimbingan dosen.
