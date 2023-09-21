# Usamos una imagen base de PHP desde Docker Hub con Apache
FROM php:7.4-apache

# Actualizamos los paquetes del sistema y instalamos algunas extensiones de PHP necesarias
RUN apt-get update && \
    apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd mysqli pdo pdo_mysql

# Instalamos Node.js y npm para JS
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash - \
    && apt-get install -y nodejs

# Instalamos el controlador PDO de PostgreSQL para PHP
RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo_pgsql

# Establecemos el directorio de trabajo en el servidor web de Apache
WORKDIR /var/www/html

# Copiamos los archivos de tu aplicación PHP al contenedor
COPY . .

# Exponemos el puerto 80 para que Apache pueda recibir solicitudes web
EXPOSE 80

# Comando para ejecutar Apache y servir la aplicación PHP
CMD ["apache2-foreground"]
