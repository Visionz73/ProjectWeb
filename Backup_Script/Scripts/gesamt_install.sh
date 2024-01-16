#!/bin/bash

echo -e "\033[0;31mStarte Skriptprozess...\033[0m"
chmod +x benutzer_sichern.sh
chmod +x sql_sichern.sh
chmod +x ex_to_input.sh

# Ausführen von Skript 1
if ./sql_sichern.sh; then
    echo -e "\033[0;31mBackup von der Datenbank wurde erfolgreich abgeschlossen.\033[0m"
else
    echo -e "\033[0;31mFehler bei der Ausführung von Backup_Database.\033[0m"
    exit 1
fi

# Ausführen von Skript 2
if ./benutzer_sichern.sh; then
    echo -e "\033[0;31mBackup von Benutzer wurden erfolgreich gesichert.\033[0m"
else
    echo -e "\033[0;31mFehler bei der Ausführung von Backup_user.\033[0m"
    exit 1
fi

# Ausführen von Skript 3
if ./ex_to_input.sh; then
    echo -e "\033[0;31mImport von Daten wurden erfolgreich gesichert.\033[0m"
else
    echo -e "\033[0;31mFehler beim Import der Daten.\033[0m"
    exit 1
fi

# Weitere Skripte können hier in ähnlicher Weise hinzugefügt werden...

echo -e "\033[0;31mAlle Skripte wurden erfolgreich ausgeführt.\033[0m"
