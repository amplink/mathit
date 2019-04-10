
<!doctype html>
<html>

<head>
	<title>Line Chart - Cubic interpolation mode</title>
	<script src="./js/Chart.min.js"></script>
	<script src="./js/utils.js?v=201904081"></script>
	<link rel="stylesheet" type="text/css" href="./css/chart_style.css?v=201904081">
	<style>
	canvas{
		-moz-user-select: none;
		-webkit-user-select: none;
		-ms-user-select: none;
	}
	</style>
</head>

<body>
	<div class="content">
		<div class="wrapper col-2" style="margin-left:-20px"><canvas id="chart-0"></canvas></div>
	</div>

	<script>
		var presets = window.chartColors;
		var utils = Samples.utils;
		var inputs = {
			min: 0,
			max: 100,
			count: 8,
			decimals: 2,
			continuity: 1
		};

		function generateData(config) {
			return utils.numbers(Chart.helpers.merge(inputs, config || {}));
		}

		function generateLabels(config) {
			return utils.months(Chart.helpers.merge({
				count: inputs.count,
				section: 3
			}, config || {}));
		}

		var options = {
			maintainAspectRatio: false,
			spanGaps: false,
			elements: {
				line: {
					tension: 0.000001
				}
			},
			plugins: {
				filler: {
					propagate: false
				}
			},
			scales: {
				xAxes: [{
					ticks: {
						autoSkip: false,
						maxRotation: 0
					}
				}]
			}
		};

		[false, 'origin', 'start', 'end'].forEach(function(boundary, index) {

			// reset the random seed to generate the same data for all charts
			utils.srand(8);
			var datapoints = [0, 20, 20, 60, 60, 70, 50, 80];
			var datapoints2 = [10, 70, 40, 90, 60, 70, 100, 80];

			new Chart('chart-' + index, {
				type: 'line',
				data: {
					labels: generateLabels(),
					datasets: [{
						backgroundColor: utils.transparentize(presets.red),
						borderColor: presets.red,
						data: datapoints,
						label: '김서정',
						fill: boundary
					},{
						backgroundColor: utils.transparentize(presets.red),
						borderColor: presets.blue,
						data: datapoints2,
						label: '학년평균',
						fill: boundary
					}]
				},
				options: Chart.helpers.merge(options, {
					title: {
						text: 'fill: ' + boundary,
						display: false
					}
				})
			});
		});

		// eslint-disable-next-line no-unused-vars
		function toggleSmooth(btn) {
			var value = btn.classList.toggle('btn-on');
			Chart.helpers.each(Chart.instances, function(chart) {
				chart.options.elements.line.tension = value ? 0.4 : 0.000001;
				chart.update();
			});
		}

	</script>
</body>
</html>