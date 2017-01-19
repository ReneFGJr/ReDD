<?php
class highcharts extends CI_Model
	{
	function column()
		{
			$sx = '';
			$sx .= $this->load->view('highchart/highchart_column',null,true);
			return($sx);
		}	
	function column_simple($data)
		{
			$sx = '';
			$sx .= $this->load->view('highchart/highchart_column_simple',$data,true);
			return($sx);
		}
	}
?>
