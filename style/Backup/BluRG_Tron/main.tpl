<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html<tag:main_rtl /> xmlns="http://www.w3.org/1999/xhtml">
<head>
   <title><tag:main_title /></title>

   <if:seo_enabled>
   <tag:cano />
   <tag:meta />
   <tag:analytic />
   <tag:ggwebmaster />
</if:seo_enabled>

<link href="favicon.ico" rel="shortcut icon" type="image/x-icon" />
<meta http-equiv="content-type" content="text/html; charset=<tag:main_charset />" />
<!-- CSS -->
<link rel='stylesheet' href='<tag:main_css />' type='text/css' />
<tag:more_css />
<!-- CSS -->

<!-- JavaScript -->
<tag:main_jscript />
<!-- JavaScript -->

<script type="text/javascript">
animatedcollapse.addDiv('header', 'fade=1,speed=1000,persist=1,hide=0');
//animatedcollapse.addDiv('bottom_menu', 'fade=1,speed=1000,persist=1,hide=0')
animatedcollapse.addDiv('recommended','fade=1,speed=1000,persist=1,hide=0');
//persist(1) uses a cookie to remember the toggled block either opened or closed and will remain in that state across your pages
//grouped like in the example below causes if you click to open one the other block(s) close
//examples of other traits  'fade=1,speed=1000,group=blocks,persist=1,hide=1')
animatedcollapse.ontoggle=function($, divobj, state){ //fires each time a DIV is expanded/contracted
   //$: Access to jQuery
   //divobj: DOM reference to DIV being expanded/ collapsed. Use "divobj.id" to get its ID
   //state: "block" or "none", depending on state which is also (hide, 0 or 1) = (0)=("block" is opened) (1)=("none" is closed)
   //alert("1) DIV ID: " + divobj.id + "\n2) Current State: "+state)
};
animatedcollapse.init();
</script>

<if:HAS_MT>
<script type="text/javascript" src="jscript/pm.js"></script>
<script>
var ss=jQuery.noConflict();
ss(document).ready(function() {
   //Get the screen height and width
   var maskHeight = ss(document).height();
   var maskWidth = ss(window).width();
   //Set heigth and width to mask to fill up the whole screen
   ss('#mask').css({'width':maskWidth,'height':maskHeight});
   //transition effect
   setTimeout(function() {
      ss('#mask').fadeIn(1000);
      ss('#mask').fadeTo("slow",0.8);
   }, 80000);
   //if mask is clicked
   ss('#mask').click(function () {
      ss(this).hide();
   });
});
</script>
</if:HAS_MT>
<if:IS_DISPLAYED_1>
<!--[if lte IE 7]>
<style type="text/css">
#menu ul {display:inline;}
</style>
<![endif]-->
</if:IS_DISPLAYED_1>

<link href="modules/video_player/src/video-js.css" rel="stylesheet">
<script src="modules/video_player/src/video.js"></script>

<!-- Christmas Snowstorm 
<script src="/jscript/snowstorm.js"></script>
<script>snowStorm.excludeMobile = false;</script>
Christmas Snowstorm End-->

</head>
<body>
   <if:HAS_MTT>
   <div id="mask"></div>
</if:HAS_MTT>
<tag:season />
<div id="main">
   <if:IS_DISPLAYED_2>
   <table width="100%" height="170" align="center" cellpadding="0" cellspacing="0" border="0">
      <tr>
         <td class="logo1"></td>
      </tr>
   </table>

   <if:HAS_AT>
   <br /> <center>  <tag:advertop /> </center>
</if:HAS_AT>

<table width='100%' align='center' cellpadding='0' cellspacing='0' border='0'>
   <tr>
      <td valign='top' width='5' rowspan='2'></td>
      <td valign="top" ><tag:main_adarea /></td>
      <td valign='top' width='5' rowspan='2'></td>
   </tr>
</table>

<TABLE align="center" cellpadding="0" cellspacing="0" border="0">
   <TR>
      <TD valign="top">
         <div id="dropdown">
            <tag:main_dropdown />
         </div></TD>
      </TR>
   </TABLE>
   <br />
   <TABLE align="center" width="100%" cellpadding="0" cellspacing="0" border="0">
      <TR>
         <TD valign="top">
            <div id="slideIt"><if:guestt><tag:main_slideIt />
               <div class="slide_spacer"></div></if:guestt>
               <div id="header">
                  <table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
                     <tr>
                        <td valign="top" width="5" rowspan="2"></td>
                        <td valign="top"><tag:main_header /></td>
                        <td valign="top" width="5" rowspan="2"></td>
                     </tr>
                  </table>
               </div>
            </div>

            <div id="bodyarea" style="padding:4ex 0 0 0;">
               <script type="text/javascript">
               var q=jQuery.noConflict();
               q(document).ready(function(){
                  q('#ann').load('ann.php?ignoreMe=' + new Date().getTime()).fadeIn("slow");
                     });
                </script>
               <div id="ann"></div>
               <div id='surround'>
               <table border="0" align="center" cellpadding="0" cellspacing="0" width="100%">
                  <tr>
                     <td valign="top" width="3" rowspan="2"></td>
                     <if:HAS_LEFT_COL>
                     <if:HAS_LEFT>
                     <td id="lcol" valign="top" width="200"><tag:main_left /></td>
                     <td valign="top" width="15" rowspan="2"></td>
                  </if:HAS_LEFT_COL>
               </if:HAS_LEFT>
               <td id="mcol" valign="top"><tag:main_content /></td>
               <if:HAS_RIGHT_COL>
               <if:HAS_RIGHT>
               <td valign="top" width="15" rowspan="2"></td>
               <td id="rcol" valign="top" width="200"><tag:main_right /></td>
            </if:HAS_RIGHT_COL>
         </if:HAS_RIGHT>
         <td valign="top" width="3" rowspan="2"></td>
      </tr>
   </table><br>
   <if:HAS_AB>
   <center> <tag:adverbottom /> </center> <br />
</if:HAS_AB>
<table align="center" width="100%" cellpadding="0" cellspacing="0" border="0">
   <tr>
      <td valign="top" width="9" rowspan="2"></td>
      <if:guesttt> <div id="slideIt2"><tag:main_slideIt2 /></if:guesttt>
         <td id="fcol" valign="top"><div id='bottom_menu'><tag:main_footer /><tag:news_text /></td>
         </div> <td valign="top" width="10" rowspan="2"></td>
      </tr>
   </table><tag:topf />
</tr>
</table>

<table width="100%" height="46" align="center" cellpadding="0" cellspacing="0" border="0" >
   <tr>
      <td align="center" valign="middle"><tag:style_copyright />&nbsp;<tag:xbtit_version /><br />
         <tag:xbtit_debug /></td>
      </tr>
   </table>

</div>
<else:IS_DISPLAYED_2>
<div id="bodyarea" style="padding: 1ex 0ex 0ex 0ex;">
   <table border="0" align="center" cellpadding="0" cellspacing="0" width="100%">
      <tr>
         <td valign="top" width="5" style="background: url(images/blank.gif);" rowspan="2"></td>
         <td valign="top"><tag:main_content /></td>
         <td valign="top" width="5" style="background: url(images/blank.gif);" rowspan="2"></td>
      </tr>
   </table>
</div>
</if:IS_DISPLAYED_2>
<if:anon>
<script src="<tag:protected />/jscript/anon.js" type="text/javascript"></script>
<script type="text/javascript"><!--
protected_links = "<tag:protected />";
auto_anonymize();
//--></script>
</if:anon>
</body>
</html>
