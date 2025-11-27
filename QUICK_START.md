# 🚀 QUICK START GUIDE - Buku Tamu Digital

## ⏱️ 5 Menit Setup

### 1️⃣ Clone/Download Project
```
cd c:\xampp\htdocs\buku_tamu
```

### 2️⃣ Run Setup (Windows)
```
setup.bat
```

Atau **Manual Setup**:
```bash
composer install
copy .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
```

### 3️⃣ Start Server
```bash
php artisan serve
```

### 4️⃣ Open Browser
```
http://127.0.0.1:8000
```

**Done! ✅**

---

## 📖 Panduan Singkat

### 🏠 Halaman Utama
- Menampilkan daftar semua buku tamu
- Filter & search data
- Export PDF / Excel
- Pagination otomatis

### ✏️ Input Data Baru
1. Klik tombol "**Input Data**" atau "**Tambah Data**"
2. Isi form:
   - **Kecamatan**: Pilih dari dropdown
   - **Nama Pengambil**: Ketik nama lengkap
   - **Nama TK/KB**: Ketik nama institusi
3. **Tanda Tangan**: Gambar di canvas
   - Hapus: Tombol "Hapus"
   - Undo: Tombol "Undo"
4. Klik **"Simpan Data"**
5. Sukses! ✅

### 🔍 Cari & Filter Data
1. Isi form pencarian di atas tabel
2. **Kecamatan**: Filter by dropdown
3. **Nama Pengambil**: Cari (partial match)
4. **Nama TK/KB**: Cari (partial match)
5. Klik **"Cari"** atau **"Reset"** untuk reset

### 📥 Download Data
- **PDF**: Klik tombol "📄 Export PDF"
- **Excel**: Klik tombol "📊 Export Excel"

---

## 🎨 Customization Cepat

### Ubah Nama Kabupaten
Edit di `resources/views/layouts/app.blade.php`:
```blade
<p>Kabupaten _______</p>  <!-- Ganti ini -->
```

Dan di footer:
```blade
<p>© 2025 Dinas Pendidikan Kabupaten _______</p>
```

### Ubah Daftar Kecamatan
Edit di `app/Helpers/GuestBookHelper.php`:
```php
function getKecamatan()
{
    return [
        'Kecamatan Nama A',
        'Kecamatan Nama B',
        // ... tambahkan
    ];
}
```

### Ubah Warna Theme
Edit di `resources/views/layouts/app.blade.php` section `<style>`:
- Primary: `#4a90e2`
- Secondary: `#87CEEB`, `#ADD8E6`
- Dark: `#005a9c`

---

## 🔧 Setup Database

### Konfigurasi di `.env`
```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=buku_tamu
DB_USERNAME=root
DB_PASSWORD=
```

### Buat Database (Manual)
```sql
CREATE DATABASE buku_tamu CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

---

## ⚡ Perintah Penting

```bash
# Jalankan server
php artisan serve

# Jalankan migrasi
php artisan migrate

# Jalankan seeder (contoh data)
php artisan db:seed

# Lihat database
php artisan tinker
> App\Models\GuestBook::all()

# Clear cache
php artisan cache:clear
php artisan config:clear

# Optimize production
php artisan config:cache
php artisan route:cache
```

---

## ⚠️ Troubleshooting

### ❌ Error: "No database selected"
```bash
# Buat database
CREATE DATABASE buku_tamu;

# Atau run migration ulang
php artisan migrate:refresh
```

### ❌ Error: Port 8000 already in use
```bash
php artisan serve --port 8001
```

### ❌ Signature pad tidak bisa digunakan
- Refresh halaman (F5)
- Coba di browser lain
- Cek console (F12) untuk error

### ❌ Data tidak tersimpan
- Pastikan signature sudah digambar
- Lihat error message di halaman
- Check database connection di `.env`

---

## 📱 Akses dari Device Lain

### Dari Laptop/PC Lain di Jaringan
```
http://[IP_KOMPUTER_SERVER]:8000
```

Cari IP komputer server:
```bash
ipconfig  # Windows - cari "IPv4 Address"
ifconfig  # Mac/Linux
```

---

## 📊 Struktur Database

```
guest_books:
├── id
├── kecamatan
├── nama_pengambil
├── nama_tk_kb
├── tanda_tangan (image base64)
├── created_at
└── updated_at
```

---

## 🎯 Fitur Tersedia

✅ Input form dengan validation  
✅ Tanda tangan digital  
✅ Penyimpanan ke MySQL  
✅ List data dengan pagination  
✅ Filter by kecamatan  
✅ Search by nama  
✅ Export PDF  
✅ Export Excel/CSV  
✅ Responsive mobile-friendly  
✅ Theme biru muda formal  

---

## 📚 Dokumentasi Lengkap

- **README_ID.md** - Dokumentasi lengkap
- **API_DOCUMENTATION.md** - API reference
- **TESTING_CHECKLIST.md** - Testing guide
- **ENV_CONFIGURATION.md** - Environment setup
- **PROJECT_COMPLETION_REPORT.md** - Project summary

---

## 🤝 Support

Pertanyaan atau masalah? Lihat:
1. README_ID.md (Troubleshooting section)
2. Buka console browser (F12)
3. Check Laravel logs: `storage/logs/`

---

## ✅ Checklist Sebelum Pakai

- [ ] Database sudah dibuat
- [ ] Migrations sudah dijalankan
- [ ] Server berjalan (php artisan serve)
- [ ] Browser membuka http://127.0.0.1:8000
- [ ] Form input bisa dibuka
- [ ] Bisa input data baru
- [ ] Data muncul di list
- [ ] Export PDF berfungsi
- [ ] Export Excel berfungsi

**Semua checked? Siap digunakan! 🎉**

---

## 💾 Backup Data

### Backup Database
```bash
mysqldump -u root buku_tamu > backup-$(date +%Y%m%d).sql
```

### Restore Database
```bash
mysql -u root buku_tamu < backup-20251125.sql
```

---

## 🚀 Tips Performance

1. **Database**: Jalankan `php artisan migrate` sebelum pakai
2. **Cache**: `php artisan config:cache` di production
3. **Assets**: Use CDN links (sudah diinclude)
4. **Uploads**: Setup storage symlink jika ada upload

---

**Ready to Go! 🎯**

```
Akses: http://127.0.0.1:8000
User: Admin (default - akan ditambahkan di update berikutnya)
Enjoy! 🎉
```

---

*Terakhir diupdate: 25 November 2025*
