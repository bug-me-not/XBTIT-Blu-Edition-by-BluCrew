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

  define("DELETE_CONFIRM", "If you are really sure you want to delete this click OK, othervise Cancel!");
  $language["ERR_MODERATE_SHOUT"]="You are not authorised to moderate this shout!";

global $CURUSER, $btit_settings;

  # avoid Undefined variable: lastID, seems to be never set...
  $lastID=0;

    if (isset($_GET["delete"]))
        $delete = $_GET["delete"]; # getting the delete header

    if (isset($_GET["edit"]))
        $edit = $_GET["edit"]; # getting the edit header

    if (isset($_GET["sid"])) {
        $sid = intval($_GET["sid"]); # getting shout id (sid)

    $post = $_POST["shoutid"]; # setting shout id
        $post = str_replace("'","\'",$post); # our textarea string replacement for preview

    }
    else
        $post="";

  function shoutError() {
    global $language;
    print "<script type='text/javascript'>
    alert('$language[ERR_MODERATE_SHOUT]')</script>";
    exit;

  }

if($btit_settings["fmhack_custom_smileys"]=="enabled")
{
 function smile() {

    global $TABLE_PREFIX;
    $list=get_result("SELECT `key`,`value` FROM {$TABLE_PREFIX}smilies",true);

    foreach($list as $code=>$url)
    {
        print("\n<a href=\"javascript: SmileIT('".str_replace("'","\'",$url['key'])."')\">
               <img border=\"0\" src=\"images/smilies/".$url['value']."\" alt=\"".$url['key']."\" /></a>");

        $count++;
    }
 }
}else{
 function smile() {

  global $smilies;
  reset($smilies);

    # getting smilies
    while (list($code, $url) = each($smilies)) {
        print("\n<a href=\"javascript: SmileIT('".str_replace("'","\'",$code)."')\">
               <img border=\"0\" src=\"images/smilies/$url\" alt=\"$code\" /></a>");

        $count++;
    }

 }
}



if (isset($_POST["confirm"]) && $_POST["confirm"]==$language["FRM_CANCEL"]) {

      header("Location: index.php?page=allshout");
}


  global $CURUSER;

      require_once("ajaxchat/conn.php"); # getting connection data
      $conn = his_getDBConnection(); # establishes the connection to the database

      include_once("include/settings.php");  # getting table prefix

      if($btit_settings["fmhack_SEO_panel"]=="enabled")
      {
          $active_seo = mysql_query("SELECT `activated_user`, `str`, `strto` FROM `{$TABLE_PREFIX}seo` WHERE `id`='1'", $conn);
          $res_seo=mysql_fetch_assoc($active_seo);
      }

  # deleting the shout
  if (isset($delete)) {

      $array=array();
      $res=mysql_query("SELECT * FROM `{$TABLE_PREFIX}settings` WHERE `key` IN('fmhack_bonus_system','sb_shout_enable')",$conn);
      while($row=mysql_fetch_assoc($res))
          $array[$row["key"]]=$row["value"];

      session_start();
      $key="";

      if($array["fmhack_bonus_system"]=="enabled" && $array["sb_shout_enable"]=="true")
          $key=",sbonus";

      $query = "SELECT uid".$key." FROM {$TABLE_PREFIX}chat WHERE id = $sid";
      $res = mysql_query($query, $conn);
      $row = mysql_fetch_array($res);

        # check for valid moderation
        if ($CURUSER["admin_access"]!="yes" && $CURUSER["uid"]!="".$row[uid]."") {
        shoutError();

        }

        # actual delete
        else {
        $sql ="DELETE FROM {$TABLE_PREFIX}chat WHERE id = $sid";
        $results = mysql_query($sql, $conn);

        if($array["fmhack_bonus_system"]=="enabled" && $array["sb_shout_enable"]=="true" && $row["sbonus"]>0)
        {
            mysql_query("UPDATE `{$TABLE_PREFIX}users` SET `seedbonus`=`seedbonus`-".$row["sbonus"]." WHERE `id`=".$row["uid"],$conn);
            $_SESSION["CURUSER"]["seedbonus"]-=$row["sbonus"];
        }

        }
    }

# some bb stuff and badwords...
require_once("ajaxchat/format_shout.php");

