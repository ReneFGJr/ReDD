<?php
class marc21 extends CI_model {

    function marc_form($id = 0, $act = '') {
        if (strlen($act) > 0)
            {
                if ($act != 'ind')
                {
                    $this->marc21_action($id,$fd,$xtag,$act);
                    $act = '';
                    $xtag = 0;
                }
            }
        $sx = '';
        if ($id == 0) {
            $cp = array();
            $dd1 = get("dd1");
            $dd2 = get("dd2");
            $dd4 = get("dd4");
            
            array_push($cp,array('$H8','','',false,false));
            array_push($cp,array('$S10','','N. acervo',true,true));
            array_push($cp,array('$T80:10','','Marc21',true,true));
            array_push($cp,array('$B8','','Importar>>',false,true));
            

            if (round($dd1) > 0)            
                {
                    $sql = "select * from metadados_emater where cod_acervo = $dd1";                    
                    $rlt = $this->db->query($sql);
                    $rlt = $rlt->result_array();                    
                    array_push($cp,array('$O 1:SIM&0:NÃO','','Já existe esse acervo, excluir anterior?',true,true));        
                }
            $form = new form;
            $sx = $form->editar($cp,'');
            

            if ((strlen($dd2) > 0) and ($form->saved > 0))
                {
                    if ($dd4 == '1')
                        {
                            $sql = "delete from metadados_emater where cod_acervo = $dd1";
                            $rlt = $this->db->query($sql);
                        }
                    $sx = $this->marc21->marc_form_import_tab($dd1,$dd2);
                    $sx .= '<a href="'.base_url('index.php/handle/marc_import').'" class="btn btn-primary">voltar</a>';
                }
        }
        return ($sx);
    }
    
    function marc_form_import_tab($id,$t)
        {
            $id = round($id);
            if ($id==0)
                {
                    return('Erro de Id');
                }
            $t = troca($t,';','.,');
            $t = troca($t,chr(9),'¢|');
            $t = troca($t,chr(13),';');
            $t = troca($t,chr(10),';');
            $ln = splitx(';',$t);
            $sx = '<pre>';
            for ($r=0;$r < count($ln);$r++)
                {
                    
                    $l = troca($ln[$r],'¢|',';¢');
                    $l = troca($l,'(','');
                    $l = troca($l,')','');
                    $l = splitx(';',$l);
                    if (count($l) >= 2)
                        {
                              $this->marc_form_import_tab_save($id,$l[0],$l[1],$l[2],$l[3]);
                              $ll = strzero(round($l[0]),3);
                              $ll .= ' '.troca($l[1],'¢','#').troca($l[2],'¢','#');
                              $ll .= ' '.troca(substr($l[3],2,strlen($l[3])),'¢','');
                              $ll = troca($ll,'¢','');
                              $sx .= troca($ll,'|','').cr();                                      
                        }
                     
                }
            $sx .= '</pre>';
            return($sx);
        }
    
    function marc_form_import_tab_save($id,$field,$tag1,$tag2,$value)
        {
            $id = round($id);
            if ($id == 0)
                {
                    return('Erro de ID');
                }
            $field = troca($field,'¢','');
            $tag1 = troca($tag1,'¢','');
            $tag2 = troca($tag2,'¢','');
            $value = troca($value,'¢','');
            $sql = "select * from metadados_emater where
                        cod_acervo = $id and
                        paragrafo = '$field' AND
                        indi1 = '$tag1' AND
                        indi2 = '$tag2' AND
                        var2 = '$value'
                        ";
            $rlt = $this->db->query($sql);
            $rlt = $rlt->result_array();
            if (count($rlt) > 0)
                {
                    return('Already');
                }
            $sql = "insert into metadados_emater
                        (cod_acervo, paragrafo, indi1, indi2, var2)
                        values
                        ($id,'$field','$tag1','$tag2','$value')";  
            $rlt = $this->db->query($sql);   
            return("Saved");                     
        }
    function editor($id = 0, $fd = 0, $xtag = 0, $act='') {
        if (strlen($act) > 0)
            {
                if ($act != 'ind')
                {
                    $this->marc21_action($id,$fd,$xtag,$act);
                    $act = '';
                    $xtag = 0;
                }
            }
        $sx = '';
        $sx .= '<form method="post" action="' . base_url("index.php/marc/main/" . $id . '/' . $fd . '/' . $xtag) . '">';
        if ($id == 0) {
            $sx .= $this -> marc21_type_select();
        } else {
            $sx .= $this -> marc21_show($id);
            if ($fd == 0) {
                $sx .= $this -> marc21_records($id);
            } else {
                $tag = strzero(sonumero(get("tag")), 3);
                $ind1 = get("ind1");
                $ind2 = get("ind2");
                $sx .= $this -> form_tag($id, $fd, $xtag);        
                
                if ($tag != '000') {
                    $idr = $this -> save_tag($id, $fd, $tag, $ind1, $ind2);
                }
            }
            /************ SHOW RECORDS *********************************/
            $sx .= $this -> marc21_show_tags($id, $fd, $xtag);
            $sx .= '</form>';
        }
        return ($sx);
    }

