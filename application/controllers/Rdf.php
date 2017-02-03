<?php
class RDF extends CI_controller {
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
		$data['title'] = ':: ReDD - Login ::';
		$data['pag'] = 3;
		$this -> load -> view('header/header', $data);
		if ($navbar == 1) {
			$this -> load -> view('header/navbar', null);
		}
	}

	public function index() {
		$this -> cab();

		$tela = '<a href="' . base_url('index.php/rdf/classes') . '">Classes</a>';
		$data['title'] = '';
		$data['content'] = $tela;
		$this -> load -> view('content', $data);
	}

	public function classes() {
		$this->load->model('thesas');
		
		$this -> cab();

		$cp = array();
		array_push($cp, array('$H8', '', '', false, false));
		array_push($cp, array('$S95', '', 'Link de importação (RDF)', True, True));
		$form = new form;
		$tela = $form -> editar($cp, '');
		$data['content'] = $tela;
		$data['title'] = '';
		$this -> load -> view('content', $data);

		if ($form -> saved > 0) {
			$link = get("dd1");
			if (!(strpos('/xml', $link))) {
				$link .= '/xml';
				$this->thesas->xml_open($link);
			}
			
		}

	}

}
?>
