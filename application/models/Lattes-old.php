<?php
class lattes extends CI_Model {
    var $limit = 4;
    var $dados;

    function v($id=0)
    {
        $rdf = new rdf;
        $data = $rdf->le($id);
        if (count($data) == 0)
        {
            $class = 'NULL';
        } else {
            $class = trim($data['c_class']);
        }
        switch($class)
        {
            case 'NULL':
            $sx = '<h1>404 - Not Found</h1>';
            break;
            case 'Person':
            $data = array();
            $data['id'] = round($id);
            $sx = $this->load->view('redd/perfil',$data,true);
            $sx .= $rdf->show_data($id);
            break;

            default:
            $sx = '<h5>Default Class Show</h5>';
            $sx .= $rdf->show_data($id);
            break;
        }
        return($sx);
    }

    function zip_register()
    {
        $dir = '__lattes/Lattes/';
        if (!is_dir($dir))
        {
            $sx = 'Diretório '.$dir.' não localizado no servidor';
            return($sx);
        }
        $rlt = scandir($dir);
        $sx = '';
        for ($rq=0;$rq < count($rlt);$rq++)
        {
            $file = $dir . $rlt[$rq];
            if (file_exists($file) and (strpos($file,'.zip') > 0))
            {
                $nr = sonumero($file);
                $sql = "select * from researcher WHERE r_lattes = '$nr'";
                $rlt2 = $this->db->query($sql);
                $rlt2 = $rlt2->result_array();
                if (count($rlt2) == 0)
                {
                    $lk = 'http://lattes.cnpq.br/'.$nr;
                    $sql = "insert into researcher
                    (r_name, r_xml, r_lattes, r_status, r_lattes_id)
                    values
                    ('# sem importação #','$lk','$lk',1,'$nr')";
                    $rlt2 = $this->db->query($sql);
                    $sx .= '<br>'.$nr.' Inserido';
                }
            }
        }
        return($sx);
    }

    function qualis_inport($file) {
        $sx = file_get_contents($file);
        $sx = utf8_encode($sx);
        $sx = troca($sx, ';', '.,');
        $sx = troca($sx, '"', '');
        $sx = troca($sx, chr(9), '¢');
        $sx = troca($sx, chr(13), ';');
        $sx = troca($sx, chr(10), ';');
        $ln = splitx(";", $sx);
        $area = 1;
        $data = date("Y-m-d");
        $ano = '2016';

        $sx = '<tt>';
        for ($r = 1; $r < count($ln); $r++) {
            $lns = $ln[$r];
            $lns = troca($lns, '¢', ';');
            $l = splitx(';', $lns);

            $issn = $l[0];
            $qualis = $l[2];
            $jname = $l[1];
            $sql = "select * from capes_qualis where cq_issn = '$issn' and cq_area = $area";
            $rlt = $this -> db -> query($sql);
            $rlt = $rlt -> result_array();
            if (count($rlt) == 0) {
                $sql = "insert into capes_qualis
                (cq_issn, cq_ano, cq_qualis, cq_update, cq_area)
                values
                ('$issn','$ano','$qualis','$data','$area')";
                $rlt = $this -> db -> query($sql);
                $sx .= $issn . ' - ' . $qualis . ' - ' . $jname . ' - <span style="color: green;"><b>Inserido</b></span><br>';
            } else {
                $sx .= $issn . ' - ' . $qualis . ' - ' . $jname . ' - <span style="color: grey;"><b>Update</b></span><br>';
            }
        }
        $sx .= '</tt>';
        return ($sx);
    }

    function row_qualis($id = '') {
        /* Lista de comunicacoes anteriores */
        $form = new form;
        $form -> tabela = '(select * from capes_qualis 
        inner join journals ON j_issn = cq_issn) as tabela ';
        $form -> see = true;
        $form -> edit = True;
        $form -> novo = False;

        $form -> row_edit = base_url('index.php/redd/qualis');
        $form -> row_view = base_url('index.php/redd/qualis');
        $form -> row = base_url('index.php/redd/qualis/');

        $form -> fd = array('id_cq', 'cq_issn', 'j_name', 'cq_ano', 'cq_qualis');
        $form -> lb = array('ID', 'ISSN', 'Journal', 'Ano', 'Qualis');
        $form -> mk = array('', 'L', 'L', 'C', 'C');

