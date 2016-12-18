google.load('visualization', '1', {packages: ['corechart', 'bar', 'line']});
google.setOnLoadCallback(drawCharts);

function drawCharts() {
	
	var scriptDir = document.getElementById('script_dir').src.replace("/js/charts.js", "");	
	$.get(scriptDir+"/ajax/server_charts.php", { }, function(responseData){
		var jsonData = JSON.parse(responseData);
		// NETWORK //
		var data_network = new google.visualization.DataTable(jsonData.network);
		var chart_network = new google.visualization.LineChart(document.getElementById('chart_network'));
		var options_network = {/*title: 'Network Activity',*/ colors: ['pink', 'magenta', 'red', 'green'],hAxis: {title: 'Server Time', titleTextStyle: {color: 'red'}}};
		chart_network.draw(data_network, options_network);	
		
		// LOAD //
		var data_load = new google.visualization.DataTable(jsonData.load);
		var chart_load = new google.visualization.LineChart(document.getElementById('chart_load'));
		var options_load = {/*title: 'Server Load Averages', */ hAxis: {title: 'Server Time', titleTextStyle: {color: 'red'}}};
		chart_load.draw(data_load, options_load);
		
		// CPU //
		var data_cpu = new google.visualization.DataTable(jsonData.cpu);
		var chart_cpu = new google.visualization.LineChart(document.getElementById('chart_cpu'));
		var options_cpu = {
			/*title: 'CPU Averages', */
			curveType: 'function',
			colors: ['orange', 'green'],
			backgroundColor: { fill: "#FFF" },
			legendTextStyle: { color: 'green' },
			titleTextStyle: { color: 'black' },
			hAxis: {title: 'Server Time', titleTextStyle: {color: 'red'}}
		};
		chart_cpu.draw(data_cpu, options_cpu);		
		
		// DISK - PAST HOUR //
		var data_disk = new google.visualization.DataTable(jsonData.disk);
		var chart_disk = new google.charts.Bar(document.getElementById('chart_disk'));	
		var options_disk = {chart: {/*title: 'Disk read / write requests - Past Hour',*/ textStyle: {color: 'red'}},
		hAxis: {title: 'Total',minValue: 0},vAxis: {title: 'Date'},bars: 'horizontal'};
		chart_disk.draw(data_disk, options_disk);
		
		// DISK - PASK WEEK //
		
		var data_disk_weekly = new google.visualization.DataTable(jsonData.disk_weekly);
		var chart_disk_weekly = new google.visualization.ComboChart(document.getElementById('chart_disk_weekly'));	
		var options_disk_weekly = {
		/*	title : 'Disk read / write data - Past Week', */
			vAxis: {title: 'Avarages'},
			hAxis: {title: 'Date'},
			seriesType: 'bars',
			series: {5: {type: 'line'}}
		};			   
					   
		chart_disk_weekly.draw(data_disk_weekly, options_disk_weekly);	
		
		// DISK - PASK MONTH //
		

		var data_disk_monthly = new google.visualization.DataTable(jsonData.disk_monthly);
		var chart_disk_monthly = new google.visualization.ComboChart(document.getElementById('chart_disk_monthly'));		   
		var options_disk_monthly = {
		/*	title : 'Disk read / write data - Past Month', */
			hAxis: {title: 'Date'},
			seriesType: 'bars',
			series: {5: {type: 'line'}},
			colors: ['#27ae60', 'orange', '#cc3333', 'blue', '#f2c40e', 'grey'],
			isStacked: true
		};			   
					   
		chart_disk_monthly.draw(data_disk_monthly, options_disk_monthly);
		
		
		// CPU PAST WEEK //
		
		var data_cpu_weekly = new google.visualization.DataTable(jsonData.cpu_weekly);
		var chart_cpu_weekly = new google.visualization.LineChart(document.getElementById('chart_cpu_weekly'));	
		var options_cpu_weekly = {chart: {/* title: 'CPU - Past Month' ,*/ textStyle: {color: 'red'}},
		hAxis: {title: 'Total',minValue: 0},vAxis: {title: 'Date'},bars: 'horizontal'};
		chart_cpu_weekly.draw(data_cpu_weekly, options_cpu_weekly);	
		
		
		// RAM PAST WEEK //
		
		var data_ram_weekly = new google.visualization.DataTable(jsonData.ram_weekly);		
		var chart_ram_weekly = new google.visualization.ComboChart(document.getElementById('chart_ram_weekly'));		   
		var options_ram_weekly = {
		/*	title : 'Disk read / write data - Past Month', */
			hAxis: {title: 'Date'},
			seriesType: 'bars',
			series: {1: {type: 'line'}},
			colors: ['#475577', 'red', 'yellow', 'pink', 'green', 'magenta']
		};	
		chart_ram_weekly.draw(data_ram_weekly, options_ram_weekly);	
		
				
		// SERVER LOCATION //
		
		var data_server_location = new google.visualization.DataTable(jsonData.server_location);
		var chart_server_location = new google.visualization.GeoChart(document.getElementById('chart_server_location'));
		var options_server_location = {colorAxis:{colors:['red','#f2c40e','gray'], minValue: 0, maxValue:2}, region:'world', legend:'none'};
		chart_server_location.draw(data_server_location,  options_server_location);
		

		// CPU ALLOCATION
		
        var data_cpu_pie = new google.visualization.DataTable(jsonData.cpu_pie);
        var chart_cpu_pie = new google.visualization.PieChart(document.getElementById('chart_cpu_pie'));
		var options_cpu_pie = {'title':'Cpu allocation',colors: ['#475577', '#cc3333']};
        chart_cpu_pie.draw(data_cpu_pie, options_cpu_pie);
		
		// RAM ALLOCATION //
		
        var data_ram_pie = new google.visualization.DataTable(jsonData.ram_pie);
        var chart_ram_pie = new google.visualization.PieChart(document.getElementById('chart_ram_pie'));
		var options_ram_pie = {'title':'Ram allocation', colors: ['#475577', '#27ae60', 'orange']};
        chart_ram_pie.draw(data_ram_pie, options_ram_pie);
		
		//
		$('#main-content').css({'display':'none', 'visibility':'visible'}).fadeIn();
		$('#loader').hide();
			
	});
}