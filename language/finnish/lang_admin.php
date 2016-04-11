<?php
$language["ACP_BAN_IP"]="Bannaa IP osoite";
$language["ACP_FORUM"]="Foorumin asetukset";
$language["ACP_USER_GROUP"]="Käyttäjäryhmien asetukset";
$language["ACP_STYLES"]="Teema-asetukset";
$language["ACP_LANGUAGES"]="Kieliasetukset";
$language["ACP_CATEGORIES"]="Kategoria-asetukset";
$language["ACP_TRACKER_SETTINGS"]="Trakkerin asetukset";
$language["ACP_OPTIMIZE_DB"]="Optimoi tietokantasi";
$language["ACP_CENSORED"]="Sensuroitujen sanojen asetukset";
$language["ACP_DBUTILS"]="Tietokannan lisätyökalut";
$language["ACP_HACKS"]="Hackit";
$language["ACP_HACKS_CONFIG"]="Hackien asetukset";
$language["ACP_MODULES"]="Moduulit";
$language["ACP_MODULES_CONFIG"]="Moduuliasetukset";
$language["ACP_MASSPM"]="Yksityinen massaviesti";
$language["ACP_PRUNE_TORRENTS"]="Poista kuolleet torrentit";
$language["ACP_PRUNE_USERS"]="Poista käyttämättömät tilit";
$language["ACP_SITE_LOG"]="Lue tapahtumalogia";
$language["ACP_SEARCH_DIFF"]="Etsi eroavaisuuksia.";
$language["ACP_BLOCKS"]="Block asetukset";
$language["ACP_POLLS"]="Poll asetukset";
$language["ACP_MENU"]="Admin Paneeli";
$language["ACP_FRONTEND"]="Sisältöasetukset";
$language["ACP_USERS_TOOLS"]="Käyttäjätyökalut";
$language["ACP_TORRENTS_TOOLS"]="Torrent-työkalut";
$language["ACP_OTHER_TOOLS"]="Muut työkalut";
$language["ACP_MYSQL_STATS"]="MySql Statistiikka";
$language["XBTT_BACKEND"]="xbtt Vaihtoehto";
$language["XBTT_USE"]="käytä <a href=\"http://xbtt.sourceforge.net/tracker/\" target=\"_blank\">xbtt</a>  backendina?";
$language["XBTT_URL"]="xbtt base url e.g. http://localhost:2710";
$language["GENERAL_SETTINGS"]="Yleiset asetukset";
$language["TRACKER_NAME"]="Sivuston nimi";
$language["TRACKER_BASEURL"]="Trakkerin osoite (ilman viimeistä /)";
$language["TRACKER_ANNOUNCE"]="Trakkerin announce linkit (yksi osoite per rivi)".($XBTT_USE?"<br />\n<span style=\"color:#FF0000; font-weight: bold;\">Tarkasta announce linkki kahdesti, olet ottanut käyttöön xbtt backendin...</span>":"");
$language["TRACKER_EMAIL"]="Trakkerin sähköpostiosoite";
$language["TORRENT_FOLDER"]="Torrent-Kansio";
$language["ALLOW_EXTERNAL"]="Salli ulkoiset torrentit";
$language["ALLOW_GZIP"]="Salli GZIP";
$language["ALLOW_DEBUG"]="Näytä Debug-tiedot sivun alareunassa";
$language["ALLOW_DHT"]="poista DHT (private flag in torrent)<br />\ntoimii vain uusissa julkaisuissa";
$language["ALLOW_LIVESTATS"]="Salli reaaliaikaiset tilastot (Varoitus!Kuormittaa palvelinta!)";
$language["ALLOW_SITELOG"]="Salli sivuston logaaminen (lLogi muuttuu torrenteissa/käyttäjissä)";
$language["ALLOW_HISTORY"]="Salli historia (torrenteissa/käyttäjissä)";
$language["ALLOW_PRIVATE_ANNOUNCE"]="Yksityinen Announce";
$language["ALLOW_PRIVATE_SCRAPE"]="Yksityinen pikapäivitys";
$language["SHOW_UPLOADER"]="Näytä lähettäjän nick";
$language["USE_POPUP"]="Avaa torrentin tiedot/yhteydet uudessa ikkunassa";
$language["DEFAULT_LANGUAGE"]="Oletuskieli";
$language["DEFAULT_CHARSET"]="Oletus kirjainmerkistö<br />\n(jos kielesi ei näy oikein, kokeile UTF-8)";
$language["DEFAULT_STYLE"]="Oletusteema";
$language["MAX_USERS"]="Maksimi käyttäjämäärä (Numeerinen, 0 = rajoittamaton)";
$language["MAX_TORRENTS_PER_PAGE"]="Torrenttia per sivu";
$language["SPECIFIC_SETTINGS"]="Trakkerin tarkat asetukset";
$language["SETTING_INTERVAL_SANITY"]="Sanityn Päivitysväli (numeric seconds, 0 = disabled)<br />Hyvä arvo, jos sallittu, on 1800 (30 minuuttia)";
$language["SETTING_INTERVAL_EXTERNAL"]="Update External interval (numeric seconds, 0 = disabled)<br />Depending of how many external torrents";
$language["SETTING_INTERVAL_MAX_REANNOUNCE"]="Maximum reannounce interval (numeric seconds)";
$language["SETTING_INTERVAL_MIN_REANNOUNCE"]="Minimum reannounce interval (numeric seconds)";
$language["SETTING_MAX_PEERS"]="Max N. of peers for request (numeric)";
$language["SETTING_DYNAMIC"]="Allow Dynamic Torrents (not recommended)";
$language["SETTING_NAT_CHECK"]="NAT Tarkistus";
$language["SETTING_PERSISTENT_DB"]="Persistent connections (Database, not recommended)";
$language["SETTING_OVERRIDE_IP"]="Allow users to override detected ip";
$language["SETTING_CALCULATE_SPEED"]="Laske ladatut ja lähetetyt bitit";
$language["SETTING_PEER_CACHING"]="Table caches (should decrease a little load)";
$language["SETTING_SEEDS_PID"]="Max num. of seeds with same PID";
$language["SETTING_LEECHERS_PID"]="Maksimimäärä lataajia samalla PIDillä";
$language["SETTING_VALIDATION"]="Hyväksymis muoto";
$language["SETTING_CAPTCHA"]="Turvattu rekisteröinti (use ImageCode, GD+Freetype libraries needed)";
$language["SETTING_FORUM"]="Foruumin linkki, voi olla:<br /><li><font color='#FF0000'>internal</font> tai tyhjä (ei arvoa) sisäiselle foorumille</li><li><font color='#FF0000'>smf</font> integroitu <a target='_new' href='http://www.simplemachines.org'>Simple Machines Foruumi</a></li><li>omana foorumi ratkaisuna (kirjoita linkki laatikkoon)</li>";
$language["BLOCKS_SETTING"]="Etusivun/Bloggien Sivu asetukset";
$language["SETTING_CLOCK"]="Kellon tyyppi";
$language["SETTING_NUM_NEWS"]="Uutisten mä&aumlrä uutisblogissa (numeric)";
$language["SETTING_NUM_POSTS"]="Topikkien määrä foorumiblogissa (numeric)";
$language["SETTING_NUM_LASTTORRENTS"]="Uusien torrenttejen määrä uudet torrentit blogissa (numeric)";
$language["SETTING_NUM_TOPTORRENTS"]="Suosituimpien torrentien määrä blogissa (numeric)";
$language["CLOCK_ANALOG"]="Analoginen";
$language["CLOCK_DIGITAL"]="Digitaalinen";
$language["CONFIG_SAVED"]="Asetukset tallennettu onnistuneesti!";
$language["CACHE_SITE"]="Cache interval (numeric seconds, 0 = disabled)";
$language["ALL_FIELDS_REQUIRED"]="Kaikki kentät pitää täyttää!";
$language["SETTING_CUT_LONG_NAME"]="Leikkaa ylipitkät torrenttien nimet yli x merkkiä (0 = don't cut)";
$language["MAILER_SETTINGS"]="Maileri";
$language["SETTING_MAIL_TYPE"]="Mailin Tyyppi";
$language["SETTING_SMTP_SERVER"]="SMTP Serveri";
$language["SETTING_SMTP_PORT"]="SMTP Portti";
$language["SETTING_SMTP_USERNAME"]="SMTP käyttäjänimi";
$language["SETTING_SMTP_PASSWORD"]="SMTP Salasana";
$language["SETTING_SMTP_PASSWORD_REPEAT"]="SMTP Salasana (Toista)";
$language["XBTT_TABLES_ERROR"]="You should have to import xbtt tables (look at xbtt installation instructions) into your database before activate xbtt backend!";
$language["XBTT_URL_ERROR"]="xbtt base url is mandatory!";
// BAN FORM
$language["BAN_NOTE"]="tämä on osa admin paneelia, Näet täällä bannatut IPt ja voit bannata uusia .<br />\nSinun pitää antaa alue (ensimmäinen IP) alue (viimeinen IP).";
$language["BAN_NOIP"]="Ei bannattuja IP-osotteita";
$language["BAN_FIRSTIP"]="Ensimmäinen IP";
$language["BAN_LASTIP"]="Viimeinen IP";
$language["BAN_COMMENTS"]="Kommentit";
$language["BAN_REMOVE"]="Poista";
$language["BAN_BY"]="Tehnyt";
$language["BAN_ADDED"]="Päivämäärä";
$language["BAN_INSERT"]="Syötä uusi IP alue";
$language["BAN_IP_ERROR"]="Huono IP Osoite.";
$language["BAN_NO_IP_WRITE"]="Et ole antanut IP osoitetta. Valitan!";
$language["BAN_DELETED"]="IP alue poistettu tietokannasta.<br />\n<br />\n<a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=banip&amp;action=read\">Go back to Ban IP</a>";
// LANGUAGES
$language["LANGUAGE_SETTINGS"]="Kieli asetukset";
$language["LANGUAGE"]="Kieli";
$language["LANGUAGE_ADD"]="Lisää uusi kieli";
$language["LANGUAGE_SAVED"]="Onneksi olkoon, Kieli muokattu";
// STYLES
$language["STYLE_SETTINGS"]="Tyyli/Teema asetukset";
$language["STYLE_EDIT"]="Editoi teemaa";
$language["STYLE_ADD"]="Syötä uusi teema";
$language["STYLE_NAME"]="Tyylin nimi";
$language["STYLE_URL"]="Tyylin URL";
$language["STYLE_FOLDER"]="Teemojen kansio ";
$language["STYLE_NOTE"]="täällä voit hallita teemojasi, Mutta sinun pitää tuoda ne palvelimelle joko ftp tai sftp.";
// CATEGORIES
$language["CATEGORY_SETTINGS"]="Kategoria asetukset";
$language["CATEGORY_IMAGE"]="Kategoria kuvake";
$language["CATEGORY_ADD"]="Syötä uusi kategoria";
$language["CATEGORY_SORT_INDEX"]="Järjestä sisältö";
$language["CATEGORY_FULL"]="Kategoria";
$language["CATEGORY_EDIT"]="Editoi Kategoriaa";
$language["CATEGORY_SUB"]="Alakategoria";
$language["CATEGORY_NAME"]="Kategoria";
// CENSORED
$language["CENSORED_NOTE"]="Kirjoita <b>yksi sana per rivi</b> sensuroidaksesi se (Sana korvataan *censored*)";
$language["CENSORED_EDIT"]="Editoi sensuroituja sanoja";
// BLOCKS
$language["BLOCKS_SETTINGS"]="Blokkien säätö";
$language["ENABLED"]="Enabled";
$language["ORDER"]="Järjestys";
$language["BLOCK_NAME"]="Blokin nimi";
$language["BLOCK_POSITION"]="Paikka";
$language["BLOCK_TITLE"]="Kielen nimi (will be used to display the translated title)";
$language["BLOCK_USE_CACHE"]="Cache this block?";
$language["ERR_BLOCK_NAME"]="You must select one of the enabled file in the name's dropdown!";
$language["BLOCK_ADD_NEW"]="Lisää uusi blokki";
// POLLS (more in lang_polls.php)
$language["POLLS_SETTINGS"]="Pollin Säädöt";
$language["POLLID"]="Pollin ID";
$language["INSERT_NEW_POLL"]="Lisää uusi Polli";
$language["CANT_FIND_POLL"]="Pollia ei löydy";
$language["ADD_NEW_POLL"]="Lisää Polli";
// GROUPS
$language["USER_GROUPS"]="Käyttäjäryhmä asetukset (Klikkaa ryhmän nimeä muokataksesi.)";
$language["VIEW_EDIT_DEL"]="Katso/Muokkaa/Poista";
$language["CANT_DELETE_GROUP"]="Tätä arvoa/Ryhmää ei voi peruuttaa!";
$language["GROUP_NAME"]="Ryhmän nimi";
$language["GROUP_VIEW_NEWS"]="Katso uutiset";
$language["GROUP_VIEW_FORUM"]="Katso foorumi";
$language["GROUP_EDIT_FORUM"]="Muokkaa Foorumia";
$language["GROUP_BASE_LEVEL"]="Valitse aloituspohja";
$language["GROUP_ERR_BASE_SEL"]="Virhe aloituspohjan kanssa!";
$language["GROUP_DELETE_NEWS"]="Poista uutisia";
$language["GROUP_PCOLOR"]="Prefix Color (like ";
$language["GROUP_SCOLOR"]="Suffix Color (like ";
$language["GROUP_VIEW_TORR"]="Katso torrentteja";
$language["GROUP_EDIT_TORR"]="Editoi Torrentteja";
$language["GROUP_VIEW_USERS"]="Katso käyttäjiä";
$language["GROUP_DELETE_TORR"]="Poista torrentteja";
$language["GROUP_EDIT_USERS"]="Muokkaa käyttäjiä";
$language["GROUP_DOWNLOAD"]="Voi ladata";
$language["GROUP_DELETE_USERS"]="Poistaa käyttäjiä";
$language["GROUP_DELETE_FORUM"]="Poistaa foorumia";
$language["GROUP_GO_CP"]="Oikeus admin paneeliin";
$language["GROUP_EDIT_NEWS"]="Muokkaa uutisia";
$language["GROUP_ADD_NEW"]="Lisää uusi ryhmä";
$language["GROUP_UPLOAD"]="Voi lähettää";
$language["GROUP_WT"]="Odotus aika jos ratio <1";
$language["GROUP_EDIT_GROUP"]="Muokkaa ryhmää";
$language["GROUP_VIEW"]="Katsoa";
$language["GROUP_EDIT"]="Muokata";
$language["GROUP_DELETE"]="Poistaa";
$language["INSERT_USER_GROUP"]="Syötä uusi käyttäjäryhmä";
$language["ERR_CANT_FIND_GROUP"]="Ei löydy tätä käyttäjäryhmää!";
$language["GROUP_DELETED"]="Käyttäjäryhmä poistettu!";
// MASS PM
$language["USERS_FOUND"]="Käyttäjiä löytyi";
$language["USERS_PMED"]="Kättäjät jolle PM lähti";
$language["WHO_PM"]="Kenelle PM lähetetään?";
$language["MASS_SENT"]="Massa PM lähetetty!!!";
$language["MASS_PM"]="Massa PM";
$language["MASS_PM_ERROR"]="Kirjoita jotain ennen kuin lähetät!!!!";
$language["RATIO_ONLY"]="Vain tämä ratio";
$language["RATIO_GREAT"]="Ratio suurempi kuin";
$language["RATIO_LOW"]="Ratio pienempi kuin";
$language["RATIO_FROM"]="Keneltä";
$language["RATIO_TO"]="Kenelle";
$language["MASSPM_INFO"]="Tiedot";
// PRUNE USERS
$language["PRUNE_USERS_PRUNED"]="kuolleet käyttäjätilit";
$language["PRUNE_USERS"]="Poista käyttämättömiä käyttäjiä";
$language["PRUNE_USERS_INFO"]="Syötä päivien lukumäärä jolloin niitä pidetään \"kuolleina\" (not connected from x days OR has signed from x days and still validating)";
// SEARCH DIFF
$language["SEARCH_DIFF"]="Etsi eroavaisuuksia.";
$language["SEARCH_DIFF_MESSAGE"]="Viesti";
$language["DIFFERENCE"]="Eroavaisuus";
$language["SEARCH_DIFF_CHANGE_GROUP"]="Vaihda käyttäjäryhmää";
// PRUNE TORRENTS
$language["PRUNE_TORRENTS_PRUNED"]="Kuolleet torrentit";
$language["PRUNE_TORRENTS"]="Poista kuolleita torrentteja";
$language["PRUNE_TORRENTS_INFO"]="Syötä päivien lukumäärä jolloin niitä pidetään  \"kuolleina\"";
$language["LEECHERS"]="lataaja(ia)";
$language["SEEDS"]="Lähettäjä(iä)";
// DBUTILS
$language["DBUTILS_TABLENAME"]="Taulun nimi";
$language["DBUTILS_RECORDS"]="Tallenteet";
$language["DBUTILS_DATALENGTH"]="Datan pituus";
$language["DBUTILS_OVERHEAD"]="Overhead";
$language["DBUTILS_REPAIR"]="korjaa";
$language["DBUTILS_OPTIMIZE"]="Optimoi";
$language["DBUTILS_ANALYSE"]="Analysoi";
$language["DBUTILS_CHECK"]="Tarkista";
$language["DBUTILS_DELETE"]="Poista";
$language["DBUTILS_OPERATION"]="Toiminto";
$language["DBUTILS_INFO"]="Info";
$language["DBUTILS_STATUS"]="Tila";
$language["DBUTILS_TABLES"]="Taulut";
// MYSQL STATUS
$language["MYSQL_STATUS"]="MySQL Tila";
// SITE LOG
$language["SITE_LOG"]="Sivun logi";
// FORUMS
$language["FORUM_MIN_CREATE"]="Min käyttäjäluokka voi luoda";
$language["FORUM_MIN_WRITE"]="Min Käyttäjä luokka voi kirjottaa";
$language["FORUM_MIN_READ"]="Min käyttäjäluokka voi lukea";
$language["FORUM_SETTINGS"]="Foorumin asetukset";
$language["FORUM_EDIT"]="Muokkaa foorumia";
$language["FORUM_ADD_NEW"]="Lisää uusi foorumi";
$language["FORUM_PARENT"]="Pääfoorumi";
$language["FORUM_SORRY_PARENT"]="(Pääfoorumilla ei voi olla pääfoorumia.)";
$language["FORUM_PRUNE_1"]="Tällä foorumilla on postauksia sekä topikkeja!<br />Kaikki tiedot menetetään...<br />";
$language["FORUM_PRUNE_2"]="Jos olet varma että haluat peruuttaa tämän foorumin";
$language["FORUM_PRUNE_3"]="Muuten mene takaisin.";
$language["FORUM_ERR_CANNOT_DELETE_PARENT"]="Et voi poistaa foorumia millä on alafoorumeita, siirrä/poista alafoorumit ja yritä uudelleen";
// MODULES
$language["ADD_NEW_MODULE"]="Lisää uusi Moduuli";
$language["TYPE"]="Tyyppi";
$language["DATE_CHANGED"]="päivämäärä koska muokattu";
$language["DATE_CREATED"]="Päivämäärä koska luotu";
$language["ACTIVE_MODULES"]="Aktiiviset Moduulit: ";
$language["NOT_ACTIVE_MODULES"]="Ei-aktiiviset Moduulit: ";
$language["TOTAL_MODULES"]="Kaikki Moduulit: ";
$language["DEACTIVATE"]="Deaktivoi";
$language["ACTIVATE"]="Aktivoi";
$language["STAFF"]="Staff";
$language["MISC"]="Miscellaneous";
$language["TORRENT"]="Torrentti";
$language["STYLE"]="Tyyli";
$language["ID_MODULE"]="ID";
//FM
// HACKS
$language["HACK_TITLE"]="Aihe";
$language["HACK_VERSION"]="Versio";
$language["HACK_AUTHOR"]="Lisännyt";
$language["HACK_ADDED"]="Lisätty";
$language["HACK_NONE"]="Ei ole asennettuja Hackkeja";
$language["HACK_ADD_NEW"]="Lisää uusi Hackki";
$language["HACK_SELECT"]="Valitse";
$language["HACK_STATUS"]="Tila";
$language["HACK_INSTALL"]="Asenna";
$language["HACK_UNINSTALL"]="Poista asennus";
$language["HACK_INSTALLED_OK"]="Hackki asennettu onnistuneesti!<br />\nNähdäksesi mitkä hackit on asennettu mene takaisin <a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=hacks&amp;action=read\">adminCP (Hacks)</a>";
$language["HACK_BAD_ID"]="Virhe haettaessa tietoja hackista tällä IDllä.";
$language["HACK_UNINSTALLED_OK"]="Hackki poistettu onnistuneesti!<br />\nNähdäksesi mitkä hackit on asennettu mene takaisin <a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=hacks&amp;action=read\">adminCP (Hacks)</a>";
$language["HACK_OPERATION"]="Toiminto";
$language["HACK_SOLUTION"]="Ratkaisu";
// USERS TOOLS
$language["USER_NOT_DELETE"]="Et voi poistaa vierasta tai itseäsi!";
$language["USER_NOT_EDIT"]="Et voi muokata itseäsi tai vierasta!";
//HIT&RUN Settings
$language["ACP_HITRUN"]="Hit & Run Asetukset";
$language["HNR_BLOCK_SETTINGS"] = "Hit & Run Block Asetukset";
$language["HNR_SCROLLING_TEXT"] = "Liikkuva teksti";
$language["HNR_COUNT"] = "Monta Hit & Runneria listataan";
$language["HNR_ERR_1"] = "Et voi tehdä kahta sääntÃ¶Ã¤ yhdelle käyttäjäryhmälle!";
$language["HNR_ACTIVE"] = "AKtiivinen";
$language["HNR_SEEDTIME"] = "Seeding Time";
$language["HNR_BANUSER"] = "Ban User";
$language["HNR_ID_LEVEL"] = "id_level kÃ¤yttÃ¤jÃ¤ryhmÃ¤lle jolle haluat sÃ¤Ã¤nnÃ¶n luoda:";
$language["HNR_DOWN_TRIG"] = "torrentin koko vÃ¤hintÃ¤Ã¤n (MB) jotta botti voi hoitaa sanktiot:";
$language["HNR_RATIO_TRIG"] = "Ratio vÃ¤hintÃ¤Ã¤n jotta botti ei varoita tai tekee varoituksen poiston:";
$language["HNR_MIN_SEED"] = "Jakoaika vÃ¤hintÃ¤Ã¤n (tunteja) jotta sÃ¤Ã¤styy varoitukselta:";
$language["HNR_TOLERANCE"] = "Anteeksi annetut pÃ¤ivÃ¤t (PÃ¤ivÃ¤t jotka botti antaa anteeksi ennen varoitusta):";
$language["HNR_UL_PUNISH"] = "Uploadin mÃ¤Ã¤rÃ¤ (MB) Joka sakotetaan kÃ¤yttÃ¤jÃ¤ltÃ¤ hit&runin tehdessÃ¤:";
$language["HNR_REW_SYS"] = "Sakon palautus - Palautetaan sakotettu mÃ¤Ã¤rÃ¤ jos kÃ¤yttÃ¤jÃ¤ palaa hoitamaan vaaditut kriteerit:";
$language["HNR_WARN_BRIDGE"] = "Otetaan kÃ¤yttÃ¶Ã¶n varoituslakki jotta muut kÃ¤yttÃ¤jÃ¤t nÃ¤kevÃ¤t HIT&RUNerin:";
$language["HNR_DAYS"] = "PÃ¤ivÃ¤Ã¤";
$language["HNR_FOR"] = "KestÃ¤Ã¤";
$language["HNR_AFTER"] = "JÃ¤lkeen";
$language["HNR_WARNINGS"] = "Varoituksen";
$language["HNR_BOOT_BRIDGE"] = "KÃ¤ytetÃ¤Ã¤n kÃ¤yttÃ¤jÃ¤n hetkellistÃ¤ BAN toimintoa HIT&RUNissa:";
$language["HNR_BOOT_USER"] = "Jos kÃ¤ytÃ¶ssÃ¤ kÃ¤yttÃ¤jÃ¤ bannitaan:";
$language["HNR_NEW_GROUP"] = "LisÃ¤Ã¤ uusi ryhmÃ¤";
$language["HNR_ID_LEVEL"] = "ID Level";
$language["HNR_USERGROUP"] = "KÃ¤yttÃ¤jÃ¤ryhmÃ¤";
$language["HNR_MIN_DOWN"] = "VÃ¤himmÃ¤islataus (mb)";
$language["HNR_MIN_RAT"] = "VÃ¤himmÃ¤is Ratio";
$language["HNR_MIN_ST"] = "Jakoaika vÃ¤hintÃ¤Ã¤n(tuntia)";
$language["HNR_TOL_DAYS"] = "Anteeksi annetut pÃ¤ivÃ¤t";
$language["HNR_UL_PUN"] = "Upload Sakko(mb)";
$language["HNR_REW"] = "Sakonpalautus";
$language["HNR_WS"] = "varoitus Symboli";
$language["HNR_FD"] = "Moneksi pÃ¤ivÃ¤ksi";
$language["HNR_WIB"] = "Ban varoituksen jÃ¤lkeen";
$language["HNR_WT"] = "Varoituskertojen ennen ban";
$language["HNR_BU"] = "Bannaa kÃ¤yttÃ¤jiÃ¤";
//INVITATION SYSTEM
$language['ACP_INVITATION_SYSTEM']='Kutsujärjestelmä';
$language['ACTIVE_INVITATIONS']='Aktivoi kutsujärjestelmä:';
$language['PRIVATE_TRACKER']='Yksityinen sivusto';
$language['PRIVATE_TRACKER_INFO']='Suojaa lisäämään, Kun laitat sivuston  "YKSITYINEN",<br />"MAX käyttäjämäärä" Vaihdetaan olemaan "1".';
$language['ACP_INVITATIONS']='kutsut';
$language['VALID_INV_MODE']='Kutsujan vahvistus vaaditaan';
$language['INVITE_TIMEOUT']='Kutsujen kuoletus<br />( päivissä )';
$language['INVITED_BY']='Kutsunut';
$language['SENT_TO']='Lähetetty';
$language['DATE_SENT']='Lähetyspäivämäärä';
$language['INV_WELCOME']='Tervetuloa kutsujärjestelmän hallintaan.<br />Aktivoimalla tämän<br />Estetään käyttäjiä luomasta tilejä ilman kutsuja.';
$language['HASH']='Hash';
$language['VALID_INV_MODE']='Vahvistus vaaditaan';
$language['VALID_INV_EXPL']='<i>Kutsujan pitää vahvistaa kutsutun tili</i>';
$language['INVITE_TIMEOUT']='Kutsujen kuoletus<br />( Päivissä )';
$language['GIVE_INVITES_TO']='Anna kutsuja';
$language['NUM_INVITES']='Kutsujen määrä';
$language['INVITES_SETTINGS']='Asetukset';
$language['INVITES_LIST']='Kutsu lista';
$language['SENDINV_CONFIRM']='Haluatko varmasti lähettää tämän kutsun?';
$language['ERR_SENDINVS']='Ole hyvä, ja valitse käyttäjänimi tai arvo.';
$language['SENDINV_EXPL']='Jos käyttäjänimeä ei syötetty, Annetaan kutsut arvolle joka on valittu.';
$language['RECYCLE_DATE']='Kierto periodi';
$language['RECYCLE_EXPL']='<i>Periodi <u>Pävissä</u> Jonka jälkeen kutsut kierrätetään</i>';
$language["ACP_FM_HACK_CONFIG"]='FM Hackien Asetukset';
$language["ACP_NO_HACKS_ENABLED"]='Ei hackeja käytössä';
$language['HACK_INFO']='Aktivoi ja disabloi hackeja täällä.<br /><br /><b>Please note you cannot disable a prerequisite hack if the parent hack is still enabled.</b> Please hover your mouse over the <img src="images/info.png"> images below to find out what the parent hack is.';
$language['HACK_ENABLED']='Aktiivinen';
$language['HACK_DISABLED']='Disabloitu';
$language['SUBMIT'] = 'Vahvista';
$language['PRE_OF'] = 'Prerequisite of';



