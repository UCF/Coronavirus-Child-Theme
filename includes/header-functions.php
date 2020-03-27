<?php
/**
 * Includes functions that handle customization and/or
 * overrides of headers from the UCF WordPress Theme.
 **/
namespace Coronavirus\Theme\Includes\Header_Functions;


/**
 * Set default header images when custom images aren't set
 * on a post/page/term.  Ensures the 'media' header type is
 * always used.
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
 */
function get_header_content_type( $content_type, $obj ) {
	if ( $content_type !== 'custom' ) {
		$content_type = 'title_subtitle';
	}
	return $content_type;
}

add_filter( 'ucfwp_get_header_content_type', __NAMESPACE__ . '\get_header_content_type', 11, 2 );
