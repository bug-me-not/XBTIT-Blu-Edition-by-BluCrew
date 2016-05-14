<?php
##############################################################################
# KIS Hack - ACP Config Tab
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
$kisTabTemplate='admin.kis.config.tpl';
# code
switch ($action) {
	# save/uninstall config
	case 'write':
		# do config
		if ($_POST['confirm']==$language['FRM_CONFIRM']) {
			if ($kisfig['kis_logs'])
				write_log('[KIS] <a href="'.$BASEURL.'/index.php?page=userdetails&id='.$uid.'">'.$uname.'</a> changed config.', 'add');
			# rewrite config
			$kisfig['kis_enabled']=isset($_POST['enabled']);
			$kisfig['kis_logs']=isset($_POST['logs']);
			$kisfig['kis_perPage']=(int)$_POST['perpage'];
			$kisfig['kis_invExpireType']=$_POST['expireType'];
			$kisfig['kis_invExpireAmmount']=(int)$_POST['expireAmmount'];
			$kisfig['kis_regType']=$_POST['regType'];
			$kisfig['kis_regAmmount']=(int)$_POST['regAmmount'];
			# do config
			$_MSG[]=array('Success', $language['CONFIG_SAVED']);
			$enabled=($kisfig['kis_enabled'])?'true':'false';
			$logs=($kisfig['kis_logs'])?'true':'false';
			$perPage=$kisfig['kis_perPage'];
			$expireType=$kisfig['kis_invExpireType'];
			$expireAmmount=$kisfig['kis_invExpireAmmount'];
			$regType=$kisfig['kis_regType'];
			$regAmmount=$kisfig['kis_regAmmount'];
			quickQuery('DELETE FROM `'.$TABLE_PREFIX.'khez_configs` WHERE `key` LIKE "kis_%" LIMIT 15;', true);
			quickQuery('INSERT INTO `'.$TABLE_PREFIX.'khez_configs` VALUES ("kis_enabled", "'.$enabled.'"), ("kis_logs", "'.$logs.'"), ("kis_perPage", '.$perPage.'), ("kis_invExpireType", "'.$expireType.'"), ("kis_invExpireAmmount", '.$expireAmmount.'), ("kis_regType", "'.$regType.'"), ("kis_regAmmount", '.$regAmmount.');', true);
		} elseif ($_POST['confirm']==$language['HACK_UNINSTALL']) {
			quickQuery('DROP TABLE IF EXISTS `'.$TABLE_PREFIX.'kis_users`;', true);
			quickQuery('DROP TABLE IF EXISTS `'.$TABLE_PREFIX.'kis_sent`;', true);
			quickQuery('DELETE FROM `'.$TABLE_PREFIX.'khez_configs` WHERE `key` LIKE "kis_%";', true);
			$kis_db=false;
			break;
		}

	# list config
	case 'read':
	default:
		# KIS configs
		$kis['ENABLED']=($kisfig['kis_enabled'])?'checked="checked"':'';
		$kis['LOGS']=($kisfig['kis_logs'])?'checked="checked"':'';
		$kis['PERPAGE']=$kisfig['kis_perPage'];
		# Time Combo
		$list=getTimeList();
		$opts['complete']=true;
		$opts['name']='expireType';
		$opts['default']=$kisfig['kis_invExpireType'];
		$kis['EXPIRE_TYPE']=get_combo($list, $opts);
		$kis['EXPIRE_AMMOUNT']=$kisfig['kis_invExpireAmmount'];
		# Size Combo
		$list=getSizeList();
		$opts['name']='regType';
		$opts['default']=$kisfig['kis_regType'];
		$kis['REG_TYPE']=get_combo($list, $opts);
		$kis['REG_AMMOUNT']=$kisfig['kis_regAmmount'];
} # switch
?>