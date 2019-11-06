<?php
class cdus extends CI_model
{
	function qst($id='')
		{
			$sx = '';
			$data = $this->le($id);

			if ($data['t']=='?')
			{
				$data = $this->classificar($data);
			}

			switch($data['t'])
				{
					case '1':
					/* Resposta única */
					$sx .= $this->show_tp1($data);
					break;

					case '5':
					/* Multipla escolha */
					$sx .= $this->show_tp5($data);
					break;

					case '9':
					/* Relaciona as colunas */
					$sx .= $this->show_tp9($data);
					break;	

					default:
					print_r($data);
					break;									
				}
			return($sx);
		}

	/************************************ Mostra perguntas ************/
	function show_tp1($data)
		{
			$sx = '';
			$sx .= '<h3>'.$data['p3'].'</h3>';
			$sx .= '<b>'.$data['p4'].'</b>';
			$form = new form;
			$cp = array();
			array_push($cp,array('$A','',$data['p3'],false,false));
			array_push($cp,array('$M','',$data['p4'],false,false));
			array_push($cp,array('$S100','','Resposta:',true,true));
			$sx = $form->editar($cp,'');
			return($sx);
		}

	function show_tp5($data)
		{
			$sx = '';
			$sx .= '<h3>'.$data['p3'].'</h3>';
			$sx .= '<b>'.mst($data['p4']).'</b>';

			$op = $data['p5'];
			$op = troca($op,'=a)','a)=');
			$op = troca($op,'~','');
			$op = troca($op,'a)',';');
			$op = troca($op,'a)',';');
			$op = splitx(';',$op);
			$ops = '';
			for ($r=0;$r < count($op);$r++)
			{
				$o = trim($op[$r]);
				if (strlen($ops) > 0)
				{
					$ops .= '&';
				}
				if (strlen($o) > 0)
				{
					if (substr($o,0,1) == '=')
					{
						$o = trim(substr($o,2,strlen($o)));
					}
					$ops .= $r.':'.$o;	
				}
				
			}

			$form = new form;
			$cp = array();
			array_push($cp,array('$A','',$data['p3'],false,false));
			array_push($cp,array('$M','',$data['p4'],false,false));
			array_push($cp,array('$R '.$ops,'','Resposta:',true,true));
			$sx = $form->editar($cp,'');
			return($sx);
		}	

	function show_tp9($data)
		{
			$sx = '';
			$sx .= '<h3>'.$data['p3'].'</h3>';
			$sx .= '<b>'.mst($data['p4']).'</b>';

			$op = $data['p5'];	
			echo $op;		
			$op = troca($op,'->',';');
			$op = troca($op,'=',';');
			$op = splitx(';',$op);
			$ops = '';
			for ($r=0;$r < count($op);$r=$r+2)
			{
				$o = trim($op[$r]);
				if (strlen($ops) > 0)
				{
					$ops .= '&';
				}
				if (strlen($o) > 0)
				{
					if (substr($o,0,1) == '=')
					{
						$o = trim(substr($o,2,strlen($o)));
					}
					$ops .= $r.':'.$o;	
				}
				
			}

			$form = new form;
			$cp = array();
			array_push($cp,array('$A','',$data['p3'],false,false));
			array_push($cp,array('$M','',$data['p4'],false,false));
			for ($r=1;$r < count($op);$r=$r+2)
			{
				array_push($cp,array('$O '.$ops,'',$op[$r],true,true));	
			}
			
			$sx = $form->editar($cp,'');
			return($sx);
		}			

