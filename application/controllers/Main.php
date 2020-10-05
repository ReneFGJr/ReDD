<?php
define("PATH","index.php/main/");
define("LIBRARY_NAME","ReDD-Service");
class Main extends CI_controller {
    var $logo = 'img/redd/background_service_place.png';
    function __construct() {
        parent::__construct();
        $LANG = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        if (strpos(' '.$LANG,'pt-BR') > 0)
        {
            $this -> lang -> load("main", "pt_br");
            $this -> lang -> load("hellper_socials", "pt_br");
        } else {
            $this -> lang -> load("main", "en");
            $this -> lang -> load("socials", "en");
        }
        $this -> load -> database("redd");
        $this -> load -> helper('form');
        $this -> load -> helper('form_sisdoc');
        $this -> load -> helper('email');
        $this -> load -> helper('url');        
        $this -> load -> library('session');
        $this -> load -> library('zip');
        $this -> load -> helper('xml');
        
        $this -> load -> library('curl');
        $this -> load -> helper('rdf');
        $this -> load -> model('serviceplace');
        $this -> load -> helper('socials');
        date_default_timezone_set('America/Sao_Paulo');
        /* Security */
        //      $this -> security();
    }
    
    public function cab($navbar = 1) {
        $data['title'] = ':: ReDD :: Services ::';
        $this -> load -> view('redd/header/header', $data);
        if ($navbar == 1) {
            $this -> load -> view('header/navbar_main', null);
        }
    }
    
    public function footer() {
        $this -> load -> view('header/footer');        
    }
    
    function main($act='',$d1='',$d2='',$d3='') {
        redirect(base_url(PATH));
    }
    
    function index($act='',$d1='',$d2='',$d3='') {
        $tela = '';
        $this -> cab();
        $sx = '';
        if (strlen($act) == 0)
        {
            $this->load->view("welcome_service_place");
        }
        $sx .= $this->serviceplace->main($act,$d1,$d2,$d3);
        $data['content'] = $sx;
        $this -> load -> view('content', $data);
        $this -> footer();
    }

    function social($act = '',$id='',$chk='') {
        $this -> cab();
        $socials = new socials;        
        $socials->social($act,$id,$chk);
        return('');
    }  
    
    function about($act = '',$id='',$chk='') {
        $this -> cab();
        return('');
    }    

    function contact($act = '',$id='',$chk='') {
        $this -> cab();
        return('');
    }    

    function services($act = '',$id='',$chk='') {
        $this -> cab();
        $tela = $this->serviceplace->services();
        $data['content'] = $tela;
        $this -> load -> view('content', $data);
        $this -> footer();
    }    

    function edit($id,$chk='') 
    {
        $tela = '';
        $this -> cab();
        $tela = $this -> trans -> edit($id,$chk);
        $data['content'] = $tela;
        $this -> load -> view('content', $data);
        $this -> footer();
    }       
}
?>
