# 1. Use PHP 8.2 with Apache
FROM php:8.2-apache

# 2. Install Linux packages and PHP extensions
RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    git \
    libzip-dev \
    && docker-php-ext-install pdo_mysql zip

# 3. Enable Apache mod_rewrite (Required for Laravel)
RUN a2enmod rewrite

# 4. Set the document root to /public (Standard for Laravel)
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf -e 's!AllowOverride None!AllowOverride All!g'

# 5. Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 6. Set working directory
WORKDIR /var/www/html

# 7. Copy project files
COPY . .

# 8. Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# 9. Set permissions for Laravel storage
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 10. Expose Port 80 (Render's default)
EXPOSE 80