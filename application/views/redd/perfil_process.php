<?php
$mother = '';
$birth_day = '';
$rdf = new rdf;
$cpf = 'não registrado';
$data = $rdf->le_data($id);
$genitor = '';
#------------------------------CRB
$crb_nr = 'sem registro';
$crb = '';
$foto = base_url('img/foto/000000.png');
$return = '<a href="' . base_url(PATH . 'librarian') . '" class="btn btn-outline-secondary">' . msg('return') . '</a>' . cr();
$btn_perfil_update = '<a href="' . base_url(PATH . 'librarian/update/' . $id) . '" class="btn btn-outline-primary">' . msg('update') . '</a>' . cr();

$father = '';
$genitora = '';
$genitor = '';
for($r=0;$r < count($data);$r++)
{
	$line = $data[$r];
	$tp = $line['c_class'];
	$vlr = $line['n_name'];
	switch($tp)
		{
			case 'prefLabel':
			$b_name = $vlr;
			break;

			/********************* CRB Nr **************/
			case 'hasCRB':
			$crbbr = $vlr;
			break;

			/******************* CPF *******************/
			case 'hasCPF':
			$cpf = substr($vlr,0,3).'.'.substr($vlr,3,3).'.'.substr($vlr,6,3).'-'.substr($vlr,9,2);
			break;

			/*************************  Genitor ************/
			case 'hasFather':
			if (strlen($genitor) == 0)
			{
				$father = $vlr;	
			} else {
				$father .= '<br>'.$vlr;
			}
			break;
			case 'hasMother':
			if (strlen($genitora) == 0)
			{
				$mother = $vlr;	
			} else {
				$mother .= '<br>'.$vlr;
			}
			break;
			case 'hasGender':
			$genre = $vlr;
			break;
			case 'hasBorn':
			$birth_day = $vlr;
			$birth_day = substr($birth_day,8,2);
			$birth_day .= ' de '.meses(round((substr($vlr,5,2))));
			$birth_day .= ' de '.substr($vlr,0,4).'.';
			break;

			
		}
		echo $tp.'->'.$vlr.'<br>';
}

#------------------------------- REGISTRO PROFISSIONAL
$rp = '<h4>' . msg('Registration') . '</h4>' . cr();
$rp .= '<table class="table">' . cr();
$rp .= '<tr>';
$rp .= '<th width="5%">' . msg('crb') . '</th>';
$rp .= '<th width="10%">' . msg('crb_reg') . '</th>';
$rp .= '<th width="10%">' . msg('crb_status') . '</th>';
$rp .= '<th width="10%">' . msg('crb_type') . '</th>';
$rp .= '<th width="10%">' . msg('crb_register') . '</th>';
$rp .= '<th width="10%">' . msg('crb_register_crb') . '</th>';
$rp .= '<th width="45%">&nbsp;</th>';
$rp .= '</tr>' . cr();

$crbnr = '10';
$crbtipo = 'PROVISÓRIO';
$crbdata = '20/02/2020';
$crbplenaria = '12/2019';
$crbreg = '0.000';
$crbsitaucao = '<span class="btn btn-outline-success">' . msg('active') . '</span>';

$genre = 'Masculino/Feminino/???';

$rp .= '<tr class="middle">';
$rp .= '<td align="center">' . $crbnr . '</td>';
$rp .= '<td align="center">' . $crbreg . '</td>';
$rp .= '<td align="center">' . $crbsitaucao . '</td>';
$rp .= '<td align="center">' . $crbtipo . '</td>';
$rp .= '<td align="center">' . $crbdata . '</td>';
$rp .= '<td align="center">' . $crbplenaria . '</td>';
$rp .= '<td align="center"></td>';

$rp .= '</table>' . cr();

#==================================================== DADOS PESSOAIS
$te = '<h4>' . msg('Documments') . '</h4>';
$te .= '<table class="table">' . cr();
$te .= '<tr>';
$te .= '<th width="10%" class="text-center">' . msg('Documment') . '</th>';
$te .= '<th width="20%" class="text-center">' . msg('Nr.') . '</th>';
$te .= '<th width="10%" class="text-center">' . msg('Date') . '</th>';
$te .= '<th width="60%" class="text-left">' . msg('Other_information') . '</th>';
$te .= '</tr>' . cr();


$rg = '3.825.355-7';
$rg_emissor = 'SSP/PR';
$rg_data = '20/12/2002';
$ctps = '0000';
$te_nr = '000.000.00.0';
$te_ze = '132';
$te_se = '4';
$te_cidade = 'PORTO ALEGRE';
$te_UF = 'RS';
$te_data = '05/11/2015';

$te .= '<tr class="text-center">';
$te .= '<td><b>CPF</b></td>';
$te .= '<td>' . $cpf . '</td>';
$te .= '</tr>';

$te .= '<tr class="text-center">';
$te .= '<td><b>RG</b></td>';
$te .= '<td>' . $rg . '</td>';
$te .= '<td>' . $rg_data . '</td>';
$te .= '<td class="text-left">' . $rg_emissor . '</td>';
$te .= '</tr>';

$te .= '<tr class="text-center">';
$te .= '<td><b>Título Eleitor</b></td>';
$te .= '<td>' . $te_nr . '</td>';
$te .= '<td>' . $te_data . '</td>';
$te .= '<td class="text-left">' . $te_ze . ' Sessão ' . $te_se . ' de ' . $te_cidade . '/' . $te_UF . '</td>';
$te .= '</tr>';

$te .= '</table>' . cr();

