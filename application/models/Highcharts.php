<?php
class highcharts extends CI_Model
	{
	function column()
		{
			$sx = '';
			$sx .= $this->load->view('highchart/highchart_column',null,true);
			return($sx);
		}	
        
      
	function column_simple($data,$frame='')
		{
			$sx = '';
            if (strlen($frame) == 0)
                {
                    $frame = 'div-'.date("YmdHis");
                }
            $data['frame'] = $frame;
			$sx .= $this->load->view('highchart/highchart_column_double',$data,true);
			/* $sx .= $this->load->view('highchart/highchart_column_simple',$data,true); */
			return($sx);
		}
	}
?>
