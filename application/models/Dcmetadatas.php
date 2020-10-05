<?php
class dcmetadatas extends CI_Model 
{
    var $table = 'dcmetadata_projects';
    function main($d1,$d2,$d3,$d4)
    {
        $sx = '';
        return($sx);
    }
    function resume()
    {
        $sql = "select * from ".$this->table." ";
        $rlt = $this->db->query($sql);
        $rlt = $rlt->result_array();
        $sx = '<h3>'.msg("Resume").'</h3>';
        return($sx);
    }
    function import()
    {
        $sx = '<span class="btn btn-outline-primary" onclick="new_data_bt()">'.msg('btn_new_dataset').'</span>';
        $sx .= '<div style="display: none; margin-top: 50px; border:1px solid #000000; border-radius: 10px; padding: 20px;" id="new_dataset">';
        $sx .= '<h2>'.msg('File_upload').'</h2>';
        $sx .= upload_file();
        
        $file = '';
        if (isset($_FILES['userfile']['tmp_name'])) { $file = $_FILES['userfile']['tmp_name']; }
        if (strlen($file) > 0)
        {
            $file = $_FILES['userfile']['tmp_name'];
            $sx = '<h1>'.msg('Saving_dataset').'</h1>';
            $csv = read_csv($file);
            $prj = 1;
            $this->save_database($csv,$prj);
            $sx .= 'Saving '.$prj;
        }
        $sx .= '</div>';
        $sx .= '<script>
        function new_data_bt()
        {				
            $("#new_dataset").toggle("slow");
        }
        </script>';
        return($sx);
    }
    function save_database($csv,$prj)    
    {
        $this->create_database($csv,$prj);
        $this->update_database($csv,$prj);
    }
    function database_name($prj=1)    
    {
        $table = "dcmetadata_".strzero($prj,3);    
        return($table);
    }
    
    function edit_dataset($id)
    {
        $form = new form;
        $table = $this->database_name();
        $form->cp = $this->le_head();
        $form->id = $id;
        $tela = $form->editar($form->cp,$table);
        if ($form->saved > 0)
        {
            if ($id == '0')
            {
                redirect(base_url(PATH.'dataset'));
            } else {
                redirect(base_url(PATH.'datasetview/'.$id));
            }
            
        }
        return($tela);
    }
    
    function register_dataset($id)
    {
        $dt=$this->le($id);
        $sx = '';
        $sx .= '<a href="'.base_url(PATH.'datasetedit/'.$id).'" class="btn btn-outline-primary">'.msg('edit').'</a>';
        $sx .= '<a href="'.base_url(PATH.'dataset').'" class="btn btn-outline-primary">'.msg('return').'</a>';
        $sx .= '<table class="table">';
        $sx .= '<tr><th width="33%" class="text-right">'.msg('field').'</th><th>'.msg('value').'</th></tr>';
        foreach($dt as $field=>$value)
        {
            $sx .= '<tr>';
            $sx .= '<td class="text-right small">'.$field.'</td>';
            $sx .= '<td>'.mst($value).'</td>';
            $sx .= '</tr>';
        }
        $sx .= '</table>';
        return($sx);
    }
    
    function view_dataset($d1,$d2)
    {
        $table = $this->database_name();
        $fld = $this->le_head();
        $cp = $fld;
        $form = array();
        $form['table'] = $table;
        $form['type'] = 1;
        $form['cp'] = $fld;
        $form['cps'] = array();
        $form['path'] = base_url(PATH.'dataset');
        $tela = row2($form);
        return($tela);
    }
    function le($id)
    {
        $table = $this->database_name();
        $fld = $this->le_head();
        $sql = "select * from ".$table." where ".$fld[0][1]." = '$id' ";
        $rlt = $this->db->query($sql);
        $rlt = $rlt->result_array();
        if (count($rlt) > 0)
        {
            $rlt = $rlt[0];
        } else {
            $rlt = array();
        }
        return($rlt);
    }
    
