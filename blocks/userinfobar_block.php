<div class="panel panel-primary">
    <div class="panel-heading">
    <h3 class="panel-title">User Info Bar</h3>
    </div>
    <div class="panel-body">
<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2014  Btiteam
//
//    This file is part of xbtit v 1.0 by BluCrew
//
////////////////////////////////////////////////////////////////////////////////////

global $CURUSER, $XBTT_USE, $TABLE_PREFIX, $btit_settings, $language, $INVITATIONSON, $FORUMLINK, $db_prefix, $btit_settings, $ipb_prefix;
print("<table cellpadding=\"2\" cellspacing=\"1\" width=\"80%\" border=\"0\" align=\"center\"><tr>\n");


// DT Uploader Medals
$resuser=do_sqlquery("SELECT  trophy, reputation , up_med FROM {$TABLE_PREFIX}users WHERE id =".$CURUSER['uid']);
$rowuser= $resuser->fetch_array();

if ($rowuser["up_med"] == 0)
$upr="";

if ($rowuser["up_med"] == 1)
$upr= "<img src='images/goblet/medaille_bronze.gif' alt='Bronze Medal' title='Bronze Medal' />";

if ($rowuser["up_med"] == 2)
$upr= "<img src='images/goblet/medaille_argent.gif' alt='Silver Medal' title='Silver Medal' />";

if ($rowuser["up_med"] >= 3)
$upr= "<img src='images/goblet/medaille_or.gif' alt='Gold Medal' title='Gold Medal' />";
// DT Uploader Medals

// DT arcade
if ($rowuser["trophy"] == 0)
$rra="";

if ($rowuser["trophy"] == 1)
$rra= "<img src='images/crown.gif' alt='Arcade King' title='Arcade King' />";

// DT arcade

// user image
$do=$btit_settings["img_don"];
$don=$btit_settings["img_donm"];
$ma=$btit_settings["img_mal"];
$fe=$btit_settings["img_fem"];
$ba=$btit_settings["img_ban"];
$tu=$btit_settings["img_tru"];
$vi=$btit_settings["img_vip"];
$wa=$btit_settings["img_war"];
$st=$btit_settings["img_sta"];
$bi=$btit_settings["img_bir"];
$pa=$btit_settings["img_par"];
$sy=$btit_settings["img_sys"];
$vip=$btit_settings["img_vipm"];
$tut=$btit_settings["img_trum"];
$fr=$btit_settings["img_fri"];
$ju=$btit_settings["img_jun"];
$bo=$btit_settings["img_bot"];

$udo="";
$udob="";
$ubir="";
$umal="";
$ufem="";
$uban="";
$uwar="";
$upar="";
$ubot="";
$utrmu="";
$utrmo="";
$uvimu="";
$uvimo="";
$ufrie="";
$ujunk="";
$ustaf="";
$usys="";

if ($CURUSER["dona"] == 'yes')
$udo= "&nbsp;<img src='images/user_images/" . $do . "' alt='" . $btit_settings["text_don"] . "' title='" . $btit_settings["text_don"] . "' />";

if ($CURUSER["donb"] == 'yes')
$udob= "&nbsp;<img src='images/user_images/" . $don . "' alt='" . $btit_settings["text_donm"] . "' title='" . $btit_settings["text_donm"] . "' />";

if ($CURUSER["birt"] == 'yes')
$ubir= "&nbsp;<img src='images/user_images/" . $bi . "' alt='" . $btit_settings["text_bir"] . "' title='" . $btit_settings["text_bir"] . "' />";

if ($CURUSER["mal"] == 'yes')
$umal= "&nbsp;<img src='images/user_images/" . $ma . "' alt='" . $btit_settings["text_mal"] . "' title='" . $btit_settings["text_mal"] . "' />";

if ($CURUSER["bann"] == 'yes')
$uban= "&nbsp;<img src='images/user_images/" . $ba . "' alt='" . $btit_settings["text_ban"] . "' title='" . $btit_settings["text_ban"] . "' />";

if ($CURUSER["war"] == 'yes')
$uwar= "&nbsp;<img src='images/user_images/" . $wa . "' alt='" . $btit_settings["text_war"] . "' title='" . $btit_settings["text_war"] . "' />";

if ($CURUSER["fem"] == 'yes')
$ufem= "&nbsp;<img src='images/user_images/" . $fe . "' alt='" . $btit_settings["text_fem"] . "' title='" . $btit_settings["text_fem"] . "' />";

