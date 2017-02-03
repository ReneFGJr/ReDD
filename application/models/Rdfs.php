<?php
class rdfs extends CI_model {
	var $table = 'programa_pos';

	function show($id = '') {
		$sql = "select * from rdf_resource
						INNER JOIN rdf_value ON id_rs = rv_propriety  
						WHERE rv_resource = '$id'
						order by id_rs, rv_value
						";
		$rlt = $this -> db -> query($sql);
		$rlt = $rlt -> result_array();
		$sx = '<table width="100%" class="table">';
		for ($r = 0; $r < count($rlt); $r++) {
			$line = $rlt[$r];
			$sx .= '<tr>';
			$sx .= '<td width="20%">' . $line['rs_propriety'] . '</td>';
			$sx .= '<td width="80%">' . $line['rv_value'] . '</td>';
			$sx .= '</tr>';
		}
		$sx .= '</table>';
		return ($sx);
	}

	function edit($id = '', $gr = '', $r = '') {
		if (strlen($r) == 0) {
			$sql = "select * from rdf_resource
						LEFT JOIN rdf_value ON id_rs = rv_propriety AND rv_resource = '$id'
						WHERE rs_group = '$gr' 
						AND rv_propriety is NULL
						order by id_rs
						";
		} else {
			$sql = "select * from rdf_resource
						WHERE rs_group = '$gr' 
						order by id_rs
						";
		}
		
		$rlt = $this -> db -> query($sql);
		$rlt = $rlt -> result_array();

		if (count($rlt) > 0) {
			$form = new form;
			$cp = array();
			$saved = 0;
			array_push($cp, array('$A', '', $id, false, true));
			for ($r = 0; $r < count($rlt); $r++) {
				$line = $rlt[$r];
				$idp = $line['id_rs'];
				array_push($cp, array($line['rs_type'], '', msg($line['rs_propriety']), false, true));

				$vlr = get("dd" . ($r + 1));
				if (strlen($vlr)) {
					$sql = "insert into rdf_value 
								(
									rv_resource, rv_propriety, rv_value
								) values (
									'$id',$idp,'$vlr'
								)";
					$xrlt = $this -> db -> query($sql);
					$saved = 1;
				}
			}
			$tela = $form -> editar($cp, '');
		} else {
			$tela = '';
			$saved = 0;
		}
		return ( array($tela, $saved));
	}

	function le($rec = '') {
		$sql = "select * from rdf where rdf_resource = '$rec' limit 1";
		$rlt = $this -> db -> query($sql);
		$rlt = $rlt -> result_array();
		if (count($rlt) > 0) {
			$line = $rlt[0];
			$rst = $line['rdf_value'];
			return ($rst);
		}
		return ('');
	}

}
?>
