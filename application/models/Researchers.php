<?php
class researchers extends CI_Model {
	var $table = 'researcher';
    var $table_ppg_line = 'researcher_ppg_line';

	function le($id = '') {
		$id = round($id);
		$sql = "select * from " . $this -> table . " where id_r = " . $id;
		$rlt = $this -> db -> query($sql);
		$rlt = $rlt -> result_array();
		if (count($rlt) > 0) {
			$line = $rlt[0];
			return ($line);
		} else {
			return ( array());
		}
	}
    
    function ppg_line_list($id)
        {
            $sql = "select rdl_docente 
                        from ".$this->table_ppg_line."
                        inner join researcher_docente_line ON rdl_line = id_rpl
                        inner join researcher ON id_r = rdl_docente
                        where id_rpl = $id 
                        group by rdl_docente";
                        
            $rlt = $this->db->query($sql);
            $rlt = $rlt->result_array();
            
            /*** docentes **/
            $p = array();
            for ($r=0;$r < count($rlt);$r++)
                {
                    $line = $rlt[$r];
                    array_push($p,$line['rdl_docente']);
                }
//            echo '<pre>';
//            print_r($p);
        }
	
	function cp($id='')
		{
			$cp = array();
			array_push($cp,array('$H8','id_r','',false,true));
			array_push($cp,array('$S80','r_name',msg('full_name'),false,true));
			array_push($cp,array('$S80','r_xml',msg('link_lattes_xml'),true,true));
			array_push($cp,array('$S80','r_lattes',msg('link_lattes'),false,true));
			array_push($cp,array('$O 1:Ativo&0:Inativo','r_status',msg('status'),true,true));
            array_push($cp,array('$B8','',msg('save'),false,true));
			return($cp);
		}

	function row($obj) {
		$obj -> fd = array('id_r', 'r_name','r_lattes_id','r_lastupdate');
		$obj -> lb = array('ID', 'Nome','ID Lattes','Atualizado');
		$obj -> mk = array('', 'L', 'D', 'D', 'C');
		return ($obj);
	}
    
    function row_ppg_line($obj) {
        $obj -> fd = array('id_rpl', 'rpl_name','rp_programa');
        $obj -> lb = array('ID', 'Nome','Programa');
        $obj -> mk = array('', 'L', 'D', 'D', 'C');
        return ($obj);
    }    
	
	function lattesReadXML($id)
		{
			$data = $this -> researchers -> le($id);
			$xml = trim($data['r_xml']);
			$idl = sonumero($data['r_lattes']);
			if (strlen($xml) > 0)
				{
					$data = $this->lattes->readXML($xml,$idl);
			
					$sql = "update ".$this->table." set ";
					$sql .= " r_lastupdate = '".$data['atualizado']."',";
					$sql .= " r_harvesting = '".date("Ymd")."',";
					$sql .= " r_lattes_id = '".$data['numero_id']."'";
					$sql .= " where id_r = ".round($id);
					$rlt = $this->db->query($sql);
				}
		}
}
?>
