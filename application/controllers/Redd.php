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
        $this->load->model('lattes_cnpq');
        $this -> cab();
        $sx = '';
        $sx .= $this->lattes_cnpq->groups();
        
        $sx .= '<ul>';
        $sx .= '<li><a href="'.base_url('index.php/redd/lattes').'">Lattes</a></li>';
        $sx .= '<li><a href="'.base_url('index.php/redd/reports').'">Relatórios</a></li>';
        $sx .= '</ul>';
        
        $data['content'] = $sx;
        $this -> load -> view('content', $data);
        $this -> footer();        
    }
    
    function group($id=0)
    {
        $this->load->model("lattes_cnpq");
        $this->cab();
        $data['content'] = $this->lattes_cnpq->group_resume($id);
        $this -> load -> view('content', $data);            
        $this->footer();
    }

    function grapho($id=0,$z=0)
    {
        $this->load->model("lattes_cnpq");
        $this->cab();
        if ($z > 0)
            {
                $this->lattes_cnpq->zera_indicadores();
            }
        $data['content'] = $this->lattes_cnpq->grapho($id);
        $this -> load -> view('content', $data);            
        $this->footer();
    }    
    function subgroup($id=0,$tp=0)
    {
        $this->load->model("lattes_cnpq");
        $this->cab();
        $data['content'] = $this->lattes_cnpq->subgroup_resume($id,$tp);
        $this -> load -> view('content', $data);            
        $this->footer();
    }    
    function reprocess_group($id=0)    
    {
        $this->load->model("lattes_cnpq");
        $this->lattes_cnpq->    group_reprocess($id);
        redirect(base_url(PATH.'group/'.$id));
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
    
    function reports($path='',$id='',$c='')
    {
        $this->load->model('lattes_cnpq');
        $this->cab();
        $data['content'] = $this->lattes_cnpq->reports($path,$id,$c);
        $data['title'] = 'Relatórios ReDD';
        $this->load->view('content',$data);
        $this->footer();
    }
    
    function export($act='',$id='')
    {
        $id = round($id);
        if ($id == 0) { $id = 1; }            
        $rdf = new rdf;
        $this->cab();
        $rsp = $rdf->rdf_export($id,1);
        $data['content'] = 'Exported '.$id;
        $id++;
        $data['content'] .= '<META http-equiv="refresh" content="1;URL='.base_url(PATH.'export/rdf/'.($id)).'">';
        $data['content'] .= $rsp;
        $this->load->view('content',$data);
        $this->footer();
    }
    
    function rdf($act='',$id='',$id2='',$id3='',$id4='',$id5='')
    {
        $rdf = new rdf;
        $rdf->index('rdf',$act,$id,$id2,$id3,$id4,$id5);
    }
}

function rdf_show_CurriculoLattes($cv)
{
    //print_r($cv);
    $rdf = new rdf;
    $data = $rdf->le_data($cv['id_cc']);
    $cvn = substr($cv['n_name'],2,80);
    $linklattes = '<a href="http://lattes.cnpq.br/'.$cvn.'" target="_new">Link Lattes</a>';
    $sx = '';
    $sx .= '<div class="container">';
    $sx .= '<div class="row">';
    $sx .= '<div class="col-md-10">';
    $sx .= '<h1>'.$rdf->extract_content($data,'hasCvName').'</h1>';
    $sx .= $linklattes;
    $sx .= '</div>';
    $sx .= '</div>';
    
    /* Formação */
    $formation = $rdf->extract_id($data,'formation');
    if (!is_array($formation)) { $formation = array($formation); }
    
    $gr = '';
    $ms ='';
    $es ='';
    $dr = '';
    $sx .= '<table class="table">';        
    for ($r=0;$r < count($formation);$r++)
    {
        $fm = $formation[$r];  
        $f = $rdf->le_data($fm);
        $course_status = $rdf->extract_content($f,'courseStatus');
        $year_i = $rdf->extract_content($f,'startYear');
        $year_f = $rdf->show_values($rdf->extract_content($f,'endYear'));
        $type = $rdf->show_values($rdf->extract_content($f,'typeDegree'));
        $course = $rdf->show_values($rdf->extract_content($f,'course'));
        if (strlen($course) > 0)
        {
            $course_id = $rdf->extract_id($f,'course');
            $f = $rdf->le_data($course_id);
            $univ = $rdf->show_values($rdf->extract_content($f,'offerCourse'));
            $sx .= '<tr>';
            $sx .= '<td>'.$type.'</td>';
            $sx .= '<td>'.$course.'</td>';
            $sx .= '<td>'.$univ.'</td>';  
            $sx .= '<td>'.$year_i.'</td>';
            $sx .= '<td>'.$year_f.'</td>';  
            $sx .= '</tr>';
        }
    }
    $sx .= '</table>';
    return($sx);
}
?>