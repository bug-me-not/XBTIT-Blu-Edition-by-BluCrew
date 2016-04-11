<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2007  Btiteam
//
//    This file is part of xbtit.
//
// Redistribution and use in source and binary forms, with or without modification,
// are permitted provided that the following conditions are met:
//
//   1. Redistributions of source code must retain the above copyright notice,
//      this list of conditions and the following disclaimer.
//   2. Redistributions in binary form must reproduce the above copyright notice,
//      this list of conditions and the following disclaimer in the documentation
//      and/or other materials provided with the distribution.
//   3. The name of the author may not be used to endorse or promote products
//      derived from this software without specific prior written permission.
//
// THIS SOFTWARE IS PROVIDED BY THE AUTHOR ``AS IS'' AND ANY EXPRESS OR IMPLIED
// WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
// MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.
// IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
// SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED
// TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
// PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF
// LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
// NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE,
// EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
//
////////////////////////////////////////////////////////////////////////////////////

// english installation file //

$install_lang["charset"]                = "utf-8";
$install_lang["lang_rtl"]               = TRUE;
$install_lang["step"]                   = "الخطوة";
$install_lang["welcome_header"]         = "مرحباً";
$install_lang["welcome"]                = "مرحباً لبرنامج تنصيب xbtitFM";
$install_lang["installer_language"]     = "اللغة:";
$install_lang["installer_language_set"] = "تفعيل هذه اللغة";
$install_lang["start"]                  = "البداية";
$install_lang["next"]                   = "التالي";
$install_lang["back"]                   = "عودة";
$install_lang["requirements_check"]     = "التاكد من المتطلبات";
$install_lang["reqcheck"]               = "المتطلب";
$install_lang["settings"]               = "اعدادت";
$install_lang["system_req"]             = "<p>".$GLOBALS["btit-tracker"]."&nbsp;".$GLOBALS["current_btit_version"]." مطلوبPHP 4.1.2 وقواعد بيانات MYSQL</p>";
$install_lang["list_chmod"]             = "<p>الرجاء التاكد من رفع الملفات واعطاء صلاحية 777 للمفات التالية</p>";
$install_lang["view_log"]               = "يمكنك عرض سجل التغيرات لهذه النسخة";
$install_lang["here"]                   = "هنا";
$install_lang["settingup"]              = "اعداد متتبعك الخاص";
$install_lang["settingup_info"]         = "الاعدادت الاساسية";
$install_lang["sitename"]               = "اسم الموقع";
$install_lang["sitename_input"]         = "xbtitFM";
$install_lang["siteurl"]                = "وصلة الموقع";
$install_lang["siteurl_info"]           = "بدون شرطة النهاية";
$install_lang["mysql_settings"]         = "MySQL اعدادت<br />\nقم بعمل قاعدة بيانات واضف المعلومات هنا";
$install_lang["mysql_settings_info"]    = "اعدادت قاعدة البيانات";
$install_lang["mysql_settings_server"]  = "MySQL خادم (localhost اذا لم تعرف استخدم)";
$install_lang["mysql_settings_username"] = "MySQL اسم المستخدم";
$install_lang["mysql_settings_password"] = "MySQL كلمة سر";
$install_lang["mysql_settings_database"] = "MySQL قاعدة بيانات";
$install_lang["mysql_settings_prefix"]  = "MySQL بادية جداول";
$install_lang["cache_folder"]           = "مجلد التخزين";
$install_lang["torrents_folder"]        = "مجلد التورينت";
$install_lang["badwords_file"]          = "badwords.txt";
$install_lang["chat.php"]               = "chat.php";
$install_lang["write_succes"]           = "<span style=\"color:#00FF00; font-weight: bold;\">يمكن تعديله</span>";
$install_lang["write_fail"]             = "<span style=\"color:#FF0000; font-weight: bold;\">لا يمكن تعديله</span> (0777)";
$install_lang["write_file_not_found"]   = "<span style=\"color:#FF0000; font-weight: bold;\">غير موجود</span>";
$install_lang["mysqlcheck"]             = "MySQL التاكد من اتصال";
$install_lang["mysqlcheck_step"]        = "MySQL تاكيد";
$install_lang["mysql_succes"]           = "<span style=\"color:#00FF00; font-weight: bold;\">تم الاتصال بقاعدة البيانات بنجاح</span>";
$install_lang["mysql_fail"]             = "<span style=\"color:#FF0000; font-weight: bold;\">فشل الاتصال بقاعدة البيانات تاكد من المعلومات</span>";
$install_lang["back_to_settings"]       = "عد وقم بادخال المعلومات المطلوبة";
$install_lang["saved"]                  = "حفظ";
$install_lang["file_not_writeable"]     = "الملف <b>./include/settings.php</b> لا يمكن تعديله";
$install_lang["file_not_exists"]        = "الملف <b>./include/settings.php</b> غير موجود";
$install_lang["not_continue_settings"]  = "لا يمكن الاستمرار في التنصيب بدون القدرة على تعديل الملف";
$install_lang["not_continue_settings2"] = "لا يمكن الاستمرار بدون هذا الملف";
$install_lang["settings.php"]           = "./include/settings.php";
$install_lang["can_continue"]           = "يمكنك الاستمرار وتغير هذا لاحقاً";
$install_lang["mysql_import"]           = "MySQL استيراد";
$install_lang["mysql_import_step"]      = "SQL Imp.";
$install_lang["create_owner_account"]   = "انشاء حساب المدير";
$install_lang["create_owner_account_step"] = "انشاء مدير";
$install_lang["database_saved"]         = "تم ادخال البيانات الى قاعدة البيانات بنجاح";
$install_lang["create_owner_account_info"] = "قم بعمل حسابك هنا";
$install_lang["username"]               = "اسم المستخدم";
$install_lang["password"]               = "كلمة السر";
$install_lang["password2"]              = "تكرار كلمة السر";
$install_lang["email"]                  = "البريد";
$install_lang["email2"]                 = "تكرار البريد";
$install_lang["is_succes"]              = "انتهى";
$install_lang["no_leave_blank"]         = "لا تترك اي حقل من الحقول فارغة";
$install_lang["not_valid_email"]        = "الرجاء التاكد من البريد";
$install_lang["pass_not_same_username"] = "لا يمكن لكلمة السر مطابقة الاسم";
$install_lang["email_not_same"]         = "البريد غير متطابقة";
$install_lang["pass_not_same"]          = "كلمات السر غير متطابقة";
$install_lang["site_config"]            = "اعدادت المتتبع";
$install_lang["site_config_step"]       = "اعدادت المتتبع";
$install_lang["default_lang"]           = "اللغة الافتراضية";
$install_lang["default_style"]          = "التنسيق الافتراضي";
$install_lang["torrents_dir"]           = "مجلد التورينتات";
$install_lang["validation"]             = "طريقة تفعيل العضوية";
$install_lang["more_settings"]          = "*&nbsp;&nbsp;&nbsp;المزيد من الاعدادت في لوحة تحكم الاشراف بعد الانتها من التنصيب";
$install_lang["tracker_saved"]          = "تم حفظ الاعدادت";
$install_lang["finished"]               = "انها التثبيت";
$install_lang["finished_step"]          = "انهاء";
$install_lang["succes_install1"]        = "تم الانتها من تنصيب المتتبع";
$install_lang["succes_install2a"]       = "<p>لقد قمت بتنصيب ".$GLOBALS["btit-tracker"]." ".$GLOBALS["current_btit_version"].".</p><p>لقد تم اقفال ملف التنصيب لتجنب اعادة التنصيب من جديد</p>";
$install_lang["succes_install2b"]       = "<p> لقد قمت بتنصيب".$GLOBALS["btit-tracker"]." ".$GLOBALS["current_btit_version"].".</p><p>ننصحك بقفل ملف التنصيب يمكنك فعل ذلك عن طريق تغيير اسم <b>install.unlock</b> الى <b>install.lock</b> والغاء هذا الملف <b>install.php</b> f</p>";
$install_lang["succes_install3"]        = "<p>فريق BTITeam يتمنى ان تستمتع بهذا المنتج المجاني <a href=\"http://www.btiteam.org/smf/index.php\" target=\"_blank\">منتدى الدعم</a>.</p>";
$install_lang["go_to_tracker"]          = "الذهاب الى متتبعك";
$install_lang["forum_type"]             = "نوع المنتدى";
$install_lang["forum_internal"]         = "xbtitFM منتدى اصلي";
$install_lang["forum_smf"]              = "Simple Machines Forum";
$install_lang["forum_other"]            = "منتدى من نوع آخر ادخل الوصلة هنا";
$install_lang["smf_download_a"]         = "<strong>اذا كنت تستعمل منتدى Simple Machines Forum</strong><br /><br/ >الرجاء تحميل آخر نسخة من المتدى <a target='_new' href='http://www.simplemachines.org/download/'>هنا</a> وارفعها الى مجلد \"smf\" و <a target='_new' href='smf/install.php'>اكبس هنا</a> لتثبيتها*<br /><strong>(الرجاء استعمال نفس قاعدة بيانات المتتبع).<br /><br /><font color='#FF0000'>Once installed</font></strong> الرجاء اعطاء ملفات اللغة الانجليزية لـ SMF (<strong>";
$install_lang["smf_download_b"]         = "</strong>) 777 <strong>واكبس على  NEXT</strong> للاستمرار في التثبيت<br /><br /><strong>* سيتم فتح الوصلة في نافذة جديدة</strong></p>";
$install_lang["smf_err_1"]              = "لا يمكن ايجاد منتدى Simple Machines Forum في مجلد \"smf\" الرجاء تثبيت المنتدى قبل الاستمرار<br /><br />اكبس <a href=\"javascript: history.go(-1);\">هنا</a> للعودة للصفحة السابقة";
$install_lang["smf_err_2"]              = "لم يتمكن من العثور على قواعد بيانات Simple Machines Forum <br /><br />اكبس <a href=\"javascript: history.go(-1);\">هنا</a> للعودة للصفحة السابقة";
$install_lang["smf_err_3a"]             = "لم نتمكن من الكتابة على ملفات لغة SMF الانجليزية(<strong>";
$install_lang["smf_err_3b"]             = "</strong>) الرجاء اعطاء التصريح 777 قبل الاستمرار<br /><br />اكبس <a href=\"javascript: history.go(-1);\">هنا</a> للعودة للصفحة السابقة";
$install_lang["allow_url_fopen"]        = "php.ini القيمة لـ \"allow_url_fopen\" (فعالة)";
$install_lang["allow_url_fopen_ON"]        = "<span style=\"color:#00FF00; font-weight: bold;\">ON</span>";
$install_lang["allow_url_fopen_OFF"]        = "<span style=\"color:#FF0000; font-weight: bold;\">OFF</span>";
$install_lang["succes_upgrade1"]        = "تم الانتها من التحديث";
$install_lang["succes_upgrade2a"]       = "<p>لقد قمت بالتحديث بنجاح ".$GLOBALS["btit-tracker"]." ".$GLOBALS["current_btit_version"]." لمتتبعك</p><p>لقد تم اغلاق التحديث ولكن ننصحب بحذف ملفات <b>upgrade.php+install.php</b> للمزيد من الحماية</p>";
$install_lang["succes_upgrade2b"]       = "<p>لقد قمت بالتحديث بنجاح ".$GLOBALS["btit-tracker"]." ".$GLOBALS["current_btit_version"]." في متتبعك</p><p>ننصحك بقفل ملف التحديث عن طريق تغيير اسم <b>install.unlock</b> الى <b>install.lock</b> او الغاء ملفات <b>upgrade.php+install.php</b> </p>";
$install_lang["succes_upgrade3"]        = "<p>قريق BTITeam يرجوا ان تستمتع بهذا المنتج المجاني <a href=\"http://www.btiteam.org/smf/index.php\" target=\"_blank\">منتديات الدعم</a>.</p>";
$install_lang['error_mysql_database']   = 'لم يستطع برناج التنصيب الوصول الى<i>%s</i>&quot; قاعدة البيانات.  في بعض الاستضافات عليك انشاء قاعدة بينانات في لوحة تحكم الموقع لتستعملها في المتتبع.';
$install_lang['error_message_click']    = 'اكبس هنا';
$install_lang['error_message_try_again']= 'للمحاولة مرة اخرى';

