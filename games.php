<?php
//HDVinnie Games

if (!defined('IN_BTIT'))
die('non direct access!');

ob_start();

if(!$CURUSER || $CURUSER['id_level']<3)
{
	stderr("Error","Permission restricted");
	header("Refresh: 10; url=index.php");
}

if($btit_settings['fmhack_games']=='disabled')
{
	stderr("Closed",'The Games section is closed.');
	die();
}

$out="";

$out.= "<table border='0' cellspacing='5' cellpadding='10' align='center' width='100%'>
<tr><td colspan='5' align='center'><h1>Blu-Torrents Games!</h1></td></tr>
<tr><td colspan='5' align='center' ><font color='#555555'><b>Welcome To The Games, Please Select A Game Below To Play.</b></font></td></tr>
<tr>
<td align='center'><a class='altlink' href='index.php?page=modules&module=casino' >Casino <br/><img src='images/casino.png' alt='Casino' title='Casino' /></a></td>
<td align='center'><a class='altlink' href='index.php?page=lottery' >Lottery <br/><img src='images/lottery.png'' alt='Lottery' title='Lottery' /></a></td>
</td>
</tr>
</table>";

$tpl->set("main_content",$out);
ob_end_clean();
?>

