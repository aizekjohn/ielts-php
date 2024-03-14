FROM php:8.3

# Update packages and install dependencies
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        git \
        curl \
        libmcrypt-dev \
        libjpeg-dev \
        libpng-dev \
        libfreetype6-dev \
        libbz2-dev \
        libzip-dev \
        libicu-dev \
        zlib1g-dev \
        postgresql-client \
        libpq-dev \
    && rm -rf /var/lib/apt/lists/*

# Install intl extension
RUN docker-php-ext-configure intl \
    && docker-php-ext-install intl pdo_pgsql zip

# Install Composer
RUN curl --silent --show-error "https://getcomposer.org/installer" | php -- --install-dir=/usr/local/bin --filename=composer

# Install Laravel Envoy
RUN composer global require "laravel/envoy=~1.0"

# Add Composer global bin directory to PATH
ENV PATH "$PATH:/root/.composer/vendor/bin"
