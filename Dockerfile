# Usa una imagen oficial de PHP con Apache
FROM php:8.3-apache

# Instala extensiones requeridas para Laravel
RUN apt-get update && apt-get install -y \
    zip unzip git libpng-dev libjpeg-dev libfreetype6-dev libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql gd zip

# Habilita mod_rewrite para Laravel
RUN a2enmod rewrite

# Copia los archivos del proyecto al contenedor
WORKDIR /var/www/html
COPY . .

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Genera la APP_KEY automáticamente (si no existe)
RUN php artisan key:generate --force

# Cambia permisos para storage y bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

# Configura Apache para servir desde /public
RUN echo "<VirtualHost *:80>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
</VirtualHost>" > /etc/apache2/sites-available/000-default.conf

# Exponer el puerto
EXPOSE 80

# Inicia Apache
CMD ["apache2-foreground"]
