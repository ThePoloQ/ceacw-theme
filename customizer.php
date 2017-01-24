<?php
/**
 * Theme Customizer
 *
 * @package ceacw
 */

/**
 * Add the Customizer functionality.
 *
 */
 
 /* Here is a list of default colors to help you out.
 *
 * Body color:                              #444
 * Dark color for text and hover:           #303030
 * Lighter color for text:                  #555 and #777
 *
 * Link color:                              #9b1c51
 * Lighter link color:                      #3b5667
 * Link hover color:                        #525e66
 * Color for text with above backgrounds:   #fff
 *
 * Backgroud colors:                        #aebec8, #f7f6f1 and #f7f7f7
 * Borders:                                 #ddd and #bbb
 */
 
 function ceacw_customize_register( $wp_customize ) {
   
  
	$wp_customize->add_setting(
		'ceacw_link_color',
		array(
			'default'           => apply_filters( 'link_ceacw_color', '#9b1c51' ),
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);


	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
		'ceacw_link_color',
		array(
			'label'       => esc_html__( 'Couleur des liens', 'ceacw' ),
			'section'     => 'colors',
			'priority'    => 40,
		)
	) );
  
	$wp_customize->add_setting(
		'ceacw_link_color_light',
		array(
			'default'           => apply_filters( 'link_ceacw_color_light', '#3b5667' ),
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);


	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
		'ceacw_link_color_light',
		array(
			'label'       => esc_html__( 'Couleur des liens éclairés', 'ceacw' ),
			'section'     => 'colors',
			'priority'    => 40,
		)
	) );

	$wp_customize->add_setting(
		'ceacw_link_color_hover',
		array(
			'default'           => apply_filters( 'link_ceacw_color_hover', '#525e66' ),
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);


	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
		'ceacw_link_color_hover',
		array(
			'label'       => esc_html__( 'Couleur des liens survolés', 'ceacw' ),
			'section'     => 'colors',
			'priority'    => 40,
		)
	) );
  
 };

add_action( 'customize_register', 'ceacw_customize_register' );


/** Ajout dans l'entete **/

function ceacw_customize_css() {
  $couleur = get_theme_mod('ceacw_link_color', '#9b1c51');
    ?>
    <!-- Personnalisation des couleurs -->
         <style type="text/css">
             .gcalendar-event-desc-sum a, #menu-primary a, .term a:hover, .main-navigation li a, button#nav-toggle, a, a:visited { color: <?php echo $couleur; ?>; }
             .term a { background-color: <?php echo $couleur; ?>;}
             .widget-title, .widgettitle, input[type="date"]:focus, input[type="datetime-local"]:focus, input[type="datetime"]:focus, input[type="email"]:focus, input[type="month"]:focus, input[type="number"]:focus, input[type="password"]:focus, input[type="search"]:focus, input[type="tel"]:focus, input[type="text"]:focus, input[type="time"]:focus, input[type="url"]:focus, input[type="week"]:focus, select:focus, textarea:focus { border-color: <?php echo $couleur; ?>; }
         </style>
    <?php
}
add_action( 'wp_head', 'ceacw_customize_css');