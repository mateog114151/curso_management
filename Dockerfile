# Usa una imagen oficial de PHP con extensiones necesarias
FROM php:8.2-fpm

# Instala dependencias del sistema
RUN apt-get update && apt-get install -y \
    git zip unzip curl libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia archivos al contenedor
COPY . /var/www/html

WORKDIR /var/www/html

# Instala dependencias PHP
RUN composer install --prefer-dist --no-dev -o

# Prepara la app Laravel
RUN php artisan key:generate --force && \
    php artisan storage:link && \
    php artisan migrate --force

# Expone el puerto
EXPOSE 8000

# Comando por defecto
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
