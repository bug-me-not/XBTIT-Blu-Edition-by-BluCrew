<?php

global $CURUSER, $XBTT_USE;

$language['ACP_BAN_IP']='Banna IPn';
$language['ACP_FORUM']='Forum Inställningar';
$language['ACP_USER_GROUP']='Klass Inställningar';
$language['ACP_STYLES']='Tema Inställningar';
$language['ACP_LANGUAGES']='Språk inställningar';
$language['ACP_CATEGORIES']='Kategori Inställningar';
$language['ACP_TRACKER_SETTINGS']='Tracker Inställningar';
$language['ACP_OPTIMIZE_DB']='Optimera databas';
$language['ACP_CENSORED']='Censurerade Ord';
$language['ACP_DBUTILS']='Databas Tillbehör';
$language['ACP_HACKS']='Skript';
$language['ACP_HACKS_CONFIG']='Skript Inställningar';
$language['ACP_MODULES']='Moduler';
$language['ACP_MODULES_CONFIG']='Module Inställningar';
$language['ACP_MASSPM']='Mass Meddelanden';
$language['ACP_PRUNE_TORRENTS']='Prune Torrents';
$language['ACP_PRUNE_USERS']='Prune Users';
$language['ACP_SITE_LOG']='Sidans Logg';
$language['ACP_SEARCH_DIFF']='Sök Skillnad';
$language['ACP_BLOCKS']='Block Inställningar';
$language['ACP_POLLS']='Röstnings Inställningar';
$language['ACP_MENU']='Admin Meny';
$language['ACP_FRONTEND']='Innehålls ';
$language['ACP_USERS_TOOLS']='Användar verktyg';
$language['ACP_TORRENTS_TOOLS']='Torrent verktyg';
$language['ACP_OTHER_TOOLS']='Andra Verktyg';
$language['ACP_MYSQL_STATS']='MySql Statistik';
$language['XBTT_BACKEND']='xbtt Val';
$language['XBTT_USE']='Använd <a href="http://xbtt.sourceforge.net/tracker/" target="_blank">xbtt</a> som backend?';
$language['XBTT_URL']='xbtt standard url länk. http://localhost:2710';
$language['GENERAL_SETTINGS']='Standard Inställningar';
$language['TRACKER_NAME']='Sidans Namn';
$language['TRACKER_BASEURL']='Sidans adress (utan sista /)';
$language['TRACKER_ANNOUNCE']='Trackerns Annons länk (en länk per rad)'.($XBTT_USE?'<br />'."\n".'<span style="color:#FF0000; font-weight: bold;">OBS!!Kolla announce url IGEN,  xbtt backend...AKTIVERAD</span>':'');
$language['TRACKER_EMAIL']='Trackerns/Ägarens e-post';
$language['TORRENT_FOLDER']='Torrent mapp';
$language['ALLOW_EXTERNAL']='Tillåt Externa torrents';
$language['ALLOW_GZIP']='Aktivera GZIP';
$language['ALLOW_DEBUG']='Visa Debug info längst ner på sidor';
$language['ALLOW_DHT']='Inaktivera DHT (privata torrent)<br />'."\n".'Blir bara på nya uppladningar';
$language['ALLOW_LIVESTATS']='Aktivera Direkta Stats (Varning för hög serverbelastning!)';
$language['ALLOW_SITELOG']='Aktivera enkel sid logg (Ändringar på torrents/användare)';
$language['ALLOW_HISTORY']='Akivera enkel Historik (torrents/användare)';
$language['ALLOW_PRIVATE_ANNOUNCE']='Privat Announce';
$language['ALLOW_PRIVATE_SCRAPE']='Privat Scrape';
$language['SHOW_UPLOADER']='Visa Uppladdares namn';
$language['USE_POPUP']='Använd Popup för Torrent detaljer/peers';
$language['DEFAULT_LANGUAGE']='Standard Språk';
$language['DEFAULT_CHARSET']='Standard Tecken Kodning<br />'."\n".'(om ditt språk inte visas Korrekt prova UTF-8)';
$language['DEFAULT_STYLE']='Standard Tema';
$language['MAX_USERS']='Max användare (Siffror, 0 = Obegränsat)';
$language['MAX_TORRENTS_PER_PAGE']='Torrents per sida';
$language['SPECIFIC_SETTINGS']='Tracker specifika Inställningar';
$language['SETTING_INTERVAL_SANITY']='Sanity intervall (Siffror Sekunder, 0 = avstängd)<br />Bra inställning,om aktiverad, är 1800 (30 minuter)';
$language['SETTING_INTERVAL_EXTERNAL']='Upddatera Externa intervall (i sekunder, 0 = avstängd)<br />Beror på antal externa torrents';
$language['SETTING_INTERVAL_MAX_REANNOUNCE']='Max åter announce intervall (siffror sekunder)';
$language['SETTING_INTERVAL_MIN_REANNOUNCE']='Min åter announce intervall (siffror sekunder)';
$language['SETTING_MAX_PEERS']='Max N. av peers för fråga (siffror)';
$language['SETTING_DYNAMIC']='Tillåt Dynamiska Torrents (Ej Rekommenderat)';
$language['SETTING_NAT_CHECK']='NAT Kontroll';
$language['SETTING_PERSISTENT_DB']='Konstant Koppling (Databas, Rekomenderas EJ)';
$language['SETTING_OVERRIDE_IP']='Tillåt användare förbigå avkänt ip';
$language['SETTING_CALCULATE_SPEED']='Räkna Hastighet och Nerladd.. bytes';
$language['SETTING_PEER_CACHING']='Table caches (minskar belastning lite)';
$language['SETTING_SEEDS_PID']='Max antal seeds med samma PID';
$language['SETTING_LEECHERS_PID']='Max antal leechers med samma PID';
$language['SETTING_VALIDATION']='Validerings Typ';
$language['SETTING_CAPTCHA']='Säker Registrering (Använd BildKod, GD+Freetype bibliotek behövs)';
$language['SETTING_FORUM']='Forum länk kan va:<br /><li><font color="#FF0000">internal</font> eller tomt (inget) för internt forum</li><li><font color="#FF0000">smf</font> för integrerat <a target="_new" href="http://www.simplemachines.org">Simple Machines Forum</a> (1.x.x)</li><li><font color="#FF0000">smf2</font> för integrerat <a target="_new" href="http://www.simplemachines.org">Simple Machines Forum</a> (2.x)</li><li><font color="#FF0000">ipb</font> för integrerat <a target="_new" href="www.invisionpower.com">Invision Power Board</a> (3.x.x)</li><li>Egen lösning (ange url i boxen)</li>';
$language['BLOCKS_SETTING']='Block inställningar På Index Sidan';
$language['SETTING_CLOCK']='Klock typ';
$language['SETTING_FORUMBLOCK']='Forum Block Visar';
$language['SETTING_NUM_NEWS']='Antal Nyheter i Nyhets Block(siffror)';
$language['SETTING_NUM_POSTS']='Antal inlägg i Forum block (Siffro)';
$language['SETTING_NUM_LASTTORRENTS']='Antal torrents i Sneaste Torrents block (siffror)';
$language['SETTING_NUM_TOPTORRENTS']='Gräns för Populärast Torrents block (Siffror)';
$language['CLOCK_ANALOG']='Analog';
$language['CLOCK_DIGITAL']='Digital';
$language['FORUMBLOCK_POSTS']='Nyaste Inlägg';
$language['FORUMBLOCK_TOPICS']='Senast Aktiva Ämnen ';
$language['CONFIG_SAVED']='Konfigurationen Sparades Korrekt!';
$language['CACHE_SITE']='Cache intervall (Siffror i sekunder, 0 = avstängd)';
$language['ALL_FIELDS_REQUIRED']='Fyll i alla fält!';
$language['SETTING_CUT_LONG_NAME']='Begränsa långa torrent namn efter x tecken (0 = Ingen begränsning)';
$language['MAILER_SETTINGS']='Mailer';
$language['SETTING_MAIL_TYPE']='Mail Typ';
$language['SETTING_SMTP_SERVER']='SMTP Server';
$language['SETTING_SMTP_PORT']='SMTP Port';
$language['SETTING_SMTP_USERNAME']='SMTP användarnamn';
$language['SETTING_SMTP_PASSWORD']='SMTP lösenord';
$language['SETTING_SMTP_PASSWORD_REPEAT']='SMTP Lösenord (igen))';
$language['XBTT_TABLES_ERROR']='Du bör importera xbtt tables (se xbtt installations anvisningar) in i databasen innan du aktiverar xbtt backend!';
$language['XBTT_URL_ERROR']='xbtt bas url är ett MÅSTE!';
// BAN FORM
$language['BAN_NOTE']='Här kan du se och lägga till IP ban på trackern.<br />'."\n".'Måste ange en längd (första IP) till (sista IP).';
$language['BAN_NOIP']='Finns inga bannade IPn';
$language['BAN_FIRSTIP']='Första IP';
$language['BAN_LASTIP']='Sista IP';
$language['BAN_COMMENTS']='Kommentar';
$language['BAN_REMOVE']='Ta bort';
$language['BAN_BY']='Av';
$language['BAN_ADDED']='Datum';
$language['BAN_INSERT']='Ange NY bannad IP längd';
$language['BAN_IP_ERROR']='Felaktig IP adress.';
$language['BAN_NO_IP_WRITE']='Tyvärr du skrev inte en IP adress!';
$language['BAN_DELETED']='Ip längden Borttagen från databas.<br />'."\n".'<br />'."\n".'<a href="index.php?page=admin&amp;user='.$CURUSER['uid'].'&amp;code='.$CURUSER['random'].'&amp;do=banip&amp;action=read">Tillbaka till Banna IP</a>';
// LANGUAGES
$language['LANGUAGE_SETTINGS']='Språk Val';
$language['LANGUAGE']='Språk';
$language['LANGUAGE_ADD']='Lägg till språk';
$language['LANGUAGE_SAVED']='Grattis Språk modifierat';
// STYLES
$language['STYLE_SETTINGS']='Tema inställningar';
$language['STYLE_EDIT']='Ändra Tema';
$language['STYLE_ADD']='Lägg till Tema';
$language['STYLE_NAME']='Tema Namn';
$language['STYLE_URL']='Temats Sökväg';
$language['STYLE_FOLDER']='Tema Mapp ';
$language['STYLE_NOTE']='Här kan ändra lägga till Teman Men du Måste Ladda upp dom med ftp(sftp).';
// CATEGORIES
$language['CATEGORY_SETTINGS']='Kategori Inställningar';
$language['CATEGORY_IMAGE']='Kategori Bild';
$language['CATEGORY_ADD']='Lägg Till Kategori';
$language['CATEGORY_SORT_INDEX']='Sortering';
$language['CATEGORY_FULL']='Kategori';
$language['CATEGORY_EDIT']='Ändra Kategori';
$language['CATEGORY_SUB']='Under-Kategori';
$language['CATEGORY_NAME']='Namn ex.(DVD)';
// CENSORED
$language['CENSORED_NOTE']='Skriv <b>ett ord per rad</b> för censur (visas som *censored*)';
$language['CENSORED_EDIT']='Ändra Censurerade Ord';
// BLOCKS
$language['BLOCKS_SETTINGS']='Block Inställningar';
$language['ENABLED']='Aktiv';
$language['ORDER']='Sortering';
$language['BLOCK_NAME']='Blockens namn';
$language['BLOCK_POSITION']='Position';
$language['BLOCK_TITLE']='Språk titel (används för att visa översatt titel)';
$language['BLOCK_USE_CACHE']='Cache detta block?';
$language['ERR_BLOCK_NAME']='You must select one of the enabled file in the name&rsquo;s dropdown!';
$language['BLOCK_ADD_NEW']='Lägg Till Nytt Block';
// POLLS (more in lang_polls.php)
$language['POLLS_SETTINGS']='Röstings Val';
$language['POLLID']='Omröstnings id';
$language['INSERT_NEW_POLL']=' Lägg Till Omröstning';
$language['CANT_FIND_POLL']='Hittar inte Omröstning';
$language['ADD_NEW_POLL']='Starta omröstning';
// GROUPS
$language['USER_GROUPS']='Klass Inställningar (Klicka på klass för ändringar)';
$language['VIEW_EDIT_DEL']='Se/Ändra/Ta bort';
$language['CANT_DELETE_GROUP']='Kan inte Ta Bort Klassen!';
$language['GROUP_NAME']='Klass Namn';
$language['GROUP_VIEW_NEWS']='Se Nyheter';
$language['GROUP_VIEW_FORUM']='Se Forum';
$language['GROUP_EDIT_FORUM']='Redigera Forum';
$language['GROUP_BASE_LEVEL']='Välj Grund Klass';
$language['GROUP_ERR_BASE_SEL']='Fel i Grund Klass Val!';
$language['GROUP_DELETE_NEWS']='Ta bort Nyhet';
$language['GROUP_PCOLOR']='Prefix Färg (som ';
$language['GROUP_SCOLOR']='Suffix Färg (som ';
$language['GROUP_VIEW_TORR']='Se Torrents';
$language['GROUP_EDIT_TORR']='Ändra Torrents';
$language['GROUP_VIEW_USERS']='Se Användare';
$language['GROUP_DELETE_TORR']='Ta bort Torrents';
$language['GROUP_EDIT_USERS']='Ändra Medlem';
$language['GROUP_DOWNLOAD']='Kan Ladda ner';
$language['GROUP_DELETE_USERS']='Ta bort Medlemm';
$language['GROUP_DELETE_FORUM']='Ta bort i Forum';
$language['GROUP_GO_CP']='Tillgång till AdminPanel';
$language['GROUP_EDIT_NEWS']='Ändra i Nyhet';
$language['GROUP_ADD_NEW']='Lägg Till Klass';
$language['GROUP_UPLOAD']='Kan Ladda Upp';
$language['GROUP_WT']='Väntetid om Ratio <1';
$language['GROUP_EDIT_GROUP']='Ändra Klass';
$language['GROUP_VIEW']='Se';
$language['GROUP_EDIT']='Ändra';
$language['GROUP_DELETE']='Ta Bort';
$language['INSERT_USER_GROUP']='Lägg Till Ny Klass';
$language['ERR_CANT_FIND_GROUP']='Hittar Inte Klass!';
$language['GROUP_DELETED']='Klass Borttagen!';
// MASS PM
$language['USERS_FOUND']='användare hittade';
$language['USERS_PMED']='användare meddelade';
$language['WHO_PM']='Vem Skickas det till?';
$language['MASS_SENT']='Mass PM skickat!!!';
$language['MASS_PM']='Mass PM';
$language['MASS_PM_ERROR']='Kanske ska skriva nått inann du skickar!!!!';
$language['RATIO_ONLY']='Denna ratio bara';
$language['RATIO_GREAT']='Mer än kvoten';
$language['RATIO_LOW']='Lägre än Kvoten';
$language['RATIO_FROM']='Från';
$language['RATIO_TO']='Till Kvoten';
$language['MASSPM_INFO']='Info';
// PRUNE USERS
$language['PRUNE_USERS_PRUNED']='Pruned users';
$language['PRUNE_USERS']='Prune users';
$language['PRUNE_USERS_INFO']='Skriv in hur många dagar innan en användare anses som "död" (inte loggat in på x dagar ELLER Registrerat sig efter inbjudan)';
// SEARCH DIFF
$language['SEARCH_DIFF']='Sök Skillnad';
$language['SEARCH_DIFF_MESSAGE']='Meddelande';
$language['DIFFERENCE']='Skillnad';
$language['SEARCH_DIFF_CHANGE_GROUP']='Byt Klass';
// PRUNE TORRENTS
$language['PRUNE_TORRENTS_PRUNED']='"DöDA" torrents';
$language['PRUNE_TORRENTS']='Ta bort döda torrents';
$language['PRUNE_TORRENTS_INFO']='Skriv in när torrents ska anses som "döda"(1-X)';
$language['LEECHERS']='leecher(s)';
$language['SEEDS']='seed(are)';
// DBUTILS
$language['DBUTILS_TABLENAME']='Tabel Namn';
$language['DBUTILS_RECORDS']='Records';
$language['DBUTILS_DATALENGTH']='Data Längd';
$language['DBUTILS_OVERHEAD']='Overhead';
$language['DBUTILS_REPAIR']='Laga';
$language['DBUTILS_OPTIMIZE']='Optimera';
$language['DBUTILS_ANALYSE']='Analysera';
$language['DBUTILS_CHECK']='Kolla';
$language['DBUTILS_DELETE']='Ta Bort';
$language['DBUTILS_OPERATION']='Operation';
$language['DBUTILS_INFO']='Info';
$language['DBUTILS_STATUS']='Status';
$language['DBUTILS_TABLES']='Tabeller';
// MYSQL STATUS
$language['MYSQL_STATUS']='MySQL Status';
// SITE LOG
$language['SITE_LOG']='Sid Logg';
// FORUMS
$language['FORUM_MIN_CREATE']='Min Klass Skapa';
$language['FORUM_MIN_WRITE']='Min Klass Skriva';
$language['FORUM_MIN_READ']='Min Klass Se';
$language['FORUM_SETTINGS']='Forum Inställningar';
$language['FORUM_EDIT']='Ändra i Forum';
$language['FORUM_ADD_NEW']='Skapa i Forum';
$language['FORUM_PARENT']='Ägare i Forum';
$language['FORUM_SORRY_PARENT']='(Sorry, I can&rsquo;t have parent, because I&rsquo;m myself a parent forum)';
$language['FORUM_PRUNE_1']='Det finns ämnen och inlägg här!<br />Du kommer bli av med all data...<br />';
$language['FORUM_PRUNE_2']='Om du är säker på att ta bort allt';
$language['FORUM_PRUNE_3']='annars tillbaka.';
$language['FORUM_ERR_CANNOT_DELETE_PARENT']='Du kan inte ta bort Forum som har under Kategorier Flytta Dom Först';
// MODULES
$language['ADD_NEW_MODULE']='Lägg Till Ny Modul';
$language['TYPE']='Typ';
$language['DATE_CHANGED']='Datum Ändrad';
$language['DATE_CREATED']='Datum Skapad';
$language['ACTIVE_MODULES']='Aktiva Moduler: ';
$language['NOT_ACTIVE_MODULES']='Ej aktiva Modulesr: ';
$language['TOTAL_MODULES']='Antal Moduler: ';
$language['DEACTIVATE']='Stäng av';
$language['ACTIVATE']='Starta';
$language['STAFF']='Staff';
$language['MISC']='Diverse';
$language['TORRENT']='Torrent';
$language['STYLE']='Tema';
$language['ID_MODULE']='ID';
// HACKS
$language['HACK_TITLE']='Namn';
$language['HACK_VERSION']='Version';
$language['HACK_AUTHOR']='Skapare';
$language['HACK_ADDED']='Inlaggd';
$language['HACK_NONE']='Inga Skript installerade';
$language['HACK_ADD_NEW']='Lägg Till Nytt Skript';
$language['HACK_SELECT']='Välj';
$language['HACK_STATUS']='Status';
$language['HACK_INSTALL']='Installera';
$language['HACK_UNINSTALL']='Ta Bort';
$language['HACK_INSTALLED_OK']='Installering av Skript Lyckades!<br />'."\n".'För att se alla skript installerade gå tillbaka till <a href="index.php?page=admin&amp;user='.$CURUSER['uid'].'&amp;code='.$CURUSER['random'].'&amp;do=hacks&amp;action=read">adminKP (Skript)</a>';
$language['HACK_BAD_ID']='Fel hittar ingen info med detta Skript ID.';
$language['HACK_UNINSTALLED_OK']='Skript avinstallerat!<br />'."\n".'För att se alla installerade skript gå tillbaka till <a href="index.php?page=admin&amp;user='.$CURUSER['uid'].'&amp;code='.$CURUSER['random'].'&amp;do=hacks&amp;action=read">adminKP (Skript)</a>';
$language['HACK_OPERATION']='Operation';
$language['HACK_SOLUTION']='Lösning';
// added rev 520
$language['HACK_WHY_FTP']='Några av filerna som Skriptet måste ändra är inte skrivbara. <br />'."\n".'Ändra rättigheter elr skapa nya mappar filer för detta. <br />'."\n".'Din ftp information kan vara tillfälligt låst pga Skript installationen.';
$language['HACK_FTP_SERVER']='FTP Server';
$language['HACK_FTP_PORT']='FTP Port';
$language['HACK_FTP_USERNAME']='FTP Användarnamn';
$language['HACK_FTP_PASSWORD']='FTP Lösenord';
$language['HACK_FTP_BASEDIR']='Lokal sökväg till xbtit (hela sökvägen från root via FTP)';
// USERS TOOLS
$language['USER_NOT_DELETE']='Du kan inte ta bort Guest eller dig själv!';
$language['USER_NOT_EDIT']='Kan inte ändra Guest eller Dig själv!';
$language['USER_NOT_DELETE_HIGHER']='Kan inte bort användare med högre klass än din egen.';
$language['USER_NOT_EDIT_HIGHER']='Kan inte ändra användare med högre klass än din egen..';
$language['USER_NO_CHANGE']='Inga ändringar gjordes.';