if ($CURUSER["par"] == 'yes')
$upar= "&nbsp;<img src='images/user_images/" . $pa . "' alt='" . $btit_settings["text_par"] . "' title='" . $btit_settings["text_par"] . "' />";

if ($CURUSER["bot"] == 'yes')
$ubot= "&nbsp;<img src='images/user_images/" . $bo . "' alt='" . $btit_settings["text_bot"] . "' title='" . $btit_settings["text_bot"] . "' />";

if ($CURUSER["trmu"] == 'yes')
$utrmu= "&nbsp;<img src='images/user_images/" . $tu . "' alt='" . $btit_settings["text_tru"] . "' title='" . $btit_settings["text_tru"] . "' />";

if ($CURUSER["trmo"] == 'yes')
$utrmo= "&nbsp;<img src='images/user_images/" . $tut . "' alt='" . $btit_settings["text_trum"] . "' title='" . $btit_settings["text_trum"] . "' />";

if ($CURUSER["vimu"] == 'yes')
$uvimu= "&nbsp;<img src='images/user_images/" . $vi . "' alt='" . $btit_settings["text_vip"] . "' title='" . $btit_settings["text_vip"] . "' />";

if ($CURUSER["vimo"] == 'yes')
$uvimo= "&nbsp;<img src='images/user_images/" . $vip . "' alt='" . $btit_settings["text_vipm"] . "' title='" . $btit_settings["text_vipm"] . "' />";

if ($CURUSER["friend"] == 'yes')
$ufrie= "&nbsp;<img src='images/user_images/" . $fr . "' alt='" . $btit_settings["text_fri"] . "' title='" . $btit_settings["text_fri"] . "' />";

if ($CURUSER["junkie"] == 'yes')
$ujunk= "&nbsp;<img src='images/user_images/" . $ju . "' alt='" . $btit_settings["text_jun"] . "' title='" . $btit_settings["text_jun"] . "' />";

if ($CURUSER["staff"] == 'yes')
$ustaf= "&nbsp;<img src='images/user_images/" . $st . "' alt='" . $btit_settings["text_sta"] . "' title='" . $btit_settings["text_sta"] . "' />";

if ($CURUSER["sysop"] == 'yes')
$usys= "&nbsp;<img src='images/user_images/" . $sy . "' alt='" . $btit_settings["text_sys"] . "' title='" . $btit_settings["text_sys"] . "' />";
// user image


print("<td class=\"header\" align=\"center\"><a class=\"mainmenu\">".$language["WELCOME_BACK"]."<a href='index.php?page=userdetails&id=".$CURUSER["uid"]."'> " . user_with_color($CURUSER["username"],$CURUSER["prefixcolor"],$CURUSER["suffixcolor"]) . get_user_icons($CURUSER) . warn($CURUSER). $rra .$upr.$udo.$udob.$ubir.$umal.$ufem.$uban.$uwar.$upar.$ubot.$utrmu.$utrmo.$uvimu.$uvimo.$ufrie.$ujunk.$ustaf.$usys." </a></td>");

//My Uploads
$res_up = do_sqlquery("SELECT count( * ) AS Count FROM {$TABLE_PREFIX}files WHERE uploader = {$CURUSER['uid']} AND anonymous='false' GROUP BY info_hash");
$up_count = sql_num_rows($res_up);
print("<td class=\"header\" align=\"center\"><a class=\"mainmenu\"><a href='index.php?page=my_uploads&id=".$CURUSER["uid"]."'>My Uploads: {$up_count}</a></td>");
//My Uploads End

// Seeding/Leeching hack
$res = do_sqlquery("SELECT count( * ) AS Count FROM {$TABLE_PREFIX}peers WHERE status = 'seeder' AND pid ='".$CURUSER["pid"]."' GROUP BY infohash");
$res1 = do_sqlquery("SELECT count( * ) AS Count FROM {$TABLE_PREFIX}peers WHERE status = 'leecher' AND pid ='".$CURUSER["pid"]."' GROUP BY infohash");

//$num = $res->fetch_array(); $num1 = $res1->fetch_array();
$seeder=sql_num_rows($res); $leecher=sql_num_rows($res1);

