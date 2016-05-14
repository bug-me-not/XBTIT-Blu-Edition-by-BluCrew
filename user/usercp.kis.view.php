<?php
##############################################################################
# KIS Hack - UCP View Tab
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
if (!defined('IN_BTIT'))
	die('non direct access!');

# template
$kisTabTemplate='usercp.kis.view.tpl';

# code
switch ($_GET['action']) {
	# delete
	case 'delete':
	case 'remove':
		# escape it
		$sqlmail=sqlesc($_GET['email']);
		$valid=get_result('SELECT uid FROM '.$TABLE_PREFIX.'kis_sent WHERE email='.$sqlmail.' AND used=0 LIMIT 1;');
		# check valid remove
		if (isset($valid[0])) {
			# remove it
			quickQuery('DELETE FROM '.$TABLE_PREFIX.'kis_sent WHERE email='.$sqlmail.' LIMIT 1;');
			# add one invite back
			kisMod($uid, 1);
			# log it
			if ($kisfig['kis_logs'])
				write_log('[KIS] <a href="'.$BASEURL.'/index.php?page=userdetails&id='.$uid.'">'.$uname.'</a> removed pending invite for '.$mail.' from <a href="'.$BASEURL.'/index.php?page=userdetails&id='.$uid.'">'.$uname.'</a>.', 'added');
		} else $_MSG[]=array('Error', sprintf($language['KIS_INVALID_DEL'], $script));

	case 'read':
	default:
		# inits
		$order='';
		$limit='';
		$ord['email']='ord=ed';
		$mark['email']='';
		$ord['status']='ord=sd';
		$mark['status']='';
		$ord['time']='ord=td';
		$mark['time']='';
		# preparing
		if (isset($_GET['ord'])) {
			$cur_order = 'ord='.$_GET['ord'];
			switch($_GET['ord']) {
				case 'ea':
					$order='ORDER BY email ASC';
					$mark['email']='&nbsp;&uarr;';
					break;
				case 'ed':
					$order='ORDER BY email DESC';
					$ord['email']='ord=ea';
					$mark['email']='&nbsp;&darr;';
					break;
				case 'sa':
					$order='ORDER BY used ASC';
					$mark['status']='&nbsp;&uarr;';
					break;
				case 'sd':
					$order='ORDER BY used DESC';
					$ord['status']='ord=sa';
					$mark['status']='&nbsp;&darr;';
					break;
				case 'ta':
					$order='ORDER BY time ASC';
					$mark['time']='&nbsp;&uarr;';
					break;
				case 'td':
					$order='ORDER BY time DESC';
					$ord['time']='ord=ta';
					$mark['time']='&nbsp;&darr;';
					break;
			}
		} else $order='ORDER BY time DESC';
		# pager
		$total=get_result('SELECT COUNT(*) as total FROM `'.$TABLE_PREFIX.'kis_sent` WHERE uid='.$uid.';', true);
		$total=$total[0]['total'];
		if ($total) {
			list($pager, ,$limit)=pager($kisfig['kis_perPage'],$total,$script.$cur_order.'&amp;');
			# header section
			$kis['EMAIL']='<a href="'.$script.$ord['email'].'">'.$language['EMAIL'].$mark['email'].'</a>';
			$kis['STATUS']='<a href="'.$script.$ord['status'].'">'.$language['ACTIVE'].$mark['status'].'</a>';
			$kis['TIME']='<a href="'.$script.$ord['time'].'">'.$language['KIS_TIME'].$mark['time'].'</a>';
			$kis['TOKEN']=$language['KIS_TOKEN'];
			$kis['ACTION']=$language['ACTION'];
			# revamp
			$dbinvites=get_result('SELECT token, time, email, used FROM '.$TABLE_PREFIX.'kis_sent WHERE uid='.$uid.' '.$order.' '.$limit, true);
			$invites=array();
			foreach ($dbinvites as $invite) {
				$row=array();
				$row['TIME']=date('Y.m.d H:i:s', $invite['time']);
				if ($invite['used']==0) {
					$row['TOKEN']='<input type="text" value="'.$invite['token'].'" />';
					$row['EMAIL']=$invite['email'];
					$row['STATUS']=$language['KIS_PENDING'];
					$row['ACTION']='<a href="'.$script.'ktab=view&amp;action=delete&amp;email='.$invite['email'].'"><img src="'.load_css('images/delete.png').'" border="0" /></a>';
				} else {
					$row['TOKEN']='-';
					$row['EMAIL']='['.getName($invite['used']).'] '.$invite['email'];
					$row['STATUS']=$language['KIS_REGISTERED'];
					$row['ACTION']='<a href="'.$BASEURL.'/index.php?page=userdetails&amp;id='.$invite['used'].'"><img src="'.load_css('images/account.png').'" border="0" /></a>';
				}
				$invites[]=$row;
			}
		} else $_MSG[]=array('Error', $language['KIS_EMPTY']);
		break;
}

# specific template vars
$usercptpl->set('pager', $pager);
$usercptpl->set('dopager', $pager!='', true);
$usercptpl->set('invites', $invites);
$usercptpl->set('doinvites', ($total!=0), true);
?>