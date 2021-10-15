<?php
class Trans extends CI_model {
    var $table = 'redd.dataverse';
    var $dir = '_dataverse';
    var $type = 'dataverse';
    var $schemaName = '';
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
        
        $sx .= '<br/><h3>'.msg('Metadata').'</h3>';
        $sx .= '<li><a href="'.base_url(PATH.'metadata').'">'.msg('metadata_custom').'</a></li>';

        $sx .= '</ul>';
        return($sx);
    }

    function TrueFalse($v)
        {
            if ($v==1) 
                {
                    return "TRUE";
                }
            return "FALSE";
        }

    function schema_tsv($d1='',$d2='')
        {
            $dt = $this->schema_le($d1);


            $sx = '';
            $sx .= '#metadataBlock	name	dataverseAlias	displayName	blockURI'.cr();
            $sx .= chr(9).$dt['mt_name'].chr(9).$dt['mt_dataverseAlias'].chr(9).$dt['mt_displayName'].chr(9).$dt['mt_blockURI'].cr();

            $sx .= '#datasetField	name	title	description	watermark	 fieldType	displayOrder	displayFormat	advancedSearchField	allowControlledVocabulary	allowmultiples	facetable	displayoncreate	required	parent	metadatablock_id'.cr();
            $sql = "select * from dataverse_tsv_metadata
                    LEFT JOIN (
                        select count(*) as total, vc_metadatablock_id, vc_schema 
                        from dataverse_tsv_vocabulary 
                        where vc_schema = '$d1'
                        group by vc_metadatablock_id, vc_schema
                    ) as Tables ON vc_metadatablock_id = m_name
                    INNER JOIN dataverse_tsv_schema ON m_schema = id_mt
                    where m_schema = '$d1'

                    order by m_displayOrder ";
            $rlt = $this->db->query($sql);
            $rlt = $rlt->result_array();
            for ($r=0;$r < count($rlt);$r++)
                {
                    $dit = $rlt[$r];

                    

                    $sx .= chr(9).
                            $dit['m_name'].chr(9).
                            $dit['m_title'].chr(9).
                            $dit['m_description'].chr(9).
                            $dit['m_watermark'].chr(9).
                            $dit['m_fieldType'].chr(9).
                            $dit['m_displayOrder'].chr(9).
                            $dit['m_displayFormat'].chr(9).
                            $this->TrueFalse($dit['m_advancedSearchField']).chr(9).
                            $this->TrueFalse($dit['m_allowControlledVocabulary']).chr(9).
                            $this->TrueFalse($dit['m_allowmultiples']).chr(9).
                            $this->TrueFalse($dit['m_facetable']).chr(9).
                            $this->TrueFalse($dit['m_displayoncreate']).chr(9).
                            $this->TrueFalse($dit['m_required']).chr(9).
                            $dit['m_parent'].chr(9).
                            $dit['mt_name'].chr(9).
                            $dit['m_termURI'].cr();
                }

            $dit = $rlt[0];
            $file = '_dataverse/tsv/'.$dit['mt_name'].'.tsv';                

            /***************** VC */
            $sx .= '#controlledVocabulary	DatasetField	Value	identifier	displayOrder    other'.cr();
            $sql = "select * from dataverse_tsv_vocabulary 
                        INNER JOIN dataverse_tsv_metadata ON id_m = vc_metadatablock_id
                        where  vc_schema = '$d1'
                        order by vc_metadatablock_id, vc_displayOrder ";
            $rlt = $this->db->query($sql);
            $rlt = $rlt->result_array();
            for ($r=0;$r < count($rlt);$r++)
                {
                    $dit = $rlt[$r];
                    $sx .= chr(9).
                    $dit['m_name'].chr(9).

                    $dit['vc_DatasetField'].chr(9).
                    $dit['vc_identifier'].chr(9).
                    $dit['vc_displayOrder'].chr(9).
                    $dit['vc_other'];
                    $sx .= cr();                    
                }
            file_put_contents($file,$sx);
            $sx = '<a href="'.base_url($file).'">'.$file.'</a>';
            return($sx);
        }

    function schema($d1='',$d2='')
        {
            if (strlen($d1) > 0)
            {
                $dt = $this->schema_le($d1);
                $name = $dt['mt_name'];
                $sx = '<h1>'.$name.'</h1>';
                /**************************** Bloco 1 */

                if (isset($dt['mt_name']))
                {
                    $sx .= '<a href="'.base_url(PATH.'metadata/schema_ed/'.$dt['id_mt']).'" class="btn btn-outline-primary">'.msg('Edit Schema').'</a>';
                }

                /**************************** Bloco 2 */
                $sx .= $this->schema_show($d1);
                $sx .= '<a href="'.base_url(PATH.'metadata/schema_field_ed/'.$dt['id_mt'].'/0').'" class="btn btn-outline-primary">'.msg('New Field').'</a>';

                $sx .= ' ';
                $sx .= '<a href="'.base_url(PATH.'metadata/schema_tsv/'.$d1).'" class="btn btn-outline-primary">'.msg('Export TSV Schema').'</a>';
                /**************************** Bloco 3 */
                //$sx .= $this->schema_show($d1);

            } else {
                $sql = "select * from dataverse_tsv_schema";
                $rlt = $this->db->query($sql);
                $rlt = $rlt->result_array();

                $sx = '<table class="table" width="100%">';
                for ($r=0;$r < count($rlt);$r++)
                {
                    $line = $rlt[$r];
                    $link = '<a href="'.base_url(PATH.'metadata/schema/'.$line['id_mt']).'">';

                    $linka = '</a>';
                    $sx .= '<tr>';
                    $sx .= '<td>';
                    $sx .= $link.$line['mt_name'].$linka;
                    $sx .= '</td>';

                    $sx .= '<td>';
                    $sx .= $line['mt_displayName'];
                    $sx .= '</td>';
                    
                    $sx .= '</tr>';
                }
                $sx .= '</table>';   
                $sx .= '<a href="'.base_url(PATH.'metadata/schema_ed/0').'" class="btn btn-outline-primary">'.msg('New Schema').'</a>';                
            }
            return($sx);
        }

    function vc($d1,$d2)
        {
            $sx = '';
            $sx .= $this->vocabulary($d2,$d1,True);

            $sx .= '<a href="'.base_url(PATH.'metadata//schema/'.$d1).'" class="btn btn-outline-primary">'.msg('return').'</a>';
            return($sx);
        }

    function vc_ed($d1,$d2,$id)
        {
            $form = new form;
            $form->id = $id;

            $cp = array();
            array_push($cp,array('$H8','id_vc','',false,false));            
            array_push($cp,array('$[0-200]','vc_displayOrder','vc_displayOrder',true,true));
            array_push($cp,array('$S100','vc_DatasetField','vc_DatasetField',true,true));
            array_push($cp,array('$S100','vc_identifier','vc_identifier',true,true));
            array_push($cp,array('$S100','vc_Value','vc_Value',false,true));                        
            array_push($cp,array('$S100','vc_other','vc_other',false,true));
            if ($id == 0)
            {
                array_push($cp,array('$HV','vc_metadatablock_id',$d1,true,true));
                array_push($cp,array('$HV','vc_schema',$d2,true,true));
            }
            $sx = $form->editar($cp,'dataverse_tsv_vocabulary');
            if ($form->saved > 0)
                {
                    echo '<script>      
                            window.opener.location.reload();
                            close();
                         </script>';
                    exit;
                }
            return($sx);
        }

    function schema_ed($id)
        {
            $cp = array();
            array_push($cp,array('$H8','id_mt','',false,false));
            array_push($cp,array('$S100','mt_name',msg('mt_name'),true,true));
            array_push($cp,array('$S100','mt_dataverseAlias',msg('mt_dataverseAlias'),false,true));
            array_push($cp,array('$S100','mt_displayName',msg('mt_displayName'),true,true));
            array_push($cp,array('$S100','mt_blockURI',msg('mt_blockURI'),false,true));
            $form = new form;
            $form->id = $id;

            $sx = $form->editar($cp,'dataverse_tsv_schema');

            if ($form->saved > 0)
                {
                    redirect(base_url(PATH.'metadata/schema/'.get("dd1")));
                }
            return($sx);
        }

    function schema_field_ed($id,$idr)
        {
            $cp = array();
            array_push($cp,array('$H8','id_m','',false,false));
            array_push($cp,array('$HV','m_name','',false,true));
            array_push($cp,array('$S100','m_title',msg('m_title'),true,true));
            array_push($cp,array('$T80:4','m_description',msg('m_description'),false,true));
            array_push($cp,array('$S100','m_watermark',msg('m_watermark'),false,true));
            $op = 'text:text';
            $op .= '&url:url';
            $op .= '&none:none';
            $op .= '&email:email';
            $op .= '&textbox:textbox';
            $op .= '&date:date';
            $op .= '&int:int';
            $op .= '&float:float';
            array_push($cp,array('$O '.$op,'m_fieldType',msg('m_fieldType'),true,true));
            array_push($cp,array('$[0-200]','m_displayOrder',msg('m_displayOrder'),true,true));
            array_push($cp,array('$SN','m_advancedSearchField',msg('m_advancedSearchField'),true,true));
            array_push($cp,array('$SN','m_allowControlledVocabulary',msg('m_allowControlledVocabulary'),true,true));
            array_push($cp,array('$SN','m_allowmultiples',msg('m_allowmultiples'),true,true));
            array_push($cp,array('$SN','m_facetable',msg('m_facetable'),true,true));
            array_push($cp,array('$SN','m_displayoncreate',msg('m_displayoncreate'),true,true));
            array_push($cp,array('$SN','m_required',msg('m_required'),true,true));
            $sql = "select m_name from dataverse_tsv_metadata where m_schema = '".$id."' group by m_name";
            array_push($cp,array('$Q m_name:m_name:'.$sql,'m_parent',msg('m_parent'),false,true));
            array_push($cp,array('$HV','m_schema',$id,true,true));

            $sx = '<h1>Schema: '.$id.'</h1>';

            $form = new form;
            $form->id = $idr;

            $sx .= $form->editar($cp,'dataverse_tsv_metadata');

            if ($form->saved > 0)
                {
                    $sql = "update dataverse_tsv_metadata set m_name = concat('PE',convert(id_m, CHAR)) where m_name = '' ";
                    $this->db->query($sql);

                    redirect(base_url(PATH.'metadata/schema/'.$id));
                }
            return($sx);
        }        

    function schema_le($id='',$name='')
        {
            $sql = "select * from dataverse_tsv_schema
                    where mt_name = '$name' or id_mt = $id
                    limit 1";
            $rlt = $this->db->query($sql);
            $rlt = $rlt->result_array();
            if (count($rlt) > 0)
                {
                    $line = $rlt[0];        
                } else {
                    return(array());
                }
            return($line);
        }

    function schema_meta_le($id='',$name='',$schema='')
        {
            $sql = "select * from dataverse_tsv_metadata
                    where (m_name = '$name' or id_m = $id) and (m_schema = '$schema')
                    limit 1";
            $rlt = $this->db->query($sql);
            $rlt = $rlt->result_array();
            if (count($rlt) > 0)
                {
                    $line = $rlt[0];        
                } else {
                    return(array());
                }
            return($line);
        } 

    function schema_vocabulary_le($id='',$name='',$value='',$schema='')
        {            
            $sql = "select * from dataverse_tsv_vocabulary
                    where (vc_metadatablock_id = '$name' or id_vc = $id) 
                            and (vc_DatasetField = '$value')
                            and (vc_schema = '$schema')
                    limit 1";

            $rlt = $this->db->query($sql);
            $rlt = $rlt->result_array();
            if (count($rlt) > 0)
                {
                    $line = $rlt[0];        
                } else {
                    return(array());
                }
            return($line);
        }         

 function schema_vocabulary($f)
        {
           $schema=$this->schemaName;
           $fl = array('vc_metadatablock_id','vc_DatasetField','vc_identifier','vc_displayOrder','vc_other');
           $dt = $this->schema_vocabulary_le(0,$f[0],$f[1],$schema);

           if (count($dt) == 0)
                {
                    $sql = "insert into dataverse_tsv_vocabulary";
                    $sql1 = 'vc_schema';
                    $sql2 = "'$schema'";
                    for ($r=0;$r < count($fl);$r++)
                    {
                        if (isset($f[$r]) and (strlen($f[$r]) > 0))
                        {
                                $sql1 .= ','; $sql2 .= ',';
                                $sql1 .= $fl[$r];
                                $sql2 .= "'".troca($f[$r],"'","´")."'";
                        }
                    }
                    $sql .= '('.$sql1.') value ('.$sql2.')';  
                    $this->db->query($sql);
                }            
        }              

    function schema_meta_save($f)
        {
           $fl = array('m_name','m_title','m_description','m_watermark',
                'm_fieldType','m_displayOrder','m_displayFormat',
                'm_advancedSearchField','m_allowControlledVocabulary',
                'm_allowmultiples','m_facetable','m_displayoncreate',
                'm_required','m_parent','m_schema','m_termURI');

           if (!isset($f[14]))
            {
                $f[14] = $this->schemaName;
            }
           $dt = $this->schema_meta_le(0,$f[0],$f[14]);

           if (count($dt) == 0)
                {
                    $sql = "insert into dataverse_tsv_metadata";
                    $sql1 = '';
                    $sql2 = '';
                    for ($r=0;$r < count($fl);$r++)
                    {
                        if (isset($f[$r]) and (strlen($f[$r]) > 0))
                        {
                            $ok = 1;
                            if ($fl[$r] == 'm_termURI')
                                {
                                    if (substr($f[$r],0,4) != 'http') { $ok = 0; }
                                }
                            if ($ok==1)
                            {
                                if ($r > 0) { $sql1 .= ','; $sql2 .= ','; }
                                $sql1 .= $fl[$r];
                                $sql2 .= "'".troca($f[$r],"'","´")."'";
                            }
                        }
                    }
                    $sql .= '('.$sql1.') value ('.$sql2.')';  
                    echo $sql;
                    echo '<hr>';                 
                    $this->db->query($sql);
                }            
        }

    function schema_show($id='')
        {
            //$sx = $this->;
            $sx = '<table class="table">';
            $sx .= '<tr>
                    <th>#</th>
                    <th>Metadata</th>
                    <th>Description</th>
                    <th>Parent</th>
                    <th>#</th>
                    </tr>';
            $sql = "select * from dataverse_tsv_metadata
                        LEFT JOIN (
                            select count(*) as total, vc_metadatablock_id, vc_schema 
                            from dataverse_tsv_vocabulary 
                            where vc_schema = '$id'
                            group by vc_metadatablock_id, vc_schema
                        ) as Tables ON vc_metadatablock_id = id_m
                        where m_schema = '$id'

                        order by m_displayOrder ";

            $rlt = $this->db->query($sql);
            $rlt = $rlt->result_array();

            $cp = array('m_displayOrder','m_title','m_description','m_parent');
            for ($r=0;$r < count($rlt);$r++)
                {
                    $line = $rlt[$r];                    
                    $sx .= '<tr>';
                    $link = '<a href="'.base_url(PATH.'metadata/vc/'.$id.'/'.$line['id_m']).'">';

                    for ($y=0;$y < count($cp);$y++)
                        {                            
                            $sx .= '<td style="padding: 0px 5px; border-bottom: 1px solid #000000;">';
                            $fld = $cp[$y];
                            if ($y==1) { $sx .= $link; }
                            $sx .= $line[$fld];
                            if ($y==1) { $sx .= '</a>'; }
                            $sx .= '</td>';                           
                        }

                    $sx .= '<td style="padding: 0px 5px; border-bottom: 1px solid #000000;">';
                    if ($line['total'] > 0)
                    {
                        $sx .= '[+]';
                    }
                    $sx .= '</a>';

                    $sx .= '<td style="padding: 0px 5px; border-bottom: 1px solid #000000;">';
                    $sx .= '<a href="'.base_url(PATH.'metadata/schema_field_ed/'.$line['m_schema'].'/'.$line['id_m']).'">';

                    $sx .= '[ed]';
                    $sx .= '</a>';
                    $sx .= '</td>';

                    $sx .= '</tr>';

                   if ($line['total'] > 0)
                    {
                        $vc = $this->vocabulary($line['vc_metadatablock_id'],$line['vc_schema']);
                        $sx .= '<tr>';
                        $sx .= '<td colspan=2></td>';
                        $sx .= '<td colspan=2>'.$vc.'</td>';
                        $sx .= '</tr>';
                    }
                }
            $sx .= '</table>';
            return($sx);
        }
    
    function vocabulary($f,$s,$edit=false)
        {
            $sql = "select * from dataverse_tsv_vocabulary 
                        where vc_metadatablock_id = '$f' 
                        and vc_schema = '$s'
                        order by vc_displayOrder ";
            $rlt = $this->db->query($sql);
            $rlt = $rlt->result_array();

            $sx = '<table width="100%" class="none">';
            for ($r=0;$r < count($rlt);$r++)
                {
                    $line = $rlt[$r];
                    $sx .= '<tr>';
                    $sx .= '<td width="2%" style="padding: 0px 5px; border-bottom: 1px solid #000000;">'.$line['vc_displayOrder'].'</td>';
                    $sx .= '<td style="padding: 0px 5px; border-bottom: 1px solid #000000;">'.$line['vc_DatasetField'].'</td>';
                    $sx .= '<td style="padding: 0px 5px; border-bottom: 1px solid #000000;">'.$line['vc_Value'].'</td>';
                    $sx .= '<td style="padding: 0px 5px; border-bottom: 1px solid #000000;">'.$line['vc_identifier'].'</td>';                    
                    $sx .= '<td style="padding: 0px 5px; border-bottom: 1px solid #000000;">'.$line['vc_other'].'</td>';
                    if ($edit == true)
                    {
                        $link = '<a href="#" onclick="newxy(\''.base_url(PATH.'metadata/vc_ed/'.$f.'/'.$s.'/'.$line['id_vc'].'?nocab=false').'\',800,600);">';
                        $linka = '</a>';
                        $sx .= '<td width="2%" style="padding: 0px 5px; border-bottom: 1px solid #000000;">'.$link.'[ed]'.$linka.'</td>';
                    }
                    $sx .= '</tr>';
                }
            $sx .= '</table>';
            if ($edit == true)
                {
                        $link = '<a class="btn btn-primary" href="#" onclick="newxy2(\''.base_url(PATH.'metadata/vc_ed/'.$f.'/'.$s.'/'.'0'.'/'.'?nocab=false').'\',800,600);">';

                        $linka = '</a>';
                        $sx .= $link.'novo'.$linka;
                }
            return($sx);
        }

    function schema_save($f)
        {
            echo '<pre>';            
            $fl = array('mt_name','mt_dataverseAlias','mt_displayName','mt_blockURI');
            $dt = $this->schema_le(0,$f[0]);
            $this->schemaName = $f[0];
            if (count($dt) == 0)
                {                    
                    $sql = "insert into dataverse_tsv_schema";
                    $sql1 = '';
                    $sql2 = '';
                    for ($r=0;$r < count($fl);$r++)
                    {
                        if (isset($f[$r]))
                        {
                            if ($r > 0) { $sql1 .= ','; $sql2 .= ','; }
                            $sql1 .= $fl[$r];
                            $sql2 .= "'".$f[$r]."'";
                        }
                    }
                    $sql .= '('.$sql1.') values ('.$sql2.')';
                    $this->db->query($sql);
                }
        }

    function import_schema($f,$t=0)
        {
            if ($t==1)
                {
                    $this->schema_save($f);
                }
            if ($t==2)
                {
                    $this->schema_meta_save($f);
                }
            if ($t==3)
                {
                    $this->schema_vocabulary($f);
                }
        }

    function metadata($d1='',$d2='',$d3='',$d4='')
        {
            $sx = '<div class="row">';
            $sx .= '<div class="'.bscol(12).'">';
            $sx .= '<h1>Metadata</h1>';
            switch($d1)
                {
                    case 'file':
                        $sx .= '<h1>'.$d2.'</h1>';
                        $d3 = true;
                        $sx .= $this->file($d2,$d3);
                        break;
                    case 'schema_tsv':
                        $sx .= $this->schema_tsv($d2,$d3);
                        break;
                    case 'schema':
                        $sx = 'Schema';
                        $sx .= $this->schema($d2,$d3);
                        break;
                    case 'schema_ed':
                        $sx = 'Schema';
                        $sx .= $this->schema_ed($d2,$d3);
                        break;
                    case 'vc_ed':
                        $sx = '<h3>Schema - Edit Vocabulary</h3>';
                        $sx .= $this->vc_ed($d2,$d3,$d4);
                        break;                        
                    case 'vc':
                        $sx = 'Schema - Vocabulary';
                        $sx .= $this->vc($d2,$d3);
                        break;                        
                    case 'schema_field_ed':
                        $sx = 'Schema';
                        $sx .= $this->schema_field_ed($d2,$d3);
                        break;                        
                    case 'files':
                        $sx = 'FILES';
                        $sx .= $this->files($d2,$d3);
                        break;                        
                    default:
                        $sx .= '<ul>';
                        $sx .= '<li>'.'<a href="'.base_url(PATH.'metadata/schema').'">'.msg('metadata_schema').'</a></li>';
                        $sx .= '<li>'.'<a href="'.base_url(PATH.'metadata/files').'">'.msg('metadata_files').'</a></li>';
                        $sx .= '</ul>';
                }
            $sx .= '</div>';
            $sx .= '</div>';
            return($sx);
        }

    function sql_database()
        {
            $sql = "create table dataverse_tsv_vocabulary
                        (
                            id_vc SERIAL NOT NULL,
                            vc_metadatablock_id char(100),
                            vc_DatasetField char(100),
                            vc_Value char(100),
                            vc_identifier char(100),
                            vc_displayOrder int(5),
                            vc_other char(20),
                            vc_schema char(40)
                        )";
            //$this->db->query($sql);    

            $sql = "create table dataverse_tsv_schema
                        (
                            id_mt SERIAL NOT NULL,
                            mt_name char(100),
                            mt_dataverseAlias char(100),
                            mt_displayName char(100),
                            mt_blockURI char(200)
                        )";
            //$this->db->query($sql);
            $sql = "create table dataverse_tsv_metadata
                        (
                            id_m SERIAL NOT NULL,
                            m_name char(40),
                            m_title char(200),
                            m_description text,
                            m_watermark char(200),
                            m_fieldType char(20),
                            m_displayOrder int(1),
                            m_displayFormat char(20),
                            m_advancedSearchField int(1),
                            m_allowControlledVocabulary int(1),
                            m_allowmultiples int(1),
                            m_facetable int(1),
                            m_displayoncreate int(1),
                            m_required int(1),
                            m_parent char(40),
                            m_schema  int(8),
                            m_termURI char(100)
                        )";          
            //$this->db->query($sql);                          
        }

    function file($d2,$d3)
        {
            $sx = '';
            $this->sql_database();
            $file = '_dataverse/tsv/'.$d2;
            $t = file_get_contents($file);

            $t = troca($t,chr(13),';');
            $t = troca($t,chr(10),';');
            $ln = splitx(';',$t);

            $nivel = 0;

            for ($r=0;$r < count($ln);$r++)
                {
                    $l = $ln[$r];
                    $lns = explode("\t",$l);

                    if (substr($lns[0],0,1) == '#')
                        {
                            echo '<h1>'.$lns[0].'</h1>';
                            switch($lns[0])
                                {
                                    case '#metadataBlock';
                                        $nivel = 1;
                                        break;
                                    case '#datasetField';
                                        $nivel = 2;
                                        $new = true;
                                        break;
                                    case '#controlledVocabulary';
                                        $nivel = 3;
                                        break;
                                }
                        } else {
                            /************************ Bloco 1 */
                            if ($nivel == 1) 
                                { 
                                    $sx .= $this->metadataBlock($lns);                                     
                                    $this->import_schema($lns,1);    
                                    $new = false;
                                }
                            /************************ Bloco 2 */
                            if ($nivel == 2) 
                                { 
                                    if ($new == true)
                                        {
                                            $sx .= '<table>';
                                            $new = false;
                                        }
                                        $sx .= $this->datasetField($lns); 
                                        $this->import_schema($lns,2,$d3);
                                }  
                            /************************ Bloco 3 */
                            if ($nivel == 3) 
                                { 
                                    if ($new == true)
                                        {
                                            $sx .= '<table>';
                                            $new = false;
                                        }
                                        $sx .= $this->controlledVocabulary($lns);
                                        $this->import_schema($lns,3,$d3);
                                }                                                   
                        }
                    if ($nivel > 0)
                    {
                        print_r($lns);                    
                        echo '<hr>';
                    }
                }
            return($sx);
        }

    function datasetField($v,$t='')
        {
            $sx = '';
            $sx .= '<tr>';
            for ($r=0;$r < count($v);$r++)
                {
                    $sx .= '<td>'.$v[$r].'</td>';
                }
            $sx .= '</tr>';
            return($sx);
        }  

    function controlledVocabulary($v,$t='')
        {
            $sx = '';
            $sx .= '<tr>';
            for ($r=0;$r < count($v);$r++)
                {
                    $sx .= '<td>'.$v[$r].'</td>';
                }
            $sx .= '</tr>';
            return($sx);            
        }

    function metadataBlock($v,$t='')
        {
            $sx = '';
            $sx .= '<div class="row">';
            $sx .= '<div class="'.bscol(2).' text-right">'.msg('name').'</div>';
            $sx .= '<div class="'.bscol(10).' big">'.$v[0].'&nbsp;</div>';
            $sx .= '<div class="'.bscol(2).' text-right">'.msg('dataverseAlias').'</div>';
            $sx .= '<div class="'.bscol(10).' big">'.$v[1].'&nbsp;</div>';
            $sx .= '<div class="'.bscol(2).' text-right">'.msg('displayName').'</div>';
            $sx .= '<div class="'.bscol(10).' big">'.$v[2].'&nbsp;</div>';
            if (isset($v[3]))
            {
                $sx .= '<div class="'.bscol(2).' text-right">'.msg('blockURI').'</div>';
                $sx .= '<div class="'.bscol(10).' big">'.$v[3].'&nbsp;</div>';
            }
            $sx .= '</div>';
            return($sx);
        }
    function files($d2,$d3)
        {
            $sx = '';
            $dir = '_dataverse/';
            check_dir($dir);
            $dir .= 'tsv/';
            check_dir($dir);

            if (isset($_FILES['fileToUpload']['name']))
                {
                    $txt = file_get_contents($_FILES['fileToUpload']['tmp_name']);
                    $name = $dir. $_FILES['fileToUpload']['name'];
                    file_put_contents($name,$txt);
                    $sx .= message(msg('file_saved').' '.$name,1);
                }

            /* Files */
            echo '===>'.$dir;
            $files = scandir($dir);

            $sx = '<ul>';
            for ($r=0;$r < count($files);$r++)
                {
                    $f = $files[$r];
                    if (!(($f=='.') or ($f=='..') or ($f=='.htaccess') or ($f=='index.php')))
                        {
                            $link = '<a href="'.base_url(PATH.'metadata/file/'.$f).'">';
                            $linka = '</a>';
                           $sx .= '<li>'.$link.$f.$linka.'</li>'.cr();
                        }

                }
            $sx .= '</ul>';
            $form = new form;
            $cp = array();
            array_push($cp,array('$H8','','',false,false));
            array_push($cp,array('$FILE','','Arquivo Import',true,true));
            $sx .= $form->editar($cp,'');
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
        if (!is_dir($dir))
        {
            check_dir($dir);
        }
        $d = scandir($dir);
        
        $sx .=  "Path: " . $dir . "<br/>";
        $fl = 0;
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
                    $fl++;
                }
            }            
        }        
        $sx .= '</pre>';
        if ($fl == 0)
        {
            $sx .= message(msg('file_not_found'),3);
        } else {
            $sx .= '<a href="'.base_url(PATH.'exportall/'.$dr).'" class="btn btn-outline-primary">'.msg('export_all_files').'</a>';
            $sx .= '<p><tt>curl http://localhost:8080/api/admin/datasetfield/loadpropertyfiles -X POST --upload-file languages.zip -H "Content-Type: application/zip"</tt></p>';
        }
        
        
        
        return($sx);
    }
    
    function resume()
    {
        $sql = "select count(*) as total from dataverse";
        $rlt = $this->db->query($sql);
        $rlt = $rlt->result_array();
        if (count($rlt) > 0)
        {
            return($rlt[0]['total']);
        } else {
            return(0);
        }
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
        $dt = $this->le($id);
        $ori = $dt['dvn_pt'];

        $cp = array();
        array_push($cp,array('$H8','id_dvn','',false,false));
        array_push($cp,array('$S100','dvn_field','field',false,false));
        array_push($cp,array('$T80:6','dvn_en','EN',true,TRUE));
        array_push($cp,array('$T80:6','dvn_pt','PT',true,TRUE));
        array_push($cp,array('$B8','','Save',false,false));
        $tela = $form->editar($cp,'dataverse');
        $tela .= $this->show_log($id);
        if ($form->saved > 0)
        {
            $for = get("dd3"); /* texto alterado */
            if ($ori != $for)
            {
                $this->save_log($id,$to,$for);
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
        }
        
    }
    
    /***************
    * Download File
    */
    function downloadall($dr='')
    {
        $dir = $this->dir;
        if (strlen($dr) > 0)
        {
            $dir .= '/'.$dr;
        }
        if (!is_dir($dir))
        {
            check_dir($dir);
        }

        $dtemp = '_tmp';
        check_dir($dtemp);
        $dtemp .= '/dataverse';
        check_dir($dtemp);
        $d = scandir($dir);
        for ($r=0;$r < count($d);$r++)
            {
                $ff = $d[$r];
                if (strpos($ff,'.properties') > 0)
                    {                        
                        echo '<br>==>'.$ff.'=='.$dir;
                        $sx = $this->download_file($dir,$ff);
                        echo $sx;
                    }
                
            }
        //$sx = $this->download_file($dir,$file);
        //$file = troca($file,'.properties','_br.properties');

        $sx = message(msg('not_yet_implemented').' '.$dir,3);
        echo $sx;
        return($sx);
    }
    
    function download_file($dir,$file)
    {
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
            return($sx);      
        } else {
            echo 'File not Found';
            exit;
        }        
    }
    
    function download($dir='', $file='')
    {
        $this->valida();        
        $sx = $this->download_file($dir,$file);
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
function versions_show()
{
    $sx ='';
    $sx .= '<div class="row">';
    $sx .= '<div class="col-2">';
    $img = base_url('img/logo/dataverse_r_project.png');
    $sx .= '<img src="'.$img.'" class="img-fluid">';    
    $sx .= '</div>';
    $sx .= '<div class="col-10">';
    $sx .= '<div class="row">';
    $sx .= '<div class="col-12">';
    $sx .= '<h3>'.msg("select_the_version").'</h3>';
    $sx .= '</div>';
    $sql = "SELECT * FROM dataverse_versions order by dvv_version desc";
    $rlt = $this->db->query($sql);
    $rlt = $rlt->result_array();
    for ($r=0;$r < count($rlt);$r++)
    {
        $line = $rlt[$r];
        $link = '<a href="'.base_url(PATH.'export/'.$line['dvv_version']).'" class="btn btn-outline-info">';
        $linka = '</a>';
        
        $sx .= '<div class="col-2" style="font-size: 200%; margin-bottom: 40px;">';
        $sx .= $line['dvv_version'];
        $sx .= '<br>';
        $sx .= $link;
        $sx .= msg('select');
        $sx .= $linka;
        $sx .= '</div>';  
    }
    $sx .= '</div>';
    $sx .= '</div>';
    return($sx);
}

}
