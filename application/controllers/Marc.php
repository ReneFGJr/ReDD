<?php
class Marc extends CI_controller
	{
	function __construct() {
	    global $handle;
        $handle = '20.500.12287';
		parent::__construct();

		$this -> lang -> load("login", "portuguese");
		//$this -> lang -> load("skos", "portuguese");
		//$this -> load -> library('form_validation');
		$this -> load -> database();
		$this -> load -> helper('form');
		$this -> load -> helper('form_sisdoc');
		$this -> load -> helper('url');
		$this -> load -> library('session');
		$this -> load -> library('tcpdf');
		date_default_timezone_set('America/Sao_Paulo');
		/* Security */
		//		$this -> security();
	}		
	public function cab($navbar=1)
		{
			$data['title'] = ':: ReDD - MARC Editor ::';
			$this->load->view('header/header',$data);
			if ($navbar==1)
				{
					$this->load->view('handle/header/navbar',null);
				}
		}
    public function index()
        {
            redirect(base_url('index.php/marc/main'));
        }
	public function main($id=0,$fd=0,$tag=0,$act='')
		{
		    $this->load->model("marc21");
			$this->cab();
			$tela = $this->marc21->editor($id,$fd,$tag,$act);
			$data['content'] = $tela;
			$this->load->view('content',$data);
		}

	}
?>
