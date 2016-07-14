<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">User Info</h4>
</div>           

<?php
/////////////////////////////////////////////////////////////////////////////////////
// 
//  User Info Block by BluCrew
//
////////////////////////////////////////////////////////////////////////////////////

global $CURUSER, $user, $USERLANG, $FORUMLINK, $db_prefix, $btit_settings, $ipb_prefix;

require_once(load_language("lang_account.php"));

block_begin("".BLOCK_USER."");

if (!$CURUSER || $CURUSER["id"]==1)
    {
// guest-anonymous, login require
        ?>
        <form action="index.php?page=login" name="login" method="post">
            <table class="lista" border="0" align="center" width="100%">
                <tr><td style="text-align:center;" align="center" class="poller"><?php echo $language["USER_NAME"]?>:</td></tr><tr><td class="poller" style="text-align:center;" align="center"><input type="text" size="9" name="uid" value="<?php $user ?>" maxlength="40" /></td></tr>
                <tr><td style="text-align:center;" align="center" class="poller"><?php echo $language["USER_PWD"]?>:</td></tr><tr><td class="poller" style="text-align:center;" align="center"><input type="password" size="9" name="pwd" maxlength="40" /></td></tr>
                <tr><td colspan="2" class="poller" style="text-align:center;" align="center"><input type="submit" value="<?php echo $language["FRM_LOGIN"]?>" /></td></tr>
                <tr><td class="lista" style="text-align:center;" align="center"><a class="user" href="index.php?page=signup"><?php echo $language["ACCOUNT_CREATE"]?></a></td></tr><tr><td class="lista" style="text-align:center;" align="center"><a class="user" href="index.php?page=recover"><?php echo $language["RECOVER_PWD"]?></a></td></tr>
            </table>
        </form>
        <?php
    }
    else
    {

// user information
     $style=style_list();
     $langue=language_list();

     $my_img_list="";
     if($btit_settings["fmhack_user_images"]=="enabled")
     {
         $selected_images=explode(",", $CURUSER["user_images"]);
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

     print("\n<form name=\"jump\" method=\"post\" action=\"index.php\">\n<table class=\"poller\" width=\"100%\" cellspacing=\"0\">\n<tr><td align=\"center\">".$language["USER_NAME"].":  " .unesc((($btit_settings["fmhack_group_colours_overall"]=="enabled")?$CURUSER["prefixcolor"].$CURUSER["username"].$CURUSER["suffixcolor"]:$CURUSER["username"]).(($btit_settings["fmhack_simple_donor_display"]=="enabled")?get_user_icons($CURUSER):"").(($btit_settings["fmhack_warning_system"]=="enabled")?warn($CURUSER):""))."</td></tr>\n");
     print("<tr><td align=\"center\">".$language["USER_LEVEL"].": ".(($btit_settings["fmhack_group_colours_overall"]=="enabled")?unesc($CURUSER["prefixcolor"].$CURUSER["level"].$CURUSER["suffixcolor"]):$CURUSER["level"]).$my_img_list.(($btit_settings["fmhack_account_parked"]=="enabled" && $CURUSER["parked"]=="yes")?" ".$language["PARK_PARKED"]:"")."</td></tr>\n");

     if($btit_settings["fmhack_uploader_medals"]=="enabled")
     {
// user information END
      

// DT Uploader Medals
        if ($CURUSER["up_med"] >= $btit_settings["UPB"])
            $up_med="<tr><td align=\"center\"><center>".$language["UM_UPL_MED"].": <img src='images/goblet/medaille_bronze.gif' alt='".$language["UM_BRONZE"]."' title='".$language["UM_BRONZE"]."' /></center></tr></td>";
        if ($CURUSER["up_med"] >= $btit_settings["UPS"])
            $up_med="<tr><td align=\"center\"><center>".$language["UM_UPL_MED"].": <img src='images/goblet/medaille_argent.gif' alt='".$language["UM_SILVER"]."' title='".$language["UM_SILVER"]."' /></center></tr></td>";
        if ($CURUSER["up_med"] >= $btit_settings["UPG"])
            $up_med="<tr><td align=\"center\"><center>".$language["UM_UPL_MED"].": <img src='images/goblet/medaille_or.gif' alt='".$language["UM_GOLD"]."' title='".$language["UM_GOLD"]."' /></center></tr></td>";

        print($up_med);
    }
// DT Uploader Medals END


//Avatar
    if ($CURUSER["avatar"] && $CURUSER["avatar"]!="")
        print("\n<tr><td align=center class=poller><center><img  width=150 max-height=250 border=0 src=".unesc($CURUSER["avatar"])." /></center></td></tr>\n");
    else
        print("\n<tr><td align=center class=poller><center><img width=150 max-height=250 border=0 src=\"$STYLEURL/images/default_avatar.gif\"></center></td></tr>\n");
//Avatar END


//Warnings
    if($btit_settings["fmhack_warning_system"]=="enabled")
    {
        $stage4=$btit_settings["warn_max"];
        $stage3=round($btit_settings["warn_max"]*0.75);
        $stage2=round($btit_settings["warn_max"]*0.5);
        $stage1=round($btit_settings["warn_max"]*0.25);
        $stage0=0;

        print("<tr><td><p class='text-danger' align='center'>Warning Level:</p></tr></td><br />");

        if($CURUSER["warn_lev"] >= $stage4)
            $wl="<a class='user' href='index.php?page=warnlog&id=".$CURUSER["uid"]."'><img src='images/warned/warn_max.png' alt='".$CURUSER["warn_lev"]."/".$stage4."' title='".$CURUSER["warn_lev"]."/".$stage4."' /></a>";
        elseif($CURUSER["warn_lev"] >= $stage3)
            $wl="<a class='user' href='index.php?page=warnlog&id=".$CURUSER["uid"]."'><img src='images/warned/warn_3.png' alt='".$CURUSER["warn_lev"]."/".$stage4."' title='".$CURUSER["warn_lev"]."/".$stage4."' /></a>";
        elseif($CURUSER["warn_lev"] >= $stage2)
            $wl="<a class='user' href='index.php?page=warnlog&id=".$CURUSER["uid"]."'><img src='images/warned/warn_2.png' alt='".$CURUSER["warn_lev"]."/".$stage4."' title='".$CURUSER["warn_lev"]."/".$stage4."' /></a>";
        elseif($CURUSER["warn_lev"] >= $stage1)
            $wl="<a class='user' href='index.php?page=warnlog&id=".$CURUSER["uid"]."'><img src='images/warned/warn_1.png' alt='".$CURUSER["warn_lev"]."/".$stage4."' title='".$CURUSER["warn_lev"]."/".$stage4."' /></a>";
        else
            $wl="<img src='images/warned/warn_0.png' alt='".$CURUSER["warn_lev"]."/".$stage4."' title='".$CURUSER["warn_lev"]."/".$stage4."' />";

        print("<tr><td align='center'>$wl</td>");
    }
//Warnings END


//Mail
    if(substr($FORUMLINK,0,3)=="smf")
     $resmail=get_result("SELECT `unread".(($FORUMLINK=="smf")?"M":"_m")."essages` `ur` FROM `{$db_prefix}members` WHERE ".(($FORUMLINK=="smf")?"`ID_MEMBER`":"`id_member`")."=".$CURUSER["smf_fid"],true,$btit_settings['cache_duration']);
 elseif($FORUMLINK=="ipb")
     $resmail=get_result("SELECT `msg_count_new` `ur` FROM `{$ipb_prefix}members` WHERE `member_id`=".$CURUSER["ipb_fid"],true,$btit_settings['cache_duration']);
 else
     $resmail=get_result("SELECT COUNT(*) `ur` FROM `{$TABLE_PREFIX}messages` WHERE `readed`='no' AND `receiver`=".$CURUSER["uid"],true,$btit_settings['cache_duration']);
 if ($resmail && count($resmail)>0)
 {
     $mail=$resmail[0];
     if ($mail['ur']>0)
        print("<tr><td align=\"center\"><a class= \"btn btn-xs btn-danger\" href=\"".($FORUMLINK=="smf"?"index.php?page=forum&action=pm":"index.php?page=usercp&amp;uid=".$CURUSER["uid"]."&amp;do=pm&amp;action=list")."\">".$language["MAILBOX"]." (<font color=\"#FFFFFF\"><b>".$mail['ur']."</b></font>)</a></td></tr>\n");
    else
     print("<tr><td align=\"center\"><a class=\"btn btn-xs btn-green\" href=\"".($FORUMLINK=="smf"?"index.php?page=forum&action=pm":"index.php?page=usercp&amp;uid=".$CURUSER["uid"]."&amp;do=pm&amp;action=list")."\">".$language["MAILBOX"]."</a></td></tr>\n");
}
else
 print("<tr><td align=\"center\">".$language["NO_MAIL"]."</td></tr>");
//Mail END


//Invites
global $kisfig;
if (!isset($kisfig)) {
$kisfig=get_khez_config("SELECT `key`,`value` FROM `{$TABLE_PREFIX}khez_configs` WHERE `key` LIKE 'kis_%' LIMIT 7;",$reload_cfg_interval);
require load_language('lang_kis.php');
require 'include/kis.php';
}
if ($kisfig['kis_enabled']) {
$rem=kisUserInfo($CURUSER['uid']);
$rem=$rem['invites'];
} else $rem='-';
echo '<td style="text-align:center;" align="center"><a class="btn btn-xs btn-info" href="index.php?page=usercp&amp;uid='.$CURUSER['uid'].'&amp;do=kis&amp;ktab=invite&amp;action=read">'.sprintf($language['KIS_BAR'], $rem).'</a></td>'."\n";
//Invites END


//Seedbonus
print("<tr><td align=\"center\"><a class=\"btn btn-xs btn-warning\" href=index.php?page=modules&module=seedbonus>BON:<img src=\"images/bonus.png\">".($CURUSER['seedbonus']>0?number_format($CURUSER['seedbonus'],2):"---")."</tr></a></td>\n");
//Seedbonus END


//FL Slots
if($btit_settings["fmhack_freeleech_slots"] == "enabled")
{
  print("<tr><td align=\"center\"><button class='btn btn-xs btn-primary' type='button'>".$language["FLS_SLOTS"].": ".$CURUSER["freeleech_slots"]."</div></button></td>\n");
}
//FL SLots END


// H&R Count
if($btit_settings["fmhack_anti_hit_and_run_system"]=="enabled")
{
  $hnr=get_result("SELECT COUNT(*) `count` FROM ".(($XBTT_USE)?"`xbt_files_users`":"`{$TABLE_PREFIX}history`")." WHERE `hit`='yes' AND `uid`=".$CURUSER["uid"], true, $btit_settings["cache_duration"]);
}

if($btit_settings["fmhack_anti_hit_and_run_system"]=="enabled")
{
  print("<tr><td align=\"center\"><button class='btn btn-xs btn-danger' type='button'>".$language["HNR_ABBREVIATION"].": ".$hnr[0]["count"]."</div></button></td>\n");
}
//H&R Count END


//User Options
print("\n<tr><td align=\"center\"><a class= \"btn btn-xs btn-default\" href=\"index.php?page=userdetails&id=".$CURUSER["uid"]."\">My Profile</a></td></tr>\n");
print("\n<tr><td align=\"center\"><a class=\"btn btn-xs btn-default\" href=\"index.php?page=usercp&amp;uid=".$CURUSER["uid"]."\">User CP</a></td></tr>\n");
if ($CURUSER["admin_access"]=="yes")
    print("\n<tr><td align=\"center\"><a class=\"btn btn-xs btn-default\" href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."\">".$language["MNU_ADMINCP"]."</a></td></tr>\n");
//User Option END


// gift
$xmasdayst= mktime(0,0,0,11,30,date("Y"));
$xmasdayend= mktime(0,0,0,1,5,date("Y")+1);
$today = time();

if ($CURUSER["gotgift"] == "no" && ($today >= $xmasdayst) && ($today <= $xmasdayend))
{
   print("<td class='lista' style='text-align:center;;' align='center'><a href='index.php?page=gift&open=1'><img src='images/gift.gif' alt='Xmas Gift' title='Xmas Gift' /></a></td>");
}
// gift END

print("</table>\n</form>");
}

//Static Mail
/*print("<div class='mail'><b>You Have <font color=\"#FF0000\"><a href=\"".($FORUMLINK=="smf"?"index.php?page=forum&action=pm":"index.php?page=usercp&amp;uid=".$CURUSER["uid"]."&amp;do=pm&amp;action=list")."\">(".$mail['ur'].")</a></font> New Message(s)!</b>
</div></a>");*/
//Static Mail End

block_end();
?>
<div class="panel-footer">
</div>
</div>