print("<td class=\"header\" align=\"center\"><a class=\"mainmenu\"><a href='index.php?page=active&id=".$CURUSER["uid"]."'>Seed: ".$seeder."</a></td>");
print("<td class=\"header\" align=\"center\"><a class=\"mainmenu\"><a href='index.php?page=active&id=".$CURUSER["uid"]."'>Leech: ".$leecher."</a></td>");
// END Seeding/Leeching hack

//Snatched torrents
$res_com = do_sqlquery("SELECT Count(*) as Count FROM {$TABLE_PREFIX}history WHERE uid = {$CURUSER['uid']} GROUP BY infohash");
$comp_count = sql_num_rows($res_com);
print("<td class=\"header\" align=\"center\"><a class=\"mainmenu\"><a href='index.php?page=snatched&id=".$CURUSER["uid"]."'>Snatched: {$comp_count}</a></td>");
//Snatched torrents

print("<td class=\"header\" align=\"center\"><a class=\"mainmenu\">".$xx."</td>\n");
print("<td class=\"green\" align=\"center\"><a class=\"mainmenu\"> &uArr;&nbsp;".makesize($CURUSER['uploaded']));
print("</td><td class=\"red\" align=\"center\"><a class=\"mainmenu\"> &dArr;&nbsp;".makesize($CURUSER['downloaded']));
print("</td><td class=\"yellow\" align=\"center\"><a class=\"mainmenu\">&#8645;&nbsp;".($CURUSER['downloaded']>0?number_format($CURUSER['uploaded']/$CURUSER['downloaded'],2):"---")."</td>\n");

if ($CURUSER["announce"]=="yes")
print("<td class=\"header\" align=\"center\"><a class=\"mainmenu\"><a href=\"index.php?page=announcement&amp;uid=".$CURUSER["uid"]."\"><img src=\"images/ann.png\"></a></td>\n");

print("<td class=\"header\" align=\"center\"><a class=\"mainmenu\">".$rep." \n");

print("<td class=\"header\" align=\"center\"><a class=\"mainmenu\">".$col."<font color='$freec'>$till".ucfirst($post)."</font> $pic</td>\n");

print "</tr></table>";

