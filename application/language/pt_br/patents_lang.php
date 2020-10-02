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

$lang['pt_01'] = 'PN';
$lang['pt_02'] = 'TI';
$lang['pt_03'] = 'AU';
$lang['pt_04'] = 'AE';
$lang['pt_05'] = 'GA';
$lang['pt_06'] = 'AB';
$lang['pt_07'] = 'TF';
$lang['pt_08'] = 'EA';
$lang['pt_09'] = 'DC';
$lang['pt_10'] = 'MC';
$lang['pt_11'] = 'IP';
$lang['pt_12'] = 'PD';
$lang['pt_13'] = 'AD';
$lang['pt_14'] = 'FD';
$lang['pt_15'] = 'PI';
$lang['pt_16'] = 'DS';
$lang['pt_17'] = 'FS';
$lang['pt_18'] = 'CP';
$lang['pt_19'] = 'CR';
$lang['pt_20'] = 'DN';
$lang['pt_21'] = 'MN';
$lang['pt_22'] = 'RI';
$lang['pt_23'] = 'CI';
$lang['pt_24'] = 'RG';


?>
