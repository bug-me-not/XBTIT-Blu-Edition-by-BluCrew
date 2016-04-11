<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2014  Btiteam
//
//  converted from BTI to XBTIT by DiemThuy - Feb 2008
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

ob_start();
?>
<div align=center>
<table width=60% border=1 cellspacing=0 cellpadding=10><tr><td class=text>
<div align=center><B>HighScores Ranking</B>
<P>

<?php
for($gameID=1;$gameID<25;$gameID++)
{
    if($gameID==1)
    {
  print("<TABLE WIDTH=100% border=1><TR><TD COLSPAN=4 bgcolor=#0099FF><center><B>Yeti Penguin</B></center></TD></TR>");
    print("<TR><TD>Rank</TD><TD WIDTH=50% align=center>Name</TD><TD>Score</TD><TD>Date</TD></TR>");
    }
    if($gameID==2)
    {
  print("<TABLE WIDTH=100% border=1><TR><TD COLSPAN=4 bgcolor=#0099FF><center><B>Yeti Pentathlon</B></center></TD></TR>");
    print("<TR><TD>Rank</TD><TD WIDTH=50% align=center>Name</TD><TD>Score</TD><TD>Date</TD></TR>");
    }
    if($gameID==3)
    {
  print("<TABLE WIDTH=100% border=1><TR><TD COLSPAN=4 bgcolor=#0099FF><center><B>yeti Snowboard</B></center></TD></TR>");
   print("<TR><TD>Rank</TD><TD WIDTH=50% align=center>Name</TD><TD>Score</TD><TD>Date</TD></TR>");
    }
    if($gameID==4)
    {
  print("<TABLE WIDTH=100% border=1><TR><TD COLSPAN=4 bgcolor=#0099FF><center><B>Yeti BigWave</B></center></TD></TR>");
   print("<TR><TD>Rank</TD><TD WIDTH=50% align=center>Name</TD><TD>Score</TD><TD>Date</TD></TR>");
    }
    if($gameID==5)
    {
  print("<TABLE WIDTH=100% border=1><TR><TD COLSPAN=4 bgcolor=#0099FF><center><B>Yeti Safari</B></center></TD></TR>");
   print("<TR><TD>Rank</TD><TD WIDTH=50% align=center>Name</TD><TD>Score</TD><TD>Date</TD></TR>");
    }
    if($gameID==6)
    {
  print("<TABLE WIDTH=100% border=1><TR><TD COLSPAN=4 bgcolor=#0099FF><center><B>Pacman</B></center></TD></TR>");
    print("<TR><TD>Rank</TD><TD WIDTH=50% align=center>Name</TD><TD>Score</TD><TD>Date</TD></TR>");
    }
    if($gameID==7)
    {
  print("<TABLE WIDTH=100% border=1><TR><TD COLSPAN=4 bgcolor=#0099FF><center><B>Yeti Overload</B></center></TD></TR>");
     print("<TR><TD>Rank</TD><TD WIDTH=50% align=center>Name</TD><TD>Score</TD><TD>Date</TD></TR>");
    }
    if($gameID==8)
    {
  print("<TABLE WIDTH=100% border=1><TR><TD COLSPAN=4 bgcolor=#0099FF><center><B>Summer Games</B></center></TD></TR>");
    print("<TR><TD>Rank</TD><TD WIDTH=50% align=center>Name</TD><TD>Score</TD><TD>Date</TD></TR>");
    }
    if($gameID==9)
    {
  print("<TABLE WIDTH=100% border=1><TR><TD COLSPAN=4 bgcolor=#0099FF><center><B>Yeti StageDive</B></center></TD></TR>");
  print("<TR><TD>Rank</TD><TD WIDTH=50% align=center>Name</TD><TD>Score</TD><TD>Date</TD></TR>");
    }
    if($gameID==10)
    {
  print("<TABLE WIDTH=100% border=1><TR><TD COLSPAN=4 bgcolor=#0099FF><center><B>Bubble Shooter</B></center></TD></TR>");
  print("<TR><TD>Rank</TD><TD WIDTH=50% align=center>Name</TD><TD>Score</TD><TD>Date</TD></TR>");
    }
    if($gameID==11)
    {
  print("<TABLE WIDTH=100% border=1><TR><TD COLSPAN=4 bgcolor=#0099FF><center><B>Super Mario Bros</B></center></TD></TR>");
  print("<TR><TD>Rank</TD><TD WIDTH=50% align=center>Name</TD><TD>Score</TD><TD>Date</TD></TR>");
    }
    if($gameID==12)
    {
  print("<TABLE WIDTH=100% border=1><TR><TD COLSPAN=4 bgcolor=#0099FF><center><B>Black Knight</B></center></TD></TR>");
  print("<TR><TD>Rank</TD><TD WIDTH=50% align=center>Name</TD><TD>Score</TD><TD>Date</TD></TR>");
    }
    if($gameID==13)
    {
  print("<TABLE WIDTH=100% border=1><TR><TD COLSPAN=4 bgcolor=#0099FF><center><B>Matrix Dock Defense</B></center></TD></TR>");
  print("<TR><TD>Rank</TD><TD WIDTH=50% align=center>Name</TD><TD>Score</TD><TD>Date</TD></TR>");
    }
    if($gameID==14)
    {
  print("<TABLE WIDTH=100% border=1><TR><TD COLSPAN=4 bgcolor=#0099FF><center><B>Fisherman Sam</B></center></TD></TR>");
  print("<TR><TD>Rank</TD><TD WIDTH=50% align=center>Name</TD><TD>Score</TD><TD>Date</TD></TR>");
    }
    if($gameID==15)
    {
  print("<TABLE WIDTH=100% border=1><TR><TD COLSPAN=4 bgcolor=#0099FF><center><B>Alloy Arena</B></center></TD></TR>");
  print("<TR><TD>Rank</TD><TD WIDTH=50% align=center>Name</TD><TD>Score</TD><TD>Date</TD></TR>");
    }
        if($gameID==16)
    {
  print("<TABLE WIDTH=100% border=1><TR><TD COLSPAN=4 bgcolor=#0099FF><center><B>Babycal Throw</B></center></TD></TR>");
  print("<TR><TD>Rank</TD><TD WIDTH=50% align=center>Name</TD><TD>Score</TD><TD>Date</TD></TR>");
    }
    if($gameID==17)
    {
  print("<TABLE WIDTH=100% border=1><TR><TD COLSPAN=4 bgcolor=#0099FF><center><B>Jungle Kid</B></center></TD></TR>");
  print("<TR><TD>Rank</TD><TD WIDTH=50% align=center>Name</TD><TD>Score</TD><TD>Date</TD></TR>");
    }
    if($gameID==18)
    {
  print("<TABLE WIDTH=100% border=1><TR><TD COLSPAN=4 bgcolor=#0099FF><center><B>Super Splash</B></center></TD></TR>");
  print("<TR><TD>Rank</TD><TD WIDTH=50% align=center>Name</TD><TD>Score</TD><TD>Date</TD></TR>");
}
    if($gameID==19)
    {
  print("<TABLE WIDTH=100% border=1><TR><TD COLSPAN=4 bgcolor=#0099FF><center><B>Auto Bahn</B></center></TD></TR>");
  print("<TR><TD>Rank</TD><TD WIDTH=50% align=center>Name</TD><TD>Score</TD><TD>Date</TD></TR>");
    }
    if($gameID==20)
    {
  print("<TABLE WIDTH=100% border=1><TR><TD COLSPAN=4 bgcolor=#0099FF><center><B>Chain Reaction</B></center></TD></TR>");
  print("<TR><TD>Rank</TD><TD WIDTH=50% align=center>Name</TD><TD>Score</TD><TD>Date</TD></TR>");
    }
    if($gameID==21)
    {
  print("<TABLE WIDTH=100% border=1><TR><TD COLSPAN=4 bgcolor=#0099FF><center><B>Yeti Final Spit</B></center></TD></TR>");
  print("<TR><TD>Rank</TD><TD WIDTH=50% align=center>Name</TD><TD>Score</TD><TD>Date</TD></TR>");
    }
        if($gameID==22)
    {
  print("<TABLE WIDTH=100% border=1><TR><TD COLSPAN=4 bgcolor=#0099FF><center><B>Destroy All Humans</B></center></TD></TR>");
  print("<TR><TD>Rank</TD><TD WIDTH=50% align=center>Name</TD><TD>Score</TD><TD>Date</TD></TR>");
    }
    if($gameID==23)
    {
  print("<TABLE WIDTH=100% border=1><TR><TD COLSPAN=4 bgcolor=#0099FF><center><B>Sonic Blox</B></center></TD></TR>");
  print("<TR><TD>Rank</TD><TD WIDTH=50% align=center>Name</TD><TD>Score</TD><TD>Date</TD></TR>");
    }
    if($gameID==24)
    {
  print("<TABLE WIDTH=100% border=1><TR><TD COLSPAN=4 bgcolor=#0099FF><center><B>Trapped In A Well</B></center></TD></TR>");
  print("<TR><TD>Rank</TD><TD WIDTH=50% align=center>Name</TD><TD>Score</TD><TD>Date</TD></TR>");
  }


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
    }else{
 $rank = 1;
    }
    if($rank<6)
    {
    $totalscore[$scores["user"]]+=(10-(($rank-1)*2));
    }
 }
 $result = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}flashscores WHERE game = ".$gameID." ORDER BY score DESC LIMIT 5;");
 while($scores = $result->fetch_array())
 {
     $userresult = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}users WHERE id = ".$scores["user"].";");
    $user = $userresult->fetch_array();
