<?php
class coversheet extends CI_Model {
	var $handle = '2050012287';
	var $table = 'metadados_emater';
	
	function row()
		{
			$cp = array();
			array_push($cp,array('$H8','','',false,false));
			array_push($cp,array('$N8','','nº patrimonio',true,true));
			$form = new form;
			$tela = $form->editar($cp,'');
			return($tela);
		}
	function pdf($id,$file='') {
		$dc = $this -> data($id);
		
		$this->create_pdf($dc,$file);
		//echo '<pre>';
		//print_r($dc);
	}
	
	function join_pdf()
		{
			//gs -dBATCH -dNOPAUSE -q -sDEVICE=pdfwrite -dPDFSETTINGS=/prepress -sOutputFile=out.pdf in1.pdf in2.pdf
		}

	function create_pdf($dc,$file='') {
		$title = '';
		$type = '';
		$year = '';
		$subj = '';
		$author = '';
		$sub = '';
		
		$dc = $dc['dc'];
		$id = $dc['id'];
		$handle = 'http://hdl.handle.net/'.$this->handle.'/'.$id;

		foreach ($dc as $vlr => $fld) {
			switch($fld)
				{
				case 'subtitle':
					$sub = ': '.troca($vlr,'/','');
					break;					
				case 'title':
					$title = $vlr;
					break;
				case 'type':
					$type = $vlr;
					break;
				case 'date.created':
					$year = $vlr;
					break;
				case 'subject.topico':
					$subj .= $vlr.'. ';
					break;
				case 'contributor.AuthorPessoal':
					$author .= $vlr.'. ';
					break;
				case 'contributor.AuthorEntidade':
					$author .= $vlr.'. ';
					break;
				case 'contributor.AuthorEvento':
					$author .= $vlr.'. ';
					break;
				}
			
		}
		//echo '<pre>';		
		//print_r($dc);
		//exit;
		
		// create new PDF document
		//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		
		$pageLayout = array(490, 693); //  or array($height, $width) 
		$pdf = new TCPDF('p', 'pt', $pageLayout, true, 'UTF-8', false);

		// set document information
		$pdf -> SetCreator(PDF_CREATOR);
		$pdf -> SetAuthor(trim($author));
		$pdf -> SetTitle($title);
		$pdf -> SetSubject(trim($subj));
		$pdf -> SetKeywords(trim($subj).' '.$handle);

		// set header and footer fonts
		$pdf -> setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

		// set default monospaced font
		$pdf -> SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf -> SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf -> SetHeaderMargin(0);
		$pdf -> SetFooterMargin(0);

		// remove default footer
		$pdf -> setPrintFooter(false);

		// set auto page breaks
		$pdf -> SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf -> setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
			require_once (dirname(__FILE__) . '/lang/eng.php');
			$pdf -> setLanguageArray($l);
		}

		// ---------------------------------------------------------

		// set font
		$pdf -> SetFont('times', '', 12);

		// add a page
		$pdf -> AddPage();


		// get the current page break margin
		$bMargin = $pdf -> getBreakMargin();
		// get current auto-page-break mode
		$auto_page_break = $pdf -> getAutoPageBreak();
		// disable auto-page-break
		$pdf -> SetAutoPageBreak(false, 0);
		// set bacground image
		$path = getcwd();
		$img_file = $path.'/img/cover_page/cp_emater.jpg';
		$pdf -> Image($img_file, 0, 0, 490, 693, '', '', '', false, 300, '', false, false, 0); /* ok */

		// restore auto-page-break status
		$pdf -> SetAutoPageBreak($auto_page_break, $bMargin);
		// set the starting point for the page content
		$pdf -> setPageMark();
		$pdf->SetFont('helvetica', '', 14);
		//$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

		// Print a text
		$html = '<table style="color: #303030;">
				<tr><td width="90">
				</td>
				<td width="430" align="center">
				<span style="font-size: 16px;"><b>'.$title.'</b>'.$sub.'</span><br>
				<span style="font-size: 12px;"><i>'.troca($author,'..','.').'</i></span>
				</td></tr>
				</table>';
		$pdf->setxy(0,198); /* ok */
		$pdf -> writeHTML($html, true, false, true, false, '');
		
		// Print a text
		$html = '<table style="color: #303030;">
				<tr><td width="90">
				</td>
				<td width="430" align="center">
				<span style="font-size: 10px;"></span><br>
				<span style="font-size: 10px;">'.$type.' / '.$year. '</span>
				</td></tr>
				</table>';
		$pdf->setxy(0,272);
		$pdf -> writeHTML($html, true, false, true, false, '');


