<?php
//------------------------------------------------------------------------------ 
//*** German (de)
//------------------------------------------------------------------------------ 

$arrLang = array();

$arrLang['alert_min_version_db'] = "Dieses Programm benötigt mindestens die Version _DB_VERSION_ von _DB_ installiert (aktuelle Version ist _DB_CURR_VERSION_). Sie können nicht fahren mit der Installation.";
$arrLang['alert_min_version_php'] = "Dieses Programm benötigt mindestens die Version _PHP_VERSION_ von PHP installiert (aktuelle Version ist _PHP_CURR_VERSION_). Sie können nicht fahren mit der Installation.";
$arrLang['alert_directory_not_writable'] = "Das Verzeichnis <b>_FILE_DIRECTORY_</b> ist nicht beschreibbar! <br /> Sie müssen 'write' Berechtigungen (Zugriffsrechte 0755 oder 777, abhängig von Ihrer System-Einstellungen), um dieses Verzeichnis zu gewähren, bevor Sie die Installation zu starten!";
$arrLang['alert_unable_to_install'] = "Unfähig, diese Anwendung zu installieren, da eine Anwendung mit der gleichen Identität bereits installiert ist. Sie dürfen nur <b>Update</b> oder <b>Deinstallieren</b> ist.";
$arrLang['alert_required_fields'] = "Die mit einem Sternchen gekennzeichneten Felder sind Pflichtfelder";
$arrLang['alert_db_host_empty'] = "Database Host kann nicht leer sein! Bitte erneut eingeben.";
$arrLang['alert_db_name_empty'] = "Database Name darf nicht leer sein! Bitte erneut eingeben.";
$arrLang['alert_db_username_empty'] = "Datenbank Benutzername darf nicht leer sein! Bitte erneut eingeben.";
$arrLang['alert_db_password_empty'] = "Datenbank-Passwort darf nicht leer sein! Bitte erneut eingeben.";
$arrLang['alert_admin_username_empty'] = "Admin Benutzername darf nicht leer sein! Bitte erneut eingeben.";
$arrLang['alert_admin_password_empty'] = "Admin Passwort darf nicht leer sein! Bitte erneut eingeben.";
$arrLang['alert_wrong_testing_parameters'] = "Testen Parameter sind falsch! Bitte geben Sie eine gültige Parameter.";
$arrLang['alert_remove_files'] = "Aus Gründen der Sicherheit, entfernen Sie bitte <b>install.php</b> Datei-und <b>install/</b> Ordner auf Ihrem Server!";

$arrLang['error_sql_executing'] = "SQL Ausführungsfehler! Bitte Schalten Sie den Debug-Modus ein und überprüfen Sie sorgfältig eine Syntax der SQL-Dump-Datei.";
$arrLang['error_can_not_open_config_file'] = "Die Datenbank wurde erfolgreich erstellt! Kann nicht geöffnet Konfigurationsdatei _config FILE_PATH an info speichern.";
$arrLang['error_can_not_read_file'] = "Datei konnte nicht gelesen _SQL_DUMP_FILE_! Bitte überprüfen Sie, ob eine Datei existiert.";
$arrLang['error_check_db_exists'] = "Datenbank-Verbindung Fehler! Bitte überprüfen Sie, ob Ihre Datenbank vorhanden ist und für die Benutzer den Zugriff <b>_DATABASE_USERNAME_</b>._ERROR_<br />";
$arrLang['error_check_db_connection'] = "Database connection error! Bitte überprüfen Sie Ihre Verbindung parameters._ERROR_<br />";

