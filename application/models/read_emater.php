<?php
class read_emater extends CI_model {
	var $table = 'metadados_emater';
		
	function data($id) {
		$sql = "select * from " . $this -> table . " where cod_acervo = $id";
		$rlt = $this -> db -> query($sql);
		$rlt = $rlt -> result_array();

		$dc = array();
		$dcc = array();
		$dcc['id'] = $id;
		$dcc['subject'] = array();
		$dcc['subject.entidade'] = array();
		$dcc['subject.evento'] = array();
		$dcc['subject.topico'] = array();
		$dcc['coverage.spatial'] = array();
		$dcc['subject.NaoControlado'] = array();
		$dcc['description'] = array();
		//$dcc['identifier.']
		
		
		$dcc['subject.topico'] = array();
		
		$dcc['subject.entidade'] = array();
		$dcc['contributor.author'] = array();
		$dcc['title.alternative'] = '';
		$dcc['title'] = '';
		$dcc['sponsorship'] = 'Emater/ASCAR - RS';
		$dcc['publisher'] = 'Emater/ASCAR - RS';
		$dcc['contributor.AuthorPessoal'] = array();
		$dcc['contributor.AuthorEntidade'] = array();
		$dcc['contributor.AuthorEvento'] = array();
		
		
		$dcc['ispartofseries'] = '';
		for ($r = 0; $r < count($rlt); $r++) {
			$line = $rlt[$r];
			$cod = trim($line['paragrafo']);
			$name = trim($line['var2']);
			switch($cod) {
				/********************** chamada *******************/
				//case '90' :
				//	$nome = $this -> extract($name, '$a');
				//	if (strlen($nome) > 0) {
				//		array_push($dcc['subject'], $nome);
				//	}
				//	break;
				/********************** autoridade pessoa *******************/
				case '500':
					$nome = $this -> extract($name, '$a');
					array_push($dcc['description'],$nome);
					break;
				case '502':
					$nome = $this -> extract($name, '$a');
					array_push($dcc['description'],$nome);
					break;					
				case '505':
					$nome = $this -> extract($name, '$a');
					array_push($dcc['description'],$nome);
					break;
				case '506':
					$nome = $this -> extract($name, '$a');
					array_push($dcc['description'],$nome);
					break;
				case '513':
					$nome = $this -> extract($name, '$a');
					array_push($dcc['description'],$nome);
					break;
				case '515':
					$nome = $this -> extract($name, '$a');
					array_push($dcc['description'],$nome);
					break;																				
				case '520':
					$nome = $this -> extract($name, '$a');
					array_push($dcc['description'],$nome);
					break;																				
				case '533':
					$nome = $this -> extract($name, '$a');
					array_push($dcc['description'],$nome);
					break;																				
				case '590':
					$nome = $this -> extract($name, '$a');
					array_push($dcc['description'],$nome);
					break;																				
				case '100' :
					$nome = $this -> extract($name, '$a');
					if (strlen($nome) > 0) {
						array_push($dcc['contributor.AuthorPessoal'],$nome);
					}
					break;
				case '700' :
					$nome = $this -> extract($name, '$a');
					if (strlen($nome) > 0) {
						array_push($dcc['contributor.AuthorPessoal'],$nome);
					}
					break;

				/********************** autoridade instituicao **************/
				case '110' :
					$nome = $this -> extract($name, '$a');
					$sub = $this -> extract($name, '$b');
					$sub2 = $this -> extract($name, '$c');
					$sub3 = $this -> extract($name, '$d');
					if (strlen($nome) > 0) {
						if (strlen($sub) > 0)
							{
								$nome .= '. '.$sub;
							}
						if (strlen($sub2) > 0)
							{
								$nome .= '. '.$sub2;
							}
						if (strlen($sub3) > 0)
							{
								$nome .= '. '.$sub3;
							}							
						$nome = troca($nome,'..','.');							
						array_push($dcc['contributor.AuthorEntidade'],$nome);
					}
					break;
				case '710' :
					$nome = $this -> extract($name, '$a');
					$sub = $this -> extract($name, '$b');
					$sub2 = $this -> extract($name, '$c');
					$sub3 = $this -> extract($name, '$d');
					if (strlen($nome) > 0) {
						if (strlen($sub) > 0)
							{
								$nome .= '. '.$sub;
							}
						if (strlen($sub2) > 0)
							{
								$nome .= '. '.$sub2;
							}
						if (strlen($sub3) > 0)
							{
								$nome .= '. '.$sub3;
							}
						$nome = troca($nome,'..','.');							
						array_push($dcc['contributor.AuthorEntidade'],$nome);
					}
					break;
				/********************** autoridade instituicao **************/
				case '111' :
					$nome = $this -> extract($name, '$a');
					$sub = $this -> extract($name, '$c');
					$sub2 = $this -> extract($name, '$d');
					$sub3 = $this -> extract($name, '$g');
					if (strlen($nome) > 0) {
						if (strlen($sub) > 0)
							{
								$nome .= '. '.$sub;
							}
						if (strlen($sub2) > 0)
							{
								$nome .= '. '.$sub2;
							}
						if (strlen($sub3) > 0)
							{
								$nome .= '. '.$sub3;
							}							
						array_push($dcc['contributor.AuthorEvento'],$nome);
					}					
					$nome = troca($nome,'..','.');							
					break;
				case '711' :
					$nome = $this -> extract($name, '$a');
					$sub = $this -> extract($name, '$c');
					$sub2 = $this -> extract($name, '$d');
					$sub3 = $this -> extract($name, '$g');
					if (strlen($nome) > 0) {
						if (strlen($sub) > 0)
							{
								$nome .= '. '.$sub;
							}
						if (strlen($sub2) > 0)
							{
								$nome .= '. '.$sub2;
							}
						if (strlen($sub3) > 0)
							{
								$nome .= '. '.$sub3;
							}							
						array_push($dcc['contributor.AuthorEvento'],$nome);
					}					
					$nome = troca($nome,'..','.');							
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
								$dcc['title'] .=': '.$sub;
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
				case '255' :
					$nome = $this -> extract($name, '$a');
					if (strlen($nome) > 0) {
						array_push($dcc['description.escala'],$nome);
					}
					break;					
				/********************** assunto **************/
				case '260' :
					$nome = trim($this -> extract($name, '$a'));					 
					$nome2 = troca(trim($this -> extract($name, '$b')), ',', '');
					if ((strlen($nome) > 0) and (strlen($nome2) > 0))
						{
							$nome .= ': ' .$nome2;
							$nome = troca($nome,': :', ':');
						}
					$nome = troca($nome, ' :', ':');
					$nome = trim($nome);
					if (strlen($nome) > 0) {
						$dcc['publisher'] = $nome;
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
						$dcc['format.extent'] = $nome;
					}
					if (strpos(' ' . $name, '$3')) {
						$nome = trim($this -> extract($name, '$3'));
						if (strlen($nome) > 0) {
							$dcc['ispartofseries'] = $nome;
							$dcc['type'] = $nome;
						}
					}

					break;
				/* 610 */
				case '610':
					$nome = $this -> extract($name, '$a');
					if (strlen($nome) > 0) {
						array_push($dcc['subject.entidade'], $nome);
						//$dcc[$nome] = 'subject.topico';
					}
					break;
				case '611':
					$nome = $this -> extract($name, '$a');
					if (strlen($nome) > 0) {
						array_push($dcc['subject.evento'], $nome);
						//$dcc[$nome] = 'subject.topico';
					}
					break;					
				/********************** assunto **************/
				case '650' :
					$nome = $this -> extract($name, '$a');
					if (strlen($nome) > 0) {
						array_push($dcc['subject.topico'], $nome);
						//$dcc[$nome] = 'subject.topico';
					}
					break;
				/********************** assunto **************/
				case '651' :
					$nome = $this -> extract($name, '$a');
					if (strlen($nome) > 0) {
						array_push($dcc['coverage.spatial'], $nome);
						//$dcc[$nome] = 'subject.topico';
					}
					break;					
				/********************** assunto local **************/
				case '653' :
					$nome = $this -> extract($name, '$a');
					if (strlen($nome) > 0) {
						if (!isset($dcc[$nome])) {
							array_push($dcc['subject.NaoControlado'], $nome);
							//$dcc[$nome] = 'coverpage.spatial';
						}
					}
					break;
				/********************** documento empresa **************/
				case '697' :
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
