<?php
// Language File for Sypex Dumper 2
$LNG = array(

// Information about the language file
'ver'				=> 20005, // Dumper version
'translated'		=> 'maramazza (http://maramazza.net/)', // Contacts
'name'				=> 'Italiano', // Lang name

// Toolbar
'tbar_backup'		=> 'Esporta',
'tbar_restore'		=> 'Importa', 
'tbar_files'		=> 'Files',
'tbar_services'		=> 'Servizi',
'tbar_options'		=> 'Opzioni',
'tbar_createdb'		=> 'Crea DB',
'tbar_connects'		=> 'Connessione',
'tbar_exit'			=> 'Esci',

// Names of objects in the tree
'obj_tables'		=> 'Tabelle',
'obj_views'			=> 'Viste',
'obj_procs'			=> 'Procedure',
'obj_funcs'			=> 'Funzioni',
'obj_trigs'			=> 'Triggers',
'obj_events'		=> 'Eventi',

// Export
'zip_max'			=> 'max',
'zip_min'			=> 'min',
'zip_none'			=> 'Non Compresso',
'default'			=> 'default',
'combo_db'			=> 'Database (Schema):', 
'combo_charset'		=> 'Charset:', 
'combo_zip'			=> 'Compressione:', 
'combo_comments'	=> 'Commenti:',
'del_legend'		=> 'Autocancellazione se:',
'del_date'			=> 'i file hanno più di %s giorni',
'del_count'			=> 'numero di file maggiore a %s',
'tree'				=> 'Oggetti selezionati:',
'no_saved'			=> 'Nessun lavoro salvato',
'btn_save'			=> 'Salva',
'btn_exec'			=> 'Esegui',

// Import	
'combo_file'		=> 'File:',
'combo_strategy'	=> 'Strategia di ripristino:',
'ext_legend'		=> 'Opzioni estese:',
'correct'			=> 'Correzione Charset',
'autoinc'			=> 'Reset AUTO_INCREMENT',

// Log
'status_current'	=> 'Stato corrente:',
'status_total'		=> 'Stato Totale:',
'time_elapsed'		=> 'Trascorso:',
'time_left'			=> 'Mancante:',
'btn_stop'			=> 'Fallito',
'btn_pause'			=> 'Pausa',
'btn_resume'		=> 'Riprendere',
'btn_again'			=> 'Ripetere',
'btn_clear'			=> 'Pulire i log',

// Files
'btn_delete'		=> 'Cancella',
'btn_download'		=> 'Download',
'btn_open'			=> 'Apri',

// Services
'opt_check'			=> 'Opzioni di Controllo:',
'opt_repair'		=> 'Opzioni di Ripristino:',
'btn_delete_db'		=> 'Cancella DB',
'btn_check'			=> 'Controlla',
'btn_repair'		=> 'Ripara',
'btn_analyze'		=> 'Analizza',
'btn_optimize'		=> 'Ottimizza',

// Options
'cfg_legend'		=> 'Settaggi Base:',
'cfg_time_web'		=> 'Timelimit web (seconds):',
'cfg_time_cron'		=> 'Timelimit cron (seconds):',
'cfg_backup_path'	=> 'Path per la directory di backup:',
'cfg_backup_url'	=> 'URL per la directory di backup:',
'cfg_globstat'		=> 'Statistiche Globali:',
'cfg_extended'		=> 'Settaggi estesi:',
'cfg_charsets'		=> 'Filtro Charset:',
'cfg_only_create'	=> 'Solo i tipi creati:',
'cfg_auth'			=> 'Autorizzazione a catena:',
'cfg_confirm'		=> 'Richiesta di conferma per:',
'cfg_conf_import'	=> 'importa',
'cfg_conf_file'		=> 'file cancellato',
'cfg_conf_db'		=> 'database cancellato',

// Connection
'con_header'		=> 'Settaggi di Connessione',
'connect'			=> 'Connessione',
'my_host'			=> 'Host:',
'my_port'			=> 'Porta:',
'my_user'			=> 'Utente:',
'my_pass'			=> 'Password:',
'my_pass_hidden'	=> 'La Password non è visibile',
'my_comp'			=> 'Protocollo di compressione',
'my_db'				=> 'Databases:',
'btn_cancel'		=> 'Cancella',

// Save Job
'sj_header'			=> 'Lavoro Salvato',
'sj_job'			=> 'Lavoro',
'sj_name'			=> 'Nome (eng.):',
'sj_title'			=> 'Descrizione:',

// Create DB
'cdb_header'		=> 'Creare un nuovo database',
'cdb_detail'		=> 'Dettagli',
'cdb_name'			=> 'Nome:',
'combo_collate'		=> 'Confronto:',
'btn_create'		=> 'Creato',

// Authorization
'js_required'		=> 'I JavaScript devono essere attivati',
'auth'				=> 'Autorizzazione',
'auth_user'			=> 'Utente:',
'auth_remember'		=> 'ricorda',
'btn_enter'			=> 'Enter',
'btn_details'		=> 'Dettagli',

// Log messages
'not_found_rtl'		=> 'RTL-file non esiste',
'backup_begin'		=> 'Inizia esportazione DB `%s`',
'backup_TC'			=> 'Esportazione tabelle `%s`',
'backup_VI'			=> 'Esportazione viste `%s`',
'backup_PR'			=> 'Esportazione procedure `%s`',
'backup_FU'			=> 'Esportazione funzioni `%s`',
'backup_EV'			=> 'Esportazione eventi `%s`',
'backup_TR'			=> 'Esportazione trigger `%s`',
'continue_from'		=> 'dalla posizione %s',
'backup_end'		=> 'Esportazione database `%s` finita.',
'autodelete'		=> 'Autocancellazione dei vecchi file:',
'del_by_date'		=> '- `%s` - cancellato (per data)',
'del_by_count'		=> '- `%s` - cancellato (per numero file)',
'del_fail'			=> '- `%s` - cancellazione fallita',
'del_nothing'		=> '- nessun file da cancellare',
'set_names'			=> 'Setta la codifica della connessione: `%s`',
'restore_begin'		=> 'Inizia importazione DB `%s`',
'restore_TC'		=> 'Importa tabelle `%s`',
'restore_VI'		=> 'Importa viste `%s`',
'restore_PR'		=> 'Importa procedure `%s`',
'restore_FU'		=> 'Importa funzioni `%s`',
'restore_EV'		=> 'Importa eventi `%s`',
'restore_TR'		=> 'Importa trigger `%s`',
'restore_keys'		=> 'Attiva Indici',
'restore_end'		=> 'DB `%s` ripristinato dal backup.',
'stop_1'			=> 'Esecuzione fallita dall utente', 
'stop_2'			=> 'Esecuzione fermata dall utente',
'stop_3'			=> 'Esecuzione fermata dal timer',
'stop_4'			=> 'Esecuzione fermata per timeout',
'stop_5'			=> 'Esecuzione fallita per un errore',
'job_done'			=> 'Lavoro eseguito correttamente',
'file_size'			=> 'Grandezza File',
'job_time'			=> 'Tempo speso',
'seconds'			=> 'secondi',
'job_freeze'			=> 'Il processo non può essere aggiornato per almeno 30 secondi. Clicca Riprendere',
'stop_job'			=> 'Basta richieste',

// For JS
'js' => array(
	
	// Tabs names
	'backup'		=> 'Esporta database (schema)',
	'restore'		=> 'Importa database (schema)',
	'log'			=> 'Log',
	'result'		=> 'Risultati',
	'files'		=> 'Files',
	'services'		=> 'Servizi',
	'options'		=> 'Opzioni',

	// Tables header
	'dt'			=> 'Data/ora',
	'action'		=> 'Azione',
	'db'			=> 'Database',
	'type'			=> 'Tipo',
	'tab'			=> 'Tabelle',
	'records'		=> 'Dati',
	'size'			=> 'Grandezza',
	'comment'		=> 'Commenti',

	// AJAX Status
	'load'			=> 'Aspetta',
	'run'			=> 'Al lavoro...',
	'sdb'			=> 'Crea nuovo Database',
	'sc'			=> 'Salva connessioni',
	'sj'			=> 'Salva lavoro',
	'so'			=> 'Salva opzioni',

	// Messages
	'pro'			=> 'Opzione accessibile solo nella versione Pro',
	'err_fopen'		=> 'Impossibile aprire il file',
	'err_sxd2'		=> 'Vedi il contenuto del file accessibile solo per i file creati tramite Sypex Dumper 2',
	'err_empty_db'	=> 'Il Database è vuoto',
	'fdc'			=> 'Vuoi veramente cancellare il file?',
	'ddc'			=> 'Vuoi veramente cancellare il database?',
	'fic'			=> 'Vuoi veramente importare il file?',

	// Sizes
	'sizes'			=> array('B', 'KB', 'MB', 'GB'),
)
);
?>
