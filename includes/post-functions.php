<?php
/**
 * Functions relating to posts
 */
namespace Coronavirus\Theme\Includes\Post_Functions;
use Coronavirus\Theme\Includes\Utilities as Utilities;


/**
 * Modifies the excerpt value for a post.
 *
 * @since 1.0.0
 * @author Jim Barnes
 */
function update_excerpt( $excerpt, $post ) {
	if ( $post && $post->post_type === 'post' ) {
		$deck = get_field( 'post_deck' );

		$excerpt = ! empty( $deck ) ? $deck : $excerpt;
	}

	return $excerpt;
}

add_filter( 'get_the_excerpt', __NAMESPACE__ . '\update_excerpt', 10, 2 );


/**
 * Displays an article link in a vertical orientation.
 * Always displays a thumbnail.
 *
 * Adapted from Today Child Theme (`today_display_feature_vertical`)
 *
 * @since 1.0.1
 * @author Jo Dickson
 * @param object $post A WP_Post object
 * @param array $args Additional arguments to modify the feature markup. Expects [ucf-post-list] attributes
 * @return string HTML markup
 */
function display_feature_vertical( $post, $args=array() ) {
	if ( ! $post instanceof \WP_Post ) return;

	$type_class     = 'feature-secondary';
	$permalink      = get_permalink( $post );
	$title          = wptexturize( $post->post_title );
	$excerpt        = ucfwp_get_excerpt( $post );
	$excerpt_more   = apply_filters( 'excerpt_more', '' );
	$subhead        = get_the_date( get_option( 'date_format' ), $post );

	ob_start();
?>
	<article class="feature feature-vertical <?php echo $type_class; ?> mb-4" aria-label="<?php echo esc_attr( $title ); ?>">
		<a href="<?php echo $permalink; ?>" class="feature-link">
			<!--TODO configurable heading elem, or just make it a <strong>-->
			<h2 class="feature-title"><?php echo $title; ?></h2>

			<?php if ( $excerpt && $excerpt !== $excerpt_more ): ?>
			<div class="feature-excerpt"><?php echo $excerpt; ?></div>
			<?php endif; ?>

			<?php if ( $subhead ): ?>
			<div class="feature-subhead mt-2"><?php echo $subhead; ?></div>
			<?php endif; ?>
		</a>
	</article>
<?php
	return trim( ob_get_clean() );
}
