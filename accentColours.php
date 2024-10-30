<?php
/**
 * Plugin Name: Colour Extractor
 * Plugin URI: http://jthaw.me
 * Description: A plugin to pull the main and accent colours.
 * Version: 0.0.1
 * Author: Jonny Thaw
 * Author URI: http://jthaw.me
 * License: GPL2
 */
 
$dir =  plugin_dir_path( __FILE__ );

require_once($dir."colours.php");

function extractColour($post_id)
{
	$image = wp_get_attachment_image_src($post_id);
	
	$img = str_replace(get_bloginfo('url'),"..",$image[0]);

	$colours = getColours($img);
	
	add_post_meta($post_id, "palette", serialize($colours));
}

add_filter('add_attachment', 'extractColour', 10, 2);

function returnPalette($id = NULL)
{

	$meta = get_post_meta($id, "palette");
	
	if($meta)
	{
		return unserialize($meta[0]);
	}
	else
	{
		return false;
	}
}

?>