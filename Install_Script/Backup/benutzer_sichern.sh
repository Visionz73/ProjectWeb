#!/bin/bash

# Stellen Sie sicher, dass das Skript als Root ausgeführt wird
if [ "$(id -u)" != "0" ]; then
    echo "Dieses Skript muss als Root ausgeführt werden" >&2
    exit 1
fi

# Benutzerliste erstellen
awk -F':' '{ if ($3 >= 1000) print $1}' /etc/passwd > benutzerliste.txt

# Home-Verzeichnisse sichern
tar -czvf homeverzeichnisse.tar.gz /home

# Benutzerdaten sichern
grep -Ff benutzerliste.txt /etc/passwd > benutzer_passwd.txt
grep -Ff benutzerliste.txt /etc/shadow > benutzer_shadow.txt
grep -Ff benutzerliste.txt /etc/group > benutzer_group.txt
grep -Ff benutzerliste.txt /etc/gshadow > benutzer_gshadow.txt
