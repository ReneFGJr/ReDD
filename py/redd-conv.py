import sys, csv, os, string

with open('pilla/pilla_acervodoc.csv', newline='') as csvfile:
	spamreader = csv.reader(csvfile, delimiter=';')
	print('<?xml version="1.0" encoding="UTF-8"?>')
	for row in spamreader:
		########################### CRIAR DIRETORIO
		try:
			directory = 'temp/'+row[2]
			os.makedirs(directory)
		except OSError:
			a = 0
			
			
		########################### ASSUNTO
		term = row[10]
		term.replace('\n','###')
		term.replace('a','x')
		#print('=xxx=>',term)
		t = term.split(';')
		for tt in t:
			tr = tt
			tr.split()
			if len(tr) > 1:
				tr.strip()
				tr.replace('\r','')
				tr.replace('\n','')
				print ("=f=>",tr,len(tr))
		
		ast = '<dublin_core schema="dc">\n\r'
		ast = ast + '<dcvalue qualifier="nrdoc" element="identifier">'+row[2]+'</dcvalue>\n\r'
		ast = ast + '<dcvalue qualifier="author" element="contributor">'+row[7]+'</dcvalue>\n\r'
		ast = ast + '<dcvalue qualifier="author" element="contributor">'+row[8]+'</dcvalue>\n\r'
		ast = ast + '<dcvalue qualifier="author" element="contributor">'+row[12]+'</dcvalue>\n\r'
		ast = ast + '<dcvalue qualifier="issued" element="date">'+row[13]+'</dcvalue>\n\r'
		ast = ast + '<dcvalue qualifier="uri" element="identifier">http://hdl.handle.net/2050011959/'+row[2]+'</dcvalue>\n\r'
		
		ast = ast + '<dcvalue language="pt_BR" qualifier="none" element="subject">'+row[10]+'</dcvalue>\n\r'
		ast = ast + '<dcvalue language="pt_BR" qualifier="abstract" element="description">'+row[11]+'</dcvalue>\n\r'
		
		ast = ast + '</dublin_core>\n\r'
		
		#print(ast)
		#print('<dcvalue qualifier="accessioned" element="date">',row[6],'</dcvalue>')
		#print('<dcvalue qualifier="available" element="date">2018-03-16T17:20:08Z</dcvalue>')
		#print()
		#print('<dcvalue language="pt_BR" qualifier="citation" element="identifier">citation</dcvalue>')
		#print('<dcvalue language="pt_BR" qualifier="none" element="description">Description: Enter any other description or comments in this box.</dcvalue>')
		#print('<dcvalue language="pt_BR" qualifier="abstract" element="description">Abstract: Enter the abstract of the item.</dcvalue>')
		#print('<dcvalue language="en" qualifier="provenance" element="description">Submitted by Rene Faustino Gabriel Junior (renefgj@gmail.com) on 2018-03-16T17:20:08Z No. of bitstreams: 1 0001.pdf: 3247834 bytes, checksum: 385c544199cbacac25c4fb782411c46e (MD5)</dcvalue>')
		#print('<dcvalue language="en" qualifier="provenance" element="description">Made available in DSpace on 2018-03-16T17:20:08Z (GMT). No. of bitstreams: 1 0001.pdf: 3247834 bytes, checksum: 385c544199cbacac25c4fb782411c46e (MD5) Previous issue date: 1930-01-19</dcvalue>')
		#print('<dcvalue language="pt_BR" qualifier="sponsorship" element="description">Sponsors: Enter the names of any sponsors and/or funding codes in the box.</dcvalue>')
		#print('<dcvalue language="pt_BR" qualifier="iso" element="language">other</dcvalue>')
		#print('<dcvalue language="pt_BR" qualifier="none" element="publisher">manuscrito</dcvalue>')
		#print('<dcvalue qualifier="ispartofseries" element="relation">arq 2;</dcvalue>')
		#print('<dcvalue language="pt_BR" qualifier="none" element="subject">cart 1</dcvalue>')
		#print('<dcvalue language="pt_BR" qualifier="none" element="subject">cart 2</dcvalue>')
		#print('<dcvalue language="pt_BR" qualifier="none" element="title">Documento 1</dcvalue>')
		#print('<dcvalue language="pt_BR" qualifier="none" element="type">Other</dcvalue>')
		#print('</dublin_core>')
