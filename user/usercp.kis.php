<?php
##############################################################################
# KIS Hack - UCP Page
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

# KOCS
require load_language('lang_kocs.php');
require 'include/kocs.php';
# Khez
require load_language('lang_khez.php');
require 'include/khez.php';
# KIS
global $kisfig;
if (!isset($kisfig)) {
	$kisfig=get_khez_config('SELECT `key`,`value` FROM `'.$TABLE_PREFIX.'khez_configs` WHERE `key` LIKE "kis_%" LIMIT 7;',$reload_cfg_interval);
	require(load_language('lang_kis.php'));
	require 'include/kis.php';
}
# Test Database
$res=do_sqlquery('SHOW TABLES LIKE "'.$TABLE_PREFIX.'kis_users";');
$kis_db=mysql_fetch_array($res, MYSQL_NUM);
$kis_db=(bool)$kis_db[0];
mysql_free_result($res);

# inits
$_MSG=array();
$_TABS=array();
$uname=$CURUSER['username'];
$script=$BASEURL.'/index.php?page=usercp&amp;do=kis&amp;action=read&uid='.$uid.'&amp;';

# tabs
$_TABS[]=array('ktab=view', $language['KIS_UCP_VIEW']);
$_TABS[]=array('ktab=invite', $language['KIS_UCP_INVITE']);
$_TABS[]=array('ktab=help', $language['KHEZ_HELP']);

# code
if ($kisfig && $kisfig['kis_enabled']) {
	switch ($_GET['ktab']) {
		case 'help':
			include $USER_PATH.'/kis/ucp.help.php';
			break;
		case 'invite':
			include $USER_PATH.'/kis/ucp.invite.php';
			break;
		case 'view':
		default:
			include $USER_PATH.'/kis/ucp.view.php';
			break;
	}
} else {
	$_TABS=array();
	$_MSG=array();
	$kisTabTemplate='hack.disabled.tpl';
	$script=$language['KIS_DISABLED'];
}

# template vars
$usercptpl->set('language',$language);
$usercptpl->set('script',$script);
$usercptpl->set('kis',$kis);
$usercptpl->set('tabs',$_TABS);
$usercptpl->set('usetabs',!empty($_TABS),true);
$usercptpl->set('msgs',$_MSG);
$usercptpl->set('usemsg',!empty($_MSG),true);
?>