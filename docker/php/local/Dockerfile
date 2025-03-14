FROM php:8.3-fpm-alpine

ARG PHP_EXT_DEPS="linux-headers oniguruma-dev libxml2-dev freetype-dev libjpeg-turbo-dev libpng-dev"

RUN apk add --no-cache $PHPIZE_DEPS $PHP_EXT_DEPS \
        libzip-dev \
        libpq-dev \
        freetype \
        libjpeg-turbo && \
    docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg && \
    docker-php-ext-install exif pdo zip bcmath dom mbstring xml xmlwriter gd && \
    apk del $PHPIZE_DEPS $PHP_EXT_DEPS && \
    rm -rf /tmp/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app
