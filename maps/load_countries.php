<?php

 $db = new PDO('mysql:host=localhost;dbname=phpmyadmin','phpmyadmin','1241323');
$countries=array();
foreach ($db->query("SELECT DISTINCT country FROM coordinates") as $country) {
	$countries[]=$country['country'];
}
header('Content-Type: application/json');
	echo json_encode($countries);
?>