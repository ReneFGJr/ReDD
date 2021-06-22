<?php
define("PATH","index.php/watson/");
define("LIBRARY_NAME","ReDD");

class Watson extends CI_controller {
    function __construct() {
        parent::__construct();
        $this -> lang -> load("dataverse", "pt_br");
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
        $this -> load -> helper('socials');

        date_default_timezone_set('America/Sao_Paulo');
        /* Security */
        //		$this -> security();
    }

    public function cab($navbar = 1) {
        $data['title'] = ':: ReDD - Watson ::';
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
        $this->load->model("watsons");
        //$this->watsons->synthesize();
        $rlt = $this->watsons->NLP();
        echo '<pre>';
        print_r($rlt);
    }
    
    public function voz() {
        $this -> cab();
        $this->load->model("watsons");
        echo 'VOZ';
        $this->watsons->synthesize();
        //$this->watsons->NLP();
    }    

}
?>
