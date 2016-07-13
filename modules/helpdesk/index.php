<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  Btiteam
//
//  converted from BTI to XBTIT by DiemThuy - Feb 2008
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

ob_start();
if (!$CURUSER || $CURUSER["view_torrents"]=="no")
   {
    err_msg($language["ERROR"] . " " . $language["NOT_AUTHORIZED"],$language["HD_SORRY"]."...");
    stdfoot();
    exit();
   }
else
    {
     

function round_time($ts)
{

  global $language;

  $mins = floor($ts / 60);
  $hours = floor($mins / 60);
  $mins -= $hours * 60;
  $days = floor($hours / 24);
  $hours -= $days * 24;
  $weeks = floor($days / 7);
  $days -= $weeks * 7;
  $t = "";
  if ($weeks > 0)
    return $weeks . (($weeks==1)?$language["HD_WEEK"]:$language["HD_WEEKS"]);
  if ($days > 0)
    return $days . (($weeks==1)?$language["HD_DAY"]:$language["HD_DAYS"]);
  if ($hours > 0)
    return $hours . (($weeks==1)?$language["HD_HOUR"]:$language["HD_HOURS"]);
  if ($mins > 0)
    return $mins . (($weeks==1)?$language["HD_MIN"]:$language["HD_MINS"]);
  return "< 1 " . $language["HD_MIN"];
}

$msg_problem = trim($_POST["msg_problem"]);
$msg_answer = trim($_POST["msg_answer"]);
$id = $_POST["id"];
$addedbyid = $_POST["addedbyid"];
$title = trim($_POST["title"]);

$action = $_GET["action"];
$solve = $_GET["solve"];

// --- action: cleanuphd
if ($action == 'cleanuphd') {
    quickQuery("DELETE FROM {$TABLE_PREFIX}helpdesk WHERE solved='yes' OR solved='ignored'");
    $action = 'problems';
}
// --- action: problems

if ($action == 'problems') {

if (!$CURUSER || $CURUSER["id_level"] < 6) // 6 is default id_level for moderators
{
  err_msg($language["HD_SORRY"]."...", $language["HD_NOT_AUTHORIZED"]);
  stdfoot();
  die;
}

// Standard HD Replies
// English
$hd_reply['1'] = array($language["HD_RTF"],$language["HD_RTF2"]);
$hd_reply['2'] = array($language["HD_STF"],$language["HD_STF2"]);
$hd_reply['3'] = array($language["HD_DN"],$language["HD_DN2"]);

// POST & GET
$id = $_GET["id"];
$hd_answer=$_POST["hd_answer"];
if ($hd_answer) {
		$body = $hd_reply[$hd_answer][1];
 }

//block_begin("Problems");

// VIEW PROBLEM DETAILS
if ($id != 0) {

$res = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}helpdesk WHERE id='$id'");
$arr = $res->fetch_array();

$zap = do_sqlquery("SELECT username FROM {$TABLE_PREFIX}users WHERE id='$arr[added_by]'");
$wyn = $zap->fetch_array();

$added_by_name = $wyn["username"];

$zap_s = do_sqlquery("SELECT username FROM {$TABLE_PREFIX}users WHERE id='$arr[solved_by]'");
$wyn_s = $zap_s->fetch_array();

$solved_by_name = $wyn_s["username"];

print("<table align=center border=1 cellpadding=5 cellspacing=0>".
      "<tr><td align=center colspan=2 class=colhead>".$arr["title"]."</td></tr>".
      "<tr><td align=right><b>".$language['ADDED']."</b></td><td align=left>".$language["HD_ON"]."&nbsp;<b>".get_date_time($arr["added"])."</b>&nbsp;".$language["BY"]."&nbsp;<a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$arr["added_by"]."_".strtr($added_by_name, $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$arr["added_by"])."'><b>".$added_by_name."</b></a></td></tr>");


if ($arr["solved"] == 'yes') {

  print("<tr><td align=right><b>".$language["HD_PROBLEM"]."</b></td><td align=left><textarea name=msg_problem cols=60 rows=10>".$arr["msg_problem"]."</textarea></td></tr>".
        "<tr><td align=right><b>".$language["HD_SOLVED"]."</b></td><td align=left><span style='color:green'><b>".$language["YES"]."</b></span>&nbsp;".$language["HD_ON"]."&nbsp;<b>".get_date_time($arr["solved_date"])."</b>&nbsp;".$language["BY"]."&nbsp;<a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$arr["solved_by"]."_".strtr($solved_by_name, $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$arr["solved_by"])."'><b>".$solved_by_name."</b></a></td></tr>".
        "<tr><td align=right><b>".$language["HD_ANSWER"]."</b></td><td align=left><textarea name=msg_answer cols=60 rows=10>".$arr["msg_answer"]."</textarea></td></tr>".
        "<tr><td align=center colspan=2 class=colhead><a href=\"javascript: history.go(-1);\">".$language["BACK"]."</a></td></tr></table>");
 }
else if ($arr["solved"] == 'ignored') {

  print("<tr><td align=right><b>".$language["HD_PROBLEM"]."</b></td><td align=left><textarea name=msg_problem cols=60 rows=10>".$arr["msg_problem"]."</textarea></td></tr>".
        "<tr><td align=right><b>".$language["HD_SOLVED"]."</b></td><td align=left><span style='color=orange'><b>".$language["HD_IGNORED"]."</b></span>&nbsp;".$language["HD_ON"]."&nbsp;<b>".get_date_time($arr["solved_date"])."</b>&nbsp;".$language["BY"]."&nbsp;<a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$arr["solved_by"]."_".strtr($solved_by_name, $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$arr["solved_by"])."'><b>".$solved_by_name."</b></a></td></tr>".
       "<tr><td align=center colspan=2 class=colhead><a href=\"javascript: history.go(-1);\">".$language["BACK"]."</a></td></tr></table>");

}
else if ($arr["solved"] == 'no') {

$addedbyid = $arr["added_by"];

print("<form method=post action=index.php?page=modules&amp;module=helpdesk><tr><td><tr><td align=right><b>".$language["HD_PROBLEM"]."</b></td><td align=left><textarea name=msg_problem cols=60 rows=10>".$arr["msg_problem"]."</textarea></td></tr>".
      "<tr><td align=right><b>".$language["HD_SOLVED"]."</b></td><td align=center><span style='color=red'><b>".$language["NO"]."</b></span>".
      "<tr><td align=right><b>".$language["HD_ANSWER"]."</b></td><td><textarea name=msg_answer cols=60 rows=10>$body</textarea><br/>[".$language["HD_BB"]."]<input type=hidden name=id value=$id><input type=hidden name=addedbyid value=$addedbyid></td></tr>".
      "<tr><td colspan=2 align=center><input type=submit value=".$language["HD_ANSWER"]."! class=btn> <b>||</b> <a href=index.php?page=modules&amp;module=helpdesk&action=solve&pid=$id&solve=ignored><span style='color=red'><b>".$language["HD_IGNORE"]."</b></span></a></td></tr>".
      "<tr><td align=center colspan=2 class=colhead><a href=\"javascript: history.go(-1);\">".$language["BACK"]."</a></td></tr></form></table>");
}
}


// VIEW PROBLEMS


else {


print("<br><table align=center border=1 cellpadding=5 cellspacing=0>"
     ."<tr><td class=colhead align=center>".$language["HD_ADDED"]."</td>"
	 ."<td class=colhead align=center>".$language["HD_ADDEDBY"]."</td>"
	 ."<td class=colhead align=center>".$language["HD_PROBLEM"]."</td>"
	 ."<td class=colhead align=center>".$language["HD_SOLVEDBY"]."</td>"
	 ."<td class=colhead align=center>".$language["HD_SOLVEDIN"]." [ xx ]</td></tr>");

$res = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}helpdesk ORDER BY added DESC");
while($arr = $res->fetch_array()) {

$zap = do_sqlquery("SELECT username FROM {$TABLE_PREFIX}users WHERE id = $arr[added_by]");
$wyn = $zap->fetch_array();

$added_by_name = $wyn["username"];

$zap_s = do_sqlquery("SELECT username FROM {$TABLE_PREFIX}users WHERE id = $arr[solved_by]");
$wyn_s = $zap_s->fetch_array();

$solved_by_name = $wyn_s["username"];

// SOLVED IN
$added = $arr["added"];
$solved_date = $arr["solved_date"];

if ($solved_date == "0") {
  $solved_in = "&nbsp;[".$language["NA"]."]";
  $solved_color = "black";
  }
else
{
  $solved_in_wtf = $arr["solved_date"] - $arr["added"];
  $solved_in = "&nbsp;[".round_time($solved_in_wtf)."]";

  if ($solved_in_wtf > 2*3600) {
    $solved_color = "red";
  }
  else if ($solved_in_wtf > 3600) {
    $solved_color = "black";
  }
  else if ($solved_in_wtf <= 1800) {
    $solved_color = "green";
  }
}


  print("<tr><td>".get_date_time($arr["added"])."</td>".
        "<td><a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$arr["added_by"]."_".strtr($added_by_name, $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$arr["added_by"])."'>".$added_by_name."</a></td>".
        "<td><a href=index.php?page=modules&amp;module=helpdesk&action=problems&id=".$arr["id"]."><b>".$arr["title"]."</b></a></td>");

        if ($arr["solved"] == 'no') {
          $solved_by = $language["NA"];
          print("<td><span style='color=red'><b>".$language["NO"]."</b></span>&nbsp;-&nbsp;".$solved_by."</td>");
        }
        else if ($arr["solved"] == 'yes') {
          $solved_by = "<a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$arr["solved_by"]."_".strtr($solved_by_name, $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$arr["solved_by"])."'>".$solved_by_name."</a>";
          print("<td><span style='color:green'><b>".$language["YES"]."</b></span>&nbsp;-&nbsp;".$solved_by."</td>");
        }
        else if ($arr["solved"] == 'ignored') {
          $solved_by = "<a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$arr["solved_by"]."_".strtr($solved_by_name, $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$arr["solved_by"])."'>".$solved_by_name."</a>";
          print("<td><span style='color:orange'><b>".$language["HD_IGNORED"]."</b></span>&nbsp;-&nbsp;".$solved_by."</td>");
        }

  print("<td><span style='color:".$solved_color."'>".$solved_in."</span></td></tr>");

}

print("<tr><td align=center class=colhead colspan=5><form method=post action=index.php?page=modules&module=helpdesk&action=cleanuphd><input type=submit value='".$language["HD_DELPROB"]."' style='height:20;align:center;'></form></tr></table>");
print("<br><br>".
      "<center><span style='color:green'>[ xx ]</span> -".$language["HD_S_FAST"]." ".
      "<span style='color:black'>[ xx ]</span> - ".$language["HD_S_INTIME"]." ".
      "<span style='color:red'>[ xx ]</span> - ".$language["HD_S_LATE"]." </center>");
}

//block_end();

if ($arr["solved"] == 'no') {


  	print("<br><br>".
  	      "<form method=post action=index.php?page=modules&amp;module=helpdesk&action=problems&id=$id>");
  	?>
	  <table align="center"  border="1" cellspacing="0" cellpadding="5">
	  <tr><td>
	  <b><?php echo $language["HD_S_REPLIES"];?>:</b>
	  <select name="hd_answer"><?
	  for ($i = 1; $i <= count($hd_reply); $i++)
	  {
	    echo "<option value=$i ".($hd_answer == $i?"selected":"").
	      ">".$hd_reply[$i][0]."</option>\n";
	  }?>
	  </select>
	  <input type="submit" value="<?php echo $language['HD_USE'];?>" class="btn">
	  </td></tr></table></form>
	<?php

}

//stdfoot();
//die;

}

