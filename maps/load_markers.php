<?php

 $db = new PDO('mysql:host=localhost;dbname=phpmyadmin','phpmyadmin','1241323');
 $country=$_POST['country'];
$sql= "SELECT lat,lng FROM coordinates WHERE country='$country'";
$coordinates=array();

foreach($db->query($sql) as $row){
	$coordinates[]=$row;
}
header('Content-Type: application/json');
	echo json_encode($coordinates);