$r3 = do_sqlquery("SELECT prefixcolor,suffixcolor FROM {$TABLE_PREFIX}users_level WHERE id=".$user["id_level"]);
$a3 = $r3->fetch_array();
$username = ($a3["prefixcolor"].$user["username"].$a3["suffixcolor"]);
$date=$scores["date"];
   $ranking = do_sqlquery("SELECT COUNT(*) FROM {$TABLE_PREFIX}flashscores WHERE game = ".$gameID." AND score > ".$scores["score"].";") OR DIE(sql_error());
    if($rankrow = $ranking->fetch_row())
    {
 $rank = $rankrow[0]+1;
    }else{
 $rank = 1;
    }
    if($gameID < 25)
    {
  if($scores["user"]==$CURUSER["uid"])
  {
    print("<TR style=\"background-color: #BBBBBB\"><TD>".$rank."</TD><TD WIDTH=50%>".$username."</TD><TD><div style=\"text-align:right;width:100%;\">".$scores["score"]."</TD><TD>".$date."</div></TD></TR>");
  }else{
    print("<TR><TD>".$rank."</TD><TD>".$username."</TD><TD><div style=\"text-align:right;width:100%;\">".$scores["score"]."</TD><TD>".$date."</div></TD></TR>");
  }
    }else{
  if($scores["user"]==$CURUSER["uid"])
  {
    print("<TR style=\"background-color: #BBBBBB\"><TD>".$rank."</TD><TD WIDTH=50%>".$username."</TD><TD>".$scores["level"]."</TD><TD><div style=\"text-align:right;width:100%;\">".$scores["score"]."</TD><TD>".$date."</div></TD></TR>");
  }else{
    print("<TR><TD>".$rank."</TD><TD>".$username."</TD><TD>".$scores["level"]."</TD><TD><div style=\"text-align:right;width:100%;\">".$scores["score"]."</TD><TD>".$date."</div></TD></TR>");
  }
    }
 }
 $yourresult = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}flashscores WHERE game = ".$gameID." AND user = ".$CURUSER["uid"]." ORDER BY score DESC LIMIT 1;") OR DIE(sql_error());
 if($yourscore = $yourresult->fetch_array())
 {
    $yourdate=$yourscore["date"];
    $yourhighscore = $yourscore["score"];
    $yourlevel = $yourscore["level"];
   $yourranking = do_sqlquery("SELECT COUNT(*) FROM {$TABLE_PREFIX}flashscores WHERE game = ".$gameID." AND score > ".$yourhighscore.";") OR DIE(sql_error());
    if($ranking = $yourranking->fetch_row())
    {
 $yourrank = $ranking[0]+1;
    }else{
 $yourrank = 1;
    }
    if($yourrank>5)
    {
    if($gameID < 25)
    {
    print("<TR style=\"background-color: #BBBBBB\"><TD>".$yourrank."</TD><TD WIDTH=50% align=center>".$CURUSER["username"]."</TD><TD><div style=\"text-align:right;width:100%;\">".$yourhighscore."</TD><TD>".$yourdate."</div></TD></TR>");
    }else{
    print("<TR style=\"background-color: #BBBBBB\"><TD>".$yourrank."</TD><TD WIDTH=50% align=center>".$CURUSER["username"]."</TD><TD>".$yourlevel."</TD><TD><div style=\"text-align:right;width:100%;\">".$yourhighscore."</TD><TD>".$yourdate."</div></TD></TR>");
    }
    }
 }
 print("</TABLE><P>");
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
$r4 = do_sqlquery("SELECT prefixcolor,suffixcolor FROM {$TABLE_PREFIX}users_level WHERE id=".$user["id_level"]);
$a4 = $r4->fetch_array();
$username = ($a4["prefixcolor"].$user["username"].$a4["suffixcolor"]);
 }else{
 $username = "Unknown?!";
 }
   $yourtotalresult = do_sqlquery("SELECT COUNT(*) FROM {$TABLE_PREFIX}flashscores WHERE user = '".$CURUSER["uid"]."';");
   if($yourtotal = $yourtotalresult->fetch_row())
   {
  $yourtotalgames = $yourtotal[0];
    }else{
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
$r5 = do_sqlquery("SELECT prefixcolor,suffixcolor FROM {$TABLE_PREFIX}users_level WHERE id=".$user["id_level"]);
$a5 = $r5->fetch_array();
$usernamescore = ($a5["prefixcolor"].$user["username"].$a5["suffixcolor"]);
 }else{
 $usernamescore = "Unknown?!";
 }
$yourscore=$totalscore[$CURUSER["uid"]];
?>
You Have Played <?=$yourtotalgames?> Games!<P>
Your Total Score are <?=$yourscore?>!<P>
<TABLE>
<TR><TD><B><CENTER>Most Bored Award</CENTER></B></TD><TD><B><CENTER>Highest Score Award</CENTER></B></TD></TR>
<TR><TD><CENTER><IMG SRC=images/mostbored.png></CENTER></TD>
<TD><CENTER><IMG SRC=images/trop.jpg></CENTER></TD></TR>
<TR><TD><CENTER>Most Bored award goes to: <B><?=$username?></B><BR/>With <?=$maxplayed?> games played!<BR/><B>Congratulations!</B></CENTER></TD>
<TD><CENTER>The highest score award goes to:<B><?=$usernamescore?></B><BR/>With a score of <?=$maxscore?>!<BR/><B>Congratulations!</B/></CENTER></TD></TR>
</table>
</td></tr>
</table>
</form>
<br/>
<center><a href=index.php?page=arcadex><h2>Return to Games Choice</h2></a></center>
</div>
<?php
global $module_out;
$module_out=ob_get_contents();
ob_end_clean();
?>
