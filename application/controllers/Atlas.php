<?php
class Atlas extends CI_controller
	{
	function __construct() {
	    global $handle;
        $handle = '20.500.12287';
		parent::__construct();

		$this -> lang -> load("login", "portuguese");
		//$this -> lang -> load("skos", "portuguese");
		//$this -> load -> library('form_validation');
		$this -> load -> database();
		$this -> load -> helper('form');
		$this -> load -> helper('form_sisdoc');
		$this -> load -> helper('url');
		$this -> load -> library('session');
		$this -> load -> library('tcpdf');
		date_default_timezone_set('America/Sao_Paulo');
		/* Security */
		//		$this -> security();
	}		
	public function cab($navbar=1)
		{
			$data['title'] = ':: ReDD - Atlas ::';
			$this->load->view('header/header',$data);
			if ($navbar==1)
				{
					$this->load->view('handle/header/navbar',null);
				}
		}
	public function index()
		{
			$this->cab();
			
			redirect(base_url('index.php/atlas/pages'));
			$this->load->view('content',$data);
		}
	public function pages($p='')
		{
		    $this->load->model('iiifs');
			$this->cab(0);
            $data = array();
            //$this->iiifs->reciver_info_image('018.tif');
            //$data['content'] = $this->iiifs->show();
            //$this->load->view('content',$data);
            
            $this->load->view('atlas',$data);
		}
    public function zoom($img='')
        {
            $this->load->model('iiifs');
            //$this->cab(0);            
            $data = array();
            $sx = '<div class="content-fluid"><div class="row"><div class="col-md-12">';
            $sxf = '</div></div></div>';
            //$this->iiifs->reciver_info_image($img);
            $data['content'] = $sx.$this->iiifs->show($img).$sxf;
            $this->load->view('content',$data);
        }
    function nr()
        {
            for ($r=1;$r < 237;$r++)
                {
                    echo strzero($r,3).'.jpg   bundle:ORIGINAL<br>';
                }
        }
    function sample()
        {
             for ($r=1;$r <= 2;$r++) {
                 echo '<img src="http://143.54.114.150:8182/iiif/2/_'.strzero($r,4).'.tif'.'/full/1024,/0/default.jpg" width="50%">';
                 echo '<br>';
              }            
             for ($r=1;$r <= 19;$r++) {
                 echo '<img src="http://143.54.114.150:8182/iiif/2/_A'.strzero($r,3).'.tif'.'/full/1024,/0/default.jpg" width="50%">';
                 echo '<br>';
              }            
             for ($r=1;$r < 237;$r++) {
                 echo '<img src="http://143.54.114.150:8182/iiif/2/'.strzero($r,3).'.tif'.'/full/1024,/0/default.jpg" width="50%">';
                 echo '<br>';
              }
             for ($r=998;$r <= 999;$r++) {
                 echo '<img src="http://143.54.114.150:8182/iiif/2/'.strzero($r,3).'.tif'.'/full/1024,/0/default.jpg" width="50%">';
                 echo '<br>';
              }
        }        			
    function miniature()
        {
             for ($r=1;$r <= 2;$r++) {
                 echo '<img src="http://143.54.114.150:8182/iiif/2/_'.strzero($r,4).'.tif'.'/full/480,/0/default.jpg" width="50%">';
                 echo '<br>';
              }            
             for ($r=1;$r <= 19;$r++) {
                 echo '<img src="http://143.54.114.150:8182/iiif/2/_A'.strzero($r,3).'.tif'.'/full/480,/0/default.jpg" width="50%">';
                 echo '<br>';
              }            
             for ($r=1;$r < 237;$r++) {
                 echo '<img src="http://143.54.114.150:8182/iiif/2/'.strzero($r,3).'.tif'.'/full/480,/0/default.jpg" width="50%">';
                 echo '<br>';
              }
             for ($r=998;$r <= 999;$r++) {
                 echo '<img src="http://143.54.114.150:8182/iiif/2/'.strzero($r,3).'.tif'.'/full/480,/0/default.jpg" width="50%">';
                 echo '<br>';
              }            
        }                   
    function full()
        {
             for ($r=1;$r <= 2;$r++) {
                 echo '<img src="http://143.54.114.150:8182/iiif/2/_'.strzero($r,4).'.tif'.'/full/full/0/default.jpg" width="50%">';
                 echo '<br>';
              }            
             for ($r=1;$r <= 19;$r++) {
                 echo '<img src="http://143.54.114.150:8182/iiif/2/_A'.strzero($r,3).'.tif'.'/full/full/0/default.jpg" width="50%">';
                 echo '<br>';
              }            
             for ($r=1;$r < 237;$r++) {
                 echo '<img src="http://143.54.114.150:8182/iiif/2/'.strzero($r,3).'.tif'.'/full/full/0/default.jpg" width="50%">';
                 echo '<br>';
              }
             for ($r=998;$r <= 999;$r++) {
                 echo '<img src="http://143.54.114.150:8182/iiif/2/'.strzero($r,3).'.tif'.'/full/full/0/default.jpg" width="50%">';
                 echo '<br>';
              }
        }                   
	}
?>
