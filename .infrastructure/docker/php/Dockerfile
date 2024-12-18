FROM php:8.2-fpm

# Environment settings
ENV DEBIAN_FRONTEND=noninteractive

ENV PATH=/app:/app/vendor/bin:/root/.composer/vendor/bin:$PATH \
    COMPOSER_ALLOW_SUPERUSER=1

RUN apt-get update --fix-missing
RUN apt-get install -y build-essential libonig-dev libpq-dev
RUN apt-get install -y --no-install-recommends libzip-dev \
    git \
    supervisor \
    gnupg \
    curl \
    wget \
    apt-utils \
    libxml2-dev \
    libcurl4-openssl-dev \
    pkg-config \
    libssl-dev \
    libbson-1.0 \
    libcurl3-dev \
    openssh-client \
    procps \
    net-tools \
    unzip

RUN docker-php-ext-configure bcmath \
    && docker-php-ext-configure pcntl --enable-pcntl \
    && docker-php-ext-install zip \
      sockets \
      soap \
      curl \
      intl \
      bcmath \
      exif \
      iconv \
      mbstring \
      pdo_mysql \
      pcntl \
    && apt-get -y autoclean


RUN pecl install xdebug && docker-php-ext-enable xdebug

# Install composer
COPY --from=composer:2.7.7 /usr/bin/composer /usr/local/bin/composer

COPY php.ini /usr/local/etc/php/conf.d/php.ini

WORKDIR /app
