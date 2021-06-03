FROM php:8.0.3-cli-alpine

RUN apk update && apk add curl git wget

RUN apk add --update --no-cache --virtual .build-dependencies $PHPIZE_DEPS

RUN pecl update-channels

RUN docker-php-ext-install bcmath sockets opcache && docker-php-ext-enable opcache && pecl install apcu && docker-php-ext-enable apcu && pecl install pcov && docker-php-ext-enable pcov

WORKDIR /usr/local/etc/php/conf.d/

COPY docker/config/php-cli/php.ini .

WORKDIR /var/www/html

RUN chown -R www-data:www-data /var/www/html

COPY . .

ENTRYPOINT [ "php"]