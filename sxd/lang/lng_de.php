<?php
// Language File for Sypex Dumper 2
$LNG = array(

// Information about the language file
'ver'				=> 20005, // Dumper version
'translated'		=> 'Christian Land (http://www.tagdocs.de/)', // Contacts
'name'				=> 'Deutsch', // Lang name

// Toolbar
'tbar_backup'		=> 'Exportieren',
'tbar_restore'		=> 'Importieren', 
'tbar_files'		=> 'Dateien',
'tbar_services'		=> 'Dienste',
'tbar_options'		=> 'Optionen',
'tbar_createdb'		=> 'DB Erzeugen',
'tbar_connects'		=> 'Verbindung',
'tbar_exit'			=> 'Beenden',

// Names of objects in the tree
'obj_tables'		=> 'Tabelle',
'obj_views'			=> 'Views',
'obj_procs'			=> 'Prozeduren',
'obj_funcs'			=> 'Funktionen',
'obj_trigs'			=> 'Trigger',
'obj_events'		=> 'Ereignisse',

// Export
'zip_max'			=> 'max',
'zip_min'			=> 'min',
'zip_none'			=> 'unkomprimiert',
'default'			=> 'Standard',
'combo_db'			=> 'Datenbank (Schema):', 
'combo_charset'		=> 'Zeichensatz:', 
'combo_zip'			=> 'Komprimierung:', 
'combo_comments'	=> 'Kommentar:',
'del_legend'		=> 'Automatisch löschen wenn:',
'del_date'			=> 'Alter der Dateien grösser als %s Tage',
'del_count'			=> 'mehr als %s Dateien vorhanden',
'tree'				=> 'Objekte auswählen:',
'no_saved'			=> 'Keine gespeicherten Jobs',
'btn_save'			=> 'Speichern',
'btn_exec'			=> 'Ausführen',

// Import	
'combo_file'		=> 'Datei:',
'combo_strategy'	=> 'Wiederherstellungsstrategie:',
'ext_legend'		=> 'Erweiterte Optionen:',
'correct'			=> 'Zeichensatzkorrektur',
'autoinc'			=> 'AUTO_INCREMENT zurücksetzen',

// Log
'status_current'	=> 'Aktueller Status:',
'status_total'		=> 'Gesamtstatus:',
'time_elapsed'		=> 'Vergangen:',
'time_left'			=> 'Restdauer:',
'btn_stop'			=> 'Abbrechen',
'btn_pause'			=> 'Pause',
'btn_resume'		=> 'Fortsetzen',
'btn_again'			=> 'Wiederholen',
'btn_clear'			=> 'Log löschen',

// Files
'btn_delete'		=> 'Löschen',
'btn_download'		=> 'Herunterladen',
'btn_open'			=> 'Öffnen',

// Services
'opt_check'			=> 'Optionem für Prüfung:',
'opt_repair'		=> 'Optionen für Reparatur:',
'btn_delete_db'		=> 'DB löSchen',
'btn_check'			=> 'Prüfen',
'btn_repair'		=> 'Reparieren',
'btn_analyze'		=> 'Analysieren',
'btn_optimize'		=> 'Optimieren',

// Options
'cfg_legend'		=> 'Einstellungen:',
'cfg_time_web'		=> 'Zeitlimit Web (Sekunden):',
'cfg_time_cron'		=> 'Zeitlimit CRON (Sekunden):',
'cfg_backup_path'	=> 'Pfad zum Backup-Verzeichnis:',
'cfg_backup_url'	=> 'URL zum Backup-Verzeichnis:',
'cfg_globstat'		=> 'Globale Statistiken:',
'cfg_extended'		=> 'Erweiterte Einstellungen:',
'cfg_charsets'		=> 'Zeichensatz-Filter:',
'cfg_only_create'	=> 'Nur folgende Typen erzeugen:',
'cfg_auth'			=> 'Autorisierungsreihenfolge:',
'cfg_confirm'		=> 'Nach Bestätigung fragen bei:',
'cfg_conf_import'	=> 'Import',
'cfg_conf_file'		=> 'Dateilöschung',
'cfg_conf_db'		=> 'Datenbank löschen',

// Connection
'con_header'		=> 'Verbindungseinstellungen',
'connect'			=> 'Verbindung',
'my_host'			=> 'Host:',
'my_port'			=> 'Port:',
'my_user'			=> 'Benutzer:',
'my_pass'			=> 'Passwort:',
'my_pass_hidden'	=> 'Passwort wird nicht angezeigt',
'my_comp'			=> 'Komprimierung',
'my_db'				=> 'Datenbanken:',
'btn_cancel'		=> 'Abbrechen',

// Save Job
'sj_header'			=> 'Job sichern',
'sj_job'			=> 'Job',
'sj_name'			=> 'Name:',
'sj_title'			=> 'Beschreibung:',

// Create DB
'cdb_header'		=> 'Neue Datenbank anlegen',
'cdb_detail'		=> 'Details',
'cdb_name'			=> 'Name:',
'combo_collate'		=> 'Kollation:',
'btn_create'		=> 'Erzeugen',

// Authorization
'js_required'		=> 'JavaScript muss aktiviert sein',
'auth'				=> 'Anmeldung',
'auth_user'			=> 'Benutzer:',
'auth_remember'		=> 'merken',
'btn_enter'			=> 'Anmelden',
'btn_details'		=> 'Details',

// Log messages
'not_found_rtl'		=> 'RTL-Datei existiert nicht',
'backup_begin'		=> 'Starte Export der Datenbank `%s`',
'backup_TC'			=> 'Exportiere Tabelle `%s`',
'backup_VI'			=> 'Exportiere View `%s`',
'backup_PR'			=> 'Exportiere Prozedur `%s`',
'backup_FU'			=> 'Exportiere Funktion `%s`',
'backup_EV'			=> 'Exportiere Event `%s`',
'backup_TR'			=> 'Exportiere Trigger `%s`',
'continue_from'		=> 'von Position %s',
'backup_end'		=> 'Export der Datenbank `%s` beendet.',
'autodelete'		=> 'Automatische Löschung alter Dateien:',
'del_by_date'		=> '- `%s` - gelöscht (nach Datum)',
'del_by_count'		=> '- `%s` - gelöscht (nach Anzahl)',
'del_fail'			=> '- `%s` - konnte nicht gelöscht werden',
'del_nothing'		=> '- keine Dateien zur Löschung vorhanden',
'set_names'			=> 'Setze Encoding der Verbindung auf: `%s`',
'restore_begin'		=> 'Starte Import der DB `%s`',
'restore_TC'		=> 'Importiere Tabelle `%s`',
'restore_VI'		=> 'Importiere View `%s`',
'restore_PR'		=> 'Importiere Prozedur `%s`',
'restore_FU'		=> 'Importiere Funktion `%s`',
'restore_EV'		=> 'Importiere Event `%s`',
'restore_TR'		=> 'Importiere Trigger `%s`',
'restore_keys'		=> 'Erzeuge Indizes',
'restore_end'		=> 'DB `%s` wiederhergestellt.',
'stop_1'			=> 'Ausführung vom Benutzer abgebrochen', 
'stop_2'			=> 'Ausführung vom Benutzer gestoppt',
'stop_3'			=> 'Ausführung vom Timer abgebrochen',
'stop_4'			=> 'Ausführung durch Timeout abgebrochen',
'stop_5'			=> 'Ausführung wegen eines Fehlers abgebrochen',
'job_done'			=> 'Job erfolgreich abgeschlossen',
'file_size'			=> 'Dateigrösse',
'job_time'			=> 'Laufzeit',
'seconds'			=> 'Sekunden',
'job_freeze'		=> 'Der Prozess wurde seit mehr als 30s nicht aktualisiert. Bitte auf Fortsetzen klicken.',
'stop_job'			=> 'Job stoppen',

// For JS
'js' => array(
	
	// Tabs names
	'backup'		=> 'Datenbankexport (Schema)',
	'restore'		=> 'Datenbankimport (Schema)',
	'log'			=> 'Log',
	'result'		=> 'Ergebnisse',
	'files'			=> 'Dateien',
	'services'		=> 'Dienste',
	'options'		=> 'Optionen',

	// Tables header
	'dt'			=> 'Datum/Uhrzeit',
	'action'		=> 'Aktion',
	'db'			=> 'Datenbank',
	'type'			=> 'Typ',
	'tab'			=> 'Tabellen',
	'records'		=> 'Datensätze',
	'size'			=> 'Grösse',
	'comment'		=> 'Kommentar',

	// AJAX Status
	'load'			=> 'Lade',
	'run'			=> 'Läft...',
	'sdb'			=> 'Neue Datenbank erzeugen',
	'sc'			=> 'Verbindung speichern',
	'sj'			=> 'Job speichern',
	'so'			=> 'Einstellungen speichern',

	// Messages
	'pro'			=> 'Option available only in Pro-version',
	'err_fopen'		=> 'Datei konnte nicht geöffnet werden',
	'err_sxd2'		=> 'Der Dateiinhalt kann nur von Dateien angezeigt werden die mit Sypex Dumper 2 erstellt wurden',
	'err_empty_db'		=> 'Databank ist leer',
	'fdc'			=> 'Wollen Sie die Datei wirklich löschen?',
	'ddc'			=> 'Wollen Sie die Datenbank wirklich löschen?',
	'fic'			=> 'Wollen Sie die Datei wirklich importieren?',

	// Sizes
	'sizes'			=> array('B', 'KB', 'MB', 'GB'),
)
);
?>
