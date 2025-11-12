# Imagen base de PHP con Composer y extensiones
FROM php:8.2-apache

# Instala dependencias del sistema
RUN apt-get update && apt-get install -y \
    git zip unzip libpng-dev libonig-dev libxml2-dev curl && \
    docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Copia los archivos del proyecto al contenedor
WORKDIR /var/www/html
COPY . .

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Genera la clave de aplicación
RUN php artisan key:generate

# Expone el puerto 8080
EXPOSE 8080

# Comando para ejecutar Laravel en modo producción
CMD php artisan serve --host=0.0.0.0 --port=8080
