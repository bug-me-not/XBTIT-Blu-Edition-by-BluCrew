<!DOCTYPE html>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">	
	<link rel="stylesheet" href="css/grid.css" type="text/css" media="screen">
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
	<link rel="stylesheet" href="css/loader.css" type="text/css" media="screen">
</head>
</html>

	
<?php
##########################################################################
$password = "admin";  // Modify Password to suit your needs, Max 10 Char.
##########################################################################

if (isset($_POST["password"]) && ($_POST["password"]=="$password")) {
?>
		
<html>		
<body>
	
	<div><br/></div>
	<div id="loader">
		<div id="css-load-contain">
			<div class="css-load-wrap" id="css-load-wrap1">
				<div class="css-load-ball" id="css-load-ball1"></div>
			</div>

			<div class="css-load-wrap" id="css-load-wrap2">
				<div class="css-load-ball" id="css-load-ball2"></div>
			</div>
	
			<div class="css-load-wrap" id="css-load-wrap3">
				<div class="css-load-ball" id="css-load-ball3"></div>
			</div>
	
			<div class="css-load-wrap" id="css-load-wrap4">
				<div class="css-load-ball" id="css-load-ball4"></div>
			</div>
		</div>
	</div>
	<div id="main-content" style="visibility:hidden">
				
		<div class="container" style="max-width:1200px">
	
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mrb-20" >
				<a href="server_dashboard.php"><div class="server_heading">SERVER DASHBOARD</div></a>
			</div>
					
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mrb-20">
				<div class="table" style="margin-top:0">
					<div class="header red">
						<div class="cell">Network Activity</div>
						<div class="cell"></div>
					</div>
				</div>
				
				
				<div id="chart_network" style="width:100%; height:auto;  min-height:300px"></div>
			</div>
			
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mrb-20">
				<div class="table" style="margin-top:0">
					<div class="header blue">
						<div class="cell">Server Load Averages</div>
						<div class="cell"></div>
					</div>
				</div>
				<div id="chart_load" style="width:100%; height:auto;  min-height:300px"></div>
			</div>
			
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mrb-20">
				<div class="table" style="margin-top:0">
					<div class="header green">
						<div class="cell">CPU Averages</div>
						<div class="cell"></div>
					</div>
				</div>
				<div id="chart_cpu" style="width:100%; height:auto; min-height:300px"></div>
			</div>
			
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mrb-20">
				<div  style="background:white">
					<div class="table" style="margin-top:0;">
						<div class="header yellow">
							<div class="cell">Disk read / write requests - Past Hour</div>
							<div class="cell"></div>
						</div>
						<div class="header" style="background:white">
							<div class="cell">&nbsp;</div>
							<div class="cell"></div>
						</div>
					
					</div>
					<div id="chart_disk" style="width:90%; height:auto;  min-height:268px; margin-left:5%; margin-right:5%"></div>
				</div>
			</div>
			
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mrb-20">
				<div class="table" style="margin-top:0">
					<div class="header dark">
						<div class="cell">Disk read / write data - Past Week</div>
						<div class="cell"></div>
					</div>
				</div>
				<div id="chart_disk_weekly" style="width:100%; height:auto; min-height:320px"></div>
			</div>
				
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mrb-20">
				<div class="table" style="margin-top:0">
					<div class="header purple">
						<div class="cell">Disk read / write data - Past Month</div>
						<div class="cell"></div>
					</div>
				</div>
				<div id="chart_disk_monthly" style="width:100%; height:auto;  min-height:320px"></div>
			</div>
			
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mrb-20">
				<div class="table" style="margin-top:0">
					<div class="header gray">
						<div class="cell">CPU Usage- Past Week</div>
						<div class="cell"></div>
					</div>
				</div>
				<div id="chart_cpu_weekly" style="width:100%; height:auto;  min-height:300px"></div>
			</div>
				
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mrb-20">
				<div class="table" style="margin-top:0">
					<div class="header brown">
						<div class="cell">Ram Usage - Past Week</div>
						<div class="cell"></div>
					</div>
				</div>
				<div id="chart_ram_weekly" style="width:100%; height:300px"></div>
			</div>
			
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mrb-20">
				<div class="table" style="margin-top:0">
					<div class="header jeans-blue">
						<div class="cell">Server Locations</div>
						<div class="cell"></div>
					</div>
				</div>
				<div id="chart_server_location" style="width:100%; height:300px"></div>
			</div>
				
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mrb-20">
				<div class="table" style="margin-top:0">
					<div class="header surf-green">
						<div class="cell">System Resources</div>
						<div class="cell"></div>
					</div>
				</div>
				<div id="chart_cpu_pie" style="width:100%; height:auto;  min-height:300px"></div>
			</div>
			
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mrb-20">
				<div class="table" style="margin-top:0">
					<div class="header yellow">
						<div class="cell">System Resources</div>
						<div class="cell"></div>
					</div>
				</div>
				<div id="chart_ram_pie" style="width:100%; height:auto;  min-height:300px"></div>
			</div>
			
	
			<div class="row"></div>	
			<br/><br/><br/>

			<div style="text-align:center; color:white">Server Dashboard 2015</div>	
	
			<div class="row"></div>		
			<br/>
							
		</div> <!--//container-->
	</div> <!--//main-content-->
		<!--jQuery-->
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<!--Google Charts API-->
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
		<!--Charts -->	
		<script src="js/charts.js" type="text/javascript" charset="utf-8" id="script_dir"></script>
		<script>
	
		</script>
	</body>
	</html>
	



<?php
}
else { // Wrong password or no password entered displays this message
	if (isset($_POST['password']) || $password == "") {
		print '<p style="color:red; text-align: center"><b>Incorrect Password</b></p>';
	}
	print '<form method="post"><p style="color:white; text-align: center">Please enter your password<br>';
	print '<input name="password" type="password" size="25" maxlength="10"><input value="Login" type="submit"></p></form>';
}

?>