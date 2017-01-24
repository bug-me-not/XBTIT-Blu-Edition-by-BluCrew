var item, line, locations;

var circ = Math.PI * 2;
var quart = Math.PI / 2;

var w = 200;
var h = 200;
var strokeSize = 40;
var radius = 100;

function drawShape(percent, context, color, update){
	var ctx = document.getElementById(context).getContext('2d');
	ctx.beginPath();
	ctx.arc(w/2, h/2,radius-strokeSize/2,-(quart),((circ) * percent) - quart,false);
	if (update != undefined){
		if (percent < 0.25){ color = '#27ae60'; }
		else if (percent >= 0.25 && percent <= 0.5){ color = '#f2c40e'; }
		else {color = '#ea6153';}
	}
	ctx.strokeStyle = color;
	ctx.lineCap = 'butt';
	ctx.lineWidth = strokeSize;
	destroy(context);
	ctx.stroke();
}



function destroy(context){
	var canvas = document.getElementById(context);
	var ctx = canvas.getContext('2d');
	ctx.clearRect(0, 0, canvas.width, canvas.height);
}

function displayPercent(percentage, context){
	document.getElementById(context).innerHTML = Math.round(percentage)+'%';
}


function analogWorldTime(){

	var clocksArr = [];
	for (var index in locations) {

		if (locations.hasOwnProperty('index') === true){
			var i = Object.keys(locations).indexOf(index);
		}

		var canvas = [];
		var ctx = [];
		var radius = [];
		var dif = [];
		canvas[i] = document.getElementById('a_'+index);
		ctx[i] = canvas[i].getContext("2d");
		radius[i] = canvas[i].height / 2;

		ctx[i].translate(radius[i], radius[i]);
		radius[i] = radius[i] * 0.90;
		//noinspection JSUnfilteredForInLoop
		dif[i] = locations[index];
		//
		clocksArr[i] = {ctx:(ctx[i]) , radius:(radius[i]), dif:(dif[i])};
		//
		drawClock(clocksArr[i].ctx, clocksArr[i].radius, clocksArr[i].dif);
		//
	}
	setInterval( function() {runClocks(clocksArr); }, 1000 );
}

function digitalWorldTime() {
	var d = new Date();

	var hour = d.getHours();
	var min = d.getMinutes(); if (min <= 9){ min = '0'+min;}
	var sec = d.getSeconds(); if (sec <= 9){ sec = '0'+sec;}
	var suffix, formattedTime;

	for (var index in locations) {
		//noinspection JSUnfilteredForInLoop
		var locationTime = hour + locations[index];
		if (locationTime < 24){
			suffix = (locationTime >= 12)? 'PM' : 'AM';
			formattedTime = ((locationTime + 11) % 12 + 1);
		}
		else{
			var AdjustedTime = locationTime - 24;
			suffix = (locationTime <= 12)? 'PM' : 'AM';
			formattedTime = ((AdjustedTime + 11) % 12 + 1);
		}
		document.getElementById('d_'+index).innerHTML = formattedTime+':'+min+':'+sec+' '+suffix;
	}
}

/* ******************************* */

function runClocks(clocksArr){
	for (var item in clocksArr){
		drawClock(clocksArr[item].ctx, clocksArr[item].radius, clocksArr[item].dif);
	}
}

function drawClock(ctx, radius, dif) {
	drawFace(ctx, radius, dif);
	drawNumbers(ctx, radius, dif);
	drawTime(ctx, radius, dif);
}

function drawFace(ctx, radius, dif) {
	var grad;
	ctx.beginPath();
	ctx.arc(0, 0, radius, 0, 2*Math.PI);
	ctx.fillStyle = 'white';
	ctx.fill();
	grad = ctx.createRadialGradient(0,0,radius*0.95, 0,0,radius*1.05);
	grad.addColorStop(0, '#333');
	grad.addColorStop(0.5, 'white');
	grad.addColorStop(1, '#333');
	ctx.strokeStyle = grad;
	ctx.lineWidth = radius*0.1;
	ctx.stroke();
	ctx.beginPath();
	ctx.arc(0, 0, radius*0.1, 0, 2*Math.PI);
	ctx.fillStyle = '#333';
	ctx.fill();
}

function drawNumbers(ctx, radius, dif) {
	var ang;
	var num;
	ctx.font = radius*0.15 + "px arial";
	ctx.textBaseline="middle";
	ctx.textAlign="center";
	for(num = 1; num < 13; num++){
		ang = num * Math.PI / 6;
		ctx.rotate(ang);
		ctx.translate(0, -radius*0.85);
		ctx.rotate(-ang);
		ctx.fillText(num.toString(), 0, 0);
		ctx.rotate(ang);
		ctx.translate(0, radius*0.85);
		ctx.rotate(-ang);
	}
}