        $sx = row($form, $id);
        return ($sx);
    }

    function lista_publicacoes($id, $type = 'ARTIG') {

        $limit = (date("Y") - $this -> limit);
        $wh = '1=1';
        $wha = " AND ((ap_ano >= $limit) or (ap_main = 'S'))";
        
        if (is_array($id)) 
        {
            $wh = '';
            for ($r = 0; $r < count($id); $r++) {
                if (strlen($wh) > 0) { $wh .= ' OR '; }
                $wh .= '( ap_autor = ' . $id[$r] . ')';
            }
        } else {
            if (strlen($id) > 0) {
                $wh = " ap_autor = '$id' ";
            }
        }

//        ap_autor = '$id'

        $sql = "select * from artigo_publicado 
            INNER JOIN journals ON ap_journal_id = id_j 
            LEFT JOIN capes_qualis ON cq_issn = j_issn and cq_area = 1
            WHERE ($wh) AND (ap_tipo = '$type') $wha 
            ORDER BY ap_ano DESC, ap_autores ";

        $rlt = $this -> db -> query($sql);
        $rlt = $rlt -> result_array();
        $sx = '<h2>' . msg('tit_' . $type) . '</h2>' . cr();
        $sx .= '<table class="table" width="100%">' . cr();
        $key = '';

        for ($r = 0; $r < count($rlt); $r++) {
            $line = $rlt[$r];

            $key .= trim($line['ap_keywords']) . ';';
            $sx .= '<tr valign="top">';

            $sx .= '<td style="padding: 4px;">';
            $sx .= $line['ap_ano'];
            $sx .= '</td>';

            $sx .= '<td style="padding: 4px;">';
            if ($line['ap_main'] == 'S') {
                $sx .= '&nbsp;*&nbsp;';
            } else {
                $sx .= '&nbsp; &nbsp;';
            }

            $sx .= '</td>';

            $sx .= '<td style="padding: 4px;">';
            $sx .= trim($line['ap_autores']);
            $sx .= '.</td><td>';
            $tit = trim($line['ap_titulo']);
            $sx .= $tit;
            $sx .= '. ';
            $sx .= '.</td><td>';
            $sx .= '<b>' . trim($line['j_name']) . '</b>';
            $sx .= '.</td><td>';
            if (strlen(trim($line['ap_serie'])) > 0) {
                $nr = $line['ap_serie'];
                $nr = trim(troca($nr, 'n.', ''));
                $sx .= ', ';
                $sx .= 'n. ' . $nr;
            }
            $sx .= 'v. ' . $line['ap_vol'];
            $sx .= ', ';
            $sx .= $line['ap_ano'] . '.';
            $sx .= '.</td><td>';            
            if ($line['j_issn'] != '') {
                //$sx .= ' ISSN ' . $line['j_issn'];
            }
            $sx .= '</td>';

            $sx .= '<td align="center">'.$line['cq_qualis'].'</td>';

            $sx .= '</tr>' . cr();
        }
        $sx .= '</table>' . cr();
        return ($sx);

    }

    /* LIVROS-E-CAPITULOS */
    function livros_capitulos($dd) {
        $titulo = $dd['TITULO-DO-ARTIGO'];
        $ano = $dd['ANO-DO-ARTIGO'];
        $jid = $dd['IDJ'];
        $ano = $dd['ANO-DO-ARTIGO'];
        $idioma = $this -> idioma($dd['IDIOMA']);
        $nr = $dd['SERIE'];
        $vol = $dd['VOLUME'];
        $ida = $dd['ID'];
        $keyword = $dd['KEYWORDS'];

        $autores = '';
        for ($r = 0; $r < count($dd['AUTORES']); $r++) {
            $dda = $dd['AUTORES'][$r];
            $auto = nbr_autor($dda['NOME-COMPLETO-DO-AUTOR'], 5);
            if (strlen($autores) > 0) {
                $autores .= '; ';
            }
            $autores .= $auto;
        }

        $keys = '';
        for ($r = 0; $r < count($keyword); $r++) {
            if (strlen($keyword[$r]) > 0) {
                if (strlen($keys) > 0) { $keys .= '; '; }
                $keys .= trim($keyword[$r]);
            }
        }
        if (strlen($keys) > 0) { $keys .= '.'; }

        $titulo = troca($titulo, "'", "´");
        $keys = troca($keys, "'", "´");
        $sql = "insert into artigo_publicado
        (
        ap_journal_id, ap_ano, ap_titulo,
        ap_idioma, ap_vol, ap_serie,
        ap_autores, ap_autor, ap_keywords
        ) values (
        '$jid','$ano','$titulo',
        '$idioma','$vol','$nr',
        '$autores','$ida','$keys' )";
        $rlt = $this -> db -> query($sql);
    }

    function evento_publicado($dd) {

        $titulo = $dd['TITULO-DO-ARTIGO'];
        $ano = $dd['ANO-DO-ARTIGO'];
        $jid = $dd['IDJ'];
        $ano = $dd['ANO-DO-ARTIGO'];
        $idioma = $this -> idioma($dd['IDIOMA']);
        $nr = $dd['SERIE'];
        $vol = $dd['VOLUME'];
        $ida = $dd['ID'];
        $keyword = $dd['KEYWORDS'];

        $autores = '';
        for ($r = 0; $r < count($dd['AUTORES']); $r++) 
        {
            $dda = $dd['AUTORES'][$r];
            $auto = nbr_autor($dda['NOME-COMPLETO-DO-AUTOR'], 5);
            if (strlen($autores) > 0) 
            {
                $autores .= '; ';
            }
            $autores .= $auto;
        }

        $keys = '';
        for ($r = 0; $r < count($keyword); $r++) 
        {
            if (strlen($keyword[$r]) > 0) 
            {
                if (strlen($keys) > 0) { $keys .= '; ';
            }
            $keys .= trim($keyword[$r]);
        }
    }
    if (strlen($keys) > 0) { $keys .= '.';
}

$titulo = troca($titulo, "'", "´");
$keys = troca($keys, "'", "´");
$sql = "insert into artigo_publicado
(
ap_journal_id, ap_ano, ap_titulo,
ap_idioma, ap_vol, ap_serie,
ap_autores, ap_autor, ap_keywords
) values (
'$jid','$ano','$titulo',
'$idioma','$vol','$nr',
'$autores','$ida','$keys'
)";
$rlt = $this -> db -> query($sql);
}

function artigo_publicado($dd, $tipo) {

    $titulo = $dd['TITULO-DO-ARTIGO'];
    $ano = $dd['ANO-DO-ARTIGO'];
    $relevancia = $dd['FLAG-RELEVANCIA'];
    if (substr($relevancia, 0, 1) == 'S') {
        $relevancia = 'S';
    } else {
        $relevancia = '';
    }
    $jid = $dd['IDJ'];
    $ano = $dd['ANO-DO-ARTIGO'];
    $idioma = $this -> idioma($dd['IDIOMA']);
    $nr = $dd['SERIE'];
    $vol = $dd['VOLUME'];
    $ida = $dd['ID'];
    $keyword = $dd['KEYWORDS'];

    $autores = '';
    for ($r = 0; $r < count($dd['AUTORES']); $r++) {
        $dda = $dd['AUTORES'][$r];
        $auto = nbr_autor($dda['NOME-COMPLETO-DO-AUTOR'], 5);
        if (strlen($autores) > 0) {
            $autores .= '; ';
        }
        $autores .= $auto;
    }

    $keys = '';
    for ($r = 0; $r < count($keyword); $r++) {
        if (strlen($keyword[$r]) > 0) {
            if (strlen($keys) > 0) { $keys .= '; ';
        }
        $keys .= trim($keyword[$r]);
    }
}
if (strlen($keys) > 0) { $keys .= '.';
}

$titulo = troca($titulo, "'", "´");
$keys = troca($keys, "'", "´");
$sql = "insert into artigo_publicado
(
ap_journal_id, ap_ano, ap_titulo,
ap_idioma, ap_vol, ap_serie,
ap_autores, ap_autor, ap_keywords,
ap_tipo, ap_main
) values (
'$jid','$ano','$titulo',
'$idioma','$vol','$nr',
'$autores','$ida','$keys',
'$tipo', '$relevancia'
)";
$rlt = $this -> db -> query($sql);
}

function idioma($ido) {
    switch($ido) {
        case 'Português' :
        $ido = 'pt_BR';
        break;
        case 'Inglês' :
        $ido = 'en';
        break;
        case 'Alemão' :
        $ido = 'dk';
        break;
        case 'Francês' :
        $ido = 'fr';
        break;
        case 'Espanhol' :
        $ido = 'es';
        break;
        case 'Espanhol' :
        $ido = 'es';
        break;
        default :
        $ido = 'pt';
        break;
    }
    return ($ido);
}

function journal($name, $issn) {
    $name = troca($name, "'", '´');
    if (strlen($issn) > 0) {
        $issn = troca($issn, '-', '');
        $issn = substr($issn, 0, 4) . '-' . substr($issn, 4, 4);
    }
    $nr = $issn;
    if (strlen($nr) > 0) {
        $sql = "select * from journals where j_issn = '$nr' or j_issn_ol = '$nr' or j_issn_l = '$nr'";
        $rlt = $this -> db -> query($sql);
        $rlt = $rlt -> result_array();
        if (count($rlt) == 0) {
            $nr = '';
        } else {
            $line = $rlt[0];
            return ($line['id_j']);
        }
    }
    $name = troca($name, '/', '-');
    $sql = "select * from journals where j_name = '$name' ";
    $rlt = $this -> db -> query($sql);
    $rlt = $rlt -> result_array();
    if (count($rlt) == 0) {
        $sql = "insert into journals 
        ( j_name, j_issn, j_issn_ol, j_issn_l )
        values
        ( '$name', '$issn','','$issn');";
        $rlt = $this -> db -> query($sql);
        $sql = "select * from journals where j_name = '$name' ";
        $rlt = $this -> db -> query($sql);
        $rlt = $rlt -> result_array();
        $line = $rlt[0];
        return ($line['id_j']);
    } else {
        $line = $rlt[0];
        return ($line['id_j']);
    }
}

