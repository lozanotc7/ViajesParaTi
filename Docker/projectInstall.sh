#!/bin/bash

echo 'cd var-www-html'
cd /var/www/html

echo 'git clone'
git clone https://github.com/lozanotc7/ViajesParaTi.git

echo 'cd var-www-html-ViajesParaTi'
cd /var/www/html/ViajesParaTi

echo 'composer install'
composer install --no-interaction

###echo 'create database and tables'
###php bin/console doctrine:database:create
###php bin/console doctrine:schema:update --force
###
###echo "insert tipo rows"
###php bin/console doctrine:query:sql "insert into tipo (name) values ('hotel'), ('pista'), ('complemento')"

