<?php
class Research extends CI_controller {
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
		$this -> load -> view('header/header', $data);
		if ($navbar == 1) {
			$this -> load -> view('header/navbar', null);
		}
	}

	public function index() {
		$this -> cab();
	}

	public function id($id = '', $cmd = '') {
		$this -> load -> model('researchers');
		$this -> cab();
		$data = $this -> researchers -> le($id);
		/* Actions */
		switch($cmd) {
			case 'inport' :
				$this -> load -> model('lattes');
				$file = $this -> lattes -> readXML($data['r_xml']);
		}
		$data['fluid'] = true;
		$data['bg'] = '#cecece';
		$data['content'] = $this -> load -> view('research/profile', $data, true);
		$this -> load -> view('content', $data);
	}

	public function researchers() {
		$this -> load -> model('researchers');
		$this -> cab();

		$data['content'] = $this -> researchers -> row();
		$this -> load -> view('content', $data);
	}

}
?>
