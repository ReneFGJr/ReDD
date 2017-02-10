<?php
class thesas extends CI_Model {
	function xml_open($url) {

		$dir = '_tmp';
		$file = $dir . '\inport.xml';

		if (!is_dir($dir)) {
			mkdir($dir);
		}

		$fl = new curl($url);
		$fl -> execute();
		$xml_zip = $fl -> last_response;

		/* Save File */
		$rlt = fopen($file, 'w+');
		fwrite($rlt, $xml_zip, strlen($xml_zip));
		fclose($rlt);

		$xmlDoc = new DOMDocument();
		$xmlDoc -> load($file);

		$x = $xmlDoc -> documentElement;

		$resource = '';
		$class = '';
		$value = '';
		
		$resource = $xmlDoc -> getElementsByTagName("uri") -> item(0) -> nodeValue;
		$value = $xmlDoc -> getElementsByTagName("literal") -> item(0) -> nodeValue;
		$class = $xmlDoc -> getElementsByTagName("subclass") -> item(0) -> nodeValue;

		if (strlen($value) > 0) {
			$sql = "select * from rdf 
					where rdf_resource = '$resource' ";
			$rlt = $this -> db -> query($sql);
			$rlt = $rlt -> result_array();
			if (count($rlt) == 0) {
				$sql = "insert into rdf
						(
							rdf_resource, rdf_value, rdf_class
						)
						values
						(
							'$resource','$value','$class'
						)";
			} else {
				$sql = "update rdf set
							rdf_value = '$value',
							rdf_class = '$class'
						where rdf_resource = '$resource' ";
			}
			$rlt = $this->db->query($sql);
		}
		//exit;
	}

}
?>
