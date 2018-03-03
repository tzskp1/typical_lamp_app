FROM php:7.0-apache
ARG MYSQL_PASSWORD
ARG MYSQL_USER
ADD src/html /var/www/html
ADD src/include /usr/local/lib/php
RUN sed -i -e "s/PASS_GRzFZRcwng/$MYSQL_PASSWORD/" /usr/local/lib/php/config.php
RUN sed -i -e "s/USER_QSzaADdHtL/$MYSQL_USER/" /usr/local/lib/php/config.php

RUN apt-get update \
    && docker-php-ext-install pdo_mysql \
    && rm -rf /var/lib/apt/lists/*