$language["ACP_SEEDBONUS"]="SeedBonus Asetukset";
$language["BONUS"]="Pistettä per tunti";
$language["PRICE_VIP"]="Hinta VIP arvolle";
$language["PRICE_CT"]="Hinta CustomTittelille";
$language["PRICE_NAME"]="Hinta käyttäjänimen vaihdolle";
$language["PRICE_GB"]="Hinta GB";
$language["POINTS"]="Pistettä";
$language["SEEDBONUS_UPDATED"]="SeedBonus Asetukset päivitetty";


// Donation History by DiemThuy -->
$language['ACP_DON_HIST']='Lahjoitushistoria';
$language['ACP_DON_HIST_SET']='Lahjoitushistoria asetukset';
$language['ACP_UNITS'] = 'Units';
$language['ACP_USE_AUTO_PM'] = 'Käytä automaattista yksityisviestiä';
$language['ACP_THANK_PM_TEXT'] = 'Kiitoslahjoituksesta PM Teksti';
$language['ACP_DONATION'] = 'Lahjoitus';
$language['ACP_AMOUNT'] = 'Summa';
$language['ACP_USERNAME'] = 'Käyttäjänimi';
$language['ACP_EDIT_DON'] = 'Muokkaa lahjoituksia';
$language['ACP_NONE_YET'] = 'Ei vielä';
$language['ACP_SHORT_DON'] = 'Lahj.';
// <-- Donation History by DiemThuy
// Advanced Auto Donation System by DiemThuy -->
$language['ACP_DONATE']='VIP & Lahjoitus asetukset';
$language['AADS_NOTHING'] = 'Ei ole';
$language['AADS_HERE'] = 'täällä';
$language['AADS_YET'] = 'vielä';
$language['AADS_YES'] = 'Kyllä';
$language['AADS_NO_TIMED_RANK'] = 'Ei väliaikaista arvoa';
$language['AADS_NO_OLD_RANK'] = 'ei vanhaa arvoa';
$language['AADS_NO_UPLOAD'] = 'ei uploadia';
$language['AADS_NO'] = 'Ei';
$language['AADS_DEM_PRO'] = 'alentamis suoja';
$language['AADS_PP_INFO'] = 'tarvitset PayPal Business tilin ja IPN enabled PayPal profiilistasi jotta tämä toimii!!';
$language['AADS_MODE'] = 'Testaus vai aito';
$language['AADS_UNITS'] = 'määrä';
$language['AADS_VIP_TRACKER'] = 'VIP arvon ID';
$language['AADS_VIP_SMF'] = 'VIP arvo ID SMF';
$language['AADS_PP_SAND_MAIL'] = 'Sandbox Email';
$language['AADS_PP_MAIL'] = 'PayPal Email';
$language['AADS_VIP_DAYS'] = '1 Euro/Dollari = .. Vip Päivät';
$language['AADS_GB_AMT'] = '1 Euro/Dollari = .. GB';
$language['AADS_NEEDED'] = 'Tarvitaan';
$language['AADS_RECEIVED'] = 'Saatu';
$language['AADS_NUM_NO_POINTS'] = '(Numeerinen) Ei pisteitä';
$language['AADS_DUE_DATE'] = 'Maksettava mennessä';
$language['AADS_DUE_DATE_VALUE'] = '31/01/10';
$language['AADS_NUM_DON'] = 'Lahjoittajien määrä blockissa';
$language['AADS_SC_BL_TEXT'] = 'Liikkuva block teksti';
$language['AADS_EN_SC_LINE'] = 'Aktivoi liikkuva teksti';
$language['AADS_DON_HIST_BR'] = 'Lahjoitushistorian silta';
$language['AADS_SIM_DON_DISP_BR'] = 'Yksinkertainen lahjoittaja silta';
$language['AADS_VIP'] = 'VIP';
$language['AADS_LNAME'] = 'Sukunimi';
$language['AADS_DDATE'] = 'Lahjoitus päivämäärä';
$language['AADS_VIP_BET'] = 'VIP välille';
$language['AADS_VIP_DAYS'] = 'VIP Per yksikkö';
$language['AADS_GB_BET'] = 'GB välille';
$language['AADS_GB_PER_UNIT'] = 'GB per yksikkö';
$language['AADS_AND_UP'] = 'Uploadisi on';
$language['AADS_UNITS_IS'] = 'Yksiköt ovat';
// <-- Advanced Auto Donation System by DiemThuy

