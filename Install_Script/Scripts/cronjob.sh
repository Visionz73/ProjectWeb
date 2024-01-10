#!/bin/bash

# PFAD zum Script
SCRIPT="/home/adminrv/ProjectWeb/Backup_Script/Scripts/ex_to_input.sh"

# Ausführbarkeit testen
if [ ! -f "$SCRIPT" ]; then
    echo "Das Skript $SCRIPT wurde nicht gefunden."
    exit 1
fi

if [ ! -x "$SCRIPT" ]; then
    echo "Das Skript $SCRIPT ist nicht ausführbar. Setze Ausführungsberechtigungen mit chmod +x "script.sh"."
    exit 1
fi

# Füge  Cronjob zu Crontab hinzu
(crontab -l 2>/dev/null; echo "0 */3 * * * $SCRIPT") | crontab -

# Überprüfung ob der Cronjob hinzugefügt wurde
if crontab -l | grep -q "$SCRIPT"; then
    echo "Cronjob erfolgreich hinzugefügt."
else
    echo "Es gab ein Problem beim Hinzufügen des Cronjobs."
fi

