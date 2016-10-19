/**
 * Ron Burgundy
 * Various JavaScript Functions
 *
 * @author      BizLogic <hire@bizlogicdev.com>
 * @license     Commercial
 * @link        http://bizlogicdev.com
 * @link		http://rbrgvnd.com
 *
 * @since       Wednesday, April 25, 2012 / 01:47 AM GMT+1 mknox
 * @edited      $Date: 2013-12-25 16:54:14 -0700 (Wed, 25 Dec 2013) $ $Author: dev@cloneui.com $
 * @version     $Revision: 6 $
 *
 * @package     Ron Burgundy
 * @category	Installer
*/

$('#logo').live('click', 
		function() {
			blockUIWithMessage( 'Loading...', 'Loading, please wait...' );	
			window.location = BASEURL; 
		}
);

function blockUIWithMessage( title, message, timeout )
{ 	
	title	= ( typeof title !== 'undefined' && strlen( title ) ) ? title : 'Loading...';
	message = ( typeof message !== 'undefined' && strlen( message ) ) ? message : 'Loading, please wait...';
	timeout	= ( typeof timeout !== 'undefined' && is_numeric( timeout ) ) ? timeout : 0;
	
	if( timeout > 0 ) {		
		$.blockUI({ 
			theme:		true, 
			title:    	title, 
			message:	message + '&nbsp;&nbsp;<img style="vertical-align: middle;" src="'+ BASEURL +'/img/loading.gif" border="0">',
			timeout:	timeout
		});	
	} else {
		$.blockUI({ 
			theme:		true, 
			title:    	title, 
			message:	message + '&nbsp;&nbsp;<img style="vertical-align: middle;" src="'+ BASEURL +'/img/loading.gif" border="0">'			
		});	
	}
}

function reloadPage()
{
	window.location.reload();
}