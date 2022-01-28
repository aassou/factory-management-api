# YARN and NODE
curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | sudo apt-key add -

echo "deb https://dl.yarnpkg.com/debian/ stable main" | sudo tee /etc/apt/sources.list.d/yarn.list

sudo apt update

sudo apt install yarn -y

# PHP 

sudo apt install software-properties-common -y

sudo add-apt-repository ppa:ondrej/php -y

sudo apt update

sudo apt install php8.0-cli unzip -y

sudo apt install php8.0-fpm -y

sudo apt install php8.0-mysql php8.0-gd php8.0-xml php8.0-mbstring -y

sudo apt install nginx -y

sudo ufw enable

sudo ufw allow 'Nginx HTTP'

# Composer

cd ~

curl -sS https://getcomposer.org/installer -o /tmp/composer-setup.php

HASH=`curl -sS https://composer.github.io/installer.sig`

echo $HASH

php -r "if (hash_file('SHA384', '/tmp/composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"

sudo php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer

# MySQL

sudo apt install mysql-server -y

sudo mysql_secure_installation
