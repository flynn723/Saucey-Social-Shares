<?php
/***************************
* Admin Page
***************************/

/*
==== Saucy Social Shares Options ====

== Functional Settings ==
= Where should Saucy Social Shares Appear? =
- Input type - Select - top or bottom of post types
- Input type - Checkbox - pages, posts (default), custom post types?

= What social networks should Saucy Social Shares Display? =
- Input type - Checkbox - facebook, twitter, pinterest, g plus, ect...?
= Social details?
- Input type - Text - Twitter Handle?

== Styling Settings ==
= Choose Styling Theme =
- Input type - Select - Dark (default), Light
- Input type - Textarea - Custom CSS

*/

function saucyss_add_options_link(){
	add_options_page('Saucy Social Shares Options', 'Saucy Social Shares', 'manage_options', 'saucyss-options', 'saucyss_options_page');
}
add_action('admin_menu', 'saucyss_add_options_link');

function saucyss_register_settings(){
	register_setting('saucyss_settings_group', 'saucyss_settings');
}
add_action('admin_init', 'saucyss_register_settings');

function saucyss_options_page(){

	global $saucyss_options;

	// if( isset( $_GET[ 'tab' ] ) ) {
	//     $active_tab = $_GET[ 'tab' ];
	// }

	ob_start(); ?>
	<div class="wrap">

		<h2><?php _e('Saucy Social Shares Options', 'saucyss_domain'); ?></h2>

	<form method="post" action="options.php">


	<div id="poststuff">
	    <div id="post-body" class="metabox-holder columns-2">

	        <!-- <div id="postbox-container-1" class="postbox-container">
	            <div id="side-sortables" class="meta-box-sortables ui-sortable">
	                <div id="apf_demo_pagemetabox__side" class="postbox ">
	                    <button type="button" class="handlediv button-link" aria-expanded="true"><span class="screen-reader-text">Toggle panel: Side</span><span class="toggle-indicator" aria-hidden="true"></span></button>
	                    <h2 class="hndle ui-sortable-handle"><span>Side</span></h2>
	                    <div class="inside">
	                    	Test
	                    </div>
	                </div>
	            </div>
	        </div> --><!-- end of <div id="postbox-container-1" -->


	        <div id="postbox-container-2" class="postbox-container">
	            <div id="normal-sortables" class="meta-box-sortables ui-sortable">
	                <div id="" class="postbox">
	                    <button type="button" class="toggle-postbox-inside handlediv button-link" aria-expanded="true"><span class="screen-reader-text">Toggle panel: Normal</span><span class="toggle-indicator" aria-hidden="true"></span></button>
	                    <h2 class="hndle ui-sortable-handle"><?php _e('Functional Settings', 'saucyss_domain'); ?></h2>
	                    <div class="inside">
							<?php settings_fields('saucyss_settings_group'); ?>
							
							<!-- <h2 class="nav-tab-wrapper">
								<a href="?page=saucyss-options&tab=functional" class="nav-tab <?php // echo $active_tab == 'functional' ? 'nav-tab-active' : ''; ?>">
									<?php // _e('Functional Options', 'saucyss_domain'); ?>
								</a>
								<a href="?page=saucyss-options&tab=styling" class="nav-tab <?php // echo $active_tab == 'styling' ? 'nav-tab-active' : ''; ?>">
									<?php // _e('Styling Options', 'saucyss_domain'); ?>
								</a>
							</h2> -->

							<?php // if ( !isset($active_tab) || isset($active_tab) && $active_tab == "functional") { ?>

								<pre>[saucy_social_shares]</pre>
								<p><?php _e('Paste the above shortcode into a WYSIWYG Editor to display Saucy Social Shares anywhere you want.', 'saucyss_domain'); ?></p>

								<h4><?php _e('Where should Saucy Social Shares Appear?', 'saucyss_domain'); ?></h4>

								<p>
									<?php $saucyss_locations = array('Top', 'Bottom'); ?>
									<select name="saucyss_settings[location]"  id="saucyss_settings[location]">
										<?php foreach($saucyss_locations as $saucyss_location){
											if ($saucyss_options['location'] == $saucyss_location){ $selected = 'selected="selected"'; } else { $selected = ''; } ?> ?>
											<option value="<?php echo $saucyss_location; ?>" <?php echo $selected; ?>><?php echo $saucyss_location; ?></option>
										<?php } ?>
									</select>
									<label class="description" for="saucyss_settings[location]"><?php _e('Should Saucey Social Shares appear in the Top or Bottom of post types', 'saucyss_domain'); ?></label>
								</p>
								<?php
								$args = array(
								   'public'   => true,
								);				  
								$post_types = get_post_types( $args, 'names', 'and' );
								if ( $post_types ) { // If there are any public post types. ?>
									<h4><?php _e('What Post Type should Saucy Social Shares Appear On?', 'saucyss_domain'); ?></h4>
									<p>
										<?php
									    foreach ( $post_types  as $post_type ) { ?>
									        <input id="saucyss_settings[enable_<?php echo $post_type; ?>]" class="setting-enable-post-type" type="checkbox" name="saucyss_settings[enable_<?php echo $post_type; ?>]" value="1" <?php checked('1', isset($saucyss_options['enable_' . $post_type])); ?> />
									        <label class="description" for="saucyss_settings[enable_<?php echo $post_type; ?>]"><?php echo $post_type; ?></label>
									    <?php } ?>
									</p>
								<?php } ?>

								<h4><?php _e('What social networks should Saucy Social Shares Display?', 'saucyss_domain'); ?></h4>
								<p>
									<?php $social_networks = array(
															'Facebook',
															'Twitter',
															'Pinterest',
															'GPlus',
															'Linkedin',
															'Reddit' );
								    foreach ( $social_networks  as $social_network ) { ?>
								        <input id="saucyss_settings[enable_<?php echo $social_network; ?>]" class="setting-enable-social-network setting-enable-<?php echo $social_network; ?>" type="checkbox" name="saucyss_settings[enable_<?php echo $social_network; ?>]" value="1" <?php checked( '1', isset( $saucyss_options['enable_' . $social_network] ) ); ?> />
								        <label class="description" for="saucyss_settings[enable_<?php echo $social_network; ?>]"><?php echo $social_network; ?></label>
								    <?php } ?>
								</p>

								<p class="option-twitter-handle-setting-wrap">
									<input id="saucyss_settings[twitter_handle]" name="saucyss_settings[twitter_handle]" type="text" value="<?php echo $saucyss_options['twitter_handle']; ?>"/>
									<label class="description" for="saucyss_settings[twitter_handle]" class="setting-"></label>
									<?php _e('Enter your Twitter Handle without the @', 'saucyss_domain'); ?>
								</p>

							<?php // } else if (isset($active_tab) && $active_tab == "styling") { ?>

								<h4><?php _e('Saucy Social Shares CSS Styling', 'saucyss_domain'); ?></h4>
								<p>
									<input id="saucyss_settings[disable_styling]" class="setting-saucy-styling" type="checkbox" name="saucyss_settings[disable_styling]" value="1" <?php checked('1', isset($saucyss_options['disable_styling'])); ?> />
									<label class="description" for="saucyss_settings[disable_styling]"><?php _e('Check - Disable saucy styling', 'saucyss_domain'); ?></label>
								</p>
								<p class="option-styling-theme-setting-wrap">
									<?php $styling_themes = array('Dark', 'Light'); ?>
									<select name="saucyss_settings[styling_theme]" id="saucyss_settings[styling_theme]">
										<?php foreach($styling_themes as $styling_theme){
											if ($saucyss_options['styling_theme'] == $styling_theme){ $selected = 'selected="selected"'; } else { $selected = ''; } ?> ?>
											<option value="<?php echo $styling_theme; ?>" <?php echo $selected; ?>><?php echo $styling_theme; ?></option>
										<?php } ?>
									</select>
									<label class="description" for="saucyss_settings[styling_theme]"><?php _e('Select your Styling Theme', 'saucyss_domain'); ?></label>
								</p>
								<p class="option-custom-css-setting-wrap">
									<label class="description" for="saucyss_settings[custom_css]"><?php _e('Enter Custom CSS', 'saucyss_domain'); ?></label>
									<br/>
									<textarea id="saucyss_settings[custom_css]" name="saucyss_settings[custom_css]" cols="80" rows="10"><?php echo $saucyss_options['custom_css']; ?></textarea>
								</p>

							<?php // } /* end of else if (isset($_GET['tab']) && $_GET['tab'] == "styling") { */ ?>

							<p class="submit">
								<input type="submit" class="button-primary" value="<?php _e('Save Options', 'saucyss_domain'); ?>"/>
							</p>

							<?php settings_errors( 'saucyss_settings_group' ); ?>

	                    </div>
	                </div>
	            </div>
	        </div><!-- end of <div id="postbox-container-2" -->

	    </div><!-- end of <div id="post-body" -->
	</div><!-- end of <div id="poststuff"> -->

	</form>

	</div><!-- end of <div class="wrap"> -->

	<?php
	echo ob_get_clean();
}