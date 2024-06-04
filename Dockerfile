# Usa una imagen de PHP como base
FROM php:8.1-fpm

# Instala las dependencias necesarias
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Copia el código de tu aplicación al contenedor
COPY . /var/www/html

# Instala las dependencias de Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install

# Expón el puerto 8000 (puedes cambiarlo según tu configuración)
EXPOSE 8000

# Ejecuta tu aplicación Laravel
CMD ["/start.sh"]
