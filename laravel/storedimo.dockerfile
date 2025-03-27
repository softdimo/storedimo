# ➤ Imagen base
FROM debian:11
ENV TZ="America/Bogota"

# ➤ Actualizar sistema
RUN apt update && apt upgrade -y

# ➤ Instalar herramientas esenciales
RUN apt-get install -y \
    apache2 apache2-utils wget curl nano vim lsb-release apt-transport-https ca-certificates

# ➤ Configurar repositorio PHP
RUN wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg
RUN echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | tee /etc/apt/sources.list.d/php.list
RUN apt update

# ➤ Instalar PHP 8.3 y extensiones necesarias
RUN apt-get install -y \
    php8.3 php8.3-cli php8.3-common php8.3-curl php8.3-dev \
    php8.3-gd php8.3-mbstring php8.3-odbc php8.3-opcache \
    php8.3-pgsql php8.3-pdo php8.3-mysql php8.3-readline \
    php8.3-sybase php8.3-xml php8.3-zip libapache2-mod-php8.3

# ➤ Instalar Composer
RUN apt-get install -y composer

# ➤ Instalar wkhtmltopdf y wkhtmltoimage
RUN apt-get install -y xfonts-75dpi xfonts-base wkhtmltopdf
RUN test -f /usr/bin/wkhtmltoimage || ln -s /usr/bin/wkhtmltopdf /usr/local/bin/wkhtmltoimage

# ➤ Instalar FPDF con Composer (ubicado en el contexto correcto)
WORKDIR /var/www/html
RUN composer require setasign/fpdf

# ➤ Limpiar paquetes innecesarios
RUN apt-get remove -y php8.2.*
RUN apt-get update && apt-get clean

# ➤ Exponer puertos
EXPOSE 80 8000

# ➤ Mantener tu configuración original
RUN rm -rf /var/www/html/*
RUN rm -rf /etc/apache2/sites-available/000-default.conf
RUN rm -rf /etc/apache2/apache2.conf
RUN rm -rf /etc/php/8.3/apache2/php.ini

# ➤ Copiar configuraciones personalizadas
ARG CACHE_BUST=1
COPY ./laravel/config_apache/000-default.conf /etc/apache2/sites-available/
COPY ./laravel/config_apache/apache2.conf /etc/apache2/
COPY ./laravel/config_php/php.ini /etc/php/8.3/apache2/

# ➤ Permisos y configuraciones finales
RUN chmod -Rvc 777 /var/www/html
WORKDIR /var/www/html/
RUN a2enmod rewrite
RUN service apache2 restart

# ➤ Iniciar Apache
CMD ["apache2ctl", "-D", "FOREGROUND"]
