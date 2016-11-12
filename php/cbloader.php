<?php
$shortoptions = 'b::';
$shortoptions .= 'u:'; //URI: Either file:// or http(s)://
$shortoptions .= 'h::'; //hostname
$shortoptions .= 'p::'; //prepend
$shortoptions .= 'r::'; //JSONroot
$shortoptions .= 'k:'; //JSON key ID

$longoptions=array(
    'help',
);

$defaults = array(
    'b' => 'default',
    'h' => 'localhost',
    'p' => '',
    'r' => null,
);

$options = getopt( $shortoptions, $longoptions ) + $defaults;

$host = $options['h'];
$dataOrigin = $options['u'];
$bucketName = $options['b'];
$prepend = $options['p'];
$jsonRoot = $options['r'];
$jsonKeyID = $options['k'];


$cluster = new CouchbaseCluster("couchbase://" . $host);
$bucket = $cluster->openBucket(bucketName);

$json = file_get_contents($dataOrigin);

$data = json_decode($json);
/*
var_dump($options);
echo PHP_EOL;
var_dump($data);
//*/
if ( !is_null($jsonRoot) )
  $data = $data[$jsonRoot];

foreach ( $data  as $itemKey => $itemValue ) {
    $key = $prepend . '' . $itemValue['$jsonKeyID'];
    var_dump($key);
    var_dump($itemValue);
/*
    $result = $bucket->upsert( $key, $value );
    var_dump($result);
//*/
}
//*/

