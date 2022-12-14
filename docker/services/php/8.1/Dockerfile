FROM php:8.1-fpm

ARG uid
ARG user

RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    nano \
    unzip

RUN pecl config-set php_ini "${PHP_INI_DIR}/php.ini"
RUN pecl install xdebug-3.1.3

RUN useradd -G www-data,root -u  $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

USER $user