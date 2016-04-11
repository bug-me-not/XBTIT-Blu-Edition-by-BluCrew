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


define("IN_BTIT",true);


$THIS_BASEPATH=dirname(__FILE__);
require("$THIS_BASEPATH/include/functions.php");

dbconn();



// get user's style
$resheet=get_result("SELECT * FROM {$TABLE_PREFIX}style where id=".$CURUSER["style"]."",true,$btit_settings['cache_duration']);
if (!$resheet)
   {

   $STYLEPATH="$THIS_BASEPATH/style/xbtit_default";
   $STYLEURL="$BASEURL/style/xbtit_default";
   $style="$BASEURL/style/xbtit_default/main.css";
   }
else
    {
        $resstyle=$resheet[0];
        $STYLEPATH="$THIS_BASEPATH/".$resstyle["style_url"];
        $style="$BASEURL/".$resstyle["style_url"]."/main.css";
        $STYLEURL="$BASEURL/".$resstyle["style_url"];
    }


$idlang=intval($_GET["language"]);

// getting user language
if ($idlang==0)
   $reslang=get_result("SELECT * FROM {$TABLE_PREFIX}language WHERE id=".$CURUSER["language"],true,$btit_settings['cache_duration']);
else
   $reslang=get_result("SELECT * FROM {$TABLE_PREFIX}language WHERE id=$idlang",true,$btit_settings['cache_duration']);

if (!$reslang)
   {
   $USERLANG="$THIS_BASEPATH/language/english";
   }
else
    {
        $rlang=$reslang[0];
        $USERLANG="$THIS_BASEPATH/".$rlang["language_url"];
    }

if (!file_exists($USERLANG))
    {
    die("Error!<br />\nMissing Language!<br />\n");
}


require_once(load_language("lang_main.php"));

if (!empty($language["charset"]))
   $GLOBALS["charset"]=$language["charset"];

if (isset($_GET['action']) && $_GET['action'])
            $action=$_GET['action'];
else $action = '';;


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php echo (!empty($language["rtl"])?"<html dir=\"".$language["rtl"]."\">\n":"<html>\n"); ?>
  <head>
  <title>Search User</title>
  <meta http-equiv="content-type" content="text/html; charset=<?php echo $GLOBALS["charset"] ?>/>" />
  <link rel="stylesheet" href="<?php echo $style; ?>" type="text/css" />
  </head>
  <body>
<?php

if ($action!="find")
   {
?>
<form action="searchusers.php?action=find" name="users" method="post">
<div align="center">
  <table class="lista">
  <tr>
     <td class="header"><?php echo $language["USER_NAME"];?>:</td>
     <td class="lista"><input type="text" name="user" size="40" maxlength="40" /></td>
     <td class="lista"><input type="submit" name="confirm" value="Search" /></td>
  </tr>
  </table>
</div>
</form>
<?php
}
else
{
  $res=get_result("SELECT username FROM {$TABLE_PREFIX}users WHERE id>1 AND username LIKE '%".sql_esc($_POST["user"])."%' ORDER BY username",true,$btit_settings['cache_duration']);
  if (!$res or count($res)==0)
     {
         print("<center>".$language["NO_USERS_FOUND"]."!<br />");
         print("<a href=searchusers.php>".$language["RETRY"]."</a></center>");
     }
  else {
?>
<script type="text/javascript">

function SendIT(){
    window.opener.document.forms['edit'].elements['receiver'].value = document.forms['result'].elements['name'].options[document.forms['result'].elements['name'].options.selectedIndex].value;
    window.close();
}
</script>

<div align="center">
  <form action="searchusers.php?action=find" name="result" method="post">
  <table class="lista">
  <tr>
     <td class="header"><?php print($language["USER_NAME"]);?>:</td>
<?php
     print("\n<td class=\"lista\">
     <select name=\"name\" size=\"1\">");
     foreach($res as $id=>$result)
         print("\n<option value=\"".$result["username"]."\">".$result["username"]."</option>");
     print("\n</select>\n</td>");
     print("\n<td class=\"lista\"><input type=\"button\" name=\"confirm\" onclick=\"javascript:SendIT();\" value=\"".$language["FRM_CONFIRM"]."\" /></td>");
?>
  </tr>
  </table>
  </form>
</div>
<?php
   }
}
print("\n<br />\n<div align=\"center\"><a href=\"javascript: window.close()\">".$language["CLOSE"]."</a></div>");
print("</body>\n</html>\n");
?>
