FROM php:8.1-fpm-alpine3.16@sha256:e4fa9ffad6bfee2d988982a9164362232f3c9af570fc6e1ca04bd534c48e62b5

RUN apk add $PHPIZE_DEPS --no-cache openssl postgresql-dev bash \
    && pecl install xdebug redis \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-install pdo pdo_pgsql \
    && docker-php-ext-enable redis

WORKDIR /var/www

RUN rm -rf /var/www/html
RUN ln -s public html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ADD . /var/www

RUN chown -R www-data:www-data /var/www

EXPOSE 9000

CMD ["php-fpm"]
