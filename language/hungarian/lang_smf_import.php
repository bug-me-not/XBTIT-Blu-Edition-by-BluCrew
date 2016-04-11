<?php

// smf_import.php language file

$lang[0]="igen";
$lang[1]="Nem";
$lang[2]="<center><u><strong><font size='4' face='Arial'>1 szint: Alapvető követelmények</font></strong></u></center><br />";
$lang[3]="<center><strong><font face='Arial' size='2'>SMF fájlok meg vannak a \"smf\" könyvtárban?<font color='";
$lang[4]="'>&nbsp;&nbsp;&nbsp; ";
$lang[5]="</font></center></strong>";
$lang[6]="<br /><center>Kérlek töltsd le a legfrissebb verziót <a target='_new' href='http://www.simplemachines.org/download/'>Innen </a> és  töltsd fel az \"smf\" mappába.<br />Ha nincs \"smf\" mappa kérlek hozz létre egyet a root könyvtárban<br />és töltsd fel a tartalmat ebbe.<br /><br />Amint feltöltött p"; // p at end is an lowercase p for use with $lang[8]
$lang[7]="<br /><center>P"; // P at end is an uppercase p for use with $lang[8]
$lang[8]="telepítés SMF by <a target='_new' href='smf/install.php'>klikkelj ide</a>*<br /><br /><strong>*Külön ablakban nyillík meg, tehát nem veszik el a jelenlegi. (Kizárólag azt az adatbázist használd, amit most a tracker telepítéséhez használsz)<br />használhatsz bármilyen adatbázis előképzőt  (kizárólag a előképző használt tracker ahol alkalmazható)<br /><br />";
$lang[9]="<font color='#0000FF' size='3'>Frissítsd fel az oldalad, amint kiegészítetted a kért követelménnyekkel.</font></strong></center>";
$lang[10]="<center><strong>SMF telepítés?<font color='";
$lang[11]="Nem talált fájlt!";
$lang[12]="Fájlt talált, de nem írható!";
$lang[13]="<center><strong>Hibák, alapértelmezett SMF English fájl elérhető és írható?<font color='";
$lang[14]="<center><strong>smf.sql fájl melyik \"sql\" könytárban?<font color='";
$lang[15]="<br /><center><strong>Nyelvi fájl (";
$lang[16]=")<br />hiányzik, kérlek ellenőrizd <font color='#FF0000'><u>minden SMF fájlt</u></font> were uploaded!<br /><br />";
$lang[17]=")<br />nem írható, <font color='#FF0000'><u>kérlek állítsd a fájlt CHMOD 777</u></font><br /><br />";
$lang[18]="<br /><center><strong>smf.sql hiányzik, <font color='#FF0000'><u>Kérlek biztosítsd ezt a fájl, ellenőrizd \"sql\" folder.</u></font><br />(Számolj a XBTIT-tel!)<br /><br />";
$lang[19]="<br /><center>All requirements have been met, please <a href='";
$lang[20]="'>klikk ide a folytatáshoz</a></center>";
$lang[21]="<center><u><strong><font size='4' face='Arial'>2 szint: Kezdő beállítás</font></strong></u></center><br />";
$lang[22]="<center>Most hogy igazoltunk mindent itt az idő, hogy megváltoztassák az adatbázist<br />, hogy hozzon mindent a nyomozóval összhangban.</center><br />";
$lang[23]="<center><form name=\"db_pwd\" action=\"smf_import.php\" method=\"GET\">Adatbázis jelszó újra:&nbsp;<input name=\"pwd\" size=\"20\" /><br />\n<br />\n<strong>kérlek <input type=\"submit\" name=\"confirm\" value=\"yes\" size=\"20\" /> a folytatáshoz</strong><input type=\"hidden\" name=\"act\" value=\"init_setup\" /></form></center>";
$lang[24]="<center><u><strong><font size='4' face='Arial'>3 szint: Tracker tagjainak importálása</font></strong></u></center><br />";
$lang[25]="<center>Most az adatbázis telepítés volt helyesen ez idő, hogy elkezdjék importálni a tracker tagoket,<br />Ez egy kis időt vehet igénybe, ha neked annyira  nagy a tag bázisod, legyél türelmes<br />és engedd meg a szövegkönyvet tenni ez munka!<br /><br /><strong>kérlek <a href='".$_SERVER["PHP_SELF"]."?act=member_import&amp;confirm=yes'>klikk ide</a> a folytatáshoz</center>";
$lang[26]="<center><u><strong><font size='4' face='Arial'>Sajnálom</font></strong></u></center><br />";
$lang[27]="<center>Sajnálom, ettől azt akarják, hogy legyen egy használat egyszer és eldob szövegkönyv és mióta már használtad azt, ezt a fájlt bezárták!</center>";
$lang[28]="<center><br /><strong><font color='#FF0000'><br />";
$lang[29]="</strong></font> Fórum accountod sikeresen elkészült, kérlek <a href='".$_SERVER["PHP_SELF"]."?act=import_forum&amp;confirm=no'>klikk ide</a> a folytatáshoz</center>";
$lang[30]="<center><u><strong><font size='4' face='Arial'> 4 szint: Importált fórum beosztása & üzenetek</font></strong></u></center><br />";
$lang[31]="<center>Ez az utolsó lépés a fórum importálásban, így fogod importálni a jelenlegi BTI fórum helyett egy új SMF,<br />mely egy új kategóriába hív \"My BTI import\",<br />kérlek <a href='".$_SERVER["PHP_SELF"]."?act=import_forum&amp;confirm=yes'>klikk ide</a> a folytatáshoz</center>";
$lang[32]="<center><u><strong><font size='4' face='Arial'>Import kész</font></strong></u></center><br />";
$lang[33]="<center><font face=\"Arial\" size=\"2\">Kérlek <a target='_new' href='smf/index.php?action=login'> lépj be az új smf fórumba</a> és a tracker részleteinél<br /> a <strong>Adminisztrációs központ</strong> válaszd ki <strong>Forum Maintenance</strong> vagy futatod<br /><strong>és megkeresed a hibákat és javítod.</strong> kövesd le és számold <strong>meg minden fórumot<br />és statisztika teljes-e.</strong> megjelölik az importot és kijavítják a hibákat és az együttmüködést az smf fórummal.<br /><br /><strong><font color='#0000FF'>Ha ez meg van és beintegráltad az smf fórumot, akkor kész vagy a használatra.</font></strong></font></center>";
$lang[34]="<center><u><strong><font size=\"4\" face=\"Arial\" color=\"#FF0000\">Hiba!</font></strong></u></center><br />\n<br />\n<center><font face=\"Arial\" size=\"3\">Rosszul gépelted be a jelszót, vay nem te vagy a tracker tulajdonosa!<br />\nKérlek figyelj jobban, mert az IP-d bekerül az oldal naplójába.</font></center>";
$lang[35]="</body>\n</html>\n";
$lang[36]="<center>Képtelen ide írni:<br /><br /><b>";
$lang[37]="</b><br /><br />Kérlek tedd írhatóvá ezt a fájlt, utána próbáld újra!</center>";
$lang[38]="<center><br /><font color=red size=4><b>Hozzáférés megtagadva</b></font></center>";
?>