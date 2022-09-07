# describe the image for php8 with mysql
FROM php:8.0.0-fpm

RUN apt update
RUN apt install -y git zip unzip

# install the PHP extensions we need
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

RUN pecl install -o -f redis && docker-php-ext-enable redis

RUN curl -s https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

CMD ["php-fpm"]

EXPOSE 9000
