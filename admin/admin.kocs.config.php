<?php
##############################################################################
# KOCS Hack - Config Tab
#
# Copyright (C) 2008 Khez
#
#    This file is part of the KOCS hack.
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
$kocsTabTemplate='admin.kocs.config.tpl';

# code
switch ($action) {
	case 'write':
		if ($_POST['confirm']==$language['FRM_CONFIRM']) {
			if ($_POST['key1']==$_POST['key2']) {
				if ($kocsfig['kocs_cfg_logs'])
					write_log('[KOCS] <a href="'.$BASEURL.'/index.php?page=userdetails&id='.$uid.'">'.$uname.'</a> changed config.', 'add');
				# rewrite config
				$kocsfig['kocs_cfg_logs']=isset($_POST['logs']);
				$kocsfig['kocs_cfg_keycheck']=isset($_POST['check']);
				# save config
				$_MSG[]=array('Success', $language['CONFIG_SAVED']);
				$logs=($kocsfig['kocs_cfg_logs'])?'true':'false';
				$check=($kocsfig['kocs_cfg_keycheck'])?'true':'false';
				$kkey=($_POST['key1']!='')?md5($_POST['key1']):$kocsfig['kocs_cfg_key'];
				# revamp key
				$key=md5($CURUSER['uid'].$kkey);
				# save it
				quickQuery('DELETE FROM `'.$TABLE_PREFIX.'khez_configs` WHERE `key` LIKE "kocs_cfg_%" LIMIT 3;');
				quickQuery('INSERT INTO `'.$TABLE_PREFIX.'khez_configs` VALUES ("kocs_cfg_logs", "'.$logs.'"), ("kocs_cfg_keycheck", "'.$check.'"), ("kocs_cfg_key", '.sqlesc($kkey).');');
			} else $_MSG[]=array('Error', $language['KOCS_PASS_MATCH']);
		} elseif ($_POST['confirm']==$language['HACK_UNINSTALL']) {			
			quickQuery('DROP TABLE `'.$TABLE_PREFIX.'khez_configs`;', true);
			$kocs_db=false;
			break;
		}

	case 'read':
	default:
		# KOCS configs
		$kocs['KEYCHECK']=($kocsfig['kocs_cfg_keycheck'])?'checked="checked"':'';
		$kocs['LOGS']=($kocsfig['kocs_cfg_logs'])?'checked="checked"':'';
}
?>