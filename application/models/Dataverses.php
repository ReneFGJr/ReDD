<?php
class dataverses extends CI_model {

    function row($id = '') {
        $form = new form;

        $form -> fd = array('id_t', 't_label', 't_pt', 't_us','t_arquivo');
        $form -> lb = array('id', msg('t_label'),msg('t_pt'), msg('t_us'), msg('t_arquivo'));
        $form -> mk = array('', 'L', 'L', 'L');

        $form -> tabela = 'redd.dataverse';
        $form -> see = true;
        $form -> novo = true;
        $form -> edit = true;

        $form -> row_edit = base_url(PATH.'edit');
        $form -> row_view = base_url(PATH.'row');
        $form -> row = base_url(PATH.'row');

        $sx = '<div class="col-md-12">'.row($form, $id).'</div>';
        return ($sx);
    }

    function edit($id,$chk)
        {
            $form = new form;
            $form->id = $id;
            $cp = array();
            array_push($cp,array('$H8','id_t','',false,false));
            array_push($cp,array('$T80:6','t_us','EN',false,false));
            array_push($cp,array('$T80:6','t_pt','PT',TRUE,TRUE));
            array_push($cp,array('$B8','','Save',false,false));
            $tela = $form->editar($cp,'dataverse');
            if ($form->saved > 0)
                {
                    redirect(base_url(PATH.row));
                }
            return($tela);
        }

