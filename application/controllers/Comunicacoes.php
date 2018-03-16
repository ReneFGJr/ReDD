<?php
class comunicacoes extends CI_Controller {
	function __construct() {
		global $dd, $acao;
		parent::__construct();

		//$this -> load -> library("nuSoap_lib");

		$this -> load -> library('form_validation');
		$this -> load -> database();
		$this -> load -> helper('form');
		$this -> load -> helper('form_sisdoc');
		$this -> load -> helper('email_sisdoc');
		$this -> load -> helper('url');
		$this -> load -> library('session');
		$this -> lang -> load("comunicacoes", "portuguese");
		date_default_timezone_set('America/Sao_Paulo');

		/* Security */
		//$this -> load -> model('usuarios');
		//$this -> usuarios -> security();

		//$this -> lang -> load("app", "english");
	}

	public function cab($navbar = 1) {
		$data['title'] = ':: ReDD - Login ::';
		$this -> load -> view('header/header', $data);
		if ($navbar == 1) {
			//$this->load->view('header/navbar',null);
		}
	}

	function index() {
	}

	function sendmailer($l = 0, $pos = 0) {

		enviaremail('renefgj@gmail.com', 'teste', 'teste de <I>e-mail</i>', 1);
		echo 'Enviado Teste!';
	}

	function message($id = '') {
		$this -> cab();

		$form = new form;
		$form -> fd = array('id_nw', 'nw_ref', 'nw_own', 'mw_subject', 'nw_created', 'nw_active');
		$form -> lb = array('ID', 'Ref', 'Dono', 'Título', 'Cadastro', 'Ativo', '', '');
		$form -> mk = array('', 'L', 'L', 'L', 'C', 'SN');
		$form -> tabela = 'mensagem';
		$form -> see = true;
		$form -> novo = true;
		$form -> edit = true;
		$form -> row_edit = base_url('index.php/comunicacoes/message_edit');
		$form -> row_view = base_url('index.php/comunicacoes/message_view');
		$form -> row = base_url('index.php/comunicacoes');

		$tela = row($form, $id);
		$data['content'] = $tela;
		$this -> load -> view('content', $data);
	}
	
	function message_send($id = '',$pg='') {
		$this -> cab();
		echo '<meta http-equiv="refresh" content="15">';		
		$sql = "select * from mensagem_mailerlist_email
					INNER JOIN mensagem_email ON id_em = mm_email
					WHERE mm_status = 1 and em_status = 1 
					limit 1";
		$rlt = $this->db->query($sql);
		$erlt = $rlt->result_array();
		
		$sql = "select * from mensagem 
					where id_nw = ".$id;
		$rlt = $this->db->query($sql);
		$rlt = $rlt->result_array();
		$line = $rlt[0];
		
		$tela = '<center><table width="600" border=0 cellpadding=5 class="message_rdp" style="line-height: 150%; font-family: Tahoma, Verdana, Arial;"> ';
		$tela .= '<tr><td style="padding: 10px;">';
		$tela .= '<b>'.$line['mw_subject'].'</b>';
		$tela .= '</td></tr>'.cr();
		$text = $line['nw_texto'];
		if ($line['nw_format'] == 'TEXT')
			{
				$text = troca($text,chr(13),'<br>');
			}

		$tela .= '<tr><td style="padding: 10px;">';
		$tela .= $text;
		$tela .= '</td></tr>'.cr();
		$tela .= '</table></center>';
		
		
		
		$data['content'] = $tela;
		$this -> load -> view('content', $data);
		$css = '';
				
		$tela = utf8_decode($tela);
		$i= 0;
		
		for ($r=0;$r < count($erlt);$r++)
			{
				$eline = $erlt[$r];
				$email = $eline['em_email'];
				$id_mm = $eline['id_mm'];
				enviaremail($email, '[RDP] '.$line['mw_subject'], $css.$tela, 1);		
				echo 'Enviado ==> '.$email.' ('.($i++).')'.'<br>';
				$sql = "update mensagem_mailerlist_email set mm_status = 0 where id_mm = ".$id_mm;
				$qrlt = $this->db->query($sql);
			}
	}	
	
