# Using the PHP base image
FROM php:8.1-fpm

# Installs Nginx, Composer, and necessary extensions
RUN apt-get update && \
    apt-get install -y nginx curl git unzip zip libzip-dev libpq-dev && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    docker-php-ext-install zip pdo pdo_pgsql

# Copies the project files to the Nginx directory
COPY . /usr/share/nginx/html

# Adjusts the permissions of the storage directory
RUN chown -R www-data:www-data /usr/share/nginx/html/storage && \
    chmod -R 775 /usr/share/nginx/html/storage

# Copies the Nginx configuration
COPY nginx.conf /etc/nginx/conf.d/default.conf

# Copy the entrypoint script
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Sets the working directory
WORKDIR /usr/share/nginx/html

# Installs Laravel dependencies
RUN composer install --no-interaction --prefer-dist

# Generates the Laravel key
RUN php artisan key:generate --no-interaction

# Exposes port 80
EXPOSE 80

# Define the entrypoint script
ENTRYPOINT ["entrypoint.sh"]
