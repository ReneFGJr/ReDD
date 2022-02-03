<?php

namespace App\Models\Dataverse;

use CodeIgniter\Model;

class SchemaMetadataImport extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'schemametadataimports';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

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

    function file_import($id,$files)
        {          
            $controlledVocabulary = new \App\Models\Dataverse\SchemaControlledVocabulary();  
            $datasetField = new \App\Models\Dataverse\SchemaDatasetField();
            if (isset($files[0]))
                {
                    $files = $files[0];
                }

            $temp = $files['files']['tmp_name'];
            $name = $files['files']['name'];
            $size = $files['files']['size'];
            $error = $files['files']['error'];
            $size = round($size/1024);

            $sx = bsmessage('Importing file '.$name.' ('.$size.' kbytes)');

            /*********/
            if (file_exists($temp))
                {
                    $txt = file_get_contents($temp);
                    $lns = explode("\n",$txt);
                    $phase = '';
                    for($r=0;$r < count($lns);$r++)
                        {
                            $ln = trim($lns[$r]);
                            if (substr($ln,0,1) == '#')
                                {
                                    $block = substr($ln,0,strpos($ln,'	'));                                    
                                    $phase = $block;                                    
                                } else {
                                    switch($phase)
                                        {
                                            case '#metadataBlock':
                                            break;
                                            case '#datasetField':
                                                $datasetField->import($id,$ln);
                                                break;
                                            case '#controlledVocabulary':
                                            break;
                                        }
                                }
                        }
                    echo '<pre>';
                    print_r($lns);
                    echo '</pre>';
                } else {
                    $sx .= bsmessage('File not found',3);
                }
            $sx = bs(bsc($sx,12));

            return $sx;
        }
}
