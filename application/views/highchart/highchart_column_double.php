<?php
$nframe = 'ct' . $frame;
$frame++;

$dados = array();
for ($r = 0; $r < count($series); $r++) {
    $dt = $data[$r];
    $cat = '';
    $ser = '';
    
    foreach ($dt as $key => $value) {
        if (strlen($cat) > 0) {
            $cat .= ', ';
            $ser .= ', ';
        }
        $cat .= '"' . $key . '"';
        $ser .= $value;
    }
    $dados[$r] = $ser;
}

$colors = array('#804000','#b35900','#e67300','#ff8c1a','#ffa64d','#ffbf80','#ffd9b3'); 
?>

<div id="<?php echo $frame; ?>" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

<script>
Highcharts.chart('<?php echo $frame; ?>', {
	chart: { type: 'column' },
	title : {
	       text : '<?php echo $title; ?>'
	       },
	subtitle : {
	       text : '<?php echo $subtitle; ?>'
	       },
	xAxis: {
	       categories : [<?php echo $cat; ?>], crosshair: true},
    yAxis: {
            min: 0, title: { text: 'Rainfall (mm)' }, max: 80
    },
    tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y:1f} publicações</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
    },
        plotOptions: {
        column: {
        pointPadding: 0.2,
        borderWidth: 0
        }
},
series: [ <?php for ($r=0;$r < count($series);$r++) { ?>
    <?php if ($r > 0) { echo ', '; } ?>
	{ 
	       name : '<?php echo $series[$r]; ?>',
	       color : '<?php echo $colors[$r]; ?>',
	       data : [ <?php echo $dados[$r]; ?>]
	}
<?php } ?>
	]
	});
</script>