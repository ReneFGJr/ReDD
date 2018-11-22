<?php
class dspace extends CI_model {
	var $dir = 'v:/processamento';
	function cip($lote = '') {
		/* Checar pasta CIP */
		$sip = $this -> dir . '/SIP';
		if (!is_dir($sip)) {
			mkdir($sip);
		}
		$sip = $this -> dir . '/SIP/' . $lote;
		if (!is_dir($sip)) {
			//echo $sip;
			mkdir($sip);
		}
	}

	function phase_i($lote, $fld) {
		/********************************************************************************************************* Criar diretorios */
		$sip = $this -> dir . '/SIP/' . $lote;
		if (!is_dir($sip)) {
			//echo $sip;
			mkdir($sip);
		}
		$sip = $this -> dir . '/SIP/' . $lote . '/' . round($fld);
		if (!is_dir($sip)) {
			//echo $sip;
			mkdir($sip);
		}
		return ($sip);
	}

	function phase_ii($lote, $fld, $pth) {
		$sx = '';
		$this -> load -> model("Coversheet");
		$sip = $this -> dir . '/SIP/' . $lote . '/' . round($fld);
		$file = $sip . '/' . 'cover.pdf';
		$sx .= $file . '<br>';
		if (!file_exists($file)) {
			$this -> Coversheet -> pdf($fld, $file);
		}
		return ($sx);
	}

	function phase_iii($lote, $fld, $pth) {
	    $sx = '';
		set_time_limit(0);
		/********************************************************************************************************* Transfere arquivos */
		$sip_dir = $this -> dir . '/SIP/' . $lote . '/' . round($fld);
		$sip = $sip_dir . $fld;
		$source = $this -> dir . '/' . $pth;
		$cover = $sip_dir . '/' . 'cover.pdf';
		$files1 = scandir($source);
		$files = array();
		for ($r = 0; $r < count($files1); $r++) {
			$fl = $files1[$r];
			
			if (strpos($fl,'-') > 0)
				{
					$ff = substr($fl, 0, strpos($fl, '-'));		
				} else {
					$ff = substr($fl, 0, strpos($fl, '.'));
				}
			
			$out = $sip_dir . '/' . 'emater_rs_' . $fl;
		
			if (sonumero($ff) == $fld) {
				$pdf = $source . '/' . $fl;									
				/* JOIN PDF */
				if (!file_exists($out)) {
					$cmd = 'dir';
					$cmd = 'gswin64.exe -dSAFER -dBATCH -dNOPAUSE -sDEVICE=pdfwrite -sOutputFile=' . $out . ' ' . $cover . ' ' . $pdf . '';
					$sx .= '<br>' . $cmd;
					$tela = shell_exec($cmd);
					$sx .= '<pre>' . $tela . '</pre>';
				}
			}
		}
        return($sx);
	}

	function phase_v($lote, $fld, $pth) {
		// license.txt
		/********************************************************************************************************* Transfere arquivos */
		$sip_dir = $this -> dir . '/SIP/' . $lote . '/' . round($fld);

		$licence = $sip_dir . '/license.txt';
		if ((!file_exists($licence)) or (filesize($licence) == 0)) {
			$txt = 'Os documentos disponibilizados no Repositório Institucional da Extensão Rural Gaúcha são protegidos pela Lei de Direito Autoral, nº 9.610, de 19 de fevereiro de 1998, que veta a reprodução ou reutilização dos mesmos, salvo para uso particular, desde que mencionada a fonte, ou com autorização prévia da Emater/RS-Ascar. Também é atribuída a licença Creative Commons - Atribuição-SemDerivações-SemDerivados (CC BY-NC-ND), que permite o download e compartilhamento dos documentos, desde que seja atribuído o crédito a Emater/RS-Ascar, não sendo permitido alterá-los de nenhuma forma ou utilizá-los para fins comerciais.';

			$hdl = fopen($licence, 'w+');
			fwrite($hdl, $txt);
			fclose($hdl);
		}
		return (1);
	}

