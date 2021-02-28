FROM php:7.4.15-fpm-alpine3.13

RUN apk update
RUN apk --no-cache add build-base autoconf
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug