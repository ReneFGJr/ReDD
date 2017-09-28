<?php
class lattes extends CI_Model {
    var $limit = 3;
    var $dados;

    function lista_publicacoes($id, $type = 'ARTIG') {
        $limit = (date("Y") - $this -> limit);
        $wh = " AND ((ap_ano >= $limit) or (ap_main = 'S'))";

        $sql = "select * from artigo_publicado
						INNER JOIN journals ON ap_journal_id = id_j
						WHERE ap_autor = '$id' AND ap_tipo = '$type' $wh
						ORDER BY ap_ano DESC, ap_autores ";

        $rlt = $this -> db -> query($sql);
        $rlt = $rlt -> result_array();
        $sx = '<h2>' . msg('tit_' . $type) . '</h2>' . cr();
        $sx .= '<table class="table" width="100%">' . cr();

        for ($r = 0; $r < count($rlt); $r++) {
            $line = $rlt[$r];
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
            $sx .= ' ';
            $tit = NBR_autor(trim($line['ap_titulo']), 8);
            $tit = strtoupper(substr($tit, 0, 1)) . substr($tit, 1, strlen($tit));
            $sx .= $tit;
            $sx .= '. ';
            $sx .= trim($line['j_name']);
            if (strlen(trim($line['ap_serie'])) > 0) {
                $nr = $line['ap_serie'];
                $nr = trim(troca($nr, 'n.', ''));
                $sx .= ', ';
                $sx .= 'n. ' . $nr;
            }
            $sx .= ', ';
            $sx .= 'v. ' . $line['ap_vol'];
            $sx .= ', ';
            $sx .= $line['ap_ano'] . '.';

            $sx .= '</td>';

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
                if (strlen($keys) > 0) { $keys .= '; ';
                }
                $keys .= trim($keyword[$r]);
            }
        }
        if (strlen($keys) > 0) { $keys .= '.';
        }

        $titulo = troca($titulo, "'", "´");
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
        return (1);
    }

    function readXML($link, $id, $harvesting = 1) {
        $prodb = array();
        $dir = '_tmp';
        $file = $dir . '\lattes_' . $id . '.zip';

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
        $zip = new ZipArchive;
        if ($zip -> open($file) === TRUE) {
            $zip -> extractTo($dir);
            $zip -> close();

            $dt = array();
            $dt['id'] = $id;
            $this -> artigosExcluir($id);

            /* LE O XML */
            //$dom = xml_dom();
            $dom = new DOMDocument("1.0", "ISO-8859-15");
            $dom -> preserveWhiteSpace = False;
            $dom -> load($dir . '/curriculo.xml');

            /* DADOS PARA RECUPERAR */
            $cv = $dom -> getElementsByTagName("CURRICULO-VITAE");
            foreach ($cv as $cvs) {
                $dta = $cvs -> getAttribute("DATA-ATUALIZACAO");
                $dta = substr($dta, 4, 4) . substr($dta, 2, 2) . substr($dta, 0, 2);
                $nid = $cvs -> getAttribute("NUMERO-IDENTIFICADOR");
                $dt['atualizado'] = $dta;
                while (strlen($nid) < 16) { $nid = '0' . $nid;
                }
                $dt['numero_id'] = $nid;
            }

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

        } else {
            echo 'failed';
        }
        $dt['artigos'] = $artigo;
        return ($dt);
    }

    function producao($id = '', $type = 'ARTIG') {
        $limit = (date("Y") - $this -> limit);
        $wh = ' where (ap_ano >= ' . $limit . ') ';
        $wh .= " and (ap_tipo = '$type' ) ";
        if (strlen($id) > 0) {
            $wh .= " and ap_autor = '$id' ";
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

    function producao_revistas($id = '', $type = 'ARTIG') {
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
