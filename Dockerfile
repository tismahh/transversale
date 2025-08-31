# syntax=docker/dockerfile:1
FROM php:8.2-cli

ENV APP_ENV=prod \
    COMPOSER_ALLOW_SUPERUSER=1

RUN apt-get update \
 && apt-get install -y git unzip libzip-dev \
 && docker-php-ext-install pdo_mysql zip opcache \
 && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
WORKDIR /app

# 1) Dépendances sans scripts (bin/console pas encore là)
COPY composer.json composer.lock symfony.lock* ./
RUN composer install --no-dev --no-scripts --prefer-dist --no-interaction

# 2) Copie du reste du code (bin/console arrive maintenant)
COPY . .

# 3) Deuxième passe pour exécuter les auto-scripts proprement
RUN composer install --no-dev --optimize-autoloader --prefer-dist --no-interaction

RUN mkdir -p var/cache var/log && chmod -R 777 var

EXPOSE 10000
CMD ["php","-S","0.0.0.0:10000","-t","public","public/index.php"]
