FROM php:8.2.30-apache-trixie

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        libz-dev \
        libmemcached-dev \
    && pecl install memcached \
    && pecl install memcache \
    && docker-php-ext-enable memcached memcache \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*
