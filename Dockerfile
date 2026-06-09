FROM php:8.2-cli

# Install dependencies sistem + ekstensi PostgreSQL
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libzip-dev zip \
    && docker-php-ext-install pdo pdo_pgsql pgsql zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy semua file project
COPY . .

# Install dependencies Laravel (production)
RUN composer install --no-dev --optimize-autoloader

# Permission untuk storage & cache
RUN chmod -R 775 storage bootstrap/cache

# Render kasih port lewat env $PORT
EXPOSE 8000

# Saat container start: migrate + seed + jalankan server
CMD php artisan migrate --force && php artisan db:seed --force && php artisan serve --host=0.0.0.0 --port=${PORT:-8000}