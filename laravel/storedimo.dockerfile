FROM debian:11
ENV TZ="America/Bogota"
RUN apt update 
RUN apt upgrade -y
RUN apt-get install -y apache2 
RUN apt-get install -y apache2-utils 
RUN apt-get install -y wget 
RUN apt-get clean 
RUN apt -y install lsb-release apt-transport-https ca-certificates
RUN wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg
RUN echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | tee /etc/apt/sources.list.d/php.list
RUN apt update 
RUN apt-get install -y curl
RUN apt-get install -y composer
RUN apt-get install -y php8.2
RUN apt-get install -y php8.2-cli
RUN apt-get install -y php8.2-common
RUN apt-get install -y php8.2-curl
RUN apt-get install -y php8.2-dev
RUN apt-get install -y php8.2-gd
RUN apt-get install -y php8.2-mbstring
RUN apt-get install -y php8.2-odbc
RUN apt-get install -y php8.2-opcache
RUN apt-get install -y php8.2-pgsql
RUN apt-get install -y php8.2-pdo php8.2-mysql
RUN apt-get install -y php8.2-readline
RUN apt-get install -y php8.2-sybase
RUN apt-get install -y php8.2-xml
RUN apt-get install -y php8.2-zip
RUN apt-get install -y libapache2-mod-php8.2
RUN apt-get install -y php8.2-common
RUN apt-get install -y php8.2-xml
RUN apt-get install -y wkhtmltopdf
RUN apt-get install -y nano
RUN apt-get install -y vim
RUN apt-get remove -y php8.3.*
RUN apt-get update

EXPOSE 80 8000

RUN rm -rf /var/www/html/*
RUN rm -rf /etc/apache2/sites-available/000-default.conf
RUN rm -rf /etc/apache2/apache2.conf
RUN rm -rf /etc/php/8.2/apache2/php.ini
ARG CACHE_BUST=1
COPY ./laravel/config_apache/000-default.conf /etc/apache2/sites-available/
COPY ./laravel/config_apache/apache2.conf /etc/apache2/
COPY ./laravel/config_php/php.ini /etc/php/8.2/apache2/

RUN chmod -Rvc 777 /var/www/html
WORKDIR /var/www/html/

RUN a2enmod rewrite
RUN service apache2 restart

CMD ["apache2ctl", "-D", "FOREGROUND"]