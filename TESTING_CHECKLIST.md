# Testing Checklist - Buku Tamu Digital

## Pre-Testing Setup
- [ ] Database sudah dibuat: `buku_tamu`
- [ ] Migrations sudah dijalankan: `php artisan migrate`
- [ ] Seeders sudah dijalankan: `php artisan db:seed` (opsional)
- [ ] Server berjalan: `php artisan serve`
- [ ] Browser terbuka di `http://127.0.0.1:8000`

## Frontend Testing

### 1. Halaman List Data (Index)
- [ ] Halaman terbuka dengan benar
- [ ] Header tampil dengan logo dan navigasi
- [ ] Footer tampil dengan copyright
- [ ] Tabel data menampilkan data dengan benar
- [ ] Nomor urut berjalan dengan benar
- [ ] Pagination bekerja (jika data > 10 item)
- [ ] Tombol "Input Data" mengarah ke form
- [ ] Tombol "Home" berfungsi

### 2. Form Input Data
- [ ] Form terbuka dengan benar
- [ ] Dropdown kecamatan berisi 8 opsi
- [ ] Input text untuk nama pengambil
- [ ] Input text untuk nama TK/KB
- [ ] Canvas signature pad tampil dengan benar
- [ ] Dapat menggambar di signature pad
- [ ] Tombol "Hapus" signature bekerja
- [ ] Tombol "Undo" signature bekerja
- [ ] Tombol "Batal" mengarah ke index

### 3. Form Submission
- [ ] Form bisa disubmit jika semua field diisi
- [ ] Error muncul jika field kosong
- [ ] Error muncul jika signature kosong
- [ ] Data disimpan ke database
- [ ] Notifikasi "Data berhasil disimpan. Terima kasih." muncul
- [ ] Redirect ke halaman list setelah submit
- [ ] Data baru tampil di tabel

### 4. Pencarian & Filter
- [ ] Filter kecamatan bekerja
- [ ] Pencarian nama pengambil bekerja (LIKE search)
- [ ] Pencarian nama TK/KB bekerja (LIKE search)
- [ ] Kombinasi filter bekerja
- [ ] Tombol reset filter menampilkan semua data
- [ ] Jumlah hasil sesuai filter

### 5. Tanda Tangan
- [ ] Modal tanda tangan bisa dibuka
- [ ] Preview tanda tangan menampilkan dengan benar
- [ ] Modal bisa ditutup
- [ ] Tombol "Lihat" hanya muncul jika ada tanda tangan

### 6. Export PDF
- [ ] Tombol export PDF ada
- [ ] Download PDF berhasil
- [ ] File terbuka/tersimpan dengan nama yang benar
- [ ] Format tabel di PDF sesuai
- [ ] Data terfilter sesuai kondisi
- [ ] Header "Laporan Buku Tamu Dinas Pendidikan" ada
- [ ] Tanggal cetak ada

### 7. Export Excel/CSV
- [ ] Tombol export Excel ada
- [ ] Download Excel/CSV berhasil
- [ ] File terbuka dengan program Excel/Sheets
- [ ] Kolom: No., Kecamatan, Nama Pengambil, Nama TK/KB, Tanggal
- [ ] Data terfilter sesuai kondisi
- [ ] Format CSV/Excel valid

### 8. Responsive Design
- [ ] Desktop: Tampilan penuh normal
- [ ] Tablet (768px): Layout responsif
- [ ] Mobile (375px): Layout mobile-friendly
- [ ] Form inputs mudah diklik di mobile
- [ ] Tabel scroll horizontal di mobile (jika diperlukan)
- [ ] Tombol mudah diklik (min 44x44px)

### 9. UI/UX
- [ ] Warna tema biru muda konsisten
- [ ] Font Poppins/Roboto teraplikasi
- [ ] Spacing dan padding terlihat rapi
- [ ] Shadow dan border radius konsisten
- [ ] Alert/notification tampil dengan benar
- [ ] Hover effects berfungsi
- [ ] Loading states (jika ada) tampil

## Backend Testing

