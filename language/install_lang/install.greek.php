<?php
/////////////////////////////////////////////////////////////////////////
// xBtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2007  Btiteam
//
//    Αυτό το αρχείο είναι μέρος του xBtit.
//
//    Το xBtit είναι δωρεάν λογισμικό: μπορείς να το παρέχεις και/ή να το
//    επεξεργαστείς υπό τους όρους του GNU General Public License όπως
//    προβλήθηκε απο το Free Software Foundation, είτε την έκδοση 3 απο
//    την ’δεια, ή (στην επιλογή σου) κάποια νεότερη έκδοση.
//
//    Το xBtit παρέχεται με την ελπίδα ότι θα είναι χρήσιμο,
//    αλλά ΧΩΡΙΣ ΚΑΠΟΙΟ ΕΝΤΑΛΜΑ; χωρίς έστω το εφαρμοσμένο ένταλμα του
//    ΕΜΠΟΡΙΟΥ ή ΠΡΟΘΕΣΗ ΓΙΑ ΣΥΓΚΕΚΡΙΜΕΝΟ ΣΚΟΠΟ.  Δες το
//    GNU General Public License για περισσότερες λεπτομέρειες.
//
//    Θα πρέπει να έχετε παραλάβει ένα αντίγραφο του GNU General Public License
//    μαζί με το xBtit.  Αν όχι,δες στο <http://www.gnu.org/licenses/>.
//
/////////////////////////////////////////////////////////////////////////

// αγγλικό αρχείο installation //

