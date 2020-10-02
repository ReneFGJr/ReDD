<?php
class serviceplace extends CI_model
    {
        function main()
            {
                $sx = '';
                $sx .= '<div class="row">';
                $sx .= '<div class="col-md-12 text-right text-light"><h1>Service Place</h1></div>';
                $sx .= '</div>';
                return($sx);
            }

        function services()
            {
                $sql = "select * from services where s_active = 1 order by s_name";
                $rlt = $this->db->query($sql);
                $rlt = $rlt->result_array();
                $sx = '<ul>';
                for ($r=0;$r < count($rlt);$r++)
                    {
                        $line = $rlt[$r];
                        $link = '<A href="'.base_url('index.php/'.$line['s_link']).'">';
                        $linka = '</a>';
                        $sx .= '<li>'.$link.msg($line['s_name']).$linka.'</li>'.cr();
                    }
                $sx .= '</ul>';
                return($sx);
            }
    }