if (isset($CURUSER) && $CURUSER && $CURUSER["uid"]>1)
{
   print("<form name=\"jump1\" action=\"index.php\" method=\"post\">\n");

   print("<table cellpadding=\"2\" cellspacing=\"1\" width=\"100%\" border=\"0\" align=\"center\"><tr>\n");

   $style=style_list();
   $langue=language_list();
   $block[0]["id"]="yes";
   $block[0]["block"]="side blocks";
   $block[1]["id"]="nol";
   $block[1]["block"]="no left";
   $block[2]["id"]="nor";
   $block[2]["block"]="no right";
   $block[3]["id"]="no";
   $block[3]["block"]="no blocks";
   
    if($btit_settings["fmhack_free_leech_with_happy_hour"]=="enabled")
   {
      $query = get_result("SELECT free, happy_hour, happy, UNIX_TIMESTAMP(`free_expire_date`) AS `timestamp` FROM `{$TABLE_PREFIX}files` WHERE `external`='no' LIMIT 1",true,$btit_settings["cache_interval"]);
      $row = $query[0];

      if(($row["free"]=="no" AND $row["happy_hour"] =="no") || (@sql_num_rows($query)==0))
      {
         $freec="blue";
         $till='';
         $col=$language['FL_FREE_LEECH'];
         $post=' '.$language['FL_NOT_TODAY'];
         $img='';
      }
	  
	   if($row["free"]=="yes")
      {
         $freec="green";
         $till=' '.$language['FL_TO'].' ';
         $col=$language['FL_FREE_LEECH'];
         $post=date("l F jS Y \a\\t g:i a",$row["timestamp"]);
         $img='';
      }
      print("</tr><tr><td class=\"mainuser\" align=\"center\" colspan=\"10\" style=\"text-align:center; padding-top:12px; padding-left:20px; float:none; font-style:italic; font-family: Verdana, Arial, Helvetica, sans-serif;\"><font color='$freec'>".$col."".$till."".ucfirst($post)."</font>".(($img!="")?"&nbsp;&nbsp;&nbsp;".$img:"")."</td>\n");
   }

   // torrent search here
   print('</tr></table></form>');
}
else
{
   session_name("xbtit");
   session_start();
   $_SESSION=array();
   setcookie("xbtit", "", time()-3600, "/");
   session_destroy();


   if (!isset($user)) $user = '';

   if($btit_settings["log_sw_dt"]=='diem')
   {
      print('<form action="index.php?page=login" name="login" method="post">
      <center>  <div id="diemthuy" >
      <table class="lista" border="0" width="100%" cellpadding="4" cellspacing="1" align="right"><tr>
      <br /><tr>
      <td align="right" class="lista">&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/SignOpen24Hours.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
      <td align="right" class="lista"><font color="yellow"><b>'.$language["USER_NAME"].':</b></td>
      <td class="lista" style="padding-left:5px;"><input type="text" size="15" name="uid" id="want_username" value="'.$user.'" maxlength="40" style="font-size:10px;" /></td>
      <td align="right" class="lista"><font color="yellow"><b>'.$language["USER_PWD"].':</b></td>
      <td class="lista" style="padding-left:5px;"><input type="password" size="15" name="pwd" id="want_password" maxlength="40" style="font-size:10px;" /></td>
      <td class="lista" align="center" style="padding-left:10px;"><input type="submit" value="'.$language["FRM_LOGIN"].'" style="font-size:10px;" /></td></tr>');

   print('</tr> </table> <br /><br /><br /><br /><br /><br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /><br />
   <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /><table class="lista" border="0" width="38%" cellpadding="4" cellspacing="1" align="right" ><tr>');

   if ($btit_settings["ua_on"]== true)
   {
      print('<td class="lista" align="right"><a class="lista"  href="index.php?page=agree"><img src="images/signup.png" /></a><a class="lista"  href="index.php?page=recover">&nbsp;&nbsp;&nbsp;<img src="images/recover.png" /></a></td>');
   }
   else
   {
      print('<td class="lista" align="right"><a class="lista"  href="index.php?page=account"><img src="images/signup.png" /></a><a class="lista"  href="index.php?page=recover">&nbsp;&nbsp;&nbsp;<img src="images/recover.png" /></a></td>');
   }
   print('</tr></table></div></center></form>');
}
if($btit_settings["log_sw_dt"]=='regular')
{
   print('<form action="index.php?page=login" name="login" method="post">
   <table class="lista" border="0" width="100%" cellpadding="4" cellspacing="1">
   <tr>
   <td class="lista" align="left">
   <table border="0" cellpadding="0" cellspacing="0">
   <tr>
   <td class="lista" style="text-align:left; padding-left:27px;">'.$language["USER_NAME"].':&nbsp;</td>
   <td class="lista"><input type="text" size="15" name="uid" value="'.$user.'" maxlength="40" style="font-size:10px" />&nbsp;&nbsp;</td>
   <td class="lista" style="text-align:left; padding-left:17px;">'.$language["USER_PWD"].':&nbsp;</td>
   <td class="lista"><input type="password" size="15" name="pwd" maxlength="40" style="font-size:10px" />&nbsp;</td>
   <td class="lista" align="center"><input type="submit" value="'.$language["FRM_LOGIN"].'" style="font-size:10px" /></td></tr></table>');

print '</td>';

if ($btit_settings["ua_on"]== true)
print("<td style=\"text-align:center;\" align=\"center\"><a href=\"index.php?page=agree \">".$language["ACCOUNT_CREATE"]."</a></td>\n");
else
print("<td style=\"text-align:center;\" align=\"center\"><a href=\"index.php?page=account \">".$language["ACCOUNT_CREATE"]."</a></td>\n");

print('<td class="lista" align="center"><a class="mainuser"  href="index.php?page=recover">'.$language["RECOVER_PWD"].'</a></td></tr></table></form>');
}
if($btit_settings["log_sw_dt"]=='yupy')
{
   // jquery login
   if($btit_settings["logisw"]==false)
   {
      print('<link rel="stylesheet" href="css_login.css" type="text/css" />');
   }
   else
   {
      print('<link rel="stylesheet" href="css_login_dt.css" type="text/css" />');
   }

   print('<script type="text/javascript">

   animatedcollapse.addDiv(\'yupylogin\',\'fade=1,height=auto\')
   animatedcollapse.addDiv(\'yupyrecover\',\'fade=1,height=auto\')
   animatedcollapse.addDiv(\'yupysignup\',\'fade=1,height=auto\')


   animatedcollapse.ontoggle=function($, divobj, state){ }

   animatedcollapse.init()

   </script>
   <div align="center" style="margin-top:1%;">&nbsp;&nbsp;

   <img class="login" style="cursor:pointer" src="images/pic/blank.gif" onclick="javascript:animatedcollapse.toggle(\'yupylogin\'); javascript:animatedcollapse.hide(\'yupyrecover\'); javascript:animatedcollapse.hide(\'yupysignup\');javascript:animatedcollapse.hide(\'yupykontakt\')" alt="login" />&nbsp;

   <img class="recover" style="cursor:pointer" src="images/pic/blank.gif" onclick="javascript:animatedcollapse.toggle(\'yupyrecover\'); javascript:animatedcollapse.hide(\'yupylogin\');javascript:animatedcollapse.hide(\'yupysignup\');javascript:animatedcollapse.hide(\'yupykontakt\')" alt="recover" />&nbsp;');

   if ($btit_settings["ua_on"]== true)
   {
      print('<a href="index.php?page=agree" class="normal" target="_parent"><img class="signup" style="cursor:pointer" src="images/pic/blank.gif" alt="signup" /></a>&nbsp;');
   }
   else
   {
      print('<a href="index.php?page=signup" class="normal" target="_parent"><img class="signup" style="cursor:pointer" src="images/pic/blank.gif" alt="signup" /></a>&nbsp;');
   }
   print('<div id="yupylogin" style="display:none">
   <form action="index.php?page=login" name="login" method="post">

   <table class="lista" border="0" cellpadding="10">
   <tr><td class="tboxhead"></td></tr>
   <tr><td align="center" class="tboxmidd"><pre><font size="3">User Name</font>:&nbsp;<input type="text" size="40" name="uid" value="'.$user.'" maxlength="40" /></pre></td></tr>
   <tr><td align="center" class="tboxmidd"><pre><font size="3">Password</font>:&nbsp;<input type="password" size="40" name="pwd" maxlength="40" /></pre></td></tr>
   <tr><td colspan="2" class="tboxmidd" align="center"><input type="submit" value="Login" /></td></tr>
   <tr><td colspan="2" class="tboxmidd" align="center"><font size=2>You Need Cookies Enabled</font></td></tr>
   <tr><td class="tboxfoot"></td></tr></table></form></div><br>');

   global $USE_IMAGECODE;
   if ($USE_IMAGECODE)
   {
      if (extension_loaded('gd'))
      {
         $arr = gd_info();
         if ($arr['FreeType Support']==1)
         {
            $p=new ocr_captcha();
            $reksec=($p->display_captcha(true));
            $private=$p->generate_private();
         }
         else
         {
            include("include/security_code.php");
            $scode_index = rand(0, count($security_code) - 1);
            $scode="<input type=hidden name=security_index value=$scode_index />n";
            $scode.=$security_code[$scode_index]["question"];
            $reksec=$scode;
         }
      }
      else
      {
         include("include/security_code.php");
         $scode_index = rand(0, count($security_code) - 1);
         $scode="<input type=hidden name=security_index value=$scode_index />n";
         $scode.=$security_code[$scode_index]["question"];
         $reksec=$scode;
      }
   }
   else
   {
      include("include/security_code.php");
      $scode_index = rand(0, count($security_code) - 1);
      $scode="<input type=hidden name=security_index value=$scode_index />n";
      $scode.=$security_code[$scode_index]["question"];
      $reksec=$scode;
   }

   print('<div id="yupyrecover" style="display:none">
   <div align="center">
   <form action="index.php?page=recover&amp;act=takerecover" name="recover" method="post">
   <table class="lista" border="0" cellpadding="15">
   <tr><td class="tboxhead"></td></tr>
   <tr><td align="center" class="tboxmidd"><pre><font size="3">Email:</font><input type=text size=40 name=email></pre></td></tr>
   <tr>
   <td colspan="2" align="center" class="tboxmidd"><pre><pre><font size="3">Security code: '.$reksec.'</font><input type="text" id="captcha" name="'.($USE_IMAGECODE?"private_key":"scode_answer").'" maxlength="6" size="6" value="" /></pre></td>
   </tr>
   <tr><td colspan="2" class="tboxmidd" align="center"><input type="submit" value="Send" /></td></tr>
   <tr><td class="tboxfoot"></td></tr></table></form></div><br /></div></center>');
   // jquery login
}
}
?>
</div></div>
