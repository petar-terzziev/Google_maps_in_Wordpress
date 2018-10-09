<?php
  $db = new PDO('pgsql:host=localhost;dbname=coordinates', 'postgres', '1241323');
$sql= "SELECT * FROM coordinates";
$lats=array();
$lngs=array();
foreach($db->query($sql) as $row){
$lats[]=$row['lat'];
$lngs[]=$row['lng'];
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
var lngs= <?php echo '["' . implode('", "', $lngs) . '"]' ?>;
for(i=0;i<lats.length;i++){
     markers[i] = new google.maps.Marker({
            position: {lat: parseFloat(lats[i]),lng: parseFloat(lngs[i])},
            map: map,
            title: "collection" 
    });
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