	function phase_iv($lote, $fld, $pth) {
		global $handle;
		$sip_dir = $this -> dir . '/SIP/' . $lote . '/' . round($fld);
		// dublin_core.xml
		$srv = $this -> source_function;
		$dt = $this -> $srv -> data($fld);

		$x = '';
		$x .= '<?xml version="1.0" encoding="utf-8" standalone="no"?>' . cr();
		$x .= '<dublin_core schema="dc">' . cr();

		foreach ($dt as $key => $value) {
			//echo '<br>===>'.$key;
			switch($key) {
				
				case 'description.escala' :
					$v = $value;
					asort($v);
					$vx = '';
					foreach ($v as $k1 => $v1) {
						if ($v1 != $vx) {
							//$x .= '<dcvalue element="description" qualifier="escala" language="pt_BR">' . $v1 . '</dcvalue>' . cr();
							$x .= '<dcvalue element="description" qualifier="none" language="pt_BR">' . $v1 . '</dcvalue>' . cr();
						}
						$vx = $v1;
					}
					break;				
				case 'subject' :
					$v = $value;
					asort($v);
					$vx = '';
					foreach ($v as $k1 => $v1) {
						if ($v1 != $vx) {
							$x .= '<dcvalue element="subject" qualifier="none" language="pt_BR">' . $v1 . '</dcvalue>' . cr();
						}
						$vx = $v1;
					}
					break;
				case 'subject.entidade' :
					$v = $value;
					asort($v);
					$vx = '';
					foreach ($v as $k1 => $v1) {
						if ($v1 != $vx) {
							//$x .= '<dcvalue element="subject" qualifier="entidade" language="pt_BR">' . $v1 . '</dcvalue>' . cr();
							$x .= '<dcvalue element="subject" qualifier="none" language="pt_BR">' . $v1 . '</dcvalue>' . cr();
						}
						$vx = $v1;
					}
					break;	
				case 'subject.evento' :
					$v = $value;
					asort($v);
					$vx = '';
					foreach ($v as $k1 => $v1) {
						if ($v1 != $vx) {
							//$x .= '<dcvalue element="subject" qualifier="evento" language="pt_BR">' . $v1 . '</dcvalue>' . cr();
							$x .= '<dcvalue element="subject" qualifier="none" language="pt_BR">' . $v1 . '</dcvalue>' . cr();
						}
						$vx = $v1;
					}
					break;
				case 'subject.topico' :
					$v = $value;
					asort($v);
					$vx = '';
					foreach ($v as $k1 => $v1) {
						if ($v1 != $vx) {
							//$x .= '<dcvalue element="subject" qualifier="topico" language="pt_BR">' . $v1 . '</dcvalue>' . cr();
							$x .= '<dcvalue element="subject" qualifier="none" language="pt_BR">' . $v1 . '</dcvalue>' . cr();
						}
						$vx = $v1;
					}
					break;
				case 'coverage.spatial' :
					$v = $value;
					asort($v);
					$vx = '';
					foreach ($v as $k1 => $v1) {
						if ($v1 != $vx) {
							$x .= '<dcvalue element="coverage" qualifier="spatial" language="pt_BR">' . $v1 . '</dcvalue>' . cr();
						}
						$vx = $v1;
					}
					break;
				case 'subject.NaoControlado' :
					$v = $value;
					asort($v);
					$vx = '';
					foreach ($v as $k1 => $v1) {
						if ($v1 != $vx) {
							//$x .= '<dcvalue element="subject" qualifier="NaoControlado" language="pt_BR">' . $v1 . '</dcvalue>' . cr();
							$x .= '<dcvalue element="subject" qualifier="none" language="pt_BR">' . $v1 . '</dcvalue>' . cr();
						}
						$vx = $v1;
					}
					break;																								
				case 'contributor.AuthorPessoal' :
					$v = $value;
					asort($v);
					$vx = '';
					foreach ($v as $k1 => $v1) {
						if ($v1 != $vx) {
							//$x .= '<dcvalue element="contributor" qualifier="AuthorPessoal" language="pt_BR">' . $v1 . '</dcvalue>' . cr();
							$x .= '<dcvalue element="contributor" qualifier="author" language="pt_BR">' . $v1 . '</dcvalue>' . cr();
						}
						$vx = $v1;
					}
					break;
				case 'format.extent':
					//$x .= '<dcvalue element="format" qualifier="extent" language="pt_BR">'.$value.'</dcvalue>'.cr();
					$x .= '<dcvalue element="format" qualifier="none" language="pt_BR">'.$value.'</dcvalue>'.cr();
					$x .= '<dcvalue element="description" qualifier="none" language="pt_BR">'.$value.'</dcvalue>'.cr();
					break;
				case 'contributor.AuthorEntidade' :
					$v = $value;
					asort($v);
					$vx = '';
					foreach ($v as $k1 => $v1) {
						if ($v1 != $vx) {
							//$x .= '<dcvalue element="contributor" qualifier="AuthorEntidade" language="pt_BR">' . $v1 . '</dcvalue>' . cr();
							$x .= '<dcvalue element="contributor" qualifier="author" language="pt_BR">' . $v1 . '</dcvalue>' . cr();
						}
						$vx = $v1;
					}
					break;
				case 'contributor.AuthorEvento' :
					$v = $value;
					asort($v);
					$vx = '';
					foreach ($v as $k1 => $v1) {
						if ($v1 != $vx) {
							//$x .= '<dcvalue element="contributor" qualifier="AuthorEvento" language="pt_BR">' . $v1 . '</dcvalue>' . cr();
							$x .= '<dcvalue element="contributor" qualifier="author" language="pt_BR">' . $v1 . '</dcvalue>' . cr();
						}
						$vx = $v1;
					}					
					break;					
				case 'title':	
					$x .= '<dcvalue element="title" qualifier="none" language="pt_BR">'.$value.'</dcvalue>'.cr();
					break;
				case 'sponsorship':
					$x .= '<dcvalue element="description" qualifier="sponsorship" language="pt_BR">Sponsors: '.$value.'</dcvalue>'.cr();
					break;
				case 'ispartofseries':
					$x .= '<dcvalue element="relation" qualifier="ispartofseries">'.$value.'</dcvalue>'.cr();
					break;
				case 'publisher':
					$x .= '<dcvalue element="publisher" qualifier="none" language="pt_BR">'.$value.'</dcvalue>'.cr();					
					break;	
				case 'date.created':
					$x .= '<dcvalue element="date" qualifier="issued">'.$value.'</dcvalue>'.cr();
					break;
				case 'type':
					$x .= '<dcvalue element="type" qualifier="none" language="pt_BR">'.$value.'</dcvalue>'.cr();
					break;	
				case 'description':
					$v = $value;
					asort($v);
					$vx = '';
					foreach ($v as $k1 => $v1) {
						if ($v1 != $vx) {
							$x .= '<dcvalue element="description" qualifier="none" language="pt_BR">' . $v1 . '</dcvalue>' . cr();
						}
						$vx = $v1;
					}				
					break;
																
			}
		}
		$x .= '<dcvalue element="language" qualifier="iso" language="pt_BR">Português (pt_BR)</dcvalue>'.cr();
		$x .= '<dcvalue element="identifier" qualifier="uri">'.htmlentities('http://hdl.handle.net/'.$handle.'/'.round($fld)).'</dcvalue>'.cr();
		//$x .= '<dcvalue element="identifier" qualifier="uri">'.htmlentities('http://hdl.handle.net/'.$handle.'/'.$fld).'</dcvalue>'.cr();
		$x .= '<dcvalue element="date" qualifier="accessioned">'.date("Y-m-d").'T'.date("H:i:s").'Z</dcvalue>'.cr();
		$x .= '</dublin_core>';
		
		$content = $sip_dir . '/dublin_core.xml';
		$hdl = fopen($content, 'w+');
		fwrite($hdl, $x);
		fclose($hdl);		

	}

