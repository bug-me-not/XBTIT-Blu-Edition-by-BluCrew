<?
require_once ("include/functions.php");
require_once ("include/config.php");

dbconn();

if (!defined("IN_BTIT"))
      die("non direct access!");

if (!defined("IN_ACP"))
      die("non direct access!");


/*if (isset($_GET["action"]))
$action = $_GET["action"];
else
$action = "";

 $subject = $HTTP_POST_VARS["subject"];
     $subject = stripslashes($subject);
     $content_1 = $HTTP_POST_VARS["content_1"];
     $content_1 = htmlentities($content_1, ENT_QUOTES);
     $content_1 = stripslashes($content_1);
     $content_1 = "<font face=\"arial\"> ". $content_1 ." </font>";*/

// get all email addresses from db from id 1
     $SQL = do_sqlquery("SELECT email FROM {$TABLE_PREFIX}users WHERE id>1");

     while($row=$SQL-> fetch_array())
         {

//collect emails in a array
         $EmailAddress2[] = $row["email"];
         }

// start send email to all
if ($action == "send_mail")
{
 $res = do_sqlquery("SELECT email FROM {$TABLE_PREFIX}users WHERE id>1") or sqlerr();
 $subject2 = $subject;
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers .= "From:".$CURUSER['email']."\r\n";
$mailbody = $HTTP_POST_VARS["content_1"];
 $to = "";
 $nmax = 1000; // Max recipients per message
 $nthis = 0;
 $ntotal = 0;
 $total = sql_num_rows($res);
 while ($arr=$res-> fetch_row()) {
   if ($nthis == 0)
     $to = $arr[0];
   else
     $to .= "," . $arr[0];
   ++$nthis;
   ++$ntotal;
   if ($nthis == $nmax || $ntotal == $total) {
     if (!mail("Multiple recipients <$SITEEMAIL>", "$subject", $mailbody,
      "From: $SITEEMAIL\r\nBcc: $to", "-f$SITEEMAIL"))
     $nthis = 0;
   }
}

// lets us know if all went fine 
        information_msg("Message Sent","Sent From: $SITEEMAIL. Message: $mailbody");
        stdfoot();
        exit();
}
$admintpl->set("subject","subject");
$admintpl->set("message","content_1");
$admintpl->set("frm_action", "index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=massemail&amp;action=send_mail");
?>
