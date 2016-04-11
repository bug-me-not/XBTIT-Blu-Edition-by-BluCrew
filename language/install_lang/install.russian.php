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

$install_lang["charset"]                = "utf8";
$install_lang["lang_rtl"]               = FALSE;
$install_lang["step"]                   = "ШАГ:";
$install_lang["welcome_header"]         = "Добро Пожаловать";
$install_lang["welcome"]                = "Добро Пожаловать в инсталяцию нового xbtitFM трекера.";
$install_lang["installer_language"]     = "Язык:";
$install_lang["installer_language_set"] = "Активировать этот Язык";
$install_lang["start"]                  = "Старт";
$install_lang["next"]                   = "Далее";
$install_lang["back"]                   = "Назад";
$install_lang["requirements_check"]     = "Проверка зависимостей";
$install_lang["reqcheck"]               = "Проверка зависимостей";
$install_lang["settings"]               = "Настройки";
$install_lang["system_req"]             = "<p>".$GLOBALS["btit-tracker"]."&nbsp;".$GLOBALS["current_btit_version"]." требуется PHP 4.1.2 или выше и MYSQL База Данных.</p>";
$install_lang["list_chmod"]             = "<p>Перед тем как мы продолжим убедитесь что Вы загрузили все требуемые файлы, а так же что следующие папки и файлы имеют разрешение на запись(CHMOD 777).</p>";
$install_lang["view_log"]               = "Вы можете посмотреть весь зписок изменений";
$install_lang["here"]                   = "здесь";
$install_lang["settingup"]              = "Настройка Вашего Трекера";
$install_lang["settingup_info"]         = "Оснавные Настройки";
$install_lang["sitename"]               = "Имя сайта";
$install_lang["sitename_input"]         = "xbtitFM";
$install_lang["siteurl"]                = "Адресс сайта";
$install_lang["siteurl_info"]           = "Без завершающего слэша";
$install_lang["mysql_settings"]         = "MySQL Настройки<br />\nСоздайте MySQL пользователя и базу данных, введите детали сюда";
$install_lang["mysql_settings_info"]    = "Настройки Базы Данных.";
$install_lang["mysql_settings_server"]  = "MySQL Сервер (localhost для большенства)";
$install_lang["mysql_settings_username"] = "MySQL Пользователь";
$install_lang["mysql_settings_password"] = "MySQL Пароль";
$install_lang["mysql_settings_database"] = "MySQL База Данных";
$install_lang["mysql_settings_prefix"]  = "MySQL Префикс";
$install_lang["cache_folder"]           = "Папка кэша";
$install_lang["torrents_folder"]        = "Папка торрентов";
$install_lang["badwords_file"]          = "badwords.txt";
$install_lang["chat.php"]               = "chat.php";
$install_lang["write_succes"]           = "<span style=\"color:#00FF00; font-weight: bold;\">открыт для записи!</span>";
$install_lang["write_fail"]             = "<span style=\"color:#FF0000; font-weight: bold;\">Закрыт для записи!</span> (0777)";
$install_lang["write_file_not_found"]   = "<span style=\"color:#FF0000; font-weight: bold;\">НЕ НАЙДЕН!</span>";
$install_lang["mysqlcheck"]             = "Проверка соединения MySQL";
$install_lang["mysqlcheck_step"]        = "MySQL Проверка";
$install_lang["mysql_succes"]           = "<span style=\"color:#00FF00; font-weight: bold;\">Соединение с Базой Данных прошло удачно!</span>";
$install_lang["mysql_fail"]             = "<span style=\"color:#FF0000; font-weight: bold;\">Не удалось, соединение не может быть установлено!</span>";
$install_lang["back_to_settings"]       = "Вернитесь назад и заполните требуюмую информацию.";
$install_lang["saved"]                  = "сохранено";
$install_lang["file_not_writeable"]     = "Файл <b>./include/settings.php</b> закрыт для записи.";
$install_lang["file_not_exists"]        = "Файл <b>./include/settings.php</b> не существует.";
$install_lang["not_continue_settings"]  = "Вы не можете продолжить установку не открыв этот файл для записи.";
$install_lang["not_continue_settings2"] = "Вы не можете продолжить с этим файлом.";
$install_lang["settings.php"]           = "./include/settings.php";
$install_lang["can_continue"]           = "Вы можете продолжить и изменить это позже.";
$install_lang["mysql_import"]           = "MySQL Импорт";
$install_lang["mysql_import_step"]      = "SQL Имп.";
$install_lang["create_owner_account"]   = "Создание Акаунта Владельца";
$install_lang["create_owner_account_step"] = "Создание Владельца";
$install_lang["database_saved"]         = "Файл database.sql был импортирован в Вашу БД.";
$install_lang["create_owner_account_info"] = "Здесь Вы можете создать акаунт владельца.";
$install_lang["username"]               = "Имя пользователя";
$install_lang["password"]               = "Пароль";
$install_lang["password2"]              = "Пароль еще раз";
$install_lang["email"]                  = "E-mail адресс";
$install_lang["email2"]                 = "E-mail еще раз";
$install_lang["is_succes"]              = "готово.";
$install_lang["no_leave_blank"]         = "Не оставляйте ничего пустым.";
$install_lang["not_valid_email"]        = "Это не коректный E-mail адресс.";
$install_lang["pass_not_same_username"] = "Пароль не может быть идентичным имени пользователя.";
$install_lang["email_not_same"]         = "E-mail не совподает.";
$install_lang["pass_not_same"]          = "Пароли не совподают.";
$install_lang["site_config"]            = "Настройки Трекера";
$install_lang["site_config_step"]       = "Натсройки Трекера";
$install_lang["default_lang"]           = "Язык по умолчанию";
$install_lang["default_style"]          = "Стиль по умолчанию";
$install_lang["torrents_dir"]           = "Папка Торрентов";
$install_lang["validation"]             = "Способ Подтверждения";
$install_lang["more_settings"]          = "*&nbsp;&nbsp;&nbsp;Больше настроек в <u>Панеле Администратора</u> после завершения установки.";
$install_lang["tracker_saved"]          = "Настройки сохранены.";
$install_lang["finished"]               = "Rounding up the Installation";
$install_lang["finished_step"]          = "Rounding up";
$install_lang["succes_install1"]        = "Установка Завершена!";
$install_lang["succes_install2a"]       = "<p>Вы успешно установили ".$GLOBALS["btit-tracker"]." ".$GLOBALS["current_btit_version"].".</p><p>Установка была заблокирована и <b>install.php</b> удален.</p>";
$install_lang["succes_install2b"]       = "<p>Вы успешно установили ".$GLOBALS["btit-tracker"]." ".$GLOBALS["current_btit_version"].".</p><p>Мы рекомендуем заблокировать установку. Вы можете сделать это изменив файл <b>install.unlock</b> на <b>install.lock</b> и удалив файл <b>install.php</b>.</p>";
$install_lang["succes_install3"]        = "<p>Мы, комманда BTITeam, надеемся что Вы будете наслаждаться нашим продуктом и что мы увидем Вас снова на нашем <a href=\"http://www.xbtitfm.com/forum/index.php\" target=\"_blank\">форуме</a>.</p>";
$install_lang["go_to_tracker"]          = "Перейти на Трекер";
$install_lang["forum_type"]             = "Тип Форума";
$install_lang["forum_internal"]         = "xbtitFM встроенный Форум";
$install_lang["forum_smf"]              = "Simple Machines Forum";
$install_lang["forum_other"]            = "Не интегрированный Форум - Введите URL здесь -->";
$install_lang["smf_download_a"]         = "<strong>Если используете Simple Machines Forum:</strong><br /><br/ >Пожалуйста скачайте последнюю версию Simple Machines Forum <a target='_new' href='http://www.simplemachines.org/download/'>здесь</a> и распакуйте контент архива в \"smf\" папку и <a target='_new' href='smf/install.php'>нажмите здесь</a> для его установки.*<br /><strong>(Пожалуйста используйте туже Базу Данных которую Вы использовали при инсталяции xbtitFM).<br /><br /><font color='#FF0000'>Once installed</font></strong> Пожалуйста установите права на файл Английского языка в SMF (<strong>";
$install_lang["smf_download_b"]         = "</strong>) в режим 777 и нажмите <strong>Далее</strong> для продолжения установки xbtitFM.<br /><br /><strong>* Обе ссылки откроются в новом окне чтобы не збить Шаг установки xbtitFM.</strong></p>";
$install_lang["smf_err_1"]              = "Не могу найти Форум в \"smf\" папке, пожалуйста установите его перед тем как продолжить.<br /><br />Нажмите <a href=\"javascript: history.go(-1);\">здесь</a> для возврата на предидущую страницу.";
$install_lang["smf_err_2"]              = "Не могу найти Simple Machines Forum в Базе Данных, пожалуйста установите его перед тем как продолжить.<br /><br />Нажмите <a href=\"javascript: history.go(-1);\">Здесь</a> для возврата на предидущую страницу.";
$install_lang["smf_err_3a"]             = "Немогу редактировать Английский языковой файл SMF (<strong>";
$install_lang["smf_err_3b"]             = "</strong>) пожалуйста CHMOD его в режим 777 перед тем как продолжить.<br /><br />Нажмите <a href=\"javascript: history.go(-1);\">здесь</a> для возврата на предидущую страницу.";
$install_lang["allow_url_fopen"]        = "php.ini режим для \"allow_url_fopen\" (лутше Вкл.)";
$install_lang["allow_url_fopen_ON"]        = "<span style=\"color:#00FF00; font-weight: bold;\">Вкл.</span>";
$install_lang["allow_url_fopen_OFF"]        = "<span style=\"color:#FF0000; font-weight: bold;\">Выкл.</span>";
$install_lang["succes_upgrade1"]        = "Обновление завершено!";
$install_lang["succes_upgrade2a"]       = "<p>Вы успешно обновили ".$GLOBALS["btit-tracker"]." ".$GLOBALS["current_btit_version"]." на Вашем трекере.</p><p>Обновление было успешно заблокировано от возможности его повторного использования, но мы также рекомендуем удалить  <b>upgrade.php+install.php</b> для большей безопасности.</p>";
$install_lang["succes_upgrade2b"]       = "<p>Вы успешно обновили ".$GLOBALS["btit-tracker"]." ".$GLOBALS["current_btit_version"]." на вашем трекере.</p><p>Мы рекомендуем заблокировать установку.  Вы можете сделать это изменив файл <b>install.unlock</b> на <b>install.lock</b> и удалив файлы <b>upgrade.php+install.php</b>.</p>";
$install_lang["succes_upgrade3"]        = "<p>Мы, комманда BTITeam, надеемся что Вы будете наслаждаться нашим продуктом и что мы увидем Вас снова на нашем <a href=\"http://www.xbtitfm.com/forum/index.php\" target=\"_blank\">форуме</a>.</p>";
$install_lang['error_mysql_database']   = 'Установщик не смог произвести доступ к  &quot;<i>%s</i>&quot; Базе Данных.  На некоторых хостах Вы должны создать базу данных через административную панель, перед тем как xbtitFM сможет ее использовать. Некоторые также добавляют префиксы к Вашим базам данных, например Ваше имя пользователя в системе.';
$install_lang['error_message_click']    = 'Нажмите здесь';
$install_lang['error_message_try_again']= 'чтобы попробывать снова';
$install_lang["torrentimg_dir"] = "Папка torrentimg";
$install_lang["torrentstats_dir"] = "Папка torrentstats";
$install_lang["subtitles_dir"] = "Папка subtitles";
$install_lang["nforep_dir"] = "Папка nfo/rep";
$install_lang["imdbcache_dir"] = "Папка imdb/cache";
$install_lang["imdbimg_dir"] = "Папка imdb/images";
$install_lang["googimg_dir"] = "Папка googly/imgs";
$install_lang["avatar_dir"] = "Папка avatar";
$install_lang["sxd_dir"] = "Папка sxd/backup";
$install_lang["thetvdb_dir"] = "Папка thetvdb";

// English definitions (Need translating)
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