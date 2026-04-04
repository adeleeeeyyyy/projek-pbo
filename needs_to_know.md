# Dokumen "Needs to Know": Platform E-Commerce Kecantikan

Dokumen ini berisi konsep, tema, keunggulan, serta penjelasan teknis mendalam mengenai sistem E-Commerce Kecantikan yang dirancang untuk Ujian Keahlian Kompetensi (UKK).

## 1. Konsep Proyek
Proyek ini adalah sebuah **Platform E-Commerce Kecantikan Berbasis Web**. Sistem ini dirancang untuk menyediakan pengalaman belanja online yang lengkap, mulai dari penemuan produk hingga proses pembayaran (checkout). Platform ini memfasilitasi dua peran utama: **Pelanggan** (untuk berbelanja) dan **Administrator** (untuk mengelola operasional toko).

## 2. Tema: "Radiance & Elegance"
- **Identitas Visual**: Bersih, minimalis, dan premium. Menggunakan palet warna yang menenangkan (slate & blue) untuk menonjolkan produk kecantikan.
- **Tujuan**: Menonjolkan keindahan alami dan memberikan kemudahan akses bagi pengguna untuk mendapatkan produk perawatan kulit dan kosmetik berkualitas.
- **Audiens**: Individu yang mencari produk kecantikan premium dengan antarmuka belanja yang modern dan mudah digunakan.

## 3. Keunggulan Sistem
- **Antarmuka Responsif**: Dibangun dengan Tailwind CSS, memastikan tampilan tetap optimal di berbagai perangkat (desktop, tablet, smartphone).
- **Manajemen Produk Terpusat**: Dashboard Admin yang intuitif untuk mengelola stok, kategori, dan detail produk secara real-time.
- **Alur Transaksi Aman**: Proses checkout yang terstruktur dengan validasi data yang ketat untuk mencegah kesalahan pesanan.
- **Performa Tinggi**: Menggunakan framework Laravel yang menjamin kecepatan, keamanan, dan kemudahan dalam pengembangan lebih lanjut.

## 4. Pengetahuan Teknis (Technical Insights)

### A. Arsitektur Sistem (MVC)
Aplikasi ini mengikuti pola arsitektur **Model-View-Controller (MVC)**:
- **Model**: Mengelola data dan logika bisnis (contoh: `Product.php`, `Order.php`). Menggunakan **Eloquent ORM** untuk interaksi database yang aman dan efisien.
- **View**: Antarmuka pengguna yang dinamis menggunakan **Blade Template Engine** dan dipadu dengan **Tailwind CSS** untuk *styling*.
- **Controller**: Menangani permintaan dari pengguna, memproses data melalui Model, dan mengirimkannya kembali ke View (contoh: `AdminController.php`, `OrderController.php`).

### B. Struktur Data & Skema Database
Sistem menggunakan database relasional (MySQL/MariaDB) dengan struktur tabel sebagai berikut:

#### 1. Tabel `users`
Menyimpan data otentikasi dan identitas pengguna.
- `id`: BigInt (Primary Key)
- `name`: String (Nama lengkap)
- `email`: String (Unique, untuk login)
- `password`: String (Hashed)
- `role`: Enum/String ('admin', 'customer')
- `timestamps`: `created_at` & `updated_at`

#### 2. Tabel `products`
Menyimpan katalog produk kecantikan.
- `id`: BigInt (Primary Key)
- `name`: String (Nama produk)
- `description`: Text (Deskripsi detail)
- `price`: Decimal (10,2) (Harga produk)
- `stock`: Integer (Jumlah stok tersedia)
- `category`: String (Kategori: Skincare, Makeup, dll)
- `image_url`: String (Link gambar produk)

#### 3. Tabel `carts`
Menyimpan keranjang belanja sementara.
- `id`: BigInt (Primary Key)
- `user_id`: Foreign Key (ke tabel `users`)
- `product_id`: Foreign Key (ke tabel `products`)
- `quantity`: Integer (Jumlah barang)

#### 4. Tabel `orders`
Menyimpan informasi utama transaksi.
- `id`: BigInt (Primary Key)
- `user_id`: Foreign Key (ke tabel `users`)
- `total_price`: Decimal (15,2) (Total bayar)
- `status`: String (Status: pending, processing, completed, cancelled)
- `shipping_address`: Text (Alamat pengiriman)

#### 5. Tabel `order_items`
Rincian produk dalam setiap pesanan (Order Detail).
- `id`: BigInt (Primary Key)
- `order_id`: Foreign Key (ke tabel `orders`)
- `product_id`: Foreign Key (ke tabel `products`)
- `quantity`: Integer
- `price`: Decimal (10,2) (Harga saat pembelian/snapshot)

### C. Alur Kerja & Logika Sistem
1.  **Middleware & Keamanan**:
    -   `auth`: Memastikan user sudah login sebelum mengakses `/cart`, `/checkout`, dan `/orders`.
    -   **Role-Based Check**: Di dalam `AdminController`, terdapat fungsi `ensureAdmin()` yang memverifikasi apakah `Auth::user()->role === 'admin'`. Jika tidak, sistem akan mengembalikan error 403 (Unauthorized).
2.  **Validasi Data**:
    -   Menggunakan Laravel Request Validation. Contoh: Produk harus memiliki nama, harga numerik, dan stok integer. Gambar divalidasi ukuran (max 2MB) dan tipe filenya.
3.  **Eloquent Relationships**:
    -   `Order -> items()`: Relasi **One-to-Many** ke `OrderItem`.
    -   `OrderItem -> product()`: Relasi **BelongsTo** ke `Product` untuk mengambil detail item.
    -   `Cart -> product()`: Relasi **BelongsTo** untuk menampilkan data produk di halaman keranjang.
4.  **Database Transactions**:
    -   Proses checkout dibungkus dalam `DB::transaction()` untuk memastikan jika terjadi error saat menyimpan salah satu item, seluruh proses akan di-rollback (data tetap konsisten).

### D. Spesifikasi Lingkungan
- **Framework**: Laravel 12.x
- **Bahasa**: PHP 8.2+
- **Frontend**: Blade Template & Tailwind CSS
- **Package Manager**: Composer & NPM

## 5. Checklist Fitur MVP (Minimum Viable Product)
Berikut adalah daftar fitur utama yang telah diimplementasikan sebagai standar minimum aplikasi e-commerce:

### Fitur Pelanggan (Customer)
- [x] **Registrasi & Login**: Akun unik untuk setiap pengguna.
- [x] **Katalog Produk**: Menampilkan daftar produk dengan pagination/grid yang rapi.
- [x] **Detail Produk**: Menampilkan deskripsi lengkap, harga, dan gambar produk.
- [x] **Keranjang Belanja (Cart)**: Menambah, menghapus, dan memperbarui jumlah item.
- [x] **Checkout System**: Validasi alamat pengiriman dan ringkasan total biaya.
- [x] **Riwayat Pesanan**: Melihat status dan detail pesanan yang telah dilakukan.

### Fitur Administrator
- [x] **Login Khusus Admin**: Keamanan tambahan dengan pengecekan role.
- [x] **Dashboard Statis**: Ringkasan jumlah produk, stok, dan estimasi penjualan.
- [x] **Manajemen Produk (CRUD)**: Menambah, melihat, mengedit, dan menghapus produk.
- [x] **Unggah Gambar Produk**: Mendukung file lokal atau URL eksternal.
- [x] **Manajemen Pesanan**: Melihat daftar pesanan masuk dan memperbarui statusnya.
