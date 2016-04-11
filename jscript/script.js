$(function(){
	
	// Checking for CSS 3D transformation support
	$.support.css3d = supportsCSS3D();
	
	var formContainer = $('#formContainer');
	
	// Listening for clicks on the ribbon links
	$('.flipLink').click(function(e){
		
		// Flipping the forms
		formContainer.toggleClass('flipped');
		
		// If there is no CSS3 3D support, simply
		// hide the login form (exposing the recover one)
		if(!$.support.css3d){
			$('#login').toggle();
		}
		e.preventDefault();
	});
	
	//formContainer.find('form').submit(function(e){
		// Preventing form submissions. If you implement
		// a backend, you might want to remove this code
	//	e.preventDefault();
	//});
	
	// A helper function that checks for the 
	// support of the 3D CSS3 transformations.
	function supportsCSS3D() {
		var props = [
		'perspectiveProperty', 'WebkitPerspective', 'MozPerspective'
		], testDom = document.createElement('a');

		for(var i=0; i<props.length; i++){
			if(props[i] in testDom.style){
				return true;
			}
		}
		
		return false;
	}

	$(document).ready(function(){
		if($(".shake").is(":visible"))
		{
			formContainer.delay(750).effect("shake");
			
			$('#errormes').delay(2000).dialog({
				autoOpen: true,
				//modal: true,
				resizable: false,
				dialogClass: "alert",
				height: 225,
				width: 350,
				buttons: {
					Ok: function() {
						$( this ).dialog( "close" );
					}
				},
				show: {
					effect: "slideDown",
					duration: 1000
				},
				hide: {
					effect: "explode",
					duration: 1000
				}
			});
			//var errordiv = $("#errormes");
			//var errormess = errordiv.text();
			//if(errordiv.is(":hidden") && errormess.length>0){ }
		}
	});
});

function login_control()
{
	if (document.getElementById('loginEmail').value.length==0)
	{
		document.getElementById('loginEmail').focus();
		return false;
	}

	if (document.getElementById('loginPass').value == "")
	{
		document.getElementById('loginPass').focus();
		return false;
	}

	return true;
}