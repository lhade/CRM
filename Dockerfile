# Base image
FROM php:8.1.0-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    unzip \
    git \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl pdo_mysql zip opcache \
    && pecl install apcu \
    && docker-php-ext-enable apcu opcache

# composer
COPY --from=composer:2.5.5 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY ./symfony .

# Start PHP-FPM
CMD composer install; -- bin/console doctrine:migrations:migrate; php-fpm

# Expose port 9000 for PHP-FPM
EXPOSE 9000