//INVITATION SYSTEM
$language['ACP_INVITATION_SYSTEM']='Inbjudnings System';
$language['ACTIVE_INVITATIONS']='Aktivera Inbjudnings System:';
$language['PRIVATE_TRACKER']='Privat Tracker';
$language['PRIVATE_TRACKER_INFO']='För ökad säkerhet när det sätts till "Privat",<br />Ändras Max användare till "1".';
$language['ACP_INVITATIONS']='Inbjudningar';
$language['VALID_INV_MODE']='Måste Bekräftas Av Inbjudare';
$language['INVITE_TIMEOUT']='Inbjudning aktiv i<br />( dagar )';
$language['INVITED_BY']='Inbjuden av';
$language['SENT_TO']='Skickat till';
$language['DATE_SENT']='Datum Skickad';
$language['INV_WELCOME']='Välkommen till inbjudnings panelen.<br />Aktivering hindrar användare att<br />registrera sig utan inbjudnings kod.';
$language['HASH']='Hash';
$language['VALID_INV_MODE']='Bekrftelse krävs';
$language['VALID_INV_EXPL']='<i>Inbjudare måste bekräfta kontot</i>';
$language['INVITE_TIMEOUT']='inbjudning aktiv i<br />( dagar )';
$language['GIVE_INVITES_TO']='Ge Inbjudningar';
$language['NUM_INVITES']='Antal Inbjudningar';
$language['INVITES_SETTINGS']='Inställningar';
$language['INVITES_LIST']='Inbjudnings Lista';
$language['SENDINV_CONFIRM']='Säkert att du vill skicka Inbjudningar?';
$language['ERR_SENDINVS']='Välj Namn eller Klass.';
$language['SENDINV_EXPL']='Saknas Namn används Klass istället.';
$language['RECYCLE_DATE']='Aktiv x dagar';
$language['RECYCLE_EXPL']='<i>Period in <u>days</u> after which invitations will be recycled</i>';
$language["ACP_FM_HACK_CONFIG"]='FM Skripts Konfig';
$language["ACP_NO_HACKS_ENABLED"]='Inga aktiva Skript';
$language['HACK_INFO']='Starta stäng av Skript här.<br /><br /><b>Går inte stänga av Skript Som krävs av andra stäng av dom först.</b> Sätt musen över <img src="images/info.png"> bilden för att se beroende Skript.';
global $BASEURL;
$language['HACK_INFO_2']='<b>Vänligen notera Skripten kan ha gjorts av flera Vänligen <a target="_blank" href="'.$BASEURL.'/FM-Hacks.txt">Klicka här</a> För mer Information.</b>';
$language['HACK_ENABLED']='PÅ';
$language['HACK_DISABLED']='AV';
$language['SUBMIT'] = 'Skicka';
$language['PRE_OF'] = 'Beroende av';

// Seed bonus -->
$language["ACP_SEEDBONUS"]="SeedBonus Inställningar";
$language["BONUS"]="Poäng per seed timme";
$language["PRICE_VIP"]="Pris för VIP";
$language["PRICE_CT"]="Pris för CustomTitle";
$language["PRICE_NAME"]="Pris för Namn byte";
$language["PRICE_GB"]="Pris för GB";
$language["POINTS"]="Poäng";
$language["SEEDBONUS_UPDATED"]="SeedBonus inställnigar ändrat";
$language["ENABLE"] = "Aktivera";
$language["AWARD_FOR"] = "Poäng för";
$language["ALL_TORR"] = "Alla torrents seedade";
$language["ONE_TORR"] = "En seedad torrent Bara";
$language["BON_FOR_UPLOAD"] = "Poäng för uppladdning av torrent";
$language["PRICE_FOR_INVITES"] = "Pris för Inbjudningar";
$language["SB_INVITE"] = "Bjud in";
$language["SB_INVITES"] = "inbjudningar";
$language["SB_DELAY"] = "fördröjning utbetalning (timmar)";
$language["BON_FOR_COMMENT"] = "Poäng för torrent Kommentar";
$language["BON_FOR_FORUM_POST"] = "Poäng för forum inlägg";
$language["SB_PNT_4_UPL"] = "Poäng för verklig uplladdning av data";
$language["SB_MIN_UL_RATE"] = "Lägsta hastighet i KB/s";
$language["SB_MAX_PER_HOUR"] = "Max poäng per timme";
$language["SB_PNTS_4_SHOUT"] = "Poäng per inlägg i Skrik Låda";
$language["SB_PNTS_4_RADIO"] = "Poäng per timmes lyssnande radion";
$language["SB_ALLOW_GIFT"] = "Tillåt skänka varandra poäng";
$language["SB_GIFTMAX"] = "Max poäng som kan ges bort";
// <-- Seed Bonus

