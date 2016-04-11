<?php

if (!defined("IN_BTIT"))
      die("non direct access!");

require_once("include/functions.php");
dbconn(false);

global $XBTT_USE;

if ($XBTT_USE)
   {
    $udownloaded="u.downloaded+IFNULL(x.downloaded,0)";
    $uuploaded="u.uploaded+IFNULL(x.uploaded,0)";
    $utables="{$TABLE_PREFIX}users u LEFT JOIN xbt_users x ON x.uid=u.id";
   }
else
    {
    $udownloaded="u.downloaded";
    $uuploaded="u.uploaded";
    $utables="{$TABLE_PREFIX}users u";
}

$resuser=do_sqlquery("SELECT $udownloaded as downloaded,$uuploaded as uploaded FROM $utables WHERE u.id=".$CURUSER["uid"]);
$rowuser= $resuser->fetch_array();
function tr2()
{
$a = func_get_args(tr2);
for($i=0;$i< (func_num_args(tr2)/2)+1;$i++)
 $row .= "<td ".$a[$i].">".$a[++$i]."</td>";
echo "<tr>".$row."</tr>";
}
///////////////////////////////////////////////////////////////////////////////
//////////////////////////////////Casino Config////////////////////////////////
///////////////////////////////////////////////////////////////////////////////

/////////////////////Test if casino is enabled////////////////////////////
$res = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}settings") or sqlerr(__FILE__, __LINE__);
while ($arr = $res->fetch_assoc())
$arr_config[$arr['key']] = $arr['value'];
if (!$arr_config["enable"])stderr("Sorry", "Casino is Closed, try later...");
//////////////////////////////////////////////////////////////////////////
$max_gainsglobal = $arr_config['max_gains_global'];
$max_gainsuser = $arr_config['max_gains_user'];
$mb_basic=1024*1024;
$max_download_user = $mb_basic*1024*$max_gainsuser; //// 2.5 TB
$max_download_global = $mb_basic*$mb_basic*$max_gainsglobal; //// 10.5 TB :-)
$max_trys = $arr_config['maxtrys']; ///How many times player can play

//////////////////This is the funny part///////////////////////
$user_everytimewin_mb = $mb_basic * 70; ////// means users that wins under 70 mb get a cheat_value of 0 -> win every time
$cheat_value = $arr_config['cheat_value']; // higher value -> less winner
$cheat_breakpoint = $arr_config['cheat_breakpoint']; ////very important value -> if (win MB > max_download_global/cheat_breakpoint)
$cheat_value_max = $arr_config['cheat_value_max']; ////// then cheat_value = cheat_value_max -->> i hope you know what i mean. ps: must be higher as cheat_value.
$cheat_ratio_user = $arr_config['cheat_ratio_user']; ///if casino_ratio_user > cheat_ratio_user -> $cheat_value = rand($cheat_value,$cheat_value_max)
$cheat_ratio_global = $arr_config['cheat_ratio_global']; /// same as user just global
$win_amount = $arr_config['win_amount']; // how much do the player win in the first game eg. bet 300, win_amount=3 ---->>> 300*3= 900 win
$win_amount_on_number = $arr_config['win_amount_on_number']; // same as win_amount for the number game
$show_real_chance = false; ///shows the user the real chance true or false
$bet_value1 = $mb_basic * 100; ///this is in MB but you can also choose gb or tb :-)
$bet_value2 = $mb_basic * 500;
$bet_value3 = $mb_basic * 1024 * 1;
$bet_value4 = $mb_basic * 1024 * 5;
$bet_value5 = $mb_basic * 1024 * 10;
$bet_value6 = $mb_basic * 1024 * 20;
$bet_value7 = $mb_basic * 1024 * 50;
$bet_value8 = $mb_basic * 1024 * 100;
$bet_value9 = $mb_basic * 1024 * 250;
$bet_value10 = $mb_basic * 1024 * 500;
//////////////////End of Funny Part///////////////////////////////


///////////////config game 3////////////////////
$maxusrbet = $arr_config['maxusrbet'];    //Amount of bets to allow per person
$maxtotbet = $arr_config['maxtotbet'];    //Amount of total open bets allowed
$alwdebt = 'n';     //Allow users to get into debt
$delold='y';     //Clear bets once finished? (cleanup.php will if value isn't 'y')
$sendfrom='0';     //The id of the user which notification PM's are noted as sent from
$casino=$HTTP_SERVER_VARS['PHP_SELF'];    //Name of file
//////////////End of Config//////////////////////

