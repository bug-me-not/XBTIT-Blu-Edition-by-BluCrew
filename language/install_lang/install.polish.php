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

$install_lang["charset"]                = "UTF-8";
$install_lang["lang_rtl"]               = FALSE;
$install_lang["step"]                   = "KROK:";
$install_lang["welcome_header"]         = "Witamy";
$install_lang["welcome"]                = "Witamy w instalacji nowego xbtitFM.";
$install_lang["installer_language"]     = "Język:";
$install_lang["installer_language_set"] = "Przełącz na ten język";
$install_lang["start"]                  = "Start";
$install_lang["next"]                   = "Następny";
$install_lang["back"]                   = "Poprzedni";
$install_lang["requirements_check"]     = "Wymagania sprawdzone";
$install_lang["reqcheck"]               = "Wym. sprawdzone";
$install_lang["settings"]               = "Ustawienia";
$install_lang["system_req"]             = "<p>".$GLOBALS["btit-tracker"]."&nbsp;".$GLOBALS["current_btit_version"]." wymaga PHP 4.1.2 bądź wyższego i serwera MYSQL .</p>";
$install_lang["list_chmod"]             = "<p>Zanim zainstalujesz skrypt, proszę sprawdź czy wszystkie pliki zostały wysłane na ftp i czy poniższe pliki/katalogi mają ustawione prawidłowe uprawnienia pozwalające skryptowi na zapis tych plików/katalogów (0777 powinien być odpowiedni).</p>";
$install_lang["view_log"]               = "Możesz przejrzeć pełną listę zmian";
$install_lang["here"]                   = "tutaj";
$install_lang["settingup"]              = "Ustaw swój tracker";
$install_lang["settingup_info"]         = "Ustawienia podstawowe";
$install_lang["sitename"]               = "Nazwa strony";
$install_lang["sitename_input"]         = "xbtitFM";
$install_lang["siteurl"]                = "Url strony";
$install_lang["siteurl_info"]           = "Bez końcowego <b>/</b>.";
$install_lang["mysql_settings"]         = "Ustawienia MySQL";
$install_lang["mysql_settings_info"]    = "Ustawienia bazy danych.";
$install_lang["mysql_settings_server"]  = "Serwer MySQL";
$install_lang["mysql_settings_username"] = "Użytkownik bazy MySQL";
$install_lang["mysql_settings_password"] = "Hasło do bazy MySQL";
$install_lang["mysql_settings_database"] = "Baza MySQL";
$install_lang["mysql_settings_prefix"]  = "Prefix tabel MySQL";
$install_lang["cache_folder"]           = "Folder Cache";
$install_lang["torrents_folder"]        = "Folder plików torrent";
$install_lang["badwords_file"]          = "badwords.txt";
$install_lang["chat.php"]               = "chat.php";
$install_lang["write_succes"]           = "<span style=\"color:#00FF00; font-weight: bold;\">jest zapisywalny!</span>";
$install_lang["write_fail"]             = "<span style=\"color:#FF0000; font-weight: bold;\">NIE jest zapisywalny!</span> (0777)";
$install_lang["write_file_not_found"]   = "<span style=\"color:#FF0000; font-weight: bold;\">NIE ZNALEZIONO!</span>";
$install_lang["mysqlcheck"]             = "Sprawdzenie połączenia z bazą MySQL";
$install_lang["mysqlcheck_step"]        = "Sprawdzanie MySQL";
$install_lang["mysql_succes"]           = "<span style=\"color:#00FF00; font-weight: bold;\">Połączenie do bazą danych powiodło się!</span>";
$install_lang["mysql_fail"]             = "<span style=\"color:#FF0000; font-weight: bold;\">Połączenie z bazą danych nie powiodło się!</span>";
$install_lang["back_to_settings"]       = "Przejdź do poprzedniego kroku i sprawdź ustawienia.";
$install_lang["saved"]                  = "zapisane";
$install_lang["file_not_writeable"]     = "Plik <b>./include/settings.php</b> nie jest zapisywalny.";
$install_lang["file_not_exists"]        = "Plik <b>./include/settings.php</b> nie istnieje.";
$install_lang["not_continue_settings"]  = "Nie możesz kontynuować instalacji dopóki ten plik nie będzie zapisywalny.";
$install_lang["not_continue_settings2"] = "Nie możesz kontynuować z tym plikiem.";
$install_lang["settings.php"]           = "./include/settings.php";
$install_lang["can_continue"]           = "Możesz kontynuować i zmienić to później.";
$install_lang["mysql_import"]           = "Import MySQL";
$install_lang["mysql_import_step"]      = "Imp. SQL";
$install_lang["create_owner_account"]   = "Tworzenie konta właściciela";
$install_lang["create_owner_account_step"] = "Twórz konto właściciela";
$install_lang["database_saved"]         = "Plik database.sql został zaimportowany do twojej bazy danych.";
$install_lang["create_owner_account_info"] = "Tutaj możesz stworzyć konto właściciela.";
$install_lang["username"]               = "Nick";
$install_lang["password"]               = "Hasło";
$install_lang["password2"]              = "Powtórz hasło";
$install_lang["email"]                  = "Email";
$install_lang["email2"]                 = "Powtórz email";
$install_lang["is_succes"]              = "zrobione.";
$install_lang["no_leave_blank"]         = "Nie zostawiaj żadnych pustych pól.";
$install_lang["not_valid_email"]        = "To nie jest prawidłowy adres email.";
$install_lang["pass_not_same_username"] = "Hasło nie może być takie samo jak twoja nazwa użytkownika.";
$install_lang["email_not_same"]         = "Adresy email nie pasują.";
$install_lang["pass_not_same"]          = "Hasla nie pasują.";
$install_lang["site_config"]            = "Ustawienia trackera";
$install_lang["site_config_step"]       = "Ust. trackera.";
$install_lang["default_lang"]           = "Domyślny język";
$install_lang["default_style"]          = "Domyślny styl";
$install_lang["torrents_dir"]           = "Folder torrentów";
$install_lang["validation"]             = "Tryb zatwierdzania kont";
$install_lang["more_settings"]          = "*&nbsp;&nbsp;&nbsp;Więcej ustawień znajdziesz w <u>Panelu Admina</u> kiedy zakończysz instalację.";
$install_lang["tracker_saved"]          = "Ustawienia zostały zapisane.";
$install_lang["finished"]               = "Kończenie instalacji";
$install_lang["finished_step"]          = "Kończenie";
$install_lang["succes_install1"]        = "Instalacja zakończona!";
$install_lang["succes_install2a"]       = "<p>Właśnie pomyślnie zainstalowałeś ".$GLOBALS["btit-tracker"]." ".$GLOBALS["current_btit_version"]." jako swój tracker.</p><p>Instalacja została pomyślnie zablokowana aby zapobiec użyciu jej ponownie ale radzimy abyś usunął <b>install.php</b> dla dodatkowej ochrony.</p>";
$install_lang["succes_install2b"]       = "<p>Właśnie pomyślnie zainstalowałeś ".$GLOBALS["btit-tracker"]." ".$GLOBALS["current_btit_version"]." jako swój tracker.</p><p>Zalecamy zablokować proces instalacji. Możesz to zrobić poprzez zmianę nazwy pliku <b>install.unlock</b> na <b>install.lock</b> lub usunięcie pliku <b>install.php</b> .</p>";
$install_lang["succes_install3"]        = "<p>My z BTITeam mamy nadzieję, że będziesz zadowolony używając ten skrypt i zobaczymy się na naszym <a href=\"http://www.xbtitfm.com/forum/index.php\" target=\"_blank\">forum</a>.</p>";
$install_lang["go_to_tracker"]          = "Przejdź do swojego trackera";
$install_lang["forum_type"]             = "Rodzaj forum";
$install_lang["forum_internal"]         = "Wewnętrzne xbtitFM Forum";
$install_lang["forum_smf"]              = "Simple Machines Forum";
$install_lang["forum_other"]            = "Niezintegrowane zewnętrzne forum - Wpisz adres tutaj -->";
$install_lang["smf_download_a"]         = "<strong>Jeżeli wybierasz Simple Machines Forum:</strong><br /><br/ >Proszę ściągnąć najnowszą wersję Simple Machines Forum <a target='_new' href='http://www.simplemachines.org/download/'>stąd</a> i wysłać zawartość archiwum do folderu \"smf\" i <a target='_new' href='smf/install.php'>kliknąć tutaj</a> aby je zainstalować.*<br /><strong>(Proszę użyć tych samych danych uwierzytelniających do bazy których używasz do instalacji trackera.)<br /><br /><font color='#FF0000'>Gdy zainstalujesz</font></strong> proszę zmienić CHMOD angielskiego pliku językowego SMF (<strong>";
$install_lang["smf_download_b"]         = "</strong>) na 777 i kliknij <strong>Następny</strong> aby kontynuować instalację xbtitFM.<br /><br /><strong>* Oba linki otworzą się w nowych oknach/zakładkach aby zapobiec wyłączeniu instalatora xbtitFM.</strong></p>";
$install_lang["smf_err_1"]              = "Nie można znaleźć Simple Machines Forum w folderze \"smf\", proszę zainstalować forum zanim przejdziesz do następnego kroku.<br /><br />Kliknij <a href=\"javascript: history.go(-1);\">tutaj</a> aby powrócić do poprzedniej strony.";
$install_lang["smf_err_2"]              = "Nie można znaleźć Simple Machines Forum w bazie danych, proszę zainstalować forum zanim przejdziesz do następnego kroku.<br /><br />Kliknij <a href=\"javascript: history.go(-1);\">tutaj</a> aby powrócić do poprzedniej strony.";
$install_lang["smf_err_3a"]             = "Nie można zapisywać do angielskiego pliku językowego SMF English (<strong>";
$install_lang["smf_err_3b"]             = "</strong>) proszę zmienić CHMOD na 777 przed kontynuacją instalacji.<br /><br />Kliknij <a href=\"javascript: history.go(-1);\">tutaj</a> aby wrócić do poprzedniej strony.";
$install_lang["allow_url_fopen"]        = "wartość w php.ini dla \"allow_url_fopen\" (najlepsze będzie ON)";
$install_lang["allow_url_fopen_ON"]        = "<span style=\"color:#00FF00; font-weight: bold;\">ON</span>";
$install_lang["allow_url_fopen_OFF"]        = "<span style=\"color:#FF0000; font-weight: bold;\">OFF</span>";
$install_lang["succes_upgrade1"]        = "Uaktualnienie zakończone!";
$install_lang["succes_upgrade2a"]       = "<p>Właśnie uaktualniłeś ".$GLOBALS["btit-tracker"]." ".$GLOBALS["current_btit_version"]." na twoim trackerze.</p><p>Uaktualnienie zostało zablokowane aby zapobiec ponownemu jego wykonaniu ale radzimy usunąć także <b>upgrade.php+install.php</b> dla dodatkowej ochrony.</p>";
$install_lang["succes_upgrade2b"]       = "<p>Właśnie uaktualniłeś ".$GLOBALS["btit-tracker"]." ".$GLOBALS["current_btit_version"]." na twoim trackerze.</p><p>Radzimy zablokować instalację. Możesz to zrobić zamieniając rozszerzenie <b>install.unlock</b> na <b>install.lock</b> lub usunąć te pliki <b>upgrade.php+install.php</b> .</p>";
$install_lang["succes_upgrade3"]        = "<p>My z BTITeam mamy nadzieje, że będziesz zadowolony z używania tego produktu i zobaczymy się ponownie na naszym <a href=\"http://www.xbtitfm.com/forum/index.php\" target=\"_blank\">forum</a>.</p>";
$install_lang['error_mysql_database']   = 'Instalator nie mógł połączyć sie z bazą danych &quot;<i>%s</i>&quot; . Na niektórych hostingach trzeba najpierw utworzyć bazę danych w panelu administracyjnym hostingu przed instalacją xbtitFM.';
$install_lang['error_message_click']    = 'Kliknij tutaj';
$install_lang['error_message_try_again']= 'aby spróbować ponownie';
$install_lang["torrentimg_dir"] = "Folder torrentimg";
$install_lang["torrentstats_dir"] = "Folder torrentstats";
$install_lang["subtitles_dir"] = "Folder subtitles";
$install_lang["nforep_dir"] = "Folder nfo/rep";
$install_lang["imdbcache_dir"] = "Folder imdb/cache";
$install_lang["imdbimg_dir"] = "Folder imdb/images";
$install_lang["googimg_dir"] = "Folder googly/imgs";
$install_lang["avatar_dir"] = "Folder avatar";
$install_lang["sxd_dir"] = "Folder sxd/backup";
$install_lang["thetvdb_dir"] = "Folder thetvdb";

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