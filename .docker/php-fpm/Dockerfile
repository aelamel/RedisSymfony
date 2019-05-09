FROM php:7.1-fpm

RUN apt-get update && apt-get install -y \
    coreutils \
    make \
    curl

RUN rm -rf /var/cache/apk/* && rm -rf /tmp/* && \
    echo "$(curl -sS https://composer.github.io/installer.sig) -" > composer-setup.php.sig \
        && curl -sS https://getcomposer.org/installer | tee composer-setup.php | sha384sum -c composer-setup.php.sig \
        && php composer-setup.php && rm composer-setup.php* \
        && chmod +x composer.phar && mv composer.phar /usr/bin/composer

RUN pecl install redis-3.1.6
RUN docker-php-ext-enable redis

RUN echo 'alias ll="ls -ltr"' >> ~/.bashrc

ADD symfony.ini /etc/php7/conf.d/
ADD symfony.ini /etc/php7/cli/conf.d/
#ADD xdebug.ini  /etc/php7/conf.d/

ADD symfony.pool.conf /etc/php7/php-fpm.d/

CMD ["php-fpm", "-F"]

WORKDIR /var/www/app
EXPOSE 9001
