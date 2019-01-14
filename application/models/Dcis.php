<?php
class dcis extends CI_model {
    function le($id) {
        $id = round($id);
        $sql = "select * from dci_curso
                    INNER JOIN dci_departamento ON id_d = dci_departamento 
                    INNER JOIN dci_faculdade ON id_f = d_faculdade
                    where id_dci = $id";
        $rlt = $this -> db -> query($sql);
        $rlt = $rlt -> result_array();
        if (count($rlt) > 0) {
            $data = $rlt[0];
        } else {
            $data = array();
        }
        return ($data);
    }

    function le_docente($id) {
        $id = round($id);
        $sql = "select * from dci_docente
                    INNER JOIN dci_curso ON id_dci = do_curso_1
                    INNER JOIN dci_departamento ON id_d = dci_departamento 
                    INNER JOIN dci_faculdade ON id_f = d_faculdade
                    where id_do = $id";
        $rlt = $this -> db -> query($sql);
        $rlt = $rlt -> result_array();
        if (count($rlt) > 0) {
            $data = $rlt[0];
        } else {
            $data = array();
        }
        return ($data);
    }

    function docente_show($id) {
        $data = $this -> le_docente($id);
        $sx = '<div class="container">';
        $sx .= '<div class="row">';
        $sx .= '<div class="col-md-6 big">' . $data['do_nome'] . '</div>';
        $sx .= '<div class="col-md-6 text-right"><b>' . $data['f_nome'] . '</b><br>' . $data['d_nome'] . '<br><i>' . $data['dci_curso'] . '</i></div>';
        $sx .= '</div>';

        $sx .= '<div class="row">';
        $sx .= '<div class="col-md-12" style="border-bottom: 1px solid #000000;"></div>';
        $sx .= '</div>';
        $sx .= '</div>';
        return ($sx);

    }

    function docentes_disciplinas($id) {
        $sql = "select * from dci_docente_disciplina
                        INNER JOIN dci_disciplina ON id_i = dd_disciplina
                        WHERE dd_docente = $id
                        ORDER BY dd_ano desc, dd_semestre desc, i_etapa, i_nome";
        $rlt = $this -> db -> query($sql);
        $rlt = $rlt -> result_array();
        $sx = '<table class="table">' . cr();
        for ($r = 0; $r < count($rlt); $r++) {
            $line = $rlt[$r];
            $link = '<a href="' . base_url('index.php/dci/docente_disciplina/' . $line['id_i']) . '">';
            $linka = '</a>';
            $sx .= '<tr>';
            $sx .= '<td align="center">' . ($r + 1) . '</td>';
            $sx .= '<td>' . $link . $line['i_codigo'] . $linka . '</td>';
            $sx .= '<td>' . $line['i_nome'] . '</td>';
            $sx .= '<td>' . $line['dd_ano'].'/'.$line['dd_semestre'].' - '.$line['dd_turma'] . '</td>';
            if ($line['i_ead'] == 1) {
                $sx .= '<td>EAD</td>';
            } else {
                $sx .= '<td>presencial</td>';
            }
            $sx .= '<td align="center">' . $line['i_ch'] . 'h</td>';
            $sx .= '<td align="center">' . $line['i_credito'] . '</td>';
            $sx .= '</tr>';
        }
        $sx .= '</table>';
        return ($sx);
    }

    function docentes_curso($id) {
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
        $rlt = $rlt -> result_array();
        $sx = '<table class="table">' . cr();
        for ($r = 0; $r < count($rlt); $r++) {
            $line = $rlt[$r];
            $link = '<a href="' . base_url('index.php/dci/docente/' . $line['id_do']) . '">';
            $linka = '</a>';
            $sx .= '<tr style="backgound-color: ' . $line['dci_cor'] . '">';
            $sx .= '<td align="center">' . ($r + 1) . '</td>';
            $sx .= '<td>' . $link . $line['do_nome'] . $linka . '</td>';
            $sx .= '<td>' . $line['do_titulacao'] . '</td>';
            $sx .= '<td>' . $line['dcs_situacao'] . '</td>';
            $sx .= '</tr>';
        }
        $sx .= '</table>';
        return ($sx);
    }

