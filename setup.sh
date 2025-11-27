#!/bin/bash

# Buku Tamu Digital - Setup Script
# This script will setup the application for Linux/macOS

echo ""
echo "======================================"
echo "Buku Tamu Digital - Setup Script"
echo "======================================"
echo ""

# Check if .env exists
if [ ! -f .env ]; then
    echo "[*] Creating .env file..."
    cp .env.example .env
    echo "[✓] .env file created"
else
    echo "[✓] .env file already exists"
fi

# Update composer dependencies
echo ""
echo "[*] Installing composer dependencies..."
composer install
if [ $? -ne 0 ]; then
    echo "[✗] Composer install failed"
    exit 1
fi
echo "[✓] Composer dependencies installed"

# Generate app key
echo ""
echo "[*] Generating application key..."
php artisan key:generate
echo "[✓] Application key generated"

# Run migrations
echo ""
echo "[*] Running database migrations..."
php artisan migrate
if [ $? -ne 0 ]; then
    echo "[✗] Migration failed. Make sure MySQL is running and .env is configured correctly."
    exit 1
fi
echo "[✓] Database migrations completed"

# Optional: Run seeders
echo ""
echo "Do you want to seed sample data? (y/n)"
read -r choice
if [ "$choice" = "y" ] || [ "$choice" = "Y" ]; then
    echo "[*] Seeding database..."
    php artisan db:seed
    echo "[✓] Database seeded with sample data"
fi

# Optimize auto-load
echo ""
echo "[*] Optimizing autoload..."
composer dump-autoload
echo "[✓] Autoload optimized"

echo ""
echo "======================================"
echo "Setup completed successfully!"
echo "======================================"
echo ""
echo "To start the development server, run:"
echo "  php artisan serve"
echo ""
echo "Then open your browser to:"
echo "  http://127.0.0.1:8000"
echo ""
