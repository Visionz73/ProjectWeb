#!/bin/bash

echo "Starte Skriptprozess..."
chmod +x Backup/benutzer_importieren.sh
chmod +x ./tool_config.sh
chmod +x ./tool_config.sh
chmod +x ./tool_config.sh


# Ausführen von Skript 1
if ./tool_config.sh; then
    echo "Die Basis Programme wurden installiert und erfolgreich abgeschlossen."
else
    echo "Fehler bei der Ausführung von Tools und Configs."
    exit 1
fi

# Ausführen von Skript 2
if Backup/./benutzer_importieren.sh; then
    echo "Die Basis user wurden eingerichtet und erfolgreich abgeschlossen."
else
    echo "Fehler bei der Ausführung von user and priv."
    exit 1
fi

# Weitere Skripte können hier in ähnlicher Weise hinzugefügt werden...

echo "Alle Skripte wurden erfolgreich ausgeführt."
