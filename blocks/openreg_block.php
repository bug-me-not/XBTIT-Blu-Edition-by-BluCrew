<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse20">Open SignUps</a>
</h4>
</div>
<div id="collapse20" class="panel-collapse collapse in">

<style type="text/css">
#clockdiv{
	font-family: sans-serif;
	color: #fff;
	display: inline-block;
	font-weight: 100;
	text-align: center;
	font-size: 30px;
}


#clockdiv > div{
	padding: 10px;
	border-radius: 3px;
	background: #00BF96;
	display: inline-block;
}

#clockdiv div > span{
	padding: 15px;
	border-radius: 3px;
	background: #00816A;
	display: inline-block;
}

.smalltext{
	padding-top: 5px;
	font-size: 16px;
}
</style>

<center>
<h3>Spread The Word To Friends and Family</h3>
<div id="clockdiv">
	<div><span class="days"></span><div class="smalltext">Days</div></div>
	<div><span class="hours"></span><div class="smalltext">Hours</div></div>
	<div><span class="minutes"></span><div class="smalltext">Minutes</div></div>
	<div><span class="seconds"></span><div class="smalltext">Seconds</div></div>
</div>
</div>
</center>

<script>
var deadline = 'June 28 2016 17:00:00 EST'; // SET OPEN REGISTRATION DEADLINE HERE //
function time_remaining(endtime){
	var t = Date.parse(endtime) - Date.parse(new Date());
	var seconds = Math.floor( (t/1000) % 60 );
	var minutes = Math.floor( (t/1000/60) % 60 );
	var hours = Math.floor( (t/(1000*60*60)) % 24 );
	var days = Math.floor( t/(1000*60*60*24) );
	return {'total':t, 'days':days, 'hours':hours, 'minutes':minutes, 'seconds':seconds};
}
function run_clock(id,endtime){
	var clock = document.getElementById(id);
	
	// get spans where our clock numbers are held
	var days_span = clock.querySelector('.days');
	var hours_span = clock.querySelector('.hours');
	var minutes_span = clock.querySelector('.minutes');
	var seconds_span = clock.querySelector('.seconds');

	function update_clock(){
		var t = time_remaining(endtime);
		
		// update the numbers in each part of the clock
		days_span.innerHTML = t.days;
		hours_span.innerHTML = ('0' + t.hours).slice(-2);
		minutes_span.innerHTML = ('0' + t.minutes).slice(-2);
		seconds_span.innerHTML = ('0' + t.seconds).slice(-2);
		
		if(t.total<=0){ clearInterval(timeinterval); }
	}
	update_clock();
	var timeinterval = setInterval(update_clock,1000);
}
run_clock('clockdiv',deadline);
</script>
</div>
<div class="panel-footer">
</div>
</div>

