<?php
class lattes_cnpq extends CI_Model
{
    var $table = 'lattes_curriculo';
    var $path = '__lattes';
    var $study = 'JOINVILE-UFSC';

    var $table_gr = 'lattes_group';
    var $table_grmb = 'lattes_group_member';
    //var $path = '__lattes/Joinville';

    function le_group($id)
    {
        $sql = "select * from " . $this->table_gr . " where gp_status = 1 and id_gp = " . $id;
        $rlt = $this->db->query($sql);
        $rlt = $rlt->result_array();
        if (count($rlt) > 0) {
            $rlt = $rlt[0];
        } else {
            $rlt = array();
        }
        return ($rlt);
    }

    function groups($id = 0)
    {
        $sql = "select * from " . $this->table_gr . " where gp_status = 1 ";
        $rlt = $this->db->query($sql);
        $rlt = $rlt->result_array();

        $sx = '<h1>' . msg("Lattes") . ' - ' . msg("Analytics") . '</h1>';
        $sx .= '<table class="table">';
        for ($r = 0; $r < count($rlt); $r++) {
            $line = $rlt[$r];
            $link = '<a href="' . base_url(PATH . 'group/' . $line['id_gp']) . '">';
            $linka = '</a>';
            $sx .= '<tr>';
            $sx .= '<td>';
            $sx .= '<h4>' . $link . $line['gp_name'] . $linka . '</h4>';
            $sx .= '</td>';
            $sx .= '</tr>';
        }
        $sx .= '</table>';
        return ($sx);
    }

    function cpr()
    {
        $cp = array();
        return ($cp);
    }

    function check_lattes_directory()
    {
        $path = $this->path;
        $limit = 20;
        $diretorio = dir($path);
        $sx = '<h1>' . msg('Zip_Lattes') . '</h1>';
        $sx .= "Lista de Arquivos do diretório '<strong>" . $path . "</strong>':<br />";
        $fls = 0;
        $prc = 0;
        while (($arquivo = $diretorio->read()) and ($prc < $limit)) {
            if ($prc > $limit) {
                echo "OPS";
                exit;
            }
            $filename = $path . '/' . $arquivo;

            if (filetype($filename) == 'file') {
                $ext = substr($filename, strlen($filename) - 3, 3);
                if ($ext == 'zip') {
                    $prc++;
                    $sx .= $filename;
                    $sx .= ' ';
                    $sx .= date("Y-m-d H:i:s", filemtime($filename));
                    $sx .= '<br>';
                    $id = sonumero($arquivo);
                    $this->lattes($id);
                    $this->unzip($filename);
                    $fls++;
                }
            }
        }
        $diretorio->close();
        if ($fls == 0) {
            $sx .= message('none file located', 3);
        }
        if ($prc >= $limit) {
            $sx .= '<meta http-equiv="refresh" content="2">';
            $sx .= '<h5>Reprocessando dados ZIP</h5>';
        }
        return ($sx);
    }

    function next_process($id)
    {
        $id++;
        $path = $this->path;
        $diretorio = dir($path);
        $fn = 0;
        while ($arquivo = $diretorio->read()) {
            //echo '>'.$path.'-->'.$arquivo.'<br>';
            if (strpos($arquivo, '.xml') > 0) {
                $fn++;
                if ($fn == $id) {
                    return (sonumero($arquivo));
                }
            }
        }
        echo 'OPS';
        exit;
    }

