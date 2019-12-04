<?php
class CDU extends CI_controller {
    
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
        define("PATH","index.php/cdu/");
        /* Security */
        //		$this -> security();
    }

    public function cab($navbar = 1) {
        $data['title'] = ':: ReDD - Classificação Decimal Universal ::';
        
        $m = array();
        array_push($m,array('Banco de Questões',base_url(PATH.'bank')));
        $data['menu'] = $m;
        $this -> load -> view('header/header', $data);
        if ($navbar == 1) {
            $this -> load -> view('header/navbar', null);
        }
    }

    private function foot() {
        $this -> load -> view('header/footer');
    }

    function q($id='')
        {
            $this->load->model('cdus');
            $this->cab();
            $sx = $this->cdus->qst($id);
            $data['content'] = $sx;
            $this -> load -> view('content', $data);
            
            $this->foot();
        }    

    function bank($id='')
        {
            $this->load->model('cdus');
            $this->cab();
            $sx = $this->cdus->row();
            $data['content'] = $sx;
            $this -> load -> view('content', $data);

            $this->foot();
        }

    function bank_inport($id='')
        {
            $this->load->model('cdus');
            $this->cab();
            $sx = $this->cdus->form();
            $sx .= $this->cdus->bank($id);

            $data['content'] = $sx;
            $this -> load -> view('content', $data);

            $this->foot();
        }

    function index() {
        $this -> load -> model("cdus");
        $tela = '';
        $this -> cab();
        $tela = "CDU";
        $data['content'] = $tela;
        $this -> load -> view('content', $data);
        $this -> foot();
    }

    function cursos($id = 0) {
        $this -> load -> model("dcis");
        $tela = '';
        $this -> cab();

        $tela .= $this -> dcis -> curso_show($id);

        $tela .= $this -> dcis -> docentes_curso($id);

        $data['content'] = $tela;
        $this -> load -> view('content', $data);
        $this -> foot();
    }

    function discilina_ed($id = 0) {
       $this -> load -> model("dcis");
        $tela = '';
        $this -> cab();

        $tela .= $this -> dcis -> disciplinas_ed($id);

        $data['content'] = $tela;
        $this -> load -> view('content', $data);
        $this -> foot();
    }

    function disciplinas($id = 0) {
        $this -> load -> model("dcis");
        $tela = '';
        $this -> cab();

        $tela .= $this -> dcis -> row_disciplinas($id);

        //$tela .= $this->dcis->docentes_curso($id);

        $data['content'] = $tela;
        $this -> load -> view('content', $data);
        $this -> foot();
    }
    
    function docente_disciplina($id=0)
        {
        $this -> load -> model("dcis");
        $tela = '';
        $this -> cab();

        $tela .= $this -> dcis -> docente_show($id);
        $tela .= $this -> dcis -> docente_disciplina_add($id);

        $data['content'] = $tela;
        $this -> load -> view('content', $data);
        $this -> foot();            
        }

    function docente($id = 0) {
        $this -> load -> model("dcis");
        $tela = '';
        $this -> cab();

        $tela .= $this -> dcis -> docente_show($id);

        $tela .= $this -> dcis -> docentes_disciplinas($id);
        
        $tela .= $this -> dcis -> docentes_disciplinas_nova($id);

        $data['content'] = $tela;
        $this -> load -> view('content', $data);
        $this -> foot();
    }

}
?>