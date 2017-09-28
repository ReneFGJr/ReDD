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
		$this -> load -> library('zip');
		$this -> load -> helper('xml');
		$this -> load -> library('curl');

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
    
    public function foot()
        {
            $this->load->view('header/footer');
        }

	public function index() {
		$this -> cab();
	}

	public function id($id = '', $cmd = '') {
		$this -> load -> model('lattes');
		$this -> load -> model('highcharts');
		$this -> load -> model('researchers');
		$this -> cab();
		$this->load->view('highchart/header');
		
		
		/* Actions */
		switch($cmd) {
			case 'inport' :
				$this -> load -> model('lattes');
				$file = $this -> researchers -> lattesReadXML($id);
				redirect(base_url('index.php/research/id/'.$id.'/'.checkpost_link($id)));
		}
		
		$data = $this -> researchers -> le($id);
		$data['fluid'] = true;
		$data['bg'] = '#e8e8e8';
		$data['content'] = $this -> load -> view('research/profile', $data, true);
		$this -> load -> view('content', $data);
		
		/* Graficos */
		$id = $data['r_lattes_id'];
        
        $dt = array();
        $dt['series'] = array();
        $dt['data'] = array();

        /***/ 
        $biblio = $this->lattes->producao($id,'ARTIG');
        array_push($dt['series'],'Artigos');
        array_push($dt['data'],$this->lattes->dados);
        
        /* EVENT */
        $event = $this->lattes->producao($id,'EVENT');
        array_push($dt['series'],'Eventos');
        array_push($dt['data'],$this->lattes->dados);
        
        /* LIVRO */
        $event = $this->lattes->producao($id,'LIVRO');
        array_push($dt['series'],'Livros');
        array_push($dt['data'],$this->lattes->dados);        
                          
              
        $dt['serie'] = 'Produção em artigos';
        $dt['title'] = 'Produção em Artigos de Periódicos';
        $dt['subtitle'] = 'Entre os anos de '.(date("Y")-$this->lattes->limit).' e '.date("Y");
            
        $sx = $this->highcharts->column_simple($dt,'prod01');    
        
        $data['fluid'] = false;    
		$data['content'] = $sx;
        
	
		$data['content'] .= $this->lattes->lista_publicacoes($id,'ARTIG');
        $data['content'] .= $this->lattes->lista_publicacoes($id,'EVENT');
        $data['content'] .= $this->lattes->lista_publicacoes($id,'LIVRO');
        
        /*****************************************************************/
		$data['fluid'] = false;
		$this -> load -> view('content', $data);
        
        $this->foot();
		
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
