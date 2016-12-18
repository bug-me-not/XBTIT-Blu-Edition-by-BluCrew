<?php
require"../include/functions.php";
dbconn(true);
global $CURUSER;

if($CURUSER["can_upload"]!="yes")
die("No Dice!");

require("../".load_language("lang_main.php"));

$_GET["searchtag"]=preg_replace(array('/[^A-Za-z0-9 ]/', '/\s\s+/'), array('', ' '), $_GET["searchtag"]);
$search1 = urlencode ($_GET["searchtag"]);
$search = sql_esc($search1);
$link = "http://images.google.com/images?hl=de&q=$search&btnG=Bilder-Suche&gbv=1&safe=active";
$code = file_get_contents($link,'r');
die(var_dump($code));
preg_match_all('/imgurl\=http\:\/\/www\.[A-Za-z0-9-]*.[A-Za-z]*[^.]*.[A-Za-z]*/', $code, $img);

echo "<table width=100%><tr><td class=block>".$language["IMG_INFO"]."</td></tr><tr><td class=lista>";

foreach($img[0] as $k => $v)
{
   preg_match("#http://(.*)#", $v, $img_pic);
   if(file_exists($img_pic[0]))
   $url=getimagesize($img_pic[0]);

   if(!is_array($url))
   {
      echo "<img src='".$BASEURL."/images/question.gif' style='width: 100px;'></a>&nbsp;";
   }else{
      echo "<a href=\"javascript:ProcessIMG('$img_pic[0]');\" rel='thumbnail'><img src='$img_pic[0]' style='width: 100px;'></a>&nbsp;";
   }
}
echo"</td></tr></table>";
?>
