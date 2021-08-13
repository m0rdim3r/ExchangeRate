FROM php:7.4-fpm

RUN apt update && apt-get install -y nano git iputils-ping
RUN docker-php-ext-install pdo_mysql

COPY php.ini /usr/local/etc/php/php.ini

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN usermod -u 1000 www-data && groupmod -g 1000 www-data

COPY symfony.sh /usr/local/bin/_symfony
RUN chmod +x /usr/local/bin/_symfony

COPY composer.sh /usr/local/bin/_composer
RUN chmod +x /usr/local/bin/_composer

WORKDIR /var/www

EXPOSE 9000