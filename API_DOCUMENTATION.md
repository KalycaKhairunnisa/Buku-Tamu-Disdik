# API Documentation - Buku Tamu Digital

## Endpoints

### 1. GET /guest-books
Menampilkan list semua buku tamu dengan pagination

**Query Parameters:**
- `kecamatan` (string, optional) - Filter berdasarkan kecamatan
- `nama_pengambil` (string, optional) - Cari berdasarkan nama pengambil (LIKE)
- `nama_tk_kb` (string, optional) - Cari berdasarkan nama TK/KB (LIKE)
- `page` (integer, optional) - Nomor halaman (default: 1)

**Example:**
```
GET /guest-books?kecamatan=Kecamatan%201&page=1
GET /guest-books?nama_pengambil=Budi
GET /guest-books?nama_tk_kb=TK%20Maju
```

**Response (200):**
```json
{
  "data": [
    {
      "id": 1,
      "kecamatan": "Kecamatan 1",
      "nama_pengambil": "Budi Santoso",
      "nama_tk_kb": "TK Maju",
      "created_at": "2025-11-25T15:30:00.000000Z"
    }
  ],
  "pagination": {
    "total": 15,
    "per_page": 10,
    "current_page": 1
  }
}
```

---

### 2. GET /guest-books/create
Menampilkan form input buku tamu

**Response (200):**
```html
<!-- HTML Form dengan signature pad -->
```

---

### 3. POST /guest-books
Menyimpan data buku tamu baru

**Request Body (form-data):**
```
kecamatan: "Kecamatan 1"
nama_pengambil: "Budi Santoso"
nama_tk_kb: "TK Maju Jaya"
tanda_tangan: "data:image/png;base64,iVBORw0KGgoAAAANSU..." (base64 canvas image)
```

**Validation Rules:**
- `kecamatan`: required, string
- `nama_pengambil`: required, string, max 255
- `nama_tk_kb`: required, string, max 255
- `tanda_tangan`: required, string (base64 data URL)

**Response (201/302 Redirect):**
```json
{
  "success": true,
  "message": "Data berhasil disimpan. Terima kasih.",
  "redirect": "/guest-books"
}
```

**Response (422 Validation Error):**
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "kecamatan": ["The kecamatan field is required."],
    "tanda_tangan": ["The tanda tangan field is required."]
  }
}
```

---

### 4. GET /guest-books/export/pdf
Export data buku tamu ke format PDF (HTML)

**Query Parameters:**
- `kecamatan` (string, optional) - Filter export by kecamatan
- `nama_pengambil` (string, optional) - Filter export by nama pengambil
- `nama_tk_kb` (string, optional) - Filter export by nama TK/KB

**Example:**
```
GET /guest-books/export/pdf?kecamatan=Kecamatan%201
GET /guest-books/export/pdf?nama_pengambil=Budi
```

**Response (200):**
```
Content-Type: text/html; charset=utf-8
Content-Disposition: attachment; filename="buku-tamu-2025-11-25.html"

<!DOCTYPE html>
<html>
<head>
  <title>Buku Tamu Dinas Pendidikan</title>
</head>
<body>
  <h1>Laporan Buku Tamu Dinas Pendidikan</h1>
  <table>
    <!-- Data dalam bentuk tabel HTML -->
  </table>
</body>
</html>
```

---

### 5. GET /guest-books/export/excel
Export data buku tamu ke format Excel/CSV

**Query Parameters:**
- `kecamatan` (string, optional) - Filter export by kecamatan
- `nama_pengambil` (string, optional) - Filter export by nama pengambil
- `nama_tk_kb` (string, optional) - Filter export by nama TK/KB

**Example:**
```
GET /guest-books/export/excel?kecamatan=Kecamatan%201
GET /guest-books/export/excel?nama_pengambil=Budi
```

**Response (200):**
```
Content-Type: text/csv; charset=utf-8
Content-Disposition: attachment; filename="buku-tamu-2025-11-25.csv"

No.,Kecamatan,Nama Pengambil,Nama TK/KB,Tanggal
1,"Kecamatan 1","Budi Santoso","TK Maju","25-11-2025 15:30"
2,"Kecamatan 2","Siti Nurhaliza","TK Ceria","25-11-2025 14:15"
```

---

## Data Model

### GuestBook Model

```php
class GuestBook extends Model {
    protected $fillable = [
        'kecamatan',
        'nama_pengambil',
        'nama_tk_kb',
        'tanda_tangan',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
```

### Database Schema

```sql
CREATE TABLE guest_books (
  id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  kecamatan VARCHAR(255) NOT NULL,
  nama_pengambil VARCHAR(255) NOT NULL,
  nama_tk_kb VARCHAR(255) NOT NULL,
  tanda_tangan LONGTEXT,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
);
```

---

## Status Codes

| Code | Deskripsi |
|------|-----------|
| 200 | OK - Request berhasil |
| 201 | Created - Resource berhasil dibuat |
| 302 | Found - Redirect (biasa digunakan setelah POST) |
| 404 | Not Found - Resource tidak ditemukan |
| 422 | Unprocessable Entity - Validation error |
| 500 | Internal Server Error |

---

## Error Handling

### Validation Error
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "field_name": ["Error message"]
  }
}
```

### Server Error
```json
{
  "message": "Server error occurred",
  "error": "Error details..."
}
```

---

## Rate Limiting

Saat ini tidak ada rate limiting. Untuk production, tambahkan:

```php
// Di routes/web.php
Route::middleware('throttle:60,1')->group(function () {
    // Routes disini
});
```

---

## Authentication

Fitur authentication akan ditambahkan di versi berikutnya.

---

## Contoh Implementasi Client-Side

### JavaScript Fetch (Input Form)

```javascript
const formData = new FormData();
formData.append('kecamatan', document.getElementById('kecamatan').value);
formData.append('nama_pengambil', document.getElementById('nama_pengambil').value);
formData.append('nama_tk_kb', document.getElementById('nama_tk_kb').value);
formData.append('tanda_tangan', canvas.toDataURL()); // dari signature pad

fetch('/guest-books', {
  method: 'POST',
  body: formData,
  headers: {
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
  }
})
.then(response => response.json())
.then(data => console.log(data))
.catch(error => console.error('Error:', error));
```

### jQuery AJAX (Fetch Data)

```javascript
$.ajax({
  url: '/guest-books',
  type: 'GET',
  data: {
    kecamatan: 'Kecamatan 1',
    page: 1
  },
  success: function(response) {
    console.log(response);
  }
});
```

---

## Future Enhancements

- [ ] REST API dengan authentication token
- [ ] API documentation dengan Swagger
- [ ] GraphQL endpoint
- [ ] Real-time sync dengan WebSocket
- [ ] Mobile app integration
- [ ] Advanced filtering dengan Elasticsearch
- [ ] Scheduled exports

---

**Last Updated:** 25 November 2025  
**API Version:** 1.0  
**Status:** Stable