// Donation History by DiemThuy -->
$language['ACP_DON_HIST']='Donation Historik';
$language['ACP_DON_HIST_SET']='Inställningar Donations Historia';
$language['ACP_UNITS'] = 'Enheter';
$language['ACP_USE_AUTO_PM'] = 'Använd Auto PM';
$language['ACP_THANK_PM_TEXT'] = 'PM Tack text';
$language['ACP_DONATION'] = 'Donation';
$language['ACP_AMOUNT'] = 'Summa';
$language['ACP_USERNAME'] = 'Namn';
$language['ACP_EDIT_DON'] = 'Ändra Donationer';
$language['ACP_NONE_YET'] = 'ingen än';
$language['ACP_SHORT_DON'] = 'Don';
// <-- Donation History by DiemThuy


// Advanced Auto Donation System by DiemThuy -->
$language['ACP_DONATE']='VIP&Donations Inställningar';
$language['AADS_NOTHING'] = 'inget';
$language['AADS_HERE'] = 'här';
$language['AADS_YET'] = 'än';
$language['AADS_YES'] = 'ja';
$language['AADS_NO_TIMED_RANK'] = 'ingen tids klass';
$language['AADS_NO_OLD_RANK'] = 'ingen gammal Klass';
$language['AADS_NO_UPLOAD'] = 'inget uppladdat';
$language['AADS_NO'] = 'nej';
$language['AADS_DEM_PRO'] = 'nergraderings skydd';
$language['AADS_PP_INFO'] = 'Paypal Inställningar : Måste ha PayPal Premier Konto och IPN eller PDT Aktiverat I Din PayPal Profil !!';
$language['AADS_AP_INFO'] = 'Payza Inställningar : Måste Payza Personal Pro konto och IPN aktiverat i din Payza Profil !!';
$language['AADS_OO_INFO'] = 'Inställningar';
$language['AADS_USEPP'] = 'Använd PayPal';
$language['AADS_USEAP'] = 'Använd Payza';
$language['AADS_SYS'] = 'System';
$language['AADS_TEST'] = 'Test Läge';
$language['AADS_AP_MAIL'] = 'Payza E-post';
$language['AADS_AP_SEC'] = 'Säkerhets Kod';
$language['AADS_MODE'] = 'Testläge eller Riktigt';
$language['AADS_UNITS'] = 'Enheter';
$language['AADS_VIP_TRACKER'] = 'VIP Klass ID';
$language['AADS_VIP_SMF'] = 'VIP Klass ID (SMF/IPB)';
$language['AADS_PP_SAND_MAIL'] = 'Test E-post';
$language['AADS_PP_MAIL'] = 'PayPal E-post';
$language['AADS_VIP_DAYS'] = '1 Euro/Dollar = .. Vip Dagar';
$language['AADS_GB_AMT'] = '1 Euro/Dollar = .. GB';
$language['AADS_NEEDED'] = 'Behövs';
$language['AADS_RECEIVED'] = 'Mottaget';
$language['AADS_NUM_NO_POINTS'] = '(siffror) Inga poäng';
$language['AADS_DUE_DATE'] = 'Utgår datum';
$language['AADS_DUE_DATE_VALUE'] = 'DD/MM/YY';
$language['AADS_NUM_DON'] = 'Antal Donationer I Block';
$language['AADS_SC_BL_TEXT'] = 'Rullande Block Text';
$language['AADS_EN_SC_LINE'] = 'Aktivera Rullande Rad';
$language['AADS_DON_HIST_BR'] = 'Donations Historik Brygga';
$language['AADS_SIM_DON_DISP_BR'] = 'Enkel Donator Display Brygga';
$language['AADS_VIP'] = 'VIP';
$language['AADS_LNAME'] = 'Efternamn';
$language['AADS_DDATE'] = 'Donations Datum';
$language['AADS_VIP_BET'] = 'VIP mellan';
$language['AADS_VIP_DAYS'] = 'VIP dagar per enhet';
$language['AADS_GB_BET'] = 'GB mellan';
$language['AADS_GB_PER_UNIT'] = 'GB per enhet';
$language['AADS_AND_UP'] = 'och uppåt är';
$language['AADS_UNITS_IS'] = 'enhet är';
$language["AADS_POSS_DON_WRONG"] = "Summor fel använd siffror, skriv siffror dela av med kommatecken";
$language["AADS_IPN_OR_PDT"] = "IPN or Payment Data Transfer";
$language["AADS_ID_TOK"] = "PDT Identity Token";
$language["AADS_PAY_ONLY"] = "PayPal Endast";
$language["AADS_ALE_ONLY"] = "Payza Endast";
$language["AADS_ALE_AND_PAY"] = "Payza & PayPal";
// <-- Advanced Auto Donation System by DiemThuy

//GOLD
$language["ACP_GOLD"]="Guld torrent Val";
$language["GOLD_CHOOSE_PIC"] = "Välj ny bild (max size 100px x 100px)";
$language["GOLD_NO_FILE"] = "Fil ej uppladdad!";
$language["GOLD_TOO_BIG"] = "Bild Storlek begränsad 100px X 100px!";
$language["GOLD_NOT_UPPED"] = "Fil ej uppladdad!";
$language["GOLD_TOO_SMALL"] = "Bilden är för liten!";
$language["GOLD_ONLY_BASE"] = "(Klass som är baserad på standard klassen får samma rättigheter)";


$language['ACP_FREECTRL']='Fri Leech Kontroll';
$language['FL_INFO'] = 'Fri Leech, om på för alla torrents (även nya uppladningar) är Fri Leech, Ingen nerladdning räknas. (Bara  uppladdat)';
$language['FL_DTE'] = 'Upphör Datum';
$language['FL_DATE_FORMAT'] = '[0000-00-00][Y/M/D] måste va i detta format';
$language['FL_TTE'] = ' Avslutas';
$language['FL_HOUR_FORMAT'] = '[00] ange i hela timmar';
$language['FL_ENABLE'] = 'Starta';
$language['FL_HAPPY_HOUR'] = 'Happy Hour, är aktiv Fri Leech 1 timme per dag olika tider';
$language['FL_EN_HAPPY_HOUR'] = 'Starta Happy Hour';


$language["IMAGE_SETTING"]="Bild Inställningar";
$language["ALLOW_IMAGE_UPLOAD"]="Tillåt bild Uppladdning";
$language["ALLOW_SCREEN_UPLOAD"]="Tillåt screens Uppladdning";
$language["IMAGE_UPLOAD_DIR"]="Bild mapp";
$language["FILE_SIZELIMIT"]="Gräns Bild Storlek";


$language["ACP_HITRUN"]="H&R Inställningar";
$language["HNR_BLOCK_SETTINGS"] = "H&R Block  Val";
$language["HNR_SCROLLING_TEXT"] = "Rullande Text";
$language["HNR_COUNT"] = "Antal Hit&Runners att visa";
$language["HNR_ERR_1"] = "Kan inte ha 2 regler för samma Klass!";
$language["HNR_ACTIVE"] = "Aktiv";
$language["HNR_SEEDTIME"] = "Seed Tid";
$language["HNR_BANUSER"] = "Banna Användare";
$language["HNR_ID_LEVEL"] = "id_level på gruppen som du vill  använda regeln på:";
$language["HNR_DOWN_TRIG"] = "Utlösare för aktivering av systemet i nerladdade (MB) när aktivering sker :";
$language["HNR_RATIO_TRIG"] = "Min ratio  för straff/belöning:";
$language["HNR_MIN_SEED"] = "Min seed tid (tim) för att undvika straff:";
$language["HNR_TOLERANCE"] = "Tolerans i dagar (antal dagar man har på sig att upfylla krav):";
$language["HNR_UL_PUNISH"] = "Hur många (MB) man ska ta från användare för Hit & Run:";
$language["HNR_REW_SYS"] = "Belönings system - ge tillbaka om man uppfyller kraven efter (straff) :";
$language["HNR_WARN_BRIDGE"] = "Använd Varnings Skriptet så andra kan see Hit & Runners:";
$language["HNR_DAYS"] = "dagar";
$language["HNR_FOR"] = "för";
$language["HNR_AFTER"] = "efter";
$language["HNR_WARNINGS"] = "varningar";
$language["HNR_BOOT_BRIDGE"] = "Använd ban Skriptet för att kicka Hit & Runners:";
$language["HNR_BOOT_USER"] = "om aktivt använs kick script för att kicka:";
$language["HNR_NEW_GROUP"] = "Lägg till ny Klass";
$language["HNR_ID_LEVEL"] = "ID Level";
$language["HNR_USERGROUP"] = "Klass";
$language["HNR_MIN_DOWN"] = "Min Nerladdat";
$language["HNR_MIN_RAT"] = "Min Ratio";
$language["HNR_MIN_ST"] = "Min Seed Tid";
$language["HNR_TOL_DAYS"] = "Tolerans Dagar";
$language["HNR_UL_PUN"] = "Uppladat Som tas bort";
$language["HNR_REW"] = "Belöning";
$language["HNR_WS"] = "Varnings Symbol";
$language["HNR_FD"] = "I Dagar";
$language["HNR_WIB"] = "Varning är Kick";
$language["HNR_WT"] = "Antal Varningar";
$language["HNR_BU"] = "Kicka Användare";

$language["ACP_AUTORANK"] = "Auto rank Panel";
$language["AUTORANK_INVALID"] = "Felaktig data, använd ett nummer mellan 1 och 23";
$language["AUTORANK_MAIN_1"] = "För att inte överbelasta servern Skannas bara anslutna regelmässigt. Hela databsen Skannas 1 gång per dygn du bör sätta tiden för detta under.<br /><br /><b>Noter:</b>Tiden bör vara när så många som möjligt är anslutna fortfarande men under tid då belastning är låg .<br /><br />Korrekta värden är 0-23 (0 = midnatt, 1 = 1:00am, 5=5:00am, 14=2:00pm etc.)";
$language["AUTORANK_MAIN_2"] = "Tid För Skanning";
$language["AUTORANK_MAIN_3"] = "Alla Andra värden ställs in";
$language["AUTORANK_MAIN_4"] = "här";
$language["AUTORANK_SEND_PM"] = "Skicka PM till användare om ändring?";


$language["ACP_BOOTED"]="Kickade Användare";
$language["ACP_BOOTED_NM"]="Användar Namn";
$language["ACP_BOOTED_EXP"]="Tid upphör";
$language["ACP_BOOTED_REA"]="Ban Orsak";
$language["ACP_BOOTED_WHO"]="Ban Gjord av";

// --------> modpanel
$language['ACP_MODPANEL']='Staff Panel';
$language['MODCP_SECTION']='Sektion (de man vill tillåta för mod/admin, det är do=xxxx delen i länken):';
$language['MODCP_DESC']='Beskrivning (använder man språk definition, så används  språk strängen annars visas de du skrev in. eg: du skrev "ACP_BAN_IP" Kommer visa "'.$language['ACP_BAN_IP'].'" ):';
$language['MODCP_URL']='URL (url till källan, {uid} byts till användarens id och {ucode} eg: länk för banna iå är http://localhost/xbtit/index.php?page=admin&user={uid}&code={ucode}&do=category&action=read):';
$language['MODCP_NEWSECTION']='Lägg till ny sektion';
$language['NO_SECTION_ACCESS']='Du har inte tillträde hit.';
// --------> modpanel



//RULES
$language["ACP_RULES_GROUP"]="Regelgrupper";
$language["ACP_RULES"]="Regler";



$language["ACP_STICKY_TORRENTS"]="Klistrade torrents";
$language["STICKY_SETTINGS"]="Klistrade Inställningar";
$language["COLOR"]="Färg";
$language["LEVEL_STICKY"]="Vem kan sätta klistrad Torrent? (Standard: Uppladare)";


