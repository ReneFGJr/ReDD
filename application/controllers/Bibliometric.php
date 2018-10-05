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
		$data['title'] = ':: ReDD - Bibliometric Tools ::';
		$data['pag'] = 2;
		$this -> load -> view('header/header', $data);
		if ($navbar == 1) {
			$this -> load -> view('header/navbar', null);
		}
	}

	public function index() {
		$this->cab();
	}

	public function tools() {
		$this->load->model('Bibliometrics');
		$this->cab();
		$ac = get("dd4");
		
		switch($ac)
			{
			case '1':
				$dd1 = get("dd1");
				$_POST['dd2'] = $this->Bibliometrics->action_remover_entre_colchetes($dd1);
				break;
			case '2':
				$dd1 = get("dd1");
				$dd3 = get("dd3");
				$_POST['dd2'] = $this->Bibliometrics->action_troca_remissicas($dd1,$dd3);
				break;				
			}
		
		$tela = $this->Bibliometrics->form();
		
		
		$data['content'] = $tela;
		$this->load->view('content',$data);
	}

}
?>
