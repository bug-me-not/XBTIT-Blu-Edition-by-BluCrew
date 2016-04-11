<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2014  Btiteam
//
//    This file is part of xbtit DT FM.
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
if (!defined("IN_BTIT"))
      die("non direct access!");

require_once ("include/functions.php");
dbconn(false);

global $CURUSER;

$flashtpl = new bTemplate();
$flashtpl->set("language",$language);

$flashtpl->set("flash1",$_GET["gameURI"]);

if(isset($_GET["gameid"]))
{
$gameID=$_GET["gameid"];
    if($gameID==1)
    {
$flashtpl->set("flash10","<TABLE WIDTH=100% border=1><TR><TD COLSPAN=4><center><B>Yeti Penguin</B></center></TD></TR>");
$flashtpl->set("flash11","<TR><TD><center>Rank</TD><TD WIDTH=50%><center>Name</TD><TD><center>Score</TD><TD><center>Date</center></TD></TR>");
    }
    if($gameID==2)
    {
$flashtpl->set("flash13","<TABLE WIDTH=100% border=1><TR><TD COLSPAN=4><center><B>Yeti Pentathlon</B></center></TD></TR>");
$flashtpl->set("flash14","<TR><TD><center>Rank</TD><TD WIDTH=50%><center>Name</TD><TD><center>Score</TD><TD><center>Date</center></TD></TR>");
    }
    if($gameID==3)
    {
$flashtpl->set("flash16","<TABLE WIDTH=100% border=1><TR><TD COLSPAN=4><center><B>Yeti Snowboard</B></center></TD></TR>");
$flashtpl->set("flash17","<TR><TD><center>Rank</TD><TD WIDTH=50%><center>Name</TD><TD><center>Score</TD><TD><center>Date</center></TD></TR>");
    }
    if($gameID==4)
    {
$flashtpl->set("flash19","<TABLE WIDTH=100% border=1><TR><TD COLSPAN=4><center><B>Yeti BigWave</B></center></TD></TR>");
$flashtpl->set("flash20","<TR><TD><center>Rank</TD><TD WIDTH=50%><center>Name</TD><TD><center>Score</TD><TD><center>Date</center></TD></TR>");
    }
    if($gameID==5)
    {
$flashtpl->set("flash22","<TABLE WIDTH=100% border=1><TR><TD COLSPAN=4><center><B>Yeti Safari</B></center></TD></TR>");
$flashtpl->set("flash23","<TR><TD><center>Rank</TD><TD WIDTH=50%><center>Name</TD><TD><center>Score</TD><TD><center>Date</center></TD></TR>");
    }
    if($gameID==6)
    {
$flashtpl->set("flash25","<TABLE WIDTH=100% border=1><TR><TD COLSPAN=4><center><B>Pacman</B></center></TD></TR>");
$flashtpl->set("flash26","<TR><TD><center>Rank</TD><TD WIDTH=50%><center>Name</TD><TD><center>Score</TD><TD><center>Date</center></TD></TR>");
    }
    if($gameID==7)
    {
$flashtpl->set("flash28","<TABLE WIDTH=100% border=1><TR><TD COLSPAN=4><center><B>Yeti Overload</B></center></TD></TR>");
$flashtpl->set("flash29","<TR><TD><center>Rank</TD><TD WIDTH=50%><center>Name</TD><TD><center>Score</TD><TD><center>Date</center></TD></TR>");
    }
    if($gameID==8)
    {
$flashtpl->set("flash31","<TABLE WIDTH=100% border=1><TR><TD COLSPAN=4><center><B>Summergames</B></center></TD></TR>");
$flashtpl->set("flash32","<TR><TD><center>Rank</TD><TD WIDTH=50%><center>Name</TD><TD><center>Score</TD><TD><center>Date</center></TD></TR>");
    }
    if($gameID==9)
    {
$flashtpl->set("flash34","<TABLE WIDTH=100% border=1><TR><TD COLSPAN=4><center><B>Yeti StageDive</B></center></TD></TR>");
$flashtpl->set("flash35","<TR><TD><center>Rank</TD><TD WIDTH=50%><center>Name</TD><TD><center>Score</TD><TD><center>Date</center></TD></TR>");
    }
    if($gameID==10)
    {
$flashtpl->set("flash37","<TABLE WIDTH=100% border=1><TR><TD COLSPAN=4><center><B>Bubble Shooter</B></center></TD></TR>");
$flashtpl->set("flash38","<TR><TD><center>Rank</TD><TD WIDTH=50%><center>Name</TD><TD><center>Score</TD><TD><center>Date</center></TD></TR>");
    }
    if($gameID==11)
    {
$flashtpl->set("flash60","<TABLE WIDTH=100% border=1><TR><TD COLSPAN=4><center><B>Super Mario Bros</B></center></TD></TR>");
$flashtpl->set("flash61","<TR><TD><center>Rank</TD><TD WIDTH=50%><center>Name</TD><TD><center>Score</TD><TD><center>Date</center></TD></TR>");
    }
    if($gameID==12)
    {
$flashtpl->set("flash62","<TABLE WIDTH=100% border=1><TR><TD COLSPAN=4><center><B>Black Knight</B></center></TD></TR>");
$flashtpl->set("flash63","<TR><TD><center>Rank</TD><TD WIDTH=50%><center>Name</TD><TD><center>Score</TD><TD><center>Date</center></TD></TR>");
    }
        if($gameID==13)
    {
$flashtpl->set("flash64","<TABLE WIDTH=100% border=1><TR><TD COLSPAN=4><center><B>Matrix Dock Defense</B></center></TD></TR>");
$flashtpl->set("flash65","<TR><TD><center>Rank</TD><TD WIDTH=50%><center>Name</TD><TD><center>Score</TD><TD><center>Date</center></TD></TR>");
    }
        if($gameID==14)
    {
$flashtpl->set("flash66","<TABLE WIDTH=100% border=1><TR><TD COLSPAN=4><center><B>Fisherman Sam</B></center></TD></TR>");
$flashtpl->set("flash67","<TR><TD><center>Rank</TD><TD WIDTH=50%><center>Name</TD><TD><center>Score</TD><TD><center>Date</center></TD></TR>");
    }
        if($gameID==15)
    {
$flashtpl->set("flash68","<TABLE WIDTH=100% border=1><TR><TD COLSPAN=4><center><B>Alloy Arena</B></center></TD></TR>");
$flashtpl->set("flash69","<TR><TD><center>Rank</TD><TD WIDTH=50%><center>Name</TD><TD><center>Score</TD><TD><center>Date</center></TD></TR>");
    }
          if($gameID==16)
    {
$flashtpl->set("flash70","<TABLE WIDTH=100% border=1><TR><TD COLSPAN=4><center><B>Babycal Throw</B></center></TD></TR>");
$flashtpl->set("flash71","<TR><TD><center>Rank</TD><TD WIDTH=50%><center>Name</TD><TD><center>Score</TD><TD><center>Date</center></TD></TR>");
    }
        if($gameID==17)
    {
$flashtpl->set("flash72","<TABLE WIDTH=100% border=1><TR><TD COLSPAN=4><center><B>Jungle Kid</B></center></TD></TR>");
$flashtpl->set("flash73","<TR><TD><center>Rank</TD><TD WIDTH=50%><center>Name</TD><TD><center>Score</TD><TD><center>Date</center></TD></TR>");
    }
        if($gameID==18)
    {
$flashtpl->set("flash74","<TABLE WIDTH=100% border=1><TR><TD COLSPAN=4><center><B>Super Splash</B></center></TD></TR>");
$flashtpl->set("flash75","<TR><TD><center>Rank</TD><TD WIDTH=50%><center>Name</TD><TD><center>Score</TD><TD><center>Date</center></TD></TR>");
    }

	        if($gameID==19)
    {
$flashtpl->set("flash75","<TABLE WIDTH=100% border=1><TR><TD COLSPAN=4><center><B>Auto Bahn</B></center></TD></TR>");
$flashtpl->set("flash76","<TR><TD><center>Rank</TD><TD WIDTH=50%><center>Name</TD><TD><center>Score</TD><TD><center>Date</center></TD></TR>");
    }
        if($gameID==20)
    {
$flashtpl->set("flash77","<TABLE WIDTH=100% border=1><TR><TD COLSPAN=4><center><B>Chain Reaction</B></center></TD></TR>");
$flashtpl->set("flash78","<TR><TD><center>Rank</TD><TD WIDTH=50%><center>Name</TD><TD><center>Score</TD><TD><center>Date</center></TD></TR>");
    }
        if($gameID==21)
    {
$flashtpl->set("flash79","<TABLE WIDTH=100% border=1><TR><TD COLSPAN=4><center><B>Yeti Final Spit</B></center></TD></TR>");

    }
          if($gameID==22)
    {
$flashtpl->set("flash81","<TABLE WIDTH=100% border=1><TR><TD COLSPAN=4><center><B>Destroy All Humans</B></center></TD></TR>");
$flashtpl->set("flash82","<TR><TD><center>Rank</TD><TD WIDTH=50%><center>Name</TD><TD><center>Score</TD><TD><center>Date</center></TD></TR>");
    }
        if($gameID==23)
    {
$flashtpl->set("flash83","<TABLE WIDTH=100% border=1><TR><TD COLSPAN=4><center><B>Sonic Blox</B></center></TD></TR>");
$flashtpl->set("flash84","<TR><TD><center>Rank</TD><TD WIDTH=50%><center>Name</TD><TD><center>Score</TD><TD><center>Date</center></TD></TR>");
    }
        if($gameID==24)
    {
$flashtpl->set("flash85","<TABLE WIDTH=100% border=1><TR><TD COLSPAN=4><center><B>Trapped In A Well</B></center></TD></TR>");
$flashtpl->set("flash86","<TR><TD><center>Rank</TD><TD WIDTH=50%><center>Name</TD><TD><center>Score</TD><TD><center>Date</center></TD></TR>");
    }
	   if($gameID==25)
    {
$flashtpl->set("flash87","<TABLE WIDTH=100% border=1><TR><TD COLSPAN=4><center><B>ColorBall2</B></center></TD></TR>");
$flashtpl->set("flash88","<TR><TD><center>Rank</TD><TD WIDTH=50%><center>Name</TD><TD><center>Score</TD><TD><center>Date</center></TD></TR>");
    }

 $result = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}flashscores WHERE game = ".$gameID." ORDER BY score DESC LIMIT 10;");
    $arcade=array();
    $i=0;

 while($scores = $result->fetch_array())
{
$userresult = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}users WHERE id = ".$scores["user"].";");
$user = $userresult->fetch_array();

