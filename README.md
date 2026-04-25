# InvSys - Inventory System 📦

InvSys adalah sistem manajemen inventaris berbasis web yang dirancang untuk efisiensi pengelolaan data barang. Aplikasi ini dibangun menggunakan framework Laravel dengan antarmuka modern menggunakan Tailwind CSS.

## Kebutuhan
Pastikan perangkat Anda sudah terinstall:

1. PHP >= 8.3
2. Composer
3. Node.js & npm
4. Database (MySQL / MariaDB)

## Panduan Instalasi
Ikuti langkah-langkah berikut untuk menjalankan proyek secara lokal:

1. Clone repository
git clone https://github.com/satriabrianydnt/project-ujk.git
cd project-ujk

2. Salin file environment
cp .env.example .env

3. Install dependency
composer install
npm install

4. Generate application key
php artisan key:generate

5. Konfigurasi database
Buka file .env
Sesuaikan konfigurasi berikut:
DB_DATABASE=nama_database
DB_USERNAME=username
DB_PASSWORD=password

6. Jalankan migrasi dan seeder
php artisan migrate --seed

7. Jalankan server
php artisan serve
npm run dev

8. Akses aplikasi
Buka browser dan kunjungi:
http://127.0.0.1:8000

## 🚀 Panduan Penggunaan

### Mengakses Dashboard
1. Login dengan Akun yang ada di dalam Seeder (default: admin@inventaris.com | admin123)
2. Klik Masuk ke Dashboard
3. Akses menu yang ada di Dashboard

### Menggunakan Menu Data Barang, Mengedit Data Barang, Menghapus Data Barang
1. Login ke dalam sistem, kemudian klik menu Data Barang di samping kiri
2. Jika belum ada data barang maka klik tombol Tambah Data Barang
3. Isi sesuai data-data yang dibutuhkan
4. Klik Simpan
5. Untuk Mengedit/Memperbarui Data Barang dan Menghapus Data barang ada di bagian Aksi pada halaman Data Barang

### Menggunakan Menu Kategori Barang
1. Login ke dalam sistem, kemudian klik menu Kategori Barang di samping kiri
2. Jika belum ada data kategori maka klik tombol Tambah Kategori Baru
3. Isi sesuai data-data yang dibutuhkan seperti Nama Kategori dan Deskripsinya
4. Klik Simpan
5. Untuk Mengedit/Memperbarui Data Barang dan Menghapus Data barang ada di bagian Aksi pada halaman Kategori barang

### Menggunakan Menu Barang Masuk & Barang Keluar
1. Login ke dalam sistem, kemudian klik menu Barang Masuk & Barang Keluar di samping kiri
2. Jika belum ada data barang masuk & keluar, maka dapat memilih tombol Tambah Barang Masuk / Tambah Barang Keluar
3. Kemudian, jika sudah disimpan maka akan muncul di tabel Riwayat Transaksi
4. Pengguna juga dapat mengexport data Barang Masuk & Keluar dengan cara mengklik tombol Export Excel jika ingin mengexport ke format Excel, dan Export PDF jika pengguna ingin mengexport ke format PDF

### 

### Mengakses Halaman Pengaturan
1.  Login ke dalam sistem.
2.  Klik menu **Pengaturan** pada Header icon Pengguna.
3.  Halaman akan menampilkan dua tab utama: **Keamanan** dan **Preferensi Sistem**.

### Cara Mengubah Password
1.  Pilih tab **Keamanan**.
2.  Masukkan password Anda yang aktif saat ini pada kolom **Password Saat Ini**.
3.  Masukkan password baru pada kolom **Password Baru**.
4.  Ulangi password baru pada kolom **Konfirmasi Password Baru**.
5.  Klik tombol **Update Password**.
6.  Jika berhasil, notifikasi sukses akan muncul.

### Cara Mengubah Nama Aplikasi
1.  Pilih tab **Preferensi Sistem**.
2.  Ubah teks pada kolom **Nama Aplikasi** (contoh: ubah menjadi "InvSys").
3.  Klik tombol **Simpan Konfigurasi**.
4.  Sistem akan otomatis memperbarui nama aplikasi
