<?php
/**
 * Functions relating to posts
 */

namespace Coronavirus\Theme\Includes\Post_Functions;

function update_excerpt( $excerpt, $post ) {
	if ( $post && $post->post_type === 'post' ) {
		$deck = get_field( 'post_deck' );

		$excerpt = ! empty( $deck ) ? $deck : $excerpt;
	}

	return $excerpt;
}

add_filter( 'the_excerpt', __NAMESPACE__ . '\update_excerpt', 10, 2 );
