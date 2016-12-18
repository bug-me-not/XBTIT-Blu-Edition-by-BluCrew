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

if (!defined('IN_BTIT'))
  die('non direct access!');

if (!defined('IN_ACP'))
  die('non direct access!');

# MASSPM SETTINGS

# This is for the drop down ratio box Where do you want the ratio range to start from?
$value=0.0;
# This is for the ending ratio range where do you want it to end?
$cutoff=10.0;
# Should we PM the sender a copy of the PM? usage: true or false
$pm_sender=true;
# Should we list the users PMed in the PM sent Box? usage: true or false
$list_users=true;
# What should the default subject be if none set?
$default_subject='Global Notice';
# Who will the PM be sent from, you can register an account here called system then change to $sender=100; where 100 is the systems UID number
$sender=$CURUSER['uid']; // use 0 For 'System'

# This will be added to the end of each message to deactivate set value to false
$footer="\n\n".'This is an automated system please do not reply!!!'; # "\n" = new line
# $footer=false; # uncomment this line for no footer

## !!!!!*****DEBUG MODE*****!!!!!
# Do we actually send the PM's ? usage: true or false
$pm = true;
# Recommended modes for debug: $pm = false; $list_users = true;

# END OF SETTINGS, DO NOT EDIT BELOW UNLESS YOU KNOW WHAT YOU ARE DOING!!!!

