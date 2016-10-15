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

		<div class="local_time">
			<canvas id="a_local" width="100" height="100"style="background-color:transparent"></canvas>
			<div id="d_local"></div><span>Local time</span>
		</div>

		<div class="server_time">
			<canvas id="a_server" width="100" height="100"style="background-color:transparent"></canvas>
			<div id="d_server"></div><span>Server time</span>
		</div>	
	
		<div class="container" style="max-width:1200px">
	
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
				<div class="server_heading">SERVER DASHBOARD</div>
			</div>
		
			<div class="row_break" style="margin:0">&nbsp;</div>
	
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="progress">
					<div class="progress-bar" role="progressbar" id="server-1_min" aria-valuemin="0" aria-valuemax="100"></div>
				</div>
				<div class="text left">1 Minute</div>
				<div class="text right"><span id="server-load-1_min"></span>%</div>
			</div>
					  
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="progress">
					<div class="progress-bar" role="progressbar" id="server-5_min" aria-valuemin="0" aria-valuemax="100"></div>
				</div>
				<div class="text left">5 Minutes</div>
				<div class="text right"><span id="server-load-5_min"></span>%</div>
			</div>
		
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="progress">
					<div class="progress-bar" role="progressbar" id="server-15_min" aria-valuemin="0" aria-valuemax="100"></div>			
				</div>
				<div class="text left">15 Minutes</div>
				<div class="text right"><span id="server-load-15_min"></span>%</div>
			</div>	 

			<div class="row_break" style="margin-bottom:20px">&nbsp;</div>

			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">	
				<div class="top_push"></div>
				<div class="table" id="system_table" style="margin-top:0">
					<div class="header red">
						<div class="cell">System</div>
						<div class="cell"></div>
					</div>
				</div>
			
				<div class="row"></div>
						
				<div class="table" id="last_login_table">
					<div class="header green">
						<div class="cell">Last login</div>
						<div class="cell"></div>
					</div>
				</div>	
	
				<div class="row"></div>
		
				<div class="table" id="tasks_table">
					<div class="header blue">
						<div class="cell">Tasks</div>
						<div class="cell"></div>
					</div>
				</div>

				<div class="row"></div>
	
				<div class="table" id="memory_table">
					<div class="header dark">
						<div class="cell">Memory</div>
						<div class="cell"></div>
					</div>
				</div>
	
				<div class="row"></div>
		
				<div class="table" id="swap_table">
					<div class="header purple">
						<div class="cell">Swap</div>
						<div class="cell"></div>
					</div>
				</div>
			
				<div class="row"></div>
		
				<div class="table" id="ping_table" style="margin-bottom:30px">
					<div class="header yellow">
						<div class="cell">Ping</div>
						<div class="cell"></div>
					</div>
				</div>
			
				<div class="row"></div>			
			
			</div>
		
		
			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">	
				
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">	
					<div class="top_push"></div>
					<div class="table_canvas_heading">RAM<br/><br/></div>
			
					<div class="table_canvas">	
					
						<canvas id="canvas1" style="z-index: 0; position:absolute;" width="200" height="200"></canvas>
						<canvas id="canvas2" style="z-index: 1; position:absolute;" width="200" height="200"></canvas>
						<div id="per1" style="color:white"></div>
					</div>
			
					<div class="row"></div>
			
					<div class="table_canvas_heading">CPU<br/><br/></div>	
					<div class="table_canvas">				
						<canvas id="canvas3" style="z-index: 0; position:absolute;" width="200" height="200"></canvas>
						<canvas id="canvas4" style="z-index: 1; position:absolute;" width="200" height="200"></canvas>
						<div id="per2" style="color:white"></div>			
					</div>
			
					<div class="row"></div>
				
					<div class="table_canvas_heading">HDD<br/><br/></div>	
					<div class="table_canvas">
						<canvas id="canvas5" style="z-index: 0; position:absolute;" width="200" height="200"></canvas>
						<canvas id="canvas6" style="z-index: 1; position:absolute;" width="200" height="200"></canvas>
						<div id="per3" style="color:white"></div>
					</div>
					<div class="row"></div>	
				</div>
			
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">	
				
				
					<div class="top_push"></div>
					<div class="table" style="margin-top:0">
						<div class="header gray">
							<div class="cell">Server Location</div>
							<div class="cell"></div>
						</div>
					</div>
				
				
					<div id="chart_server_location"></div>
										
					<div class="row_break" style="margin-bottom:20px">&nbsp;</div>
					<a href="server_performance_charts.php">
						<div class="table" style="margin-top:0">
							<div class="header yellow">
								<div class="cell">Click to View Performance Charts</div>
								<div class="cell"></div>
							</div>
						</div>
	
						<div class="panel dashboard-chart default">				
		
							<div class="flot-dashboard-demo-1"></div>
							<div class="dashboard-chart footer">			
								<p>Hourly, Weekly & Monthly Server Performance Charts</p>
							</div>					
						</div>
					</a>
			
					<div class="row"></div>

					<div class="table"  id="services_table">
						<div class="header dark">
							<div class="cell">Status</div>
							<div class="cell">Service</div>
							<div class="cell">Port</div>
						</div>		
					</div>
			
				</div>

				<div class="row"></div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">	
					<div class="table" id="disk_table">
						<div class="header jeans-blue">
							<div class="cell">HDD Mount</div>
							<div class="cell">Used</div>
							<div class="cell">Free</div>
							<div class="cell">Total</div>
						</div>
					</div>
		
					<div class="row"></div>
			
					<div class="table" id="network_table">
						<div class="header surf-green">
							<div class="cell">Network</div>
							<div class="cell">IP</div>
							<div class="cell">Receive</div>
							<div class="cell">Transmit</div>
						</div>
					</div>
		
					<div class="row"></div>
				</div>
			</div>
		
			
			<div class="row"></div>	
			<br/><br/><br/>

			<div style="text-align:center; color:white">Server Dashboard 2015</div>	
	
			<div class="row"></div>		
			<br/>

		</div> <!--container-->
	
	</div> <!--main-content-->
	<!-- jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	
	<!-- Server Script -->
	<script src="js/script.js" type="text/javascript" charset="utf-8" id="script_dir"></script>

	<!-- jQuery Flot -->
	<script src="js/jquery.flot.min.js" type="text/javascript" charset="utf-8"></script>

	<!-- CPU / RAM Demo -->
	<script src="js/flot-realtime.js" type="text/javascript" charset="utf-8"></script>
	
	<!--Google Charts API-->
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	
	
	
	<script> 

	var scriptDir = document.getElementById('script_dir').src.replace("/js/script.js", "");
	$(document).ready(function(){ serverInfo(scriptDir);  setInterval( function() { serverLoadDemo() }, 3000 ); /* Get server load every 3 seconds */	});

	google.load('visualization', '1', {packages: ['corechart']});
	google.setOnLoadCallback(drawChart);

	function drawChart() {
		$.get(scriptDir+"/ajax/server_location.php", { }, function(responseData){
			var jsonData = JSON.parse(responseData);		
			var data_server_location = new google.visualization.DataTable(jsonData.server_location);
			var chart_server_location = new google.visualization.GeoChart(document.getElementById('chart_server_location'));
			var options_server_location = {colorAxis:{colors:['red','#2980b9','gray'], minValue: 0, maxValue:2}, region:'world', legend:'none'};
			chart_server_location.draw(data_server_location,  options_server_location);
		});			
	}
	
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
