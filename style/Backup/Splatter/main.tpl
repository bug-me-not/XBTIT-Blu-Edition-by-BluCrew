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
<link href="favicon.ico" rel="shortcut icon" type="image/x-icon" />

 <!-- #CSS Links -->
    <!-- Basic Styles -->
      <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.css">
      <link rel="stylesheet" type="text/css" href="assets/css/custom.css">
      <link rel="stylesheet" type="text/css" href="assets/font-awesome/css/font-awesome.css">
      <link href="assets/plugins/iCheck-master/skins/all.css?v=1.0.2" rel="stylesheet">
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
    
    <!-- #GOOGLE FONT -->
      <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,300,600,700,900" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:400,200,300,700" rel="stylesheet" type="text/css">
    
<!-- Custom CSS -->
<link rel='stylesheet' href='css/hover.css' type='text/css' />
<link rel='stylesheet' href='css/pulseglow.css' type='text/css' />
<link rel="stylesheet" href="css/SideNav.css" type='text/css'/>
<link rel="stylesheet" href="font-awesome-4.5-2.0/css/font-awesome.min.css" type='text/css'>
<tag:more_css />
<!-- CSS -->

<!-- JavaScript -->
<tag:main_jscript />
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


<!-- SideNav -->
<div id='snav' class='en'>
  <ul>
    <li>
      <a href='#'>
        <i class="fa fa-home"></i>
        <span>Home</span>
      </a>
    </li>
     <li>
      <a href='index.php?page=modules&amp;module=cover'>
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

   <!-- Top Navigation Start-->
    <header class="navbar navbar-inverse navbar-fixed-top navbar-inverse" role="banner"><div class="container"><div class="navbar-header"><button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span> <span class="icon-bar"></span></button><a href="index.php" class="navbar-brand"><h3><font color=##00aeff>Blu-Torrents</font></h3></a></div><nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation"><ul class="nav navbar-nav"><li><a href="index.php">Home</a></li><li><a href="index.php?page=torrents&search=&category=0&uploader=0&options=0&active=0&gold=0">Torrents</a></li><li><a href="index.php?page=modules&module=bluflix&sortby=latest">BluFLIX</a></li><li><a href="index.php?page=upload">Upload</a></li><li><a href="index.php?page=requests">Requests</a></li><li><a href="index.php?page=viewexpected">Upcoming</a></li><li><a href="index.php?page=modules&module=seedhelp">Seedhelp</a></li><li><a href="index.php?page=forum">Forums</a></li></ul></nav></div></header>

    <!--Spacer-->
    <div id='Logo_Spacer1'></div>
    </br>
    </br>
    </br>

    <!-- MainUser Info Bar Start -->
    <div class="container">
    <div class="row">
    <div class="col-md-12">
    <tag:main_header />
    </div>
    </div>
    </div>

<!-- Start of main bodyarea wrapper -->
<!-- Page Content -->
    <div class="container">
<if:IS_DISPLAYED_2>
<!-- Content Row -->
        <div class="row">
<if:HAS_LEFT_COL>   
<!-- Left Blocks -->
<div class="col-md-3">
<tag:main_left />
</div>
</if:HAS_LEFT_COL>
<!-- Center Blocks -->
<!-- if right column is live again make the below col-md8 -->
<div class="col-md-9">
<tag:main_content />
 </div>
 <noscript>
 <!-- Right side is not needed for now as it repeats some of the top and left -->
 <if:HAS_RIGHT_COL>
  <!-- Right Blocks -->
<div class="col-md-2">
<tag:main_right /> 
</div>
</if:HAS_RIGHT_COL>
</noscript>
</div>
<else:IS_DISPLAYED_2>
<tag:main_content />
</if:IS_DISPLAYED_2>
<!-- /.row -->

<!-- Bottom Blocks -->
    <div class="row">
    <div class="col-md-12">
    <tag:main_footer /> 
    </div>
    </div>

<!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
            <div class="panel panel-primary">
   <div class="panel-heading">
      <h3 class="panel-title"></h3>
   </div>
   <div class="panel-body">
      <p>Copyright &copy; 2016 BluCrew <noscript><tag:style_copyright />&nbsp;<tag:xbtit_version /></noscript></p>
          <p><tag:xbtit_debug /></p>
   </div>
</div>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->
      </body>
      </html>
