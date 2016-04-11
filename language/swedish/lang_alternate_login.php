<?php
$language["ACP_LOGIN_PAGE"]= 'Inställning Alternativ Inloggning';
$language['SINGLE_LOGIN_PAGE']='Välj statisk Bakgrund';
$language["SINGLE_BACKGROUND"]= 'Statisk Bakgrund';
$language["ROTATING_LOGIN_PAGE"]= 'Välj varierande Bakgrund';
$language["ROTATING_BACKGROUND"]= 'Varierande Bakgrund';
$language["CHOOSE_LOGIN_PAGE"]= 'Välj Sidtyp för inlogg';
$language["LOGIN_PAGE_TYPES"]= 'Inlogg Sidtyp';
$language['REGISTERED']='Registrerad';

$language["CHOOSE_FAQ"]="Välj Vanlig eller Alternativ FAQ Sida";
$language["CHOOSE_RULES"]="Välj vanlig eller Alternativ Regel sida";
$language["RULES_TYPES"]="Val Vanlig/Alternativ Regel sida";
$language["DEFAULT_RULES"]="Standard Regel";
$language["CUSTOM_RULES"]="Alternativ Regel";
$language["FAQ_TYPES"]="Val Vanlig/Alternativ FAQ sida";
$language["DEFAULT_FAQ"]="Vanlig FAQ sida";
$language["CUSTOM_FAQ"]="Alternativ FAQ sida";
$language["ENABLE_ALL_WARN"]="Test";

// Birthday hack
$language["DOB"]="Födelsedatum";
$language["DOB_FORMAT"]="<b>Dag (DD) / Månad (MM) / År (YYYY)</b>";

// Password strength
$language['WEEK']='Svagt';
$language['MEDIUM']='Medel';
$language['SAFE']='Starkt';
$language['STRONG']='Säkert';
$language["ERR_PASS_TOO_WEAK_1"]="För svagt lösenord.<br />Av säkerhetsskäl måste det innehålla minst";
$language["ERR_PASS_TOO_WEAK_1A"]="För svagt lösenord.<br />Av säkerhetsskäl måste det innehålla minst";
$language["ERR_PASS_TOO_WEAK_2"]="liten bokstav";
$language["ERR_PASS_TOO_WEAK_2A"]="små bokstäver";
$language["ERR_PASS_TOO_WEAK_3"]="Stor bokstav";
$language["ERR_PASS_TOO_WEAK_3A"]="Stora bokstäver";
$language["ERR_PASS_TOO_WEAK_4"]="Siffra";
$language["ERR_PASS_TOO_WEAK_4A"]="Siffror";
$language["ERR_PASS_TOO_WEAK_5"]="symbol";
$language["ERR_PASS_TOO_WEAK_5A"]="symboler";
$language["ERR_PASS_TOO_WEAK_6"]="Här visas ett  starkt lösenord du kan använda";
$language["SECSUI_ACC_PWD_1"]="Ditt lösenord behöver:";
$language["SECSUI_ACC_PWD_1A"]="Lösenordet behöver:";
$language["SECSUI_ACC_PWD_2"]="Vara minst";
$language["SECSUI_ACC_PWD_3"]="tecken i längd";
$language["SECSUI_ACC_PWD_3A"]="tecken i längd";
$language["SECSUI_ACC_PWD_4"]="Ha minst";
$language["SECSUI_ACC_PWD_5"]="liten bokstav";
$language["SECSUI_ACC_PWD_5A"]="Små bokstäver";
$language["SECSUI_ACC_PWD_6"]="Liten bokstav";
$language["SECSUI_ACC_PWD_6A"]="Stora bokstäver";
$language["SECSUI_ACC_PWD_7"]="Siffra";
$language["SECSUI_ACC_PWD_7A"]="Siffror";
$language["SECSUI_ACC_PWD_8"]="symbol";
$language["SECSUI_ACC_PWD_8A"]="symboler";
//Booted
$language['BOOTED']='Inaktiverat Konto!';
$language['BOOTEDUT']='Tills';
$language['WHYBOOTED']='Orsak:';