//GOLD
$language["ACP_GOLD"]="GOLD torrent asetukset";
$language['ACP_FREECTRL']='FreeLeech asetukset';
$language['FL_INFO'] = 'FreeLeech, Jos aktiivinen (myös uudet torrentit) olevat FreeLeech(vapaalataus), ladatut tavut eivät tallennu tietokantaan. (vain lähetetyt)';
$language['FL_DTE'] = 'Päättymis päivämäärä';
$language['FL_DATE_FORMAT'] = '[0000-00-00][Vuosi/KK/Päivä] Pitää olla tässä formaatissa';
$language['FL_TTE'] = 'Päättymis kellonaika';
$language['FL_HOUR_FORMAT'] = '[00] Pitää olla tasatunti';
$language['FL_ENABLE'] = 'Aktivoi';
$language['FL_HAPPY_HOUR'] = 'Happy Hour, jos aktivoitu niin vuorokaudessa yksi tunti on vapaalatausta';
$language['FL_EN_HAPPY_HOUR'] = 'Aktivoi Happy Hour';


$language["IMAGE_SETTING"]="Kuva asetukset";
$language["ALLOW_IMAGE_UPLOAD"]="Salli kansien lähettäminen";
$language["ALLOW_SCREEN_UPLOAD"]="Salli kuvakaappausten lähetys";
$language["IMAGE_UPLOAD_DIR"]="kuvien tallennushakemisto";
$language["FILE_SIZELIMIT"]="Kuvan maksimi koko";
//AUTORANK
$language["ACP_AUTORANK"] = "Automaattisenarvon hallinta";
$language["AUTORANK_INVALID"] = "Virheellinen arvo, Ole hyvä ja anna arvo 1 väliltä 23";
$language["AUTORANK_MAIN_1"] = "Vältääkseen kuormaa järjestelmä skannaa käyttäjiä jotka ovat yhdistyneinä torrentteihin sekalaisesti. Koko käyttäjäkanta skannataan kerran 24tunnissa jonka aika sinun pitää antaa tähän.<br /><br /><b>Huomio:</b> Aika kannattaa määrittää niin ettei se ole pahin ruuhka-aika sivustolla mutta myös niin että siellä on käyttäjiä paikalla,muuten ne saattavat jäädä pois kierrosta.<br /><br />Toimivat arvot ovat 0-23 (0 = Keskiyö, 1 = 1:00aamlla, 5=5:00aamulla, 14=2:00iltapäivällä Jne.)";
$language["AUTORANK_MAIN_2"] = "Täyden skannauksen aika";
$language["AUTORANK_MAIN_3"] = "Voit asettaa muut arvot";
$language["AUTORANK_MAIN_4"] = "täällä";
$language["ACP_BOOTED"]="Aikabannatut käyttäjät";
			$language["ACP_BOOTED_NM"]="Käyttäjänimi";
