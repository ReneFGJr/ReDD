<?php
class Handle extends CI_controller
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
		$this -> load -> library('tcpdf');
		date_default_timezone_set('America/Sao_Paulo');
		/* Security */
		//		$this -> security();
	}		
	public function cab($navbar=1)
		{
			$data['title'] = ':: ReDD - Handle ::';
			$this->load->view('header/header',$data);
			if ($navbar==1)
				{
					$this->load->view('handle/header/navbar',null);
				}
		}
	public function index()
		{
			$this->cab();
			
			$tela = '<a href="'.base_url('index.php/oraculo').'">oráculo</a>';
			$data['content'] = $tela;
			$this->load->view('content',$data);
		}
	public function process($pth='',$cmd='')
		{
			global $handle;
			$srv = 'read_emater';
			$this->cab();
			$this->load->model("dspace");
			$this->load->model($srv);			
			$this->source_function = $srv;
			$handle = $this->$srv->handle;
								
			$lote = 'lote_'.date("Ymd_His");
			$lote = 'lote_'.date("Ymd");
			$lote = $pth;
			$this->dspace->gerar_cip($lote);
			
			$tela = $this->dspace->diretorio($pth,$lote);
			$data['content'] = $tela;
			$this->load->view("content",$data);			
		}			
	public function cover($id='')
		{
			$this->load->model('coversheet');
			if (strlen(get("dd1") > 0))
				{
					$id = get("dd1");
				}
			
			if (strlen($id) == 0)
				{
					$this->cab();
					$data['content'] = $this->coversheet->row();
					$this->load->view('content',$data);					
				} else {
					$this->coversheet->pdf($id);
				}
			
		}
	}
?>
