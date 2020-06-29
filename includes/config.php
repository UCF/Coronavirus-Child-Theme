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
	// Custom menu location for this theme's homepage icon grid
	register_nav_menu( 'home-icon-menu', __( 'Home Icon Menu' ) );

	// Remove unused header menu registered in UCF WP Theme
	unregister_nav_menu( 'header-menu' );

	// Remove unused image sizes registered in UCF WP Theme
	remove_image_size( 'bg-img' );
	remove_image_size( 'bg-img-sm' );
	remove_image_size( 'bg-img-md' );
	remove_image_size( 'bg-img-lg' );
	remove_image_size( 'bg-img-xl' );

	// Enable breadcrumbs (requires Yoast SEO)
	add_theme_support( 'yoast-seo-breadcrumbs' );
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
			'description' => 'Text to display above the page title on all subpages (excluding those using custom header markup). This text links back to the site homepage.',
			'section'     => CORONAVIRUS_THEME_CUSTOMIZER_PREFIX . 'headers'
		)
	);

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


/**
 * Enable responsive embeds (handled by Athena Shortcodes Plugin)
 *
 * @since 1.0.0
 * @author Jo Dickson
 */
add_filter( 'athena_sc_enable_responsive_embeds', '__return_true' );
add_filter( 'option_athena_sc_enable_responsive_embeds', '__return_true' );


/**
 * Enable Athena classes on generated FAQ markup.
 *
 * @since 1.0.0
 * @author Jo Dickson
 */
add_filter( 'option_ucf_faq_include_athena_classes', '__return_true' );


/**
 * Force-disable FAQ archives in favor of controlling
 * FAQ lists manually via pages on this site.
 *
 * @since 1.0.0
 * @author Jo Dickson
 */
add_filter( 'option_ucf_faq_disable_faq_archive', '__return_true' );


/**
 * Force new FAQs to have a very high default sort order, pushing
 * them to the bottom of sorted FAQ lists.
 *
 * @since 1.0.0
 * @author Jo Dickson
 */
add_filter( 'option_ucf_faq_default_sort_order', '__return_true' );


/**
 * Force the ACF Font Awesome plugin to use v4 icons.
 *
 * @since 1.0.0
 * @author Jo Dickson
 */
function fontawesome_version() {
	return 4;
}

add_filter( 'ACFFA_override_major_version', __NAMESPACE__ . '\fontawesome_version' );


/**
 * Overriding the parent theme function to add in feeds.
 *
 * @since 1.0.1
 * @author RJ Bruneel
 **/
function ucfwp_kill_unused_templates() {
	global $wp_query, $post;

	if ( is_author() || is_attachment() || is_date() || is_search() || is_comment_feed() ) {
		wp_redirect( home_url() );
		exit();
	}
}
add_action( 'template_redirect', __NAMESPACE__ . '\ucfwp_kill_unused_templates' );

function enable_unused_templates() {
    remove_filter( 'template_redirect', 'ucfwp_kill_unused_templates' );
}
add_action( 'after_setup_theme', __NAMESPACE__ . '\enable_unused_templates' );
