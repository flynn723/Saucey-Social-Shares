<?php
/***************************
* Enqueue Scripts
***************************/

function saucyss_load_scripts(){
	global $saucyss_options;
	
	wp_enqueue_style('font-awesome', plugin_dir_url(__FILE__) . 'css/font-awesome-social-icons-only.min.css');
	if ( ! isset( $saucyss_options['disable_styling'] ) ){
		wp_enqueue_style('saucyss-styles', plugin_dir_url(__FILE__) . 'css/plugin-style.min.css', array( ), '1.2');			
	}
	wp_enqueue_script ( 'saucyss-scripts', plugin_dir_url( __FILE__) . 'js/plugin-scripts.js', array( 'jquery' ), '1.1', true );

}
add_action('wp_enqueue_scripts', 'saucyss_load_scripts');
