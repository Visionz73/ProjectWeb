#!/bin/bash

# MySQL-Benutzer und Passwort
NEW_USER="con_admin"
NEW_PASS="12345"           # Verwenden Sie hier ein stärkeres Passwort

# Verbindung zu MySQL als root und Ausführen der Befehle
sudo mysql <<EOF
-- Erstellen eines neuen Benutzers
CREATE USER '$NEW_USER'@'localhost' IDENTIFIED BY '$NEW_PASS';

-- Gewähren von Berechtigungen
GRANT ALL PRIVILEGES ON *.* TO '$NEW_USER'@'localhost';

-- Anwenden der neuen Berechtigungen
FLUSH PRIVILEGES;
EOF

echo "Benutzer '$NEW_USER' wurde erstellt und Berechtigungen wurden gesetzt."
