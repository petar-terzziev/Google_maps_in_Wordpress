<?php

 $db = new PDO('mysql:host=localhost;dbname=coordinates','root');
 $country=$_POST['country'];
$sql= "SELECT lat,lng FROM coordinates WHERE country='$country'";
$coordinates=array();

foreach($db->query($sql) as $row){
	$coordinates[]=$row;
}
header('Content-Type: application/json');
	echo json_encode($coordinates);