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



function get_id_by_name($name)
{

	global $TABLE_PREFIX;

	$id_query = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}users WHERE `username`='$name'",true);
	$id = $id_query->fetch_array();

	return $id["id"];
}

if($_GET["action"] == 'save')
{
	if(!empty($_POST["username"]) || !empty($_POST["bytes"]) || !empty($_POST["what"]) || !empty($_POST["uploaded"]) || !empty($_POST["downloaded"]))
	{
		$username = sql_esc($_POST["username"]);
		$userid=get_id_by_name($username);

		if($_POST["bytes"]=='1')
			{
			$uploaded = $_POST["uploaded"];
			$downloaded = $_POST["downloaded"];
			}
		elseif($_POST["bytes"]=='2')
			{
			$uploaded = $_POST["uploaded"]*1024;
			$downloaded = $_POST["downloaded"]*1024;
			}
		elseif($_POST["bytes"]=='3')
			{
			$uploaded = $_POST["uploaded"]*1024*1024;
			$downloaded = $_POST["downloaded"]*1024*1024;
			}
		elseif($_POST["bytes"]=='4')
			{
			$uploaded = $_POST["uploaded"]*1024*1024*1024;
			$downloaded = $_POST["downloaded"]*1024*1024*1024;
			}
		elseif($_POST["bytes"]=='5')
			{
			$uploaded = $_POST["uploaded"]*1024*1024*1024*1024;
			$downloaded = $_POST["downloaded"]*1024*1024*1024*1024;
			}


	    if ($XBTT_USE)
        {
            $udownloaded="u.downloaded+IFNULL(x.downloaded,0) `downloaded`";
            $uuploaded="u.uploaded+IFNULL(x.uploaded,0) `uploaded`";
            $utables="{$TABLE_PREFIX}users u LEFT JOIN xbt_users x ON x.uid=u.id";
        }
        else
        {
            $udownloaded="u.downloaded";
            $uuploaded="u.uploaded";
            $utables="{$TABLE_PREFIX}users u";
        }

		if($_POST["what"] =='1')
			{
			$result = do_sqlquery("SELECT ".$uuploaded.", ".$udownloaded." FROM ".$utables." WHERE `u`.`id` = ".$userid, true);
			$arr = $result->fetch_assoc();
			$uploaded = $arr["uploaded"]+$uploaded;
			$downloaded = $arr["downloaded"]+$downloaded;
			if($XBTT_USE)
			{
                quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `uploaded`=0, `downloaded`=0 WHERE `id`= ".$userid, true);
                quickQuery("UPDATE `xbt_users` SET `uploaded` = $uploaded, `downloaded` = $downloaded WHERE `uid` = ".$userid, true);
            }
			else
                quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `uploaded` = $uploaded, `downloaded` = $downloaded WHERE `id` = ".$userid, true);
			}
		elseif($_POST["what"] =='2')
			{
			$result = do_sqlquery("SELECT ".$uuploaded.", ".$udownloaded." FROM ".$utables." WHERE `u`.`id` = ".$userid, true);
			$arr = $result->fetch_assoc();
			$uploaded = $arr["uploaded"]-$uploaded;
			$downloaded = $arr["downloaded"]-$downloaded;
			if($XBTT_USE)
			{
                quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `uploaded`=0, `downloaded`=0 WHERE `id`= ".$userid, true);
                quickQuery("UPDATE `xbt_users` SET `uploaded` = ".(($uploaded<0)?0:$uploaded).", `downloaded` = ".(($downloaded<0)?0:$downloaded)." WHERE `uid` = ".$userid, true);
            }
			else
                quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `uploaded` = $uploaded, `downloaded` = $downloaded WHERE `id` = ".$userid, true);
			}
		elseif($_POST["what"] =='3')
			{
			if($XBTT_USE)
			{
                quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `uploaded`=0, `downloaded`=0 WHERE `id`= ".$userid, true);
                quickQuery("UPDATE `xbt_users` SET `uploaded` = $uploaded, `downloaded` = $downloaded WHERE `uid` = ".$userid, true);
            }
			else
                quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `uploaded` = $uploaded, `downloaded` = $downloaded WHERE `id` = ".$userid, true);
			}
		redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=ratio-editor&updated=yes");
	} else {
		stderr($language["ERROR"],$language["ALL_FIELDS_REQUIRED"]);
	}
}
else
{
	$admintpl->set("updated", $_GET["updated"]=="yes", true);
	$admintpl->set("language",$language);
	$admintpl->set("frm_action","index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=ratio-editor&action=save");
}

?>
