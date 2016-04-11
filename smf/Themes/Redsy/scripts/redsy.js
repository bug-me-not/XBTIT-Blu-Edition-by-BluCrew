	$(document).ready(function(){
		$(".dropdown").hover(            
			function() {
				$(".dropdown-menu", this).stop( true, true ).fadeIn("fast");
				$(this).toggleClass("open");
				$("b", this).toggleClass("caret caret-up");                
			},
			function() {
				$(".dropdown-menu", this).stop( true, true ).fadeOut("fast");
				$(this).toggleClass("open");
				$("b", this).toggleClass("caret caret-up");                
		});
		$(".scroll-to-top").click(function()	{
			$("html, body").animate({ scrollTop: 0 }, 600);
			 return false;
		});
		$(window).scroll(function(){
				
			 var position = $(window).scrollTop();
			
			 if(position >= 200)	{
				$(".scroll-to-top").addClass("active")
			 }
			 else	{
				$(".scroll-to-top").removeClass("active")
			 }
		});
		$( ".navbar-toggle").click(function(){
			$("#menu").addClass("show-menu");
		});
	}); 