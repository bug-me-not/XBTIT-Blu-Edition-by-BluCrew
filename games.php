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

/*<td align='center'><a class='altlink' href='index.php?page=arcadex' >Flash Arcade <br/><img src='images/arcadex.png' alt='Arcade' title='Flash Arcade' /></a>
<td align='center'><a class='altlink' href='index.php?page=bet' >Sports Betting <br/><img src='images/sportsbet.png' alt='SportsBet' title='Sports Betting' /></a></td>
<tr>
<td align='center'><a class='altlink' href='index.php?page=slots' >Slots <br/><img src='images/slot.png' alt='Slots' title='Slots' /></a></td>
<td align='center'><a class='altlink' href='index.php?page=blackjack' >BlackJack <br/><img src='images/blackjack.png' alt='Blackjack' title='BlackJack' /></a></td>
</tr>
<tr>
<td align='center'><a class='altlink' href='index.php?page=hangman' >Hangman <br/><img src='images/hangman.png' alt='Hangman' title='Hangman' /></a></td>
<td align='center'><a class='altlink' href='index.php?page=mustafa' >Mustafa <br/><img src='images/mustafa.png' alt='Mustafa' title='Mustafa' /></a></td>
<td align='center'><a class='altlink' href='index.php?page=snake' >Snake <br/><img src='images/snake.png' alt='Snake' title='Snake' /></a></td> </tr>;
*/
?>

