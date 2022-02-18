<?php

namespace App\Controllers;

use App\Controllers\BaseController;

helper(['boostrap', 'url', 'graphs', 
        'sisdoc_forms', 'form', 'nbr', 'sessions',
        'database']);
define("URL", getenv('app.baseURL'));
define("PATH", getenv('app.baseURL').'index.php/Dataverse/');

class Dataverse extends BaseController
{
    private function cab()
        {
            $data['title'] = ':: Dataverse ::';
            $sx = view('Header/Header', $data);
            return $sx;
        }
    public function index($d1='',$d2='',$d3='',$d4='')
    {
        echo "OK";
        exit;
        $sx = $this->cab();
        echo $d1.'->'.$d2.'=>'.$d3;

        switch ($d1)
            {
                case 'schema':
                    $SchemaMetadata = new \App\Models\Dataverse\SchemaMetadata();
                    $sx .= $SchemaMetadata->index($d2,$d3,$d3);
                    break;
                default: 
                    $sx .= '<ul>';
                    $sx .= '<li>'.anchor(PATH.'index/schema', lang('Dataverse.Schema')).'</li>';
            }
        return $sx;
    }
}
