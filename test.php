<?php
 $db = new PDO('mysql:host=localhost;dbname=coordinates','root');
$sql= "SELECT * FROM coordinates";
$lats=array();
$count= $db->query($sql)->fetchColumn();
if($count<10000){
	$file=file_get_contents("https://data.opendatasoft.com/api/records/1.0/search/?dataset=geonames-all-cities-with-a-population-1000%40public&rows=10000&facet=timezone&facet=country&refine.timezone=Asia%2FShanghai");
$cities=json_decode($file);
foreach($cities->records as $city){
$db->query('INSERT INTO coordinates (lat,lng) VALUES ('.$city->fields->coordinates[0].','.$city->fields->coordinates[1].')');
$lats[]=$city->fields->coordinates;
}
}
else{
   foreach($db->query($sql) as $row){
   	$lats[]=$row;
   }
}
header('Content-Type: application/json');
echo json_encode($lats);
?> 