	function classificar($d)
		{
			$q = $d['p5'];
			$tp = $d['t'];
			if (substr($q,0,2) == '=%')
			{
				$tp = '1';
			}
			if (strpos(' '.$q,'~a)') > 0)
			{
				$tp = 5;
			}

			if (strpos(' '.$q,'->') > 0)
				{
					$tp = 9;
				}
			$sql = "update questions set t='$tp' where id_q = ".round($d['id_q']);
			$rlt =$this->db->query($sql);
			$d['t'] = $tp;
			return($d);
		}
	function le($id='')
		{
			$sql = "select * from questions where id_q = ".round($id);
			$rlt = $this->db->query($sql);
			$rlt = $rlt->result_array();
			$line = $rlt[0];
			return($line);
		}
	function row($id='')
		{
			$sql = "select * from questions order by p2";
			$rlt = $this->db->query($sql);
			$rlt = $rlt->result_array();
			$sx = '<table class="table" >';
			for ($r=0;$r < count($rlt);$r++)
			{
				$line = $rlt[$r];
				$link = '<a href="'.base_url(PATH.'q/'.$line['id_q']).'">';
				$linka = '</a>';
				$sx .= '<tr>';
				$sx .= '<td width="25%">'.$link.$line['p2'].$linka.'</td>';
				$sx .= '<td width="25%">'.$link.$line['p4'].$linka.'</td>';
				$sx .= '<td width="73%">'.$link.$line['p5'].$linka.'</td>';
				$sx .= '<td width="2%">'.$link.$line['t'].$linka.'</td>';
				$sx .= '</tr>';
			}
			$sx .= '</table>';
			return($sx);
		}
	function form()
	{
		$pg = '';
		$tela = '<div class="row"><div class="col-md-12">';
		if (strlen($pg) == 0)
		{
			$form = new form;
			$form->offset = $pg;
			$cp = array();
			array_push($cp,array('$H8','','',false,false));
			array_push($cp,array('$FILE','','',false,false));		
			$tela .= $form->editar($cp,'');

			/*** FILE **/
			/************* Processar arquivo **********/
			if (isset($_FILES['fileToUpload']['tmp_name']) and ($form->saved > 0) and (strlen($_FILES['fileToUpload']['tmp_name']) > 0))
			{
				/*********************** Preparando ****************/
				$file = $_FILES['fileToUpload']['tmp_name'];
				$l = file_get_contents($file);	
				$l = strip_tags($l);
				$l = troca($l,chr(9),'');
				$l = troca($l,chr(13),'');
				$l = troca($l,chr(10),'');
				$l = troca($l,"'",'´');
				$l = troca($l,'http\://',chr(13).'http:');
				$l = troca($l,'\:',':');
				$l = troca($l,'//',chr(13).'//');
				$ln = splitx(chr(13),$l);

				/*********************** Processando ***************/
				for ($r=0;$r < count($ln);$r++)
				{
					$l = $ln[$r];
					$p1 = substr($l,0,strpos($l,'name:'));
					$n = substr($l,strpos($l,'name:'),strlen($l));
					if (strpos($l,'::') > 0)
					{
						$p2 = substr($n,0,strpos($n,'::'));
						$n = substr($n,strpos($n,'::')+2,strlen($n));

						$p3 = substr($n,0,strpos($n,'::'));
						if (strlen($p3) > 0)
						{
							$n = substr($n,strpos($n,'::')+2,strlen($n));
							$p4 = substr($n,0,strpos($n,'{'));
							$n = substr($n,strpos($n,'{')+1,strlen($n));
							$p5 = substr($n,0,strpos($n,'}'));
						} else {
							$p4 = '';
							$p5 = '';
						}
					} else {
						$p2 = '';
						$p3 = '';
						$p4 = '';
						$p5 = '';
					}

					if ((substr($p1,0,2) == '//') and (substr($p2,0,5) == 'name:'))
					{
						$p1 = trim(troca($p1,'//',''));
						$p2 = trim(troca($p2,'name:',''));
						$p5 = troca($p5,"'","´");
						$p5 = troca($p5,"html]","");
						$id = $this->question($p1,$p2,$p3,$p4,$p5);
					}
				}

			} else {
				$tela .= 'OPs';
			}			
		}
		$tela .= '</div>';
		return($tela);				
	}

	function question($p1,$p2,$p3,$p4,$p5)
		{
			$sql = "select * from questions	where p1 = '$p1' and p2 = '$p2' and p3 = '$p3' and p4 = '$p4' and p5 = '$p5' ";
			$rlt = $this->db->query($sql);
			$rlt = $rlt->result_array();
			if (count($rlt) == 0)
			{
				$sql = "insert into questions
						(p1,p2,p3,p4,p5)
						values
						('$p1','$p2','$p3','$p4','$p5')";
				$rlt = $this->db->query($sql);
				echo "*** NOVO ***";
			}
		}
	function bank($id)
	{

	}

}
?>