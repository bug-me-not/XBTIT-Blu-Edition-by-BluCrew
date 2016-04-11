<?php
$language['ACCOUNT_CREATED']='Konto Skapat';
$language['USER_NAME']='Användar Namn';
$language['USER_PWD_AGAIN']='Upprepa lösenord';
$language['USER_PWD']='Lösenord';
$language['USER_STYLE']='Tema';
$language['USER_LANGUE']='Språk';
$language['IMAGE_CODE']='Bild Kod';
$language['INSERT_USERNAME']='Du måste skriva användarnamn!';
$language['INSERT_PASSWORD']='Du måste ange ett lösenord!';
$language['DIF_PASSWORDS']='Lösenorden är inte likadana!';
$language['ERR_NO_EMAIL']='Du måste ange en fungerande adress';
$language['USER_EMAIL_AGAIN']='Upprepa e-post';
$language['ERR_NO_EMAIL_AGAIN']='Upprepa e-post';
$language['DIF_EMAIL']='E-post adresserna är inte Likadana!';
$language['SECURITY_CODE']='Svara på frågan';
# Password strength
$language['WEEK']='Svagt';
$language['MEDIUM']='Medium';
$language['SAFE']='Säkert';
$language['STRONG']='Starkt';
$language["ERR_GENERIC"]='Generellt Fel: '.sql_error();
//INVITATION SYSTEM
global $SITENAME, $BASEURL, $SITEEMAIL;
$language['INVIT_MSGINFO']='Du har begärt ett nytt konto på '.$SITENAME;
$language['INVIT_MSGINFO1']="\n\n".'Ditt konto väntar på att bli bekräftad av den som bjöd in dig till dess har du begränsad tillgång till sidan.';
$language['INVIT_MSGINFO2A']="\n\n".'Konto info:'."\n".'Användarnamn:';
$language['INVIT_MSGINFO2B']='Lösenord:';
$language["INVIT_MSGINFO3"]="\n\n".'----------------'."\n\n".'Om du inte registrerat dig på '.$SITENAME.', skicka mailet till '.$SITEEMAIL;
$language['INVIT_MSG_AUTOCONFIRM3']="\n\n".'----------------'."\n\n".'Du kan nu besöka'."\n\n".$BASEURL.'/index.php&page=login'.
									"\n\n".'och använda dint konto information för att logga in.'."\n\n".
									'Lycka till och hoppad du får det bra '.$SITENAME.'!'."\n\n\n".'----------------'."\n\n".
									'Om du inte registrerat dig på '.$SITENAME.', Skicka detta mail till '.$SITEEMAIL;
$language['REG_CONFIRM']='Konto bekräftelse';
$language['INVITATION_ONLY']='Tyvärr Registrering stängd.<br>Du behöver en inbjudan för att registrera dig.';
$language['WELCOME_INVITE']='Välkommen du har accepterat en inbjudan från nån av våra medlemmar.<br />Du kan nu registrera dig.';
$language['INVITE_EMAIL_SENT1']='Ett bekräftelse mail har skickat till den adress du angett';
$language['INVITE_EMAIL_SENT2']='<br />Du måste vänta till den som bjudit in dig bekräftat det.';
$language['INVITE_EMAIL_SENT3']='Ett mail har skickats till den adress du angav';
$language['INVITE_EMAIL_SENT4']='<br />Du kan nu <a href="index.php?page=login">LOGGA IN</a>. Lycka till Och Hoppas du får trevligt på '.$SITENAME.'!';
$language['INVALID_INVITATION']='Din inbjudningskod är ogiltig.';
$language['ERR_INVITATION']='<br />Begär en ny inbjudan från den som skickat den.';

$language["DOMAIN_BANNED"]="Inge falsk e-post adress är tillåten använd en riktig och fungerande adress.";

$language["UN_INV_ACC_1"] = "Inbjudan från";
$language["UN_INV_ACC_2"] = "acepterad Kontot Skapat";

$language["RREG_CLOSED_1"] = "Registrering är Stängd den är öppen i olika tidsintervaller  vänligen försök senare.";
$language["RREG_CLOSED_2"] = "Om du har en inbjudan kan du hoppa över detta steg genom att följa länken i mailet.";
$language["ERR_IP_ALREADY_EXISTS_1"] = "Ditt IP Nummer";
$language["ERR_IP_ALREADY_EXISTS_2"] = "Finns redan i våra databas.<br /><br />Om ni använder delat IP Vänligen kontakata en administratör.";

?>