function authores($name, $abrev, $nri) {
    $nr = $nri;
    if (strlen($nr) > 0) {
        $sql = "select * from lt_autores where a_nr_id = '$nr' ";
        $rlt = $this -> db -> query($sql);
        $rlt = $rlt -> result_array();
        if (count($rlt) == 0) {
            $nr = '';
        } else {
            $line = $rlt[0];
            return ($line['id_a']);
        }
    }
    $sql = "select * from lt_autores where a_nome_completo = '$name' ";
    $rlt = $this -> db -> query($sql);
    $rlt = $rlt -> result_array();
    if (count($rlt) == 0) {
        $sql = "insert into lt_autores 
        ( a_nome_completo, a_nome_citacao, a_nr_id )
        values
        ( '$name', '$abrev','$nri');";
        $rlt = $this -> db -> query($sql);
        $sql = "select * from lt_autores where a_nome_completo = '$name' ";
        $rlt = $this -> db -> query($sql);
        $rlt = $rlt -> result_array();
        $line = $rlt[0];
        return ($line['id_a']);
    } else {
        $line = $rlt[0];
        return ($line['id_a']);
    }
}

function artigosExcluir($id) {
    $sql = "delete from artigo_publicado where ap_autor = '$id' ";
    $rlt = $this -> db -> query($sql);
    $sql = "delete from lt_orientacao where oo_nr_id = '$id' ";
    $rlt = $this -> db -> query($sql);
    return (1);
}