// Torrent Request
$language["TRAV_REQ_SET"] = "Önsknings Panel";
$language["TRAV_REQ_HO"] = "Önskningar Aktiverat";
$language["TRAV_REQ_IB"] = "Önskningar i block";
$language["TRAV_DUFRAP"] = "Dagar Önskning Är kvar efter Fylld";
$language["TRAV_REQ_PP"] = "Önskningar per Sida";
$language["TRAV_MILTPR"] = "min Klass För Att Önska";
$language["TRAV_ARIS"] = "Annonsera Önskning i Skrik Lådan";
$language["TRAV_MRU"] = "Använd max antal";
$language["TRAV_MNOR"] = "Max antal önsknigar per Användare";
$language["TRAV_RRFFAR"] = "Belöning för fylld Önskan Panel";
$language["TRAV_RRS"] = "Belönings Panel";
$language["TRAV_RIUOS"] = "Belöning uppladdat eller Poäng";
$language["TRAV_AIB"] = "Värde bytes";
$language["TRAV_SBP"] = "Seedbonus poäng";
$language["TRAV_ADD_REQ"] = "Önska";
// Torrent Request

$language['XTD_ACP']='XTD Panel';

$language["ACP_LOTTERY"]="Lotteri";
$language["LOTT_SETTINGS"]="Lotteri Panel";
$language["EXPIRE_DATE"]="Slut Datum";
$language["EXPIRE_TIME"]="Slut Tid";
$language["EXPIRE_DATE_VIEW"]="(0000-00-00 i detta format)";
$language["EXPIRE_TIME_VIEW"]="i hela timmar";
$language["IS_SET"]="datum och tid nu)";
$language["NUM_WINNERS"]="Antal vinnare";
$language["TICKET_COST"]=" Lott Pris ";
$language["MIN_WIN"]="Minsta du kan vinna";
$language["LOTTERY_STATUS"]="Lotteri Startat";
$language["VIEW_SELLED"]="Se sålda Lotter";
$language["ACP_SELLED_TICKETS"]="Sålda Lotter";
$language["NO_TICKET_SOLD"]="Inga Lotter Sålda";
$language["TICKETS"]="Lotter";
$language["PURCHASE"]="Köp";
$language["SOLD_TICKETS"]="Sålda Lottoer";
$language["LOTTERY"]="Lotteri";
$language["MAX_BUY"]="Max en användare Kan Köpa";
$language["LOTT_ID"] = "Id";
$language["LOTT_USERNAME"] = "Användar Namn";
$language["LOTT_NUMBER_OF_TICKETS"] = "Antal Lotter";
$language["BACK_TO_LOTTERY"]="Tillbaka Till Lotteri";
$language["LOTT_SENDER_ID"]="Sänd ID för PM";
$language["ADMIN_SB_BANNED"] = "Shoutbox bannad";

$language['tmsg1']="Ticker Meddelande 1";
$language['tmsg2']="Ticker Meddelande 2";
$language['tmsg3']="Ticker Meddelande 3";
$language['tmsg4']="Ticker Meddelande 4";

// Site Offline
$language["ACP_OFFLINE"]="Sida Stängd Panel";
$language["OFFLINE_SETTING"]="Sida avstängd?";
$language["OFFLINE_MESSAGE"]="Meddelande till användare (max 200 tecken, bara admins har tillgång till sidan)";

// Download Ratio Check
$language["SETTING_MIN_DLRATIO"]="Min ratio för att ladda Ner";
$language["SETTING_CUSTOM_SETTINGS"]="Ratio Kontroll Panel";
$language["BYPASS_DLCHECK"]="Gå förbi Kontroll";

// Radio
$language["RAD_SETTINGS"]="Radio Panel";
$language['djhead']="Dj Lista";

// Message Spy
$language["ACP_ISPY"]="PM Spion";
$language["DATE_SENT"]="Datum Skickat";
$language["MESSAGE"]="Meddelande";

// Sport Betting - Start
$language["SB_SETTINGS"] = "Betting Panel";
$language["SB_MIN_IDL_2_BET"] = "Min id_rang för Bett";
$language["SB_FOR_ID"] = "Forum nummer att posta i";
$language["SB_FOR_USER_ID"] = "Forum användar ID att posta med";
$language["SB_MAX_BON"] = "Max Bonus Poäng";
// Sport Betting - End

// NEW USER DONATE UPLOAD
$language["SETTINGS_UPLOAD"]="Registrerings Bonus för nya medlemar.";
$language["VALUE_UPLOAD"]="Skriv värde ange enhet.";
$language["KB"]="Kb";
$language["MB"]="Mb";
$language["GB"]="Gb";
$language["TB"]="Tb";

// Add new Users in AdminCP
$language["ACP_ADD_USER"]='Lägg till användare';
$language["NEW_USER_EMAIL"]='Skick e-post med lösenord till användare';
$language["NEW_USER_EMAIL_TEXT"]='
Hej %s,

Du har fått ett konto på %s,
användarnam: %s
lösenord: %s
sidans url: %s

Hoppas du kommer trivas hos oss
Med vänliga hälsninga
Staff';

// Torrents Limit
$language["MAX_TORRENTS"] = "Max Torrents";

// Client ban
$language['BAN_CLIENT']='Banna Torrent Klient';
$language['REMOVE_CLIENTBAN']='Ta bort Torrent Klient Ban';
$language['CLIENT_REMOVED']='Klienten borttagen från bann lista.<br /><br />';
$language['RETURN']='Åter';
$language['UNBAN_MAIN']='Genom att besöka denna sida vill du ta bort bann på denna Klient:';
$language['CONFIRM_ACTION']='Säker på att du vill ? (blir inte någon fler kontroll).';
$language['CLIENT_ALREADY_BANNED']='Denna Klient är redan bannad!';
$language['ALL_VERSIONS']='Alla versioner';
$language['CLIENT_ADDED']='Denna klient tillagd i bann lista<br /><br />';
$language['NEED_A_REASON']='Orsak Krävs!';
$language['BAN_MAIN']='Genom att besöka denna sida vill du banna denna klient:';
$language['BAN_ALL_VERSIONS']='Bana alla versioner?';
$language['REASON']='Orsak';

// Ban Button
$language["ACP_BB"]="Bann Knapp - IP Längd";
$language["ACP_BB_USER"]="Bann Knapp - Medlemm";
$language["BB_SETTINGS"] = "Bann Knapp Panel";
$language["BB_LEVEL"] = "Min Ban Level";
$language["BB_DAYS"] = "Ban Dagar";
$language["BB_NONE_YET_1"] = "Finns";
$language["BB_NONE_YET_2"] = "inga";
$language["BB_NONE_YET_3"] = "bannade";
$language["BB_NONE_YET_4"] = "IPn";
$language["BB_NONE_YET_5"] = "här";
$language["BB_NONE_YET_6"] = "än";
$language["BB_NONE_YET_7"] = "i alla fall";
$language["BB_USERS"] = "Användare";
$language["BB_NOT_ANYMORE"] = "Tyvärr Inte längre";
$language["BB_TEXT_1"] = "Användare i denna lista är bannade av bann knappen, temporär IP längd ban för";
$language["BB_TEXT_2"] = "dagar, temporär för att undvika att andra drabbas, användaren ger troligen upp att försöka efter nån dag.";
$language["BB_TEXT_3"] = "Användare här är bannade av Bann Knappen, hävs först när bann tas bort, även bannade från announce.";
$language["BB_FIRST_IP"] = "Första IP";
$language["BB_LAST_IP"] = "Sista IP";
$language["BB_BAN_ADDED"] = "Ban Tillagd";
$language["BB_BAN_EXPIRE"] = "Ban Utgår";
$language["BB_ADDED_BY"] = "Gjord av";
$language["BB_USER_COMM"] = "Användare å kommentar";
$language["BB_DEL"] = "Ta bort";
$language["BB_COMM"] = "Kommentar";
$language["BB_IP_BANNED"] = "IP Längd Bannad";

// Ratio Editor
$language["ACP_RATIO_EDITOR"] = "Ratio Ändring";
$language["RATIO_USERNAME"] = "Namn";
$language["RATIO_UPLOADED"] = "Uppladdat";
$language["RATIO_DOWNLOADED"] = "Nerladdat";
$language["RATIO_INPUT_MEASURE"] = "Välj enhet:";
$language["RATIO_BYTES"] = "Bytes";
$language["RATIO_K_BYTES"] = "KBytes";
$language["RATIO_M_BYTES"] = "MBytes";
$language["RATIO_G_BYTES"] = "GBytes";
$language["RATIO_T_BYTES"] = "TBytes";
$language["RATIO_ACTION"] = "Action:";
$language["RATIO_ADD"] = "Lägg Till";
$language["RATIO_REMOVE"] = "Ta bort";
$language["RATIO_REPLACE"] = "Byt Ut";
$language["RATIO_HEADER"] = "Uppdatera användares ratio";
$language["RATIO_SUCCES"] = "Lyckades";
$language["RATIO_UPDATE_SUCCES"] = "Uppdatering av användarens ratio Lyckades";

// Duplicate Accounts
$language["DUPLICATES"]="2 Konton";
$language["ERR_USERS_NOT_FOUND"]="Ingen Hittades!";

// Report High Upload Speed
$language["RHUS_HIGH_UL_SUP"] = "Hög UL Hastighets Rapport Panel";
$language["RHUS_EN_SYS"] = "Aktivera System";
$language["RHUS_DIS"] = "avstängd";
$language["RHUS_REP_FROM"] = "Rapport från hastighet i (KB/s)";
$language["RHUS_REP_TU"] = "Anmäld gånger / Användare";
$language["RHUS_ONLY_ONCE"] = "bara engång";
$language["RHUS_NO_LIM"] = "ingen gräns";

// Twitter Update
$language["TWIT_REG"] = "Tillåt Twitter Inlägg";
$language["TWIT_AUTH_1"] = "För att godkänna sidan att använda Tweets till ditt Twitter Konto bör du";
$language["TWIT_AUTH_2"] = "Klicka här";
$language["TWIT_AUTH_3"] = "logga in på ditt Twitter konto. Kommer då se nått liknande";
$language["TWIT_AUTH_4"] = "Skriv in PIN nummret du får i boxen tryck sen \"Submit\" knappen";
$language["TWIT_SUBMIT"] = "SKicka";
$language["TWIT_BAD_PIN"] = "Fel Pin Nummer, ska vara 7 siffror . Kontrollera och försök igen.";
$language["TWIT_REG_MISS_1"] = "Kod saknas, kom igen";
$language["TWIT_REG_MISS_2"] = "för att starta om denna process";
$language["TWIT_SUCCESS"] = "Twitter godkännande gjort,  nya torrenter annonseras nu  på ditt Twitter Konto automatiskt.";
$language["TWIT_CURL_REQ"] = "<span style='color:red'><b>(cURL extension behövs för att kunna användas)</b></span>";

// Torrent Moderation
$language["ACP_ADD_WARN"]="Torrent ändrings orsak";
$language["ACP_TMOD_SET"]="Torrent ändrings Panel";
$language["WARN_TITLE"]="Orsak titel";
$language["WARN_TEXT"]="Förklara orsak";
$language["WARN_ADD_REASON"]="Ange ny orsak";
$language["TRUSTED"]="Säker";
$language["TRUSTED_MODERATION"]="Säker modifiering";
$language["TORRENT_STATUS"]="Torrentstatus";
$language["TORRENT_MODERATION"]="Modifiering";
$language["MODERATE_TORRENT"] = "Modifiera";
$language["MODERATE_STATUS_OK"] = "Ok";
$language["MODERATE_STATUS_BAD"] = "Bad";
$language["MODERATE_STATUS_UN"] = "Omodifierad";
$language["FRM_CONFIRM_VALIDATE"] = "Bekräfta återvalidering";
$language["MODERATE_PANEL"] = "Modifiera torrentpanel";
$language["TMOD_SEND_PM"] = "Skicka PM då torrenten godkänts?";
$language["TMOD_SHOW_APPROVER"] = "Visa vem som godkänt torrent?";

// Uploader Medals
$language["UM_UPLOADER_MED"] = "Inställning för uppladdarmedalj";
$language["UM_HOW_MANY"] = "Kontrollera senaste X dagarnas uppladdade torrenter";
$language["UM_BRONZE_COUNT"] = "Lägsta antal uppladdningar för brons";
$language["UM_SILVER_COUNT"] = "Lägsta antal uppladdningar för silver";
$language["UM_GOLD_COUNT"] = "Lägsta antal uppladdningar för guld";
$language["UM_SHOWALL"] = "Visa alla eller bara uppladdares";
$language["UM_ALLRANKS"] = "Alla Rangnivåer";
$language["UM_UPONLY"] = "Endast uppladdare";
$language["UM_BLOCK_LIMIT"] = "Blockgräns";

