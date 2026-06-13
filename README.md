# Mini-Dashboard

Mini Dashboard adalah aplikasi dashboard berbasis PHP dan MySQL yang digunakan untuk mengelola data melalui antarmuka web.

## Persyaratan

- PHP
- MySQL / MariaDB
- XAMPP atau Laragon
- phpMyAdmin

## Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/Adhistyas/Mini-Dashboard.git
```

### 2. Pindahkan Project ke Folder Web Server

Contoh pada XAMPP:

```text
htdocs/Mini-Dashboard
```

### 3. Import Database

1. Jalankan Apache dan MySQL.
2. Buka phpMyAdmin.
3. Pilih menu **Import**.
4. Import file berikut:

```text
sql/Db_Bagas Aditiya.sql
```

6. Tunggu hingga proses import selesai.

### 4. Konfigurasi Database

Pastikan konfigurasi koneksi database pada project sudah sesuai dengan database yang telah dibuat.

Contoh konfigurasi lokal:

```text
Host     : localhost / 127.0.0.1
Username : root
Password :
```

## Login

Gunakan akun berikut untuk masuk ke aplikasi:

| Username | Password |
| -------- | -------- |
| admin    | admin    |

## Menjalankan Aplikasi

Buka browser dan akses:

```text
http://localhost/Mini-Dashboard
```

## Author

**Bagas Aditiya**