function readXML($link, $id, $harvesting = 0) {
    $prodb = array();
    $dir = '__lattes';
    $file = $dir . '/Lattes/' . $id . '.zip';

    if (!file_exists($file))
    {
        echo "Erro ao abrir o arquivo: ".$file;
        echo '<hr>';
        exit;
    }

    /*************************** Coletar dados *************/
    if ($harvesting == 1) {
        if (!is_dir($dir)) {
            mkdir($dir);
        }

        $fl = new curl($link);
        $fl -> execute();
        $xml_zip = $fl -> last_response;

        /* Save File */
        $rlt = fopen($file, 'w+');
        fwrite($rlt, $xml_zip, strlen($xml_zip));
        fclose($rlt);
    }

    /************************************* Descompactar *******/
    $zip = new ZipArchive;
    if (!$zip -> open($file) === TRUE) 
    {
        $zip -> extractTo($dir);
        $zip -> close();
    }

    $dt = array();
    $dt['id'] = $id;
    $this -> artigosExcluir($id);

    /* LE O XML */
    $dom = new DOMDocument("1.0", "ISO-8859-15");
    $dom -> preserveWhiteSpace = False;
    $dom -> load($dir . '/curriculo.xml');

    /* DADOS GERAIS */
    $cv = $dom -> getElementsByTagName("DADOS-GERAIS");
    foreach ($cv as $cvs) {
        $nome = $cvs -> getAttribute("NOME-COMPLETO");
        $dt['nome_completo'] = $nome;
        $dt['nascimento_cidade'] = $cvs -> getAttribute("CIDADE-NASCIMENTO");
        $dt['nascimento_pais'] = $cvs -> getAttribute("SIGLA-PAIS-NACIONALIDADE");
        $dt['nacionalidade_pais'] = $cvs -> getAttribute("PAIS-DE-NACIONALIDADE"); 
        $dt['nacionalidade_uf'] = $cvs -> getAttribute("UF-NASCIMENTO"); 
    } 

    $cv = $dom -> getElementsByTagName("CURRICULO-VITAE");
    foreach ($cv as $cvs) {
        $dta = $cvs -> getAttribute("DATA-ATUALIZACAO");
        $dta = substr($dta, 4, 4) . substr($dta, 2, 2) . substr($dta, 0, 2);
        $nid = $cvs -> getAttribute("NUMERO-IDENTIFICADOR");
        $dt['atualizado'] = $dta;
        while (strlen($nid) < 16) { $nid = '0' . $nid; }
        $dt['numero_id'] = $nid;
    }    

    $rdf = new rdf;
    /*****************************************************************************/
    $id_lattes = (string)$nid;
    $idc = $rdf->rdf_concept_create('LattesID',$id_lattes);

    /****************************************************************** Persona */
    $idp = $rdf->rdf_concept_create('Person',(string)$dt['nome_completo']);

    $prop = 'hasLattesId';
    $rdf->set_propriety($idp, $prop, $idc, $lit = 0);

    /****************************************************************** Nascimento */
    $id_place_city = 0;
    $id_place_UF = 0;
    $id_place_pais = 0;
    if (strlen((string)$dt['nascimento_cidade']) > 0)
    {
        $compl = ' ('.(string)$dt['nacionalidade_uf'].')';
        $id_place_city = $rdf->rdf_concept_create('Place',(string)$dt['nascimento_cidade'].$compl); 
    }
    if (strlen((string)$dt['nacionalidade_uf']) > 0)
        { $id_place_UF = $rdf->rdf_concept_create('Place',(string)$dt['nacionalidade_uf']); }
    if (strlen((string)$dt['nacionalidade_pais']) > 0)
        { $id_place_pais = $rdf->rdf_concept_create('Place',(string)$dt['nacionalidade_pais']); }

    if (($id_place_city > 0) and ($id_place_UF))
    {
        $prop = 'isPartOf';
        $rdf->set_propriety($id_place_city, $prop, $id_place_UF, $lit = 0);       
    }

    if (($id_place_pais > 0) and ($id_place_UF))
    {
        $prop = 'isPartOf';
        $rdf->set_propriety($id_place_UF, $prop, $id_place_pais, $lit = 0);
    }   
    
    if (($idp > 0) and ($id_place_city))
    {
        $prop = 'hasBorn';
        $rdf->set_propriety($idp, $prop, $id_place_city, $lit = 0);       
    }

    /***************************************************** Instituições ***********************/
    $f = array('GRADUACAO','MESTRADO','DOUTORADO');
    for ($i=0;$i < count($f);$i++)
    {
        $cv = $dom -> getElementsByTagName($f[$i]);
        foreach ($cv as $cvs) {  
            $dt_inst = (string)$cvs -> getAttribute("NOME-INSTITUICAO");
            if (strlen($dta) > 0)
            {            
                $id_inst = $rdf->rdf_concept_create('CorporateBody',$dt_inst);
                $msa = (string)$cvs -> getAttribute("CODIGO-INSTITUICAO");
                $idn = $rdf->frbr_name($msa);
                $rdf->set_propriety($id_inst, 'code', 0, $idn);
            }
            echo '<br>=instituição=>'.$dta;

            /* Agencia financiadora */            
            $dta = (string)$cvs -> getAttribute("NOME-AGENCIA");
            if (strlen($dta) > 0)
            {            
                $id_finan = $rdf->rdf_concept_create('CorporateBody',$dta);
                $msa = (string)$cvs -> getAttribute("CODIGO-AGENCIA-FINANCIADORA");
                $idn = $rdf->frbr_name($msa);
                $rdf->set_propriety($id_finan, 'code', 0, $idn);
            }
            echo '<br>=financiamento=>'.$dta;

            /* Curso **********************************/
            $dta = (string)$cvs -> getAttribute("NOME-CURSO");
            $dtac = (string)$cvs -> getAttribute("CODIGO-CURSO");
            $dtas = (string)$cvs -> getAttribute("STATUS-DO-CURSO");
            $tipo = (string)$cvs -> getAttribute("TIPO-MESTRADO");
            $tipo .= (string)$cvs -> getAttribute("TIPO-DOUTORADO");

            $curso = nbr_autor($f[$i],7).' '.$dta.' ('.$dt_inst.')';
            $id_curso = $rdf->rdf_concept_create('AcademicCourse',$curso);
            $idn = $rdf->frbr_name($dtac);
            $rdf->set_propriety($id_curso, 'code', 0, $idn);
            $rdf->set_propriety($id_inst, 'offerOf', $id_curso);
            

            /* Formação Persona **********************************/
            $titt  = (string)$cvs -> getAttribute("TITULO-DA-DISSERTACAO-TESE");
            $titt .= (string)$cvs -> getAttribute("TITULO-DO-TRABALHO-DE-CONCLUSAO-DE-CURSO");
            $dtano_i = (string)$cvs -> getAttribute("ANO-DE-INICIO");
            $dtano_f = (string)$cvs -> getAttribute("ANO-DE-CONCLUSAO");

            $dta_nome = nbr_autor($f[$i],7).' ' . $dta. ' - '.trim((string)$dt['nome_completo']);
            $formacao = $rdf->rdf_concept_create('AcademicDegree',$dta_nome);   
            $rdf->set_propriety($idp, 'graduated', $formacao);
            $rdf->set_propriety($formacao, 'degree', $id_curso);
            $tipof = $rdf->rdf_concept_create('AcademicDegreeType',nbr_autor($f[$i],7));   
            $rdf->set_propriety($id_curso, 'hasAcademicDegreeType', $tipof);            
                    //hasAcademicDegreeType
            //$rdf->set_propriety($formacao, 'graduated', $id_inst);

            /* Datas */
            if (strlen($dtano_i) > 0)
            {
               $dtini = $rdf->rdf_concept_create('Date',$dtano_i);   
               $rdf->set_propriety($formacao, 'started', $dtini);
           }
           if (strlen($dtano_f) > 0)
           {
               $dtfin = $rdf->rdf_concept_create('Date',$dtano_f);   
               $rdf->set_propriety($formacao, 'finish', $dtfin);             
           }

           if (strlen($titt) > 0)
           {
               $idtcc = $rdf->frbr_name($titt);   
               $rdf->set_propriety($formacao, 'hasTitle', 0, $idtcc);             
           }            

           echo '<br>=curso=>'.$idp.'=='.$id_curso;
       }
   }
   //exit;
   /* PRODUCAO BIBLIOGRAFICA */
   $artigo = $dom -> getElementsByTagName("ARTIGO-PUBLICADO");

   $I = 0;
   foreach ($artigo as $key => $vlr) {
    $seq = $vlr -> getAttribute("SEQUENCIA-PRODUCAO");
    $prodb[$I]['ID'] = $id;

    /**********************************************************************************/
    $art2 = $vlr -> getElementsByTagName("DADOS-BASICOS-DO-ARTIGO");
    foreach ($art2 as $nkey => $dta) {
        $prodb[$I]['NATUREZA'] = $dta -> getAttribute("NATUREZA");
        $prodb[$I]['TITULO-DO-ARTIGO'] = $dta -> getAttribute("TITULO-DO-ARTIGO");
        $prodb[$I]['ANO-DO-ARTIGO'] = $dta -> getAttribute("ANO-DO-ARTIGO");
        $prodb[$I]['IDIOMA'] = $dta -> getAttribute("IDIOMA");
        $prodb[$I]['MEIO-DE-DIVULGACAO'] = $dta -> getAttribute("MEIO-DE-DIVULGACAO");
        $prodb[$I]['HOME-PAGE-DO-TRABALHO'] = $dta -> getAttribute("HOME-PAGE-DO-TRABALHO");
        $prodb[$I]['FLAG-RELEVANCIA'] = $dta -> getAttribute("FLAG-RELEVANCIA");
        $prodb[$I]['FLAG-DIVULGACAO-CIENTIFICA'] = $dta -> getAttribute("FLAG-DIVULGACAO-CIENTIFICA");
    }

    /**********************************************************************************/
    $art2 = $vlr -> getElementsByTagName("DETALHAMENTO-DO-ARTIGO");
    foreach ($art2 as $nkey => $dta) {
        $prodb[$I]['TITULO-DO-PERIODICO-OU-REVISTA'] = $dta -> getAttribute("TITULO-DO-PERIODICO-OU-REVISTA");
        $prodb[$I]['ISSN'] = $dta -> getAttribute("ISSN");
        $prodb[$I]['VOLUME'] = $dta -> getAttribute("VOLUME");
        $prodb[$I]['SERIE'] = $dta -> getAttribute("SERIE");
        $prodb[$I]['PAGINA-INICIAL'] = $dta -> getAttribute("PAGINA-INICIAL");
        $prodb[$I]['PAGINA-FINAL'] = $dta -> getAttribute("PAGINA-FINAL");
        $prodb[$I]['IDJ'] = $this -> journal($dta -> getAttribute("TITULO-DO-PERIODICO-OU-REVISTA"), $dta -> getAttribute("ISSN"));
    }

    $prodb[$I]['AUTORES'] = array();
    $art2 = $vlr -> getElementsByTagName("AUTORES");
    $i = 0;
    foreach ($art2 as $nkey => $dta) {
        $nome = troca($dta -> getAttribute("NOME-COMPLETO-DO-AUTOR"), "'", "´");
        $nome_cita = troca($dta -> getAttribute("NOME-PARA-CITACAO"), "'", "´");
        $prodb[$I]['AUTORES'][$i]['NOME-COMPLETO-DO-AUTOR'] = $nome;
        $prodb[$I]['AUTORES'][$i]['NOME-PARA-CITACAO'] = $dta -> getAttribute("NOME-PARA-CITACAO");
        $prodb[$I]['AUTORES'][$i]['ORDEM-DE-AUTORIA'] = $dta -> getAttribute("ORDEM-DE-AUTORIA");
        $prodb[$I]['AUTORES'][$i]['NRO-ID-CNPQ'] = $dta -> getAttribute("NRO-ID-CNPQ");
        $prodb[$I]['AUTORES'][$i]['ID'] = $this -> authores($nome, $nome_cita, $dta -> getAttribute("NRO-ID-CNPQ"));
        $i++;
    }

    /*************************************************** PALAVRA-CHAVE ***********/

    $art2 = $vlr -> getElementsByTagName("PALAVRAS-CHAVE");
    $i = 0;
    $keys = array();
    foreach ($art2 as $nkey => $dta) {
        for ($n = 1; $n < 20; $n++) {
            $kk = $dta -> getAttribute("PALAVRA-CHAVE-" . $n);
            if (strlen($kk) > 0) {
                array_push($keys, $kk);
            }
        }
        $i++;
    }
    $prodb[$I]['KEYWORDS'] = $keys;
    $I++;
}
for ($r = 0; $r < count($prodb); $r++) {
    $ln = $prodb[$r];
    $this -> artigo_publicado($ln, 'ARTIG');
}

/*************************************************************************/
/* TRABALHOS-EM-EVENTOS                                                  */
$artigo = $dom -> getElementsByTagName("TRABALHO-EM-EVENTOS");

$I = 0;
foreach ($artigo as $key => $vlr) {
    $seq = $vlr -> getAttribute("SEQUENCIA-PRODUCAO");
    $prodb[$I]['ID'] = $id;

    /**********************************************************************************/
    $art2 = $vlr -> getElementsByTagName("DADOS-BASICOS-DO-TRABALHO");
    foreach ($art2 as $nkey => $dta) {
        $prodb[$I]['NATUREZA'] = $dta -> getAttribute("NATUREZA");
        $prodb[$I]['TITULO-DO-ARTIGO'] = $dta -> getAttribute("TITULO-DO-TRABALHO");
        $prodb[$I]['ANO-DO-ARTIGO'] = $dta -> getAttribute("ANO-DO-TRABALHO");
        $prodb[$I]['IDIOMA'] = $dta -> getAttribute("IDIOMA");
        $prodb[$I]['MEIO-DE-DIVULGACAO'] = $dta -> getAttribute("MEIO-DE-DIVULGACAO");
        $prodb[$I]['HOME-PAGE-DO-TRABALHO'] = $dta -> getAttribute("HOME-PAGE-DO-TRABALHO");
        $prodb[$I]['FLAG-RELEVANCIA'] = $dta -> getAttribute("FLAG-RELEVANCIA");
        $prodb[$I]['FLAG-DIVULGACAO-CIENTIFICA'] = $dta -> getAttribute("FLAG-DIVULGACAO-CIENTIFICA");
    }

    /**********************************************************************************/
    $art2 = $vlr -> getElementsByTagName("DETALHAMENTO-DO-TRABALHO");
    foreach ($art2 as $nkey => $dta) {
        $prodb[$I]['VOLUME'] = $dta -> getAttribute("VOLUME");
        $prodb[$I]['SERIE'] = $dta -> getAttribute("SERIE");
        $prodb[$I]['PAGINA-INICIAL'] = $dta -> getAttribute("PAGINA-INICIAL");
        $prodb[$I]['PAGINA-FINAL'] = $dta -> getAttribute("PAGINA-FINAL");
        $prodb[$I]['IDJ'] = $this -> journal($dta -> getAttribute("TITULO-DO-PERIODICO-OU-REVISTA"), $dta -> getAttribute("ISSN"));
        $prodb[$I]['NOME-DO-EVENTO'] = $dta -> getAttribute("NOME-DO-EVENTO");
        $prodb[$I]['IDJ'] = $this -> journal($dta -> getAttribute("NOME-DO-EVENTO"), $dta -> getAttribute("ISSN"));
    }

    $prodb[$I]['AUTORES'] = array();
    $art2 = $vlr -> getElementsByTagName("AUTORES");
    $i = 0;
    foreach ($art2 as $nkey => $dta) {
        $nome = troca($dta -> getAttribute("NOME-COMPLETO-DO-AUTOR"), "'", "´");
        $nome_cita = troca($dta -> getAttribute("NOME-PARA-CITACAO"), "'", "´");
        $prodb[$I]['AUTORES'][$i]['NOME-COMPLETO-DO-AUTOR'] = $nome;
        $prodb[$I]['AUTORES'][$i]['NOME-PARA-CITACAO'] = $dta -> getAttribute("NOME-PARA-CITACAO");
        $prodb[$I]['AUTORES'][$i]['ORDEM-DE-AUTORIA'] = $dta -> getAttribute("ORDEM-DE-AUTORIA");
        $prodb[$I]['AUTORES'][$i]['NRO-ID-CNPQ'] = $dta -> getAttribute("NRO-ID-CNPQ");
        $prodb[$I]['AUTORES'][$i]['ID'] = $this -> authores($nome, $nome_cita, $dta -> getAttribute("NRO-ID-CNPQ"));
        $i++;
    }

    /*************************************************** PALAVRA-CHAVE ***********/

    $art2 = $vlr -> getElementsByTagName("PALAVRAS-CHAVE");
    $i = 0;
    $keys = array();
    foreach ($art2 as $nkey => $dta) {
        for ($n = 1; $n < 20; $n++) {
            $kk = $dta -> getAttribute("PALAVRA-CHAVE-" . $n);
            if (strlen($kk) > 0) {
                array_push($keys, $kk);
            }
        }
        $i++;
    }
    $prodb[$I]['KEYWORDS'] = $keys;
    $I++;
}
for ($r = 0; $r < count($prodb); $r++) {
    $ln = $prodb[$r];
    $this -> artigo_publicado($ln, 'EVENT');
}

/*************************************************************************/
/* LIVROS-E-CAPITULOS                                                    */
$prodb = array();
$artigo = $dom -> getElementsByTagName("LIVRO-PUBLICADO-OU-ORGANIZADO");
$I = 0;
foreach ($artigo as $key => $vlr) {

    $seq = $vlr -> getAttribute("SEQUENCIA-PRODUCAO");
    $prodb[$I]['ID'] = $id;

    /**********************************************************************************/
    $art2 = $vlr -> getElementsByTagName("DADOS-BASICOS-DO-LIVRO");
    foreach ($art2 as $nkey => $dta) {

        $prodb[$I]['TIPO'] = $dta -> getAttribute("TIPO");
        $prodb[$I]['NATUREZA'] = $dta -> getAttribute("NATUREZA");
        $prodb[$I]['TITULO-DO-ARTIGO'] = $dta -> getAttribute("TITULO-DO-LIVRO");
        $prodb[$I]['ANO-DO-ARTIGO'] = $dta -> getAttribute("ANO");
        $prodb[$I]['IDIOMA'] = $dta -> getAttribute("IDIOMA");
        $prodb[$I]['MEIO-DE-DIVULGACAO'] = $dta -> getAttribute("MEIO-DE-DIVULGACAO");
        $prodb[$I]['HOME-PAGE-DO-TRABALHO'] = $dta -> getAttribute("HOME-PAGE-DO-TRABALHO");
        $prodb[$I]['FLAG-RELEVANCIA'] = $dta -> getAttribute("FLAG-RELEVANCIA");
        $prodb[$I]['FLAG-DIVULGACAO-CIENTIFICA'] = $dta -> getAttribute("FLAG-DIVULGACAO-CIENTIFICA");
    }

    /**********************************************************************************/
    $art2 = $vlr -> getElementsByTagName("DETALHAMENTO-DO-LIVRO");
    foreach ($art2 as $nkey => $dta) {
        $prodb[$I]['VOLUME'] = $dta -> getAttribute("VOLUME");
        $prodb[$I]['SERIE'] = $dta -> getAttribute("SERIE");
        $prodb[$I]['PAGINA-INICIAL'] = $dta -> getAttribute("PAGINA-INICIAL");
        $prodb[$I]['PAGINA-FINAL'] = $dta -> getAttribute("NUMERO-DE-PAGINAS");
        $prodb[$I]['IDJ'] = $this -> journal($dta -> getAttribute("TITULO-DO-PERIODICO-OU-REVISTA"), $dta -> getAttribute("ISSN"));
        $prodb[$I]['NOME-DO-EVENTO'] = $dta -> getAttribute("NOME-DA-EDITORA");
        $prodb[$I]['IDJ'] = $this -> journal($dta -> getAttribute("NOME-DA-EDITORA"), $dta -> getAttribute("ISBN"));
    }

    $prodb[$I]['AUTORES'] = array();
    $art2 = $vlr -> getElementsByTagName("AUTORES");
    $i = 0;
    foreach ($art2 as $nkey => $dta) {
        $nome = troca($dta -> getAttribute("NOME-COMPLETO-DO-AUTOR"), "'", "´");
        $nome_cita = troca($dta -> getAttribute("NOME-PARA-CITACAO"), "'", "´");
        $prodb[$I]['AUTORES'][$i]['NOME-COMPLETO-DO-AUTOR'] = $nome;
        $prodb[$I]['AUTORES'][$i]['NOME-PARA-CITACAO'] = $dta -> getAttribute("NOME-PARA-CITACAO");
        $prodb[$I]['AUTORES'][$i]['ORDEM-DE-AUTORIA'] = $dta -> getAttribute("ORDEM-DE-AUTORIA");
        $prodb[$I]['AUTORES'][$i]['NRO-ID-CNPQ'] = $dta -> getAttribute("NRO-ID-CNPQ");
        $prodb[$I]['AUTORES'][$i]['ID'] = $this -> authores($nome, $nome_cita, $dta -> getAttribute("NRO-ID-CNPQ"));
        $i++;
    }

    /*************************************************** PALAVRA-CHAVE ***********/

    $art2 = $vlr -> getElementsByTagName("PALAVRAS-CHAVE");
    $i = 0;
    $keys = array();
    foreach ($art2 as $nkey => $dta) {
        for ($n = 1; $n < 20; $n++) {
            $kk = $dta -> getAttribute("PALAVRA-CHAVE-" . $n);
            if (strlen($kk) > 0) {
                array_push($keys, $kk);
            }
        }
        $i++;
    }
    $prodb[$I]['KEYWORDS'] = $keys;
    $I++;
}

for ($r = 0; $r < count($prodb); $r++) {
    $ln = $prodb[$r];
    $this -> artigo_publicado($ln, 'LIVRO');
}

/************************* ORIENTACOES *****************/

$prodb = array();
$orientacoes = $dom -> getElementsByTagName("OUTRAS-ORIENTACOES-CONCLUIDAS");
$I = 0;

foreach ($orientacoes as $key => $vlr) {
    $seq = $vlr -> getAttribute("SEQUENCIA-PRODUCAO");

    $prodb[$I]['ID'] = $seq;

    /**********************************************************************************/
    $orx = $vlr -> getElementsByTagName("DADOS-BASICOS-DE-OUTRAS-ORIENTACOES-CONCLUIDAS");

    $NATUREZA = $vlr -> getAttribute("NATUREZA");
    $TITULO = $vlr -> getAttribute("TITULO");
    $ano = $vlr -> getAttribute("ANO");

    $prodb[$I]['Natureza'] = $NATUREZA;
    $prodb[$I]['titulo'] = $TITULO;
    $prodb[$I]['Tipo'] = 'Graduação';
    $prodb[$I]['ano'] = $ano;

    /**********************************************************************************/
    $orientacao = $vlr -> getElementsByTagName("DETALHAMENTO-DE-OUTRAS-ORIENTACOES-CONCLUIDAS");

    $ori = $vlr -> getAttribute("NOME-DO-ORIENTADO");
    $inst = $vlr -> getAttribute("NOME-DA-INSTITUICAO");
    $curso = $vlr -> getAttribute("NOME-DO-CURSO");
    $ano = $vlr -> getAttribute("ANO");
    $tipoo = $vlr -> getAttribute("TIPO-DE-ORIENTACAO");

    $prodb[$I]['Orientado'] = $ori;
    $prodb[$I]['Instituicao'] = $inst;
    $prodb[$I]['Curso'] = $curso;
    $prodb[$I]['TipoO'] = $tipoo;
    $I++;
}

/************************* ORIENTACOES MESTRADO *****************/

$orientacoes = $dom -> getElementsByTagName("ORIENTACOES-CONCLUIDAS-PARA-MESTRADO");

foreach ($orientacoes as $key => $vlr) {
    $seq = $vlr -> getAttribute("SEQUENCIA-PRODUCAO");
    $prodb[$I]['ID'] = $seq;
    /**********************************************************************************/
    $orientacao = $vlr -> getElementsByTagName("DADOS-BASICOS-DE-ORIENTACOES-CONCLUIDAS-PARA-MESTRADO");
    $NATUREZA = $vlr -> getAttribute("NATUREZA");
    $TIPO = $vlr -> getAttribute("TIPO");
    $TITULO = $vlr -> getAttribute("TITULO");
    $ano = $vlr -> getAttribute("ANO");

    $prodb[$I]['Natureza'] = $NATUREZA;
    $prodb[$I]['Tipo'] = $TIPO;
    $prodb[$I]['titulo'] = $TITULO;
    $prodb[$I]['ano'] = $ano;

    /**********************************************************************************/
    $orientacao = $vlr -> getElementsByTagName("DETALHAMENTO-DE-ORIENTACOES-CONCLUIDAS-PARA-MESTRADO");

    $ori = $vlr -> getAttribute("NOME-DO-ORIENTADO");
    $inst = $vlr -> getAttribute("NOME-DA-INSTITUICAO");
    $curso = 'PPG ' . $vlr -> getAttribute("NOME-DO-CURSO");
    $ano = $vlr -> getAttribute("ANO");
    $tipoo = $vlr -> getAttribute("TIPO-DE-ORIENTACAO");

    $prodb[$I]['Orientado'] = $ori;
    $prodb[$I]['Instituicao'] = $inst;
    $prodb[$I]['Curso'] = $curso;
    $prodb[$I]['TipoO'] = $tipoo;
    $I++;
}

/************************* ORIENTACOES DOUTORADO *****************/

$orientacoes = $dom -> getElementsByTagName("ORIENTACOES-CONCLUIDAS-PARA-DOUTORADO");
foreach ($orientacoes as $key => $vlr) {
    $seq = $vlr -> getAttribute("SEQUENCIA-PRODUCAO");
    $prodb[$I]['ID'] = $seq;
    /**********************************************************************************/
    $orientacao = $vlr -> getElementsByTagName("DADOS-BASICOS-DE-ORIENTACOES-CONCLUIDAS-PARA-DOUTORADO");
    $NATUREZA = $vlr -> getAttribute("NATUREZA");
    $TIPO = $vlr -> getAttribute("TIPO");
    $TITULO = $vlr -> getAttribute("TITULO");
    $ano = $vlr -> getAttribute("ANO");

    $prodb[$I]['Natureza'] = $NATUREZA;
    $prodb[$I]['Tipo'] = $TIPO;
    $prodb[$I]['titulo'] = $TITULO;
    $prodb[$I]['ano'] = $ano;

    /**********************************************************************************/
    $orientacao = $vlr -> getElementsByTagName("DETALHAMENTO-DE-ORIENTACOES-CONCLUIDAS-PARA-DOUTORADO");

    $ori = $vlr -> getAttribute("NOME-DO-ORIENTADO");
    $inst = $vlr -> getAttribute("NOME-DA-INSTITUICAO");
    $curso = 'PPG ' . $vlr -> getAttribute("NOME-DO-CURSO");
    $ano = $vlr -> getAttribute("ANO");
    $tipoo = $vlr -> getAttribute("TIPO-DE-ORIENTACAO");

    $prodb[$I]['Orientado'] = $ori;
    $prodb[$I]['Instituicao'] = $inst;
    $prodb[$I]['Curso'] = $curso;
    $prodb[$I]['TipoO'] = $tipoo;
    $I++;
}

foreach ($prodb as $key => $ln) {
    $nat = $ln['Natureza'];
    $tit = $ln['titulo'];
    $tip = $ln['Tipo'];
    $ano = $ln['ano'];
    $ori = $ln['Orientado'];
    $ins = $ln['Instituicao'];
    $cur = $ln['Curso'];
    $tio = $ln['TipoO'];

    $sql = "insert into lt_orientacao
    ( oo_natureza, oo_titulo, oo_tipo, oo_ano, oo_orientado, oo_instituicao, oo_curso, oo_nr_id, oo_tipo_ori)
    value ( '$nat','$tit','$tip', '$ano','$ori','$ins', '$cur','$id', '$tio')";
    $rlt = $this -> db -> query($sql);
}

if (!isset($artigo))
    { $artigo = array(); }
$dt['artigos'] = $artigo;
return ($dt);
}