// Main FILE

//block_begin("Helpdesk");

if ($action == 'solve') {

  $pid = $_GET["pid"];

  if ($solve == 'ignored') {

    quickQuery("UPDATE {$TABLE_PREFIX}helpdesk SET solved='ignored', solved_by=$CURUSER[uid], solved_date = UNIX_TIMESTAMP() WHERE id=$pid");

  }
}

if (($msg_answer != "") && ($id != 0)){

$zap_usr = do_sqlquery("SELECT username FROM {$TABLE_PREFIX}users WHERE id = $addedbyid");
$wyn_usr = $zap_usr->fetch_array();
$addedby_name = $wyn_usr["username"];
$ans_usr = do_sqlquery("SELECT username FROM {$TABLE_PREFIX}users WHERE id = $CURUSER[uid]");
$wan_usr = $ans_usr->fetch_array();
$sendby_name = $wan_usr["username"];

$msg = sqlesc($language["HD_MSG1"]."\n\n[quote=".$addedby_name."]".$msg_problem."[/quote]\n".$msg_answer."\n\n".$language["HD_MSG2"]." $SITENAME ".$language["HD_MSG3"]." $sendby_name");

quickQuery("UPDATE {$TABLE_PREFIX}helpdesk SET solved='yes', solved_by=$CURUSER[uid], solved_date = UNIX_TIMESTAMP(), msg_answer = ".sqlesc($msg_answer)." WHERE id=$id");
// PM function SMF & Int PM system XBTIT
send_pm($CURUSER[uid],$addedbyid,sqlesc('Helpdesk'), $msg );

// need a historie - 2

}

