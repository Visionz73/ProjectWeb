#!/bin/bash

# MySQL-Benutzer und Passwort
MYSQL_USER="root"
MYSQL_PASS="12345"  # Ersetzen Sie dies durch Ihr MySQL-Root-Passwort
NEW_USER="conn_admin"
NEW_PASS="12345"           # Verwenden Sie hier ein stärkeres Passwort

# MySQL-Befehl zum Erstellen eines neuen Benutzers
mysql -u "$MYSQL_USER" -p"$MYSQL_PASS" -e "CREATE USER '$NEW_USER'@'localhost' IDENTIFIED BY '$NEW_PASS';"

# Gewähren Sie dem neuen Benutzer erforderliche Berechtigungen
# Beispiel: Gewähren Sie alle Berechtigungen auf einer bestimmten Datenbank
mysql -u "$MYSQL_USER" -p"$MYSQL_PASS" -e "GRANT ALL PRIVILEGES ON *.* TO '$NEW_USER'@'localhost';"

# Flush Privileges
mysql -u "$MYSQL_USER" -p"$MYSQL_PASS" -e "FLUSH PRIVILEGES;"