$language['ACCOUNT_CREATED']='Kontot Skapat';
$language['USER_NAME']='Användarnamn';
$language['USER_PWD_AGAIN']='Upprepa Lösen';
$language['USER_PWD']='Lösen';
$language['USER_STYLE']='Tema';
$language['USER_LANGUE']='Språk';
$language['IMAGE_CODE']='Bild Kod';
$language['INSERT_USERNAME']='Måste ange namn!';
$language['INSERT_PASSWORD']='Måste ange ett lösen!';
$language['DIF_PASSWORDS']='Lösenorden är inte lika!';
$language['ERR_NO_EMAIL']='Måste ange en riktig email address';
$language['USER_EMAIL_AGAIN']='Upprepa email';
$language['ERR_NO_EMAIL_AGAIN']='Upprepa email';
$language['DIF_EMAIL']='Email är inte likadana!';
$language['REGISTERED_EMAIL']='Registrerad Email';
$language['USER_EMAIL']='Email';
$language['USER_EMAIL']='Riktig Email';
$language['SECURITY_CODE']='Säkerhetskod!';
$language['SSL'] = "Tvinga SSL:";
$language['SSL_DESC'] = "Tvinga säker anslutning till sidan.";
$language['FRM_CONFIRM']='Bekräfta';
$language['FRM_LOGIN']='Logga In';
$language['FRM_SIGNUP']='Registrera';
$language['COUNTRY']='Lan';
$language['TIMEZONE']='Tidszon';
$language['NEED_COOKIES']='OBS:<br /> Cookies måste va aktiverad för att logga in.';

//INVITATION SYSTEM
global $SITENAME, $BASEURL, $SITEEMAIL;
$language['INVIT_MSGINFO']='Du har regitrerat ett konto på '.$SITENAME;
$language['INVIT_MSGINFO1']="\n\n".'Kontot väntar på verifiering av den som bjudit in dig. Innan kontot är bekräftat har du inte full tillgång till sidan.';
$language['INVIT_MSGINFO2A']="\n\n".'Konto information:'."\n".'Anändarnamn:';
$language['INVIT_MSGINFO2B']='Lösenord:';
$language["INVIT_MSGINFO3"]="\n\n".'----------------'."\n\n".'om du inte registrerat dig på '.$SITENAME.', vänligen vidarebefodra detta mail till '.$SITEEMAIL;
$language['INVIT_MSG_AUTOCONFIRM3']="\n\n".'----------------'."\n\n".'Du kan nu gå till'."\n\n".$BASEURL.'/index.php&page=login'.
									"\n\n".'och använda dina Konto detaljer för att logga in.'."\n\n".
									'Lycka till och Välkommen till '.$SITENAME.'!'."\n\n\n".'----------------'."\n\n".
									'Om du inte registrerat dig på '.$SITENAME.', vänligen vidarebefordra detta mail till '.$SITEEMAIL;
$language['REG_CONFIRM']='Konto bekräftelse';
$language['INVITATION_ONLY']='Ledsen men stängt för registrering.<br>Du måste ha en invite för att kunna bli medlem.';
$language['WELCOME_INVITE']='Välkommen! Du har accepterat en inbjudan från en av våra medlemmar.<br />Du kan nu registrera dig.';
$language['INVITE_EMAIL_SENT1']='Ett bekräftelse mail har skickats till adressen du angett';
$language['INVITE_EMAIL_SENT2']='<br />Du får vänta tills den som bjudit in dig bekräftat registreringen.';
$language['INVITE_EMAIL_SENT3']='Ett bekräftelse mail har skickats till mailen du angett';
$language['INVITE_EMAIL_SENT4']='<br />Du kan nu<a href="index.php?page=login">LOGGA IN</a>. Lycka till å hoppas du kommer trivas på '.$SITENAME.'!';
$language['INVALID_INVITATION']='Din inbjudningskod är inte giltig.';
$language['ERR_INVITATION']='<br />Fråga efter en ny Inbjudan Av den som bjöd in dig.';

$language["DOMAIN_BANNED"]="Email domänen är svartlistad vänligen använd en annan.";

$language["UN_INV_ACC_1"] = "Inbjudan från";
$language["UN_INV_ACC_2"] = "är godkänd och kontot är skapat";

$language["RREG_CLOSED_1"] = "Registrering är stängt för tillfället men är öppet vid olika tider..Vänligen prova senare.";
$language["RREG_CLOSED_2"] = "Om du fått en inbjudan kan du gå förbi detta genom att följa länken i inbjudnings mailet.";
$language["ERR_IP_ALREADY_EXISTS_1"] = "Ditt IP nummer";
$language["ERR_IP_ALREADY_EXISTS_2"] = "Används redan på sidan.<br /><br />Har du en delad anslutning kontakta en site admin.";