		// Print a text
		$html = '<table style="color: #303030;">
				<tr><td width="80">
				</td>
				<td width="225" align="left">
				<span style="font-size: 14px;">&nbsp;</span><br>
				<span style="font-size: 10px;">Cód. Acervo: '.$id.'</span>
				</td>
				<td width="230" align="right">
				<span style="font-size: 14px;">&nbsp;</span><br>
				<span style="font-size: 10px;">&copy; Emater/RS-Ascar</span>
				</td>				
				</tr>
				</table>';
		$pdf->setxy(0,290);
		$pdf -> writeHTML($html, true, false, true, false, '');

		// Print a text
		$html = '<table style="color: #303030;">
				<tr>
				<td width="75">
				</td>
				<td width="470" style="font-size: 8px; text-align: justify;">
O Repositório Institucional (RI) da Extensão Rural Gaúcha é uma realização da Biblioteca Bento Pires Dias, da Emater/RS-Ascar, em parceria com o Centro de Documentação e Acervo Digital da Pesquisa da Universidade Federal do Rio Grande do Sul (CEDAP/UFRGS) que
teve início em 2017 e objetiva a preservação digital, aplicando metodologias específicas, das coleções de documentos publicados pela Emater/RS-
Ascar.<br><br>
Os documentos remontam ao início dos trabalhos de extensão rural no Rio Grande do Sul, a partir da década de 1950. Portanto, salienta-se que
estes podem apresentar informações e/ou técnicas desatualizadas ou obsoletas.
<br><ol style="font-size: 8px; text-align: justify;">
<li>Os documentos disponibilizados neste RI são provenientes da coleção documental da Biblioteca Eng. Agr. Bento Pires Dias, custodiadora
dos acervos institucionais da Emater/RS-Ascar. Sua utilização se enquadra nos termos da Lei de Direito Autoral, nº 9.610, de 19 de
fevereiro de 1998.</li>
<li>É vetada a reprodução ou reutilização dos documentos disponibilizados neste RI, protegidos por direitos autorais, salvo para uso particular
desde que mencionada a fonte, ou com autorização prévia da Emater/RS-Ascar, nos termos da Lei de Direito Autoral, nº 9.610, de 19 de
fevereiro de 1998.</li>
<li>O usuário deste RI se compromete a respeitar as presentes condições de uso, bem como a legislação em vigor, especialmente em matéria
de direitos autorais. O descumprimento dessas disposições implica na aplicação das sanções e penas cabíveis previstas na Lei de Direito
Autoral, nº 9.610, de 19 de fevereiro de 1998 e no Código Penal Brasileiro.</li>
</ol>
Para outras informações entre em contato com a Biblioteca da Emater/RS-Ascar   - E-mail: biblioteca@emater.tche.br				
				</td>
				</tr>
				</table>';
		$pdf->setxy(0,459);
		$pdf -> writeHTML($html, true, false, true, false, '');
		
		// Print a text
		// Print a text
		$html = '<table style="color: #303030;">
				<tr><td width="90">
				</td>
				<td width="455" align="right">
				<span style="font-size: 7px;">Disponível em: '.$handle.'</span><br>
				<span style="font-size: 7px;">Documento gerado em: '.date("d/m/Y H:i").'</span>
				</td>				
				</tr>
				</table>';
		$pdf->setxy(0,426);
		$pdf -> writeHTML($html, true, false, true, false, '');

				// QRCODE,Q : QR-CODE Better error correction
				// set style for barcode
				$style = array('border' => 2, 'vpadding' => 'auto', 'hpadding' => 'auto', 'fgcolor' => array(0, 0, 0), 'bgcolor' => false, //array(255,255,255)
				'module_width' => 1, // width of a single module in points
				'module_height' => 1 // height of a single module in points
				);
				$pdf -> write2DBarcode($handle, 'QRCODE,Q', 62, 375, 75, 75, $style, 'N');

		// ---------------------------------------------------------

