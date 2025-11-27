@echo off
REM Buku Tamu Digital - Setup Script for Windows
REM This script will setup the application

echo.
echo ======================================
echo Buku Tamu Digital - Setup Script
echo ======================================
echo.

REM Check if .env exists
if not exist .env (
    echo [*] Creating .env file...
    copy .env.example .env
    echo [✓] .env file created
) else (
    echo [✓] .env file already exists
)

REM Update composer dependencies
echo.
echo [*] Installing composer dependencies...
call composer install
if errorlevel 1 (
    echo [✗] Composer install failed
    pause
    exit /b 1
)
echo [✓] Composer dependencies installed

REM Generate app key
echo.
echo [*] Generating application key...
call php artisan key:generate
echo [✓] Application key generated

REM Run migrations
echo.
echo [*] Running database migrations...
call php artisan migrate
if errorlevel 1 (
    echo [✗] Migration failed. Make sure MySQL is running and .env is configured correctly.
    pause
    exit /b 1
)
echo [✓] Database migrations completed

REM Optional: Run seeders
echo.
echo Do you want to seed sample data? (Y/N)
set /p choice=
if /i "%choice%"=="Y" (
    echo [*] Seeding database...
    call php artisan db:seed
    echo [✓] Database seeded with sample data
)

REM Optimize auto-load
echo.
echo [*] Optimizing autoload...
call composer dump-autoload
echo [✓] Autoload optimized

echo.
echo ======================================
echo Setup completed successfully!
echo ======================================
echo.
echo To start the development server, run:
echo   php artisan serve
echo.
echo Then open your browser to:
echo   http://127.0.0.1:8000
echo.
pause