// IMG In SB After X Shouts
$language["IMGSB_SETTINGS"] = "Inställningar för bilder i Shoutboxen";
$language["IMGSB_AFTER"] = "Efter X Shouts";
$language["IMGSB_TYPE"] = "Typ";
$language["IMGSB_IMAGES"] = "Bilder";
$language["IMGSB_TEXT"] = "Text";
$language["IMGSB_BOTH"] = "Båda";

$language["ACP_FM_HACK_SUBMENU"]='Sub Meny';

// style bridge
$language["STYLE_BRIDGE"] = "Xbtit->Smf Style Bridge";
$language["EDIT_STYLE_BRIDGE"] = "Ändra->Xbtit->Smf";
$language["EDITXB_STYLE_BRIDGE"] = "Xbtit tema:";
$language["EDITSM_STYLE_BRIDGE"] = "Smf tema:";
$language["EDITBTN_STYLE_BRIDGE"] = "Kör";
$language["HEADXB_STYLE_BRIDGE"] = "Xbtit";
$language["HEADSM_STYLE_BRIDGE"] = "Smf";
$language["HEADSTYLE_STYLE_BRIDGE"] = "Tema";
$language["HEADID_STYLE_BRIDGE"] = "Id";
$language["HEADCURR_STYLE_BRIDGE"] = "Nuvarnade inställningar";
$language["EDDEL_STYLE_BRIDGE"] = "ändra/ta bort";
$language["INSERT_STYLE_BRIDGE"] = "Sätt in->Xbtit->Smf";
$language["SMF_IS_REQ"] = "<span style='color:red'><b>(SMF mode krävs för aktivering)</b></span>";

// Block Comments
$language["BC_BLOCK_COMMENT"] = "Blockera kommentarer";

$language["TICKER_CONF"]='LED Ticker Config';
$language["SIGNUP_BONUS"]="Signup Bonus";

$language["WS_WARN_SETTINGS"]="Varningsinställningar";
$language["WS_MAX_WL"] = "Maximum varningsnivå";
$language["WS_AUTO_DOWN"] = "Auto-nergradering";
$language["WS_AUTO_DOWN_INT"] = "Auto-nergraderingsintervall (dagar)";
$language["WS_BOOT_AT_MAX"] = "Starta upp användare vid max varningsnivå";
$language["WS_BAN_BUTTON_AT_MAX"] = "Banknapp användare vid max varningsnivå";
$language["WS_BAN_BUTTON_AT_MAX"] = "Banknapp användare vid max varningsnivå";
$language["WS_TAKE_NO_ACTION_AT_MAX"] = "Vidta ingen åtgärd vid maximum varningsnivå";

$language["HACK_EN_DIS_ALL"] = "Slå på/Koppla från alla hacks";
$language["HACK_SET_ABOVE"] = "Använd inställningarna ovan";
$language["HACK_EN_ALL"] = "Aktivera alla";
$language["HACK_DIS_ALL"] = "Avaktivera alla";


$language["HNR_TS_ONLY"] = "Endast seedtid";
$language["HNR_RATIO_ONLY"] = "Endast ratio";
$language["HNR_TS_OR_RATIO"] = "Seedtid ELLER ratio";
$language["HNR_TS_OR_RATIO_1"] = "Seedtid <span style='color:blue;'><b>ELLER</b></span> Ratio";
$language["HNR_TS_AND_RATIO"] = "Seedtid OCH ratio";
$language["HNR_TS_AND_RATIO_1"] = "Seedtid <span style='color:green;'><b>OCH</b></span> Ratio";
$language["HNR_METHOD"] = "Metod";
$language["HNR_MIN_ST"] = "Minimum Seedtid";
$language["HNR_HOURS"] = "Timma (r)";
$language["HNR_DAYS"] = "Dag(ar)";
$language["HNR_MIN_RATIO"] = "Minimum Ratio";
$language["HNR_TOLERANCE"] = "Tolerans";
$language["HNR_DL_TRIGGER"] = "Ladda ner trigger";
$language["HNR_BYTES"] = "Byte(s)";
$language["HNR_KB"] = "Kilobyte(s)";
$language["HNR_MB"] = "Megabyte(s)";
$language["HNR_GB"] = "Gigabyte(s)";
$language["HNR_TB"] = "Terabyte(s)";
$language["HNR_BLSO"] = "Blockera leeching (Endast Seed )";
$language["HNR_CFP"] = "Skapa forum post";
$language["HNR_YMSAR"] = "Välj en rang!";
$language["HNR_YMSAM"] = "Välj en metod!";
$language["HNR_YMSAMST"] = "Välj minimum seedtid!";
$language["HNR_YMSAMR"] = "Välj minimum ratio!";
$language["HNR_YMSAMSTAAMR"] = "Välj  minimum seedtid och minimum ratio!";
$language["HNR_YMSAT"] = "Ställ in tolerans!";
$language["HNR_YMSADT"] = "Ställ in nerladdningstrigger!";
$language["HNR_YMSAVFBL"] = "Ställ in ett värde för att blockera leeching!";
$language["HNR_BFID"] = "Bad Forum ID!";
$language["HNR_MINSEED"] = "Min. S.T.";
$language["HNR_MINRAT"] = "Min. Ratio";
$language["HNR_TOL"] = "Tol.";
$language["HNR_DLTRIG"] = "D. Trig.";
$language["HNR_BLOLEECH"] = "Blockera Leech";
$language["HNR_FORPOST"] = "Forum Post";
$language["HNR_HRS"] = "Timmar";
$language["HNR_DYS"] = "Dagar";
$language["HNR_SET_FOR"] = "Inställningar för H&R";
$language["HNR_CONFIRM_DEL"] = "Bekräfta radering";
$language["HNR_R_U_SURE"] = "Vill du verkligen ta bort det här?";

// Low ratio Warn & Ban System
$language['ACP_LRB']='Låg-ratio varning och ban';

$language["RAT_OV_SET"] = "Låg-ratio varnings och bansystem - Övergripande inställningar";
$language["RAT_EN_SYS"] = "Aktivera system";
$language["RAT_1ST_WAR"] = "PM 1:a varning";
$language["RAT_2ND_WAR"] = "PM 2:a varning";
$language["RAT_LAST_WAR"] = "PM sista varning";
$language["RAT_US_SET"] = "Low Ratio Warning & Ban System - User Group Settings";
$language["RAT_RANK_ID"] = "Rang ID";
$language["RAT_MIN_DOWN"] = "Minsta nerladdning för att utlösa";
$language["RAT_1ST_RAT"] = "Ratio för 1:a varning";
$language["RAT_2ND_RAT"] = "Ratio för 2:a varning";
$language["RAT_3RD_RAT"] = "Ratio för 3:e varning";
$language["RAT_FIN_RAT"] = "Ratio för slutgiltig ban";
$language["RAT_NEXT_WARN"] = "Dagar till nästa varning";
$language["RAT_DBFWAB"] = "Dagar mellan sista varning och ban";
$language["RAT_SWS"] = "Visa varningssymbol";
$language["RAT_NEW_GROUP"] = "Lägg till ny grupp";
$language["RAT_ID_LEVEL"] = "ID-nivå";
$language["RAT_USERG"] = "Användargrupp";
$language["RAT_MIN_DOWN_A"] = "Min nerladdat";
$language["RAT_1ST_RAT_A"] = "1a ratiovarning";
$language["RAT_2ND_RAT_A"] = "2:aratiovarning";
$language["RAT_3RD_RAT_A"] = "3:e ratiovarning";
$language["RAT_FIN_RAT_A"] = "Ban ratio";
$language["RAT_DTSW"] = "Dagar till 2:a varning";
$language["RAT_DTTW"] = "Dagar till 3:e varning";
$language["RAT_DTB"] = "Dagar att banna";
$language["RAT_WS"] = "Varningssymbol";
$language["RAT_WABH"] = "Varnings- och banhistorik";
$language["RAT_USER"] = "Användare";
$language["RAT_WARN_TIM"] = "Varnad gånger";
$language["RAT_WS_BANNED"] = "Bannad";
$language["RAT_UNWARN"] = "Ta bort varning";
$language["RAT_UNBAN"] = "Ta bort ban";
$language["RAT_GROUP_RULES"] = "Gruppregler";
$language["RAT_NO_2ND_RULE"] = "Det går inte att lägga till 2 regler för  1 grupp!";

// Upload Multiplier
$language["UPM_SETTINGS"] = "Inställning för uppladdningsmultiplikator";
$language["UPM_MIN_BASE"] = "Inställning för minimum basrang";

// Allow Upload / Download
$language["AUAD_DOWN"] = "Nerladdning";
$language["AUAD_UP"] = "Uppladdning";

// Proxy / Blacklist
$language["ACP_PROXY"] = "Användare bakom Proxy";
$language["ACP_BLACKLIST"] = "Svarta listan";
$language["PROX_ADD_TO_LIST"] = "Lägg till Proxy IP-n till svarta listan, titta efter Proxy IP-n vid";
$language["PROX_PIP"] = "Proxy IP";
$language["PROX_IP"] = "IP";
$language["PROX_DA"] = "Datum tillagd";
$language["PROX_REM"] = "Ta bort";
$language["PROX_NONE_YET"] = "Ingen svartlistad IP ännu";
$language["PROX_SUBJ_1"] = "Proxy upptäckt!";
$language["PROX_MSG_1"] = "Förklara varför du använder en proxy, för tillfället har dina nerladdningsrättigheter dragits in.";
$language["PROX_SUBJ_2"] = "Proxyskäl accepterat";
$language["PROX_MSG_2"] = "Vi accepterar ditt skäl för att använda en proxy, dina nerladdningsrättigheter har återställts.";
$language["PROX_NOTHING_1"] = "Ingenting";
$language["PROX_NOTHING_2"] = "till";
$language["PROX_NOTHING_3"] = "se";
$language["PROX_NOTHING_4"] = "här";
$language["PROX_NOTHING_5"] = "ännu";
$language["PROX_ALL_DL"] = "Tillåt DL";
$language["PROX_PUNISH"] = "Straff";

//FAQ
$language["ACP_FAQ_GROUP"]="FAQ-grupper";
$language["ACP_FAQ"]="FAQ";
$language["ACP_FAQ_QUESTION"]="FAQ-frågor";

// Gifts
$language["ACP_GIFTS"] = "Gåvor";
$language["GIFTS_SELECT"] = "Välj mottagare";
$language["GIFTS_NAME"] = "Användare";
$language["GIFTS_RANK"] = "Rang";
$language["GIFTS_ALL"] = "Alla";
$language["GIFTS_INV"] = "Inbjudan";
$language["GIFTS_SB"] = "Seedbonus";
$language["GIFTS_SBP"] = "Seedbonuspoäng";
$language["GIFTS_ACTION"] = "Välj typ";
$language["GIFTS_USER_NAME"] = "Om användarnamn";
$language["GIFTS_IF_RANK"] = "Om rang";
$language["GIFTS_WHO"] = "Vem skall få gåvan";
$language["GIFTS_WHAT"] = "Gåva";
$language["GIFTS_NUMBER"] = "Hur mycket";
$language["GIFTS_SUCCES"] = "Lyckades";
$language["GIFTS_UPDATE_SUCCES"] = "Den valda användaren har fått sin gåva";
$language["No_GO_INV"] = "Du kan inte ge inbjudan, systemet är inaktiverat!";
$language["No_GO_SB"] = "Du kan inte ge seedbonuspoäng, systemet är inaktiverat!";
$language["GIFT_SUBJECT"] = "Du har fått en gåva";
$language["GIFT_MES_A"] = "Du har fått";
$language["GIFT_MES_B"] = "Detta är ett automatmeddelande, svara inte";
$language["GIFT_ERROR_MSG"] = "Något blev fel ?!";
$language["GIFT_CUSTOM"] = "Anledning till gåvan Text (PM)";
$language["GIFT_TEXT"] = "Text";

// staff control
$language['ACP_STAFF_CONTROL'] = "Staffkontroll";
$language['MO']= 'Vill du verkligen ställa tillbaka denna användares rang till den föregående?';
$language['MA']= 'Ångra';
$language['AUSER']= 'Användare';
$language['OL']= 'Gammal rang';
$language['NE']= 'Ny rang';
$language['BY']= 'Åtgärd av';
$language['DA']= 'När';
$language['SC']= 'Staffkontroll';
$language['UNDONE']= 'Ångrat';

// Birthday hack
$language["ACP_BIRTHDAY"]="inställning för födelsedagshack";
$language["BIRTHDAY_LOWER_LIMIT"]="Minimum användarålder";
$language["BIRTHDAY_UPPER_LIMIT"]="Maximum användarålder";
$language["BIRTHDAY_BONUS"]="Födelsedagsbonus per år (GB)";
$language["BIRTHDAY_UPDATED"]="Tack, inställningen för din födelsedagshack har nu blivit uppdaterad";

