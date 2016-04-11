<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  Btiteam
//
//    This file is part of xbtit.
//
// Redistribution and use in source and binary forms, with or without modification,
// are permitted provided that the following conditions are met:
//
//   1. Redistributions of source code must retain the above copyright notice,
//      this list of conditions and the following disclaimer.
//   2. Redistributions in binary form must reproduce the above copyright notice,
//      this list of conditions and the following disclaimer in the documentation
//      and/or other materials provided with the distribution.
//   3. The name of the author may not be used to endorse or promote products
//      derived from this software without specific prior written permission.
//
// THIS SOFTWARE IS PROVIDED BY THE AUTHOR ``AS IS'' AND ANY EXPRESS OR IMPLIED
// WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
// MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.
// IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
// SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED
// TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
// PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF
// LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
// NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE,
// EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
//
////////////////////////////////////////////////////////////////////////////////////

require_once("include/smilies.php");
if (!isset($CURUSER)) global $CURUSER;
?>
<script type="text/javascript">
function SmileIT(smile){
    document.forms['shout'].elements['mess'].value = document.forms['shout'].elements['mess'].value+" "+smile+" ";
    document.forms['shout'].elements['mess'].focus();
}

function Pophistory() {
         newWin=window.open('index.php?page=allshout&amp;nocolumns=1','shouthistory','height=500,width=480,resizable=yes,scrollbars=yes');
         if (window.focus) {newWin.focus()}
}
function PopMoreSmiles(form,name) {
         newWin=window.open('index.php?page=moresmiles&amp;form='+form+'&amp;text='+name,'moresmile','height=500,width=450,resizable=yes,scrollbars=yes');
         if (window.focus) {newWin.focus()}
}

</script>
<?php
function clean_shoutbox(){
  $f=@fopen("chat.php","w");
  if($f){
    fwrite($f, "<?php\n?>");
  }
  @fclose($f);
  redirect($_SERVER["PHP_SELF"]);
  exit;

}

function format_shout($text)
{
    global $smilies, $BASEURL, $privatesmilies;

    $s = $text;

    $s = strip_tags($s);

    $s = unesc($s);

    $f=@fopen("badwords.txt","r");
    if ($f && filesize ("badwords.txt")!=0)
       {
       $bw=fread($f,filesize("badwords.txt"));
       $badwords=explode("\n",$bw);
       for ($i=0;$i<count($badwords);++$i)
           $badwords[$i]=trim($badwords[$i]);
       $s = str_replace($badwords,"*censured*",$s);
       }
    @fclose($f);

    // [b]Bold[/b]
    $s = preg_replace("/\[b\]((\s|.)+?)\[\/b\]/", "<b>\\1</b>", $s);

    // [i]Italic[/i]
    $s = preg_replace("/\[i\]((\s|.)+?)\[\/i\]/", "<i>\\1</i>", $s);

    // [u]Underline[/u]
    $s = preg_replace("/\[u\]((\s|.)+?)\[\/u\]/", "<u>\\1</u>", $s);

    // [color=blue]Text[/color]
    $s = preg_replace(
        "/\[color=([a-zA-Z]+)\]((\s|.)+?)\[\/color\]/i",
        "<font color=\\1>\\2</font>", $s);

    // [color=#ffcc99]Text[/color]
    $s = preg_replace(
        "/\[color=(#[a-f0-9][a-f0-9][a-f0-9][a-f0-9][a-f0-9][a-f0-9])\]((\s|.)+?)\[\/color\]/i",
        "<font color=\\1>\\2</font>", $s);

    // [url=http://www.example.com]Text[/url]
    $s = preg_replace(
        "/\[url=((http|ftp|https|ftps|irc):\/\/[^<>\s]+?)\]((\s|.)+?)\[\/url\]/i",
        "<a href=\\1 target=_blank>\\3</a>", $s);

    // [url]http://www.example.com[/url]
    $s = preg_replace(
        "/\[url\]((http|ftp|https|ftps|irc):\/\/[^<>\s]+?)\[\/url\]/i",
        "<a href=\\1 target=_blank>\\1</a>", $s);

    // [url]www.example.com[/url]
    $s = preg_replace(
        "/\[url\](www\.[^<>\s]+?)\[\/url\]/i",
        "<a href='http://\\1' target='_blank'>\\1</a>", $s);

    // [url=www.example.com]Text[/url]
    $s = preg_replace(
        "/\[url=(www\.[^<>\s]+?)\]((\s|.)+?)\[\/url\]/i",
        "<a href='http://\\1' target='_blank'>\\2</a>", $s);


    // [size=4]Text[/size]
    $s = preg_replace(
        "/\[size=([1-7])\]((\s|.)+?)\[\/size\]/i",
        "<font size=\\1>\\2</font>", $s);

    // [font=Arial]Text[/font]
    $s = preg_replace(
        "/\[font=([a-zA-Z ,]+)\]((\s|.)+?)\[\/font\]/i",
        "<font face=\"\\1\">\\2</font>", $s);

    // Linebreaks
    $s = nl2br($s);

    // Maintain spacing
    $s = str_replace("  ", " &nbsp;", $s);

    reset($smilies);
    while (list($code, $url) = each($smilies))
        $s = str_replace($code, "<img border=\"0\" src=\"$BASEURL/images/smilies/$url\" alt=\"$code\" />", $s);

    reset($privatesmilies);
    while (list($code, $url) = each($privatesmilies))
        $s = str_replace($code, "<img border=\"0\" src=\"$BASEURL/images/smilies/$url\" alt=\"$code\" />", $s);


    return $s;
}

