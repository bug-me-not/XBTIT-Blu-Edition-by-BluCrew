<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse10">Forums</a>
</h4>
</div>
<div id="collapse10" class="panel-collapse collapse in">
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

global $CURUSER, $FORUMLINK, $THIS_BASEPATH, $db_prefix, $block_forumlimit, $btit_settings, $TABLE_PREFIX, $language, $ipb_prefix, $res_seo;
if(!isset($language["SYSTEM_USER"]))
    $language["SYSTEM_USER"]="System";
# return empty block if can't view
if (!$CURUSER || $CURUSER['view_forum']=='no')
    return;

# init based on forum type
if (substr($FORUMLINK,0,3)=='smf') {
    $topicsTable=$db_prefix.'topics';
    $postsTable=$db_prefix.'messages';
}
elseif ($FORUMLINK=='ipb') {
    $topicsTable=$ipb_prefix.'topics';
    $postsTable=$ipb_prefix.'posts';
}
else {
    $topicsTable=$TABLE_PREFIX.'topics';
    $postsTable=$TABLE_PREFIX.'posts';
}
# init topics, posts, and average
$row=get_result("SELECT (SELECT COUNT(*) FROM `".$topicsTable."`) AS `tc`, (SELECT COUNT(*) FROM `".$postsTable."`) AS `pc`",true,$btit_settings['cache_duration']);
$topics=$row[0]['tc'];
$posts=$row[0]['pc'];
$postsAvg=($posts==0)?0:number_format(($topics/$posts)*100,0);
$realLastPosts=$btit_settings['forumblocktype']; # 0=topics, 1=posts

