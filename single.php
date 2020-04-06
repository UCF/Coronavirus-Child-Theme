<?php
/**
 * Template for a single post
 */

$deck = get_field( 'post_deck' );
?>

<?php get_header(); the_post(); ?>

<article class="<?php echo $post->post_status; ?> post-list-item">
	<div class="container mt-4 mt-sm-5 mb-5 pb-sm-4">
		<?php if ( ! empty( $deck ) ) : ?>
		<div class="lead mb-3">
			<?php echo $deck; ?>
		</div>
		<?php endif; ?>
		<?php the_content(); ?>
	</div>
</article>

<?php get_footer(); ?>
