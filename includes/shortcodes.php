<?php
/***************************
* Shortcodes
* Creates shortcode [saucy_social_shares] 
***************************/

function saucy_social_shares_func(){

  global $saucyss_options;

  // var_dump($saucyss_options);

  $post = get_post();

  $share_btns_enabled = 0;
  // Get current page URL 
  $urlToShare = get_permalink($post->ID);
  // Get current page title
  $titleToShare = str_replace( ' ', '%20', $post->post_title);
  // Get Post Thumbnail for pinterest
  $thumbnailToShare = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
  // Get Bloginfo Name
  $siteTitle = str_replace( ' ', '%20', get_bloginfo('name'));

  /* Facebook */
  if ( isset( $saucyss_options['enable_Facebook'] ) ) {
    $fb_url = 'https://www.facebook.com/sharer/sharer.php?u='.$urlToShare;
    $share_btns_enabled++;    
  }

  /* Twitter */
  if ( isset( $saucyss_options['enable_Twitter'] ) ) {

    if ( isset( $saucyss_options['twitter_handle'] ) ) {
      // Get Twitter Handle
      $twitterHandle = $saucyss_options['twitter_handle'];
      $twitterHandle = str_replace('https://twitter.com/', '', $twitterHandle);
    }

    if ($twitterHandle){  
      $twitter_url = 'https://twitter.com/intent/tweet?text='.$titleToShare.'&amp;url='.$urlToShare.'&amp;via='.$twitterHandle;
    } else {
      $twitter_url = 'https://twitter.com/intent/tweet?text='.$titleToShare.'&amp;url='.$urlToShare.'&amp;via='.$siteTitle;
    }
    $share_btns_enabled++;    
  }

  /* Pinterest */
  if ( isset( $saucyss_options['enable_Pinterest'] ) ) {
    $pinterest_url = 'https://pinterest.com/pin/create/button/?url='.$urlToShare.'&amp;media='.$thumbnailToShare[0].'&amp;description='.$titleToShare;
    $share_btns_enabled++;    
  }

  /* Google Plus */
  if ( isset( $saucyss_options['enable_GPlus'] ) ) {
    $google_url = 'https://plus.google.com/share?url='.$urlToShare;
    $share_btns_enabled++;    
  }

  /* Linkedin */
  if ( isset( $saucyss_options['enable_Linkedin'] ) ) {
    $linkedin_url = 'http://www.linkedin.com/shareArticle?mini=true&url=' . $urlToShare . '&title=' . $titleToShare;
    $share_btns_enabled++;
  }

  /* Reddit */
  if ( isset( $saucyss_options['enable_Reddit'] ) ) {
    $reddit_url = 'http://www.reddit.com/submit?url=' . $urlToShare . '&title=' . $titleToShare;
    $share_btns_enabled++;
  }  

  ob_start(); ?>

  <h3 class="mobile-share-text"><?php _e('Share', 'saucyss_'); ?></h3>

  <ul id="saucy-social-shares-ul" class="social-shares <?php echo $saucyss_options['styling_theme']; ?> saucyss-btns-<?php echo $share_btns_enabled; ?> clearfix">

    <li><?php _e('Share', 'saucyss_'); ?></li>

    <?php if ( isset( $saucyss_options['enable_Facebook'] ) ): ?>
      <li class="facebook-share">
        <a href="<?php echo $fb_url; ?>" title="<?php esc_attr_e('Share On Facebook'); ?>" rel="nofollow" class="open-share-window" >
          <i class="fa fa-facebook"></i>
        </a>
      </li>
    <?php endif;

    if ( isset( $saucyss_options['enable_Twitter'] ) ): ?>
      <li class="twitter-share">
        <a href="<?php echo $twitter_url; ?>" title="<?php esc_attr_e('Share On Twitter'); ?>" rel="nofollow" class="open-share-window" >
          <i class="fa fa-twitter"></i>
        </a>
      </li>
    <?php endif;

    if ( isset( $saucyss_options['enable_Pinterest'] ) ): ?>
      <li class="pinterest-share">
        <a href="<?php echo $pinterest_url; ?>" title="<?php esc_attr_e('Share On Pinterest'); ?>" rel="nofollow" class="open-share-window" >
          <i class="fa fa-pinterest"></i>
        </a>
      </li>
    <?php endif;

    if ( isset( $saucyss_options['enable_GPlus'] ) ): ?>
      <li class="google-share">
        <a href="<?php echo $google_url; ?>" title="<?php esc_attr_e('Share On Google Plus'); ?>" rel="nofollow" class="open-share-window" >
          <i class="fa fa-google"></i>
        </a>
      </li>
    <?php endif;

    if ( isset( $saucyss_options['enable_Linkedin'] ) ): ?>
      <li class="linkedin-share">
        <a href="<?php echo $linkedin_url; ?>" title="<?php esc_attr_e('Share On Linkedin'); ?>" rel="nofollow" class="open-share-window" >
          <i class="fa fa-linkedin"></i>
        </a>
      </li>
    <?php endif;

    if ( isset( $saucyss_options['enable_Reddit'] ) ): ?>
      <li class="reddit-share">
        <a href="<?php echo $reddit_url; ?>" title="<?php esc_attr_e('Share On Reddit'); ?>" rel="nofollow" class="open-share-window" >
          <i class="fa fa-reddit"></i>
        </a>
      </li>
    <?php endif; ?>

  </ul>
  <?php 
  $output_string = ob_get_contents();
  ob_get_clean();
  return $output_string;
}

add_shortcode('saucy_social_shares', 'saucy_social_shares_func');