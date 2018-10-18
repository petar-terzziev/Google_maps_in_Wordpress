<?php
/**
 *
 */
/*
Plugin Name: Load_into_DB
Plugin URI: 
Description: Plugin to load coordinates of cities and the countries they're from into WPDB
Version: 1.0.0
Author: Petar Terziev
Author URI: 
License: GPLv2 or later
Text Domain: 
*/ 
function myplugin_activate() {

   global $wpdb;
  $asia=file_get_contents("https://data.opendatasoft.com/api/records/1.0/search/?dataset=geonames-all-cities-with-a-population-1000%40public&rows=10000&facet=timezone&facet=country&refine.timezone=Asia%2FShanghai");
$asia_cities=json_decode($asia);
foreach($asia_cities->records as $city){
$sql=$wpdb->prepare("INSERT IGNORE  into wp_coordinates (recordid,lat,lng,country) values (%s,%d,%d,%s)",array($city->recordid,$city->fields->coordinates[0],$city->fields->coordinates[1],$city->fields->country));
$wpdb->query($sql);
}

$europe=file_get_contents("https://data.opendatasoft.com/api/records/1.0/search/?dataset=geonames-all-cities-with-a-population-1000%40public&rows=10000&facet=timezone&facet=country&refine.timezone=Europe%2FBerlin");
$europe_cities=json_decode($europe);
foreach($europe_cities->records as $city){
	$sql=$wpdb->prepare("INSERT IGNORE  into wp_coordinates (recordid,lat,lng,country) values (%s,%d,%d,%s)",array($city->recordid,$city->fields->coordinates[0],$city->fields->coordinates[1],$city->fields->country));
$wpdb->query($sql);
}

}
register_activation_hook( __FILE__, 'myplugin_activate' );

?>
