<?php
class dataverses extends CI_model {
    function import() {
        $form = new form;
        $cp = array();
        array_push($cp, array('$H8', '', '', false, false));
        array_push($cp, array('$S109', '', 'Arquivo', True, True));
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
            redirect(base_url('index.php/dataverse/import'));

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

    function download() {
        /***************************** ZIP FILE ************/
        $zip = new ZipArchive();
        $filename = "_documment/pt_BR.zip";
        if (file_exists($filename)) {
            unlink($filename);
        }
        if ($zip -> open($filename, ZIPARCHIVE::CREATE) !== TRUE) {
            exit("cannot open <$filename>\n");
        }

        /*************************** BUILD FILE *************/
        $sql = "select t_arquivo, count(*) as total from redd.dataverse group by t_arquivo order by t_arquivo";
        $rlt = $this -> db -> query($sql);
        $rlt = $rlt -> result_array();
        for ($r = 0; $r < count($rlt); $r++) {
            $fl = $rlt[$r]['t_arquivo'];
            $sql = "select * from redd.dataverse where t_arquivo = '$fl' 
                            order by t_label ";
            $rrr = $this -> db -> query($sql);
            $rrr = $rrr -> result_array();
            $sx = '';
            for ($y = 0; $y < count($rrr); $y++) {
                $line = $rrr[$y];
                //$s = utf8_decode(trim($line['t_pt']));
                $s = (trim($line['t_pt']));
                $s = troca($s,'</ ','</');
                $sx .= trim($line['t_label']) . '=' . $s . cr();
            }

            check_dir('_documment');
            check_dir('_documment/dataverse/');
            $dir = '_documment/dataverse/' . $fl;
            $fld = fopen($dir, 'w+');
            fwrite($fld, $sx);
            fclose($fld);

            /**************** ADD TO ZIP **********************/
            $zip -> addFile($dir, $fl);
        }

        /************** ZIP STATUS ***************/
        echo "numfiles: " . $zip -> numFiles . "\n";
        echo "status:" . $zip -> status . "\n";
        $zip -> close();
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
                $tela .= $id . ' ' . $vlr . ' <b>Update</b><br>';
                $sql = "update redd.dataverse set t_pt = '$vlr' where t_lock = 0 and id_t = " . $id;
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
