<?php
/*
 * Plugin Name: PRyC WP: Add timestamp to style.css link
 * Plugin URI:
 * Description: PRyC Wordpress: Add timestamp to style.css link (eg: style.css?1412863646&#038). Also works with child theme style.css
 * Author: PRyC
 * Author URI: http://PRyC.pl
 * Version: 1.0.4
 */
 
/* CODE: */

if ( ! defined( 'ABSPATH' ) ) exit;

add_action('wp_enqueue_scripts','pryc_wp_add_timestamp_to_style_css_link',999);
function pryc_wp_add_timestamp_to_style_css_link() {

	if (!wp_style_is('style','done')) {
	
		if (get_template() != get_stylesheet()) {
			$parent_theme = wp_get_theme();
			$parent_theme_name = strtolower($parent_theme->parent_theme);
		
			wp_deregister_style($parent_theme_name.'-style');
			wp_dequeue_style($parent_theme_name.'-style');
		}
		else {
			wp_deregister_style('style');
			wp_dequeue_style('style');
		}

		$style_path = get_stylesheet_directory().'/style.css';
		if (file_exists($style_path)) {
			wp_enqueue_style(get_stylesheet().'-style',get_stylesheet_uri().'?'.filemtime($style_path));
		}

	}

}
/* END */
