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

	$wp_customize->add_section(
		'social-links',
		array(
			'title'    => esc_html__( 'Intégration des réseaux sociaux', 'ceacw' ),
			'priority' => 80,
			'panel'    => 'theme'
		)
	);

	$wp_customize->add_setting(
		'ceacw_socials_links',
		array(
			'default'           => false,
		)
	);

	$wp_customize->add_control(
		'ceacw_socials_links',
		array(
			'label'    => esc_html__( 'Liens en fin de posts', 'ceacw' ),
			'section'  => 'social-links',
			'priority' => 20,
			'type'     => 'checkbox'
		)
	);

	$wp_customize->add_setting(
		'ceacw_socials_fb_appid',
		array(
			'default'           => '',
                        'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'ceacw_socials_fb_appid',
		array(
			'label'    => esc_html__( 'ID de l\'application facebook', 'ceacw' ),
			'section'  => 'social-links',
			'priority' => 10,
			'type'     => 'text'
		)
	);
	$wp_customize->add_section(
		'theme-pages',
		array(
			'title'    => esc_html__( 'Pages du thème', 'ceacw' ),
			'priority' => 90,
			'panel'    => 'theme'
		)
	);
	$wp_customize->add_setting(
		'ceacw_contact_uri',
		array(
			'default'           => '/',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'ceacw_contact_uri',
		array(
			'label'    => esc_html__( 'Chemin vers la page contact', 'ceacw' ),
			'section'  => 'theme-pages',
			'description' => get_site_url(),
			'priority' => 10,
			'type'     => 'text'
		)
	);

	$wp_customize->add_setting(
		'ceacw_ml_uri',
		array(
			'default'           => '/',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'ceacw_ml_uri',
		array(
			'label'    => esc_html__( 'Chemin vers la page des mentions légales', 'ceacw' ),
			'section'  => 'theme-pages',
			'description' => get_site_url(),
			'priority' => 10,
			'type'     => 'text'
		)
	);

	$wp_customize->add_setting(
		'ceacw_fb_url',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'ceacw_fb_url',
		array(
			'label'    => esc_html__( 'Adresse de la page Facebook', 'ceacw' ),
			'section'  => 'theme-pages',
			'priority' => 10,
			'type'     => 'text'
		)
	);
   
  
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
             .gcalendar-event-desc-sum a, .gcalendar-event-desc-sum a:visited, #menu-primary a, #menu-primary a:visited, .term a:hover, .main-navigation li a, button#nav-toggle, a, a:visited, .entry-title a { color: <?php echo $couleur; ?>; }
             .term a, .term a:visited { background-color: <?php echo $couleur; ?>;}
             .widget-title, .widgettitle, input[type="date"]:focus, input[type="datetime-local"]:focus, input[type="datetime"]:focus, input[type="email"]:focus, input[type="month"]:focus, input[type="number"]:focus, input[type="password"]:focus, input[type="search"]:focus, input[type="tel"]:focus, input[type="text"]:focus, input[type="time"]:focus, input[type="url"]:focus, input[type="week"]:focus, select:focus, textarea:focus { border-color: <?php echo $couleur; ?>; }
         </style>
    <?php
}
add_action( 'wp_head', 'ceacw_customize_css');