function orientacao_list($id = '') {
    $wh = '1=1';
    if (is_array($id)) {
        $wh = '';
        for ($r = 0; $r < count($id); $r++) {
            if (strlen($wh) > 0) { $wh .= ' OR ';
        }
        $wh .= "( oo_nr_id = '" . $id[$r] . "')";
    }
} else {
    if (strlen($id) > 0) {
        $wh = " oo_nr_id = '$id' ";
    }
}


$sql = "select * from lt_orientacao where $wh order by oo_natureza, oo_ano desc, oo_curso";
$rlt = $this -> db -> query($sql);
$rlt = $rlt -> result_array();
$sx = '<table class="table" width="100%">';
$xano = 0;
$xtio = '';
$n = 0;
for ($r = 0; $r < count($rlt); $r++) {
    $ln = $rlt[$r];
    $tio = $ln['oo_natureza'];
    $ano = $ln['oo_ano'];

    if ($xtio != $tio) {
        $sx .= '<tr><td colspan=2><h2>' . msg($tio) . '</h2></td><td valign="bottom"></td></tr>';
        $xtio = $tio;
        $n = 1;
        $xano = 0;
        $nr = 1;
    }
    if ($xano != $ano) {
        $sx .= '<tr><td width="50">' . $ln['oo_ano'] . '</td>';
        $xano = $ano;
    } else {
        $sx .= '<tr><td width="50">&nbsp;</td>';
    }

    $sx .= '<td>' . $ln['oo_tipo'];
    $sx .= ' ' . $ln['oo_curso'];
    $sx .= ' - <i>' . $ln['oo_orientado'] . '</i> ';
    $sx .= ' - (' . trim($ln['oo_instituicao']) . ')';

    if (strlen($ln['oo_tipo_ori']) > 0) {
        $sx .= ' - ' . msg($ln['oo_tipo_ori']);
    }
    $sx .= '</td><td>' . ($n++);
    $sx .= '</td></tr>';
}
$sx .= '</table>';
return ($sx);
}

