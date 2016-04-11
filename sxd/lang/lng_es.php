<?php
// Language File for Sypex Dumper 2
$LNG = array(

// Information about the language file
'ver'				=> 20005, // Dumper version
'translated'		=> 'David Amador T. (http://www.davphantom.net/)', // Contacts
'name'				=> 'Español', // Lang name

// Toolbar
'tbar_backup'		=> 'Exportar',
'tbar_restore'		=> 'Importar', 
'tbar_files'		=> 'Archivos',
'tbar_services'		=> 'Servicios',
'tbar_options'		=> 'Opciones',
'tbar_createdb'		=> 'Crear DB',
'tbar_connects'		=> 'Conexión',
'tbar_exit'			=> 'Salir',

// Names of objects in the tree
'obj_tables'		=> 'Tablas',
'obj_views'			=> 'Vistas',
'obj_procs'			=> 'Procedimientos',
'obj_funcs'			=> 'Funciones',
'obj_trigs'			=> 'Triggers',
'obj_events'		=> 'Eventos',

// Export
'zip_max'			=> 'max',
'zip_min'			=> 'min',
'zip_none'			=> 'Sin comprimir',
'default'			=> 'Por defecto',
'combo_db'			=> 'Base de Datos (Schema):', 
'combo_charset'		=> 'Charset:', 
'combo_zip'			=> 'Compresión:', 
'combo_comments'	=> 'Comentarios:',
'del_legend'		=> 'Autodelete if:',
'del_date'			=> 'edad de los archivos de más de %s días',
'del_count'			=> 'número de archivos de más de %s',
'tree'				=> 'Objetos seleccionados:',
'no_saved'			=> 'No hay trabajos guardados',
'btn_save'			=> 'Guardar',
'btn_exec'			=> 'Ejecutar',

// Import	
'combo_file'		=> 'Archivo:',
'combo_strategy'	=> 'Estrategia de importación:',
'ext_legend'		=> 'Opciones extendidas:',
'correct'			=> 'Charset correction',
'autoinc'			=> 'Reiniciar AUTO_INCREMENT',

// Log
'status_current'	=> 'Estado actual:',
'status_total'		=> 'Estado total:',
'time_elapsed'		=> 'Elapsed:',
'time_left'			=> 'Left:',
'btn_stop'			=> 'Abortar',
'btn_pause'			=> 'Pausar',
'btn_resume'		=> 'Reiniciar',
'btn_again'			=> 'Repetir',
'btn_clear'			=> 'Limpiar log',

// Files
'btn_delete'		=> 'Eliminar',
'btn_download'		=> 'Descargar',
'btn_open'			=> 'Abrir',

// Services
'opt_check'			=> 'Opciones para Check:',
'opt_repair'		=> 'Opciones para Repair:',
'btn_delete_db'		=> 'Eliminar DB',
'btn_check'			=> 'Verificar',
'btn_repair'		=> 'Reparar',
'btn_analyze'		=> 'Analizar',
'btn_optimize'		=> 'Optimizar',

// Options
'cfg_legend'		=> 'Configuración básica:',
'cfg_time_web'		=> 'Tiempo límite web (segundos):',
'cfg_time_cron'		=> 'Tiempo límite de tarea (segundos):',
'cfg_backup_path'	=> 'Ruta de directorio de backups:',
'cfg_backup_url'	=> 'URL para directorio de backup:',
'cfg_globstat'		=> 'Estadísticas globales:',
'cfg_extended'		=> 'Configuración extendida:',
'cfg_charsets'		=> 'Charset filter:',
'cfg_only_create'	=> 'Sólo crear tipos:',
'cfg_auth'			=> 'Authorization chain:',
'cfg_confirm'		=> 'Preguntar confirmación para:',
'cfg_conf_import'	=> 'importar',
'cfg_conf_file'		=> 'eliminar archivo',
'cfg_conf_db'		=> 'eliminar base de datos',

// Connection
'con_header'		=> 'Configuración de conexión',
'connect'			=> 'Conexión',
'my_host'			=> 'Host:',
'my_port'			=> 'Puerto:',
'my_user'			=> 'Usuario:',
'my_pass'			=> 'Password:',
'my_pass_hidden'	=> 'Password no se mostrará',
'my_comp'			=> 'Protocolo comprimido ',
'my_db'				=> 'Bases de datos:',
'btn_cancel'		=> 'Cancelar',

// Save Job
'sj_header'			=> 'Guardar tarea',
'sj_job'			=> 'Tarea',
'sj_name'			=> 'Nombre (ejem.):',
'sj_title'			=> 'Descripción:',

// Create DB
'cdb_header'		=> 'Crear nueva base de datos',
'cdb_detail'		=> 'Detalles',
'cdb_name'			=> 'Nombre:',
'combo_collate'		=> 'Collation:',
'btn_create'		=> 'Crear',

// Authorization
'js_required'		=> 'JavaScript debe estar habilitado',
'auth'				=> 'Authorización',
'auth_user'			=> 'Usuario:',
'auth_remember'		=> 'Recordar',
'btn_enter'			=> 'Aceptar',
'btn_details'		=> 'Detalles',

// Log messages
'not_found_rtl'		=> 'RTL-archivo no existe',
'backup_begin'		=> 'Iniciar exportar `%s`',
'backup_TC'			=> 'Exportar tabla `%s`',
'backup_VI'			=> 'Exportar vista `%s`',
'backup_PR'			=> 'Exportar procedimiento `%s`',
'backup_FU'			=> 'Exportar función `%s`',
'backup_EV'			=> 'Exportar evento `%s`',
'backup_TR'			=> 'Exportar trigger `%s`',
'continue_from'		=> 'from positions %s',
'backup_end'		=> 'Exportar base de datos `%s` finalizó.',
'autodelete'		=> 'Autoborrar archivos antiguos:',
'del_by_date'		=> '- `%s` - borrado (por fecha)',
'del_by_count'		=> '- `%s` - borrado (por número)',
'del_fail'			=> '- `%s` - eliminación falló',
'del_nothing'		=> '- Ningún archivo a eliminar',
'set_names'			=> 'Set connection encoding: `%s`',
'restore_begin'		=> 'Iniciar importación DB `%s`',
'restore_TC'		=> 'Importar tabla `%s`',
'restore_VI'		=> 'Importar vista `%s`',
'restore_PR'		=> 'Importar procedimiento `%s`',
'restore_FU'		=> 'Importar función `%s`',
'restore_EV'		=> 'Importar evento `%s`',
'restore_TR'		=> 'Importar trigger `%s`',
'restore_keys'		=> 'Habilitar indies',
'restore_end'		=> 'DB `%s` restaurar desde una copia de seguridad.',
'stop_1'			=> 'Ejecución abortada por el usuario', 
'stop_2'			=> 'Ejecución detenida por el usuario',
'stop_3'			=> 'Ejecución detenida por timer',
'stop_4'			=> 'Ejecución detenida por timeout',
'stop_5'			=> 'Ejecución aborted because of an error',
'job_done'			=> 'Job successful',
'file_size'			=> 'Tamańo de archivo',
'job_time'			=> 'tiempo transcurrido',
'seconds'			=> 'segundos',
'job_freeze'		=> 'El proceso no ha sido actualizado desde hace más de 30 segundos. Haga clic en Reanudar',
'stop_job'			=> 'Detener tarea',

// For JS
'js' => array(
	
	// Tabs names
	'backup'		=> 'Exportar base de datos (schema)',
	'restore'		=> 'Importar base de datos (schema)',
	'log'			=> 'Log',
	'result'		=> 'Resultados',
	'files'			=> 'Archivos',
	'services'		=> 'Servicios',
	'options'		=> 'Opciones',

	// Tables header
	'dt'			=> 'Fecha/hora',
	'action'		=> 'Acción',
	'db'			=> 'Base de datos',
	'type'			=> 'Tipo',
	'tab'			=> 'Tabs',
	'records'		=> 'Registros',
	'size'			=> 'Tamańo',
	'comment'		=> 'Comentarios',

	// AJAX Status
	'load'			=> 'Cargando',
	'run'			=> 'Ejecutando...',
	'sdb'			=> 'Crear base de datos',
	'sc'			=> 'Guardar conexión',
	'sj'			=> 'Guardar tarea',
	'so'			=> 'Guardar opciones',

	// Messages
	'pro'			=> 'Opciones disponibles solo en la versión Profesional',
	'err_fopen'		=> 'No es posible abrir el archivo',
	'err_sxd2'		=> 'View file contents available only for files created by Sypex Dumper 2',
	'err_empty_db'	=> 'Base de datos está vacía',
	'fdc'			=> 'żEstá Usted seguro que desea eliminar el archivo?',
	'ddc'			=> 'żEstá Usted seguro que desea eliminar la base de datos?',
	'fic'			=> 'żEstá Usted seguro que desea importar el archivo?',

	// Sizes
	'sizes'			=> array('B', 'KB', 'MB', 'GB'),
)
);
?>
