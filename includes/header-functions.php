<?php
/**
 * Includes functions that handle customization and/or
 * overrides of headers from the UCF WordPress Theme.
 **/
namespace Coronavirus\Theme\Includes\Header_Functions;


/**
 * Set default header image IDs when custom images aren't set
 * on an object.
 *
 * @since 1.0.0
 * @author Jo Dickson
 * @param array $header_imgs A set of Attachment IDs, one sized for use on -sm+ screens, and another for -xs
 * @param mixed $obj A queried object (e.g. WP_Post, WP_Term), or null
 * @return array Modified set of Attachment IDs
 */
function header_media_defaults( $header_imgs, $obj ) {
	if ( isset( $header_imgs['header_image'] ) && $header_imgs['header_image'] ) {
		return $header_imgs;
	}

	$default_sm = get_theme_mod( 'header_default_sm' );
	$default_xs = get_theme_mod( 'header_default_xs' );

	if ( $default_sm ) {
		$header_imgs['header_image'] = $default_sm;
	}

	// Only set `header_image_xs` if the -sm+ image is available
	// AND the -xs image is actually set:
	if ( $default_sm && $default_xs ) {
		$header_imgs['header_image_xs'] = $default_xs;
	}

	return $header_imgs;
}

add_filter( 'ucfwp_get_header_images_after', __NAMESPACE__ . '\header_media_defaults', 11, 2 );


/**
 * Forces headers in this theme to always use the `media`
 * header template part, except for single Posts and FAQs,
 * which use the `condensed` header template part.
 *
 * @since 1.0.0
 * @author Jo Dickson
 * @param string $header_type The object's header type
 * @param mixed $obj A queried object (e.g. WP_Post, WP_Term), or null
 * @return string Modified header type name
 */
function get_header_type( $header_type, $obj ) {
	$header_type = 'media';

	if (
		( ! $obj && ! is_home() )
		|| ( $obj instanceof \WP_Post && in_array( $obj->post_type, array( 'post', 'faq' ) ) )
	) {
		$header_type = 'condensed';
	}

	return $header_type;
}

add_filter( 'ucfwp_get_header_type', __NAMESPACE__ . '\get_header_type', 11, 2 );


/**
 * Modifies the logic behind what content_type is returned
 * for an object's header.  Prevents the UCF WP Theme's default
 * header_content template part from being utilized, and always
 * returns either the `title_subtitle` or `custom` template parts.
 *
 * NOTE: only the `media` header template part utilizes header_content
 * template parts; the `condensed` header bypasses all of this.
 *
 * @since 1.0.0
 * @author Jo Dickson
 * @param string $content_type The object's header_content type
 * @param mixed $obj A queried object (e.g. WP_Post, WP_Term), or null
 * @return string Modified header_content type name
 */
function get_header_content_type( $content_type, $obj ) {
	if ( $content_type !== 'custom' ) {
		$content_type = 'title_subtitle';
	}
	return $content_type;
}

add_filter( 'ucfwp_get_header_content_type', __NAMESPACE__ . '\get_header_content_type', 11, 2 );


/**
 * Returns markup for a breadcrumb back to the homepage, for use above
 * page header title+subtitles.
 *
 * @since 1.0.0
 * @author Jo Dickson
 * @return string
 */
function get_breadcrumb() {
	$retval = '';
	if ( ! is_front_page() ) {
		$breadcrumb_text = trim( wptexturize( get_theme_mod( 'header_breadcrumb_text' ) ) );

		if ( $breadcrumb_text ) {
			ob_start();
		?>
			<nav aria-label="Home breadcrumb">
				<a class="cv-header-breadcrumb" href="<?php echo get_home_url(); ?>">
					<?php echo $breadcrumb_text; ?>
				</a>
			</nav>
		<?php
			$retval = trim( ob_get_clean() );
		}
	}
	return $retval;
}
