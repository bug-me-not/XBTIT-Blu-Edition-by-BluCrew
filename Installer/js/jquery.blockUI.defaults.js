$(document).ready(function() {				
	$.blockUI.defaults.message = '<img border="0" src="'+ DEFAULT_PRELOADER_IMAGE + '">';				
	$.blockUI.defaults.css = { 
        padding: 0,
        margin: 0,
        width: '30%',
        top: '40%',
        left: '35%',
        textAlign: 'center',
        cursor: 'wait'
    };

	$.blockUI.defaults.overlayCSS = { 
		backgroundColor: '#FFFFFF', 
		opacity:         0.6, 
		cursor:          'wait'
	};
});