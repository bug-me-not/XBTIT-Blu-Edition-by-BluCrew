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

if (!defined("IN_BTIT"))
  die("non direct access!");

if (!defined("IN_ACP"))
  die("non direct access!");


if ($moderate_user)
{
    $admin_menu=array(
        0=>array(
            "title"=>$language["ACP_USERS_TOOLS"],
            "menu"=>array(0=>array(
                "url"=>"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=masspm&amp;action=write" ,
                "description"=>$language["ACP_MASSPM"]),
            1=>array(
                "url"=>"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=".(($btit_settings["fmhack_advanced_prune_users_and_torrents"]=="enabled")?"adv_":"")."pruneu" ,
                "description"=>$language["ACP_PRUNE_USERS"]),
            2=>array(
                "url"=>"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=searchdiff" ,
                "description"=>$language["ACP_SEARCH_DIFF"])
            )
            ),
        );

}
else
{
    $admin_menu=array(
        0=>array(
            "title"=>$language["ACP_TRACKER_SETTINGS"],
            "menu"=>array(0=>array(
                "url"=>"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=config&amp;action=read" ,
                "description"=>$language["ACP_TRACKER_SETTINGS"]),
            1=>array(
                "url"=>"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=banip&amp;action=read" ,
                "description"=>$language["ACP_BAN_IP"]),

            2=>array(
                "url"=>"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=language&amp;action=read" ,
                "description"=>$language["ACP_LANGUAGES"]),
            3=>array(
                "url"=>"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=style&amp;action=read" ,
                "description"=>$language["ACP_STYLES"]),
            4=>array(
                "url"=>"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=security_suite" ,
                "description"=>$language["ACP_SECSUI_SET"]),
            5=>array(
                "url"=>"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=php_log" ,
                "description"=>$language["LOGS_PHP"]),
            6=>array(
                "url"=>"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=integrity" ,
                "description"=>$language["INTEGRITY_SETUP"])
            )),
        1=>array(
            "title"=>$language["ACP_FRONTEND"],
            "menu"=>array(0=>array(
                "url"=>"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=category&amp;action=read" ,
                "description"=>$language["ACP_CATEGORIES"]),
            1=>array(
                "url"=>"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=poller&amp;action=read" ,
                "description"=>$language["ACP_POLLS"]),
            2=>array(
                "url"=>"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=badwords&amp;action=read" ,
                "description"=>$language["ACP_CENSORED"]),
            3=>array(
                "url"=>"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=blocks&amp;action=read" ,
                "description"=>$language["ACP_BLOCKS"])
            )
            ),
        2=>array(
            "title"=>$language["ACP_USERS_TOOLS"],
            "menu"=>array(0=>array(
                "url"=>"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=groups&amp;action=read" ,
                "description"=>$language["ACP_USER_GROUP"]),
            1=>array(
                "url"=>"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=masspm&amp;action=write" ,
                "description"=>$language["ACP_MASSPM"]),
            2=>array(
                "url"=>"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=".(($btit_settings["fmhack_advanced_prune_users_and_torrents"]=="enabled")?"adv_":"")."pruneu" ,
                "description"=>$language["ACP_PRUNE_USERS"]),
            3=>array(
                "url"=>"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=searchdiff" ,
                "description"=>$language["ACP_SEARCH_DIFF"]),
            4=>array(
                "url"=>"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=loglog" ,
                "description"=>$language["ACP_LOGLOG"]),
            5=>array(
                "url"=>"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=proxy" ,
                "description"=>$language["ACP_PROXY"]),
            6=>array(
                "url"=>"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=read_messages" ,
                "description"=>$language["ACP_MENU_SUPPORT"])
            )
            ),

        3=>array(
            "title"=>$language["ACP_TORRENTS_TOOLS"],
            "menu"=>array(0=>array(
                "url"=>"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=".(($btit_settings["fmhack_advanced_prune_users_and_torrents"]=="enabled")?"adv_":"")."prunet" ,
                "description"=>$language["ACP_PRUNE_TORRENTS"]),
            1=>array(
             "url"=>"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=flush",
             "description"=>$language['ACP_FLUSH']),
            2=>array(
                "url"=>"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=featured&amp;action=read" ,
                "description"=>$language["ACP_FEATURED"])
            )
            ),

        4=>array(
            "title"=>$language["ACP_FORUM"],
            "menu"=>array(0=>array(
                "url"=>"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=forum&amp;action=read" ,
                "description"=>$language["ACP_FORUM"])
            )
            ),

        5=>array(
            "title"=>$language["ACP_OTHER_TOOLS"],
            "menu"=>array(0=>array(
                "url"=>"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=dbutil" ,
                "description"=>$language["ACP_DBUTILS"]),
            1=>array(
                "url"=>"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=mysql_stats" ,
                "description"=>$language["ACP_MYSQL_STATS"]),
            2=>array(
                "url"=>"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=logview" ,
                "description"=>$language["ACP_SITE_LOG"]),
            3=>array(
               "url"=>"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=seedip" ,                    "description"=>$language["SEEDBOX_LOG"])
            )
            ),

        6=>array(
            "title"=>$language["ACP_MODULES"],
            "menu"=>array(0=>array(
                "url"=>"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=module_config&amp;action=manage" ,
                "description"=>$language["ACP_MODULES_CONFIG"])
            )
            ),

        7=>array(
            "title"=>$language["ACP_HACKS"],
            "menu"=>array(0=>array(
                "url"=>"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=hacks&amp;action=read" ,
                "description"=>$language["ACP_HACKS_CONFIG"])
            )
            ),
        8=>array(
            'title'=>$language['ACP_KHEZ'],
            'menu'=>array(0=>array(
              # ==KhezMenu==
                'url'=>'index.php?page=admin&amp;user='.$CURUSER['uid'].'&amp;code='.$CURUSER['random'].'&amp;do=kocs',
                'description'=>$language['ACP_KOCS']),
            1=>array(
                'url'=>'index.php?page=admin&amp;user='.$CURUSER['uid'].'&amp;code='.$CURUSER['random'].'&amp;do=kis',
                    'description'=>$language['ACP_KIS'])
            )
            )
        );
}