    function xml_lattes($id)
    {
        $file = $this->path . '/' . $id . '.xml';
        if (file_exists($file)) {
            $sx = '<h4>' . $file . '</h4>';
        } else {
            $sx = msg('file_not_found') . ' ' . $file . '<br>';
            echo $sx;
            return ("");
        }

        /* Teste */
        /********************************* XML to ARRAY ***************************/
        $xml = simplexml_load_file($file, "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($xml);
        $cv = json_decode($json, TRUE);

        /* testado */
        $idcv = $this->processar_cv($id, $cv);
        $this->processar_dados_gerais($cv, $idcv, $id);
        $this->processar_producao_bibliografica($cv, $idcv, $id);
        $this->processar_producao_tecnica($cv, $idcv, $id);
        return ("");
    }

    function row($path, $id)
    {
        $sx = '';
        $dt = array();
        $dt['table'] = $this->table;
        $dt['path'] = base_url(PATH . 'payroll/');
        $dt['cp'] = $this->cpr();

        switch ($path) {
            case 'check_lattes_directory':
                $sx = '';
                $sx .= '<div class="col-md-12" id="input">';
                $sx .= $this->check_lattes_directory();
                $sx .= '</div>';
                break;

            case 'xml_lattes':
                $sx = '';
                $sx .= '<div class="col-md-12" id="input">';
                $sx .= $this->xml_lattes($id);
                $sx .= '</div>';
                break;

            case 'xml_lattes_auto':
                $sx = '';
                $sx .= '<div class="col-md-12" id="input">';
                $idn = round($id);
                $idcv = $this->next_process($idn);
                if ($idcv != '') {
                    $sx .= '<h4>Lattes: ' . $idcv . '</h4>';
                    $idn++;
                    $sx .= '<h6>ID: ' . $idn . '</h6>';
                    $sx .= $this->xml_lattes($idcv);
                    $sx .= '<meta http-equiv="refresh" content="5;' . base_url(PATH . 'lattes/xml_lattes_auto/' . $idn) . '">';
                } else {
                    $sx .= '<h1>Fim do processamento</h1>';
                }
                $sx .= '</div>';
                break;


            default:
                $sx .= '<ul>';
                $sx .= '<li>' . '<a href="' . base_url(PATH . 'lattes/check_lattes_directory') . '">' . msg('check_lattes_directory') . '</a>';
                $sx .= '<li>' . '<a href="' . base_url(PATH . 'lattes/xml_lattes_auto') . '">' . msg('xml_lattes') . '</a>';
                $sx .= '</ul>';
        }
        $data['content'] = $sx;
        $this->load->view('content', $data);
        return ($sx);
    }

    function group_resume($id = 0)
    {
        $data = $this->le_group($id);
        $sx = '';
        $sx .= $this->show_group($data);
        $sx .= '<div class="row">';
        $tot = $data['gp_members'];
        $sx .= $this->show_group_summary(1, $id, $tot);
        $tot = $data['gp_articles'];
        $sx .= $this->show_group_summary(2, $id, $tot);
        $tot = $data['gp_book'];
        $sx .= $this->show_group_summary(3, $id, $tot);
        $tot = $data['gp_chapterbook'];
        $sx .= $this->show_group_summary(4, $id, $tot);
        $tot = $data['gp_event'];
        $sx .= $this->show_group_summary(5, $id, $tot);
        $tot = $data['gp_software'];
        $sx .= $this->show_group_summary(6, $id, $tot);
        $tot = $data['gp_patent'];
        $sx .= $this->show_group_summary(7, $id, $tot);
        $tot = $data['gp_di'];
        $sx .= $this->show_group_summary(8, $id, $tot);
        $tot = $data['gp_tech'];
        $sx .= $this->show_group_summary(9, $id, $tot);
        $sx .= '</div>';

        $sx .= '<a href="' . base_url(PATH . 'reprocess_group/' . $id) . '">';
        $sx .= '<img src="' . base_url('img/redd/icone_reprocess.png') . '" width="48">';
        $sx .= '</a>';
        $sx .= '<a href="' . base_url(PATH . 'grapho/' . $id) . '">';
        $sx .= '<img src="' . base_url('img/redd/icone_grapho.png') . '" width="48">';
        $sx .= '</a>';

        return ($sx);
    }

    function show_group_summary($tp, $id, $tot)
    {
        $link = '<a href="' . base_url(PATH . 'subgroup/' . $id . '/' . $tp) . '" style="text-decoration: none;">';
        $linka = '</a>';
        $sx = '';
        $imgs = array(
            '', 'img/redd/icone_researcher.png', 'img/redd/icone_article.png', 'img/redd/icone_book.png', 'img/redd/icone_book.png', 'img/redd/icone_proceedings.png', 'img/redd/icone_software.png', 'img/redd/icone_patent.png', 'img/redd/icone_design.png', 'img/redd/icone_product.png'
        );
        $txts = array(
            '', 'Researcher', 'Articles', 'Books', 'ChapterBooks',
            'Proceedings', 'Software', 'Patent', 'IndustrialDesign', 'TechnologicalProduct', 'Researcher', 'Articles', 'Books', 'Proceedings'
        );
        $cols = array(
            '', '#663399', '#009933',
            '#D85555', '#D85555', '#5555D8',
            '#9900CC', '#ff00ff',
            '#6666ff', '#D8D855',
        );
        $colb = array(
            '', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#000'
        );
        $img = $imgs[$tp];
        $txt = $txts[$tp];
        $cor = $cols[$tp];
        $cob = $colb[$tp];

        $sx .= $link;
        $sx .= '<div class="col-4" style="margin-bottom: 40px;">';
        $sx .= '<div class="row" style="padding: 4px;">';
        $sx .= '<div class="col-3">';
        $sx .= '<img src="' . base_url($img) . '" class="img-fluid">';
        $sx .= '</div>';
        $sx .= '<div class="col-9 text-right">';
        $sx .= '<span style="font-size: 40px; color: ' . $cor . ';"><b>' . $tot . '</b></span>';
        $sx .= '</div>';


        /****/
        $sx .= '<div class="col-12 text-center" style="background-color:  ' . $cor . '; color:  ' . $cob . '">';
        $sx .= msg($txt);
        $sx .= '</div>';
        $sx .= '</div>';
        $sx .= $linka;

        $sx .= '</div>';
        return ($sx);
    }

    function show_group($data)
    {
        $sx = '';
        $sx .= '<div class="row" style="border-bottom: 1px solid #000000; margin-bottom: 20px;">';
        $sx .= '<div class="col-12">';
        $sx .= '<h1>' . $data['gp_name'] . '</h1>';
        $sx .= '</div>';
        $sx .= '</div>';
        return ($sx);
    }

    function group_reprocess($id=0)
    {
        $data = $this->le_group($id);
        $mb = $this->group_id_rdf($id);
        
        $sql = "update ".$this->table_gr." set gp_members = ".count($mb)." where id_gp = ".sonumero($id);
        $rlt = $this->db->query($sql);

        $wh = '';
        for ($r=0;$r < count($mb);$r++)
            {
                $l = $mb[$r];
                if (strlen($wh) > 0) { $wh .= ' OR '; }
                $wh .= ' (p_cv = '.$l.') ';

            }
        $sql = "select p_nat, count(*) as total 
                    from lattes_producao 
                    WHERE ($wh)
                    GROUP BY p_nat
                    ";
        $rlt = $this->db->query($sql);
        $rlt = $rlt->result_array();

        $prop = array('SOF', 'ART', 'EVE','PAT','CAP','LIV','IDS','TEC');
        $fld = array('gp_software','gp_articles','gp_event','gp_patent','gp_chapterbook','gp_book','gp_di','gp_tech');

        /* Zera dados */
        $sql = "";
        for ($r=0;$r < count($fld);$r++)
            {
                if ($r > 0) { $sql .= ', '; }
                $sql .= $fld[$r] .' = 0';
            }
        $sql = "update ".$this->table_gr." set ".$sql." where id_gp = ".sonumero($id);
        $xxx = $this->db->query($sql);
       
        for ($y = 0;$y < count($rlt); $y++)
        {
            $ln = $rlt[$y];
            $vlr = $ln['total'];
 
            $sql = "update ".$this->table_gr." set ";
            $sql .= $fld[$y]." = ".$vlr;
            $sql .= " where id_gp = ".sonumero($id);
            $xrlt = $this->db->query($sql);
        }
    } 

    function subgroup_resume($group,$type)
        {
            $types = array('','','ART');
            switch($type)
                {
                    case '1':
                        break;
                    case '2':
                        $sx = $this->resumo_groups_type($group,$types[2]);
                        break;
                    default:
                    $sx = $this->resumo_groups_type($group,$types[$type]);
                    break;
                }
            return($sx);
        }
    function resumo_groups_type($group,$type)
        {
            $wh = $this->group_id_where($group);
            $sql = "select p_ano, count(*) as total
                        FROM lattes_producao
                        where ($wh) and p_nat = '$type'
                        GROUP BY p_ano
                        ORDER BY p_ano";
            $rlt = $this->db->query($sql);
            $rlt = $rlt->result_array();

            $prod = array();
            $ini = 1980;
            $fim = 2020;
            for ($r=$ini;$r <= $fim;$r++)
                {
                    $prod[$r] = 0;
                }
            for ($r=0;$r < count($rlt);$r++)
                {
                    $ano = $rlt[$r]['p_ano'];
                    $total = $rlt[$r]['total'];
                    $prod[$ano] = $total;
                }
            $sxr = 'artigos_'.$group.' = c(';
            $n = 0;
            foreach($prod as $ano => $total)
                {
                    if ($n > 0) { $sxr .= ', '; }
                    $sxr .= $total;
                    $n++;
                }
            $sxr .= ')';
            return($sxr);
        }
    
	function group_id_rdf($id)
	{
        $sql = "select id_lt
                from lattes_group_member 
                INNER JOIN lattes_curriculo on gm_lattes_id = lt_lattes
		        where gm_group = $id 
		        group by id_lt
		";
		$gr = array();
		$rlt = $this->db->query($sql);
		$rlt = $rlt->result_array();
		for ($r=0;$r < count($rlt);$r++)
		{
			array_push($gr,$rlt[$r]['id_lt']);
		}			
		return($gr);
    }
    
    function group_id_where($id)
        {
            $mb = $this->group_id_rdf($id);
            $wh = '';
            for ($r=0;$r < count($mb);$r++)
                {
                    $l = $mb[$r];
                    if (strlen($wh) > 0) { $wh .= ' OR '; }
                    $wh .= ' (p_cv = '.$l.') ';    
                }            
            return($wh);
        }

    /**************************************** PROCESSAR CV *************/
    function processar_cv($id, $cv)
    {
        $term = 'cv' . $id;
        $class = "lattes_CurriculoLattes";
        $DT = array();
        $DT['lattes_name'] = $cv['DADOS-GERAIS']['@attributes']['NOME-COMPLETO'];
        $DT['idc'] = $term;
        if (isset($cv['@attributes'])) {
            $att = $cv['@attributes'];
            foreach ($att as $key => $v) {
                switch ($key) {
                    case 'SISTEMA-ORIGEM-XML':
                        $DT['origem-xml'] = $v;
                        break;

                    case 'NUMERO-IDENTIFICADOR':
                        $DT['lattes_id'] = $v;

                        break;

                    case 'DATA-ATUALIZACAO':
                        $CvDateUpdate = substr($v, 4, 4) . '-' . substr($v, 2, 2) . '-' . substr($v, 0, 2);
                        $DT['lattes_update'] = $CvDateUpdate;
                        break;

                    case 'HORA-ATUALIZACAO':
                        $CvTimeUpdate = substr($v, 0, 2) . ':' . substr($v, 2, 2) . ':' . substr($v, 4, 2);
                        $DT['lattes_updateHour'] = $CvTimeUpdate;
                        break;
                }
            }
            $DT['lattes_url'] = 'http://lattes.cnpq.br/' . $id;
        }
        $id = $this->update_lattes_curriculo($DT);
        return ($id);
    }
    function update_lattes_curriculo($dt)
    {
        $lattes = $dt['lattes_id'];
        $date = $dt['lattes_update'];
        $hour = trim($dt['lattes_updateHour']);
        if (isset($dt['lattes_name'])) {
            $name = $dt['lattes_name'];
        } else {
            $name = '';
        }

        $sql = "select * from lattes_curriculo where lt_lattes = '" . $lattes . "'";
        $rlt = $this->db->query($sql);
        $rlt = $rlt->result_array();
        if (count($rlt) == 0) {
            $sqlx = "insert into lattes_curriculo
                        (lt_lattes, lt_update, lt_status, lt_name)
                        values
                        ('$lattes', '$date', '$hour', '$name')";

            $this->db->query($sqlx);
            sleep(1);

            $rlt = $this->db->query($sql);
            $rlt = $rlt->result_array();
        } else {
            $nn = '';
            if (strlen($name) > 0) {
                $nn = ", lt_name = '$name' ";
            }
            $sqlx = "update lattes_curriculo set
                            lt_update = '$date',
                            lt_hour = '$hour'
                            $nn
                        where id_lt = " . $rlt[0]['id_lt'];
            $this->db->query($sqlx);
        }
        return ($rlt[0]['id_lt']);
    }

    function processar_dados_gerais($cv, $idcv, $lattes)
    {
        $DT = array();
        if (isset($cv['DADOS-GERAIS'])) {
            $dg = $cv['DADOS-GERAIS'];
            if (isset($dg['@attributes'])) {
                $att = $dg['@attributes'];
                foreach ($att as $key => $v) {
                    $DT[$key] = $v;
                }

                /* Fase II ******************************************************/
                if (isset($dg['RESUMO-CV'])) {
                    $v = $dg['RESUMO-CV']['@attributes']['TEXTO-RESUMO-CV-RH'];
                    $DT['RESUMO-CV'] = $v;
                }

                /* Fase III  ** ENDERECO PROFISSIONAL **************************/
                if (isset($dg['ENDERECO'])) {
                    $DT['ENDERECO'] = (array)$dg['ENDERECO']['ENDERECO-PROFISSIONAL']['@attributes'];
                }

                /* Fase IV  ** FORMACAO-ACADEMICA-TITULACAO **************************/
                $DT['GRADUAÇÃO'] = array();
                $DT['ESPECIALIZACAO'] = array();
                $DT['MESTRADO'] = array();
                $DT['DOUTORADO'] = array();
                if (isset($dg['FORMACAO-ACADEMICA-TITULACAO'])) {
                    $ar = $dg['FORMACAO-ACADEMICA-TITULACAO'];
                    if (isset($ar['GRADUACAO']['@attributes'])) {
                        array_push($DT['GRADUAÇÃO'], $ar['GRADUACAO']['@attributes']);
                    }
                    if (isset($ar['ESPECIALIZACAO']['@attributes'])) {
                        array_push($DT['ESPECIALIZACAO'], $ar['ESPECIALIZACAO']['@attributes']);
                    }
                    if (isset($ar['MESTRADO']['@attributes'])) {
                        array_push($DT['MESTRADO'], $ar['MESTRADO']['@attributes']);
                    }
                    if (isset($ar['DOUTORADO']['@attributes'])) {
                        array_push($DT['DOUTORADO'], $ar['DOUTORADO']['@attributes']);
                    }
                }


                /* Fase V ** Atuacao profissional ***********************************/
                if (isset($dg['ATUACOES-PROFISSIONAIS'])) {
                    $DT['ATUACOES-PROFISSIONAIS'] = array();
                    $ar = $dg['ATUACOES-PROFISSIONAIS']['ATUACAO-PROFISSIONAL'];
                    for ($r = 0; $r < count($ar); $r++) {
                        if (isset($ar[0])) {
                            $at = $ar[$r];
                        } else {
                            $at = $ar;
                        }

                        $inst_cod = $at['@attributes']['CODIGO-INSTITUICAO'];
                        $inst_nome = $at['@attributes']['NOME-INSTITUICAO'];

                        /**************************** VINCULOS *******************/
                        if (isset($at['VINCULOS'])) {
                        }
                    }

                    /* Fase VI ** Área de Atuaçao ***********************************/
                    if (isset($dg['AREAS-DE-ATUACAO']['AREA-DE-ATUACAO'])) {
                        $at = $dg['AREAS-DE-ATUACAO']['AREA-DE-ATUACAO'];
                        $DT['AREAS-DE-ATUACAO'] = array();
                        for ($z = 0; $z < count($at); $z++) {
                            if (isset($at[0])) {
                                array_push($DT['AREAS-DE-ATUACAO'], $at[$z]['@attributes']);
                            } else {
                                array_push($DT['AREAS-DE-ATUACAO'], $at['@attributes']);
                            }
                        }
                    }

                    /* Fase VII ** Idiomas *********************************/
                    $DT['IDIOMAS'] = array();
                    if (isset($dg['IDIOMAS']['IDIOMA'])) {
                        $at = $dg['IDIOMAS']['IDIOMA'];
                        for ($z = 0; $z < count($at); $z++) {
                            if (count($at) == 1) {
                                array_push($DT['IDIOMAS'], $at['@attributes']);
                            } else {
                                array_push($DT['IDIOMAS'], $at[$z]['@attributes']);
                            }
                        }
                    }
                }
            }
        }
        //print_r($DT);
    }

    /*************************** PROCESSAR DADOS GERAIS CV *************/
    function processar_producao_bibliografica($cv, $idcv, $lattes)
    {
        $this->excluir_producao($idcv);
        $DT = array();
        if (isset($cv['PRODUCAO-BIBLIOGRAFICA'])) {
            $dg = $cv['PRODUCAO-BIBLIOGRAFICA'];

            //TRABALHOS-EM-EVENTOS
            if (isset($dg['TRABALHOS-EM-EVENTOS'])) {
                $te = $dg['TRABALHOS-EM-EVENTOS']['TRABALHO-EM-EVENTOS'];
                for ($r = 0; $r < count($te); $r++) {
                    if (isset($te[0])) {
                        $this->trabalho_evento($idcv, $lattes, $te[$r]);
                    } else {
                        $this->trabalho_evento($idcv, $lattes, $te);
                    }
                }
            }

            //ARTIGOS-PUBLICADOS
            if (isset($dg['ARTIGOS-PUBLICADOS'])) {
                $te = $dg['ARTIGOS-PUBLICADOS']['ARTIGO-PUBLICADO'];
                for ($r = 0; $r < count($te); $r++) {
                    if (isset($te[0])) {
                        $this->trabalho_artigo($idcv, $lattes, $te[$r]);
                    } else {
                        $this->trabalho_artigo($idcv, $lattes, $te);
                    }
                }
            }

            //LIVROS E CAPITULOS
            if (isset($dg['LIVROS-E-CAPITULOS'])) {
                /* LIVROS E LIVROS ORGANIZADOS */
                if (isset($dg['LIVROS-E-CAPITULOS']['LIVROS-PUBLICADOS-OU-ORGANIZADOS']['LIVRO-PUBLICADO-OU-ORGANIZADO'])) {
                    $te = $dg['LIVROS-E-CAPITULOS']['LIVROS-PUBLICADOS-OU-ORGANIZADOS']['LIVRO-PUBLICADO-OU-ORGANIZADO'];
                    for ($r = 0; $r < count($te); $r++) {
                        if (isset($te[0])) {
                            $this->trabalho_livros($idcv, $lattes, $te[$r]);
                        } else {
                            $this->trabalho_livros($idcv, $lattes, $te);
                        }
                    }
                }
                /* CAPITULOS */
                if (isset($dg['LIVROS-E-CAPITULOS']['CAPITULOS-DE-LIVROS-PUBLICADOS']['CAPITULO-DE-LIVRO-PUBLICADO'])) {
                    $te = $dg['LIVROS-E-CAPITULOS']['CAPITULOS-DE-LIVROS-PUBLICADOS']['CAPITULO-DE-LIVRO-PUBLICADO'];
                    for ($r = 0; $r < count($te); $r++) {
                        if (isset($te[0])) {
                            $this->capitulo_livros($idcv, $lattes, $te[$r]);
                        } else {
                            $this->capitulo_livros($idcv, $lattes, $te);
                        }
                    }
                }
            }
        }
    }

    function autores($t)
    {
        $aut = '';
        $n = 0;
        if (isset($t[0])) {
            for ($r = 0; $r < count($t); $r++) {
                if (strlen($aut) > 0) {
                    $aut .= '; ';
                }
                $aut .= nbr_author($t[$r]['@attributes']['NOME-PARA-CITACAO'], 5);
                $n++;
            }
        } else {
            $aut .= nbr_author($t['@attributes']['NOME-PARA-CITACAO'], 5);
            $n++;
        }
        $aut = troca($aut, "'", "´");
        return (array($aut, $n));
    }



    function trabalho_artigo($idcv, $lattes, $te)
    {
        $auth = $this->autores($te['AUTORES']);
        $DT['AUTORES'] = $auth[0];
        $DT['AUTORES_NR'] = $auth[1];
        $DT['NATUREZA'] = 'ART';
        $DT['TIPO']     = $this->outros($te['DADOS-BASICOS-DO-ARTIGO']['@attributes']['NATUREZA']);
        $DT['TITULO']   = $te['DADOS-BASICOS-DO-ARTIGO']['@attributes']['TITULO-DO-ARTIGO'];
        $DT['ANO']      = $te['DADOS-BASICOS-DO-ARTIGO']['@attributes']['ANO-DO-ARTIGO'];
        $DT['PAIS']     = $this->pais($te['DADOS-BASICOS-DO-ARTIGO']['@attributes']['PAIS-DE-PUBLICACAO']);
        $DT['IDIOMA']   = $this->idioma($te['DADOS-BASICOS-DO-ARTIGO']['@attributes']['IDIOMA']);
        $ISSN = $te['DETALHAMENTO-DO-ARTIGO']['@attributes']['ISSN'];
        $DT['PUBLICACAO'] = $this->publicacao($te['DETALHAMENTO-DO-ARTIGO']['@attributes']['TITULO-DO-PERIODICO-OU-REVISTA'], $ISSN);
        $DT['ABRANGENCIA'] = '-';
        $DT['CIDADE'] = $this->cidade($te['DETALHAMENTO-DO-ARTIGO']['@attributes']['LOCAL-DE-PUBLICACAO']);

        $this->save_work($DT, $idcv);
    }


    function trabalho_livros($idcv, $lattes, $te)
    {
        $auth = $this->autores($te['AUTORES']);
        $DT['AUTORES'] = $auth[0];
        $DT['AUTORES_NR'] = $auth[1];
        $DT['NATUREZA'] = 'LIV';
        $DT['TIPO']     = $this->outros($te['DADOS-BASICOS-DO-LIVRO']['@attributes']['NATUREZA']);
        $DT['TITULO']   = $te['DADOS-BASICOS-DO-LIVRO']['@attributes']['TITULO-DO-LIVRO'];
        $DT['ANO']      = $te['DADOS-BASICOS-DO-LIVRO']['@attributes']['ANO'];
        $DT['PAIS']     = $this->pais($te['DADOS-BASICOS-DO-LIVRO']['@attributes']['PAIS-DE-PUBLICACAO']);
        $DT['IDIOMA']   = $this->idioma($te['DADOS-BASICOS-DO-LIVRO']['@attributes']['IDIOMA']);
        $ISSN = '';
        $DT['PUBLICACAO'] = 0;
        $DT['ABRANGENCIA'] = '-';
        $DT['CIDADE'] = $this->cidade($te['DETALHAMENTO-DO-LIVRO']['@attributes']['CIDADE-DA-EDITORA']);

        $this->save_work($DT, $idcv);
    }

    function capitulo_livros($idcv, $lattes, $te)
    {
        $auth = $this->autores($te['AUTORES']);
        $DT['AUTORES'] = $auth[0];
        $DT['AUTORES_NR'] = $auth[1];
        $DT['NATUREZA'] = 'CAP';
        $DT['TIPO']     = $this->outros($te['DADOS-BASICOS-DO-CAPITULO']['@attributes']['TIPO']);
        $DT['TITULO']   = $te['DADOS-BASICOS-DO-CAPITULO']['@attributes']['TITULO-DO-CAPITULO-DO-LIVRO'];
        $DT['TITULO']   .= ' in: ' . $te['DETALHAMENTO-DO-CAPITULO']['@attributes']['TITULO-DO-LIVRO'];
        $DT['ANO']      = $te['DADOS-BASICOS-DO-CAPITULO']['@attributes']['ANO'];
        $DT['PAIS']     = $this->pais($te['DADOS-BASICOS-DO-CAPITULO']['@attributes']['PAIS-DE-PUBLICACAO']);
        $DT['IDIOMA']   = $this->idioma($te['DADOS-BASICOS-DO-CAPITULO']['@attributes']['IDIOMA']);
        $ISSN = '';
        $DT['PUBLICACAO'] = 0;
        $DT['ABRANGENCIA'] = '-';
        $DT['CIDADE'] = $this->cidade($te['DETALHAMENTO-DO-CAPITULO']['@attributes']['CIDADE-DA-EDITORA']);

        $this->save_work($DT, $idcv);
    }

    function trabalho_evento($idcv, $lattes, $te)
    {
        $auth = $this->autores($te['AUTORES']);
        $DT['AUTORES'] = $auth[0];
        $DT['AUTORES_NR'] = $auth[1];
        $DT['NATUREZA'] = 'EVE';
        $DT['TIPO']     = $this->outros($te['DADOS-BASICOS-DO-TRABALHO']['@attributes']['NATUREZA']);
        $DT['TITULO']   = $te['DADOS-BASICOS-DO-TRABALHO']['@attributes']['TITULO-DO-TRABALHO'];
        $DT['ANO']      = $te['DADOS-BASICOS-DO-TRABALHO']['@attributes']['ANO-DO-TRABALHO'];
        $DT['PAIS']     = $this->pais($te['DADOS-BASICOS-DO-TRABALHO']['@attributes']['PAIS-DO-EVENTO']);
        $DT['IDIOMA']   = $this->idioma($te['DADOS-BASICOS-DO-TRABALHO']['@attributes']['IDIOMA']);
        $DT['PUBLICACAO'] = $this->publicacao($te['DETALHAMENTO-DO-TRABALHO']['@attributes']['TITULO-DOS-ANAIS-OU-PROCEEDINGS']);
        $DT['ABRANGENCIA'] = $this->abrangencia($te['DETALHAMENTO-DO-TRABALHO']['@attributes']['CLASSIFICACAO-DO-EVENTO']);
        $DT['CIDADE'] = $this->cidade($te['DETALHAMENTO-DO-TRABALHO']['@attributes']['CIDADE-DA-EDITORA']);

        $this->save_work($DT, $idcv);
    }

    function publicacao($t, $issn = '')
    {
        if (strlen(trim($t)) == 0) {
            return (0);
        }
        if (strlen($t) > 255) {
            $t = substr($t, 0, 250) . '...';
        }
        $t = troca($t, "'", "´");
        $sql = "select * from lattes_publicacao where p_name = '$t'";
        if (strlen($issn) > 0) {
            $issn = troca($issn, '-', '');
            $sql .= " OR p_issn = '$issn' ";
        }
        $rlt = $this->db->query($sql);
        $rlt = $rlt->result_array();
        if (count($rlt) == 0) {
            $sqlx = "insert into lattes_publicacao (p_name, p_issn) values ('$t','$issn') ";
            $rltx = $this->db->query($sqlx);
            $rlt = $this->db->query($sql);
            $rlt = $rlt->result_array();
        }
        return ($rlt[0]['id_p']);
    }

    function pais($t)
    {
        if (strlen(trim($t)) == 0) {
            return (0);
        }
        $t = troca($t, "'", "´");
        $sql = "select * from lattes_pais where p_name = '$t'";
        $rlt = $this->db->query($sql);
        $rlt = $rlt->result_array();
        if (count($rlt) == 0) {
            $sqlx = "insert into lattes_pais (p_name) values ('$t') ";
            $rltx = $this->db->query($sqlx);
            $rlt = $this->db->query($sql);
            $rlt = $rlt->result_array();
        }
        return ($rlt[0]['id_p']);
    }

    function cidade($t)
    {
        if (strlen(trim($t)) == 0) {
            return (0);
        }
        if (strlen($t) > 50) {
            $t = substr($t, 0, 45) . '...';
        }
        $t = troca($t, "'", "´");
        $sql = "select * from lattes_cidade where p_name = '$t'";
        $rlt = $this->db->query($sql);
        $rlt = $rlt->result_array();
        if (count($rlt) == 0) {
            $sqlx = "insert into lattes_cidade (p_name) values ('$t') ";
            $rltx = $this->db->query($sqlx);
            $rlt = $this->db->query($sql);
            $rlt = $rlt->result_array();
        }
        return ($rlt[0]['id_p']);
    }
    function outros($t)
    {
        if (strlen($t) > 255) {
            $t = substr($t, 0, 250) . '...';
        }
        if (strlen(trim($t)) == 0) {
            return (0);
        }
        $t = troca($t, "'", "´");
        $sql = "select * from lattes_outros where p_name = '$t'";
        $rlt = $this->db->query($sql);
        $rlt = $rlt->result_array();
        if (count($rlt) == 0) {
            $sqlx = "insert into lattes_outros (p_name) values ('$t') ";
            $rltx = $this->db->query($sqlx);
            sleep(1);
            $rlt = $this->db->query($sql);
            $rlt = $rlt->result_array();
        }
        return ($rlt[0]['id_p']);
    }

    function idioma($t)
    {
        return ($this->outros($t));
    }

    function abrangencia($t)
    {
        switch ($t) {
            case 'NACIONAL':
                $t = 'N';
                break;
            case 'INTERNACIONAL':
                $t = 'I';
                break;
            case 'REGIONAL':
                $t = 'R';
                break;
            case 'LOCAL':
                $t = 'R';
                break;
            case 'NAO_INFORMADO':
                $t = '-';
                break;
            default:
                echo "OPS - abrangencia - " . $t;
                exit;
        }
        return ($t);
    }

    function excluir_producao($idcv)
    {
        $sql = "delete FROM lattes_producao where p_cv = $idcv";
        $rlt = $this->db->query($sql);
    }

    function save_work($DT, $idcv)
    {
        $NATUREZA = $DT['NATUREZA'];
        $TITULO = troca($DT['TITULO'], "'", "´");
        $NATUREZA = $DT['NATUREZA'];
        $PUBLICACAO = $DT['PUBLICACAO'];
        $CIDADE = $DT['CIDADE'];
        $TIPO = $DT['TIPO'];
        $ANO = $DT['ANO'];
        $PAIS = $DT['PAIS'];
        $AUTORES = $DT['AUTORES'];
        $NATUREZA = $DT['NATUREZA'];
        $ABRANGENCIA = $DT['ABRANGENCIA'];
        $IDIOMA = $DT['IDIOMA'];
        if (isset($DT['FINALIDADE'])) {
            $FINALIDADE = $DT['FINALIDADE'];
        } else {
            $FINALIDADE = 0;
        }


        $sql = "select * from lattes_producao
                    where p_cv = $idcv and p_nat = '$NATUREZA' and p_titulo = '$'";
        $rlt = $this->db->query($sql);
        $rlt = $rlt->result_array();

        if (count($rlt) == 0) {
            $sql = "insert into lattes_producao
                        (
                            p_cv, p_nat, p_titulo,
                            p_tipo, p_ano, p_pais,
                            p_idioma, p_abrangencia, p_publicacao,
                            p_cidade, p_autores, p_finalidade
                        )
                        values
                        (
                            $idcv, '$NATUREZA', '$TITULO',
                            '$TIPO','$ANO','$PAIS',
                            '$IDIOMA','$ABRANGENCIA','$PUBLICACAO',
                            $CIDADE,'$AUTORES',$FINALIDADE
                        )";
            $this->db->query($sql);
        }
    }
    /*************************** PROCESSAR DADOS GERAIS CV *************/
    function processar_producao_tecnica($cv, $idcv, $lattes)
    {
        $rdf = new rdf;
        if (isset($cv['PRODUCAO-TECNICA'])) {
            $dg = $cv['PRODUCAO-TECNICA'];
            if (isset($dg['SOFTWARE'])) {
                /* Software */
                for ($r = 0; $r < count($dg['SOFTWARE']); $r++) {
                    if (isset($dg['SOFTWARE'][0])) {
                        $soft = $dg['SOFTWARE'][$r];
                    } else {
                        $soft = $dg['SOFTWARE'];
                    }

                    $this->software($idcv, $soft);
                }
            }

            if (isset($dg['PATENTE'])) {
                /* Patentes */
                for ($r = 0; $r < count($dg['PATENTE']); $r++) {
                    if (isset($dg['PATENTE'][0])) {
                        $patent = $dg['PATENTE'][$r];
                    } else {
                        $patent = $dg['PATENTE'];
                    }
                    $this->patente($idcv, $patent);
                }
            }
            if (isset($dg['DESENHO-INDUSTRIAL'])) {
                /* Desenho Industrial */
                for ($r = 0; $r < count($dg['DESENHO-INDUSTRIAL']); $r++) {
                    if (isset($dg['DESENHO-INDUSTRIAL'][0])) {
                        $DI = $dg['DESENHO-INDUSTRIAL'][$r];
                    } else {
                        $DI = $dg['DESENHO-INDUSTRIAL'];
                    }
                    $this->desenho_industrial($idcv, $DI);
                }
            }
                //print_r($dg);
                //technological product
            ;
            if (isset($dg['PRODUTO-TECNOLOGICO'])) {
                /* Desenho Industrial */
                for ($r = 0; $r < count($dg['PRODUTO-TECNOLOGICO']); $r++) {
                    if (isset($dg['PRODUTO-TECNOLOGICO'][0])) {
                        $DI = $dg['PRODUTO-TECNOLOGICO'][$r];
                    } else {
                        $DI = $dg['PRODUTO-TECNOLOGICO'];
                    }
                    $this->produto_tecnologico($idcv, $DI);
                }
            }
        }
    }
    function software($idcv, $te)
    {
        $auth = $this->autores($te['AUTORES']);
        $DT['AUTORES'] = $auth[0];
        $DT['AUTORES_NR'] = $auth[1];
        $DT['NATUREZA'] = 'SOF';
        $DT['TIPO']     = $this->outros($te['DADOS-BASICOS-DO-SOFTWARE']['@attributes']['NATUREZA']);
        $DT['TITULO']   = $te['DADOS-BASICOS-DO-SOFTWARE']['@attributes']['TITULO-DO-SOFTWARE'];
        $DT['ANO']      = $te['DADOS-BASICOS-DO-SOFTWARE']['@attributes']['ANO'];
        $DT['PAIS']     = $this->pais($te['DADOS-BASICOS-DO-SOFTWARE']['@attributes']['PAIS']);
        $DT['IDIOMA']   = $this->idioma($te['DADOS-BASICOS-DO-SOFTWARE']['@attributes']['IDIOMA']);
        $DT['PUBLICACAO'] = $this->publicacao($te['DETALHAMENTO-DO-SOFTWARE']['@attributes']['PLATAFORMA']);
        $DT['ABRANGENCIA'] = 0;
        $DT['FINALIDADE'] = $this->outros($te['DETALHAMENTO-DO-SOFTWARE']['@attributes']['FINALIDADE']);
        $DT['CIDADE'] = 0;
        //[REGISTRO-OU-PATENTE]
        $this->save_work($DT, $idcv);
    }

    function patente($idcv, $te)
    {
        $auth = $this->autores($te['AUTORES']);
        $DT['AUTORES'] = $auth[0];
        $DT['AUTORES_NR'] = $auth[1];
        $DT['NATUREZA'] = 'PAT';
        $DT['TIPO']     = $this->outros($te['DETALHAMENTO-DA-PATENTE']['REGISTRO-OU-PATENTE']['@attributes']['TIPO-PATENTE']);
        $DT['TITULO']   = $te['DADOS-BASICOS-DA-PATENTE']['@attributes']['TITULO'];
        $DT['ANO']      = $te['DADOS-BASICOS-DA-PATENTE']['@attributes']['ANO-DESENVOLVIMENTO'];
        $DT['PAIS']     = $this->pais($te['DADOS-BASICOS-DA-PATENTE']['@attributes']['PAIS']);
        $DT['IDIOMA']   = '';
        $DT['PUBLICACAO'] = $this->publicacao($te['DETALHAMENTO-DA-PATENTE']['REGISTRO-OU-PATENTE']['@attributes']['INSTITUICAO-DEPOSITO-REGISTRO']);
        $DT['ABRANGENCIA'] = 0;
        $DT['FINALIDADE'] = $this->outros($te['DETALHAMENTO-DA-PATENTE']['REGISTRO-OU-PATENTE']['@attributes']['TIPO-PATENTE']);
        $DT['CIDADE'] = 0;
        //[REGISTRO-OU-PATENTE]
        $this->save_work($DT, $idcv);
    }

    function produto_tecnologico($idcv, $te)
    {
        $auth = $this->autores($te['AUTORES']);
        $DT['AUTORES'] = $auth[0];
        $DT['AUTORES_NR'] = $auth[1];
        $DT['NATUREZA'] = 'TEC';
        $DT['TIPO']     = $this->outros($te['DADOS-BASICOS-DO-PRODUTO-TECNOLOGICO']['@attributes']['TIPO-PRODUTO']);
        $DT['TITULO']   = $te['DADOS-BASICOS-DO-PRODUTO-TECNOLOGICO']['@attributes']['TITULO-DO-PRODUTO'];
        $DT['ANO']      = $te['DADOS-BASICOS-DO-PRODUTO-TECNOLOGICO']['@attributes']['ANO'];
        $DT['PAIS']     = $this->pais($te['DADOS-BASICOS-DO-PRODUTO-TECNOLOGICO']['@attributes']['PAIS']);
        $DT['IDIOMA']   = $this->idioma($te['DADOS-BASICOS-DO-PRODUTO-TECNOLOGICO']['@attributes']['IDIOMA']);
        $DT['PUBLICACAO'] = $this->publicacao($te['DETALHAMENTO-DO-PRODUTO-TECNOLOGICO']['@attributes']['DISPONIBILIDADE']);
        $DT['ABRANGENCIA'] = 0;
        $DT['FINALIDADE'] = $this->outros($te['DADOS-BASICOS-DO-PRODUTO-TECNOLOGICO']['@attributes']['NATUREZA']);
        $DT['CIDADE'] = $this->cidade($te['DETALHAMENTO-DO-PRODUTO-TECNOLOGICO']['@attributes']['CIDADE-DO-PRODUTO']);
        $this->save_work($DT, $idcv);
    }

    function desenho_industrial($idcv, $te)
    {
        $auth = $this->autores($te['AUTORES']);
        $DT['AUTORES'] = $auth[0];
        $DT['AUTORES_NR'] = $auth[1];
        $DT['NATUREZA'] = 'IDS';
        $DT['TIPO']     = $this->outros($te['DADOS-BASICOS-DO-PRODUTO-TECNOLOGICO']['@attributes']['TIPO-PRODUTO']);
        $DT['TITULO']   = $te['DADOS-BASICOS-DO-PRODUTO-TECNOLOGICO']['@attributes']['TITULO-DO-PRODUTO'];
        $DT['ANO']      = $te['DADOS-BASICOS-DO-PRODUTO-TECNOLOGICO']['@attributes']['ANO'];
        $DT['PAIS']     = $this->pais($te['DADOS-BASICOS-DO-PRODUTO-TECNOLOGICO']['@attributes']['PAIS']);
        $DT['IDIOMA']   = $this->idioma($te['DADOS-BASICOS-DO-PRODUTO-TECNOLOGICO']['@attributes']['IDIOMA']);
        $DT['PUBLICACAO'] = $this->publicacao($te['DETALHAMENTO-DO-PRODUTO-TECNOLOGICO']['@attributes']['DISPONIBILIDADE']);
        $DT['ABRANGENCIA'] = 0;
        $DT['FINALIDADE'] = $this->outros($te['DADOS-BASICOS-DO-PRODUTO-TECNOLOGICO']['@attributes']['NATUREZA']);
        $DT['CIDADE'] = $this->cidade($te['DETALHAMENTO-DO-PRODUTO-TECNOLOGICO']['@attributes']['CIDADE-DO-PRODUTO']);
        $this->save_work($DT, $idcv);
    }
}
