<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\ClassRoom;
use App\Models\Message;
use App\Models\Notification;
use App\Models\Question;
use App\Models\Registration;
use App\Models\ReminderMessage;
use App\Models\Role;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database for demo purposes.
     */
    public function run(): void
    {
        // 1. Roles (Role 1: Admin, 2: Teacher, 3: Student)
        $adminRole   = Role::create(['role' => 'admin']);
        $teacherRole = Role::create(['role' => 'teacher']);
        $studentRole = Role::create(['role' => 'student']);

        // 2. Classrooms (Kelas)
        $classA = ClassRoom::create(['class' => 'TI-4A (Teknik Informatika)']);
        $classB = ClassRoom::create(['class' => 'TI-4B (Teknik Informatika)']);
        $classC = ClassRoom::create(['class' => 'SI-4A (Sistem Informasi)']);

        // 3. Admin User
        $admin = User::create([
            'name'      => 'Dr. Ahmad Hidayat, M.Kom.',
            'email'     => 'admin@gmail.com',
            'password'  => bcrypt('1234'),
            'role_id'   => $adminRole->id,
            'id_number' => '199001012015011001',
            'major'     => 'Teknologi Informasi'
        ]);

        // 4. Teachers (Dosen Pembimbing)
        $teacher1 = User::create([
            'name'      => 'Dr. Hendra Wijaya, M.T.',
            'email'     => 'teacher@gmail.com',
            'password'  => bcrypt('1234'),
            'role_id'   => $teacherRole->id,
            'id_number' => '198203152008011002',
            'major'     => 'Teknik Informatika'
        ]);

        $teacher2 = User::create([
            'name'      => 'Alex Bachtiar, Ph.D.',
            'email'     => 'alex@gmail.com',
            'password'  => bcrypt('1234'),
            'role_id'   => $teacherRole->id,
            'id_number' => '197905202005011001',
            'major'     => 'Teknik Informatika'
        ]);

        $teacher3 = User::create([
            'name'      => 'Dr. Siti Rahma, S.T., M.Kom.',
            'email'     => 'siti@gmail.com',
            'password'  => bcrypt('1234'),
            'role_id'   => $teacherRole->id,
            'id_number' => '198511122010012003',
            'major'     => 'Sistem Informasi'
        ]);

        // 5. Students (Mahasiswa)
        $student1 = User::create([
            'name'      => 'Robert Davis Chaniago',
            'email'     => 'robert@gmail.com',
            'password'  => bcrypt('1234'),
            'role_id'   => $studentRole->id,
            'class_id'  => $classA->id,
            'id_number' => '210101001',
            'major'     => 'Teknik Informatika'
        ]);

        $student2 = User::create([
            'name'      => 'Budi Setiawan',
            'email'     => 'budi@gmail.com',
            'password'  => bcrypt('1234'),
            'role_id'   => $studentRole->id,
            'class_id'  => $classA->id,
            'id_number' => '210101002',
            'major'     => 'Teknik Informatika'
        ]);

        $student3 = User::create([
            'name'      => 'Citra Lestari',
            'email'     => 'citra@gmail.com',
            'password'  => bcrypt('1234'),
            'role_id'   => $studentRole->id,
            'class_id'  => $classB->id,
            'id_number' => '210101003',
            'major'     => 'Teknik Informatika'
        ]);

        $student4 = User::create([
            'name'      => 'Dewi Anggraini',
            'email'     => 'dewi@gmail.com',
            'password'  => bcrypt('1234'),
            'role_id'   => $studentRole->id,
            'class_id'  => $classC->id,
            'id_number' => '210101004',
            'major'     => 'Sistem Informasi'
        ]);

        // 6. Topics (Topik Bimbingan Dosen)
        $topic1 = Topic::create([
            'topic'       => 'Rancang Bangun Aplikasi E-Learning Berbasis Microservices & Framework Laravel',
            'description' => 'Fokus pada pembangunan arsitektur aplikasi web modern, RESTful API, otentikasi JWT, dan optimasi performa server.',
            'teacher_id'  => $teacher1->id
        ]);

        $topic2 = Topic::create([
            'topic'       => 'Penerapan Algoritma Deep Learning untuk Deteksi Penyakit Tanaman Padi',
            'description' => 'Eksplorasi arsitektur Convolutional Neural Network (CNN) dan klasifikasi dataset gambar daun pertanian.',
            'teacher_id'  => $teacher2->id
        ]);

        $topic3 = Topic::create([
            'topic'       => 'Analisis & Redesain UI/UX Aplikasi Mobile Banking Menggunakan Metode Design Thinking',
            'description' => 'Studi pengalaman pengguna, wawancara mendalam, wireframing, kuesioner UEQ, dan usability testing.',
            'teacher_id'  => $teacher3->id
        ]);

        $topic4 = Topic::create([
            'topic'       => 'Implementasi Internet of Things (IoT) pada Sistem Monitoring Pertanian Cerdas',
            'description' => 'Integrasi mikrokontroler ESP32, sensor kelembaban tanah, dan dashboard pemantauan berbasis MQTT.',
            'teacher_id'  => $teacher1->id
        ]);

        // 7. Registrations (Pendaftaran Topik Mahasiswa)
        Registration::create([
            'student_id' => $student1->id,
            'topic_id'   => $topic1->id,
            'teacher_id' => $teacher1->id
        ]);

        Registration::create([
            'student_id' => $student2->id,
            'topic_id'   => $topic2->id,
            'teacher_id' => $teacher2->id
        ]);

        Registration::create([
            'student_id' => $student3->id,
            'topic_id'   => $topic3->id,
            'teacher_id' => $teacher3->id
        ]);

        Registration::create([
            'student_id' => $student4->id,
            'topic_id'   => $topic4->id,
            'teacher_id' => $teacher1->id
        ]);

        // 8. Questions (Pertanyaan Bimbingan & Revisi)
        $q1 = Question::create([
            'title'      => 'Revisi Bab 1 & 2: Latar Belakang, Landasan Teori, dan Diagram Use Case',
            'body'       => '<p>Selamat pagi Pak Hendra, berikut draf <strong>Bab 1 dan Bab 2</strong> yang telah saya revisi sesuai catatan masukan minggu lalu mengenai penambahan latar belakang masalah dan perbaikan diagram Use Case. Dokumen terlampir.</p>',
            'file'       => 'file-questions/9BOjXdJtT8BzchtYm8Kfx8zZGYufWpk1TfJa25ap.pdf',
            'status'     => 'revision',
            'user_id'    => $student1->id,
            'teacher_id' => $teacher1->id,
            'topic_id'   => $topic1->id
        ]);

        $q2 = Question::create([
            'title'      => 'Draf Bab 3: Metodologi Penelitian & Arsitektur Model CNN',
            'body'       => '<p>Permisi Pak Alex, berikut draf Bab 3 mengenai teknik preprocessing dataset citra daun padi dan skema arsitektur Convolutional Neural Network (CNN) untuk ulasan Bapak.</p>',
            'file'       => 'file-questions/G1sSeCAdqMssM7K59XVrEDJEJy0L88sJvBtNLH3A.pdf',
            'status'     => 'revision',
            'user_id'    => $student2->id,
            'teacher_id' => $teacher2->id,
            'topic_id'   => $topic2->id
        ]);

        $q3 = Question::create([
            'title'      => 'Laporan Final Tugas Akhir Bab 1 - 5 (Siap Sidang Skripsi)',
            'body'       => '<p>Selamat siang Ibu Siti, berikut naskah lengkap tugas akhir yang telah diperbaiki total dari Bab 1 hingga Bab 5 beserta hasil usability testing. Dokumen ini sudah siap diarsipkan dan diajukan ke sidang skripsi.</p>',
            'file'       => 'file-questions/aeqO93ltL4RERCe8mXr5H2uocJUglSZX1FWFFv9L.pdf',
            'status'     => 'accepted', // Status Masuk Arsip
            'user_id'    => $student3->id,
            'teacher_id' => $teacher3->id,
            'topic_id'   => $topic3->id
        ]);

        // 9. Answers (Balasan / Chat Bimbingan)
        Answer::create([
            'body'        => 'Latar belakang masalah dan perumusan masalah sudah jauh lebih sistematis. Namun pada Bab 2, harap tambahkan min. 3 referensi jurnal bereputasi 3 tahun terakhir (2023-2026).',
            'file'        => null,
            'question_id' => $q1->id,
            'user_id'     => $teacher1->id
        ]);

        Answer::create([
            'body'        => 'Baik Pak Hendra, terima kasih atas arahannya. Referensi jurnal terbaru sudah saya tambahkan pada poin 2.3.',
            'file'        => null,
            'question_id' => $q1->id,
            'user_id'     => $student1->id
        ]);

        Answer::create([
            'body'        => 'Selamat Citra, seluruh revisi laporan tugas akhir Anda disetujui. Naskah ini resmi diarsipkan untuk persyaratan ujian sidang skripsi.',
            'file'        => null,
            'question_id' => $q3->id,
            'user_id'     => $teacher3->id
        ]);

        // 10. Messages (Pesan Massal Dosen)
        Message::create([
            'message'    => 'Diberitahukan kepada seluruh mahasiswa bimbingan agar segera memperbarui draf Bab 1-3 sebelum batas akhir pengumpulan minggu depan.',
            'is_read'    => false,
            'student_id' => $student1->id,
            'teacher_id' => $teacher1->id
        ]);

        Message::create([
            'message'    => 'Jadwal bimbingan tatap muka minggu ini dilaksanakan pada hari Kamis pukul 10.00 WIB di Ruang Dosen 204.',
            'is_read'    => false,
            'student_id' => $student2->id,
            'teacher_id' => $teacher2->id
        ]);

        // 11. System Notifications (Pengumuman Admin)
        Notification::create([
            'title'        => 'Pengumuman Pendaftaran Ujian Sidang Skripsi Gelombang II',
            'notification' => 'Pendaftaran Ujian Sidang Skripsi Gelombang II Tahun Akademik 2025/2026 resmi dibuka mulai tanggal 1 hingga 15 bulan depan. Lengkapi berkas persetujuan pembimbing.',
            'admin_id'     => $admin->id
        ]);

        Notification::create([
            'title'        => 'Jadwal Seminar Hasil Tugas Akhir & Informasi Perpustakaan',
            'notification' => 'Jadwal pelaksanaan Seminar Hasil dan verifikasi bebas perpustakaan dapat diakses melalui papan pengumuman fakultas.',
            'admin_id'     => $admin->id
        ]);

        // 12. Reminder Messages (Pengingat Admin ke Dosen)
        ReminderMessage::create([
            'reminder'   => 'Pengingat Admin: Terdapat 2 draf revisi bimbingan mahasiswa yang menunggu tanggapan/ulasan Bapak.',
            'teacher_id' => $teacher1->id
        ]);
    }
}
