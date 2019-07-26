FROM php:5.6-apache
RUN a2enmod rewrite
RUN docker-php-ext-install mysqli

RUN echo "date.timezone = Europe/Prague" > /usr/local/etc/php/conf.d/timezone.ini