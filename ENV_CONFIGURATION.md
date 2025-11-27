# Environment Configuration Guide

## File .env

Berikut adalah penjelasan untuk setiap konfigurasi di file `.env`:

### Application Settings

```dotenv
APP_NAME=BukuTamuDinas
APP_ENV=local
APP_KEY=base64:xxxxxxxxxxxxxx
APP_DEBUG=true
APP_URL=http://localhost
```

- **APP_NAME**: Nama aplikasi (gunakan di email, etc)
- **APP_ENV**: Environment (local, staging, production)
- **APP_KEY**: Generated key, jangan diubah manual
- **APP_DEBUG**: Set `false` di production
- **APP_URL**: URL publik aplikasi

### Lokalisasi

```dotenv
APP_LOCALE=id
APP_FALLBACK_LOCALE=id
APP_FAKER_LOCALE=id_ID
```

- **APP_LOCALE**: Bahasa default (id untuk Indonesia)
- **APP_FAKER_LOCALE**: Locale untuk Faker library

### Database Configuration

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=buku_tamu
DB_USERNAME=root
DB_PASSWORD=
```

**Penjelasan:**
- **DB_CONNECTION**: Driver database (mysql, pgsql, sqlite, sqlsrv)
- **DB_HOST**: Host database server
- **DB_PORT**: Port database (MySQL default: 3306)
- **DB_DATABASE**: Nama database
- **DB_USERNAME**: Username database
- **DB_PASSWORD**: Password database (kosong jika tidak ada)

**Contoh Konfigurasi:**
```dotenv
# XAMPP Local (default)
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=buku_tamu
DB_USERNAME=root
DB_PASSWORD=

# Remote Server
DB_CONNECTION=mysql
DB_HOST=192.168.1.100
DB_PORT=3306
DB_DATABASE=buku_tamu_prod
DB_USERNAME=db_user
DB_PASSWORD=secure_password123

# PostgreSQL
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=buku_tamu
DB_USERNAME=postgres
DB_PASSWORD=postgres_password
```

### Cache Configuration

```dotenv
CACHE_STORE=database
```

- **CACHE_STORE**: Driver cache (database, redis, file, array)

### Session Configuration

```dotenv
SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
```

- **SESSION_DRIVER**: Driver session storage
- **SESSION_LIFETIME**: Session timeout dalam menit
- **SESSION_ENCRYPT**: Enkripsi session data

### Queue Configuration

```dotenv
QUEUE_CONNECTION=database
```

- **QUEUE_CONNECTION**: Job queue driver (untuk async tasks)

### Mail Configuration (Optional)

```dotenv
MAIL_MAILER=log
MAIL_SCHEME=null
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_FROM_ADDRESS="noreply@bukutamu.local"
MAIL_FROM_NAME="${APP_NAME}"
```

**Untuk SMTP Email:**
```dotenv
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@dinpendidikan.go.id"
```

---

## Development Configuration

### .env untuk Development

```dotenv
APP_NAME=BukuTamuDinas
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=buku_tamu_dev
DB_USERNAME=root
DB_PASSWORD=

CACHE_STORE=database
SESSION_DRIVER=database
QUEUE_CONNECTION=database

LOG_CHANNEL=stack
LOG_LEVEL=debug
```

### Run Development Server

```bash
# Terminal 1: Jalankan PHP server
php artisan serve

# Terminal 2 (Optional): Jalankan Queue
php artisan queue:listen

# Terminal 3 (Optional): Jalankan Log Monitor
php artisan pail
```

---

## Production Configuration

### .env untuk Production

```dotenv
APP_NAME=BukuTamuDinas
APP_ENV=production
APP_DEBUG=false
APP_URL=https://bukutamu.dinpendidikan.go.id

DB_CONNECTION=mysql
DB_HOST=production.db.server
DB_PORT=3306
DB_DATABASE=buku_tamu_prod
DB_USERNAME=prod_user
DB_PASSWORD=StrongPassword123!@#

CACHE_STORE=redis
SESSION_DRIVER=database
QUEUE_CONNECTION=redis

LOG_CHANNEL=stack
LOG_LEVEL=error
```

### Production Setup Checklist

```bash
# 1. Generate app key jika belum
php artisan key:generate

# 2. Config cache untuk performance
php artisan config:cache

# 3. Route cache
php artisan route:cache

# 4. Clear semua cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear

# 5. Optimize composer
composer install --optimize-autoloader --no-dev

# 6. Run migrations (jika fresh)
php artisan migrate --force

# 7. Setup permissions
chmod 755 storage bootstrap/cache
chmod 644 storage/logs/*

# 8. Setup web server (Nginx example)
# Lihat setup-nginx.conf untuk konfigurasi Nginx
```

---

## Environment Variables untuk Features

### Jika ingin menambah Email Notifikasi

```dotenv
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
```

### Jika ingin menambah Storage Cloud (S3)

```dotenv
AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=ap-southeast-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false
```

### Jika ingin menambah Analytics

```dotenv
GOOGLE_ANALYTICS_ID=G-XXXXXXXXXX
```

### Jika inambah Redis untuk Cache/Queue

```dotenv
REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```

---

## Troubleshooting Environment

### Error: "Undefined index: APP_KEY"
**Solusi**: Jalankan `php artisan key:generate`

### Error: "SQLSTATE[HY000]: General error: 1030 Got error"
**Solusi**: Buat database: `CREATE DATABASE buku_tamu CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;`

### Error: Permission denied di storage
**Solusi**: 
```bash
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

### Error: Database tidak bisa connect
**Solusi**:
- Pastikan MySQL service berjalan
- Cek DB_HOST, DB_PORT, DB_USERNAME, DB_PASSWORD di .env
- Test connection: `php artisan tinker` lalu `DB::connection()->getPdo();`

### Error: Session error
**Solusi**: Jalankan `php artisan session:table` lalu `php artisan migrate`

---

## Best Practices

### ✅ DO:
- Gunakan `.env.example` sebagai template
- Jangan commit `.env` ke version control
- Ganti APP_KEY yang sudah di-generate
- Gunakan strong password untuk production
- Backup `.env` production di tempat aman
- Review `.env` sebelum deploy

### ❌ DON'T:
- Jangan hardcode sensitive data di code
- Jangan share `.env` file
- Jangan gunakan debug=true di production
- Jangan gunakan default password
- Jangan expose .env di public folder
- Jangan commit `.env.local` ke repo

---

## Quick Reference

| Variable | Dev Value | Prod Value |
|----------|-----------|-----------|
| APP_ENV | local | production |
| APP_DEBUG | true | false |
| DB_HOST | 127.0.0.1 | ip.prod.server |
| CACHE_STORE | database | redis |
| LOG_LEVEL | debug | error |

---

**Last Updated:** 25 November 2025
