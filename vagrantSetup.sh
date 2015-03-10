#!/usr/bin/env bash

apt-get update;

#preparation for php5.6
apt-get install -y python-software-properties;
add-apt-repository ppa:ondrej/php5-5.6;
apt-get update;
#apt-get dist-upgrade;
#----------------------

echo "##########Installing mc##########";
apt-get install -y mc;
apt-get install -y git;
apt-get install -y php5;
apt-get install -y php5-mcrypt;

#apt-get install -y apache2;
if ! [ -L /var/www/html ]; then
  rm -rf /var/www/html;
  ln -fs /vagrant/www/public /var/www/html;
  cd /vagrant/www;
  php ../composer/composer.phar install;
  sudo /etc/init.d/apache2 restart;
fi