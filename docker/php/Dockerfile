FROM php:7.3-fpm

RUN apt-get update -y
RUN apt-get install libsodium-dev -y
RUN apt-get install nano -y
RUN apt-get install libpng-dev -y
RUN docker-php-ext-install pdo pdo_mysql sodium gd pcntl

RUN pecl install -o -f redis \
&&  rm -rf /tmp/pear \
&&  echo "extension=redis.so" > /usr/local/etc/php/conf.d/redis.ini

RUN apt-get install -y cron

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ADD schedule/crontab /etc/cron.d/cron

RUN chmod 0644 /etc/cron.d/cron

RUN touch /var/log/cron.log

CMD printenv > /etc/environment && echo "cron starting..." && (cron) && : > /var/log/cron.log && tail -f /var/log/cron.log ; crontab /etc/cron.d/cron