$(document).ready(function() {
	$('body').imagesLoaded( function() {
		$.unblockUI();
	});
	
	$.imgpreload([
	    DEFAULT_PRELOADER_IMAGE,
	    BASEURL + '/img/loading.gif'
	    ], {
	    each: function() {
	        // this = dom image object
	        // check for success with: $(this).data('loaded')
	        // callback executes on every image load
	    },
	    all: function() {
	        // this = array of dom image objects
	        // check for success with: $(this[i]).data('loaded')
	        // callback executes when all images are loaded				    		    			            
	    }
	});
	
	$('.button-finish').click(function() {
		bootbox.dialog({
			message: 'Please <strong>delete the install</strong> directory located @ ' + BASEDIR,
			title: '<i class="fa fa-check"></i> Installation Complete',
			buttons: {
				main: {
					label: 'OK',
					className: 'btn-primary',
					callback: function() {
						$.blockUI();
						window.location.assign( BASEURL );
					}
				}
			}
		});	
	});
	
	WIZARD = $('#installWizard').bootstrapWizard({
		'tabClass': 'bwizard-steps', 
		'nextSelector': '.button-next', 
		'previousSelector': '.button-previous',
		'onInit': function(tab, navigation, index) {
			$('#installWizard').fadeIn();	
			$.unblockUI();
		},
		'onNext': function(tab, navigation, index) {			
			var currentIndex = $('#installWizard').bootstrapWizard('currentIndex');
			if( currentIndex > 0 ) {
				if( !$('#frmInstaller').valid() ) {
					removeFromArray(GOOD_STEPS, currentIndex);					
					bootbox.dialog({
						message: 'Please rectify the unresolved errors',
						title: '<i class="fa fa-exclamation-triangle"></i> Installation ERROR',
						buttons: {
							main: {
								label: 'OK',
								className: 'btn-primary',
								callback: function() {
									// ...
								}
							}
						}
					});	
					
					return false;
				} else {
					switch( currentIndex ) {
						case 1:
							$.ajax({
								type: 'POST',
								url: BASEURL + '/',
								data: {	
									ajax: 1, 
									method: 'adminCred',
									adminUsername: trim( $('#adminUsername').val() ),
									adminPassword: sha1( trim( $('#adminPassword').val() ) ),
									adminEmail: trim( $('#adminEmail').val() ) 
								},
								complete: function( jqXHR, textStatus ) {
									// ...
								},
								success: function( response, textStatus, jqXHRresponse ) {
									// ...
								},
								error: function( jqXHR, textStatus, errorThrown ) {
									// ...
								},		
								dataType: 'json'
							});
							
							if( !in_array( currentIndex, GOOD_STEPS ) ) {
								GOOD_STEPS.push( currentIndex );									
							}							
							
							break;
							
						case 2:
							// START:	DB Check							
							$.blockUI();
							$.ajax({
								type: 'POST',
								url: BASEURL + '/',
								data: {	
									ajax: 1, 
									method: 'dbCheck',
									dbHost: $('#dbHost').val(),
									dbPort: $('#dbPort').val(),
									dbName: $('#dbName').val(),
									dbUsername: $('#dbUsername').val(),
									dbPassword: $('#dbPassword').val()
								},
								complete: function( jqXHR, textStatus ) {
									$.unblockUI();								
								},
								success: function( response, textStatus, jqXHRresponse ) {
									if( response.status == 'OK' ) {
										$('#dbErrorMessage').fadeOut();
										$('#dbSuccessMessage').html('<i class="fa fa-check"></i> Database connection established. Click \'Next\' to proceed.').fadeIn();
										$('.pager').find('.button-next').val('Next');
										DB_ERROR = false;										
									} else {
										$('#dbSuccessMessage').fadeOut();										
										$('#dbErrorMessage').html( '<i class="fa fa-exclamation-triangle"></i> ' + response.error ).fadeIn();
										DB_ERROR = true;								
									}
								},
								error: function( jqXHR, textStatus, errorThrown ) {
									DB_ERROR = true;
								},		
								dataType: 'json'
							});
																									
							if( DB_ERROR ) {
								removeFromArray(currentIndex, GOOD_STEPS);
								return false;
							} else {
								DB_ERROR = false;								
								if( !in_array( currentIndex, GOOD_STEPS ) ) {
									GOOD_STEPS.push( currentIndex );
								}
								
								$('.pager').find('.button-next').val('Next');
							}
							
							break;
							// END:		DB Check							
							
						case 3:
							if( !DATA_IMPORTED ) {								
								$('#installWizard').find('.button-next').addClass('disabled');								
								$('#dataImportStatus').fadeIn();
								$('#bigdumpContainer').attr('src', BASEURL + '/bigdump.php?start=1&foffset=0&totalqueries=0&fn='+urlencode( INSTALL_SQL ) );
								
								return false;
							}
							
							if( !in_array( currentIndex, GOOD_STEPS ) ) {
								GOOD_STEPS.push( currentIndex );									
							}
							
							break;
							
						default:
							if( !in_array( currentIndex, GOOD_STEPS ) ) {
								GOOD_STEPS.push( currentIndex );									
							}							
					}									
				}
			} else {				
				if( !in_array( currentIndex, GOOD_STEPS ) ) {
					bootbox.dialog({
						message: 'Please resolve the errors presented on this page',
						title: '<i class="fa fa-exclamation-triangle"></i> Installation ERROR',
						buttons: {
							main: {
								label: 'OK',
								className: 'btn-primary',
								callback: function() {
									// ...
								}
							}
						}
					});	
					
					return false;
				}
			}						
		},
		'onTabShow': function(tab, navigation, index) {	
			if( index > 0 ) {
				var currentIndex = $('#installWizard').bootstrapWizard('currentIndex');				
				if( !in_array( parseInt(currentIndex - 1), GOOD_STEPS ) ) {					
					bootbox.dialog({
						message: 'All installation steps must be followed sequentially',
						title: '<i class="fa fa-exclamation-triangle"></i> ERROR',
						buttons: {
							main: {
								label: 'OK',
								className: 'btn-primary',
								callback: function() {
									// ...
								}
							}
						}
					});	
					
					$('#installWizard').bootstrapWizard('show', max( GOOD_STEPS ) );
					return false;
				}
			}
			
			TAB_INDEX	= index;
			var total	= navigation.find('li').length;
			var current	= index + 1;
			var percent	= ( current / total ) * 100;
			
			$('#installWizard').find('.progress-bar').css({ width: percent + '%' });
			
			if( index == total ) {
				if( !in_array( index, GOOD_STEPS ) ) {
					GOOD_STEPS.push( index );					
				}	
			}

			// if it's the last tab then hide the last button and show the finish instead
			if( current >= total ) {				
				var complete = $('#btnWizard-next').data('complete');
				if( complete == 1 ) {
					DATA_IMPORTED = true;
					$('#btnWizard-next').val('Finish');		
				} else {
					DATA_IMPORTED = false;
					$('#btnWizard-next').val('Import Data').removeClass('disabled');								
				}					
				/*$('#installWizard').find('.button-next').hide();
				$('#installWizard').find('.button-finish').show();
				$('#installWizard').find('.button-finish').removeClass('disabled'); */
			} else if( current == 3 ) {
				if( DB_ERROR ) {
					$('#installWizard').find('.button-next').val('Check DB Connection');					
				} else {
					$('#installWizard').find('.button-next').val('Next');					
				}				
			} else {
				$('#installWizard').find('.button-next').val('Next');				
				$('#installWizard').find('.button-next').show();
				$('#installWizard').find('.button-finish').hide();
			}
		},		
		'onTabClick': function(tab, navigation, index) {
			var total	= navigation.find('li').length;
			var current	= index + 1;
			
			if( current != total ) {
				if( !in_array( index, GOOD_STEPS ) ) {
					bootbox.dialog({
						message: 'Please resolve the errors presented on this page',
						title: '<i class="fa fa-exclamation-triangle"></i> Installation ERROR',
						buttons: {
							main: {
								label: 'OK',
								className: 'btn-primary',
								callback: function() {
									// ...
								}
							}
						}
					});	
					
					return false;				
				}				
			}
		}		
	});	
					
	$('#switcher').themeswitcher({ 
    	loadTheme: strtolower( CURRENT_THEME ), 
    	cookieExpires: 3650, 
    	cookiePath: '/',		   
    	cookieName: 'theme', 
    	cookieOnSet: function( cookieName, cookieValue ) {
    		$.post( 
    		    BASEURL + '/', { 
    		    	sessionUpdate: true, 
    		    	theme: cookieValue 
    		    },
    		    function( data ) {
    		    	// ...						
				}
			);					
	    },
    	onSelect: function() {
    		blockUIWithMessage( '', '', 1500 );
    		reloadPage();		    			
    	},
    	onSelectComplete: function() {		     
    		// ...	
    	}
	});	    	

	$('.btnPageRefresh').click(function() {
		$.blockUI();
		window.location.reload();
	});	
	
	$('#frmInstaller').validate({ 
		rules: {
			adminPassword: { 
				required: true,
				adminUsernameAdminPasswordNotEqual: '#adminUsername'
			},
			adminPasswordConfirm: {
				required: true,
				equalTo: '#adminPassword'
			},
			adminEmail: { 
				required: true,
				email: true
			},
			adminEmailConfirm: {
				required: true,
				equalTo: '#adminEmail',
				email: true
			}
		}
	});
});