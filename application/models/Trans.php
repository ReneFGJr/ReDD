<?php
class Trans extends CI_model {
    var $table = 'redd.dataverse';
    var $dir = '_dataverse';
    var $type = 'dataverse';
    function main($act,$d1,$d2,$d3)
    {
        switch($act)
        {
            default:
            $sx = $this->menu();
        }
        return($sx);
    }
    
    function menu()
    {
        $sx = '<ul>';
        $sx .= '<br/><h3>'.msg('File Import').'</h3>';
        $sx .= '<li><a href="'.base_url(PATH.'import').'">'.msg('import_file').'</a></li>';
        
        $sx .= '<br/><h3>'.msg('Translate').'</h3>';
        $sx .= '<li><a href="'.base_url(PATH.'translate').'">'.msg('translate').'</a></li>';        
        $sx .= '<li><a href="'.base_url(PATH.'check_translate').'">'.msg('check_translate').'</a></li>';        
        $sx .= '<li><a href="'.base_url(PATH.'mass_translate').'">'.msg('mass_translate').'</a></li>';
        
        $sx .= '<br/><h3>'.msg('File Export').'</h3>';
        $sx .= '<li><a href="'.base_url(PATH.'export').'">'.msg('export_file').'</a></li>';
        
        $sx .= '</ul>';
        return($sx);
    }
    
    function exports($dr='',$file='')
    {
        $sx = '<h1>'.msg('export_file').'</h1>';
        $dir = $this->dir;
        if (strlen($dr) > 0)
        {
            $dir .= '/'.$dr;
        }
        $d = scandir($dir);
        
        $sx .=  "Path: " . $dir . "<br/>";
        for ($r=0;$r < count($d);$r++) {
            $entry = trim($d[$r]);
            if (($entry != '.') and ($entry != '..') and (is_dir($dir.'/'.$entry)))
            {
                $entry = trim($entry);
                $fch = $dir.'/'.$entry."/.htaccess";
                echo $fch.'<br>';
                
                if (file_exists($fch))
                {                    
                    if (($entry <> '.') and ($entry <> '..'))
                    {
                        $link = '<a href="'.base_url(PATH.'export/'.$entry).'">';
                        $linka = '</a>';
                        $sx .= '<li>';
                        $sx .= $link.$entry.$linka;
                        $sx .= '</li>';
                    }
                }
            }
            
            $fch = $dir.'/'.$entry;
            if (file_exists($fch))
            {                    
                if (strpos($entry,'.prop') > 0)
                {
                    $link = '<a href="'.base_url(PATH.'export/'.$dr.'/'.$entry).'">';
                    $linka = '</a>';
                    $sx .= '<li>';
                    $sx .= $link.$entry.$linka;
                    $sx .= '</li>';
                }
            }            
        }        
        $sx .= '</pre>';

        $sx .= '<a href="'.base_url(PATH.'exportall/'.$dr).'" class="btn btn-outline-primary">'.msg('export_all_files').'</a>';

        return($sx);
    }
    
    function translates()
    {
        $form = new form;
        $form->table = $this->table;
        
        $sx = row($form);
    }
    
