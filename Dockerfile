# Usa la imagen oficial de PHP 8.3 con Apache
FROM php:8.3-apache

# Instala dependencias del sistema necesarias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo_mysql zip exif pcntl bcmath

# Habilita el módulo de reescritura de Apache
RUN a2enmod rewrite

# Copia todos los archivos del proyecto al contenedor
WORKDIR /var/www/html
COPY . .

# Copia Composer desde la imagen oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instala dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# Genera la clave de aplicación
# RUN php artisan key:generate

# Cambia permisos para el almacenamiento y caché
RUN chmod -R 775 storage bootstrap/cache

# Expone el puerto 80
EXPOSE 80

# Comando por defecto
CMD ["apache2-foreground"]
