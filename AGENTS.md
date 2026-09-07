# Graduance Project Guidelines & Invariants

## 1. UI & Spacing Invariants (Critical)
- **Strict Spacing Rule**: Jangan pernah membiarkan elemen visual (avatar, ikon, badge, teks judul) menempel atau kekurangan margin/gap.
  - Avatar/ikon dan teks di sampingnya **wajib** memiliki jarak minimal `12px` hingga `16px` (jangan pernah membiarkan elemen berdampingan saling menyentuh).
  - Card internal padding minimal `20px` - `28px` untuk desktop, jangan membuat konten berdesakan ke tepi border.
- **Framework Utility Hygiene (Bootstrap 5)**:
  - Project ini menggunakan **Bootstrap 5**.
  - **DILARANG** menggunakan utility Tailwind decimal seperti `gap-2.5`, `p-2.5`, `me-1.5`, `mt-0.5`, `py-1.5`. Bootstrap 5 hanya mendukung integer `0` s/d `5`.
  - Gunakan kelas valid Bootstrap (`gap-2`, `gap-3`, `me-2`, `me-3`, `p-3`) atau inline CSS eksplisit (`style="gap: 16px;"`) jika membutuhkan ukuran presisi.

## 2. Anti-Slop & Visual Fatigue Standards (antislop-human)
- **Hindari "Cards Inside Cards" Slop**: Dilarang menumpuk banyak kotak kecil/chat bubble palsu di dalam kartu preview. Gunakan layout bersih dengan fokus tunggal yang jelas (misal: 1 status card + 1 progress bar yang mudah dipahami dalam 3 detik).
- **Text Density & Scannability**: Batasi teks deskripsi kemampuan menjadi 1 kalimat inti yang tegas dan bullet points yang konkret. Jangan menjejali card dengan paragraf panjang.
- **WCAG AAA Accessible Contrast**:
  - Warna coral brand utama `#eb5d1e` memiliki kontras rendah pada background putih (3.43:1).
  - Untuk teks body, subheader, icon, dan badge fungsional pada background putih, **wajib** menggunakan deep coral `#c2410c` (rasio kontras 5.18:1, lolos WCAG AA/AAA).
  - Teks deskripsi menggunakan neutral dark `#4b5563` atau `#374151`, bukan abu-abu pudar `#9ca3af`.

## 3. CSS Syntax Integrity
- Jangan menulis shorthand framework sebagai properti CSS vanilla di file `.css` (contoh: jangan menulis `flex-column;`, gunakan selalu `flex-direction: column;`).

## 4. Local Development Environment
- PHP 8.2 Portable CLI berlokasi di:
  `C:\Users\ibnuk\AppData\Local\Microsoft\WinGet\Packages\PHP.PHP.8.2_Microsoft.Winget.Source_8wekyb3d8bbwe\php.exe`
- Konfigurasi `php.ini` memerlukan path absolut untuk `extension_dir` agar ekstensi `pdo_mysql`, `curl`, `mbstring`, `openssl`, dan `fileinfo` berjalan semestinya.
