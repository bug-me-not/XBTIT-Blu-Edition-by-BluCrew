<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html<tag:main_rtl /> xmlns='http://www.w3.org/1999/xhtml'>
<head>
  <title><tag:main_title /></title>
	<if:seo_enabled>
  <tag:cano />
  <tag:meta />
  <tag:analytic />
  <tag:ggwebmaster />
  </if:seo_enabled>
  <meta http-equiv='content-type' content='text/html; charset=<tag:main_charset />' />
  <link rel='stylesheet' href='<tag:main_css />' type='text/css' />
  <tag:more_css />
	<tag:main_jscript />
	
<script type="text/javascript">
animatedcollapse.addDiv('header', 'fade=1,speed=1000,persist=1,hide=0')
animatedcollapse.addDiv('bottom_menu', 'fade=1,speed=1000,persist=1,hide=1')
animatedcollapse.ontoggle=function($, divobj, state){ //fires each time a DIV is expanded/contracted
}
animatedcollapse.init()
</script>

<if:IS_DISPLAYED_1>	
<!--[if lte IE 7]>
<style type='text/css'>
#menu ul {display:inline;}
</style>
<![endif]-->
</if:IS_DISPLAYED_1>

<if:aads_enabled>
<script type="text/javascript">
 $(document).ready(function() {
 	 $("#bitcoin_payment_status").load("bitcoin_monitor.php?<tag:bc_extra_params />");
   var refreshId = setInterval(function() {
      $("#bitcoin_payment_status").load("bitcoin_monitor.php?<tag:bc_extra_params />");
   }, 60000);
   $.ajaxSetup({ cache: false });
});
</script>
</if:aads_enabled>

<if:balloons_enabled>
  <script type="text/javascript" src="./jscript/overlib.js"></script>
  </head>
  <div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>
<else:balloons_enabled>
  </head>
</if:balloons_enabled>

</head>
<body>

<if:IS_DISPLAYED_2>
                      
<div id='main_body_wrap'>
                        
<div id='outer_wrap'>
<div id='mid_Container'>
<div id='Logo_Spacer1'></div>
	<div id='Logo'></div>	
<!-- blah blah -->
<div id="slideIt"><tag:main_slideIt />	  
  <div id='top_row'>
		<div id='Logo_Spacer2'></div>				
     <div id='top_row_inner1'>
        <div id='top_row_inner2'>
				 <div class="top_row_spacer"></div>
 				  <div id='header'>
<!-- blah blah -->		
				<div class="wrap_tl">
      <div class="wrap_tr">
    <div class="wrap_tm"></div>
  </div>
   </div>
<!-- blah blah -->	
    <div class="wrap_ml">
      <div class="wrap_mr">
        <div class="wrap_mm">
          <div class="wrap_inner_content">
<tag:main_header />
					    <div class="space"></div>
					    </div>
					  </div>
				 </div>
       </div>
<!-- blah blah -->		
    <div class="wrap_bl">
      <div class="wrap_br">
        <div class="wrap_bm"></div>
      </div>
    </div>
<div style='clear: both;'></div>
	</div>
</div>
 </div>
<!-- blah blah -->
   </div>			
    </div>			

<div id='ader_wrap'>	
  <div id='ader_wrap1'>
    <div id='ader_wrap2'>
		    <div id='adarea'><tag:main_adarea /></div>
      </div>
    </div>
  </div> 
 	
  <div id='top_menu'>
      <div id='top_menu_inner1'>	   
        <div id='top_menu_inner2'>				
        		<div id='Emenu'>
					<div id='extra'><tag:main_extra /></div>
				</div>						                        
			</div>
			<div style='clear: both;'></div>
    </div>
   </div>
	 <div class="top_menu_spacer"></div>
