# describe the image for php8 with mysql
FROM php:8.0.0-fpm

# install the PHP extensions we need
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
EXPOSE 9000
