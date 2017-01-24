<?php

$language["BLACKJACK"] = "Blackjack";
$language["BJ_WELCOME_1"] = "<p><font color='#FFFFFF'>The object is to get a hand with a value as close to 21 as possible without going bust. You will be playing against the dealer so you must beat their hand in order to win.</font>";
$language["BJ_WELCOME_2"] = "<font color='yellow'><b> Each game costs ".makesize($btit_settings["bj_blackjack_stake"])." of upload credit to play.</p></b></font><font size=2 color='#FFFFFF'><li><b>Blackjack pays ".makesize(($btit_settings["bj_blackjack_stake"]*$btit_settings["bj_blackjack_prize"])+$btit_settings["bj_blackjack_stake"])."</li><li>Beating the dealer pays ".makesize(($btit_settings["bj_blackjack_stake"]*$btit_settings["bj_normal_prize"])+$btit_settings["bj_blackjack_stake"])."</li><li>Push (a draw) returns your original stake.</li><li>Losing returns nothing.</li></font>";
$language["CONTINUE"] = "Continue";
$language["DEALER_HAND"] = "<font color='#FFFFFF' face='Arial'><b>Dealers Hand (";
$language["YOUR_HAND"] = "<font color='#FFFFFF' face='Arial'><b>Your Hand (";
$language["HIT"] = "Hit";
$language["STAND"] = "Stand";
$language["ACTIVE_GAME_1"] = "You already have an active game, ";
$language["ACTIVE_GAME_2"] = " to resume it.";
$language["YOU_WIN"] = "<font color='lime' size='2'><b>You win!</b></font>";
$language["YOU_LOSE"] = "<font color='red' size='2'><b>You lose!</b></font>";
$language["PUSH"] = "<font color='orange'><b>Push!</b></font>";
$language["INSUFFICIENT_UPLOAD_CREDIT"] = "<font color='#FF0000' size='2'><b>You have insufficient upload credit to play!</b></font>";
$language["PLAY_AGAIN"] = "<font color='yellow' face='Arial' size='2'>Play again</font>";


?>