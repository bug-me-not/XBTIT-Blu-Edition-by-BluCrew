<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  Btiteam
//
//    This file is part of xbtit.
//
//    Donation Historie Edit ACP by DiemThuy ( Juni 2009 )
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



$admintpl->set("language",$language);
$id=(int)$_GET['id'];
$action = $_GET['action'];
$returnto = "index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=don_hist";

if($action == 'update')
{
    $DT1	=	sql_esc($_POST['da']);
    $DT2	=	sql_esc($_POST['daa']);
    $DT3	=	sql_esc($_POST['db']);
    $DT4	=	sql_esc($_POST['dbb']);
    $DT5	=	sql_esc($_POST['dc']);
    $DT6	=	sql_esc($_POST['dcc']);
    $DT7	=	sql_esc($_POST['dd']);
    $DT8	=	sql_esc($_POST['ddd']);
    $DT9	=	sql_esc($_POST['de']);
    $DT10	=	sql_esc($_POST['dee']);
    $DT11	=	sql_esc($_POST['df']);
    $DT12	=	sql_esc($_POST['dff']);
    $DT13	=	sql_esc($_POST['dg']);
    $DT14	=	sql_esc($_POST['dgg']);
    $DT15	=	sql_esc($_POST['dh']);
    $DT16	=	sql_esc($_POST['dhh']);
    $DT17	=	sql_esc($_POST['di']);
    $DT18	=	sql_esc($_POST['dii']);
    $DT19	=	sql_esc($_POST['dj']);
    $DT20	=	sql_esc($_POST['djj']);

    quickQuery("UPDATE `{$TABLE_PREFIX}don_historie` SET `donate_date`='".$DT1."', `don_ation`='".$DT2."', `donate_date_1`='".$DT3."' , `don_ation_1`='".$DT4."', `donate_date_2`='".$DT5."' , `don_ation_2`='".$DT6."',  `donate_date_3`='".$DT7."' , `don_ation_3`='".$DT8."', `donate_date_4`='".$DT9."' , `don_ation_4`='".$DT10."', `donate_date_5`='".$DT11."' , `don_ation_5`='".$DT12."',  `donate_date_6`='".$DT13."' , `don_ation_6`='".$DT14."', `donate_date_7`='".$DT15."' , `don_ation_7`='".$DT16."',  `donate_date_8`='".$DT17."' , `don_ation_8`='".$DT18."', `donate_date_9`='".$DT19."' , `don_ation_9`='".$DT20."' WHERE `don_id`='$id'") or sqlerr();
    header("Location: $BASEURL/$returnto");
}
$r2=do_sqlquery("SELECT d.* , ul.prefixcolor, ul.suffixcolor , username , u.id FROM {$TABLE_PREFIX}users u INNER JOIN {$TABLE_PREFIX}don_historie d  ON u.id = d.don_id LEFT JOIN {$TABLE_PREFIX}users_level ul ON u.id_level=ul.id WHERE don_id=".$id);
$arr=$r2->fetch_assoc();

$namee=stripslashes($arr['prefixcolor']) . $arr['username'] . stripslashes($arr['suffixcolor']);

$admintpl->set("username",$namee);
$admintpl->set("a",$arr['donate_date']);
$admintpl->set("aa",$arr['don_ation']);
$admintpl->set("b",$arr['donate_date_1']);
$admintpl->set("bb",$arr['don_ation_1']);
$admintpl->set("c",$arr['donate_date_2']);
$admintpl->set("cc",$arr['don_ation_2']);
$admintpl->set("d",$arr['donate_date_3']);
$admintpl->set("dd",$arr['don_ation_3']);
$admintpl->set("e",$arr['donate_date_4']);
$admintpl->set("ee",$arr['don_ation_4']);
$admintpl->set("f",$arr['donate_date_5']);
$admintpl->set("ff",$arr['don_ation_5']);
$admintpl->set("g",$arr['donate_date_6']);
$admintpl->set("gg",$arr['don_ation_6']);
$admintpl->set("h",$arr['donate_date_7']);
$admintpl->set("hh",$arr['don_ation_7']);
$admintpl->set("i",$arr['donate_date_8']);
$admintpl->set("ii",$arr['don_ation_8']);
$admintpl->set("j",$arr['donate_date_9']);
$admintpl->set("jj",$arr['don_ation_9']);
$admintpl->set("frm_action", "index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=don_edit&amp;action=update&amp;id=".$id);

?>