	function message_view($id = '') {
		$this -> cab();
		
		$sql = "select * from mensagem 
					where id_nw = ".$id;
		$rlt = $this->db->query($sql);
		$rlt = $rlt->result_array();
		$line = $rlt[0];
		
		$tela = '<center><table width="600" border=0 cellpadding=5 class="message_rdp" style="line-height: 150%; font-family: Tahoma, Verdana, Arial;"> ';
		$tela .= '<tr><td style="padding: 10px;">';
		$tela .= '<b>'.$line['mw_subject'].'</b>';
		$tela .= '</td></tr>'.cr();
		$text = $line['nw_texto'];
		if ($line['nw_format'] == 'TEXT')
			{
				$text = troca($text,chr(13),'<br>');
			}

		$tela .= '<tr><td style="padding: 10px;">';
		$tela .= $text;
		$tela .= '</td></tr>'.cr();
		$tela .= '</table></center>';
		
		
		
		$data['content'] = $tela;
		$this -> load -> view('content', $data);
		$css = '';
				
		$tela = utf8_decode($tela);
		$i= 0;
		//enviaremail('sonia.caregnato@gmail.com', '[RDP] '.$line['mw_subject'], $css.$tela, 1);
		echo 'Enviado ==>'.($i++).'<br>';
		//enviaremail('paulacarolinejardim@gmail.com', '[RDP] '.$line['mw_subject'], $css.$tela, 1);
		echo 'Enviado ==>'.($i++).'<br>';
		//enviaremail('rafael.rocha@ufrgs.br', '[RDP] '.$line['mw_subject'], $css.$tela, 1);
		echo 'Enviado ==>'.($i++).'<br>';
		//enviaremail('carolina.felicissimo@rnp.br', '[RDP] '.$line['mw_subject'], $css.$tela, 1);
		echo 'Enviado ==>'.($i++).'<br>';
		//enviaremail('leandro.ciuffo@rnp.br', '[RDP] '.$line['mw_subject'], $css.$tela, 1);
		echo 'Enviado ==>'.($i++).'<br>';
		//enviaremail('renefgj@gmail.com', '[RDP] '.$line['mw_subject'], $css.$tela, 1);
		echo 'Enviado ==>'.($i++).'<br>';		
	}	

	function message_edit($id = '') {
		$this -> cab();
		$cp = array();
		$sql_own = 'id_m:m_name:select * from mensagem_own where m_active = 1 ';
		array_push($cp, array('$H8', 'id_nw', '', False, True));
		array_push($cp, array('$S20', 'nw_ref', msg('ref'), False, True));
		array_push($cp, array('$S40', 'mw_subject', msg('titulo'), False, True));
		array_push($cp, array('$T80:13', 'nw_texto', msg('texto'), False, True));
		array_push($cp, array('$Q ' . $sql_own, 'nw_own', 'Enviador', False, True));

		array_push($cp, array('$O 1:Sim&0:Não', 'nw_active', msg('ativo'), True, True));
		array_push($cp, array('$O HTML:HTML&TEXT:TEXT', 'nw_format', msg('formato'), True, True));
		array_push($cp, array('$B', '', msg('enviar'), false, True));

		$form = new form;
		$form -> cp = $cp;
		$form -> id = $id;
		$tela = $form -> editar($cp, 'mensagem');
		$data['content'] = $tela;
		$this -> load -> view('content', $data);
		if ($form->saved > 0)
			{
				redirect(base_url('index.php/comunicacoes/message'));
			}
		
	}

	function inport_list() {
		$this -> cab();
		$cp = array();
		array_push($cp, array('$H8', '', '', false, false));
		array_push($cp, array('$T80:8', '', 'lista de e-mail', true, true));
		array_push($cp, array('$M', '', '<center>informe um por linha, separando o e-mail e o nome por ponto e virgua, ex:<br>renefgj@gmail.com;Rene Faustino Gabriel Junior</center>', false, true));
		array_push($cp, array('$Q id_ml:ml_name:select * from mensagem_mailerlist where ml_active=1 order by ml_name', '', 'Inserir na lista', false, false));
		array_push($cp, array('$B8', '', 'Inserir na lista', false, false));
		$form = new form;
		$tela = $form -> editar($cp, '');

		if ($form -> saved > 0) {
			$l = get("dd1");
			$mailer_id = get("dd3");

			$l = troca($l, ';', '#');
			$l = troca($l, chr(13), ';');
			$l = troca($l, chr(10), ';');
			$l = splitx(';', $l);
			//$tela = '';
			for ($r = 0; $r < count($l); $r++) {
				$n = $l[$r];
				$n = splitx('#', $n);
				$email = '';
				if (count($n) > 1) {
					if (strpos($n[0], '@')) {
						$email = $n[0];
						$name = $n[1];
					} else {
						$email = $n[1];
						$name = $n[0];
					}
				} else {
					$email = $n[0];
					$name = '';
				}
				$tela .= '<br>==>' . $email . ' -> ' . $name;
				$sql = "select * from mensagem_email where em_email = '" . $email . "'";
				$rlt = $this -> db -> query($sql);
				$rlt = $rlt -> result_array();
				if (count($rlt) == 0) {
					$zsql = "insert into mensagem_email (em_name, em_email) values ('$name','$email')";
					$rltx = $this -> db -> query($zsql);
					$rlt = $this -> db -> query($sql);
					$rlt = $rlt -> result_array();
					$tela .= ' <span style="color:green;">inserido!</span>';
				} else {
					$tela .= ' <span style="color:red;">já existe!</span>';
				}
				$email_id = $rlt[0]['id_em'];
				$sql = "select * from mensagem_mailerlist_email where mm_email = $email_id and mm_ml = $mailer_id";
				$rlt = $this -> db -> query($sql);
				$rlt = $rlt -> result_array();
				if (count($rlt) == 0) {
					$sql = "insert into mensagem_mailerlist_email (mm_email, mm_ml) values ($email_id,$mailer_id)";
					$rlt = $this -> db -> query($sql);
					$tela .= ' -> <span style="color: blue;"> incorporado</span>';
				}
				$tela .= cr();

			}
		}

		$data['content'] = $tela;
		$this -> load -> view('content', $data);
	}

}
