#!/bin/bash

# MySQL-Benutzer und Passwort
NEW_USER="con_admin"
NEW_PASS="12345"           # Verwenden Sie hier ein stärkeres Passwort

# MySQL-Befehl zum Erstellen eines neuen Benutzers
sudo mysql "CREATE USER '$NEW_USER'@'localhost' IDENTIFIED BY '$NEW_PASS';"

# Gewähren Sie dem neuen Benutzer erforderliche Berechtigungen
# Beispiel: Gewähren Sie alle Berechtigungen auf einer bestimmten Datenbank
sudo mysql "GRANT ALL PRIVILEGES ON *.* TO '$NEW_USER'@'localhost';"

# Flush Privileges
sudo mysql "FLUSH PRIVILEGES;"
