<?php
##############################################################################
# KIS Hack - ACP Award Tab
#
# Copyright (C) 2008 Khez
#
#    This file is part of the KIS hack.
#
# THIS SOFTWARE IS PROVIDED BY THE AUTHOR ``AS IS'' AND ANY EXPRESS OR IMPLIED
# WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
# MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.
# IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
# SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED
# TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
# PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF
# LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
# NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE,
# EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
#
##############################################################################

# direct access
if (!defined('IN_ACP'))
	die('non direct access!');
# template
$kisTabTemplate='kis/acp.award.tpl';
# inits
$msg=isset($_POST['msg'])?$_POST['msg']:'';
$subject=isset($_POST['subject'])?$_POST['subject']:'';
$rank=isset($_POST['awardLevel'])?(int)$_POST['awardLevel']:0;
$invites=isset($_POST['inv'])?(int)$_POST['inv']:0;
$sender=isset($_POST['anon'])?0:$uid;
$exact=isset($_POST['exact']);
# actions
switch ($action) {
	# do award
	case 'write':
		if ($_POST['confirm']==$language['FRM_CONFIRM']) {
			if ($subject!='') {
				if ($msg!='') {
					$sqlsubject=sqlesc($subject);
					$sqlmsg=sqlesc($msg);
					if ($rank!=1 && $invites != 0) {
						$users=get_result('SELECT `id`, `username` FROM `'.$TABLE_PREFIX.'users` WHERE id_level='.$rank.';');
						$i=0;
						foreach ($users as $user) {
							kisMod($user['id'], $invites, $exact);
							send_pm($sender,$user['id'],$sqlsubject,$sqlmsg);
							$i++;
							$response[]='<a href="'.$BASEURL.'/index.php?page=userdetails&amp;id='.$user['id'].'">'.$user['username'].'</a>';
						}
						$response=isset($response)?' ( '.implode(' - ',$response).' )':'';
						$_MSG[]=($i!=0)?array('Success', sprintf($language['KIS_MASS_RESPONSE'], $invites, $i).$response):array('Error', $language['KIS_NOUSER']);
						if ($kisfig['kis_logs'])
							write_log('[KIS] <a href="'.$BASEURL.'/index.php?page=userdetails&id='.$uid.'">'.$uname.'</a> awarded '.$invites.' invites to '.$i.' users'.$response.'.', 'add');
					} else $_MSG[]=array('Error', $language['KIS_RNKINV']);
				} else $_MSG[]=array('Error', $language['ERR_BODY_EMPTY']);
			} else $_MSG[]=array('Error', $language['ERR_SUBJECT']);
		}
	
	# show input
	case 'read':
	default:
		# inits
		$kis['ANON']=($sender)?'':'checked="checked"';
		$kis['EXACT']=($exact)?'checked="checked"':'';
		$kis['INVITES']=$invites;
		$kis['SUBJECT']=$subject;
		# get ranks
		$ranks=rank_list();
		$opts['complete']=true;
		$opts['name']='awardLevel';
		$opts['default']=$rank;
		$opts['value']='level';
		$kis['AWARDRANK']=get_combo($ranks, $opts);
		$kis['BODY']=textbbcode('kis','msg',$msg);
}
?>