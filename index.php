<?php get_header(); ?>

<div class="container mt-5 mb-5 pb-sm-4">
	<div class="row">
		<div class="col-12">
		<?php if ( have_posts() ): ?>
			<?php while ( have_posts() ) : the_post(); ?>
			<article class="archive-post-list-item mb-4 mb-lg-5">
				<a class="archive-post-link" href="<?php the_permalink(); ?>">
					<h2 class="archive-post-title"><?php the_title(); ?></h2>
					<div class="archive-post-excerpt mb-1"><?php the_excerpt(); ?></div>
					<div class="archive-post-date"><?php the_time( 'F j, Y' ); ?></div>
				</a>
			</article>
			<?php endwhile; ?>

			<?php ucfwp_the_posts_pagination(); ?>
		<?php else: ?>
			<p>No results found.</p>
		<?php endif; ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>
