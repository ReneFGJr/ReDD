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

	function index() {
		$this->load->model("tools");
		$tela = '';
		$this -> cab();
		$this -> load -> view('oraculo/search');

		$cmd = get("dd1");
		$cmd = troca($cmd, ' ', ';');
		$cmd = splitx(';', $cmd);
		if (isset($cmd[0])) {
			switch ($cmd[0]) {
				case 'inport' :
					$tela = '<h3>Inport</h3>';
					if (isset($cmd[1]))
						{
							switch($cmd[1])
								{
								case 'csv':
									$tela .= $this->tools->file_upload();
									$tela .= $this->tools->file_upload_save_to_temp();
									break;
								default:
									$tela .= '
										<div class="alert alert-danger" role="alert">
										  Formato "<b>"'.$cmd[1].'</b>" desconhecido de importação
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