// PM Banned
$language["PMB_BANNED"] = "PM-bannad";

$language["FORUM_DISPLAY_TYPE"] = "Visa integrerade forum i:";
$language["FORUM_OPTION_1"] = "en iframe (standard)";
$language["FORUM_OPTION_2"] = "samma fönster";
$language["FORUM_OPTION_3"] = "ett nytt fönster";

$language["PEERS_VIEW_PEERS"] = "Se peers";
$language["PEERS_VIEW_HIST"] = "Se historik";
$language["PEERS_VIEW_USERD"] = "Se användardetaljer Torrenter";

$language["ACP_DPS_SETTINGS"]="ladda ner Prefix/Suffixinställningar";
$language["DPS_PREFIX"]="Torrent FilenamnPrefix";
$language["DPS_SUFFIX"]="Torrent Filenamnsuffix";
$language["DPS_EXAMPLE"]="Exempel";
$language["DPS_EXAMPLE_TORR"]="Some.Movie.2011.DVDRip.XviD-SomeTeam.torrent";
$language["DPS_BEFORE"]="Före";
$language["DPS_AFTER"]="Efter";

$language["ACP_UPL_RIGHTS"]="inställning för uppladdarrättigheter";
$language["UPRI_EDIT"]="Tillåt uppladdare att ändra sin egen torrent";
$language["UPRI_DELETE"]="Tillåt uppladdare att radera sina egna torrenter";

$language["ACP_PG_SETT"]="Pager Typ inställningar";
$language["PG_TYPE"]="Välj Pager Typ";
$language["PG_OLD"]="gammal stil";
$language["PG_NEW"]="Ny stil";

$language["BAN_CHEAPMAIL"]="Banna Cheapmail Domains";
$language["ERR_WILDCARD_1"]=" wildcardet ";
$language["ERR_WILDCARD_2"]=" är redan på Cheapmail Domains lista så inget behöver läggas till ";
$language["ERR_WILDCARD_3"]=" till listan.";
$language["CHEAP_CONFIRM_1"]="Vill du verkligen radera ";
$language["CHEAP_CONFIRM_2"]="Ingen ytterligare bekräftelse skickas";
$language["CHEAP_DELETED_1"]=" har raderats";
$language["CHEAP_DELETED_2"]="Klicka här";
$language["CHEAP_DELETED_3"]=" för att återvända";
$language["ERR_CHEAP_SUBMIT"]="För in ett värde i textrutan!!";
$language["CHEAP_ADDED"]=" lades till Cheapmail Domainslistan";
$language["ERR_CHEAP_DUPE"]=" är redan på Cheapmail Domainslista";
$language["CHEAP_CURRENT"]="Aktuell Cheapmail domains";
$language["ADDED_BY"]="Tillagd av";
$language["CHEAP_COUNT_1"]="hittades ";
$language["CHEAP_COUNT_2"]=" Cheapmail Domains";
$language["CHEAP_ADD"]="Lägg till Cheapmail Domain:";

$language["UP_CONTROL"]="Uppladdarkontroll";
$language["UP_RANK_UPL"]="Rang - Uppladdare";
$language["UP_RANK_OTH"]="Rang - övrigt";
$language["UP_LAST_ONLINE"]="Senast online";
$language["UP_LAST_UPLOAD"]="Senast uppladdad";
$language["UP_DAYS_AGO"]="Dagar sedan";
$language["UP_ACT_UPL"]="Aktiva uppladdningar";

$language["IP2C_DB_IMP1"]="Databas från IP2-land har framgångsrikt importerats, du kan nu aktivera hacken";
$language["IP2C_DB_IMP2"]="här";
$language["IP2C_DB_REQ1"]="<span style='color:red'><b>(Databasimport (5.9MB) krävs för aktivering, ";
$language["IP2C_DB_REQ2"]="klicka här";
$language["IP2C_DB_REQ3"]="att importera.</b></span>";

$language["AVATAR_UPLOAD"] = "Avataruppladdning";
$language["MAX_FILE_SIZE"] = "Max. size på filen! (i kb)";
$language["MAX_IMAGE_SIZE"] = "Max. storlek på bilden!";
$language["IMAGE_WIDTH"] = "Bredd";
$language["IMAGE_HEIGHT"] = "Höjd";
$language["AVATAR_UPLOAD_SET"] = "Inställningar för avataruppladdning";

$language["UN_SETTINGS"] = "Inställning för användaranteckningar";
$language["UN_NOTEMOD"] = "Modifiera/Ta bort anteckningar";
$language["UN_ENABLED"] = "Aktiverad";
$language["UN_DISABLED"] = "Avstängd";
$language["UN_AUTONOTE"] = "Automatisk anteckning på användarposten för";
$language["UN_INVITE"] = "Inbjudan-händelse";
$language["UN_BONUS"] = "Bonuspoäng-händelse";
$language["UN_DONATE"] = "Donations-händelse";
$language["UN_WARN"] = "Varnings-händelse";
$language["UN_HNR"] = "Hit & Run-händelse";
$language["UN_AUTORANK"] = "Autorang-händelse";
$language["UN_BOOTED"] = "Starthändelse";
$language["UN_SBBAN"] = "Shoutbox ban-händelse";
$language["UN_BANBUT"] = "Banknapp-händelse";
$language["UN_PARKED"] = "Parkerad händelse";
$language["UN_LRBE"] = "Låg ratio ban-händelse";
$language["UN_BIRTHDAY"] = "Födelsedagshändelse";
$language["UN_SBOX_REM"]="är inte längre bannad från Shoutboxen"; 
$language["UN_SBOX_ADD"]="har bannats från att använda Shoutboxen";
$language["UN_BAN_BUT_2"]="är inte längre bannad via Banknappen";
$language["UN_NOTESPERPAGE"]="Anteckningar per sida";

$language["VIEW_NFO"]="Läs NFO";

$language["RREG_SETTINGS"]="Slumpvis registeringsinställning";
$language["RREG_OPEN_FOR"]="Registrering öppen för";
$language["RREG_AT_A_TIME"]="åt gången";
$language["RREG_RANDOM_WINDOW"]="Minimum/Maximum fönster";
$language["RREG_MINUTES"]="minut(er)";
$language["RREG_AF_CLOSE"]="efter senaste registreringsförslutning";

// FORUM AUTO-TOPIC
$language['ACP_CATFORUM_CONFIG']='Forum Auto-Topic Konfiguration';
$language['ACP_CATFORUM_SELECT']='Forum Auto-Topic';
$language['AUTOTOPIC_MESS1']='<br />Här kan du aktivera auto-topic vid torrentuppladdning upon torrent upload in your forum.<br>You can choose Internal, SMF or IPB Forum in Tracker\'s Settings in order to use this functionality.';
$language['AUTOTOPIC_MESS2']='<br>Välj vilket forum som går till vilken kategori.<br>Modifieringar tillämpas direkt. Det går bara att välja ett forum per torrentkategori.<br>Endast torrenter som uppladdas efter aktivering kommer ha automatiskt forum topic.<br />';
$language['AUTOTOPIC_ACTIVE']='Aktivera Auto-Topic';
$language['AUTOTOPIC_PREFIX']='Prefix för ämnesnamn<br />Välj ett prefix att posta för ämnets namn, t.ex. "[Ny Torrent] ".';

$language["VIEW_REENC"]="View Re-encoded";
$language["ACP_REENC_SET"]="Re-Encode inställningar";
$language["ACP_SHOUTANN_SET"]="Shoutbox Announce inställningar";
$language["SHOUTANN_SHOW_UP"]="Visa uppladdarens namn på torrentannouncen";

$language['ACP_SEO']='Xbtit SEO panel';
$language["ACP_STCOMM_SET"]="Inställningar för staffkommentarer";
$language["SCOMM_MIN_SET"]="Lägsta rang för att skriva kommentarer";
$language["SCOMM_MIN_ADD"]="Lägsta rang för att se kommentarer";

$language["ACP_RECOMMEND_SET"]="Rekommenderade torrentinställningar";
$language["RTORR_MAX_TO_DISP"]="Maximalt rekommenderade antal torrenter";

$language["ACP_UIMG_SET"]="Inställningar för Användarbilder";
$language["ACP_UIMG_START"]="Användarbilder - Start";
$language["ACP_UIMG_END"]="Användarbilder - Slut";

$language["ACP_SECSUI_SET"]="Inställningar för säkerhetsserie";
$language["SECSUI_QUAR_SETTING"]="Uppladdade karantänfilsinställningar";
$language["SECSUI_QUAR_TERMS_1"]="villkor för karantänsök (en per rad)";
$language["SECSUI_QUAR_TERMS_2"]="Lägg till ord som kommer trigga filkarantän nedan:";
$language["SECSUI_QUAR_TERMS_3"]="ANM: Det är inte tillrådligt att lägga till <b><&#63;</b> eller <b>&#63;></b> då de kan uppträda naturligt i filen, istället bör du sätta värdet <b>short_open_tag</b> till <b>Off</b> php.ini, detta hindrar sidan från att köra php-kod som startar med <b><&#63;</b> och kommer tvinga eventuella hackers att använda den långa php open tag (<b><&#63;php</b>) i stället.<br /><br />Aktuellt värde är:<br />";
$language["SECSUI_QUAR_DIR_1"]="karantänkatalog";
$language["SECSUI_QUAR_DIR_2"]="Denna mapp bör helst vara omöjlig att komma åt via internet och vara minst en nivå över trackerns rootkatalog till exempel:";
$language["SECSUI_QUAR_DIR_3"]="Se till att du CHOWN/CHMOD denna katalog korrekt så att servern kan skriva filer till den.";
$language["SECSUI_QUAR_PM"]="Tracker ID till PM när filer skickas i karantän";
$language["SECSUI_QUAR_INV_USR"]="Ogiltig användare";
$language["SECSUI_PASS_SETTINGS"]="Lösenordsinställningar";
$language["SECSUI_PASS_TYPE"]="Lösenord Hashing Metod";
$language["SECSUI_PASS_INFO"]="Här kan du välja den lösenordsalgoritm du vill att xbtitFM skall använda när den lagrar lösenord i databasen:";
$language["SECSUI_NO_MEMBER"]="Det finns ingen medlem med det tracker id";
$language["SECSUI_GAZ_TITLE"]="Gazelle Site Salt";
$language["SECSUI_GAZ_DESC"]="Sätt ett slumpmässigt värde här. När det är gjort får du inte ändra för då måste alla återställa sina lösenord.";
$language["SECSUI_COOKIE_SETTINGS"]="Cookieinställning";
$language["SECSUI_COOKIE_PRIMARY"]="Huvudsaklig Cookieinställning";
$language["SECSUI_COOKIE_TYPE"]="Cookie Typ";
$language["SECSUI_COOKIE_EXPIRE"]="Cookie utgår";
$language["SECSUI_COOKIE_T1"]="Classic xbtit";
$language["SECSUI_COOKIE_T2"]="Ny xbtitFM (Regular)";
$language["SECSUI_COOKIE_T3"]="Ny xbtitFM (Session)";
$language["SECSUI_COOKIE_NAME"]="Cookie Namn";
$language["SECSUI_COOKIE_ITEMS"]="Cookie objekt";
$language["SECSUI_COOKIE_PATH"]="Cookie Path";
$language["SECSUI_COOKIE_DOMAIN"]="Cookie Domain";
$language["SECSUI_COOKIE_MIN"]="Minut";
$language["SECSUI_COOKIE_MINS"]="Minuter";
$language["SECSUI_COOKIE_HOUR"]="Timme";
$language["SECSUI_COOKIE_HOURS"]="Timmar";
$language["SECSUI_COOKIE_DAY"]="Dag";
$language["SECSUI_COOKIE_DAYS"]="Dagar";
$language["SECSUI_COOKIE_WEEK"]="Vecka";
$language["SECSUI_COOKIE_WEEKS"]="Veckor";
$language["SECSUI_COOKIE_MONTH"]="Månad";
$language["SECSUI_COOKIE_MONTHS"]="Månader";
$language["SECSUI_COOKIE_YEAR"]="År";
$language["SECSUI_COOKIE_YEARS"]="År";
$language["SECSUI_COOKIE_TOO_FAR"]="Tyvärr skulle det sätta utgångsdatum efter nuvarande gräns tisd 19 januari 2038 03:14:07 GMT, justera utgångsdatum i enlighet med detta!";
$language["SECSUI_COOKIE_PSALT"]="Password Salt";
$language["SECSUI_COOKIE_UAGENT"]="Användaragenten";
$language["SECSUI_COOKIE_ALANG"]="Acceptera språk";
$language["SECSUI_COOKIE_IP"]="IP Adress";
$language["SECSUI_COOKIE_DEF"]="NOTE: Alla cookietyper har följande som standard:<br /><br /><li>Tracker ID</li><li>Password Hash</li><li>Slumpad siffra</li>";
$language["SECSUI_COOKIE_PD"]="NOTE: Om du är osäker vad du skall läggga in för \"Cookie Path\" or \"Cookie Domain\", lämna det tomt och standardvärden kommer att användas";
$language["SECSUI_COOKIE_IP_TYPE_1"] = "1:a octet endast (Y.N.N.N)";
$language["SECSUI_COOKIE_IP_TYPE_2"] = "2:a octet endast (N.Y.N.N)";
$language["SECSUI_COOKIE_IP_TYPE_3"] = "3:e octet endast (N.N.Y.N)";
$language["SECSUI_COOKIE_IP_TYPE_4"] = "4:e octet endast (N.N.N.Y)";
$language["SECSUI_COOKIE_IP_TYPE_5"] = "1:a & 2:a octets (Y.Y.N.N)";
$language["SECSUI_COOKIE_IP_TYPE_6"] = "2:a & 3:e octets (N.Y.Y.N)";
$language["SECSUI_COOKIE_IP_TYPE_7"] = "3:e & 4:e octets (N.N.Y.Y)";
$language["SECSUI_COOKIE_IP_TYPE_8"] = "1:a & 3:e octets (Y.N.Y.N)";
$language["SECSUI_COOKIE_IP_TYPE_9"] = "1:a & 4:e octets (Y.N.N.Y)";
$language["SECSUI_COOKIE_IP_TYPE_10"] = "2:a & 4:e octets (N.Y.N.Y)";
$language["SECSUI_COOKIE_IP_TYPE_11"] = "1:a, 2:a & 3:e octets (Y.Y.Y.N)";
$language["SECSUI_COOKIE_IP_TYPE_12"] = "2:a, 3:e & 4:e octets (N.Y.Y.Y)";
$language["SECSUI_COOKIE_IP_TYPE_13"] = "Hel IP-adress (Y.Y.Y.Y)";
$language["SECSUI_PASSHASH_TYPE_1"] = "Classic xbtit";
$language["SECSUI_PASSHASH_TYPE_2"] = "TBDev";
$language["SECSUI_PASSHASH_TYPE_3"] = "TorrentStrike";
$language["SECSUI_PASSHASH_TYPE_4"] = "Gazelle";
$language["SECSUI_PASSHASH_TYPE_5"] = "Simple Machines Forum";
$language["SECSUI_PASSHASH_TYPE_6"] = "Ny xbtit";
$language["SECSUI_PASSHASH_TYPE_7"] = "Ny xbtitFM";
$language["SECSUI_PASS_MUST"] = "Lösenordet måste";
$language["SECSUI_PASS_BE_AT_LEAST"] = "vara åtminstone";
$language["SECSUI_PASS_HAVE_AT_LEAST"] = "ha åtminstone";
$language["SECSUI_PASS_CHAR_IN_LEN"] = "tecken i längd";
$language["SECSUI_PASS_CHAR_IN_LEN_A"] = "tecken i längd";
$language["SECSUI_PASS_LC_LET"] = "liten bokstav";
$language["SECSUI_PASS_LC_LET_A"] = "små bokstäver";
$language["SECSUI_PASS_UC_LET"] = "stor bokstav";
$language["SECSUI_PASS_UC_LET_A"] = "Stora bokstäver";
$language["SECSUI_PASS_NUM"] = "siffra";
$language["SECSUI_PASS_NUM_A"] = "siffror";
$language["SECSUI_PASS_SYM"] = "specialtecken";
$language["SECSUI_PASS_SYM_A"] = "specialtecken";
$language["SECSUI_PASS_ERR_1"] = "Det går inte att ha ett högre värde för stora bokstäver + små bokstäver + siffror + specialtecken";
$language["SECSUI_PASS_ERR_2"] = "än du har för minimum antal tecken som behövs i lösenordet";

