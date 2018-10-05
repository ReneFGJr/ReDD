<?php
class Bibliometrics extends CI_model
	{
	function action_troca_remissicas($a,$b)
		{
			$b = troca($b,chr(13),';');
			$b = troca($b,chr(10),'');
			$lb = splitx(';',$b); 
			for ($r = 0;$r < count($lb);$r++)
				{
					$t1 = substr($lb[$r],0,strpos($lb[$r],'=>'));
					$t2 = substr($lb[$r],strpos($lb[$r],'=>')+2,strlen($lb[$r]));
					$a = troca($a,$t1,$t2);
				}
			return($a);
		}
	function action_remover_entre_colchetes($k)
		{
			$s = '';
			$k = troca($k,'[','<');
			$k = troca($k,']','>');
			$s = strip_tags($k);
			return($s);
		}
	function form()
		{
			$cp = array();
			array_push($cp,array('$H8','','',false,false));
			array_push($cp,array('$T8:10','','Original',true,true));
			array_push($cp,array('$T8:10','','Result',false,true));
			array_push($cp,array('$T8:10','','Matriz',false,true));
			
			$op = '1:Remover entre colchetes';
			$op .= '&2:Trocar termos de para (=>)';
			array_push($cp,array('$O'.$op,'','Function',true,true));
			$form = new form;
			$sx = $form->editar($cp,'');
			
			
			return($sx);
		}	
	}
?>