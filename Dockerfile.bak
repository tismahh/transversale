# syntax=docker/dockerfile:1
FROM php:8.2-cli

# Autorise composer à tourner en root + mode prod
ENV APP_ENV=prod \
    COMPOSER_ALLOW_SUPERUSER=1

# Outils + extensions PHP (MariaDB/MySQL)
RUN apt-get update \
 && apt-get install -y git unzip libzip-dev \
 && docker-php-ext-install pdo_mysql zip opcache \
 && rm -rf /var/lib/apt/lists/*

# Composer depuis l'image officielle
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copie d'abord les manifests pour profiter du cache
COPY composer.json composer.lock symfony.lock* ./

# ⚠ Plugins actifs grâce à COMPOSER_ALLOW_SUPERUSER=1
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# Puis le reste du code
COPY . .

# Dossiers runtime
RUN mkdir -p var/cache var/log && chmod -R 777 var

EXPOSE 10000
CMD ["php","-S","0.0.0.0:10000","-t","public","public/index.php"]
