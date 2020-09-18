

# Features:
-Registrierung
-login/logout
-Kursplan
-Trainingskalender
-Trainingsverwaltung
-Accountdatenverwaltung


# Anforderungen
##Zur Benutzung der Applikation wird eine Internetverbindung benötigt

## Zur Gewährleistung der Funktionalität muss Javascript im Browser des Benutzers aktiviert sein.

## Zur Benutzung der Applikation werden folgende Anwendungen benötigt 
	XAMPP Version: 7.1.32
	Control Panel Version: 3.2.4  
	phpmyadmin
## Dev-tools
	PHP Version 7.3.10/7.1.32
	MariaDB Version 10.4.8

	
# Anleitung

1. Schritt: Kopieren Sie den Projektordner in Ihren htdocs Ordner oder an einen anderen für XAMPP zugreifbaren Speicherort.

2. Schritt: Starten Sie den Apache Server und MySQL im XAMMP Control Panel.

3. Schritt:	Folgende Einstellungen für phpmyadmin müssen gegebenenfalls angepasst werden
			Passwort: ''
			Benutzername: 'root'
4. Schritt: Führen Sie das Skript unter dem Pfad IT-Projekt/src/database/implementationScriptIT-Projekt.sql in Ihrem DBMS (MySQL) aus.

5. Schritt: Führen Sie das Skript unter dem Pfad IT-Projekt/src/database/valuesIT-Projekt.sql in Ihrem DBMS (MySQL) aus.

6. Schritt: Die Startseite kann nun im Browser unter http://localhost/IT-Projekt/ betreten werden.

## Login
Sie können sich selbst Registrieren und Einlogen oder den Testaccount nutzen
	email: test@123.de.com 
	pw: test123456

## Github:
https://github.com/BenjaminS01/IT-Projekt

##Live-System:
https://trainingskalender.herokuapp.com/