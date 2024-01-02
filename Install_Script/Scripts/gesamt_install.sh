#!/bin/bash

echo "Starte Skriptprozess..."
chmod +x ./benutzer_importieren.sh
chmod +x ./tool_config.sh


# Ausführen von Skript 1
if ./tool_config.sh; then
    echo "Die Basis Programme wurden installiert und erfolgreich abgeschlossen."
else
    echo "Fehler bei der Ausführung von Tools und Configs."
    exit 1
fi

# Ausführen von Skript 2
if ./sql_user.sh; then
    echo "Die Basis Programme wurden installiert und erfolgreich abgeschlossen."
else
    echo "Fehler bei der Ausführung von sql_user."
    exit 1
fi


# Ausführen von Skript 3
if ./benutzer_importieren.sh; then
    echo "Die Basis user wurden eingerichtet und erfolgreich abgeschlossen."
else
    echo "Fehler bei der Ausführung von user and priv."
    exit 1
fi

# Weitere Skripte können hier in ähnlicher Weise hinzugefügt werden...

echo "Alle Skripte wurden erfolgreich ausgeführt."
