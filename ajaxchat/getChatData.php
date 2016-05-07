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
    
  require_once("format_shout.php");
  require_once("../include/functions.php");

# Headers are sent to prevent browsers from caching.. IE is still resistent sometimes
header( "Expires: Mon, 26 Jul 1997 05:00:00 GMT" ); 
header( "Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" ); 
header( "Cache-Control: no-cache, must-revalidate" ); 
header( "Pragma: no-cache" );
header("Content-Type: text/html; charset=UTF-8");

# if no id of the last known message id is set to 0
if (!$lastID) { $lastID = 0; }

# call to retrieve all messages with an id greater than $lastID
getData($lastID);

# function that do retrieve all messages with an id greater than $lastID
function getData($lastID) {
  require_once("conn.php"); # getting connection data
  include_once("../include/settings.php");   # getting table prefix
  include_once("../include/offset.php");

global $CURUSER, $btit_settings, $TABLE_PREFIX, $dbhost, $dbuser, $dbpass, $database;

if(!isset($CURUSER) || !is_array($CURUSER))
{
    session_name("BluRG");
    session_start();
    $CURUSER=$_SESSION["CURUSER"];
}
if ($CURUSER["view_users"]!="yes") {
die("Sorry, Shoutbox is not available...");
}
    // Warn System / Donor Display / Booted / Group Colours Overall -->
    $query1_select="";
    $query1_join="";
    $query1_and="";
    if($btit_settings["fmhack_simple_donor_display"]=="enabled" || $btit_settings["fmhack_warning_system"]=="enabled" || $btit_settings["fmhack_booted"]=="enabled" || $btit_settings["fmhack_group_colours_overall"]=="enabled" || $btit_settings["fmhack_shoutbox_banned"]=="enabled")
        $query1_join.="LEFT JOIN `{$TABLE_PREFIX}users` `u` ON `c`.`uid`=`u`.`id` ";
    if($btit_settings["fmhack_simple_donor_display"]=="enabled")
        $query1_select.="`u`.`donor`,";
    if($btit_settings["fmhack_warning_system"]=="enabled")
        $query1_select.="`u`.`warn`,";
    if($btit_settings["fmhack_booted"]=="enabled")
        $query1_select.="`u`.`booted`,";	
    if($btit_settings["fmhack_group_colours_overall"]=="enabled")
    {
        $query1_join.="LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level`=`ul`.`id` ";
        $query1_select.="`ul`.`prefixcolor`, `ul`.`suffixcolor`,";
    }
    if($btit_settings["fmhack_shoutbox_banned"]=="enabled")
        $query1_select.="`u`.`sbox`,";
    if($btit_settings["fmhack_private_shouts"]=="enabled")
        $query1_and.="AND `private`='no' OR (".$CURUSER['uid']." = `toid` OR ".$CURUSER['uid']."= `fromid` AND `private`='yes') ";

    $sql =  "SELECT ".$query1_select." `c`.* FROM `{$TABLE_PREFIX}chat` `c` ".$query1_join." WHERE `c`.`id` > ".$lastID." ".$query1_and." ORDER BY `c`.`id` DESC LIMIT 10";
    $conn = getDBConnection(); # establishes the connection to the database

    if($btit_settings["fmhack_SEO_panel"]=="enabled")
    {
        $active_seo = mysql_query("SELECT `activated_user`, `str`, `strto` FROM `{$TABLE_PREFIX}seo` WHERE `id`='1'", $conn);
        $res_seo=mysql_fetch_assoc($active_seo);
    }

    $results = mysql_query($sql, $conn);
    
    # getting the data array
    while ($row = mysql_fetch_array($results)) {
    
    # getting the data array
        $id   = $row["id"];
        $uid  = $row["uid"];
        $time = $row["time"];
        $name =(($btit_settings["fmhack_group_colours_overall"]=="enabled")?stripslashes($row["prefixcolor"].$row["name"].$row["suffixcolor"]):$row["name"]) .
                   (($btit_settings["fmhack_simple_donor_display"]=="enabled")?get_user_icons($row):"") .
                   (($btit_settings["fmhack_warning_system"]=="enabled")?warn($row):"") .
                   (($btit_settings["fmhack_booted"]=="enabled")?booted($row):"");
        $text = htmlspecialchars_decode($row["text"]);


// <-- Warn System / Donor Display / Booted / Group Colours Overall

        if($btit_settings["fmhack_shoutbox_banned"]!="enabled")
            $row["sbox"] = "no";

        if($row["sbox"]=="no" || $uid=="0"){//make sure system can still post


        if($btit_settings["fmhack_private_shouts"]=="enabled" && $uid!=$CURUSER["uid"])
        {
            $name=$name."&nbsp;<a href=\"javascript:PopPshout('".$CURUSER["uid"]."','".$uid."','".$CURUSER["pchat"]."');\"><b>[pm]</b></a>";
		    if($row["private"]=="yes")
            {
                $name = "<b><span style='color:orangered;'>[PM]</span></b>&nbsp;".$name."&nbsp;<a href=\"javascript:PopPshout('".$CURUSER["uid"]."','".$uid."','".$CURUSER["pchat"]."');\"><b>[reply]</b></a>";
            }
        }
        
        # if no name is present somehow, $name and $text are set to the strings under
        # we assume all must be ok, othervise no post will be made by javascript check
        # if ($name == '') { $name = 'Anonymous'; $text = 'No message'; }

      
      # we put together our chat using some css     
      $chatout = "
                 <li><span class='name'>".date("d/m/Y H:i:s", $time - $offset)." | <a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$uid."_".strtr($row["name"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$uid)."'>".$name."</a>:</span></li>
                            <div class='lista' style='text-align:right;
                                      margin-top:-13px;
                                    margin-bottom:0px;
                                   /* color: #006699;*/
                          '>
                          # $id</div>
 
                 <!-- # chat output -->
                 <div class='chatoutput'>".format_shout($text)."</div>
                 ";

         echo $chatout; # echo as known handles arrays very fast...

    }
}
}//end if shoutbox

?>