		//Close and output PDF document
		if (strlen($file) > 0)
			{
				$pdf -> Output($file,'F');		
			} else {
				$pdf -> Output('teste.pdf', 'I');
			} 
				
		

	}

	function data($id) {
		$sql = "select * from ".$this->table." where cod_acervo = $id";
		$rlt = $this -> db -> query($sql);
		$rlt = $rlt -> result_array();

		$dc = array();
		$dcc = array();
		$dcc['id'] = $id;
		$dcc['subject'] = array();
		for ($r = 0; $r < count($rlt); $r++) {
			$line = $rlt[$r];
			$cod = trim($line['paragrafo']);
			$name = trim($line['var2']);
			//echo '<br>==>' . $cod . '===' . $name;
			switch($cod) {
				/********************** chamada *******************/
				case '90' :
					$nome = $this -> extract($name, '$a');
					if (strlen($nome) > 0) {
						$dcc[$nome] = 'identifier.localizacao';
					}
					break;
				/********************** autoridade pessoa *******************/
				case '100' :
					$nome = $this -> extract($name, '$a');
					if (strlen($nome) > 0) {
						$dcc[$nome] = 'contributor.AuthorEntidade';
					}
					break;
				case '700' :
					$nome = $this -> extract($name, '$a');
					if (strlen($nome) > 0) {
						$dcc[$nome] = 'contributor.AuthorEntidade';
					}
					break;

				/********************** autoridade instituicao **************/
				case '110' :
					$nome = $this -> extract($name, '$a');
					if (strlen($nome) > 0) {
						$dcc[$nome] = 'contributor.AuthorEntidade';
					}
					break;
				case 'A710' :
					$nome = $this -> extract($name, '$a');
					if (strlen($nome) > 0) {
						$dcc[$nome] = 'contributor.AuthorEntidade';
					}
					break;

				/********************** autoridade instituicao **************/
				case '111' :
					$nome = $this -> extract($name, '$a');
					if (strlen($nome) > 0) {
						$dcc[$nome] = 'contributor.AuthorEvento';
					}
					break;
				case 'A711' :
					$nome = $this -> extract($name, '$a');
					if (strlen($nome) > 0) {
						$dcc[$nome] = 'contributor.AuthorEvento';
					}
					break;

				/********************** assunto **************/
				case '245' :
					$nome = $this -> extract($name, '$a');
					$sub = $this -> extract($name, '$b');				
					if (strlen($nome) > 0) {
						$nome = trim(troca($nome,'/',''));
						$nome = trim(troca($nome,':',''));
						if (strlen($sub) > 0)
							{
								$sub = trim(troca($sub,':',''));
								$sub = trim(troca($sub,'/',''));
								$sub = trim($sub);
								$dcc[$sub] = 'subtitle';
							}
						$dcc[$nome] = 'title';
					}
					break;
				/********************** assunto **************/
				case '246' :
					$nome = $this -> extract($name, '$a');
					if (strlen($nome) > 0) {
						$dcc[$nome] = 'title.alternative';
					}
					break;
				/********************** assunto **************/
				case '260' :
					$nome = trim($this -> extract($name, '$a'));
					$nome .= ' ' . troca(trim($this -> extract($name, '$b')), ',', '');
					$nome = troca($nome, ' :', ':');
					$nome = trim($nome);
					if (strlen($nome) > 0) {
						$dcc[$nome] = 'publisher';
					}
					
					$nome = trim($this -> extract($name, '$c'));
					if (strlen($nome) > 0) {
						$nome = troca($nome,'.','');
						$dcc[$nome] = 'date.created';
					}
					break;
				/********************** assunto **************/
				case '300' :
					$nome = $name;
					
					$nome1 = trim($this -> extract($name, '$a'));
					$nome2 = trim($this -> extract($name, '$b'));
					$nome3 = trim($this -> extract($name, '$c'));
					$nome = trim($nome1.' '.$nome2.' '.$nome3);
					if (strlen($nome) > 0) {
						$dcc[$nome] = 'format.extent';
					}
					if (strpos(' '.$name,'$3'))
						{
							$nome = trim($this -> extract($name, '$3'));
							if (strlen($nome) > 0) {
								$dcc[$nome] = 'type';
							}
						}
					
					break;

				/********************** assunto **************/
				case '650' :
					$nome = $this -> extract($name, '$a');
					if (strlen($nome) > 0) {
						array_push($dcc['subject'],$nome);
						//$dcc[$nome] = 'subject.topico';
					}
					break;
				/********************** assunto local **************/
				case '651' :
					$nome = $this -> extract($name, '$a');
					if (strlen($nome) > 0) {
						if (!isset($dcc[$nome]))
							{
								array_push($dcc['subject'],$nome);
								//$dcc[$nome] = 'coverpage.spatial';
							}
					}
					break;
				/********************** documento empresa **************/
				case '653' :
					$nome = trim($this -> extract($name, '$a'));
					if (strlen($nome) > 0) {
						if (!isset($dcc[$nome]))
							{
								array_push($dcc['subject'],$nome);
								//$dcc[$nome] = 'coverpage.NaoControlado';
							}
					}
					break;
			}
		}
		$dc['dc'] = $dcc;
		//echo '<pre>';
		//print_r($dcc);
		//exit;
		return ($dc);
	}

	function extract($v, $f) {
		if (strpos(' ' . $v, $f) > 0) {
			$n = substr($v, strpos($v, $f) + 2, strlen($v));
			if (strpos($n, '$') > 0) {
				$n = trim(substr($n, 0, strpos($n, '$')));
				if (substr($n, strlen($n) - 1, 1) == ':') {
					$n = trim(substr($n, 0, strlen($n) - 1));
				}
			}
			return (trim($n));
		} else {
			return ('');
		}
	}

}
?>
