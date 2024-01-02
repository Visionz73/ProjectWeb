#!/bin/bash

# Aktualisieren der Paketquellen und Upgrade der vorhandenen Pakete
#sudo apt-get update && sudo apt-get upgrade -y

# Installation der benötigten Pakete
sudo apt-get install -y nginx php php-fpm phpmyadmin mariadb-server

#Stop installed Apache
sudo systemctl stop apache2

#Disable
sudo systemctl disable apache2

#Deinstall Apache 
sudo apt-get remove apache2

# Kopieren der Nginx-Konfigurationsdatei aus dem "configs/" Verzeichnis
sudo cp ../configs/default /etc/nginx/sites-available/default

# Überprüfung von der Konfig und Neustart von Nginx
sudo nginx -t && sudo systemctl restart nginx

# Kopieren der phpmyadmin-Konfigurationsdatei aus dem "configs/" Verzeichnis
sudo cp ../configs/config.inc.php /etc/phpmyadmin/config.inc.php

# Hinzufügen der www-data sudo-Berechtigungen
echo "www-data ALL=(ALL) NOPASSWD: ALL" | sudo tee /etc/sudoers.d/www-data

# Erstellen eines symbolischen Links für phpMyAdmin
sudo ln -s /usr/share/phpmyadmin /var/www/html/phpmyadmin







