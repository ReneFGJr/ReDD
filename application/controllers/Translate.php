<?php
class Translate extends CI_controller {
    var $logo = 'img/logo/logo_translate.jpg';
    function __construct() {
        parent::__construct();
        define("PATH","index.php/translate/");
        
        $this -> lang -> load("login", "portuguese");
        $this -> load -> database();
        $this -> load -> helper('form');
        $this -> load -> helper('form_sisdoc');
        $this -> load -> helper('socials');
        $this -> load -> helper('url');
        $this -> load -> library('session');
        date_default_timezone_set('America/Sao_Paulo');
        /* Security */
        //		$this -> security();
        $this -> load -> model("translates");
        $this-> translates->table = 'redd.translate';
        $this-> translates->dir = '_translate';
        $this-> translates->type = 'codeigniter';
    }
    
    public function cab($navbar = 1) {
        $data['title'] = ':: ReDD :: Translate ::';
        $this -> load -> view('redd/header/header', $data);
        if ($navbar == 1) {
            $this -> load -> view('redd/header/navbar', null);
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
        if (strlen($act) == 0)
        {
            $sx = '<img src="'.base_url($this->logo).'">';
        }
        $sx .= $this->translates->main($act,$d1,$d2,$d3);
        $data['content'] = $sx;
        $this -> load -> view('content', $data);
        $this -> footer();
    }
    
    function check_translate()
    {
        $tela = '';
        $this -> cab();
        $tela = $this -> translates -> check_translates();
        $data['content'] = $tela;
        $this -> load -> view('content', $data);
        $this -> footer();
    }
    
    function edit($id,$chk='') 
    {
        $tela = '';
        $this -> cab();
        $tela = $this -> translates -> edit($id,$chk);
        $data['content'] = $tela;
        $this -> load -> view('content', $data);
        $this -> footer();
    }   
    
    function mass_translate($d1='',$d2='',$d3='')
    {
        $tela = '';
        $this -> cab();
        if (strlen($d1) == 0)
        {
            $tela = $this -> translates -> mass_translates($d1,$d2,$d3);
        } else {
            $tela = $this -> translates -> mass_translates_file($d1,$d2,$d3);
        }
        
        $data['content'] = $tela;
        $this -> load -> view('content', $data);
        $this -> footer();
    } 
    
    
    function export($d='',$file='') 
    {
        if (strlen($file) == 0)
        {
            $this -> cab();
            $tela = $this -> translates -> exports($d);
            $data['content'] = $tela;
            $this -> load -> view('content', $data);
            $this -> footer();
        } else {
            
            $this -> translates -> download($d,$file);            
        }        
    }    
    
    function import() {
        $this -> load -> model('translates');
        $this -> cab();
        $tela = $this -> translates -> import();
        $data['content'] = $tela;
        $this -> load -> view('content', $data);
        $this -> footer();
    }
    
}
?>
