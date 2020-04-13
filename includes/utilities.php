<?php
/**
 * Utility functions
 */
namespace Coronavirus\Theme\Includes\Utilities;


/**
 * Returns an attachment ID for the desired thumbnail
 * image of a given post.  Optionally returns a fallback
 * if no image is available.
 *
 * Adapted from Today Child Theme (`today_get_thumbnail_id`)
 *
 * @since 1.0.0
 * @author Jo Dickson
 * @param mixed $post WP_Post object or post ID
 * @param bool $use_fallback Whether or not a fallback image should be returned if a thumbnail isn't set
 * @return mixed Attachment ID (int) or null on failure
 */
function get_thumbnail_id( $post, $use_fallback=true ) {
	if ( is_numeric( $post ) ) {
		$post = get_post( $post );
	}
	if ( ! $post instanceof \WP_Post ) return null;

	// Try to retrieve a standard featured image first:
	$attachment_id = get_post_thumbnail_id( $post );

	// Use a Yoast social banner image if no featured image is set:
	if ( ! $attachment_id && method_exists( '\WPSEO_Meta', 'get_value' ) ) {
		// Try Twitter first, then Facebook (opengraph)
		$twitter_img_id = \WPSEO_Meta::get_value( 'twitter-image-id', $post->ID );
		if ( $twitter_img_id ) {
			$attachment_id = $twitter_img_id;
		}
		else {
			$attachment_id = \WPSEO_Meta::get_value( 'opengraph-image-id', $post->ID );
		}
	}

	// Get fallback if necessary
	if ( ! $attachment_id && $use_fallback ) {
		// Use the UCF Post List Shortcode plugin's
		// fallback thumbnail, if one is available
		if ( method_exists( '\UCF_Post_List_Config', 'get_option_or_default' ) ) {
			$attachment_id = \UCF_Post_List_Config::get_option_or_default( 'ucf_post_list_fallback_image' );
			$attachment_id = is_numeric( $attachment_id ) ? intval( $attachment_id ) : null;
		}
	}

	return $attachment_id;
}
