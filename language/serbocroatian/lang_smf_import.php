<?php

// smf_import.php language file

$lang[0]="Da";
$lang[1]="Ne";
$lang[2]="<center><u><strong><font size='4' face='Arial'>Korak 1: Pocetni Tehnicki Zahtjevi</font></strong></u></center><br />";
$lang[3]="<center><strong><font face='Arial' size='2'>SMF fajlovi prisutni u \"smf\" direktorijumu?<font color='";
$lang[4]="'>&nbsp;&nbsp;&nbsp; ";
$lang[5]="</font></center></strong>";
$lang[6]="<br /><center>Molimo <a target='_new' href='http://www.simplemachines.org/download/'>downloadujte SMF</a> i uploadujte sadrzaj direktorijuma u \"smf\" direktorijum.<br />Ukoliko nemate \"smf\" direktorijum molimo kreirajte jedan u tracker root-u i u njega uploadujte<br />sadrzaj downloadovane arhive.<br /><br />Jednom uploadovano m"; // p at end is an lowercase p for use with $lang[8]
$lang[7]="<br /><center>M"; // P at end is an uppercase p for use with $lang[8]
$lang[8]="olimo instalirajte SMF klikom na <a target='_new' href='smf/install.php'><< ovaj link >></a>*<br /><br /><strong>* Koristite ISTU Bazu Podataka i ISTE detalje prijave za Bazu Podataka koje ste koristili i za Tracker,<br />Prefix stolova Baze Podataka moze biti po vasoj zelji (iskljucujuci prefix koristen od strane<br />trackera)<br /><br />";
$lang[9]="<font color='#0000FF' size='3'>Osvjezite ovu stranicu ukoliko ste komletirali Korak 1!</font></strong></center>";
$lang[10]="<center><strong>SMF instaliran?<font color='";
$lang[11]="Fajl nije pronadjen!";
$lang[12]="Fajl pronadjen ali zapis nije omogucen!";
$lang[13]="<center><strong>Glavni SMF English Errors fajl je dostupan i zapis dozvoljen?<font color='";
$lang[14]="<center><strong>smf.sql fajl je prisutan u \"sql\" direktorijumu?<font color='";
$lang[15]="<br /><center><strong>Jezik fajl (";
$lang[16]=")<br />nedostaje, molimo provjerite <font color='#FF0000'><u>da su svi SMF fajlovi</u></font> uploadovani!<br /><br />";
$lang[17]=")<br />nema dozvolu za zapis, <font color='#FF0000'><u>molimo CHMOD taj fajl u 777</u></font><br /><br />";
$lang[18]="<br /><center><strong>smf.sql nedostaje, <font color='#FF0000'><u>molimo provjerite da je fajl prisutan u \"sql\" direktorijumu.</u></font><br />(Trebao bi biti ukljucen sa XBTIT distribucijom!)<br /><br />";
$lang[19]="<br /><center>Svi tehnicki zahtjevi su zadovoljeni, molimo <a href='";
$lang[20]="'>kliknite ovde da nastavite</a></center>";
$lang[21]="<center><u><strong><font size='4' face='Arial'>Korak 2: Pocetna Instalacija</font></strong></u></center><br />";
$lang[22]="<center>Sada kada znamo da imamo sve potrebno za nastavak, vrijeme je za modifikaciju Baze Podataka<br />i izvrsime integraciju sa trackerom.</center><br />";
$lang[23]="<center><form name=\"db_pwd\" action=\"smf_import.php\" method=\"GET\">Lozinka Baze Podataka:&nbsp;<input name=\"pwd\" size=\"20\" /><br />\n<br />\n<strong>molimo <input type=\"submit\" name=\"confirm\" value=\"yes\" size=\"20\" /> za nastavak</strong><input type=\"hidden\" name=\"act\" value=\"init_setup\" /></form></center>";
$lang[24]="<center><u><strong><font size='4' face='Arial'>Korak 3: Kopiranje tracker naloga</font></strong></u></center><br />";
$lang[25]="<center>Sada kada smo izvrsili integraciju Baze Podataka vrijeme je da kopiramo tracker naloge,<br />Ovo moze potrajati ukoliko imate mnogo korisnickih naloga, stoga molimo vas budite strpljivi i dozvolite<br />skripti da zavrsi svoj posao!<br /><br /><strong>molimo <a href='".$_SERVER["PHP_SELF"]."?act=member_import&amp;confirm=yes'>kliknite ovdje</a> sa nastavite</center>";
$lang[26]="<center><u><strong><font size='4' face='Arial'>Oprostite</font></strong></u></center><br />";
$lang[27]="<center>Oprostite, ovaj skript bi trebao da se iskoristi samo jednom potom obrise i kako ste ga vec koristili mi smo ga zakljucali!</center>";
$lang[28]="<center><br /><strong><font color='#FF0000'><br />";
$lang[29]="</strong></font> Forum nalozi su uspjesno kreirani, molimo <a href='".$_SERVER["PHP_SELF"]."?act=import_forum&amp;confirm=no'>kliknite ovdje</a> da nastavite</center>";
$lang[30]="<center><u><strong><font size='4' face='Arial'>Korak 4: Dodavanje forum izgled i postova</font></strong></u></center><br />";
$lang[31]="<center>Ovo je posljednji korak forum integracije, ovo ce dodati vase trenutne BTI Forume u SMF,<br />i dodani u novu kategoriju zvanu \"My BTI import\",<br />molimo <a href='".$_SERVER["PHP_SELF"]."?act=import_forum&amp;confirm=yes'>kliknite ovdje</a> da nastavite</center>";
$lang[32]="<center><u><strong><font size='4' face='Arial'>Kopiranje kompletno</font></strong></u></center><br />";
$lang[33]="<center><font face=\"Arial\" size=\"2\">Molimo <a target='_new' href='smf/index.php?action=login'>prijavite se na vas novi SMF forum</a> koristeci vase Tracker detalje i posjetite<br />the <strong>Forum Administraciju</strong> zatim odaberite <strong>Odrzavanje Foruma</strong> i pokrenite<br /><strong>Pronadjite i popravite greske za Bazu Podataka.</strong> propraceno sa <strong>prebrojte forum statistike<br />i postove</strong> da malo optimiziramo Bazu Podataka i popravime greske ukoliko ih ima itd.<br /><br /><strong><font color='#0000FF'>Vas integrisani SMF Forum ce tada biti u potpunosti spreman za upotrebu!</font></strong></font></center>";
$lang[34]="<center><u><strong><font size=\"4\" face=\"Arial\" color=\"#FF0000\">ERROR!</font></strong></u></center><br />\n<br />\n<center><font face=\"Arial\" size=\"3\">Ukucali ste netacnu lozinku ili niste Tracker vlasnik!<br />\nVasa IP adresa je zabiljezena za analizu.</font></center>";
$lang[35]="</body>\n</html>\n";
?>