    function mass_trans_file($d1,$d2,$d3)
    {
        $sql = "select *
        from ".$this->table."
        where dvn_pt = '' and dvn_file = '$d1' and dvn_en <> ''
        order by dvn_file";
        $rlt = $this->db->query($sql);
        $rlt = $rlt->result_array(); 
        $t = '';
        for ($r=0;$r < count($rlt);$r++)
        {
            $line = $rlt[$r];
            $term = trim($line['dvn_en']);
            if ($term != '')
            {
                $t .= '=('.$line['id_dvn'].') ';
                $t .= $term;
                $t .= chr(13);
            }
        }
        $sx = '';
        $sx .= '<h3>'.$d1.'</h3>';
        $sx .= '<form method="post">';
        $sx .= '<textarea name="dd1" rows=10 style="width: 100%;" disabled>'.$t.'</textarea>';
        
        $trans = get("dd2");
        if (strlen($trans) > 0)
        {
            $trans = troca($trans,'= (','=(');
            $ln = splitx(chr(13),$trans.chr(13).'=(0) '.chr(13));
            $tot = 0;
            for ($r=0;$r < count($ln);$r++)
            {
                $l = $ln[$r];
                if (substr($l,0,2) == '=(')
                {
                    $id = sonumero(substr($l,0,strpos($l,') ')));
                    $txt = substr($l,strpos($l,')')+1,strlen($l));
                    $txt = trim($txt);
                    $txt = troca($txt,"'","´");
                    $sql = "update ".$this->table." set dvn_pt = '".$txt."'
                    where id_dvn = $id ";                                
                    $this->db->query($sql);
                    $tot++;
                }
            }
            $sx .= message(msg('updated_translates - '.$tot.' '.msg('register(s)'),1));
        } else {
            $sx .= '<h3>'.msg('Translate').'</h3>';
            $sx .= '<p>'.msg('insert_the_translate').'</p>';
            $sx .= '<textarea name="dd2" rows=10 style="width: 100%;">'.get("dd2").'</textarea>';               
            $sx .= '<input type="submit" value="'.msg('submit_translate').'" class="btn btn-outline-primary">';
            $sx .= ' ';
        }
        $sx .= '<a href="'.base_url(PATH.'mass_translate').'" class="btn btn-outline-primary">'.msg('return').'</a>';
        $sx .= '</form>';        
        return($sx);
    }
    
    function mass_trans($d1,$d2,$d3)
    {
        $sql = "select count(*) as total, dvn_file
        from ".$this->table." 
        where dvn_pt = '' and trim(dvn_en) <> ''
        group by dvn_file
        order by dvn_file";
        $rlt = $this->db->query($sql);
        $rlt = $rlt->result_array();
        $xfl = '';
        $sx = '<h3>'.msg('mass_translate').'</h3>';
        $sx .= '<ul>';
        for ($r=0;$r < count($rlt);$r++)
        {
            $line = $rlt[$r];
            $link = '<a href="'.base_url(PATH.'mass_translate/'.$line['dvn_file'].'/'.checkpost_link($line['dvn_file'])).'" target="_editar">';
            $linka = '</a>';
            
            $sx .= '<li>';
            $sx .= $link.$line['dvn_file'].$linka;
            $sx .= ' ('.$line['total'].' '.msg('to_translate').')';
            $sx .= '</li>';
        }
        $sx .= '</ul>';
        if (count($rlt) == 0)
        {
            $sx .= message(msg('nothing message to translate'),5);
        }
        return($sx);   
    }
    
    function check_trans()
    {
        $sql = "select * from ".$this->table."
        where dvn_pt = '' 
        order by dvn_file, dvn_file";
        $rlt = $this->db->query($sql);
        $rlt = $rlt->result_array();
        $xfl = '';
        $sx = '<h3>'.msg('check_translate').'</h3>';
        $sx .= '<ul>';
        for ($r=0;$r < count($rlt);$r++)
        {
            $line = $rlt[$r];
            if ($xfl != $line['dvn_file'])
            {
                $xfl = $line['dvn_file'];
                $sx .= '<h3>'.$xfl.'</h3>';
            }
            $link = '<a href="'.base_url(PATH.'edit/'.$line['id_dvn'].'/'.checkpost_link($line['id_dvn'])).'" target="_editar">';
            $linka = '</a>';
            
            $sx .= '<li>';
            $sx .= $link.$line['dvn_field'].$linka;
            $sx .= '<span style="color:#bbb">';
            $sx .= ' ('.$line['dvn_en'].')';
            $sx .= '</span>';
            $sx .= '</li>';
        }
        $sx .= '</ul>';
        if (count($rlt) == 0)
        {
            $sx .= message(msg('nothing message with problens'),5);
        }        
        return($sx);
    }
    
    function le($id)
    {
        $sql = "select * from ".$this->table."
        where id_dvn = ".$id;
        $rlt = $this->db->query($sql);
        $rlt = $rlt->result_array();
        $rlt = $rlt[0];
        return($rlt);
    }
    
