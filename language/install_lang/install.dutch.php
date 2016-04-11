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

// dutch installation file //

$install_lang["charset"]                = "ISO-8859-1";
$install_lang["lang_rtl"]               = FALSE;
$install_lang["step"]                   = "STAP:";
$install_lang["welcome_header"]         = "Welkom";
$install_lang["welcome"]                = "Welkom bij de installatie van die nieuwe xbtitFM.";
$install_lang["installer_language"]     = "Taal:";
$install_lang["installer_language_set"] = "Stel deze taal in";
$install_lang["start"]                  = "Start";
$install_lang["next"]                   = "Volgende";
$install_lang["back"]                   = "Terug";
$install_lang["requirements_check"]     = "Benodigdheden Controle";
$install_lang["reqcheck"]               = "Benod. Controle";
$install_lang["settings"]               = "Instellingen";
$install_lang["system_req"]             = "<p>".$GLOBALS["btit-tracker"]."&nbsp;".$GLOBALS["current_btit_version"]." vereist PHP 4.1.2 of beter en een MYSQL database.</p>";
$install_lang["list_chmod"]             = "<p>Voordat we verdergaan, zorg ervoor dat alle bestanden geupload zijn en de onderstaande bestanden de goede permissies heeft voor dit script om weg te schrijven (0777 zou voldoende moeten zijn).</p>";
$install_lang["view_log"]               = "Bekijk de volledige wijzigingen";
$install_lang["here"]                   = "hier";
$install_lang["settingup"]              = "Opzetten van uw tracker";
$install_lang["settingup_info"]         = "Een paar installatie onderdelen";
$install_lang["sitename"]               = "Naam van site";
$install_lang["sitename_input"]         = "xbtitFM";
$install_lang["siteurl"]                = "Link van de site";
$install_lang["siteurl_info"]           = "Zonder een <b>/</b> op het einde.";
$install_lang["mysql_settings"]         = "MySQL Instellingen";
$install_lang["mysql_settings_info"]    = "Uw instellingen voor uw database.";
$install_lang["mysql_settings_server"]  = "MySQL Server Adres";
$install_lang["mysql_settings_username"] = "MySQL Gebruikersnaam";
$install_lang["mysql_settings_password"] = "MySQL Wachtwoord";
$install_lang["mysql_settings_database"] = "MySQL Database";
$install_lang["mysql_settings_prefix"]  = "MySQL Tabel Prefix";
$install_lang["cache_folder"]           = "Cache Map";
$install_lang["torrents_folder"]        = "Torrents Map";
$install_lang["badwords_file"]          = "badwords.txt";
$install_lang["chat.php"]               = "chat.php";
$install_lang["write_succes"]           = "<span style=\"color:#00FF00; font-weight: bold;\">is schrijfbaar!</span>";
$install_lang["write_fail"]             = "<span style=\"color:#FF0000; font-weight: bold;\">NIET schrijfbaar!</span> (0777)";
$install_lang["write_file_not_found"]   = "<span style=\"color:#FF0000; font-weight: bold;\">NIET gevonden!</span>";
$install_lang["mysqlcheck"]             = "MySQL Connectie Controle";
$install_lang["mysqlcheck_step"]        = "MySQL Contr.";
$install_lang["mysql_succes"]           = "<span style=\"color:#00FF00; font-weight: bold;\">Met succes verbinding gemaakt met de database!</span>";
$install_lang["mysql_fail"]             = "<span style=\"color:#FF0000; font-weight: bold;\">Helaas, de verbinding kon niet worden gemaakt!</span>";
$install_lang["back_to_settings"]       = "Ga terug en vul de juiste benodigde gegevens in.";
$install_lang["saved"]                  = "opgeslagen";
$install_lang["file_not_writeable"]     = "Het bestand <b>./include/settings.php</b> is niet schrijfbaar.";
$install_lang["file_not_exists"]        = "Het bestand <b>./include/settings.php</b> bestaat niet.";
$install_lang["not_continue_settings"]  = "U kunt niet verdergaan zonder dat dit bestand schrijfbaar is.";
$install_lang["not_continue_settings2"] = "U kunt niet verdergaan zonder dit bestand.";
$install_lang["settings.php"]           = "./include/settings.php";
$install_lang["can_continue"]           = "U kunt verdergaan en deze vereisten later corrigeren.";
$install_lang["mysql_import"]           = "MySQL Importeren";
$install_lang["mysql_import_step"]      = "SQL Imp.";
$install_lang["create_owner_account"]   = "Aanmaken van Eigenaars Account";
$install_lang["create_owner_account_step"] = "Maak Eigenaar";
$install_lang["database_saved"]         = "De database.sql bestand is geimporteerd naar uw database.";
$install_lang["create_owner_account_info"] = "Hier kunt u het eigenaars account aanmaken.";
$install_lang["username"]               = "Gebruikersnaam";
$install_lang["password"]               = "Wachtwoord";
$install_lang["password2"]              = "Herhaal wachtwoord";
$install_lang["email"]                  = "Email";
$install_lang["email2"]                 = "Herhaal email";
$install_lang["is_succes"]              = "is gelukt.";
$install_lang["no_leave_blank"]         = "U mag niets leeg laten.";
$install_lang["not_valid_email"]        = "Dit is geen geldig email adres.";
$install_lang["pass_not_same_username"] = "Uw wachtwoord mag niet hetzelfde zijn als uw gebruikersnaam.";
$install_lang["email_not_same"]         = "Email adressen komen niet overeen.";
$install_lang["pass_not_same"]          = "De wachtwoorden komen niet overeen.";
$install_lang["site_config"]            = "Tracker Instellingen";
$install_lang["site_config_step"]       = "Tracker Inst.";
$install_lang["default_lang"]           = "Standaard Taal";
$install_lang["default_style"]          = "Standaard Uiterlijk";
$install_lang["torrents_dir"]           = "Torrents Folder";
$install_lang["validation"]             = "Validatie Instelling";
$install_lang["more_settings"]          = "*&nbsp;&nbsp;&nbsp;Meer instelling in het <u>Admin Paneel</u> wanneer de installatie voltooid is.";
$install_lang["tracker_saved"]          = "De instelling zijn opgeslagen.";
$install_lang["finished"]               = "Afronding van Installatie";
$install_lang["finished_step"]          = "Afronden";
$install_lang["succes_install1"]        = "De installatie is gelukt!";
$install_lang["succes_install2a"]       = "<p>U heeft met succes ".$GLOBALS["btit-tracker"]." ".$GLOBALS["current_btit_version"]." ge&iuml;nstalleerd op uw tracker.</p><p>De installatie is met succes vergrendelt tegen hergebruik maar wij adviseren u om <b>install.php</b> te verwijderen voor de zekerheid.</p>";
$install_lang["succes_install2b"]        = "<p>U heeft met succes ".$GLOBALS["btit-tracker"]." ".$GLOBALS["current_btit_version"]." geïnstalleerd op uw tracker.</p><p>Wij adviseren u de installatie te vergrendelen. Dit kunt u doen door <b>install.unlock</b> te veranderen naar <b>install.lock</b> of dit <b>install.php</b> bestand te verwijderen.</p>";
$install_lang["succes_install3"]        = "<p>Wij van BTITeam wensen u veel plezier bij het gebruik van dit product en hopen u nog eens te zien op ons <a href=\"http://www.xbtitfm.com/forum/index.php\" target=\"_blank\">forum</a>.</p>";
$install_lang["go_to_tracker"]          = "Ga naar uw tracker";
$install_lang["forum_type"]             = "Forum Type";
$install_lang["forum_internal"]         = "xbtitFM Intern Forum";
$install_lang["forum_smf"]              = "Simple Machines Forum";
$install_lang["forum_other"]            = "Niet ge&iuml;ntegreerd Extern Forum - Plaats de link hier -->";
$install_lang["smf_download_a"]         = "<strong>Wanneer u Simple Machines Forum gebruikt:</strong><br /><br/ >Download a.u.b. de laatste versie van Simple Machines Forum <a target='_new' href='http://www.simplemachines.org/download/'>hier</a> en upload naar de \"smf\" folder en <a target='_new' href='smf/install.php'>klik hier</a> om vervolgens te installeren.<br />*<strong>(Gebruik alstublieft dezefde database kwalificaties zoals u deze gebruikt heeft in de installatie).<br /><br /><font color='#FF0000'>Eenmaal ge&iuml;nstalleerd</font></strong> CHMOD de engelse SMF taalbestand<br />(<strong>";
$install_lang["smf_download_b"]         = "</strong>)<br />naar 777 en klik op <strong>Volgende</strong> om verder te gaan met de xbtitFM installatie.<br /><br /><strong>* Allebei de linken worden geopend in een nieuw window/tab om verlies van data tegen te gaan tijdens de xbtitFM installatie.</strong></p>";
$install_lang["smf_err_1"]              = "Kan Simple Machines Forum in de \"smf\" folder is niet vinden, installeer dit eerst voordat u verdergaat.<br /><br />Klik <a href=\"javascript: history.go(-1);\">hier</a> om terug te gaan.";
$install_lang["smf_err_2"]              = "Kan Simple Machines Forum niet vinden in de database, installeer dit eerst voordat u verdergaat.<br /><br />Klik <a href=\"javascript: history.go(-1);\">hier</a> om terug te gaan.";
$install_lang["smf_err_3a"]             = "Mislukt om te schrijven naar het engelse SMF taalbestand (<strong>";
$install_lang["smf_err_3b"]             = "</strong>) CHMOD dit eerst voordat u verdergaat.<br /><br />Klik <a href=\"javascript: history.go(-1);\">hier</a> om terug te gaan.";
$install_lang["allow_url_fopen"]        = "php.ini waarde voor \"allow_url_fopen\" (beste is ON)";
$install_lang["allow_url_fopen_ON"]     = "<span style=\"color:#00FF00; font-weight: bold;\">ON</span>";
$install_lang["allow_url_fopen_OFF"]    = "<span style=\"color:#FF0000; font-weight: bold;\">OFF</span>";
$install_lang["succes_upgrade1"]        = "Upgrade is geslaagd!";
$install_lang["succes_upgrade2a"]       = "<p>U heeft met succes ".$GLOBALS["btit-tracker"]." ".$GLOBALS["current_btit_version"]." geupgrade op uw tracker.</p><p>De installatie is met succes vergrendelt tegen hergebruik maar wij adviseren u om <b>upgrade.php+install.php</b> te verwijderen voor de zekerheid.</p>";
$install_lang["succes_upgrade2b"]       = "<p>U heeft met succes ".$GLOBALS["btit-tracker"]." ".$GLOBALS["current_btit_version"]." geupgrade op uw tracker.</p><p>Wij adviseren u de installatie te vergrendelen. Dit kunt u doen door <b>install.unlock</b> te veranderen naar <b>install.lock</b> of dit <b>upgrade.php+install.php</b> bestand te verwijderen.</p>";
$install_lang["succes_upgrade3"]        = "<p>Wij van BTITeam hopen dat u veel plezier heeft met dit product en wij hopen u nog een terug te zien op ons <a href=\"http://www.xbtitfm.com/forum/index.php\" target=\"_blank\">forum</a>.</p>";
$install_lang['error_mysql_database']   = 'De installer kon geen verbinding krijgen met de &quot;<i>%s</i>&quot; database. Met enkele hosts, moet u een database aanmaken in uw administratie paneel voordat xbtitFM het kan gebruiken. Ook het toevoegen van prefixes - zoals uw gebruikersnaam - aan uw database.';
$install_lang['error_message_click']    = 'Klik hier';
$install_lang['error_message_try_again']= 'om het opnieuw te proberen';
$install_lang["torrentimg_dir"] = "torrentimg Map";
$install_lang["torrentstats_dir"] = "torrentstats Map";
$install_lang["subtitles_dir"] = "subtitles Map";
$install_lang["nforep_dir"] = "nfo/rep Map";
$install_lang["imdbcache_dir"] = "imdb/cache Map";
$install_lang["imdbimg_dir"] = "imdb/images Map";
$install_lang["googimg_dir"] = "googly/imgs Map";
$install_lang["avatar_dir"] = "avatar Map";
$install_lang["sxd_dir"] = "sxd/backup Map";
$install_lang["thetvdb_dir"] = "thetvdb Map";

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