<?php
##############################################################################
# KIS Hack - UCP Invite Tab
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

#direct access
if (!defined('IN_BTIT'))
	die('non direct access!');

# template
$kisTabTemplate='usercp.kis.invite.tpl';

# inits
$user=kisUserInfo($uid);
$kis=array();

# quickfix
if ($user['invites']==0) {
	$_GET['action']='read';
	$allow=false;
	$_MSG[]=array('Error', $language['KIS_NONE']);
} else $allow=true;

# code
switch ($_GET['action']) {
	# send invites
	case 'send':
		# array of emails
		$emails=explode(',',$_POST['emails']);
		$invites=count($emails);
		# enough invites?
		if ($invites>$user['invites']) {
			$_MSG[]=array('Error', $language['KIS_OVERKILL']);
		} else {
			$badmail=false;
			# test each email if valid, already regged or invited
			foreach ($emails as &$email) {
				$email=trim($email);
				$sql_mail=sqlesc($email);
				# valid email
				if (!isValidMail($email)) {
					$badmail=true;
					$_MSG[]=array('Error', $language['KIS_BAD_MAIL']);
					break;
				} else {
					# already regged
					$mail=get_result('SELECT uid FROM '.$TABLE_PREFIX.'kis_sent WHERE email='.$sql_mail.' LIMIT 1;', true);
					if (isset($mail[0])) {
						$badmail=true;
						$_MSG[]=array('Error', $language['KIS_BAD_SENT']);
						break;
					} else {
						# alrady invited
						$sent=get_result('SELECT id FROM '.$TABLE_PREFIX.'users WHERE email='.$sql_mail.' LIMIT 1;', true);
						if (isset($sent[0])) {
							$badmail=true;
							$_MSG[]=array('Error', $language['KIS_BAD_EXISTENT']);
							break;
						}
					}
				}
			}

			# each email was valid and not regged/invited
			if (!$badmail) {
				$time=time();
				$values=array();
				foreach ($emails as $email) {
					$sql_mail=sqlesc($email); # hate that I do this again
					$token=md5(time().'khez'.$uid);
					$link=$BASEURL.'/index.php?page=signup&amp;invite='.$token;
					$subject=sprintf($language['KIS_MAIL_SUBJECT'], $btit_settings['name']);
					$body=sprintf($language['KIS_MAIL_BODY'], $btit_settings['name'], $uname, $token, $link);
					# send mail
					send_mail($email, $subject, $body, true);
					# insert invite token
					$values[]='("'.$token.'", '.$time.', '.$uid.', '.$sql_mail.', 0)';
				}
				if ($kisfig['kis_logs'])
					write_log('[KIS] <a href="'.$BASEURL.'/index.php?page=userdetails&id='.$uid.'">'.$uname.'</a> invited '.$invites.' users: '.$_POST['emails'].'.', 'add');
				# insert invite tokens
				quickQuery('INSERT INTO '.$TABLE_PREFIX.'kis_sent VALUES '.implode(',', $values).';');
				# update total invites
				quickQuery('UPDATE '.$TABLE_PREFIX.'kis_users SET invites=invites-'.$invites.' WHERE uid='.$uid.' LIMIT 1;');
				$user['invites']-=$invites;
				$_MSG[]=array('Success', sprintf($language['KIS_SUCCESS'], $_POST['emails']));
				$_POST['emails']='';
			}
		}

	case 'read':
	case 'list':
	default:
		# inits
		$form_action='&amp;ktab=invite&amp;action=send';
		# kis
		$kis['REMAINING']=$user['invites'];
		$kis['EMAILS']=isset($_POST['emails'])?$_POST['emails']:'';
		break;
}

$usercptpl->set('allow', $allow, true);
$usercptpl->set('frm_action', $form_action);
?>