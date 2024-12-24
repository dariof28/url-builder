# Dockerfile

# Immagine base PHP con Composer
FROM php:8.1-cli

# Aggiorna pacchetti e installa le dipendenze necessarie
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && docker-php-ext-install zip

# Installa Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Installa Xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Configura Xdebug per remote debugging
RUN echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_port=9003" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Imposta la directory di lavoro nel container
WORKDIR /app

# Copia il contenuto della directory locale nella directory di lavoro
COPY . /app