$arrLang['admin_access_data'] = "Admin-Zugangsdaten";
$arrLang['admin_access_data_descr'] = "(Sie benötigen diese, um die geschützte Admin-Bereich eingeben)";
$arrLang['admin_login'] = "Admin Login";
$arrLang['admin_login_info'] = "Ihr Benutzername muss mindestens 6 Zeichen lang sein und Groß-und Kleinschreibung. Bitte geben Sie keine Sonderzeichen.";
$arrLang['admin_password'] = "Admin Passwort";
$arrLang['admin_password_info'] = "Wir empfehlen, dass Ihr Passwort nicht ein Wort, das Sie im Wörterbuch finden kann, umfasst sowohl Kapital-und Kleinbuchstaben, und enthält mindestens ein Sonderzeichen enthalten (1-9,!, *, _, Etc.).";
$arrLang['asp_tags'] = "ASP-Tags";
$arrLang['build_date'] = "Build-Datum";
$arrLang['cancel_installation'] = "Installation abbrechen";
$arrLang['click_start_button'] = "Klicken Sie auf Start, um fortzufahren";
$arrLang['click_to_start_installation'] = "Hier klicken, um die Installation zu starten";
$arrLang['checked'] = "geprüft";
$arrLang['continue_installation'] = "Installation fortsetzen";
$arrLang['database_host'] = "Datenbank-Host";
$arrLang['database_host_info'] = "Hostname oder IP-Adresse des Datenbankservers. Hafen, oder als IP-Adresse, z. B. 192.168.0.1: Der Datenbankserver kann in der Form eines Hostnamens (und / oder Port-Adresse), wie db1.myserver.com oder localhost:5432";
$arrLang['database_name'] = "Name der Datenbank";
$arrLang['database_name_info'] = "Name der Datenbank. Die Datenbank verwendet werden, um die Daten zu halten. Ein Beispiel für Datenbank-Name ist 'testdb'.";
$arrLang['database_username'] = "Datenbank-Benutzername";
$arrLang['database_username_info'] = "Datenbank-Benutzername. Der Benutzername für die Datenbank-Server zu verbinden. Ein Beispiel für Benutzername ist 'test_123'.";
$arrLang['database_password'] = "Datenbank-Passwort";
$arrLang['database_password_info'] = "Datenbank-Passwort. Das Passwort wird zusammen mit dem Benutzernamen, das die Datenbank-Benutzerkonto Formen verwendet.";
$arrLang['database_prefix'] = "Datenbank-Präfix (optional)";
$arrLang['database_prefix_info'] = "Datenbank-Präfix. Dient der eindeutigen Präfix für Datenbanktabellen gesetzt und verhindern, dass eine Art von Daten aus ein anderes stört. Ein Beispiel für Datenbank-Präfix 'abc_'.";
$arrLang['disabled'] = "Behinderte";
$arrLang['error'] = "Fehler";
$arrLang['getting_system_info'] = "Erste System-Info";
$arrLang['file_successfully_rewritten'] = "Die _CONFIG_FILE_ Datei wurde erfolgreich neu geschrieben und die Datenbank aktualisiert.";
$arrLang['file_successfully_deleted'] = "Die _CONFIG_FILE_ Datei wurde erfolgreich gelöscht und Datenbank entfernt.";
$arrLang['file_successfully_created'] = "Die _CONFIG_FILE_ Datei wurde erfolgreich erstellt.";
$arrLang['follow_the_wizard'] = "Folgen Sie den <b>Wizard</b>, um das Setup der Datenbank";
$arrLang['installation_guide'] = "Installationsanleitung";
$arrLang['installation_type'] = "Installationsart";
$arrLang['language'] = "Sprache";
$arrLang['license'] = "Lizenz";
$arrLang['loading'] = "Laden";
$arrLang['magic_quotes_gpc'] = "Magic Quotes für GPC (Get/Post/Cookie)";
$arrLang['magic_quotes_runtime'] = "Magic Quotes Runtime";
$arrLang['magic_quotes_sybase'] = "Magic Quotes werden in Sybase-Stil";
$arrLang['new_installation_of'] = "Neuinstallation von";
$arrLang['new'] = "neu";
$arrLang['password_encryption'] = "Passwort-Verschlüsselung";
$arrLang['perform_manual_installation'] = "Führen Sie eine <b>Handbuch</b> Installation";
$arrLang['php_version'] = "PHP-Version";
$arrLang['proceed_to_login_page'] = "Gehen Sie zur Login-Seite"; 
$arrLang['safe_mode'] = "Safe Mode";
$arrLang['sendmail_from'] = "Sendmail von";
$arrLang['sendmail_path'] = "Sendmail Weg";
$arrLang['server_api'] = "Server API";
$arrLang['session_support'] = "Session-Unterstützung";
$arrLang['short_open_tag'] = "Kurze Öffnungs-Tags";
$arrLang['smtp'] = "SMTP";
$arrLang['smtp_port'] = "SMTP-Port";
$arrLang['step_1_database_import'] = "Schritt 1. Database Import";
$arrLang['step_1_database_import_error'] = "Schritt 1. Database Import (Fehler)";
$arrLang['step_2_installation_completed'] = "Schritt 2. Installation abgeschlossen!";
$arrLang['step_2_updating_completed'] = "Schritt 2. Aktualisierung abgeschlossen!";
$arrLang['step_2_uninstallation_completed'] = "Schritt 2. Deinstallation abgeschlossen!";
$arrLang['system'] = "System";
$arrLang['system_architecture'] = "System-Architektur";
$arrLang['test_database_connection'] = "Test-Datenbank-Verbindung";
$arrLang['unknown'] = "unbekannt";
$arrLang['uninstall'] = "deinstallieren";
$arrLang['update'] = "Aktualisierung";
$arrLang['virtual_directory_support'] = "virtuelle Verzeichnis-Support";
    
?>