<?php
/**
 * Ron Burgundy
 * Installer, Global Config
 *
 * @author      BizLogic <hire@bizlogicdev.com>
 * @copyright   2013 - 2014 BizLogic
 * @license		Commercial
 * @link        http://rbrgvnd.com
 * @link        http://bizlogicdev.com
 *
 * @since       Thursday, December 12, 2013 / 18:06 GMT+1
 * @edited      $Date: 2011-11-03 14:59:43 +0100 (Thu, 03 Nov 2011) $
 * @version     $Id: index.php 4898 2011-11-03 13:59:43Z mknox $
 *
 * @package     Ron Burgundy
 * @category    Installer
 */

error_reporting( E_ALL );
ini_set('display_errors', false);
ini_set('error_log', dirname( dirname( __FILE__ ) ).'/logs/'.date('m-d-Y').'-php-errors.log');
define('IN_INSTALL', true);
// 10 years
define('COOKIE_TIMEOUT', 315360000);
define('GARBAGE_TIMEOUT', COOKIE_TIMEOUT);
ini_set('session.gc_maxlifetime', GARBAGE_TIMEOUT);
session_set_cookie_params(COOKIE_TIMEOUT, '/');
// setting session dir
if( !defined( 'IN_PHPUNIT' ) ) {
	$sessdir = '/tmp/'.$_SERVER['HTTP_HOST'];
	// if session dir not exists, create directory
	if ( !is_dir( $sessdir ) ) {
		@mkdir( $sessdir, 0777 );
	}

	// if directory exists, then set session.savepath otherwise let it go as is
	if( is_dir( $sessdir ) ) {
		ini_set( 'session.save_path', $sessdir );
	}
	session_start();	
}

require_once('functions.php');
require_once('constants.php');
require_once('classes/RonBurgundy.php');

// init
$RonBurgundy = new RonBurgundy;

if( isset( $_COOKIE['theme'] ) AND strlen( @$_COOKIE['theme'] ) ) {
	$_SESSION['theme'] = $_COOKIE['theme'];
} else {
	setcookie( 'theme', DEFAULT_JQUERY_UI_THEME );
	$_SESSION['theme'] = DEFAULT_JQUERY_UI_THEME;
}

$_SESSION['themeString'] = jQueryUIStringToTemplateName( $_SESSION['theme'] );

require_once('classes/singleton.class.php');
require_once('classes/Smarty/Smarty.class.php');

$smarty                 = Singleton::getInstance('Smarty');
$smarty->compile_check  = true;
$smarty->cache_dir		= SMARTY_CACHE_DIR;
$smarty->compile_dir	= SMARTY_COMPILE_DIR;
$smarty->debugging      = false;
$smarty->template_dir 	= SMARTY_TEMPLATE_DIR;
$smarty->loadPlugin('smarty_compiler_switch');

$smartyDirs = array( 
    SMARTY_CACHE_DIR, 
    SMARTY_COMPILE_DIR, 
    BASEDIR.'/logs' 
);

// check Smarty setup
$smartyIssues = checkDirPerms( $smartyDirs );

if( !empty( $smartyIssues ) ) {
	echo 'The issues below are preventing the installer from running properly: ';
	echo '<ol>';

	foreach( $smartyIssues AS $key => $value ) {
		echo '<li>Please CHMOD '.$value.' to 0777</li>';
	}

	echo '</ol>';
	echo '<button onclick="window.location.reload();" style="width: 150px; height: 40px;">Reload Page</button>';	

	exit;
}