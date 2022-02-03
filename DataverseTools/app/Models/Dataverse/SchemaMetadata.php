<?php

namespace App\Models\Dataverse;

use CodeIgniter\Model;

class SchemaMetadata extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'dataverse_tsv_schema';
    protected $primaryKey       = 'id_mt';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_mt','mt_name','mt_dataverseAlias',
        'mt_displayName','mt_blockURI'
    ];

    protected $typeFields    = [
        'hidden','string:100','string:100',
        'string:100','url'
    ];    

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    function index($d1,$d2,$d3)
        {
            $sx = '';
            switch($d1)
                {
                    case 'datafieldEd':
                        $datasetField = new \App\Models\Dataverse\SchemaDatasetField();
                        $sx .= $datasetField->datafieldEd($d2,$d3);
                        break;
                    case 'import':
                        $sx .= $this->import($d2,$d3);
                        break;
                    case 'edit':
                        $sx = $this->edit($d2,$d3);
                        break;                    
                    case 'viewid':
                        $sx = $this->viewid($d2,$d3);
                        break;
                    default:
                        $sx .= bs(bsc($this->tableView(),12));
                }
            return $sx;
        }

    function tableView()
        {
            $this->path = PATH.'index/schema';
            $sx = tableview($this);
            return $sx;
        }
    
    function viewid($id)
        {
            $datasetField = new \App\Models\Dataverse\SchemaDatasetField();
            $sx = '';
            $sx .= $this->show($id);

            $sx .= bs(bsc($this->bt_return($id).' '.$this->bt_edit($id).' '.$this->bt_import($id).' ',12));
            $sx .= $datasetField->show($id);
            return $sx;
        }
    function show($id)
        {
            $id = round($id);
            $dt = $this->find($id);
            $sx = '';
            $sx .= '<h1>'.$dt['mt_name'].'</h1>';
            $sx .= '<h2>'.$dt['mt_dataverseAlias'].'</h2>';
            $sx .= '<h3>'.$dt['mt_displayName'].'</h3>';
            $sx .= '<h4>'.$dt['mt_blockURI'].'</h4>';  
            $sx .= '<hr>';          
            $sx = bs(bsc($sx,12));
            return $sx;
        }

    function import($id)
        {
            $sx = '';
            $sx .= $this->show($id);
            $txt = h(lang('Dataverse.import_info'),4);
            $txt .= '<p>'.lang('Dataverse.import_text').'</p>';

            $attributes = ['class' => 'myclass', 'id' => 'myid'];
            $form = form_open_multipart(PATH.'index/schema/import/'.$id, $attributes);
            $form .= form_upload(array('name'=>'files')).'<br>';
            $form .= form_submit(array('class'=>'btn btn-outline-primary mt-3','value'=>lang('Dataverse.import_submit')));
            $form .= form_close();

            if (isset($_FILES))
                {
                    $files = $_FILES;
                    if (count($files) > 0)
                        {
                            $SchemaMetadataImport = new \App\Models\Dataverse\SchemaMetadataImport();
                            $sx .= $SchemaMetadataImport->file_import($id,$files);
                        }
                    
                }



            $sx .= bs(bsc($form,6).bsc($txt,6));

            //$files = $this->request->getFiles();
            //print_r($file);
            return $sx;
        }

    function edit($id)
        {
            $this->id = $id;
            $this->path = PATH.'index/schema';
            $this->path_back = $this->path;
            if ($id > 0)
                {
                    $this->path = PATH.'index/schema/viewid/'.$id;
                }
            
            $sx = form($this);
            $sx = bs(bsc($sx,12));
            return $sx;
        }
    function bt_import($id)
        {
            $sx = '<a href="'.PATH.'index/schema/import/'.$id.'" class="btn btn-outline-primary">'.bsicone('import',22).' '.lang('Dataverse.import').'</a>';
            return $sx;
        }
    function bt_edit($id)
        {
            $sx = '<a href="'.PATH.'index/schema/edit/'.$id.'" class="btn btn-outline-primary">'.bsicone('edit',22).' '.lang('Dataverse.edit').'</a>';
            return $sx;
        }        
    function bt_return($id)
        {
            $sx = '<a href="'.PATH.'index/schema/'.'" class="btn btn-outline-primary">'.bsicone('return',22).' '.lang('Dataverse.return').'</a>';
            return $sx;
        }        
}
