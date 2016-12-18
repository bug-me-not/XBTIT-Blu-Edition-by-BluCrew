<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  XBtiteam
//
//    This file is part of xbtit.
//
// Gifts by DiemThuy - Dec 2010
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



global $btit_settings;

// select single user
function get_id_by_name($name)
{
    global $TABLE_PREFIX;

    $id_query = do_sqlquery("SELECT id FROM {$TABLE_PREFIX}users WHERE `username`='$name'",true);
    $id = $id_query->fetch_array();

    return $id["id"];
}
// select single user end

// select rank
$opts['name']='level';
$opts['complete']=true;
$opts['id']='id';
$opts['value']='level';
$opts['default']=$row['id_level'];
$ranks=rank_list();
// Get rid of the guest rank
unset($ranks[0]);
$admintpl->set('rank_combo',get_combodt($ranks, $opts));
// select rank end

if($_GET["action"] == 'save')
{
    if(!empty($_POST["selecta"]) || !empty($_POST["selectb"]) || !empty($_POST["what"]))
    {
        $username = sql_esc($_POST["username"]);
        $custom=sql_esc($_POST["custom"]);
        (isset($_POST["level"]) && !empty($_POST["level"]) && is_numeric($_POST["level"])) ? $level=(int)0+$_POST["level"] : $level=0;
        (isset($_POST["what"]) && !empty($_POST["what"]) && is_numeric($_POST["what"])) ? $what=(float)0+$_POST["what"] : $what=0;

        if($level==0 OR $what==0)
        stderr($language["ERROR"], $language["GIFT_ERROR_MSG"]);

        // what
        if($_POST["selectb"]=='1')
        {
            if($btit_settings["fmhack_invitation_system"]!="enabled")
                stderr($language["ERROR"], $language["No_GO_INV"]);
            else
                $item = "invitations";
            $var =	$language["GIFTS_INV"];
        }
        elseif($_POST["selectb"]=='2')
        {
            if($btit_settings["fmhack_bonus_system"]!="enabled")
                stderr($language["ERROR"], $language["No_GO_SB"]);
            else
                $item = "seedbonus";
            $var = $language["GIFTS_SBP"];
        }
        // what end

        // pm
        $subj=sqlesc($language['GIFT_SUBJECT']);
        $msg=sqlesc($language['GIFT_MES_A']." ".$what." ".$var." \n\n ".$custom." \n\n [color=red]".$language['GIFT_MES_B']."[/color]");
        // pm end

        // who and update
		if($_POST["selecta"]=='1')
        {
            $userid=get_id_by_name($username);
            quickQuery("UPDATE {$TABLE_PREFIX}users SET ".$item." = ".$item." + ".$what." WHERE `id` = ".$userid."", true);
            send_pm(0,$userid,$subj,$msg);
        }
        elseif($_POST["selecta"]=='2')
        {
            quickQuery("UPDATE {$TABLE_PREFIX}users SET ".$item." = ".$item." + ".$what." WHERE `id_level` = ".$level."", true);
			$result = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}users WHERE `id_level` = ".$level, true);
			while($arr=$result->fetch_assoc())
            {
                $uid = $arr["id"];
                send_pm(0,$uid,$subj,$msg);
            }
        }
        elseif($_POST["selecta"]=='3')
        {
            quickQuery("UPDATE {$TABLE_PREFIX}users SET ".$item." = ".$item." + ".$what." WHERE id>1", true);
			$result = do_sqlquery("SELECT id FROM {$TABLE_PREFIX}users WHERE id>1 ORDER BY id ASC",true);
			while($arr=$result->fetch_assoc())
			{
                $uid = $arr["id"];
                send_pm(0,$uid,$subj,$msg);
            }
        }
        // who and update end

        redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=gifts&updated=yes");
    }
    else
    {
        stderr($language["ERROR"],$language["ALL_FIELDS_REQUIRED"]);
    }
}
else
{
    $admintpl->set("updated", $_GET["updated"]=="yes", true);
    $admintpl->set("language",$language);
    $admintpl->set("frm_action","index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=gifts&amp;action=save");
}

?>
