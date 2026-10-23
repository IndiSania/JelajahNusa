# JelajahNusa — Panduan Digital Wisata Indonesia

JelajahNusa adalah proyek website wisata Indonesia berbasis PHP Native dan MySQL. Proyek ini dirancang sebagai fondasi portofolio PPLG: memiliki katalog destinasi, pencarian dan filter, halaman detail, halaman budaya, formulir saran, serta panel admin untuk mengelola destinasi.

## Fitur
- Landing page responsif dengan desain editorial bernuansa hijau, krem, dan terracotta.
- Katalog destinasi dengan pencarian, filter wilayah, dan kategori.
- Detail destinasi, tips berkunjung, serta tautan peta.
- Halaman budaya Nusantara.
- Formulir saran yang tersimpan ke database.
- Login admin, dashboard, tambah/edit/hapus destinasi, dan daftar pesan.
- Query PDO prepared statements, escaping output, session cookie flags, dan token CSRF pada formulir yang mengubah data.
- SQL seed berisi contoh destinasi. Informasi dan gambar contoh perlu diverifikasi sebelum dipakai sebagai panduan perjalanan nyata.

## Teknologi
- PHP 8+
- MySQL / MariaDB
- HTML5, CSS3, JavaScript
- PDO untuk akses database
- Google Fonts dan gambar Unsplash melalui internet

## Cara menjalankan di XAMPP
1. Ekstrak folder `JelajahNusa` ke `C:\xampp\htdocs\JelajahNusa`.
2. Jalankan Apache dan MySQL dari XAMPP Control Panel.
3. Buka `http://localhost/phpmyadmin`.
4. Pilih menu **Import**, pilih file `database/jelajahnusa.sql`, lalu jalankan import. SQL akan membuat database `jelajahnusa` beserta tabel dan data contoh.
5. Periksa `includes/config.php`. Pengaturan default cocok untuk instalasi XAMPP umum: host `localhost`, database `jelajahnusa`, user `root`, password kosong. Sesuaikan jika konfigurasi MySQL kamu berbeda.
6. Buka `http://localhost/JelajahNusa`.

## Login admin demo
- URL: `http://localhost/JelajahNusa/admin/login.php`
- Username: `admin`
- Password awal: `password`

PENTING: segera ubah password demo sebelum dipasang online. Untuk mengganti hash, jalankan `php -r "echo password_hash('PASSWORD_BARU', PASSWORD_DEFAULT), PHP_EOL;"` di terminal PHP, lalu update kolom `admins.password_hash` untuk user `admin`. Jangan gunakan akun demo untuk produksi.

## Struktur folder
```text
JelajahNusa/
├── admin/
│   ├── destination-delete.php
│   ├── destination-form.php
│   ├── index.php
│   ├── login.php
│   ├── logout.php
│   └── messages.php
├── assets/
│   ├── css/style.css
│   └── js/main.js
├── database/jelajahnusa.sql
├── includes/
│   ├── config.php
│   ├── footer.php
│   ├── functions.php
│   └── header.php
├── budaya.php
├── kontak.php
├── destinasi.php
├── detail.php
└── index.php
```

## Catatan pengembangan
- Gambar menggunakan URL Unsplash dan membutuhkan koneksi internet; ganti URL di database bila ingin memakai foto sendiri yang sudah memiliki izin penggunaan.
- Data destinasi adalah contoh awal, bukan jaminan jam buka, harga tiket, kondisi cuaca, atau status keselamatan terbaru. Periksa sumber resmi sebelum bepergian.
- Untuk produksi, gunakan HTTPS, password unik yang kuat, pembatasan percobaan login, pengelolaan rahasia konfigurasi di luar web root, backup database, dan tinjauan keamanan tambahan.
- File ini merupakan starter project pendidikan. Uji ulang semua alur sebelum digunakan secara publik.
