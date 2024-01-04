#!/bin/bash

# Stellen Sie sicher, dass das Skript als Root ausgeführt wird
if [ "$(id -u)" != "0" ]; then
    echo "Dieses Skript muss als Root ausgeführt werden" >&2
    exit 1
fi

# Zielverzeichnis festlegen
zielverzeichnis="/home/adminrv/ProjectWeb/Backup_Script/Backup/Export_user"


# Erstellen des Zielverzeichnisses, falls es nicht existiert
mkdir -p "$zielverzeichnis"

# Benutzerliste erstellen und im Zielverzeichnis speichern
awk -F':' '{ if ($3 >= 1000) print $1}' /etc/passwd > "$zielverzeichnis/benutzerliste.txt"

# Home-Verzeichnisse sichern und im Zielverzeichnis speichern
tar -czvf "$zielverzeichnis/homeverzeichnisse.tar.gz" /home

# Benutzerdaten sichern und im Zielverzeichnis speichern
grep -Ff "$zielverzeichnis/benutzerliste.txt" /etc/passwd > "$zielverzeichnis/benutzer_passwd.txt"
grep -Ff "$zielverzeichnis/benutzerliste.txt" /etc/shadow > "$zielverzeichnis/benutzer_shadow.txt"
grep -Ff "$zielverzeichnis/benutzerliste.txt" /etc/group > "$zielverzeichnis/benutzer_group.txt"
grep -Ff "$zielverzeichnis/benutzerliste.txt" /etc/gshadow > "$zielverzeichnis/benutzer_gshadow.txt"

