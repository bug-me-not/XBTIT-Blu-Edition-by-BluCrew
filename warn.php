<?php
// first check for direct linking
if(!defined("IN_BTIT"))
    die('non direct access!');


// check if allowed and die if not
if($CURUSER['edit_users']=='no')
    stderr($language["ERROR"],$language['TR_UNAUTH']);

(isset($_GET["id"]) && is_numeric($_GET["id"]) && $_GET["id"]>1) ? $id=(int)0+$_GET["id"] : $id=1;
(isset($_GET["type"]) && ($_GET["type"]=="inc" || $_GET["type"]=="dec")) ? $type=$_GET["type"] : $type=false;
(isset($_POST["reason"]) && !empty($_POST["reason"])) ? $reason=$_POST["reason"] : $reason=false;
(isset($_POST["pm"]) && ($_POST["pm"]=="no" || $_POST["pm"]=="yes")) ? $pm=$_POST["pm"] : $pm=false;

if($id==1)
    stderr($language["ERROR"],$language["BAD_ID"]);
if($type===false)
    stderr($language["ERROR"],$language["WS_UNK_TYPE"]);
if($id==$CURUSER["uid"])
    stderr($language["ERROR"],$language['WS_CANT_WARN']);
if(!isset($language["SYSTEM_USER"]))
    $language["SYSTEM_USER"]="System";
$warntpl=new btemplate();
$warntpl->set("language",$language);
$warntpl->set("id",$id);
$warntpl->set("type",$type);
$warntpl->set("inc",(($type=="inc")?true:false),true);
$warntpl->set("testing", textbbcode("increment","reason"));

