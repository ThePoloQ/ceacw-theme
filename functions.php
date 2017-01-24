<?php
/**
 * Toivo functions, definitions, filters and actions.
 *
 * @package ceacw
 */

/**
 * The current version of the theme.
 */
define( 'CEACW_VERSION', '1.1.1' );


/** POUR DEBUGGAGE **/
//error_reporting(E_ALL);
//ini_set('display_errors', '1');


function disable_front_page_redirect_madness($redirect_url) {
        if( is_front_page() ) {
                $redirect_url = false;
        }

        return $redirect_url;
}

add_filter( 'redirect_canonical', 'disable_front_page_redirect_madness' );

function ceacw_jquery() {
  if ( ! is_admin() ){
    wp_deregister_script('jquery');
    wp_deregister_script('jquery-migrate');
    wp_register_script('jquery', '/wp-includes/js/jquery/jquery.js', '1.12.4', TRUE);
    wp_register_script('jquery-migrate', '/wp-includes/js/jquery/jquery-migrate.min.js', array('jquery'), '1.4.1', TRUE );
    wp_enqueue_script('jquery-migrate');
  }
}
add_action( 'init', 'ceacw_jquery' );

function add_menu_atts_title( $atts, $item, $args ) {
    $atts['title'] = esc_attr($item->title);
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'add_menu_atts_title', 11, 3 );


require get_stylesheet_directory() . '/functions-override.php';

require get_stylesheet_directory() . '/functions-terms.php';

require get_stylesheet_directory() . '/customizer.php';

if( !function_exists( 'ceacw_breadcrumb_trail' ) ) {
	require_once( get_stylesheet_directory() . '/inc/breadcrumbs-ceacw.php' );
}