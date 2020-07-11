<?php
class lattes_cnpq extends CI_Model 
{
	var $table = 'lattes_curriculo';
	var $path = '__lattes';
	var $study = 'JOINVILE-UFSC';
	//var $path = '__lattes/Joinville';
	
	function cpr()
	{
		$cp = array();
		return($cp);
	}	
	
	function row($path,$id)
	{
		$sx = '';
		$dt = array();
		$dt['table'] = $this->table;
		$dt['path'] = base_url(PATH.'payroll/');		
		$dt['cp'] = $this->cpr();
		
		switch($path)
		{
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
				if ($idcv != '')
				{
					$sx .= '<h4>Lattes: '.$idcv.'</h4>';
					$idn++;
					$sx .= '<h6>ID: '.$idn.'</h6>';
					$sx .= $this->xml_lattes($idcv);
					$sx .= '<meta http-equiv="refresh" content="5;'.base_url(PATH.'lattes/xml_lattes_auto/'.$idn).'">';
				} else {
					$sx .= '<h1>Fim do processamento</h1>';
				}
				$sx .= '</div>';
			break;			
			
			
			default:
			$sx .= '<ul>';
			$sx .= '<li>'.'<a href="'.base_url(PATH.'lattes/check_lattes_directory').'">'.msg('check_lattes_directory').'</a>';
			$sx .= '<li>'.'<a href="'.base_url(PATH.'lattes/xml_lattes_auto').'">'.msg('xml_lattes').'</a>';			
			$sx .= '</ul>';
		}
		$data['content'] = $sx;
		$this->load->view('content',$data);
		return($sx);
	}	
	
	function next_process($id)
	{
		$id++;
		$path = $this->path;
		$diretorio = dir($path);
		$fn = 0;
		while($arquivo = $diretorio -> read())
		{
			if (strpos($arquivo,'.xml') > 0)
			{
				$fn++;
				if ($fn == $id)
				{
					return(sonumero($arquivo));
				}
			}
		}
		echo 'OPS';
		exit;
	}	
	
	function lattes($id)
	{
		if (strlen($id) < 10)
		{
			return(0);
		}
		
		$sql = "select * from ".$this->table." where lt_lattes = '$id' ";
		$rlt = $this->db->query($sql);
		$rlt = $rlt->result_array();
		
		if (count($rlt) == 0)
		{
			$isql = "insert into ".$this->table." 
			(lt_lattes, lt_nome, lt_update)
			values
			('$id','','1901-01-01')";				
			$rlt = $this->db->query($isql);
			sleep(1);
			$rlt = $this->db->query($sql);
			$rlt = $rlt->result_array();
		}	
		$line = $rlt[0];
		return($line);		
	}
	
