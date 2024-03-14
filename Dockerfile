FROM php:8.3

# Update packages and install dependencies
RUN apt-get update && \
    apt-get install -y --no-install-recommends git curl libmcrypt-dev libjpeg-dev libpng-dev libfreetype6-dev libbz2-dev libzip-dev && \
    rm -rf /var/lib/apt/lists/*

# Install needed extensions
RUN docker-php-ext-install pdo_mysql zip

# Install Composer
RUN curl --silent --show-error "https://getcomposer.org/installer" | php -- --install-dir=/usr/local/bin --filename=composer

# Install Laravel Envoy
RUN composer global require "laravel/envoy=~1.0"
