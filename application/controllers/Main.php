<?php
class Main extends CI_controller
	{
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
	public function cab($navbar=1)
		{
			$data['title'] = ':: ReDD - Login ::';
			$this->load->view('header/header',$data);
			if ($navbar==1)
				{
					$this->load->view('header/navbar',null);
				}
		}
	public function index()
		{
			$this->cab();
		}	
	public function researchers()
		{
			$this->load->model('researchers');
			$this->cab();
			
			$data['content'] = $this->researchers->row();
			$this->load->view('content',$data);
		}
	}
?>
