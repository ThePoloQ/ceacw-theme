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

function remove_wp_version(){
    return '';
}

add_filter('the_generator', 'remove_wp_version');

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

function ceacw_social_links($content){
  if (!get_theme_mod('ceacw_socials_links')) return $content;
  $my_url=urlencode(get_permalink());
  $my_title=urlencode(get_the_title());
  
  if ( is_single() ) $my_style=' style="text-align:right;"'; else $my_style="";
  
  $links = '<div class="ceacw-social-links"'.$my_style.'>
  <a target="_blank" href="http://www.facebook.com/sharer/sharer.php?u='.$my_url.'">Facebook</a>
  <a target="_blank" href="http://twitter.com/share?url='.$my_url.'&text='.urlencode('Venez lire l\'article ').$my_title.'">Twitter</a>
  <a target="_blank" href="https://plus.google.com/share?url='.$my_url.'">Google+</a>
  </div>';
  
  return $content.$links;
}

add_filter('the_content', 'ceacw_social_links');
//add_filter('the_excerpt', 'ceacw_social_links');


add_action( 'wp_head', 'ceacw_facebook_tags' );

function ceacw_facebook_tags() {
  $fbappid = get_theme_mod('ceacw_socials_fb_appid');
  if (strlen($fbappid)>0) { ?>
  <meta property="fb:app_id" content="<?php echo esc_attr($fbappid); ?>" />
  <?php
  }
  if(is_front_page()){ ?>
    <meta property="og:title" content="<?php bloginfo('sitename') ?>" />
    <meta property="og:site_name" content="<?php bloginfo('description'); ?>" />
    <meta property="og:url" content="<?php bloginfo('url') ?>" />
    <meta property="og:description" content="<?php bloginfo('description'); ?>" />
    <meta property="og:type" content="website" />

    <?php $image = wp_get_attachment_image_src( get_option('site_icon'), 'ceacw-fb-thumb' ); ?>    
    <meta property="og:image" content="<?php echo $image[0]; ?>"/>

  <?php
  }

  if( is_single() || is_page()) {
    setup_postdata(get_post());
  ?>
    <meta property="og:title" content="<?php the_title(); ?>" />
    <meta property="og:site_name" content="<?php bloginfo( 'description' ); ?>" />
    <meta property="og:url" content="<?php the_permalink(); ?>" />
    <meta property="og:description" content="<?php echo esc_attr(wp_strip_all_tags(get_the_excerpt())); ?>" />
    <meta property="og:type" content="article" />
    
    <?php 
      if ( has_post_thumbnail() ) :
        $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'ceacw-fb-thumb' );
      else :
        $image = wp_get_attachment_image_src( get_option('site_icon'), 'ceacw-fb-thumb' );
    ?>
    <?php endif; ?>
    
    <meta property="og:image" content="<?php echo $image[0]; ?>"/>  
    
  <?php
    wp_reset_postdata();
  }
}

function ceacw_image_size(){
  add_image_size( 'ceacw-fb-thumb', 9999, 300, false);
}


function ceacw_image_add_alt($attr){
    if( !isset( $attr['alt'] )  || strlen($attr['alt'])==0 ){
	if(isset($attr['itemprop'])) $alt=$attr['itemprop'];
        else $alt=$attr['src'];
        $attr['alt'] = $alt;
    }   

    return $attr;
}

add_filter( 'wp_get_attachment_image_attributes',  'ceacw_image_add_alt');

add_action( 'after_setup_theme', 'ceacw_image_size', 11 );

/////////////////////////////////////////////////////////////////////////////////////////////////////

require get_stylesheet_directory() . '/functions-excerpt.php';

require get_stylesheet_directory() . '/functions-override.php';

require get_stylesheet_directory() . '/functions-terms.php';

require get_stylesheet_directory() . '/customizer.php';

if( !function_exists( 'ceacw_breadcrumb_trail' ) ) {
	require_once( get_stylesheet_directory() . '/inc/breadcrumbs-ceacw.php' );
}