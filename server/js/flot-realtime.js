function runChartAnimation(){

	jQuery(document).ready(function($) {

		if ($('.flot-dashboard-demo-1').length) {
			var data = [],
			totalPoints = 300;

			var max = 0;
			var timeout_update = 0;

			function getRandomData() {
				if (data.length > 0) data = data.slice(1);

				while (data.length < totalPoints) {
					var prev = data.length > 0 ? data[data.length - 1] : 50,
					y = prev + Math.random() * 10 - 5;
					if (y < 0) {
						y = 0;
					} else if (y > 100) {
						y = 100;
					}

					timeout_update++;
					if (timeout_update >= 60) {
						timeout_update = 0;
						$('.current-flot-demo-1').html(Math.round(y) + '%');
					}
					data.push(y);
				}

				var res = [];
				for (var i = 0; i < data.length; ++i) {
					res.push([i, data[i]])
				}
				return res;
			}

			var updateInterval = 30;
			$("#updateInterval").val(updateInterval).change(function() {
				var v = $(this).val();
				if (v && !isNaN(+v)) {
					updateInterval = +v;
					if (updateInterval < 1) {
						updateInterval = 1;
					} else if (updateInterval > 2000) {
						updateInterval = 2000;
					}
					$(this).val("" + updateInterval);
				}
			});
			var plot = $.plot(".flot-dashboard-demo-1", [getRandomData()], {
				series: {shadowSize: 0 },
				yaxis: {min: 0, max: 100},
				xaxis: {show: false},
				grid: {borderWidth:{top:0, left:0, right:0, bottom:0}},
				colors: ['#f75d3f']
			});

			function update() {
				plot.setData([getRandomData()]);
				plot.draw();
				setTimeout(update, updateInterval);
			}
			update();
		}

	});
}

runChartAnimation();