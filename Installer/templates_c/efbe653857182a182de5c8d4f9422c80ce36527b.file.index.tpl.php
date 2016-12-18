<?php /* Smarty version Smarty-3.1.15, created on 2016-12-15 17:04:45
         compiled from "/home/Blu-Edition/Installer/templates/default/html/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20844269115852cd2d403e75-94992122%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'efbe653857182a182de5c8d4f9422c80ce36527b' => 
    array (
      0 => '/home/Blu-Edition/Installer/templates/default/html/index.tpl',
      1 => 1480444469,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20844269115852cd2d403e75-94992122',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'permissionErrors' => 0,
    'error' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_5852cd2d551a89_39016815',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5852cd2d551a89_39016815')) {function content_5852cd2d551a89_39016815($_smarty_tpl) {?><?php if (!is_callable('smarty_function_math')) include '/home/Blu-Edition/Installer/includes/classes/Smarty/plugins/function.math.php';
?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="CONTENT-TYPE" content="text/html; charset=utf-8"/>
	<meta http-equiv="CONTENT-LANGUAGE" content="EN"/>				
	<meta http-equiv="Cache-Control" content="no-cache/"/>
	<meta http-equiv="Pragma" content="no-cache"/>
	<meta http-equiv="Expires" content="-1"/>
	<meta name="robots" content="noindex, nofollow">
		
	<title><?php echo @constant('APP_NAME');?>
 &mdash; Blu-Edition Installer</title>
			
	<script type="text/javascript">
		var BASEURL					= '<?php echo @constant('BASEURL');?>
';
		var BASEDIR					= '<?php echo @constant('BASEDIR');?>
';
		var DEBUG					= true;
		var DEFAULT_PRELOADER_IMAGE = '<?php echo @constant('DEFAULT_PRELOADER_IMAGE');?>
';
		var CURRENT_THEME 			= '<?php echo $_SESSION['theme'];?>
';
		var GOOD_STEPS				= new Array();
		var TAB_INDEX				= null;
		var DB_ERROR				= true;
		var DATA_WARN				= false;
		var DATA_IMPORTED			= false;
		var INSTALL_SQL				= '<?php echo @constant('DATABASE_SQL_FILEPATH');?>
';
		var WIZARD					= null;
		
		<?php if (!strlen($_SESSION['theme'])) {?>
			CURRENT_THEME = '<?php echo @constant('DEFAULT_JQUERY_UI_THEME');?>
';
		<?php }?>		
	</script>	
	    
    <!-- php.js -->
	<script src="<?php echo @constant('BASEURL');?>
/js/phpjs.js" type="text/javascript"></script>
		
	<link rel="stylesheet" href="<?php echo @constant('BASEURL');?>
/css/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.19/themes/base/jquery-ui.css">		
	<link rel="stylesheet" href="<?php echo @constant('BASEURL');?>
/css/custom.css?<?php echo smarty_function_math(array('equation'=>'rand()'),$_smarty_tpl);?>
">	
	<link href="<?php echo @constant('BASEURL');?>
/css/font-awesome.min.css" rel="stylesheet">	
	
	<?php switch (mb_strtolower($_SESSION['theme'], 'UTF-8')){?>
<?php case "absolution":?>
		<?php case "aristo":?>
		<?php case "delta":?>
		<?php case "selene":?>
			<link rel="stylesheet" href="<?php echo @constant('BASEURL');?>
/css/jquery-ui/<?php echo $_SESSION['themeString'];?>
/jquery-ui.css">
		<?php break;?>

		<?php default:?>
			<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.19/themes/<?php echo $_SESSION['themeString'];?>
/jquery-ui.css">
	<?php }?>
	
	<script src="<?php echo @constant('BASEURL');?>
/js/jquery-1.7.2.min.js" type="text/javascript"></script>
    <script src="<?php echo @constant('BASEURL');?>
/js/jquery-ui-1.8.19.custom.min.js" type="text/javascript"></script>
    <script src="<?php echo @constant('BASEURL');?>
/js/jquery-validation/jquery.validate.min.js" type="text/javascript"></script>
	<script src="<?php echo @constant('BASEURL');?>
/js/jquery-validation/custom-methods.js?<?php echo smarty_function_math(array('equation'=>'rand()'),$_smarty_tpl);?>
" type="text/javascript"></script>    
      
	<script type="text/javascript" src="<?php echo @constant('BASEURL');?>
/js/jquery.imgpreload.min.js"></script>
	<script type="text/javascript" src="<?php echo @constant('BASEURL');?>
/js/imagesloaded.pkgd.min.js"></script>    
    
    <script src="<?php echo @constant('BASEURL');?>
/js/jquery.observor.js?<?php echo smarty_function_math(array('equation'=>'rand()'),$_smarty_tpl);?>
" type="text/javascript"></script>        
    <script src="<?php echo @constant('BASEURL');?>
/js/consolelog.min.js" type="text/javascript"></script>
    
    <!--  blockUI -->
    <script src="<?php echo @constant('BASEURL');?>
/js/jquery.blockUI.js" type="text/javascript"></script>
    <script src="<?php echo @constant('BASEURL');?>
/js/jquery.blockUI.defaults.js" type="text/javascript"></script>
    
    <!--  custom functions -->
    <script src="<?php echo @constant('BASEURL');?>
/js/functions.js?<?php echo smarty_function_math(array('equation'=>'rand()'),$_smarty_tpl);?>
"></script>
    
    <!-- jQuery UI Themeswitcher -->
	<script src="<?php echo @constant('BASEURL');?>
/js/themeswitcher.js?<?php echo smarty_function_math(array('equation'=>'rand()'),$_smarty_tpl);?>
" type="text/javascript"></script>
	
    <script src="<?php echo @constant('BASEURL');?>
/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo @constant('BASEURL');?>
/js/bootbox.min.js" type="text/javascript"></script>
	<script src="<?php echo @constant('BASEURL');?>
/js/jquery.bootstrap.wizard.js" type="text/javascript"></script>		
</head>
<body>	
	<div class="center">
		<div id="logo">
			<a href="<?php echo @constant('BASEURL');?>
">
				<i style="font-size: x-large;" class="fa fa-plug" alt="<?php echo @constant('APP_NAME');?>
 Installer" title="<?php echo @constant('APP_NAME');?>
 Installer"></i>
			</a>
		</div>
		<div id="installWizard">
			<form name="frmInstaller" id="frmInstaller" action="" method="POST">			
				<ul>
					<li>
						<a href="#permissions" data-toggle="tab">
							<span class="label">1</span> File Permissions
						</a>
					</li>
					<li>
						<a href="#adminCredentials" data-toggle="tab">
							<span class="label">2</span> Admin Credentials
						</a>
					</li>
					<li>
						<a href="#dbConnection" data-toggle="tab">
							<span class="label">3</span> Database Connection
						</a>
					</li>
					<li>
						<a id="linkDataImport" href="#dataImport" data-toggle="tab">
							<span class="label">3</span> Data Import
						</a>
					</li>
				</ul>	
				<div class="progress progress-striped active">
					<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="">
						<span class="sr-only"></span>
					</div>
				</div>							
				<div class="tab-content">
					<div class="tab-pane" id="permissions">	
						<?php if (count($_smarty_tpl->tpl_vars['permissionErrors']->value)>0) {?>
							<script type="text/javascript">
								removeFromArray(GOOD_STEPS, 0);						
							</script> 									
							<div class="alert alert-danger">
								<i class="btnPageRefresh fa fa-refresh" style="float: right;"></i>
								<i class="fa fa-exclamation-triangle"></i> Please CHMOD the following files or directories to 0777
							</div>											
							<ol>
							<?php  $_smarty_tpl->tpl_vars['error'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['error']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['permissionErrors']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['error']->key => $_smarty_tpl->tpl_vars['error']->value) {
$_smarty_tpl->tpl_vars['error']->_loop = true;
?>
							    <li><i style="color: #A94442;" class="fa fa-exclamation-triangle"></i> <?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</li>
							<?php } ?>
						<?php } else { ?>
							<div class="alert alert-success">
								<i class="fa fa-check"></i> File permissions are OK
								<script type="text/javascript">
									if( !in_array( GOOD_STEPS ) ) {
										GOOD_STEPS.push(0);									
									}					
								</script> 								
							</div>							
						<?php }?>
						</ol>
					</div>
					<div class="tab-pane" id="adminCredentials">
						<table style="width: 100%;" cellpadding="10">
							<tr>
								<td class="frmLabel">
									Administrator's Username:
								</td>
								<td>
									<input type="text" value="" id="adminUsername" name="adminUsername" data-name="Administrator Username" required>								
								</td>								
							</tr>
                            <tr>
                                <td class="frmLabel">
                                    Administrator's e-mail:
                                </td>
                                <td>
                                    <input type="text" value="" id="adminEmail" name="adminEmail" required>                               
                                </td>                               
                            </tr>
                            <tr>
                                <td class="frmLabel">
                                    Confirm Administrator's e-mail:
                                </td>
                                <td>
                                    <input type="text" value="" id="adminEmailConfirm" name="adminEmailConfirm" required>                         
                                </td>                               
                            </tr>												
							<tr>
								<td class="frmLabel">
									Administrator's Password:
								</td>
								<td>
									<input type="password" value="" id="adminPassword" name="adminPassword" required>								
								</td>								
							</tr>
							<tr>
								<td class="frmLabel">
									Confirm Administrator's Password:
								</td>
								<td>
									<input type="password" value="" id="adminPasswordConfirm" name="adminPasswordConfirm" required>							
								</td>								
							</tr>													
						</table>					
					</div>
					<div class="tab-pane" id="dbConnection">
						<div class="alert alert-danger" id="dbErrorMessage"></div>
						<div class="alert alert-success" id="dbSuccessMessage"></div>
						
						<table style="width: 100%;" cellpadding="10">
							<tr>
								<td class="frmLabel">
									Database Hostname:
								</td>
								<td>
									<input type="text" value="localhost" id="dbHost" name="dbHost" required>								
								</td>								
							</tr>
							<tr>
								<td class="frmLabel">
									Database Port:
								</td>
								<td>
									<input type="text" value="3306" id="dbPort" name="dbPort" required>								
								</td>								
							</tr>							
							<tr>
								<td class="frmLabel">
									Database Name:
								</td>
								<td>
									<input type="text" value="" id="dbName" name="dbName" required>							
								</td>								
							</tr>
							<tr>
								<td class="frmLabel">
									Database Username:
								</td>
								<td>
									<input type="text" value="" id="dbUsername" name="dbUsername" required>							
								</td>								
							</tr>																					
							<tr>
								<td class="frmLabel">
									Database Password:
								</td>
								<td>
									<input type="password" value="" id="dbPassword" name="dbPassword">								
								</td>								
							</tr>											
						</table>
					</div>
					<div class="tab-pane" id="dataImport">
						<table style="width: 100%;" cellpadding="10">
							<tr>
								<td>				
									<div id="dataImportStatus">
										<iframe src="" id="bigdumpContainer" frameBorder="0"></iframe>									
									</div>
								</td>
							</tr>
							<tr>			
								<td>
									<input type="checkbox" value="0" id="dataLossWarn" name="dataLossWarn" required> I accept all responsibility for any data loss that may occur during this installation								
								</td>								
							</tr>
						</table>					
					</div>					
					<div class="pager">
						<div style="float: right;">
							<input type="button" id="btnWizard-next" class="btnPager btn button-next" name="next" value="Next" data-complete="0" />
							<input type="button" id="btnWizard-prev" class="disabled btnPager btn button-finish" name="finish" value="Finish" />
						</div>
						<div style="float: left;">
							<input type="button" class="btnPager btn button-previous" name="previous" value="Previous" />
						</div>
					</div>
				</div>	
			</form>				
		</div>
		
		<div id="switcher" style="margin-top: 10px; margin-left: 0px; position: fixed;"></div>		
	</div>

	<!--  START:	blockUI on page load -->
	<div style="display: none;" class="blockUI"></div>
	<div style="z-index: 1000; position: fixed;" class="blockUI blockOverlay ui-widget-overlay"></div>
	<div style="z-index: 1011; position: fixed; width: 30%; top: 40%; left: 35%;" class="blockUI blockMsg blockPage ui-dialog ui-widget ui-corner-all ui-widget-content ui-draggable">
		<div class="ui-widget-header ui-dialog-titlebar ui-corner-all blockTitle">Loading</div>
		<div class="ui-widget-content ui-dialog-content">
			<p>Loading, please wait... <img border="0" src="<?php echo @constant('BASEURL');?>
/img/loading.gif"></p>
		</div>
	</div>
	<!--  END:		blockUI on page load -->

	</body>
</html><?php }} ?>
