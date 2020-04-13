<?php
use Coronavirus\Theme\Includes\Post_Functions as Post_Functions;
?>

<?php get_header(); ?>

<div class="container mt-5 mb-5 pb-sm-4">

<?php if ( have_posts() ): ?>
	<div class="row">
		<?php while ( have_posts() ) : the_post(); ?>
		<div class="col-md-6 col-lg-4">
			<?php echo Post_Functions\display_feature_vertical( $post ); ?>
		</div>
		<?php endwhile; ?>
	</div>
	<?php ucfwp_the_posts_pagination(); ?>
<?php else: ?>
	<p>No results found.</p>
<?php endif; ?>

</div>

<?php get_footer(); ?>
