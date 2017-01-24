<?php
// Taalbestand voor Sypex Dumper 2
$LNG = array(

// Information about the language file
'ver'				=> 20005, // Dumper versie
'translated'		=> 'Jelmer Smid (http://www.lagoworks.nl/)', // Contactinfo
'name'				=> 'Nederlands', // Taalnaam

// Toolbar
'tbar_backup'		=> 'Exporteren',
'tbar_restore'		=> 'Importeren', 
'tbar_files'		=> 'Bestanden',
'tbar_services'		=> 'Diensten',
'tbar_options'		=> 'Opties',
'tbar_createdb'		=> 'DB maken',
'tbar_connects'		=> 'Connectie',
'tbar_exit'			=> 'Beëindigen',

// Namen van de objecten in de hyrarchie
'obj_tables'		=> 'Tabellen',
'obj_views'			=> 'Overzichten',
'obj_procs'			=> 'Procedures',
'obj_funcs'			=> 'Functies',
'obj_trigs'			=> 'Triggers',
'obj_events'		=> 'Gebeurtenissen',

// Exporteren
'zip_max'			=> 'max',
'zip_min'			=> 'min',
'zip_none'			=> 'Niet gecomprimeerd',
'default'			=> 'Standaard',
'combo_db'			=> 'Database (Schema):', 
'combo_charset'		=> 'Karakterset:', 
'combo_zip'			=> 'Compressie:', 
'combo_comments'	=> 'Commentaar:',
'del_legend'		=> 'Automatisch verwijderen als:',
'del_date'			=> 'de leeftijd van de bestanden groter is dan %s dagen',
'del_count'			=> 'meer dan %s bestanden',
'tree'				=> 'Selecteer objecten:',
'no_saved'			=> 'Geen opgeslagen bewerkingen',
'btn_save'			=> 'Opslaan',
'btn_exec'			=> 'Uitvoeren',

// Importeren	
'combo_file'		=> 'Bestand:',
'combo_strategy'	=> 'Herstel strategie:',
'ext_legend'		=> 'Opties uitbreiden:',
'correct'			=> 'Karakterset correctie',
'autoinc'			=> 'Herstel AUTO_INCREMENT',

// Log
'status_current'	=> 'Huidige status:',
'status_total'		=> 'Totale status:',
'time_elapsed'		=> 'Verstreken:',
'time_left'			=> 'over:',
'btn_stop'			=> 'Abort',
'btn_pause'			=> 'Pause',
'btn_resume'		=> 'Verdergaan',
'btn_again'			=> 'Herhalen',
'btn_clear'			=> 'log leegnmaken',

// Bestanden
'btn_delete'		=> 'Verwijderen',
'btn_download'		=> 'Download',
'btn_open'			=> 'Openen',

// Diensten
'opt_check'			=> 'Opties voor Controle:',
'opt_repair'		=> 'Opties voor het Herstellen:',
'btn_delete_db'		=> 'DB verwijderen',
'btn_check'			=> 'Controle',
'btn_repair'		=> 'Repareren',
'btn_analyze'		=> 'Analiseren',
'btn_optimize'		=> 'Optimalizeren',

// Options
'cfg_legend'		=> 'Basis instellingen:',
'cfg_time_web'		=> 'Tijdslimiet web (secondes):',
'cfg_time_cron'		=> 'Tijdslimiet cron (secondes):',
'cfg_backup_path'	=> 'Pad naar backup bestandsmap:',
'cfg_backup_url'	=> 'URL naar backup bestandsmap:',
'cfg_globstat'		=> 'Algemene statistieken:',
'cfg_extended'		=> 'Uitgebreide instellingen:',
'cfg_charsets'		=> 'Karakterset filter:',
'cfg_only_create'	=> 'Alleen deze types maken:',
'cfg_auth'			=> 'Autorisatie schakeling:',
'cfg_confirm'		=> 'Vraag bevestiging voor:',
'cfg_conf_import'	=> 'importeren',
'cfg_conf_file'		=> 'bestand verwijderen',
'cfg_conf_db'		=> 'database verwijderen',

// Connection
'con_header'		=> 'Connectie Instellingen',
'connect'			=> 'Connectie',
'my_host'			=> 'Host:',
'my_port'			=> 'Poort:',
'my_user'			=> 'Gebruiker:',
'my_pass'			=> 'Wachtwoord:',
'my_pass_hidden'	=> 'Wachtwoord zal niet te zien zijn',
'my_comp'			=> 'Compressie protocol',
'my_db'				=> 'Databases:',
'btn_cancel'		=> 'Annuleren',

// Save Job
'sj_header'			=> 'Bewerking opslaan',
'sj_job'			=> 'Bewerking',
'sj_name'			=> 'Naam (eng.):',
'sj_title'			=> 'Beschrijving:',

// Create DB
'cdb_header'		=> 'Nieuwe database maken',
'cdb_detail'		=> 'Details',
'cdb_name'			=> 'Naam:',
'combo_collate'		=> 'Collation:',
'btn_create'		=> 'Maken',

// Authorization
'js_required'		=> 'JavaScript moet aan staan',
'auth'				=> 'Autorisatie',
'auth_user'			=> 'Gebruiker:',
'auth_remember'		=> 'onthouden',
'btn_enter'			=> 'Invoeren',
'btn_details'		=> 'Details',

// Log messages
'not_found_rtl'		=> 'RTL-file bestaat niet',
'backup_begin'		=> 'Starten DB export `%s`',
'backup_TC'			=> 'Exporteren tabel `%s`',
'backup_VI'			=> 'Exporteren overzicht `%s`',
'backup_PR'			=> 'Exporteren procedure `%s`',
'backup_FU'			=> 'Exporteren functies `%s`',
'backup_EV'			=> 'Exporteren gebeurtenissen `%s`',
'backup_TR'			=> 'Exporteren trigger `%s`',
'continue_from'		=> 'van positie %s',
'backup_end'		=> 'Exporteren database `%s` beëindigd.',
'autodelete'		=> 'Automatisch verwijderen van oude bestanden:',
'del_by_date'		=> '- `%s` - verwijderd (by datum)',
'del_by_count'		=> '- `%s` - verwijderd (by hoeveelheid)',
'del_fail'			=> '- `%s` - verwijderdering mislukt',
'del_nothing'		=> '- er zijn geen bestanden te verwijderen',
'set_names'			=> 'Connectie encodering instellen: `%s`',
'restore_begin'		=> 'Begin importeren DB `%s`',
'restore_TC'		=> 'Importeer tabel `%s`',
'restore_VI'		=> 'Importeer overzicht `%s`',
'restore_PR'		=> 'Importeer procedure `%s`',
'restore_FU'		=> 'Importeer functies `%s`',
'restore_EV'		=> 'Importeer gebeurtenis `%s`',
'restore_TR'		=> 'Import trigger `%s`',
'restore_keys'		=> 'Indices aanzetten',
'restore_end'		=> 'DB `%s` hersteld van een backup.',
'stop_1'			=> 'Uitvoering geannuleerd door de gebruiker', 
'stop_2'			=> 'Uitvoering gestopt door de gebruiker',
'stop_3'			=> 'Uitvoering gestopt by timer',
'stop_4'			=> 'Uitvoering gestopt by timeout',
'stop_5'			=> 'Uitvoering geannuleerd door een error',
'job_done'			=> 'Bewerking succesvol',
'file_size'			=> 'Bestandsgrootte',
'job_time'			=> 'Tijd verstreken',
'seconds'			=> 'secondes',
'job_freeze'		=> 'De bewerking is langer dan 30 seconden niet geupdate. Klik Verder gaan',
'stop_job'			=> 'Stop de aanvraag',

// For JS
'js' => array(
	
	// Tabs names
	'backup'		=> 'Exporteer database (schema)',
	'restore'		=> 'Importeer database (schema)',
	'log'			=> 'Log',
	'result'		=> 'Resultaat',
	'files'			=> 'Bestanden',
	'services'		=> 'Diensten',
	'options'		=> 'Opties',

	// Tables header
	'dt'			=> 'Datum/tijd',
	'action'		=> 'Actie',
	'db'			=> 'Database',
	'type'			=> 'Type',
	'tab'			=> 'Tabs',
	'records'		=> 'Records',
	'size'			=> 'Grootte',
	'comment'		=> 'Commentaar',

	// AJAX Status
	'load'			=> 'Verwerken',
	'run'			=> 'Bezig...',
	'sdb'			=> 'Nieuwe database aanmaken',
	'sc'			=> 'Connectie opslaan',
	'sj'			=> 'Bewerking opslaan',
	'so'			=> 'Opties opslaan',

	// Messages
	'pro'			=> 'Optie alleen beschikbaar in de in Pro-versie',
	'err_fopen'		=> 'Het lukt niet het bestand te openen',
	'err_sxd2'		=> 'Het bekijken van de bestandsinhoud is alleen mogelijk bij bestanden die gemaakt zijn door Sypex Dumper 2',
	'err_empty_db'	=> 'Database is leeg',
	'fdc'			=> 'Weet je zeker dat je dit bestand wilt verwijderen?',
	'ddc'			=> 'Weet je zeker dat je deze database wilt verwijderen?',
	'fic'			=> 'Weet je zeker dat je dit bestand wilt importeren?',

	// Sizes
	'sizes'			=> array('B', 'KB', 'MB', 'GB'),
)
);
?>