$language["SMF_MIRROR"] = "SMF Mirror";
$language["GROUP_SMF_MIRROR"] = "Speglar rangen på SMF-forumet för statusändringar, etc.";
$language["SMF_LIST"] = "<b><u>Aktuell SMF-grupplista från databasen</u></b><br />";
$language["IPB_AUTO_ID"] = "IPB Autopost ID";
$language["IPB_MIRROR"] = "IPB Mirror";
$language["GROUP_IPB_MIRROR"] = "Speglar rangen på IPB-forumetför statusändringar, etc.";
$language["IPB_LIST"] = "<b><u>Aktuell IPB-grupplista från databasen</u></b><br />";

$language["ACP_CBT"]="Cooly's Backup Verktyg";
$language["ACP_BUFILES"]="Fil Backup";
$language["ACP_BUDB"]="MYSQL Backup";
$language["ACP_BUINFO"]="klicka på drive för att fortsätta.";
$language["ACP_BUINFO2"]="Klicka på knappen för att köra en ny back-up. Varning dock! Klicka bara en gång. Den arbetar i bakgrunden och du behöver inte vänta på resultatet!";
$language['Watchu']= 'Bevakade användare';
$language['WatchL']= 'Bevakningslista';
$language["DDL_ADD_ED"] = "Lägg till/Ändra direktnerladdning";
$language["DDL_VIEW"] = "Se direktnerladdning";

$language["ACP_BALL_SET"] = "Popupp vid Mouseover inställning";
$language["BALL_DEFAULT"] = "Visa standardobjekt";
$language["BALL_IMGUP"] = "Bilduppladdning";
$language["BALL_IMDB"] = "IMDB Poster";
$language["ACP_ONLINE_SET"] = "Online Block inställningar";
$language["ONLINE_TIMEOUT"] = "Online Block timeout (minuter)";
$language["PRICE_FOR_HNR"] = "Priset för Hit & Run minskning";
$language["ACP_SHOWPORN_SET"]="Dölj/visa adultinställningar";
$language["SP_PORN_CAT"]="Din adultkategori";
$language["SP_PORN_CATS"]="Dina adultkategorier";
$language["SP_MULTI_CAT"]= "Om du har multipla adultkategorier, kan du gå in på dem som en kommaseparerad lista, ftill exempel <span style='font-weight:bold;'>1,2,3</span>";
$language["SHOUT_PAGER_LIMIT"]="Shouts Per sida (Shoutbox Historik)";

$language["STYLE_TYPE"]="Stl Typ";
$language["CLA_STYLE"]="xbtit Klassiskt stil system";
$language["ATM_STYLE"]="atmoner's stil system";
$language["PET_STYLE"]="Petr1fied's stil system";

$language["IMGUP_MAXW"]="Max bredd";
$language["IMGUP_MAXH"]="Maximum höjd";

$language["VIPFL_FREELEECH"] = "VIP Frileech";

$language["HOS_CAN_HIDE"] = "Kan dölja";
$language["HOS_SEE_HIDDEN"] = "Se dolda medlemmar";
$language["FLOW_LIM"]="Imageflow Gräns";
$language["FLOW_CATS"]="Imageflow Kategorier";
$language["FLOW_SET"]="Imageflow Inställningar";

$language["IMGFL_PRIORITY"]="Imageflow Priority";
$language["IMGFL_IU"]="Ladda upp Bild";
$language["IMGFL_IMDB"]="IMDB Poster";




// Upload Multiplier
$language["UPM_SET_MULTI"] = "Aktivera multiplikator på  torrenter";
$language["UPM_VIEW_MULTI"] = "Sök torrents med X-uppladdning";
$language["UPM_SET_MULTI_SHORT"] = " Gånger X";
$language["UPM_VIEW_MULTI_SHORT"] = "Se gånger X";

$language["BUMP_CANBUMP"] = "Flytta torrent till toppen av listan";
$language["BUMP_CANBUMP_SHORT"] = "Flytta upp torrents";

$language["ACP_ARCHIVE_SET"] = "Arkiv System Inställningar";
$language["ARC_OLDER_THAN"] = "Flytta torrents äldre än till arkiv";
$language["ARC_HOURS"] = "timmar";
$language["ARC_DAYS"] = "dagar";
$language["ARC_WEEKS"] = "veckor";
$language["ARC_BONUS"] = "Extra bonus för arkiv torrents";

$language["ARC_VIEW_NEW"]="Se Nya Torrents";
$language["ARC_UP_NEW"]="Ladda upp Nya Torrents";
$language["ARC_DOWN_NEW"]="Ladda ner Nya Torrents";
$language["ARC_VIEW_ARC"]="Se Arkiv";
$language["ARC_UP_ARC"]="Ladda upp till Arkiv";
$language["ARC_DOWN_ARC"]="Ladda ner från arkiv";

$language["ADS_PRE"]="Förhandsvisa AD";
$language["ADS_AREA"]="Område";
$language["ADS_CON"]="Innehåll";
$language["ADS_EDT"]="Ändra";
$language["ADS_EN"]="Aktiverad";
$language["ADS_H"]="Huvud";
$language["ADS_LT"]="Vänster Topp";
$language["ADS_LB"]="Vänster Botten";
$language["ADS_RT"]="Höger Toppen";
$language["ADS_RB"]="Höger Botten";
$language["ADS_AC"]="Ovanför Kommentarer";
$language["ADS_F"]="Footer";
$language["ADS_PREV"]="Förhandsvisa";
$language["ADS_VIEW"]="Vilken klass kan se";
$language["ADS_CONF"]="ADS Inställning";
$language["SETUP_MSG"]="Inställning";
$language["SETUP_MSG2"]="Reg PM Inställning ";
$language["PREVIEW_MSG"]="Förhandsvisning";
$language['HACK_ENABLE_ALL_WARN']="Warning: Just because this option is here, it is not necessarily a\\ngood idea to use it.\\n\\nEnabling all hacks in one fell swoop will have the adverse effect\\nof disabling many features that are available by default and you\\'ll\\nmost likely end up looking for a needle in a haystack when it\\ncomes to trying to configure the hacks afterwards.\\n\\nInstead we advise you to only enable the hacks that you actually\\nneed and also build up your list of enabled hacks gradually. This\\nway you can configure the settings for each hack as you go along.\\n\\nYou can of course ignore this warning and continue to use this\\noption anyway but you have been warned!";
$language["LGO_TITLE"]="Logisk Ordning";
$language["LRO_INFO"]="Logisk Klass ordning (Allows better range selection)";
$language["LRO_ERR_BLOCK"]="You have not configured the logical rank orders correctly. Please ensure all ranks have a unique value and they are in order of priority/importance.<br /><br />You can configure the logical rank orders";
$language["FLS_ENABLE"]="Aktivera Fri leech Slots?";
$language["FLS_COST"]="Pris per Fri leech Slot";
$language["FLS_PRICE_FOR_FLS"]="Kostnad för Fri leech slot";
$language["FLS_ACP_ADMIN"] = "Fri leech Slot Admin";
$language["FLS_AFFECT"] = "Vad ska ändras";
$language["FLS_INDIV"] = "Enstaka Medlem";
$language["FLS_GROUP"] = "Grupp av klass";
$language["FLS_NEED_RO"] = "Denna admin sida kräver <b>Logical Rank Ordering</b> skriptet aktiverat.<br /><br />Aktivera det";
$language["FLS_RANK_RANGE"]="Klass rank:";
$language["FLS_OPTIONS"]="Att utföra:";
$language["FLS_SET_SLOTS_TO"]="Ställ in Fri leech slots till detta värde:";
$language["FLS_ZERO_AND_CANCEL"]="Noll slots och avsluta Fri leech slots";
$language["FLS_INCREMENT_SLOTS"]="Ändrat Freeleech slots av:";
$language["FLS_NO_USER"]="Inge namn angivet!";
$language["FLS_USER_INVALID"]="Användaren finns inte!";
$language["FLS_INC_BY_ZERO"]="Du kan inte ändra med noll inget ändras!";
$language["FLS_JOB_DONE"]="Ändringen Genofördes korrekt.";
$language["FLS_RANGE_ERROR"]="Klass måste sättas från lägst till högst.";
$language["ACP_TOW_SETTINGS"]="Veckans Film/Torrent Inställning";
$language["TOW_TORRENT_SEARCH"]="Sök fil för Veckans torrent";
$language["TOW_SEL_TORR"]="Vald torrent";
$language["TOW_SUCCESS_1"]="Din inställning har accepterats.";
$language["TOW_SUCCESS_2"]="För att återgå till index.";
$language["TOW_CLICK"]="Klicka här";
$language["TOW_CHOOSE"]="Välj en";
$language["TOW_CHOOSE_SET"]="Välj Inställningar";
$language["TOW_SEL_FOR"]="Välj för";
$language["TOW_THIS_WEEK"]="Denna vecka";
$language["TOW_NEXT_WEEK"]="Nästa vecka";
$language["TOW_IMUP"]="Bild uppladdning";
$language["TOW_IMPRI"]="Bild prio..";
$language["TOW_MOVE_ALONG"]="Inget att ställa in";
$language["TOW_SET_MULTI"]="Ställ in X uppladning";
$language["TOW_REV_AFTER"]="Återställ vid utgång";
$language["TOW_SET_GOLD"]="Sätt guld";
$language["TOW_NO_TORR"]="Inget Hittades!";
$language["CAPTCHA_CONFIG"]="Captcha Inställning";
$language["CAPTCHA_PUB"]="Allmän Nyckel";
$language["CAPTCHA_PRIV"]="Privat Nyckel";
$language["CAPTCHA_DESC"]="Registrera <a target=\"_new\" href=\"http://www.google.com/recaptcha\">Här</a> lägg till domän för att få dina nycklar.";
$language["ACP_PROTUSER_SETTINGS"]="Inställningar Skyddade Användarnamn";
$language["PROTUSER_ADD_NAMES"]="Skyddade användarnam (Ett per rad)";
$language["HTML_PARSE"]="Upload Filename Parser Type";
$language["HTML_SPECIAL"]="<a href='javascript:poppeer(\"http://php.net/manual/en/function.htmlspecialchars.php\");'>htmlspecialchars</a>";
$language["HTML_ENT"]="<a href='javascript:poppeer(\"http://php.net/manual/en/function.htmlentities.php\");'>htmlentities</a>";
$language["ACP_INTFORUMPOLL_SETTINGS"]="Integrerad Forum omröstning";
$language["INTFPOLL_MON"]="Forum att kontrollera  för Omröstningar";
$language["ACP_TAC_SETTINGS"]="Inställningar för Torrent Färger";
$language["TAC_SNATCHED_PREFIX"]="Nerladdad torrents prefix färg (eg <span style='color:blue;'>&lt;span style=&#39;color:blue;&#39;&gt;)</span>";
$language["TAC_SNATCHED_SUFFIX"]="Nerladdad torrents suffix färg (eg <span style='color:blue;'>&lt;&#47;span&gt;</span>)";
$language["TAC_LEECHING_PREFIX"]="Leeching torrents prefix färg (eg <span style='color:red;'>&lt;span style=&#39;color:red;&#39;&gt;</span>)";
$language["TAC_LEECHING_SUFFIX"]="Leeching torrents suffix färg (eg <span style='color:red;'>&lt;&#47;span&gt;</span>)";
$language["TAC_SEEDING_PREFIX"]="Seeding torrents prefix färg (eg <span style='color:green;'>&lt;span style=&#39;color:green;&#39;&gt;</span>)";
$language["TAC_SEEDING_SUFFIX"]="Seeding torrents suffix färg (eg <span style='color:green;'>&lt;&#47;span&gt;</span>)";
$language["TAC_HIDE_DOWN_IMG"]="Dölj iconen för nerladdade torrent";

