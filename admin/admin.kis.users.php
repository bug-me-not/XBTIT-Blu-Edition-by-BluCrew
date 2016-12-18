<?php
##############################################################################
# KIS Hack - ACP Users Tab
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
if(!defined("IN_BTIT"))
    die("non direct access!");
if (!defined('IN_ACP'))
	die('non direct access!');
# template
$kisTabTemplate='admin.kis.users.tpl';
# inits
$form=false;
# code
if ($_POST['confirm']==$language['FRM_CONFIRM']) {
	if ($action=='edit') {
		$id=(int)$_GET['id'];
		$invites=(int)$_POST['invites'];
		if (kisMod($id, $invites, true))
			$_MSG[]=array('Success', $language['KIS_EDIT']);
		else
			$_MSG[]=array('Error', $language['KIS_NOEDIT']);
		if ($kisfig['kis_logs'])
			write_log('[KIS] <a href="'.$BASEURL.'/index.php?page=userdetails&id='.$uid.'">'.$uname.'</a> edited '.getNameX($id, $BASEURL).' invites to '.$invites.'.', 'modify');
	} elseif ($action=='search') {
		$what=$_POST['what'];
		if ($what=='id') {
			$id=(int)$_POST['who'];
			$name=get_result('SELECT username FROM '.$TABLE_PREFIX.'users WHERE id='.$id.' LIMIT 1;', $CACHE_DURATION);
			if (isset($name[0])) {
				$name=$name[0]['username'];
			} else {
				$_MSG[]=array('Error', $language['ERR_USER_NOT_FOUND']);
				$error=true;
			}
		} elseif ($what=='user') {
			$name=sqlesc($_POST['who']);
			$user=get_result('SELECT username, id FROM '.$TABLE_PREFIX.'users WHERE username='.$name.' LIMIT 1;', $CACHE_DURATION);
			if (isset($user[0])) {
				$id=$user[0]['id'];
				$name=$user[0]['username'];
			} else {
				$_MSG[]=array('Error', $language['ERR_USER_NOT_FOUND']);
				$error=true;
			}
		} else {
			$_MSG[]=array('Error', $language['KIS_INVALID_TYPE']);
			$error=true;
		}
		if (!isset($error)) {
			$form=true;
			$unfo=kisUserInfo($id);
			$inviter=get_result('SELECT uid FROM '.$TABLE_PREFIX.'kis_sent WHERE used='.$id.' LIMIT 1;', $CACHE_DURATION);
			$kis['INVITER']=(isset($inviter[0]))?getNameX($inviter[0]['uid'], $BASEURL):$language['KIS_ORGANIC'];
			$kis['INVITES']=$unfo['invites'];
			$kis['JOINED']='<a href="'.$script.'ktab=invites&amp;uid='.$id.'">'.$unfo['joined'].' users</a>';
			$kis['RESULTS']='<a href="'.$BASEURL.'/index.php?page=userdetails&amp;id='.$id.'">'.$name.'</a>';
			if ($kisfig['kis_logs'])
				write_log('[KIS] <a href="'.$BASEURL.'/index.php?page=userdetails&id='.$uid.'">'.$uname.'</a> searched for '.$kis['RESULTS'].'.', 'modified');
		}
	}
}
# specific template vars
$admintpl->set('pager', $pager);
$admintpl->set('dopager', $pager!='', true);
$admintpl->set('invites', $invites);
$admintpl->set('doinvites', ($total!=0), true);
$admintpl->set('form', $form, true);
$admintpl->set('uid', $id);
?>