////////////////////NOUVELLE VERIF DES CLASSES/////////////////////////////
$user_class = $CURUSER["id_level"];
$class_allowed = array_map('trim', @explode('|', $arr_config["class_allowed"]));
if (!in_array($user_class, $class_allowed)){
stderr("Error","Sorry Admins Don't allow your group to play casino.");
}
///////////////////////////////////////////////////////////////////
$query ="select * from casino where userid = '".$CURUSER["uid"]."'";
$result = do_sqlquery($query) or die (sql_error());
if(sql_affected_rows()!=1)
{
 quickQuery("INSERT INTO casino (userid, win, lost, trys, date) VALUES(" . $CURUSER["uid"] . ",0,0,0, '" . get_date_time() . "')") or sql_error();

 $result = do_sqlquery($query); ///query another time to get the new user, if the show_error_msg is uncomment
}

$row = $result->fetch_array();
 $user_win = $row["win"];
 $user_lost = $row["lost"];
 $user_trys = $row["trys"];
 $user_date = $row["date"];
 $user_deposit = $row["deposit"];
 $user_enableplay = $row["enableplay"];

if($user_enableplay=="no")
 stderr("Error","Sorry ".$CURUSER["username"]." you're banned from casino.");

if($user_trys > $max_trys)
 stderr("Error","Sorry ".$CURUSER["username"]." your playtime is over $max_trys Times, you have to wait 5 hours.");



 if ($CURUSER["downloaded"] > 0)
   $ratio = number_format($rowuser["uploaded"] / $rowuser["downloaded"], 2);
 else
   if ($rowuser["uploaded"] > 0)
     $ratio = 999;
   else
     $ratio = 0;

/////////////////////////////////////Nouvelle Verif ratio///////////////////////
$miniratio = $arr_config['ratio_mini'];
  if($ratio < $miniratio){


stderr("Error","Sorry $CURUSER[username], your ratio is under $miniratio!");

}
////////////////////////////////////////////////////////////////////////////////
 $global_down2 = do_sqlquery(" select (sum(win)-sum(lost)) as globaldown,(sum(deposit)) as globaldeposit, sum(win) as win, sum(lost) as lost from casino") or die (sql_error());
 $row = $global_down2->fetch_array();
 $global_down = $row["globaldown"];
 $global_win = $row["win"];
 $global_lost = $row["lost"];
 $global_deposit = $row["globaldeposit"];

 if ($user_win > 0)
   $casino_ratio_user = number_format($user_lost / $user_win, 2);
 else
   if ($user_lost > 0)
     $casino_ratio_user = 999;
   else
     $casino_ratio_user = 0.00;

 if ($global_win > 0)
   $casino_ratio_global = number_format($global_lost / $global_win, 2);
 else
   if ($global_lost > 0)
     $casino_ratio_global = 999;
   else
     $casino_ratio_global = 0.00;

 //get users that bet the first time or win very less :-)
 if($user_win < $user_everytimewin_mb)
  $cheat_value = 0;
 else
 {
  //i think this is a god idea GLOBAL
  if($global_down > ($max_download_global / $cheat_breakpoint))
   $cheat_value = $cheat_value_max;
  if($casino_ratio_global < $cheat_ratio_global)
   $cheat_value = rand($cheat_value,$cheat_value_max);

  //i think this is a god idea for EACH USER
  if(($user_win - $user_lost) > ($max_download_user / $cheat_breakpoint))
   $cheat_value = $cheat_value_max;
  if($casino_ratio_user < $cheat_ratio_user)
   $cheat_value = rand($cheat_value,$cheat_value_max);
 }

if($global_down > $max_download_global)
 stderr("Sorry","".$CURUSER["username"]."global max win is above ".makesize($max_download_global));


