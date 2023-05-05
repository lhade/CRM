# Base image
FROM php:8.1.0-fpm-alpine

RUN set -ex \
  && apk --no-cache add \
    postgresql-dev

# Install dependencies
RUN docker-php-ext-install pdo pdo_pgsql sockets

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

# composer
COPY --from=composer:2.5.5 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY ./symfony .

# CMD 
RUN composer install