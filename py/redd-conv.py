import sys, csv

with open('pilla/pilla_acervodoc.csv', newline='') as csvfile:
	spamreader = csv.reader(csvfile, delimiter=';')
	print(spamreader)
	for row in spamreader:
		#print(row[0] , '===>', row[1], '===>',row[2], '===>',row[3], '===>',row[4], '===>',row[5], '===>',row[6], '===>',row[7], '===>',row[8], '===>',row[9], '===>',row[10], '===>',row[11], '===>',row[12])
		print('===>',row[0],'===',row[1])
		
	#print(csv.list_dialects())
	#print(csv.excel_tab)


		