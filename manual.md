# Manual Penggunaan CMS - Kaosintim Panel (cms8003)

## Informasi Umum
- **URL Admin:** https://cms8003.156-67-220-144.sslip.io/admin/login
- **URL Website:** https://cms8003.156-67-220-144.sslip.io
- **Database:** cms_03

## Akun Login
| Role | Email | Password |
|------|-------|----------|
| Super Admin | tbfarhannh@gmail.com | AcaCantik123 |
| Admin | kaosintim@gmail.com | Qwerty12345 |

## Fitur CMS
### 1. Dashboard
Tampilan utama dengan ringkasan data dan grafik penjualan.

### 2. Manajemen Produk
- Tambah, edit, hapus produk
- Atur gambar produk (multiple images)
- Atur harga, diskon, ukuran, warna
- Atur fitur produk

### 3. Manajemen Portfolio
- Tambah portfolio dengan gambar
- Atur deskripsi portfolio

### 4. Manajemen Testimonial
- Tambah testimonial pelanggan
- Atur rating dan foto

### 5. Manajemen Brand
- Kelola brand collaboration

### 6. Manajemen FAQ
- Tambah dan edit pertanyaan umum

### 7. Manajemen Pengguna
- Super Admin: akses penuh ke semua fitur
- Admin: akses terbatas

## Cara Import Database
```bash
mysql -u root -p cms_03 < database/cms_03_full.sql
```

## Teknologi
- Laravel 13
- PHP 8.4
- MySQL 8.0
- Nginx
