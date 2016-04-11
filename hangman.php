<?php

//require_once("include/functions.php");
//require_once("include/config.php");
if($btit_settings['fmhack_games']=='disabled')
{
   stderr("Closed",'The Games section is closed.');
   die();
}

//dbconn();
$hangout="";

if ($CURUSER["view_news"]=="yes")
{
//standardheader("hangman");
block_begin("Hangman");
/*
#####################################################################
# PHP Hangman Game #
# Version 1.2.0 #
# ©2002,2003 0php.com - Free PHP Scripts #
#####################################################################

#####################################################################
# #
# Author : 0php.com #
# Created : July 12, 2002 #
# Modified : March 22, 2004 #
# E-mail : webmaster@0php.com #
# Website : http://www.0php.com/ #
# License : FREE (GPL); See Copyright and Terms below #
# #
# Donations accepted via PayPal to webmaster@0php.com #
# #
#####################################################################

>> Copyright and Terms:

This software is copyright © 2002-2004 0php.com. It is distributed
under the terms of the GNU General Public License (GPL). Because it is licensed
free of charge, there is NO WARRANTY, it is provided AS IS. The author can not
be held liable for any damage that might arise from the use of this software.
Use it at your own risk.

All copyright notices and links to 0PHP.com website MUST remain intact in the scripts and in the HTML for the scripts.

For more details, see http://www.0php.com/license_GNU_GPL.php (or http://www.gnu.org/).

>> Installation
Copy the PHP script and images to the same directory. You can optionally edit the category and list of words/phrases to solve below. You can also add additional characters to $additional_letters and/or $alpha if you want to use international (non-English) letters or other characters not included by default (see further instructions below for those).

To prevent Google from playing hangman, add the line below between <HEAD> and </HEAD>:
<META NAME="robots" CONTENT="NOINDEX,NOFOLLOW">


================================================================================
=======*/


// $Category = "Web Programming";

# list of words (phrases) to guess below, separated by new line
$list = "THOR
DUNSTON CHECKS IN
CASABLANCA
GONE WITH THE WIND
ELEMENTARY
SOLARIS
THE TREASURE OF THE SIERRA MADRE
ALL IS LOST
ROAD TO PERDITION
CITY OF EMBER
LITTLE MISS SUNSHINE
ALIEN RESURRECTION
THE YOUNG PHILADELPHIANS
KICKBOXER
THE MALTESE FALCON
ENTER THE DRAGON
KUNG FU PANDA
THE FIRM
HOW TO MARRY A MILLIONAIRE
THE WALKING DEAD
CAPTAIN CORELLI'S MANDOLIN
THE GREAT TRAIN ROBBERY
BRUCE ALMIGHTY
A BRIDGE TOO FAR
ALIENS
THE PERFECT STORM
THE TRUMAN SHOW
TWO MULES FOR SISTER SARA
THE UNTOUCHABLES
THE PEACEMAKER
TIME BANDITS
GENTLEMEN PREFER BLONDES
UNIVERSAL SOLDIER
CAST AWAY
KILL YOUR DARLINGS
MY SISTER'S KEEPER
CHINESE ZODIAC
ZOMBIELAND
CYMBELINE
CYBORG
JACKIE BROWN
SOME LIKE IT HOT
THE CROODS
CON AIR
DIAMONDS ARE FOREVER
RETURN OF THE KILLER TOMATOES
TRON
GONE BABY GONE
ORANGE IS THE NEW BLACK
PROMETHEUS
A YOUNG DOCTOR'S NOTEBOOK
THUNDERBOLT AND LIGHTFOOT
DECEMBER BOYS
BURN AFTER READING
THE GREEN MILE
THE TUXEDO
I LOVE YOU PHILIP MORRIS
THE SIMPSONS
THE DIARY OF ANNE FRANK
A BEAUTIFUL MIND
SUDDEN DEATH
THE HUNT FOR RED OCTOBER
THE COLOR OF MONEY
HOME ALONE
LEATHERHEADS
WHAT IF
THE ROCK
RUSH HOUR
ME MYSELF AND IRENE
THE POLAR EXPRESS
PALE RIDER
GLADIATOR
CAT ON A HOT TIN ROOF
MOONSTRUCK
FUN WITH DICK AND JANE
MILLION DOLLAR BABY
SEINFELD
INTERSTELLAR
SOUTH PARK
MILLER'S CROSSING
THE THIN RED LINE
THE MONUMENTS MEN
THE TAILOR OF PANAMA
THE RUM DIARY
NO RESERVATIONS
GHOSTBUSTERS
THE WICKER MAN
THUNDERBALL
THE MAJESTIC
THANK YOU FOR SMOKING
THE IDES OF MARCH
TRUE GRIT
THE HORSE WHISPERER
RAISING ARIZONA
THE STING
UNFORGIVEN
THE HUDSUCKER PROXY
EXODUS
FRONTERA
THE BIG LEBOWSKI
GONE IN SIXTY SECONDS
OLYMPUS HAS FALLEN
THE OKLAHOMA KID
INTOLERABLE CRUELTY
THE LEAGUE OF EXTRAORDINARY GENTLEMEN
HIGH FIDELITY
NIM'S ISLAND
BUTCH CASSIDY AND THE SUNDANCE KID
ANY GIVEN SUNDAY
BARTON FINK
POINT BREAK
FRIENDS
APPALOOSA
GOLDFINGER
ALIEN
THE MEN WHO STARE AT GOATS
JUSTIFIED
INSIDE LLEWYN DAVIS
HARRY POTTER AND THE PRISONER OF AZKABAN
TRON LEGACY
MURDER ON THE ORIENT EXPRESS
NATIONAL TREASURE
ETERNAL SUNSHINE OF THE SPOTLESS MIND
THE FIFTH ELEMENT
BROKEN CITY
A HISTORY OF VIOLENCE
THE PIANIST
SILVER LININGS PLAYBOOK
DEFINITELY MAYBE
LEMONY SNICKET'S A SERIES OF UNFORTUNATE EVENTS
THE OFFICE
THE FORBIDDEN KINGDOM
RATATOUILLE
THE READER
THE LAKE HOUSE
HAPPY FEET
CHAIN REACTION
BRAVEHEART
THE ILLUSIONIST
EQUILIBRIUM
AEON FLUX
TERMINATOR SALVATION
THE OTHERS
INGLOURIOUS BASTERDS
PANDORUM
DIRTY DANCING
SURROGATES
THE TIME TRAVELER'S WIFE
THE MACHINIST
THE INFORMANT
GREEN ZONE
TRUE ROMANCE
THE THOMAS CROWN AFFAIR
THE GOLDEN COMPASS
THE IMAGINARIUM OF DOCTOR PARNASSUS
BROTHERS
SAVING PRIVATE RYAN
STARSHIP TROOPERS
MINORITY REPORT
JACK REACHER
THE DEPARTED
TITANIC
CARLITO'S WAY
BAD BOYS
SUPERNATURAL
EASTERN PROMISES
AGORA
HOT TUB TIME MACHINE
ONE FLEW OVER THE CUCKOO'S NEST
SABRINA
MEMENTO
SLEEPLESS IN SEATTLE
WHITE COLLAR
THE HITCHHIKER'S GUIDE TO THE GALAXY
ALMOST FAMOUS
BRIDGE TO TERABITHIA
INDEPENDENCE DAY
CLIFFHANGER
PSYCH
LETTERS TO JULIET
THE LAST OF THE MOHICANS
JACOB'S LADDER
CONSTANTINE
WINTER'S BONE
INCEPTION
PATRIOT GAMES
EAT PRAY LOVE";



# make sure that any characters to be used in $list are in either
# $alpha OR $additional_letters, but not in both. It may not work if you change fonts.
# You can use either upper OR lower case of each, but not both cases of the same letter.

# below ($alpha) is the alphabet letters to guess from.
# you can add international (non-English) letters, in any order, such as in:
# $alpha = "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÑÒÓÔÕÖØÙÚÛÜÝŸABCDEFGHIJKLMNOPQRSTUVWXYZ";
$alpha = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

# below ($additional_letters) are extra characters given in words; '?' does not work
# these characters are automatically filled in if in the word/phrase to guess
$additional_letters = " -.,;!?%&0123456789";

#========= do not edit below here ======================================================


//echo<<<endHTML
//<HTML><HEAD><TITLE>Hangman Game (Movie Titles)</TITLE>
//<META NAME="DESCRIPTION" CONTENT="Hangman">
//<meta content="text/html; charset=windows-1252" http-equiv=content-type>
//</HEAD>

//<BODY bgColor='#CCCCCC' link='navy' vlink='navy' alink='navy'>
$hangout .="<DIV ALIGN='center' bgColor='#CCCCCC' link='navy' vlink='navy' alink='navy'>";
//endHTML;

$len_alpha = strlen($alpha);

if(isset($_GET["n"])) $n=$_GET["n"];
if(isset($_GET["letters"])) $letters=$_GET["letters"];
if(!isset($letters)) $letters="";

//if(isset($PHP_SELF)) $self=$PHP_SELF.;
//else
$self=$_SERVER["PHP_SELF"]."?page=hangman";

$links="";






$max=6; # maximum number of wrong
# error_reporting(0);
$list = strtoupper($list);
$words = explode("\n",$list);
srand ((double)microtime()*1000000);
$all_letters=$letters.$additional_letters;
$wrong = 0;

$hangout .= "<P><B>Hangman Game (Movie Titles)</B><BR>\n";

if (!isset($n)) { $n = rand(1,count($words)) - 1; }
$word_line="";
$word = trim($words[$n]);
$done = 1;
for ($x=0; $x < strlen($word); $x++)
{
if (strstr($all_letters, $word[$x]))
{
if ($word[$x]==" ") $word_line.="&nbsp; "; else $word_line.=$word[$x];
}
else { $word_line.="_<font size=1>&nbsp;</font>"; $done = 0; }
}

if (!$done)
{

for ($c=0; $c<$len_alpha; $c++)
{
if (strstr($letters, $alpha[$c]))
{
if (strstr($words[$n], $alpha[$c])) {$links .= "\n<B>$alpha[$c]</B> "; }
else { $links .= "\n<FONT color=\"red\">$alpha[$c] </font>"; $wrong++; }
}
else
{ $links .= "\n<A HREF=\"$self&letters=$alpha[$c]$letters&n=$n\">$alpha[$c]</A> "; }
}
$nwrong=$wrong; if ($nwrong>6) $nwrong=6;
$hangout .= "\n<p><BR>\n<IMG SRC=\"images/hangman_$nwrong.gif\" ALIGN=\"MIDDLE\" BORDER=0 WIDTH=100 HEIGHT=100 ALT=\"Wrong: $wrong out of $max\">\n";

if ($wrong >= $max)
{
$n++;
if ($n>(count($words)-1)) $n=0;
$hangout .="<BR><BR><H1><font size=5>\n$word_line</font></H1>\n";
$hangout .= "<p><BR><FONT color=\"red\"><BIG>SORRY, YOU ARE HANGED!!!</BIG></FONT><BR><BR>";
if (strstr($word, " ")) $term="phrase"; else $term="word";
$hangout .= "The $term was \"<B>$word</B>\"<BR><BR>\n";
$hangout .="<A HREF=$self&n=$n>Play again.</A>\n\n";
}
else
{
$hangout .= " &nbsp; # Wrong Guesses Left: <B>".($max-$wrong)."</B><BR>\n";
$hangout .= "<H1><font size=5>\n$word_line</font></H1>\n";
$hangout .= "<P><BR>Choose a letter:<BR><BR>\n";
$hangout .= "$links\n";
}
}
else
{
$n++; # get next word
if ($n>(count($words)-1)) $n=0;
$hangout .= "<BR><BR><H1><font size=5>\n$word_line</font></H1>\n";
$hangout .= "<P><BR><BR><B>Congratulations!!! &nbsp;You win!!!</B><BR><BR><BR>\n";
$hangout .= "<A HREF=$self&n=$n>Play again</A>\n\n";
$winamnt = mt_rand(100,1000);
quickQuery("UPDATE {$TABLE_PREFIX}users SET seedbonus=seedbonus+{$winamnt}");
}

//echo<<<endHTML

$hangout .= "<p align='center'><BR><BR><font face='Verdana' size='1'>PHP Hangman Game - Version 1.2.0<br></DIV>";//</BODY></HTML>

//endHTML;
$tpl->set("main_content",$hangout);
}
	else
	{
		stderr("ERROR","SORRY, YOUR NOT AUTHORISED...");
    //err_msg(ERROR.NOT_AUTHORIZED."!",SORRY."...");
	}
block_end();
//stdfoot();
?>
