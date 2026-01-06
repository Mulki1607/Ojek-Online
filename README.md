# 🚖 ILS OJOL – Aplikasi Ojek Online Berbasis Web

ILS OJOL (Intat Lon Siat Ojek Online) adalah aplikasi layanan transportasi dan pengiriman berbasis web yang dibangun menggunakan **Laravel** dan **Tailwind CSS**.  
Aplikasi ini dirancang sebagai simulasi sistem ojek online modern yang mencakup peran **User**, **Driver**, dan **Admin** dalam satu platform terintegrasi.

Project ini dikembangkan sebagai bagian dari pembelajaran dan pengembangan sistem informasi berbasis web, dengan pendekatan arsitektur yang terstruktur, modular, dan siap untuk dikembangkan lebih lanjut ke skala produksi.

---

## 🎯 Tujuan Project

- Membangun sistem ojek online berbasis web dengan alur nyata
- Menerapkan konsep **multi-authentication** (User, Driver, Admin)
- Mengimplementasikan **real-time location concept**, wallet system, dan order flow
- Mengembangkan UI modern, konsisten, dan responsif
- Menjadi fondasi untuk pengembangan aplikasi publik di masa depan

---

## 🧩 Fitur Utama

### 👤 User
- Registrasi & login user
- Melihat driver terdekat (berdasarkan lokasi)
- Membuat pesanan (ride, delivery, belanja)
- Melihat status pesanan secara real-time
- Memberikan rating & ulasan kepada driver
- Dompet (wallet):
  - Top up saldo
  - Riwayat transaksi

---

### 🏍️ Driver
- Registrasi & login driver
- Dashboard driver
- Online / Offline status
- Update lokasi otomatis (GPS browser)
- Manajemen data kendaraan (motor / mobil)
- Menerima & menyelesaikan pesanan
- Dompet driver:
  - Saldo otomatis dari pesanan
  - Penarikan saldo (withdraw)
  - Riwayat pendapatan

---

### 🛠️ Admin
- Login & register admin (layout khusus)
- Dashboard admin dengan statistik:
  - Total user, driver, dan pesanan
  - Status pesanan & driver (chart)
- Manajemen user
- Manajemen driver
  - Status online/offline
  - Data kendaraan driver
  - Riwayat pesanan driver
- Insight panel (top rating, driver paling aktif)

---

## 🧱 Teknologi yang Digunakan

- **Backend**: Laravel
- **Frontend**: Blade Template + Tailwind CSS
- **Database**: MySQL
- **Authentication**: Laravel Multi Auth (User, Driver, Admin)
- **Maps**:
  - Google Maps Embed
  - Leaflet + OpenStreetMap
- **Chart**: Chart.js
- **Version Control**: Git & GitHub

---

## 🗂️ Struktur Project (Ringkas)
app/ ├── Http/ │   ├── Controllers/ │   │   ├── User/ │   │   ├── Driver/ │   │   └── Admin/ ├── Models/ │   ├── User.php │   ├── Driver.php │   ├── Pesanan.php │   ├── Wallet.php │   ├── WalletTransaction.php │   └── Kendaraan.php
resources/ ├── views/ │   ├── layouts/ │   │   ├── main.blade.php │   │   ├── driver.blade.php │   │   ├── admin.blade.php │   │   └── guest.blade.php │   ├── user/ │   ├── driver/ │   └── admin/
routes/ ├── web.php

---

## 🔐 Keamanan & Best Practice

- `.env` tidak disertakan dalam repository
- Menggunakan mass assignment protection
- Validasi request di setiap proses penting
- Relasi database terdefinisi jelas (Eloquent ORM)
- Wallet transaction tercatat secara terpisah

---

📌 Status Project
🔧 Dalam Tahap Pengembangan Aktif
Fitur yang telah dibangun sudah mencakup alur inti aplikasi ojek online.
Namun project ini belum berhenti sampai di sini.

🌱 Rencana Pengembangan Selanjutnya
Beberapa pengembangan lanjutan yang direncanakan:
Integrasi real-time map tracking
Notifikasi real-time (WebSocket)
Sistem pembayaran otomatis (payment gateway)
Aplikasi mobile (Android / iOS)
Optimasi performa & keamanan
Deployment ke server publik

---

✨ Penutup
Project ILS OJOL tidak hanya dibuat sebagai tugas atau simulasi, tetapi sebagai fondasi sistem yang akan terus dikembangkan hingga menjadi aplikasi yang layak digunakan oleh khalayak ramai.
Pengembangan akan dilakukan secara bertahap, terstruktur, dan berorientasi pada kebutuhan pengguna serta standar aplikasi modern.

---

📌 Developed with purpose, not just for assignment — but for real-world readiness.