function orientacao($id = '', $anoi = 2015, $anof = 2019) {
    if (is_array($id)) {
        $wh = '';
        for ($r = 0; $r < count($id); $r++) {
            if (strlen($wh) > 0) { $wh .= ' OR ';
        }
        $wh .= "( oo_nr_id = '".$id[$r]."')";
    }
} else {
    $wh = " oo_nr_id = '$id' ";
}

$sql = "select count(*) as total, oo_natureza, oo_ano from lt_orientacao 
where $wh 
and ((oo_ano >= $anoi) and (oo_ano <= $anof))
group by oo_curso, oo_natureza, oo_ano
order by oo_natureza, oo_ano, oo_curso";

$rlt = $this -> db -> query($sql);
$rlt = $rlt -> result_array();
$p = array();
for ($r = 0; $r < count($rlt); $r++) {
    $ln = $rlt[$r];
    $ano = $ln['oo_ano'];
    $nat = msg($ln['oo_natureza']);
    $total = $ln['total'];

    $p[$ano][$nat] = $total;
}

$sxx = '';
$cor = array();
$cor['Tese'] = '#2E9AFE';
$cor['Dissertação'] = '#81DAF5';
$cor['Iniciação'] = '#F7D358';
$cor['TCC'] = '#DBA901';
        //$cor['Orientações'] = '#ff80ff';

$sx = '<table class="table">';
$sx .= '<tr><td colspan="10"><h4>Orientações</h4></td></tr>';
$sx .= '$head';
$sx .= '<tr>';
for ($r = $anoi; $r <= $anof; $r++) {
    $sxx .= '<td width="100">' . $r . '</td>';
    if (isset($p[$r])) {
        $sx .= '<td>';
        foreach ($p[$r] as $key => $value) {
            $scor = substr($key, 0, strpos($key, ' '));
            $xcor = '#ffffff';
            if (isset($cor[$scor])) {
                $xcor = $cor[$scor];
                switch($scor) {
                    case 'Iniciação' :
                    $sname = 'IC';
                    break;
                    case 'Tese' :
                    $sname = 'TESE';
                    break;
                    case 'Dissertação' :
                    $sname = 'MEST.';
                    break;
                    case '' :
                    break;
                    default :
                    $sname = $scor;
                }

                $size = $value * 25;
                $sx .= '<div title="' . msg($key) . '" class="text-center" style="padding: 0px; margin: 0px; background-color: ' . $xcor . '; width:100px; height:' . $size . 'px; border-left: 1px solid #000000; border-right: 1px solid #000000;" >';
                $sx .= $sname . ' (' . $value . ')';
                $sx .= '</div>';
            }
        }
    } else {
        $sx .= '<td>&nbsp;';
    }
    $sx .= '</td>';

}
$sx .= '</tr>';
$sx .= '</table>';
$sx = troca($sx, '$head', '<tr align="center">' . $sxx . '</tr>');
return ($sx);
}

