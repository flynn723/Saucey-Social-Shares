<?php
/***************************
* Admin Enqueue Scripts
***************************/

function saucyss_admin_scripts() {
    wp_enqueue_script( 'jquery-ui-sortable' );

	wp_enqueue_script ( 'saucyss-admin-scripts', plugin_dir_url( __FILE__) . 'js/admin-plugin-scripts.min.js', array( 'jquery' ), '1.2', true );
}
add_action('admin_enqueue_scripts', 'saucyss_admin_scripts');
