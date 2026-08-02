<div align="center">

# 🎓 Graduance - Sistem Informasi Bimbingan Skripsi & Tugas Akhir

[![Laravel Version](https://img.shields.io/badge/Laravel-v10.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP Version](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![Docker](https://img.shields.io/badge/Docker-Ready-2496ED?style=for-the-badge&logo=docker&logoColor=white)](https://www.docker.com/)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Tests Status](https://img.shields.io/badge/Tests-46%20Passed%20%7C%20100%25-success?style=for-the-badge&logo=githubactions&logoColor=white)](./tests/HAPPY_FLOW_RESULTS.md)
[![Security Audited](https://img.shields.io/badge/IDOR%20Security-Protected-blueviolet?style=for-the-badge&logo=shield)](./tests/BROKEN_FLOW_RESULTS.md)

<p align="center">
  <b>Graduance</b> adalah platform manajemen bimbingan skripsi dan tugas akhir perguruan tinggi berbasis web modern yang menghubungkan Mahasiswa, Dosen Pembimbing, dan Administrator Fakultas secara terintegrasi, cepat, dan aman.
</p>

</div>

---

## 🌟 Fitur Utama Aplikasi

### 👨‍🎓 Peran Mahasiswa (*Student*)
* **Pendaftaran Topik Bimbingan**: Memilih dan mendaftar pada topik skripsi yang dibuka oleh Dosen Pembimbing.
* **Pengajuan Revisi & Draf Skripsi**: Mengunggah file draf revisi (format PDF/DOCX) beserta catatan perbaikan.
* **Obrolan Bimbingan Interactive**: Berinteraksi dan melihat riwayat ulasan/koreksi dari dosen secara *real-time*.
* **Kotak Masuk Pengumuman**: Membaca pesan massal dan pengumuman dari Dosen Pembimbing & Fakultas.

### 👨‍🏫 Peran Dosen Pembimbing (*Teacher*)
* **Manajemen Topik Skripsi**: Membuka, mengedit, dan mengelola topik bimbingan tugas akhir.
* **Review & Koreksi Bimbingan**: Membuka draf revisi mahasiswa, mengunduh lampiran, dan memberikan tanggapan ulasan.
* **Persetujuan Sidang (*Approve*)**: Menyetujui bimbingan yang telah selesai untuk dipindahkan secara otomatis ke **Sistem Arsip**.
* **Daftar Mahasiswa Bimbingan**: Memantau daftar seluruh mahasiswa yang dibimbing beserta progresnya.
* **Pesan Massal (*Mass Messaging*)**: Mengirimkan pengumuman serentak ke seluruh/beberapa mahasiswa bimbingan.

### 🛡️ Peran Administrator (*Admin*)
* **Manajemen Pengguna**: Mengelola data Dosen Pembimbing dan Mahasiswa.
* **Manajemen Kelas & Jurusan**: Mengelompokkan mahasiswa berdasarkan kelas akademik (`TI-4A`, `TI-4B`, `SI-4A`).
* **Pengumuman Fakultas**: Mempublikasikan notifikasi resmi fakultas di dashboard seluruh pengguna.
* **Pesan Pengingat Dosen (*Reminder*)**: Mengirimkan notifikasi pengingat ke dosen yang memiliki draf bimbingan tertunda.
* **Sistem Arsip Skripsi**: Mengakses dan memfilter seluruh dokumen tugas akhir yang telah lulus/disetujui berdasarkan kelas.

---

## 🔑 Akun Demo Siap Pakai

Gunakan kredensial berikut untuk menguji coba aplikasi di lingkungan lokal:

| Peran (Role) | Email | Password | Pengguna |
| :--- | :--- | :---: | :--- |
| 🛡️ **Super Admin** | `admin@gmail.com` | `1234` | Dr. Ahmad Hidayat, M.Kom. |
| 👨‍🏫 **Dosen Utama** | `teacher@gmail.com` | `1234` | Dr. Hendra Wijaya, M.T. |
| 👨‍🏫 **Dosen AI** | `alex@gmail.com` | `1234` | Alex Bachtiar, Ph.D. |
| 👨‍🏫 **Dosen UI/UX** | `siti@gmail.com` | `1234` | Dr. Siti Rahma, S.T., M.Kom. |
| 👨‍🎓 **Mahasiswa (Revisi Aktif)** | `robert@gmail.com` | `1234` | Robert Davis Chaniago (`TI-4A`) |
| 👨‍🎓 **Mahasiswa (Bab 3)** | `budi@gmail.com` | `1234` | Budi Setiawan (`TI-4A`) |
| 👨‍🎓 **Mahasiswa (Lulus/Arsip)** | `citra@gmail.com` | `1234` | Citra Lestari (`TI-4B`) |
| 👨‍🎓 **Mahasiswa (Pendaftar Baru)** | `dewi@gmail.com` | `1234` | Dewi Anggraini (`SI-4A`) |

---

## ⚡ Panduan Instalasi & Jalankan (Quick Start)

Prasyarat: Dipastikan telah menginstall **Docker** & **Docker Compose** di perangkat Anda.

### 1. Clone Repository & Masuk ke Folder
```bash
git clone https://github.com/IbnuKhalis/graduance.git
cd graduance
```

### 2. Salin Konfigurasi `.env`
```bash
cp .env.example .env
```

### 3. Jalankan Docker Container (PHP 8.2 + MySQL)
```bash
docker compose up -d
```

### 4. Eksekusi Migrasi & Seeding Data Demo
```bash
docker compose exec app php artisan migrate:fresh --seed
```

### 5. Buat Link Simbolis Storage (Untuk Upload Foto & File)
```bash
docker compose exec app php artisan storage:link
```

### 6. Bersihkan Cache Konfigurasi & View
```bash
docker compose exec app php artisan config:clear
docker compose exec app php artisan view:clear
```

Aplikasi kini siap diakses melalui browser Anda di: **`http://127.0.0.1:8000`** 🚀

---

## 🧪 Pengujian Otomatis (Automated Testing)

Aplikasi ini dilengkapi dengan **46 Test Cases (185 Assertions)** yang menguji alur bisnis normal maupun ketahanan keamanan aplikasi.

### 🟢 1. Menjalankan Seluruh Test Suite
```bash
docker compose exec app php artisan test
```

### 🎯 2. Menjalankan Khusus Happy Flow Suite
Menguji 20 skenario alur utama (Autentikasi, Profil, Topik, Bimbingan, Approval, Pesan Massal, & Admin).
```bash
docker compose exec app php artisan test --testsuite=HappyFlow
```
> 📄 [Lihat Dokumentasi & Hasil Happy Flow](./tests/HAPPY_FLOW_RESULTS.md)

### 🛡️ 3. Menjalankan Khusus Broken Flow & Security Suite
Menguji 16 skenario ketahanan celah keamanan (Proteksi IDOR, Role Bypass, Upload File Executable Terlarang, & Penanganan 404).
```bash
docker compose exec app php artisan test --testsuite=BrokenFlow
```
> 📄 [Lihat Dokumentasi & Hasil Broken Flow](./tests/BROKEN_FLOW_RESULTS.md)

---

## 🛠️ Teknologi & Arsitektur

* **Framework Backend**: Laravel 10.x (PHP 8.2 CLI)
* **Database Management System**: MySQL 8.0 (Containerized)
* **Optimasi Performa**: PHP OPcache, Route Caching, & View Pre-compilation
* **Testing Framework**: PHPUnit 10 dengan SQLite In-Memory Database
* **Containerization**: Docker Compose (`app` & `mysql` services)
* **Frontend**: Blade Templating, Vanilla CSS, Bootstrap 5, FontAwesome, & SweetAlert2

---

## 📁 Struktur Direktori Utama

```text
graduance/
├── app/
│   ├── Http/Controllers/    # Controller utama (Auth, Bimbingan, Topik, Admin, Profile)
│   └── Models/              # Model Eloquent (User, Question, Answer, Topic, ClassRoom, dll)
├── database/
│   ├── factories/           # Factory untuk unit testing
│   ├── migrations/          # Migrasi skema database
│   └── seeders/             # Seeder data dummy demo lengkap
├── docker-compose.yml       # Konfigurasi container Docker app & database MySQL
├── Dockerfile               # Setup PHP 8.2, pdo_mysql, & OPcache
├── public/
│   └── storage/             # Symlink ke storage/app/public untuk foto & dokumen
├── resources/views/         # Template tampilan Blade UI/UX
├── routes/
│   └── web.php              # Rute utama aplikasi & middleware otorisasi
└── tests/
    ├── Feature/             # Automated test cases (Happy Flow & Broken Flow)
    ├── HAPPY_FLOW_RESULTS.md # Laporan hasil tes Happy Flow
    └── BROKEN_FLOW_RESULTS.md# Laporan hasil tes Broken Flow & Keamanan
```

---

## 📄 Lisensi

Proyek ini berada di bawah lisensi [MIT License](LICENSE).
