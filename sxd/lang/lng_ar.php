<?php
// Language File for Sypex Dumper 2
$LNG = array(

// Information about the language file
'ver'				=> 20004, // Dumper version
'translated'		=> 'Reko24', // Contacts
'name'				=> 'Arabic', // Lang name

// Toolbar
'tbar_backup'		=> 'تصدير',
'tbar_restore'		=> 'استيراد', 
'tbar_files'		=> 'ملفات',
'tbar_services'		=> 'الخدمات',
'tbar_options'		=> 'الخيارات',
'tbar_createdb'		=> 'انشاء قاعدة بيانات',
'tbar_connects'		=> 'اتصال',
'tbar_exit'			=> 'خروج',

// Names of objects in the tree
'obj_tables'		=> 'جداول',
'obj_views'			=> 'عرض',
'obj_procs'			=> 'اجرائات',
'obj_funcs'			=> 'دوال',
'obj_trigs'			=> 'مشغلات',
'obj_events'		=> 'احداث',

// Export
'zip_max'			=> 'الحد الاقصي',
'zip_min'			=> 'الحد الادني',
'zip_none'			=> 'فك الضغط',
'default'			=> 'افتراضي',
'combo_db'			=> 'قاعدة البيانات (Schema):', 
'combo_charset'		=> 'الترميز:', 
'combo_zip'			=> 'ضغط:', 
'combo_comments'	=> 'تعليق:',
'del_legend'		=> 'حذف اذا:',
'del_date'			=> 'حذف بعد %s ايام',
'del_count'			=> 'عدد الملفات اكثر من %s',
'tree'				=> 'اختار:',
'no_saved'			=> 'لا توجد طلبات محفوظه',
'btn_save'			=> 'حفظ',
'btn_exec'			=> 'تنفيذ',

// Import	
'combo_file'		=> 'ملف:',
'combo_strategy'	=> 'Restore strategy:',
'ext_legend'		=> 'خيارات موسعة:',
'correct'			=> 'محارف التصحيح',
'autoinc'			=> 'Reset AUTO_INCREMENT',

// Log
'status_current'	=> 'الاحصائيات الحاليه:',
'status_total'		=> 'الاحصائيات الكليه:',
'time_elapsed'		=> 'Elapsed:',
'time_left'			=> 'ترك:',
'btn_stop'			=> 'الغاء',
'btn_pause'			=> 'ايقاف',
'btn_resume'		=> 'استكمال',
'btn_again'			=> 'تكرار',
'btn_clear'			=> 'مسح السجل',

// Files
'btn_delete'		=> 'حذف',
'btn_download'		=> 'تحميل',
'btn_open'			=> 'فتح',

// Services
'opt_check'			=> 'خيارات الفحص:',
'opt_repair'		=> 'خيارات الاصلاح:',
'btn_delete_db'		=> 'حذف القاعده',
'btn_check'			=> 'فصح',
'btn_repair'		=> 'صيانه',
'btn_analyze'		=> 'تحليل',
'btn_optimize'		=> 'تحسين',

// Options
'cfg_legend'		=> 'الخيارات الاساسيه:',
'cfg_time_web'		=> 'الوقت المحدد (بالثانية):',
'cfg_time_cron'		=> 'وقت تنفيذ ال cron (بالثانية):',
'cfg_backup_path'	=> 'مسار حفظ الباك اب:',
'cfg_backup_url'	=> 'الرابط لمكان التخزين:',
'cfg_globstat'		=> 'الاحصائيات العامة:',
'cfg_extended'		=> 'الخيارات الاضافيه:',
'cfg_charsets'		=> 'فلتر الحروف:',
'cfg_only_create'	=> 'إنشاء أنواع فقط:',
'cfg_auth'			=> 'سلسلة التحويل:',
'cfg_confirm'		=> 'اطلب تاكيد لـ:',
'cfg_conf_import'	=> 'استيراد',
'cfg_conf_file'		=> 'حذف الملف',
'cfg_conf_db'		=> 'حذف قاعدة البيانات',

// Connection
'con_header'		=> 'اعدادات التصال',
'connect'			=> 'الاتصال',
'my_host'			=> 'المستضيف:',
'my_port'			=> 'المنفذ:',
'my_user'			=> 'اسم المستخدم:',
'my_pass'			=> 'كلمة السر:',
'my_pass_hidden'	=> 'كلمة السر لا يظهر',
'my_comp'			=> 'ضغط البروتوكول',
'my_db'				=> 'قواعد البيانات:',
'btn_cancel'		=> 'الغاء',

// Save Job
'sj_header'			=> 'حفظ المهمه',
'sj_job'			=> 'المهمه',
'sj_name'			=> 'الاسم (eng.):',
'sj_title'			=> 'الوصف:',

// Create DB
'cdb_header'		=> 'انشاء قاعدة بيانات جديدة',
'cdb_detail'		=> 'التفاصيل',
'cdb_name'			=> 'اسم المستخدم:',
'combo_collate'		=> 'الترتيب:',
'btn_create'		=> 'انشاء',

// Authorization
'js_required'		=> 'يجب تمكين الجافة سكربت',
'auth'				=> 'الاذن',
'auth_user'			=> 'اسم المستخدم:',
'auth_remember'		=> 'تذكر',
'btn_enter'			=> 'دخول',
'btn_details'		=> 'التفاصيل',

// Log messages
'not_found_rtl'		=> 'ملف الـ RTL غير موجود',
'backup_begin'		=> 'بدأ تصدير قاعدة بيانات `%s`',
'backup_TC'			=> 'تصدير جدول `%s`',
'backup_VI'			=> 'تصدير عرض `%s`',
'backup_PR'			=> 'تصدير الاجراءات `%s`',
'backup_FU'			=> 'تصدير الدالة `%s`',
'backup_EV'			=> 'تصدير الحدث `%s`',
'backup_TR'			=> 'تصدير trigger `%s`',
'continue_from'		=> 'من مواقع %s',
'backup_end'		=> 'تصدير قاعدة البيانات `%s` انتهى.',
'autodelete'		=> 'حذف الملفات القديمة تلقائيا:',
'del_by_date'		=> '- `%s` - حذف (حسب التاريخ)',
'del_by_count'		=> '- `%s` - حذف (بالجرد)',
'del_fail'			=> '- `%s` - حذف الملف',
'del_nothing'		=> '- لا تحذف الملف',
'set_names'			=> 'اختر مجموعة الترميز: `%s`',
'restore_begin'		=> 'بدأ استيراد قاعدة البيانات `%s`',
'restore_TC'		=> 'استيراد الجدول `%s`',
'restore_VI'		=> 'استيراد العرض `%s`',
'restore_PR'		=> 'اسستيراد الاجرائات `%s`',
'restore_FU'		=> 'استيراد الدالة `%s`',
'restore_EV'		=> 'استيراد الحدث `%s`',
'restore_TR'		=> 'استيراد trigger `%s`',
'restore_keys'		=> 'تمكين indexes',
'restore_end'		=> 'قاعدة البيانات `%s` استعادة من نسخة احتياطية.',
'stop_1'			=> 'احباط التنفيز من قبل المستخدم', 
'stop_2'			=> 'ايقاف التنفيذ من قبل المستخدم',
'stop_3'			=> 'ايقاف تفيذ موقت',
'stop_4'			=> 'انتهاء مدة التنفيذ',
'stop_5'			=> 'ايقاف التنفيذ بسبب خطأ',
'job_done'			=> 'المهمة نجحت',
'file_size'			=> 'حجم الملف',
'job_time'			=> 'الوقت المنقضي',
'seconds'			=> 'ثواني',
'job_freeze'		=> 'هذه العملية لم يتم تحديثه لأكثر من 30 ثانية. اضغط متابعة',
'stop_job'			=> 'ايقاف الطلب',

// For JS
'js' => array(
	
	// Tabs names
	'backup'		=> 'تصدير قاعدة البيانات (schema)',
	'restore'		=> 'استيراد قاعدة البيانات (schema)',
	'log'			=> 'السجل',
	'result'		=> 'Results',
	'files'			=> 'الملفات',
	'services'		=> 'الخدمات',
	'options'		=> 'الخيارات',

	// Tables header
	'dt'			=> 'التاريخ / الوقت',
	'action'		=> 'العمل',
	'db'			=> 'قاعدة البيانات',
	'type'			=> 'النوع',
	'tab'			=> 'الجداول',
	'records'		=> 'السجلات',
	'size'			=> 'الحجم',
	'comment'		=> 'التعليقات',

	// AJAX Status
	'load'			=> 'تحميل',
	'run'			=> 'يعمل ...',
	'sdb'			=> 'انشاء قاعدة بيانات جديدة',
	'sc'			=> 'حفظ الاتصال',
	'sj'			=> 'حفظ الوظائف',
	'so'			=> 'حفظ خيارات',

	// Messages
	'pro'			=> 'الخيارات متاحة في النسخة الكاملة',
	'err_fopen'		=> 'غير قادر على فتح الملف',
	'err_sxd2'		=> 'عرض محتوى الملفات التى تم انشائها بواسطة السكربت فقط',
	'err_empty_db'	=> 'قاعدة البيانات فارغة',
	'fdc'			=> 'هلا أنت متأكد انك تريد حذف الملف ؟',
	'ddc'			=> 'هلا أنت متأكد انك تريد حذف قاعدة البيانات ؟',
	'fic'			=> 'هلا أنت متأكد انك تريد استيراد الملف ؟',

	// Sizes
	'sizes'			=> array('B', 'KB', 'MB', 'GB'),
)
);
?>
