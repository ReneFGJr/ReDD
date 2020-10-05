<?php
define("PATH","index.php/dcmetadata/");
define("LIBRARY_NAME","DC database");
class Dcmetadata extends CI_controller {
    var $logo = 'img/logo/dcmetadata_project.jpg';
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
        $this -> load -> model('dcmetadatas');
        date_default_timezone_set('America/Sao_Paulo');
        /* Security */
        //      $this -> security();
    }
    
    public function cab($navbar = 1) 
    {
        
        if ((!isset($_SESSION['user'])) or (strlen($_SESSION['user']) == 0))
        {
            redirect(base_url(""));
        }
        
        $data['title'] = ':: Doblin Core :: Database ::';
        $this -> load -> view('redd/header/header', $data);
        
        if ($navbar == 1) {
            $this -> load -> view('header/navbar_main', null);
            $menu = array();
            $menu['title'] = 'Doblin Core - Database';
            $menu['i'] = array();
            $menu['i']['home'] = base_url(PATH);
            
            //if (isset($_SESSION['dcproject']))
            {
                $menu['i']['dataset'] = base_url(PATH.'dataset');        
                $menu['i']['importCSV'] = base_url(PATH.'import');
                $menu['i']['exporttCSV'] = base_url(PATH.'export');
            }
            $menu['s'] = base_url(PATH.'search');
            $d['code'] = menu($menu);
            //$d['code'] .= breadcrumb();            
            $this->load->view('echo',$d);
            return("");            
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
        $sx .= $this->dcmetadatas->resume();
        $sx .= $this->dcmetadatas->main($act,$d1,$d2,$d3);
        $data['content'] = $sx;
        $this -> load -> view('content', $data);
        $this -> footer();
    }
    
    function dataset($pg='',$chk='')
    {
        $this->cab();
        $tela = '</div><div class="container-fluid">'.$this->dcmetadatas->view_dataset($pg,$chk);
        $data['content'] = $tela;
        $this -> load -> view('content', $data);
        $this -> footer();        
    }
    
    function datasetedit($id)
    {
        $this->cab();
        $tela = $this->dcmetadatas->edit_dataset($id);
        $data['content'] = $tela;
        $this -> load -> view('content', $data);
        $this -> footer();                    
        
    }
    
    function datasetview($id)
    {
        $this->cab();
        $tela = $this->dcmetadatas->register_dataset($id);
        $data['content'] = $tela;
        $this -> load -> view('content', $data);
        $this -> footer();                    
    }
    
    function social($act = '',$id='',$chk='') {
        $this -> cab();
        $socials = new socials;        
        $socials->social($act,$id,$chk);
        return('');
    }     
    
    function import() {
        $this -> load -> model('dcmetadatas');
        $this -> cab();
        $tela = $this -> dcmetadatas -> import();
        $data['content'] = $tela;
        $this -> load -> view('content', $data);
        $this -> footer();
    }
    
    function export()
    {
        $conf=get("dd1");
        $this -> load -> model('dcmetadatas');
        if ($conf == '')
        {            
            $this -> cab();
            $tela = $this -> dcmetadatas -> export();
            $data['content'] = $tela;
            $this -> load -> view('content', $data);
            $this -> footer();            
        } else {
            $tela = $this -> dcmetadatas -> export($conf);
        }
    }
    
}
