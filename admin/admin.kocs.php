<?php
##############################################################################
# KOCS Hack - ACP Page
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

# KOCS
require load_language('lang_kocs.php');
require $THIS_BASEPATH.'/include/kocs.php';
# Khez
require load_language('lang_khez.php');
require $THIS_BASEPATH.'/include/khez.php';

# test database
$res=do_sqlquery('SHOW TABLES LIKE "'.$TABLE_PREFIX.'khez_configs";');
$kocs_db=$res->fetch_array();
$kocs_db=(bool)$kocs_db[0];
$res->free();

# inits
$hack_info['id']=0;
$_MSG=array();
$_TABS=array();
$script=$BASEURL.'/index.php?page=admin&amp;user='.$CURUSER['uid'].'&amp;code='.$CURUSER['random'].'&amp;do=kocs&amp;';
$uid=$CURUSER['uid'];
$uname=$CURUSER['username'];

# tabs
$_TABS[]=array('ktab=backup', $language['KOCS_TAB_BACKUP']);
$_TABS[]=array('ktab=restore', $language['KOCS_TAB_RESTORE']);
$_TABS[]=array('ktab=config', $language['KHEZ_CONFIG']);
$_TABS[]=array('ktab=help', $language['KHEZ_FAQ']);

# get config & test permissions
global $kocsfig;
if ($kocs_db) {
	$kocsfig=get_khez_config('SELECT `key`,`value` FROM `'.$TABLE_PREFIX.'khez_configs` WHERE `key` LIKE "kocs_%" LIMIT 8;', 0);
	if ($kocsfig['kocs_cfg_keycheck']) {
		$key=(isset($_GET['key']))?$_GET['key']:md5($CURUSER['uid'].md5($_POST[$_POST['field']]));
		$goodKey=($key==md5($CURUSER['uid'].$kocsfig['kocs_cfg_key']));
	} else $goodKey=true;
} else $goodKey=false;

# code
if ($goodKey) {
	switch ($_GET['ktab']) {
		case 'help':
			include $ADMIN_PATH.'admin.kocs.help.php';
			break;
		case 'config':
			include $ADMIN_PATH.'admin.kocs.config.php';
			break;
		case 'restore':
			include $ADMIN_PATH.'admin.kocs.restore.php';
			break;
		case 'backup':
		default:
			include $ADMIN_PATH.'admin.kocs.backup.php';
			break;
	}
} else {
	# template
	$kocsTabTemplate='admin.kocs.badkey.tpl';
	# block tabs
	$_TABS=array();
	# block browsers from remembering
	$kocs['FIELD']='key'.time();
}

# Uninstalled Hack?
if (!$kocs_db) {
	# get hack id
	$hack_info=do_sqlquery('SELECT id FROM `'.$TABLE_PREFIX.'hacks` WHERE `title` = "KOCS - Khez Optimized Config System" LIMIT 1;');
	$hack_info=$hack_info->fetch_assoc();
	# show db error template
	$kocsTabTemplate='hack.nodb.tpl';
	# block tabs and messages
	$_TABS=array();
	$_MSG=array();
}

# template vars
$admintpl->set('language',$language);
$admintpl->set('script',$script);
$admintpl->set('key',$key);
$admintpl->set('hack_id',$hack_info['id']);
$admintpl->set('kocs',$kocs);
$admintpl->set('tabs',$_TABS);
$admintpl->set('usetabs',!empty($_TABS),true);
$admintpl->set('msgs',$_MSG);
$admintpl->set('usemsg',!empty($_MSG),true);
?>