

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
<!-- #CSS Links -->
<!-- Basic Styles -->
      <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.css">
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
<!-- Basic Styles -->

<!-- #GOOGLE FONT -->
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,300,600,700,900" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:400,200,300,700" rel="stylesheet" type="text/css">
<!-- #GOOGLE FONT -->

<!-- Custom CSS -->
<link rel='stylesheet' href='css/hover.css' type='text/css' />
<link rel='stylesheet' href='css/pulseglow.css' type='text/css' />
<link rel="stylesheet" href="css/SideNav.css" type='text/css'/>
<link rel="stylesheet" href="font-awesome-4.5-2.0/css/font-awesome.min.css" type='text/css'>
<!-- jasny-bootstrap -->
<link href="assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet">
<!-- bootstrap-switch -->
<link href="assets/plugins/bootstrap-switch/css/bootstrap-switch.css" rel="stylesheet">
<!-- bootstrap-multiselect -->
<link href="assets/plugins/bootstrap-multiselect-master/css/bootstrap-multiselect.css" rel="stylesheet">
<link href="assets/plugins/bootstrap-multiselect-master/css/prettify.css" rel="stylesheet">
<!-- alertify Dialogs -->
<link rel="stylesheet" href="assets/plugins/alertify/css/alertify.core.css" />
<link rel="stylesheet" href="assets/plugins/alertify/css/alertify.default.css" id="toggleCSS" />
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="assets/plugins/fuelux/css/fuelux.min.css" />
<!-- Data Slider -->
<link rel="stylesheet" href="assets/plugins/slider/css/slider.css">
<!-- bootstrap-datetimepicker -->
<link rel="stylesheet" href="assets/plugins/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.css">
<link rel="stylesheet" href="assets/plugins/bootstrap-daterangepicker-master/css/daterangepicker-bs3.css">
<tag:more_css />
<!-- Custom CSS -->

<!-- JavaScript -->
<tag:main_jscript />
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
 <script>

 var Bs = jQuery.noConflict();

var themes = {
    "Dark": "assets/bootstrap/css/bootstrap.css",
    "Light" : "assets/bootstrap/css/bootstrap1.css",
    "Light V2" : "assets/bootstrap/css/bootstrap2.css"

}
Bs(function(){
   var themesheet = Bs('<link href="'+themes['Dark']+'" rel="stylesheet" />');
    themesheet.appendTo('head');
    Bs('.theme-link').click(function(){
       var themeurl = themes[Bs(this).attr('data-theme')]; 
        themesheet.attr('href',themeurl);
    });
});
</script>
<!-- JavaScript -->

<if:IS_DISPLAYED_1>
<!--[if lte IE 7]>
<style type='text/css'>
#menu ul {display:inline;}
</style>
<![endif]-->
</if:IS_DISPLAYED_1>

<if:balloons_enabled>
<script type="text/javascript" src="jscript/overlib.js"></script>
</if:balloons_enabled>

<!-- Christmas Snowstorm 
<script src="jscript/snowstorm.js" type="text/javascript"></script>
<script>snowStorm.excludeMobile = false;</script>
Christmas Snowstorm End-->
</head>
<body>

<!-- Top Navigation Start-->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
<div class="container-fluid">
<!-- Brand and toggle get grouped for better mobile display -->
<div class="navbar-header">
         <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
         <span class="sr-only">Toggle navigation</span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         </button>
         </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav navbar-left">
    <tag:main_dropdown />
    </ul>
 <form action="index.php" method="get" name="torrent_search" class="navbar-form navbar-right">
  <input type="hidden" name="page" value="torrents" />

      <td><input
      onfocus="if (this.value == 'Torrents') this.value='';"
   onblur="if(this.value == '') this.value='Torrents';"
      type="text" name="search" class="search" size="30" maxlength="50" value="Torrents" /></td>
</form>

    </div></nav>


