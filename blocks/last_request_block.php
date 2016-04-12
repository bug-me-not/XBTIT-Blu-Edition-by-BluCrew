
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
block_begin("Latest Requests");

global $btit_settings ;
require_once load_language("lang_requests.php");
require_once dirname(__FILE__)."/../include/offset.php";
$number = 5;//$btit_settings["req_number"];

$res = get_result("SELECT `cat`.`id` as `catid`, `cat`.`image` as `catimg`, `cat`.`name` as `catname`, `req`.`reqname` , UNIX_TIMESTAMP(`req`.`dateadded`) as `dateadded` , `req`.`requester` , (SELECT count(distinct `reqbou`.`addedby`) FROM `{$TABLE_PREFIX}requests_bounty` `reqbou` WHERE `reqbou`.`req_id`=`req`.`id`)as `total_voters` , `u`.`username` , `ul`.`suffixcolor` , `ul`.`prefixcolor` FROM `{$TABLE_PREFIX}requests` `req` LEFT JOIN `{$TABLE_PREFIX}users` `u` ON `req`.`requester`=`u`.`id` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `ul`.`id`=`u`.`id_level` LEFT JOIN `{$TABLE_PREFIX}categories` `cat` ON `cat`.`id`=`req`.`category` ORDER BY `dateadded` DESC, `req`.`id` DESC LIMIT {$number}");

if(count($res)>0)
{
  $content = '';

  $content .= "<div class='panel panel-primary'><div class='panel-heading'><h4 class='text-center'>{$language['TRAV_REC_REQ']}</h4></div>";
  $content .= "<table class='table table-bordered'>";
  $content .= "<tr><td>{$language['CATEGORY_FULL']}</td><td>{$language['TRAV_REQ_NAME']}</td><td>{$language['TRAV_REQ_BY']}</td><td>{$language['TRAV_DATE_REQ']}</td><td>{$language['TRAV_VOTERS']}</td></tr>";

foreach($res as $data)
{
  $catlink = "index.php?page=torrents&category={$data['catid']}";
  $catimg = image_or_link(($data['catimg']==""?"":"{$STYLEPATH}/images/categories/".$data['catimg']),"",$data['catname']);

  $requser = $data['prefixcolor'].$data['username'].$data['suffixcolor'];
  $reqdate = date("d/m/Y H:i:s",$data['dateadded']-$offset);

  $content .= "<tr>
  <td><a href='{$catlink}'>{$catimg}</a></td>
  <td>{$data['reqname']}</td>
  <td>{$requser}</td>
  <td>{$reqdate}</td>
  <td>{$data['total_voters']}</td>
  </tr>";
}

$content .="<table></div></div><div class='panel-footer'>
</div>";
echo $content;
}
else
{
  echo "<div class='nothing'>{$language['TRAV_NOWTFOUND']}</div>";
}

block_end();
?>
