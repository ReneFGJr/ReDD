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
	
	function checadir($d)
		{
			if (!is_dir($d))
				{
					mkdir($d);
				} else {
					echo "OK ".$d.' - ';
				}
			return(1);
		}

	function file_upload_save_to_temp() {
		$sx = '';
		if (isset($_FILES["fileToUpload"]["tmp_name"])) {
			$target_file = $_FILES["fileToUpload"]["tmp_name"]; 
			$FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			
			$dir = '_tmp';
			$this->checadir($dir);
			$dir = '_tmp/repo/'.date("y");
			$this->checadir($dir);			
			$dir = '_tmp/repo/'.date("y");
			$this->checadir($dir);
			$dir = '_tmp/repo/'.date("y").'/'.date("m");
			$this->checadir($dir);
			$target_file = $dir .= '/'.'file_001.'.$FileType;
			
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
