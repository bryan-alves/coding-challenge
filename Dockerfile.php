# PHP + extensões para Laravel
FROM php:8.2-fpm

# Instalar dependências do sistema e PHP
RUN apt-get update && apt-get install -y \
    git zip unzip libpng-dev libonig-dev libxml2-dev curl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Definir diretório de trabalho
WORKDIR /var/www/html

# Copiar composer.json e instalar dependências PHP
COPY composer.json composer.lock ./
RUN composer install --no-scripts --no-autoloader || true

# Copiar projeto inteiro
COPY . .

# Instalar autoloader otimizado
RUN composer dump-autoload --optimize
