#!/usr/bin/env bash

DBPASSWORD='123';

apt-get update;

#preparation for php5.6
apt-get install -y python-software-properties;
add-apt-repository ppa:ondrej/php5-5.6;
apt-get update;
#apt-get dist-upgrade;
#----------------------

echo "##########Installing app##########";
apt-get install -y mc;
apt-get install -y git;
apt-get install -y php5;
apt-get install -y php5-mcrypt;
apt-get install -y php5-mysql;
apt-get install -y nodejs;
apt-get install -y npm;

####nodejs Install
apt-get install -y openjdk-7-jre;
apt-get install -y curl;
curl -sL https://deb.nodesource.com/setup | sudo bash -;
apt-get install -y nodejs;
apt-get install -y build-essential;
npm install -g npm@latest;

#mysql
debconf-set-selections <<< 'mysql-server mysql-server/root_password password $DBPASSWORD';
debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password $DBPASSWORD';
apt-get install -y mysql-server;
mysql -uroot -p123 -e "GRANT ALL PRIVILEGES ON *.* TO forge@localhost IDENTIFIED BY ''"
mysql -uroot -p123 -e "DROP DATABASE IF EXISTS \`forge\`";
mysql -uroot -p123 -e "CREATE DATABASE \`forge\` DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_unicode_ci";

#xdebug
apt-get install -y php5-dev php-pear;
sudo pecl install xdebug;
sudo echo "zend_extension=/usr/lib/php5/20131226/xdebug.so" >> /etc/php5/apache2/php.ini;
sudo echo "xdebug.remote_enable=1" >> /etc/php5/apache2/php.ini;
sudo echo "xdebug.profiler_enable=1" >> /etc/php5/apache2/php.ini;
sudo echo "xdebug.idekey=\"PHPSTORM-XDEBUG\"" >> /etc/php5/apache2/php.ini;
sudo echo "xdebug.remote_autostart=on" >> /etc/php5/apache2/php.ini;
sudo echo "xdebug.remote_connect_back=on" >> /etc/php5/apache2/php.ini;

#phpmyadmin
debconf-set-selections <<< "phpmyadmin phpmyadmin/dbconfig-install boolean true";
debconf-set-selections <<< "phpmyadmin phpmyadmin/app-password-confirm password $DBPASSWORD";
debconf-set-selections <<< "phpmyadmin phpmyadmin/mysql/admin-pass password $DBPASSWORD";
debconf-set-selections <<< "phpmyadmin phpmyadmin/mysql/app-pass password $DBPASSWORD";
debconf-set-selections <<< "phpmyadmin phpmyadmin/reconfigure-webserver multiselect apache2";
apt-get -y install phpmyadmin;
ln -s /usr/share/phpmyadmin/ /vagrant/public/phpmyadmin;

#modRewrite
sudo a2enmod rewrite;
sudo sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/sites-available/default;

#apt-get install -y apache2;
if ! [ -L /var/www/html ]; then
  rm -rf /var/www/html;
  ln -fs /vagrant/public /var/www/html;
  cd /vagrant/server/www;
  php ../composer/composer.phar install;
fi

sudo /etc/init.d/apache2 restart;