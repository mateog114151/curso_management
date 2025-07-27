FROM php:8.2-fpm

# Dependencias
RUN apt-get update && apt-get install -y \
    git zip unzip curl libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia código
COPY . /var/www/html
WORKDIR /var/www/html

# Instala dependencias PHP
RUN composer install --prefer-dist --no-dev -o

# Copia el script de entrada
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Expone el puerto
EXPOSE 8000

# Comando por defecto
CMD ["/entrypoint.sh"]
