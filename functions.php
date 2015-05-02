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