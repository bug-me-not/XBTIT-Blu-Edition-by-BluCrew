<?php

if(!isset($_GET["smf_typ"]))
    $_GET["smf_typ"]="";

// smf_import.php language file

$lang[0]='Ja';
$lang[1]='Nej';
$lang[2]='<center><u><strong><font size="4" face="Arial">Steg 1: Initiala krav</font></strong></u></center><br />';
$lang[3]='<center><strong><font size="2" face="Arial">SMF-filer i "smf"-mappen?<font color="';
$lang[4]='">&nbsp;&nbsp;&nbsp; ';
$lang[5]='</font></center></strong>';
$lang[6]='<br /><center>Vänligen <a target="_new" href="http://www.simplemachines.org/download/">ladda ner SMF</a> och ladda upp innehållet i arkivet till "smf"-mappen.<br />Om du inte har en "smf"-mapp, skapa en i tracker rooten och ladda upp<br />innehållet i arkivet till den.<br /><br />Uppladdad en gång p'; // p at end is a lowercase p for use with $lang[8]
$lang[7]='<br /><center>P'; // P at end is an uppercase p for use with $lang[8]
$lang[8]='Installera SMF med <a target="_new" href="smf/install.php">clicking here</a>*<br /><br /><strong>* Använd samma login som för trackern,<br />Använd vilket databasprefix som önskas (använd inte prefix som används av<br />tillämplig tracker)<br /><br />';
$lang[9]='<font color="#0000FF" size="3">Ladda om sidan när du gjort klar uppgiften!</font></strong></center>';
$lang[10]='<center><strong>SMF installerad?<font color="';
$lang[11]='Filen kunde inte hittas!';
$lang[12]='Filen hittades, men det inte att skriva till den!';
$lang[13]='<center><strong>Standard english Errors file finns tillgänglig och är skrivbar?<font color="';
$lang[14]='<center><strong>smf.sql fil finns i "sql"-mappen?<font color="';
$lang[15]='<br /><center><strong>Språkfil (';
$lang[16]=')<br />saknas, se till att <font color="#FF0000"><u>alla SMF-filer</u></font> laddades upp!<br /><br />';
$lang[17]=')<br />är inte skrivbar, <font color="#FF0000"><u>vänligen CHMOD denna fil till 777</u></font><br /><br />';
$lang[18]='<br /><center><strong>smf.sql saknas, <font color="#FF0000"><u>kontrollera att denna fil är tillgänglig i "sql" folder.</u></font><br />(Den bör vara inkluderad med XBTIT distributionen!)<br /><br />';
$lang[19]='<br /><center>Alla krav är uppfyllda, vänligen <a href="';
$lang[20]='">klicka här för att fortsätta</a></center>';
$lang[21]='<center><u><strong><font size="4" face="Arial">Steg 2: Initial Setup</font></strong></u></center><br />';
$lang[22]='<center>När allt nu är verifierat att allt är på plats, är det dags att modifiera databasen<br />så allt blir i överensstämmelse med trackern.</center><br />';
$lang[23]='<center><form name="db_pwd" action="smf_import.php" method="GET">Enter Database password:&nbsp;<input name="pwd" size="20" /><br />'."\n".'<br />'."\n".'<strong>please click <input type="submit" name="confirm" value="yes" size="20" /> to proceed</strong><input type="hidden" name="act" value="init_setup" /><input type="hidden" name="smf_type" value="'.$_GET["smf_type"].'" /></form></center>';
$lang[24]='<center><u><strong><font size="4" face="Arial">Steg 3: Importera trackermedlemmarna</font></strong></u></center><br />';
$lang[25]='<center>När databasen är korrekt uppsatt, är det dags att börja importera trackermedlemmarna,<br />Det här kan ta lite tid, så ha tålamod och<br />låt scriptet arbeta i lugn och ro!<br /><br /><strong>please <a href="'.$_SERVER['PHP_SELF'].'?act=member_import&amp;confirm=yes&smf_type='.$_GET["smf_type"].'">Klicka här</a> för att fortsätta</center>';
$lang[26]='<center><u><strong><font size="4" face="Arial">Ledsen</font></strong></u></center><br />';
$lang[27]='<center>Ledsen, det här är avsett att användas endast en gång. Eftersom du redan har använt det, så har den här filen låsts!</center>';
$lang[28]='<center><br /><strong><font color="#FF0000"><br />';
$lang[29]='</strong></font> Forumkonton har framgångsrikt skapats, vänligen <a href="'.$_SERVER['PHP_SELF'].'?act=import_forum&amp;confirm=no&smf_type='.$_GET["smf_type"].'">Klicka här</a> för att fortsätta</center>';
$lang[30]='<center><u><strong><font size="4" face="Arial">Steg 4: Importera forumlayout och poster</font></strong></u></center><br />';
$lang[31]='<center>detta är det sista steget i forumimporten och det kommer importera dina nuvarande BTI-forum till SMF,<br />De importeras till en ny kategori som heter "Mina BTI-importer",<br />please <a href="'.$_SERVER['PHP_SELF'].'?act=import_forum&amp;confirm=yes&smf_type='.$_GET["smf_type"].'">Klicka här</a> för att fortsätta</center>';
$lang[32]='<center><u><strong><font size="4" face="Arial">Importen klar</font></strong></u></center><br />';
$lang[33]='<center><font face="Arial" size="2">Please <a target="_new" href="smf/index.php?action=login">Logga in på ditt nya SMF-forum</a> använd dina trackeruppgifter<strong>*</strong> och gå till<br />the <strong>Administration Center</strong> välj sedan <strong>Forumunderhåll</strong> och kör<br /><strong>Sök och reparera eventuella fel</strong> följt av <strong>Räkna om alla forums totaler<br />och statistik</strong> för att snygga till importen och ordna posträkningssystemet, etc.<br /><br /><strong><font color="#0000FF">Ditt integrerade SMF-forum är sedan klart att använda!</font></strong><br /><br /><strong>* Om du använder någon annan metod än xbtit Classic lösenord hashing method i the Security Suite måste du (och alla medlemmar) logga in på trackern för att återställa SMF-lösenordet. (Alternativt går det att använda Password Recovery på SMF men det är mycket bättre att göra det via tracker login så att man får samma lösenord på båda kontona.)</strong></font></center>';
$lang[34]='<center><u><strong><font size="4" face="Arial" color="#FF0000">FEL!</font></strong></u></center><br />'."\n".'<br />'."\n".'<center><font face="Arial" size="3">Du har skrivit fel lösenord, eller du är inte ägare till denna tracker!<br />'."\n".'Observera att ditt IP har loggats.</font></center>';
$lang[35]='</body>'."\n".'</html>'."\n";
$lang[36]='<center>Det gick inte att skriva till:<br /><br /><b>';
$lang[37]='</b><br /><br />Var god se till att denna fil är skrivbar och kör sedan scriptet igen.</center>';
$lang[38]='<center><br /><font color="red" size="4"><b>Tillträde nekat</b></font></center>';
?>