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

  /*################################################################
  #
  #         Ajax MySQL shoutbox for btit
  #         Version  1.0
  #         Author : miskotes
  #         Created: 11/07/2007
  #         Contact: miskotes [at] yahoo.co.uk
  #         Website: YU-Corner.com
  #         Credits: linuxuser.at, plasticshore.com
  #
  ################################################################*/

# emulate register_globals on
if (!ini_get('register_globals')) {
        extract($_POST, EXTR_SKIP);
}
$name = $n; # name from the form
$text = $c; # comment from the form
$uid = (int)$u;  # userid from the form
include("../include/settings.php");
include("../include/common.php");
require("../include/crk_protection.php");//xss fix
mysql_select_db($database, mysql_connect($dbhost,$dbuser,$dbpass));

$secsui_res=mysql_query("SELECT * FROM `{$TABLE_PREFIX}settings`");
while($secsui_arr=mysql_fetch_assoc($secsui_res))
{
    $btit_settings[$secsui_arr["key"]]=$secsui_arr["value"];
}

$cookie=test_my_cookie();

if($cookie["is_valid"]===false || $cookie["id"]==1)
    die;

if($cookie["id"]!=$uid)
{
    // select first owner (default id_level=8) from users table
    $ra=mysql_fetch_assoc(mysql_query("SELECT `id` FROM `{$TABLE_PREFIX}users` WHERE `id_level`=8 ORDER BY `id` LIMIT 1"));
    $admin_pm_id=$ra['id'];

    $ip=getip();
    $name="Hacker [$ip]";
    $uid=1;
    $text="[color=red][b]I am a hacker who deserves to be banned![/b][/color] :axe:";
    $res=mysql_query("SELECT `id`, `username` FROM `{$TABLE_PREFIX}users` WHERE `cip`='$ip' ORDER BY `id` ASC");
    if(@mysql_num_rows($res)>0)
    {
        if($btit_settings["fmhack_SEO_panel"]=="enabled")
        {
            $active_seo = mysql_query("SELECT `activated_user`, `str`, `strto` FROM `{$TABLE_PREFIX}seo` WHERE `id`='1'", $conn);
            $res_seo=mysql_fetch_assoc($active_seo);
        }
        $subject="Shoutbox hack attempt!";
        $msg="Someone with the IP Address $ip hacked the shoutbox on ".date('l jS F Y \a\\t g:ia', time()).", here is a list of potential members to check:\n\n";
        while($row=mysql_fetch_assoc($res))
        {
            $msg.="[url=$BASEURL/".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$row["id"]."_".strtr($row["username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$row["id"])."]".$row["username"]."[/url]\n";
        }
        $FORUMLINK=$btit_settings["forum"];
        send_pm(0,$admin_pm_id,sqlesc($subject),sqlesc($msg));
    }
}

# some weird conversion of the data inputed
$name = str_replace("\'","'",$name);
$name = str_replace("'","\'",$name);
$text = str_replace("\'","'",$text);
$text = str_replace("'","\'",$text);
$text = str_replace("---"," - - ",$text);
$text = str_replace("[IMG]","[img]",$text);
$text = str_replace("[/IMG]","[/img]",$text);

$img_test = "/\[img\]((http)+(s)?:\/\/[^\s'\"<>]+(\.gif|\.jpg|\.png|\.php))\[\/img\]/";
if(preg_match($img_test,$text,$user))
{
    if(!getimagesize($user[1]))
        $text="";
}

$name = str_replace("---"," - - ",$name);
$name = strip_tags($name);//no naughty meta tags or stuff!
# the message is cut of after 500 letters
if (strlen($text) > 500) { $text = substr($text,0,500); }

# to allow for linebreaks a space is inserted every 50 letters
//$text = preg_replace("/([^\s]{50})/","$1 ",$text);


/*
# the name is shortened to 30 letters
if (strlen($name) > 30) {
    $name = substr($name, 0,30);
}
*/

require_once("conn.php");

# only if a name and a message have been provided the information is added to the db
if ($name != '' && $text != '' && $uid !='') {
    addData($name,$text,$uid); # adds new data to the database
    getID(2000); # some database maintenance
}

# adds new data to the database
function addData($name,$text,$uid)
{
    include("../include/settings.php");   # getting table prefix

    global $BASEURL, $btit_settings, $language;
    if(!isset($language["SYSTEM_USER"]))
        $language["SYSTEM_USER"]="System";

    session_name("Blu-torrents");
    session_start();
    $now = time();
    $conn = getDBConnection();

    $key="";
    $value="";

    if($btit_settings["fmhack_bonus_system"]=="enabled" && $btit_settings["sb_shout_enable"]=="true" && $btit_settings["bonus_make_a_shout"]>0)
    {
        mysql_query("UPDATE `{$TABLE_PREFIX}users` SET `seedbonus`=`seedbonus`+".$btit_settings["bonus_make_a_shout"]." WHERE `id`=".$uid,$conn);
        $_SESSION["CURUSER"]["seedbonus"]+=$btit_settings["bonus_make_a_shout"];
        $key.=",`sbonus`";
        $value.=",'".$btit_settings["bonus_make_a_shout"]."'";
    }
  //mods and above system message
  $check = mysql_query("SELECT g.admin_access from {$TABLE_PREFIX}users u LEFT JOIN {$TABLE_PREFIX}users_level g ON u.id_level=g.id where u.id=".$uid, $conn);
  $class=mysql_fetch_row($check);
  $system_pattern = '/(^\/sys)\s([\w\W\s]+)/is';
	if(preg_match($system_pattern,$text,$out) && $class[0]=="yes")
	{

	    $name="System";
		$uid = 0;
		$text = $out[2];

	}
    $sql = "INSERT INTO {$TABLE_PREFIX}chat (time,name,text,uid".$key.") VALUES ('".$now."','".$name."','".$text."','".$uid."'".$value.")";

    if($GLOBALS['charset']=="UTF-8" && function_exists('mysql_set_charset'))
	    mysql_set_charset('utf8',$conn);

    $results = mysql_query($sql, $conn);
    if (!$results || empty($results)) {
        # echo 'There was an error creating the entry';
        end;
    }
    else
    {
        if($btit_settings["fmhack_IMG_in_SB_after_x_shouts"]=="enabled")
        {
            $last_record=mysql_insert_id($conn);
            if($last_record % $btit_settings["don_chat"] == 0)
            {
                if($btit_settings["type_chat"]=="both")
                {
                    $both_array[0]="text";
                    $both_array[1]="image";
                    $rand=rand(0,1);
                    $btit_settings["type_chat"]=$both_array[$rand];
                }
                if($btit_settings["type_chat"]=="text")
                {
                     $i=1;
                     $text_array=array();
                     foreach (glob("../shouts/text/*.txt") as $filename)
                     {
                         $text_array[$i]["filename"]=$filename;
                         $i++;
                     }
                     $text_count=count($text_array);
                     if($text_count>=1)
                     {
                         if($text_count==1)
                             $rand=1;
                         else
                             $rand=rand(1,$text_count);

                         $filename = $text_array[$rand]["filename"];
                         $handle = fopen($filename, "r");
                         $contents = mysql_real_escape_string(fread($handle, filesize($filename)));
                         fclose($handle);
                     }
                     else
                         $contents = mysql_real_escape_string("Text based auto-shout not possible, no text files are present.");
                }
                elseif($btit_settings["type_chat"]=="image")
                {
                     $i=1;
                     $image_array=array();
                     foreach (glob("../shouts/images/{*.gif,*.GIF,*.jpg,*.JPG,*.jpeg,*.JPEG,*.png,*.PNG,*.bmp,*.BMP}",GLOB_BRACE) as $filename)
                     {
                         $image_array[$i]["filename"]=$filename;
                         $i++;
                     }
                     $image_count=count($image_array);
                     if($image_count>=1)
                     {
                         if($image_count==1)
                             $rand=1;
                         else
                             $rand=rand(1,$image_count);

                         $filename = $image_array[$rand]["filename"];
                         $contents = mysql_real_escape_string("[img]".$BASEURL."/".str_replace("../","",$filename)."[/img]");
                     }
                     else
                         $contents = mysql_real_escape_string("Image based auto-shout not possible, no image files are present.");
                }
                mysql_query("INSERT INTO {$TABLE_PREFIX}chat (time,name,text,uid) VALUES ('".$now."','".mysql_real_escape_string($language["SYSTEM_USER"])."','".$contents."',0)",$conn);
            }
        }
    }
}

# returns the id of a message at a certain position
function getID($position) {
  include("../include/settings.php");   # getting table prefix

    $sql =  "SELECT * FROM {$TABLE_PREFIX}chat ORDER BY id DESC LIMIT ".$position.",1";
    $conn = getDBConnection();
    $results = mysql_query($sql, $conn);
    if (!$results || empty($results)) {
        # echo 'There was an error creating the entry';
        end;
    }
    while ($row = mysql_fetch_array($results)) {
        $id = $row[0]; # the result is converted from the db setup (see conn.php)
    }
    if ($id) {
        deleteEntries($id); # deletes all message prior to a certain id
    }
}

# deletes all message prior to a certain id
function deleteEntries($id) {
  include("../include/settings.php");   # getting table prefix

    $sql =  "DELETE FROM {$TABLE_PREFIX}chat WHERE id < ".$id;
    $conn = getDBConnection();
    $results = mysql_query($sql, $conn);
    if (!$results || empty($results)) {
        # echo 'There was an error deletig the entries';
        end;
    }
}
exit; # exits the script
?>