FROM php:8.0-fpm

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
RUN alias composer="php -n /usr/local/bin/composer"

ARG PROJECT_ROOT="/var/www"
ENV PROJECT_ROOT=${PROJECT_ROOT}

# Install dependencies
RUN apt-get update && apt-get install -y vim
RUN apt-get install -y \
      zlib1g-dev \
      libzip-dev \
      unzip
RUN docker-php-ext-install zip

# Install Npm
RUN apt-get update
RUN apt-get -y install curl gnupg
RUN curl -sL https://deb.nodesource.com/setup_12.x  | bash -
RUN apt-get -y install nodejs

WORKDIR ${PROJECT_ROOT}

COPY ./ ${PROJECT_ROOT}

RUN chown -R www-data:www-data /var/www