    function remove_tag($id)
        {
            $sql = "update marc21_tag set t_status = 0 where id_t = $id";
            echo $sql;
            $this->db->query($sql);
            return('');
        }
        
    function remove_filed($id)
        {
            $sql = "update marc21_code set c_status = 0 where id_c = $id";
            echo $sql;
            $this->db->query($sql);
            return('');           
        }

    function marc21_action($id,$fd,$xtag,$act)
        {
           switch ($act)
            {
               case 'del':
                   $this->remove_tag($xtag);
                   break;
               case 'delr':
                   $this->remove_filed($xtag);
                   break;
            } 
            return('');
        }
    

    function user() {
        $user = 1;
        return ($user);
    }
    
    function row_acervo($form)
        {
        $form -> fd = array('id_c','cod_acervo','paragrafo','indi1','indi2','var2');
        $form -> lb = array('id', msg('acervo'), msg('field'), msg('ind1'), msg('ind2'), msg('content'));
        $form -> mk = array('', 'C', 'C', 'C','C','L','C');
        return($form);            
        }

    function marc21_show_tags($id, $fd, $atag) {
        $field = get("field");
        $data = get("data");
        if ((strlen($field) > 0) and (strlen($data) > 0)) {
            $this -> save_field($id, $fd, $atag, $field, $data);
        }

        $sql = "select * from marc21_tag 
                        LEFT JOIN marc21_code ON id_t = c_tag and c_status = 1
                        where t_registro = $fd and t_status = 1
                        order by t_tag";

        $rlt = $this -> db -> query($sql);
        $rlt = $rlt -> result_array();
        $sx = '<table class="table">';
        $sx .= '<tr>';
        $sx .= '<th align="center" width="3%">TAG</th>';
        $sx .= '<th align="center" width="3%">Ind.</th>';
        $sx .= '<th align="center" width="3%">#</th>';
        $sx .= '<th align="center" width="85%">Data</th>';
        $sx .= '<th align="center" width="3%"></th>';
        $sx .= '<th align="center" width="3%"></th>';
        $sx .= '<th align="center" width="3%"></th>';
        $sx .= '</tr>';

        $xtag = '';
        $xind1 = '';
        $xind2 = '';
        $new = 0;
        $form = 0;
        for ($r = 0; $r < count($rlt); $r++) {
            $line = $rlt[$r];

            $tag = $line['t_tag'];
            $ind1 = $line['t_ind1'];
            $ind2 = $line['t_ind2'];
            $sx .= '<tr>';
            if (($tag != $xtag) or ($ind1 != $xind1) or ($ind2 != $xind2)) {
                $sx .= '<td>';
                $sx .= $line['t_tag'];
                $sx .= '</td>';
                $sx .= '<td>';
                $link = '<a href="'.base_url('index.php/marc/main/'.$id.'/'.$fd.'/'.$line['id_t'].'/ind').'">';
                $sx .= $link;
                $sx .= $line['t_ind1'];
                $sx .= $line['t_ind2'];
                $sx .= '</a>';
                $sx .= '</td>';
                $xtag = $tag;
                $xind1 = $ind1;
                $xind2 = $ind2;
                $new = 1;
            } else {
                //if (strlen($line['c_code']) == 0)
                    {
                        $sx .= '<td colspan="2">&nbsp;</td>';
                    }
            }
            if (($atag == $line['id_t']) and ($form == 0)) {
                $sx .= $this -> form_field($id, $fd, $atag);
                $form = 1;
                $sx .= '<td colspan=2></td>';
                $sx .= '</tr>';
                $sx .= '<tr><td colspan=3>&nbsp;</td>';
            } else {
                if (($new == 1) )
                    {
                        $link = '<a href="' . base_url('index.php/marc/main/' . $id . '/' . $fd . '/' . $line['id_t']) . '">';
                        $sx .= '<td>' . $link . '[+]' . '</a>';
                        $new = 0;
                    } else {
                        $sx .= '<td>&nbsp;</td>';
                    }
            }
            if (strlen($line['c_code']) == 0) {
                $sx .= '<td colspan=3>&nbsp;</td>';
            } else {
                $sx .= '<td colspan=3>' . '$'.$line['c_code'] .' ' . $line['c_text'] . '</td>';
            }

            /******************** links para exclusão de registros ********************************/            
            if ($line['id_c'] > 0)
                {
                    $link = '<a href="' . base_url('index.php/marc/main/' . $id . '/' . $fd . '/' . $line['id_c'].'/delr') . '" style="color:red;" onclick="return confirm(\'Excluir registro $'.$line['c_code'].' '.$line['c_text'].'?\');">';                    
                } else {
                    $link = '<a href="' . base_url('index.php/marc/main/' . $id . '/' . $fd . '/' . $line['id_t'].'/del') . '" style="color:red;" onclick="return confirm(\'Excluir registro '.$line['t_tag'].'?\');">';        
                }

                        
            $sx .= '<td>'.$link.'[del]</a></td>';
            $sx .= '</tr>'.cr();
        }
        $sx .= '</table>';
        return ($sx);
    }

