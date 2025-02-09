#!/bin/sh

# Run migrations
php artisan migrate --force

# Start Nginx and PHP-FPM
nginx -g 'daemon off;' & php-fpm
