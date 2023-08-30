### // Crear IMAGEN 
### 	docker build -t <IMAGE_NAME> <PATH>
### 	docker build -t symfony4 .
### 
### // Arrancar imagenes
### 	docker run -d --name <CONTAINER_NAME> -p 80:80 <IMAGE_NAME>
### 	docker run -d --name ViajesParaTi -p 80:80 symfony4
### 	docker run -d --name testContainer -p 80:80 test
###
### // Acceder al contenedor
###     docker exec -ti <CONTAINER_NAME> /bin/bash
###     docker exec -ti ViajesParaTi /bin/bash

FROM ubuntu:22.04
MAINTAINER Acobur Asesores <francisco.texeira@acobur.es>


# Environments vars
ENV TERM=xterm
ARG DEBIAN_FRONTEND=noninteractive


# update & upgrade
RUN apt-get update
RUN apt-get -y upgrade

#dependency packages and repo for php 8
RUN apt install -y apt-transport-https 
RUN apt install -y ca-certificates 
RUN apt install -y gnupg2 
RUN apt install -y lsb-release
RUN apt install -y software-properties-common
RUN add-apt-repository ppa:ondrej/php -y

# installation
RUN apt install -y --fix-missing apache2

RUN apt install -y php7.4
RUN apt install -y php-cli
RUN apt install -y php-imagick
RUN apt install -y php-pear
RUN apt install -y php-xdebug 
RUN apt install -y php-zip
RUN apt install -y php7.4-apcu
RUN apt install -y php7.4-curl
RUN apt install -y php7.4-fpm
RUN apt install -y php7.4-gd
RUN apt install -y php7.4-imap
RUN apt install -y php7.4-intl
RUN apt install -y php7.4-mysql
RUN apt install -y php7.4-xml
RUN apt install -y php7.4-zip
# php7.4-dev libmcrypt-dev

# force php 7.4
RUN rm /etc/alternatives/php
RUN update-alternatives --install /usr/bin/php php /usr/bin/php7.4 101
RUN service apache2 restart

# install other components
RUN apt install -y curl
RUN apt install -y git
RUN apt install -y nano
RUN apt install -y phpunit
RUN apt install -y unzip
RUN apt install -y vim
RUN apt install -y wget

RUN apt install -y libapache2-mod-php7.4

RUN a2enmod rewrite
RUN phpenmod mcrypt



# Add Init
ADD init.sh /init.sh
RUN chmod 755 /init.sh


# composer installation
ADD composer.sh /composer.sh
RUN chmod 755 /composer.sh
RUN /./composer.sh


# project installation
ADD projectInstall.sh /projectInstall.sh
RUN chmod 755 /projectInstall.sh
RUN /./projectInstall.sh


# update apache site and restart
ADD 000-default.conf /etc/apache2/sites-enabled/000-default.conf
RUN chown -R www-data:www-data /var/www
RUN service apache2 restart


WORKDIR /var/www/
VOLUME /var/www/html
EXPOSE 80

ENTRYPOINT ["/init.sh"]