    function download2($file='',$tp='')   
    {
        $cr = chr(13);
        /*********** Biblioteca de traduções */
        $sql = "select * from dataverse 
                    where t_arquivo = '$file' 
                        and t_label <> ''
                        and substring(t_label,1,1) <> '#' 
                    ";
        $rlt = $this->db->query($sql);
        $rlt = $rlt->result_array();
        $lang = array();
        for ($r=0;$r < count($rlt);$r++)
        {
            $line = $rlt[$r];
            $lang[$line['t_label']] = $line['t_pt'];
        }

        /****************************************** Processamento **************/
        $sx = '';
        $flr = '_documment/dataverse/MRF/'.$file;
        if (file_exists($flr))
        {
          $fn = fopen($flr,"r");
          while(! feof($fn))  {
            $l = fgets($fn);
            if (substr($l,0,1) == '#')
                {
                    $sx .= $l.$cr;
                } else {
                    # Linha comentada
                    $cp = substr($l,0,strpos($l,"="));
                    if (strlen($cp) > 0)
                        {
                            if (isset($lang[$cp]))
                            {
                                $sx .= $cp.'='.$lang[$cp].$cr;
                            } else {
                                //echo "<br>Erro <b><i>".$cp.'</i></b>';
                                $sx .= $l.$cr;
                            }
                        } else {
                            $sx .= $l.$cr;
                        }
                }
        }
        fclose($fn);        
    } else {
        echo 'File not Found';
        exit;
    }
    $file = troca($file,'.properties','_pt.properties');
    header("Content-Type: text/plain"); 
    header("Content-Disposition: attachment; filename=\"".$file."\"");
    echo mb_convert_encoding($sx,'Windows-1252','UTF-8');
    exit;
}

function validate()
    {
        $sx = '';
        $sql = "select * from dataverse where 
                    (t_pt like '%.,%') or (t_pt like '%0 #%')";
        $rlt = $this->db->query($sql);
        $rlt = $rlt->result_array();
        $sx .= '<pre>';
        for ($r=0;$r < count($rlt);$r++)
            {
                $line = $rlt[$r];
                $id = $line['id_t'];
                $l = $line['t_pt'];
                $l = troca($l,'.,',';');

                /*****/
                if (strpos($l,'0 #'))
                    {
                        $l = $line['t_us'];
                    }

                $sx .= $l;
                $sx .= '<hr>';
                $sql = "update dataverse set t_pt = '$l' where id_t = $id";
                $rrr = $this->db->query($sql);
            }
        $sx .= '</pre>';
        $sx .= '<h2>Fim do processo #1</h2>';

        $sql = "select * from dataverse where 
                    (t_pt = '') and (t_us <> '')
                    order by t_arquivo";
        $rlt = $this->db->query($sql);
        $rlt = $rlt->result_array();
        $sx .= '<pre>';
        $fx = '';
        for ($r=0;$r < count($rlt);$r++)
            {
                $line = $rlt[$r];
                $ff = $line['t_arquivo'];
                if ($ff != $fx)
                    {
                        $sx .= '<h2>'.$ff.'</h2>';
                        $fx = $ff;
                    }
                $id = $line['id_t'];
                $l = $line['t_us'];
                $lb = $line['t_label'];
                $sx .= $lb.'='.$l.'<br>';
            }
        $sx .= '</pre>';
        $sx .= '<h2>Fim do process #3</h2>';        
        return($sx);            
    }

function import() {
    $form = new form;
    $cp = array();
    array_push($cp, array('$H8', '', '', false, false));
    $op = 'Bundle.properties:Bundle.properties';
    array_push($cp, array('$O '.$op, '', 'Arquivo', True, True));
    array_push($cp, array('$T80:25', '', 'Conteúdo', True, True));
    array_push($cp, array('$B8', '', 'Importar >>>', False, True));

    $tela = $form -> editar($cp, '');

    if ($form -> saved > 0) {
        $ln = troca(get("dd2"), ';', '.,');
        $ln = troca($ln, chr(13), ';');
        $ln = troca($ln, chr(10), '');
        $ln = splitx(';', $ln);
        $file = get("dd1");
        $tela .= '<h3>' . $file . '</h3>';
        for ($r = 0; $r < count($ln); $r++) {
            $tela .= $this -> dataverse($ln[$r], $file);
        }
            //redirect(base_url('index.php/dataverse/inport'));

    }
    return ($tela);
}

function translate($arg1, $arg2) {
    $sx = '';
    switch($arg1) {
        case 'id' :
        $sx .= $this -> file_to_translate($arg2);
        $sx .= $this -> file_in_translate($arg2);
        break;
        default :
        $sx .= $this -> list_files(base_url('index.php/dataverse/translate_google/'));
        break;
    }
    return ($sx);
}

function checked()
{
    $sql = "select * from redd.dataverse";
    $rlt = $this->db->query($sql);
    $rlt = $rlt->result_array();
    echo '<pre>';
    for ($r=0;$r < count($rlt);$r++)
    {
        $line = $rlt[$r];
        $L = $line['t_pt'];
        echo '<br>'.$line['t_arquivo'].' - '.$line['t_label'] . '</b><br>';

        echo $line['t_us'] . '<br>';
        echo $line['t_pt'] . '<br>';

        if (strpos($L,'% ') > 0)
        {
            $L = troca($L,'% ',' %');
            $sql = "update redd.dataverse set t_pt = '".$L."' where id_t = ".$line['id_t'];
            $rrr = $this->db->query($sql);
        }
        if (strpos($L,'} /') > 0)
        {
            $L = troca($L,'} /','}/');
            $sql = "update redd.dataverse set t_pt = '".$L."' where id_t = ".$line['id_t'];
            $rrr = $this->db->query($sql);
        }                        
        echo '<hr>';

    }
    echo '</pre>';
}

function download($file = 'Bundle.properties',$lang = 'pt') {
    /***************************** ZIP FILE ************/
    $sql = "select * from redd.dataverse 
    where t_arquivo = '$file' 
    order by id_t, t_label ";
    $rrr = $this -> db -> query($sql);
    $rrr = $rrr -> result_array();
    $sx = '';
    for ($y = 0; $y < count($rrr); $y++) {
        $line = $rrr[$y];
                //$s = utf8_decode(trim($line['t_pt']));
        $s = (trim($line['t_pt']));
        $s = troca($s,'</ ','</');
            //$s = troca($s,'"','&#34;');
        $s = troca($s,'., ','');
        $s = troca($s,';,.',';');
        $s = troca($s,',.',';');
        $s = troca($s,'/ ','');
        $s = troca($s,' # ','#');
        $s = troca($s,'´',"'");
        $s = troca($s,'´',"'");
        $s = troca($s,chr(13),chr(92).'n');
        $s = troca($s,chr(10),'');
            //if (!strpos($s,'{'))
        {
                //$s = utf8_decode($s);
            $lb = trim($line['t_label']);
            $c = '=';
            if (strlen($lb) == 0) { $c = ''; }
            $sx .= trim(trim($lb) . $c . $s) . chr(13);
        }
    }
    $file = troca($file,'.properties','_'.$lang.'.properties');
    header("Content-Type: text/plain"); 
    header("Content-Disposition: attachment; filename=\"".$file."\"");
    echo mb_convert_encoding($sx,'Windows-1252','UTF-8');
    exit;
}

function writeUTF8File($filename,$content) { 
    $f=fopen($filename,"w"); 
        # Now UTF-8 - Add byte order mark 
    fwrite($f, pack("CCC",0xef,0xbb,0xbf)); 
    fwrite($f,$content); 
    fclose($f); 
}    

function file_in_translate($file) {
    $form = new form;
    $cp = array();
    array_push($cp, array('$H8', '', '', false, false));
    array_push($cp, array('$HV', '', $file, False, True));
    array_push($cp, array('$A2', '', 'Conteúdo traduzido', False, True));
    array_push($cp, array('$T80:10', '', '', True, True));
    array_push($cp, array('$B8', '', 'Importar >>>', False, True));
    $tela = $form -> editar($cp, '');

    if ($form -> saved > 0) {
        $ln = get("dd3");
        $ln = troca($ln, chr(13), ';');
        $ln = troca($ln, chr(10), '');
        $ln = splitx(';', $ln);
        for ($r = 0; $r < count($ln); $r++) {
            $id = sonumero(substr($ln[$r], 0, strpos($ln[$r], ']')));
            if ($id > 0) {
                $vlr = trim(substr($ln[$r], strpos($ln[$r], ']') + 1, strlen($ln[$r])));
                $vlr = troca($vlr, ' .,. ', chr(10));
            }
            $vlr = troca($vlr,'¢','\\');
            $vlr = troca($vlr,'.,',';');
            $tela .= $id . ' ' . $vlr . ' <b>Update</b><br>';
            $sql = "update redd.dataverse set t_pt = '$vlr' where t_lock = 0 and id_t = " . $id;
            echo '<br>'.$sql;
            $rlt = $this -> db -> query($sql);
        }
    }

    return ($tela);
}

function file_to_translate($file) {
    $sx = '<textarea rows=10 class="form-control form_textarea ">';
    $sql = "select * from redd.dataverse 
    where t_arquivo = '$file'
    and t_pt = ''";
    $rlt = $this -> db -> query($sql);
    $rlt = $rlt -> result_array();
    for ($r = 0; $r < count($rlt); $r++) {
        $line = $rlt[$r];
        $vlr = $line['t_us'];
        $vlr = troca($vlr, chr(10), ' .,. ');
        $vlr = troca($vlr, chr(13), '');
        $sx .= '[' . $line['id_t'] . '] ' . $vlr . cr();
    }
    $sx .= '</textarea>';
    return ($sx);
}

function list_files($url) {
    $sql = "select t_arquivo, count(*) as total from redd.dataverse group by t_arquivo order by t_arquivo";
    $rlt = $this -> db -> query($sql);
    $rlt = $rlt -> result_array();
    $sx = '<h3>' . msg('file_list') . '</h3>';
    for ($r = 0; $r < count($rlt); $r++) {
        $line = $rlt[$r];
        $link = '<a href="' . $url . 'id/' . $line['t_arquivo'] . '">';
        $linka = '</a>';
        $sx .= '<li>' . $link . $line['t_arquivo'] . $linka . '</li>';
    }
    return ($sx);
}

function dataverse($lb, $file) {
    $l1 = substr($lb, 0, strpos($lb, '='));
    $l2 = substr($lb, strpos($lb, '=') + 1, strlen($lb));
    $sql = "select * from redd.dataverse 
    where t_arquivo = '$file'
    AND t_label = '$l1' ";
    $rlt = $this -> db -> query($sql);
    $rlt = $rlt -> result_array();
    $sx = $l1;
    if (count($rlt) > 0) {
        $sx .= $l1 . ' <span style="color: grey;"><b>Pass</b></span>';
    } else {
        $sql = "insert into redd.dataverse
        (t_arquivo, t_label, t_us, t_pt)
        values
        ('$file','$l1','$l2','')";
        $rlt = $this -> db -> query($sql);
        $sx .= $l1 . ' <span style="color: green;"><b>Atualizado</b></span>';
    }
    return ($sx . '<br>');

}

}
?>
