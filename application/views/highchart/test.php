<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta name="robots" content="noindex, nofollow">
		<meta name="googlebot" content="noindex, nofollow">

		<script type="text/javascript" src="//code.jquery.com/jquery-3.1.1.js"></script>

		<link rel="stylesheet" type="text/css" href="/css/result-light.css">

		<style type="text/css">
		</style>

		<title></title>

		<script type='text/javascript'>
			//<![CDATA[

			$(function() {
				Highcharts.chart('container', {
					chart : {
						type : 'column'
					},
					title : {
						text : 'Stacked column chart'
					},
					xAxis : {
						categories : ['Apples', 'Oranges', 'Pears', 'Grapes', 'Bananas']
					},
					yAxis : {
						min : 0,
						title : {
							text : 'Total fruit consumption'
						},
						stackLabels : {
							enabled : true,
							style : {
								fontWeight : 'bold',
								color : (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
							}
						}
					},
					legend : {
						align : 'right',
						x : -30,
						verticalAlign : 'top',
						y : 25,
						floating : true,
						backgroundColor : (Highcharts.theme && Highcharts.theme.background2) || 'white',
						borderColor : '#CCC',
						borderWidth : 1,
						shadow : false
					},
					tooltip : {
						headerFormat : '<b>{point.x}</b><br/>',
						pointFormat : '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
					},
					plotOptions : {
						column : {
							stacking : 'normal',
							dataLabels : {
								enabled : true,
								color : (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
							}
						}
					},
					series : [{
						name : 'John',
						data : [5, 3, 4, 7, 2]
					}, {
						name : 'Jane',
						data : [2, 2, 3, 2, 1]
					}, {
						name : 'Joe',
						data : [3, 4, 4, 2, 5]
					}]
				});
			});
			//]]>

		</script>

	</head>

	<body>
		<script src="https://code.highcharts.com/highcharts.js"></script>
		<script src="https://code.highcharts.com/modules/exporting.js"></script>

		<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

		<script>
			// tell the embed parent frame the height of the content
			if (window.parent && window.parent.parent) {
				window.parent.parent.postMessage(["resultsFrame", {
					height : document.body.getBoundingClientRect().height,
					slug : "None"
				}], "*")
			}
		</script>

	</body>

</html>

