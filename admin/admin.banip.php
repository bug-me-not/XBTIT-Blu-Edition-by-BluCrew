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

switch ($action)
    {

    case 'delete':

        if ($_GET['ip']=="")
            stderr($language["ERROR"],$language["INVALID_ID"]);
        //delete the ip from db
        $id = max(0,$_GET['ip']);
        if($XBTT_USE)
        {
            $res=get_result("SELECT `first`, `last` FROM `{$TABLE_PREFIX}bannedip` WHERE `id`=".$id, true, $btit_settings["cache_duration"]);
            if(count($res)>0)
                quickQuery("DELETE FROM `xbt_deny_from_hosts` WHERE `begin`='".$res[0]["first"]."' AND `end`='".$res[0]["last"]."'", true);
        }
        quickQuery("DELETE FROM {$TABLE_PREFIX}bannedip WHERE id=".$id,true);
        success_msg($language["SUCCESS"],$language["BAN_DELETED"]);
        stdfoot(true,false);
        break;

    case 'write':
        if ($_POST['firstip']=="" || $_POST['lastip']=="")
            stderr($language["ERROR"],$language["BAN_NO_IP_WRITE"]);
        else
         {
            //ban the ip for real
            $firstip = $_POST["firstip"];
            $lastip = $_POST["lastip"];
            $comment = $_POST["comment"];
            $firstip = sprintf("%u", ip2long($firstip));
            $lastip = sprintf("%u", ip2long($lastip));
            if ($firstip == -1 || $lastip == -1)
                 err_msg($language["ERROR"],$language["BAN_IP_ERROR"]);
            else{
                 $comment = sqlesc($comment);
                 $added = sqlesc(time());
                 quickQuery("INSERT INTO {$TABLE_PREFIX}bannedip (added, addedby, first, last, comment) VALUES($added, ".$CURUSER["uid"].", $firstip, $lastip, $comment)",true);
                 if($XBTT_USE)
                     quickQuery("INSERT INTO `xbt_deny_from_hosts` (`begin`, `end`) VALUES ('".$firstip."', '".$lastip."')", true);
            }
          }
    // don't break, so now we read directly ;)

    case '':
    case 'read':
    default:
        $banned=array();
        $getbanned = do_sqlquery("SELECT b.*, u.username FROM {$TABLE_PREFIX}bannedip b LEFT JOIN {$TABLE_PREFIX}users u ON u.id=b.addedby ORDER BY b.added DESC",true);
        $rowsbanned = @sql_num_rows($getbanned);
        $admintpl->set("frm_action","index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=banip&amp;action=write");
        $i=0;
        if ($rowsbanned>0)
        {
           $admintpl->set("no_records",false,true);

           while ($arr=$getbanned->fetch_assoc())
              {
              $banned[$i]["first_ip"] = long2ip($arr["first"]);
              $banned[$i]["last_ip"] = long2ip($arr["last"]);
              $banned[$i]["date"] = get_date_time($arr['added']);
              $banned[$i]["comments"] = htmlspecialchars(unesc($arr["comment"]));
              $banned[$i]["by"] = "<a href=\"".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$arr["addedby"]."_".strtr($arr["username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$arr["addedby"])."\">".unesc($arr["username"])."</a>";
              $banned[$i]["remove"] = "<a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=banip&amp;action=delete&amp;ip=".$arr["id"]."\" onclick=\"return confirm('". str_replace("'","\'",$language["DELETE_CONFIRM"])."')\">".image_or_link("$STYLEPATH/images/delete.png","",$language["DELETE"])."</a>";
           $i++;
           }
        }
        else
           $admintpl->set("no_records",true,true);

        $admintpl->set("bannedip",$banned);
        $admintpl->set("language",$language);
    }

?>
