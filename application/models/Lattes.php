<?php
class lattes extends CI_Model {
	function readXML($link, $id, $harvesting = 1) {
		$dir = '_tmp';
		$file = $dir . '\lattes_'.$id.'.zip';

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
			$cv = $dom->getElementsByTagName( "CURRICULO-VITAE" );
			foreach( $cv as $cvs )
				{
					$dta = $cvs->getAttribute("DATA-ATUALIZACAO");
					$dta = substr($dta,4,4).substr($dta,2,2).substr($dta,0,2);
					
					
					$nid = $cvs->getAttribute("NUMERO-IDENTIFICADOR");
					$dt['atualizado'] = $dta;
					while (strlen($nid) < 16) { $nid = '0'.$nid; }
					$dt['numero_id'] = $nid;
				}

			/* PRODUCAO BIBLIOGRAFICA */
			$PD = $dom->getElementsByTagName( "PRODUCAO-BIBLIOGRAFICA" );
			foreach ($PD as $ptipos) {
				print_r($ptipos);
				/* Trabalhos em eventos */
				$trbs = $ptipos->getElementsByTagName( "TRABALHOS-EM-EVENTOS" );
				echo '<hr>';
				print_r($trbs);
				echo '<hr>';
			}
			

			/* XML */
			$searchNode = $dom->getElementsByTagName( "AREA-DE-ATUACAO" );
			foreach( $searchNode as $searchNode )
				{
					echo '<b>'.$searchNode->getAttribute("NOME-GRANDE-AREA-DO-CONHECIMENTO").'</b>';
					echo ' - ';
					echo '<b>'.$searchNode->getAttribute("NOME-DA-AREA-DO-CONHECIMENTO").'</b>';
					echo ' - ';
					echo '<b>'.$searchNode->getAttribute("NOME-DA-SUB-AREA-DO-CONHECIMENTO").'</b>';
					echo '<hr>';					
				}
		} else {
			echo 'failed';
		}			
		return($dt);
	}

}
?>
