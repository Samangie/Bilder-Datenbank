# Bilder Datenbank

## ToDo
- Adminbereich
- Userprofil - Daten ändern
- Öffentliche Galerien 
- Design zwischen hell/ dunkel wechseln können
- Tags
- Verschiednene Ansichten für die Darstellung der Bilder
- Bild für eine Galerie definieren 


### Installation

Kopiere zuert alle Dateien aus der Branch, welche du verwenden möchtest, in den Ordner in dem du Dein Projekt entwickeln möchtest. Hier wird das Verzeichnis `C:\dev\my-project` verwendet.

Um später mit einem DNS Namen auf die Seite zugreifen zu können, musst du den gewünschten DNS Namen in der `hosts`-Datei eintagen. Wir verwenden in diesem Beispiel den Namen `my-project.local`.

`C:\Windows\System32\drivers\etc\hosts`
```
# [...]

127.0.0.1    my-project.local
```

Damit der Apache Webserver aus dem XAMPP Stack weiss, welcher DNS Namen zu welchem Ordner auf dem Dateisystem gehört, musst du einen VirtualHost erstellen. Dazu musst du die Datei `C:\xampp\apache\conf\extra\httpd-vhosts.conf` folgendermassen anpassen.

```apache
# [...]

# Wird benötigt um VirtualHosts für alle Requests auf Port 80 zu aktivieren
NameVirtualHost *:80

# [...]

# Eigentliche VHost Konfiguration
<VirtualHost 127.0.0.1>
    # DNS Name auf den der VHost hören soll
    ServerName my-project.local

    # Ort an dem Das Projekt zu finden ist
    DocumentRoot "c:/dev/my-project/public"

    # Nochmals
    <Directory "c:/dev/my-project/public">
        Options Indexes FollowSymLinks
        Options +Includes
        AllowOverride All
        Order allow,deny
        Require all granted
        Allow from All
        DirectoryIndex index.php
    </Directory>
</VirtualHost>
```

Importiere die Datei welche du unter /data/bilderdb_4h_hawkes.sql findest. Damit erstellt sich automatisch eine 
Daten bank mit Testbenutern und Testdaten. 

Sollte ein Fehler auftreten kann auch die Datei /data/blank_database_setup.sql importiert werden. Darin sind 
aber keine Testdaten enthalten. 

Nun starte den Apache über das XAMPP Control Panel neu und du solltest mit dem Browser Chrome auf die Seite `http://my-project.local` zugreifen können.


##Testbenutzer

Benutzername: Test
Passwort: gibbiX12345$

## Sonstiges
ERD und Arbeitsjournal sind unter /data zu finden. 