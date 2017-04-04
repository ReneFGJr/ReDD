<?php
class cursos extends CI_model
	{
	var $table = 'graduacao';
	
	function row($form) {

		$form -> fd = array('id_cr', 'cr_nome', 'cr_codigo','instituicao','cr_nota');
		$form -> lb = array('id', msg('cr_nome'), msg('cr_codigo'), msg('instituicao'), msg('Nota'));
		$form -> mk = array('', 'L', 'L', 'L','C','C','C');


		return($form);
	}	
	}
?>
