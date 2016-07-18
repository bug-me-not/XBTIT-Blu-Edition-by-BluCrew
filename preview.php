<?php
#################################################################
#
#         Preview for upload description.
#         Version 1.2
#         By Cooly for xbtitFM
#
#################################################################

require_once("include/functions.php");

dbconn(false);

global $CURUSER;
require("./".load_language("lang_upload.php"));
//get current style
  $resheet=do_sqlquery("SELECT * FROM {$TABLE_PREFIX}style where id=".$CURUSER["style"]."");
if (!$resheet)
   {

   $STYLEPATH="$THIS_BASEPATH/style/xbtit_default";
   $STYLEURL="$BASEURL/style/xbtit_default";
}
else
    {
        $resstyle=$resheet->fetch_array();
        $STYLEPATH="$THIS_BASEPATH/".$resstyle["style_url"];
        $STYLEURL="$BASEURL/".$resstyle["style_url"];
}


$text=(isset($_POST["data"]) && $_SERVER["REQUEST_METHOD"]=="POST"?htmlentities($_POST["data"]):$text='');
if($text!='')
{
echo"<link rel=\"stylesheet\" type=\"text/css\" href=\"".$STYLEURL."/bootstrap.css\" />";
echo '<table width="98%" class="main" align="center"><tr><td class="header" align="center">'.$language["UP_PREV"].'</div></td></tr><tr><td class="lista" align="center">'.format_comment($text).'</td></td></tr></table>';
}
else{
$reponce=array("responce","1");
echo"<div style='display: none;'>";
echo json_encode($responce);
echo"</div>";
}
?>