<?php
/**
 * Handle all theme configuration here
 **/
namespace Coronavirus\Theme\Includes\Config;


define( 'CORONAVIRUS_THEME_URL', get_stylesheet_directory_uri() );
define( 'CORONAVIRUS_THEME_STATIC_URL', CORONAVIRUS_THEME_URL . '/static' );
define( 'CORONAVIRUS_THEME_CSS_URL', CORONAVIRUS_THEME_STATIC_URL . '/css' );
define( 'CORONAVIRUS_THEME_JS_URL', CORONAVIRUS_THEME_STATIC_URL . '/js' );
define( 'CORONAVIRUS_THEME_IMG_URL', CORONAVIRUS_THEME_STATIC_URL . '/img' );
define( 'CORONAVIRUS_THEME_CUSTOMIZER_PREFIX', 'ucfcoronavirus_' );


/**
 * Initialization functions to be fired early when WordPress loads the theme.
 *
 * @since 1.0.0
 * @author Jo Dickson
 */
function init() {
	// Remove unused image sizes registered in UCF WP Theme
	remove_image_size( 'bg-img' );
	remove_image_size( 'bg-img-sm' );
	remove_image_size( 'bg-img-md' );
	remove_image_size( 'bg-img-lg' );
	remove_image_size( 'bg-img-xl' );
}

add_action( 'after_setup_theme', __NAMESPACE__ . '\init', 11 );


/**
 * Defines sections used in the WordPress Customizer.
 *
 * @since 1.0.0
 * @author Jo Dickson
 */
function define_customizer_sections( $wp_customize ) {
	$wp_customize->add_section(
		CORONAVIRUS_THEME_CUSTOMIZER_PREFIX . 'headers',
		array(
			'title' => 'Headers'
		)
	);
}

add_action( 'customize_register', __NAMESPACE__ . '\define_customizer_sections' );


/**
 * Defines settings and controls used in the WordPress Customizer.
 *
 * @since 1.0.0
 * @author Jo Dickson
 */
function define_customizer_fields( $wp_customize ) {
	// Headers
	$wp_customize->add_setting(
		'header_default_sm',
		array(
			'default' => ''
		)
	);

	$wp_customize->add_control(
		new \WP_Customize_Media_Control(
			$wp_customize,
			'header_default_sm',
			array(
				'label'       => 'Default header image (sm+)',
				'description' => 'Header image to use on pages that don\'t have a specific header image selected (for -sm breakpoint and up.)',
				'section'     => CORONAVIRUS_THEME_CUSTOMIZER_PREFIX . 'headers',
				'mime_type'   => 'image'
			)
		)
	);

	$wp_customize->add_setting(
		'header_default_xs',
		array(
			'default' => ''
		)
	);

	$wp_customize->add_control(
		new \WP_Customize_Media_Control(
			$wp_customize,
			'header_default_xs',
			array(
				'label'       => 'Default header image (xs)',
				'description' => 'Header image to use on pages that don\'t have a specific header image selected (for -xs breakpoint only.)',
				'section'     => CORONAVIRUS_THEME_CUSTOMIZER_PREFIX . 'headers',
				'mime_type'   => 'image'
			)
		)
	);
}

add_action( 'customize_register', __NAMESPACE__ . '\define_customizer_fields' );
