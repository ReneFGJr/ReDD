<?php
class Auth extends CI_controller
	{
	function __construct() {
		parent::__construct();

		$this -> lang -> load("login", "portuguese");
		//$this -> lang -> load("skos", "portuguese");
		//$this -> load -> library('form_validation');
		$this -> load -> database();
		$this -> load -> helper('form');
		$this -> load -> helper('form_sisdoc');
		$this -> load -> helper('url');
		$this -> load -> library('session');
		date_default_timezone_set('America/Sao_Paulo');
		/* Security */
		//		$this -> security();
	}		
	public function cab($navbar=1)
		{
			$data['title'] = ':: ReDD - Authority Control - FRBR ::';
			$this->load->view('header/header',$data);
			if ($navbar==1)
				{
					$this->load->view('auth/navbar',null);
				}
		}
	public function index()
		{
			$this->cab();
			$this->load->view('auth/search',null);
		}
	public function normalize()
		{
			$this->load->model('auths');
			$this->cab();
			$sx = '<form method="post">
					Lista de autores
					<textarea name="dd1" style="width: 100%;" rows=10>'.get("dd1").'</textarea>
					<input type="submit" value="processar >>>">
					</form>';
			$dd1 = get("dd1");
			$au = array();
			$rs = '';
			$tx = '';
			if (strlen($dd1) > 0)
				{
					$d = $dd1;
					$d = troca($d,';','¢');
					$d = troca($d,chr(13),';');
					$d = troca($d,chr(10),'');
					$l = splitx(';',$d);
					for ($r=0;$r < count($l);$r++)
						{
							$ln = $l[$r];
							//print_r($ln);
							//echo '<hr>';
							
							$lns = troca($ln,'¢',';').';';
							$lns = splitx(';',$lns);
							for ($y = 0;$y < count($lns);$y++)
								{
										$a = nbr_autor($lns[$y],8);
										$rs .= $a.cr();
										$tx .= $a.';';
								}
							$tx .= cr();
						}
						$sx .= '<pre>'.$rs.'</pre>';
						$sx .= '<hr>';
						$sx .= '<pre>'.$tx.'</pre>';
				}
				
			
			$data['content'] = $sx;
			$this->load->view('content',$data);
		}			
	public function researchers()
		{
			$this->load->model('auths');
			$this->cab();
			
			$data['content'] = $this->researchers->row();
			$this->load->view('content',$data);
		}
	}
?>
