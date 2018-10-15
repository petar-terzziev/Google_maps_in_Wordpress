<div class="blog-post">
	<h2 class="blog-post-title"><?php the_title(); ?></h2>
	<p class="blog-post-meta"><?php the_date(); ?> by <a href="#"><?php the_author(); ?></a></p>

 <?php the_content(); ?>

</div>
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
     <div>
     	<p>Choose country:</p>
      <select name="select_country" id="select_country" onchange="initMap()">
    <option value="null" selected>Select Country</option>
</select> 
</div>
    <!--The div element for the map -->
    <div id="map"></div>

     <script>
     	function load_countries(){
     			var select_menu = document.getElementById("select_country");
$.ajax({
type:'POST',
url: 'load_countries.php',
datatype: 'json',
success: function (d){

console.log('okok');
}
});


     	}
// Initialize and add the map
function initMap() {
  // The location of Uluru
  var uluru = {lat: -25.344, lng: 131.036};
  // The map, centered at Uluru
  var map = new google.maps.Map(
      document.getElementById('map'), {zoom: 4, center: uluru});
   var markers=Array();
            $.ajax({
                type : 'POST',
                url : 'load_markers.php',
                datatype: 'json',
                data : {
                	country: $('#select_country').val()

                },
                success : function (d) {

                	for (i in d){
                      markers[i]= new google.maps.Marker({
            position: {lat: parseFloat(d[i][0]),lng: parseFloat(d[i][1])},
            map: map,
            title: "collection" 
    });
                 }
                },
            
});
     
}
$(document).ready(load_countries());

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