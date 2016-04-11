<?php
$language['ACP_BAN_IP']='Ban IPs';
$language['ACP_FORUM']='Forum indstillinger';
$language['ACP_USER_GROUP']='Brugergruppe indstillinger';
$language['ACP_STYLES']='Tema indstillinger';
$language['ACP_LANGUAGES']='Sprog indstillinger';
$language['ACP_CATEGORIES']='Kategori indstillinger';
$language['ACP_TRACKER_SETTINGS']='Tracker indstillinger';
$language['ACP_OPTIMIZE_DB']='Optim?r database';
$language['ACP_CENSORED']='Censur indstillinger';
$language['ACP_DBUTILS']='Database programmer';
$language['ACP_HACKS']='Hacks';
$language['ACP_HACKS_CONFIG']='Hacks indstillinger';
$language['ACP_MODULES']='Moduler';
$language['ACP_MODULES_CONFIG']='Module indstillinger';
$language['ACP_MASSPM']='Multi privat besked';
$language['ACP_PRUNE_TORRENTS']='Udrens torrents';
$language['ACP_PRUNE_USERS']='Udrens brugere';
$language['ACP_SITE_LOG']='Se site log';
$language['ACP_SEARCH_DIFF']='Søg differencer';
$language['ACP_BLOCKS']='Block indstillinger';
$language['ACP_POLLS']='Poll indstillinger';
$language['ACP_MENU']='Admin menu';
$language['ACP_FRONTEND']='Indholds indstillinger';
$language['ACP_USERS_TOOLS']='Bruger værktøj';
$language['ACP_TORRENTS_TOOLS']='Torrent værktøj';
$language['ACP_OTHER_TOOLS']='Andre værktøjer';
$language['ACP_MYSQL_STATS']='MySql statistikker';
$language['XBTT_BACKEND']='XBTT indstillinger';
$language['XBTT_USE']='Brug <a href="http://xbtt.sourceforge.net/tracker/" target="_blank">xbtt</a> som backend?';
$language['XBTT_URL']='xbtt base url f.eks. http://localhost:2710';
$language['GENERAL_SETTINGS']='Generelle indstillinger';
$language['TRACKER_NAME']='Trackerens navn';
$language['TRACKER_BASEURL']='Trackers URL (uden det sidste /)';
$language['TRACKER_ANNOUNCE']='Trackerens announce URLS (1 url per linie)'.($XBTT_USE?'<br />'."\n".'<span style="color:#FF0000; font-weight: bold;">Check dine announce urls to gange, slå xbtt backend til...</span>':'');
$language['TRACKER_EMAIL']='Trackers/ejers email';
$language['TORRENT_FOLDER']='Torrent bibliotek';
$language['ALLOW_EXTERNAL']='Tillad eksterne torrents';
$language['ALLOW_GZIP']='Tillad GZIP';
$language['ALLOW_DEBUG']='Vis debug info på sidens bund';
$language['ALLOW_DHT']='Sl? DHT fra (private flag i torrent)<br />'."\n".'vil kun ændres for nye torrents';
$language['ALLOW_LIVESTATS']='Slå live stats til (advarsel - bruger mange ressourcer!)';
$language['ALLOW_SITELOG']='Slå site log til (logger ?ndringer i torrents og brugere)';
$language['ALLOW_HISTORY']='Slå site historik til (torrents/brugere)';
$language['ALLOW_PRIVATE_ANNOUNCE']='Private announce';
$language['ALLOW_PRIVATE_SCRAPE']='Private scrape';
$language['SHOW_UPLOADER']='Vis uploaders navn';
$language['USE_POPUP']='Brug popup til torrent detaljer';
$language['DEFAULT_LANGUAGE']='Standard sprog';
$language['DEFAULT_CHARSET']='Standard karaktersæt<br />'."\n".'(hvis det valgte sprog ikke virker så prøv UTF-8)';
$language['DEFAULT_STYLE']='Standard tema';
$language['MAX_USERS']='Max brugere (numerisk, 0 = ingen max)';
$language['MAX_TORRENTS_PER_PAGE']='Torrents per side';
$language['SPECIFIC_SETTINGS']='Trackerens specifikke indstillinger';
$language['SETTING_INTERVAL_SANITY']='Sanity interval (numerisk i sekunder, 0 = slået fra)<br />God værdi, hvis slået til er 1800 (30 minutter)';
$language['SETTING_INTERVAL_EXTERNAL']='Update External interval (numerisk i sekunder, 0 = slået fra)<br />Afhængig af hvor mange eksterne torrents';
$language['SETTING_INTERVAL_MAX_REANNOUNCE']='Maximum reannounce interval (numerisk i sekunder)';
$language['SETTING_INTERVAL_MIN_REANNOUNCE']='Minimum reannounce interval (numerisk i sekunder)';
$language['SETTING_MAX_PEERS']='Max antal peers for request (numerisk)';
$language['SETTING_DYNAMIC']='Tillad dynamiske torrents (ikke anbefalet)';
$language['SETTING_NAT_CHECK']='NAT check';
$language['SETTING_PERSISTENT_DB']='Vedholdende forbindelser (database, ikke anbefalet)';
$language['SETTING_OVERRIDE_IP']='Tillad brugere at tilsidesætte fundne IPer';
$language['SETTING_CALCULATE_SPEED']='Udregn hastighed og downloadede bytes';
$language['SETTING_PEER_CACHING']='Tabel caching (burde nedsætte server load)';
$language['SETTING_SEEDS_PID']='Max antal seeds fra samme PID';
$language['SETTING_LEECHERS_PID']='Max antal leechers fra samme PID';
$language['SETTING_VALIDATION']='Validerings metode';
$language['SETTING_CAPTCHA']='Sikker registrering (brug ImageCode, GD+Freetype libraries nødvendigt)';
$language['SETTING_FORUM']='Forum link, kan være:<br /><li><font color="#FF0000">intern</font> eller tom (ingen værdi) for intern forum</li><li><font color="#FF0000">smf</font> for integreret <a target="_new" href="http://www.simplemachines.org">Simple Machines Forum</a></li><li>Din egen forum løsning (specificer URL i boks)</li>';
$language['BLOCKS_SETTING']='Index/Blocks indstillinger';
$language['SETTING_CLOCK']='Ur type';
$language['SETTING_FORUMBLOCK']='Forum block type';
$language['SETTING_NUM_NEWS']='Grænse for Latest news block (numerisk)';
$language['SETTING_NUM_POSTS']='Grænse for Forum block (numerisk)';
$language['SETTING_NUM_LASTTORRENTS']='Grænse for Sidste torrents block (numerisk)';
$language['SETTING_NUM_TOPTORRENTS']='Grænse for Mest populære torrents block (numerisk)';$language["Custom_foot"]="Egen footer line (blank for ikke at vise):";
	  $language["ADMIN_INFO"]="Administration af:";

