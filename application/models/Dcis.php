<?php
class dcis extends CI_model {
    function le($id) {
        $id = round($id);
        $sql = "select * from dci_curso
                    INNER JOIN dci_departamento ON id_d = dci_departamento 
                    INNER JOIN dci_faculdade ON id_f = d_faculdade
                    where id_dci = $id";
        $rlt = $this -> db -> query($sql);
        $rlt = $rlt->result_array();
        if (count($rlt) > 0)
            {
                $data = $rlt[0];
            } else {
                $data = array();
            }
        return($data);        
    }
    
    function le_docente($id) {
        $id = round($id);
        $sql = "select * from dci_docente
                    INNER JOIN dci_curso ON id_dci = do_curso_1
                    INNER JOIN dci_departamento ON id_d = dci_departamento 
                    INNER JOIN dci_faculdade ON id_f = d_faculdade
                    where id_do = $id";
        $rlt = $this -> db -> query($sql);
        $rlt = $rlt->result_array();
        if (count($rlt) > 0)
            {
                $data = $rlt[0];
            } else {
                $data = array();
            }
        return($data);        
    }    
    
    function docente_show($id)
        {
            $data = $this->le_docente($id);
            $sx = '<div class="container">';
            $sx .= '<div class="row">';
            $sx .= '<div class="col-md-6 big">'.$data['do_nome'].'</div>';
            $sx .= '<div class="col-md-6 text-right"><b>'.$data['f_nome'].'</b><br>'.$data['d_nome'].'<br><i>'.$data['dci_curso'].'</i></div>';
            $sx .= '</div>';
            
            $sx .= '<div class="row">';
            $sx .= '<div class="col-md-12" style="border-bottom: 1px solid #000000;"></div>';
            $sx .= '</div>';
            $sx .= '</div>';
            return($sx);       
              
        }
    function docentes_disciplinas($id)
        {
            $sql = "select * from dci_docente_disciplina
                        INNER JOIN dci_disciplina ON id_i = dd_disciplina
                        WHERE dd_docente = $id
                        ORDER BY dd_ano desc, dd_semestre desc, i_etapa, i_nome";
        $rlt = $this -> db -> query($sql);
        $rlt = $rlt->result_array();  
        $sx = '<table class="table">'.cr();
        for ($r=0;$r < count($rlt);$r++)
            {
                $line = $rlt[$r];
                $link = '<a href="'.base_url('index.php/dci/docente_disciplina/'.$line['id_i']).'">';
                $linka = '</a>';
                $sx .= '<tr>';
                $sx .= '<td align="center">'.($r+1).'</td>';
                $sx .= '<td>'.$link.$line['i_codigo'].$linka.'</td>';
                $sx .= '<td>'.$line['i_nome'].'</td>';
                if ($line['i_ead'] == 1)
                    {
                        $sx .= '<td>EAD</td>';        
                    } else {
                        $sx .= '<td>presencial</td>';
                    }
                $sx .= '<td align="center">'.$line['i_ch'].'h</td>';
                $sx .= '<td align="center">'.$line['i_credito'].'</td>';
                $sx .= '</tr>';
            } 
        $sx .= '</table>';
        return($sx);                        
        }
    
    function docentes_curso($id)
        {
        $id = round($id);
        $sql = "select * from dci_docente
                    INNER JOIN dci_docente_situacao ON id_dcs = do_situacao
                    INNER JOIN dci_curso ON id_dci = do_curso_1
                    INNER JOIN dci_departamento ON id_d = dci_departamento                                         
                    INNER JOIN dci_faculdade ON id_f = d_faculdade
                    where (do_curso_1 = $id) OR (do_curso_2 = $id) OR (do_curso_3 = $id)
                    order by do_nome
                    ";
        $rlt = $this -> db -> query($sql);
        $rlt = $rlt->result_array();  
        $sx = '<table class="table">'.cr();
        for ($r=0;$r < count($rlt);$r++)
            {
                $line = $rlt[$r];
                $link = '<a href="'.base_url('index.php/dci/docente/'.$line['id_do']).'">';
                $linka = '</a>';
                $sx .= '<tr style="backgound-color: '.$line['dci_cor'].'">';
                $sx .= '<td align="center">'.($r+1).'</td>';
                $sx .= '<td>'.$link.$line['do_nome'].$linka.'</td>';
                $sx .= '<td>'.$line['do_titulacao'].'</td>';
                $sx .= '<td>'.$line['dcs_situacao'].'</td>';
                $sx .= '</tr>';
            } 
        $sx .= '</table>';
        return($sx);
        }
    
    function curso_show($id) {
        $data = $this->le($id);
        $sx = '<div class="container">';
        $sx .= '<div class="row">';
        $sx .= '<div class="col-md-6 big">'.$data['dci_curso'].'</div>';
        $sx .= '<div class="col-md-6 text-right"><b>'.$data['f_nome'].'</b><br>'.$data['d_nome'].'</div>';
        $sx .= '</div>';
        
        $sx .= '<div class="row">';
        $sx .= '<div class="col-md-12" style="border-bottom: 1px solid #000000;"></div>';
        $sx .= '</div>';
        $sx .= '</div>';
        return($sx);               
    }    

    function cursos() {
        $sql = "select * from dci_curso where dci_ativo = 1";
        $rlt = $this -> db -> query($sql);
        $sx = '<div class="row big">' . cr();
        $rlt = $rlt -> result_array();
        for ($r = 0; $r < count($rlt); $r++) {
            $line = $rlt[$r];
            $link = '<a href="' . base_url('index.php/dci/cursos/' . $line['id_dci']) . '">';
            $sx .= '<div class="col-md-12">';
            $sx .= $link . $line['dci_curso'] . '</a>';
            $sx .= '</div>' . cr();
        }
        $sx .= '</div>';
        return ($sx);
    }

}
?>
