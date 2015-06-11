<?php
/**
 * Load up custom.css
 * @return void
 */

//load child theme css
if ( !function_exists('sofa_child_enqueue_scripts') && !is_admin() ) {
	
	function sofa_child_enqueue_scripts() {
		wp_register_style( 'child_custom', get_stylesheet_directory_uri() . "/custom.css", array('franklin-main'), get_franklin_theme()->get_theme_version() );
        wp_enqueue_style( 'child_custom' );
	}

	add_action('wp_enqueue_scripts', 'sofa_child_enqueue_scripts', 99);
}

// log test payments
function sofa_edd_log_test_payment_stats() {
	return true;
}
add_filter('edd_log_test_payment_stats', 'sofa_edd_log_test_payment_stats');

// Expand all accordions
function franklin_child_pledge_levels_wrapper_atts($default) {
    return 'class="accordion-expanded campaign-pledge-levels"';
}

add_filter('franklin_pledge_levels_wrapper_atts', 'franklin_child_pledge_levels_wrapper_atts', 11);


//Add custom login stylesheet
function custom_login_css() {
  echo '<link rel="stylesheet" type="text/css" href="'.get_stylesheet_directory_uri().'/login.css" />';
}
  add_action('login_head', 'custom_login_css');


// Re-enable paypal shipping 

function pw_edd_paypal_shipping_args( $args, $purchase_data ) {
  $args['no_shipping'] = '2';
  return $args;
}
add_filter( 'edd_paypal_redirect_args', 'pw_edd_paypal_shipping_args', 10, 2 );


if ( !function_exists( 'franklin_campaign_video' ) ) {

  function franklin_campaign_video($campaign) {
    global $wp_embed;

    // If a campaign object was not passed, do nothing
    if ( !$campaign instanceof ATCF_Campaign )
      return;

    // If there is no video, do nothing
    if ( !$campaign->video() || trim( $campaign->video() ) == 'http://' )
      return;   
    ?>

    <!-- Campaign video -->
    <section class="campaign-video">
      <?php echo $wp_embed->run_shortcode('[embed]'.$campaign->video().'[/embed]' ) ?>
    </section>
    <!-- End campaign video -->

    <?php
  }
}


remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );


