<?php
class Patent extends CI_controller {
	function __construct() {
		parent::__construct();
		$this -> lang -> load("patents", "portuguese");
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
		$data['title'] = ':: Patent ::';
		$data['pag'] = 0;
		$this -> load -> view('patent/header', $data);
		if ($navbar == 1) {
			$this -> load -> view('patent/navbar', null);
		}
	}

	public function index() {
		redirect(base_url('index.php/patent/row'));
	}

	function sql($id = 0) {
		$file = "/home/rene/python/sql1/sql_" . ($id) . '.sql';
		#$file = "c:/lixo/patent/sql_" . ($id) . '.sql';
		if (file_exists($file)) {
			$rlt = fopen($file, 'r');
			$sql = fread($rlt, filesize($file));
			fclose($rlt);

			$rlt = $this -> db -> query($sql);
			echo "PROCESSADO ARQUIVO " . $file;
			echo '<meta http-equiv="refresh" content="1; url=' . base_url('index.php/patent/sql/' . ($id + 1)) . '" />';
		} else {
			echo "ERRO " . $file;
		}
	}

	function sql_del($id=0) {
		$sql = "select * from (
						SELECT max(id_pn) as idm, count(*) as total, pn_resource, pn_propriety, pn_value FROM patent
						group by pn_resource, pn_propriety, pn_value
						) as tabela
						where total > 1
						limit 10000 ";
		$rlt = $this -> db -> query($sql);
		$rlt = $rlt -> result_array();
		$sql = "delete from patent where ";
		if (($id / 10) == round($id / 10)) {
			for ($r = 0; $r < count($rlt); $r++) {
				$line = $rlt[$r];
				if ($r > 0) { $sql .= ' or ';
				}
				$sql .= ' (id_pn = ' . $line['idm'] . ') ';
			}
			if (count($rlt) > 0) {
				echo '<br>Excluído ' . count($rlt) . ' registros';
				$rlt = $this -> db -> query($sql);
				echo '<meta http-equiv="refresh" content="10; url=' . base_url('index.php/patent/sql_del/' . ($id + 1)) . '" />';
			}
		}
	}

	function import($file_nr = '') {
		$this -> cab();
		$this -> load -> model('patents');

		$file = '';
		$auto = 0;
		if (strlen($file_nr) > 0) {
			$auto = 1;
			$fileX = 'd:\patentes\pat (#).txt';
			$file = troca($fileX, '#', $file_nr);
		}

		$tela = '
				<form enctype="multipart/form-data" action="' . base_url('index.php/patent/import') . '" method="POST">
				    Enviar esse arquivo: <input name="userfile" type="file" />
				    <input type="submit" value="Enviar arquivo" />
				</form>			
			';
		$data['content'] = $tela;
		$data['title'] = msg('File Import');
		$this -> load -> view('content', $data);

		if (isset($_FILES['userfile']['tmp_name'])) {
			$file = $_FILES['userfile']['tmp_name'];
		}

		if (strlen($file) > 0) {
			echo '<h1>' . $file . '</h1>';
			$file2 = troca($fileX . 'x', '#', $file_nr);
			$cmd = 'TYPE "' . $file . '" > "' . $file2 . '"';
			shell_exec($cmd);

			//$sx = $this->patents->inport_file($file);
			//$data['content'] = '<pre>'.$sx.'</pre>';
			//$this->load->view('content',$data);

			$tela = $this -> patents -> process_file($file2);
			$data['content'] = $tela;
			$data['title'] = msg('File Import - Process');
			$this -> load -> view('content', $data);
		}
		if ($auto == 1) {
			echo '<meta http-equiv="refresh" content="5; ' . base_url('index.php/patent/import/' . ($file_nr + 1)) . '">';
		}
	}

	function tools($i = '', $cp = '') {
		$this -> load -> model('patents');
		$this -> cab();

		$title = 'Menu';
		$tela = '<h3>' . msg('Tools 1') . '</h3>';
		$tela .= '<tt>';
		for ($nr = 1; $nr <= 24; $nr++) {
			$nr = strzero($nr, 2);
			if ($nr > 1) { $tela .= ' | ';
			}
			$tela .= '<a href="' . base_url('index.php/patent/tools/1/' . $nr) . '">' . msg('pt_' . $nr) . '</a>';
		}
		$tela .= '</tt>';
		$data['content'] = $tela;
		$this -> load -> view('content', $data);

		switch($i) {
			case '1' :
				$title = 'Tools - Agrupador';
				$tela = $this -> patents -> tools_1($cp);
				break;
			default :
				$tela = '';
				$title = '';
				break;
		}
		$data['title'] = $title;
		$data['content'] = $tela;
		$this -> load -> view('content', $data);
	}

	public function row($pg = '') {
		$this -> load -> model('patents');
		$this -> cab();

		$form = new form;
		$form = $this -> patents -> row($form);

		$tabela = "patent";

		$form -> tabela = $tabela;
		$form -> see = true;
		$form -> novo = true;
		$form -> edit = true;

		$form -> row_edit = base_url('index.php/patent/edit');
		$form -> row_view = base_url('index.php/patent/view');
		$form -> row = base_url('index.php/patent/row');

		$tela = row($form, $pg);
		$data['content'] = $tela;
		$data['title'] = '';
		$this -> load -> view('content', $data);
	}

	public function view($id = '') {
		$this -> load -> model('patents');
		$this -> cab();

		$tela = $this -> patents -> show_line($id);
		$data['content'] = $tela;
		$data['title'] = '';
		$this -> load -> view('content', $data);
	}

}
?>