    function curso_show($id) {
        $data = $this -> le($id);
        $sx = '<div class="container">';
        $sx .= '<div class="row">';
        $sx .= '<div class="col-md-6 big">' . $data['dci_curso'] . '</div>';
        $sx .= '<div class="col-md-6 text-right"><b>' . $data['f_nome'] . '</b><br>' . $data['d_nome'] . '</div>';
        $sx .= '</div>';

        $sx .= '<div class="row">';
        $sx .= '<div class="col-md-12" style="border-bottom: 1px solid #000000;"></div>';
        $sx .= '</div>';
        $sx .= '</div>';
        return ($sx);
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
    
    function disciplinas_ed($id=0)
    {
        $cp = array();
        array_push($cp,array('$H8','id_i','',false,true));
        array_push($cp,array('$S10','i_codigo','Código',true,true));
        array_push($cp,array('$S80','i_nome','Nome da disciplina',true,true));
        array_push($cp,array('$O 1:SIM&0:NÃO','i_situacao','Ativo',true,true));
        array_push($cp,array('$Q id_it:it_descricao:select * from dci_disciplina_tipo order by id_it','i_tipo','Tipo',true,true));
        array_push($cp,array('$C1','i_ead','EAD',false,true));
        array_push($cp,array('$[0-9]','i_etapa','Estapa',true,true));
        array_push($cp,array('$H8','i_link','Link',false,true));
        array_push($cp,array('$H8','i_ch','Carga horária',false,true));
        array_push($cp,array('$[1-6]','i_credito','Credito',false,true));
        
        
        $form = new form;
        $form->id = $id;
        $tabela = 'dci_disciplina';
        $tela = $form->editar($cp,$tabela);
        if ($form-> saved > 0)
            {
                redirect(base_url('index.php/dci/disciplinas'));
            }
        return($tela);
    }

    function row_disciplinas($id=0) {

        $form = new form;
        $form -> fd = array('id_i', 'i_nome', 'i_codigo', 'i_etapa');
        $form -> lb = array('id', msg('cr_nome'), msg('cr_codigo'), msg('instituicao'), msg('Nota'));
        $form -> mk = array('', 'L', 'L', 'L', 'C', 'C', 'C');
        $form -> tabela = 'dci_disciplina';
        $form-> novo = true;
        $form-> edit = true;
        $form -> row_edit = base_url('index.php/dci/discilina_ed');
        $tela = row($form);
        return ($tela);
    }
    function docente_disciplina_add($id=0)
        {
            $cp = array();
            array_push($cp,array('$H8','','',false,false));
            array_push($cp,array('$Q id_do:do_nome:select * from dci_docente where id_do = '.$id,'dd_docente','Docente',true,true));
            array_push($cp,array('$Q id_i:i_codigo:select id_i, i_nome, concat(i_codigo, \' - \',i_nome) as i_codigo from dci_disciplina order by i_nome','dd_disciplina','Disciplina',true,true));
            array_push($cp,array('$S20','dd_ano','Ano',true,true));
            array_push($cp,array('$[1-2]','dd_semestre','Semestre',true,true));
            $form = new form;
            $tela = $form->editar($cp,'dci_docente_disciplina');
            if ($form->saved > 0)
                {
                    redirect(base_url('index.php/dci/docente/'.$id));
                }
            return($tela);
        }
    function docentes_disciplinas_nova($id=0)
        {
            $sx = '<a href="'.base_url('index.php/dci/docente_disciplina/'.$id).'" class="btn btn-primary">';
            $sx .= 'Atribuir disciplina';
            $sx .= '</a>';
            return($sx);
        }

}
?>
