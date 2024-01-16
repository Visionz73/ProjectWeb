#!/bin/bash

# Definieren Sie die Quell- und Zielverzeichnisse
SOURCE_DIR="/home/adminrv/ProjectWeb"
DEST_DIR="/var/www/html"

# Kopieren der Verzeichnisse
cp -r "$SOURCE_DIR/PHP" "$DEST_DIR" && \
cp -r "$SOURCE_DIR/CSS" "$DEST_DIR" && \
cp -r "$SOURCE_DIR/Pictures" "$DEST_DIR"

echo "Kopieren abgeschlossen."