<!-- Start of main bodyarea wrapper -->
  <div class='wrap_tl'>
      <div class='wrap_tr'>
        <div class='wrap_tm'></div>
      </div>
    </div>
    <div class='wrap_ml'>
      <div class='wrap_mr'>
        <div class='wrap_mm'>
          <div class='wrap_inner_content'> 
						<div class="spacer"></div>
<div id='top_margin'></div>
  
 <div id='bodyarea'>
	<div id='surround'>
 
    <table border='0' align='center' cellpadding='0' cellspacing='0' width='100%'>
      <tr>
        <td valign='top' width='10' rowspan='2'></td>
				<if:HAS_LEFT_COL>
          <td valign='top' id='scol' width='190'><tag:main_left /></td>
        <td valign='top' width='10' rowspan='2'></td>
				</if:HAS_LEFT_COL>
				
	      <td valign='top'><br />
			<table id='SRRND' align='center' width='100%' cellpadding='0' cellspacing='0' border='0'>
        <tr class='overlay'>
				<td height='20' valign='top'></td>
				</tr>
				<tr>
          <td id='Mcol' valign='top'><tag:main_content /></td>
        </tr>
      </table></td>
			
				<if:HAS_RIGHT_COL>
        <td valign='top' width='10' rowspan='2'></td>
          <td valign='top' id='scol' width='190'><tag:main_right /></td>
				</if:HAS_RIGHT_COL>
        <td valign='top' width='10' rowspan='2'></td>
      </tr>
    </table>

    <br />
	<div id="slideIt2"><tag:main_slideIt2 />
	 <div class="top_row_spacer"></div>      
    <table align='center' width='100%' cellpadding='0' cellspacing='0' border='0'>
      <tr>
        <td valign='top' width='10' rowspan='2'></td>
				<td valign='top'><div id='bottom_menu'>
			<table id='SRRND2' align='center' width='100%' cellpadding='0' cellspacing='0' border='0'>
        <tr class='overlay2'>
				<td height='20' valign='top'></td>
				</tr>
				<tr>
        <td id='Fcol' valign='top'><tag:main_footer /></td>
				</tr>
      </table></div></td>
        <td valign='top' width='10' rowspan='2'></td>
      </tr>
    </table></div>

	 </div> 
	 <div style='clear: both;'></div>
  </div>

    </div>
</div>
    </div>
        </div>
    <div class="wrap_bl">
      <div class="wrap_br">
        <div class="wrap_bm"> </div>
      </div>
    </div>
		<div class="shadowbar"></div>
  </div>
<!-- End of main bodyarea wrapper -->
<!-- end mid_Container -->   
<div class="spacer"></div>
	       <div id='bottom_margin'></div>
             <div id='bottom_row'>
            <div id='bottom_row_inner1'>
        <div id='bottom_row_inner2'>		
      <div id='footer_wrap'>
   <div id='footer_text'><span class="footer"><div class="Fspacer"></div><tag:style_copyright />&nbsp;<tag:xbtit_version /><div class="Fspacer"></div>
         <tag:xbtit_debug /><div class="Fspacer"></div><tag:to_top /></span></div>
				 
        </div>
				 <div style='clear: both;'></div>
        </div>
      </div>
  </div>
 
<else:IS_DISPLAYED_2>
    <div id='bodyarea' style='padding: 1ex 0ex 0ex 0ex;'>  
<table border='0' align='center' cellpadding='0' cellspacing='0' width='100%'>
    <tr>
<td valign='top' width='5' rowspan='2'></td>
    <td valign='top'><tag:main_content /></td>
<td valign='top' width='5' rowspan='2'></td>
      </tr>
    </table>
      </div>
</if:IS_DISPLAYED_2>
</div>
<!-- end outer_wrap -->
<if:anon_enabled>
  <script src="<tag:protected />/jscript/anon.js" type="text/javascript"></script>
  <script type="text/javascript"><!--
  protected_links = "<tag:protected />";
  auto_anonymize();
  //--></script>
</if:anon_enabled>
</div>
</body>
</html>