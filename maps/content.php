<div class="blog-post">
	<h2 class="blog-post-title"><?php the_title(); ?></h2>
	<p class="blog-post-meta"><?php the_date(); ?> by <a href="#"><?php the_author(); ?></a></p>
<?php global $wpdb;
$countries=$wpdb->get_results("select distinct country from wp_coordinates");
$cur_country=$_POST['select_country'];
$sql='select lat,lng from wp_coordinates where country=\''.$cur_country.'\'';
$coordinates=$wpdb->get_results($sql);
?> <?php the_content(); ?>

</div>
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
     <div>
     	<p>Choose country:</p>

<form action="#" method="post">
      <select name="select_country" id="select_country" onchange="this.form.submit(); initMap(); document.getElementById('default_option').innerHTML='<?php echo $cur_country?>'">
    <option value="null" id="default_option" selected>Select Country</option>
</select>
</form> 
</div>
    <!--The div element for the map -->
    <div id="map"></div>

     <script>
     	function load_countries(){
     			var select_menu = document.getElementById("select_country");
         var countries_string='<?php echo json_encode($countries)?>';
         var countries =JSON.parse(countries_string);
         for(i in countries){
          var option = document.createElement("option");
option.value=countries[i]['country'];
option.text = countries[i]['country'];
select_menu.add(option, select_menu[i+1]);
         }

     	}
// Initialize and add the map
function initMap() {
  // The location of Uluru
  var uluru = {lat: -25.344, lng: 131.036};
  // The map, centered at Uluru
  var map = new google.maps.Map(
      document.getElementById('map'), {zoom: 4, center: uluru});
   var markers=Array();
            
    var crds_str='<?php echo json_encode($coordinates)?>';
    var crds=JSON.parse(crds_str);

for(i in crds){
    markers[i]= new google.maps.Marker({
            position: {lat: parseFloat(crds[i]['lat']),lng: parseFloat(crds[i]['lng'])},
            map: map,
            title: "collection" 
    });
}
     
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
