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
 * Defines settings and controls used in the WordPress Customizer.
 *
 * @since 1.0.0
 * @author Jo Dickson
 */
function define_customizer_fields( $wp_customize ) {
	// Site Identity
	$wp_customize->add_setting(
		'header_breadcrumb_text',
		array(
			'default' => ''
		)
	);

	$wp_customize->add_control(
		'header_breadcrumb_text',
		array(
			'type'        => 'text',
			'label'       => 'Header breadcrumb text',
			'description' => 'Text to display above the page title on all subpages, which links back to the site homepage.',
			'section'     => 'title_tagline'
		)
	);
}

add_action( 'customize_register', __NAMESPACE__ . '\define_customizer_fields' );
