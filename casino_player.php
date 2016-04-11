<?php

if (!defined("IN_BTIT"))
      die("non direct access!");

//require "include/functions.php";
dbconn(false);
global $TABLE_PREFIX;
if ($CURUSER["admin_access"] == "yes")
$edit = 1;
$res2 = do_sqlquery("select count(*) from casino") or die(sql_error());
$row2 = $res2->fetch_array();
$count = $row2[0];
$perpage = 50;
list($pagertop, $pagerbottom, $limit) = pager($perpage, $count, "index.php?page=modules&module=casino&action=stats&amp;");
$res = do_sqlquery("select {$TABLE_PREFIX}users.id as userid,{$TABLE_PREFIX}users.username, {$TABLE_PREFIX}users.downloaded, {$TABLE_PREFIX}users.uploaded, casino.win, casino.lost,casino.deposit from casino inner join {$TABLE_PREFIX}users on casino.userid = {$TABLE_PREFIX}users.id ORDER BY (casino.win - casino.lost) DESC $limit") or sqlerr();
//stdhead("Players");
if (sql_num_rows($res) == 0)
print("<p align=center><b>No players</b></p><br><a href=\"javascript:history.back();\">Go back</a>\n");
else
{
//begin_frame("List of Casino Players");
print("<p align=center><a href=index.php?page=modules&module=casino>Back</a></p>\n");
echo $pagertop;
print("<div align=center>");
print("<table border=1 cellspacing=0 cellpadding=5>\n");


if($edit==0)
print("<tr><td class=header>Name</td><td class=header align=center>Uploaded</td><td class=header align=center>Downloaded</td><td class=header align=center>Ratio</td><td class=header align=center>Deposit on P2P</td><td class=header align=center>Won</td><td class=header align=center>Lost</td><td class=header align=center>Trys</td><td class=header align=center>Total</td><td class=header align=center>Can Play</td>\n");
else
print("<tr><td class=header>Name</td><td class=header align=center>Uploaded</td><td class=header align=center>Downloaded</td><td class=header align=center>Ratio</td><td class=header align=center>Deposit on P2P</td><td class=header align=center>Won</td><td class=header align=center>Lost</td><td class=header align=center>Trys</td><td class=header align=center>Total</td><td class=header align=center>Can Play</td><td class=header align=center>edit user</td>\n");


while ($arr = $res->fetch_assoc())
{
$rez = do_sqlquery("select * from casino where userid=$arr[userid]");
$arz = $rez->fetch_array();
if ($arr["downloaded"] > 0)
{
$ratio = number_format($arr["uploaded"] / $arr["downloaded"], 3);
}
else
if ($arr["uploaded"] > 0)
$ratio = "Inf.";
else
$ratio = "---";
$uploaded =makesize($arr["uploaded"]);
$downloaded = makesize($arr["downloaded"]);
if ($CURUSER[uid] == $arr[userid])
$bg = "class=blocklist";
else
$bg = "class=main";

$all = $arz[win]-$arz[lost];
if($all < 0)
{
$all = $all * -1;
$minus = "-";
}
if($arz[enableplay]=="yes"){
$arz[enableplay]="<font color=green>Yes</font>";
}else{
$arz[enableplay]="<font color=red>No</font>";
}
if($edit==0)
print("<tr><td $bg align=center><a href=index.php?page=userdetails&id=$arr[userid]><center><b>$arr[username]</b></a></center></td><td align=center $bg><center>$uploaded</center></td><td align=center $bg><center>$downloaded</center></td><td  align=center $bg><center>$ratio</center></td><td align=center $bg><center>".makesize($arz[deposit])."</center></td><td  align=center $bg><center>".makesize($arz[win])."</center></td><td  align=center $bg><center>".makesize($arz[lost])."</center></td><td align=center $bg><center>$arz[trys]</center></td><td  align=center $bg><center> $minus".makesize($all)."</center></td><td  align=center $bg><center>$arz[enableplay]</center></td></tr>\n");
else
print("<tr><td $bg align=center><a href=index.php?page=userdetails&id=$arr[userid]><center><b>$arr[username]</b></a></center></td><td  align=center $bg><center>$uploaded</center></td><td  align=center $bg><center>$downloaded</center></td><td  align=center $bg><center>$ratio</center></td><td align=center $bg><center>".makesize($arz[deposit])."</center></td><td  align=center $bg><center>".makesize($arz[win])."</center></td><td  align=center $bg><center>".makesize($arz[lost])."</center></td><td  align=center $bg><center>$arz[trys]</center></td><td  align=center $bg><center> $minus".makesize($all)."</center></td><td  align=center $bg><center>$arz[enableplay]</center></td><td  align=center $bg><form name=edit-player method=post action=index.php?page=modules&module=casino&action=edit><input type=hidden name=userid value=$arr[userid]> <input class=btn type=submit value=edit ></form></td></tr>\n");
}
print("</table>\n");
print("</div>");
//end_frame();
print("<br/>");
}

?>