    function le_head()
    {
        $table = $this->database_name();
        $sql = "select * from $table limit 1";
        $rlt = $this->db->query($sql);
        $rlt = $rlt->result_array();
        $fld = array();
        $id = 0;
        foreach($rlt[0] as $name => $value)
        {         
            $t = true;
            $c = '$T80:3';
            if ($id == 0) { $t = false; $c = '$H'; }
            array_push($fld,array($c,$name,msg($name),false,$t,true));
            $id++;
        }
        return($fld);
    }
    
    function update_database($csv,$prj)
    {
        $table = $this->database_name($prj);
        for ($r=1;$r < count($csv);$r++)
        {
            $line = $csv[$r];
            $id = $line[0];
            $sql = "select * from $table where ".$csv[0][0]." = $id ";
            $rlt = $this->db->query($sql);
            $rlt = $rlt->result_array();
            if (count($rlt) == 0)
            {
                
                $c1 = '';
                $c2 = '';
                for ($y=0;$y < count($line);$y++)
                {
                    $fld = $csv[0][$y];
                    $vlr = $csv[$r][$y];
                    $vlr = troca($vlr,"'","´");
                    if ($y > 0) { $c1 .= ', '; $c2 .= ', '; }
                    $c1 .= $fld;
                    $c2 .= "'$vlr'";
                }
                $sql = "insert into $table ($c1) values ($c2)";
                $this->db->query($sql);
            }
        }
        return('');
    }
    function create_database($csv,$prj)    
    {
        $fld = $csv[0];
        $table = $this->database_name($prj);
        
        /* Checa tabela */
        $sql = "SELECT * FROM information_schema.tables WHERE table_schema = 'redd' AND table_name = '$table' LIMIT 1";
        $rlt = $this->db->query($sql);
        $rlt = $rlt->result_array();
        if (count($rlt) == 0)
        {
            $sql = "create table $table (".$fld[0]."  SERIAL) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin";
            $this->db->query($sql);
            for ($r=1;$r < count($fld);$r++)
            {
                $cp_fld = $fld[$r];
                $sql = "ALTER TABLE $table ADD $cp_fld TEXT";
                $this->db->query($sql);
            }
        }
    }
    function export($c='')
    {
        $sep = array(';',':',',');
        if ($c == '')
        {
            $sx = '<h1>'.msg('Export').'</h1>';
            $form = new form;
            $cp = array();
            array_push($cp,array('$H','','',false,false));
            
            $op = '0:'.msg('semicolon').';';
            $op .= '1:'.msg('colon').';';
            $op .= '2:'.msg('coma');
            array_push($cp,array('$O '.$op,'',msg('separator'),true,true));
            $sx .= $form->editar($cp,'');
        } else {
            $sx = '';
            $table = $this->database_name();
            $sp = $sep[get("dd1")];
            $fld = $this->le_head();
            $sql = "select * from $table order by ".$fld[0][1];
            $rlt = $this->db->query($sql);
            $rlt = $rlt->result_array();
            /******** Header */
            $cr = chr(10);
            for ($r=0;$r < count($fld);$r++)
            {
                if ($r > 0) { $sx .= $sp; }
                $sx .= $fld[$r][1];
            }
            $sx .= $cr;
            for ($r=0;$r < count($rlt);$r++)
            {
                $ln = '';
                $line = $rlt[$r];
                foreach($line as $fld=>$vlr)
                {
                    
                    if ($ln != '') { $ln .= $sp; }
                    $vlr = troca($vlr,'"','""');
                    $ln .='"'.$vlr.'"';
                }
                $sx .= $ln.$cr;
            }                        
            header('Content-Encoding: UTF-8');
            header('Content-type: text/csv; charset=UTF-8');
            header('Content-Disposition: attachment; filename=Customers_Export.csv');
            echo utf8_decode($sx); 
        }
        return($sx);
    }
}