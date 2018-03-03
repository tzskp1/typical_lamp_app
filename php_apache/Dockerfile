FROM php:7.0-apache
ADD src/html /var/www/html
RUN apt-get update \
    && docker-php-ext-install pdo_mysql \
    && rm -rf /var/lib/apt/lists/*