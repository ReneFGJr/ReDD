<?php
class read_emater extends CI_model {
	var $handle = '2050012287';
	var $table = 'metadados_emater';
		
	function data($id) {
		$sql = "select * from " . $this -> table . " where cod_acervo = $id";
		$rlt = $this -> db -> query($sql);
		$rlt = $rlt -> result_array();

		$dc = array();
		$dcc = array();
		$dcc['id'] = $id;
		$dcc['subject'] = array();
		$dcc['contributor.author'] = array();
		$dcc['title.alternative'] = '';
		$dcc['title'] = '';
		$dcc['sponsorship'] = 'Emater/ASCAR - RS';
		$dcc['publisher'] = 'Emater/ASCAR - RS';
		
		$dcc['ispartofseries'] = '';
		for ($r = 0; $r < count($rlt); $r++) {
			$line = $rlt[$r];
			$cod = trim($line['paragrafo']);
			$name = trim($line['var2']);
			switch($cod) {
				/********************** chamada *******************/
				case '90' :
					$nome = $this -> extract($name, '$a');
					if (strlen($nome) > 0) {
						array_push($dcc['subject'], $nome);
					}
					break;
				/********************** autoridade pessoa *******************/
				case '100' :
					$nome = $this -> extract($name, '$a');
					if (strlen($nome) > 0) {
						array_push($dcc['contributor.author'],$nome);
					}
					break;
				case '700' :
					if (strlen($nome) > 0) {
						array_push($dcc['contributor.author'],$nome);
					}
					break;

				/********************** autoridade instituicao **************/
				case '110' :
					$nome = $this -> extract($name, '$a');
					if (strlen($nome) > 0) {
						array_push($dcc['contributor.author'],$nome);
					}
					break;
				case '710' :
					$nome = $this -> extract($name, '$a');
					if (strlen($nome) > 0) {
						array_push($dcc['contributor.author'],$nome);
					}
					break;
				/********************** autoridade instituicao **************/
				case '111' :
					$nome = $this -> extract($name, '$a');
					if (strlen($nome) > 0) {
						array_push($dcc['contributor.author'],$nome);
					}
					break;
				case '711' :
					$nome = $this -> extract($name, '$a');
					if (strlen($nome) > 0) {
						array_push($dcc['contributor.author'],$nome);
					}
					break;


				/********************** assunto **************/
				case '245' :
					$nome = $this -> extract($name, '$a');
					$sub = $this -> extract($name, '$b');
					if (strlen($nome) > 0) {
						$nome = trim(troca($nome, '/', ''));
						$nome = trim(troca($nome, ':', ''));
						if (strlen($sub) > 0) {
							$sub = trim(troca($sub, ':', ''));
							$sub = trim(troca($sub, '/', ''));
							$sub = trim($sub);
							$dcc[$sub] = 'subtitle';
						}
						$dcc['title'] = $nome;
						if (strlen($sub) > 0)
							{
								$dcc['title'] .': '.$sub;
							}
					}
					break;
				/********************** assunto **************/
				case '246' :
					$nome = $this -> extract($name, '$a');
					if (strlen($nome) > 0) {
						$dcc['title.alternative'] = $nome;
					}
					break;
				/********************** assunto **************/
				case '260' :
					$nome = trim($this -> extract($name, '$a'));
					$nome .= ' ' . troca(trim($this -> extract($name, '$b')), ',', '');
					$nome = troca($nome, ' :', ':');
					$nome = trim($nome);
					if (strlen($nome) > 0) {
						$dcc[$nome] = 'publisher';
					}

					$nome = trim($this -> extract($name, '$c'));
					if (strlen($nome) > 0) {
						$nome = troca($nome, '.', '');
						$nome = troca($nome,'[','');
						$nome = troca($nome,']','');
						$nome = troca($nome,'?','');
						$dcc['date.created'] = $nome;
					}
					break;
				/********************** assunto **************/
				case '300' :
					$nome = $name;

					$nome1 = trim($this -> extract($name, '$a'));
					$nome2 = trim($this -> extract($name, '$b'));
					$nome3 = trim($this -> extract($name, '$c'));
					$nome = trim($nome1 . ' ' . $nome2 . ' ' . $nome3);
					if (strlen($nome) > 0) {
						$dcc[$nome] = 'format.extent';
					}
					if (strpos(' ' . $name, '$3')) {
						$nome = trim($this -> extract($name, '$3'));
						if (strlen($nome) > 0) {
							$dcc['ispartofseries'] = $nome;
							$dcc['type'] = $nome;
						}
					}

					break;

				/********************** assunto **************/
				case '650' :
					$nome = $this -> extract($name, '$a');
					if (strlen($nome) > 0) {
						array_push($dcc['subject'], $nome);
						//$dcc[$nome] = 'subject.topico';
					}
					break;
				/********************** assunto local **************/
				case '651' :
					$nome = $this -> extract($name, '$a');
					if (strlen($nome) > 0) {
						if (!isset($dcc[$nome])) {
							array_push($dcc['subject'], $nome);
							//$dcc[$nome] = 'coverpage.spatial';
						}
					}
					break;
				/********************** documento empresa **************/
				case '653' :
					$nome = trim($this -> extract($name, '$a'));
					if (strlen($nome) > 0) {
						if (!isset($dcc[$nome])) {
							array_push($dcc['subject'], $nome);
							//$dcc[$nome] = 'coverpage.NaoControlado';
						}
					}
					break;
			}
		}
		$dcc;
		//echo '<pre>';
		//print_r($dcc);
		//exit;
		return ($dcc);
	}
	function extract($v, $f) {
		if (strpos(' ' . $v, $f) > 0) {
			$n = substr($v, strpos($v, $f) + 2, strlen($v));
			if (strpos($n, '$') > 0) {
				$n = trim(substr($n, 0, strpos($n, '$')));
				if (substr($n, strlen($n) - 1, 1) == ':') {
					$n = trim(substr($n, 0, strlen($n) - 1));
				}
			}
			return (trim($n));
		} else {
			return ('');
		}
	}
}