////////////////////////////////////////////////////////////////////////////////////////////////
$betmb = $_POST["betmb"];
if((($_POST["color"]=="red"||$_POST["color"]=="black")||($_POST["number"]=="1"||$_POST["number"]=="2"||$_POST["number"]=="3"||$_POST["number"]=="4"||$_POST["number"]=="5"||$_POST["number"]=="6"))&&($_POST["betmb"]==$bet_value1||$_POST["betmb"]==$bet_value2||$_POST["betmb"]==$bet_value3||$_POST["betmb"]==$bet_value4||$_POST["betmb"]==$bet_value5||$_POST["betmb"]==$bet_value6||$_POST["betmb"]==$bet_value7||$_POST["betmb"]==$bet_value8||$_POST["betmb"]==$bet_value9||$_POST["betmb"]==$bet_value10))
{
if($_POST["number"])
{
 $win_amount = $win_amount_on_number;
 $cheat_value = $cheat_value+5;
 $winner_was = $_POST["number"];
}
else
 $winner_was = $_POST["color"];

 $win = $win_amount*$betmb;

if($rowuser["uploaded"] < $betmb)
 stderr("Sorry"," ".$CURUSER["username"]." you don't have uploaded ".makesize($betmb));




if(rand(0,$cheat_value)==$cheat_value)
{

print("<br><br>Yes ".$winner_was." is the result, ".$CURUSER["username"]." you got it and win ".makesize($win)."");
  ?>
 <h3 align=center><a href="index.php?page=modules&module=casino">Back to Casino</a></h3>
 <br />
 <?php

 quickQuery("UPDATE {$TABLE_PREFIX}users SET uploaded = uploaded + '$win' WHERE id=".$CURUSER["uid"]) or sqlerr();
 quickQuery("UPDATE casino SET date = '".get_date_time()."', trys = trys + 1, win = win + ".$win." WHERE userid=".$CURUSER["uid"]) or sqlerr();
}
else
{
 if($_POST["number"])
 {
  do
  {
   $fake_winner = rand(1,6);
  }
  while($_POST["number"]==$fake_winner);
 }
 else
 {
  if($_POST["color"]=="black")
   $fake_winner= "red";
  else
   $fake_winner= "black";
 }

print("<br>Sorry ".$fake_winner." is winner and not ".$winner_was.", ".$CURUSER["username"]." you lost ".makesize($betmb)."");
 ?>
 <h3 align=center><a href="index.php?page=modules&module=casino">Back to Casino</a></h3>
 <br />
 <?php


quickQuery("UPDATE {$TABLE_PREFIX}users SET uploaded = uploaded - '$betmb' WHERE id=".$CURUSER["uid"]) or sqlerr();
quickQuery("UPDATE casino SET date = '".get_date_time()."', trys = trys + 1 ,lost = lost + ".$betmb." WHERE userid=".$CURUSER["uid"]) or sqlerr();
}

}
else
{
///////////////////////////////////////GAME 3////////////////////////////////////

//////////Notice game 3 is NOT counted with the trys in casino!!!///////////////

//get user stats
$betsp = do_sqlquery("SELECT challenged FROM casino_bets WHERE proposed = '".$CURUSER['username']."'");
$openbet = 0;
while($tbet2 = $betsp->fetch_assoc())
{
if($tbet2[challenged]=='empty')
 $openbet++;
}

//Convert bet amount into bits
$amnt = $_POST["amnt"];
if(isset($_POST['unit'])){
if ($_POST["unit"] =="1")
 $nobits = $amnt*$mb_basic;
else
 $nobits = $amnt*$mb_basic*1024;
}

//$ratio2 = number_format(($rowuser["uploaded"])/$rowuser["downloaded"],2);

if(!$rowuser[uploaded] || !$rowuser[downloaded])

$ratio='0';
else
$ratio = number_format(($rowuser["uploaded"]-$nobits)/$rowuser["downloaded"],2);

$time = strtotime("now");
$time = date('Y-n-j G:i:s',$time);
$goback = "<a href=index.php?page=modules&module=casino>Back</a>";
/////////////////////////GAME 1/////////////////////////////////
//Take Bet

if (isset($_GET["takebet"]))
{
$betid=$_GET["takebet"];
$random = rand(0,1);
$loc = do_sqlquery("SELECT * FROM casino_bets WHERE id = '$betid'");
$tbet= $loc->fetch_assoc();
$nogb = makesize($tbet[amount]);

if($CURUSER['uid']==$tbet['userid']){
echo'<script type="text/javascript">
function windowunder(link)

{

  window.opener.document.location=link;

  window.close();

}

</script>';
echo"<body bgcolor=#A1BFD9><center><h2>Sorry you cant bet yourself?</h2><br><a href=\"javascript:window.close();\">Close</a>";
exit();
}
elseif($tbet['challenged']!="empty"){
echo'<script type="text/javascript">
function windowunder(link)

{

  window.opener.document.location=link;

  window.close();

}

</script>';
 echo"<body bgcolor=#A1BFD9><center><h2>Sorry Someone has already taken that bet!</h2><a href=\"javascript:windowunder('index.php?page=modules&module=casino');\">Click here to continue.</a>";
exit();
}

if($rowuser[uploaded] < $tbet['amount'])
{
 $debt = $tbet['amount']-$rowuser['uploaded'];
 $newup = $rowuser['uploaded']-$debt;
}

if(isset($debt) && $alwdebt !='y'){
 echo"<body bgcolor=#A1BFD9><center>Sorry<h2>You are ".makesize(($nobits-$rowuser[uploaded]))." short of making that bet!</h2><br><a href=\"javascript:window.close();\">Close</a>";
exit();
}
if($random==1)
{

 quickQuery("UPDATE {$TABLE_PREFIX}users SET uploaded = uploaded+".$tbet['amount']." WHERE id = '".$CURUSER['uid']."'") or sqlerr();
 /////////////////////Casino Stats//////////////////////////////////
 quickQuery("UPDATE casino SET date = '".get_date_time()."', trys = trys + 1, lost = lost + ".$tbet['amount']." WHERE userid='".$tbet['userid']."'") or sqlerr(); //NEW
 quickQuery("UPDATE casino SET date = '".get_date_time()."', trys = trys + 1, win = win + ".$tbet['amount']." WHERE userid='".$CURUSER['uid']."'") or sqlerr(); //NEW
 ///////////////////////////////////////////////////////////////////
 quickQuery("UPDATE casino SET deposit = deposit-".$tbet['amount']." WHERE userid = '".$tbet['userid']."'") or sqlerr();
 if(sql_affected_rows()==0)
  quickQuery("INSERT INTO casino (userid, date, deposit) VALUES (".$tbet['userid'].", '$time', '-".$tbet['amount']."')") or sqlerr();

 quickQuery("UPDATE casino_bets SET challenged = '".$CURUSER['username']."'  WHERE id = $betid") or sqlerr();

$sub=sqlesc("You lost a bet!");
$mess=sqlesc("$CURUSER[username] just won $nogb of your upload credit!");
  send_pm(0,$tbet['userid'],$sub,$mess);

echo'<script type="text/javascript">
function windowunder(link)

{

  window.opener.document.location=link;

  window.close();

}

</script>';
echo("<body bgcolor=#A1BFD9><center><h2>You got it You won the bet, $nogb has been credited to your account, from <a href=\"javascript:windowunder('index.php?page=userdetails&id=$tbet[userid]');\">$tbet[proposed]'s</a> !</h2><br><a href=\"javascript:windowunder('index.php?page=modules&module=casino');\">Click here to continue.</a>");

 if($delold=='y')
  quickQuery("DELETE FROM casino_bets WHERE id =".$tbet[id]) or sqlerr();
}
else
{
 if(empty($newup))

 $newup = $tbet['amount'];
 $newup2 = $tbet['amount']*2;

 quickQuery("UPDATE {$TABLE_PREFIX}users SET uploaded = uploaded - '$newup' WHERE id = '".$CURUSER['uid']."'") or sqlerr();
 quickQuery("UPDATE {$TABLE_PREFIX}users SET uploaded = uploaded + '$newup2' WHERE id = '".$tbet['userid']."'") or sqlerr();
 ////////////////////////////Casino Stats////////////////////////////////////
 quickQuery("UPDATE casino SET date = '".get_date_time()."', trys = trys + 1, win = win + ".$tbet['amount']." WHERE userid='".$tbet['userid']."'") or sqlerr(); //NEW
 quickQuery("UPDATE casino SET date = '".get_date_time()."', trys = trys + 1, lost = lost + ".$tbet['amount']." WHERE userid='".$CURUSER['uid']."'") or sqlerr(); //NEW
 ////////////////////////////////////////////////////////////////////////////
 quickQuery("UPDATE casino SET deposit = deposit - ".$tbet['amount']." WHERE userid = '".$tbet['userid']."'");
 if(sql_affected_rows()==0)
  quickQuery("INSERT INTO casino (userid, date, deposit) VALUES (".$tbet['userid'].", '$time', '-".$tbet['amount']."')") or sqlerr();
 quickQuery("UPDATE casino_bets SET challenged = '".$CURUSER['username']."' WHERE id = $betid") or sqlerr();

$sub=sqlesc("You won a bet!");
$mess=sqlesc("You just won $nogb of upload credit from $CURUSER[username]");
  send_pm(0,$tbet['userid'],$sub,$mess);

echo'<script type="text/javascript">
function windowunder(link)

{

  window.opener.document.location=link;

  window.close();

}

</script>';
echo("<body bgcolor=#A1BFD9><center><h2>Damn it You lost the bet, <a href=\"javascript:windowunder('index.php?page=userdetails&id=$tbet[userid]');\">$tbet[proposed]</a> has won $nogb of your hard earned upload credit!</h2><br><a href=\"javascript:windowunder('index.php?page=modules&module=casino');\">Click here to continue.</a>");

 if($delold=='y')
  quickQuery("DELETE FROM casino_bets WHERE id=".$tbet[id]) or sqlerr();
 }

exit(); //// the user should not reach this code but for security :-)
}

//Add a new bet
$loca = do_sqlquery("SELECT * FROM casino_bets WHERE challenged ='empty'") or sqlerr();
$totbets = sql_num_rows($loca);

if (isset($_POST["unit"]))
{
if($openbet >= $maxusrbet)
stderr("Error","Sorry There are already $openbet bets open, take an open bet!<br><a href=index.php?page=modules&module=casino>Click here to continue</a>");
if($nobits==0)
stderr("Error","Please dont add bets without a win!");
if($nobits < 0)

casinoerr("Error","Sorry Don't try to cheat the system, or I will ban you right now!<br><a href=index.php?page=modules&module=casino>Click here to continue</a>");

$newup = $nobits;
$debt  = $nobits-$rowuser['uploaded'];
if($rowuser['uploaded'] < $nobits)
{
 if($alwdebt!='y')
  stderr("Error","Sorry Thats ".makesize($debt)." more than you got!");

}
$betsp = do_sqlquery("SELECT id, amount FROM casino_bets WHERE userid = ".$CURUSER['uid']." ORDER BY time ASC") or sqlerr();
$tbet2 = $betsp->fetch_row();
//"";

$dummy = "<table width=100% cellspacing=0 cellpadding=3 border=1><tr><td class=blocklist align=center><center><H3>Success Bet added, you will receive a PM notifying you of the results when someone has taken it.</H3></td></tr></table>";
quickQuery("INSERT INTO casino_bets ( userid, proposed, challenged, amount, time) VALUES ('".$CURUSER['uid']."','".$CURUSER['username']."', 'empty', '$nobits', '$time')") or sqlerr();
quickQuery("UPDATE {$TABLE_PREFIX}users SET uploaded = uploaded - '$newup'  WHERE id = ".$CURUSER['uid']) or sqlerr();
quickQuery("UPDATE casino SET deposit = deposit + '$nobits' WHERE userid = ".$CURUSER['uid']) or sqlerr();

do_sqlquery($query);
if(sql_affected_rows()==0)
  quickQuery("INSERT INTO casino (userid, date, deposit) VALUES (".$CURUSER['uid'].", '$time', '".$nobits."')") or sqlerr();
}
$loca = do_sqlquery("SELECT * FROM casino_bets WHERE challenged ='empty'");
$totbets = sql_num_rows($loca);
////////////////////////////////////////////////standard html begin


echo"$dummy";
?>

<table align="center" width="50%" border="0">
  <tr>
    <td class=header><font size=3><center>Bet P2P with other users</center></font></td></tr><tr>
    <td class=main><center><a href=index.php?page=modules&module=casino&action=stats><h3>View user Stats</h3></a></center></td>
  </tr>
</table>
</form>
<hr>
<script src=http://www.unitconversion.org/converter3/converter3.js></script>
<!-- DATA STORAGE CONVERTER END -->
<?php

print("<center>");
print("<table class=message width=650 cellspacing=0 cellpadding=5>\n");
print("<tr><td align=center >");


//Place bet table

if ($openbet < $maxusrbet)
{
if($totbets >= $maxtotbet)
 echo "<br>are already $maxtotbet bets open, take an open bet!<br>";
else
{
echo "<br><table bgcolor=#FFFFFF width=60% cellspacing=0 cellpadding=3 border=0>
 <tr>
    <td class=header colspan=6><center><font size=3>Place bet</font></center></td></tr></table>";
 echo "<table width=60% cellspacing=0 cellpadding=3 border=0>
 <tr>

    <td class=header>Amount to bet</td>
<form name=p2p method=post action=".$phpself.">

    <td class=lista><input type=text name=amnt size=20 value=1></td>
 <td class=lista> <select name=unit>
  <option value=1>MB</option>
  <option value=2>GB</option>
     </select></td></tr><tr><td class=header></td><td class=header><center><input class=btn type=submit value=Gamble!></center></td><td class=header>
 </td></tr>
 </table></form>";
}
}


///Open Bets table
echo ("<table width=90% cellspacing=0 cellpadding=3 border=1><tr>");
echo('<td align=center class=header colspan=4><font size=3>Open Bets</font></td></tr>');
echo("<tr>");
echo("<td align=center class=header width=15%>Name</td><td class=header width=15% align=center>Amount</td>");
echo("<td width=45% align=center class=header>Time</td><td class=header align=center>Take Bet</td>");
echo("</tr>");
while ($res = $loca->fetch_assoc())
{
 echo (" <tr>");
 echo("<td align=center class=lista><center>$res[proposed]</center></td>");
 echo("<td align=center class=lista><center>".makesize($res['amount'])."</center></td>");
 echo("<td align=center class=lista><center>$res[time]</center></td>");
 echo("<td align=center class=lista><center><b><a href=\"javascript:popcasino('index.php?page=modules&module=casino&takebet=$res[id]');\">HERE</a></b></center></td>");
 echo("</tr>");
 $abcdefgh=1;
}
if($abcdefgh==false)
 echo("<tr><td align=center colspan=4 class=lista><center>Sorry no Bets</td></tr>");
echo "</table>";
echo('</td></tr></table><br>');
print("</center>");
print("<hr>");

//////////////////////////////////////////////////////////////////////////////////////// game 3
//print("<tr><td>");
?>
<table  align="center" width="50%" border="0">
  <tr>
    <td class=header><font size=3><center>Bet on a Color</center></font></td>
  </tr>
</table>
<br />
<?php
print("<center>");
echo'<form name=casino method=post action="'.$phpself.'">
<table width=50% cellspacing=0 cellpadding=5 border=0><tr>
<td class=header valign=middle><center>Bet on:</center></td><td class=header valign=middle>
black<input name="color" type="radio" checked value="black">
red<input name="color" type="radio" value="red"></td></tr><tr><td class=header valign=middle>
How Much:
<select name="betmb">
<option value="'.$bet_value1.'">'.makesize($bet_value1).'</option>
<option value="'.$bet_value2.'">'.makesize($bet_value2).'</option>
<option value="'.$bet_value3.'">'.makesize($bet_value3).'</option>
<option value="'.$bet_value4.'">'.makesize($bet_value4).'</option>
<option value="'.$bet_value5.'">'.makesize($bet_value5).'</option>
<option value="'.$bet_value6.'">'.makesize($bet_value6).'</option>
<option value="'.$bet_value7.'">'.makesize($bet_value7).'</option>
<option value="'.$bet_value8.'">'.makesize($bet_value8).'</option>
<option value="'.$bet_value9.'">'.makesize($bet_value9).'</option>
<option value="'.$bet_value10.'">'.makesize($bet_value10).'</option>
</select></td><td class=header valign=middle>
 <input class=btn type=submit value=Go!></td>
';

 if($show_real_chance)
  $real_chance=$cheat_value+1;
 else
  $real_chance=2;
 //tr("your chance:","1 : ".$real_chance,1);
 //tr("you can win:",$win_amount." * stake",1);
 echo('</tr></table><br>');
 print("</form>");
print("</center>");
 print("<hr>");
// print("<tr><td>");
 ?><table align="center" width="50%" border="0">
  <tr>
    <td class=header><font size=3><center>Bet on a Number</center></font></td>
  </tr>
</table>
<br />
<?php
 print('<form name=casino2 method=post action="'.$phpself.'">
 <table align=center width=50% cellspacing=0 cellpadding=5 border=0><tr>
  <td class=header>Bet on number:
  <input name="number" type="radio" checked value="1">1&nbsp;&nbsp;<input name="number" type="radio" value="2">2&nbsp;&nbsp;<input name="number" type="radio" value="3">3</td>
  <td class=header><input name="number" type="radio" value="4">4&nbsp;&nbsp;<input name="number" type="radio" value="5">5&nbsp;&nbsp;<input name="number" type="radio" value="6">6</td></tr><tr><td class=header>
 <center>How much:&nbsp;&nbsp;<select name="betmb">
<option value="'.$bet_value1.'">'.makesize($bet_value1).'</option>
<option value="'.$bet_value2.'">'.makesize($bet_value2).'</option>
<option value="'.$bet_value3.'">'.makesize($bet_value3).'</option>
<option value="'.$bet_value4.'">'.makesize($bet_value4).'</option>
<option value="'.$bet_value5.'">'.makesize($bet_value5).'</option>
<option value="'.$bet_value6.'">'.makesize($bet_value6).'</option>
<option value="'.$bet_value7.'">'.makesize($bet_value7).'</option>
<option value="'.$bet_value8.'">'.makesize($bet_value8).'</option>
<option value="'.$bet_value9.'">'.makesize($bet_value9).'</option>
<option value="'.$bet_value10.'">'.makesize($bet_value10).'</option>
 </select></center></td>
<td class=header><input class=btn type=submit value="GO!" ></td></tr><tr>
');

 if($show_real_chance)
  $real_chance=$cheat_value+5;
 else
  $real_chance=6;
 print("<td class=header>Your chances:1 : ".$real_chance."</td>");
print("<td class=header>You can win:".$win_amount_on_number." * stake</td>");
 echo('</tr></table><br>');
 print("</form>");
print("<hr>");
print("<tr><td>");
?>
<table align="center" width="67%" border="0">
  <tr>
    <td class=header><font size=3><center><?php echo("$CURUSER[username]"); ?>'s details: </center></font></td>
  </tr>
</table>

<?php
print("<div align=center>");
print("<table border=1 cellspacing=0 width=650 cellpadding=3>\n");
print("<tr><td align=center class=lista>");
 print("<center><font size=3>$CURUSER[username] @ Casino</font><hr>\n");
 print("<table cellspacing=0 cellpadding=5><tr>\n
 <td class=lista> You can win:".makesize($max_download_user)."</td></tr><tr>
 <td class=lista> Won:".makesize($user_win)."</td></tr><tr>
  <td class=lista>Lost:".makesize($user_lost)."</td></tr><tr>
 <td class=lista> Ratio:".$casino_ratio_user."</td></tr><tr>
  <td class=lista>Deposit on P2P:".makesize($user_deposit+$nobits)."</td></tr>");


 echo('</table>');
print("</td><td align=center class=lista>");
 print("<center><font size=3>Global Stats</font><hr>\n");
 print("<table cellspacing=0 cellpadding=5><tr>\n
 <td class=lista> Members can win:".makesize($max_download_global)."</td></tr><tr>
  <td class=lista>Won:".makesize($global_win)."</td></tr><tr>
  <td class=lista>Lost:".makesize($global_lost)."</td></tr><tr>
  <td class=lista>Ratio:".$casino_ratio_global."</td></tr><tr>
  <td class=lista>Deposit on P2P:".makesize($global_deposit)."</td></tr>");
 echo('</table>');
print("</td><td align=center class=lista valign=top>");
  print("<center><font size=3>Your Stats</font><hr>\n");
print("<br><table cellspacing=0 cellpadding=5><tr>\n
 <td class=lista>Uploaded:".makesize($rowuser['uploaded'] - $nobits)."</td></tr><tr>
 <td class=lista>Downloaded:".makesize($rowuser['downloaded'])."</td></tr><tr>
 <td class=lista>Ratio:".$ratio."</td></tr>
</table>");
print("</td></tr>");
echo('</table>');

print("<br />");
}

?>
