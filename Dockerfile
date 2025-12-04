# Dockerfile
FROM php:8.2-fpm

# Install system dependencies needed for extensions (libssl-dev for mongodb)
RUN apt-get update && \
    apt-get install -y \
        libssl-dev \
        pkg-config \
        libzip-dev \
        unzip \
        git \
    && rm -rf /var/lib/apt/lists/*

# Install and enable 'zip' and 'mongodb' extensions
# Use a specific version for better stability (e.g., mongodb-2.1.4 for PHP 8.2)
# The PECL installation creates the 'mongodb.so' file.
RUN docker-php-ext-install zip && \
    pecl install mongodb-2.1.4 && \
    docker-php-ext-enable mongodb

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory for the application
WORKDIR /var/www/html