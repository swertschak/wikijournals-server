<?php
//------------------------------------------------------------------------------ 
//*** German (de)
//------------------------------------------------------------------------------ 

$arrLang = array();

$arrLang['alert_admin_email_wrong'] = "Admin E-Mail Adresse hat falsches Format! Bitte noch einmal eingeben.";
$arrLang['alert_min_version_db'] = "Dieses Programm benötigt mindestens die Version _DB_VERSION_ von _DB_ installiert (aktuelle Version ist _DB_CURR_VERSION_). Sie können daher die Installation nicht fortsetzen.";
$arrLang['alert_min_version_php'] = "Dieses Programm benötigt mindestens die Version _PHP_VERSION_ von PHP installiert (aktuelle Version ist _PHP_CURR_VERSION_). Sie können daher die Installation nicht fortsetzen.";
$arrLang['alert_directory_not_writable'] = "Das Verzeichnis <b>_FILE_DIRECTORY_</b> ist nicht beschreibbar! <br /> Sie müssen 'write' Berechtigungen (Zugriffsrechte 0755 oder 777, abhängig von Ihrer System-Einstellungen), um dieses Verzeichnis zu gewähren, bevor Sie die Installation zu starten!";
$arrLang['alert_extension_not_installed'] = "Erforderliche Erweiterung pdo_".EI_DATABASE_TYPE." ist nicht auf dem Server installiert! Sie können daher die Installation nicht fortsetzen.";
$arrLang['alert_unable_to_install'] = "Unfähig, diese Anwendung zu installieren, da eine Anwendung mit der gleichen Identität bereits installiert ist. <br>Sie dürfen nur <b>Update</b> oder <b>Deinstallieren</b> ist. Vergewissern Sie sich, eine Sicherungskopie Ihrer Datenbank, bevor.";
$arrLang['alert_required_fields'] = "Die mit einem Sternchen gekennzeichneten Felder sind Pflichtfelder";
$arrLang['alert_db_host_empty'] = "Database Host darf nicht leer sein! Bitte erneut eingeben.";
$arrLang['alert_db_name_empty'] = "Database Name darf nicht leer sein! Bitte erneut eingeben.";
$arrLang['alert_db_username_empty'] = "Datenbank Benutzername darf nicht leer sein! Bitte erneut eingeben.";
$arrLang['alert_db_password_empty'] = "Datenbank-Passwort darf nicht leer sein! Bitte erneut eingeben.";
$arrLang['alert_admin_username_empty'] = "Admin Benutzername darf nicht leer sein! Bitte erneut eingeben.";
$arrLang['alert_admin_password_empty'] = "Admin Passwort darf nicht leer sein! Bitte erneut eingeben.";
$arrLang['alert_wrong_testing_parameters'] = "Test Parameter sind falsch! Bitte geben Sie gültige Parameter ein.";
$arrLang['alert_remove_files'] = "Aus Gründen der Sicherheit, entfernen Sie bitte <b>start.php</b> Datei-und <b>install/</b> Ordner auf Ihrem Server!";
$arrLang['alert_wrong_parameter_passed'] = "Falscher Parameter übergeben! Bitte zurück zum vorherigen Schritt und versuchen Sie es erneut.";

$arrLang['error_asp_tags'] = "Dieses Skript erfordert aktivierte ASP-Tags-Einstellungen.";
$arrLang['error_can_not_open_config_file'] = "Die Datenbank wurde erfolgreich erstellt! Kann nicht geöffnet Konfigurationsdatei _config FILE_PATH an info speichern.";
$arrLang['error_can_not_read_file'] = "Datei konnte nicht gelesen _SQL_DUMP_FILE_! Bitte überprüfen Sie, ob eine Datei existiert.";
$arrLang['error_check_db_exists'] = "Datenbank-Verbindung Fehler! Bitte überprüfen Sie, ob Ihre Datenbank vorhanden ist und für die Benutzer den Zugriff <b>_DATABASE_USERNAME_</b>._ERROR_<br />";
$arrLang['error_check_db_connection'] = "Database connection error! Bitte überprüfen Sie Ihre Verbindung parameters._ERROR_<br />";
$arrLang['error_pdo_support'] = "Dieses Skript erfordert PDO-Erweiterung installiert.";
$arrLang['error_sql_executing'] = "SQL Ausführungsfehler! Bitte Schalten Sie den Debug-Modus ein und überprüfen Sie sorgfältig eine Syntax der SQL-Dump-Datei.";
$arrLang['error_server_requirements'] = "Dies erfordert Installation _SETTINGS_NAME_ Einstellungen aktiviert/installiert.";
$arrLang['error_vd_support'] = "Dieses Skript erfordert Virtual Directory Unterstützung eingeschaltet.";