function smile() {
?>
<div align="center">
  <table cellpadding="1" cellspacing="1">
  <tr>
  <?php

  global $smilies, $count;
  reset($smilies);

  while ((list($code, $url) = each($smilies)) && $count<20)
        {
        print("\n<td><a href=\"javascript: SmileIT('".str_replace("'","\'",$code)."')\"><img border=\"0\" src=\"images/smilies/$url\" alt=\"$code\" /></a></td>");
        $count++;
        }
  ?>
  </tr>
  </table>
</div>
<?php
}

function safehtml($string)
{
$validcharset=array(
"ISO-8859-1",
"ISO-8859-15",
"UTF-8",
"cp866",
"cp1251",
"cp1252",
"KOI8-R",
"BIG5",
"GB2312",
"BIG5-HKSCS",
"Shift_JIS",
"EUC-JP");

   if (in_array($GLOBALS["charset"],$validcharset))
      return htmlentities($string,ENT_COMPAT,$GLOBALS["charset"]);
   else
       return htmlentities($string);
}

echo "";
$msg = array();
function file_save($filename, $content, $flags = 0)
{if (!($file = fopen($filename, 'w')))
     return FALSE;
$n = fwrite($file, $content);
fclose($file);
return $n ? $n : FALSE;
}

if (!file_exists("chat.php")) file_save("chat.php","<?php\n\$msg = ".var_export($msg,TRUE)."\n?>");

include "chat.php";
/*
$canpost = empty($_POST['submit']) ? 'Refresh' : $_POST['submit'];
$canpost = ($canpost == 'Refresh') ? 0 : 1;
*/
if (!empty($_POST['mess']) && !empty($_POST['pseudo']))
{
  $i = count($msg);
  if ($i == 0) $oldi = 0;
  else $oldi = $i - 1;

  if (!isset($msg[$oldi]['texte']) || $msg[$oldi]['texte'] != htmlspecialchars($_POST['mess']))
  {
  $msg[$i]['pseudo'] = htmlspecialchars($_POST['pseudo']);
  $msg[$i]['texte'] = htmlspecialchars($_POST['mess']);
  $msg[$i]['date'] = time();
  unset ($_POST['pseudo']);
  unset ($_POST['mess']);
  }
}

$msg2 = array_reverse($msg);
echo '<div align="left" class="chat"><table width="95%" align="center"> <tr><td>';
include("include/offset.php");
for ($i=0;$i<10 && $i<count($msg2);++$i)
{
  $sql="SELECT u.id as uid,prefixcolor,suffixcolor FROM {$TABLE_PREFIX}users u INNER JOIN {$TABLE_PREFIX}users_level ul ON ul.id_level=u.id_level WHERE u.username='".$msg2[$i]['pseudo']."'";
  $res = do_sqlquery($sql);
  $result=$res->fetch_assoc();
  // user or level don't exit in db
  if (!$result)
    echo '<b>'.'</b>&nbsp;&nbsp;&nbsp;['.date("d/m/y H:i",$msg2[$i]['date']-$offset).']'.'&nbsp;&nbsp;<b>'.$msg2[$i]['pseudo'].'</b>:&nbsp;&nbsp;&nbsp;'.format_shout($msg2[$i]['texte']).'<hr>';
  else
  {

    global $btit_settings, $res_seo;

    echo '<b>'.'</b>&nbsp;&nbsp;&nbsp;['.date("d/m/y H:i",$msg2[$i]['date']-$offset).']'."&nbsp;&nbsp;<a style='text-decoration:none' href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$result["uid"]."_".strtr($msg2[$i]["pseudo"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$result["uid"])."'>".unesc($result['prefixcolor']).$msg2[$i]['pseudo'].unesc($result['suffixcolor']).'</a>:&nbsp;&nbsp;&nbsp;'.format_shout($msg2[$i]['texte']).'<hr />';
    unset($result);
  }
  $res->free();
}
echo "</td></tr></table></div>";

file_save("chat.php", "<?php\n\$msg = ".var_export($msg,TRUE)."\n?>");

unset ($_POST['pseudo']);
unset ($_POST['mess']);

if ($CURUSER["uid"]>1)
{
/*
header("Expires: Mon, 1 Jan 1990 01:00:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
*/
?>
<div class="miniform" align="center">
<form method="post" name="shout" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
<input type="hidden" name="pseudo" value="<?php echo $CURUSER["username"]?>" /><br />
<input name="mess" size="70" maxlength="100" />
<br />
<a href="javascript: PopMoreSmiles('shout','mess')">Emoticons</a> &nbsp; &nbsp; &nbsp;<input name="submit" type="submit" value="<?php echo $language["FRM_CONFIRM"]; ?>" />&nbsp;&nbsp;
<input name="submit" type="submit" value="<?php echo $language["FRM_REFRESH"]; ?>" />&nbsp;&nbsp;
<?php
$messages = count($msg);
if ($messages > 0){
if ($CURUSER["edit_torrents"]=="yes"){
?>
    <input type="submit" name="action" value="<?php echo $language["FRM_CLEAN"]; ?>" /> &nbsp; &nbsp; &nbsp;<a href="javascript: Pophistory()"><?php echo $language["HISTORY"]; ?></a>
<?php
if (isset($_POST['action']) && $_POST['action'] == 'Clean') clean_shoutbox();
}
else {
?>
<a href="javascript: Pophistory()"><?php echo $language["HISTORY"]; ?></a>
<?php
  }
}
?>
</form>
</div>
<?php
}
else
    print("<div align=\"center\"><a href=\"javascript: Pophistory()\">".$language["HISTORY"]."</a>\n<br />".$language["ERR_MUST_BE_LOGGED_SHOUT"]."</div>");

?>
