<?php
class Watson extends CI_controller {
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
        $this->watsons->NLP();
    }

}
?>
