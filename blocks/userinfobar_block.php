<div class="col-md-6 col-lg-6">
<div class="clearfix visible-sm-block"></div>
<div class="clearfix visible-md-block"></div>
<div class='panel panel-default'>
<div class='panel-heading'><h4><i class='fa fa-fw fa-user'></i>Welcome Back</h4></div>
<div class='panel-body' align='center'>
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


print("<td style=\"text-align:left;\" align=\"left\"><a href='index.php?page=userdetails&id=".$CURUSER["uid"]."'> " . user_with_color($CURUSER["username"],$CURUSER["prefixcolor"],$CURUSER["suffixcolor"]) . get_user_icons($CURUSER) . warn($CURUSER). $rra .$upr.$udo.$udob.$ubir.$umal.$ufem.$uban.$uwar.$upar.$ubot.$utrmu.$utrmo.$uvimu.$uvimo.$ufrie.$ujunk.$ustaf.$usys." </a></td>");

//My Uploads
$res_up = do_sqlquery("SELECT count( * ) AS Count FROM {$TABLE_PREFIX}files WHERE uploader = {$CURUSER['uid']} AND anonymous='false' GROUP BY info_hash");
$up_count = sql_num_rows($res_up);
print("&nbsp;<td style=\"text-align:left;\" align=\"left\"><a class=\"mainmenu\">My Uploads: {$up_count}</td>&nbsp;&nbsp;&nbsp;");
//END My Uploads End

// Seeding/Leeching hack
$res = do_sqlquery("SELECT count( * ) AS Count FROM {$TABLE_PREFIX}peers WHERE status = 'seeder' AND pid ='".$CURUSER["pid"]."' GROUP BY infohash");
$res1 = do_sqlquery("SELECT count( * ) AS Count FROM {$TABLE_PREFIX}peers WHERE status = 'leecher' AND pid ='".$CURUSER["pid"]."' GROUP BY infohash");

//$num = $res->fetch_array(); $num1 = $res1->fetch_array();
$seeder=sql_num_rows($res); $leecher=sql_num_rows($res1);

print("&nbsp;<td style=\"text-align:center;\" align=\"center\">Seed: ".$seeder."</td>&nbsp;&nbsp;&nbsp;");
print("&nbsp;<td style=\"text-align:center;\" align=\"center\"><a class=\"mainmenu\">Leech: ".$leecher."</td>&nbsp;&nbsp;&nbsp;");
// END Seeding/Leeching hack

//Snatched torrents
$res_com = do_sqlquery("SELECT Count(*) as Count FROM {$TABLE_PREFIX}history WHERE uid = {$CURUSER['uid']} GROUP BY infohash");
$comp_count = sql_num_rows($res_com);
print("&nbsp;<td style=\"text-align:center;\" align=\"center\"><a class=\"mainmenu\">Snatched: {$comp_count}</td>&nbsp;&nbsp;&nbsp;");
//END Snatched torrents

//Stats
print("<spam style=\"text-align:right; color: #00C900\" align=\"center\">&uarr;&nbsp;".makesize($CURUSER['uploaded']));
print("</span><span style=\"text-align:center; color: #bd362f;\" align=\"left\">&nbsp;&darr;&nbsp;".makesize($CURUSER['downloaded']));
print("</span><span style=\"text-align:left; color: #636311;\" align=\"left\">&nbsp;(SR ".($CURUSER['downloaded']>0?number_format($CURUSER['uploaded']/$CURUSER['downloaded'],2):"---").")</span> \n");
//END Stats    

print "<br />";

// freeleech hack
   $query = do_sqlquery("SELECT *, UNIX_TIMESTAMP(`free_expire_date`) AS `timestamp` FROM `{$TABLE_PREFIX}files` WHERE `external`='no'", true);
   $row = $query->fetch_array()
;

if($row["free"]=="no" AND $row["happy_hour"] =="no" )
{
      $freec="blue";
      $till='';
      $col='Free Leech';
      $post=' Not Today';
      $img='';
}
if ($row["happy"]=="no" AND $row["happy_hour"] =="yes" )
{
   $happy1= do_sqlquery("SELECT UNIX_TIMESTAMP(`value_s`) AS `timestampp` FROM `{$TABLE_PREFIX}avps` WHERE `arg`='happyhour'");
   $happy2 =$happy1->fetch_array()
;

      $freec="red";
      $till='';
      $col='';
      $post='Next Happy Hour Starts '.date("l F jS Y \a\\t g:i a",$happy2["timestampp"]);
      $img='';
}
if($row["happy"]=="yes")
{
      $freec="green";
      $till='';
      $col='';
      $post='It Is Happy Hour ';
      $img ='<img src="images/proost.jpg" alt="free leech"/>';
}
if($row["free"]=="yes")
{
     $freec="green";
     $till=' To ';
     $col='Free Leech';
     $post=date("l jS F Y \a\\t g:i a",$row["timestamp"]);
     $img='';
}
/*else
{
            $freec="red";
            $till='';
            $col='';
            $post='VIP Free Leech Is Enabled';
            $img =''; 
}*/

print("<div class=\"background-color\"><p>".$col."".$till."".ucfirst($post)."\n(UTC)</p></div>\n");
// end freeleech hack

print "</tr>";

if (isset($CURUSER) && $CURUSER && $CURUSER["uid"]>1)
{
   print("<form name=\"jump1\" action=\"index.php\" method=\"post\">\n");

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


   print('</form>');
}
?>
</div>
</div>
</div>

