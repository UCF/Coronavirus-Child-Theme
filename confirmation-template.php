<?php
    /*
    Template Name: Confirmation
	*/

	get_header();
	the_post();

	$message = "";

	if( isset ( $_GET['audience'] ) && have_rows( 'confirmations', $post ) ) :
		$confirmations = get_field( 'confirmations', $post );
		$message_key = array_search( $_GET['audience'], array_column( $confirmations, 'confirmation_parameter' ) );
		$message = ( $message_key === FALSE || $message_key === "" ) ? "" : $confirmations[$message_key]['confirmation_message'];
	endif;
?>

<div class="container">
	<div class="row my-4 my-lg-5">
		<div class="col-lg-8 offset-lg-2">
			<?php echo $message; ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>
