# Etapa 1: Dependencias de PHP y Apache
FROM php:8.3-apache

# Instala extensiones necesarias
RUN apt-get update && apt-get install -y \
    git unzip libpng-dev libjpeg-dev libfreetype6-dev libzip-dev zip && \
    docker-php-ext-install pdo pdo_mysql gd zip && \
    a2enmod rewrite

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Copia el código del proyecto
COPY . .

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instala las dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# Genera la APP_KEY si no existe
RUN php artisan key:generate --force || true

# Permisos necesarios
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Configura Apache para servir desde /public
RUN echo '<VirtualHost *:80>\n\
    ServerName localhost\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# Expone el puerto
EXPOSE 80

# Inicia Apache
CMD ["apache2-foreground"]
