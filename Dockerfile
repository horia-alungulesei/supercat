FROM php:8.4-apache
ADD ./src /var/www/html

RUN apt update -y && apt upgrade -y
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

RUN useradd -m appuser
USER appuser
