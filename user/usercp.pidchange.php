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


switch ($action)
{
    case 'post':
          $pid=md5(uniqid(rand(),true));
          $res=quickQuery("UPDATE {$TABLE_PREFIX}users SET pid='".$pid."' WHERE id='".$CURUSER['uid']."'",true);
          if ($res)
             {
             if($XBTT_USE)
                 quickQuery("UPDATE xbt_users SET torrent_pass='".$pid."' WHERE uid='".$CURUSER['uid']."'",true);
             redirect("index.php?page=usercp&uid=".$uid."");
             exit();
             }
          else
         {
        err_msg($language["ERROR"],$language["NOT_POSS_RESET_PID"]."<br /><a href=\"index.php?page=usercp&amp;uid=".$uid."\">".$language["HOME"]."</a><br />");
        stdfoot();
        exit;
         }
    break;

    case '':
    case 'change':
    default:
    $result=do_sqlquery("SELECT pid FROM {$TABLE_PREFIX}users WHERE id=".$CURUSER['uid'],true);
    $row = $result->fetch_assoc();
    $pid=$row["pid"];
    if (!$pid)
      {
        $pid=md5(uniqid(rand(),true));
        $res=quickQuery("UPDATE {$TABLE_PREFIX}users SET pid='".$pid."' WHERE id='".$CURUSER['uid']."'",true);
      }
    else
      {
        $usercptpl->set("IS_PEER",false,true);
        // we must check if user is currently a peer
        if ($XBTT_USE)
          {
        $rp=do_sqlquery("SELECT COUNT(*) FROM xbt_files_users xfu INNER JOIN xbt_users xu ON xfu.uid=xu.uid WHERE xu.torrent_pass='$pid' AND xfu.active=1",true);
        $ispeer=$rp->fetch_row();
        if ($ispeer[0] > "0") $usercptpl->set("IS_PEER",true,true);
        $rp->free();
          }
        else
          {
        $rp=do_sqlquery("SELECT COUNT(*) FROM {$TABLE_PREFIX}peers WHERE pid='$pid'");
        $ispeer=$rp->fetch_row();
        if ($ispeer[0] > "0") $usercptpl->set("IS_PEER",true,true);
        $rp->free();
          }
      }
    $pid_ctpl=array();
    $pid_ctpl["frm_action"]="index.php?page=usercp&amp;do=pid_c&amp;action=post&amp;uid=".$uid."";
    $pid_ctpl["userpid"]=$pid;
    $pid_ctpl["ispeer"]=($ispeer[0]>0?$language["CURRENTLY_PEER"]."<br />".$language["STOP_PEER"]."\n":"");
    $pid_ctpl["reset_disabled"]=($ispeer[0]>0?"disabled":"");
    $pid_ctpl["frm_cancel"]="index.php?page=usercp&amp;uid=".$uid."";
    $usercptpl->set("pid_c",$pid_ctpl);
    break;
}
?>