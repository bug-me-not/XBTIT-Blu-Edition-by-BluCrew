<?php
// Traduzione eseguita da mOOn, con il QCheck di Laurianti.
//Un grazie anche a Confe, e a chi si è prodigato nel testare il Tracker
// Per qualsiasi info ci trovate su http://www.btiteam.org
$lang[0]="Si";
$lang[1]="No";
$lang[2]="<center><u><strong><font size='4' face='Arial'>Fase 1: Requisiti Iniziali</font></strong></u></center><br />";
$lang[3]="<center><strong><font face='Arial' size='2'>Sono presenti i file SMF nella cartella\"smf\"?<font color='";
$lang[4]="'>&nbsp;&nbsp;&nbsp; ";
$lang[5]="</font></center></strong>";
$lang[6]="<br /><center>Ti preghiamo di <a target='_new' href='http://www.simplemachines.org/download/'>scaricare SMF</a> e invia il contenuto dell'archivio nella cartella \"smf\"!<br />Se non hai una cartella \"smf\" ti preghiamo di crearla nella radice del tuo tracker e di inviare il contenuto<br />dell'archivio dentro alla cartella.<br /><br />Una volta caricato"; // p at end is an lowercase p for use with $lang[8]
$lang[7]="<br /><center>P"; // P at end is an uppercase p for use with $lang[8]
$lang[8]="installa SMF <a target='_new' href='smf/install.php'>premendo qui</a>*<br /><br /><strong>* Per favore, usa gli stessi parametri per il database come quelli usati per il tracker,<br />si puo' utilizzare qualsiasi tipo di prefisso per il database che si vuole (escludendo il prefisso utilizzato dal <br />tracker ove applicabile)<br /><br />";
$lang[9]="<font color='#0000FF' size='3'>È possibile aggiornare la pagina dopo aver completato il compito richiesto!</font></strong></center>";
$lang[10]="<center><strong>Hai installato SMF ?<font color='";
$lang[11]="File non trovato!";
$lang[12]="File trovato ma non scrivibile!";
$lang[13]="<center><strong>Errore, il file Default SMF English Errors è disponibile e scrivibile?<font color='";
$lang[14]="<center><strong>Il file smf.sql è presente nella cartella\"sql\"?<font color='";
$lang[15]="<br /><center><strong>File di lingua (";
$lang[16]=")<br />non si trova, ti preghiamo di controllare <font color='#FF0000'><u>tutti i file SMF </u></font> dove sono stati caricati!<br /><br />";
$lang[17]=")<br />non è scrivibile, <font color='#FF0000'><u>please CHMOD this file to 777</u></font><br /><br />";
$lang[18]="<br /><center><strong>il file smf.sql non si trova, <font color='#FF0000'><u>controlla che il file sia presente nella cartella \"sql\".</u></font><br />(Dovrebbe essere incluso nella distribuzione di XBTIT!)<br /><br />";
$lang[19]="<br /><center>Tutti i requisiti sono stati soddisfatti, <a href='";
$lang[20]="'>premi qui per continuare</a></center>";
$lang[21]="<center><u><strong><font size='4' face='Arial'>Fase 2: Setup di avvio</font></strong></u></center><br />";
$lang[22]="<center>Ora che abbiamo verificato tutto(ed è tutto a posto) è il momento di modificare il database<br />e di portare in linea tutto con il tracker.</center><br />";
$lang[23]="<center><strong>prego <a href='".$_SERVER["PHP_SELF"]."?act=init_setup&confirm=yes'>premere qui</a> per procedere</center>";
$lang[24]="<center><u><strong><font size='4' face='Arial'>Fase 3: Import utenti del tracker</font></strong></u></center><br />";
$lang[25]="<center>Ora il database è stato impostato correttamente, è il momento di iniziare l'import degli utenti del tracker,<br />Questo può richiedere un po 'di tempo, se si dispone di un ampio numero di utenti vi preghiamo di essere pazienti<br />e di permettere che lo script faccia il suo lavoro!!<br /><br /><strong>prego <a href='".$_SERVER["PHP_SELF"]."?act=member_import&confirm=yes'>premere qui</a> per procedere</center>";
$lang[26]="<center><u><strong><font size='4' face='Arial'>OOppss</font></strong></u></center><br />";
$lang[27]="<center>OOppss, questo è destinato ad essere usato una sola volta, e poichè hai gia utilizzato lo script, questo file è stato bloccato!!</center>";
$lang[28]="<center><br /><strong><font color='#FF0000'><br />";
$lang[29]="</strong></font>Gli account per il Forum sono stati creati con successo, prego <a href='".$_SERVER["PHP_SELF"]."?act=import_forum&confirm=no'>premi qui</a> per procedere</center>";
$lang[30]="<center><u><strong><font size='4' face='Arial'>Stage 4: Importing the forum layout & posts</font></strong></u></center><br />";
$lang[31]="<center>Questa è la fase finale del forum import, , questo farà da ponte al forum di XBTI a SMF,<br />e saranno importati in una nuova categoria denominata \"My BTI import\",<br />prego <a href='".$_SERVER["PHP_SELF"]."?act=import_forum&confirm=yes'>premi qui</a> per procedere</center>";
$lang[32]="<center><u><strong><font size='4' face='Arial'>Import Completo</font></strong></u></center><br />";
$lang[33]="<center><font face='Arial' size=2>Ti preghiamo <a target='_new' href='smf/index.php?action=login'>di accedere al tuo Forum SMF</a> usando i parametri del tuo Tracker<br />, poi vai in <strong>Administration Center</strong> e seleziona <strong>Forum Maintenance</strong> dopo esegui<br /><strong>Find and repair any errors.</strong> seguito da <strong>Recount all forum totals<br />and statistics.</strong> per riordinare l'importazione e fissare il numero dei messaggi ecc .<br /><br /><strong><font color='#0000FF'>Il tuo Forum SMF integrato è pronto all'uso!!</font></strong></font></center>";
?>