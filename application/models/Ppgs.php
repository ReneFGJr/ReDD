<?php
class ppgs extends CI_model
	{
	var $table = 'programa_pos';
	
	function le($id='')
		{
			$sql = "select * from ".$this->table." where id_ppg = ".$id;
			$rlt = $this->db->query($sql);
			$rlt = $rlt->result_array();
			if (count($rlt) > 0)
				{
					$line = $rlt[0];					
					$line['instituicao'] = $this->rdfs->le($line['ppg_instituicao']);
					
					$line['rdf'] = 'ppg:'.$line['id_ppg'];
					
					return($line);		
				}
			return(array());
		}
	
	function row($form) {

		$form -> fd = array('id_ppg', 'ppg_programa', 'ppg_codigo','instituicao','ppg_nota_d','ppg_nota_m','ppg_nota_p');
		$form -> lb = array('id', msg('ppg_programa'), msg('ppg_codigo'), msg('instituicao'), msg('Dr.'), msg('Msc.'), msg('Prof.'));
		$form -> mk = array('', 'L', 'L', 'L','C','C','C');


		return($form);
	}
	
	function cp()
		{
			$cp = array();
			array_push($cp,array('$H8','id_ppg','',false,false));
			array_push($cp,array('$S20','ppg_codigo','Código Capes',True,True));
			array_push($cp,array('$S80','ppg_programa','Nome do Programa',True,True));
			array_push($cp,array('$H50','ppg_sigla','Sigla',false,True));
			array_push($cp,array('$RDF:area','ppg_area','Área',True,True));
			array_push($cp,array('$RDF:instituicao','ppg_instituicao','Instituição',True,True));
			
			array_push($cp,array('$[0-7]D','ppg_nota_d','Nota (doutorado)',false,True));
			array_push($cp,array('$[0-7]D','ppg_nota_m','Nota (mestrado)',false,True));
			array_push($cp,array('$[0-7]D','ppg_nota_p','Nota (profissional)',false,True));
			
			array_push($cp,array('$S100','ppg_link','Link do programa',False,True));
			
			return($cp);
		}	
	}
?>
