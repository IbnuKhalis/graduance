#!/bin/sh
set -e

mkdir -p /var/www/html/storage/app/public/file-questions
mkdir -p /var/www/html/storage/app/public/file-answer
mkdir -p /var/www/html/storage/app/public/photos
mkdir -p /var/www/html/storage/framework/cache/data
mkdir -p /var/www/html/storage/framework/sessions
mkdir -p /var/www/html/storage/framework/views
mkdir -p /var/www/html/storage/logs

chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Create symlink if missing
if [ ! -L /var/www/html/public/storage ]; then
    php artisan storage:link || true
fi

# In production, cache config & routes if artisan is functional
if [ "$APP_ENV" = "production" ]; then
    php artisan config:clear || true
    php artisan route:clear || true
    php artisan view:clear || true
fi

exec apache2-foreground
