<?php
class lattes extends CI_Model {
	function readXML($link, $id, $harvesting = 1) {
		$dir = '_tmp';
		$file = $dir . '\lattes_' . $id . '.zip';
		echo '<hr>' . $file . '<hr>';

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

			/* LE O XML */
			$dom = xml_dom();
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
			$artigos = $dom -> getElementsByTagName("ARTIGOS-PUBLICADOS");
			foreach ($artigos as $artigo) {
				$art1 = $artigo -> getElementsByTagName("ARTIGO-PUBLICADO");
				foreach ($art1 as $art2) {
					$artg['NATUREZA'] = $art2 -> getAttribute("NATUREZA");
					$artg['TITULO'] = $art2 -> getAttribute("TITULO-DO-ARTIGO");
					$artg['ANO'] = $art2 -> getAttribute("ANO-DO-ARTIGO");
					$artg['IDIOMA'] = $art2 -> getAttribute("IDIOMA");

					print_r($artg);
					echo '<hr>';
				}
			}
			exit ;

			$ddt = $dom -> getElementsByTagName("DADOS-BASICOS-DO-ARTIGO");
			$r = 0;
			$artigo = array();
			foreach ($ddt as $art) {
				$artg = array();
				$artg['NATUREZA'] = $art -> getAttribute("NATUREZA");
				$artg['TITULO'] = $art -> getAttribute("TITULO-DO-ARTIGO");
				$artg['ANO'] = $art -> getAttribute("ANO-DO-ARTIGO");
				$artg['IDIOMA'] = $art -> getAttribute("IDIOMA");
				$artigo[$r] = $artg;
				$r++;
			}
			$r = 0;
			$ddt = $dom -> getElementsByTagName("DETALHAMENTO-DO-ARTIGO");
			foreach ($ddt as $art) {
				$artigo[$r]['TITULO-DO-PERIODICO-OU-REVISTA'] = $art -> getAttribute("TITULO-DO-PERIODICO-OU-REVISTA");
				$artigo[$r]['ISSN'] = $art -> getAttribute("ISSN");
				$artigo[$r]['VOLUME'] = $art -> getAttribute("VOLUME");
				$artigo[$r]['SERIE'] = $art -> getAttribute("SERIE");
				$artigo[$r]['PAGINA-INICIAL'] = $art -> getAttribute("PAGINA-INICIAL");
				$artigo[$r]['PAGINA-FINAL'] = $art -> getAttribute("PAGINA-FINAL");
				//$artigo[$r]['VOLUME'] = $art -> getAttribute("VOLUME");
				$r++;
			}
			echo '<pre>';
			print_r($artigo);
			echo '</pre>';

			/* XML */
			$searchNode = $dom -> getElementsByTagName("AREA-DE-ATUACAO");
			foreach ($searchNode as $searchNode) {
				echo '<b>' . $searchNode -> getAttribute("NOME-GRANDE-AREA-DO-CONHECIMENTO") . '</b>';
				echo ' - ';
				echo '<b>' . $searchNode -> getAttribute("NOME-DA-AREA-DO-CONHECIMENTO") . '</b>';
				echo ' - ';
				echo '<b>' . $searchNode -> getAttribute("NOME-DA-SUB-AREA-DO-CONHECIMENTO") . '</b>';
				echo '<hr>';
			}
		} else {
			echo 'failed';
		}
		$dt['artigos'] = $artigo;
		return ($dt);
	}

}
?>