$i=0;

$admin_menu[9]["title"]=$language["ACP_FM_HACK_CONFIG"];
$alphabetize=array();
if($btit_settings["fmhack_invitation_system"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=invitations";
    $unsorted[$i]["description"]=$language["ACP_INVITATIONS"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_bonus_system"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=seedbonus";
    $unsorted[$i]["description"]=$language["ACP_SEEDBONUS"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
// Donation History by DiemThuy -->
if($btit_settings["fmhack_donation_history"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=don_hist";
    $unsorted[$i]["description"]=$language["ACP_DON_HIST"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=don_hist_set";
    $unsorted[$i]["description"]=$language["ACP_DON_HIST_SET"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
// <-- Donation History by DiemThuy
if($btit_settings["fmhack_advanced_auto_donation_system"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=donate";
    $unsorted[$i]["description"]=$language["ACP_DONATE"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_gold_and_silver_torrents"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=gold";
    $unsorted[$i]["description"]=$language["ACP_GOLD"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_free_leech_with_happy_hour"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=free";
    $unsorted[$i]["description"]=$language["ACP_FREECTRL"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_warning_system"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=warned_users";
    $unsorted[$i]["description"]=$language['WS_WARNED_USERS'];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=warn_settings";
    $unsorted[$i]["description"]=$language['WS_WARN_SETTINGS'];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
// Hit & Run -->
if($btit_settings["fmhack_anti_hit_and_run_system"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=hitrun";
    $unsorted[$i]["description"]=$language["ACP_HITRUN"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=hrb_conf";
    $unsorted[$i]["description"]=$language["HNR_BLOCK_SETTINGS"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
// <-- Hit & Run
// Autorank -->
if($btit_settings["fmhack_auto_rank"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=autorank";
    $unsorted[$i]["description"]=$language["ACP_AUTORANK"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
// <-- Autorank
if($btit_settings["fmhack_booted"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=booted_users";
    $unsorted[$i]["description"]=$language['ACP_BOOTED'];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_staffpanel"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=modpanel&amp;action=read";
    $unsorted[$i]["description"]=$language["ACP_MODPANEL"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_rules_with_groups"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=rules_cat";
    $unsorted[$i]["description"]=$language["ACP_RULES_GROUP"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=rules";
    $unsorted[$i]["description"]=$language["ACP_RULES"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_sticky_torrent"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=sticky";
    $unsorted[$i]["description"]=$language["ACP_STICKY_TORRENTS"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_extended_torrent_description"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=xtd";
    $unsorted[$i]["description"]=$language["XTD_ACP"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_lottery"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=lottery_settings";
    $unsorted[$i]["description"]=$language["ACP_LOTTERY"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_site_offline"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=offline";
    $unsorted[$i]["description"]=$language["ACP_OFFLINE"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_shoutcast_stats_and_DJ_application"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=radio_settings";
    $unsorted[$i]["description"]=$language["RAD_SETTINGS"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
    $unsorted[$i]["url"]="index.php?page=dj&do=list";
    $unsorted[$i]["description"]=$language["djhead"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_message_spy"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=ispy";
    $unsorted[$i]["description"]=$language["ACP_ISPY"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_add_new_users_in_adminCP"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=newuser";
    $unsorted[$i]["description"]=$language["ACP_ADD_USER"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_ban_button"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=banbutton&amp;action=read";
    $unsorted[$i]["description"]=$language["ACP_BB"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=banbutton_user&amp;action=read";
    $unsorted[$i]["description"]=$language["ACP_BB_USER"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=ban_button";
    $unsorted[$i]["description"]=$language["BB_SETTINGS"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_ratio_editor"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=ratio-editor";
    $unsorted[$i]["description"]=$language["ACP_RATIO_EDITOR"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_duplicate_accounts"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=duplicates";
    $unsorted[$i]["description"]=$language["DUPLICATES"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_torrent_moderation"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=warn";
    $unsorted[$i]["description"]=$language["ACP_ADD_WARN"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=tmod_set";
    $unsorted[$i]["description"]=$language["ACP_TMOD_SET"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_twitter_update"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=twitter";
    $unsorted[$i]["description"]=$language["TWIT_REG"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_teams"]=="enabled")
{
    require_once(load_language("lang_teams.php"));
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=teams";
    $unsorted[$i]["description"]=$language["TEAMS_TS"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=team_users";
    $unsorted[$i]["description"]=$language["TEAMS_TU"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_xbtit_->_SMF_style_bridge"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=style_bridge";
    $unsorted[$i]["description"]=$language["STYLE_BRIDGE"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_signup_bonus_upload"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=signup_bonus";
    $unsorted[$i]["description"]=$language["SIGNUP_BONUS"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_torrent_image_upload"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=image_upload";
    $unsorted[$i]["description"]=$language["IMAGE_SETTING"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_show_if_seedbox_is_used"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=sb_use";
    $unsorted[$i]["description"]=$language["SB_SS_SETTINGS"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_LED_ticker"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=ticker_conf";
    $unsorted[$i]["description"]=$language["TICKER_CONF"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_circling_last_torrents"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=imageflow_settings";
    $unsorted[$i]["description"]=$language["FLOW_SET"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_low_ratio_ban_system"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=lrb";
    $unsorted[$i]["description"]=$language["ACP_LRB"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_detect_and_blacklist_proxy"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=proxy";
    $unsorted[$i]["description"]=$language["ACP_PROXY"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=blacklist";
    $unsorted[$i]["description"]=$language["ACP_BLACKLIST"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_faq_with_groups"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=faq_group";
    $unsorted[$i]["description"]=$language["ACP_FAQ_GROUP"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=faq_question";
    $unsorted[$i]["description"]=$language["ACP_FAQ_QUESTION"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_gifts"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=gifts";
    $unsorted[$i]["description"]=$language["ACP_GIFTS"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_staff_control"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=staff_control";
    $unsorted[$i]["description"]=$language["ACP_STAFF_CONTROL"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_birthdays"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=birthday";
    $unsorted[$i]["description"]=$language["ACP_BIRTHDAY"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_download_prefix_or_suffix"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=dlpresuf";
    $unsorted[$i]["description"]=$language["ACP_DPS_SETTINGS"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_uploader_rights"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=ulrights";
    $unsorted[$i]["description"]=$language["ACP_UPL_RIGHTS"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_pager_type_select"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=pgtype";
    $unsorted[$i]["description"]=$language["ACP_PG_SETT"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_ban_cheapmail_domains"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=block_cheapmail";
    $unsorted[$i]["description"]=$language["BAN_CHEAPMAIL"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_uploader_control"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=uploader_control";
    $unsorted[$i]["description"]=$language["UP_CONTROL"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_avatar_upload"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=avatar_upload";
    $unsorted[$i]["description"]=$language["AVATAR_UPLOAD_SET"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_torrent_request_and_vote"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=requests";
    $unsorted[$i]["description"]=$language["TRAV_REQ_SET"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_download_ratio_checker"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=dlcheck";
    $unsorted[$i]["description"]=$language["SETTING_CUSTOM_SETTINGS"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_sport_betting"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=sport_bet";
    $unsorted[$i]["description"]=$language["SB_SETTINGS"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_high_UL_speed_report"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=rep_high_ul";
    $unsorted[$i]["description"]=$language["RHUS_HIGH_UL_SUP"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_uploader_medals"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=up_med";
    $unsorted[$i]["description"]=$language["UM_UPLOADER_MED"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_IMG_in_SB_after_x_shouts"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=img_in_shout";
    $unsorted[$i]["description"]=$language["IMGSB_SETTINGS"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_user_notes"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=user_notes";
    $unsorted[$i]["description"]=$language["UN_SETTINGS"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_registration_open_randomly"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=random_reg";
    $unsorted[$i]["description"]=$language["RREG_SETTINGS"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_forum_auto_topic"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=smf_select";
    $unsorted[$i]["description"]=$language["ACP_CATFORUM_SELECT"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_offer_to_re-encode"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=reencode";
    $unsorted[$i]["description"]=$language["ACP_REENC_SET"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_shoutbox_member_and_torrent_announce"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=shout_announce";
    $unsorted[$i]["description"]=$language["ACP_SHOUTANN_SET"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_SEO_panel"]=="enabled")
{
 require(load_language("lang_seo.php"));
 $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=seo";
 $unsorted[$i]["description"]=$language["ACP_SEO"];
 $alphabetize[$i]=$unsorted[$i]["description"];
 $i++;
}
if($btit_settings["fmhack_staff_comment_in_torrent_details"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=scommdet";
    $unsorted[$i]["description"]=$language["ACP_STCOMM_SET"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_recommended_torrents"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=recommend";
    $unsorted[$i]["description"]=$language["ACP_RECOMMEND_SET"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_user_images"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=user_images";
    $unsorted[$i]["description"]=$language["ACP_UIMG_SET"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_CBT_(Coolys_Backup_Tools)"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=backup";
    $unsorted[$i]["description"]=$language["ACP_BUFILES"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=dbbackup";
    $unsorted[$i]["description"]=$language["ACP_BUDB"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_user_watch_list"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=watched_users";
    $unsorted[$i]["description"]=$language['WatchL'];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_balloons_on_mouseover"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=balloons";
    $unsorted[$i]["description"]=$language['ACP_BALL_SET'];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_online_timeout"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=online";
    $unsorted[$i]["description"]=$language['ACP_ONLINE_SET'];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_show_or_hide_porn"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=showporn";
    $unsorted[$i]["description"]=$language["ACP_SHOWPORN_SET"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_user_signup_agreement"]=="enabled")
{
    require_once(load_language("lang_agree.php"));
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=admin_agree";
    $unsorted[$i]["description"]=$language["ACP_USER_SIGNUP_AGREEMENT"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_archive_torrents"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=archive";
    $unsorted[$i]["description"]=$language["ACP_ARCHIVE_SET"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_ads_system"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=ads_setup";
    $unsorted[$i]["description"]=$language["ADS_CONF"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_welcome_pm"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=welcome_msg";
    $unsorted[$i]["description"]=$language["SETUP_MSG2"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_freeleech_slots"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=fls";
    $unsorted[$i]["description"]=$language["FLS_ACP_ADMIN"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_torrent_of_the_week"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=tow";
    $unsorted[$i]["description"]=$language["ACP_TOW_SETTINGS"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_comment_captcha"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=comment_captcha";
    $unsorted[$i]["description"]=$language["CAPTCHA_CONFIG"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_protected_usernames"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=protuser";
    $unsorted[$i]["description"]=$language["ACP_PROTUSER_SETTINGS"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_poll_from_integrated_forum"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=intforumpoll";
    $unsorted[$i]["description"]=$language["ACP_INTFORUMPOLL_SETTINGS"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_torrent_activity_colouring"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=toractcou";
    $unsorted[$i]["description"]=$language["ACP_TAC_SETTINGS"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_grab_images_from_theTVDB"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=tvdb";
    $unsorted[$i]["description"]=$language["ACP_TVDB_SETTINGS"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_ask_for_reseed"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=reseed";
    $unsorted[$i]["description"]=$language["ACP_RESEED_SETTINGS"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_download_requires_introduction"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=introb4down";
    $unsorted[$i]["description"]=$language["IBD_SETTINGS"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_only_allow_specified_email_domains"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=specmail";
    $unsorted[$i]["description"]=$language["OASED_SETTINGS"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_no_columns_display"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=nocoldisp";
    $unsorted[$i]["description"]=$language["NOCOL_SETTINGS"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_block_signup_from_certain_countries"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=csignup";
    $unsorted[$i]["description"]=$language["CSIGN_SETTINGS"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_custom_smileys"]=="enabled")
{
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=smilies";
    $unsorted[$i]["description"]=$language["SMILE_MENU"];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_hide_style"]=="enabled")
{
    require_once(load_language("lang_style_lang.php"));
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=hide_style";
    $unsorted[$i]["description"]=$language['ACP_HIDE_STYLES'];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_hide_language"]=="enabled")
{
    require_once(load_language("lang_style_lang.php"));
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=hide_language";
    $unsorted[$i]["description"]=$language['ACP_HIDE_LANGUAGES'];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if($btit_settings["fmhack_apply_for_membership"]=="enabled")
{
    require_once(load_language("lang_apply_membership.php"));
    $unsorted[$i]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=apply_membership";
    $unsorted[$i]["description"]=$language['ACP_APPLY_MEMBERSHIP_SET'];
    $alphabetize[$i]=$unsorted[$i]["description"];
    $i++;
}
if(isset($alphabetize) && !empty($alphabetize))
{
    asort($alphabetize);
    $i=0;
    foreach($alphabetize as $key => $value)
    {
        $admin_menu[9]["menu"][$i]["url"]=$unsorted[$key]["url"];
        $admin_menu[9]["menu"][$i]["description"]=$unsorted[$key]["description"];
        $i++;
    }
}
if(!is_array($admin_menu[9]["menu"]))
{
    $admin_menu[9]["menu"][0]["url"]="index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=hacks&amp;action=read";
    $admin_menu[9]["menu"][0]["description"]=$language["ACP_NO_HACKS_ENABLED"];
}

if($btit_settings["fmhack_staffpanel"]=="enabled")
{
    // --------> modpanel
    if ($CURUSER['id_level']<8)
    {
        $admin_menu=array(array('title'=>$CURUSER['level'].' Menu')); //reset array
        $menu_array=get_result("SELECT description, link FROM {$TABLE_PREFIX}adminpanel WHERE id_level=".$CURUSER['id']." AND access='1'");
        foreach ($menu_array as $id=>$mar)
        {
            if (array_key_exists($mar['description'],$language))
                $link_desc=$language[$mar['description']];
            else
                $link_desc=unesc($mar['description']);
            $admin_menu[0]['menu'][]=array('url'=>str_replace(array('{uid}','{ucode}'),array($CURUSER['uid'],$CURUSER['random']),$mar['link']),'description'=>$link_desc);
        }
    }
    // --------> modpanel
}

?>
