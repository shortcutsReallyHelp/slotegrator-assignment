# describe the image for php8 with mysql
FROM php:8.0.0-fpm

WORKDIR /var/www

RUN apt update
RUN apt install -y git zip unzip wget

# install pdo mysql
RUN docker-php-ext-install pdo_mysql

RUN pecl install -o -f redis && docker-php-ext-enable redis

RUN curl -s https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

RUN wget https://github.com/ddosify/ddosify/releases/latest/download/ddosify_amd64.deb
RUN dpkg -i ddosify_amd64.deb

CMD ["php-fpm"]

EXPOSE 9000
