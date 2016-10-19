<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="CONTENT-TYPE" content="text/html; charset=utf-8"/>
	<meta http-equiv="CONTENT-LANGUAGE" content="EN"/>				
	<meta http-equiv="Cache-Control" content="no-cache/"/>
	<meta http-equiv="Pragma" content="no-cache"/>
	<meta http-equiv="Expires" content="-1"/>
	<meta name="robots" content="noindex, nofollow">
		
	<title>{$smarty.const.APP_NAME} &mdash; Blu-Edition Installer</title>
			
	<script type="text/javascript">
		var BASEURL					= '{$smarty.const.BASEURL}';
		var BASEDIR					= '{$smarty.const.BASEDIR}';
		var DEBUG					= true;
		var DEFAULT_PRELOADER_IMAGE = '{$smarty.const.DEFAULT_PRELOADER_IMAGE}';
		var CURRENT_THEME 			= '{$smarty.session.theme}';
		var GOOD_STEPS				= new Array();
		var TAB_INDEX				= null;
		var DB_ERROR				= true;
		var DATA_WARN				= false;
		var DATA_IMPORTED			= false;
		var INSTALL_SQL				= '{$smarty.const.DATABASE_SQL_FILEPATH}';
		var WIZARD					= null;
		
		{if !strlen( $smarty.session.theme )}
			CURRENT_THEME = '{$smarty.const.DEFAULT_JQUERY_UI_THEME}';
		{/if}		
	</script>	
	    
    <!-- php.js -->
	<script src="{$smarty.const.BASEURL}/js/phpjs.js?{math equation='rand()'}" type="text/javascript"></script>
		
	<link rel="stylesheet" href="{$smarty.const.BASEURL}/css/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.19/themes/base/jquery-ui.css">		
	<link rel="stylesheet" href="{$smarty.const.BASEURL}/css/custom.css?{math equation='rand()'}">	
	<link rel="stylesheet" href="{$smarty.const.BASEURL}/css/font-awesome.min.css">	
	
	{switch $smarty.session.theme|lower}
		{case "absolution"}
		{case "aristo"}
		{case "delta"}
		{case "selene"}
			<link rel="stylesheet" href="{$smarty.const.BASEURL}/css/jquery-ui/{$smarty.session.themeString}/jquery-ui.css">
		{/case}

		{default}
			<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.19/themes/{$smarty.session.themeString}/jquery-ui.css">
	{/switch}
	
	<script src="{$smarty.const.BASEURL}/js/jquery-1.7.2.min.js" type="text/javascript"></script>
    <script src="{$smarty.const.BASEURL}/js/jquery-ui-1.8.19.custom.min.js" type="text/javascript"></script>          
	<script type="text/javascript" src="{$smarty.const.BASEURL}/js/jquery.imgpreload.min.js"></script>
	<script type="text/javascript" src="{$smarty.const.BASEURL}/js/imagesloaded.pkgd.min.js"></script>                
    <script src="{$smarty.const.BASEURL}/js/consolelog.min.js" type="text/javascript"></script>
    
    <!--  blockUI -->
    <script src="{$smarty.const.BASEURL}/js/jquery.blockUI.js" type="text/javascript"></script>
    <script src="{$smarty.const.BASEURL}/js/jquery.blockUI.defaults.js" type="text/javascript"></script>
    
    <!--  custom functions -->
    <script src="{$smarty.const.BASEURL}/js/functions.js?{math equation='rand()'}"></script>
    
    <!-- jQuery UI Themeswitcher -->
	<script src="{$smarty.const.BASEURL}/js/themeswitcher.js?{math equation='rand()'}" type="text/javascript"></script>
	
    <script src="{$smarty.const.BASEURL}/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
    <script src="{$smarty.const.BASEURL}/js/bootbox.min.js" type="text/javascript"></script>	
</head>
<body>	
	<div class="center">
		<div id="logo">
            <a href="{$smarty.const.BASEURL}">
                <i style="font-size: x-large;" class="fa fa-plug" alt="{$smarty.const.APP_NAME} Installer" title="{$smarty.const.APP_NAME} Installer"></i>
            </a>
		</div>

		<div class="alert alert-danger">
			{foreach from=$errors item=errorMessage}
			    <i class="fa fa-exclamation-triangle"></i> {$errorMessage}<br>
			{/foreach}		
		</div>
		
		<div id="switcher" style="margin-top: 10px; margin-left: 0px; position: fixed;"></div>		
	</div>

	<!--  START:	blockUI on page load -->
	<div style="display: none;" class="blockUI"></div>
	<div style="z-index: 1000; position: fixed;" class="blockUI blockOverlay ui-widget-overlay"></div>
	<div style="z-index: 1011; position: fixed; width: 30%; top: 40%; left: 35%;" class="blockUI blockMsg blockPage ui-dialog ui-widget ui-corner-all ui-widget-content ui-draggable">
		<div class="ui-widget-header ui-dialog-titlebar ui-corner-all blockTitle">Loading</div>
		<div class="ui-widget-content ui-dialog-content">
			<p>Loading, please wait...</p>
		</div>
	</div>
	<!--  END:		blockUI on page load -->

		<script type="text/javascript">
			{literal}
			$(document).ready(function() {
				$.unblockUI();
			});
			{/literal}		
		</script>
	</body>
</html>