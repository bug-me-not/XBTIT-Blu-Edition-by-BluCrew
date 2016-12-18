// JavaScript Document

var accordWithPage =  function() {

  var jQ = jQuery.noConflict();
 var faqDiv = jQ('#faq-links div');

 jQ(function () {
  faqDiv.on("click", function()  {
    var hideSec = 'faq-hide';  
    var $this = jQ(this),
    $id = $this.attr('id'),
    $class = '.' + jQ('.about-' + $id).attr('class').replace(hideSec, '');

    jQ('#faq-wrapper').addClass(hideSec);
    jQ('.about-' + $id).removeClass(hideSec);
    jQ('div[class*=about]').not($class).addClass(hideSec);

  });
});

 jQ(function () {
  var select = 'faq-selected';      
  
  faqDiv.click(function () {

    if (jQ(this).hasClass(select)) 
    {
      jQ(this).removeClass(select);
    } 
    else 
    {
      jQ('#faq-links .faq-selected').removeClass(select);
      jQ(this).addClass(select);             
    }
    }); //faq link selected
});



//Accordion

jQ(function () {
  var expand = 'expanded';
  var content = jQ('.faq-content');
        //FAQ Accordion
        jQ('.faq-accordion > li > a').click(function (e) {
          e.preventDefault();
          if (jQ(this).hasClass(expand)) 
          {
            jQ(this).removeClass(expand);
            jQ(this).parent().children('ul').stop(true, true).slideUp();
          } 
          else 
          {
            jQ('.faq-accordion > li > a.expanded').removeClass(expand);
            jQ(this).addClass(expand);
            content.filter(":visible").slideUp();
            jQ(this).parent().children('ul').stop(true, true).slideDown();
            jQ(this).children('div').focus();
          }}); //accordion function
        content.hide();
      }); 
}

jQuery(document).ready(function () {accordWithPage();});

jQuery(function () {
 jQuery("#faq-links div").click(function () {
  jQuery('.slide-left').fadeOut( "slow", "linear" );
  jQuery('.slide-left').fadeIn( "slow", "linear" );
    }); //faq link fade in and out
  }); //document ready