$language["ACP_TVDB_SETTINGS"]="TVDB Inställningar";
$language["TVDB_CATS"]="Välj Dina TV Kategorier";
$language["TVDB_MIN_RATING"]="Minsta betyg på röster";
$language["TVDB_MIN_VOTERS"]="Minsta antal som röstat på poster";
$language["IMGFL_TVDB"]="Slumpad TVDB Poster";
$language["TVDB_PRIORITY_1"]="Första Val";
$language["TVDB_PRIORITY_2"]="Andra Val";
$language["TVDB_PRIORITY_3"]="Tredje Val";
$language["TVDB_PRIORITY_ERR1"]="Ogiltig Data Från!";
$language["TVDB_PRIORITY_ERR2"]="Måste vara olika val i valfälten!";
$language["TVDB_ADD_AWK"]="Ange en annan titel";
$language["TVDB_AWK_EXPLAIN"]="Här kan du ange undantag Om systemet in klarar av att hitta info på TVDB Så att kommande uppladdningar visas korrekt .";
$language["TVDB_REL_NAME"]="Release namn, ex för<br /><span style='color:green;'>Beauty.and.the.Beast.2012.S01E16.720p.HDTV.x264-IMMERSE</span><br />Bara <span style='color:green;'>Beauty.and.the.Beast.2012</span> kan anges.";
$language["TVDB_DELIM"]="Vad används för att dela upp orden i Titeln?<br />(oftast <span style='color:green;'>.</span> eller <span style='color:green;'>_</span> eller ibland ett mellanslag)";
$language["TVDB_CURR_AWK"]="Nuvarande Andra Titlar";
$language["TVDB_REL_NAME_SHORT"]="Release namn";
$language["TVDB_DELIM_SHORT"]="Bryt tecken";
$language["TVDB_AWK_ERR"]="Om du lägger till en annan Titel måste du ange:<br /><ul><li>Release namnet.</li><li>Vilket bryt tecken som används.</li><li> TVDB Seriens ID.</li></ul><span style='color:red;font-weight:bold;'>Alla 3 måste användas!</span>";
$language["TVDB_HIDE_IMDB"]="Göm IMDB i Torrent Detailjer Om Det finns info från TVDB?";

$language["ADV_PRUNE_MAX_VAL"]="Ta bort ej verifierade konton efter";
$language["ADV_PRUNE_MAX_TOR"]="Ta bort torrents När dom varit döda i";
$language["ADV_DAYS"]="Dagar";
$language["ADV_PRUNE_FIRST_WARN"]="Första Inaktivitets Varningen Efter";
$language["ADV_PRUNE_FIRST_WARN_MSG"]="Första varnings meddelandet";
$language["ADV_PRUNE_SECOND_WARN"]="Andra inaktivitets varningen efter";
$language["ADV_PRUNE_SECOND_WARN_MSG"]="Andra varnings meddelandet";
$language["ADV_DEL_AFTER"]="Ta bort användaren efter ytterligare";
$language["ADV_EXEMPT_RANKS"]="Klasser som skyddas från borttagning";
$language["ADV_KEY"]="Message Ersättnings Koder";
$language["ADV_USERNAME1"]="Tracker Användarnamn";
$language["ADV_USERNAME2"]="i ditt fall";
$language["ADV_SEE_BELOW"]="Se under";
$language["ADV_PRUNE_CURRENTLY"]="Nuvarande";
$language["ADV_PRUNE_FINAL_MSG"]="Slugiltigt meddelande";

$language["SEO_MODRW_REQ"]="<span style='color:red;font-weight:bold;'>Apache \"mod_rewrite\" modulen krävs för att aktivera detta skript.</span>";
$language["CAN_BOOT_USERS"]="Bannlys användare";
$language["ACP_RESEED_SETTINGS"]="Återseed Inställningar";
$language["RESEED_MIN_SEE"]="Minsta antal seeds";
$language["RESEED_MIN_FIN"]="Minsta antal färdiga";
$language["RESEED_MIN_LEE"]="Minsta antal tankare";
$language["RESEED_MIN_TOR"]="Minst äldre än (dagar)";
$language["RESEED_MIN_REQ"]="Minst dagar sen förfrågan om återseed";
$language["IBD_SETTINGS"]="Intro Före Nerladdning inställningar";
$language["IBD_SELECT_FORUM"]="Välj forum för introduktion";
$language["IBD_SUCCESS_MSG"]="Forum valt. Ställ nu in Vilka klasser som kräver en introduktion innan dom kan ladda ner.<br /><br />Du kan göra detta";
$language["IBD_INTRO_NEEDED"]="Nerladdning kräver Introduktion";
$language["IBD_SELECT_TOPIC"]="Specifikt post id. (Tillval<br />\"0\" = ny post krävs)";
$language["IBD_NEED_BOTH"]="Vänligen ställ in både Forum och Ämnes id!";
$language["IBD_TOPICID_NOT_FOUND"]="Ämnes id hittades inte i angett Forum, Kontrollera och försök igen.";
$language["OASED_SETTINGS"]="E-post Domäns inställningar";
$language["OASED_DOMAINS"]="Tillåtna E-post domäner eg <span style='color:green'>gmail.com</span><br />(En domän per rad)";
$language["NOCOL_SETTINGS"]="Sidokolumn inställningar";
$language["NOCOL_ADD_EXCEPTIONS"]="Sidor som ska visa sido kolumner. Ange delen efter <span style='color:green'>index.php?page=</span> i adressen.<br />Med Exempel<span style='color:green'>index.php?page=userdetails&id=123</span> anger du bara <span style='color:green'>userdetails</span> ensamt<br />(Kan även använda <span style='color:green'>index</span>)";
$language["MAGNET_NO_ENABLE"]="<span style='color:red;font-weight:bold;'>Trackern måste vara public och tillåta DHT För att använda detta.</span>";
$language["MAGNET_LINK_ONLY"]="Visa endast magnet länkar där möjligt<br />(göm torrent nerladdnings länk)";
$language["CSIGN_SETTINGS"]="Tillåtna land inställningar";
$language["CSIGN_SELECT_COUNTRY"]="Välj land att blockera. (Landet<br />blir tillagt härunder automatiskt)";
$language["CSIGN_COUNT_TO_BLOCK"]="Blockerade land (Ett per linje)";
$language["PFET_UPL_EXT"]="Ladda upp Externa Torrents";
$language["PFET_REF_EXT"]="Uppdatera Externa Torrents";
$language["PFET_NO_ENABLE"]="<span style='color:red;font-weight:bold;'>Din tracker måste tillåta externa torrents vid användning av detta.</span>";
$language["SPY_TRUNCATE"]="FÖRSTÖR";
$language["SPY_INFO"]="Vänta";
$language["SPY_INFO_MSG"]="Är du säker på att du vill ta bort allt<br />Låt medlemmarna veta innan du gör det.<br /><a href='index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=ispy&amp;action=flush'>Ja</a>&nbsp;&nbsp;<a href='index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=ispy'>Nej</a>";
$language["SPY_ERR_MSG"]="Borttagning misslyckades!";
$language["SPY_SUCCESS"]="Deletion Process Complete!<br /><a href='index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=ispy'>{$language["BACK"]}</a>";
$language["GALLERY"]="Galleri";
$language["GALLERY_SET"]="Galleri Inställningar";
$language["GALLERY_MFS"]="Max Fil Storlek (Bytes):";
$language["GALLERY_PTH"]="Bild källa:";
$language["GALLERY_GRP"]="Klass Val:";
$language["GALLERY_SEL"]="Vald";
$language["GALLERY_NOL"]="Ej Vald";
$language["SMILE_MENU"]="Smiley Inställningar";
$language["TAG"]="Tag";
$language["SMILE_UPD"]="Uppdaterad!";
$language["SMILE_DLD"]="Borttagen!";
$language["SMILE_IMGER"]="Antingen existerar inte bilden eller du har inte angett tag.";
$language["SMILE_IMGER2"]="Endast bilder kan laddas upp!";
$language["SMILE_MISS"]="Fält saknas!";
$language["SMILE_IMPORT"]="Klicka <a href='index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=smilies&action=import'>här</a> för att importera dina nuvarande smileys.";
$language["SMILE_CURR"]="Nuvarande Smileys";
$language["INTEGRITY_INDEXED"]="Fil Indexering klar!";
$language["INTEGRITY_COMP"]="Test klar Du får ett meddelande via mail över resultatet!";
$language["INTEGRITY_REP"]="Integritets Kontrollrapport";
$language["INTEGRITY_OK"]="Fil strukturen är intakt.";
$language["INTEGRITY_BAD"]="Följande avvikelser hittades:";
$language["INTEGRITY_LAST"]="Senast testat";
$language["INTEGRITY_NOINDEX"]="<span style='color:red;'>Du har inget index än!</span>. Klicka <a href='index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&do=integrity&action=index_now'>här</a> för att indexera din filstruktur!";
$language["INTEGRITY_ALINDEX"]="Du har tidigare indexerat dina filer denna kontroll undersöker avvikelser och skickar en mailrapport!.<br /> Klicka <a href='index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&do=integrity&action=check'>här</a> för att fortsätta";
$language["INTEGRITY_MSG"]="This will catalogue your filebase so then you can check at a later time if any files have been modified<br />
and will alert you if any changes have been made. This is to help incase any files get modified without your<br />
knowledge and you can track them down very easily.<br />
Current Status:<br />";
$language["INTEGRITY_MENU"]="Fil Integritets kontroll";
$language["INTEGRITY_SETUP"]="Fil Integritets inställning";

?>