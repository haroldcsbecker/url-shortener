FROM ubuntu:18.04

ENV LC_ALL=C
ENV LANG en_US.UTF-8
ENV LANG_ALL en_US.UTF-8

ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data

RUN apt update && apt install composer
RUN apt update && apt -y install apt-transport-https software-properties-common vim curl sudo

RUN sudo add-apt-repository ppa:ondrej/php \
    && apt update \
    && apt -y install php7.4 \
    php7.4-fpm \
    php7.4-json \
    php7.4-pdo \
    php7.4-mysql \
    php7.4-zip \
    php7.4-mbstring \
    php7.4-curl \
    php7.4-xml \
    php7.4-bcmath \
    php7.4-json

RUN sudo add-apt-repository ppa:ondrej/apache2 \
    && apt-get update \
    && apt-get install -y apache2 libapache2-mod-php7.4 \
    && a2enmod headers \
    && a2enmod rewrite \
    && a2enmod http2 \
    && a2enmod ssl \
    && apt-get -y autoremove

VOLUME [ "/var/www/html" ]
WORKDIR /var/www/html

EXPOSE 80

ENTRYPOINT [ "/usr/sbin/apache2" ]
CMD ["-D", "FOREGROUND"]
