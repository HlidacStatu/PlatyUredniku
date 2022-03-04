FROM php:7.4-apache

RUN apt update && apt -y upgrade
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN a2enmod rewrite

COPY ./php.ini /usr/local/etc/php/php.ini
COPY ./src /var/www/html/
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
