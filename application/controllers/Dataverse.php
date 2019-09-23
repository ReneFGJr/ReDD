<?php
class Dataverse extends CI_controller {
    function __construct() {
        parent::__construct();
        define("PATH","index.php/dataverse/");

        $this -> lang -> load("login", "portuguese");
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
        $data['title'] = ':: ReDD - Dataverse ::';

        $m = array();
        array_push($m, array('Dataverse', base_url('index.php/dataverse/')));
        array_push($m, array('Importar', base_url('index.php/dataverse/import')));
        array_push($m, array('Exportar', base_url('index.php/dataverse/exportar')));
        array_push($m, array('Tradução', base_url('index.php/dataverse/translate_google')));

        $data['menu'] = $m;
        $this -> load -> view('header/header', $data);
        if ($navbar == 1) {
            $this -> load -> view('header/navbar', null);
        }
    }

    private function foot() {
        $this -> load -> view('header/footer');
    }

    function index() {
        $this -> load -> model("dataverses");
        $tela = '';
        $this -> cab();
        $this -> load -> view('oraculo/search');



        $cmd = get("dd1");
        $cmd = troca($cmd, ' ', ';');
        $cmd = splitx(';', $cmd);
        //PRINT_R($cmd);
        if (isset($cmd[0])) {
            switch (trim($cmd[0])) {
                case 'row' :
                    $tela = $this -> dataverses -> row();
                    break;
                case 'row' :
                    $tela = $this -> dataverses -> download();
                    break;                    
                default :
                    break;
            }
        }

        $tela .= '<ul>';
        $tela .= '<li><a href="'.base_url(PATH.'row').'">Listar</li>'.cr();
        $tela .= '<li><a href="'.base_url(PATH.'checked').'">Checking</li>'.cr();
        $tela .= '<li><a href="'.base_url(PATH.'exportar').'">Exportar</li>'.cr();
        $tela .= '</ul>';
        $data['content'] = $tela;
        $this -> load -> view('content', $data);
        $this -> foot();
    }

    function row() {
        $this -> load -> model("dataverses");
        $tela = '';
        $this -> cab();
        $tela = $this -> dataverses -> row();
        $data['content'] = $tela;
        $this -> load -> view('content', $data);
        $this -> foot();
    }

    function exportar() {
        $this -> load -> model("dataverses");
        $this -> dataverses -> download();
    }

    function checked() {
        $this -> load -> model("dataverses");
        $this -> dataverses -> checked();
    }    

    function translate_google($arg1 = '', $arg2 = '') {
        $this -> load -> model('dataverses');
        $this -> cab();
        $tela = $this -> dataverses -> translate($arg1, $arg2);
        $data['content'] = $tela;
        $this -> load -> view('content', $data);
        $this -> foot();
    }

    function import() {
        $this -> load -> model('dataverses');
        $this -> cab();
        $tela = $this -> dataverses -> import();
        $data['content'] = $tela;
        $this -> load -> view('content', $data);
        $this -> foot();
    }

}
?>
