<?php
class Bibliometric extends CI_controller {
	function __construct() {
		parent::__construct();
		$this -> lang -> load("login", "portuguese");
		//$this -> lang -> load("skos", "portuguese");
		//$this -> load -> library('form_validation');
		$this -> load -> database();
		$this -> load -> helper('form');
		$this -> load -> helper('form_sisdoc');
		$this -> load -> helper('url');
		$this -> load -> library('session');
		$this -> load -> library('curl');
		$this -> load -> library('zip');
		$this -> load -> helper('xml');

		date_default_timezone_set('America/Sao_Paulo');
		/* Security */
		//		$this -> security();
	}

	public function cab($navbar = 1) {
		$data['title'] = ':: ReDD - Estudos Bibiliométricos ::';
		$data['pag'] = 2;
		$this -> load -> view('header/header', $data);
		if ($navbar == 1) {
			$this -> load -> view('header/navbar', null);
		}
	}

	public function index() {
		$this -> load -> model('cursos');
		$this -> cab();

		/* Model */
		$file = 'c:/lixo/cs.csv';
		$txt = load_file_local($file);

		$ln = splitx(chr(13), $txt);
		$mx = array();

		$auth = array();
		$auths = array();
		
		for ($r = 1; $r < count($ln); $r++) {
			$l = splitx(';', $ln[$r]);
			if (count($l) > 1) {
				$art = $l[0];
				for ($y = 1; $y < count($l); $y++) {
					$aut = $l[$y];
					if (!isset($auth[$aut]))
						{
							array_push($auths,$aut);
							$auth[$aut] = 1;
						}
					if (strlen($aut) > 0) {
						if (!isset($mx[$art])) {
							$mx[$art] = $aut;
						} else {
							$mx[$art] .= ';' . $aut;
						}
					}
				}
			}
		}
		/* PHASE II - Frequências de cocitação */
		$mt = array();
		foreach ($mx as $key => $value) {
			$au = splitx(';', $value);

			for ($y = 0; $y < (count($au) - 1); $y++) {
				for ($m = 1; $m < count($au); $m++) {
					$a1 = $au[$y];
					$a2 = $au[$m];
					if (isset($mt[$a1][$a2])) {
						$mt[$a1][$a2] = $mt[$a1][$a2] + 1;
					} else {
						$mt[$a1][$a2] = 1;
					}
				}
			}
		}

		sort($auths);
		/* PHASE III - Gera matrix */
		$sh = '-;';
		$sx = '';
		for ($r=0;$r < count($auths);$r++)
			{
				$a1 = $auths[$r];
				$sh .= $a1.';'; 
				$sn = $a1.';';
				for ($y=0;$y < count($auths);$y++)
					{
						$a2 = $auths[$y];
						if (isset($mt[$a1][$a2]))
							{
								$sn .= $mt[$a1][$a2].';';
							} else {
								$sn .= '0;';
							}								
					}
				$sx .= $sn.chr(13).chr(10);					
			}
		echo '<pre>';
		echo $sh.cr();
		echo $sx;
	}

}
?>
