FROM php:8.0-cli

RUN apt-get update
RUN apt-get install curl \
    && apt-get install git -y
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
