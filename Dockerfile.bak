# syntax=docker/dockerfile:1

FROM php:8.2-cli

# Outils + extensions PHP (MySQL). Si tu es en Postgres, vois plus bas.
RUN apt-get update \
 && apt-get install -y git unzip libzip-dev \
 && docker-php-ext-install pdo_mysql opcache

# Installer Composer (copié depuis l'image officielle)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Étape séparée pour profiter du cache Docker
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# Copier le reste du code
COPY . .

# Expose le port HTTP interne
EXPOSE 10000

# Démarre le serveur PHP intégré en servant /public (router = index.php)
CMD ["php", "-S", "0.0.0.0:10000", "-t", "public", "public/index.php"]