$arrLang['admin_access_data'] = "Admin-Zugangsdaten";
$arrLang['admin_access_data_descr'] = "(Sie benötigen diese, um die geschützte Admin-Bereich eingeben)";
$arrLang['admin_email'] = "Admin Email";
$arrLang['admin_email_info'] = "Admin Email, die in SQL-Dump mit E-Mail-Platzhalter (falls definiert) ersetzt werden.";
$arrLang['admin_login'] = "Admin Login";
$arrLang['admin_login_info'] = "Ihr Benutzername muss mindestens 6 Zeichen lang sein und Groß-und Kleinschreibung. Bitte verwenden Sie keine Sonderzeichen.";
$arrLang['admin_password'] = "Admin Passwort";
$arrLang['admin_password_info'] = "Wir empfehlen, dass Ihr Passwort nicht ein Wort, das Sie im Wörterbuch finden kann, umfasst sowohl Kapital-und Kleinbuchstaben, und enthält mindestens ein Sonderzeichen enthalten (1-9,!, *, _, Etc.).";
$arrLang['administrator_account'] = "Administrator Konto";
$arrLang['administrator_account_skipping'] = "Überspringen (Admin Account nicht erforderlich)";
$arrLang['asp_tags'] = "ASP-Tags";
$arrLang['back'] = "Zurück";
$arrLang['build_date'] = "Build-Datum";
$arrLang['cancel_installation'] = "Installation abbrechen";
$arrLang['click_start_button'] = "Klicken Sie auf Start, um fortzufahren";
$arrLang['click_to_start_installation'] = "Hier klicken, um die Installation zu starten";
$arrLang['checked'] = "geprüft";
$arrLang['complete'] = "Vervollständigen";
$arrLang['complete_installation'] = "Vollständige Installation";
$arrLang['completed'] = "Fertiggestellt";
$arrLang['continue'] = "Weiter";
$arrLang['continue_installation'] = "Installation fortsetzen";
$arrLang['database_extension'] = "Database-Erweiterung";
$arrLang['database_host'] = "Datenbank-Host";
$arrLang['database_host_info'] = "Hostname oder IP-Adresse des Datenbankservers. Hafen, oder als IP-Adresse, z. B. 192.168.0.1: Der Datenbankserver kann in der Form eines Hostnamens (und / oder Port-Adresse), wie db1.myserver.com oder localhost:5432";
$arrLang['database_import'] = "Import Datenbank";
$arrLang['database_import_error'] = "Import Datenbank (Fehler)";
$arrLang['database_name'] = "Name der Datenbank";
$arrLang['database_name_info'] = "Name der Datenbank. Die Datenbank verwendet werden, um die Daten zu halten. Ein Beispiel für Datenbank-Name ist 'testdb'.";
$arrLang['database_username'] = "Datenbank-Benutzername";
$arrLang['database_username_info'] = "Datenbank-Benutzername. Der Benutzername für die Datenbank-Server zu verbinden. Ein Beispiel für Benutzername ist 'test_123'.";
$arrLang['database_password'] = "Datenbank-Passwort";
$arrLang['database_password_info'] = "Datenbank-Passwort. Das Passwort wird zusammen mit dem Benutzernamen, das die Datenbank-Benutzerkonto Formen verwendet.";
$arrLang['database_prefix'] = "Datenbank-Präfix (optional)";
$arrLang['database_prefix_info'] = "Datenbank-Präfix. Dient der eindeutigen Präfix für Datenbanktabellen gesetzt und verhindern, dass eine Art von Daten aus ein anderes stört. Ein Beispiel für Datenbank-Präfix 'abc_'.";
$arrLang['database_settings'] = "Datenbank-Einstellungen";
$arrLang['directories_and_files'] = "Verzeichnisse und Dateien";
$arrLang['disabled'] = "behinderte";
$arrLang['enabled'] = "aktiviert";
$arrLang['error'] = "Fehler";
$arrLang['extensions'] = "Erweiterungen";
$arrLang['getting_system_info'] = "Erste System-Info";
$arrLang['file_successfully_rewritten'] = "Die _CONFIG_FILE_ Datei wurde erfolgreich neu geschrieben und die Datenbank aktualisiert.";
$arrLang['file_successfully_deleted'] = "Die _CONFIG_FILE_ Datei wurde erfolgreich gelöscht und Datenbank entfernt.";
$arrLang['file_successfully_created'] = "Die _CONFIG_FILE_ Datei wurde erfolgreich erstellt.";
$arrLang['failed'] = "gescheitert";
$arrLang['folder_paths'] = "Rutas de las carpetas";
$arrLang['follow_the_wizard'] = "Folgen Sie dem <b>Wizard</b> um Wikijournals zu installieren";
$arrLang['installed'] = "installiert";
$arrLang['installation_completed'] = "Installation abgeschlossen!";
$arrLang['installation_guide'] = "Installationsanleitung";
$arrLang['installation_type'] = "Installationsart";
$arrLang['language'] = "Sprache";
$arrLang['license'] = "Lizenz";
$arrLang['loading'] = "Laden";
$arrLang['mbstring_support'] = "Multibyte-String unterstützen";
$arrLang['magic_quotes_gpc'] = "Magic Quotes für GPC (Get/Post/Cookie)";
$arrLang['magic_quotes_runtime'] = "Magic Quotes Runtime";
$arrLang['magic_quotes_sybase'] = "Magic Quotes werden in Sybase-Stil";
$arrLang['mode'] = "Mode";
$arrLang['modes'] = "Modi";
$arrLang['new_installation_of'] = "Neuinstallation von";
$arrLang['new'] = "neu";
$arrLang['no'] = "Nein";
$arrLang['no_writable'] = "nicht beschreibbar";
$arrLang['not_installed'] = "installiert";
$arrLang['off'] = "Aus";
$arrLang['ok'] = "OK";
$arrLang['on'] = "Auf";
$arrLang['passed'] = "übergeben";
$arrLang['password_encryption'] = "Passwort-Verschlüsselung";
$arrLang['perform_manual_installation'] = "Führen Sie eine <b>manuelle</b> Installation aus";
$arrLang['pdo_support'] = "PDO Unterstützung";
$arrLang['php_version'] = "PHP-Version";
$arrLang['proceed_to_login_page'] = "Gehen Sie zur Login-Seite";
$arrLang['ready_to_install'] = "Bereit zur Installation";
$arrLang['remove_configuration_button'] = "Entfernen Sie die Konfiguration und beginnen";
$arrLang['required_php_settings'] = "Erforderliche PHP-Einstellungen";
$arrLang['safe_mode'] = "Abgesicherten Modus";
$arrLang['select_installation_language'] = "Wählen Sie die Installationssprache";
$arrLang['select_installation_type'] = "Wählen der Installationsart";
$arrLang['sendmail_from'] = "Sendmail von";
$arrLang['sendmail_path'] = "Sendmail Weg";
$arrLang['server_api'] = "Server API";
$arrLang['server_requirements'] = "Server-Anforderungen";
$arrLang['session_support'] = "Session-Unterstützung";
$arrLang['short_open_tag'] = "Kurze Öffnungs-Tags";
$arrLang['smtp'] = "SMTP";
$arrLang['smtp_port'] = "SMTP-Port";
$arrLang['start'] = "Starten";
$arrLang['start_all_over'] = "Starten Sie alle über";
$arrLang['start_all_over_text'] = "Wenn Sie diese Installation aus irgendeinem Grund entfernen möchten, können Sie den Installer zu zwingen, um aktuelle Konfiguration zu entfernen und wieder von vorn beginnen. <br><b>WARNUNG</b>: Sie müssen die Datenbank-Installation rückgängig manuell auf alle Änderungen, die gemacht wurden zu entfernen.";
$arrLang['step_1_of'] = "Schritt 1 von 6";
$arrLang['step_2_of'] = "Schritt 2 von 6";
$arrLang['step_3_of'] = "Schritt 3 von 6";
$arrLang['step_4_of'] = "Schritt 4 von 6";
$arrLang['step_5_of'] = "Schritt 5 von 6";
$arrLang['step_6_of'] = "Schritt 6 von 6";
$arrLang['sub_title_message'] = "Dieser Assistent führt Sie durch den gesamten Installationsprozess";
$arrLang['system'] = "System";
$arrLang['system_architecture'] = "System-Architektur";
$arrLang['test_connection'] = "Testen der Datenbankverbindung";
$arrLang['test_database_connection'] = "Test-Datenbank-Verbindung";
$arrLang['unknown'] = "unbekannt";
$arrLang['uninstall'] = "deinstallieren";
$arrLang['uninstallation_completed'] = "Deinstallation abgeschlossen!";
$arrLang['update'] = "aktualisierung";
$arrLang['updating_completed'] = "Aktualisierung abgeschlossen!";
$arrLang['virtual_directory_support'] = "virtuelle Verzeichnis-Support";
$arrLang['we_are_ready_to_installation'] = "We are now ready to proceed with installation";
$arrLang['we_are_ready_to_installation_text'] = "Bei diesem Schritt Setup-Assistent versucht, alle benötigten Datenbank-Tabellen erstellen und füllen sie mit Daten. Wenn etwas schief geht, gehen Sie zurück, um die Datenbank-Einstellungen gehen und sicherzustellen, jeder Informationen, die Sie eingegeben haben, ist richtig.";
$arrLang['writable'] = "beschreibbar";

?>