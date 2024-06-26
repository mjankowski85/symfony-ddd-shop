FROM php:8.2-fpm-alpine as php
COPY docker/php-fpm/php.ini /usr/local/etc/php/conf.d/99-overrides.ini.template
COPY docker/php-fpm/www.conf /usr/local/etc/php-fpm.d/www.conf.template
RUN apk update && apk add ca-certificates && apk add busybox-suid libcap && setcap cap_setgid=ep /bin/busybox; \
update-ca-certificates;
RUN set -eux; \
mkdir /opt/app/;
EXPOSE 9000
WORKDIR /opt/app/

FROM php as builder
RUN apk update
RUN apk --no-cache add curl
ENV COMPOSER_ALLOW_SUPERUSER=1
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN set -eux; \
composer clear-cache
ENV PATH="${PATH}:/root/.composer/vendor/bin"
CMD ["php-fpm"]

FROM builder as php_app_dev
ARG USER_ID=1000
ARG GROUP_ID=1000
ARG USER_NAME=dev
ARG GROUP_NAME=dev

RUN addgroup -g $GROUP_ID $GROUP_NAME && \
    adduser --shell /sbin/nologin --disabled-password --uid $USER_ID --ingroup $GROUP_NAME $USER_NAME; \
    chown -R $USER_NAME:$GROUP_NAME $HOME/.composer

RUN apk --update --no-cache add autoconf linux-headers g++ make && \
  pecl install -f xdebug && \
  docker-php-ext-enable xdebug && \
  apk del --purge autoconf g++ make
COPY docker/php-fpm/xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
USER $USER_NAME