$language['ERR_500']='HTTP/1.0 500 Anlutning förbjuden!';
$language['ERR_AVATAR_EXT']='Sorry either the image doesn&rsquo;t exist or the file type is incorrect (bara gif, jpg, bmp eller png bilder är tillåtet).';
$language['ERR_BAD_LAST_POST']='';
$language['ERR_BAD_NEWS_ID']='Ogiltigt Nyhets ID!';
$language['ERR_BODY_EMPTY']='Titel kan inte va tomte!';
$language['ERR_CANT_CONNECT']='Kan inte ansluta till lokal MySQL server';
$language['ERR_CANT_OPEN_DB']='Kan inte öppna databasen';
$language['ERR_COMMENT_EMPTY']='Kommentar kan inte va tom!';
$language['ERR_DB_ERR']='Databas fel. Vänligen kontakta site admin om detta.';
$language['ERR_DELETE_POST']='Ta bort inlägg. Kontroll: Vill du ta bort inlägg. Klicka';
$language['ERR_DELETE_TOPIC']='Ta bort Ämne. Kontroll: Vill du ta bort ämnet. Klicka';
$language['ERR_EMAIL_ALREADY_EXISTS']='Email Finns redan i databasen!';
$language['ERR_EMAIL_NOT_FOUND_1']='Denna Email adressen';
$language['ERR_EMAIL_NOT_FOUND_2']='hittades inte i databasen.';
$language['ERR_ENTER_NEW_TITLE']='Du måste ange ny titel!';
$language['ERR_FORUM_NOT_FOUND']='Forum hittades inte';
$language['ERR_FORUM_UNKW_ACT']='Forum fel : Okänd händelse';
$language['ERR_GUEST_EXISTS']='"Gäst" är ett skyddat namn. Du kan inte regitrera dig med namnet "Gäst"';
$language['ERR_IMAGE_CODE']='Säkerhets koden är inte likadan';
$language['ERR_INS_TITLE_NEWS']='Du måste ange både TITEL och Nyhet';
$language['ERR_INV_NUM_FIELD']='Ogiltiga fält från klient';
$language['ERR_INVALID_CLIENT_EVENT']='Ogiltig händelse= från klient.';
$language['ERR_INVALID_INFO_BT_CLIENT']='Ogiltig information mottagen från BitTorrent klient';
$language['ERR_INVALID_IP_NUMB']='ogiltig IP adress. Måste va standard decimal form (hostnamn ej tillåtet)';
$language['ERR_LEVEL']='Ledsen, Din Klass ';
$language['ERR_LEVEL_CANT_POST']='Du har inte tillåtelse att skriva i detta forum.';
$language['ERR_LEVEL_CANT_VIEW']='Du har inte tillgång till denna tråd.';
$language['ERR_MISSING_DATA']='Data saknas!';
$language['ERR_MUST_BE_LOGGED_SHOUT']='Du måste vara inloggad för att skriva...';
$language['ERR_NO_BODY']='Ingen Bröd text';
$language['ERR_NO_NEWS_ID']='Nyhets ID  finns inte!';
$language['ERR_NO_POST_WITH_ID']='Inget inlägg med ID ';
$language['ERR_NO_SPACE']='Namnet kan inte innehålla mellanslag använd understreck Ex:<br /><br />';
$language['ERR_NO_TOPIC_ID']='Inget Tråd ID mottogs';
$language['ERR_NO_TOPIC_POST_ID']='Ingen tråd associerad med inläggs ID';
$language['ERR_NOT_AUTH']='Åtkomst Nekad!';
$language['ERR_NOT_FOUND']='Finns ej...';
$language['ERR_NOT_PERMITED']='Ingen Åtkomst';
$language['ERR_PASS_LENGTH_1']='Lösen ordet måste va minst';
$language['ERR_PASS_LENGTH_2']='tecken i längd.';
$language['ERR_PASSWORD_INCORRECT']='Fel Lösenord';
$language['ERR_PERM_DENIED']='Tillstånd nekas';
$language['ERR_PID_NOT_FOUND']='Vänligen ladda ner torrenten igen. PID systemet är aktiv din PID hittades inte i torrenten';
$language['ERR_RETR_DATA']='Kan inte ta emot data!';
$language['ERR_SEND_EMAIL']='Kan inte skicka mail. Vänligen kontakta siteadmin om felet.';
$language['ERR_SERVER_LOAD']='Tillfälligt hög serverbelastning. Provar igen, Vänligen vänta...';
$language['ERR_SPECIAL_CHAR']='<font color="black">Ditt Namn kan inte innehålla specialtecken som:<br /><br /><font color="red"><strong>* &#63; &#60; &#62; &#64; &#36; &#38; &#37; etc.</strong></font></font><br />';
$language['ERR_SQL_ERR']='SQL Fel';
$language['ERR_SUBJECT']='Måste ange Ämne.';
$language['ERR_TOPIC_ID_NA']='Tråd ID är Inte tillgängligt';
$language['ERR_TOPIC_LOCKED']='Tråden är låst';
$language['ERR_TORRENT_IN_BROWSER']='Denna fil är inte för BitTorrent klienter.';
$language['ERR_UPDATE_USER']='Kan inte uppdatera info.för användaren. Vänligen kontakta system administratören.';
$language['ERR_USER_ALREADY_EXISTS']='Finns redan en användare med detta namn!';
$language['ERR_USER_NOT_FOUND']='Ledsen, Ingen användare hittades';
$language['ERR_USER_NOT_USER']='Du kan inte använda någon annans användar panel!';
$language['ERR_USERNAME_INCORRECT']='Felaktigt Användarnamn';


