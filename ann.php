<?php
//require dirname(__FILE__)."/include/functions.php";
require_once("include/functions.php");
//require_once(load_language("lang_staff_announcements.php"));
require_once ("language/english/lang_staff_announcements.php");
dbconn();
global $CURUSER, $BASEURL, $TABLE_PREFIX, $language;
$read=get_result("SELECT * from `{$TABLE_PREFIX}users` where `id`=".$CURUSER["uid"],true);
if ($CURUSER["uid"]>1 && $read[0]["announce_read"] == "no" && $arr = announcement($read[0]["announce_read"])) {

$alert='

<script type="text/javascript" src="'.$BASEURL.'/jscript/announcement.js"></script>

<script type="text/javascript" src="'.$BASEURL.'/jscript/preview.js"></script>

<!-- annoucement start #'.$arr[id].' -->

<div id="dropin" style="background-color:#231708;z-index:25;position:absolute;visibility:hidden;left:300px;top:100px;width:650px;height:100px;">

<table border="0" cellpadding="0" cellspacing="0" width="650">

<tr><td class="header" style="background-color:#231708;padding: 2px 0 0 10px;">

<font color=white><b>'.$language['TITLE'].':</b> '.$arr["subject"].' -- <b>'.$language['CREATED_ON'].'"</b> '.$arr["added"].'" <b>'.$language['BY'].':</b> '.$arr["by"].'</b></font></td>

<td width="16px" align="right" class="header" style="background-color:#231708;padding: 2px;"><a href="#" onClick="dismissbox();return false"><img src="./images/close.jpg" border="0"></a></td></tr>

<tr><td colspan="2" class="lista" width="650" style="background-color:#231708;padding: 0 0 0 5px;">

<p><font color=white>

'.format_comment($arr["message"]).'

</font></p>



<center><img id="loading" style="background-color:#231708;visibility: hidden;width:30px;height:30px;" src="./images/load.gif">

<span style="background-color:#231708;color:red;" name="preview" id="previewr" align="left" valign="top">

<a href="#" style="background-color:#231708;A:link:black;A:visited:black;A:active:black;A:hover:whit;" onclick="javascript:clearannouncement(this.parentNode,\''.$BASEURL.'/clear_ann.php?uid='.$read[0]["announce_read"].'\')"><font color=white>'.$language['MARK_READ'].'</font></a>

</span></center><br><br></form>

</td></tr></table>

</div>

<!-- annoucement end #'.$arr[id].'-->

<span id="new_ann" style="background-color:#231708;visibility: visible"><table border=0 cellspacing=0 cellpadding=10 bgcolor=red width=100% align=center><tr><td style=\'padding: 10px; background: red\' align=\'center\'>

<b><a href="javascript:show_announcement()"><font color=white>'.$language['NEW_ANNOUNCEMENT'].'</font></a></b></td></tr></table></span><br />

';
}else{ $alert='';}
echo $alert;
?>
