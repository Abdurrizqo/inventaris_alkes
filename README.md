# INTANSIMANIS

**INTANSIMANIS** merupakan singkatan dari **Inventarisasi dan Mutasi**. Aplikasi ini dikembangkan untuk mengelola inventaris dan mutasi alat medis di rumah sakit. Dengan menggunakan aplikasi ini, rumah sakit dapat memonitor pergerakan alat medis, memastikan bahwa setiap alat tercatat dengan baik, serta memudahkan proses pelaporan dan audit.

## Fitur Utama

- **Manajemen Inventaris**: Tambah, edit, dan hapus data alat medis.
- **Pelacakan Mutasi**: Pantau pergerakan alat dari satu ruangan ke ruangan lain.
- **QR Code**: Generate QR code untuk setiap alat medis untuk memudahkan identifikasi.
- **Laporan**: Export data inventaris dan mutasi ke format Excel dan PDF.
- **Keamanan**: Menggunakan autentikasi dan otorisasi berbasis peran (role-based access control) untuk memastikan hanya pengguna yang berwenang yang dapat mengakses fitur tertentu.

## Spesifikasi Teknologi

- **Framework**: [Laravel](https://laravel.com) (versi terbaru)
- **Admin Panel**: [Filament](https://filamentphp.com) (versi terbaru)
- **Database**: MySQL / MariaDB
- **Bahasa Pemrograman**: PHP 8.x
- **Frontend**: Blade template, Livewire
- **QR Code Generator**: [Endroid QR Code](https://github.com/endroid/qr-code)

## Prasyarat

Pastikan Anda telah menginstal prasyarat berikut sebelum memulai instalasi:

- PHP >= 8.0
- Composer
- Node JS
- MySQL atau MariaDB
- Ekstensi PHP yang dibutuhkan:
  - `php_zip`
  - `php_xml`
  - `php_gd2`
  - `php_iconv`
  - `php_simplexml`
  - `php_xmlreader`
  - `php_zlib`

## Instalasi

Berikut adalah langkah-langkah untuk menginstal aplikasi **INTANSIMANIS** di lingkungan lokal Anda.

1. **Clone Repository**

   ```bash
   git clone https://github.com/Abdurrizqo/inventaris_alkes.git

2. **Instal Depedensi**

   ```bash
   composer install
   npm run install

3. **Setting ENV**
Ganti file .env.example menjadi .env dan sesuaikan variabel APP_URL dengan IP localhost projek serta atur variabel database.

4. **Generate Key Application**
    ```bash
    php artisan key:generate

5. **Migrasi dan Seed**
    ```bash
    php artisan migrate --seed
Atur default user pada file database/seeders/DatabaseSeeder.php

6. **Public Storage**

    ```bash
    php artisan storage:link

7. **Jalankan Aplikasi**

    ```bash
    php artisan serve

Gunakan route /admin untuk menampilkan halaman Admin.