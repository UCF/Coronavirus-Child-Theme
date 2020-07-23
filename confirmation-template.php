<?php
    /*
    Template Name: Confirmation
	*/

	get_header();
	the_post();

?>
<div class="container">
	<div class="row my-5">
		<div class="col-lg-8 offset-lg-2">
<?php

	the_content();

	if( have_rows( 'confirmations', $post ) ):

		while( have_rows( 'confirmations', $post ) ) : the_row();

			if( isset( $_GET[ get_sub_field( 'confirmation_parameter', $post ) ] ) ) {
				echo get_sub_field( 'confirmation_message', $post );
			}

		endwhile;

	endif;
?>
		</div>
	</div>
</div>

<?php get_footer(); ?>
