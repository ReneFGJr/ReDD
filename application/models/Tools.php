<?php
class tools extends CI_model {
	function file_upload() {
		$sx = '
				<form method="post" enctype="multipart/form-data">
					<div class="col-md-5" style="border: 1px solid #000000; border-radius: 20px; padding: 10px 20px;">
					<h4>Upload</h4>
				    Selecione o arquivo para Upload<br>
				    <input type="file" name="fileToUpload" id="fileToUpload">
				    <input type="submit" value="Enviar arquivo >>" name="submit">
				    </div>
				</form>';
		return ($sx);
	}

	function checadir($d) {
		if (!is_dir($d)) {
			//echo '<br>===criando==>'.$d;
			mkdir($d);
		} else {
			//echo "OK ".$d.' - ';
		}
		return (1);
	}

	function open($f) {
		$sx = '';
		$ext = $this -> file_extension($f);
		switch ($ext) {
			case 'csv' :
				$sx = $this -> tools -> open_csv($f);
				break;
		}
		return ($sx);
	}

	function terms($t) {
		$t = troca($t, chr(13), ';');
		$t = troca($t, chr(10), '');
		$lt = splitx(';', $t);
		$au = array();
		$aus = array();
		for ($r = 0; $r < count($lt); $r++) {
			$an = $lt[$r];
			if (strlen($an) > 0) {
				$an = nbr_autor($an, 7);
				if (!isset($au[$an])) {
					$au[$an] = 1;
					array_push($aus,$an);
				}
			}
		}
		$sx = '';
		sort($aus);
		for ($r=0;$r < count($aus);$r++)
			{
				$sx .= $aus[$r].cr();
			}
		return($sx);
	}

	function from_to($f) {
		$path = '';
		$dir = $path . '_tmp/repo/';
		$f = $dir . $f;

		if (file_exists($f)) {
			$sx = 'OK';
			$myfile = fopen($f, "r") or die("Unable to open file!");
			$sx = fread($myfile, filesize($f));
			fclose($myfile);
		}
	}

	function open_csv($f) {
		$path = '';
		$dir = $path . '_tmp/repo/';
		$f = $dir . $f;
		if (file_exists($f)) {
			$sx = 'OK';
			$myfile = fopen($f, "r") or die("Unable to open file!");
			$sx = fread($myfile, filesize($f));
			fclose($myfile);
			$sx = utf8_encode($sx);
			$sx = troca($sx, ';;', ';-;');

			$sx = troca($sx, chr(13), '<tr><td>');
			$sx = troca($sx, chr(10), '');
			$sx = troca($sx, ';', '<td>');

			$sx = '<table border=1 cellpadding=4 cellspacing=2>' . $sx . '</table>';
		} else {
			$sx = 'File not found';
		}
		return ($sx);
	}

	function file_extension($f) {
		while (strpos($f, '.')) {
			$f = substr($f, strpos($f, '.') + 1, strlen($f));
		}
		return ($f);
	}

	function arquivo($d, $fl) {
		$root = scandir($d);
		$sx = '';
		$f = 0;
		foreach ($root as $value) {
			if ($fl == $f) { $fn = $value;
			}
			if (is_dir($value)) {
				$sx .= '<tt>&lt;dir&gt; ' . $value . '</tt><br>';
			} else {
				$sx .= '<tt><a href="' . base_url('index.php/oraculo/?dd1=file') . '&q=' . $f . '">' . $value . '</a></tt><br>';
			}
			$f++;
		}
		return ($fn);
	}

	function diretorio($d) {
		$root = scandir($d);
		$sx = '';
		$f = 0;
		foreach ($root as $value) {
			if (is_dir($value)) {
				$sx .= '<tt>&lt;dir&gt; ' . $value . '</tt><br>';
			} else {
				$sx .= '<tt><a href="' . base_url('index.php/oraculo/?dd1=file') . '&q=' . $f . '">' . $value . '</a></tt><br>';
			}
			$f++;
		}
		return ($sx);
	}

	function file_upload_save_to_temp() {
		$sx = '';
		if (isset($_FILES["fileToUpload"]["tmp_name"])) {
			$target_file = $_FILES["fileToUpload"]["tmp_name"];
			$FileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

			$path = '';
			$dir = $path . '_tmp';
			$this -> checadir($dir);
			$dir = $path . '_tmp/repo/';
			$this -> checadir($dir);
			//$dir = $path . '_tmp/repo/' . date("Y");
			//$this -> checadir($dir);
			//$dir = $path . '_tmp/repo/' . date("Y") . '/' . date("m");
			//$this -> checadir($dir);
			$target_file = $dir .= '/' . 'file_001.' . $FileType;

			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				$sx .= "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
			} else {
				$sx .= "Sorry, there was an error uploading your file.";
			}
			return ($sx);
		}
	}

}
?>
