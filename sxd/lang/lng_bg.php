<?php
// Language File for Sypex Dumper 2
$LNG = array(

// Information about the language file
'ver'				=> 20005, // Dumper version
'translated'		=> 'InvisionBG (http://invisionbg.com/)', // Contacts
'name'				=> 'Български', // Lang name

// Toolbar
'tbar_backup'		=> 'Ескпорт',
'tbar_restore'		=> 'Импорт', 
'tbar_files'		=> 'Файлове',
'tbar_services'		=> 'Операции',
'tbar_options'		=> 'Настройки',
'tbar_createdb'		=> 'Създаване на БД',
'tbar_connects'		=> 'Свързване',
'tbar_exit'			=> 'Изход',

// Names of objects in the tree
'obj_tables'		=> 'Таблици',
'obj_views'			=> 'Прегледи',
'obj_procs'			=> 'Процедури',
'obj_funcs'			=> 'Функции',
'obj_trigs'			=> 'Тригери',
'obj_events'		=> 'Събития',

// Export
'zip_max'			=> 'максимум',
'zip_min'			=> 'минимум',
'zip_none'			=> 'Без компресия',
'default'			=> 'по подразбиране',
'combo_db'			=> 'База данни:', 
'combo_charset'		=> 'Кодировка:', 
'combo_zip'			=> 'Компресия:', 
'combo_comments'	=> 'Коментар:',
'del_legend'		=> 'Автоматично изтриване ако:',
'del_date'			=> 'файловете са по-стари от %s дена',
'del_count'			=> 'броят на файловете е повече от %s',
'tree'				=> 'Изберете обекти:',
'no_saved'			=> 'Няма съхранени задачи',
'btn_save'			=> 'Съхрани',
'btn_exec'			=> 'Изпълни',

// Import	
'combo_file'		=> 'Файл:',
'combo_strategy'	=> 'Стратегия за възстановяване:',
'ext_legend'		=> 'Допълнителни опции:',
'correct'			=> 'Промяна на кодировката',
'autoinc'			=> 'Занули AUTO_INCREMENT',

// Log
'status_current'	=> 'Текущ статус:',
'status_total'		=> 'Общ статус:',
'time_elapsed'		=> 'Изминало време:',
'time_left'			=> 'Оставащо време:',
'btn_stop'			=> 'Прекъсни',
'btn_pause'			=> 'Пауза',
'btn_resume'		=> 'Продължи',
'btn_again'			=> 'Повтори',
'btn_clear'			=> 'Изчисти лога',

// Files
'btn_delete'		=> 'Изтрий',
'btn_download'		=> 'Свали',
'btn_open'			=> 'Отвори',

// Services
'opt_check'			=> 'Опции за проверка:',
'opt_repair'		=> 'Опции за поправка:',
'btn_delete_db'		=> 'Изтриване на БД',
'btn_check'			=> 'Проверка',
'btn_repair'		=> 'Поправка',
'btn_analyze'		=> 'Анализ',
'btn_optimize'		=> 'Оптимизация',

// Options
'cfg_legend'		=> 'Основни настройки:',
'cfg_time_web'		=> 'Време за изпълнение в web (сек.):',
'cfg_time_cron'		=> 'Време за изпълнение на cron (сек.):',
'cfg_backup_path'	=> 'Път към папката backup:',
'cfg_backup_url'	=> 'URL до папката backup:',
'cfg_globstat'		=> 'Подробна статистика:',
'cfg_extended'		=> 'Допълнителни настройки:',
'cfg_charsets'		=> 'Филтър за кодировката:',
'cfg_only_create'	=> 'Експорт само на структури:',
'cfg_auth'			=> 'Авторизация чрез:',
'cfg_confirm'		=> 'Изисквай потвърждение за:',
'cfg_conf_import'	=> 'импорт на БД',
'cfg_conf_file'		=> 'изтриване на файла',
'cfg_conf_db'		=> 'изтриване на БД',

// Connection
'con_header'		=> 'Настройки на връзката',
'connect'			=> 'Връзка',
'my_host'			=> 'Хост:',
'my_port'			=> 'Порт:',
'my_user'			=> 'Потребител:',
'my_pass'			=> 'Парола:',
'my_pass_hidden'	=> 'Паролата е скрита',
'my_comp'			=> 'Протокол за компресия',
'my_db'				=> 'Бази данни:',
'btn_cancel'		=> 'Отказ',

// Save Job
'sj_header'			=> 'Съхрани задачата',
'sj_job'			=> 'Задача',
'sj_name'			=> 'Име (англ.):',
'sj_title'			=> 'Описание:',

// Create DB
'cdb_header'		=> 'Създаване на нова БД',
'cdb_detail'		=> 'Подробности',
'cdb_name'			=> 'Име:',
'combo_collate'		=> 'Сравнение:',
'btn_create'		=> 'Създай',

// Authorization
'js_required'		=> 'JavaScript трябва да е включен',
'auth'				=> 'Вход',
'auth_user'			=> 'Потребител:',
'auth_remember'		=> 'Запомни ме',
'btn_enter'			=> 'Вход',
'btn_details'		=> 'Подробности',

// Log messages
'not_found_rtl'		=> 'RTL-файла не съществува',
'backup_begin'		=> 'Начало на експорта на БД `%s`',
'backup_TC'			=> 'Експорт на таблица `%s`',
'backup_VI'			=> 'Експорт на преглед `%s`',
'backup_PR'			=> 'Експорт на процедура `%s`',
'backup_FU'			=> 'Експорт на функция `%s`',
'backup_EV'			=> 'Експорт на събитие `%s`',
'backup_TR'			=> 'Експорт на тригер `%s`',
'continue_from'		=> 'от позиции %s',
'backup_end'		=> 'Експортът на база данни `%s` е завършен.',
'autodelete'		=> 'Автоматично изтриване на стари файлове:',
'del_by_date'		=> '- `%s` - изтрити (по дата)',
'del_by_count'		=> '- `%s` - изтрити (по брой)',
'del_fail'			=> '- `%s` - не са изтрити',
'del_nothing'		=> '- няма файлове за изтриване',
'set_names'			=> 'Избрана кодировка за връзка с БД: `%s`',
'restore_begin'		=> 'Начало на импорт на БД `%s`',
'restore_TC'		=> 'Импорт на таблица `%s`',
'restore_VI'		=> 'Импорт на преглед `%s`',
'restore_PR'		=> 'Импорт на процедура `%s`',
'restore_FU'		=> 'Импорт на фунцкия `%s`',
'restore_EV'		=> 'Импорт на събитие `%s`',
'restore_TR'		=> 'Импорт на тригер `%s`',
'restore_keys'		=> 'Включване на индексите',
'restore_end'		=> 'БД `%s` е възстановена от резервното копие.',
'stop_1'			=> 'Изпълнението е прекъснато от потребителя', 
'stop_2'			=> 'Изпълнението е спряно от потребителя',
'stop_3'			=> 'Изпълнението е спряно от таймера',
'stop_4'			=> 'Изпълнението е спряно заради забавяне',
'stop_5'			=> 'Изпълнението е прекъснато заради грешка',
'job_done'			=> 'Задачата е изпълнена успешно',
'file_size'			=> 'Размер на файла',
'job_time'			=> 'Време за изпълнение',
'seconds'			=> 'секунди',
'job_freeze'		=> 'Процесът не е обновяван повече от 30 секунди. Натиснете Продължи',
'stop_job'			=> 'Заявка за спиране',

// For JS
'js' => array(
	
	// Tabs names
	'backup'		=> 'Създаване на резервно копие на БД',
	'restore'		=> 'Възстановяване на БД',
	'log'			=> 'Лог',
	'result'		=> 'Резултати',
	'files'			=> 'Файлове',
	'services'		=> 'Операции с базите данни',
	'options'		=> 'Настройки на програмата',

	// Tables header
	'dt'			=> 'Дата/време',
	'action'		=> 'Действие',
	'db'			=> 'База данни',
	'type'			=> 'Тип',
	'tab'			=> 'Таблици',
	'records'		=> 'Записи',
	'size'			=> 'Размер',
	'comment'		=> 'Коментари',

	// AJAX Status
	'load'			=> 'Зареждане',
	'run'			=> 'Изпълнение...',
	'sdb'			=> 'Създаване на база данни',
	'sc'			=> 'Запазване на свързването',
	'sj'			=> 'Запазване на задачата',
	'so'			=> 'Опции за съхраняване',

	// Messages
	'pro'			=> 'Само в Pro-версията',
	'err_fopen'		=> 'Файлът не може да бъде отворен',
	'err_sxd2'		=> 'Разглеждането на съдържанието на файла е възможно само за файлове, създадени от Sypex Dumper 2',
	'err_empty_db'	=> 'Базата данни е празна',
	'fdc'			=> 'Наистина ли искате да изтриете този файл?',
	'ddc'			=> 'Наистина ли искате да изтриете базата данни?',
	'fic'			=> 'Наистина ли искате да импортирате файла?',

	// Sizes
	'sizes'			=> array('B', 'KB', 'MB', 'GB'),
)
);
?>
