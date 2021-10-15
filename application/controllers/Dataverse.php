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
            $this -> lang -> load("dataverse", "pt_br");
        } else {
            $this -> lang -> load("dataverse", "en");
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
        $this -> load -> helper('bootstrap');
        $this -> load -> model('trans');
        date_default_timezone_set('America/Sao_Paulo');
        /* Security */
        //      $this -> security();
    }
    
    public function cab($navbar = 1) {
        
        if ((!isset($_SESSION['user'])) or (strlen($_SESSION['user']) == 0))
        {
            redirect(base_url(""));
        }
        $data['title'] = ':: Dataverse :: Traduções ::';
        $this -> load -> view('redd/header/header', $data);
        if (get("nocab") != '') { $navbar = 0; }

        if ($navbar == 1) {
            $this -> load -> view('header/navbar_main', null);
            $menu = array();
            $menu['title'] = 'Dataverse Tradução';
            $menu['i'] = array();
            $menu['i']['home'] = base_url(PATH);
            $menu['i']['versions'] = base_url(PATH.'versions');
            $menu['i']['export'] = array();
            $menu['i']['export']['individual'] = base_url(PATH.'versions');
            $menu['i']['export']['all'] = base_url(PATH.'versions');
            $menu['s'] = base_url(PATH.'search');
            $d['code'] = menu($menu);
            //$d['code'] .= breadcrumb();
            $this->load->view('echo',$d);
            
        }
    }
    
    public function footer() {
        $this -> load -> view('header/footer');        
    }
    
    function main($act='',$d1='',$d2='',$d3='') {
        redirect(base_url(PATH));
    }
    
    function index($act='',$d1='',$d2='',$d3='',$d4='') {
        $tela = '';
        $this -> cab();
        if (strlen($act) == 0)
        {
            $sx = '<img src="'.base_url($this->logo).'">';
        }
        $sx .= '<div class="row"><div class="col-12"><h5>'.msg('Total_of').' '.number_format($this->trans->resume(),0,',','.').' '.msg('records').'</h5></div></div>';
        $sx .= $this->trans->main($act,$d1,$d2,$d3,$d4);
        $data['content'] = $sx;
        $this -> load -> view('content', $data);
        $this -> footer();
    }

    function metadata($d1='',$d2='',$d3='',$d4='')
        {
                  $this -> cab(); 
                  $sx = $this->trans->metadata($d1,$d2,$d3,$d4);
                  $data['content'] = $sx;
                  $this -> load -> view('content', $data);
                  $this -> footer(); 
        }    

    function guide($d1='',$d2='',$d3='',$d4='',$d5='',$d6='')
        {
            $this->guide_cab($d1,$d2,$d3);
            $this->load->model('dataverse_guides');
            $tela = $this->dataverse_guides->index($d1,$d2,$d3,$d4,$d5,$d6);
            $data['content'] = $tela;
            $this -> load -> view('content', $data);
        }

    function guide_cab($d1='',$d2='',$d3='')
        {
            $data['title'] = ':: Dataverse :: GUIA ::';
            $this -> load -> view('redd/header/header', $data);
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
    
    function versions()
    {
        $this->cab();
        $tela = $this -> trans -> versions_show();
        $data['content'] = $tela;
        $this -> load -> view('content', $data);
        //$this -> footer();
    }
    
    function exportall($file='') 
    {
        if (strlen($file) == 0)
        {
            redirect(base_url(PATH));
        } else {
            
            $this -> trans -> downloadall($file);            
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
