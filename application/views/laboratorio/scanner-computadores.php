<table align="center" width="800">
	<tr>
		<td><img src="<?php echo base_url("img/logo/ufrgs.png");?>" height="100"></td>
		<td align="right"><img src="<?php echo base_url("img/logo/finep.png");?>" height="100"></td>
	</tr>
	<tr>
		<td colspan=2 align="center">
			
		</td>
	</tr>
	<tr><td>
		Data: <?php echo date("d/m/Y");?>
	</td>
	<td align="right">
		Local: CEDAP - UFRGS
	</td></tr>
</table>	
<center>
<?php
$pc = array('579547','582453','582454','582455','582456','582457','582458','582459');
?>
<?php
for ($r = 0; $r < count($pc); $r = $r + 2) {
	echo '<table align="center" width="800">';
	echo '<tr>	<th width="25%"></th>
					<th width="25%"></th>
					<th width="25%"></th>
					<th width="25%"></th>
				</tr>';
	echo '<tr>';
	echo '<th colspan=2 style="font-size: 30px;">';
	echo 'Patrimônio Nº' . $pc[$r];
	echo '</th>';
	if (isset($pc[$r + 1])) {
		echo '<th colspan=2 style="font-size: 30px;">';
		echo 'Patrimônio Nº' . $pc[$r + 1];
		echo '</th>';
		echo '</tr>';
	}
	echo '<tr valign="top">';

	echo '<td style="padding: 10px;">';
	echo '<img src="' . base_url('img/laboratorio/' . $pc[$r] . '-P.jpg') . '" width="100%">';
	echo '<br>Imagem do equipamento';
	echo '</td>';

	echo '<td style="padding: 10px;">';
	echo '<img src="' . base_url('img/laboratorio/' . $pc[$r] . '.jpg') . '" width="100%">';
	echo '<br>Imagem da ficha de patrimônio';
	echo '</td>';

	if (isset($pc[$r + 1])) {
		echo '<td style="padding: 10px;">';
		echo '<img src="' . base_url('img/laboratorio/' . $pc[$r + 1] . '-P.jpg') . '" width="100%">';
		echo '<br>Imagem do equipamento';
		echo '</td>';

		echo '<td style="padding: 10px;">';
		echo '<img src="' . base_url('img/laboratorio/' . $pc[$r + 1] . '.jpg') . '" width="100%">';
		echo '<br>Imagem da ficha de patrimônio';
		echo '</td>';
	}
	echo '</tr>';
	echo '</table>';
	if ((int)($r / 4) != ($r / 4)) {
		echo '<hr style="page-break-after: always;">';
	}
}
?>