if (($msg_problem != "") && ($title != "")){

quickQuery("INSERT INTO {$TABLE_PREFIX}helpdesk (title, msg_problem, added, added_by) VALUES (".sqlesc($title).", ".sqlesc($msg_problem).", UNIX_TIMESTAMP(),  $CURUSER[uid])",true);

// quickQuery("INSERT INTO helpdesk (added) VALUES ($dt)") or sqlerr();

  err_msg($language["HD_HELP_DESK"], $language["HD_MSG_SENT"]);
  block_end();
  stdfoot();
  die;
}

// ----- MAIN HELP DESK ---------

if (!$CURUSER || $CURUSER["id_level"] >= 6) // 6 is default id_level for moderators
{
$st_usr = do_sqlquery("SELECT username FROM {$TABLE_PREFIX}users WHERE id = $CURUSER[uid]");
$sta_usr = $st_usr->fetch_array();
$staff_name = $sta_usr["username"];

$countt=get_result("SELECT * FROM {$TABLE_PREFIX}helpdesk WHERE solved='no'");
$count=count($countt);

print("<center><a href=index.php?page=modules&amp;module=helpdesk&action=problems><h1><br><span style='color=blue'>".$language["HD_WELCOME_1"]." ".$staff_name." ".$language["HD_WELCOME_2"]." </span><span style='color:red'>".$count." </span><span style='color:blue'>".$language["HD_WELCOME_3"]."</span></h1></a></center>");
}
?>
<!-- ENGLISH -->
<div class='panel panel-default'><div class='panel-heading'></div><div class='panel-body' align='center'>
<br><center><h1><span style='color=purple'><?php echo $SITENAME . " " . $language["HELPDESK"]; ?></h1></span></center>
<center><span style='color:red' size=2><?php echo $language["HD_WELCOME_MSG"];?></span><br/></center>

