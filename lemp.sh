# YARN and NODE
curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | sudo apt-key add -

echo "deb https://dl.yarnpkg.com/debian/ stable main" | sudo tee /etc/apt/sources.list.d/yarn.list

sudo apt update

sudo apt install yarn -y

# PHP 

sudo apt install software-properties-common -y

sudo add-apt-repository ppa:ondrej/php -y

sudo apt update

sudo apt install unzip php8.0-cli php8.0-common php8.0-mysql php8.0-fpm php8.0-gd php8.0-xml php8.0-mbstring -y

sudo apt install nginx -y

sudo ufw enable

sudo ufw allow 'Nginx HTTP'

# Composer

curl -sS https://getcomposer.org/installer -o /tmp/composer-setup.php

sudo php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer

# MySQL

sudo apt install mysql-server -y

sudo mysql_secure_installation
