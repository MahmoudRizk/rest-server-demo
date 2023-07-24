FROM php:8.1.9-fpm-alpine

WORKDIR /var/www/

# Install alpine packages
RUN apk add --no-cache --update \
    libzip-dev \
    libxml2-dev \
    libpng-dev \
    jpeg-dev \
    freetype-dev \
    libjpeg-turbo \
    libmcrypt-dev \
    autoconf \
    g++ \
    gcc

RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg

# Install php extensions
RUN docker-php-ext-install \
    pdo_mysql \
    zip \
    xml \
    gd \
    exif

# Install composer dependencies
COPY --chown=www-data:www-data .env /var/www/.env

# Install composer and install packages
COPY --chown=www-data:www-data ./composer.lock ./composer.json /var/www/
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-scripts --no-autoloader
# Copy existing application directory contents
COPY --chown=www-data:www-data . .

RUN composer dumpautoload -o
RUN composer run-script post-autoload-dump

RUN php artisan optimize:clear

USER www-data