//User Signup Agreement
$language["ACP_USER_SIGNUP_AGREEMENT"] = "Användaravtal";
$language["ACP_USER_SIGNUP_AGREEMENT1"] = "Inställningar Användaravtal";
$language["ACP_TEXT_BOX_ONE"] = "Text Fält Ett";
$language["ACP_TEXT_BOX_TWO"] = "Text Fält Två";
$language["ACP_TEXT_BOX_THREE"] = "Text Fält Tre";
$language["ACP_TEXT_BOX_FOUR"] = "Text Fält Fyra";
$language["ACP_ENABLE"]="Aktivera";
$language["ACP_ENABLED"]="Aktiverat";
$language["ACP_DISABLED"]="Inaktivt";

$language["AGREE"]="Måste godkänna innan du kan registrera";
$language["AGREE1"]="Jag Godkänner";
$language["ENABLE"]="Aktivera";
$language["ENABLED"]="Aktiverat";
$language["DISABLED"]="Avstängd";
$language['ERR']='Fel';

//Menu
$language['LOGIN']='Logga Inn';
$language['RECOVER']='Återställ lösenord';
$language['SIGNUP']='Skapa Konto';
$language['MNU_NEWS']='Nyheter';
$language['MNU_FORUM']='Forum';
$language["MNU_RULES"]="Regler";
$language["MNU_FAQ"]="F.A.Q.";
$language["MNU_IRC"]="IRC";

// Hide
$language['ACP_DIS_TITLE']='Aktivera/Inaktivera På Alternativ Inloggnings sida';
$language["EN_DIS_ALL"] = "Aktivera/Inaktivera Knappar på Alternativ inloggnings sida";
$language["SET_ABOVE"] = "Använd Ovanstående Inställningar";
$language["EN_ALL"] = "Aktivera Alla";
$language["DIS_ALL"] = "Inaktivera  Alla";
$language['ACP_HIDE']='Meny Knappar';
$language['ACP_NEWS']='Aktivera/Inaktivera Nyheter';
$language['ACP_FORUM']='Aktivera/Inaktivera Forum';
$language['ACP_RULES']='Aktivera/Inaktivera Regler';
$language['ACP_FAQ']='Aktivera/Inaktivera F.A.Q.';
$language['ACP_IRC']='Aktivera/Inaktivera IRC';
$language['ACP_VIEW_IRC']='Måste installera IRC Modulen först';


//News
$language['POSTED_BY']='Skriven av:';
$language['POSTED_DATE']='Skrivet den:';
$language['TITLE']='Titel:';

//Mesages
$language['NEWS_MSG']='Aktivering gör så att besökaren kan se och använda denna knapp på Alternativ Inloggnings sida';
$language['FORUM_MSG']='Aktivering gör så att besökaren kan se och använda denna knapp på  Alternativ Inloggnings sida';
$language['RULES_MSG']="Varning: Bara för att funktionen finns här är det inte säkert att\\ndet är bra att använda det.\\n\\nAktivering av alla skript kan ge motsatt effekt\\ndå många redan finns som standard och slutar med att du\\ntroligen får svårt att konfigurera Skripten sen.\\n\\nVi rekomenderar att du aktiverar det du verkligen behöver\\nn och bygger upp listan med aktiverade Skript gradvis. På\\ndetta sätt kan du ställa in Skripten korrekt som du vill.\\n\\nDu kan strunta i denna varningen och fortsätta använda denna\\ninställning ändå men du är Varnad!";
$language['FAQ_MSG']="Varning: Bara för att funktionen finns här är det inte säkert att\\ndet är bra att använda det.\\n\\nAktivering av alla skript kan ge motsatt effekt\\ndå många redan finns som standard och slutar med att du\\ntroligen får svårt att konfigurera Skripten sen.\\n\\nVi rekomenderar att du aktvera det du verkligen behöver\\nn och bygger upp listan med aktiverade Skript gradvis. På\\ndetta sätt kan du ställa in Skripten korrekt som du vill.\\n\\nDu kan strunta i denna varningen och fortsätta använda denna\\ninställning ändå men du är Varnad!";

$language["MODE_TYPE"]="Typ Val";
$language["MODE_CLASSIC"]="Klassisk";
$language["MODE_NEW"]="Ny";
?>