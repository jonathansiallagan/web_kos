# Website Kos Laravel

Proyek kolaborasi Laravel untuk sistem kos — dengan dua role:

-   Admin: Mengelola data kos
-   User: Melihat & memesan kamar kos

 # Website Manajemen Kos (Website-Kos-Laravel)

Sebuah aplikasi web yang dibangun menggunakan framework Laravel untuk membantu pemilik kos mengelola kamar, penghuni, keuangan, dan laporan operasional harian. Proyek ini menggunakan template [Soft UI Dashboard](https://www.creative-tim.com/product/soft-ui-dashboard) yang diintegrasikan secara kustom.

Proyek ini sedang dalam pengembangan aktif di branch `dev-UA`.

---

## 🚀 Fitur Utama

Aplikasi ini dibagi menjadi two peran utama: **Admin (Pemilik Kos)** dan **User (Penghuni)**.

### 👑 Fitur Sisi Admin (Pemilik Kos)

Dashboard admin yang komprehensif untuk mengelola semua aspek bisnis kos:

* **🏠 Manajemen Kamar:** Admin dapat Menambah, Melihat, Mengedit, dan Menghapus (CRUD) data kamar, termasuk detail harga, tipe, fasilitas, dan foto.
* **🙋 Manajemen Penghuni:**
    * Melihat daftar kamar yang terisi dan penghuninya.
    * Menambahkan penghuni ke kamar kosong secara manual.
    * Mengeluarkan penghuni dari kamar (mengubah status kamar menjadi "Tersedia").
* **✅ Persetujuan Pemesanan (Approval):**
    * Melihat daftar pemesanan kamar yang masuk dari *dashboard* pengguna.
    * Menyetujui (approve) atau Menolak (reject) pemesanan.
    * Saat disetujui, penghuni otomatis masuk ke "Data Penghuni Aktif".
* **💰 Manajemen Keuangan:**
    * Dashboard ringkasan Pemasukan, Pengeluaran, dan Keuntungan Bersih bulan ini.
    * Form untuk mencatat semua pengeluaran operasional (listrik, air, internet, dll).
    * Melihat riwayat pemasukan dan pengeluaran terbaru.
* **🧾 Manajemen Tagihan:**
    * Tombol untuk **membuat tagihan** secara otomatis untuk semua penghuni di awal bulan.
    * Tombol aman untuk "Periksa & Buat Tagihan Baru" (untuk penghuni yang baru masuk di tengah bulan).
    * Mengonfirmasi pembayaran dengan tombol "Tandai Lunas".
* **🛠️ Laporan Kerusakan:**
    * Melihat daftar laporan kerusakan yang dikirim oleh penghuni.
    * Mengubah status laporan ("Baru", "Dikerjakan", "Selesai").
* **👥 Manajemen Akun:**
    * Melihat semua akun (admin dan user) yang terdaftar di sistem.
    * Mengedit role (admin/user) dan data akun.
    * Menghapus akun.
* **🔔 Sistem Notifikasi Terpusat:**
    * Menerima notifikasi real-time (via database) setiap kali ada User yang memesan kamar baru.
    * **Deep Linking:** Mengklik notifikasi akan langsung mengarahkan Admin ke halaman detail pemesanan yang spesifik untuk melakukan persetujuan.
    * Fitur "Tandai Semua Dibaca" dan indikator badge merah pada navbar.
* **👤 Profil Admin:** Admin dapat mengedit informasi profilnya sendiri.

### 👤 Fitur Sisi Pengguna (Penghuni)

Dashboard personal untuk setiap penghuni kos:

* **🖥️ Dashboard Pengguna:**
    * Menampilkan pesan selamat datang yang dipersonalisasi.
    * Menampilkan detail kamar yang sedang mereka tempati.
    * Menampilkan status tagihan bulan ini ("Lunas" / "Belum Bayar").
* **🛌 Pemesanan Kamar (Untuk User Baru):**
    * Jika user belum punya kamar, dashboard akan otomatis menampilkan daftar kamar yang "Tersedia".
    * User dapat mengklik "Pesan Sekarang" untuk mengajukan pemesanan ke admin.
    * Jika pesanan sedang ditinjau, dashboard akan menampilkan status "Menunggu Persetujuan".
* **📜 Riwayat Tagihan:**
    * Halaman khusus untuk melihat semua riwayat tagihan (lunas/belum bayar) dari bulan-bulan sebelumnya.
* **🔧 Lapor Kerusakan:**
    * Form khusus bagi penghuni untuk mengirim laporan kerusakan (kamar atau umum) langsung ke admin.
* **🔔 Sistem Notifikasi Terpusat:**
    * Menerima notifikasi instan saat pemesanan kamar Disetujui atau Ditolak oleh admin.
    * Jika **Disetujui**: Notifikasi mengarahkan langsung ke halaman "Riwayat Tagihan" untuk melihat tagihan pertama.
    * Jika **Ditolak**: Notifikasi memberitahu alasan dan mengarahkan kembali ke halaman utama untuk mencari kamar lain.
    * Tampilan halaman notifikasi yang bersih dan terpisah dari notifikasi admin.
* **👤 Profil Pengguna:** Penghuni dapat mengedit informasi profilnya sendiri.

---

## 🛠️ Setup & Instalasi

Proyek ini dibangun di atas **Laravel 12**.

1.  **Clone repository:**
    ```bash
    git clone [URL-REPOSITORY-KAMU]
    cd website-kos-laravel
    ```

2.  **Install dependensi:**
    ```bash
    composer install
    ```

3.  **Setup Environment:**
    * Salin file `.env.example` menjadi `.env`.
        ```bash
        cp .env.example .env
        ```
    * Buat kunci aplikasi:
        ```bash
        php artisan key:generate
        ```
    * Atur koneksi database (DB_DATABASE, DB_USERNAME, DB_PASSWORD) di file `.env`.

4.  **Migrasi Database:**
    Jalankan migrasi untuk membuat semua tabel (`users`, `kamars`, `pembayarans`, `pengeluarans`, `laporans`, `pemesanans`, dll.).
    ```bash
    php artisan migrate
    ```

5.  **(Opsional) Seeding Data:**
    Jika kamu punya *Seeder* untuk data awal (misal, akun admin):
    ```bash
    php artisan db:seed
    ```

6.  **Jalankan Server:**
    ```bash
    php artisan serve
    ```
    Aplikasi akan berjalan di `http://127.0.0.1:8000`.

---

## 📧 Catatan Fitur: Reset Password (Lokal)

Fitur ini menggunakan driver `log` untuk pengujian lokal (tanpa kirim email asli).
Agar fitur ini berjalan di laptop kalian, lakukan konfigurasi berikut:

1.  Buka file `.env`
2.  Ubah bagian `MAIL_MAILER` menjadi:
    ```env
    MAIL_MAILER=log
    ```
3.  Untuk melihat Link Reset Password yang dikirim sistem, cek file:
    `storage/logs/laravel.log`

---

## 🌲 Status Branch

* **`main`**: (Atau `master`) Branch produksi utama.
* **`dev-UA`**: Branch pengembangan aktif. Berisi semua fitur admin dan pengguna.
---

## 🌲 Status Branch

* **`main`**: (Atau `master`) Branch produksi utama.
* **`dev-UA`**: Branch pengembangan untuk implementasi fitur-fitur admin (Manajemen Penghuni, Keuangan, Laporan, dan Akun). Semua fitur baru yang tercantum di atas ada di *branch* ini.

Dokumentasi Proyek: Integrasi UI dan Pengembangan Fitur
Ini adalah catatan dari semua perubahan besar yang dibuat pada proyek website-kos-laravel untuk mengintegrasikan template Soft UI Dashboard dan membangun fitur-fitur admin kustom.

---
**Tahap 1: Integrasi Template ("Rombak Total") :**
Tujuan awal adalah mengganti UI lama dengan template Soft UI Dashboard. Setelah menghadapi berbagai kendala saat integrasi manual, kita memutuskan untuk mengambil pendekatan "rombak total":

Hapus Aset Lama: Menghapus semua file di dalam resources/views/ dan public/ (kecuali file-file inti Laravel seperti index.php).

Salin Aset Baru: Menyalin semua file dan folder dari folder resources/views/ dan public/ milik template Soft UI Dashboard ke dalam proyek kita.

Salin Komponen: Menyalin folder app/View/Components/ dari template ke proyek kita untuk memastikan komponen Blade (<x-...>) berfungsi.

---
**Tahap 2: Penyesuaian Backend (Menghubungkan Mesin ke Tampilan Baru) :**
Setelah tampilan baru terpasang, kita harus menyambungkan ulang semua Controller dan Route agar berfungsi dengan file View yang baru.

Routes (routes/web.php):

Menghapus Prefix Nama: Menghapus ->name('admin.') dan ->name('user.') dari grup route untuk menyederhanakan pemanggilan.

Mengganti Nama Route: Mengubah nama route agar cocok dengan link di sidebar template. Contoh:

Route admin.dashboard diubah menjadi name('dashboard').

Route admin.kamar.index diubah menjadi name('tables').

Route profile.edit (untuk user) diubah menjadi name('profile').

Controllers (Semua File):

Memperbaiki Base Controller: File app/Http/Controllers/Controller.php yang inti (induk) tidak sengaja terhapus. Kita membuatnya kembali agar extends Controller berfungsi.

Mengubah return view(): Mengedit semua controller (KamarController, DashboardController, AuthenticatedSessionController, ProfileController) untuk menunjuk ke file Blade template yang baru.

Contoh: return view('admin.kamar.index') diubah menjadi return view('pages.tables').

Contoh: return view('auth.login') diubah menjadi return view('pages.static-sign-in').

Mengubah redirect(): Memperbarui semua return redirect()->route(...) agar menggunakan nama route baru (misalnya, route('tables')).

---
**Tahap 3: Perbaikan Bug Kritis & Penyesuaian Layout :**
Selama proses integrasi, kita memperbaiki beberapa bug:

Masalah CSS/JS: Memperbaiki semua path aset di file layout (app.blade.php, guest.blade.php) agar menggunakan helper asset() dan menunjuk ke lokasi yang benar (/css/, /js/, /assets/).

Font Awesome 403 (Forbidden): Link Font Awesome bawaan template terkunci. Kita menggantinya dengan link CDN gratis di semua file layout.

Halaman Blank (419 & Logic): Memperbaiki halaman login yang blank dengan:

Memperbaiki logika di layouts/user_type/auth.blade.php agar menggunakan routeIs('login') (bukan Request::is('...')).

Memastikan halaman static-sign-in menggunakan layout tamu (layouts.user_type.guest).

Memastikan form login memiliki token @csrf untuk memperbaiki error 419 PAGE EXPIRED.

Sidebar Terpotong: Memperbaiki sidebar yang tidak bisa di-scroll penuh dengan menghapus blok <div class="sidenav-footer ..."> (kartu "Need help?") dari file layouts/navbars/auth/sidebar.blade.php.

Forgot Password (Frontend):
1.  Menambahkan link "Forgot Password" di `static-sign-in.blade.php`.
2.  Mengubah logika *styling* `Remember me` dan `Forgot Password` menggunakan **Flexbox** (`d-flex justify-content-between`) agar sejajar dan rapi.
    
Forgot Password (Backend):
1.  Mengarahkan Controller ke View bawaan template (`session.reset-password.sendEmail`) untuk memperbaiki `View not found`.
2.  Memperbaiki form di `resetPassword.blade.php` agar menggunakan `route('password.update')` (bukan URL manual) untuk memperbaiki error **419 Page Expired**.
  
Logout (405): Mengubah link Logout (Navbar & Sidebar) menjadi **Form POST** untuk memperbaiki error **Method Not Allowed**.

---
**Tahap 4: Implementasi Fitur Admin Kustom (Mengganti Contoh) :**
Kita mengganti semua halaman "contoh" dari template dengan fitur-fitur fungsional:

Data Kamar (KamarController)

Menghubungkan KamarController ke pages/tables.blade.php.

Mengganti isi tables.blade.php dengan @foreach untuk menampilkan data $kamars dari database, lengkap dengan tombol "Tambah", "Edit", dan "Hapus".

Menghubungkan pages/kamar-create.blade.php dan menambahkan JS untuk preview gambar.

Data Penghuni (PenghuniController)

Mengganti: Link "Billing" di sidebar.

Database: Membuat migrasi create_pembayarans_table dan create_kamars_table (serta memperbarui kamars dengan user_id).

Model: Membuat Pembayaran.php dan memperbarui Kamar.php & User.php dengan relasi (belongsTo, hasOne).

Fitur: Membuat PenghuniController (untuk index, create, store, destroy) dan view (pages/penghuni-index.blade.php, pages/penghuni-create.blade.php) untuk menetapkan user ke kamar yang tersedia.

Keuangan (KeuanganController)

Mengganti: Link "Virtual Reality" di sidebar.

Database: Membuat migrasi dan model Pengeluaran.php.

Fitur: Membuat KeuanganController untuk menampilkan dashboard keuangan (Total Pemasukan, Pengeluaran, Untung Bersih).

View: Menggunakan pages/billing.blade.php sebagai template, kita mengubahnya menjadi pages/keuangan.blade.php yang berisi 3 bagian: Kartu Laporan, Form Catat Pengeluaran, dan Riwayat Transaksi.

Laporan Kerusakan (LaporanController)

Mengganti: Link "RTL" di sidebar.

Database: Membuat migrasi dan model Laporan.php (dengan relasi ke user dan kamar).

Fitur: Membuat LaporanController (CRUD lengkap) untuk mengelola laporan (Baru, Dikerjakan, Selesai).

View: Membuat pages/laporan-index.blade.php (daftar laporan) dan pages/laporan-create.blade.php (form laporan baru).

Manajemen Akun (UserController)

Mengganti: Link "Laravel Examples" ("User Management" & "User Profile").

Fitur: Membuat UserController (CRUD lengkap) untuk mengelola semua akun di tabel users.

View: Mengadaptasi file laravel-examples/user-management.blade.php dan laravel-examples/user-profile.blade.php agar menjadi dinamis dan terhubung ke UserController.

Profil Admin (ProfileController)

Memperbaiki: Link "Profile" di "Account Pages".

Fitur: Memperbaiki ProfileController dan pages/profile.blade.php agar admin yang sedang login dapat mengedit profilnya sendiri.

---
**Tahap 5: Sistem Notifikasi & Refactoring UI (Pemisahan Role) :**
Fokus tahap ini adalah meningkatkan interaksi antar pengguna dan memisahkan logika tampilan antara Admin dan User agar lebih aman dan rapi.

Sistem Notifikasi (Database Driver):

Database: Membuat tabel notifications bawaan Laravel.

Backend Class: Membuat 3 Class Notifikasi:

PemesananBaru: Dikirim ke Admin saat user memesan kamar.

PemesananDisetujui: Dikirim ke User saat admin menerima pesanan (disertai link ke Tagihan).

PemesananDitolak: Dikirim ke User saat admin menolak pesanan.

Logic Controller:

Memperbarui PemesananController & PenghuniController untuk memicu pengiriman notifikasi ($user->notify(...)).

Refactoring NotificationController untuk memisahkan tampilan adminIndex dan userIndex.

Refactoring UI & Sidebar (Pemisahan Tanggung Jawab):

Sidebar Terpisah: Memecah file sidebar tunggal menjadi dua file terpisah:

sidebar-admin.blade.php: Khusus menu pengelolaan kos.

sidebar-user.blade.php: Khusus menu penyewa (Tagihan, Lapor Kerusakan).

Layout Dinamis: Memperbarui logika di auth.blade.php (Layout Utama) untuk memanggil file sidebar yang sesuai berdasarkan auth()->user()->role.

Navbar & AJAX: Menambahkan indikator "Titik Merah" (Badge) di lonceng navbar dan script AJAX untuk menyembunyikan badge saat diklik tanpa reload halaman.

Database Safety: Menghapus Unique Constraint pada tabel pemesanan dan memindahkan validasi anti-spam ke Controller, memungkinkan admin menyimpan riwayat penolakan tanpa error database.
