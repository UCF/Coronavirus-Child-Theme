<?php
/**
 * Includes functions that handle customization and/or
 * overrides of headers from the UCF WordPress Theme.
 **/
namespace Coronavirus\Theme\Includes\Header_Functions;


/**
 * Set default header image IDs when custom images aren't set
 * on an object.  Ensures the 'media' header type is always used.
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

	$header_imgs['header_image'] = 'attachmentid'; // TODO retrieve from customizer value
	$header_imgs['header_image_xs'] = 'attachmentid'; // TODO retrieve from customizer value

	return $header_imgs;
}

add_filter( 'ucfwp_get_header_images_after', __NAMESPACE__ . '\header_media_defaults', 11, 2 );


/**
 * Simplifies the logic behind what content_type is returned
 * for an object's header.  Prevents the UCF WP Theme's default
 * header_content template part from being utilized, and always
 * returns either the `title_subtitle` or `custom` template parts.
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
	if ( ! is_home() && ! is_front_page() ) {
		$breadcrumb_text = trim( wptexturize( get_theme_mod( 'header_breadcrumb_text' ) ) );

		if ( $breadcrumb_text ) {
			ob_start();
		?>
			<div class="mb-2">
				<a class="cv-header-breadcrumb" href="<?php echo get_home_url(); ?>">
					<?php echo $breadcrumb_text; ?>
				</a>
			</div>
		<?php
			$retval = trim( ob_get_clean() );
		}
	}
	return $retval;
}
