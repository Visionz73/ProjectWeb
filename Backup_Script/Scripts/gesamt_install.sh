#!/bin/bash

echo "Starte Skriptprozess..."
chmod +x benutzer_sichern.sh
chmod +x sql_sichern.sh
chmod +x ex_to_input.sh



# Ausführen von Skript 1
if ./sql_sichern.sh; then
    echo "Backup von der Datenbank wurde erfolgreich abgeschlossen."
else
    echo "Fehler bei der Ausführung von Backup_Database."
    exit 1
fi

# Ausführen von Skript 2
if ./benutzer_sichern.sh; then
    echo "Backup von Benutzer wurden erfolgreich gesichert."
else
    echo "Fehler bei der Ausführung von Backup_user."
    exit 1
fi

# Ausführen von Skript 3
if ./ex_to_input.sh; then
    echo "Import von Daten wurden erfolgreich gesichert."
else
    echo "Fehler beim Import der Daten."
    exit 1
fi



# Weitere Skripte können hier in ähnlicher Weise hinzugefügt werden...

echo "Alle Skripte wurden erfolgreich ausgeführt."