#==================================================== DADOS PESSOAIS - FISICA
$ip = '<h4>' . msg('Personal_informations') . '</h4>';
$ip .= '<table class="table">' . cr();
$ip .= '<tr>';
$ip .= '<th width="20%" class="text-center">' . msg('Information') . '</th>';
$ip .= '<th width="80%" class="text-left">' . msg('Descriptions') . '</th>';
$ip .= '</tr>' . cr();


#----------------------- RESUME
$resume = 'Cadastro atualizado em: 10/10/2018';

#==================================================== FINANCEIRO
$fi = '<h4>' . msg('Financial') . '</h4>';
$fi .= '<table class="table">' . cr();
$fi .= '<tr>';
$fi .= '<th width="15%" class="text-center">' . msg('Due_date') . '</th>';
$fi .= '<th width="15%" class="text-center">' . msg('Doc') . '</th>';
$fi .= '<th width="40%" class="text-center">' . msg('Description') . '</th>';
$fi .= '<th width="15%" class="text-center">' . msg('Status') . '</th>';
$fi .= '<th width="15%" class="text-right">' . msg('Value') . '</th>';
$fi .= '</tr>' . cr();

$fian = array();
array_push($fian, array('31/01/2019', '1º Parcela','Anuidade referente a 2019','<span class="btn btn-danger fluid">Atrasada</span>', 115));
array_push($fian, array('28/02/2019', '2º Parcela','Anuidade referente a 2019','<span class="btn btn-outline-success fluid">Quitada</span>', 115));
array_push($fian, array('31/03/2019', '3º Parcela','Anuidade referente a 2019','<span class="btn btn-outline-warning fluid" >Aberto</span>', 115));

for ($r = 0; $r < count($fian); $r++) {
	$fi .= '<tr class="text-center">';
	$fi .= '<td>' . $fian[$r][0] . '</td>';
	$fi .= '<td>' . $fian[$r][1] . '</td>';
	$fi .= '<td>' . $fian[$r][2] . '</td>';
	$fi .= '<td>' . $fian[$r][3] . '</td>';
	$fi .= '<td class="text-right">' . number_format($fian[$r][4],2,',','.') . '</td>';
	$fi .= '</tr>';
}

$fi .= '</table>' . cr();

#--------------------------------------------- WORK PLACE
$wp = '<h4>' . msg('WorkPlace') . '</h4>';
$wp .= '<table class="table">' . cr();
$wp .= '<tr>';
$wp .= '<th width="10%" class="text-center">' . msg('Start_date') . '</th>';
$wp .= '<th width="10%" class="text-center">' . msg('Finish_date') . '</th>';
$wp .= '<th width="60%" class="text-left">' . msg('Place') . '</th>';
$wp .= '<th width="15%" class="text-center">' . msg('City') . '</th>';
$wp .= '<th width="5%" class="text-right">' . msg('State') . '</th>';
$wp .= '</tr>' . cr();

$wpan = array();
array_push($wpan, array('31/01/2019','-','Biblioteca Pública de Porto Alegre','Porto Alegre','RS','<span class="btn btn-primary fluid">Ativo</span>' ));
array_push($wpan, array('01/01/2015','31/01/2019','Biblioteca da PUCPR','Curitiba','PR','<span class="btn btn-outline-success fluid">Inativo</span>' ));

for ($r = 0; $r < count($wpan); $r++) {
	$wp .= '<tr class="text-center">';
	$wp .= '<td>' . $wpan[$r][0] . '</td>';
	$wp .= '<td>' . $wpan[$r][1] . '</td>';
	$wp .= '<td class="text-left">' . $wpan[$r][2] . '</td>';
	$wp .= '<td>' . $wpan[$r][3] . '</td>';
	$wp .= '<td>' . $wpan[$r][4] . '</td>';
	$wp .= '<td>' . $wpan[$r][5] . '</td>';
	$wp .= '</tr>';
}

$wp .= '</table>' . cr();


$age = '49 anos';

$ip .= '<tr>';
$ip .= '<th width="20%" class="text-right">' . msg('mother_name') . '</th>';
$ip .= '<td width="80%" class="text-left">' . $mother . '</th>';
$ip .= '</tr>' . cr();

$ip .= '<tr>';
$ip .= '<th width="20%" class="text-right">' . msg('father_name') . '</th>';
$ip .= '<td width="80%" class="text-left">' . $father . '</th>';
$ip .= '</tr>' . cr();

$ip .= '<tr>';
$ip .= '<th width="20%" class="text-right">' . msg('birth_day') . '</th>';
$ip .= '<td width="80%" class="text-left">' . $birth_day . ' - ' . $age . '</th>';
$ip .= '</tr>' . cr();

$ip .= '<tr>';
$ip .= '<th width="20%" class="text-right">' . msg('genre') . '</th>';
$ip .= '<td width="80%" class="text-left">' . $genre.'</th>';
$ip .= '</tr>' . cr();

$address = 'Casado';

$ip .= '<tr>';
$ip .= '<th width="20%" class="text-center">' . msg('marital_status') . '</th>';
$ip .= '<td width="80%" class="text-left">' .$address.'</th>';
$ip .= '</tr>' . cr();

$address = 'Rua Ramiro Barcelos, 2705 - Campus Saúde<br>
Sala: 106 - Anexo 1<br>
Brasil - Porto Alegre - RS - CEP 90.035-007';
$ip .= '<tr>';
$ip .= '<th colspan=2 class="middle">' . msg('Address_information') . '</th>';
$ip .= '</tr>' . cr();


$ip .= '<tr>';
$ip .= '<th width="20%" class="text-center">' . msg('address') . '</th>';
$ip .= '<td width="80%" class="text-left">' .$address.'</th>';
$ip .= '</tr>' . cr();

$ip .= '</table>' . cr();
?>