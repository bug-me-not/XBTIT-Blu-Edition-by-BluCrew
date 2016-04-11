<?php

// smf_import.php language file

$lang[0]="Ναι";
$lang[1]="Οχι";
$lang[2]="<center><u><strong><font size='4' face='Arial'>Επίπεδο 1: Initial Requirements</font></strong></u></center><br />";
$lang[3]="<center><strong><font face='Arial' size='2'>SMF files present in the \"smf\" folder?<font color='";
$lang[4]="'>&nbsp;&nbsp;&nbsp; ";
$lang[5]="</font></center></strong>";
$lang[6]="<br /><center>Please <a target='_new' href='http://www.simplemachines.org/download/'>download SMF</a> και ανέβασε τα περιεχόμενα τις αρχειοθέτησης στο \"smf\" φάκελο.<br />Αν δεν έχετε έναν \"smf\" φάκελο παρακαλώ δημιουργήστε έναν στο tracker root και ανεβάστε<br />τα περιεχόμενα της αρχειοθέτησης σε αυτόν.<br /><br />Αφού εχει ανεβαστεί p"; // p at end is an lowercase p for use with $lang[8]
$lang[7]="<br /><center>P"; // P at end is an uppercase p for use with $lang[8]
$lang[8]="Παρακαλώ κάντε install SMF <a target='_new' href='smf/install.php'>κλικάροντας εδώ</a>*<br /><br /><strong>* Παρακαλώ χρησιμοποιήστε την ίδια βάση δεδομένων συνδέοντας τις ίδιες λεπτομέρειες με αυτές που συνδέσατε για τον tracker σας,<br />μπορείτε να χρησιμοποιήσετε μια βάση δεδομένων οποιουδήποτε προθέματος θέλετε (εξαιρώντας το πρόθεμα που χρησιμοποιήται απο τον<br />tracker όπου εφαρμόζεται)<br /><br />";
$lang[9]="<font color='#0000FF' size='3'>Μπορείται να ανανεώσετε αυτή τη σελίδα αφού έχετε ολοκληρώσει τη ζητούμενη αποστολή!</font></strong></center>";
$lang[10]="<center><strong>SMF installed?<font color='";
$lang[11]="Το αρχείο δεν βρέθηκε!";
$lang[12]="Το αρχείο βρέθηκε αλλά δεν είναι εγγράψιμο!";
$lang[13]="<center><strong>Προεπιλεγμένο SMF λάθος αρχείο διαθέσιμο και εγγράψιμο?<font color='";
$lang[14]="<center><strong>smf.sql αρχείο παρόν στο \"sql\" φάκελο?<font color='";
$lang[15]="<br /><center><strong>Αρχείο γλώσσας (";
$lang[16]=")<br />εαν λείπει παρακαλώ σιγουρέψτε <font color='#FF0000'><u>ολα τα SMF αρχεία</u></font> ανεβάστηκαν!<br /><br />";
$lang[17]=")<br />δεν είναι εγγράψιμο, <font color='#FF0000'><u>παρακαλώ CHMOD αυτό το αρχείο σε 777</u></font><br /><br />";
$lang[18]="<br /><center><strong>smf.sql λείπει, <font color='#FF0000'><u>παρακαλώ σιγουρέψτε οτι αυτό το αρχείο είναι παρόν στο \"sql\" φάκελο.</u></font><br />(θα έπρεπε να περιέχεται στη XBTIT διανομή!)<br /><br />";
$lang[19]="<br /><center>Ολα τα απαραίτητα έχουν τεθεί, παρακαλώ <a href='";
$lang[20]="'>click εδώ για να συνεχίσετε</a></center>";
$lang[21]="<center><u><strong><font size='4' face='Arial'>Επίπεδο 2: Initial Setup</font></strong></u></center><br />";
$lang[22]="<center>Τώρα που επιβεβαιώσαμε οτι ολα είναι στη θέση τους ήρθε η ώρα να τροποποιήσουμε τη βάση δεδομένων<br />για να τα φέρουμε ολα σύμφωνα με τον τracker.</center><br />";
$lang[23]="<center><form όνομα=\"db_pwd\" δράση=\"smf_import.php\" μέθοδος=\"ΠΑΡΕ\">Δώσε Κωδικό Βάσης Δεδομένων:&nbsp;<input όνομα=\"pwd\" μέγεθος=\"20\" /><br />\n<br />\n<strong>παρακαλώ <input type=\"στείλε\" όνομα=\"επικύρωσε\" αξία=\"ναι\" μέγεθος=\"20\" /> για να συνεχίσετε</strong><input type=\"κρυμμένο\" όνομα=\"act\" αξία=\"init_setup\" /></form></center>";
$lang[24]="<center><u><strong><font size='4' face='Arial'>Επίπεδο 3: Εισήγαγε τα μέλη του tracker </font></strong></u></center><br />";
$lang[25]="<center>Τώρα η βάση δεδομένων έγινε setup σωστά και είναι η ώρα για να ξεκινήσει η εισαγωγή μελών του tracker,<br />Αυτό μπορεί να πάρει κάποιο χρόνο εαν έχεις μεγάλη βάση δεδομένων μελών για αυτό παρακαλώ κάντε υπομονή και επιτρέψτε<br />το σενάριο θα κάνει την δουλειά του!<br /><br /><strong>παρακαλώ <a href='".$_SERVER["PHP_SELF"]."?act=member_import&amp;confirm=ναι'>click εδώ</a> to proceed</center>";
$lang[26]="<center><u><strong><font size='4' face='Arial'>Συγνώμη</font></strong></u></center><br />";
$lang[27]="<center>Συγνώμη, αυτό προορίζετε να χρησιμοποιηθή μια φορά και να εξαχθεί το σενάριο αφού το έχετε ήδη χρησιμοποιήση, αυτό το αρχείο κλειδώθηκε!</center>";
$lang[28]="<center><br /><strong><font color='#FF0000'><br />";
$lang[29]="</strong></font> Forum λογαριασμοί επιτυχώς δημιουργήθηκαν, παρακαλώ <a href='".$_SERVER["PHP_SELF"]."?act=import_forum&amp;confirm=οχι'>click εδώ</a> για να συνεχίσετε </center>";
$lang[30]="<center><u><strong><font size='4' face='Arial'>Επίπεδο 4: Εισαγωγή στο forum layout & posts</font></strong></u></center><br />";
$lang[31]="<center>Αυτό είναι το τελικό επίπεδο απο την εισαγωγή στο forum εισάγετε, αυτό θα εισαχθεί στα τρέχοντα BTI Forums σε SMF,<br />θα εισαχθούν σε μια νέα κατηγορία που ονομάζεται \"Η BTI εισαγωγή\",<br />παρακαλώ <a href='".$_SERVER["PHP_SELF"]."?act=import_forum&amp;confirm=ναι'>click εδώ</a> για να συνεχίσετε </center>";
$lang[32]="<center><u><strong><font size='4' face='Arial'>Εισαγωγή ολοκληρώθηκε</font></strong></u></center><br />";
$lang[33]="<center><font face=\"Arial\" size=\"2\">Παρακαλώ <a target='_new' href='smf/index.php?action=συνδεθείτε'>συνδεθείτε στο νέο σας SMF forum</a> χρησιμοποιήστε τις πληροφορίες του Tracker σας και πηγαίνετε στο <br />το <strong>Κέντρο Διαχείρησης</strong> μετά επιλέξτε <strong>Forum συντήρηση</strong> και τρέξτε<br /><strong>Βρέστε και επιδιορθώστε οπιαδήποτε λάθη.</strong> ακολουθούμενα απο  <strong>Ξαναμετρήστε όλα τα σύνολα του forum<br />και τα στατιστικά.</strong> για να συμμαζέψετε την εισαγωγή και να διωρθώσετε το μέτρημα του post κτλ.<br /><br /><strong><font color='#0000FF'>Το ενσωματωμένο σας SMF Forum θα πρέπει να είναι έτοιμο για να χρησιμοποιηθή!</font></strong></font></center>";
$lang[34]="<center><u><strong><font size=\"4\" face=\"Arial\" color=\"#FF0000\">ERROR!</font></strong></u></center><br />\n<br />\n<center><font face=\"Arial\" size=\"3\">Πληκτρολογήσατε λάθος κωδικό ή δεν είστε ο κάτοχος αυτού του  tracker!<br />\nΠαρακαλώ σημειώστε οτι η IP συνδέθηκε.</font></center>";
$lang[35]="</body>\n</html>\n";
?>