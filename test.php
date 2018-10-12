<?php
 $db = new PDO('mysql:host=localhost;dbname=phpmyadmin','phpmyadmin','1241323');
$sql= "SELECT * FROM coordinates";

$lats=array();
	$file=file_get_contents("https://data.opendatasoft.com/api/records/1.0/search/?dataset=geonames-all-cities-with-a-population-1000%40public&rows=11&facet=timezone&facet=country&refine.timezone=Asia%2FShanghai");
$cities=json_decode($file);
foreach($cities->records as $city){
$db->query('INSERT IGNORE INTO coordinates (recordid,lat,lng) VALUES (\''.$city->recordid.'\','.$city->fields->coordinates[0].','.$city->fields->coordinates[1].')');
}
foreach($db->query($sql) as $row){
	$lats[]=$row;
}
header('Content-Type: application/json');
	echo json_encode($lats);
?> 
