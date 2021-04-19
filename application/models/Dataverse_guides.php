<?php
class dataverse_guides extends CI_Model
    {
        function index($d1,$d2,$d3,$d4,$d5,$d6)
            {
                $sx = $this->navbar();
                $sx .= '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">'.cr();
                $sx .= '
                <!-- https://icons.getbootstrap.com/ -->                
                ';

                switch($d1)
                    {
                        case 'about':
                            $sx .= $this->about($d2);
                        break;

                        case 'contact':
                            $sx .= $this->contact($d2);
                        break;  
                                              

                        case 'glossary':
                            $sx .= $this->glossary($d2);
                        break;  

                        case 'item':
                            $sx .= $this->guide_item($d2);
                        break;

                        case 'itemv':
                            $sx .= $this->guide_item_view($d2);
                        break;  

                        case 'ed':
                            $sx .= $this->edit($d2,$d3);
                        break;                                               

                        case 'api':
                        if (strlen($d2) > 0)
                            {
                                    $sx = $this->guide_api($d2,$d3,$d4,$d5,$d6);
                            }
                            $sx .= $this->menus_api($sx);
                        break;

                        default:
                            $sx .= $this->menus($sx);                            
                            break;

                    }
                return($sx);
            }

        function navbar()
            {
                $sx = '
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="'.base_url(PATH.'guide').'">GUIDE</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="'.base_url(PATH.'guide/glossary').'">Glossário <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="'.base_url(PATH.'guide/about').'">Sobre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="'.base_url(PATH.'guide/contact').'">Contato</a>
                    </li>
                    <!--
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown link
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                    -->
                    </ul>
                </div>
                </nav>                
                ';
                return($sx);               ;
            }

        function edit($d2,$d3)
            {
                $form = new form;
                $cp = array();
                array_push($cp,array('$H8','id_g','',false,false));
                array_push($cp,array('$S20','g_order','g_order',true,true));
                array_push($cp,array('$S100','g_title','g_title',true,true));                
                array_push($cp,array('$S50','g_icone','g_icone',false,true));
                array_push($cp,array('$T80:15','g_description','g_description',false,true));
                array_push($cp,array('$O 1:SIM&0:NÃO','g_nivel','Menu inicial?',false,true));

                $form->id = $d2;
                $sx = $form->editar($cp,'dataverse_guia_menu');
                if ($form->saved > 0)
                    {
                        if ($d2 == 0)
                            {
                                redirect(base_url(PATH.'guide/'));
                            } else {
                                redirect(base_url(PATH.'guide/itemv/'.$d2));
                            }
                        
                    }
                return($sx);
            }

        function menus()
            {
                $sql = "select * 
                        from dataverse_guia_menu
                        where g_nivel = 1
                        order by g_order ";
                $rlt = $this->db->query($sql);
                $rlt = $rlt->result_array();

                $sx = '<div class="row">';
                for ($r=0;$r < count($rlt);$r++)
                    {                        
                        $line = $rlt[$r];
                        $link = '<a href="'.base_url(PATH.'guide/item/'.$line['g_order']).'">';
                        $linka = '</a>';
                        $sx .= '<div class="'.bscol(2).' text-center">';
                        $sx .= $link;
                        $sx .= '<i class="'.$line['g_icone'].'" style="font-size: 4rem; color: cornflowerblue;"></i>';
                        $sx .= '<br>';
                        $sx .= $line['g_title'];
                        $sx .= $linka;
                        $sx .= '</div>';
                    }
                $sx .= '</div>';
                return($sx);
            }
        function guide_item($d3)
            {
                $sql = "select * 
                        from dataverse_guia_menu
                        where g_order like '$d3%'
                        order by g_order ";
                $rlt = $this->db->query($sql);
                $rlt = $rlt->result_array();

                $sx = '<div class="row">';
                for ($r=0;$r < count($rlt);$r++)
                    {                        
                        $line = $rlt[$r];
                        $link = '<a href="'.base_url(PATH.'guide/itemv/'.$line['id_g']).'">';
                        $linka = '</a>';

                        if (strlen($line['g_icone']) > 0)
                        {
                            $sx .= '<div class="'.bscol(12).' text-left" style="font-size: 4rem; color: cornflowerblue;">';
                            $sx .= '<span class="'.$line['g_icone'].'" ></span> ';
                            $sx .= $line['g_title'];
                            $sx .= '</div>';
                        } else {
                            $sx .= '<div class="'.bscol(12).' text-left" style="font-size: 1.5rem;">';
                            $sx .= $link;
                            $sx .= $line['g_title'];
                            $sx .= $linka;
                            $sx .= '</div>';

                        }
                        
                    }
                $sx .= '</div>';
                return($sx);
            } 

        function guide_item_view($d3)
            {
                $sql = "select * 
                        from dataverse_guia_menu
                        where id_g = '$d3'
                        ";
                $rlt = $this->db->query($sql);
                $rlt = $rlt->result_array();

                $sx = '<div class="row">';
                $line = $rlt[0];
                        $sx .= '<div class="'.bscol(12).' text-left">';
                        $sx .= '<h1><b>'.$line['g_title'].'</b></h1>';
                        $txt = $line['g_description'];
                        $txt = troca($txt,'===== ','<h5>');
                        $txt = troca($txt,' =====','</h5>');
                        $txt = troca($txt,'==== ','<h4>');
                        $txt = troca($txt,' ====','</h4>');
                        $txt = troca($txt,'=== ','<h3>');
                        $txt = troca($txt,' ===','</h3>');
                        $txt = troca($txt,'== ','<h2>');
                        $txt = troca($txt,' ==','</h2>');
                        $txt = troca($txt,'= ','<h1>');
                        $txt = troca($txt,' =','</h1>');
                        $txt = troca($txt,'´',"'");
                        $sx .= $this->images(mst($txt));
                        $sx .= '</div>';   
                        $sx .= '<a href="'.base_url(PATH.'guide/ed/'.$line['id_g']).'">ed</a>';
                $sx .= '</div>';
                return($sx);
            }  
        function images($txt)
            {
                $txt = troca($txt,'[[IMAGE','<img src="'.base_url('img/guide/image_'));
                $txt = troca($txt,']]','.jpg" style="border: 0px solid #000000;">');
                return($txt);
            }                    

        function about()
            {
                $sx = '<h1>Sobre</h1>';
                return($sx);
            }

        function menus_api()
            {
                $sql = "select * from dataverse_api order by da_ordem";
                $rlt = $this->db->query($sql);
                $rlt = $rlt->result_array();

                $sx = '<ol>';
                for ($r=0;$r < count($rlt);$r++)
                    {
                        $line = $rlt[$r];
                        $link = '<a href="'.base_url(PATH.'guide/api/'.$line['id_da']).'">';
                        $linka = '</a>';
                        $sx .= '<li>';
                        $sx .= $line['da_ordem'];
                        $sx .= $link;
                        $sx .= $line['da_api'];
                        $sx .= $linka;
                        $sx .= '</li>';
                    }
                $sx .= '</ol>';
                return($sx);
            } 

            function guide_api($d2,$d3,$d4,$d5,$d6)
                {
                $sql = "select * from dataverse_api where id_da = ".round($d2);
                $rlt = $this->db->query($sql);
                $rlt = $rlt->result_array();
                $line = $rlt[0];

                $sx = '<h1>'.$line['da_api'].'</h1>';
                $sx .= '<div class="'.bscol(12).'">';
                $sx .= $line['da_name'];
                $sx .= '</div>';

                $sx .= '<div class="'.bscol(12).'">';
                $sx .= $line['da_name'];
                $sx .= '</div>';

                $sx .= '<div class="'.bscol(12).'">';
                $sx .= '<pre>'.$line['da_sample'].'</pre>';
                $sx .= '</div>';

                return($sx);
                }           
            function contact($d2)
                {
                    $sx = '';
                    return($sx);
                }

            function glossary($d2)
                {
                    $sx = '';
                    return($sx);
                }
    }