<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2014  Btiteam
//
//    This file is part of xbtit DT FM.
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
block_begin("Top Bountied Requests");

global $btit_settings ;
require_once load_language("lang_requests.php");
require_once dirname(__FILE__)."/../include/offset.php";
$number = $btit_settings["req_limit"];

$res = get_result("SELECT `cat`.`id` as `catid`, `cat`.`image` as `catimg`, `cat`.`name` as `catname`, `req`.`id`,`req`.`reqname` , UNIX_TIMESTAMP(`req`.`dateadded`) as `dateadded` , `req`.`requester` , (SELECT sum(`reqbou`.`seedbonus`) FROM `{$TABLE_PREFIX}requests_bounty` `reqbou` WHERE `reqbou`.`req_id`=`req`.`id`)as `bounty` , `req`.`uploadedby`,`req`.`infohash`, `u`.`username` , `ul`.`suffixcolor` , `ul`.`prefixcolor` FROM `{$TABLE_PREFIX}requests` `req` LEFT JOIN `{$TABLE_PREFIX}users` `u` ON `req`.`requester`=`u`.`id` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `ul`.`id`=`u`.`id_level` LEFT JOIN `{$TABLE_PREFIX}categories` `cat` ON `cat`.`id`=`req`.`category` ORDER BY `bounty` DESC, `req`.`id` DESC LIMIT {$number}");

if(count($res)>0)
{

  print("<div class='panel panel-primary'><div class='panel-heading'><h4 class='text-center'><a class='accordion-toggle' data-toggle='collapse' data-parent='#accordion' href='#collapse22'>{$language['TRAV_BOU_REQ']}</a></h4></div>\n");
  print("<div id='collapse22' class='panel-collapse collapse in'>");
  print("<table class='table table-bordered'>\n");
  print("<tr><td>{$language['CATEGORY_FULL']}</td><td>{$language['TRAV_REQ_NAME']}</td><td>{$language['TRAV_REQ_BY']}</td><td>{$language['TRAV_DATE_REQ']}</td><td>{$language['TRAV_BON']}</td><td>{$language['TRAV_FILL']}</td></tr>\n");

  foreach($res as $data)
  {
    $catlink = "index.php?page=torrents&category={$data['catid']}";
    $catimg = image_or_link(($data['catimg']==""?"":"{$STYLEPATH}/images/categories/".$data['catimg']),"",$data['catname']);

    if (strlen($data['reqname'])>45)
    {
      $extension = "...";
      $data['reqname'] = substr($data['reqname'], 0, 40)."$extension";
    }

    $reqname = ($CURUSER['view_users']=="yes")?"<a href='index.php?page=requests&action=viewreq&id={$data['id']}' title=\"{$language['TRAV_REQ_BY']}: {$data['username']}\">{$data['reqname']}</a>":"User";

    $requser = "<a href='index.php?page=userdetails&id={$data['requester']}'>".$data['prefixcolor'].$data['username'].$data['suffixcolor']."</a>";
    $reqdate = date("d/m/Y H:i:s",$data['dateadded']-$offset);

    $reqlink = ($CURUSER['view_torrents']=='yes')?"<a href='index.php?page=torrent-details&id={$data['infohash']}'>{$language['PAR_LINK']}</a>":$language['NOT_AVAILABLE'];
    $reqfill = ($data['uploadedby']>1)? "<font color=green>{$language['YES']}</font><br />{$reqlink}":"<font color=red>{$language['NO']}</font>";

    print("<tr><td><a href='{$catlink}'>{$catimg}</a></td><td>{$reqname}</td><td>{$requser}</td><td>{$reqdate}</td><td>".number_format($data['bounty'])."</td><td>{$reqfill}</td></tr>\n");
  }

  print("</table></div><div class='panel-footer'></div></div>\n");

  if($CURUSER['view_torrents'] == 'no')
  {
    echo $language["TRAV_NOADD1"]." is ".$language['TRAV_NOTALLOWED'];
  }
  elseif($btit_settings['req_onoff'] != 'true')
  {
    echo $language["TRAV_REQ_OFF"];
  }
  else
  {
    echo $content; 
  }
}
else
{
  echo "<div class='nothing'>{$language['TRAV_NOWTFOUND']}</div>";
}

block_end();
?>