	function phase_viii($lote, $fld, $pth) {
		// contents
		$sip_dir = $this -> dir . '/SIP/' . $lote . '/' . round($fld);
		$files1 = scandir($sip_dir);
		$sx = '';
		for ($r = 0; $r < count($files1); $r++) {
			$f = $files1[$r];
			$ext = substr($f, strlen($f) - 4, 4);
			if ($ext == '.pdf') {
				$sx .= $f . '	bundle:ORIGINAL' . cr();
			}
			if ($f == 'license.txt') {
				$sx .= $f . '	bundle:LICENSE' . cr();
			}
		}

		// 0001.pdf	    bundle:ORIGINAL
		// license.txt	bundle:LICENSE

		$content = $sip_dir . '/contents';
		$hdl = fopen($content, 'w+');
		fwrite($hdl, $sx);
		fclose($hdl);
	}

	function phase_vi($lote, $fld, $pth) {
		// handle
		/********************************************************************************************************* Transfere arquivos */
		global $handle;
		$sip_dir = $this -> dir . '/SIP/' . $lote . '/' . round($fld);

		$handle_file = $sip_dir . '/handle';
		//if ((!file_exists($handle)) or (filesize($handle) == 0)) 
		{
			//$txt = $handle . '/' . sonumero($fld);
            $txt = $handle . '/' . round(sonumero($fld));
			$hdl = fopen($handle_file, 'w+');
			fwrite($hdl, $txt);
			fclose($hdl);
		}
		return (1);
	}

