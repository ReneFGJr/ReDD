<?php
global $frame;
if (!isset($frame)) { $frame = 1; }
$nframe = 'ct'.strzero($frame,4);
?>
<script type='text/javascript'>
	//<![CDATA[

	$(function() {
		Highcharts.chart('<?php echo $nframe;?>', {
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

<div id="<?php echo $nframe;?>" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

<script>
	// tell the embed parent frame the height of the content
	if (window.parent && window.parent.parent) {
		window.parent.parent.postMessage(["resultsFrame", {
			height : document.body.getBoundingClientRect().height,
			slug : "None"
		}], "*")
	}
</script>
