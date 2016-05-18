<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">Admin Checks</h4>
</div>
<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2014  Btiteam
//
//    This file is part of xbtit dt fm.
//
// Redistribution and use in source and binary forms, with or without modification,
// are permitted provided that the following conditions are met:
//
// Admin block by DiemThuy 08/2012 made for XBTIT FM DT [www.xbtitdeveloping.nl]
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

global $CURUSER,$btit_settings;
if (!$CURUSER || $CURUSER["id_level"]<6)
   {
    // do nothing
   }
else
    {
print(" <table class='table table-bordered'>");
// tm
if ($CURUSER['moderate_trusted']=='yes')
{
    $res=get_result("SELECT COUNT(*) `count` FROM `{$TABLE_PREFIX}files` WHERE `moder`='um'", true, $btit_settings["cache_duration"]);
    $row = $res[0];
    $um_t = (int)$row["count"];

if ($um_t>0)
	print("<tr><td class=\"header\" align=\"left\"><a href=\"index.php?page=moder\"><span style=\"float:left;\"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Torrent Mod</a><span style=\"
    float:right; padding-right:5px;\"><font color=\"red\"> [ $um_t ]</font></span></td></tr>\n");
	else
	print("<tr><td class=\"header\" align=\"left\"><a href=\"index.php?page=moder\"><span style=\"float:left;\"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Torrent Mod</a><span style=\"
    float:right; padding-right:5px;\"><font color=\"green\">[ - ]</font></span></td></tr>\n");
}

// reports
$resrep=do_sqlquery("SELECT COUNT(*) FROM {$TABLE_PREFIX}reports WHERE dealtwith=0");
if ($resrep && sql_num_rows($resrep)>0)
   {
    $rep=$resrep->fetch_row();


    if ($rep[0]>0){

print("<tr><td class=\"header\" align=\"left\"><a href=\"index.php?page=reports&amp;uid=".$CURUSER["uid"]."\"><span style=\"float:left; padding-left:3px;\"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Reports</a><span style=\"float:right; padding-right:5px;\"><font color=\"red\"><b>[ $rep[0] ]</font></span></td></tr>\n");
    }else
print("<tr><td class=\"header\" align=\"left\"><a href=\"index.php?page=reports&amp;uid=".$CURUSER["uid"]."\"><span style=\"float:left; padding-left:3px;\"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Reports</a><span style=\"float:right; padding-right:5px;\"><font color=\"green\">[ - ]</font></span></td></tr>\n");
   }
else
print("<tr><td class=\"header\" align=\"left\"><a href=\"index.php?page=reports&amp;uid=".$CURUSER["uid"]."\"><span style=\"float:left; padding-left:3px;\"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Reports</a><span style=\"float:right; padding-right:5px;\"><font color=\"green\">[ - ]</font></span></td></tr>\n");

// helpdesk
$countt=get_result("SELECT * FROM {$TABLE_PREFIX}helpdesk WHERE solved='no'");
$count=count($countt);

if ($count==0)
print("<tr><td class=\"header\" align=\"left\"><a href=\"index.php?page=modules&amp;module=helpdesk\"><span style=\"float:left; padding-left:3px;\"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Help Desk</a><span style=\"float:right; padding-right:5px;\"><font color=\"green\">[ - ]<font></span></td></tr>\n");
else
print("<tr><td class=\"header\" align=\"left\"><a href=\"index.php?page=modules&amp;module=helpdesk\"><span style=\"float:left; padding-left:3px;\"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Help Desk</a><span style=\"float:right; padding-right:5px;\"><font color=\"red\">[ $count ]<font></span></td></tr>\n");

// no imdb
$countnoimdbt=get_result("SELECT * FROM {$TABLE_PREFIX}files WHERE (imdb='' OR imdb=0) AND imdb_ignore='no'");
$countnoimdb=count($countnoimdbt);

if ($countnoimdb==0)
print("<tr><td class=\"header\" align=\"left\"><a href=\"index.php?page=torrents\"><span style=\"float:left; padding-left:3px;\"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No IMDB</a><span style=\"float:right; padding-right:5px;\"><font color=\"green\">[ - ]<font></span></td></tr>\n");
else
print("<tr><td class=\"header\" align=\"left\"><a href=\"index.php?page=torrents\"><span style=\"float:left; padding-left:3px;\"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No IMDB</a><span style=\"float:right; padding-right:5px;\"><font color=\"red\">[ $countnoimdb ]<font></span></td></tr>\n");

//no imdb
$counttvdbq=do_sqlquery("SELECT * FROM {$TABLE_PREFIX}files f LEFT JOIN {$TABLE_PREFIX}categories c ON f.category=c.id WHERE (tvdb_id='' OR tvdb_id=0) AND c.sub=82");
$counttvdb=sql_num_rows($counttvdbq);
if ($counttvdb==0)
print("<tr><td class=\"header\" align=\"left\"><a href=\"index.php?page=torrents\"><span style=\"float:left; padding-left:3px;\"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No TVDB</a><span style=\"float:right; padding-right:5px;\"><font color=\"green\">[ - ]<font></span></td></tr>\n");
else
print("<tr><td class=\"header\" align=\"left\"><a href=\"index.php?page=torrents\"><span style=\"float:left; padding-left:3px;\"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No TVDB</a><span style=\"float:right; padding-right:5px;\"><font color=\"red\">[ {$counttvdb} ]<font></span></td></tr>\n");


//Hit and run cleaner
print("<tr><td class=\"header\" align=\"left\"><a href=\"index.php?page=modules&amp;module=hitnrun_cleaner\"><span style=\"float:left; padding-left:3px;\"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style=\"float:left; padding-right:5px;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Clean Hit & Run </span></a></td></tr>\n");

if ($btit_settings["cloud"]==TRUE)
print("<tr><td class=\"header\" align=\"left\"><a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=cloudflush\"><span style=\"float:left; padding-left:3px;\"></span><font color=\"red\"><span style=\"float:right; padding-right:5px;\">Cloud Flush<font></span></a></td><tr>\n");

//contact
$rescc=get_result("SELECT * FROM {$TABLE_PREFIX}contact_system WHERE re='no'");
$counc=count($rescc);

if ($counc==0)
print("<tr><td class=\"header\" align=\"left\"><span style=\"float:left; padding-left:3px;\"></span><a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&do=read_messages\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Contact</a><span style=\"float:right; padding-right:5px;\"><font color=\"green\">[ - ]<font></span></td></tr>\n");
else
print("<tr><td class=\"header\" align=\"left\"><span style=\"float:left; padding-left:3px;\"></span><a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&do=read_messages\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Contact</a><span style=\"float:right; padding-right:5px;\"><font color=\"red\">[ $counc ]<font></span></td></tr>\n");

//Users
$resusrc=do_sqlquery("SELECT COUNT(*) FROM {$TABLE_PREFIX}users WHERE id > 1");
$usrc=$resusrc->fetch_row();

print("<tr><td class=\"header\" align=\"left\"><a href=\"index.php?page=users\"><span style=\"float:left; padding-left:3px;\"></span><span style=\"float:left; padding-right:5px;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Users</span></a> <span style=\"float:right; padding-right:5px;\"><font color=\"green\"><b>[ $usrc[0] ]</font></span> </td></tr>\n");


//Partners
print("<tr><td class=\"header\" align=\"left\"><a href=\"index.php?page=partners\"><span style=\"float:left; padding-left:3px;\"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style=\"float:left; padding-right:5px;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Partners </span></a></td></tr>\n");

//Staff Announce
print("<tr><td class=\"header\" align=\"left\"><a href=\"javascript:announce('announcements.php')\"><span style=\"float:left; padding-left:3px;\"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style=\"float:left; padding-right:5px;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$language['MNU_ANNOUNCEMENT']."</span></a></td></tr>\n");

print("</TABLE>");
}
//end
?>
<div class="panel-footer">
</div>
</div>