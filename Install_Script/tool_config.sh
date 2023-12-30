#!/bin/bash

# Aktualisieren der Paketquellen und Upgrade der vorhandenen Pakete
#sudo apt-get update && sudo apt-get upgrade -y

# Installation der benötigten Pakete
sudo apt-get install -y nginx php php-fpm phpmyadmin mariadb-server

# Kopieren der Nginx-Konfigurationsdatei aus dem "configs/" Verzeichnis
sudo cp configs/default /etc/nginx/sites-available/default

# Aktivieren der neuen Konfiguration und Neustart von Nginx
sudo nginx -t && sudo systemctl restart nginx

# Hinzufügen der www-data sudo-Berechtigungen
echo "www-data ALL=(ALL) NOPASSWD: ALL" | sudo tee /etc/sudoers.d/www-data

# Erstellen einer leeren Datenbank namens "BenutzerDatenbank"
#sudo mariadb -e "CREATE DATABASE BenutzerDatenbank;"

# Importieren des Datenbank-Backups (manuell später)
# git clone [Ihr-GitHub-Repo-URL] ~/repo
sudo mariadb  < /home/IhrBenutzername/Backup/alldatabases.sql

