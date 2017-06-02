<?php
Class Patents extends CI_Model {
	function inport_file($file = '') {
		$utf_string = file_get_contents($file);
		//$sjis_string = mb_convert_encoding($utf_string, 'SJIS', 'UTF-8');
		$sjis_string = $this->convert_to($utf_string, 'utf8');
		return ($sjis_string);
	}

	function convert_to($source, $target_encoding) {
		// detect the character encoding of the incoming file
		$encoding = mb_detect_encoding($source, "auto");
		$encoding = 'utf8';
		// escape all of the question marks so we can remove artifacts from
		// the unicode conversion process
		$target = str_replace("?", "[question_mark]", $source);

		// convert the string to the target encoding
		$target = mb_convert_encoding($target, $target_encoding, $encoding);

		// remove any question marks that have been introduced because of illegal characters
		$target = str_replace("?", "", $target);

		// replace the token string "[question_mark]" with the symbol "?"
		$target = str_replace("[question_mark]", "?", $target);

		return $target;
	}

	function tools_1($cp) {
		$fld = 'pt_' . strzero($cp, 2);
		$sql = "select $fld, count(*) as total 
						from patent
						where $fld <> '' 
						group by $fld order by total desc, $fld";
		$rlt = $this -> db -> query($sql);
		$rlt = $rlt -> result_array();
		$sx = '<table class="table" width="100%">';
		$sx .= '<tr><th width="3%">#</th>
						<th width="3%">freq.</th>
						<th width="94%">value</th>						
					</tr>';

		for ($r = 0; $r < count($rlt); $r++) {
			$line = $rlt[$r];
			$sx .= '<tr>';
			$sx .= '<td>' . ($r + 1) . '</td>';
			$sx .= '<td align="center">' . $line['total'] . '</td>';
			$sx .= '<td>' . $line[$fld] . '</td>';
			$sx .= '</tr>';
		}
		$sx .= '</table>';
		return ($sx);

	}

	function row($form) {

		$form -> fd = array('id_pn', 'pn_resource', 'pn_propriety', 'pn_value');
		$form -> lb = array('id', msg('pn_resource'), msg('pn_propriety'), msg('pn_value'));
		$form -> mk = array('', 'L', 'L', 'L', 'L', 'C', 'C');

		return ($form);
	}

	function le($id) {
		$id = round($id);
		$sql = "select * from patent where id_pt = $id";
		$rlt = $this -> db -> query($sql);
		$rlt = $rlt -> result_array();
		if (count($rlt) > 0) {
			return ($rlt[0]);
		} else {
			return ( array());
		}
	}

	function show_line($id) {
		$rlt = $this -> le($id);
		$sx = '<table width="100%" class="table">';
		foreach ($rlt as $key => $value) {
			$sx .= '<tr><td>' . msg($key) . '</td><td>' . $value . '</td></tr>' . cr();
		}
		$sx .= '</table>';
		return ($sx);
	}

	function process_file($file = '') {
		ini_set('max_execution_time', 300);
		$sx = $this -> inport_file($file);
		$sa = troca($sx, ';', '.,');
		$sa = troca($sa, ' ;', ';');
		$sa = troca($sa, ' ;', ';');
		$sa = troca($sa, ' ;', ';');
		$sa = troca($sa, '; ', ';');
		$sa = troca($sa, '; ', ';');
		$sa = troca($sa, '; ', ';');

		$sa = troca($sa, chr(13), ';');
		$sa = troca($sa, chr(10), ';');
		$ln = splitx(';', $sa . ';');

		$sx = '';
		for ($r = 1; $r < count($ln); $r++) {
			/* LINES */
			$sb = ($ln[$r]);
			$sb = troca($sb, chr(15), ' ;');
			$sb = troca($sb, chr(10), ' ;');
			$sb = troca($sb, chr(9), '-x-;');
			for ($t = 1; $t < 32; $t++) {
				$sb = troca($sb, chr($t), '');
			}

			//$sb = troca($sb, ';','z¢z');

			//$sb = troca($sb,'-x-',' ');

			$sc = splitx(';', $sb);
			/* TODOS OS CAMPOS */
			if (count($sc) != 24) {
				//print_r($sc);
				//exit;
				//exit;
			}

			/* CAMPOS DE IMPORTAÇÃO */
			$sql1 = '';
			$sql2 = '';
			for ($i = 0; $i < count($sc); $i++) {
				$vlr = $sc[$i];
				$vlr = troca($vlr, '-x-', '');
				$vlr = troca($vlr, "'", '´');
				if ($i > 0) {
					$sql1 .= ', ';
					$sql2 .= ', ';
				}
				$sql1 .= 'pt_' . strzero($i + 1, 2);
				$sql2 .= "'$vlr'";
			}
			$pt01 = $sc[0];
			$pt01 = troca($pt01, '-x-', '');

			if (strlen($pt01) > 8) {
				$sql = "select * from patent where pt_01 = '$pt01' ";
				$rlt = $this -> db -> query($sql);
				$rlt = $rlt -> result_array();
				$sx .= $pt01 . ' ';
				if (count($rlt) == 0) {
					$sql = "insert into patent 
								($sql1)
								values
								($sql2)";
					$rlt = $this -> db -> query($sql);
					$sx .= '<span class="btn-sucess"> insered </span>';
				} else {
					$sx .= '<span class="btn-alert"> already </span>';
				}
				$sx .= '<br>';
			}
		}
		return ($sx);
	}

}
?>