    function save_field($id, $fd, $atag, $field, $data) {
        $sql = "insert into marc21_code
                        (c_tag, c_code, c_text, c_status)
                        values
                        ($atag,'$field','$data',1)";
        $this -> db -> query($sql);
    }

    function save_tag($id, $fd, $tag, $ind1, $ind2) {
        $user = $this -> user();
        $sql = "select * from marc21_tag
                        where 
                            t_tag = '$tag'
                            AND t_ind1 = '$ind1'
                            AND t_ind2 = '$ind2'
                            AND t_registro = $fd";
        $rlt = $this -> db -> query($sql);
        $rlt = $rlt -> result_array();
        if (count($rlt) > 0) {

        } else {
            $sqli = "insert into marc21_tag
                            (t_tag, t_ind1, t_ind2, t_registro, t_status, t_user)
                            values
                            ('$tag','$ind1','$ind2','$fd',1,$user)";
            $rlt = $this -> db -> query($sqli);
            $rlt = $this -> db -> query($sql);
            $rlt = $rlt -> result_array();
        }
        $line = $rlt[0];
        return ($line['id_t']);
    }

    function marc21_show($id) {
        $data = $this -> le($id);
        $sx = '<h1>' . $data['mc_tipo'] . '</h1>' . cr();
        return ($sx);
    }

    function marc21_records($id) {
        $sx = '';
        $user = 1;
        $wh = 'AND m_user = ' . $user;
        $sql = "select * from marc21_registro
                        left join users on m_user = id_us 
                        where m_type = $id
                        $wh 
                        order by m_created desc";
        $rlt = $this -> db -> query($sql);
        $rlt = $rlt -> result_array();
        $sx .= '<table class="table" width="100%">';
        $sx .= '<tr><th width="2%">#</th>
                        <th width="28%">Titúlo</th>
                        <th width="30%">Autor(es)</th>
                        <th width="10%">Dt. Criação</th>
                        <th width="20%">User</th>
                    </tr>' . cr();
        for ($r = 0; $r < count($rlt); $r++) {
            $line = $rlt[$r];
            $link = '<a href="' . base_url('index.php/marc/main/' . $id . '/' . $line['id_m']) . '">';
            $linka = '</a>';
            $sx .= '<tr>';
            $sx .= '<td>' . $link . $line['id_m'] . $linka . '</td>';
            $sx .= '<td>';
            $sx .= $link . $line['m_title'] . $linka;
            $sx .= '</td>';
            $sx .= '<td>';
            $sx .= $link . $line['m_author'] . $linka;
            $sx .= '</td>';
            $sx .= '<td>';
            $sx .= $link . stodbr($line['m_created']) . $linka;
            $sx .= '</td>';
            $sx .= '<td>';
            $sx .= $link . trim($line['us_nome']) . $linka;
            $sx .= '</td>';
            $sx .= '</tr>';
        }
        return ($sx);
    }

