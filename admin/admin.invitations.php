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



function read_invitations()
{
    global $TABLE_PREFIX, $admintpl, $language, $CURUSER, $STYLEPATH, $btit_settings;

    $scriptname = htmlspecialchars($_SERVER["PHP_SELF"] . "?page=admin&user=" . $CURUSER["uid"] .
        "&code=" . $CURUSER["random"] . "&do=invitations");
    $addparam = "";
    $res = get_result("SELECT COUNT(*) as invites FROM {$TABLE_PREFIX}invitations", true);
    $count = $res[0]["invites"];

    list($pagertop, $pagerbottom, $limit) = pager('15', $count, $scriptname .
        "&amp;");

    $admintpl->set("inv_pagertop", $pagertop);
    $admintpl->set("inv_pagerbottom", $pagerbottom);

    $results = get_result("SELECT `i`.*, `u`.`username` FROM `{$TABLE_PREFIX}invitations` `i` LEFT JOIN `{$TABLE_PREFIX}users` `u` ON `i`.`inviter`=`u`.`id` ORDER BY `i`.`id` DESC $limit", true, $btit_settings["cache_duration"]);
    $invitees = array();
    $i = 0;
    foreach ($results as $data)
    {
        $inviter_name = $data["username"];
        $invitees[$i]["inviter"] = "<a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$data["inviter"]."_".strtr($inviter_name, $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$data["inviter"])."'>".$inviter_name."</a>";
        $invitees[$i]["invitee"] = unesc($data["invitee"]);
        $invitees[$i]["hash"] = unesc($data["hash"]);
        $invitees[$i]["time_invited"] = $data["time_invited"];
        $invitees[$i]["delete"] = "<a href=\"index.php?page=admin&amp;user=" . $CURUSER["uid"] .
            "&amp;code=" . $CURUSER["random"] .
            "&amp;do=invitations&amp;action=delete&amp;id=" . $data["id"] . "\" onclick=\"return confirm('" .
            AddSlashes($language["DELETE_CONFIRM"]) . "')\">" . image_or_link("$STYLEPATH/images/delete.png",
            "", $language["DELETE"]) . "</a>";
        $i++;
    }
    $admintpl->set("invitees", $invitees);
    $admintpl->set("language", $language);
}

switch ($action)
{
    case 'activate':
        if ($_POST["confirm"] == $language["FRM_CONFIRM"])
        {
            quickQuery("UPDATE {$TABLE_PREFIX}settings SET `value`='" . $_POST["ptracker"] .
                "' WHERE `key`='invitation_only'", true);

            //turn of inviter validation, no sense in keepin' it on
            if ($_POST["ptracker"] == "false")
            {
                $reqvalid = sql_esc($_POST["ptracker"]);
                quickQuery("UPDATE {$TABLE_PREFIX}settings SET `value`='0' WHERE `key`='max_users'", true);
            }
            else
            {
                $reqvalid = sql_esc($_POST["reqvalid"]);
                quickQuery("UPDATE {$TABLE_PREFIX}settings SET `value`='1' WHERE `key`='max_users'", true);
            }
            quickQuery("UPDATE {$TABLE_PREFIX}settings SET `value`='" . $reqvalid .
                "' WHERE `key`='invitation_reqvalid'", true);

            $setting = sqlesc($_POST["rec_after"]);
            quickQuery("UPDATE {$TABLE_PREFIX}settings SET `value`=" . $setting .
                " WHERE `key`='invitation_expires'", true);
        }
        redirect("index.php?page=admin&user=" . $CURUSER["uid"] . "&code=" . $CURUSER["random"] .
            "&do=invitations&action=read");
        break;

    case 'send':

        (isset($_POST["num_invs"]) && is_numeric($_POST["num_invs"])) ? $num_invites=$_POST["num_invs"] : $num_invites=0;
        (isset($_POST["level"]) && is_numeric($_POST["level"])) ? $level=$_POST["level"] : $level=FALSE;
        (isset($_POST["receiver"])) ? $receiver=sql_esc($_POST["receiver"]) : $receiver="";
        if ($receiver!="" && $num_invites>=1)
            $destiny = "`username`='".$receiver."'";
        elseif($receiver=="" && $level!==FALSE && $num_invites>=1)
        {
            if ($level!=0)
                $destiny = "`id_level`=".$level;
            elseif($level==0)
                $destiny = "`id_level`>1";
        }
        else
        {
            stderr($language["ERROR"],$language["MISSING_DATA"]);
        }

        // send invitations to a user
        quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `invitations`=`invitations`+$num_invites WHERE " .
            $destiny, true);
        redirect("index.php?page=admin&user=" . $CURUSER["uid"] . "&code=" . $CURUSER["random"] .
            "&do=invitations&action=read");
        break;

    case 'delete':
        if (isset($_GET["id"]))
        {
            // let's delete the invitation and send a PM to the inviter
            // just in case you want to justify the deletion
            $id = max(0, $_GET["id"]);
            // update the deleted user's style to default one
            quickQuery("DELETE FROM {$TABLE_PREFIX}invitations WHERE id=$id", true);
            redirect("index.php?page=admin&user=" . $CURUSER["uid"] . "&code=" . $CURUSER["random"] .
                "&do=invitations&action=read");
        }
        break;

    case '':
    case 'read':
    default:
        $btit_settings = get_fresh_config("SELECT `key`,`value` FROM {$TABLE_PREFIX}settings") or
            sqlerr(__file__, __line__);

        $invit["ptracker_on"] = ($btit_settings['invitation_only'] ? "checked=\"checked\"" :
            "");
        $invit["ptracker_off"] = (!$btit_settings['invitation_only'] ? "checked=\"checked\"" :
            "");

        $invit["reqvalid_on"] = ($btit_settings['invitation_reqvalid'] ? "checked=\"checked\"" :
            "");
        $invit["reqvalid_off"] = (!$btit_settings['invitation_reqvalid'] ? "checked=\"checked\"" :
            "");
        $invit["recycle_after"] = $btit_settings['invitation_expires'];
        $admintpl->set("invit", $invit);
        $admintpl->set("receiver", $_POST["receiver"]);

        $opts['name'] = 'level';
        $opts['complete'] = true;
        $opts['id'] = 'id';
        $opts['value'] = 'level';
        $opts['default'] = 0;

        $ranks = rank_list();
        $ranks[] = array('id' => 0, 'level' => $language['ALL']);
        $admintpl->set("group_combo", get_combo($ranks, $opts));

        $admintpl->set("searchuser", "<a href=\"javascript:popusers('searchusers.php');\">" .
            $language["FIND_USER"] . "</a>");

        read_invitations();

        $admintpl->set("frm_action", "index.php?page=admin&amp;user=" . $CURUSER["uid"] .
            "&amp;code=" . $CURUSER["random"] . "&amp;do=invitations&amp;action=send");

        $admintpl->set("frm1_action", "index.php?page=admin&amp;user=" . $CURUSER["uid"] .
            "&amp;code=" . $CURUSER["random"] . "&amp;do=invitations&amp;action=activate");
}

?>
