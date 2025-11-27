# Buku Tamu Digital Dinas Pendidikan

Sistem buku tamu digital untuk Dinas Pendidikan yang memungkinkan pengunjung untuk mencatat kunjungan mereka secara digital dengan tanda tangan berbasis canvas.

## Fitur Utama

### 1. **Formulir Input Data**
- Dropdown untuk memilih kecamatan
- Input teks untuk nama orang yang mengambil dokumen
- Input teks untuk nama TK/KB
- Tanda tangan digital menggunakan Signature Pad (berbasis HTML5 Canvas)
- Tombol untuk menghapus dan undo tanda tangan

### 2. **Penyimpanan Data**
- Data disimpan ke database MySQL dengan otomatis
- Notifikasi "Data berhasil disimpan. Terima kasih." setelah form berhasil disubmit
- Redirect ke halaman data setelah submit berhasil

### 3. **Tampilan Data**
- Tabel data dengan nomor urut otomatis
- Modal untuk melihat preview tanda tangan digital
- Responsive design yang mobile-friendly
- Pagination dengan 10 data per halaman

### 4. **Pencarian & Filter**
- Filter berdasarkan kecamatan
- Pencarian berdasarkan nama pengambil
- Pencarian berdasarkan nama TK/KB
- Reset filter untuk menampilkan semua data

### 5. **Export Data**
- Export ke PDF (format HTML yang siap cetak)
- Export ke Excel/CSV dengan kolom: No., Kecamatan, Nama Pengambil, Nama TK/KB, Tanggal

### 6. **Desain UI**
- Theme warna biru muda (#87CEEB, #ADD8E6) sesuai standar pemerintah
- Font modern: Poppins dan Roboto
- Header dengan logo Dinas Pendidikan (ikon graduation cap)
- Footer dengan copyright "© 2025 Dinas Pendidikan Kabupaten _______"
- Responsive design untuk semua ukuran layar

### 7. **Struktur MVC Laravel**
- Mengikuti standar Laravel 12
- Model: `App\Models\GuestBook`
- Controller: `App\Http\Controllers\GuestBookController`
- Views di folder `resources/views/guest-books/`

## Persyaratan Sistem

- PHP 8.2+
- Laravel 12
- MySQL 5.7+
- Composer
- Browser modern yang support HTML5 Canvas

## Instalasi & Setup

### 1. Clone atau Download Project
```bash
cd c:\xampp\htdocs\buku_tamu
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Setup Environment
```bash
# Copy .env file
copy .env.example .env

# Generate app key
php artisan key:generate
```

### 4. Konfigurasi Database
Edit file `.env`:
```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=buku_tamu
DB_USERNAME=root
DB_PASSWORD=
```

Buat database MySQL:
```sql
CREATE DATABASE buku_tamu CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 5. Jalankan Migrasi
```bash
php artisan migrate
```

### 6. Seeding Data (Opsional)
```bash
php artisan db:seed
```

### 7. Jalankan Server
```bash
php artisan serve
```

Server akan berjalan di `http://127.0.0.1:8000`

## Struktur Folder

```
buku_tamu/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── GuestBookController.php
│   ├── Models/
│   │   └── GuestBook.php
│   ├── Helpers/
│   │   └── GuestBookHelper.php
│   └── Providers/
│       └── AppServiceProvider.php
├── database/
│   ├── migrations/
│   │   └── 2025_11_25_015737_create_guest_books_table.php
│   ├── factories/
│   │   └── GuestBookFactory.php
│   └── seeders/
│       └── DatabaseSeeder.php
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php
│       └── guest-books/
│           ├── index.blade.php
│           └── create.blade.php
├── routes/
│   └── web.php
├── .env
└── composer.json
```

## Rute Aplikasi

| Method | Route | Deskripsi |
|--------|-------|-----------|
| GET | `/guest-books` | Tampilkan daftar buku tamu |
| GET | `/guest-books/create` | Tampilkan form input |
| POST | `/guest-books` | Simpan data buku tamu |
| GET | `/guest-books/export/pdf` | Export data ke PDF |
| GET | `/guest-books/export/excel` | Export data ke Excel/CSV |

## Teknologi yang Digunakan

- **Backend**: Laravel 12
- **Database**: MySQL
- **Frontend**: Bootstrap 5, Poppins/Roboto Fonts
- **Signature Pad**: signature_pad.js
- **Icon**: Font Awesome 6
- **Email/Styling**: CSS3, HTML5

## Fitur Future Update (Siap untuk Dikembangkan)

- ✅ Sistem login admin untuk kelola data
- ✅ Dashboard analytics
- ✅ Email notification
- ✅ Print data history
- ✅ User management
- ✅ Activity logging

## Customization

### Mengubah Nama Kecamatan

Edit file `app/Helpers/GuestBookHelper.php`:
```php
function getKecamatan()
{
    return [
        'Kecamatan Nama 1',
        'Kecamatan Nama 2',
        // ... tambahkan sesuai kebutuhan
    ];
}
```

### Mengubah Warna Theme

Edit file `resources/views/layouts/app.blade.php` section `<style>` dan ganti nilai hex color:
- Primary: `#4a90e2`
- Secondary: `#87CEEB`, `#ADD8E6`
- Dark: `#005a9c`

### Mengubah Nama Kabupaten

Edit di file `resources/views/layouts/app.blade.php`:
```blade
<p>Kabupaten _______</p>
```

Dan di footer:
```blade
<p><i class="fas fa-copyright"></i> 2025 Dinas Pendidikan Kabupaten _______</p>
```

## Troubleshooting

### Error: SQLSTATE[HY000] [2002] No such file or directory
**Solusi**: Pastikan MySQL service sudah berjalan. Di XAMPP, jalankan MySQL dari control panel.

### Error: Call to undefined method factory()
**Solusi**: Pastikan trait `HasFactory` sudah ditambahkan ke model GuestBook dan jalankan `composer dump-autoload`.

### Form tidak bisa submit
**Solusi**: 
1. Pastikan signature sudah digambar (ada tanda tangan di canvas)
2. Refresh halaman browser
3. Buka console browser untuk cek error JavaScript

### Export PDF/Excel tidak berfungsi
**Solusi**: Pastikan tidak ada error di controller export dan browser tidak memblokir download.

## Support & Kontribusi

Untuk pertanyaan atau saran pengembangan, silakan hubungi tim IT Dinas Pendidikan.

## Lisensi

Project ini dilisensikan untuk Dinas Pendidikan Kabupaten. Jangan distribusikan tanpa izin.

---

**Terakhir diupdate**: 25 November 2025
**Versi**: 1.0
**Status**: Production Ready