    function view($id='')
    {
        $d = $this->le($id);
        $sx = '';
        
        $sx .= '<div class="col-12"><h1><b>'.$d['dvn_field'].'</b></h1></div>';
        $sx .= '<div class="col-12"><h4>file:'.$d['dvn_file'].'</h4></div>';
        $sx .= '<div class="col-12"><h4>Inglês</h4><textarea style="width: 100%; height: 150px;" readonly>'.$d['dvn_en'].'</textarea></div>';
        $sx .= '<div class="col-12"><h4>Português</h4><textarea style="width: 100%; height: 150px;" readonly>'.$d['dvn_pt'].'</textarea></div>';
        $sx .= '<a href="'.base_url(PATH.'edit/'.$id).'" class="btn btn-outline-secundary">'.msg('edit').'</a>';
        return($sx);
    }
    
    function row2($id = '') {
        $form = new form;
        
        $form -> fd = array('id_dvn', 'dvn_field', 'dvn_en', 'dvn_pt');
        $form -> lb = array('id', msg('dvn_field'), msg('dvn_en'),msg('dvn_pt'));
        $form -> mk = array('', 'L', 'L', 'L');
        $form -> sz = array(0,20,40,40);
        
        $form -> tabela = $this->table;
        $form -> see = true;
        $form -> novo = true;
        $form -> edit = true;
        
        $form -> row_edit = base_url(PATH.'edit');
        $form -> row_view = base_url(PATH.'view');
        $form -> row = base_url(PATH.'translate');
        
        $sx = '</div>';
        $sx .= '<div class="container-fluid">';
        $sx .= '<div class="row">';
        $sx .= '<div class="col-md-12">'.row($form, $id).'</div>';
        return ($sx);
    }
    
    function edit($id,$chk)
    {
        $form = new form;
        $form->id = $id;
        $cp = array();
        array_push($cp,array('$H8','id_dvn','',false,false));
        array_push($cp,array('$S100','dvn_field','field',false,false));
        array_push($cp,array('$T80:6','dvn_en','EN',true,TRUE));
        array_push($cp,array('$T80:6','dvn_pt','PT',true,TRUE));
        array_push($cp,array('$H8','dvn_pt','',false,false));
        array_push($cp,array('$B8','','Save',false,false));
        $tela = $form->editar($cp,'dataverse');
        $tela .= $this->show_log($id);
        if ($form->saved > 0)
        {
            $to = get("dd4"); /* Texto original */
            $for = get("dd3"); /* texto alterado */
            if ($to != $for)
                {
                    $this->save_log($id,$to,$for);
                    print_r($_POST);
                }
            redirect(base_url(PATH.'translate'));
        }
        return($tela);
    }

    function save_log($id,$de,$para)
        {
            $user = $_SESSION['id'];
            $sql = "insert into dataverse_log
                (tlog_term, tlog_old, tlog_new,	tlog_user)
                values
                ('$id','$de','$para',$user)";
            $this->db->query($sql);
            return('');
        }
    
    function show_log($id)
        {
            $sql = "select * from dataverse_log
                        LEFT JOIN users ON id_us = tlog_user
                        where tlog_term = $id order by tlog_data desc";
            $rlt = $this->db->query($sql);
            $rlt = $rlt->result_array();
            $sx = '<table width="100%">';
            for ($r=0;$r < count($rlt);$r++)            
                {
                    $line = $rlt[$r];
                    $sx .= '<tr valign="top" style="background-color: #eee;">';
                    $sx .= '<td>';
                    $sx .= stodbr($line['tlog_data']).' ';
                    $sx .= substr($line['tlog_data'],11,8);
                    $sx .= ' - '.$line['us_nome'];
                    $sx .= '</td>';
                    $sx .= '</tr>';

                    $sx .= '<tr valign="top">';
                    $sx .= '<td>DE: '.$line['tlog_old'].'<hr>PARA: '.$line['tlog_new'];
                    $sx .= '</td>';
                    $sx .= '</tr>';
                }
            $sx .= '</table>';
            return($sx);
        }        
    function valida()
    {
        $sql = "select * from ".$this->table."
        where dvn_pt like '%".chr(10)."' 
        limit 100";
        $rlt = $this->db->query($sql);            
        $rlt = $rlt->result_array();
        
        for ($r=0;$r < count($rlt);$r++)
        {
            $line = $rlt[$r];
            $pt = trim($line['dvn_pt']);
            $pt = substr($pt,0,strlen($pt));
            $sql = "update ".$this->table." set
            dvn_pt = '".$pt."'
            where id_dvn = ".$line['id_dvn'];
            $rrr = $this->db->query($sql);
            print_r($line);
            echo '<hr>';
        }
        
    }
    