	function check_lattes_directory()
	{
		$path = $this->path;
		$diretorio = dir($path);
		$sx = '<h1>'.msg('Zip_Lattes').'</h1>';
		$sx .= "Lista de Arquivos do diretório '<strong>".$path."</strong>':<br />";
		$fls = 0;
		while($arquivo = $diretorio -> read()){
			$filename = $path.'/'.$arquivo;
			
			if (filetype($filename) == 'file')
			{
				$ext = substr($filename,strlen($filename)-3,3);
				if ($ext == 'zip')
				{
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
		$diretorio -> close();
		if ($fls == 0)
		{
			$sx .= message('none file located',3);
		}
		return($sx);
	}
	
	function xml_lattes($id)
	{
		$file = $this->path.'/'.$id.'.xml';
		if (file_exists($file))
		{
			$sx = '<h4>'.$file.'</h4>';
		} else {
			$sx = msg('file_not_found').' '.$file;
			echo $sx;
			return("");
		}
		
		/* Teste */
		/********************************* XML to ARRAY ***************************/
		$xml = simplexml_load_file($file, "SimpleXMLElement", LIBXML_NOCDATA);
		$json = json_encode($xml);
		$cv = json_decode($json,TRUE);
		
		/* testado */
		$idcv = $this->processar_cv($id,$cv);
		$this->processar_cadastro_lattes($cv,$idcv,$id);
		$this->processar_dados_gerais($cv,$idcv,$id);
		$this->processar_producao_bibliografica($cv,$idcv,$id);
		$this->processar_producao_tecnica($cv,$idcv,$id);
		return("");
	}
	/*************************** PROCESSAR DADOS GERAIS CV *************/
	function processar_producao_tecnica($cv,$idcv,$lattes)	
	{
		$rdf = new rdf;
		if (isset($cv['PRODUCAO-TECNICA']))
		{
			$dg = $cv['PRODUCAO-TECNICA'];
			if (isset($dg['SOFTWARE']))
			{
				/* Software */
				for ($r=0;$r < count($dg['SOFTWARE']);$r++)
				{
					if (isset($dg['SOFTWARE'][0]))
					{
						$soft = $dg['SOFTWARE'][$r];
					} else {
						$soft = $dg['SOFTWARE'];
					}
					
					$this->software($idcv,$soft);
				}				
			}
			
			if (isset($dg['PATENTE']))
			{
				/* Software */
				for ($r=0;$r < count($dg['PATENTE']);$r++)
				{
					if (isset($dg['PATENTE'][0]))
					{
						$patent = $dg['PATENTE'][$r];					
					} else {
						$patent = $dg['PATENTE'];
					}
					$this->patente($idcv,$patent);
				}				
			}
			if (isset($dg['PATENTE']))
			{
				/* Software */
				
			}
			//print_r($dg);
			;
			
		}
	}
	
	function patente($idcv,$w)
	{
		return('');
		$rdf = new rdf;
		echo '============';
		print_r($w);
		echo '============';
		exit;
		
		$tipo 	= 'SOFTWARE';
		$natu = $w['DADOS-BASICOS-DO-SOFTWARE']['@attributes']['NATUREZA'];
		$titulo = $w['DADOS-BASICOS-DO-SOFTWARE']['@attributes']['TITULO-DO-SOFTWARE'];
		$ano = $w['DADOS-BASICOS-DO-SOFTWARE']['@attributes']['ANO'];
		$pais = $w['DADOS-BASICOS-DO-SOFTWARE']['@attributes']['PAIS'];
		$idioma = $w['DADOS-BASICOS-DO-SOFTWARE']['@attributes']['IDIOMA'];
		$doi = $w['DADOS-BASICOS-DO-SOFTWARE']['@attributes']['DOI'];
		
		$vfina = $w['DETALHAMENTO-DO-SOFTWARE']['@attributes']['FINALIDADE'];
		$vplat = $w['DETALHAMENTO-DO-SOFTWARE']['@attributes']['PLATAFORMA'];
		$vambi = $w['DETALHAMENTO-DO-SOFTWARE']['@attributes']['AMBIENTE'];
		$vdisp = $w['DETALHAMENTO-DO-SOFTWARE']['@attributes']['DISPONIBILIDADE'];
		$vspon = $w['DETALHAMENTO-DO-SOFTWARE']['@attributes']['INSTITUICAO-FINANCIADORA'];
		
		$aut = $this->autores($w);
		$ref = $aut[1];
		
		/* Dados do Capítulo */
		$vi = $ref.'. '.$titulo.' ['.$vplat.'] '.$vambi.')';
		$idt = $rdf -> frbr_name($vi);
		$id_p = $rdf->rdf_concept($idt, 'lattes:SoftwareWork', $orign = '');
		$rdf->set_propriety($idcv, 'lattes:buildSoftware', $id_p, 0);
		
		$idt = $rdf -> frbr_name($titulo);
		$rdf->set_propriety($id_p, 'skos:prefLabel', $idt, 0);		
		
		$idt = $rdf -> frbr_name($vplat);
		$id_lg = $rdf->rdf_concept($idt, 'lattes:LanguageProgram', $orign = '');
		$rdf->set_propriety($id_p, 'lattes:buildLanguageProgram', $id_lg, 0);
		
		$idt = $rdf -> frbr_name($vambi);
		$id_la = $rdf->rdf_concept($idt, 'lattes:SoftwareEnvironment', $orign = '');
		$rdf->set_propriety($id_p, 'lattes:buildSoftwareEnvironment', $id_la, 0);
		
		$idt = $this->date($ano);
		$rdf->set_propriety($id_p, 'lattes:buildSoftwareDate', $idt, 0);
		
		if (strlen($vfina) > 0)
		{
			$idt = $rdf -> frbr_name($vfina);
			$rdf->set_propriety($id_p, 'lattes:buildSoftwareGoal', 0, $idt);
		}
		
		
	}	
	
	function software($idcv,$w)
	{
		$rdf = new rdf;
		$tipo 	= 'SOFTWARE';
		$natu = $w['DADOS-BASICOS-DO-SOFTWARE']['@attributes']['NATUREZA'];
		$titulo = $w['DADOS-BASICOS-DO-SOFTWARE']['@attributes']['TITULO-DO-SOFTWARE'];
		$ano = $w['DADOS-BASICOS-DO-SOFTWARE']['@attributes']['ANO'];
		$pais = $w['DADOS-BASICOS-DO-SOFTWARE']['@attributes']['PAIS'];
		$idioma = $w['DADOS-BASICOS-DO-SOFTWARE']['@attributes']['IDIOMA'];
		$doi = $w['DADOS-BASICOS-DO-SOFTWARE']['@attributes']['DOI'];
		
		$vfina = $w['DETALHAMENTO-DO-SOFTWARE']['@attributes']['FINALIDADE'];
		$vplat = $w['DETALHAMENTO-DO-SOFTWARE']['@attributes']['PLATAFORMA'];
		$vambi = $w['DETALHAMENTO-DO-SOFTWARE']['@attributes']['AMBIENTE'];
		$vdisp = $w['DETALHAMENTO-DO-SOFTWARE']['@attributes']['DISPONIBILIDADE'];
		$vspon = $w['DETALHAMENTO-DO-SOFTWARE']['@attributes']['INSTITUICAO-FINANCIADORA'];
		
		
		/* registro de patente de software */
		//'REGISTRO-OU-PATENTE'
		if (isset($w['DETALHAMENTO-DO-SOFTWARE']['REGISTRO-OU-PATENTE']['@attributes']['TIPO-PATENTE']))
		{
			$ptipo = $w['DETALHAMENTO-DO-SOFTWARE']['REGISTRO-OU-PATENTE']['@attributes']['TIPO-PATENTE'];
			$pcod = $w['DETALHAMENTO-DO-SOFTWARE']['REGISTRO-OU-PATENTE']['@attributes']['CODIGO-DO-REGISTRO-OU-PATENTE'];
			$ptitulo = $w['DETALHAMENTO-DO-SOFTWARE']['REGISTRO-OU-PATENTE']['@attributes']['TITULO-PATENTE'];
			
			$pdt_depos = $w['DETALHAMENTO-DO-SOFTWARE']['REGISTRO-OU-PATENTE']['@attributes']['DATA-PEDIDO-DE-DEPOSITO'];
			$pdt_conse = $w['DETALHAMENTO-DO-SOFTWARE']['REGISTRO-OU-PATENTE']['@attributes']['DATA-DE-CONCESSAO'];
			$pplace = $w['DETALHAMENTO-DO-SOFTWARE']['REGISTRO-OU-PATENTE']['@attributes']['INSTITUICAO-DEPOSITO-REGISTRO'];
			
			$ppct = $w['DETALHAMENTO-DO-SOFTWARE']['REGISTRO-OU-PATENTE']['@attributes']['NUMERO-DEPOSITO-PCT'];
		}
		
		$aut = $this->autores($w);
		$ref = $aut[1];
		
		/* Dados do Capítulo */
		$vi = $ref.'. '.$titulo.' ['.$vplat.'] '.$vambi.')';
		$idt = $rdf -> frbr_name($vi);
		$id_p = $rdf->rdf_concept($idt, 'lattes:SoftwareWork', $orign = '');
		$rdf->set_propriety($idcv, 'lattes:buildSoftware', $id_p, 0);
		
		$idt = $rdf -> frbr_name($titulo);
		$rdf->set_propriety($id_p, 'skos:prefLabel', $idt, 0);		
		
		$idt = $rdf -> frbr_name($vplat);
		$id_lg = $rdf->rdf_concept($idt, 'lattes:LanguageProgram', $orign = '');
		$rdf->set_propriety($id_p, 'lattes:buildLanguageProgram', $id_lg, 0);
		
		$idt = $rdf -> frbr_name($vambi);
		$id_la = $rdf->rdf_concept($idt, 'lattes:SoftwareEnvironment', $orign = '');
		$rdf->set_propriety($id_p, 'lattes:buildSoftwareEnvironment', $id_la, 0);
		
		$idt = $this->date($ano);
		$rdf->set_propriety($id_p, 'lattes:buildSoftwareDate', $idt, 0);
		
		if (strlen($vfina) > 0)
		{
			$idt = $rdf -> frbr_name($vfina);
			$rdf->set_propriety($id_p, 'lattes:buildSoftwareGoal', 0, $idt);
		}
		
		
	}
	
	/*************************** PROCESSAR DADOS GERAIS CV *************/
	function processar_producao_bibliografica($cv,$idcv,$lattes)	
	{
		$rdf = new rdf;
		if (isset($cv['PRODUCAO-BIBLIOGRAFICA']))
		{
			$dg = $cv['PRODUCAO-BIBLIOGRAFICA'];
			
			
			//TRABALHOS-EM-EVENTOS
			if (isset($dg['TRABALHOS-EM-EVENTOS']))
			{
				$te = $dg['TRABALHOS-EM-EVENTOS']['TRABALHO-EM-EVENTOS'];
				for ($r=0;$r < count($te);$r++)
				{
					if (isset($te[0]))
					{
						$this->trabalho_evento($idcv,$lattes,$te[$r]);
					} else {
						$this->trabalho_evento($idcv,$lattes,$te);
					}
				}
			}
			
			//ARTIGOS-PUBLICADOS
			if (isset($dg['ARTIGOS-PUBLICADOS']))
			{
				$te = $dg['ARTIGOS-PUBLICADOS']['ARTIGO-PUBLICADO'];
				for ($r=0;$r < count($te);$r++)
				{
					if (isset($te[0]))
					{
						$this->trabalho_artigo($idcv,$lattes,$te[$r]);
					} else {
						$this->trabalho_artigo($idcv,$lattes,$te);
					}
				}
			}
			
			//LIVROS E CAPITULOS
			if (isset($dg['LIVROS-E-CAPITULOS']))
			{
				/* LIVROS E LIVROS ORGANIZADOS */
				if (isset($dg['LIVROS-E-CAPITULOS']['LIVROS-PUBLICADOS-OU-ORGANIZADOS']['LIVRO-PUBLICADO-OU-ORGANIZADO']))
				{
					$te = $dg['LIVROS-E-CAPITULOS']['LIVROS-PUBLICADOS-OU-ORGANIZADOS']['LIVRO-PUBLICADO-OU-ORGANIZADO'];
					for ($r=0;$r < count($te);$r++)
					{
						if (isset($te[0]))
						{
							$this->trabalho_livros($idcv,$lattes,$te[$r]);
						} else {
							$this->trabalho_livros($idcv,$lattes,$te);
						}
					}
				}
				/* CAPITULOS */
				if (isset($dg['LIVROS-E-CAPITULOS']['CAPITULOS-DE-LIVROS-PUBLICADOS']['CAPITULO-DE-LIVRO-PUBLICADO']))
				{
					$te = $dg['LIVROS-E-CAPITULOS']['CAPITULOS-DE-LIVROS-PUBLICADOS']['CAPITULO-DE-LIVRO-PUBLICADO'];
					for ($r=0;$r < count($te);$r++)
					{
						if (isset($te[0]))
						{
							$this->capitulo_livros($idcv,$lattes,$te[$r]);
						} else {
							$this->capitulo_livros($idcv,$lattes,$te);
						}
					}
				}
			}			
		}
	}
	
	function capitulo_livros($idcv,$lattes,$w)
	{
		$rdf = new rdf;
		$FAC1 = 'DADOS-BASICOS-DO-CAPITULO';
		$tipo 	= $w[$FAC1]['@attributes']['TIPO'];
		$natu = 'CAPITULO';
		$titulo_cap = $w[$FAC1]['@attributes']['TITULO-DO-CAPITULO-DO-LIVRO'];
		$ano = $w[$FAC1]['@attributes']['ANO'];
		$pais = $w[$FAC1]['@attributes']['PAIS-DE-PUBLICACAO'];
		$idioma = $w[$FAC1]['@attributes']['IDIOMA'];
		$doi = $w[$FAC1]['@attributes']['DOI'];
		
		$FAC1 = 'DETALHAMENTO-DO-CAPITULO';
		$titulo = $w[$FAC1]['@attributes']['TITULO-DO-LIVRO'];
		$ISBN = $w[$FAC1]['@attributes']['ISBN'];
		$cidade = $w[$FAC1]['@attributes']['CIDADE-DA-EDITORA'];
		$editora = $w[$FAC1]['@attributes']['NOME-DA-EDITORA'];
		
		$autores = $this->autores($w);
		$ref = $autores[1];
		
		/**************** Processar */
		$vi = $ref.'. <b>'.$titulo_cap.'</b> ('.$tipo.') '.$ano.'. <i>In:</i> '.$titulo;
		if (strlen($doi) > 0)
		{
			$vi .= ' DOI: '.$doi;
		}
		if (strlen($ISBN) > 0)
		{
			$vi .= ' ISBN: '.$ISBN;
		}		
		$vi = troca($vi,'..','.');
		
		/* Dados do Livro */
		
		
		/* Dados do Capítulo */
		$idt = $rdf -> frbr_name($vi);
		$id_p = $rdf->rdf_concept($idt, 'lattes:BookChapterWork', $orign = '');
		$rdf->set_propriety($idcv, 'lattes:wasPublishChapterBook', $id_p, 0);
		
		/* Sobre o livro */
		if (strlen($ISBN) > 0)
		{
			$id_isbn = $this->isbn($ISBN,$titulo,$ano,$editora,$cidade);
			$rdf->set_propriety($id_p, 'lattes:wasISBN', $id_isbn, 0);
		}
		
		/* Evento */
		if (strlen($ano) > 0)
		{
			$id_ano = $this->date($ano);
			$rdf->set_propriety_update($id_p, 'lattes:bookDate', $id_ano, 0);
		}
		
		/* Natureza */
		if (strlen($natu) > 0)
		{
			$idt = $rdf -> frbr_name($natu);
			$id_p = $rdf->rdf_concept($idt, 'lattes:WorkNature', $orign = '');			
			$rdf->set_propriety_update($id_p, 'lattes:bookWorkNature', $id_p, 0);
		}
		return(1);
	}	
	
	function trabalho_livros($idcv,$lattes,$w)
	{
		$rdf = new rdf;
		
		$FAC1 = 'DADOS-BASICOS-DO-LIVRO';
		$tipo 	= $w[$FAC1]['@attributes']['TIPO'];
		$natu = $w[$FAC1]['@attributes']['NATUREZA'];
		$titulo = $w[$FAC1]['@attributes']['TITULO-DO-LIVRO'];
		$ano = $w[$FAC1]['@attributes']['ANO'];
		$pais = $w[$FAC1]['@attributes']['PAIS-DE-PUBLICACAO'];
		$idioma = $w[$FAC1]['@attributes']['IDIOMA'];
		$doi = $w[$FAC1]['@attributes']['DOI'];
		
		$FAC1 = 'DETALHAMENTO-DO-LIVRO';
		$ISBN = $w[$FAC1]['@attributes']['ISBN'];
		$cidade = $w[$FAC1]['@attributes']['CIDADE-DA-EDITORA'];
		$editora = $w[$FAC1]['@attributes']['NOME-DA-EDITORA'];
		
		$autores = $this->autores($w);
		$ref = $autores[1];
		
		/**************** Processar */
		$vi = $ref.'. <b>'.$titulo.'</b> ('.$tipo.') '.$ano.'.';
		if (strlen($doi) > 0)
		{
			$vi .= ' DOI: '.$doi;
		}
		if (strlen($ISBN) > 0)
		{
			$vi .= ' ISBN: '.$ISBN;
		}		
		$vi = troca($vi,'..','.');
		
		$idt = $rdf -> frbr_name($vi);
		$id_p = $rdf->rdf_concept($idt, 'lattes:BookWork', $orign = '');
		$rdf->set_propriety($idcv, 'lattes:wasPublishBook', $id_p, 0);
		
		/* Sobre o livro */
		if (strlen($ISBN) > 0)
		{
			$id_isbn = $this->isbn($ISBN,$titulo,$ano,$editora,$cidade);
			$rdf->set_propriety($id_p, 'lattes:wasISBN', $id_isbn, 0);
		}
		
		/* Evento */
		if (strlen($ano) > 0)
		{
			$id_ano = $this->date($ano);
			$rdf->set_propriety_update($id_p, 'lattes:bookDate', $id_ano, 0);
		}
		
		/* Natureza */
		if (strlen($natu) > 0)
		{
			$idt = $rdf -> frbr_name($natu);
			$id_p = $rdf->rdf_concept($idt, 'lattes:WorkNature', $orign = '');			
			$rdf->set_propriety_update($id_p, 'lattes:bookWorkNature', $id_p, 0);
		}
		return(1);
	}
	
	function isbn($isbn,$titulo,$ano,$editora,$cidade)
	{
		$rdf = new rdf;
		$isbn = $this->isbns($isbn);
		$isbn13 = $isbn['isbn13'];
		$isbn10 = $isbn['isbn10'];
		
		$idt = $rdf -> frbr_name('ISBN: '.$isbn['isbn13']);
		$idt1 = $rdf -> frbr_name($isbn['isbn10']);
		$idt2 = $rdf -> frbr_name($isbn['isbn10']);
		$id_p = $rdf->rdf_concept($idt, 'ISBN', $orign = '');
		$rdf->set_propriety($id_p, 'skos:altLabel', $idt1, 0);
		$rdf->set_propriety($id_p, 'skos:altLabel', $idt2, 0);
		
		if (strlen($editora) > 0)
		{
			$id_city = '';
			if (strlen($cidade) > 0)
			{
				$id_city = $this->city($cidade);
			}
			$id_e = $this->editora($editora,$id_city);
			$rdf->set_propriety($id_p, 'hasPublishing', $id_e, 0);
		}
		
		if (strlen($titulo) > 0)
		{
			$idt = $rdf -> frbr_name($titulo);
			$rdf->set_propriety($id_p, 'FRBR:hasTitle', 0, $idt);
		}
		
		if (strlen($ano) > 0)
		{
			$idt = $this->date($ano);
			$rdf->set_propriety($id_p, 'skos:hasPublishDate', $idt);
		}		
		return($id_p);
	}
	
	/************* ISBNS ***********************************/
	function isbns($isbn)
	{
		if (is_array($isbn))
		{
			$isbn = $isbn['isbn13'];
		}
		$isbn = troca($isbn,'-','');
		$isbn = troca($isbn,'.','');
		$rsp = array();
		
		if (strlen($isbn) == 13) {
			$rsp['isbn13'] = $isbn;
			$rsp['isbn10'] = isbn13to10($isbn);
		} else {
			$rsp['isbn10'] = $isbn;
			$rsp['isbn13'] = isbn10to13($isbn);
		}
		
		$rsp['isbn10f'] = substr($rsp['isbn10'],0,2).'-'.substr($rsp['isbn10'],2,5).'-'.substr($rsp['isbn10'],7,2).'-'.substr($rsp['isbn10'],9,1);
		$rsp['isbn13f'] = substr($rsp['isbn13'],0,3).'-'.substr($rsp['isbn13'],3,4).'-'.substr($rsp['isbn13'],7,5).'-'.substr($rsp['isbn13'],12,1);
		return($rsp);	
	}	
	
	function autores($w)
	{
		$autores = array();
		$aut = $w['AUTORES'];
		$ref = '';
		for ($y=0;$y < count($aut);$y++)
		{
			if (count($aut) == 1)
			{
				$nome = $aut['@attributes']['NOME-PARA-CITACAO'];
				$nome_lattes = $w['AUTORES']['@attributes']['NRO-ID-CNPQ'];
			} else {
				$nome = $aut[$y]['@attributes']['NOME-PARA-CITACAO'];
				if (isset($w['AUTORES'][$y]['@attributes']['NRO-ID-CNPQ']))
				{
					$nome_lattes = $w['AUTORES'][$y]['@attributes']['NRO-ID-CNPQ'];
				}
			}	
			/* Usa apenas o primeiro nome na citação */
			if (strpos($nome,';') > 0)
			{
				$nome = substr($nome,0,strpos($nome,';'));
			}
			
			/* Inclui separador de ponto e virgula entre os autores */
			if (strlen($ref) > 0) 
			{ 
				$ref.= '; '; 
			}
			$ref .= $nome;
			
			if (strlen($nome_lattes) > 0)
			{
				$nome .= trim($nome).'@lattes:'.$nome_lattes;
			}
			array_push($autores,$nome);
		}	
		return(array($autores,$ref));
	}	
	
	function trabalho_artigo($idcv,$lattes,$w)
	{
		$rdf = new rdf;
		$titulo = trim($w['DADOS-BASICOS-DO-ARTIGO']['@attributes']['TITULO-DO-ARTIGO']);
		$ano = trim($w['DADOS-BASICOS-DO-ARTIGO']['@attributes']['ANO-DO-ARTIGO']);
		$pais = trim($w['DADOS-BASICOS-DO-ARTIGO']['@attributes']['PAIS-DE-PUBLICACAO']);
		$lang = trim($w['DADOS-BASICOS-DO-ARTIGO']['@attributes']['IDIOMA']);
		$natu = trim($w['DADOS-BASICOS-DO-ARTIGO']['@attributes']['NATUREZA']);
		$doi = trim($w['DADOS-BASICOS-DO-ARTIGO']['@attributes']['DOI']);
		
		$journal = trim($w['DETALHAMENTO-DO-ARTIGO']['@attributes']['TITULO-DO-PERIODICO-OU-REVISTA']);
		$issn = trim($w['DETALHAMENTO-DO-ARTIGO']['@attributes']['ISSN']);
		$v = trim($w['DETALHAMENTO-DO-ARTIGO']['@attributes']['VOLUME']);
		$n = trim($w['DETALHAMENTO-DO-ARTIGO']['@attributes']['FASCICULO']);
		
		$aut = $this->autores($w);
		$autores = $aut[0];
		$ref = $aut[1];
		
		/**************** Processar */
		if (strlen($v) > 0) { $v = ', v. '.$v; }
		if (strlen($n) > 0) { $n = ', n. '.$n; }
		$vi = $ref.'. '.$titulo.'. <b> '.$journal.'</b>'.$v.$n.', '.$ano.'.';
		if (strlen($doi) > 0)
		{
			$vi .= ' DOI: '.$doi;
		}
		$vi = troca($vi,'..','.');
		
		$idt = $rdf -> frbr_name($vi);
		$id_p = $rdf->rdf_concept($idt, 'lattes:ArticleWork', $orign = '');
		$rdf->set_propriety($idcv, 'lattes:wasPublishArticle', $id_p, 0);
		
		/* Journal */
		if (strlen($journal) > 0)
		{
			$id_j = $this->journal($journal,$issn);
			$rdf->set_propriety_update($id_p, 'lattes:hasPublishIn', $id_j, 0);
		}
		
		/* Issue */
		if (strlen($v.$n.$ano) > 0)
		{
			$issue = 'Issue: '.$v.$n.', '.$ano.' - '.strzero($id_j,7);
			$idt = $rdf -> frbr_name($issue);
			$id_issue = $rdf->rdf_concept($idt, 'lattes:JournalIssue', $orign = '');
			$rdf->set_propriety_update($id_j, 'lattes:hasIssue', $id_issue, 0);
			$rdf->set_propriety_update($id_p, 'lattes:hasIssue', $id_issue, 0);
		}		
		
		/* Evento */
		if (strlen($ano) > 0)
		{
			$id_ano = $this->date($ano);
			$rdf->set_propriety_update($id_p, 'lattes:articleDate', $id_ano, 0);
		}
		
		/* Natureza */
		if (strlen($natu) > 0)
		{
			$idt = $rdf -> frbr_name($natu);
			$id_p = $rdf->rdf_concept($idt, 'lattes:WorkNature', $orign = '');			
			$rdf->set_propriety_update($id_p, 'lattes:eventWorkNature', $id_p, 0);
		}
		return(1);
	}	
	
	function trabalho_evento($idcv,$lattes,$w)
	{
		$rdf = new rdf;
		$titulo = trim($w['DADOS-BASICOS-DO-TRABALHO']['@attributes']['TITULO-DO-TRABALHO']);
		$ano = trim($w['DADOS-BASICOS-DO-TRABALHO']['@attributes']['ANO-DO-TRABALHO']);
		$pais = trim($w['DADOS-BASICOS-DO-TRABALHO']['@attributes']['PAIS-DO-EVENTO']);
		$lang = trim($w['DADOS-BASICOS-DO-TRABALHO']['@attributes']['IDIOMA']);
		$natu = trim($w['DADOS-BASICOS-DO-TRABALHO']['@attributes']['NATUREZA']);
		$evento = trim($w['DETALHAMENTO-DO-TRABALHO']['@attributes']['NOME-DO-EVENTO']);
		$cidade = trim($w['DETALHAMENTO-DO-TRABALHO']['@attributes']['CIDADE-DO-EVENTO']);
		$editora = trim($w['DETALHAMENTO-DO-TRABALHO']['@attributes']['NOME-DA-EDITORA']);
		$editora_cd = trim($w['DETALHAMENTO-DO-TRABALHO']['@attributes']['CIDADE-DA-EDITORA']);
		
		$aut = $this->autores($w);
		$autores = $aut[0];
		$ref = $aut[1];
		
		/**************** Processar */
		
		$vi = $ref.'. '.$titulo.'. <i>In:</i> '.$evento.' ,'.$ano.' , ';
		$vi .= $cidade.'. <b>Anais...</b>.';
		if (strlen($editora_cd) > 0)
		{ 
			$vi .= ': '.$editora.', '.$ano;
		}
		$vi = troca($vi,'..','.');
		
		$idt = $rdf -> frbr_name($vi);
		$id_p = $rdf->rdf_concept($idt, 'lattes:EventWork', $orign = '');
		$rdf->set_propriety($idcv, 'lattes:wasPublishEvent', $id_p, 0);
		
		
		/* Evento */
		if (strlen($evento) > 0)
		{
			$id_evento = $this->evento($evento);
			$rdf->set_propriety_update($id_p, 'lattes:eventName', $id_evento, 0);
		}			
		
		/* Evento */
		if (strlen($ano) > 0)
		{
			$id_ano = $this->date($ano);
			$rdf->set_propriety_update($id_p, 'lattes:eventDate', $id_ano, 0);
		}
		
		/* Pais */
		if (strlen($pais) > 0)
		{
			$id_pais = $this->country($pais);
			$rdf->set_propriety_update($id_evento, 'lattes:eventPlace', $id_pais, 0);
		}
		/* Cidade */
		if (strlen($cidade) > 0)
		{
			$id_pais = $this->city($cidade);
			$rdf->set_propriety_update($id_evento, 'lattes:eventPlace', $id_pais, 0);
		}		
		
		/* Natureza */
		if (strlen($natu) > 0)
		{
			$idt = $rdf -> frbr_name($natu);
			$id_p = $rdf->rdf_concept($idt, 'lattes:WorkNature', $orign = '');			
			$rdf->set_propriety_update($id_p, 'lattes:eventWorkNature', $id_p, 0);
		}
		return(1);
	}
	
	function processar_cadastro_lattes($cv,$idcv,$lattes)
	{
		$nome = $cv['DADOS-GERAIS']['@attributes']['NOME-COMPLETO'];
		$cv_lattes = $cv['@attributes']['NUMERO-IDENTIFICADOR'];
		
		$sql = "select * from lattes_curriculo where lt_lattes = '$cv_lattes' ";
		$rlt = $this->db->query($sql);
		$rlt = $rlt -> result_array();
		
		if (count($rlt) > 0)
		{
			$sql = "update lattes_curriculo set lt_nome = '$nome', lt_rdf = $idcv where id_lt = ".$rlt[0]['id_lt'];
			$rlt = $this->db->query($sql);
		}
		return('');
	}
	
	/*************************** PROCESSAR DADOS GERAIS CV *************/
	function processar_dados_gerais($cv,$idcv,$lattes)	
	{
		$rdf = new rdf;
		if (isset($cv['DADOS-GERAIS']))
		{
			$dg = $cv['DADOS-GERAIS'];
			if (isset($dg['@attributes']))
			{
				$att = $dg['@attributes'];
				foreach ($att as $key => $v) {
					switch($key)
					{
						case 'NOME-COMPLETO':
							$idt = $rdf -> frbr_name($v);
							$id_p = $rdf->rdf_concept($idt, 'frbr:Person', $orign = '');
							$prop = 'lattes:hasCvName';
							$rdf->set_propriety_update($idcv, $prop, $id_p, 0);
						break;
						
						case 'NOME-EM-CITACOES-BIBLIOGRAFICAS':
							$ns = splitx(';',$v.';');
							for($r=0;$r<count($ns);$r++)
							{
								$n = nbr_author($ns[$r],7);
								$idt = $rdf -> frbr_name($n);
								$rdf->set_propriety($id_p, 'skos:altLabel', 0, $idt);
							}
						break;
						
						case 'PAIS-DE-NASCIMENTO':
							$id_pais = $this->country($v);
						break;
						
						case 'UF-NASCIMENTO':
							$id_uf = $this->state($v,$id_pais);
						break;
						
						case 'CIDADE-NASCIMENTO':
							$id_city = $this->city($v);
							$rdf->set_propriety_update($id_p, 'hasBorn', $id_city, 0);
						break;
						
						case 'SIGLA-PAIS-NACIONALIDADE':
							$n = UpperCaseSql($v);
							$idt = $rdf -> frbr_name($n);
							$rdf->set_propriety_update($id_pais, 'skos:abbreviation', 0, $idt);
						break;
						
						case 'ORCID-ID':
							$idt = $rdf -> frbr_name($v);
							$rdf->set_propriety_update($id_p, 'orcid:hasOrcidUrl', 0, $idt);
						break;
					}
				}
				
				/* Fase II ******************************************************/
				if (isset($dg['RESUMO-CV']))
				{
					$v = $dg['RESUMO-CV']['@attributes']['TEXTO-RESUMO-CV-RH'];
					$idt = $rdf -> frbr_name($v);
					$rdf->set_propriety_update($idcv, 'lattes:hasBiography', 0, $idt);
				}
				
				
				/* Fase III  ** ENDERECO PROFISSIONAL **************************/
				if (isset($dg['ENDERECO']))
				{
					$ad = $dg['ENDERECO']['ENDERECO-PROFISSIONAL']['@attributes'];
					foreach ($ad as $key => $v) {
						switch($key)
						{
							case 'CODIGO-INSTITUICAO-EMPRESA':
								$cod_inst = $v;
							break;
							
							case 'NOME-INSTITUICAO-EMPRESA':
								$n = nbr_author($v,7);
								$idt = $rdf -> frbr_name($n);
								$id_inst = $rdf->rdf_concept($idt, 'frbr:CorporateBody', $orign = '');
								if (isset($cod_inst))
								{
									$idt = $rdf -> frbr_name($cod_inst);
									$rdf->set_propriety($id_inst, 'hasID', 0, $idt);
								}
								$rdf->set_propriety($idcv, 'lattes:hasWork', $id_inst, 0);
							break;
							
							case 'CODIGO-ORGAO':
								$cod_inst_org = $v;
							break;
							
							case 'NOME-ORGAO':
								$n = nbr_author($v,7);
								if (strlen($n) > 0)
								{
									$idt = $rdf -> frbr_name($n);
									$id_dep = $rdf->rdf_concept($idt, 'frbr:CorporateBodyDepartament', $orign = '');
									
									if (isset($id_inst))
									{
										$rdf->set_propriety($id_inst, 'hasDepartament',$id_dep, 0);
									}							
									
									if (isset($cod_inst_org))
									{
										$idt = $rdf -> frbr_name($cod_inst_org);
										$rdf->set_propriety($id_dep, 'hasID', 0, $idt);
									}	
									
									$rdf->set_propriety($idcv, 'lattes:hasWorkDepartament', $id_dep, 0);
								}
							break;
							
							case 'CODIGO-UNIDADE':
								$cod_inst_org_uni = $v;
							break;
							
							case 'NOME-UNIDADE':
								$n = nbr_author($v,7);
								if (strlen($n) > 0)
								{
									$idt = $rdf -> frbr_name($n);
									$id_dep_un = $rdf->rdf_concept($idt, 'frbr:CorporateBodyDepUnit', $orign = '');
									$rdf->set_propriety($id_dep, 'lattes:hasDepartamentOf', $id_dep_un, 0);
								}
							break;
							
							case 'PAIS':
								$id_county = $this->country($v);
							break;
							
							case 'UF':
								$id_wuf = $this->state($v,$id_county);
							break;							
							
							case 'CIDADE':
								$id_city = $this->city($v,$id_wuf);
								if (isset($id_dep))
								{
									$rdf->set_propriety($id_dep,'hasPlace',$id_city);
								}
							break;
							
							default:
							//echo '<br>'.$key.'=>'.$v;
						}
					}
				}
				
				/* Fase IV  ** FORMACAO-ACADEMICA-TITULACAO **************************/
				if (isset($dg['FORMACAO-ACADEMICA-TITULACAO']))
				{
					$ar = $dg['FORMACAO-ACADEMICA-TITULACAO'];
					if (isset($ar['GRADUACAO']))
					{
						$grad = $this->formacao($idcv,$ar['GRADUACAO'],'Graduate',$lattes);
					}
					if (isset($ar['ESPECIALIZACAO']))
					{
						$esp = $this->formacao($idcv,$ar['ESPECIALIZACAO'],'Specialization',$lattes);
					}
					if (isset($ar['MESTRADO']))
					{
						$mest = $this->formacao($idcv,$ar['MESTRADO'],'Master',$lattes);
					}
					if (isset($ar['DOUTORADO']))
					{
						$dout = $this->formacao($idcv,$ar['DOUTORADO'],'Phd',$lattes);
					}
					
				}
				
				
				/* Fase V ** Atuacao profissional ***********************************/
				if (isset($dg['ATUACOES-PROFISSIONAIS']))
				{
					$ar = $dg['ATUACOES-PROFISSIONAIS']['ATUACAO-PROFISSIONAL'];
					for ($r=0;$r < count($ar);$r++)
					{
						if (isset($ar[0]))
						{
							$at = $ar[$r];								
						} else {
							$at = $ar;							
						}
						
						$inst_cod = $at['@attributes']['CODIGO-INSTITUICAO'];
						$inst_nome = $at['@attributes']['NOME-INSTITUICAO'];
						$inst_v = $this->instituicao($inst_cod,$inst_nome);
						
						/* Criar vinculo */
						$vinc = nbr_author($inst_nome,7).' - cv'.$lattes;
						$idt = $rdf -> frbr_name($vinc);
						$id_vc = $rdf->rdf_concept($idt, 'lattes:InstitutionalBond', $orign = '');
						
						$rdf->set_propriety($idcv, 'lattes:hasInstitutionalBond', $id_vc);
						
						/**************************** VINCULOS *******************/
						if (isset($at['VINCULOS']))
						{
							$vc = $at['VINCULOS'];
							for ($y=0;$y < count($vc);$y++)
							{
								if (count($vc) == 1)
								{
									$vnc = $vc['@attributes'];
								} else {
									$vnc = $vc[$y]['@attributes'];
								}
								
								$funcao = $vnc['OUTRO-ENQUADRAMENTO-FUNCIONAL-INFORMADO'];
								$DE = $vnc['FLAG-DEDICACAO-EXCLUSIVA'];
								$ch = $vnc['CARGA-HORARIA-SEMANAL'];
								$ini = strzero($vnc['ANO-INICIO'],4).'-'.strzero($vnc['MES-INICIO'],2);
								$fim = strzero($vnc['ANO-FIM'],4).'-'.strzero($vnc['MES-FIM'],2);
								if ($fim == '0000-00') { $fim = 'NOW'; }
								$id_dini = $this->date($ini);
								$id_dfim = $this->date($fim);
								
								/* Cria a funcao na instituicao */
								$idt = $rdf -> frbr_name($vinc . ' - '.$funcao.' '.$ini);
								$id_vcf = $rdf->rdf_concept($idt, 'lattes:InstitutionalBondOccupation', $orign = '');
								$rdf->set_propriety($id_vc, 'hasInstitutionalBondOccupation', $id_vcf);
								
								$idf = $rdf -> frbr_name($funcao);
								$id_oc = $rdf->rdf_concept($idf, 'lattes:Occupation', $orign = '');
								$rdf->set_propriety($id_vcf, 'hasOccupation', $id_oc);
								
								//$idt = $rdf -> frbr_name($cod);
								$rdf->set_propriety($id_vcf, 'hasOccupationStart', $id_dini);
								$rdf->set_propriety($id_vcf, 'hasOccupationEnd', $id_dfim);
								$rdf->set_propriety($id_vcf, 'hasOccupation', $id_oc);
							}
						}
					}
				}
				
				/* Fase VI ** Área de Atuaçao ***********************************/
				if (isset($dg['AREAS-DE-ATUACAO']['AREA-DE-ATUACAO']))
				{
					$at = $dg['AREAS-DE-ATUACAO']['AREA-DE-ATUACAO'];
					for ($z=0;$z < count($at);$z++)
					{
						if (isset($at[0]))
						{
							$this->area_conhecimento($at[$z]['@attributes'],$idcv);
						} else {
							$this->area_conhecimento($at['@attributes'],$idcv);
						}
						
					}
				}
				
				/* Fase VII ** Idiomas *********************************/
				if (isset($dg['IDIOMAS']['IDIOMA']))
				{
					$at = $dg['IDIOMAS']['IDIOMA'];
					for ($z=0;$z < count($at);$z++)
					{
						if (count($at) == 1)
						{
							$lang = $at['@attributes'];
						} else {
							$lang = $at[$z]['@attributes'];
						}
						$this->idiomas($lang,$idcv);
					}
				}
			}
		}
		return(1);
	}
	
	function idiomas($rf,$idc)
	{
		$rdf = new rdf;
		$compreende = strtolower($rf['PROFICIENCIA-DE-COMPREENSAO']);
		$escrita = strtolower($rf['PROFICIENCIA-DE-ESCRITA']);
		$fala = strtolower($rf['PROFICIENCIA-DE-FALA']);
		$leitura = strtolower($rf['PROFICIENCIA-DE-LEITURA']);
		$idioma = $rf['DESCRICAO-DO-IDIOMA'];
		$idioma_ct = $rf['IDIOMA'];
		
		$v = UpperCase($idioma).' - lê '.$leitura.', escreve '.$escrita;
		$v .= ', fala '.$fala.' e compreende '.$compreende;
		
		$idt = $rdf -> frbr_name($v);
		$id_k = $rdf->rdf_concept($idt, 'lattes:LanguageProficiency', $orign = '');
		
		$rdf->set_propriety($idc, 'lattes:hasLanguageProficiency', $id_k);
		return(0);
	}
	
	function area_conhecimento($rg,$idc)
	{
		$rdf = new rdf;
		$area = $rg['NOME-GRANDE-AREA-DO-CONHECIMENTO'];
		$area = troca($area,'_',' ');
		$area = nbr_author($area,7);
		$idt = $rdf -> frbr_name($area);
		$id_k = $rdf->rdf_concept($idt, 'cnpq:KnowledgeArea', $orign = '');
		$rdf->set_propriety($idc, 'lattes:hasKnowledgeArea', $id_k);
		
		$area = $rg['NOME-DA-AREA-DO-CONHECIMENTO'];
		if (strlen($area) > 0)
		{
			$idt = $rdf -> frbr_name($area);
			$id_k1 = $rdf->rdf_concept($idt, 'cnpq:KnowledgeArea', $orign = '');
			$rdf->set_propriety($id_k, 'skos:broader', $id_k1);
			$rdf->set_propriety($idc, 'lattes:hasKnowledgeArea', $id_k1);
		}
		
		$area = $rg['NOME-DA-SUB-AREA-DO-CONHECIMENTO'];
		if (strlen($area) > 0)
		{
			$idt = $rdf -> frbr_name($area);
			$id_k2 = $rdf->rdf_concept($idt, 'cnpq:KnowledgeArea', $orign = '');
			$rdf->set_propriety($id_k1, 'skos:broader', $id_k2);
			$rdf->set_propriety($idc, 'lattes:hasKnowledgeArea', $id_k2);
		}
		
		$area = $rg['NOME-DA-ESPECIALIDADE'];
		if (strlen($area) > 0)
		{
			$idt = $rdf -> frbr_name($area);
			$id_k3 = $rdf->rdf_concept($idt, 'cnpq:KnowledgeArea', $orign = '');
			$rdf->set_propriety($id_k2, 'skos:broader', $id_k3);
			$rdf->set_propriety($idc, 'lattes:hasKnowledgeArea', $id_k3);
		}
		
	}
	
	function instituicao($cod,$name)
	{
		$rdf = new rdf;
		$n = nbr_author($name,7);
		$nome_instituicao = $name;
		$idt = $rdf -> frbr_name($n);
		$id_inst = $rdf->rdf_concept($idt, 'frbr:CorporateBody', $orign = '');
		if (strlen($cod) > 0)
		{
			$idt = $rdf -> frbr_name($cod);
			$rdf->set_propriety($id_inst, 'hasID', 0, $idt);
		}
		return($id_inst);
	}
	
	function formacao($idcv,$cv,$type,$lattes)
	{
		$rdf = new rdf;
		if (isset($cv['@attributes']))
		{
			foreach ($cv['@attributes'] as $key => $v) {
				switch($key)
				{
					case 'CODIGO-INSTITUICAO':
						$cod_inst = $v;
					break;
					
					case 'NOME-INSTITUICAO':
						$n = nbr_author($v,7);
						$nome_instituicao = $v;
						$idt = $rdf -> frbr_name($n);
						$id_inst = $rdf->rdf_concept($idt, 'frbr:CorporateBody', $orign = '');
						if (isset($cod_inst))
						{
							$idt = $rdf -> frbr_name($cod_inst);
							$rdf->set_propriety($id_inst, 'hasID', 0, $idt);
						}
					break;
					
					case 'CODIGO-CURSO':
					break;
					
					case 'NOME-CURSO':
						$curso_nome = $v;
						if (($type == 'Graduate') or ($type == 'Specialization'))
						{
							$curso_nome .= ' - '.$cv['@attributes']['NOME-INSTITUICAO'];
						}
					break;
					
					case 'NOME-CURSO-INGLES':
						if (!isset($id_curso))
						{
							$n = trim($curso_nome).' ('.$type.')';
							$idt = $rdf -> frbr_name($n);
							$id_curso = $rdf->rdf_concept($idt, 'capes:CurseId', $orign = '');
						}
					break;
					
					case 'CODIGO-CURSO-CAPES':
						if (strlen($v) > 0)
						{
							$n = trim($curso_nome).' ('.$v.')';
						} else {
							$n = trim($curso_nome).' ('.$type.')';
						}
						$idt = $rdf -> frbr_name($n);
						$id_curso = $rdf->rdf_concept($idt, 'capes:CurseId', $orign = '');
						if (strlen($v) > 0)
						{
							$idt = $rdf -> frbr_name($v);
							$rdf->set_propriety($id_curso,'capes:ID',0,$idt);
						}
					break;
					
					case 'CODIGO-AREA-CURSO':
					break;
					
					case 'TITULO-DA-DISSERTACAO-TESE':
						if (isset($title))
						{
							if (strlen($v) > 0)
							{ $title = $v; }
						} else {
							$title = $v;	
						}					
					break;
					
					case 'TITULO-DO-TRABALHO-DE-CONCLUSAO-DE-CURSO':
						if (isset($title))
						{
							if (strlen($v) > 0)
							{ $title = $v; }
						} else {
							$title = $v;	
						}
					break;
					
					case 'NOME-COMPLETO-DO-ORIENTADOR':
						$orientador = $v;
						$orientador_lattes = $cv['@attributes']['NUMERO-ID-ORIENTADOR'];
					break;
					
					case 'ANO-DE-OBTENCAO-DO-TITULO':
						$anot = $v;
					break;
					
					case 'ANO-DE-INICIO':
						$anoi = $v;
					break;
					
					case 'ANO-DE-CONCLUSAO':
						$anof = $v;
					break;
					
					case 'STATUS-DO-CURSO':
						$status = $v;
					break;
					
					default:
					//echo '<br>'.$key.'='.$v;
				break;
			}
		}
		
		/* Vincula o curso a instituição */
		if (isset($id_inst) and (isset($id_curso)))
		{
			$rdf->set_propriety($id_inst,'capes:offerCourse',$id_curso);
		}
		
		/* Vincula o curso */
		if (isset($id_curso))
		{
			/* Viculo a formação */
			$idt = $rdf -> frbr_name($type.' - '.$curso_nome.' - '.$nome_instituicao.' - '.$lattes);
			$id_form = $rdf->rdf_concept($idt, 'EducationFormation'.$type, $orign = '');
			$rdf->set_propriety($idcv,'lattes:formation',$id_form);
			
			$idt = $rdf -> frbr_name($type);
			$id_deg = $rdf->rdf_concept($idt, 'FormationDegree', $orign = '');
			$rdf->set_propriety_update($id_form,'lattes:typeDegree',$id_deg);
			
			if (isset($anoi)) { $rdf->set_propriety_update($id_form,'lattes:startYear',$this->date($anoi));}
			if (isset($anof)) { $rdf->set_propriety_update($id_form,'lattes:endYear',$this->date($anof));}
			if (isset($anot)) { $rdf->set_propriety_update($id_form,'lattes:titulationYear',$this->date($anot));}
			if (isset($id_curso)) { $rdf->set_propriety_update($id_form,'lattes:course',$id_curso);}
			if (isset($status)) 
			{ 
				$idt = $rdf -> frbr_name($status);
				$rdf->set_propriety_update($id_form,'lattes:courseStatus',0,$idt);
			}
			
			if (isset($title)) 
			{ 
				$idt = $rdf -> frbr_name($title);
				$rdf->set_propriety_update($id_form,'hasTitleWork',0,$idt);
			}
			
			if (isset($orientador))
			{
				$term = 'cv'.$orientador_lattes;			
				$class = "lattes:CurriculoLattes";
				$item = $rdf -> frbr_name($term);
				$id_orientador = $rdf->rdf_concept($item, $class, $orign = '');
				
				$idt = $rdf -> frbr_name($orientador);
				$id_od = $rdf->rdf_concept($idt, 'frbr:Person', $orign = '');
				$prop = 'lattes:hasCvName';
				$rdf->set_propriety_update($id_orientador, $prop, $id_od, 0);
				
				$rdf->set_propriety_update($id_form,'lattes:hasCvAdvisor'.$type,$id_od);
			}
			
		}
	}
	return(1);
}

function date($n)
{
	$rdf = new rdf;
	$n = trim($n);
	if (strlen($n) == 4)
	{
		$idt = $rdf -> frbr_name($n);
		$idy = $rdf->rdf_concept($idt, 'Year', $orign = '');
		return($idy);	
	}
	if (strlen($n) == 7)
	{
		$idt = $rdf -> frbr_name($n);
		$idy = $rdf->rdf_concept($idt, 'YearMonth', $orign = '');
		return($idy);	
	}		
	if ((strlen($n) == 10) or ($n == 'NOW'))
	{
		$idt = $rdf -> frbr_name($n);
		$idy = $rdf->rdf_concept($idt, 'Date', $orign = '');
		return($idy);	
	}		
	
}

function evento($v)
{
	$rdf = new rdf;
	$n = nbr_author($v,7);
	$idt = $rdf -> frbr_name($n);
	$id_event = $rdf->rdf_concept($idt, 'lattes:AcademicEvent', $orign = '');
	return($id_event);
}

function editora($v,$cidade)
{
	$rdf = new rdf;
	$n = nbr_author($v,7);
	$idt = $rdf -> frbr_name($n);
	$id_ed = $rdf->rdf_concept($idt, 'Publishing', $orign = '');
	
	if (strlen($cidade) > 0)
	{
		$rdf->set_propriety($id_ed, 'hasPublishingPlace',$cidade);
	}
	return($id_ed);
}	

function journal($n,$issn)
{
	$rdf = new rdf;
	$n = nbr_author($n,7);
	$idt = $rdf -> frbr_name($n);
	$id_j = $rdf->rdf_concept($idt, 'lattes:Journal', $orign = '');
	
	if (strlen($issn) > 0)
	{
		if (strlen($issn) == 8)
		{
			$issn = substr($issn,0,4).'-'.substr($issn,4,4);
		}
		$idt = $rdf -> frbr_name($issn);
		$rdf->set_propriety($id_j, 'hasISSN',0 , $idt);
	}
	return($id_j);
}

function city($v,$id_uf=0)
{
	$rdf = new rdf;
	$n = nbr_author($v,7);
	$idt = $rdf -> frbr_name($n);
	$id_city = $rdf->rdf_concept($idt, 'PlaceCity', $orign = '');
	
	if ($id_uf > 0)
	{
		$rdf->set_propriety($id_uf, 'hasPlaceCity', $id_city, 0);
	}	
	return($id_city);
}

function state($v,$id_pais=0)
{
	$rdf = new rdf;
	if (strlen($v) < 3)
	{
		$n = UpperCaseSql($v);
	} else {
		$n = nbr_author($v,7);	
	}						
	$idt = $rdf -> frbr_name($n);
	$id_uf = $rdf->rdf_concept($idt, 'PlaceState', $orign = '');
	
	if ($id_pais > 0)
	{
		$rdf->set_propriety($id_pais, 'hasPlaceState', $id_uf, 0);
	}
	return($id_uf);
}	

function country($v)
{
	$rdf = new rdf;
	$n = nbr_author($v,7);
	$idt = $rdf -> frbr_name($n);
	$id_pais = $rdf->rdf_concept($idt, 'PlaceCountry', $orign = '');
	return($id_pais);
}	

/**************************************** PROCESSAR CV *************/
function processar_cv($id,$cv)
{
	$rdf = new rdf;
	$term = 'cv'.$id;			
	$class = "lattes:CurriculoLattes";
	$item = $rdf -> frbr_name($term);
	$idc = $rdf->rdf_concept($item, $class, $orign = '');
	
	if (isset($cv['@attributes']))
	{
		$att = $cv['@attributes'];
		foreach ($att as $key => $v) {
			switch($key)
			{
				case 'SISTEMA-ORIGEM-XML':
					$idt = $rdf -> frbr_name($v);
					$id_dt = $rdf->rdf_concept($idt, 'Date', $orign = '');
					$prop = 'lattes:hasCvSource';
					$rdf->set_propriety_update($idc, $prop, $id_dt, 0);	
				break;
				
				case 'NUMERO-IDENTIFICADOR':
					$idt = $rdf -> frbr_name($v);
					$prop = 'lattes:hasCvID';
					$rdf->set_propriety_update($idc, $prop, 0, $id_dt);
				break;
				
				case 'DATA-ATUALIZACAO':
					$data = substr($v,4,4).'-'.substr($v,2,2).'-'.substr($v,0,2);
					/* Data de atualização do CV */
					$idt = $rdf -> frbr_name($data);
					$id_dt = $rdf->rdf_concept($idt, 'Date', $orign = '');
					$prop = 'lattes:hasCvDateUpdate';
					$rdf->set_propriety_update($idc, $prop, $id_dt, 0);					
				break;
				
				case 'HORA-ATUALIZACAO':
					$hora = ' '.substr($v,0,2).':'.substr($v,2,2).':'.substr($v,4,2);
					$idt = $rdf -> frbr_name($hora);
					$id_dt = $rdf->rdf_concept($idt, 'Time', $orign = '');
					$prop = 'lattes:hasCvTimeUpdate';
					$rdf->set_propriety_update($idc, $prop, $id_dt, 0);
				break;
			}			
		}
		$idt = $rdf -> frbr_name('http://lattes.cnpq.br/'.$id);
		$rdf->set_propriety_update($idc, 'hasUrl', 0, $idt);
	}
	return($idc);
}

function unzip($file)
{
	$zip = new ZipArchive;
	
	$dir = '__lattes/tmp/';
	dircheck($dir);
	if (file_exists($file))
	{
		$zip = new ZipArchive;
		$zip -> open($file);
		$zip -> extractTo($dir);
		$zip -> close();
		
		/* Copy File */
		$filexml = sonumero($file).'.xml';
		$curriculo = $dir.'curriculo.xml';
		copy($curriculo,'__lattes/'.$filexml);
		/* Remove File */
		unlink($curriculo);
		/* Remove Zip File */
		unlink($file);
	} else {
		echo 'File not found!';
	}
}

function propriedades()
{
	$rdf = new rdf;
	$sql = "select d_p, c_class, c_prefix, id_c, count(*) as total 
	from rdf_data 
	inner join rdf_class ON d_p = id_c
	group by d_p, c_class, c_prefix, id_c";
	$rlt = $this->db->query($sql);
	$rlt = $rlt->result_array();
	$sx = '<table class="table">';
	for ($r=0;$r < count($rlt);$r++)
	{
		$line = $rlt[$r];
		$sx .= '<tr>';
		$sx .= '<td>'.$rdf->prefix($line['c_prefix']).':'.$line['c_class'].'</td>';
		$sx .= '<td>'.$line['id_c'].'</td>';
		$sx .= '<td>'.$line['total'].'</td>';
		$sx .= '</tr>';
	}
	$sx .= '</table>';
	return($sx);
}

function report_05($dt)
{
	$sx = '';
	$rdf = new rdf;
	
	$sql = "SELECT * FROM rdf_concept as c1 
	inner join rdf_data as dt1 ON d_r2 = c1.id_cc
	inner join rdf_data as dt2 ON dt1.d_r2 = dt2.d_r1
	
	left join rdf_class ON dt2.d_p = id_c
	left  join rdf_name ON dt2.d_literal = id_n
	
	WHERE dt1.d_p = 192";
	$rlt = $this->db->query($sql);
	$rlt = $rlt -> result_array();
	$t = 0;
	for ($r=0;$r < count($rlt);$r++)
	{
		$line = $rlt[$r];
		if ($t < 10)
		{
			$t++;
			echo '<pre>';
			print_r($line);
			echo '</pre>';
		}
	}
	
	//$nclass = trim($line['rp_query']);
	$nclass = 'hasBorn';
	$class = $rdf->find_class($nclass,0);
	$sql = "SELECT id_cc, n_name, count(*) AS total FROM `rdf_concept`
	INNER JOIN rdf_name ON cc_pref_term = id_n
	INNER JOIN rdf_data as n1 ON n1.d_r2 = id_cc
	where d_p = $class
	group by n_name, id_cc
	order by total desc";
	echo $sql;
	$rlt = $this->db->query($sql);
	$rlt = $rlt->result_array();
	$sx .= $this->show_results($rlt);
	
	return($sx);
}

function report_06($dt)
{
	$sx = '';
	$rdf = new rdf;
	//$nclass = trim($line['rp_query']);
	$nclass = 'hasCvName';
	$nclass2 = 'hasCvName';
	$class = $rdf->find_class($nclass,0);
	$class2 = $rdf->find_class($nclass2,0);
	$sql = "SELECT *, 1 as total FROM `rdf_concept`
	INNER JOIN rdf_name ON cc_pref_term = id_n
	INNER JOIN rdf_data as n1 ON n1.d_r2 = id_cc
	LEFT JOIN  rdf_data as n2 ON n1.d_r2 = n1.d_r1 and n2.d_p = $class2
	where n1.d_p = $class
	order by n_name";
	echo $sql;
	echo $sql;
	$rlt = $this->db->query($sql);
	$rlt = $rlt->result_array();
	$sx .= $this->show_results($rlt);
	
	return($sx);
}

function reports($a1,$a2,$a3)
{
	$sx = '';
	if (strlen($a1) ==0)
	{
		$sx = $this->reports_row();
	} else {
		$sql = "select * from reports where id_rp = ".round($a1);
		$rlt = $this->db->query($sql);
		$rlt = $rlt->result_array();
		$line = $rlt[0];
		
		$sx .= '<h3>'.$line['rp_name'].' ('.$line['rp_type'].')</h3>';
		switch ($line['rp_type']) {
			
			case '5':
				$sql = $line['rp_query'];
				$sql = troca($sql,'$CRB','');
				$sx .= $this->propriedades();
				$sx .= $this->report_06($a1);
			break;
			
			/***************************************** Tipo dados Simples com total */
			case '1':
				$sql = $line['rp_query'];
				$sql = troca($sql,'$CRB','');
				$sql = troca($sql,'$STUDY',$this->study);
				$rlt = $this->db->query($sql);
				$rlt = $rlt->result_array();
				$sx .= $this->show_results($rlt);
			break;
			
			/************************************ Tipo dados Simples com total RDF */
			case '2':
				$rdf = new rdf;
				$nclass = trim($line['rp_query']);
				$class = $rdf->find_class($nclass,0);
				$sql = "SELECT id_cc, n_name, count(*) AS total FROM `rdf_concept`
				INNER JOIN rdf_name ON cc_pref_term = id_n
				INNER JOIN rdf_data ON d_r2 = id_cc
				where cc_class = $class
				group by n_name, id_cc
				order by total desc";
				$rlt = $this->db->query($sql);
				$rlt = $rlt->result_array();
				$sx .= $this->show_results($rlt);
			break;
			
			/************************************ Tipo dados Simples com total RDF */
			case '3':
				$rdf = new rdf;
				$nclass = trim($line['rp_query']);
				$dtype = $line['rp_data_type'];
				$dtt = 'n_name';
				$order = 'total desc, n_name';
				if ($dtype == 'Y')
				{
					$dtt = 'substring(n_name,1,4) as n_name ';
					$order = 'n_name';
				}
				
				$class = $rdf->find_class($nclass,0);
				$sql = "
				SELECT n_name, count(*) AS total FROM 
				(
					select $dtt from `rdf_concept`
					INNER JOIN rdf_name ON cc_pref_term = id_n
					INNER JOIN rdf_data ON d_r2 = id_cc
					where d_p = $class
					) as tabela
					group by n_name
					order by $order";
					
					$rlt = $this->db->query($sql);
					$rlt = $rlt->result_array();
					$sx .= $this->show_results($rlt);
				break;				
				
				/************************************************************* DEFAULT */
				default:
				# code...
			break;
		}
	}
	return($sx);
}	

function show_results($rlt)
{
	$sx = '<table class="table">';
	$sx .= '<tr class="text-center" style="border-bottom: 2px solid #000000; border-top: 2px solid #000000;">';
	$sx .= '<th width="55%">'.msg('field').'</th>';
	$sx .= '<th width="15%">'.msg('value').'</th>';
	$sx .= '<th width="15%">'.msg('percentual').'</th>';
	$sx .= '<th width="15%">'.msg('accumulated').'</th>';
	$sx .= '</tr>';
	$total = 0;
	for ($r=0;$r < count($rlt);$r++)
	{
		$line = $rlt[$r];
		$total = $total + $line['total'];
	}
	if ($total == 0) { return(""); }		
	$tota = 0;
	for ($r=0;$r < count($rlt);$r++)
	{
		$link = '';
		$linka = '';
		$line = $rlt[$r];
		
		$sx .= '<tr>';
		foreach ($line as $key => $value) {
			if ($key == 'id_cc')
			{
				$link = '<a href="'.base_url(PATH.'/v/'.$value).'">';
				$linka = '';
			} else {
				$align = ' class="text-left"';
				if (sonumero($value) == $value)
				{
					$align = ' class="text-center"';
				}
				$sx .= '<td '.$align.'>'.$link.msg($value).$linka.'</td>';
			}
		}
		$tota = $tota + $line['total'];
		$perc = number_format(100 * $line['total'] / $total,1,',','.').'%';
		$perca = number_format(100 * $tota / $total,1,',','.').'%';
		$sx .= '<td '.$align.'>'.$perc.'</td>';
		$sx .= '<td '.$align.'>'.$perca.'</td>';
		$sx .= '</tr>'.cr();
	}
	$sx .= '<tr style="border-top: 2px solid #000000;"><td class="text-right">'.msg('total').'</td>';
	$sx .= '<td class="text-center"><b>'.$total.'</b></td>';
	$sx .= '<td class="text-center"><b>100%</b></td>';
	$sx .= '<td class="text-center"><b>100%</b></td>';
	$sx .= '</table>';
	return($sx);
}	

function reports_row()
{
	$sx = '<div class="col-md-12">';
	$sx .= '<ul>';
	$sql = "select * from reports where rp_active = 1 order by rp_order";
	$rlt = $this->db->query($sql);
	$rlt = $rlt->result_array();
	for ($r=0;$r < count($rlt);$r++)
	{
		$line = $rlt[$r];
		$sx .= '<li>';
		$sx .= '<a href="'.base_url(PATH.'reports/'.$line['id_rp']).'">';
		$sx .= $line['rp_name'];
		$sx .= '</a>';
		$sx .= '</li>';
	}
	$sx .= '</ul>';
	$sx .= '</div>';
	return($sx);
}
}
?>