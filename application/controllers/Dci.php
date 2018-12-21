<?php
class DCI extends CI_controller {
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
		$data['title'] = ':: ReDD - DCI ::';
		$this -> load -> view('header/header', $data);
		if ($navbar == 1) {
			$this -> load -> view('header/navbar', null);
		}
	}

	private function foot() {
		$this -> load -> view('header/footer');
	}	

	function index() {
		$this -> load -> model("dcis");
		$tela = '';
		$this -> cab();
		$this -> load -> view('oraculo/search');

		$cmd = get("dd1");
		$cmd = troca($cmd, ' ', ';');
		$cmd = splitx(';', $cmd);
		//PRINT_R($cmd);
		if (isset($cmd[0])) {
			switch (trim($cmd[0])) {
                case 'cursos':
                    $tela = $this->dcis->cursos();
                    break;
            default:
                break;
			}
		}
		$data['content'] = $tela;
		$this -> load -> view('content', $data);
		$this -> foot();
	}

    function cursos($id=0)
        {
        $this -> load -> model("dcis");
        $tela = '';
        $this -> cab();
        
        $tela .= $this->dcis->curso_show($id);
        
        $tela .= $this->dcis->docentes_curso($id);

        $data['content'] = $tela;
        $this -> load -> view('content', $data);
        $this -> foot();   
        }
    function docente($id=0)
        {
        $this -> load -> model("dcis");
        $tela = '';
        $this -> cab();
        
        $tela .= $this->dcis->docente_show($id);
        
        $tela .= $this->dcis->docentes_disciplinas($id);

        $data['content'] = $tela;
        $this -> load -> view('content', $data);
        $this -> foot();   
        }

}
?>
