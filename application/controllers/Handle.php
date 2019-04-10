<?php
class Handle extends CI_controller {
    function __construct() {
        global $handle;
        $handle = '20.500.12287';
        parent::__construct();

        $this -> lang -> load("login", "portuguese");
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

    public function cab($navbar = 1) {
        $data['title'] = ':: ReDD - Handle ::';
        $this -> load -> view('header/header', $data);
        if ($navbar == 1) {
            $this -> load -> view('handle/header/navbar', null);
        }
    }

    public function index($pg = '') {
        $this -> cab();
        $tela = '<h1>Cover Tools</h1>' . cr();
        $tela .= '<ul>' . cr();
        $tela .= '<li>' . '<a href="' . base_url('index.php/handle/marc_row') . '">' . msg('Acervo Marc') . '</a></li>' . cr();
        $tela .= '<li>' . '<a href="' . base_url('index.php/handle/marc_import') . '">' . msg('Importar Marc') . '</a></li>' . cr();
        $tela .= '</ul>' . cr();

        $data['content'] = $tela;
        $this -> load -> view('content', $data);
    }

    function marc_import() {
        $this -> load -> model("marc21");
        $this -> cab();

        $tela = '<h1>Import Marc</h1>';
        $tela .= $this -> marc21 -> marc_form(0);

        $data['content'] = $tela;
        $this -> load -> view('content', $data);

    }

    public function marc_row($pg = '') {
        $this -> load -> model("marc21");
        $this -> cab();

        $tela = '<h1>Cover Tools</h1>';

        $form = new form;
        $form = $this -> marc21 -> row_acervo($form);

        $tabela = " metadados_emater ";

        $form -> tabela = $tabela;
        $form -> see = true;
        $form -> novo = false;
        $form -> edit = true;

        $form -> row_edit = base_url('index.php/handle/marc_edit');
        $form -> row_view = base_url('index.php/handle/marc_view');
        $form -> row = base_url('index.php/handle/marc_row');

        $tela = row($form, $pg);

        $data['content'] = $tela;
        $this -> load -> view('content', $data);
    }

    public function process($pth = '', $cmd = '') {
        global $handle;
        $srv = 'read_emater';
        $this -> cab();
        $this -> load -> model("dspace");
        $this -> load -> model($srv);
        $this -> source_function = $srv;

        $lote = 'lote_' . date("Ymd_His");
        $lote = 'lote_' . date("Ymd");
        $lote = $pth;
        $this -> dspace -> gerar_cip($lote);

        $tela = $this -> dspace -> diretorio($pth, $lote);
        $data['content'] = $tela;
        $this -> load -> view("content", $data);
    }

    public function cover($id = '') {
        $this -> load -> model('coversheet');
        if (strlen(get("dd1") > 0)) {
            $id = get("dd1");
        }

        if (strlen($id) == 0) {
            $this -> cab();
            $data['content'] = $this -> coversheet -> row();
            $this -> load -> view('content', $data);
        } else {
            $this -> coversheet -> pdf($id);
        }

    }

    public function select($id = '') {
        $this -> cab();
        $data['content'] = "Nupergs";
        $this -> load -> view('content', $data);
        print_r($db);
    }

}
?>
