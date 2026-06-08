# 🏫 Binus Space — Sistem Peminjaman Ruangan Kampus

> Platform booking ruangan kelas dan laboratorium kampus secara online untuk mahasiswa dan dosen Binus University.

![Status](https://img.shields.io/badge/status-active-success)
![Backend](https://img.shields.io/badge/backend-Laravel%2011-red)
![Frontend](https://img.shields.io/badge/frontend-React-blue)
![Database](https://img.shields.io/badge/database-MySQL-orange)

---

## 📋 Deskripsi

**Binus Space** adalah aplikasi web yang memudahkan mahasiswa dan dosen untuk meminjam ruangan kelas atau laboratorium kampus secara mandiri dan online. Sebelumnya, proses peminjaman ruangan dilakukan secara manual yang memakan waktu dan rawan terjadi bentrok jadwal. Aplikasi ini menyederhanakan proses tersebut menjadi beberapa langkah digital yang cepat dan transparan.

### Masalah yang Diselesaikan
- Proses peminjaman ruangan manual yang lambat dan tidak efisien
- Sulitnya mengecek ketersediaan ruangan secara real-time
- Tidak ada sistem persetujuan yang terpusat dan transparan
- Rawan terjadi double-booking pada satu ruangan

### Solusi
Sistem booking online dengan alur pengajuan yang jelas, dilengkapi panel admin untuk menyetujui atau menolak permohonan, sehingga peminjaman ruangan menjadi terorganisir dan dapat dilacak.

---

## ✨ Fitur Utama

| Fitur | Deskripsi |
|-------|-----------|
| 🔍 **Cek Ketersediaan** | Lihat daftar ruangan dengan pencarian dan filter berdasarkan kategori (Kelas/Lab) |
| 📅 **Booking Jadwal** | Ajukan peminjaman ruangan dengan memilih tanggal, waktu, dan mengisi data pemohon |
| ✅ **Approval System** | Admin dapat menyetujui atau menolak permohonan melalui dashboard khusus |
| 🔐 **Login Admin** | Akses panel admin yang terproteksi untuk mengelola persetujuan |

---

## 🛠️ Teknologi yang Digunakan

### Frontend
- **React** — library JavaScript untuk membangun antarmuka
- **Tailwind CSS** — styling utility-first
- **Axios** — HTTP client untuk komunikasi dengan API
- **Lucide React** — ikon

### Backend
- **Laravel 11** — framework PHP untuk REST API
- **Eloquent ORM** — manajemen database
- **MySQL** — basis data relasional

### Tools
- **Git & GitHub** — version control
- **Composer** — package manager PHP
- **NPM** — package manager JavaScript

---

## 📦 Struktur Repository

Proyek ini dibagi menjadi dua repository terpisah (prinsip *separation of concerns*):

- **binus-space-frontend** — antarmuka pengguna (React)
- **binus-space-backend** — REST API dan logika bisnis (Laravel)

---

## 🚀 Cara Instalasi

### Prasyarat
Pastikan sudah terinstall:
- PHP 8.2+ dan Composer
- Node.js dan NPM
- MySQL (via XAMPP/Laragon)

### 1. Setup Backend (Laravel)

```bash
# Clone repository backend
git clone https://github.com/rifkyrp64-debug/binus-space-backend.git
cd binus-space-backend

# Install dependencies
composer install

# Salin file environment
cp .env.example .env

# Generate application key
php artisan key:generate
```

Edit file `.env`, sesuaikan konfigurasi database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=binus_space
DB_USERNAME=root
DB_PASSWORD=

ADMIN_EMAIL=admin@binus.ac.id
ADMIN_PASSWORD=admin123
```

Buat database `binus_space` di phpMyAdmin, lalu jalankan migration dan seeder:
```bash
php artisan migrate --seed
php artisan serve
```

Backend akan berjalan di `http://localhost:8000`

### 2. Setup Frontend (React)

```bash
# Clone repository frontend
git clone https://github.com/rifkyrp64-debug/binus-space-frontend.git
cd binus-space-frontend

# Install dependencies
npm install

# Jalankan development server
npm run dev
```

Frontend akan berjalan di `http://localhost:5173` (atau port yang ditampilkan)

---

## 📖 Cara Penggunaan

### Untuk Pengguna (Mahasiswa/Dosen)

1. **Buka halaman utama** — lihat informasi platform dan fitur yang tersedia
2. **Klik "Booking Ruangan"** — masuk ke daftar ruangan
3. **Cari & filter ruangan** — gunakan kolom pencarian atau filter kategori (Semua/Kelas/Lab)
4. **Klik "Booking Sekarang"** pada ruangan yang diinginkan
5. **Isi formulir booking** dalam 3 langkah:
   - Langkah 1: Pilih tanggal dan waktu mulai
   - Langkah 2: Isi nama, NIM/NIP, email, telepon, dan tujuan peminjaman
   - Langkah 3: Konfirmasi data dan ajukan
6. **Tunggu persetujuan** dari admin

### Untuk Admin

1. **Klik menu "Admin"** di navigasi
2. **Login** menggunakan email dan password admin
3. **Kelola permohonan** — lihat semua booking yang masuk
4. **Filter berdasarkan status** — Semua/Menunggu/Disetujui/Ditolak
5. **Setujui atau tolak** setiap permohonan yang berstatus "Menunggu"

> **Kredensial Admin (default):**
> Email: `admin@binus.ac.id`
> Password: `admin123`

---

## 🔌 Dokumentasi API

| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| `GET` | `/api/ruangan` | Mengambil daftar semua ruangan |
| `GET` | `/api/ruangan/{nama}/booked` | Mengambil jadwal yang sudah disetujui untuk ruangan tertentu |
| `POST` | `/api/booking` | Membuat permohonan booking baru |
| `POST` | `/api/login` | Autentikasi admin |
| `GET` | `/api/admin/bookings` | Mengambil semua data booking (admin) |
| `PUT` | `/api/admin/bookings/{id}/status` | Memperbarui status booking (approved/rejected) |

### Contoh Request Booking
```json
POST /api/booking
{
  "nama": "Ahmad Fauzi",
  "nim": "2301234567",
  "email": "ahmad@binus.ac.id",
  "telepon": "081234567890",
  "fasilitas_id": "Ruang Kelas 301",
  "tanggal": "2026-06-20",
  "waktu_mulai": "09:00",
  "durasi": 2,
  "tujuan": "Presentasi Proyek Akhir"
}
```

---

## 🧪 Testing

Backend dilengkapi unit test menggunakan PHPUnit untuk memastikan reliabilitas API:

```bash
php artisan test
```

Test mencakup: pengambilan data ruangan, pembuatan booking, validasi input, persetujuan admin, dan autentikasi login.

---

## 🗄️ Struktur Database

### Tabel `ruangan`
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint | Primary key |
| nama | string | Nama ruangan |
| kapasitas | integer | Kapasitas orang |
| gedung | string | Gedung |
| lantai | integer | Lantai |

### Tabel `bookings`
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint | Primary key |
| nama | string | Nama pemohon |
| nim | string | NIM/NIP pemohon |
| email | string | Email pemohon |
| telepon | string | Nomor telepon |
| fasilitas_id | string | Nama ruangan yang dipinjam |
| tanggal | date | Tanggal peminjaman |
| waktu_mulai | string | Waktu mulai (format 24 jam) |
| durasi | integer | Durasi dalam jam |
| tujuan | text | Tujuan peminjaman |
| status | enum | pending / approved / rejected |

---

## 🔮 Pengembangan Selanjutnya (Future Work)

- Notifikasi email otomatis ke pemohon saat status berubah (integrasi Laravel Mail + SMTP)
- Fitur upload dokumen pendukung (surat izin)
- Riwayat booking per pengguna
- Autentikasi pengguna (bukan hanya admin)
- Validasi otomatis untuk mencegah double-booking pada slot yang sama

---

## 👥 Tim Pengembang

| Nama | NIM | Peran |
|------|-----|-------|
| _(Muhamad Rifki Perkasa)_ | _(2802479413)_ | _(UI/UX)_ |
| _(Nama Anggota 2)_ | _(NIM)_ | _(Peran)_ |
| _(Nama Anggota 3)_ | _(NIM)_ | _(Peran)_ |

---

## 📄 Lisensi

Proyek ini dibuat untuk memenuhi tugas mata kuliah **COMP6100001 - Software Engineering**, Binus University.

---

_Dikembangkan dengan ❤️ oleh Tim Binus Space — 2026_
