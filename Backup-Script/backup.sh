#!/bin/bash

#Variablen für User- und Backupverzeichnis

user="/home/mirko"

backup="/home/backup"

#Zum Verzeichnis des Users gehen

cd "$user"
echo -e "\nZum Userverzeichnis $user gewechstelt...\n"

#Userverzeichnis in Backupverzeichnis kopieren

cp -r "$user" "$backup"
echo "Das Userverzeichnis wurde erfolgreich gesichert!"


echo -e "Das Userverzeichnis wurde unter $backup gespeichert.\n"

########################################################################

#MySQL und die Datenbanken backupen

sql_pfad="/var/lib/mysql"

#Zum Quellordner von MySQL gehen

cd "$sql_pfad"
echo -e "Zum Speicherort von MySQL $sql_pfad gewechselt...\n"

#Den MySQL Ordner in das Backupvezeichnis kopieren

cp -r "$sql_pfad" "$backup"
echo "MySQL wurde erfolgreich gesichert!"

echo -e "MySQL und die Datenbanken wurden unter $backup gespeichert.\n"


