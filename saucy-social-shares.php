<?php
/*
Plugin Name: Saucy Social Shares
Plugin URI: https://mydigitalsauce.com
Description: A Saucy Simple plugin that allows you to place social share buttons anywhere on your WordPress site via a shortcode or appending the social share buttons to pages posts or any custom post type.
Author: MyDigitalSauce
Author URI: https://mydigitalsauce.com/author/mydigitalsauce
Version: 1.2
*/

/***************************
* Global Variables
***************************/
$saucyss_prefix = 'saucyss_';
$saucyss_plugin_name = 'Saucy Social Shares';

// retrieve our plugin settings from the options table
$saucyss_options = get_option('saucyss_settings');

/***************************
* Constants
***************************/
// if(!defined('SAUCYSS_DIR')) define('SAUCYSS_DIR', dirname( __FILE__ ) );

define('SAUCYSS_DIR', dirname( __FILE__ ) );

if ( ! defined( 'SAUCYSS_URL' ) ) {
	define ( 'SAUCYSS_URL', plugin_dir_path( __FILE__ ) );
}

/***************************
* Internalization
***************************/
/**
 * Loads plugin text domain
 *
 * Used for internationalization
 *
 * @access      private
 * @since       1.0 
 * @return      void
*/
function saucyss_textdomain() {
	load_plugin_textdomain( 'saucyss_', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action('init', 'saucyss_textdomain');


/***************************
* Includes
***************************/
/* Admin Area - Back End */
if ( is_admin() ) {
	include( SAUCYSS_URL . 'includes/admin-page.php'); // admin page	
	include( SAUCYSS_URL . 'includes/admin-enqueue-scripts.php'); // enqueues js and css
} else {
	/* Front End */
	include( SAUCYSS_URL . 'includes/enqueue-scripts.php'); // enqueues js and css
}
/* Loaded Globally */
include( SAUCYSS_URL . 'includes/functions.php'); // display content functions
include( SAUCYSS_URL . 'includes/shortcodes.php'); // shortcodes