<!-- SideNav  -->
<div id='snav' class='en'>
  <ul>
    <li>
      <a href='index.php'>
        <i class="fa fa-home"></i>
        <span>Home</span>
      </a>
    </li>
        <li>
      <a href='index.php?page=modules&module=getrss'>
        <i class="fa fa-rss"></i>
        <span>RSS</span>
      </a>
    </li>
     <li>
      <a href='index.php?page=modules&amp;module=covers'>
        <i class="fa fa-photo"></i>
        <span>Artwork Section</span>
      </a>
    </li>
     <li>
      <a href='index.php?page=extra-stats&type=users'>
        <i class="fa fa-pie-chart"></i>
        <span>Extra Stats</span>
      </a>
    </li>
    <li>
      <a href='index.php?page=flush'>
        <i class="fa fa-refresh"></i>
        <span>Flush Ghost Peers</span>
      </a>
    </li> 
    <li>
      <a href='index.php?page=friendlist'>
        <i class="fa fa-users"></i>
        <span>Friends List</span>
      </a>
    </li>
    <li>
      <a href='index.php?page=notepad'>
        <i class="fa fa-book"></i>
        <span>Notepad</span>
      </a>
    </li>
    <li>
      <a href='index.php?page=bookmark&amp;uid=<tag:uid />'>
        <i class="fa fa-bookmark"></i>
        <span>Bookmarks</span>
      </a>
    </li>
    <li>
      <a href='index.php?page=usercp&amp;uid=<tag:uid />'>
        <i class="fa fa-gear"></i>
        <span>UserCP</span>
      </a>
    </li>
    <li>
      <a href='index.php?page=usercp&amp;uid=<tag:uid />&amp;do=pm&amp;action=list'>
        <i class="fa fa-envelope"></i>
        <span>Mailbox</span>
      </a>
    </li>
    <li>
      <a href='index.php?page=modules&amp;module=helpdesk'>
        <i class="fa fa-question-circle"></i>
        <span>Helpdesk</span>
      </a>
    </li>
    <li>
      <a href='index.php?page=rules'>
        <i class="fa fa-file-text-o"></i>
        <span>Rules</span>
      </a>
    </li>
     <li>
      <a href='index.php?page=faq'>
        <i class="fa fa-info"></i>
        <span>FAQ</span>
      </a>
    </li>
     <li>
      <a href='https://www.gofundme.com/k4e9zyz8?utm_medium=wdgt'>
        <i class="fa fa-usd"></i>
        <span>Donate</span>
      </a>
    </li>
     <li>
      <a href='logout.php'>
        <i class="fa fa-sign-out"></i>
        <span>Logout</span>
      </a>
    </li>
  </ul>
</div>

   <div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>
   <if:IS_DISPLAYED_2>
   <div id='main_body_wrap'>
 
    <!--Spacer-->
    </br>
    </br>
    </br>

    <!-- MainUser Info Bar Start -->
    <table border='0' align='center' cellpadding='0' cellspacing='0' width='95%'>
    <tr>
    <td><tag:main_header /></td>
    </tr>
    </table>

    <!-- Site Alerts -->
    <center><div class="page-header">
    <h1>Site Alerts:<small> Ratio Free Enabled | Bootstrap {LESS} Enabled</small>
    </h1></div></center>

<!--Main Page Content -->

    <table border='0' align='center' cellpadding='0' cellspacing='0' width='auto'>
      <tr>
        <td valign='top' width='5' rowspan='2'></td>
        <if:HAS_LEFT_COL>
          <td valign='top' width='225'><tag:main_left /></td>
        <td valign='top' width='30' rowspan='2'></td>
        </if:HAS_LEFT_COL>
        
      <td valign='top'>
      <table align='center' width='auto' cellpadding='0' cellspacing='0' border='0'>
        <tr>
          <td valign='top'><tag:main_content /></td>
        </tr>
      </table></td>
      
        <if:HAS_RIGHT_COL>
        <td valign='top' width='30' rowspan='2'></td>
          <td valign='top' width='225'><tag:main_right /></td>
        </if:HAS_RIGHT_COL>
        <td valign='top' width='5' rowspan='2'></td>
      </tr>
    </table>

<!-- Bottom Blocks -->
    <table border='0' align='center' cellpadding='0' cellspacing='0' width='95%'>
    <tr>
    <td><tag:main_footer /></td>
    </tr>
    </table>

<!-- Footer -->
        <footer>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
            <div class="panel panel-primary">
   <div class="panel-heading">
      <h3 class="panel-title"></h3>
   </div>
   <div class="panel-body">
      <p class="text-success">Copyright &copy; 2016 XBTIT Blu Edition by BluCrew</p>
          <p><tag:xbtit_debug /></p>
   </div>
</div>
                </div>
            </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->
      </body>
      </html>
