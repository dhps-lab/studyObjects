FROM php:7.4-apache

RUN a2enmod rewrite
COPY apacheconf.conf /usr/local/apache2/sites-enabled/000-default.conf
RUN service apache2 restart
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli pdo_mysql curl
RUN export APACHE_LOG_DIR=/var/www/html/logs/
