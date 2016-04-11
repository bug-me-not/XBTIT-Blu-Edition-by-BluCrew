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



global $STYLEURL;

require_once(load_language("lang_teams.php"));

if (!$CURUSER || $CURUSER["edit_users"]!="yes")
    stderr($language["ERROR"],$language["TEAMS_ACC_DEN"]);

$team = htmlspecialchars($_GET['team']);
(isset($_GET["team_description"]) && !empty($_GET["team_description"])) ? $team_description = sqlesc($_GET["team_description"]) : $team_description="";
(isset($_GET["sure"]) && !empty($_GET["sure"]) && $_GET["sure"]=="yes") ? $sure="yes" : $sure="no";
(isset($_GET["add"]) && !empty($_GET["add"]) && $_GET["add"]=="true") ? $add="true" : $add="false";
(isset($_GET["edited"]) && !empty($_GET["edited"]) && is_numeric($_GET["edited"])) ? $edited = (int)0+$_GET['edited'] : $edited=0;
(isset($_GET["id"]) && !empty($_GET["id"]) && is_numeric($_GET["id"])) ? $id = (int)0+$_GET['id'] : $id=0;
(isset($_GET["del"]) && !empty($_GET["del"]) && is_numeric($_GET["del"])) ? $del = (int)0+$_GET['del'] : $del=0;
(isset($_GET["team_owner"]) && !empty($_GET["team_owner"]) && strlen($_GET["team_owner"])<=40) ? $teamownername = sqlesc($_GET["team_owner"]) : $teamownername="";
(isset($_GET["team_name"]) && !empty($_GET["team_name"]) && strlen($_GET["team_name"])<=255) ? $team_name = sqlesc($_GET["team_name"]) : $team_name="";
(isset($_GET["team_info"]) && !empty($_GET["team_info"])) ? $team_info = sqlesc($_GET["team_info"]) : $team_info="";
(isset($_GET["team_image"]) && !empty($_GET["team_image"]) && strlen($_GET["team_image"])<=255) ? $team_image = sqlesc($_GET["team_image"]) : $team_image="";
(isset($_GET["editid"]) && !empty($_GET["editid"]) && is_numeric($_GET["editid"])) ? $editid = (int)0+$_GET['editid'] : $editid=0;
(isset($_GET["name"]) && !empty($_GET["name"]) && strlen($_GET["name"])<=255) ? $name = sqlesc($_GET["name"]) : $name="";
(isset($_GET["image"]) && !empty($_GET["image"]) && strlen($_GET["image"])<=255) ? $image = sqlesc($_GET["image"]) : $image="";
(isset($_GET["owner"]) && !empty($_GET["owner"]) && strlen($_GET["owner"])<=40) ? $owner = sqlesc($_GET["owner"]) : $owner="";
(isset($_GET["info"]) && !empty($_GET["info"])) ? $info = sqlesc($_GET["info"]) : $info="";
(isset($_POST["team_state"]) && !empty($_POST["team_state"]) && ($_POST["team_state"]=="private" || $_POST["team_state"]=="public")) ? $team_state = sqlesc($_POST["team_state"]) : $team_state=false;

$admintpl->set("language",$language);
$admintpl->set("edit_page",false,true);
$admintpl->set("add",true,true);
$admintpl->set("display",true,true);
$admintpl->set("user", $CURUSER["uid"]);
$admintpl->set("code", $CURUSER["random"]);
$admintpl->set("name",$name);
$admintpl->set("image",$image);
$admintpl->set("owner",$owner);
$admintpl->set("private_mode", (($btit_settings["team_state"]=="private")?true:false), true);
$admintpl->set("public_mode", (($btit_settings["team_state"]=="public")?true:false), true);

if($team_state!==false && $btit_settings["team_state"]!=$team_state)
{
    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$team_state."' WHERE `key`='team_state'", true);

    foreach (glob($THIS_BASEPATH."/cache/*.txt") as $filename)
        unlink($filename);
    redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=teams");
}

//Delete Team
if($del > 0 && $sure == "yes")
{
    $query = "UPDATE `{$TABLE_PREFIX}users` SET `team`=0 WHERE `team`=".$del;
    $sql = do_sqlquery($query,true);

    $query = "UPDATE `{$TABLE_PREFIX}users_level` SET `sel_team`=0 WHERE `sel_team`=".$del;
    $sql = do_sqlquery($query,true);

    $query = "UPDATE `{$TABLE_PREFIX}files` SET `team`=0 WHERE `team`=".$del;
    $sql = do_sqlquery($query,true);

    $query = "DELETE FROM `{$TABLE_PREFIX}teams` WHERE `id`=".$del." LIMIT 1";
    $sql = do_sqlquery($query,true);

    write_log($language["TEAMS_DELETED"].": ".$del,"delete");
    success_msg($language["SUCCESS"],$language["TEAMS_SUC_DEL"]."&nbsp;[<a href='index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=teams'>".$language["BACK"]."</a>]");
    stdfoot();
    exit();
}
elseif($del>0 && $sure=="no")
    stderr($language["FRM_CONFIRM"],"<b>".$language["TEAMS_DEL_CON1"]." ($team) ( <b><a href='index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=teams&del=".$del."&team=".$team."&sure=yes'>".$language["YES"]."!</a></b> / <b><a href='index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=teams'>".$language["NO"]."!</a></b> )");