# Headers are sent to prevent browsers from caching.. IE is still resistent sometimes
header( "Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
header( "Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" );
header( "Cache-Control: no-cache, must-revalidate" );
header( "Pragma: no-cache" );
header("Content-Type: text/html; charset=UTF-8");


  if (isset($edit)) {

  print "<script type='text/javascript' language='javascript' src='ajaxchat/functions.js' ></script>";

 ?>
  <script type="text/javascript">

  // inserts smilies into form
  function SmileIT(smile) {
    document.forms['shout'].elements['shoutid'].value = document.forms['shout'].elements['shoutid'].value+" "+smile+" ";  //this non standard attribute prevents firefox' autofill function to clash with this script
    document.forms['shout'].elements['shoutid'].focus();
  }
  </script>

 <?php


      $query = "SELECT * FROM {$TABLE_PREFIX}chat WHERE id = $sid";
      $res = mysql_query($query, $conn);
      $row = mysql_fetch_array($res);

        # check for valid moderation
        if ($CURUSER["admin_access"]!="yes" && $CURUSER["uid"]!="".$row[uid]."") {
        shoutError();

        }

        # actual edit widgets
        else {
        print "<span class='name'>".date("d/m/Y H:i:s", $row["time"] - $offset)." | <a href=javascript:windowunder('".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$row["uid"]."_".strtr($row["name"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$row["uid"])."')>".$row["name"]."</a>:</span>";

                              print "
                            <div style='text-align:right;
                                  margin-top:-13px;
                                  margin-bottom:-3.5px;
                                  '>
                                  <a onclick=\"return confirm('". str_replace("'","\'",DELETE_CONFIRM)."')\" href='index.php?page=allshout&amp;sid=$sid&amp;delete'>
                                <img border='0' class='DeleteSwap' src='images/canvas.gif' alt='' /></a>

                            </div>";

                              print "
                            <div style='text-align:right;
                                  margin-top:-15px;
                                  margin-bottom:2px;
                                  padding-right:22px;
                                  '>
                                # $row[id]
                            </div>";


            if (isset($_POST["confirm"]) && $_POST["confirm"]==$language["FRM_PREVIEW"]) {

            $post = str_replace("\'","'",$post);

            print "<div class='chatoutput'>".format_shout($post)."</div>";

            $text = $post;

            }

            else {

            print "<div class='chatoutput'>".format_shout($row[text])."</div>";

            $text = $row[text];

            }



            $edit_text = "
            <form enctype='multipart/form-data' name='shout' method='post' action='index.php?page=allshout&amp;sid=$sid&amp;edit'>

            <textarea style='width:99%; style='overflow: auto;' rows='2' name='shoutid'>".htmlspecialchars(unesc($text))."</textarea>
                          <div style='text-align:right;
                                  margin-top:5px;
                                  margin-bottom:9px;'>
                      <input type='submit' name='confirm' value='$language[FRM_CONFIRM]' />
                      <input type='submit' name='confirm' value='$language[FRM_PREVIEW]' />
                      <input type='submit' name='confirm' value='$language[FRM_CANCEL]' />

            &nbsp;
            <a href='#smile' onclick=javascript:servOC('20','',''); Hide('Hide'); id='name20'>
            <img src='images/smile.gif' border='0' class='form' title='$language[MORE_SMILES]' align='top' alt='' /></a>

            ";


 if (isset($_POST["confirm"]) && $_POST["confirm"]==$language["FRM_CONFIRM"]) {

#################################################
         $post = str_replace("[/IMG]","[/img]",$post);
		$img_test = "/\[img\]((http)+(s)?:\/\/[^\s'\"<>]+(\.gif|\.jpg|\.png))\[\/img\]/";
if(preg_match($img_test,$post,$user))
{
if(!getimagesize($user[1]))
$post="Image not correct! possible hack attempt! [b]".$_SERVER["REMOTE_ADDR"]."[/b]";
}
  $sql = "UPDATE {$TABLE_PREFIX}chat SET text = '".$post."' WHERE id = '".$sid."'";
    $conn = his_getDBConnection();
    $results = mysql_query($sql, $conn);

    if (!$results || empty($results)) {
         # echo 'There was an error creating the entry';
        end;
    }

         redirect("index.php?page=allshout");

      ############################################################
}


        print  "<div align='center'>$edit_text</div>";
 ?>
    <div id='ihtr20' align='center' style='border:1px solid #CECECE; display:none; margin-top:5px;

    overflow: auto; /* this makes our div to have scrolls */
    '>

  <div id='ihif20' width='100%'>

  <?php smile(); ?>

  </div>
    </div>
      </div>
        </form>
  <hr>

   <?php

        }
  }

# getting the style wc3
global $tpl;
/*$tpl->set("more_css","<link href='<? echo $STYLEURL ?>/main.css' rel='stylesheet' type='text/css' />");*/

# if no id of the last known message id is set to 0
if (!$lastID) { $lastID = 0; } # we treat 0 (zero) as null point, sorry...

# call to retrieve all messages with an id greater than $lastID which is NOT zero
getData($lastID);

# function that do retrieve all messages with a set id
function getData($lastID) {

  include_once("include/settings.php");  # getting table prefix
  include_once("include/offset.php");

  # discard it if we are editing
  $sid = isset($_GET["sid"])?$_GET["sid"]:0; # get shout id (sid)and set it to zero for bool

    // Warn System / Donor Display / Booted / Group Colours Overall -->
    global $CURUSER, $btit_settings, $TABLE_PREFIX, $dbhost, $dbuser, $dbpass, $database, $res_seo;
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

    $sql =  "SELECT ".$query1_select." c.* FROM {$TABLE_PREFIX}chat c ".$query1_join." WHERE (".$CURUSER['uid']." = toid OR ".$CURUSER['uid']."= fromid AND private='yes') ORDER BY id DESC";
    $conn = his_getDBConnection(); # establishes the connection to the database
    $results = mysql_query($sql, $conn);

    # getting the data array
    while ($row = mysql_fetch_array($results)) {

    # creating and naming array
        $id   = $row["id"];
        $uid  = $row["uid"];
        $time = $row["time"];
        $name =(($btit_settings["fmhack_group_colours_overall"]=="enabled")?stripslashes($row["prefixcolor"].$row["name"].$row["suffixcolor"]):$row["name"]) .
                   (($btit_settings["fmhack_simple_donor_display"]=="enabled")?get_user_icons($row):"") .
                   (($btit_settings["fmhack_warning_system"]=="enabled")?warn($row):"") .
                   (($btit_settings["fmhack_booted"]=="enabled")?booted($row):"");
        // <-- Warn System / Donor Display / Booted / Group Colours Overall
        $text = htmlspecialchars_decode($row["text"]);

        if($btit_settings["fmhack_shoutbox_banned"]!="enabled")
            $row["sbox"] = "no";

        if($row["sbox"]=="no" || $uid=="0"){//make sure system can still post


        # if no name is present somehow, $name and $text are set to the strings under
        # we assume all must be ok, othervise no post will be made by javascript check
        # if ($name == '') { $name = 'Anonymous'; $text = 'No message'; }





      # we lego put together our chat using some conditions and css and javascript this time

      print "<span class='name'>".date("d/m/Y H:i:s", $time - $offset)." | <a href=\"javascript:windowunder('".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$uid."_".strtr($row["name"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$uid)."')\">".$name."</a>:</span>";

          global $CURUSER;

        if ($CURUSER["admin_access"]!="yes" && $CURUSER["uid"]!="".$uid."") {}

        else {
               # edit/delete buttons -->
                 print "<div style='text-align:right;
                             margin-top:-13px;
                             margin-bottom:-3.5px;
                             '>
                      <a href='index.php?page=allPshout&amp;sid=$id&amp;edit'><img border='0' class='EditSwap' src='images/canvas.gif' alt='' /></a>
                      <a onclick=\"return confirm('". str_replace("'","\'",DELETE_CONFIRM)."')\" href='index.php?page=allPshout&amp;sid=$id&amp;delete'>
                      <img border='0' class='DeleteSwap' src='images/canvas.gif' alt='' /></a>
                 </div>";

               }

                 # chat output -->
                 print "<div class='chatoutput'>".format_shout($text)."</div>";
        }
    }
}

?>
  <script type="text/javascript">

  // closes popup and displays details in parent window
  function windowunder(link) {
    window.opener.document.location=link;
    window.close();
  }
  </script>
<br />
<div align="center"><a href="javascript: window.close();"><?php echo $language["CLOSE"] ?></a></div>