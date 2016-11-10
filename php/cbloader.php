<?php
$shortoptions = 'b::';
$shortoptions .= 'u:';  //URI: Either filepath  or http(s)://
$shortoptions .= 'h::'; //hostname
$shortoptions .= 'p::'; //prepend
$shortoptions .= 'r::'; //JSONroot
$shortoptions .= 'k::';  //JSON key ID
$shortoptions .= 'f::';  //format: arrayi|object

$longoptions=array(
    'help',
);

$defaults = array(
    'b' => 'default',
    'h' => 'localhost',
    'p' => '',
    'r' => null,
    'k' => 'id',
    'f' => 'array',
);

$options = getopt( $shortoptions, $longoptions ) + $defaults;

$host = $options['h'];
$dataOrigin = $options['u'];
$bucketName = $options['b'];
$prepend = $options['p'];
$jsonRoot = $options['r'];
$jsonKeyID = $options['k'];
$format = $options['f'];

$cluster = new CouchbaseCluster("couchbase://" . $host);
$bucket = $cluster->openBucket($bucketName);


$json = file_get_contents($dataOrigin);

$data = json_decode($json);

if ( !is_null($jsonRoot) && $format == 'object'  )
  $data = $data[$jsonRoot];
$counter = 0;
$errors = 0;
foreach ( $data  as $item ) {
    $key = $prepend . '' . $item->$jsonRoot->$jsonKeyID;
    $result = $bucket->upsert( $key, $item->$jsonRoot );
    if ($result->error == 'NULL') {
	echo 'Error: ' . $result->error . PHP_EOL;
        $errors++;
    } else {
	echo 'CAS: ' . $result->cas . PHP_EOL;
        $counter++;
    }
}

echo PHP_EOL;
echo 'Documents inserted: ' . $counter . ' - Errors: ' . $errors; 
echo PHP_EOL;
