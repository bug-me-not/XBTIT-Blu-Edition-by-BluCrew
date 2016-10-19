<?php
/**
 * Ron Burgundy
 * Installer
 *
 * @author      BizLogic <hire@bizlogicdev.com>
 * @copyright   2013 - 2014 BizLogic
 * @link        http://bizlogicdev.com
 * @link        http://rbrgvnd.com
 *
 * @since       Thursday, December 12, 2013 / 18:04 GMT+1
 * @edited      $Date: 2013-12-25 15:56:01 -0700 (Wed, 25 Dec 2013) $
 * @version     $Id: index.php 5 2013-12-25 22:56:01Z dev@cloneui.com $
 *
 * @package     Ron Burgundy
 * @category    Installer
*/

require_once('includes/config.php');
if( file_exists( 'install.lock' ) ) {
	$smarty->assign( 'errors', array('This application is already installed') );	
	$smarty->display('html/error/error.tpl');	
	exit;	
}

if( !empty( $_POST ) ) {
	if( isset( $_POST['sessionUpdate'] ) ) {
		if( strlen( @$_POST['theme'] ) ) {
			$_SESSION['theme'] = $_POST['theme'];
			exit( '$_SESSION[\'theme\'] set to: '.$_SESSION['theme'] );
		}
	}
	
	if( isset( $_POST['ajax'] ) ) {
		if( (int)$_POST['ajax'] == 1 ) {			
			$method = @$_POST['method'];
			switch( $method ) {
				case 'adminCred':
					header('Content-Type: application/json');
					$json = array();
										
					$_SESSION['adminUsername'] = $_POST['adminUsername'];
					$_SESSION['adminPassword'] = $_POST['adminPassword'];
					$_SESSION['adminEmail']    = $_POST['adminEmail'];
					
					$json['status'] = 'OK';						
					exit( json_encode( $json ) );
										
					break;
					
				case 'dbCheck':
					header('Content-Type: application/json');
					$json = array();
														
					$result = checkDbConnection(
					    $_POST['dbHost'],  
						$_POST['dbUsername'], 
						$_POST['dbPassword'], 
						$_POST['dbName'],
						$_POST['dbPort']												
					);

					if( (int)$result != 1 ) {
						$json['status'] = 'ERROR';
						$json['error']	= $result;
					} else {
						$_SESSION['dbHost']		= $_POST['dbHost'];
						$_SESSION['dbUsername']	= $_POST['dbUsername'];
						$_SESSION['dbPassword']	= $_POST['dbPassword'];
						$_SESSION['dbName']		= $_POST['dbName'];
						$_SESSION['dbPort']		= $_POST['dbPort'];
						
						$_SESSION['mysqli'] = new mysqli(
						    $_POST['dbHost'], 
                            $_POST['dbUsername'], 
                            $_POST['dbPassword'], 
                            $_POST['dbName'], 
                            $_POST['dbPort'] 
						);
												
						$json['status'] = 'OK';											
					}
					
					exit( json_encode( $json ) );					
										
					break;

				case 'bigdump':	
					header('Content-Type: application/json');
					$json = array();										
					$step = $_POST['step'];
					
					switch( $step ) {
						case 1:	
							$mysqli = $_SESSION['mysqli'];
							$tables = $mysqli->query("SHOW TABLES");
							
							echo $tables->num_rows;
							exit;
																			
							if ( !$mysqli->query("DROP DATABASE `".mysqli_real_escape_string( $_SESSION['dbName'] )."`" ) ) {
								$json['status'] = 'ERROR';
								$json['result'] = 'Truncation of database:  '.$_SESSION['dbName'].' failed. <br>';
								$json['result'] .= $mysqli->errno .' '.$mysqli->error;								
							} else {
								$json['status'] = 'OK';
								$json['result'] = 'Truncated database:  '.$_SESSION['dbName'];								
							}
														
							break;	
							
						default:
							$json['status'] = 'ERROR';							
							$json['result'] = 'Unhandled exception';
					}
					
					exit( json_encode( $json ) );					
										
					break;					
			}
			
			exit;												
		}		
	}	
}

if( isset( $_COOKIE['theme'] ) AND strlen( @$_COOKIE['theme'] ) ) {
    $themes = array(
        'absolution',
        'aristo',
        'black-tie',
        'blitzer',
        'cupertino',
        'dark-hive',
        'delta',
        'dot-luv',
        'eggplant',
        'excite-bike',
        'flick',
        'hot-sneaks',
        'humanity',
        'le-frog',
        'mint-choc',
        'overcast',
        'pepper-grinder',
        'redmond',
        'selene',
        'smoothness',
        'south-street',
        'start',   
        'sunny',
        'swanky-purse',
        'trontastic',
        'ui-lightness',
        'ui-darkness',
        'vader',
    );
    
    if( !in_array( strtolower( $_COOKIE['theme'] ), $themes ) ) {
        $_SESSION['theme'] = DEFAULT_JQUERY_UI_THEME;
    } else {
        $_SESSION['theme'] = $_COOKIE['theme'];
    }
	
} else {
	setcookie( 'theme', DEFAULT_JQUERY_UI_THEME );
	$_SESSION['theme'] = DEFAULT_JQUERY_UI_THEME;
}

$_SESSION['themeString'] = jQueryUIStringToTemplateName( $_SESSION['theme'] );
$permissionErrors = checkFolderPermissions();
$smarty->assign('permissionErrors', $permissionErrors);
$smarty->display('html/index.tpl');