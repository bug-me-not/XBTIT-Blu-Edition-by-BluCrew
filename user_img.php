<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  Btiteam
//
//    User Images Hack by DiemThuy June 2010 - sponsored and made free by Verifire
//    Complete rewrite for xbtitFM by Petr1fied May 2011.
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

$user_images=array();
$selected_images=explode(",", $CURUSER["user_images"]);
$i=1;
$image_count=0;
$my_img_list="";

foreach($btit_settings as $key => $value)
{
    if(substr($key,0,9)=="user_img_")
    {
        $value_split=explode("[+]", $value);
        $user_images[$i]["img"]="<img src='images/user_images/".$value_split[0]."' alt='".$value_split[1]."' title='".$value_split[1]."' />";
        $user_images[$i]["desc"]=$value_split[1];
        if(in_array($i, $selected_images))
        {
            $image_count++;
            $my_img_list.="&nbsp;<img src='images/user_images/".$value_split[0]."' alt='".$value_split[1]."' title='".$value_split[1]."' />";
        }
        $i++;
    }
}

$user_imgtpl = new bTemplate();
$user_imgtpl->set("language", $language);
$user_imgtpl->set("user", unesc($CURUSER["prefixcolor"].$CURUSER["username"].$CURUSER["suffixcolor"]));
$user_imgtpl->set("userimages", $my_img_list);
$user_imgtpl->set("have_image", (($image_count>0)?true:false), true);
$user_imgtpl->set("image_list", $user_images);

?>