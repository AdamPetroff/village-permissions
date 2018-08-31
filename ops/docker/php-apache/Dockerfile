FROM php:7.1-apache

RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_mysql

RUN a2enmod rewrite