$install_lang["torrentimg_dir"] = "torrentimg Folder";
$install_lang["torrentstats_dir"] = "torrentstats Folder";
$install_lang["subtitles_dir"] = "subtitles Folder";
$install_lang["nforep_dir"] = "nfo/rep Folder";
$install_lang["imdbcache_dir"] = "imdb/cache Folder";
$install_lang["imdbimg_dir"] = "imdb/images Folder";
$install_lang["googimg_dir"] = "googly/imgs Folder";
$install_lang["avatar_dir"] = "avatar Folder";
$install_lang["sxd_dir"] = "sxd/backup Folder";
$install_lang["thetvdb_dir"] = "thetvdb Folder";

$install_lang["forum_ipb"]              = "Invision Power Board";
$install_lang["ipb_download_a"]         = "<b>If using Invision Power Board:</b><br /><br/ >Please download the latest version of Invision Power Board from your <a target='_new' href='http://www.invisionpower.com/customer/'>Client Area</a> at Invision Power Services, extract the files somewhere on your computer and then upload the contents of the \"upload\" folder to the \"ipb\" folder.<br /><br />Once uploaded please make sure the \"cache\", \"hooks\", \"public\" and \"uploads\" folders are CHMOD'd to 777 recursively, rename \"conf_global.dist.php\" to \"conf_global.php\" and CHMOD that to 777 as well.<br /><br />Once done please <a target='_new' href='ipb/admin/install/index.php'>click here</a> to install it.*<br /><b>(Please use the same database credentials you used for this installation procedure and be sure to enter a database prefix, we suggest using <span style='color:blue;'>ipb_</span> as your prefix).<br /><br /><font color='#FF0000'>Once installed</font></b> please CHMOD the default cached English language file (<b>";
$install_lang["ipb_download_b"]         = "</b>) to 777 and click <b>Next</b> to continue with the xbtitFM installation.<br /><br /><b>* Both links will open into a new window/tab to prevent losing your place on the xbtitFM installation.</b></p>";
$install_lang["ipb_err_1"]              = "Can't find Invision Power Board in the \"ipb\" folder, please install it before proceeding.<br /><br />Click <a href=\"javascript: history.go(-1);\">here</a> to return to the previous page.";
$install_lang["ipb_err_2"]              = "Can't find Invision Power Board in the database, please install it before proceeding.<br /><br />Click <a href=\"javascript: history.go(-1);\">here</a> to return to the previous page.";
$install_lang["ipb_err_3a"]             = "Unable to write to the IPB English language file (<b>";
$install_lang["ipb_err_3b"]             = "</b>) please CHMOD to 777 before proceeding.<br /><br />Click <a href=\"javascript: history.go(-1);\">here</a> to return to the previous page.";
$install_lang["ipb_err_4a"]             = "IPB English language file (<b>";
$install_lang["ipb_err_4b"]             = "</b>) doesn't exist, cannot proceed.<br /><br />Click <a href=\"javascript: history.go(-1);\">here</a> to return to the previous page.";
$install_lang["ipb_err_5"]             = "Unable to write to the IPB Config file (<b>";
$install_lang["ipb_err_6"]             = "Unable to write to the Tracker Config file (<b>";

?>