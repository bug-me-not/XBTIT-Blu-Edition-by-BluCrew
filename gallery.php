<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2007  Btiteam
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
global $CURUSER, $TABLE_PREFIX, $btit_settings,$BASEURL;

$THIS_BASEPATH=dirname(__FILE__);
$USERLANG = $THIS_BASEPATH."/language/english";

require_once('include/functions.php');
if(!$CURUSER || $CURUSER['uid']==1)
{
   redirect($BASEURL);
}
require_once('btemplate/bTemplate.php');
dbconn(true);
include($THIS_BASEPATH.'/index.begin.php');
require($USERLANG."/gallery_lang.php");

if(gallery_in())
{
   $mod = $CURUSER["edit_torrents"]=="yes";

   if($mod && isset($_GET["delete"]))
   {
      $delete = (int)$_GET["delete"];

      if (is_valid_id($delete))
      {
         $r = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}gallery WHERE id=$delete",true);
         if (sql_num_rows($r) == 1)
         {
            $a = $r->fetch_assoc();

            quickQuery("DELETE FROM {$TABLE_PREFIX}gallery WHERE id=$delete");

            if (!unlink("gallery/{$a['name']}"))
            redirect("gallery.php",sprintf($language['gallery19']));

         }
      }
   }

   $gallerytpl = new bTemplate();

   $res = do_sqlquery("SELECT count(*) FROM {$TABLE_PREFIX}gallery",true);
   $row = $res->fetch_array();
   $count = $row[0];
   $perpage = 10;
   list($pagertop, $pagerbottom, $limit) = pager($perpage, $count, $_SERVER["PHP_SELF"] . "?out=" . $_GET["out"] . "&" );

   $res = do_sqlquery("SELECT added, id, owner, name FROM {$TABLE_PREFIX}gallery ORDER BY added DESC $limit",true);

   if(sql_num_rows($res) == 0)
   {
      $gallerytpl->set("no_data",true,true);
      $gallerytpl->set("has_data",false,true);
   }
   else
   {
      $gallerytpl->set("no_data",false,true);
      $gallerytpl->set("has_data",true,true);
      $images = array();

      while($arr=$res->fetch_assoc())
      {
         $r2 = do_sqlquery("SELECT username FROM {$TABLE_PREFIX}users WHERE id={$arr['owner']}",true);
         $a2 = $r2->fetch_assoc();
         $date = substr($arr['added'], 0, strpos($arr['added'], " "));
         $time = substr($arr['added'], strpos($arr['added'], " ") + 1);
         $name = $arr["name"];
         $url = str_replace(" ", "%20", htmlspecialchars($btit_settings["gallery_pth"]."/$name"));

         $images['date']=$date;
         $images['time']=$time;
         $images['owner_id']=$arr['owner'];
         $images['owner']=$a2['username'];
         $images['url']=$url;
         $images['name']=$name;
         $images['image_id']=$arr['id'];
      }
      $gallerytpl->set("images",$images);
   }

   $gallerytpl->set("sitename",$SITENAME);
   $gallerytpl->set("baseurl",$BASEURL);
   $gallerytpl->set("imagedir",($BASEURL."/gallery"));
   $gallerytpl->set("charset",$charset);
   $gallerytpl->set("request_uri",htmlentities(urlencode($_SERVER['REQUEST_URI'])));
   $gallerytpl->set("bonus",((int)$CURUSER['seedbonus']));
   $gallerytpl->set("username",$CURUSER['username']);
   $gallerytpl->set("userid",((int)$CURUSER['uid']));
   $gallerytpl->set("userip",(htmlspecialchars($_SERVER['REMOTE_ADDR'])));
   $gallerytpl->set("language",$language);
   $gallerytpl->set("pagertop",$pagertop);
   $gallerytpl->set("pagerbottom",$pagerbottom);

   echo $gallerytpl->fetch(load_template("gallery.tpl"));
}else{
   ext_err_msg($language["OOPS"],$language["GRP"]);
   //redirecturl($BASEURL);
}
include($THIS_BASEPATH.'/index.end.php');
?>