function drawTime(ctx, radius, dif){
	var now = new Date();
	var hour = now.getHours();
	var minute = now.getMinutes();
	var second = now.getSeconds();
	//hour
	hour = hour + dif;
	hour=hour%12;
	hour=(hour*Math.PI/6)+
	(minute*Math.PI/(6*60))+
	(second*Math.PI/(360*60));
	drawHand(ctx, hour, radius*0.5, radius*0.07);
	//minute
	minute=(minute*Math.PI/30)+(second*Math.PI/(30*60));
	drawHand(ctx, minute, radius*0.8, radius*0.07);
	// second
	second=(second*Math.PI/30);
	drawHand(ctx, second, radius*0.9, radius*0.02);
}

function drawHand(ctx, pos, length, width) {
	ctx.beginPath();
	ctx.lineWidth = width;
	ctx.lineCap = "round";
	ctx.moveTo(0,0);
	ctx.rotate(pos);
	ctx.lineTo(0, -length);
	ctx.stroke();
	ctx.rotate(-pos);
}

/******** SERVER INFO ********/


function serverInfo(dir){

		$.get(dir+"/ajax/server_monitor.php", { }, function(data){

			var returnedData = JSON.parse(data);
			for (item in returnedData.system_info){
				html = '<div class="table_row">';
				html += '<div class="cell">'+item+'</div>';
				html += '<div class="cell">'+returnedData.system_info[item]+'</div>';
				html += '</div>';
				$('#system_table').append(html);
			}
			// Calculate local time and server time difference and run clocks
			var localDate = new Date;
			var serverDate = returnedData.system_info['server_date'];
			var serverDateArr = serverDate.split(' ');
			var newServerDateArr = [];
			for (var i = 0; i < serverDateArr.length; i++) {
				if (serverDateArr[i]) {
					newServerDateArr.push(serverDateArr[i]);
				}
			}
			var timeArr = newServerDateArr[3].split(':');
			var time_dif = localDate.getHours() - timeArr[0];

			if (localDate.getHours() > timeArr[0]){time_dif = -time_dif;}
			locations = {local: 0, server: time_dif};
			analogWorldTime();
			digitalWorldTime();
			setInterval(digitalWorldTime, 1000);

			var html;
			for (line in returnedData.last_login){
				html = '<div class="table_row">';
				html += '<div class="cell">'+returnedData.last_login[line].user+'</div>';
				html += '<div class="cell">'+returnedData.last_login[line].date+'</div>';
				html += '</div>';
				$('#last_login_table').append(html);
			}

			for (item in returnedData.memory_info){
				html = '<div class="table_row">';
				html += '<div class="cell">'+item+'</div>';
				html += '<div class="cell">'+returnedData.memory_info[item]+'</div>';
				html += '</div>';
				$('#memory_table').append(html);
			}

			displayRAM(returnedData.memory_info.Used_percent);

			for (item in returnedData.swap_info){
				html = '<div class="table_row">';
				html += '<div class="cell">'+item+'</div>';
				html += '<div class="cell">'+returnedData.swap_info[item]+'</div>';
				html += '</div>';
				$('#swap_table').append(html);
			}


			for (line in returnedData.ping_info){
				html = '<div class="table_row">';
				html += '<div class="cell">'+returnedData.ping_info[line].host+'</div>';
				html += '<div class="cell">'+returnedData.ping_info[line].ping+'&nbsp;ms</div>';
				html += '</div>';
				$('#ping_table').append(html);
			}

			for (line in returnedData.services_info){

				var isOnline  = returnedData.services_info[line].status == 1 ? '<div class="service service_online" style="background-color: #27ae60"></div>' : '<div class="service service_offline" style="background-color: #ea6153"></div>';

				html = '<div class="table_row">';
				html += '<div class="cell_mobile">';
				html += isOnline;
				html +='</div>';
				html += '<div class="cell_mobile">'+returnedData.services_info[line].name+'</div>';
				html += '<div class="cell_mobile">'+returnedData.services_info[line].port+'</div>';
				html += '</div>';
				$('#services_table').append(html);
			}

			for (line in returnedData.disk_info){
				html = '<div class="table_row">';
				html += '<div class="cell_mobile">'+returnedData.disk_info[line].mount+'</div>';
				html += '<div class="cell_mobile">'+returnedData.disk_info[line].used+'</div>';
				html += '<div class="cell_mobile">'+returnedData.disk_info[line].free+'</div>';
				html += '<div class="cell_mobile">'+returnedData.disk_info[line].total+'</div>';
				html += '</div>';
				$('#disk_table').append(html);
			}

			displayHDD(returnedData.disk_info[0].percent_used.replace('%', ''));

			for (line in returnedData.network_info){
				html = '<div class="table_row">';
				html += '<div class="cell_mobile">'+returnedData.network_info[line].inter_face+'</div>';
				html += '<div class="cell_mobile">'+returnedData.network_info[line].ip+'</div>';
				html += '<div class="cell_mobile">'+returnedData.network_info[line].receive+'</div>';
				html += '<div class="cell_mobile">'+returnedData.network_info[line].transmit+'</div>';
				html += '</div>';
				$('#network_table').append(html);
			}

			for (item in returnedData.tasks_info){
				html = '<div class="table_row">';
				html += '<div class="cell">'+item+'</div>';
				html += '<div class="cell">'+returnedData.tasks_info[item]+'</div>';
				html += '</div>';
				$('#tasks_table').append(html);
			}
			var currentCpuUse;
			if ( (100 - returnedData.cpu_info['percent_id']) < 1 ){
				currentCpuUse = 1;
			}
			else{
				currentCpuUse = returnedData.cpu_info['percent_id'];
			}

			displayCPU(currentCpuUse);

			$('#main-content').css({'display':'none', 'visibility':'visible'}).fadeIn();
			$('#loader').hide();
		});
		serverLoad(dir);
	}



	function serverLoadDemo(){

		var rand1= Math.floor(Math.random() * 75) + 1  ;
		var rand2= Math.floor(Math.random() * 85) + 1  ;
		var rand3= Math.floor(Math.random() * 65) + 1  ;

		var returnedData = {'1_min': rand1, '5_min': rand2, '15_min': rand3};

		for (var item in returnedData){
			$('#server-'+item).css({'width':returnedData[item]+'%'});
			$('#server-load-'+item).html(returnedData[item]);

			if(returnedData[item] < 25){
				if ($('#server-'+item).hasClass('moderate')){$('#server-'+item).removeClass('moderate');}
				if ($('#server-'+item).hasClass('heavy')){$('#server-'+item).removeClass('heavy');}
				$('#server-'+item).addClass('light');
			}
			else if (returnedData[item] >= 25 && returnedData[item] <= 50){
				if ($('#server-'+item).hasClass('moderate')){$('#server-'+item).removeClass('moderate');}
				if ($('#server-'+item).hasClass('heavy')){$('#server-'+item).removeClass('heavy');}
				$('#server-'+item).addClass('progress-bar moderate');
			}
			else{
				if ($('#server-'+item).hasClass('moderate')){$('#server-'+item).removeClass('moderate');}
				if ($('#server-'+item).hasClass('heavy')){$('#server-'+item).removeClass('heavy');}
				$('#server-'+item).addClass('heavy');
			}
		}

		displayCPU(rand1);
		displayRAM(rand2);
		displayHDD(rand3);
	}

	function serverLoad(dir){

		$.get(dir+"/ajax/server_load.php", { }, function(data){
			var returnedData = JSON.parse(data);

			for (var item in returnedData){
				$('#server-'+item).css({'width':returnedData[item]+'%'});
				$('#server-load-'+item).html(returnedData[item]);

				if(returnedData[item] < 25){
					if ($('#server-'+item).hasClass('moderate')){$('#server-'+item).removeClass('moderate');}
					if ($('#server-'+item).hasClass('heavy')){$('#server-'+item).removeClass('heavy');}
					$('#server-'+item).addClass('light');
				}
				else if (returnedData[item] >= 25 && returnedData[item] <= 50){
					if ($('#server-'+item).hasClass('moderate')){$('#server-'+item).removeClass('moderate');}
					if ($('#server-'+item).hasClass('heavy')){$('#server-'+item).removeClass('heavy');}
					$('#server-'+item).addClass('progress-bar moderate');
				}
				else{
					if ($('#server-'+item).hasClass('moderate')){$('#server-'+item).removeClass('moderate');}
					if ($('#server-'+item).hasClass('heavy')){$('#server-'+item).removeClass('heavy');}
					$('#server-'+item).addClass('heavy');
				}
			}
		});

	}

	function displayRAM(per){
		drawShape(100/100, 'canvas1', 'rgba(255,255,255,0.8)');
		drawShape(per/100, 'canvas2', '#27ae60', true);
		displayPercent(per, 'per1');
	}

	function displayCPU(per){
		drawShape(100/100, 'canvas3', 'rgba(255,255,255,0.8)');
		drawShape(per/100, 'canvas4', '#f2c40e', true);
		displayPercent(per, 'per2');
	}

	function displayHDD(per){
		drawShape(100/100, 'canvas5', 'rgba(255,255,255,0.8)');
		drawShape(per/100, 'canvas6', '#ea6153', true);
		displayPercent(per, 'per3');
	}


