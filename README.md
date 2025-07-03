
# 📘 Karteikarten Web-Anwendung

Ein einfaches PHP-Projekt zur Verwaltung und Anzeige von Karteikarten mit MySQL-Datenbankanbindung.

## 📁 Projektstruktur

- `karteikarten.sql` – SQL-Skript zum Erstellen der MySQL-Datenbanktabelle(n)
- `Verbindung_zum_DataBank.php` – Verbindet die Anwendung mit einer lokalen MySQL-Datenbank
- `karte.php` – Hauptseite zur Anzeige von Karteikarten aus der Datenbank

## 🚀 Einrichtung

1. **Datenbank importieren:**
   - Öffne phpMyAdmin oder ein MySQL-Tool.
   - Erstelle eine neue Datenbank, z. B. `karteikarten`.
   - Importiere die Datei `karteikarten.sql`.

2. **Datenbankzugang konfigurieren:**
   - Öffne die Datei `Verbindung_zum_DataBank.php`.
   - Passe Benutzername, Passwort und Datenbankname ggf. an deine Umgebung an:

     ```php
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "karteikarten";
     ```

3. **Projekt starten:**
   - Kopiere alle Dateien in dein lokales Webserver-Verzeichnis (z. B. `htdocs` bei XAMPP).
   - Rufe `http://localhost/karte.php` im Browser auf.

## 💡 Hinweise

- PHP & MySQL erforderlich (z. B. über [XAMPP](https://www.apachefriends.org/index.html))
- Die Anwendung lädt Karteikarten dynamisch aus der Datenbank
- Einfacher, selbsterklärender Aufbau – ideal zum Lernen
