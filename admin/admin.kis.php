<?php
##############################################################################
# KIS Hack - ACP Page
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

# KHEZ
require load_language('lang_khez.php');
require $THIS_BASEPATH.'/include/khez.php';
# KIS
if (!isset($kisfig)) {
	$kisfig=get_khez_config('SELECT `key`,`value` FROM `'.$TABLE_PREFIX.'khez_configs` WHERE `key` LIKE "kis_%" LIMIT 7;', 0);
	require load_language('lang_kis.php');
	require $THIS_BASEPATH.'/include/kis.php';
}

# test database
$res=do_sqlquery('SHOW TABLES LIKE "'.$TABLE_PREFIX.'kis_sent";');
$kis_db=$res->fetch_array();
$kis_db=(bool)$kis_db[0];
$res->free();

# inits
$hack_info['id']=0;
$config=false;
$uid=$CURUSER['uid'];
$uname=$CURUSER['username'];
$_MSG=array();
$_TABS=array();
$script=$BASEURL.'/index.php?page=admin&amp;user='.$uid.'&amp;code='.$CURUSER['random'].'&amp;do=kis&amp;';

# tabs
$_TABS[]=array('ktab=config', $language['KHEZ_CONFIG']);
$_TABS[]=array('ktab=award', $language['KIS_TAB_AWARD']);
$_TABS[]=array('ktab=users', $language['KIS_TAB_USERS']);
$_TABS[]=array('ktab=invites', $language['KIS_TAB_INVITES']);
$_TABS[]=array('ktab=stats', $language['KHEZ_STATS']);
$_TABS[]=array('ktab=help', $language['KHEZ_FAQ']);

# code
if ($kis_db) {
	switch ($_GET['ktab']) {
		case 'help':
			require $ADMIN_PATH.'/admin.kis.help.php';
			break;
		case 'award':
			require $ADMIN_PATH.'/admin.kis.award.php';
			break;
		case 'users':
			require $ADMIN_PATH.'/admin.kis.users.php';
			break;
		case 'invites':
			require $ADMIN_PATH.'/admin.kis.invites.php';
			break;
		case 'stats':
			require $ADMIN_PATH.'/admin.kis.stats.php';
			break;
		case 'config':
		default:
			require $ADMIN_PATH.'/admin.kis.config.php';
			break;
	}
} # if db

# Uninstalled Hack?
if (!$kis_db) {
	# get hack id
	$hack_info=do_sqlquery('SELECT id FROM `'.$TABLE_PREFIX.'hacks` WHERE `title` = "KIS - Khez Invite System" LIMIT 1;');
	$hack_info=$hack_info->fetch_assoc();
	# show db error template
	$kisTabTemplate='hack.nodb.tpl';
	# block tabs and messages
	$_TABS=array();
	$_MSG=array();
}

# template vars
$admintpl->set('language',$language);
$admintpl->set('script',$script);
$admintpl->set('hack_id',$hack_info['id']);
$admintpl->set('kis',$kis);
$admintpl->set('tabs',$_TABS);
$admintpl->set('usetabs',!empty($_TABS),true);
$admintpl->set('msgs',$_MSG);
$admintpl->set('usemsg',!empty($_MSG),true);
?>