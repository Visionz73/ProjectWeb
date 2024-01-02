# Ändern der Kollation in der SQL-Datei
sed -i 's/utf8mb4_0900_ai_ci/utf8mb4_unicode_ci/g' ../Database/BenutzerDatenbank.sql

# Erstellen der Datenbank, falls sie nicht existiert
sudo mariadb -u root -p -e "CREATE DATABASE IF NOT EXISTS BenutzerDatenbank;"

# Importieren der Datenbank
sudo mariadb -u root -p BenutzerDatenbank < ../Database/BenutzerDatenbank.sql