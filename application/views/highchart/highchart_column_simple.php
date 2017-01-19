<?php
global $frame;
if (!isset($frame)) { $frame = 1;
}
$nframe = 'ct' . strzero($frame, 4);

$cat = '';
$ser = '';
echo $nframe;
echo '<hr>';
foreach ($data as $key => $value) 	
	{
		if (strlen($cat) > 0)
			{
				$cat .= ', ';
				$ser .= ', ';
			}
		$cat .= $key;
		$ser .= $value;
	}
?>
 <style type="text/css">
	#container {
		height: 400px;
		min-width: 310px;
		max-width: 800px;
		margin: 0 auto;
	}
</style>
<script type='text/javascript'>
	//<![CDATA[

	$(function() {
		Highcharts.chart('<?php echo $nframe;?>', {
			chart : {
				type : 'column',
				options3d : {
					enabled : true,
					alpha : 0,
					beta : 0,
					depth : 20
				}
			},
			title : {
				text : '<?php echo $title;?>'
			},
			subtitle : {
				text : '<?php echo $subtitle;?>'
			},
			plotOptions : {
				column : {
					depth : 25
				}
			},
			xAxis : {
				categories : [<?php echo $cat;?>]
			},
			yAxis : {
				title : {
					text : null
				}
			},
			series : [{
				name : '<?php echo $serie;?>',
				data : [<?php echo $ser;?>]
			}]
		});
	});
	//]]>

</script>

<div id="<?php echo $nframe; ?>" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

 
 <script>
	// tell the embed parent frame the height of the content
	if (window.parent && window.parent.parent) {
		window.parent.parent.postMessage(["resultsFrame", {
			height : document.body.getBoundingClientRect().height,
			slug : "None"
		}], "*")
	}
