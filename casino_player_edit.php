<?php

if (!defined("IN_BTIT"))
      die("non direct access!");


//require "include/functions.php";
dbconn(false);
global $TABLE_PREFIX, $CURUSER;

if($CURUSER["admin_access"]=="yes"){

$userid=$_POST["userid"];
$lost=$_POST["lost"];
$won=$_POST["won"];
$printys=$_POST["printys"];
$date=$_POST["date"];
$enableplay=$_POST["enableplay"];

$resname = do_sqlquery("select username from {$TABLE_PREFIX}users where id = '".$userid."'") or die(sql_error());
$name = $resname->fetch_array();
$result = do_sqlquery("select * from casino where userid = '".$userid."'") or die(sql_error());
if (sql_num_rows($result) == 0)stderr("Error","No user id!");
else{$row = $result->fetch_array();
$user_win = $row["win"];
$user_lost = $row["lost"];
$user_printys = $row["trys"];
$user_date = $row["date"];
$user_enableplay = $row["enableplay"];
//stdhead();

if($_POST["userid"]!=NULL&&$_POST["won"]!=NULL&&$_POST["lost"]!=NULL&&$_POST["printys"]!=NULL&&$_POST["date"]!=NULL&&$_POST["enableplay"]!=NULL)
{

$dif_win = $won - $user_win;
///// this is printicky
$dif_lost = $lost - $user_lost;
///// this is printicky
$up = $dif_win - $dif_lost;
///// this is printicky
quickQuery("UPDATE {$TABLE_PREFIX}users SET uploaded = uploaded + ".$up." WHERE id=".$userid) or sqlerr();
quickQuery("UPDATE casino SET date = '".$date."', trys = '".$printys."' ,lost = '".$lost."',win = '".$won."',enableplay='".$enableplay."' WHERE userid=".$userid) or sqlerr();
print("<br>The Stats for member ".$name[username]." have been updated with success :-)<br><a href=index.php?page=modules&module=casino&action=stats>Return</a>");
}else
{
if ($user_win > 0)
$casino_ratio_user = number_format($user_lost / $user_win, 2);
else if ($user_lost > 0)
$casino_ratio_user = 999;
else
$casino_ratio_user = 0;
if($user_enableplay=="yes") {
$select="<option value=yes checked >yes</option>";
$select.="<option value=no>no</option>";
} else
{
$select="<option value=no >no</option>";
$select.="<option value=yes checked>yes</option>";
}
$res = do_sqlquery("select {$TABLE_PREFIX}users.id as userid, {$TABLE_PREFIX}users.username from casino inner join {$TABLE_PREFIX}users on casino.userid = {$TABLE_PREFIX}users.id ORDER BY (casino.win - casino.lost) DESC") or sqlerr();
$arr = $res->fetch_assoc();
$recherche = do_sqlquery("SELECT username FROM {$TABLE_PREFIX}users where id='".$userid."'") or die(sql_error());
$cul = $recherche->fetch_assoc();
//begin_block ("Users Edition");
//begin_frame("Editing User ".$cul["username"]."");
print("<center><h2>Welcome, you are now able to edit user <a href=index.php?page=userdetails&id=$userid><b>$cul[username]</a>!</h2></center>\n");
print("<form name=edit-player method=post action=$phpself><input type=hidden name=userid value=$userid>");
print("<table cellspacing=0 cellpadding=3 width=400><tr>\n");
print("<td class=header><center>user ratio:&nbsp;".$casino_ratio_user."</td></tr><tr>");
print("<td class=header><center>user won:&nbsp;<input type=text name=won value='$user_win' >&nbsp;&nbsp;".makesize($user_win)."</td></tr><tr>");
print("<td class=header><center>user lost:&nbsp;<input type=text name=lost value='$user_lost' >&nbsp;&nbsp;".makesize($user_lost)."</td></tr><tr>");
print("<td class=header>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;user played:&nbsp; <input type=text name=printys value='$user_printys'>&nbsp;&nbsp;<b>games</b></td></tr><tr>");
print("<td class=header>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;last access:&nbsp;<input type=text name=date value='$user_date' ></td></tr><tr>");
print("<td class=header><center>allow user to play:&nbsp;<select name=\"enableplay\">'.$select.'</select></td></tr>");
print("<tr><td colspan=2 align=center><input type=submit value='change user stats'></td></tr>");
print("</table>\n");
print("</form>");
print("<br/>");
print("<center><h3><a href=index.php?page=modules&module=casino&action=stats>Return</a></h3></center>\n");
//end_frame();
print("<br/>");
//end_block();
}
}
}//if user can admin
else{
echo"No access for normal users!!";
}
?>
