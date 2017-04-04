<?php
class Biblioteconomia extends CI_controller {
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
		$data['title'] = ':: ReDD - Bibilioteconomia ::';
		$data['pag'] = 2;
		$this -> load -> view('header/header', $data);
		if ($navbar == 1) {
			$this -> load -> view('header/navbar', null);
		}
	}

	public function index() {
		redirect(base_url('index.php/biblioteconomia/row'));
	}

	public function view($id = '', $chk = '', $ac = '', $r='') {
		$this -> load -> model('rdfs');
		$this -> load -> model('cursos');
		$this -> cab();

		$data = $this -> cursos -> le($id);

		$this -> load -> view('cr/cr', $data);
		
		$t = '';
		$t .= '<a href="' . base_url('index.php/cr/view/' . $id . '/' . $chk . '') . '" class="btn btn-default">#</a>';
		$t .= '<a href="' . base_url('index.php/cr/view/' . $id . '/' . $chk . '/AREACONCEN') . '" class="btn btn-default">Área do conhecimento</a>';
		$t .= '<a href="' . base_url('index.php/cr/view/' . $id . '/' . $chk . '/LINHAPESQ1') . '" class="btn btn-default">Linha de Pesquisa #1</a>';
		$t .= '<a href="' . base_url('index.php/cr/view/' . $id . '/' . $chk . '/LINHAPESQ2') . '" class="btn btn-default">Linha de Pesquisa #2</a>';
		$t .= '<a href="' . base_url('index.php/cr/view/' . $id . '/' . $chk . '/LINHAPESQ3') . '" class="btn btn-default">Linha de Pesquisa #3</a>';
		$t .= '<a href="' . base_url('index.php/cr/view/' . $id . '/' . $chk . '/DISCIPLINA/R') . '" class="btn btn-default">Disciplinas</a>';
		$data['content'] = $t;
		$this -> load -> view('content', $data);

		if (strlen($ac) > 0) {
			$tela = $this -> rdfs -> edit($data['rdf'], $ac, $r);
			$data['content'] = $tela[0];
			$this -> load -> view('content', $data);
			
			if ($tela[1]=='1')
				{
					redirect(base_url('index.php/cr/view/'.$id.'/'.$chk));
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
		$this -> load -> model('cursos');
		$this -> cab();

		$form = new form;
		$form = $this -> cursos -> row($form);

		$tabela = "		(
						select inst.rdf_value as instituicao, id_cr,
						cr_codigo, cr_nome, cr_sigla, 
						cr_nota
						FROM ".$this->cursos->table." 
						LEFT JOIN rdf as inst ON cr_instituicao = rdf_resource
						) as instituicao ";

		$form -> tabela = $tabela;
		$form -> see = true;
		$form -> novo = true;
		$form -> edit = true;

		$form -> row_edit = base_url('index.php/biblioteconomia/edit');
		$form -> row_view = base_url('index.php/biblioteconomia/view');
		$form -> row = base_url('index.php/biblioteconomia/row');

		$tela = row($form, $pg);
		$data['content'] = $tela;
		$data['title'] = '';
		$this -> load -> view('content', $data);
	}

	public function edit($id = '') {
		$this -> load -> model('cursos');
		$this -> cab();
		$cp = $this -> cursos -> cp();

		$form = new form;
		$form -> id = $id;
		$tela = $form -> editar($cp, $this -> cursos -> table);
		$data['content'] = $tela;
		$data['title'] = '';
		$this -> load -> view('content', $data);

		if ($form -> saved > 0) {
			redirect(base_url('index.php/cr'));
		}

	}

}
?>
