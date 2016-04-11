<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html<tag:main_rtl /> xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title><tag:main_title /></title>
  <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
  <META HTTP-EQUIV="Expires" CONTENT="-1">
  <if:seo_enabled>
  <tag:cano />
  <tag:meta />
  <tag:analytic />
  <tag:ggwebmaster />
  </if:seo_enabled>

  <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
  <meta http-equiv="content-type" content="text/html; charset=<tag:main_charset />" />
  <meta http-equiv="cache-control" content="no-cache" />
  <link rel="stylesheet" href="style/BluRG_Dark_v4/main.css" type="text/css" />
  <link rel="stylesheet" href="style/BluRG_Dark_v3/google-plus-ui-buttons/css/css3-buttons.css" type="text/css" media="screen">
  <link rel="stylesheet" href="style/BluRG_Dark_v3/google-plus-ui-buttons/tiptip.css" type="text/css"  media="screen">

<script type="text/javascript" src="style/BluRG_Dark_v3/scripts/jquery/1.8.0/jquery.min.js"></script>
<script type="text/javascript" src="style/BluRG_Dark_v3/scripts/wallet/pay-now-button.js"></script>

<script src="style/BluRG_Dark_v3/scripts/jquery.min.js"></script>
<script src="style/BluRG_Dark_v3/google-plus-ui-buttons/jquery.tiptip.js"></script>
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
<script>
	$(document).ready(function() {
		// Launch TipTip tooltip
		$('.tiptip a.button, .tiptip button').tipTip();
	});
</script>
  <tag:more_css />
    <tag:main_jscript />
<if:IS_DISPLAYED_1>
<!--[if lte IE 7]>
<style type="text/css">
#menu ul {display:inline;}
</style>
<![endif]-->
</if:IS_DISPLAYED_1>
<if:balloons_enabled>
  <script type="text/javascript" src="./jscript/overlib.js"></script>
  
  <link href="modules/video_player/src/video-js.css" rel="stylesheet">
<script src="modules/video_player/src/video.js"></script>
<style type="text/css">
  .vjs-default-skin { color: #dcc4c4; }
  .vjs-default-skin .vjs-play-progress,
  .vjs-default-skin .vjs-volume-level { background-color: #28a3e6 }
  .vjs-default-skin .vjs-control-bar,
  .vjs-default-skin .vjs-big-play-button { background: rgba(0,0,0,0.7) }
  .vjs-default-skin .vjs-slider { background: rgba(0,0,0,0.2333333333333333) }
  .vjs-default-skin .vjs-control-bar { font-size: 100% }
</style>
  </head>
  <div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>
<else:balloons_enabled>
  </head>
</if:balloons_enabled>
<body>

<div id="main">

    <div id="header">
      <table width="1300px" align="center" cellpadding="0" cellspacing="0" border="0">
        <tr>
          <td valign="top" width="5" rowspan="2"></td>
          <td valign="top"><tag:main_header /></td>
          <td valign="top" width="5" rowspan="2"></td>
        </tr>
      </table>
  </div>




<if:IS_DISPLAYED_2>
  <div id="logo">
    <table width="1300px" align="center" cellpadding="0" cellspacing="0" border="0">
      <tr>
        <td class="tracker_logo" align="center" valign="top"></td>
      </tr>
    </table></div>

    <table width='1300px' align='center' cellpadding='0' cellspacing='0' border='0'>
      <div id='adarea'>
        <tr>
          <td valign='top' width='5' rowspan='2'></td>
          <td valign='top' style='text-align:center;'><tag:main_adarea /></td>
          <td valign='top' width='5' rowspan='2'></td>
        </tr>
      </div>
    </table>

    <TABLE align="center" cellpadding="0" cellspacing="0" border="0">
      <TR>
        <TD valign="top">  
    <div id="dropdown">
      <tag:main_dropdown />
	  </br>
   </div></TD>
       </TR>
    </TABLE>
	  <TABLE align="center" width="1300px" cellpadding="0" cellspacing="0" border="0">
      <TR>
        <TD valign="top">


  <script type="text/javascript">
    var collapse2=new animatedcollapse("header", 800, false, "block")
  </script>
  <div id="bodyarea" style="padding:2px 0 0 0;">  
    <table border="0" align="center" cellpadding="0" cellspacing="0" width="100%">
      <tr>
        <td valign="top" width="5" rowspan="2"></td>
        <if:HAS_LEFT_COL>
        <td id="col" valign="top" width="200"><tag:main_left /></td>
        <td valign="top" width="5" rowspan="2"></td>
        </if:HAS_LEFT_COL>
        <td id="mcol" valign="top"><tag:main_content /></td>
        <if:HAS_RIGHT_COL>
        <td valign="top" width="5" rowspan="2"></td>
        <td id="col" valign="top" width="200"><tag:main_right /></td>
        </if:HAS_RIGHT_COL>
        <td valign="top" width="5" rowspan="2"></td>
      </tr>
    </table>
    <br />      
    <table align="center" width="100%" cellpadding="0" cellspacing="0" border="0">
      <tr>
        <td valign="top" width="5" rowspan="2"></td>
        <td id="mcol" valign="top"><tag:main_footer /></td>
        <td valign="top" width="5" rowspan="2"></td>
      </tr>
    </table>
        <br />
  </div>
    </TD>
      </TR>
    </TABLE>
  <div id="footer">
       <table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
         <tr>
  <td align="center" valign="bottom"><br /><br /><br /><br /><br /><tag:style_copyright />&nbsp;<tag:xbtit_version /><br />
         <tag:xbtit_debug /></td>
        </tr><tr>
                <td class="footer" align="center" valign="bottom"></td>
        </tr>
             </table>
     </div><br />
<else:IS_DISPLAYED_2>
    <div id="bodyarea" style="padding: 1ex 0ex 0ex 0ex;">  
	
  <script type="text/javascript">
var q=jQuery.noConflict();
    q(document).ready(function(){ 
q('#ann').load('ann.php?ignoreMe=' + new Date().getTime()).fadeIn("slow");
    });  
</script>
<div id="ann"></div> 
	
<table border="0" align="center" cellpadding="0" cellspacing="0" width="100%">
    <tr>
<td valign="top" width="5" style="background: url(images/blank.gif);" rowspan="2"></td>
    <td valign="top"><tag:main_content /></td>
<td valign="top" width="5" style="background: url(images/blank.gif);" rowspan="2"></td>
      </tr>
    </table>
      </div>
	  </if:IS_DISPLAYED_2>
</div>
<if:anon_enabled>
  <script src="<tag:protected />/jscript/anon.js" type="text/javascript"></script>
  <script type="text/javascript"><!--
  protected_links = "<tag:protected />";
  auto_anonymize();
  //--></script>
</if:anon_enabled>
</body>
</html>
