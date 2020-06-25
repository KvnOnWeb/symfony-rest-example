FROM php:7.4-fpm

# Update
RUN apt update

# Install recommended extensions for Symfony
RUN apt-get install -y \
        apt-utils \
        libicu-dev \
        git \
        vim \
        zsh \
        autoconf \
        openssl \
        wget \
        vim \
        alien \
        libzip-dev \
        zip \
        libfontconfig1 \
        libxrender1 \
        libssh2-1-dev libssh2-1

RUN docker-php-ext-configure zip && docker-php-ext-install zip && docker-php-ext-install bcmath

RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo && docker-php-ext-install pdo_pgsql

# install xdebug
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

# Add Git credential store
#ADD git.store /root
#RUN git config --global credential.helper 'store --file /root/git.store'
RUN git config --global http.sslVerify false

WORKDIR /code