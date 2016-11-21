$(document).ready(function(){

  $('#kcdmenu > ul > li:has(ul)').addClass("has-sub");

  $('#kcdmenu > ul > li > a').click(function() {
    var checkElement = $(this).next();
    
    $('#kcdmenu li').removeClass('active');
    $(this).closest('li').addClass('active');	
    
    
    if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
      $(this).closest('li').removeClass('active');
      checkElement.slideUp('normal');
    }
    
    if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
      $('#kcdmenu ul ul:visible').slideUp('normal');
      checkElement.slideDown('normal');
    }
    
    if (checkElement.is('ul')) {
      return false;
    } else {
      return true;	
    }		
  });

});