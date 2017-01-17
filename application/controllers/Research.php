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
		
		/* Actions */
		switch($cmd) {
			case 'inport' :
				$this -> load -> model('lattes');
				$file = $this -> researchers -> lattesReadXML($id);
		}
		$data = $this -> researchers -> le($id);
		$data['fluid'] = true;
		$data['bg'] = '#e8e8e8';
		$data['content'] = $this -> load -> view('research/profile', $data, true);
		$this -> load -> view('content', $data);
	}
	
	public function edit($id='',$chk='')
		{
		$this -> load -> model('researchers');
		$this -> cab();
		
		$form = new form;
		$form->cp = $this->researchers->cp();	
		$form->id = $id;
		
		$data['content'] = $form->editar($form->cp,$this->researchers->table);
		$data['title'] = msg('Research');
		$this->load->view('content',$data);
		$this->load->view('header/footer',null);
		
		if ($form->saved > 0)
			{
				redirect(base_url('index.php/research/researchers'));	
			}		
		}

	public function researchers($id='') {
		$this -> load -> model('researchers');
		$this -> cab();

		/* Lista de comunicacoes anteriores */
		$form = new form;
		$form -> tabela = $this -> researchers -> table;
		$form -> see = true;
		$form -> edit = True;
		$form -> novo = True;
		$form = $this -> researchers -> row($form);

		$form -> row_edit = base_url('index.php/research/edit');
		$form -> row_view = base_url('index.php/research/id');
		$form -> row = base_url('index.php/research/researchers/');

		$data['content'] = row($form, $id);
		$data['title'] = msg('researchers');

		$this -> load -> view('content', $data);

		$this -> load -> view('header/footer', $data);
	}

}
?>
