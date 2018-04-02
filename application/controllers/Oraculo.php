<?php
class Oraculo extends CI_controller {
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
		date_default_timezone_set('America/Sao_Paulo');
		/* Security */
		//		$this -> security();
	}

	public function cab($navbar = 1) {
		$data['title'] = ':: ReDD - Login ::';
		$this -> load -> view('header/header', $data);
		if ($navbar == 1) {
			$this -> load -> view('header/navbar', null);
		}
	}

	private function foot() {
		$this -> load -> view('header/footer');
	}

	function vocabulario() {
		$this -> load -> model("tools");
		$tela = '';
		$this -> cab();
		$this -> load -> view('oraculo/search');

		$cp = array();
		$form = new form;
		array_push($cp, array('$H8', '', '', false, false));
		array_push($cp, array('$T80:8', '', 'Termos', true, true));
		array_push($cp, array('$B8', '', 'Analisar >>>', false, false));
		$tela = $form -> editar($cp, '');

		if ($form -> saved > 0) {
			$t = get("dd1");
			$tela = '<pre>'.$this -> tools -> terms($t).'</pre>';
		}
		$data['content'] = $tela;
		$this -> load -> view('content', $data);
		$this -> foot();

	}

	function index() {
		$this -> load -> model("tools");
		$tela = '';
		$this -> cab();
		$this -> load -> view('oraculo/search');

		$cmd = get("dd1");
		$cmd = troca($cmd, ' ', ';');
		$cmd = splitx(';', $cmd);
		//PRINT_R($cmd);
		if (isset($cmd[0])) {
			switch (trim($cmd[0])) {
				case 'vocabulario' :
					redirect(base_url('index.php/oraculo/vocabulario'));
					break;
				case 'fromto' :
					$tela = '<h3>De/Para</h3>';
					for ($r = 0; $r < 100; $r++) {
						if (isset($_SESSION['file_' . $r])) {
							$arq = $_SESSION['file_' . $r];
							$tela .= '<hr>';
							$tela .= $this -> tools -> from_to($arq);
						}
					}
					break;
				case 'open' :
					$tela = '<h3>Open</h3>';
					for ($r = 0; $r < 100; $r++) {
						if (isset($_SESSION['file_' . $r])) {
							$arq = $_SESSION['file_' . $r];
							$tela .= '<hr>';
							$tela .= $this -> tools -> open($arq);
						}
					}
					break;
				case 'use' :
					$idf = get("q");
					$arq = $this -> tools -> arquivo('_tmp/repo/', get("q"), $idf);
					if (isset($_SESSION['file'])) {
						$if = round($_SESSION['file']);
						$if++;
					} else {
						$if = 0;
					}
					$_SESSION['file'] = $if;
					$_SESSION['file_' . $if] = $arq;
					redirect(base_url('index.php/oraculo?dd1=open'));
					break;
				case 'file' :
					$idf = get("q");
					$arq = $this -> tools -> arquivo('_tmp/repo/', get("q"), $idf);
					$tela = '<h3>ARQUIVO: ' . get("q") . '</h3>';
					$tela .= $this -> tools -> arquivo('_tmp/repo/', get("q"));
					$ext = $this -> tools -> file_extension($arq);
					$tela .= '[' . $ext . ']';
					$tela .= '<hr>';
					switch($ext) {
						case 'csv' :
							$tela .= '<a href="' . base_url('index.php/oraculo/?dd1=use&q=' . $idf) . '" class="btn btn-default">Use</a>';
							//$tela .= '<a href="'.base_url('index.php/oraculo/?dd1=file_open&q='.$idf).'" class="btn btn-default">Open</a>';
							break;
					}
					break;
				case 'dir' :
					$tela = '<h3>DIRETÓRIO: ' . get("d") . '</h3>';
					$tela .= $this -> tools -> diretorio('_tmp/repo/');
					break;
				case 'inport' :
					$tela = '<h3>Inport</h3>';
					if (isset($cmd[1])) {
						switch($cmd[1]) {
							case 'csv' :
								$tela .= $this -> tools -> file_upload();
								$tela .= $this -> tools -> file_upload_save_to_temp();
								break;
							default :
								$tela .= '
										<div class="alert alert-danger" role="alert">
										  Formato "<b>"' . $cmd[1] . '</b>" desconhecido de importação
										</div>';
								break;
						}
					} else {
						$tela .= '
							<div class="alert alert-danger" role="alert">
							  tipo de importação não informada
							</div>
							';
					}
					break;
			}
		}
		$data['content'] = $tela;
		$this -> load -> view('content', $data);
		$this -> foot();

	}

}
?>
