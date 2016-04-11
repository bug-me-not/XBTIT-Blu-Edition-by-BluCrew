<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2007  Btiteam
//
//    This file is part of xbtit.
//
// BTI version created by TheDevil , converted to XBTIT-2 by DiemThuy - Nov 2008
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
	  
if ($CURUSER["id_level"]==1)
{
	redirect("index.php"); // redirects to index.php if guest
	exit();
}
      
$fav_uptpl= new bTemplate();
$fav_uptpl-> set("language",$language);

$do = $_GET["do"];
$fav_up_id = $_GET["fav_up_id"];

// Add member to friendlist

if ($do=="add")
{
	if (!isset($fav_up_id))
	{
		redirect("index.php"); // redirects to index.php if fav_up_id not set
		exit();
	}

    $hmm=do_sqlquery("SELECT * FROM {$TABLE_PREFIX}fav_uploader WHERE fav_up_id = '$fav_up_id' AND user_id = ".$CURUSER['uid']);
	if (sql_num_rows($hmm))
	{
		err_msg(ERROR,MEMBER_ALREADY_EXIST);
		block_end();
		stdfoot();
		exit();
	}
	$qry = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}users WHERE id = '$fav_up_id'");
	$res = $qry->fetch_array();
	$chk = sql_num_rows($qry);
	if (!$chk)
	{
		redirect("index.php"); // redirects to index.php if fav_up_id not in database
		exit();
	}
	do_sqlquery("INSERT INTO {$TABLE_PREFIX}fav_uploader (user_id, fav_up_id, fav_up_name) VALUES ('".$CURUSER["uid"]."', '".sql_esc($fav_up_id)."', '".$res["username"]."')");
    redirect("index.php?page=fav_up");
	exit();

}
// Delete friend
elseif ($do=="del")
{

	{
        $msg = sql_esc($_GET["id"]);
		quick_query("DELETE FROM {$TABLE_PREFIX}fav_uploader WHERE id=\"$msg\"");
	}
	redirect("index.php?page=fav_up");
	exit();
}
// Main friendlist page
else
{

	$qry=do_sqlquery("SELECT * FROM {$TABLE_PREFIX}fav_uploader WHERE user_id = ".$CURUSER['uid']);
	$coun=sql_num_rows($qry);

	if ($coun)

         $friend=array();
         $i=0;
	while ($res=$qry->fetch_array())
	{
		$tor=do_sqlquery("SELECT ul.prefixcolor, ul.suffixcolor, ul.level, u.username, u.avatar, UNIX_TIMESTAMP(u.lastconnect) AS lastconnect FROM {$TABLE_PREFIX}users u LEFT JOIN {$TABLE_PREFIX}users_level ul ON u.id_level=ul.id WHERE u.id>1 AND u.id = ".$res['fav_up_id']);

         $ret=mysql_fetch_array($tor);

        $avatar = ($ret["avatar"] && $ret["avatar"] != "" ? htmlspecialchars($ret["avatar"]) : "");
        if ($avatar=="")
        $av=("<img src='$STYLEURL/images/default_avatar.gif' border='0' width=50 />");
           else
           $av=("<img width=50 src=$avatar>");
// Online User

		$last = $ret['lastconnect'];
		$online=time();
			$online-=60*15;
		if($last > $online)
		{
			$online = "<img src=images/fonline.gif border=0> User is Online";
		}
		else
			$online = "<img src=images/foffline.gif border=0> User is Offline";
// end online users
       $fav_up[$i]["id"]=$res["id"];
       $fav_up[$i]["avatar"]=("<center>$av</center>");
       $fav_up[$i]["name"]=("<a href=index.php?page=fav_up_up&id=".$res["fav_up_id"].">".unesc($ret["prefixcolor"]).unesc($ret["username"]).unesc($ret["suffixcolor"])."</a>");
       $fav_up[$i]["level"]=$ret['level'];
       $fav_up[$i]["acces"]= date("d/m/y h:i:s",$ret['lastconnect']);
       $fav_up[$i]["status"]=("<center>$online</center>");
       $fav_up[$i]["delete"]=("<center><a href=\"index.php?page=fav_up&do=del&amp;id=".$fav_up[$i]["id"]."\" onclick=\"return confirm('".AddSlashes($language["DELETE_CONFIRM"])."')\">".image_or_link("$STYLEPATH/images/delete.png","",$language["DELETE"])."</a></center>");
       $i++;
}
}
	$fav_uptpl->set("fav_up",$fav_up);

?>
