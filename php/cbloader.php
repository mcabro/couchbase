<?php
$shortoptions = 'b::';
$shortoptions .= 'u:'; //URI: Either file:// or http(s)://
$shortoptions .= 'h::'; //hostname
$shortoptions .= 'p::'; //prepend

//    -r  JSONroot              JSON root to parse
//    -d  SearchKey            JSON Key ID

$longoptions=array(
    'help',	
);

$defaults = array(
    'b' => 'default',
    'h' => 'localhost',
    'p' => '',
);

$options = getopt( $shortoptions, $longoptions ) + $defaults;
$prepend = 'eess::';

$jsonOriginal = file_get_contents($options['u']);

$jsonDecoded = json_decode($jsonOriginal, true);
foreach ( $jsonDecoded  as $item ) {
    $key = $prepend . '';
    
}
?>