    /***************
    * Download File
    */
    function downloadall($dir='')
        {
            $sx = message(msg('not_yet_implemented'),3);
            echo $sx;
            return($sx);
        }
    function download($dir='', $file='')
    {
        $this->valida();
        $cr = chr(13).chr(10);
        /*********** Biblioteca de traduções */
        $sql = "select * from dataverse 
        where dvn_file = '$file' 
        and dvn_pt <> ''
        ";
        $rlt = $this->db->query($sql);
        $rlt = $rlt->result_array();
        $lang = array();
        for ($r=0;$r < count($rlt);$r++)
        {
            $line = $rlt[$r];
            $cap = $line['dvn_field'];
            $cap = troca($cap,'u0020','\\u0020');
            $cap = troca($cap,'´',"'");
            if (strlen(trim($line['dvn_pt'])) > 0)
            {
                $lang[$cap] = $line['dvn_pt'];
            } else {
                $lang[$cap] = $line['dvn_en'];
            }
        }
        
        /****************************************** Processamento **************/
        $sx = '';
        $flr = $this->dir.'/'.$dir.'/'.$file;
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
                            $ss = $lang[$cp];
                            $ss = troca($ss,chr(10),'\\n');
                            $sx .= $cp.'='.$ss.$cr;
                        } else {
                            //echo "<br>Erro <b><i>".$cp.'</i></b>';
                            $l = trim($l);
                            $sx .= $l.' [en]'.$cr;
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
        $file = troca($file,'.properties','_br.properties');
        header("Content-Type: text/plain"); 
        header("Content-Disposition: attachment; filename=\"".$file."\"");
        echo mb_convert_encoding($sx,'Windows-1252','UTF-8');
        exit;
    }
    
    function import() {
        $form = new form;
        $cp = array();
        array_push($cp, array('$H8', '', '', false, false));
        array_push($cp, array('$FILE', '','Arquivo', false, True));
        array_push($cp, array('$HV', '','en', True, True));
        array_push($cp, array('$S10', '','Versão do Arquivo (v.__)', True, True));
        array_push($cp, array('$B8', '', 'Importar >>>', False, True));
        
        $tela = $form -> editar($cp, '');
        
        if ($form -> saved > 0) {
            if (isset($_FILES['fileToUpload']['name']))
            {
                $file = $_FILES['fileToUpload']['name'];
                $file_prop = troca($file,'_br.properties','.properties');
                $type = $_FILES['fileToUpload']['type'];
                $tmp_name = $_FILES['fileToUpload']['tmp_name'];
                $error = $_FILES['fileToUpload']['error'];
                $size = $_FILES['fileToUpload']['size'];
            }
            $tela .= '<h3>' . $file . '</h3>';
            
            /******************
            * Leitura do arquivo linha a linha
            */
            if (file_exists($tmp_name))
            {
                /* Copia Arquivo */
                $ver = lowercasesql(get("dd3"));
                $ver = troca($ver,'v.','');
                $ver = troca($ver,'v','');
                $ver = trim($ver);
                
                $dir = $this->dir;
                check_dir($dir);
                $dir .= '/v'.$ver.'/';
                check_dir($dir);
                
                $file_new = $dir.$file;
                copy($tmp_name,$file_new);
                
                /* Idioma */
                $lg = get("dd2");
                $fn = fopen($tmp_name,"r");            
                while(! feof($fn))  {
                    $ln = fgets($fn);
                    switch($this->type)
                    {
                        case 'dataverse':
                            $tela .= $this -> dataverse($ln, $file_prop,$lg);
                        break;
                        
                        case 'codeigniter':
                            $tela .= $this->codeigniter($ln,$file_prop,$lg);
                            echo '<tt>'.$ln.'</tt>';
                        break;
                    }
                    
                }            
                fclose($fn);  
                
                
                //redirect(base_url('index.php/dataverse/inport'));
            }            
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
    $sql = "select * from ".$this->table;
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
            $sql = "update ".$this->table." set t_pt = '".$L."' where id_t = ".$line['id_t'];
            $rrr = $this->db->query($sql);
        }
        if (strpos($L,'} /') > 0)
        {
            $L = troca($L,'} /','}/');
            $sql = "update ".$this->table." set t_pt = '".$L."' where id_t = ".$line['id_t'];
            $rrr = $this->db->query($sql);
        }                        
        echo '<hr>';
        
    }
    echo '</pre>';
}

