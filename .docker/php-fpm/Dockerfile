FROM php:7.2-fpm

ENV PHP_INI_DIR=/usr/local/etc/php
ENV PHP_WWW_DIR=//usr/local/etc/php-fpm.d/

RUN apt-get update && apt-get install -y \
        libfreetype6-dev libjpeg62-turbo-dev libpng-dev \
        mc pkg-config build-essential librabbitmq-dev libpq-dev wkhtmltopdf libxml2-dev \
    && apt-get clean -y \
    && docker-php-ext-install -j$(nproc) iconv pdo pdo_mysql pdo_pgsql pcntl bcmath zip soap sockets \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb \
    && pecl install amqp \
    && docker-php-ext-enable amqp \
    && pecl install -o -f redis \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable redis \
    && mkdir -p /usr/local/var/tmp \
    && mkdir /.config \
    && chmod 777 /.config /usr/local/var/tmp

COPY conf/php-fpm.ini $PHP_INI_DIR/php.ini
COPY conf/www.conf $PHP_WWW_DIR/www.conf
COPY . /app

RUN chmod 0777 -R /app \
    && chown www-data:www-data -R /app

WORKDIR /app



