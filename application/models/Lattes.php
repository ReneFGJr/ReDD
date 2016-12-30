<?php
class lattes extends CI_Model {
	function readXML($link) {
		$dir = '_tmp';
		$harvesting = 0;
		$file = $dir . '\lattes.zip';

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

			/* XML */
			$dom = xml_dom();
			$dom -> load($dir . '/curriculo.xml');
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
	}

}
?>
