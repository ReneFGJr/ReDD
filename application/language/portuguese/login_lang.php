<?php
// This file is part of the Brapci Software. 
// 
// Copyright 2015, UFPR. All rights reserved. You can redistribute it and/or modify
// Brapci under the terms of the Brapci License as published by UFPR, which
// restricts commercial use of the Software. 
// 
// Brapci is distributed in the hope that it will be useful, but WITHOUT ANY
// WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
// PARTICULAR PURPOSE. See the ProEthos License for more details. 
// 
// You should have received a copy of the Brapci License along with the Brapci
// Software. If not, see
// https://github.com/ReneFGJ/Brapci/tree/master//LICENSE.txt 
/* @author: Rene Faustino Gabriel Junior <renefgj@gmail.com>
 * @date: 2015-12-01
 */
if (!function_exists(('msg')))
	{
		function msg($t)
			{
				$CI = &get_instance();
				if (strlen($CI->lang->line($t)) > 0)
					{
						return($CI->lang->line($t));
					} else {
						return($t);
					}
			}
	}
	
/* Login */
$lang['Username'] = 'Usuário';
$lang['Password'] = 'Senha';
$lang['Keep me Signed in'] = 'Manter-se conectado';
$lang['Sign In'] = 'Entrar';
$lang['SIGN IN'] = 'Acessar';
$lang['SIGN UP'] = 'Sobre';
$lang['Forgot Password'] = 'Esqueceu sua senha';

$lang['tit_ARTIG'] = 'Artigos em Revistas';
$lang['tit_EVENT'] = 'Trabalhos em Eventos';
$lang['tit_LIVRO'] = 'Livros e Capítulos';
$lang['link_lattes'] = 'Links para o Lattes';
$lang['last_update'] = 'Atualizado em';
$lang['name'] = 'Nome do pesquisador';


$lang['ORIENTADOR_PRINCIPAL'] = 'Orientador';
$lang['TRABALHO_DE_CONCLUSAO_DE_CURSO_GRADUACAO'] = 'TCC Graduação';
$lang['ORIENTACAO-DE-OUTRA-NATUREZA'] = 'Orientações de outra natureza';
$lang['INICIACAO_CIENTIFICA'] = 'Iniciação Científica';
$lang['MONOGRAFIA_DE_CONCLUSAO_DE_CURSO_APERFEICOAMENTO_E'] = 'Orientações de Especialização';

?>
