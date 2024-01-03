#!/bin/bash

echo -e "\e[32mStarte Skriptprozess...\e[0m"
sleep 5
chmod +x ./benutzer_importieren.sh
chmod +x ./tool_config.sh
chmod +x ./sql_database_import.sh
chmod +x ./sql_user.sh
chmod +x ./root_dir.sh

# Ausführen von Skript 1
if ./tool_config.sh; then
    echo -e "\e[32mDie Basis Programme wurden installiert und erfolgreich abgeschlossen.\e[0m"
    sleep 5
else
    echo -e "\e[32mFehler bei der Ausführung von Tools und Configs.\e[0m"
    exit 1
fi

# Ausführen von Skript 2
if ./sql_database_import.sh; then
    echo -e "\e[32mDer Database Import wurde eingerichtet und erfolgreich abgeschlossen.\e[0m"
    sleep 5
else
    echo -e "\e[32mFehler bei der Ausführung von database_import.\e[0m"
    exit 1
fi

# Ausführen von Skript 3
if ./sql_user.sh; then
    echo -e "\e[32mDie Datenbank user wurden konfiguriert und erfolgreich eingerichtet.\e[0m"
    sleep 5
else
    echo -e "\e[32mFehler bei der Ausführung von sql_user.\e[0m"
    exit 1
fi

# Ausführen von Skript 4
if ./benutzer_importieren.sh; then
    echo -e "\e[32mDie Basis user wurden eingerichtet und erfolgreich abgeschlossen.\e[0m"
    sleep 5
else
    echo -e "\e[32mFehler bei der Ausführung von benutzer_import.\e[0m"
    exit 1
fi

# Ausführen von Skript 5
if ./root_dir.sh; then
    echo -e "\e[32mDer Webserver ist eingerichtet und erfolgreich abgeschlossen.\e[0m"
    sleep 5
else
    echo -e "\e[32mFehler bei der Ausführung von root_dir.\e[0m"
    exit 1
fi

# Weitere Skripte können hier in ähnlicher Weise hinzugefügt werden...

echo -e "\e[32mAlle Skripte wurden erfolgreich ausgeführt.\e[0m"