//Edit Team
if($edited == 1)
{
    $aa = do_sqlquery("SELECT `id` FROM `{$TABLE_PREFIX}users` WHERE `username`='".$teamownername."'",true);
    if(@sql_num_rows($aa)>0)
    {
        $ar = $aa->fetch_assoc();
        $team_owner = (int)0+$ar["id"];
        $query = "UPDATE `{$TABLE_PREFIX}teams` SET `name` = '".$team_name."', `info` = '".$team_info."', `owner` = ".$team_owner.", `image` = '".$team_image."' WHERE `id`=".$id;
        $sql = do_sqlquery($query,true);

        quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `team` = ".$id." WHERE `id`=".$team_owner,true);

        if($sql)
        {
            success_msg($language["SUCCESS"],$language["TEAMS_UPD_TEAM"]."!<br><a href='index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=teams'>".$language["BACK"]."</a>");
            write_log($language["TEAMS_HAS_EDIT"]." (".$team_name.")","edit");
            stdfoot();
            exit();
        }
    }
    else
        stderr($language["ERROR"],$language["TEAMS_NO_OWNER"]);
}

if($editid > 0)
{
    $admintpl->set("edit_page",true,true);
    $admintpl->set("add",false,true);
    $admintpl->set("display",false,true);
    $admintpl->set("edity", textbbcode("smolf3d1","team_info",$info));
    $admintpl->set("editid",$editid);
}

//Add Team
if($add == 'true')
{
    $ping=do_sqlquery("SELECT `id` FROM `{$TABLE_PREFIX}teams` WHERE `name`='".$team_name."'",true);
    if(@sql_num_rows($ping)>0)
        stderr($language["ERROR"],$language["TEAMS_T_EXISTS"]);

    $pname=do_sqlquery("SELECT `u`.`username` FROM `{$TABLE_PREFIX}teams` `t` LEFT JOIN `{$TABLE_PREFIX}users` `u` on `u`.`id`=`t`.`owner` WHERE `t`.`id`>0 ORDER BY `u`.`username` ASC",true);
    while($pnames=$pname->fetch_array())
    {
        if($pnames["username"]==$team_owner)
            stderr($language["ERROR"],$language["TEAMS_O_EXISTS"]);
    }

    // check image extension if someone has a better idea ;)
    if ($team_image && $team_image!="" && !in_array(substr($team_image,strlen($team_image)-4),array(".gif",".jpg",".bmp",".png",".ico")))
        stderr($language["ERROR"],$language["TEAMS_NOT_IMG"]);

    $aa = do_sqlquery("SELECT `id` FROM `{$TABLE_PREFIX}users` WHERE `username`='".$teamownername."'",true);
    if(@sql_num_rows($aa)==0)
        stderr($language["ERROR"],$language["TEAMS_NO_OWNER"]);

    $ar = $aa->fetch_assoc();
    $team_owner = $ar["id"];
    $query = "INSERT INTO `{$TABLE_PREFIX}teams` SET `name` = '".$team_name."', `owner` = $team_owner , `info` = '".$team_description."', `image` = '".$team_image."'";
    $sql = do_sqlquery($query,true);

    $tid = sql_insert_id();

    quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `team` = '$tid' WHERE `id`=".$team_owner,true);

    if($sql)
    {
        write_log("has created new team (".sqlesc($team_name).")","edit");
        $admintpl->set("success",$language["TEAMS_T_ADDED"]);
    }
    else
        $admintpl->set("success","");
}

$admintpl->set("desc",textbbcode("smolf3d","team_description"));

//ELSE Display Teams
$teamsres=do_sqlquery("SELECT COUNT(*) FROM `{$TABLE_PREFIX}teams` WHERE `id`>0",true);
$teamnum=$teamsres->fetch_row();
$num2=$teamnum[0];
$perpage=(max(0,$CURUSER["torrentsperpage"])>0?$CURUSER["torrentsperpage"]:10);
list($pagertop, $pagerbottom, $limit) = pager($perpage, $num2, "index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=teams&amp;");

$admintpl->set("pagertop",$pagertop);
$admintpl->set("pagerbottom",$pagerbottom);

$teamres=do_sqlquery("SELECT `u`.`username`, `ul`.`prefixcolor`, `ul`.`suffixcolor`, `t`.`id`, `t`.`name`, `t`.`image`, `t`.`owner`, `t`.`info` FROM `{$TABLE_PREFIX}teams` `t` LEFT JOIN `{$TABLE_PREFIX}users` `u` ON `t`.`owner`=`u`.`id` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level`=`ul`.`id` WHERE `t`.`id`>0 ORDER BY `t`.`id` ASC $limit",true);

$teams=array();
$i=0;

while ($row = $teamres->fetch_array())
{
    $OWNERNAME = $row["username"];
    $id = (int)0+$row['id'];
    $name = htmlspecialchars($row['name']);
    $image = htmlspecialchars($row['image']);
    $info = htmlspecialchars($row['info']);
    $teams[$i]["id"] = (int)$row['id'];
    $teams[$i]["name"] = htmlspecialchars($row['name']);
    $teams[$i]["image"] = htmlspecialchars($row['image']);
    $teams[$i]["owner"] = (int)$row['owner'];
    $teams[$i]["info"] = format_comment($row['info']);
    $teams[$i]["OWNERNAME"] = unesc($row["prefixcolor"] . $row["username"] . $row["suffixcolor"]);
    $teams[$i]["delb"]="<a href='index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=teams&del=$id&team=$name'><img src=$STYLEURL/images/delete.png border=0></a>";
    $teams[$i]["edb"]="<a href='index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=teams&editid=$id&name=$name&image=$image&info=$info&owner=$OWNERNAME'><img src=$STYLEURL/images/edit.png border=0></a>";
    $i++;
}
$admintpl->set("teams",$teams);

?>