# init some variable...
$ratio=0;
$pick=0;
$msg='';
$l_users='';
$flevel=0;
$tlevel=0;
# Actual Code Start
$error=(isset($_GET['error']))?$_GET['error']:'';
$error_msg='';
$masspm=array();
$masspm_post=false;
$ratio_d='';
switch ($action) {
  case 'post':
      if (isset($_POST['masspm'])) {
            #init vars
            $ratio=(isset($_POST['ratio'])?$_POST['ratio']:0);
            $pick=(isset($_POST['pick'])?$_POST['pick']:0);
            $flevel=(int)($_POST['level']);
            $tlevel=(int)($_POST['levell']);
            $subject=($_POST['subject']==''?$default_subject:$_POST['subject']);
            $original_subject=htmlspecialchars($subject);
            $msg=(isset($_POST['msg'])?$_POST['msg']:'');
            $subject=sqlesc($subject);
            # empty message and not debug mode
            if ($msg=='' && $pm) {
                $error='return';
            } else {
                # append footer
                if($footer)
                    $msg.=$footer;
                $original_msg=$msg;
                $msg=sqlesc($msg);
                # get ratio
                if ($ratio)
                    switch($pick) {
                        case 0:
                            $pick='='.$ratio;
                            $ratio_d='with a '.$language['RATIO'].' of <b>('.$ratio.')</b>';
                            break;

                        case 1:
                            $pick='>='.$ratio;
                            $ratio_d='with a '.$language['RATIO'].' of <b>('.$ratio.')</b> and above';
                            break;
                        case 2:
                            $pick='<='.$ratio;
                            $ratio_d='with a '.$language['RATIO'].' of <b>('.$ratio.')</b> and below';
                            break;
                    }
                # get level
                if ($flevel==0||$tlevel==0) {
                    # selected all
                    $where='WHERE u.id>1';
                    $rank_details='in all '.$language['USER_LEVEL'].'s';
                } else {
                    # get id_level names
                    $where='id_level='.$flevel;
                    if ($flevel==$tlevel) {
                        $limit=1;
                    } else {
                        $limit=2;
                        $where.=' OR id_level='.$tlevel;
                        if ($flevel>$tlevel) {
                            $flevel+=$tlevel;
                            $tlevel=$flevel-$tlevel;
                            $flevel-=$tlevel;
                        }
                    }
                    $levelsRes=get_result('SELECT id_level, level FROM '.$TABLE_PREFIX.'users_level WHERE '.$where.' LIMIT '.$limit);
                    foreach ($levelsRes as $level)
                        $levels[$level['id_level']]= $level['level'];
                    # create query for actual user listing
                    if ($limit==2) {
                        $where='WHERE u.id_level BETWEEN '.$flevel.' AND '.$tlevel.' AND u.id>1';
                        $rank_details='in '.$language['USER_LEVEL'].'s <b>('.$levels[$flevel].' - '.$levels[$tlevel].')</b>';
                    } else {
                        $where='WHERE u.id_level='.$flevel.' AND u.id>1';
                        $rank_details='in '.$language['USER_LEVEL'].' <b>('.$levels[$flevel].')</b>';
                    }
                }
                # correct ratio value
                if ($XBTT_USE) {
                    $tables=$TABLE_PREFIX.'users u LEFT JOIN xbt_users x ON x.uid=u.id';
                    if ($ratio)
                        $where.=' AND ((u.uploaded+IFNULL(x.uploaded,0))/(u.downloaded+IFNULL(x.downloaded,0.1)))'.$pick;
                } else {
                    $tables=$TABLE_PREFIX.'users u';
                    if ($ratio)
                        $where.=' AND ((u.uploaded)/(u.downloaded=0))'.$pick;
                }
                # get data
                $pm_users=get_result('SELECT u.id, u.username FROM '.$tables.' '.$where,true);
                $i=0;
                # revamp data
                foreach ($pm_users as $cur) {
                    if ( (!$pm_sender) && $cur['id']==$CURUSER['uid'])
                        continue;
                    $i++;
                    if ($pm)
                        send_pm($sender,$cur['id'],$subject,$msg);
                    if ($list_users)
                        $l_users[] ='<a href="'.$BASEURL.'/'.(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$cur["id"]."_".strtr($cur["username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$cur["id"]).'">'.$cur['username'].'</a>';
                }
                # set output vars
                $block_title=$language['MASS_SENT'];
                $masspm_post=true;
                $masspm['subject']=$original_subject;
                $masspm['body']=format_comment($original_msg);
                $masspm['info']='<b>'.$i.'</b> '.$language['USERS_FOUND'].' '.$rank_details.' '.$ratio_d.' !! '.((!$pm)?' [ DEBUG MODE ] ':'').'<br /><br />'.$language['USERS_PMED'].'<br />'.implode(' - ',$l_users);
                break;
            }
        }

    case 'write':
        switch ($error) {
          case 'return':
                $error_msg=$language['MASS_PM_ERROR'];
                $error=true;
                break;

          default:
                $error=false;
        }
        # init options
        $opts['name']='level';
        $opts['complete']=true;
        $opts['id']='id';
        $opts['value']='level';
        $opts['default']=$flevel;
        # get from rank group
        $ranks=rank_list($btit_settings["fmhack_logical_rank_ordering"]=="enabled"?true:'');
        $ranks[]=array('id'=>0, 'level'=>$language['ALL']);
        $masspm['combo_from_group']=get_combo($ranks, $opts);
        # get to rank group
        $opts['name']='levell';
        $opts['default']=$tlevel;
        $masspm['combo_to_group']=get_combo($ranks, $opts);
        # get ratios
        $combo="\n".'<select name="ratio"><option value="0"'.($ratio==0?' selected="selected" ':'').'>'.$language['ANY'].'</option>';
        for ($value=0;$value <= ($cutoff*10);$value++) {
            $cur=($value/10);
            $combo.="\n".'<option value="'.$cur.'"'.($ratio==$cur?' selected="selected" ':'').'>'.$cur.'</option>';
        }
        $combo.="\n".'</select>';
        $masspm['combo_from_ratio']=$combo;
        # get ratio type
        $combo="\n".'<select name="pick">';
        $combo.="\n".'<option value="0"'.($pick==0?' selected="selected" ':'').'>'.$language['RATIO_ONLY'].'</option>';
        $combo.="\n".'<option value="1"'.($pick==1?' selected="selected" ':'').'>'.$language['RATIO_GREAT'].'</option>';
        $combo.="\n".'<option value="2"'.($pick==2?' selected="selected" ':'').'>'.$language['RATIO_LOW'].'</option>';
        $combo.="\n".'</select>';
        $masspm['combo_pick_ratio']=$combo;
        $masspm['body']=textbbcode('masspm','msg',$msg);
        $block_title=$language['ACP_MASSPM'];
        break;

    default:
        # invalid action
        redirect('index.php?page=admin&user='.$CURUSER['uid'].'&code='.$CURUSER['random']);
}

$admintpl->set('frm_error',$error,true);
$admintpl->set('frm_message', $error_msg);
$admintpl->set('language',$language);
$admintpl->set('frm_action','index.php?page=admin&amp;user='.$CURUSER['uid'].'&amp;code='.$CURUSER['random'].'&amp;do=masspm&amp;action=post');
$admintpl->set('masspm',$masspm);
$admintpl->set('masspm_post',$masspm_post,true);
?>