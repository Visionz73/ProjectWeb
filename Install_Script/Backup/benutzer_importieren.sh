#!/bin/bash

# Stellen Sie sicher, dass das Skript als Root ausgeführt wird
if [ "$(id -u)" != "0" ]; then
    echo "Dieses Skript muss als Root ausgeführt werden" >&2
    exit 1
fi

# Sicherstellen, dass alle benötigten Dateien vorhanden sind
for file in benutzerliste.txt homeverzeichnisse.tar.gz benutzer_passwd.txt benutzer_shadow.txt benutzer_group.txt benutzer_gshadow.txt; do
    if [ ! -f "$file" ]; then
        echo "Fehler: Datei $file nicht gefunden!" >&2
        exit 1
    fi
done

# Benutzerdaten importieren
cat benutzer_passwd.txt >> /etc/passwd
cat benutzer_shadow.txt >> /etc/shadow
cat benutzer_group.txt >> /etc/group
cat benutzer_gshadow.txt >> /etc/gshadow

# Home-Verzeichnisse wiederherstellen
tar -xzvf homeverzeichnisse.tar.gz -C /

# Berechtigungen anpassen
while read benutzer; do
    if id "$benutzer" &>/dev/null; then
        chown -R "${benutzer}:${benutzer}" "/home/${benutzer}"
    else
        echo "Warnung: Benutzer $benutzer existiert nicht, Berechtigungen wurden nicht angepasst."
    fi
done < benutzerliste.txt
