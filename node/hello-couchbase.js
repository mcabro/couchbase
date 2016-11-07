var couchbase = require('couchbase');
var cluster = new couchbase.Cluster('couchbase://192.168.4.44');
var bucket = cluster.openBucket('NYC-bucket');

bucket.upsert('testdoc', {name:'Frank'}, function(err, result) {
  if (err) throw err;

  bucket.get('testdoc', function(err, result) {
    if (err) throw err;

    console.log(result.value);
    // {name: Frank}
  });
});
process.exit(0);

