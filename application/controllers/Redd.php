<?php

class Redd extends CI_controller {
    function __construct() {
        parent::__construct();
        $this -> lang -> load("redd", "portuguese");
        //$this -> lang -> load("skos", "portuguese");
        //$this -> load -> library('form_validation');
        $this -> load -> database("redd");
        $this -> load -> helper('form');
        $this -> load -> helper('form_sisdoc');
        $this -> load -> helper('url');
        $this -> load -> library('session');
        $this -> load -> library('zip');
        $this -> load -> helper('xml');
        $this -> load -> library('curl');
        $this -> load -> helper('rdf');
        define('PATH','index.php/redd/');
        date_default_timezone_set('America/Sao_Paulo');
        /* Security */
        //		$this -> security();
    }
    
    public function sucupira()
    {
        $this->load->model("sucupiras");
        $this->sucupiras->process();
    }

    public function cab($navbar = 1) {
        $data['title'] = ':: ReDD ::';
        $this -> load -> view('redd/header/header', $data);
        if ($navbar == 1) {
            $this -> load -> view('redd/header/navbar', null);
        }
    }

    public function foot() {
        $this -> load -> view('header/footer');
    }

    public function index() {
        $this -> cab();
    }

    public function v($id) {
        $this -> load -> model('lattes');
        
        $this -> cab();
        $tela = $this -> lattes -> v($id);
        $data['content'] = $tela;
        $this -> load -> view('content', $data);
        $this -> foot();
    }    

    public function tools($act='') {
        $this -> load -> model('lattes');
        $this -> load -> model('highcharts');
        $this -> load -> model('researchers');

        $sx = '';
        $this -> cab();
        switch ($act)
            {
                case 'files':
                    $sx = $this->lattes->zip_register();
                    $sx .= '<br/><a href="'.PATH.'tools">Voltar</a>';
                    break;
                default:
                    $sx = '<a href="'.PATH.'tools/files'.'">Processar arquivos</a>';
                    break;
            }
        $data['content'] = $sx;
        $this -> load -> view('content', $data);            
    }    

    public function id($id='',$chk='',$cmd='')
    {
        $this -> load -> model('lattes');
        $this -> load -> model('highcharts');
        $this -> load -> model('researchers');
        $this -> cab();
        $this -> load -> view('highchart/header');            
        if (strlen($cmd) == 0)
        {
            $data = $this -> researchers -> le($id);

            $data['fluid'] = true;
            $data['bg'] = '#e8e8e8';
            $data['chk'] = $chk;
            $data['content'] = $this -> load -> view('redd/profile', $data, true);
            $this -> load -> view('content', $data);

            $data['fluid'] = false;
            $data['content'] = $this->researchers->research($data);
            $idp = $data['r_lattes_id'];

            $data['content'] .= $this -> lattes -> lista_publicacoes($idp, 'ARTIG');
            $data['content'] .= $this -> lattes -> lista_publicacoes($idp, 'EVENT');
            $data['content'] .= $this -> lattes -> lista_publicacoes($idp, 'LIVRO');
            $data['content'] .= $this -> lattes -> orientacao_list($idp);

            /*****************************************************************/
            $data['fluid'] = false;
            $this -> load -> view('content', $data);
        } else {
            /* Actions */
            switch($cmd) {
                case 'inport' :
                $this -> load -> model('lattes');

                $file = $this -> researchers -> lattesReadXML($id);
                redirect(base_url('index.php/redd/id/' . $id . '/' . checkpost_link($id)));
                break;


            }           

        }
        $this -> foot();
    }

    public function edit($id = '', $chk = '') {
        $this -> load -> model('researchers');
        $this -> cab();

        $form = new form;
        $form -> cp = $this -> researchers -> cp();
        $form -> id = $id;

        $data['content'] = $form -> editar($form -> cp, $this -> researchers -> table);
        $data['title'] = msg('Research');
        $this -> load -> view('content', $data);
        $this -> load -> view('header/footer', null);

        if ($form -> saved > 0) {
            redirect(base_url('index.php/redd/select'));
        }
    }

    public function select_ppg_line_sel($id = '') {
        $this -> load -> model('researchers');
        $this -> cab();  
        
        $this->researchers->ppg_line_list($id);
        
    }

    public function select_ppg_line($id = '') {
        $this -> load -> model('researchers');
        $this -> cab();

        /* Lista de comunicacoes anteriores */
        $form = new form;
        $form -> tabela = "(select * from researcher_ppg inner join researcher_ppg_line ON id_rp = rpl_ppg) as tabela";
        $form -> see = true;
        $form -> edit = false;
        $form -> novo = True;
        $form = $this -> researchers -> row_ppg_line($form);

        $form -> row_edit = base_url('index.php/redd/edit');
        $form -> row_view = base_url('index.php/redd/select_ppg_line_sel');
        $form -> row = base_url('index.php/redd/select_ppg_line/');

        $data['content'] = row($form, $id);
        $data['title'] = msg('ppg_line');

        $this -> load -> view('content', $data);

        $this -> load -> view('header/footer', $data);
    }

    public function select($id = '') {
        $this -> load -> model('researchers');
        $this -> cab();

        /* Lista de comunicacoes anteriores */
        $form = new form;
        $form -> tabela = $this -> researchers -> table;
        $form -> see = true;
        $form -> edit = True;
        $form -> novo = True;
        $form = $this -> researchers -> row($form);

        $form -> row_edit = base_url('index.php/redd/edit');
        $form -> row_view = base_url('index.php/redd/id');
        $form -> row = base_url('index.php/redd/select/');

        $data['content'] = row($form, $id);
        $data['title'] = msg('researchers');

        $this -> load -> view('content', $data);

        $this -> load -> view('header/footer', $data);
    }

    public function qualis($id = '') {
        $this -> load -> model('lattes');
        $this -> cab();
        $data = array();

        if ($id == 'inport') {
            $sx = $this -> lattes -> qualis_inport('_documment/classificacoes_publicadas_comunicacao_e_informacao_2017_1496941693687.xls');
            $data['content'] = $sx;
        } else {
            $data['content'] = $this -> lattes -> row_qualis($id);
            $data['content'] = '<a href="' . base_url('index.php/redd/qualis/inport/') . '" class="btn btn-primary">Inport Qualis</a>' . $data['content'];
            $data['title'] = msg('Qualis');
        }

        $this -> load -> view('content', $data);
        $this -> load -> view('header/footer', $data);
    }
    public function textminer() {
        $this -> load -> model('textminer');
        $this -> cab();
        $data = array();
        
        $tela = $this->textminer->form_1();
        $dd1 = get("dd1");
        if (strlen($dd1) > 0)
        {
            $tela .= '<pre>'.$this->textminer->email_extractor($dd1).'</pre>';
        }

        $data['content'] = $tela;

        $this -> load -> view('content', $data);
        $this -> load -> view('header/footer', $data);
    }
    public function webqualis($act='') {
        $this -> load -> model('qualis');
        $this -> cab();
        //$this->qualis->issnl_inport();
        //$tela = $this->qualis->inport();
        $tela = $this->qualis->inport_sjr();
        $data['content'] = $tela;

        $this -> load -> view('content', $data);
        $this -> load -> view('header/footer', $data);
    }
}
?>
