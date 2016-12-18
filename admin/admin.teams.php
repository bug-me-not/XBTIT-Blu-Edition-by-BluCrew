<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  Btiteam
//
//    This file is part of xbtit.
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

if (!defined("IN_ACP"))
    die("non direct access!");



require_once(load_language("lang_teams.php"));
$admintpl->set("language",$language);

if (!$CURUSER || $CURUSER["admin_access"]!="yes")
    stderr($language["ERROR"],$language["NOT_ADMIN_CP_ACCESS"]);
else
{
    $teamsres=do_sqlquery("SELECT COUNT(*) FROM `{$TABLE_PREFIX}users` WHERE `team`>0 ORDER BY `team` ASC, `id` ASC $limit",true);
    $teamnum=$teamsres->fetch_row();
    $num2=$teamnum[0];
    $perpage=(max(0,$CURUSER["torrentsperpage"])>0?$CURUSER["torrentsperpage"]:10);
    list($pagertop, $pagerbottom, $limit) = pager($perpage, $num2, "index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=team_users&amp;");

    $admintpl->set("pagertop",$pagertop);
    $admintpl->set("pagerbottom",$pagerbottom);

    $teamres=do_sqlquery("SELECT `u`.`id`, `u`.`username`, `ul`.`prefixcolor`, `ul`.`suffixcolor`, `u`.`team` `userteam`, `t`.`id` `teamsid`, `t`.`name` `teamname`, `t`.`image` `teamimage`
                          FROM `{$TABLE_PREFIX}teams` `t`
                          LEFT JOIN `{$TABLE_PREFIX}users` `u` ON `u`.`team` = `t`.`id`
                          LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level`=`ul`.`id`
                          WHERE `u`.`team` >0
                          ORDER BY `u`.`team` ASC, `u`.`id` ASC $limit",true);

    $teams=array();
    $i=0;

    while ($row = $teamres->fetch_array())
    {
        $teams[$i]["id"] = (int)$row["id"];
	    $teams[$i]["username"] = stripslashes($row["prefixcolor"].$row["username"].$row["suffixcolor"]);
	    $teams[$i]["teamimage"] = htmlspecialchars($row["teamimage"]);
	    $teams[$i]["teamname"] =  htmlspecialchars($row["teamname"]);
        $i++;
    }
    $admintpl->set("teams",$teams);
    unset($row);
    @$teamres->free();
    unset($teams);
}

?>