    function le($id) {
        $sql = "select * from marc21 where id_mc = " . round($id);
        $rlt = $this -> db -> query($sql);
        $rlt = $rlt -> result_array();
        if (count($rlt) > 0) {
            return ($rlt[0]);
        } else {
            return ( array());
        }
    }

    function marc21_type_select() {
        $sql = "select * from marc21";
        $rlt = $this -> db -> query($sql);
        $rlt = $rlt -> result_array();

        $sx = '<h1>Tipo de registro</h1>' . cr();
        $sx .= '<ul>';
        for ($r = 0; $r < count($rlt); $r++) {
            $line = $rlt[$r];
            $link = '<a href="' . base_url('index.php/marc/main/' . $line['id_mc']) . '">';
            $sx .= '<li>' . $link . $line['mc_tipo'] . '</a></li>';
        }
        $sx .= '</ul>';
        return ($sx);
    }

    function ajuda($tipo, $field = '') {

        $sx = 'https://www.loc.gov/marc/bibliographic/bd100.html';
        return ($sx);
    }

    function form_field($id, $fd, $xtag) {
        $submit = '<input type="submit" value=">>" name="acao">';
        $sx = '';
        $fic = '<option value=""></option>' . cr();
        for ($r = 0; $r < 26; $r++) {
            $fic .= '<option value="' . chr(97 + $r) . '">' . chr(97 + $r) . '</option>' . cr();
        }
        $sx .= '<td>';
        $sx .= '<select name="field" size=1>' . $fic . '</select>' . cr();
        $sx .= '</td>';
        $sx .= '<td>';
        $sx .= '<textarea name="data" class="form_control" style="width:100%; height: 60px;"></textarea>';
        $sx .= '</td>' . cr();

        $sx .= '<td>';
        $sx .= $submit;
        $sx .= '</td>' . cr();
        return ($sx);
    }

    function form_tag($id, $fd, $atag) {
        $submit = '<input type="submit" value="novo >>" name="acao">';
        $fid = '<option value="_">#</option>' . cr();
        for ($r = 0; $r < 10; $r++) {
            $fid .= '<option value="' . $r . '">' . $r . '</option>' . cr();
        }
        $sx = '';
        $sx .= '<table class="table" style="border: 1px solid #000000;">';
        $sx .= '<tr>';
        $sx .= '<th align="center" width="3%">TAG</th>';
        $sx .= '<th align="center" width="3%">Ind1</th>';
        $sx .= '<th align="center" width="3%">Ind2</th>';
        $sx .= '<th align="center" width="3%">Code</th>';
        $sx .= '<th align="center" width="88%">Data</th>';
        $sx .= '</tr>';

        $sx .= '<tr>';
        $sx .= '<td>';
        $sx .= '<input type="text" size="3" name="tag">';
        $sx .= '</td>';

        $sx .= '<td>';
        $sx .= '<select name="ind1">' . $fid . '</select>';
        $sx .= '</td>';

        $sx .= '<td>';
        $sx .= '<select name="ind2">' . $fid . '</select>';
        $sx .= '</td>';

        if (1 == 2) {
            $sx .= '<td>';
            $sx .= '<select name="subf">' . $fic . '</select>';
            $sx .= '</td>';

            $sx .= '<td>';
            $sx .= '<input type="text" size="999" name="tag" style="width: 100%;">';
            $sx .= '</td>';
        } else {
            $sx .= '<td colspan=2>';
            $sx .= $submit;
            $sx .= '</td>';
        }

        $sx .= '</tr>';
        $sx .= '</table>';
        return ($sx);
    }

}
?>
