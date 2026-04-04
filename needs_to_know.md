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
- **Model**: Mengelola data dan logika bisnis (contoh: [Product.php](file:///home/himro/Projects/projek-pbo/app/Models/Product.php), [Order.php](file:///home/himro/Projects/projek-pbo/app/Models/Order.php)). Menggunakan **Eloquent ORM** untuk interaksi database yang aman dan efisien.
- **View**: Antarmuka pengguna yang dinamis menggunakan **Blade Template Engine** dan dipadu dengan **Tailwind CSS** untuk *styling*.
- **Controller**: Menangani permintaan dari pengguna, memproses data melalui Model, dan mengirimkannya kembali ke View (contoh: [AdminController.php](file:///home/himro/Projects/projek-pbo/app/Http/Controllers/AdminController.php), [OrderController.php](file:///home/himro/Projects/projek-pbo/app/Http/Controllers/OrderController.php)).

### B. Struktur & Relasi Database
Sistem menggunakan database relasional dengan skema berikut:
- **Users**: Menyimpan data akun pelanggan dan admin (dibedakan melalui kolom `role`).
- **Products**: Informasi produk seperti nama, deskripsi, harga, stok, kategorti, dan URL gambar.
- **Carts**: Tabel perantara antara User dan Product untuk menyimpan item yang belum dicheckout.
- **Orders & OrderItems**: 
    - `Orders` menyimpan informasi utama pesanan (total harga, alamat, status).
    - `OrderItems` menyimpan rincian produk yang dibeli dalam satu pesanan (snapshot harga saat dibeli, kuantitas).

**Relasi Utama**:
- [User](file:///home/himro/Projects/projek-pbo/app/Models/User.php#10-49) **Has Many** `Orders` (Satu user bisa punya banyak pesanan).
- [Order](file:///home/himro/Projects/projek-pbo/app/Models/Order.php#8-24) **Has Many** `OrderItems` (Satu pesanan bisa terdiri dari banyak produk).
- [Product](file:///home/himro/Projects/projek-pbo/app/Models/Product.php#7-20) **Has Many** `OrderItems` (Satu produk bisa muncul di banyak pesanan).

### C. Alur Kerja Sistem (System Workflow)
1.  **Sisi Pelanggan**:
    - Pelanggan melakukan registrasi dan login.
    - Menjelajahi katalog produk di halaman utama.
    - Menambahkan produk ke dalam keranjang belanja ([Cart](file:///home/himro/Projects/projek-pbo/app/Models/Cart.php#8-24)).
    - Melakukan `Checkout` dengan mengisi alamat pengiriman. Sistem akan memindahkan data dari [Cart](file:///home/himro/Projects/projek-pbo/app/Models/Cart.php#8-24) ke `Orders` dalam satu **Database Transaction** untuk menjaga integritas data.
2.  **Sisi Administrator**:
    - Admin login melalui jalur khusus (`/admin/login`).
    - Mengakses Dashboard untuk melihat ringkasan statistik (total stok, produk, dll).
    - Melakukan operasi **CRUD** (Create, Read, Update, Delete) pada tabel produk.
    - Mengelola status pesanan pelanggan (dari `pending` ke status selanjutnya).

### D. Keamanan & Validasi
- **Middleware [auth](file:///home/himro/Projects/projek-pbo/app/Http/Controllers/AdminController.php#18-38)**: Melindungi rute sensitif agar hanya bisa diakses oleh pengguna yang sudah login.
- **Role-Based Access**: Memastikan halaman admin hanya bisa diakses oleh user dengan role 'admin'.
- **Validasi Request**: Setiap input dari pengguna divalidasi dengan ketat menggunakan Laravel `validate` untuk mencegah SQL Injection dan data cacat.
- **Database Transaction**: Digunakan pada proses checkout untuk memastikan jika terjadi kegagalan sistem, data pesanan tidak akan tercipta secara setengah-setengah (menjamin atomisitas).