	function phase_vii($lote, $fld, $pth) {
		/* Remove Cover.pdf */
		$sip_dir = $this -> dir . '/SIP/' . $lote . '/' . $fld;
		$cover = $sip_dir . '/cover.pdf';
		if (file_exists($cover)) {
			unlink($cover);
		}
	}

	function gerar_cip($lote = '') {
		$this -> cip($lote);
	}

	function diretorio($pth = '', $lote) {
	    global $handle;
		$dir = $this -> dir;
		if (strlen($pth) > 0) {
			$dir .= '/' . $pth;
		}
		$files1 = scandir($dir);
		$file = array();
		$sx = '<tt>';
		foreach ($files1 as $key => $value) {
			$link = '<a href="' . base_url('index.php/handle/process' . $pth . '/' . $value) . '">';
			$linka = '</a>';
			if (!is_dir($dir . '/' . $value)) {
				$linka = '';
				$link = '';
				array_push($file, $value);

				if (strpos($value, '.pdf') > 0) {
					if (strpos($value,'-') > 0)
						{
							$nr = substr($value, 0, strpos($value, '-'));		
						} else {
							$nr = substr($value, 0, strpos($value, '.'));
						}
					
					$nr = sonumero($nr);
					$this -> phase_i($lote, $nr);
					$this -> phase_ii($lote, $nr, $pth);
					$this -> phase_iii($lote, $nr, $pth);
					$this -> phase_iv($lote, $nr, $pth);
					/* Dublin Core */
					$this -> phase_v($lote, $nr, $pth);
					$this -> phase_vi($lote, $nr, $pth);
					$this -> phase_vii($lote, $nr, $pth);
					$this -> phase_viii($lote, $nr, $pth);
                    $sx .= '<br>==>'.$handle.'<br>';
				}

				$sx .= $link . $value . $linka . '<br>';
			} else {
				$sx .= '[dir] <span color="blue"><b>' . $link . $value . $linka . '</b></span><br>';
			}

		}
		$sx .= '</tt>';
		$sx .= 'Total ' . count($file) . ' files to process';
		return ($sx);
	}

}
?>
