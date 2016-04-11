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


if (!$CURUSER || $CURUSER["admin_access"]!="yes")
   {
       err_msg(ERROR,NOT_ADMIN_CP_ACCESS);
       stdfoot();
       exit;
}
else
{
    $delete_timeout=time() - (60*60*24*7); // delete log older then 7 days
    quickQuery("DELETE FROM {$TABLE_PREFIX}logs where added<$delete_timeout");
    $logres=do_sqlquery("SELECT COUNT(*) FROM {$TABLE_PREFIX}logs ORDER BY added DESC");
    $lognum=$logres->fetch_row();
    $num=$lognum[0];
    $perpage=(max(0,$CURUSER["postsperpage"])>0?$CURUSER["postsperpage"]:20);
    list($pagertop, $pagerbottom, $limit) = pager($perpage, $num, "index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=logview&amp;");

    $admintpl->set("language",$language);
    $admintpl->set("pager_top",$pagertop);
    $admintpl->set("pager_bottom",$pagerbottom);

    $logres=do_sqlquery("SELECT * FROM {$TABLE_PREFIX}logs ORDER BY added DESC $limit");
    $log=array();
    $i=0;

    include("$THIS_BASEPATH/include/offset.php");

    if ($logres)
        {
        while ($logview=$logres->fetch_assoc())
            {
            if ($logview["type"]=="delete")
                $log[$i]["class"]="class=\"deleted\"";
            elseif ($logview["type"]=="add")
                $log[$i]["class"]="class=\"added\"";
            elseif ($logview["type"]=="modify")
                $log[$i]["class"]="class=\"modified\"";
            else
                $log[$i]["class"]="class=\"lista\"";

          $log[$i]["date"]=date("d/m/Y H:i:s",$logview["added"]-$offset);
          $log[$i]["username"]=$logview["user"];
          $log[$i]["action"]=$logview["txt"];
          $i++;
         }

    }

    $admintpl->set("logs",$log);

    unset($logview);
    $logres->free();
    unset($log);

}
?>
