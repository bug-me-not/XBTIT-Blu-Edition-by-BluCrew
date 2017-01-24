<?php

// Simplified Chinese installation file //

$install_lang["charset"]                = "UTF-8";
$install_lang["lang_rtl"]               = FALSE;
$install_lang["step"]                   = "STEP:";
$install_lang["welcome_header"]         = "欢迎";
$install_lang["welcome"]                = "欢迎安装xbtitFM.";
$install_lang["installer_language"]     = "语言选择:";
$install_lang["installer_language_set"] = "使用此语言";
$install_lang["start"]                  = "开始";
$install_lang["next"]                   = "下一步";
$install_lang["back"]                   = "上一步";
$install_lang["requirements_check"]     = "环境检测";
$install_lang["reqcheck"]               = "环境检测";//也可以翻译成需求检测
$install_lang["settings"]               = "设置";
$install_lang["system_req"]             = "<p>".$GLOBALS["btit-tracker"]."&nbsp;".$GLOBALS["current_btit_version"]." 需要 PHP 4.1.2(或更高版本) 和 MYSQL数据库 的支持.</p>";
$install_lang["list_chmod"]             = "<p>在进行一切操作之前, 请确保所有文件都已上传到您的网站目录中, 并且这些文件有权限被访问 (如果是Linux系统，需要设置以下目录或文件的0777权限).</p>";
$install_lang["view_log"]               = "您可以查看全部修改记录：";
$install_lang["here"]                   = "修改记录";
$install_lang["settingup"]              = "设置您的tracker";
$install_lang["settingup_info"]         = "基本设置";
$install_lang["sitename"]               = "站点名称";
$install_lang["sitename_input"]         = "xbtitFM";
$install_lang["siteurl"]                = "站点url";
$install_lang["siteurl_info"]           = "请不要加上url结尾处的斜杠";
$install_lang["mysql_settings"]         = "MySQL设置<br />\n你可能需要创建一个MySQL用户和对应数据库, 这里填写的参数将会保存在数据库中";
$install_lang["mysql_settings_info"]    = "数据库设置";
$install_lang["mysql_settings_server"]  = "MySQL 服务器<br />\n(一般情况填localhost即可)";
$install_lang["mysql_settings_username"] = "MySQL 用户名";
$install_lang["mysql_settings_password"] = "MySQL 密码";
$install_lang["mysql_settings_database"] = "MySQL 数据库名";
$install_lang["mysql_settings_prefix"]  = "MySQL 表头标记";
$install_lang["cache_folder"]           = "临时文件夹";
$install_lang["torrents_folder"]        = "Torrents 文件夹";
$install_lang["badwords_file"]          = "badwords.txt";
$install_lang["chat.php"]               = "chat.php";
$install_lang["write_succes"]           = "<span style=\"color:#00FF00; font-weight: bold;\">允许写入</span>";
$install_lang["write_fail"]             = "<span style=\"color:#FF0000; font-weight: bold;\">不允许写入</span> (0777)";
$install_lang["write_file_not_found"]   = "<span style=\"color:#FF0000; font-weight: bold;\">无法找到!</span>";
$install_lang["mysqlcheck"]             = "MySQL 连接检测";
$install_lang["mysqlcheck_step"]        = "MySQL 检测";
$install_lang["mysql_succes"]           = "<span style=\"color:#00FF00; font-weight: bold;\">成功连接到数据库!</span>";
$install_lang["mysql_fail"]             = "<span style=\"color:#FF0000; font-weight: bold;\">连接失败, 不能建立到数据库的连接!</span>";
$install_lang["back_to_settings"]       = "请返回补充必要的参数.";
$install_lang["saved"]                  = "(已保存)";
$install_lang["file_not_writeable"]     = "文件 <b>./include/settings.php</b> 不可写入.";
$install_lang["file_not_exists"]        = "文件 <b>./include/settings.php</b> 不存在.";
$install_lang["not_continue_settings"]  = "您不能继续安装步骤除非这些文件可以写入.";
$install_lang["not_continue_settings2"] = "因为这个文件你无法继续.";
$install_lang["settings.php"]           = "./include/settings.php";
$install_lang["can_continue"]           = "继续并在之后更改此参数.";
$install_lang["mysql_import"]           = "MySQL 导入";
$install_lang["mysql_import_step"]      = "MySQL 导入.";
$install_lang["create_owner_account"]   = "创建管理员账号";
$install_lang["create_owner_account_step"] = "创建管理员账号";
$install_lang["database_saved"]         = "文件database.sql已被导入您的数据库.";
$install_lang["create_owner_account_info"] = "在这里您可以创建tracker管理员的账号(权限为owner).";
$install_lang["username"]               = "帐号";
$install_lang["password"]               = "密码";
$install_lang["password2"]              = "再输入一次密码";
$install_lang["email"]                  = "Email地址";
$install_lang["email2"]                 = "再输入一次Email地址";
$install_lang["is_succes"]              = "完成.";
$install_lang["no_leave_blank"]         = "请填完所有参数.";
$install_lang["not_valid_email"]        = "邮箱地址非法.";
$install_lang["pass_not_same_username"] = "不允许帐号和密码相同.";
$install_lang["email_not_same"]         = "两次输入的Email地址不匹配.";
$install_lang["pass_not_same"]          = "两次输入的密码不匹配.";
$install_lang["site_config"]            = "Tracker 设置";
$install_lang["site_config_step"]       = "Tracker 设置";
$install_lang["default_lang"]           = "默认语言";
$install_lang["default_style"]          = "默认风格";
$install_lang["torrents_dir"]           = "Torrents目录:";
$install_lang["validation"]             = "用户验证模式";
$install_lang["more_settings"]          = "*&nbsp;&nbsp;&nbsp;如需修改更多设置请在安装结束后访问 <u>管理面板</u> .";
$install_lang["tracker_saved"]          = "设置已保存.";
$install_lang["finished"]               = "结束安装";
$install_lang["finished_step"]          = "结束";
$install_lang["succes_install1"]        = "安装已完成!";
$install_lang["succes_install2a"]       = "<p>您成功地安装了 ".$GLOBALS["btit-tracker"]." ".$GLOBALS["current_btit_version"].".</p><p>您已顺利对安装进程上锁并且文件 <b>install.php</b> 已被删除.</p>";
$install_lang["succes_install2b"]       = "<p>您成功地安装了 ".$GLOBALS["btit-tracker"]." ".$GLOBALS["current_btit_version"].".</p><p>我们建议对安装进程上锁. 对安装进程上锁您需要将文件 <b>install.unlock</b> 改名为 <b>install.lock</b> 并删除文件 <b>install.php</b>.</p>";
$install_lang["succes_install3"]        = "<p>BTITeam希望您妥善使用我们的产品，有任何问题欢迎访问我们的<a href=\"http://www.btiteam.org/smf/index.php\" target=\"_blank\">论坛</a>.</p>";
$install_lang["go_to_tracker"]          = "进入您的tracker";
$install_lang["forum_type"]             = "论坛格式";
$install_lang["forum_internal"]         = "xbtitFM自带的论坛";
$install_lang["forum_smf"]              = "Simple Machines Forum";
$install_lang["forum_other"]            = "外部论坛 - 请在这里输入url -->";
$install_lang["smf_download_a"]         = "<strong>如果您需要使用 Simple Machines Forum :</strong><br /><br/ >请在 <a target='_new' href='http://www.simplemachines.org/download/'>这里</a> 下载 Simple Machines Forum 的最新版本并将文件上传到 \"smf\" 目录然后 <a target='_new' href='smf/install.php'>点击这里</a> 开始 Simple Machines Forum 的安装.*<br /><strong>(请使用和刚才的 xbtitFM 相同的数据库证书).</strong><br /><br />请在<strong><font color='#FF0000'>安装完成</font></strong>后使用 CHMOD 命令将 Simple Machines Forum 的语言文件 (<strong>";
$install_lang["smf_download_b"]         = "</strong>) 转换为 777 权限并点击 <strong>下一步</strong> 来继续 xbtitFM 的安装.<br /><br /><strong>* 以上两个链接都将会在新窗口/新标签中打开来防止 xbtitFM 安装进程的中断.</strong></p>";
$install_lang["smf_err_1"]              = "在目录 \"smf\" 中找不到 Simple Machines Forum , 请在此步骤之前安装它.<br /><br />点击 <a href=\"javascript: history.go(-1);\">这里</a> 返回之前的页面.";
$install_lang["smf_err_2"]              = "找不到 Simple Machines Forum 的数据库, 请在此步骤之前安装它.<br /><br />点击 <a href=\"javascript: history.go(-1);\">这里</a> 返回之前的页面.";
$install_lang["smf_err_3a"]             = " Simple Machines Forum 的语言文件不可写入 (<strong>";
$install_lang["smf_err_3b"]             = "</strong>) 安装进程开始前请使用 CHMOD 命令将文件转换为 777 权限.<br /><br />点击 <a href=\"javascript: history.go(-1);\">这里</a> 返回之前的页面.";
$install_lang["allow_url_fopen"]        = "php.ini 文件中 \"allow_url_fopen\" 的值(最好为ON)";
$install_lang["allow_url_fopen_ON"]        = "<span style=\"color:#00FF00; font-weight: bold;\">ON</span>";
$install_lang["allow_url_fopen_OFF"]        = "<span style=\"color:#FF0000; font-weight: bold;\">OFF</span>";
$install_lang["succes_upgrade1"]        = "升级完成!";
$install_lang["succes_upgrade2a"]       = "<p>您已成功升级您的tracker到 ".$GLOBALS["btit-tracker"]." ".$GLOBALS["current_btit_version"].".</p><p>您已顺利对升级进程上锁, 我们同样建议您删除 <b>upgrade.php+install.php</b> 以保证安全.</p>";
$install_lang["succes_upgrade2b"]       = "<p>您已成功升级您的tracker到 ".$GLOBALS["btit-tracker"]." ".$GLOBALS["current_btit_version"]." .</p><p>我们建议对安装进程上锁. 对安装进程上锁您需要将文件 <b>install.unlock</b> 改名为 <b>install.lock</b> 或删除名为 <b>upgrade.php</b> 和 <b>install.php</b> 的文件.</p>";
$install_lang["succes_upgrade3"]        = "<p>BTITeam希望您妥善使用我们的产品，有任何问题欢迎访问<a href=\"http://www.btiteam.org/smf/index.php\" target=\"_blank\">我们的论坛</a>.</p>";
$install_lang['error_mysql_database']   = '安装程序不能访问 &quot;<i>%s</i>&quot; 数据库.  对于一些主机来说, 您必须在xbtitFM使用数据库之前到管理面板中创建数据库.  一些主机可能要求您添加前缀(例如你的用户名)到您的数据库名称之前.';
$install_lang['error_message_click']    = '点击这里';
$install_lang['error_message_try_again']= '重试';



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