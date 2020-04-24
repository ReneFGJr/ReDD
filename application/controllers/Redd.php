<?php
define("PATH","index.php/redd/");
define("LIBRARY_NAME","ReDD");
class Redd extends CI_controller {
    function __construct() {
        parent::__construct();
        $LANG = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        if (strpos(' '.$LANG,'pt-BR') > 0)
        {
            $this -> lang -> load("redd", "portuguese");
        } else {
            $this -> lang -> load("redd", "english");
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
        date_default_timezone_set('America/Sao_Paulo');
        /* Security */
        //      $this -> security();
    }
    
    public function cab($navbar = 1) {
        $data['title'] = ':: ReDD ::';
        $this -> load -> view('redd/header/header', $data);
        if ($navbar == 1) {
            $this -> load -> view('redd/header/navbar', null);
        }
    }

    public function footer() {
        $this -> load -> view('header/footer');        
    }


    public function index() {
        $this -> cab(0);       
        if ((isset($_SESSION['user'])) and (strlen($_SESSION['user']) > 0))
        {
            redirect(base_url(PATH.'main'));
        }
        $this->cab();
        $data['show'] = 1;
        $data['login'] = '<h1>ReDD - Login</h1>';

        $data['login'] .= $this->load->view("social/login/login",$data,true);

        $this->load->view('welcome_redd',$data);
        $sx = '<style> .modal-content { border: 0px; -webkit-box-shadow: 0px 0px 0px; } </style>'.cr();
        $data['content'] = $sx;
        $data['title'] = '';
        $this->load->view('content',$data);
    }

    public function main() {
        $this -> cab();
        $sx = '<ul>';
        $sx .= '<a href="'.base_url('index.php/redd/lattes').'">Lattes</a>';
        $sx .= '</ul>';

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

    function lattes($path='',$id='')
    {
        $this->load->model('lattes_cnpq');
        $this->cab();
        $this->lattes_cnpq->row($path,$id);
        $this->footer();
    } 

    function zera()
        {
            $sql = "TRUNCATE rdf_concept";
            $rlt = $this->db->query($sql);
            $sql = "TRUNCATE rdf_data";
            $rlt = $this->db->query($sql);
            $sql = "TRUNCATE rdf_name";
            $rlt = $this->db->query($sql);
        }   

    public function v($id) {
        $this -> cab();
        $rdf = new rdf;
        $tela = $rdf->show_data($id);
        $tela .= $rdf->view_data($id);
        $data['content'] = $tela;
        $this -> load -> view('content', $data);
        $this -> footer();
    }    
}
?>