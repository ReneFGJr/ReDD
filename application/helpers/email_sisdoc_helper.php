<?php
function enviaremail($para, $assunto, $texto, $de, $anexos = array()) {
    echo "OK1";
	if (!is_array($para)) {
		$para = array($para);
	}
	$CI = &get_instance();

	//$config = Array('protocol' => 'smtp', 'smtp_host' => 'mail.sisdoc.com.br', 'smtp_port' => 587, 'smtp_user' => 'rene@sisdoc.com.br', 'smtp_pass' => '448545ct', 'mailtype' => 'html', 'charset' => 'iso-8859-1', 'wordwrap' => False);
	$config = Array('protocol' => 'smtp', 'smtp_host' => 'smtp.ufrgs.br', 'smtp_port' => 465, 'smtp_user' => '00282381', 'smtp_pass' => 'andre@19', 'mailtype' => 'html', 'charset' => 'iso-8859-1', 'wordwrap' => False);
	$CI -> load -> library('email', $config);

	for ($r = 0; $r < count($anexos); $r++) {
		$CI -> email -> attach($anexos[$r]);
	}

	/* de */
	$sql = "select * from mensagem_own where id_m = " . round($de);
	$rlt = $CI -> db -> query($sql);
	$rlt = $rlt -> result_array();

	/***************************************************/
	if (count($rlt) == 1) {
		$line = $rlt[0];
		$e_mail = trim($line['m_email']);
		$e_nome = trim($line['m_descricao']);

		$CI -> email -> from($e_mail, $e_nome);
		$CI -> email -> to($para[0]);
		$CI -> email -> subject($assunto);
		$CI -> email -> message($texto);

		/* e-mail com copias */
		$bcc = array();
		for ($r = 1; $r < count($para); $r++) {
			array_push($bcc, $para[$r]);
		}

		if (count($bcc) > 0) {
			$CI -> email -> bcc($bcc);
		}

		$sx = '<div id="email_enviado">';
		$sx .= '<h3>' . msg('email_enviado') . '</h3>';
		for ($r = 0; $r < count($para); $r++) {
			$sx .= $para[$r];
			$sx .= '<br>';
		}
		$sx .= '<br>';
		$sx .= '</div>';
        
            $headers = 'From: Dados de Pesquisa RNP <dadosdepesquisa@rnp.br> ' . "\r\n" .
                       'Reply-To: dadosdepesquisa@rnp.br' . "\r\n" .
                       'X-Mailer: PHP/' . phpversion();
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";                       
            
            $real_sender = '-f rene.gabriel@ufrgs.br';        

        mail($para[0], $assunto, $texto, $headers, $real_sender);

		//$CI -> email -> send();
		return ('ok');
	} else {
		echo('<font color="red">Proprietário do e-mail (' . $de . ') não configurado (veja mensagem_own)</font>');
		exit ;
	}
}
?>