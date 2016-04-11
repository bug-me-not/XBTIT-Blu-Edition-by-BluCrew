<?php
//Christmas Present
if (!defined("IN_BTIT"))
die("non direct access!");

require_once("include/functions.php");
dbconn();

global $CURUSER, $XBTT_USE;

$xmasday= new DateTime(date("c",mktime(0,0,0,12,25,2015)));
$today = new DateTime(date("c",time()));//mktime(date("G"), date("i"), date("s"), date("m"), date("d"), date("Y"));
$gifts = array("upload", "bonus");
$randgift = array_rand($gifts);
$gift = $gifts[$randgift];
$userid = 0 + $CURUSER["uid"];
if (!is_valid_id($userid))
stderr("Error", "Invalid ID");
$open = 0 + $_GET["open"];
if ($open != 1)
{
   stderr("Error", "Invalid url");
}
if (isset($open) && $open == 1)
{
   if ($today >= $xmasday)
   {
      if ($CURUSER["gotgift"] == 'no')
      {
         if ($gift == "upload")
         {
            $randamt = mt_rand(25,100);
            if($XBTT_USE)
            quickQuery("UPDATE `xbt_users` `xu` LEFT JOIN `{$TABLE_PREFIX}users` `u` ON `xu`.`uid`=`u`.`id` SET `xu`.`uploaded`=`xu`.`uploaded`+1024*1024*1024*{$randamt}, `u`.`gotgift`='yes' WHERE `xu`.`uid`=".sqlesc($userid)."") or sqlerr(__FILE__, __LINE__);
            else
            quickQuery("UPDATE {$TABLE_PREFIX}users SET uploaded=uploaded+1024*1024*1024*{$randamt}, gotgift='yes' WHERE id=".sqlesc($userid).";") or sqlerr(__FILE__, __LINE__);

            header('Refresh: 8; url=index.php');
            stderr("Congratulations!", "<img src=\"images/gift.png\" style=\"float: left; padding-right:10px;\" alt=\"Xmas Gift\" title=\"Xmas Gift\" /> <h2> You just got  {$randamt} GB upload !</h2>
            Thank You for your support and sharing throughout the year ".date('Y')." ! <br /> Merry Christmas and a Happy New Year from {$SITENAME}");
         }
         if ($gift == "bonus")
         {
            $randbon = mt_rand(5000,10000);
            quickQuery("UPDATE {$TABLE_PREFIX}users SET seedbonus = seedbonus + {$randbon} , gotgift='yes' WHERE id=".sqlesc($userid).";") or sqlerr(__FILE__, __LINE__);
            header('Refresh: 8; url=index.php');
            stderr("Congratulations!", "<img src=\"images/gift.png\" style=\"float: left; padding-right:10px;\" alt=\"Xmas Gift\" title=\"Xmas Gift\" /> <h2> You just got {$randbon} seed bonus points !</h2>
            Thank You for your support and sharing throughout the year ".date('Y')." ! <br /> Merry Christmas and a Happy New Year from {$SITENAME}");
         }
      }
      else
      {
         stderr("Sorry...", "You already got your gift you naughty member !");
      }
   }
   else
   {
$diff = $today->diff($xmasday);
      stderr("Whoops", "Be patient!  You can't open your present until Christmas day! You dont want coal do you? <b>".$diff->m."</b> month(s), <b>". $diff->d . "</b> day(s), <b>" .$diff->h."</b> Hour(s), <b>".$diff->i."</b> Minute(s) and <b>".$diff->s."</b> Second(s) to go. <br /> Today:<b>" . $today->format('l dS \of F Y h:i:s A') . "</b><br />Christmas day:<b>" . $xmasday->format('l dS \of F Y h:i:s A')."</b>");
   }
}
?>