# check number of topics
if ($topics!=0) {
    # inits
    $limit='LIMIT '.((isset($block_forumlimit))?$block_forumlimit:5).';';
    $postsList='';
    # test forum type
    if (substr($FORUMLINK,0,3)=='smf')
    {
        $boards=get_result("SELECT ".(($FORUMLINK=="smf")?"`ID_BOARD`, `memberGroups`":"`id_board`, `member_groups`")." FROM `{$db_prefix}boards`",true,$btit_settings['cache_duration']);
        $exclude=($realLastPosts)?"":(($FORUMLINK=="smf")?"WHERE `t`.`ID_LAST_MSG`=`m`.`ID_MSG`":"WHERE `t`.`id_last_msg`=`m`.`id_msg`");
        foreach ($boards as $check)
        {
            $forumid=(($FORUMLINK=="smf")?$check["ID_BOARD"]:$check["id_board"]);
            $read=explode(',',(($FORUMLINK=="smf")?$check["memberGroups"]:$check["member_groups"]));
            if (!in_array((($CURUSER["smf_group_mirror"]>0)?$CURUSER["smf_group_mirror"]:$CURUSER['id_level']+10), $read))
                $exclude.=(($exclude=='')?"WHERE ":" AND ")."`m`.".(($FORUMLINK=="smf")?"`ID_BOARD`":"`id_board`")."!=".$forumid;
        }
        $query2_select="";
        $query2_join="";

        if($btit_settings["fmhack_group_colours_overall"]=="enabled" || $btit_settings["fmhack_simple_donor_display"]=="enabled")
        {
            if($btit_settings["fmhack_simple_donor_display"]=="enabled")
            {
                $query2_select.="`u`.`donor`,";
                if($btit_settings["fmhack_group_colours_overall"]!="enabled")
                    $query2_join.="INNER JOIN `{$TABLE_PREFIX}users` `u` ON `m`.`ID_MEMBER`=`u`.`smf_fid` ";
            }
            $query2_select.="`ul`.`prefixcolor`, `ul`.`suffixcolor`,";
            $query2_join.=(($btit_settings["fmhack_group_colours_overall"]!="enabled")?"":" INNER JOIN `{$TABLE_PREFIX}users` `u` ON `m`.`ID_MEMBER`=`u`.`smf_fid` ")."INNER JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level`=`ul`.`id` ";
        }
        # get posts [ shoult also test for permissions ]
        if($FORUMLINK=="smf")
            $lastPosts=get_result("SELECT ".$query2_select." `m`.`ID_TOPIC` `tid`, `m`.`ID_MSG` `pid`, `t`.`ID_FIRST_MSG` `spid`, `m`.`posterTime` `added`, `m`.`posterName` `username`, `m`.`body`, `m`.`ID_MEMBER` `userid` FROM `{$db_prefix}messages` `m` LEFT JOIN `{$db_prefix}topics` `t` ON `m`.`ID_TOPIC`=`t`.`ID_TOPIC` ".$query2_join." ".$exclude." ORDER BY `m`.`posterTime` DESC ".$limit,true,$btit_settings['cache_duration']);
        else
            $lastPosts=get_result("SELECT ".$query2_select." `m`.`id_topic` `tid`, `m`.`id_msg` `pid`, `t`.`id_first_msg` `spid`, `m`.`poster_time` `added`, `m`.`poster_name` `username`, `m`.`body`, `m`.`id_member` `userid` FROM `{$db_prefix}messages` `m` LEFT JOIN `{$db_prefix}topics` `t` ON `m`.`id_topic`=`t`.`id_topic` ".$query2_join." ".$exclude." ORDER BY `m`.`poster_time` DESC ".$limit,true,$btit_settings['cache_duration']);
        # format posts
        foreach ($lastPosts as $post)
        {
            if(isset($post["spid"]) && !empty($post["spid"]))
            {
                if($btit_settings["fmhack_group_colours_overall"]=="enabled")
                    $post["username"]=unesc($post["prefixcolor"].$post["username"].$post["suffixcolor"]);
                # get topic subject
                $title=get_result("SELECT `subject` FROM `{$db_prefix}messages` WHERE ".(($FORUMLINK=="smf")?"`ID_MSG`":"`id_msg`")."=".$post['spid']." LIMIT 1",true,$btit_settings['cache_duration']);
                $title=$title[0]['subject'];

                # cut it if necessary
                $head=wordwrap($title, 25 ,"\n", true);
                $post['title']=$head;

                if($btit_settings["fmhack_integrated_forum_display"]=="enabled")
                {
                    if($btit_settings["forum_viewtype"]!="iframe")
                    {
                        $href="href='".$btit_settings["url"]."/smf/index.php?topic=".$post["tid"].".msg".$post["pid"]."#msg".$post["pid"]."' target='".$btit_settings["forum_viewtype"]."'";
                        $href2="href='".$btit_settings["url"]."/smf/index.php?action=profile;u=".$post["userid"]."' target='".$btit_settings["forum_viewtype"]."'";
                    }
                    else
                    {
                        $href="href='".$btit_settings["url"]."/index.php?page=forum&amp;action=viewtopic&amp;topicid=".$post["tid"].".msg".$post["pid"]."#msg".$post["pid"]."'";
                        $href2="href='".$btit_settings["url"]."/index.php?page=forum&amp;action=profile;u=".$post["userid"]."'";
                    }
                }
                else
                {
                    $href="href='".$btit_settings["url"]."/index.php?page=forum&amp;action=viewtopic&amp;topicid=".$post["tid"].".msg".$post["pid"]."#msg".$post["pid"]."'";
                    $href2="href='".$btit_settings["url"]."/index.php?page=forum&amp;action=profile;u=".$post["userid"]."'";
                }
                $postsList.='<tr><td class="lista"><b><a class="forum" title="'.$language['FIRST_UNREAD'].': '.$post['title'].'" '.$href.'>'.$post['title'].'</a></b><br />'.$language['LAST_POST_BY'].' <a class="forum" '.$href2.'>'.$post['username'].(($btit_settings["fmhack_simple_donor_display"]=="enabled")?get_user_icons($post):"").'</a><br />On '.date('d/m/Y H:i:s',$post['added']).'</td></tr>';
            }
        }
    }
    elseif($FORUMLINK=="ipb")
    {
        $level=$CURUSER["id_level"];
        $query=get_result("SELECT `f`.`id`, `p`.`perm_view`, `f`.`parent_id` FROM `{$ipb_prefix}forums` `f` LEFT JOIN `{$ipb_prefix}permission_index` `p` ON (`f`.`id`=`p`.`perm_type_id` AND `p`.`app`='forums' AND `p`.`perm_type`='forum') ORDER BY `f`.`id` ASC", true, $btit_settings["cache_duration"]);
        $exclude="";

        foreach($query as $check)
        {
            $forumid=$check["id"];
            if($check["parent_id"]==-1)
                $exclude=($exclude." AND forum_id!=".$forumid);
            else
            {
                if($check["perm_view"]!="*")
                {
                    $perm=trim($check["perm_view"], ",");
                    $read=explode(',',$perm);
                    if(is_array($read))
                    {
                        if (!in_array($level, $read))
                        {
                            $exclude=($exclude." AND forum_id!=".$forumid);
                        }
                    }
                    else
                    {
                        $exclude=($exclude." AND forum_id!=".$forumid);
                    }
                }
            }
        }
        // --- Use the value defined in the site config or use 5 by default
        if (isset($GLOBALS["block_forumlimit"]))
               $limit="LIMIT " . $GLOBALS["block_forumlimit"];
        else
               $limit="LIMIT 5";

        // --- SQL Query to get the X topics to display in the forum block
        $sqlquery = "SELECT tp.tid, tp.title, tp.last_poster_id, tp.last_post, tp.last_poster_name, tp.forum_id, ";
        $sqlquery.= "fm.id ";
        if($btit_settings["fmhack_group_colours_overall"]=="enabled")
            $sqlquery.= ", ul.prefixcolor, ul.suffixcolor ";
        if($btit_settings["fmhack_simple_donor_display"]=="enabled")
            $sqlquery.= ", u.donor ";
        $sqlquery.= "FROM {$ipb_prefix}topics tp ";
        $sqlquery.= "LEFT JOIN {$ipb_prefix}forums fm ON fm.id = tp.forum_id ";
        if($btit_settings["fmhack_simple_donor_display"]=="enabled" || $btit_settings["fmhack_group_colours_overall"]=="enabled")
            $sqlquery.="LEFT JOIN {$TABLE_PREFIX}users u ON tp.last_poster_id=u.ipb_fid ";
        if($btit_settings["fmhack_group_colours_overall"]=="enabled")
            $sqlquery.="LEFT JOIN {$TABLE_PREFIX}users_level ul ON u.id_level=ul.id ";
        $sqlquery.= "WHERE tp.state!='link' ";
        $sqlquery.= $exclude." ORDER BY last_post DESC ".$limit;

        $tres = get_result($sqlquery, true, $btit_settings["cache_duration"]);

        // --- Lets grab their time offset so that we can offset the post time appropriately
        include("include/offset.php");

        foreach($tres as $post)
        {
            if($btit_settings["fmhack_group_colours_overall"]=="enabled")
                $post["last_poster_name"]=unesc($post["prefixcolor"].$post["last_poster_name"].$post["suffixcolor"]);

            $title=$post["title"];

            # cut it if necessary
            $head=wordwrap($title, 25 ,"\n", true);
            $post['title']=$head;

            if($btit_settings["fmhack_integrated_forum_display"]=="enabled")
            {
                if($btit_settings["forum_viewtype"]!="iframe")
                {
                    $href="href='".$btit_settings["url"]."/ipb/index.php?showtopic=".$post["tid"]."' target='".$btit_settings["forum_viewtype"]."'";
                    $href2="href='".$btit_settings["url"]."/ipb/index.php?showuser=".$post["last_poster_id"]."' target='".$btit_settings["forum_viewtype"]."'";
                }
                else
                {
                    $href="href='index.php?page=forum&amp;action=viewtopic&amp;topicid=".$post["tid"]."'";
                    $href2="href='index.php?page=forum&amp;action=showuser&amp;userid=".$post["last_poster_id"]."'";
                }
            }
            else
            {
                $href="href='ndex.php?page=forum&amp;action=viewtopic&amp;topicid=".$post["tid"]."'";
                $href2="href='index.php?page=forum&amp;action=showuser&amp;userid=".$post["last_poster_id"]."'";
            }

            $postsList.='<tr><td class="lista"><b><a class="forum" title="'.$language['FIRST_UNREAD'].': '.$post['title'].'" '.$href.'>'.$post['title'].'</a></b><br />'.$language['LAST_POST_BY'].' <a class="forum" '.$href2.'>'.$post['last_poster_name'].(($btit_settings["fmhack_simple_donor_display"]=="enabled")?get_user_icons($post):"").'</a><br />On '.date('d/m/Y H:i:s',$post['last_post']).'</td></tr>';
       }
    }
    else {
        # get posts based if can read
        $lastPosts=get_result('SELECT p.topicid as tid, p.id as pid, t.subject, p.added, p.body, p.userid FROM '.$topicsTable.' as t LEFT JOIN '.$postsTable.' as p ON p.topicid=t.id LEFT JOIN '.$TABLE_PREFIX.'forums as f ON f.id=t.forumid WHERE f.minclassread<='.$CURUSER['id_level'].(($realLastPosts)?'':' AND p.id=t.lastpost').' ORDER BY p.added DESC '.$limit,true,$btit_settings['cache_duration']);
        # format posts
        foreach($lastPosts as $post) {
            # get username
            $query1_select="";
            if($btit_settings["fmhack_simple_donor_display"]=="enabled")
                $query1_select.="u.donor,";
            // Warn System -->
            if($btit_settings["fmhack_warning_system"]=="enabled")
                $query1_select.="u.warn_lev,";
            // <-- Warn System

            $user=get_result('SELECT '.$query1_select.' ul.prefixcolor, u.username, ul.suffixcolor FROM '.$TABLE_PREFIX.'users_level as ul LEFT JOIN '.$TABLE_PREFIX.'users as u ON u.id_level=ul.id WHERE u.id='.$post['userid'].' LIMIT 1;',true,$btit_settings['cache_duration']);
            if (isset($user[0])) {
                $user=$user[0];
                $post['username']=unesc($user['prefixcolor'].$user['username'].$user['suffixcolor']);
            } else $post['username']='[DELETED USER]';

           if($post['userid']==0)
               $post["username"]=$language["SYSTEM_USER"];

            // Warn System -->
            $postsList.='<tr><td class="lista"><b><a class="forum" href="index.php?page=forum&amp;action=viewtopic&amp;topicid='.$post['tid'].'&amp;msg='.$post['pid'].'#'.$post['pid'].'">'.htmlspecialchars(unesc($post['subject'])).'</a></b><br />'.$language['LAST_POST_BY'].' <a class="forum" href="'.(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$post["userid"]."_".strtr($user["username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$post["userid"]).'">'.$post['username'].(($btit_settings["fmhack_warning_system"]=="enabled")?warn($user):"").'</a><br />On '.get_date_time($post['added']).'</td></tr>';
            // <-- Warn System
        }
    }
} else $postsList='<tr><td class="lista">'.$language['NO_TOPIC'].'</td></tr>';
?>
<table cellpadding="4" cellspacing="1" width="100%">
    <tr>
        <td class="lista">
            <table width="100%" cellspacing="2" cellpadding="2">
                <tr>
                    <td><?php echo $language['TOPICS'];?>:</td>
                    <td align="right"><?php echo number_format($topics);?></td>
                </tr>
                <tr>
                    <td><?php echo $language['POSTS'];?>:</td>
                    <td align="right"><?php echo number_format($posts);?></td>
                </tr>
                <tr>
                    <td><?php echo $language['TOPICS'].'/'.$language['POSTS'];?>:</td>
                    <td align="right"><?php echo $postsAvg;?>%</td>
                </tr>
            </table>
        </td>
    </tr>
    <?php echo $postsList;?>
</table>
<?php

?>
</div>
<div class="panel-footer">
</div>
</div>
