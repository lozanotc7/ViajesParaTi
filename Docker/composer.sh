#!/bin/bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"

HASH="$(wget -q -O - https://composer.github.io/installer.sig)"

php composer-setup.php --install-dir=/usr/local/bin --filename=composer
