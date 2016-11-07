from couchbase.bucket import Bucket
from couchbase.n1ql import N1QLQuery
from couchbase.exceptions import HTTPError

cb = Bucket('couchbase://192.168.4.44/default')
cb.upsert('u:king_arthur', {'name': 'Arthur',
           'email': 'kingarthur@couchbase.com',
           'interests': ['Holy Grail', 'African Swallows']})
cb.get('u:king_arthur').value
try:
    cb.n1ql_query('CREATE PRIMARY INDEX ON default').execute()
except HTTPError as e:  # Python >2.5
    if e.rc == 59 :
       pass
    else:
        raise
#   print str(e.rc)
#    pass
row_iter = cb.n1ql_query(N1QLQuery('SELECT name FROM default WHERE ' +\
 '$1 IN interests', 'African Swallows'))
for row in row_iter: print row
