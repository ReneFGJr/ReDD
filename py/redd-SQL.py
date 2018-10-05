import sys, csv, os, string, re, shutil

# @function DATE FUNCTIONS
# @version v0.18.04.30
##################################
def dtos(dt=''):
	if (len(dt) == 10):
		ano = dt[6]+dt[7]+dt[8]+dt[9]
		mes = dt[3]+dt[4]
		dia = dt[0]+dt[1]
		data = ano+"-"+mes+"-"+dia
		sr = data
	else:
		sr = '0000-00-00'
	return sr

# @function PADRONIZAÇÃO DE NOMES
# @version v0.18.04.30
##################################
##################################
def nbr_title(title=''):
	sr = ''
	uc = 1
	title = title.lower()
	for x in range(0, len(title)):
		if len(title) > 0:
			t = title[x]
			if uc == 1:
				if not t.isupper():
					sr = sr + t.upper()
				else:
					sr = sr + t
			else:
				sr = sr + t
			uc = 0
			
		if t == '.':
			uc = 1				
	return sr
	
def nbr_name(name=''):
    uc = 1
    sr = ''
    name = name.replace('.', '. ')
    for x in range(0, len(name)):
        # Caracter ############################
        s = name[x]
        if uc == 1:
            if not s.isupper():
                sr = sr + s.upper()
            else:
                sr = sr + s
            uc = 0
        else:
            sr = sr + s.lower()
            uc = 0
        if s == ' ' or s == '.':
            uc = 1

    # Regras ##################################
    sr = sr.replace('  ', ' ')
    sr = sr.replace(' E ', ' e ')
    sr = sr.replace(' De ', ' de ')

    sr = sr.replace(' Do ', ' do ')
    sr = sr.replace(' Dos ', ' dos ')

    sr = sr.replace(' Da ', ' da ')
    sr = sr.replace(' Das ', ' das ')

    sr = sr.replace(' Em ', ' em ')
    sr = sr.replace(' O ', ' o ')

    return sr


with open('U:/Excel-Metadados/pilla_acervodoc.csv', newline='') as csvfile:
    handle = '2050011959'
    license = 'license.txt'
    ast = ''
	
    spamreader = csv.reader(csvfile, delimiter=';')
    for row in spamreader:
        hd = row[2]
        while len(hd) < 5:
            hd = '0' + hd
        hd = '300' + hd
        directory = 'pilla_raul/' + hd

        ########################### HANDLE
        handle_nr = handle + '/' + hd

        ########################### ID
        id = row[2]
        idf = id
        while (len(idf) < 4):
            idf = '0' + idf

        ########################### ABSTRACT
        abstract = row[11]
        abstract = re.sub('\r\n', '; ', abstract)
        title = nbr_name(abstract)
		
        abstract = 'De: '+row[7]+'\r\rPara: '+row[8]+'\n\rData: '+row[6]+'\n\rDescrição: '+abstract

        tl = title.split('.')
        if len(tl) > 0:
           title = tl[0]
		   
        title = title + ';'
        tl = title.split(';')
        if len(tl) > 0:
           title = tl[0]		   
		

        ########################### ASSUNTO
        t = row[10]
        t = re.sub('\r\n', ';', t)
        t = re.sub('; ', ';', t)
        t = t.split(';')
        subj = '';
        for tt in t:
            tt.split()
            if len(tt) > 1:
                tt.strip()
                tt.rstrip();
                tt.lstrip();
                if len(tt) > 2:
                    subj = subj + tt + ';'

            ast = ast + 'insert into pilla (r_arq, r_nrdoc, r_nrdoc2, r_doc, r_local, r_dtdoc, r_remetente, r_destinatario, r_descricao, r_assunto, r_n1, r_data2, r_isd, r_rmes) '
            ast = ast + ' values '
            row7 = ''
            row8 = ''
            if len(row[7]) > 3:
                row7 = "" + nbr_name(row[7]) + ""
  
            if len(row[8]) > 3:
                row8 = "" + nbr_name(row[8]) + ""
            ast = ast + "("		
            ast = ast + "'"+row[1]+"', "
            ast = ast + "'"+row[2]+"', "
            ast = ast + "'"+row[3]+"', "
            ast = ast + "'"+row[4]+"', "
            ast = ast + "'"+row[5]+"', "
            #ast = ast + "'"+row[6]+"', "
            ast = ast + "'"+row8+"', "
            ast = ast + "'"+row7+"', "
            ast = ast + "'"+row[9]+"', "
            ast = ast + "'"+row[10]+"', "
            ast = ast + "'"+row[11]+"', "
            ast = ast + "'"+row[12]+"', "
            ast = ast + "'"+dtos(row[13])+"', "
            ast = ast + "'"+row[14]+"', "
            ast = ast + "'"+row[15]+"' "
            ast = ast + ");"
            ast = ast + '\r\n'
    

        ######################### Bundle
        arq = 'd:/lixo/n.sql'
        ok = 0;

        ######################### DUBLIC CORE
        fdc = open(arq, 'w')
        fdc.write(ast)
        fdc.close()

            