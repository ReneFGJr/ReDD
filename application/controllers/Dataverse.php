<?php
define("PATH","index.php/dataverse/");
define("LIBRARY_NAME","Dataverse Tradutor");
class Dataverse extends CI_controller {
    var $logo = 'img/logo/dataverse_r_project.png';
    function __construct() {
        parent::__construct();
        $LANG = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        if (strpos(' '.$LANG,'pt-BR') > 0)
        {
            $this -> lang -> load("dataverse", "portuguese");
        } else {
            $this -> lang -> load("dataverse", "english");
        }
        
        $this -> load -> database("redd");
        $this -> load -> helper('form');
        $this -> load -> helper('form_sisdoc');
        $this -> load -> helper('url');
        $this -> load -> helper('socials');
        $this -> load -> library('session');
        $this -> load -> library('zip');
        $this -> load -> helper('xml');
        $this -> load -> library('curl');
        $this -> load -> helper('rdf');
        $this -> load -> model('trans');
        date_default_timezone_set('America/Sao_Paulo');
        /* Security */
        //      $this -> security();
    }
    
    public function cab($navbar = 1) {
        $data['title'] = ':: ReDD :: Dataverse ::';
        $this -> load -> view('redd/header/header', $data);
        if ($navbar == 1) {
            $this -> load -> view('header/navbar_dataverse', null);
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
        $sx .= $this->trans->main($act,$d1,$d2,$d3);
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
    
    function check_translate()
    {
        $tela = '';
        $this -> cab();
        $tela = $this -> trans -> check_trans();
        $data['content'] = $tela;
        $this -> load -> view('content', $data);
        $this -> footer();
    }

    function translate($p='')
    {
        $tela = '';
        $this -> cab();
        $tela = $this -> trans -> row2($p);
        $data['content'] = $tela;
        $this -> load -> view('content', $data);
        $this -> footer();
    } 

    function view($id='')
    {
        $tela = '';
        $this -> cab();
        $tela = $this -> trans -> view($id);
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
    
    function mass_translate($d1='',$d2='',$d3='')
    {
        $tela = '';
        $this -> cab();
        if (strlen($d1) == 0)
        {
            $tela = $this -> trans -> mass_trans($d1,$d2,$d3);
        } else {
            $tela = $this -> trans -> mass_trans_file($d1,$d2,$d3);
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
            $tela = $this -> trans -> exports($d);
            $data['content'] = $tela;
            $this -> load -> view('content', $data);
            $this -> footer();
        } else {
            
            $this -> trans -> download($d,$file);            
        }        
    }    
    
    function import() {
        $this -> load -> model('trans');
        $this -> cab();
        $tela = $this -> trans -> import();
        $data['content'] = $tela;
        $this -> load -> view('content', $data);
        $this -> footer();
    }
    
}
?>