$install_lang["charset"]                = "ISO-8859-1";
$install_lang["lang_rtl"]               = Ψευδής;
$install_lang["step"]                   = "Βήμα:";
$install_lang["welcome_header"]         = "Καλώς ήρθατε";
$install_lang["welcome"]                = "Καλώς ήρθατε στο installation για το νέο xbtitFM-Tracker.";
$install_lang["installer_language"]     = "Γλώσσα:";
$install_lang["installer_language_set"] = "Επιλογή αυτής της γλώσσας";
$install_lang["start"]                  = "Έναρξη";
$install_lang["next"]                   = "Επόμενο";
$install_lang["back"]                   = "Προηγούμενο";
$install_lang["requirements_check"]     = "Έλεγχος αιτημάτων";
$install_lang["reqcheck"]               = "Έλεγχος req.";
$install_lang["settings"]               = "Επιλογές";
$install_lang["system_req"]             = "<p>".$GLOBALS["btit-tracker"]."&nbsp;".$GLOBALS["current_btit_version"]." Χρειάζεται PHP 4.1.2 ή καλύτερο και μια MYSQL βάση δεδομένων.</p>";
$install_lang["list_chmod"]             = "<p>Πριν πάμε παρακάτω, παρακαλώ σιγουρέψτε ότι όλα τα αρχεία ανέβηκαν και ότι τα αρχεία που ακολουθούν έχουν άδειες που ταιριάζουν στο να επιτραπεί στο σενάριο να γραφτεί(0777 should be sufficient).</p>";
$install_lang["view_log"]               = "Μπορείς να δείς ολόκληρο το changelog";
$install_lang["here"]                   = "Εδώ";
$install_lang["settingup"]              = "Φτιάχνει τις επιλογές για τον tracker";
$install_lang["settingup_info"]         = "Βασικές επιλογές";
$install_lang["sitename"]               = "Όνομα site";
$install_lang["sitename_input"]         = "xbtitFM-Tracker";
$install_lang["siteurl"]                = "Site-url";
$install_lang["siteurl_info"]           = "Without trailing slash";
$install_lang["mysql_settings"]         = "MySQL-επιλογές<br />\nΔημιούργησε ένα χρήστη ή μια βάση δεδομένων MySQL,βάλτε τις επιλογές εδώ";
$install_lang["mysql_settings_info"]    = "Έπιλογές βάσης δεδομένων.";
$install_lang["mysql_settings_server"]  = "MySQL-κεντρικός υπολογιστής(ο τοπικός host δουλεύει καλά για τους περισσότερους κεντρικούς υπολογιστές)";
$install_lang["mysql_settings_username"] = "MySQL Όνομα χρήστη";
$install_lang["mysql_settings_password"] = "MySQL Κωδικός";
$install_lang["mysql_settings_database"] = "MySQL βάση δεδομένων";
$install_lang["mysql_settings_prefix"]  = "MySQL Table Prefix";
$install_lang["cache_folder"]           = "Cache φάκελος";
$install_lang["torrents_folder"]        = "Torrents φάκελος";
$install_lang["badwords_file"]          = "badwords.txt";
$install_lang["chat.php"]               = "chat.php";
$install_lang["write_succes"]           = "<span style=\"color:#00FF00; font-weight: bold;\">is writable!</span>";
$install_lang["write_fail"]             = "<span style=\"color:#FF0000; font-weight: bold;\">NOT writable!</span> (0777)";
$install_lang["write_file_not_found"]   = "<span style=\"color:#FF0000; font-weight: bold;\">NOT FOUND!</span>";
$install_lang["mysqlcheck"]             = "MySQL έλεγχος σύνδεσης";
$install_lang["mysqlcheck_step"]        = "MySQL έλεγχος";
$install_lang["mysql_succes"]           = "<span style=\"color:#00FF00; font-weight: bold;\">Επιτυχημένη σύνδεση με τη βάση δεδομένων!</span>";
$install_lang["mysql_fail"]             = "<span style=\"color:#FF0000; font-weight: bold;\">Αποτυχία, αυτή η σύνδεση δεν μπορεί να πραγματοποιηθεί!</span>";
$install_lang["back_to_settings"]       = "Πήγαινε πίσω και συμπλήρωσε τις πληροφορίες.";
$install_lang["saved"]                  = "Αποθηκεύτηκαν";
$install_lang["file_not_writeable"]     = "Το αρχείο <b>./include/settings.php</b> δεν είναι εγγράψιμο.";
$install_lang["file_not_exists"]        = "Το αρχείο <b>./include/settings.php</b> δεν υπάρχει.";
$install_lang["not_continue_settings"]  = "Δεν μπορείς να συνεχίσεις με το install χωρίς το αρχείο να είναι εγγράψιμο.";
$install_lang["not_continue_settings2"] = "Δεν μπορείς να συνεχίσεις με αυτό το αρχείο.";
$install_lang["settings.php"]           = "./include/settings.php";
$install_lang["can_continue"]           = "Συνέχισε και κάνε τις αλλαγές αργότερα.";
$install_lang["mysql_import"]           = "MySQL εισαγωγή";
$install_lang["mysql_import_step"]      = "SQL Imp.";
$install_lang["create_owner_account"]   = "Δημιούργησε δικό σου λογαριασμό";
$install_lang["create_owner_account_step"] = "Δημιουργία δικού σου";
$install_lang["database_saved"]         = "Η database.sql έγινε εισαγωγή στη βάση δεδομένων σου.";
$install_lang["create_owner_account_info"] = "Εδώ δημιουργείς δικό σου λογαριασμό.";
$install_lang["username"]               = "Όνομα Χρήστη";
$install_lang["password"]               = "Κωδικός";
$install_lang["password2"]              = "Επανάληψη κωδικού";
$install_lang["email"]                  = "Ηλεκτρονικό ταχυδρομείο (email)";
$install_lang["email2"]                 = "επανάληψη ηλεκτρονικού ταχυδρομείου (email)";
$install_lang["is_succes"]              = "Επιτυχής εγγραφή.";
$install_lang["no_leave_blank"]         = "Μην αφήνεις κανένα πεδίο κενό.";
$install_lang["not_valid_email"]        = "Το ηλεκτρονικό ταχυδρομείο δεν είναι έγκυρο.";
$install_lang["pass_not_same_username"] = "Ο κωδικός δεν πρέπει να είναι ίδιος με το ονομα χρήστη.";
$install_lang["email_not_same"]         = "Το ηλεκτρονικό ταχυδρομείο δεν είναι ίδιο.";
$install_lang["pass_not_same"]          = "Ο κωδικός δεν είναι ίδιος.";
$install_lang["site_config"]            = "Tracker επιλογές";
$install_lang["site_config_step"]       = "Tracker Sett.";
$install_lang["default_lang"]           = "Επιλεγμένη γλώσσα";
$install_lang["default_style"]          = "Επιλεγμένο στυλ";
$install_lang["torrents_dir"]           = "Torrents Dir";
$install_lang["validation"]             = "Εγκυρότητα";
$install_lang["more_settings"]          = "*&nbsp;&nbsp;&nbsp;Περισσότερες επιλογές στο <u>Admin Panel</u> όταν έχει ολοκληρωθεί το installation.";
$install_lang["tracker_saved"]          = "Οι επιλογές σας αποθηκεύτηκαν.";
$install_lang["finished"]               = "Rounding up the Installation";
$install_lang["finished_step"]          = "Rounding up";
$install_lang["succes_install1"]        = "Το installation ολοκληρώθηκε!";
$install_lang["succes_install2a"]       = "<p>Κάνατε επιτυχώς install το ".$GLOBALS["btit-tracker"]." ".$GLOBALS["current_btit_version"].".</p><p>Tο install επιτυχώς κλειδώθηκε και <b>install.php</b> και διαγράφηκε για να αποφευχθεί η επαναχρησιμοποίησή του.</p>";
$install_lang["succes_install2b"]       = "<p>Κάνατε επιτυχώς install το ".$GLOBALS["btit-tracker"]." ".$GLOBALS["current_btit_version"].".</p><p>Σας συμβουλεύουμε να κλειδώσετε το install. Μπορείτε να το κάνετε αλλάζοντας το <b>install.unlock</b> σε <b>install.lock</b> και να διαγράψετε αυτό το <b>install.php</b> αρχείο.</p>";
$install_lang["succes_install3"]        = "<p>Η ομάδα του BTI ελπίζει να απολάυσετε τη χρησιμοποιήση αυτού του προιόντος και να σας δούμε ξανά στο <ahref=\"http://www.xbtitfm.com/forum/index.php\" target=\"_blank\">forum</a>.</p>";
$install_lang["go_to_tracker"]          = "Πήγαινε στο tracker σου";
$install_lang["forum_type"]             = "Forum τύπος";
$install_lang["forum_internal"]         = "xbtitFM-Tracker internal Forum";
$install_lang["forum_smf"]              = "Απλές μηχανές Forum";
$install_lang["forum_other"]            = "Unintegrated External Forum - Γράψτε url εδώ -->";
$install_lang["smf_download_a"]         = "<strong>If Χρησιμοποιώντας απλές μηχανές Forum:</strong><br /><br/ >Παρακαλώ κατεβάστε την τελευταία  version για τις απλές μηχανές Forum <a target='_new' href='http://www.simplemachines.org/download/'>here</a> και ανεβάστε τα περιεχόμενα της συλλογής στο \"smf\" φάκελο και <a target='_new' href='smf/install.php'>click here</a> κάντε το install.*<br /><strong>(Παρακαλώ χρησιμοποιήστε την ίδια βάση δεδομένων που χρησιμοποιήσατε για την διαδικασία του install).<br /><br /><font color='#FF0000'>Αφού γίνει install</font></strong> παρακαλώ CHMOD το SMF αγγλικής γλώσσας αερχείο (<strong>";
$install_lang["smf_download_b"]         = "</strong>) στο 777 και κάντε click <strong>Next</strong> για να συνεχίσετε με το install του xbtitFM-Tracker.<br /><br /><strong>* Και οι δύο σύνδεσμοι θα ανοίξουν σε νέο παράθυρο/tab για να αποφευχθεί το χάσιμο του install του xbtitFM-Tracker.</strong></p>";
$install_lang["smf_err_1"]              = "Δε μπορεί να βρεί το απλές μηχανές Forum στο \"smf\" φάκελο, παρακαλώ κάντε το install πριν συνεχίσετε,<br /><br />Click <a href=\"javascript: history.go(-1);\">here</a> για να επιστρέψτε στη προηγούμενη σελίδα.";
$install_lang["smf_err_2"]              = "Δε μπορεί να βρεί το απλές μηχανές Forum στη βάση δεδομένων, παρακαλώ κάντε το install πριν συνεχίσετε.<br /><br />Κάντε click <a href=\"javascript: history.go(-1);\">εδώ</a> για να επιστρέψετε στη προηγούμενη σελίδα.";
$install_lang["smf_err_3a"]             = "Δεν μπορεί να γράψει στο SMF αγγλικής γλώσσας αρχείο (<strong>";
$install_lang["smf_err_3b"]             = "</strong>) Παρακαλώ CHMOD στο 777 πριν συνεχίσετε.<br /><br />Κάντε click <a href=\"javascript: history.go(-1);\">here</a> για να επιστρέψετε στη προηγούμενη σελίδα.";
$install_lang["allow_url_fopen"]        = "php.ini value for \"allow_url_fopen\" (best is ON)";
$install_lang["allow_url_fopen_ON"]        = "<span style=\"color:#00FF00; font-weight: bold;\">ON</span>";
$install_lang["allow_url_fopen_OFF"]        = "<span style=\"color:#FF0000; font-weight: bold;\">OFF</span>";
$install_lang["succes_upgrade1"]        = "Η αναβάθμιση ολοκληρώθηκε!";
$install_lang["succes_upgrade2a"]       = "<p>Αναβαθμίσατε επιτυχώς ".$GLOBALS["btit-tracker"]." ".$GLOBALS["current_btit_version"]." στον tracker σας.</p><p>Η αναβάθμιση κλειδώθηκε επιτυχώς για να αποφευχθεί η επαναχρησιμοποίησή του αλλά σας συμβουλεύουμε να το διαγράψετε <b>upgrade.php+install.php</b> για περισσότερη προστασία.</p>";
$install_lang["succes_upgrade2b"]       = "<p>Αναβαθμίσατε επιτυχώς ".$GLOBALS["btit-tracker"]." ".$GLOBALS["current_btit_version"]." στον tracker σας.</p><p>Σας συμβουλεύουμε να κλειδώσετε το install. Μπορείτε να το κάνετε αυτό αλλάζωντάς <b>install.unlock</b> το <b>install.lock</b> ή για να διαγράψετε αυτό το <b>upgrade.php+install.php</b> αρχείο.</p>";
$install_lang["succes_upgrade3"]        = "<p>WΗ ομάδα του BTI ελπίζει να απολάυσετε τη χρησιμοποιήση αυτού του προιόντος και να σας δούμε <ahref=\"http://www.xbtitfm.com/forum/index.php\" target=\"_blank\">forum</a>.</p>";
$install_lang['error_mysql_database']   = 'Ο installer δε μπόρεσε να έχει πρόσβαση στο &quot;<i>%s</i>&quot; database.  Με μερικούς hosts, πρέπει να δημιουργήσετε βάση δεδομένων μέσα στο administration panel πριν το xbtitFM το χρησιμοποιήσει.  Μερικοί ακόμη προσθέτουν prefixes - όπως το όνομα χρήστη σας - στα ονόματά σας στη βάση δεδομένων.';
$install_lang['error_message_click']    = 'Πάτα εδώ';
$install_lang['error_message_try_again']= 'για να ξαναδοκιμάσεις';
$install_lang["torrentimg_dir"] = "torrentimg φάκελος";
$install_lang["torrentstats_dir"] = "torrentstats φάκελος";
$install_lang["subtitles_dir"] = "subtitles φάκελος";
$install_lang["nforep_dir"] = "nfo/rep φάκελος";
$install_lang["imdbcache_dir"] = "imdb/cache φάκελος";
$install_lang["imdbimg_dir"] = "imdb/images φάκελος";
$install_lang["googimg_dir"] = "googly/imgs φάκελος";
$install_lang["avatar_dir"] = "avatar φάκελος";
$install_lang["sxd_dir"] = "sxd/backup φάκελος";
$install_lang["thetvdb_dir"] = "thetvdb φάκελος";

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