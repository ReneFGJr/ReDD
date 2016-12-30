<?php
class researchers extends CI_Model
	{
	var $table = 'researcher';
	
	function le($id='')
		{
			$id = round($id);
			$sql = "select * from ".$this->table." where id_r = ".$id;
			$rlt = $this->db->query($sql);
			$rlt = $rlt->result_array();
			if (count($rlt) > 0)
				{
					$line = $rlt[0];
					return($line);
				} else {
					return(array());
				}
		}
	
	function row()
		{
			$sql = "select * from ".$this->table." where r_status = 1 order by r_name";
			$rlt = $this->db->query($sql);
			$rlt = $rlt->result_array();
			
			$sx = '';
			$sx .= '<div class="row">'.cr();
			$sx .= '<div class="col-md-12">'.cr();
			$sx .= '<table class="table">'.cr();
			$sx .= '<tr>';
			$sx .= '<th>'.msg('name').'</th>';
			$sx .= '</tr>';
			for ($r=0;$r < count($rlt);$r++)
				{
					$line = $rlt[$r];
					$link = '<a href="'.base_url('index.php/research/id/'.$line['id_r']).'" class="middle">';
					
					$sx .= '<tr>';
					$sx .= '<td>';
					$sx .= $link.$line['r_name'].'</a>';
					$sx .= '</td>';
					$sx .= '</tr>';
				}
			$sx .= '</table>';
			$sx .= '</div>'.cr();
			$sx .= '</div>'.cr();
			return($sx);
		}	
	}
?>