function producao($id = '', $type = 'ARTIG') {
    $limit = (date("Y") - $this -> limit);
    if (is_array($id)) {
        $whe = '';
        for ($r = 0; $r < count($id); $r++) {
            if (strlen($whe) > 0) { $whe .= ' OR ';
        }
        $whe .= '( ap_autor = ' . $id[$r] . ')';
    }
    $wh = ' where (ap_ano >= ' . $limit . ') ';
    $wh .= " and (ap_tipo = '$type' ) ";
    $wh .= " and (" . $whe . ")";
} else {
    $wh = ' where (ap_ano >= ' . $limit . ') ';
    $wh .= " and (ap_tipo = '$type' ) ";
    if (strlen($id) > 0) {
        $wh .= " and ap_autor = '$id' ";
    }
}
$sql = "select count(*) as total, ap_ano from artigo_publicado 
$wh
group by ap_ano
ORDER BY AP_ANO";
$rlt = $this -> db -> query($sql);
$rlt = $rlt -> result_array();

$dados = array();
for ($r = (date("Y") - 4); $r <= date("Y"); $r++) {
    $dados[$r] = 0;
}

for ($r = 0; $r < count($rlt); $r++) {
    $line = $rlt[$r];
    $year = $line['ap_ano'];
    $value = $line['total'];
    if ($year >= $limit) {
        $dados[$year] = $value;
    }
}

$this -> dados = $dados;

return (1);
}

