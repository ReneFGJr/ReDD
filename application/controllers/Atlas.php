<?php
class Atlas extends CI_controller
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
			$data['title'] = ':: ReDD - Atlas ::';
			$this->load->view('header/header',$data);
			if ($navbar==1)
				{
					$this->load->view('handle/header/navbar',null);
				}
		}
	public function index()
		{
			$this->cab();
			
			redirect(base_url('index.php/atlas/pages'));
			$this->load->view('content',$data);
		}
	public function pages($p='')
		{
		    $this->load->model('iiifs');
			$this->cab(0);
            $data = array();
            //$this->iiifs->reciver_info_image('018.tif');
            //$data['content'] = $this->iiifs->show();
            //$this->load->view('content',$data);
            
            $this->load->view('atlas',$data);
		}
    public function zoom($img='')
        {
            $this->load->model('iiifs');
            $this->cab(0);
            $data = array();
            //$this->iiifs->reciver_info_image($img);
            $data['content'] = $this->iiifs->show($img);
            $this->load->view('content',$data);
        }        			
	}
?>
