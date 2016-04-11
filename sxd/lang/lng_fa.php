<?php
// Language File for Sypex Dumper 2
$LNG = array(

// Information about the language file
'ver'				=> 20006, // Dumper version
'translated'		=> 'Mohammad Reza Mahmoudi (http://asgx.ir/)', // Contacts
'name'				=> 'Persian/فارسی', // Lang name
//'my_lang'            =>'زبان :',


// Toolbar
'tbar_backup'		=> 'صدور پایگاه داده',
'tbar_restore'		=> 'ورود پایگاه داده', 
'tbar_files'		=> 'فایل ها',
'tbar_services'		=> 'خدمات',
'tbar_options'		=> 'تنظیمات',
'tbar_createdb'		=> 'ساخت دیتابیس',
'tbar_connects'		=> 'تنظیمات اتصال',
'tbar_exit'			=> 'خروج',

// Names of objects in the tree
'obj_tables'		=> 'tables',
'obj_views'			=> 'Views',
'obj_procs'			=> 'Procedures',
'obj_funcs'			=> 'Functions',
'obj_trigs'			=> 'Triggers',
'obj_events'		=> 'Events',

// Export
'zip_max'			=> 'حداکثر',
'zip_min'			=> 'حد اقل',
'zip_none'			=> 'بدون فشرده سازی',
'default'			=> 'پیش فرض',
'combo_db'			=> ' نام پایگاه داده :', 
'combo_charset'		=> 'Charset:', 
'combo_zip'			=> 'نوع فشرده سازی :', 
'combo_comments'	=> 'توضیحات :',
'del_legend'		=> 'حذف اتوماتیک در صورتی که : ',
'del_date'			=> 'سن فایل ها بیشتر از %s روز باشد.',
'del_count'			=> 'تعداد فایل ها بیشتر از %s باشد.',
'tree'				=> 'انتخاب جداول :',
'no_saved'			=> 'فعالیتی ذخیره نشده است',
'btn_save'			=> 'ذخیره',
'btn_exec'			=> 'اجرا',

// Import	
'combo_file'		=> 'فایل :',
'combo_strategy'	=> 'نوع و روش برگرداندن :',
'ext_legend'		=> 'تنظیمات پیشرفته :',
'correct'			=> 'تصحیح خودکار Charset',
'autoinc'			=> 'ریست کردن AUTO_INCREMENT',

// Log
'status_current'	=> 'وضعیت فعلی : ',
'status_total'		=> ' وضعیت کلی : ',
'time_elapsed'		=> 'زمان سپری شده : ',
'time_left'			=> 'زمان باقی مانده : ',
'btn_stop'			=> 'لغو',
'btn_pause'			=> 'مکث',
'btn_resume'		=> 'ادامه',
'btn_again'			=> 'تکرار مجدد',
'btn_clear'			=> 'پاک کردن شرح فعالیت',

// Files
'btn_delete'		=> 'حذف',
'btn_download'		=> 'دانلود',
'btn_open'			=> 'باز کردن',

// Services
'opt_check'			=> 'تنظیمات بررسی :',
'opt_repair'		=> 'تنظیمات اصلاح :',
'btn_delete_db'		=> 'حذف پایگاه داده',
'btn_check'			=> 'بررسی',
'btn_repair'		=> 'اصلاح',
'btn_analyze'		=> 'تحلیل',
'btn_optimize'		=> 'بهینه سازی',

// Options
'cfg_legend'		=> 'تنظیمات اصلی : ',
'cfg_time_web'		=> 'محدوده زمانى در وب به ثانیه : ',
'cfg_time_cron'		=> 'محدوده زمانى cron به ثانیه : ',
'cfg_backup_path'	=> 'مسیر قرار گیری فایل پشتیبان : ',
'cfg_backup_url'	=> 'آدرس پوشه قرار گیری فایل پشتیبان : ',
'cfg_globstat'		=> 'آمار سراسری و کلی : ',
'cfg_extended'		=> 'تنظیمات پیشرفته : ',
'cfg_charsets'		=> 'Charset filter:',
'cfg_only_create'	=> 'Only create types:',
'cfg_auth'			=> 'Authorization chain:',
'cfg_confirm'		=> 'پرسش از شما در مواقع : ',
'cfg_conf_import'	=> 'وارد کردن پایگاه داده',
'cfg_conf_file'		=> 'حذف فایل ',
'cfg_conf_db'		=> 'حذف پایگاه داده',

// Connection
'con_header'		=> 'تنظیمات اتصال',
'connect'			=> ' اتصال ها',
'my_host'			=> 'هاست:',
'my_port'			=> 'پورت:',
'my_user'			=> 'نام کاربری:',
'my_pass'			=> 'رمز عبور :',
'my_pass_hidden'	=> 'رمز عبور نشان داده نمی شود',
'my_comp'			=> 'پروتکل فشرده ',
'my_db'				=> 'پایگاه های داده:',
'btn_cancel'		=> 'لغو',

// Save Job
'sj_header'			=> 'ذخیره فعالیت',
'sj_job'			=> 'شرح فعالیت',
'sj_name'			=> 'نام : ',
'sj_title'			=> 'توضیحات : ',

// Create DB
'cdb_header'		=> 'ساخت دیتابیس جدید',
'cdb_detail'		=> 'جزئیات',
'cdb_name'			=> 'نام:',
'combo_collate'		=> 'Collation:',
'btn_create'		=> 'ایجاد',

// Authorization
'js_required'		=> 'جاوا اسکریپت باید فعال باشد',
'auth'				=> 'ورود ',
'auth_user'			=> 'نام کاربری :',
'auth_remember'		=> 'به خاطر سپاری',
'btn_enter'			=> 'ورود',
'btn_details'		=> 'جزئیات',

// Log messages
'not_found_rtl'		=> 'RTL-file not exists',
'backup_begin'		=> 'Start export DB `%s`',
'backup_TC'			=> 'Export table `%s`',
'backup_VI'			=> 'Export view `%s`',
'backup_PR'			=> 'Export procedure `%s`',
'backup_FU'			=> 'Export function `%s`',
'backup_EV'			=> 'Export event `%s`',
'backup_TR'			=> 'Export trigger `%s`',
'continue_from'		=> 'from positions %s',
'backup_end'		=> 'Export database `%s` finished.',
'autodelete'		=> 'Autodelete of old files:',
'del_by_date'		=> '- `%s` - deleted (by date)',
'del_by_count'		=> '- `%s` - deleted (by count)',
'del_fail'			=> '- `%s` - delete fail',
'del_nothing'		=> '- no files to delete',
'set_names'			=> 'Set connection encoding: `%s`',
'restore_begin'		=> 'Start import DB `%s`',
'restore_TC'		=> 'Import table `%s`',
'restore_VI'		=> 'Import view `%s`',
'restore_PR'		=> 'Import procedure `%s`',
'restore_FU'		=> 'Import function `%s`',
'restore_EV'		=> 'Import event `%s`',
'restore_TR'		=> 'Import trigger `%s`',
'restore_keys'		=> 'Enable indexes',
'restore_end'		=> 'DB `%s` restored from a backup.',
'stop_1'			=> 'Execution aborted by user', 
'stop_2'			=> 'Execution stopped by user',
'stop_3'			=> 'Execution stopped by timer',
'stop_4'			=> 'Execution stopped by timeout',
'stop_5'			=> 'Execution aborted because of an error',
'job_done'			=> 'Job successful',
'file_size'			=> 'File size',
'job_time'			=> 'Time spent',
'seconds'			=> 'seconds',
'job_freeze'		=> 'The process has not been updated for more than 30 seconds. Click Resume',
'stop_job'			=> 'Stop request',

// For JS
'js' => array(
	
	// Tabs names
	'backup'		=> 'صدور پایگاه داده',
	'restore'		=> 'وارد کردن پایگاه داده',
	'log'			=> 'مراحل فعالیت سیستم',
	'result'		=> 'نتایج',
	'files'			=> 'فایل ها',
	'services'		=> 'خدمات',
	'options'		=> 'تنظیمات',

	// Tables header
	'dt'			=> 'زمان',
	'action'		=> 'اقدام',
	'db'			=> 'نام پایگاه داده',
	'type'			=> 'نوع',
	'tab'			=> 'تعداد جداول',
	'records'		=> 'تعداد رکوردها',
	'size'			=> 'سایز',
	'comment'		=> 'توضیحات',

	// AJAX Status
	'load'			=> 'در حال بارگذاری',
	'run'			=> 'در حال فعالیت...',
	'sdb'			=> 'ساخت پایگاه داده جدید',
	'sc'			=> 'ذخیره وضعیت اتصال',
	'sj'			=> 'ذخیره فعالیت',
	'so'			=> 'ذخیره تنظیمات',

	// Messages
	'pro'			=> 'شما قادر به مشاهده درون پایگاه داده نیستید',
	'err_fopen'		=> 'شما قادر به باز کردن فایل نیستید',
	'err_sxd2'		=> 'شما قادر به مشاهده درون فایل ها نیستید',
	'err_empty_db'	=> 'پایگاه داده خالی است',
	'fdc'			=> 'آیا شما برای پاک کردن  این فایل مطمئن هستید?',
	'ddc'			=> 'آیا شما برای پاک کردن  این دیتابیس مطمئن هستید?',
	'fic'			=> 'آیا شما برای وارد کردن  این فایل مطمئن هستید?',

	// Sizes
	'sizes'			=> array('B', 'KB', 'MB', 'GB'),
)
);
?>