$language['CLOCK_ANALOG']='Analog';
$language['CLOCK_DIGITAL']='Digital';
$language['FORUMBLOCK_POSTS']='Sidste posts';
$language['FORUMBLOCK_TOPICS']='Sidste aktive emner';
$language['CONFIG_SAVED']='Konfigureringen er blevet opdateret!';
$language['CACHE_SITE']='Cache interval (numerisk i sekunder, 0 = slået fra)';
$language['ALL_FIELDS_REQUIRED']='Alle felter er obligatoriske!';
$language['SETTING_CUT_LONG_NAME']='Klip lange torrent navne efter x antal tegn (0 = klip ikke)';
$language['MAILER_SETTINGS']='Mailer';
$language['SETTING_MAIL_TYPE']='Mail type';
$language['SETTING_SMTP_SERVER']='SMTP server';
$language['SETTING_SMTP_PORT']='SMTP port';
$language['SETTING_SMTP_USERNAME']='SMTP brugernavn';
$language['SETTING_SMTP_PASSWORD']='SMTP kodeord';
$language['SETTING_SMTP_PASSWORD_REPEAT']='SMTP kodeord (gentag)';
$language['XBTT_TABLES_ERROR']='Du burde skulle importerer xbtt tabeller (se xbtt installations instruktioner) ind i din database før du aktiver xbtt backend!';
$language['XBTT_URL_ERROR']='xbtt base url er obligatorisk!';
// BAN FORM
$language['BAN_NOTE']='I denne del af admin panelet, kan du se udelukkede (banned) iper samt udelukke nye IPer fra trackeren.<br />'."\n".'Du skal indtaste en værdi fra første til sidste IP (eks. 65.82.10.1 - 65.82.10.1 osv';
$language['BAN_NOIP']='Der er ingen udelukkede IPer';
$language['BAN_FIRSTIP']='Første IP';
$language['BAN_LASTIP']='Sidste IP';
$language['BAN_COMMENTS']='Kommentarer';
$language['BAN_REMOVE']='Slet';
$language['BAN_BY']='Af';
$language['BAN_ADDED']='Dato';
$language['BAN_INSERT']='Tilføj nye IP værdier';
$language['BAN_IP_ERROR']='Ikke gyldig IP adresse.';
$language['BAN_NO_IP_WRITE']='Du har ikke indtastet en IP adresse!';
$language['BAN_DELETED']='IP værdierne er blevet slettet fra databasen.<br />'."\n".'<br />'."\n".'<a href="index.php?page=admin&amp;user='.$CURUSER['uid'].'&amp;code='.$CURUSER['random'].'&amp;do=banip&amp;action=read">Gå tilbage til Udelukkede IPer</a>';
// LANGUAGES
$language['LANGUAGE_SETTINGS']='Sprog indstillinger';
$language['LANGUAGE']='Sprog';
$language['LANGUAGE_ADD']='Indsæt nyt sprog';
$language['LANGUAGE_SAVED']='Sproger er blevet modificeret';
// STYLES
$language['STYLE_SETTINGS']='Tema/Style indstillinger';
$language['STYLE_EDIT']='Rediger style';
$language['STYLE_ADD']='Indsæt ny style';
$language['STYLE_NAME']='Style navn';
$language['STYLE_URL']='Style URL';
$language['STYLE_FOLDER']='Style bibliotek';
$language['STYLE_NOTE']='I denne sektion kan du håndtere dine style indstillinger, men du skal uploade styles fra ftp/sftp.';
// CATEGORIES
$language['CATEGORY_SETTINGS']='Kategori indstillinger';
$language['CATEGORY_IMAGE']='Kategori billede';
$language['CATEGORY_ADD']='Indsæt ny kategori';
$language['CATEGORY_SORT_INDEX']='Sortering';
$language['CATEGORY_FULL']='Kategori';
$language['CATEGORY_EDIT']='Rediger kategori';
$language['CATEGORY_SUB']='Under-kategori';
$language['CATEGORY_NAME']='Kategori';
// CENSORED
$language['CENSORED_NOTE']='Skriv <b>1 ord per linie</b> for at udelukke det (vil blive ændret til *censored*)';
$language['CENSORED_EDIT']='Rediger censurerede ord';
// BLOCKS
$language['BLOCKS_SETTINGS']='Block indstillinger';
$language['ENABLED']='Slået til';
$language['ORDER']='Sortering';
$language['BLOCK_NAME']='Block navn';
$language['BLOCK_POSITION']='Position';
$language['BLOCK_TITLE']='Titel (vil blive brugt til at vise den oversatte titel)';
$language['BLOCK_USE_CACHE']='Cache denne block?';
$language['ERR_BLOCK_NAME']='Du skal vælge en block i dropdown menuen!';
$language['BLOCK_ADD_NEW']='Tilføj en ny block';
// POLLS (more in lang_polls.php)
$language['POLLS_SETTINGS']='Poll indstillinger';
$language['POLLID']='Poll id';
$language['INSERT_NEW_POLL']='Tilføj ny Poll';
$language['CANT_FIND_POLL']='Kan ikke finde poll';
$language['ADD_NEW_POLL']='Tilføj Poll';
// GROUPS
$language['USER_GROUPS']='Brugergruppe indstillinger (klik på gruppens navn for at rediger)';
$language['VIEW_EDIT_DEL']='Se/Rediger/Slet';
$language['CANT_DELETE_GROUP']='Dette niveau/gruppe kan ikke slettes!';
$language['GROUP_NAME']='Gruppe navn';
$language['GROUP_VIEW_NEWS']='Se nyheder';
$language['GROUP_VIEW_FORUM']='Se forum';
$language['GROUP_EDIT_FORUM']='Rediger forum';
$language['GROUP_BASE_LEVEL']='Vælg base niveau';
$language['GROUP_ERR_BASE_SEL']='Fejl ved valgt base niveau!';
$language['GROUP_DELETE_NEWS']='Slet nyheder';
$language['GROUP_PCOLOR']='Prefix farve (som ';
$language['GROUP_SCOLOR']='Suffix farve (som ';
$language['GROUP_VIEW_TORR']='Se torrents';
$language['GROUP_EDIT_TORR']='Rediger torrents';
$language['GROUP_VIEW_USERS']='Se brugere';
$language['GROUP_DELETE_TORR']='Slet torrents';
$language['GROUP_EDIT_USERS']='Rediger brugere';
$language['GROUP_DOWNLOAD']='Kan downloade';
$language['GROUP_DELETE_USERS']='Slet brugere';
$language['GROUP_DELETE_FORUM']='Slet forum';
$language['GROUP_GO_CP']='Har adgang til Admin panel';
$language['GROUP_EDIT_NEWS']='Rediger nyheder';
$language['GROUP_ADD_NEW']='Tilføj ny gruppe';
$language['GROUP_UPLOAD']='Kan uploade';
$language['GROUP_WT']='Ventetid hvis ratio <1';
$language['GROUP_EDIT_GROUP']='Rediger gruppe';
$language['GROUP_VIEW']='Se';
$language['GROUP_EDIT']='Rediger';
$language['GROUP_DELETE']='Slet';
$language['INSERT_USER_GROUP']='Indsæt ny brugergruppe';
$language['ERR_CANT_FIND_GROUP']='Kan ikke finde denne gruppe!';
$language['GROUP_DELETED']='Gruppen er blevet slettet!';
// MASS PM
$language['USERS_FOUND']='Brugere fundet';
$language['USERS_PMED']='Brugere PMed';
$language['WHO_PM']='Hvem vil denne PM blive sendt til?';
$language['MASS_SENT']='Mass PM sendt!!!';
$language['MASS_PM']='Mass PM';
$language['MASS_PM_ERROR']='Det ville måske være en god ide at skrive noget før du tilføjer den!!!!';
$language['RATIO_ONLY']='Denne ratio kun';
$language['RATIO_GREAT']='Større end denne ratio';
$language['RATIO_LOW']='Mindre end denne ratio';
$language['RATIO_FROM']='Fra';
$language['RATIO_TO']='Til';
$language['MASSPM_INFO']='Besked';
// PRUNE USERS
$language['PRUNE_USERS_PRUNED']='Udrensede brugere';
$language['PRUNE_USERS']='Udrens brugere';
$language['PRUNE_USERS_INFO']='Indtast det antal dage brugere anses for "døde" (ikke aktive i x antal dage eller er opskrevet for x antal dage siden uden at blive godkendt)';
// SEARCH DIFF
$language['SEARCH_DIFF']='Søg Diff.';
$language['SEARCH_DIFF_MESSAGE']='Besked';
$language['DIFFERENCE']='Difference';
$language['SEARCH_DIFF_CHANGE_GROUP']='Ændre brugergrupp';
// PRUNE TORRENTS
$language['PRUNE_TORRENTS_PRUNED']='Udrensede torrents';
$language['PRUNE_TORRENTS']='Udrens torrents';
$language['PRUNE_TORRENTS_INFO']='Indtast det antal dage torrents anses for "døde"';
$language['LEECHERS']='leecher(e)';
$language['SEEDS']='seed(ers)';
// DBUTILS
$language['DBUTILS_TABLENAME']='Tabel navn';
$language['DBUTILS_RECORDS']='Records';
$language['DBUTILS_DATALENGTH']='Data størrelse';
$language['DBUTILS_OVERHEAD']='Overhead';
$language['DBUTILS_REPAIR']='Reparer';
$language['DBUTILS_OPTIMIZE']='Optimer';
$language['DBUTILS_ANALYSE']='Analyser';
$language['DBUTILS_CHECK']='Check';
$language['DBUTILS_DELETE']='Slet';
$language['DBUTILS_OPERATION']='Operation';
$language['DBUTILS_INFO']='Info';
$language['DBUTILS_STATUS']='Status';
$language['DBUTILS_TABLES']='Tabeller';
// MYSQL STATUS
$language['MYSQL_STATUS']='MySQL status';
// SITE LOG
$language['SITE_LOG']='Site log';
// FORUMS
$language['FORUM_MIN_CREATE']='Min class opret';
$language['FORUM_MIN_WRITE']='Min class skriv';
$language['FORUM_MIN_READ']='Min class læs';
$language['FORUM_SETTINGS']='Forum indstillinger';
$language['FORUM_EDIT']='Rediger forum';
$language['FORUM_ADD_NEW']='Tilføj nyt forum';
$language['FORUM_PARENT']='Forældre forum';
$language['FORUM_SORRY_PARENT']='(Beklager, kan ikke have et forældre forum, dette er et forældre forum)';
$language['FORUM_PRUNE_1']='Der er emner og posts i dette forum!<br />Du vil miste al data...<br />';
$language['FORUM_PRUNE_2']='Hvis du er sikker på at slette dette forum..';
$language['FORUM_PRUNE_3']='ellers gå tilbage.';
$language['FORUM_ERR_CANNOT_DELETE_PARENT']='Du kan ikke slette et forum der har underforum, flyt underforum og prøv igen!';
// MODULES
$language['ADD_NEW_MODULE']='Tilføj nyt modul';
$language['TYPE']='Type';
$language['DATE_CHANGED']='Dato ændret';
$language['DATE_CREATED']='Dato oprettet';
$language['ACTIVE_MODULES']='Active moduler: ';
$language['NOT_ACTIVE_MODULES']='Ikke-aktive moduler: ';
$language['TOTAL_MODULES']='Total antal moduler: ';
$language['DEACTIVATE']='Deaktiver';
$language['ACTIVATE']='Aktiver';
$language['STAFF']='Staff';
$language['MISC']='Diverse';
$language['TORRENT']='Torrent';
$language['STYLE']='Style';
$language['ID_MODULE']='ID';
// HACKS
$language['HACK_TITLE']='Titel';
$language['HACK_VERSION']='Version';
$language['HACK_AUTHOR']='Forfatter';
$language['HACK_ADDED']='Tilføjet';
$language['HACK_NONE']='Der er ingen hacks installeret';
$language['HACK_ADD_NEW']='Tilføj ny hack';
$language['HACK_SELECT']='Vælg';
$language['HACK_STATUS']='Status';
$language['HACK_INSTALL']='Installer';
$language['HACK_UNINSTALL']='Afinstaller';
$language['HACK_INSTALLED_OK']='Hack er blevet installeret!<br />'."\n".'For at se hvilke hacks der er installeret, gå tilbage til <a href="index.php?page=admin&amp;user='.$CURUSER['uid'].'&amp;code='.$CURUSER['random'].'&amp;do=hacks&amp;action=read">adminCP (Hacks)</a>';
$language['HACK_BAD_ID']='Fejl ved læsning af hack med dette ID.';
$language['HACK_UNINSTALLED_OK']='Hack er blevet afinstalleret!<br />'."\n".'For at se hvilke hacks der er installeret, gå tilbage til <a href="index.php?page=admin&amp;user='.$CURUSER['uid'].'&amp;code='.$CURUSER['random'].'&amp;do=hacks&amp;action=read">adminCP (Hacks)</a>';
$language['HACK_OPERATION']='Operation';
$language['HACK_SOLUTION']='Løsning';
// added rev 520
$language['HACK_WHY_FTP']='Nogle af de filer hacken skal rediger er ikke skriv-bare. <br />'."\n".'Dette skal ændres ved at logge ind fra FTP og chmod/oprette file(r) bibliotek(er). <br />'."\n".'Din FTP information kan blive gemt for korrekt filhåndtering af hackens installations process.';
$language['HACK_FTP_SERVER']='FTP server';
$language['HACK_FTP_PORT']='FTP port';
$language['HACK_FTP_USERNAME']='FTP brugernavn';
$language['HACK_FTP_PASSWORD']='FTP kodeord';
$language['HACK_FTP_BASEDIR']='Lokal sti for xbtit (sti fra roden når du logger ind via ftp)';
// USERS TOOLS
$language['USER_NOT_DELETE']='Du kan ikke slette gæstebruger eller dig selv!';
$language['USER_NOT_EDIT']='Du kan ikke redigerer gæstebruger eller dig selv!';
$language['USER_NOT_DELETE_HIGHER']='Du kan ikke slette brugere med højere rank end dig selv!';
$language['USER_NOT_EDIT_HIGHER']='Du kan ikke redigere brugere med højere rank end dig selv!';
$language['USER_NO_CHANGE']='Ingen ændringer blev foretaget';
//Manual Hack Install
$language['MHI_VIEW_INSRUCT'] = 'Se manuel installation?';
$language['MHI_MAN_INSRUCT_FOR'] = 'Manuel installation for';
$language['MHI_RUN_QUERY'] = 'Kør følgende SQL forespørgelse via phpMyAdmin';
$language['MHI_IN'] = 'I';
$language['MHI_ALSO_IN'] = 'Også i';
$language['MHI_FIND_THIS'] = 'Find dette';
$language['MHI_ADD_THIS'] = 'Tilføj dette';
$language['MHI_IT'] = 'Det';
$language['MHI_REPLACE'] = 'Erstat med';
$language['MHI_COPY'] = 'Kopier';
$language['MHI_AS'] = 'Som';


