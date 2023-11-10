# Usa una imagen de PHP 7.0 como base
FROM php:7.0-apache

# Habilita el módulo de Apache para Rewrite (necesario para CodeIgniter)
RUN a2enmod rewrite

# Instala las extensiones de PHP necesarias para CodeIgniter y MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Establece el directorio de trabajo dentro del contenedor
WORKDIR /var/www/html

# Copia los archivos de tu proyecto a la imagen
COPY . /var/www/html

# Cambia los permisos si es necesario (esto puede variar según tu proyecto)
# RUN chown -R www-data:www-data /var/www/html
# RUN useradd -ms /bin/bash www-data
RUN chown -R www-data:www-data /var/www/html
RUN chmod 755 /var/www/html
USER www-data

# Expon el puerto 80 para que se pueda acceder a través del navegador
EXPOSE 80

# Opcional: si necesitas configuraciones adicionales de PHP, puedes copiar un archivo php.ini personalizado
# COPY php.ini /usr/local/etc/php/conf.d/

# Opcional: si necesitas importar una base de datos al inicio, puedes hacerlo aquí
# COPY database.sql /docker-entrypoint-initdb.d/

# Ejecuta Apache al iniciar el contenedor
CMD ["apache2-foreground"]
