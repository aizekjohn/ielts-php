# Set the base image for subsequent instructions
FROM php:8.3-alpine

# Update packages and install dependencies
RUN apk update && \
    apk add --no-cache git curl libmcrypt-dev libjpeg-turbo-dev libpng-dev freetype-dev libbz2 libzip-dev

# Install needed extensions
RUN docker-php-ext-install pdo_mysql zip

# Install Composer
RUN curl --silent --show-error "https://getcomposer.org/installer" | php -- --install-dir=/usr/local/bin --filename=composer

# Install Laravel Envoy
RUN composer global require "laravel/envoy=~1.0"
