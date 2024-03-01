FROM php:8.2.16-apache-bullseye

# Memcached Installation
RUN apt-get update && apt-get install -y libz-dev libmemcached-dev && rm -r /var/lib/apt/lists/*
RUN pecl install memcached
RUN echo extension=memcached.so >> /usr/local/etc/php/conf.d/memcached.ini

# Memcached Installation
RUN pecl install memcache
RUN echo extension=memcache.so >> /usr/local/etc/php/conf.d/memcache.ini
