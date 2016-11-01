import json
import sys
import urllib2
import os
import errno

jsonsDir = "data/jsons"
jsonUrl ='https://sedeaplicaciones.minetur.gob.es/ServiciosRESTCarburantes/PreciosCarburantes/EstacionesTerrestres/'
prepend = 'eess::'
# creamos el directorio de destino 
try:
    os.makedirs(jsonsDir)
except OSError as exc:  # Python >2.5
    if exc.errno == errno.EEXIST and os.path.isdir(path):
        pass
    else:
        raise

# eessUrl = sys.argv[1]
f = urllib2.urlopen(jsonUrl)
data = json.load(f)
listaEESS = data['ListaEESSPrecio']
for i in range(0, len(listaEESS)):
   eessid = listaEESS[i]['IDEESS']
   outfile = open(jsonsDir + '/' + prepend + str(eessid) + '.json', 'w')
   json.dump(listaEESS[i], outfile)
   outfile.close()