$language["ACP_ADD_USER"]='Tilføj ny bruger';
$language["NEW_USER_EMAIL"]='Send en email til den nye bruger med kodeord';
$language["NEW_USER_EMAIL_TEXT"]='
Hej %s,

Du er lige blevet tilføjet på %s,
Brugernavn: %s
Kodeord: %s

Håber du vil nyde dit ophold hos os!

Med venlig hilsen
%s Staff';

      

$language["IMAGE_SETTING"]="Billed indstilling";
$language["ALLOW_IMAGE_UPLOAD"]="Tillad billed upload";
$language["ALLOW_SCREEN_UPLOAD"]="Tillad screens upload";
$language["IMAGE_UPLOAD_DIR"]="Billed upload bibliotek";
$language["FILE_SIZELIMIT"]="Max billed størrelse";

//INVITATION SYSTEM
$language['ACP_INVITATION_SYSTEM']='Invitations system';
$language['ACTIVE_INVITATIONS']='Aktiver invitations system:';
$language['PRIVATE_TRACKER']='Privat tracker';
$language['PRIVATE_TRACKER_INFO']='For yderligere sikkerhed vil "Max brugere" også blive ændret til "1" når privat tracker vælges.';
$language['ACP_INVITATIONS']='Invitationer';
$language['VALID_INV_MODE']='Inviter bekræftelse er behøvet';
$language['INVITE_TIMEOUT']='Invitation slettet efter<br />( i dage )';
$language['INVITED_BY']='Inviteret af';
$language['SENT_TO']='Sendt til';
$language['DATE_SENT']='Dato sendt';
$language['INV_WELCOME']='Velkommen til Invitations systemet.<br />Aktivering af dette system vil forhindre<br />registrering på trackeren uden en invitation.';
$language['HASH']='Hash';
$language['VALID_INV_MODE']='Bekræftelse mangles';
$language['VALID_INV_EXPL']='<i>Inviter skal bekræfte den inviterede brugers konto</i>';
$language['INVITE_TIMEOUT']='Invitation slettet efter<br />( i dage )';
$language['GIVE_INVITES_TO']='Giv invitation';
$language['NUM_INVITES']='Invitationer tilbage';
$language['INVITES_SETTINGS']='Indstillinger';
$language['INVITES_LIST']='Invitations liste';
$language['SENDINV_CONFIRM']='Er du sikker på at du vil sende denne invitation?';
$language['ERR_SENDINVS']='Vælg venligst brugernavn eller bruger niveau.';
$language['SENDINV_EXPL']='Hvis brugernavn ikke indtastes, vil rank blive valgt istedet.';
$language['RECYCLE_DATE']='Slette periode';
$language['RECYCLE_EXPL']='<i>Periode i <u>dage</u> hvorefter inviationer vil blive slettet</i>';
        
$language["SETTING_MIN_DLRATIO"]="Minimum ratio for at kunne downloade torrents";
$language["SETTING_CUSTOM_SETTINGS"]="Custom indstilinger";
$language["BYPASS_DLCHECK"]="Bypass download check";

?>