function codeigniter($lb,$file,$lg='pt')
{
    if ((strlen($lb) == 0) or ($file == ''))
    {
        return("");
    }
    $l1 = substr($lb, 0, strpos($lb, '='));
    $l1 = trim(troca($l1,"'","´"));
    $l2 = substr($lb, strpos($lb, '=') + 1, strlen($lb));
    $l2 = trim(troca($l2,"'","´"));  
    if (strlen($l1) > 0)
    {
        $l2 = substr($l2,2,strlen($l2)-5);
        $l1 = troca($l1,'$lang[','');
        $l1 = troca($l1,']','');
        $l1 = troca($l1,'´','');
        
        $sql = "select * from ".$this->table."
        where dvn_file = '$file'
        AND dvn_field = '$l1' ";
        $rlt = $this -> db -> query($sql);
        $rlt = $rlt -> result_array();
        $sx = $l1;
        $l_en = '';
        $l_es = '';
        $l_fr ='';
        $l_pt = $l2;
        echo '='.$l1.'===>'.$l2;
        echo '<hr>';
        /*
        if (count($rlt) > 0) {
            $sql = "update ".$this->table." set ";
            $sql = "l_pt = '".$l_pt."'
            $sql .= 'where id_dvn = '.$rlt[0]['id_dvn'];
            $rlt = $this -> db -> query($sql);
            $sx .= $l1 . ' <span style="color: grey;"><b>Update</b></span>';
        } else {
            $sql = "insert into ".$this->table."
            (dvn_file, dvn_field, dvn_en, dvn_es, dvn_pt, dvn_fr)
            values
            ('$file','$l1','$l_en','$l_es','$l_pt','$l_fr')";
            $rlt = $this -> db -> query($sql);
            $sx .= $l1 . ' <span style="color: green;"><b>Inserido</b></span>';
        }
        */
        return ($sx . '<br>');            
    }  
    
}

function dataverse($lb, $file, $lg = 'en') {        
    if ((strlen($lb) == 0) or ($file == ''))
    {
        return("");
    }
    $l1 = substr($lb, 0, strpos($lb, '='));
    $l1 = trim(troca($l1,"'","´"));
    $l2 = substr($lb, strpos($lb, '=') + 1, strlen($lb));
    $l2 = trim(troca($l2,"'","´"));
    
    /* Type */     
    if (strlen($l2) == 0) { return("");}
    if ($lg == 'pt')
    {
        $l_pt = utf8_encode($l2);
        $l_en = '';
    } else {
        $l_pt = '';
        $l_en = $l2;
    }
    $sql = "select * from ".$this->table."
    where dvn_file = '$file'
    AND dvn_field = '$l1' ";
    $rlt = $this -> db -> query($sql);
    $rlt = $rlt -> result_array();
    $sx = $l1;
    if (count($rlt) > 0) {
        $sql = "update ".$this->table." set ";
        if ($lg == 'pt')
        {
            $sql .= "dvn_pt = '".$l_pt."'";
        } else {
            $sql .= "dvn_en = '".$l_en."'";
        }
        $sql .= 'where id_dvn = '.$rlt[0]['id_dvn'];
        $rlt = $this -> db -> query($sql);
        $sx .= $l1 . ' <span style="color: grey;"><b>Update</b></span>';
    } else {
        $sql = "insert into ".$this->table."
        (dvn_file, dvn_field, dvn_en, dvn_pt)
        values
        ('$file','$l1','$l_en','$l_pt')";
        $rlt = $this -> db -> query($sql);
        $sx .= $l1 . ' <span style="color: green;"><b>Inserido</b></span>';
    }
    return ($sx . '<br>');
    
}

}