### 1. Database
- [ ] Tabel `guest_books` ada di database
- [ ] Kolom: id, kecamatan, nama_pengambil, nama_tk_kb, tanda_tangan, created_at, updated_at
- [ ] Data insert berjalan dengan benar
- [ ] Timestamps (created_at, updated_at) auto-generated
- [ ] Data bisa di-query dengan benar

### 2. Model & Controller
- [ ] GuestBook model dengan fillable attributes
- [ ] Factory generate data dengan benar
- [ ] Seeder membuat 15 sample data
- [ ] Controller methods semuanya ada:
  - [ ] index()
  - [ ] create()
  - [ ] store()
  - [ ] exportPdf()
  - [ ] exportExcel()

### 3. Validation
- [ ] Kecamatan wajib diisi
- [ ] Nama pengambil wajib diisi & max 255 char
- [ ] Nama TK/KB wajib diisi & max 255 char
- [ ] Tanda tangan wajib diisi (tidak kosong)
- [ ] Error message tampil dengan benar

### 4. Routes
```
✓ GET  /                      -> redirect ke /guest-books
✓ GET  /guest-books           -> index (list data)
✓ GET  /guest-books/create    -> create (form input)
✓ POST /guest-books           -> store (simpan data)
✓ GET  /guest-books/export/pdf -> export PDF
✓ GET  /guest-books/export/excel -> export Excel
```

## Security Testing

- [ ] CSRF protection aktif (form punya csrf token)
- [ ] Input sanitization (prevent XSS)
- [ ] SQL injection tidak mungkin (prepared statements)
- [ ] No sensitive data di view source
- [ ] File upload security (jika ada)

## Performance Testing

- [ ] Page load time < 2 detik
- [ ] Database query optimal (no N+1 queries)
- [ ] Memory usage reasonable
- [ ] Pagination loading smooth
- [ ] Export tidak crash dengan banyak data

## Browser Compatibility

- [ ] Chrome/Edge (latest)
- [ ] Firefox (latest)
- [ ] Safari (latest)
- [ ] Mobile browsers (Chrome mobile, Safari iOS)

## Edge Cases

- [ ] Form dengan special characters
- [ ] Nama dengan emoji
- [ ] Kecamatan dengan spasi
- [ ] Export dengan filter menghasilkan 0 data
- [ ] Pagination dengan 1 item
- [ ] Signature pad pada slow internet

## Data Integrity

- [ ] Data tidak hilang setelah submit
- [ ] Duplicate data tidak mungkin
- [ ] Soft delete (jika ada) bekerja
- [ ] Updated_at timestamp berubah saat edit
- [ ] Filter tidak mengubah data original

## Admin/Future Features (Untuk Versi Next)

- [ ] Login page ready untuk diintegrasikan
- [ ] Admin dashboard dapat diakses dengan route guard
- [ ] Delete functionality siap ditambahkan
- [ ] Edit functionality siap ditambahkan
- [ ] User management ready

## Sign-Off

**Tester:** ___________________________  
**Date:** ___________________________  
**Status:** 
- [ ] PASSED - Semua test OK
- [ ] PASSED WITH NOTES - Ada beberapa catatan (lihat notes)
- [ ] FAILED - Ada masalah (lihat issues)

**Notes/Issues:**
```
[Tulis catatan atau masalah di sini]
```

---

### Cara Melakukan Testing:

1. **Manual Testing:**
   - Buka aplikasi di browser
   - Ikuti checklist di atas
   - Catat hasil di file ini

2. **Browser Console Testing:**
   - Buka DevTools (F12)
   - Lihat Console untuk error JavaScript
   - Lihat Network untuk request/response

3. **Database Testing:**
   - Jalankan: `php artisan tinker`
   - Query: `App\Models\GuestBook::all()`
   - Lihat data di phpMyAdmin/MySQL Workbench

4. **Performance Testing:**
   - DevTools > Network tab
   - DevTools > Performance tab
   - Jalankan: `php artisan tinker` untuk time queries

---

**Last Updated:** 25 November 2025
