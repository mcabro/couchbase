<?php
$jsonsDir="data/jsons";
$jsonUrl='https://sedeaplicaciones.minetur.gob.es/ServiciosRESTCarburantes/PreciosCarburantes/EstacionesTerrestres/';
//$jsonOriginal = file_get_contents("data/eess_raw.json");

if(!mkdir($jsonDir, 0755, true)) {
    die('Fallo al crear las carpetas...');
}
$jsonOriginal = file_get_contents($jsonUrl);

$jsonDecoded = json_decode($jsonOriginal, true);
foreach ( $jsonDecoded['ListaEESSPrecio']  as $eess ) {
    $filename='es::'. $eess['IDEESS'];
    file_put_contents( "$jsonsDir/$filename.json", json_encode($eess));
}
echo "Look for jsons in $resultsDir";
?>
