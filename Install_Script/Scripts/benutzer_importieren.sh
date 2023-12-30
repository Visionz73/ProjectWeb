#!/bin/bash

# Stellen Sie sicher, dass das Skript als Root ausgeführt wird
if [ "$(id -u)" != "0" ]; then
    echo "Dieses Skript muss als Root ausgeführt werden" >&2
    exit 1
fi

# Definieren des Backup-Verzeichnisses
backup_verzeichnis="../Backup/Import_user"

# Sicherstellen, dass das Backup-Verzeichnis existiert
if [ ! -d "$backup_verzeichnis" ]; then
    echo "Fehler: Backup-Verzeichnis $backup_verzeichnis nicht gefunden!" >&2
    exit 1
fi

# Überprüfen, ob alle benötigten Dateien vorhanden sind
for file in benutzerliste.txt homeverzeichnisse.tar.gz benutzer_passwd.txt benutzer_shadow.txt benutzer_group.txt benutzer_gshadow.txt; do
    if [ ! -f "$backup_verzeichnis/$file" ]; then
        echo "Fehler: Datei $file nicht gefunden in $backup_verzeichnis!" >&2
        exit 1
    fi
done

# Benutzerdaten importieren
cat "$backup_verzeichnis/benutzer_passwd.txt" >> /etc/passwd
cat "$backup_verzeichnis/benutzer_shadow.txt" >> /etc/shadow
cat "$backup_verzeichnis/benutzer_group.txt" >> /etc/group
cat "$backup_verzeichnis/benutzer_gshadow.txt" >> /etc/gshadow

# Home-Verzeichnisse wiederherstellen
tar -xzvf "$backup_verzeichnis/homeverzeichnisse.tar.gz" -C /

# Berechtigungen anpassen
while read benutzer; do
    if id "$benutzer" &>/dev/null; then
        chown -R "${benutzer}:${benutzer}" "/home/${benutzer}"
    else
        echo "Warnung: Benutzer $benutzer existiert nicht, Berechtigungen wurden nicht angepasst."
    fi
done < "$backup_verzeichnis/benutzerliste.txt"