function producao_qualis($id = '', $type = 'ARTIG') {
    $limit = (date("Y") - $this -> limit);

    if (is_array($id)) {
        $whe = '';
        for ($r = 0; $r < count($id); $r++) {
            if (strlen($whe) > 0) { $whe .= ' OR ';
        }
        $whe .= '( ap_autor = ' . $id[$r] . ')';
    }
    $wh = ' where (ap_ano >= ' . $limit . ') ';
    $wh .= " and (ap_tipo = '$type' ) ";
    $wh .= " and (" . $whe . ")";
} else {
    $wh = ' where (ap_ano >= ' . $limit . ') ';
    $wh .= " and (ap_tipo = '$type' ) ";
    if (strlen($id) > 0) {
        $wh .= " and ap_autor = '$id' ";
    }
}
$sql = "SELECT count(*) as total, ap_ano, cq_qualis 
from artigo_publicado
inner join journals ON id_j = ap_journal_id
inner join capes_qualis ON (j_issn = cq_issn)  
$wh
group by ap_ano, cq_qualis
ORDER BY AP_ANO, cq_qualis";

$rlt = $this -> db -> query($sql);
$rlt = $rlt -> result_array();

$dados = array();
for ($r = (date("Y") - 4); $r <= date("Y"); $r++) {
    $dados[$r] = array();
}

for ($r = 0; $r < count($rlt); $r++) {
    $line = $rlt[$r];
    $year = $line['ap_ano'];
    $qualis = $line['cq_qualis'];
    $value = $line['total'];
    if ($year >= $limit) {
        $dados[$year][$qualis] = $value;
    }
}

/*****************/
$cores = array('A1' => '#81DAF5', 'A2' => '#CEECF5', 'B1' => '#86B404', 'B2' => '#A5DF00', 'B3' => '#BFFF00', 'B4' => '#C8FE2E', 'B5' => '#D0FA58', 'C' => '#C0C0C0');
$sx = '<table class="table">';
$sx .= '<tr><td colspan="10"><h4>Publicações</h4></td></tr>';
$sx .= '$header';
$sx .= '<tr>';
$sxx = '';
        //$sx .= '<td rowspan=10 style="height: 300px;">&nbsp;</td>';
foreach ($dados as $ano => $value) {
    $sx .= '<td width="90px;" valign="bottom">';
    foreach ($value as $qualis => $total) {
        $size = $total * 30;
        $size .= 'pt;';
        $cor = $cores[$qualis];
        $sx .= '<div class="text-center" style="height: ' . $size . '; border-left: 1px solid #000000; border-right: 1px solid #000000; background-color: ' . $cor . ';">';
        $sx .= $qualis;
        $sx .= '-(' . $total . ')';
        $sx .= '</div>';
    }
    $sx .= '</td>';
    $sxx .= '<td align="center">' . $ano . '</td>';
}
$head = '<tr>' . $sxx . '</tr>';
$sx = troca($sx, '$header', $head);
$sx .= '</table>';
return ($sx);
}

function producao_revistas_x($id = '', $type = 'ARTIG') {
    $limit = (date("Y") - $this -> limit);
    $wh = ' (ap_ano >= ' . $limit . ') ';
    $wh .= " and (ap_tipo = '$type' )";
    if (strlen($id) > 0) {
        $wh .= " and (ap_autor = '$id') ";
    }

    $sql = "select count(*) as total, j_name, ap_tipo 
    FROM artigo_publicado
    INNER JOIN journals ON ap_journal_id = id_j
    where $wh
    group by j_name, ap_tipo
    ORDER BY j_name";

    $rlt = $this -> db -> query($sql);
    $rlt = $rlt -> result_array();

    $dados = array();
    for ($r = 0; $r < count($rlt); $r++) {
        $line = $rlt[$r];
        $year = $line['j_name'];
        $value = $line['total'];
        $tipo = $line['ap_tipo'];
        $dados[$year][$tipo] = $value;
    }
    $data['data'] = $dados;
    $data['serie'] = 'Produção em artigos';
    $data['title'] = 'Produção em Artigos de Periódicos';
    $data['subtitle'] = 'Entre os anos de ' . $limit . ' e ' . date("Y");

    $sx = $this -> highcharts -> column_simple($data);
    return ($sx);
}

}
?>
