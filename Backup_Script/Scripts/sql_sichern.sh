#!/bin/bash

# Nachricht, dass der Backup-Prozess beginnt
echo "SQL-Datenbank wird gebackupt, kleinen Moment bitte..."

# Warten für 3 Sekunden
sleep 3

# Ausführen des Backups
mysqldump -u root -p'12345' -e BenutzerDatenbank > /home/adminrv/ProjectWeb/Backup_Script/Databases/BenutzerDatenbank.sql

# Überprüfen, ob der Befehl erfolgreich war
if [ $? -eq 0 ]; then
    echo "Die SQL-Datenbank wurde erfolgreich gesichert."
else
    echo "Es gab einen Fehler beim Sichern der SQL-Datenbank."
fi
