FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip nginx supervisor

    # Install PHP extensions
    RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

    # Install Composer
    COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

    WORKDIR /var/www

    COPY . .

    # Install dependencies
    RUN composer install --optimize-autoloader --no-dev

    # Set permissions
    RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
    RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache

    # Copy nginx config
    COPY docker/nginx.conf /etc/nginx/sites-enabled/default

    # Copy supervisor config
    COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

    EXPOSE 80

    CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