$r3 = do_sqlquery("SELECT prefixcolor,suffixcolor FROM {$TABLE_PREFIX}users_level WHERE id=".$user["id_level"]);
$a3 = $r3->fetch_array();
$username = ($a3["prefixcolor"].$user["username"].$a3["suffixcolor"]);

$ranking = do_sqlquery("SELECT COUNT(*) FROM {$TABLE_PREFIX}flashscores WHERE game = ".$gameID." AND score > ".$scores["score"].";") OR DIE(sql_error());
if($rankrow = $ranking->fetch_row())
{
$rank = $rankrow[0]+1;
}
else
{
$rank = 1;
}
if($gameID < 25 AND $gameID!=21)
{
if($scores["user"]==$CURUSER["uid"])
{
$arcade[$i]["flash40"]=("<TR style=\"background-color: #BBBBBB\"><TD><center>".$rank."</TD><TD WIDTH=50%><b>".$username."</b></TD><TD><div style=\"text-align:right;width:100%;\"><center>".$scores["score"]."</TD><TD><center>".$scores["date"]."</div></TD></TR>");
}
else
{
$arcade[$i]["flash41"]=("<TR><TD><center>".$rank."</TD><TD>".$username."</TD><TD><div style=\"text-align:right;width:100%;\"><center>".$scores["score"]."</TD><TD><center>".$scores["date"]."</div></TD></TR>");
}
}
$i++;
}
$flashtpl->set("arcade",$arcade);
$flashtpl->set("flash50","</TABLE><P>");
}
if($gameID == 21)
{
$flashtpl->set("flash51","<TABLE WIDTH=100% border=1>");
$flashtpl->set("flash52","<TR><TD><center><font color=red>Unable to Save HighScores for this Game! , just play for fun ;)</font></center></TD></TR>");
$flashtpl->set("flash53","</TABLE>");
}
?>
