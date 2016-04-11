<?php
require_once("../include/functions.php");
require_once("../language/english/lang_main.php");
dbconn(false);
global $SITENAME, $BASEURL, $XBTT_USE, $btit_settings, $CURUSER, $TABLE_PREFIX;

$get=get_result("SELECT `language_url` FROM `{$TABLE_PREFIX}language` WHERE id=".$CURUSER["language"],true,$btit_settings["cache_duration"]);
$got=$get[0];
if($got["language_url"]!="language/english")
    require_once("../".$got["language_url"]."/lang_main.php");

$uploaded=makesize($CURUSER["uploaded"]);
$downloaded=makesize($CURUSER["downloaded"]);
$last=($CURUSER["lastconnect"]==0 ? "N/A" : get_date_time($CURUSER["lastconnect"]));

$teksta=$language["LED_WELCOME"];
$tekstb=$language["LED_TO"];
$tekstc="OverRight delay=30 center=true Sleep URL=".$BASEURL." delay=4000 text=\y£\w".$SITENAME."";

$msg1=$btit_settings["ticker_msg_1"];
$msg2=$btit_settings["ticker_msg_2"];
$msg3=$btit_settings["ticker_msg_3"];
$msg4=$btit_settings["ticker_msg_4"];

if ($XBTT_USE)
   $act=get_result("SELECT COUNT(*) as acts FROM xbt_files_users xfu WHERE active=1 AND uid='".$CURUSER["uid"]."'", true, $btit_settings["cache_duration"]);
else
{
  if ($PRIVATE_ANNOUNCE)
      $act=get_result("SELECT COUNT(*) as acts FROM {$TABLE_PREFIX}peers p INNER JOIN {$TABLE_PREFIX}files f ON f.info_hash = p.infohash WHERE p.pid='".($CURUSER["pid"])."'",true,$btit_settings["cache_duration"]);
  else
      $act=get_result("SELECT COUNT(*) as acts FROM {$TABLE_PREFIX}peers p INNER JOIN {$TABLE_PREFIX}files f ON f.info_hash = p.infohash WHERE p.ip='".($CURUSER["cip"])."'",true,$btit_settings["cache_duration"]);
  }

$amountact=$act[0]["acts"];
?>

!! The Demo script
Do

   ScrollDown delay=30 center=true text=\y£\g*<?php echo htmlspecialchars($teksta); ?>*
   Sleep delay=2000
      
   Do
      ScrollUp delay=30 center=true text=\y£\n+<?php echo htmlspecialchars($tekstb); ?>+
   Repeat times=0
   Sleep delay=1000
   <?php echo $tekstc; ?>.
   Sleep delay=3000
   Pixel delay=10 pixels=15 clear=true
   
   
   ScrollLeft delay=30 center=true text=\g<?php echo"".ucfirst(strtolower($CURUSER["username"]))." ".$language["LED_UPLOADED"].": ". $uploaded.""; ?>.
   Sleep delay=2000
   
   ScrollLeft delay=30 center=true text=<?php echo $language["DOWNLOADED"].": ".$downloaded.""; ?>.
   Sleep delay=2000
   
   ScrollLeft delay=30 center=true text=\y<?php echo $language["LED_ACT_TOR"].": ".$amountact.""; ?>.
   Sleep delay=2000
   
   ScrollLeft delay=30 center=true text=<?php echo $language["LED_LAST_VISIT"]." ".$last.""; ?>.
   Sleep delay=2000
   
    ScrollRight delay=30 center=true text=\y£\b<?php echo $msg1; ?>. 
   Sleep delay=2000
   
   ScrollRight delay=30 center=true text=\y£\g<?php echo $msg2; ?>.
   Blink delay=500 times=3   
   Sleep delay=2000
   
    OverCenter delay=30 center=true text=\o<?php echo $msg3; ?>. 
   Sleep delay=2000
   
   ScrollLeft delay=30 center=true text=<?php echo $msg4; ?>.
   Sleep delay=2000

   Pixel delay=10 pixels=15 clear=true
   Sleep delay=1000
   
   ScrollLeft delay=30 startspace=20 endspace=120 text=<?php echo $language["LED_CURRTIME"]; ?> \{tt} on \{dn}-\{mn}-\{YY}.
   ScrollLeft delay=30 startspace=20 endspace=120 text=<?php echo $language["LED_TODAYIS"]; ?> \{dd} \{mm} \{dn}, \{YY}.
   Sleep delay=1000

!! repeat infinitely
Repeat times=-1
!! reload the script
Reload