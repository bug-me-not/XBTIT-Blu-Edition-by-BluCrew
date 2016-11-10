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

$install_lang["charset"]                = "ISO-8859-1";
$install_lang["lang_rtl"]               = FALSE;
$install_lang["step"]                   = "STEP:";
$install_lang["welcome_header"]         = "Welcome";
$install_lang["welcome"]                = "Welcome to the installation for the new XBTIT Blu-Edition.";
$install_lang["installer_language"]     = "Language:";
$install_lang["installer_language_set"] = "Enable this language";
$install_lang["start"]                  = "Start";
$install_lang["next"]                   = "Next";
$install_lang["back"]                   = "Back";
$install_lang["requirements_check"]     = "Requirements Check";
$install_lang["reqcheck"]               = "Req.Check";
$install_lang["settings"]               = "Settings";
$install_lang["system_req"]             = "<p>XBTIT Blu-Edition requires PHP 7+ and an MYSQL database.</p>";
$install_lang["list_chmod"]             = "<p>Before we go any further, please ensure that all the files have been uploaded, and that the following files have suitable permissions to allow this script to write to it (0777 should be sufficient).</p>";
$install_lang["view_log"]               = "You can view full changelog";
$install_lang["here"]                   = "here";
$install_lang["settingup"]              = "Setting up your tracker";
$install_lang["settingup_info"]         = "Basic Settings";
$install_lang["sitename"]               = "Sitename";
$install_lang["sitename_input"]         = "XBTIT Blu-Edition";
$install_lang["siteurl"]                = "Site-url";
$install_lang["siteurl_info"]           = "Without trailing slash";
$install_lang["mysql_settings"]         = "MySQL Settings<br />\nCreate a MySQL user and database, input the details here";
$install_lang["mysql_settings_info"]    = "Database Settings.";
$install_lang["mysql_settings_server"]  = "MySQL Server (localhost works ok for most servers)";
$install_lang["mysql_settings_username"] = "MySQL Username";
$install_lang["mysql_settings_password"] = "MySQL Password";
$install_lang["mysql_settings_database"] = "MySQL Database";
$install_lang["mysql_settings_prefix"]  = "MySQL Table Prefix";
$install_lang["cache_folder"]           = "cache Folder";
$install_lang["torrents_folder"]        = "torrents Folder";
$install_lang["badwords_file"]          = "badwords.txt";
$install_lang["chat.php"]               = "chat.php";
$install_lang["write_succes"]           = "<p class=\"text-success\">is writable!</p>";
$install_lang["write_fail"]             = "<p class=\"text-danger\">NOT WRITABLE!</p> (0777)";
$install_lang["write_file_not_found"]   = "<p class=\"text-warning\">NOT FOUND!</p>";
$install_lang["mysqlcheck"]             = "MySQL Connection Check";
$install_lang["mysqlcheck_step"]        = "MySQL Check";
$install_lang["mysql_succes"]           = "<p class=\"text-success\">Succesfully connected to the database!</p>";
$install_lang["mysql_fail"]             = "<p class=\"text-danger\">Failed, the connection couldn't be astablished!</p>";
$install_lang["back_to_settings"]       = "Go back and fill in the neccesary info.";
$install_lang["saved"]                  = "saved";
$install_lang["file_not_writeable"]     = "The file <b>include/settings.php</b> is not writeable.";
$install_lang["file_not_exists"]        = "The file <b>include/settings.php</b> doesn't exists.";
$install_lang["not_continue_settings"]  = "You can not continue with the install without this file being writable.";
$install_lang["not_continue_settings2"] = "You can not continue with this file.";
$install_lang["not_continue_settings3"] = "You can not continue with the install without this folder being writable.";
$install_lang["settings.php"]           = "include/settings.php";
$install_lang["backupsh_file"]           = "sxd/backup.sh";
$install_lang["backupsh_not_writeable"]     = "The file <b>./sxd/backup.sh</b> is not writeable.";
$install_lang["backupsh_not_exists"]        = "The file <b>./sxd/backup.sh</b> doesn't exists.";
$install_lang["cfgphp_file"]           = "sxd/cfg.php";
$install_lang["cfg_not_writeable"]     = "The file <b>./sxd/cfg.php</b> is not writeable.";
$install_lang["cfg_not_exists"]        = "The file <b>./sxd/cfg.php</b> doesn't exists.";
$install_lang["sesphp_file"]           = "sxd/ses.php";
$install_lang["ses_not_writeable"]     = "The file <b>./sxd/ses.php</b> is not writeable.";
$install_lang["ses_not_exists"]        = "The file <b>./sxd/ses.php</b> doesn't exists.";





