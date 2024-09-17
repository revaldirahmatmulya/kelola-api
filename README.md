## Proyek API Laravel
Panduan ini akan membantu Anda dalam menginstal dan menjalankan proyek API Laravel ini di perangkat Anda, serta mengaksesnya menggunakan Ngrok.

Clone Repository
Clone repositori ini ke perangkat Anda menggunakan Git: 
```bash
git clone https://github.com/username/repository-name.git
```

Pindah ke direktori proyek: 

```bash
cd repository-name
```

## Instalasi Dependensi
Instal dependensi proyek menggunakan Composer: composer install

Konfigurasi Lingkungan
Salin file konfigurasi .env.example ke .env: 

```bash
cp .env.example .env
```

Atur konfigurasi di file .env sesuai kebutuhan (misalnya, database, aplikasi key).

Generate Key Aplikasi
Generate key aplikasi Laravel: 

```bash
php artisan key:generate
```

Migrasi Database
Jalankan migrasi database untuk menyiapkan skema: 

```bash
php artisan migrate
```
Seed Database
Jika proyek ini memiliki seeder untuk mengisi data awal, jalankan seeder: 
```bash
php artisan db:seed
```
Menjalankan Proyek
Jalankan server pengembangan lokal: 
```
php artisan serve
```
Secara default, server akan berjalan di http://localhost:8000.

## Mengakses Proyek Menggunakan Ngrok
Install Ngrok

Jika Ngrok belum terpasang, unduh dan instal Ngrok dari situs Ngrok sesuai dengan sistem operasi Anda.

Jalankan Ngrok

Jalankan Ngrok untuk meneruskan trafik dari port lokal (misalnya port 8000): 
```
ngrok http 8000
```
Ngrok akan memberikan URL publik yang dapat digunakan untuk mengakses API Anda dari luar jaringan lokal.

## Akses API

Gunakan URL publik yang diberikan oleh Ngrok untuk mengakses API Anda. Misalnya, jika Ngrok memberikan URL https://abcdefg12345.ngrok.io, Anda dapat mengakses API Anda di https://abcdefg12345.ngrok.io. 

Copy URL API yang sudah diberikan Ngrok lalu Paste URL tersebut pada file Api.js pada folder utils di project React (React-kelola)

Catatan Tambahan
Pastikan bahwa konfigurasi database dan variabel lingkungan di .env sudah benar.
Jika Anda menggunakan database yang memerlukan setup khusus (seperti SQLite, MySQL, dll.), pastikan bahwa konfigurasi tersebut sesuai dan database sudah siap.
Periksa log aplikasi jika terjadi masalah dengan menjalankan perintah: tail -f storage/logs/laravel.log
