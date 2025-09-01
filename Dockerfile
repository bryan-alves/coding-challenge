# PHP + Node para Laravel + Vite
FROM php:8.2-fpm

# Instalar dependências do sistema e PHP
RUN apt-get update && apt-get install -y \
    git zip unzip libpng-dev libonig-dev libxml2-dev curl npm \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Definir diretório de trabalho
WORKDIR /var/www/html

# Copiar package.json e package-lock.json e instalar dependências Node
COPY package*.json ./
RUN npm install

# Copiar restante do projeto Laravel
COPY . .