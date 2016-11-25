<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">Online</h4>
</div>
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

global $CURUSER, $btit_settings, $language, $res_seo;
if (!$CURUSER || $CURUSER["view_users"]=="no")
   {
    // do nothing
   }
else
    {

    // DT Uploader Medals
        if($btit_settings["fmhack_uploader_medals"]=="enabled")
     {
        if ($CURUSER["up_med"] >= $btit_settings["UPB"])
            $up_med="<i class=\"fa fa-trophy\" aria-hidden=\"true\" title=\"BRONZE MEDAL\" /></i>";
        if ($CURUSER["up_med"] >= $btit_settings["UPS"])
            $up_med="<i class=\"fa fa-trophy\" aria-hidden=\"true\" title=\"SILVER MEDAL\" /></i>";
        if ($CURUSER["up_med"] >= $btit_settings["UPG"])
            $up_med="<i class=\"fa fa-trophy\" aria-hidden=\"true\" title=\"GOLD MEDAL\" /></i>";
    }
    // DT Uploader Medals END

    //block_begin("Online Users");
     print("\n<table class=\"lista\" width=\"100%\">\n");

     $u_online=array();
     $group=array();

     $query1_exclude="";
     if($btit_settings["fmhack_hide_online_status"]=="enabled")
     {
        $u_hidden=get_result("SELECT COUNT(*) `hidden` FROM `{$TABLE_PREFIX}online` WHERE `invisible`='yes'",true,$btit_settings["cache_duration"]);
        $total_invisible=$u_hidden[0]["hidden"];
        if($CURUSER["see_hidden"]!="yes" && $total_invisible>0)
        {
            $query1_exclude.=" WHERE (`ol`.`invisible`='no' OR `ol`.`user_id`=".$CURUSER["uid"].")";
        }
     }
     $u_online=get_result("SELECT `ol`.*,`ul`.`logical_rank_order` FROM `{$TABLE_PREFIX}online` `ol` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `ul`.`level`=`ol`.`user_group`".$query1_exclude." ORDER BY `ul`.`logical_rank_order` ASC",true,$btit_settings['cache_duration']);

     $total_online=count($u_online);
     $uo=array();
     foreach($u_online as $id=>$users_online)
        {
            if (isset($group[unesc(ucfirst((($btit_settings["fmhack_group_colours_overall"]=="enabled")?unesc($users_online["prefixcolor"].$users_online["user_group"].$users_online["suffixcolor"]):$users_online["user_group"])))]))
            {
               if($btit_settings["fmhack_hide_online_status"]=="enabled")
               {
                   if($users_online["invisible"]!="yes")
                       $group[unesc(ucfirst((($btit_settings["fmhack_group_colours_overall"]=="enabled")?unesc($users_online["prefixcolor"].$users_online["user_group"].$users_online["suffixcolor"]):$users_online["user_group"])))]++;
               }
               else
                   $group[unesc(ucfirst((($btit_settings["fmhack_group_colours_overall"]=="enabled")?unesc($users_online["prefixcolor"].$users_online["user_group"].$users_online["suffixcolor"]):$users_online["user_group"])))]++;
            }
            else
            {
               if($btit_settings["fmhack_hide_online_status"]=="enabled")
               {
                   if($users_online["invisible"]!="yes")
                       $group[unesc(ucfirst((($btit_settings["fmhack_group_colours_overall"]=="enabled")?unesc($users_online["prefixcolor"].$users_online["user_group"].$users_online["suffixcolor"]):$users_online["user_group"])))]=1;
               }
               else
                   $group[unesc(ucfirst((($btit_settings["fmhack_group_colours_overall"]=="enabled")?unesc($users_online["prefixcolor"].$users_online["user_group"].$users_online["suffixcolor"]):$users_online["user_group"])))]=1;
            }
            if ($users_online["user_id"]>1)
            {
                $my_img_list="";
                if($btit_settings["fmhack_user_images"]=="enabled")
                {
                    $selected_images=explode(",", $users_online["user_images"]);
                    $j=1;
                    $image_count=0;

                    foreach($btit_settings as $key => $value)
                    {
                        if(substr($key,0,9)=="user_img_")
                        {
                            $value_split=explode("[+]", $value);
                            if(in_array($j, $selected_images))
                            {
                                $image_count++;
                                $my_img_list.="&nbsp;<img src='images/user_images/".$value_split[0]."' alt='".$value_split[1]."' title='".$value_split[1]."' />";
                            }
                            $j++;
                        }
                    }
                }
                $uo[]="<a class=\"online\" href=\""."index.php?page=userdetails&id=".$users_online["user_id"]."\" title=\"".unesc(ucfirst($users_online["location"]))."\">".unesc($users_online["prefixcolor"].$users_online["user_name"].$users_online["suffixcolor"]).(($btit_settings["fmhack_simple_donor_display"]=="enabled")?get_user_icons($users_online):"").$up_med.(($btit_settings["fmhack_booted"]=="enabled")?booted($users_online):"").(($btit_settings["fmhack_warning_system"]=="enabled")?warn($users_online):"").$my_img_list.(($btit_settings["fmhack_hide_online_status"]=="enabled" && $users_online["invisible"]=="yes")?"<i class=\"fa fa-user-secret\" aria-hidden=\"true\" title=\"Online Status Hidden\"></i></a>":"");
            }
     }

print("<tr><td colspan=\"2\" class=\"blocklist\">".$language["ACTIVATED"].": ".implode(", ",$uo)."</td>\n</tr>\n");
print("<table><tr><td align=\"left\">&nbsp;<i class=\"fa fa-user\" aria-hidden=\"true\"></i><b>&nbsp;  (Total Users Online Now: <font color ='red'>".$total_online."</font>)</b></td>");
print("<td align=\"center\">&nbsp;<i class=\"fa fa-user\" aria-hidden=\"true\"></i><b>&nbsp;  (Unique Visits Today: <font color ='red'>Coming Soon</font>)</b></td></tr></table>");
     block_end();
} // end if user can view

?>
<div class="panel-footer">
</div>
</div>