<br/>
<form method="post" action="index.php?page=modules&amp;module=helpdesk">
<table width=auto border=0 align=center cellpadding=0 cellspacing=0>
  <tr>
    <td align="right">&nbsp;<b><?php echo $language["TITLE"];?>:</b></td>
    <td align="left"><input type="text" size="60" maxlength="50" name="title"></td>
  </tr>
</br>
<br>
  <tr>
    <td colspan="2"><textarea name="msg_problem" cols="75" rows="10"></textarea>
    </br>
    <center>[<?php echo $language["HD_BB"];?>]</center>
  </tr>
  <tr>
    <td align="center" colspan="2"><input type="submit" value="<?php echo $language['HD_HELPME'];?>" class="btn btn-primary"></td>
  </tr>
</table>
</form>
</div>
</div>
<?php

//Adding Report site bug code to Helpdesk - Gaart
print "<br/>";
print "<br/>";
print "<br/>";

print "<center><h1><font color=purple>Report Site Bug <a href=\"index.php?page=modules&module=bugs&action=bugreport\">HERE</a></h1></font></center>";
//Adding Report site bug code to Helpdesk 

//Adding Uploaders Application to Helpdesk - Vinnie
print "<center><h1><font color=purple>Apply for Uploader Rank <a href=\"index.php?page=uploadrequest\">HERE</a></h1></font></center>";
//Adding Report site bug code to Helpdesk 

}

global $module_out;
$module_out=ob_get_contents();
ob_end_clean();
?>