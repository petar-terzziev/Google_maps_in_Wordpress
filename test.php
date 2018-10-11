<?php
 $db = new PDO('pgsql:host=localhost;dbname=coordinates', 'postgres', '1241323');
$sql= "SELECT * FROM coordinates";
$lats=array();
if(!$db){
	echo 'noyojk';
}
$count=0;
foreach($db->query($sql) as $var){
$count++;
}
if($count<=10000){
	$file=file_get_contents("https://data.opendatasoft.com/api/records/1.0/search/?dataset=geonames-all-cities-with-a-population-1000%40public&rows=10&facet=timezone&facet=country&refine.timezone=Asia%2FShanghai");

$cities=json_decode($file);
foreach($cities->records as $city){
$db->query("INSERT INTO coordinates (lat,lng) VALUES ('$city->fields->coordinates[0]','$city->fields->coordinates[1]')");
$lats[]=$city->fields->coordinates[0];
}
}

?>

<html>
  <head>
    <style>
       /* Set the size of the div element that contains the map */
      #map {
        height: 400px;  /* The height is 400 pixels */
        width: 100%;  /* The width is the width of the web page */
       }
    </style>
  </head>
  <body>
     <h3>My Google Maps Demo</h3>
    <!--The div element for the map -->
    <div id="map"></div>

     <script>
// Initialize and add the map
function initMap() {
  // The location of Uluru
  var uluru = {lat: -25.344, lng: 131.036};
  // The map, centered at Uluru
  var map = new google.maps.Map(
      document.getElementById('map'), {zoom: 4, center: uluru});
//create number of markers based on collection.length
var markers=Array();

var lats = <?php echo '["' . implode('", "', $lats) . '"]' ?>;
for(i=0;i<lats.length;i++){
console.log(lats[i]);
}
}
    </script>
    <!--Load the API from the specified URL
    * The async attribute allows the browser to render the page while the API loads
    * The key parameter will contain your own API key (which is not needed for this tutorial)
    * The callback parameter executes the initMap() function
    -->
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAutW-KzdxV_So564MrGUM3qQtNNqNE8Gg&callback=initMap">
    </script>
  </body>
</html>   