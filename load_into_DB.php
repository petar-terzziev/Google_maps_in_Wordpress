<?php
 $db = new PDO('mysql:host=localhost;dbname=coordinates','root');

	$asia=file_get_contents("https://data.opendatasoft.com/api/records/1.0/search/?dataset=geonames-all-cities-with-a-population-1000%40public&rows=10000&facet=timezone&facet=country&refine.timezone=Asia%2FShanghai");
$asia_cities=json_decode($asia);
foreach($asia_cities->records as $city){
$db->query('INSERT IGNORE INTO coordinates (recordid,lat,lng) VALUES (\''.$city->recordid.'\','.$city->fields->coordinates[0].','.$city->fields->coordinates[1].')');
}

	$europe=file_get_contents("https://data.opendatasoft.com/api/records/1.0/search/?dataset=geonames-all-cities-with-a-population-1000%40public&rows=11&facet=timezone&facet=country&refine.timezone=Europe%2FBerlin");
$europe_cities=json_decode($europe);
foreach($europe_cities->records as $city){
$db->query('INSERT IGNORE INTO coordinates (recordid,lat,lng) VALUES (\''.$city->recordid.'\','.$city->fields->coordinates[0].','.$city->fields->coordinates[1].')');
}

?>