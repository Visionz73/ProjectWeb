#!/bin/bash

# Pfad zur SSH-Konfigurationsdatei
SSH_CONFIG_FILE="/etc/ssh/sshd_config"

# Sicherungskopie der SSH-Konfigurationsdatei erstellen
sudo cp $SSH_CONFIG_FILE ${SSH_CONFIG_FILE}.backup

# Überprüfen, ob PermitRootLogin bereits in der Datei existiert
if grep -q "PermitRootLogin" $SSH_CONFIG_FILE; then
    # Ersetzen der Zeile PermitRootLogin, falls vorhanden
    sudo sed -i 's/^PermitRootLogin.*/PermitRootLogin no/' $SSH_CONFIG_FILE
else
    # Hinzufügen der Zeile am Ende der Datei, falls nicht vorhanden
    echo "PermitRootLogin no" | sudo tee -a $SSH_CONFIG_FILE
fi

# SSH-Dienst neu starten, um die Änderungen zu übernehmen
sudo systemctl restart ssh

echo "SSH-Konfiguration aktualisiert und Dienst neu gestartet."