$language["ACP_BOOTED_EXP"]="Päättymisaika";
$language["ACP_BOOTED_REA"]="Ban syy";
$language["ACP_BOOTED_WHO"]="Ban Antoi";

// --------> modpanel
$language['ACP_MODPANEL']='StaffPaneelin Asetukset';
$language['MODCP_SECTION']='Kohta (Se kohta jonka haluat sallia mod/admin, se\ do=xxxx osa linkistä):';
$language['MODCP_DESC']='Määritelmä (Jos et käytä kielitiedostoja, Käytetään annettua teksiä, Muuten käytä kieli tiedostoa. Esim: Laitat "ACP_BAN_IP" se \Näkyy "'.$language['ACP_BAN_IP'].'" ):';
$language['MODCP_URL']='LINKKI (Linkki haluttuun osioon, {uid} Korvataan linkkiin käyttäjän UIDin tialle\ kuten myös {ucode} Esim: linkki  banip On seuraavasti http://localhost/xbtit/index.php?page=admin&user={uid}&code={ucode}&do=category&action=read):';
$language['MODCP_NEWSECTION']='Lisää uusi osio';
$language['NO_SECTION_ACCESS']='Ei\ Pääsyä tähän osioon.';
// --------> modpanel



//RULES
$language["ACP_RULES_GROUP"]="Sääntöryhmät";
$language["ACP_RULES"]="Säännöt";

?>