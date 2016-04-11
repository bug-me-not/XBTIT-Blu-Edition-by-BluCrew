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

      if($btit_settings['fmhack_games']=='disabled')
      {
        stderr("Closed",'The Games section is closed.');
        die();
      }

require_once ("include/functions.php");
dbconn(false);

global $CURUSER,$btit_settings;

$arcadetpl = new bTemplate();
$arcadetpl->set("language",$language);

if ($btit_settings["arc_aw"] == true)
{
$arte=$btit_settings["arc_upl"].' MB upload';
}
else
{
$arte=$btit_settings["arc_sb"].' seedbonus points';
}
$arcadetpl->set("flashscores77",$arte);

for($gameID=1;$gameID<25;$gameID++)
{
$result = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}flashscores GROUP BY user;");
while($populate = $result->fetch_array())
{
if(!isset($totalscore[$populate["user"]]))
{
$totalscore[$populate["user"]]=0;
}
}
$result = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}flashscores WHERE game = ".$gameID." ORDER BY score DESC;");
while($scores = $result->fetch_array())
{
$ranking = do_sqlquery("SELECT COUNT(*) FROM {$TABLE_PREFIX}flashscores WHERE game = ".$gameID." AND score > ".$scores["score"].";") OR DIE(sql_error());
if($rankrow = $ranking->fetch_row())
{
$rank = $rankrow[0]+1;
}
else
{
$rank = 1;
}
if($rank<6)
{
$totalscore[$scores["user"]]+=(10-(($rank-1)*2));
}
}
}
$maxplayed = 0;
$userplayed = 0;
$result = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}flashscores GROUP BY user;");
while($flashuser = $result->fetch_array())
{
$totalresult = do_sqlquery("SELECT COUNT(*) FROM {$TABLE_PREFIX}flashscores WHERE user = '".$flashuser["user"]."';");
if($totaluser = $totalresult->fetch_row())
{
if($totaluser[0]>$maxplayed)
{
$userplayed = $flashuser["user"];
$maxplayed = $totaluser[0];
}
}
}
$result = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}users WHERE id = ".$userplayed.";");
if($user = $result->fetch_array())
{
$r3 = do_sqlquery("SELECT prefixcolor,suffixcolor FROM {$TABLE_PREFIX}users_level WHERE id=".$user["id_level"]);
$a3 = $r3->fetch_array();
$username = ($a3["prefixcolor"].$user["username"].$a3["suffixcolor"]);

}
else
{
$username = "Unknown?!";
}
$yourtotalresult = do_sqlquery("SELECT COUNT(*) FROM {$TABLE_PREFIX}flashscores WHERE user = '".$CURUSER["uid"]."';");
if($yourtotal = $yourtotalresult->fetch_row())
{
$yourtotalgames = $yourtotal[0];
}
else
{
$yourtotalgames = 0;
}
$maxscore=0;
$maxscoreuser=0;
$result = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}flashscores GROUP BY user;");
while($check = $result->fetch_array())
{
if($totalscore[$check["user"]]>$maxscore)
{
$maxscore=$totalscore[$check["user"]];
$maxscoreuser=$check["user"];
}
}
$result = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}users WHERE id = ".$maxscoreuser.";");
if($user = $result->fetch_array())
{
$r4 = do_sqlquery("SELECT prefixcolor,suffixcolor FROM {$TABLE_PREFIX}users_level WHERE id=".$user["id_level"]);
$a4 = $r4->fetch_array();
$usernamescore = ($a4["prefixcolor"].$user["username"].$a4["suffixcolor"]);
}
else
{
$usernamescore = "Unknown?!";
}
$yourscore=$totalscore[$CURUSER["uid"]];

$arcadetpl->set("flashscores40",$yourtotalgames);
$arcadetpl->set("flashscores41",$yourscore);
$arcadetpl->set("flashscores42",$username);
$arcadetpl->set("flashscores43",$usernamescore);
$arcadetpl->set("flashscores44",$maxscore);
$arcadetpl->set("flashscores45",$maxplayed);
?>
