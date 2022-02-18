FROM php:7.4-fpm

COPY /composer.json /composer.lock /var/www/novs/
# Install system dependencies
RUN apt-get update && apt-get install -y \
        git \
        curl \
        libpng-dev \
        libonig-dev \
        libxml2-dev \
        zip \
        libzip-dev \
        unzip \
        nodejs \
        npm \
        mc

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip mysqli pdo sockets
RUN docker-php-ext-configure zip

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/novs

RUN chmod /var/www/novs/storage/logs
