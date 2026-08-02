<div align="center">

# 🎓 Graduance - Thesis & Academic Guidance Information System

[![Laravel Version](https://img.shields.io/badge/Laravel-v10.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP Version](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![Docker](https://img.shields.io/badge/Docker-Ready-2496ED?style=for-the-badge&logo=docker&logoColor=white)](https://www.docker.com/)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Tests Status](https://img.shields.io/badge/Tests-46%20Passed%20%7C%20100%25-success?style=for-the-badge&logo=githubactions&logoColor=white)](./tests/HAPPY_FLOW_RESULTS.md)
[![Security Audited](https://img.shields.io/badge/IDOR%20Security-Protected-blueviolet?style=for-the-badge&logo=shield)](./tests/BROKEN_FLOW_RESULTS.md)

<p align="center">
  <b>Graduance</b> is a modern web-based thesis and final project guidance management platform designed to connect Students, Academic Advisors (Teachers), and Faculty Administrators in a fast, integrated, and secure ecosystem.
</p>

</div>

---

## 🌟 Key Features

### 👨‍🎓 Student Role
* **Thesis Topic Registration**: Browse and register for available thesis topics published by Academic Advisors.
* **Revision & Draft Submissions**: Upload thesis draft revisions (PDF/DOCX format) along with revision notes.
* **Interactive Guidance Chat**: Engage in real-time communication and view feedback and corrections from advisors.
* **Announcement Inbox**: Read broadcast messages and official announcements sent by Advisors & Faculty Administrators.

### 👨‍🏫 Teacher / Academic Advisor Role
* **Topic Management**: Create, edit, and manage thesis topics available for guidance.
* **Review & Correction System**: Inspect student draft submissions, download attachments, and leave structured feedback.
* **Thesis Approval**: Approve completed guidance sessions to automatically archive student documents into the **Archive System**.
* **Mentored Students Overview**: Monitor all assigned students and track their thesis progress.
* **Mass Messaging**: Send simultaneous broadcast messages to all or selected mentored students.

### 🛡️ Administrator Role
* **User Management**: Manage accounts for Teachers and Students.
* **Classroom & Department Management**: Group students by academic class (`TI-4A`, `TI-4B`, `SI-4A`).
* **Faculty Announcements**: Publish official announcements across user dashboards.
* **Advisor Reminders**: Send automated or manual reminder notifications to advisors with pending review drafts.
* **Thesis Archive System**: Access, search, and filter approved thesis documents by academic class.

---

## 🔑 Demo Credentials

Use the following credentials to test the application in your local environment:

| Role | Email | Password | User Name |
| :--- | :--- | :---: | :--- |
| 🛡️ **Super Admin** | `admin@gmail.com` | `1234` | Dr. Ahmad Hidayat, M.Kom. |
| 👨‍🏫 **Lead Advisor** | `teacher@gmail.com` | `1234` | Dr. Hendra Wijaya, M.T. |
| 👨‍🏫 **AI Advisor** | `alex@gmail.com` | `1234` | Alex Bachtiar, Ph.D. |
| 👨‍🏫 **UI/UX Advisor** | `siti@gmail.com` | `1234` | Dr. Siti Rahma, S.T., M.Kom. |
| 👨‍🎓 **Student (Active Revision)** | `robert@gmail.com` | `1234` | Robert Davis Chaniago (`TI-4A`) |
| 👨‍🎓 **Student (Chapter 3)** | `budi@gmail.com` | `1234` | Budi Setiawan (`TI-4A`) |
| 👨‍🎓 **Student (Graduated/Archived)** | `citra@gmail.com` | `1234` | Citra Lestari (`TI-4B`) |
| 👨‍🎓 **Student (New Applicant)** | `dewi@gmail.com` | `1234` | Dewi Anggraini (`SI-4A`) |

---

## ⚡ Quick Start Guide

Prerequisites: Ensure **Docker** & **Docker Compose** are installed on your system.

### 1. Clone Repository & Navigate
```bash
git clone https://github.com/IbnuKhalis/graduance.git
cd graduance
```

### 2. Copy `.env` File
```bash
cp .env.example .env
```

### 3. Start Docker Containers (PHP 8.2 + MySQL)
```bash
docker compose up -d
```

### 4. Run Database Migrations & Demo Seeding
```bash
docker compose exec app php artisan migrate:fresh --seed
```

### 5. Create Storage Symbolic Link (For File Uploads)
```bash
docker compose exec app php artisan storage:link
```

### 6. Clear Configuration & View Caches
```bash
docker compose exec app php artisan config:clear
docker compose exec app php artisan view:clear
```

The application is now ready to access in your browser at: **`http://127.0.0.1:8000`** 🚀

---

## 🧪 Automated Testing

Graduance features **46 Test Cases (185 Assertions)** covering standard business flows as well as security vulnerability tests.

### 🟢 1. Run Complete Test Suite
```bash
docker compose exec app php artisan test
```

### 🎯 2. Run Happy Flow Suite
Tests 20 core business scenarios (Authentication, Profile, Topics, Guidance, Approval, Mass Messaging, & Admin).
```bash
docker compose exec app php artisan test --testsuite=HappyFlow
```
> 📄 [View Happy Flow Test Documentation & Results](./tests/HAPPY_FLOW_RESULTS.md)

### 🛡️ 3. Run Broken Flow & Security Suite
Tests 16 vulnerability scenarios (IDOR Protection, Role Bypass, Executable Upload Prevention, & 404 Exception Handling).
```bash
docker compose exec app php artisan test --testsuite=BrokenFlow
```
> 📄 [View Broken Flow & Security Test Results](./tests/BROKEN_FLOW_RESULTS.md)

---

## 🛠️ Tech Stack & Architecture

* **Backend Framework**: Laravel 10.x (PHP 8.2 CLI)
* **Database Management System**: MySQL 8.0 (Containerized)
* **Performance Optimization**: PHP OPcache, Route Caching, & View Pre-compilation
* **Testing Framework**: PHPUnit 10 with SQLite In-Memory Database
* **Containerization**: Docker Compose (`app` & `mysql` services)
* **Frontend**: Blade Templating, Vanilla CSS, Bootstrap 5, FontAwesome, & SweetAlert2

---

## 📁 Directory Structure

```text
graduance/
├── app/
│   ├── Http/Controllers/    # Application controllers (Auth, Guidance, Topics, Admin, Profile)
│   └── Models/              # Eloquent models (User, Question, Answer, Topic, ClassRoom, etc.)
├── database/
│   ├── factories/           # Factories for unit testing
│   ├── migrations/          # Database schema migrations
│   └── seeders/             # Complete demo database seeders
├── docker-compose.yml       # Docker Compose setup for PHP app & MySQL database
├── Dockerfile               # Setup for PHP 8.2, pdo_mysql, & OPcache
├── public/
│   └── storage/             # Symlink to storage/app/public for photos & uploaded files
├── resources/views/         # Blade UI/UX templates
├── routes/
│   └── web.php              # Web routes & authorization middleware
└── tests/
    ├── Feature/             # Automated test cases (Happy Flow & Broken Flow)
    ├── HAPPY_FLOW_RESULTS.md # Happy Flow test documentation report
    └── BROKEN_FLOW_RESULTS.md# Broken Flow & Security test report
```

---

## 📄 License

This project is licensed under the [MIT License](LICENSE).
