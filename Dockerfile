FROM php:8.2-apache

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    curl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establece el nuevo DocumentRoot
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Habilitar el módulo rewrite de Apache para Laravel
RUN a2enmod rewrite

# Crear y establecer directorio de trabajo
WORKDIR /var/www/html

# Copiar archivos del proyecto
COPY ./project .

# Instalar dependencias de PHP
RUN composer install

# Permisos para Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Exponer puerto 80 para Apache
EXPOSE 80

# Iniciar Apache
CMD ["apache2-foreground"]
