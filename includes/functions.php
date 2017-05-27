<?php
/***************************
* Display Content Functions
***************************/

function saucyss_add_content($content){
	
	global $saucyss_options;

	$are_saucyss_enabled = false;

	$post_types_args = array(
	   'public'   => true,
	);
	$post_types = get_post_types( $post_types_args, 'names', 'and' );

	if ( $post_types ) { // If there are any public post types.
	    foreach ( $post_types  as $post_type ) {
	    	// return content if enable_$post_type is true
	    	if (isset($saucyss_options['enable_'.$post_type])) {
	    		if (is_singular($post_type)) {
	    			$are_saucyss_enabled = true;
	    		}
	    	}
	    } /* end of foreach */
	}

	if ($are_saucyss_enabled) {
		if ($saucyss_options['location'] == "Top") {

			$extra_content = do_shortcode('[saucy_social_shares]');
			$content = $extra_content . $content;

		} else {
			$content .= $extra_content;
		}
		return $content;
	} else {
		return $content;
	}
	
}
add_filter('the_content', 'saucyss_add_content');

function saucyss_custom_css() {
	
	global $saucyss_options;

	if (!isset($saucyss_options['disable_styling'])): ?>
	    <style type="text/css">
		/* Saucy Social Shares Custom CSS */
	    <?php echo $saucyss_options['custom_css']; ?>
	    </style>
<?php endif;
}
add_action('wp_head', 'saucyss_custom_css');