$install_lang["can_continue"]           = "You can continue and change this later.";
$install_lang["mysql_import"]           = "MySQL Import";
$install_lang["mysql_import_step"]      = "SQL Imp.";
$install_lang["create_owner_account"]   = "Creating Owner Account";
$install_lang["create_owner_account_step"] = "Create Owner";
$install_lang["database_saved"]         = "The database.sql has been imported to your database.";
$install_lang["create_owner_account_info"] = "Here you can create the owner account.";
$install_lang["username"]               = "Username";
$install_lang["password"]               = "Password";
$install_lang["password2"]              = "Repeat password";
$install_lang["email"]                  = "Email";
$install_lang["email2"]                 = "Repeat email";
$install_lang["is_succes"]              = "is done.";
$install_lang["no_leave_blank"]         = "Don't leave anything blank.";
$install_lang["not_valid_email"]        = "This is not a valid email adress.";
$install_lang["pass_not_same_username"] = "Password cannot be the same as username.";
$install_lang["email_not_same"]         = "Email adresses don't match.";
$install_lang["pass_not_same"]          = "Passwords don't match.";
$install_lang["site_config"]            = "Tracker Settings";
$install_lang["site_config_step"]       = "Tracker Sett.";
$install_lang["default_lang"]           = "Default Language";
$install_lang["default_style"]          = "Default Style";
$install_lang["torrents_dir"]           = "orrents Dir";
$install_lang["validation"]             = "Validation Mode";
$install_lang["more_settings"]          = "*&nbsp;&nbsp;&nbsp;More settings in the <u>Admin Panel</u> when the installation is completed.";
$install_lang["tracker_saved"]          = "The settings are saved.";
$install_lang["finished"]               = "Rounding up the Installation";
$install_lang["finished_step"]          = "Rounding up";
$install_lang["succes_install1"]        = "The installation is completed!";
$install_lang["succes_install2a"]       = "<p>You succesfully installed ".$GLOBALS["btit-tracker"]." ".$GLOBALS["current_btit_version"].".</p><p>The installation has been successfully locked and <b>install.php</b> deleted to prevent being used again.</p>";
$install_lang["succes_install2b"]       = "<p>You succesfully installed ".$GLOBALS["btit-tracker"]." ".$GLOBALS["current_btit_version"].".</p><p>We have locked the installation and changed <b>install.unlock</b> to <b>install.lock</b> and deleted <b>install.php</b> file.</p>";
$install_lang["succes_install3"]        = "<p>We of BTITeam hope you enjoy use of this product and that we will see you again on our <a href=\"http://forum.xbtitfm.com/index.php\" target=\"_blank\">forum</a>.</p>";
$install_lang["go_to_tracker"]          = "Go to your tracker";
$install_lang["forum_type"]             = "Forum Type";
$install_lang["forum_internal"]         = "xbtitFM Internal Forum";
$install_lang["forum_smf"]              = "Simple Machines Forum";
$install_lang["forum_other"]            = "Unintegrated External Forum - Enter url here -->";
$install_lang["smf_download_a"]         = "<strong>If using Simple Machines Forum:</strong><br /><br/ >Please download the latest version of Simple Machines Forum <a target='_new' href='http://www.simplemachines.org/download/'>here</a> and upload the contents of the archive to the \"smf\" folder and <a target='_new' href='smf/install.php'>click here</a> to install it.*<br /><strong>(Please use the same database credentials you used for this installation procedure).<br /><br /><font color='#FF0000'>Once installed</font></strong> please CHMOD the SMF English language file (<strong>";
$install_lang["smf_download_b"]         = "</strong>) to 777 and click <strong>Next</strong> to continue with the xbtitFM installation.<br /><br /><strong>* Both links will open into a new window/tab to prevent losing your place on the xbtitFM installation.</strong></p>";
$install_lang["smf_err_1"]              = "Can't find Simple Machines Forum in the \"smf\" folder, please install it before proceeding.<br /><br />Click <a href=\"javascript: history.go(-1);\">here</a> to return to the previous page.";
$install_lang["smf_err_2"]              = "Can't find Simple Machines Forum in the database, please install it before proceeding.<br /><br />Click <a href=\"javascript: history.go(-1);\">here</a> to return to the previous page.";
$install_lang["smf_err_3a"]             = "Unable to write to the SMF English language file (<strong>";
$install_lang["smf_err_3b"]             = "</strong>) please CHMOD to 777 before proceeding.<br /><br />Click <a href=\"javascript: history.go(-1);\">here</a> to return to the previous page.";
$install_lang["allow_url_fopen"]        = "php.ini value for \"allow_url_fopen\" (best is ON)";
$install_lang["allow_url_fopen_ON"]        = "<span style=\"color:#00FF00; font-weight: bold;\">ON</span>";
$install_lang["allow_url_fopen_OFF"]        = "<span style=\"color:#FF0000; font-weight: bold;\">OFF</span>";
$install_lang["succes_upgrade1"]        = "The upgrade is completed!";
$install_lang["succes_upgrade2a"]       = "<p>You succesfully upgraded ".$GLOBALS["btit-tracker"]." ".$GLOBALS["current_btit_version"]." on your tracker.</p><p>The upgrade has been successfully locked to prevent being used again and we have also deleted <b>upgrade.php+install.php</b> for extra protection.</p>";
$install_lang["succes_upgrade2b"]       = "<p>You succesfully upgraded ".$GLOBALS["btit-tracker"]." ".$GLOBALS["current_btit_version"]." on your tracker.</p><p>We advise you to lock the installation. You can do this by changing <b>install.unlock</b> to <b>install.lock</b> or to delete this <b>upgrade.php+install.php</b> file.</p>";
$install_lang["succes_upgrade3"]        = "<p>We of BTITeam hope you enjoy use of this product and that we will see you again on our <a href=\"http://forum.xbtitfm.com/index.php\" target=\"_blank\">forum</a>.</p>";
$install_lang['error_mysql_database']   = 'The installer was unable to access the &quot;<i>%s</i>&quot; database.  With some hosts, you have to create the database in your administration panel before xbtitFM can use it.  Some also add prefixes - like your username - to your database names.';
$install_lang['error_message_click']    = 'Click here';
$install_lang['error_message_try_again']= 'to try again';
$install_lang["backup_tmp_dir"] = "backup_tmp Folder";
$install_lang["backupbackup_dir"] = "backup/backup Folder";
$install_lang["backup_dir"] = "backup Folder";
$install_lang["accesscode_dir"] = "access_code Folder";
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
$install_lang["smilies_dir"] = "images/smilies Folder";
$install_lang["filehost_dir"] = "file_hosting Folder";






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