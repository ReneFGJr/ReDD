<?php
class PPG extends CI_controller {
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
		$this -> load -> library('curl');
		$this -> load -> library('zip');
		$this -> load -> helper('xml');

		date_default_timezone_set('America/Sao_Paulo');
		/* Security */
		//		$this -> security();
	}

	public function cab($navbar = 1) {
		$data['title'] = ':: ReDD - Login ::';
		$data['pag'] = 2;
		$this -> load -> view('header/header', $data);
		if ($navbar == 1) {
			$this -> load -> view('header/navbar', null);
		}
	}

	public function index() {
		$this->cab();
		$this->load->view('laboratorio/cedap');
	}
	public function patrimonio($id='') {
		$this->cab(0);
		switch($id)	
			{
			case '':
				$this->cab(1);
					$sx = '<ul>';
					$sx .= '<li><a href="'.base_url('index.php/ppg/patrimonio/0').'">Todos</a>'.cr();
					$sx .= '<li><a href="'.base_url('index.php/ppg/patrimonio/1').'">Todos 10312</a>'.cr();
					$sx .= '<li><a href="'.base_url('index.php/ppg/patrimonio/2').'">Todos 10314</a>'.cr();
					$sx .= '<li><a href="'.base_url('index.php/ppg/patrimonio/3').'">Todos 10313</a>'.cr();
					$sx .= '<li><a href="'.base_url('index.php/ppg/patrimonio/4').'">Todos 10310</a>'.cr();
					$sx .= '<li><a href="'.base_url('index.php/ppg/patrimonio/5').'">Todos 10309</a>'.cr();
					$sx .= '<li><a href="'.base_url('index.php/ppg/patrimonio/6').'">Todos 10308</a>'.cr();
					$sx .= '<li><a href="'.base_url('index.php/ppg/patrimonio/7').'">Todos 10307</a>'.cr();
					$sx .= '<li><a href="'.base_url('index.php/ppg/patrimonio/8').'">Todos 10306</a>'.cr();
					$sx .= '<li><a href="'.base_url('index.php/ppg/patrimonio/9').'">Todos 10311</a>'.cr();
					$sx .= '</ul>';
					$data['content'] = $sx;
					$this->load->view('content',$data);
					break;
			case 0:
				$this->load->view('laboratorio/cedap-laboratorio');
				break;
			case 1:
				$this->load->view('laboratorio/cedap-seguranca');
				break;
			case 2:
				$this->load->view('laboratorio/cedap-video');
				break;
			case 3:
				$this->load->view('laboratorio/cedap-scanner-big');
				break;	
			case 4:
				$this->load->view('laboratorio/scanner-microficha');
				break;	
			case 5:
				$this->load->view('laboratorio/scanner-livros');
				break;	
			case 6:
				$this->load->view('laboratorio/scanner-negativo');
				break;
			case 7:
				$this->load->view('laboratorio/scanner-continuo-1');
				break;
			case 8:
				$this->load->view('laboratorio/scanner-continuo-2');
				break;												
			case 9:
				$this->load->view('laboratorio/scanner-computadores');
				break;							
			}
		
	}

	public function view($id = '', $chk = '', $ac = '', $r='') {
		$this -> load -> model('rdfs');
		$this -> load -> model('ppgs');
		$this -> cab();

		$data = $this -> ppgs -> le($id);

		$this -> load -> view('ppg/ppg', $data);
		
		$t = '';
		$t .= '<a href="' . base_url('index.php/ppg/view/' . $id . '/' . $chk . '') . '" class="btn btn-default">#</a>';
		$t .= '<a href="' . base_url('index.php/ppg/view/' . $id . '/' . $chk . '/AREACONCEN') . '" class="btn btn-default">Área do conhecimento</a>';
		$t .= '<a href="' . base_url('index.php/ppg/view/' . $id . '/' . $chk . '/LINHAPESQ1') . '" class="btn btn-default">Linha de Pesquisa #1</a>';
		$t .= '<a href="' . base_url('index.php/ppg/view/' . $id . '/' . $chk . '/LINHAPESQ2') . '" class="btn btn-default">Linha de Pesquisa #2</a>';
		$t .= '<a href="' . base_url('index.php/ppg/view/' . $id . '/' . $chk . '/LINHAPESQ3') . '" class="btn btn-default">Linha de Pesquisa #3</a>';
		$t .= '<a href="' . base_url('index.php/ppg/view/' . $id . '/' . $chk . '/DISCIPLINA/R') . '" class="btn btn-default">Disciplinas</a>';
		$data['content'] = $t;
		$this -> load -> view('content', $data);

		if (strlen($ac) > 0) {
			$tela = $this -> rdfs -> edit($data['rdf'], $ac, $r);
			$data['content'] = $tela[0];
			$this -> load -> view('content', $data);
			
			if ($tela[1]=='1')
				{
					redirect(base_url('index.php/ppg/view/'.$id.'/'.$chk));
				}
		} else {
		/* VIEW */
			$tela = $this -> rdfs -> show($data['rdf']);
			$data['content'] = $tela;
			$data['title'] = '';
			$this -> load -> view('content', $data);
		}


	}

	public function row($pg = '') {
		$this -> load -> model('ppgs');
		$this -> cab();

		$form = new form;
		$form = $this -> ppgs -> row($form);

		$tabela = "		(
						select inst.rdf_value as instituicao, id_ppg,
						ppg_codigo, ppg_programa, ppg_sigla, 
						ppg_nota_d, ppg_nota_m, ppg_nota_p
						FROM programa_pos 
						LEFT JOIN rdf as inst ON ppg_instituicao = rdf_resource
						) as instituicao ";

		$form -> tabela = $tabela;
		$form -> see = true;
		$form -> novo = true;
		$form -> edit = true;

		$form -> row_edit = base_url('index.php/ppg/edit');
		$form -> row_view = base_url('index.php/ppg/view');
		$form -> row = base_url('index.php/ppg/row');

		$tela = row($form, $pg);
		$data['content'] = $tela;
		$data['title'] = '';
		$this -> load -> view('content', $data);
	}

	public function edit($id = '') {
		$this -> load -> model('ppgs');
		$this -> cab();
		$cp = $this -> ppgs -> cp();

		$form = new form;
		$form -> id = $id;
		$tela = $form -> editar($cp, $this -> ppgs -> table);
		$data['content'] = $tela;
		$data['title'] = '';
		$this -> load -> view('content', $data);

		if ($form -> saved > 0) {
			redirect(base_url('index.php/ppg'));
		}

	}

}
?>
