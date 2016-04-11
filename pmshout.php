<?php
//pm refresh in shout v3 cooly
require_once"include/functions.php";
dbconn();

global $CURUSER, $FORUMLINK, $BASEURL;

if(isset($CURUSER) && $CURUSER["uid"]>1)
{
    if(substr($FORUMLINK,0,3)=="smf")
        $resmail=get_result("SELECT `unread".(($FORUMLINK=="smf")?"M":"_m")."essages` `ur` FROM `{$db_prefix}members` WHERE ".(($FORUMLINK=="smf")?"`ID_MEMBER`":"`id_member`")."=".$CURUSER["smf_fid"],true,$btit_settings['cache_duration']);
    elseif($FORUMLINK=="ipb")
        $resmail=get_result("SELECT `msg_count_new` `ur` FROM `{$ipb_prefix}members` WHERE `member_id`=".$CURUSER["ipb_fid"],true,$btit_settings['cache_duration']);
    else
        $resmail=get_result("SELECT COUNT(*) `ur` FROM `{$TABLE_PREFIX}messages` WHERE `readed`='no' AND `receiver`=".$CURUSER["uid"],true,$btit_settings['cache_duration']);


       if ($FORUMLINK=="" || $FORUMLINK=="internal" || substr($FORUMLINK,0,3)=="smf" || $FORUMLINK=="ipb")
       {
       if($btit_settings["fmhack_integrated_forum_display"]=="enabled" && (substr($FORUMLINK,0,3)=="smf" || $FORUMLINK=="ipb"))
       {
           if($btit_settings["forum_viewtype"]!="iframe")
           {
			switch($FORUMLINK)
			{
			case 'smf2':
			case 'smf':
			$href='href="'.$BASEURL.'/smf/index.php?action=pm" target="'.$btit_settings["forum_viewtype"].'"';
			break;
			case 'ipb':
			$href='href="'.$BASEURL.'/ipb/index.php?app=members&module=messaging" target="'.$btit_settings["forum_viewtype"].'"';
			break;
		     }
            }
           else
               $href="href='".($FORUMLINK=="smf"?"index.php?page=forum&action=pm":"index.php?page=usercp&amp;uid=".$CURUSER["uid"]."&amp;do=pm&amp;action=list")."'";
       }
       else
           $href="href='".($FORUMLINK=="smf"?"index.php?page=forum&action=pm":"index.php?page=usercp&amp;uid=".$CURUSER["uid"]."&amp;do=pm&amp;action=list")."'";
      }

    if ($resmail && count($resmail)>0)
    {
        $mail=$resmail[0];
        if ($mail['ur']>0)
            $pm="<a ".$href."><img border=\"0\" src=\"".$BASEURL."/images/pm.gif\" title=\"New Messages\"></a>";
        else
            $pm="";
    }
    else
        $pm="";

    if($pm!="")
        echo $pm;
}

?>