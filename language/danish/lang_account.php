<?php
$language['ACCOUNT_CREATED']='Konto oprettet';
$language['USER_NAME']='Bruger';
$language['USER_PWD_AGAIN']='Indtast kodeord igen';
$language['USER_PWD']='Kodeord';
$language['USER_STYLE']='Tema';
$language['USER_LANGUE']='Sprog';
$language['IMAGE_CODE']='Billed kode';
$language['INSERT_USERNAME']='Du skal indtaste et brugernavn!';
$language['INSERT_PASSWORD']='Du skal indtaste et kodeord!';
$language['DIF_PASSWORDS']='Kodeordne passer ikke overens!';
$language['ERR_NO_EMAIL']='Du skal indtaste en gyldig email';
$language['USER_EMAIL_AGAIN']='Gentag email';
$language['ERR_NO_EMAIL_AGAIN']='Gentag email';
$language['DIF_EMAIL']='Email passer ikke overens!';
$language['SECURITY_CODE']='Svar på spørgsmålet';
# Password strength
$language['WEEK']='Svagt';
$language['MEDIUM']='Medium';
$language['SAFE']='Sikker';
$language['STRONG']='Stærk';
$language["ERR_GENERIC"]='Mysql fejl: '.sql_error();
//INVITATION SYSTEM
$language['INVIT_MSGINFO']='Du har bedt om en ny konto på '.$SITENAME.' og du har angivet denne adresse (';
$language['INVIT_MSGINFO1']=') som kontakt adresse.<br /><br />Din konto afventer bekræftigelse af din inviter.'.
                            '<br />Du kan ikke logge ind p? '.$SITENAME.' før din konto er bekræftet .<br /><br />Konto info:\nUsername:';
$language['INVIT_MSGINFO2']='Kodeord:';
$language['INVIT_MSGINFO3']='Hvis du ikke bekræfter denne inden 24 timer bliver den slettet.'.
                            '<br />----------------<br />Hvis du ikke har bedt om registrering hos '.$SITENAME.', så send venligst denne email til '.$SITEEMAIL;
$language['INVIT_MSG_AUTOCONFIRM3']='----------------<br />Du kan nu logge ind her <br /><br />'.$BASEURL.'/login.php'.
                                    '<br /><br />med din brugerinformation.<br /><br />'.
                                    'Held og lykke og hav et godt ophold hos '.$SITENAME.'!<br /><br /><br />----------------<br />'.
                                    'Hvis du ikke har bedt om registrering hos '.$SITENAME.', så send venligst denne email til '.$SITEEMAIL;
$language['REG_CONFIRM']='Konto bekræftelse';
$language['INVITATION_ONLY']='Beklager, der er lukket for registrering.<br>Du skal bruge en invitation for at komme videre.';
$language['WELCOME_INVITE']='Velkommen! Du har accepteret en invitation fra en ven.<br />Du kan nu skrive dig op.';
$language['INVITE_EMAIL_SENT1']='En bekræftelses email er sendt til den ønskede email';
$language['INVITE_EMAIL_SENT2']='<br />Du er n?dt til at vente indtil din ven bekræfter din invitation.';
$language['INVITE_EMAIL_SENT3']='En email er sendt til den ønskede adresse';
$language['INVITE_EMAIL_SENT4']='<br />Du kan nu <a href="index.php?page=login">logge ind</a>. Held og lykke og hav et godt ophold hos '.$SITENAME.'!';
$language['INVALID_INVITATION']='Din brugte invitationskode er ugyldig.';
$language['ERR_INVITATION']='<br />Bed om en ny invitation fra din ven.';
        ?>
