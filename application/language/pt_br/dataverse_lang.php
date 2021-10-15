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
$lang['import_file'] = 'Importar Arquivo';
$lang['File Import'] = 'Importação do Arquivo de Traduação';
$lang['Translate'] = 'Tradução';
$lang['check_translate'] = 'Rever as traduções';
$lang['export_file'] = 'Exportar arquivos Master';
$lang['Path'] = 'Diretório';
$lang['mass_translate'] = 'Tradução em Massa';
$lang['to_translate'] = 'para traduzir';
$lang['sign_in'] = 'entrar';
$lang['SignIn'] = 'Entrar';
$lang['Forgot Password?'] = 'Esqueceu a senha?';
$lang['password'] = 'Senha';
$lang['SignUp'] = 'Cadastre-se';
$lang['Don’t have an account?'] = 'Não tem uma conta?';
$lang['fullName'] = 'Nome completo';
$lang['Sign Up Send'] = 'Enviar cadastro';
$lang['return'] = 'voltar';
$lang['login'] = 'entrar';
$lang['user_perfil'] = 'Perfil do usuário';
$lang['user_logout'] = 'Sair';
$lang['dvn_pt'] = 'Português';
$lang['dvn_en'] = 'Inglês';
$lang['dvn_file'] = 'Arquivo';
$lang['action'] = 'Ação';
$lang['File Export'] = 'Exportar arquivo .properties';
$lang[''] = '';
$lang[''] = '';
$lang[''] = '';
$lang[''] = '';
$lang[''] = '';
$lang[''] = '';