if($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")
    $cu=get_result("SELECT `username` FROM `{$TABLE_PREFIX}users` WHERE `id`=".$id, true, $btit_settings["cache_duration"]);

if(isset($_POST) && !empty($_POST))
{
    $res=do_sqlquery("SELECT `warn_lev`".(($btit_settings["fmhack_user_notes"]=="enabled" && $btit_settings["un_warn"]=="enabled")?", `user_notes`":"")." FROM `{$TABLE_PREFIX}users` WHERE `id`=".$id, true);
    $row=$res->fetch_assoc();

    if($reason===false)
        stderr($language["ERROR"],$language['WS_MUST_GIVE_REASON']);

    if($type=="inc")
    {
        if($row["warn_lev"]>=$btit_settings["warn_max"])
            stderr($language["ERROR"],$language["WS_CANT_INC"]);

        $stage4=$btit_settings["warn_max"];
        $stage3=round($btit_settings["warn_max"]*0.75);
        $stage2=round($btit_settings["warn_max"]*0.5);
        $stage1=round($btit_settings["warn_max"]*0.25);
        $stage0=0;

        $row["warn_lev"]+=1;

        if($row["warn_lev"] >= $stage4)
            $wl="[img]".$BASEURL."/images/warned/warn_max.png[/img] (".$row["warn_lev"]."/".$stage4.")";
        elseif($row["warn_lev"] >= $stage3)
            $wl="[img]".$BASEURL."/images/warned/warn_3.png[/img] (".$row["warn_lev"]."/".$stage4.")";
        elseif($row["warn_lev"] >= $stage2)
            $wl="[img]".$BASEURL."/images/warned/warn_2.png[/img] (".$row["warn_lev"]."/".$stage4.")";
        elseif($row["warn_lev"] >= $stage1)
            $wl="[img]".$BASEURL."/images/warned/warn_1.png[/img] (".$row["warn_lev"]."/".$stage4.")";
        else
            $wl="[img]".$BASEURL."/images/warned/warn_0.png[/img] (".$row["warn_lev"]."/".$stage4.")";

        quickQuery("INSERT INTO `{$TABLE_PREFIX}warn_logs` (`uid`, `notes`, `contact`, `date_added`, `type`, `added_by`) VALUES (".$id.", '".sql_esc($reason)."', '".(($pm=="yes")?"pm":"none")."', UNIX_TIMESTAMP(), 'inc', ".$CURUSER["uid"].")",true);
        quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `warn_lev`=`warn_lev`+1, `warn_last`=UNIX_TIMESTAMP() WHERE `id`=".$id);
        if($pm=="yes")
        {
            if(substr($FORUMLINK,0,3)=="smf" || $FORUMLINK=="ipb")
            {
                reset($smilies);
                while (list($code, $url) = each($smilies))
                    $reason = str_replace($code, "[img]".$BASEURL."/images/smilies/".$url."[/img]", $reason);

                reset($privatesmilies);
                while (list($code, $url) = each($privatesmilies))
                    $reason = str_replace($code, "[img]".$BASEURL."/images/smilies/".$url."[/img]", $reason);
            }
            send_pm($CURUSER["uid"],$id,sqlesc($language['WS_YHRAW']),sqlesc($language['WS_TRFW'].":\n\n"."[quote=".$CURUSER["username"]."]".$reason."[/quote]"."\n\n". $language["WS_YOUR_CUR_LEV"]."\n\n".$wl.(($btit_settings["warn_auto_down_enable"]=="yes")?"\n\n".$language["WS_DEC_IN_DAYS_1"]." ".$btit_settings["warn_auto_decrease"]." ".$language["WS_DEC_IN_DAYS_2"]:"")."\n\n".$language["WS_AUTO_MSG"]."\n"));
        }
        if($btit_settings["fmhack_user_notes"]=="enabled" && $btit_settings["un_warn"]=="enabled")
        {
            if(isset($row["user_notes"]) && !empty($row["user_notes"]))
                $usernotes=unserialize(unesc($row["user_notes"]));
            else
                $usernotes=array();

            $usernotes[]=base64_encode($language["UN_WLEV_INC"]."<+>0<+>".$language["SYSTEM_USER"]."<+>".time()); 
            $new_notes=serialize($usernotes); 
            quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `user_notes`='".sql_esc($new_notes)."' WHERE `id`=".$id, true);
        }
        redirect((($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$id."_".strtr($cu[0]["username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$id));
    }
    elseif($type=="dec")
    {
        if($row["warn_lev"]<=0)
            stderr($language["ERROR"],$language["WS_CANT_DEC"]);

        $stage4=$btit_settings["warn_max"];
        $stage3=round(($btit_settings["warn_max"]/3)*2);
        $stage2=round($btit_settings["warn_max"]/3);
        $stage1=1;
        $stage0=0;

        $row["warn_lev"]-=1;

        if($row["warn_lev"] >= $stage4)
            $wl="[img]".$BASEURL."/images/warned/warn_max.png[/img] (".$row["warn_lev"]."/".$stage4.")";
        elseif($row["warn_lev"] >= $stage3)
            $wl="[img]".$BASEURL."/images/warned/warn_3.png[/img] (".$row["warn_lev"]."/".$stage4.")";
        elseif($row["warn_lev"] >= $stage2)
            $wl="[img]".$BASEURL."/images/warned/warn_2.png[/img] (".$row["warn_lev"]."/".$stage4.")";
        elseif($row["warn_lev"] >= $stage1)
            $wl="[img]".$BASEURL."/images/warned/warn_1.png[/img] (".$row["warn_lev"]."/".$stage4.")";
        else
            $wl="[img]".$BASEURL."/images/warned/warn_0.png[/img] (".$row["warn_lev"]."/".$stage4.")";

        quickQuery("INSERT INTO `{$TABLE_PREFIX}warn_logs` (`uid`, `notes`, `contact`, `date_added`, `type`, `added_by`) VALUES (".$id.", '".sql_esc($reason)."', '".(($pm=="yes")?"pm":"none")."', UNIX_TIMESTAMP(), 'dec', ".$CURUSER["uid"].")",true);
        quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `warn_lev`=`warn_lev`-1, `warn_last`=".(($row["warn_lev"]>0)?"UNIX_TIMESTAMP()":"0")." WHERE `id`=".$id);
        if($pm=="yes")
        {
            if(substr($FORUMLINK,0,3)=="smf" || $FORUMLINK=="ipb")
            {
                reset($smilies);
                while (list($code, $url) = each($smilies))
                    $reason = str_replace($code, "[img]".$BASEURL."/images/smilies/".$url."[/img]", $reason);

                reset($privatesmilies);
                while (list($code, $url) = each($privatesmilies))
                    $reason = str_replace($code, "[img]".$BASEURL."/images/smilies/".$url."[/img]", $reason);
            }
            send_pm($CURUSER["uid"],$id,sqlesc($language['WS_WC_SUBJ']),sqlesc($language['WS_WC_MSG'].":\n\n"."[quote=".$CURUSER["username"]."]".$reason."[/quote]"."\n\n". $language["WS_YOUR_CUR_LEV"]."\n\n".$wl."\n\n".(($btit_settings["warn_auto_down_enable"]=="yes" && $row["warn_lev"]>0)?$language["WS_DEC_IN_DAYS_1"]." ".$btit_settings["warn_auto_decrease"]." ".$language["WS_DEC_IN_DAYS_2"]."\n\n":"").$language["WS_AUTO_MSG"]."\n"));
        }
        if($btit_settings["fmhack_user_notes"]=="enabled" && $btit_settings["un_warn"]=="enabled")
        {
            if(isset($row["user_notes"]) && !empty($row["user_notes"]))
                $usernotes=unserialize(unesc($row["user_notes"]));
            else
                $usernotes=array();

            $usernotes[]=base64_encode($language["UN_WLEV_DEC"]."<+>0<+>".$language["SYSTEM_USER"]."<+>".time()); 
            $new_notes=serialize($usernotes); 
            quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `user_notes`='".sql_esc($new_notes)."' WHERE `id`=".$id, true);
        }
        redirect((($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$id."_".strtr($cu[0]["username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$id));
    }
}

?>