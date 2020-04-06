<?php
/**
 * Functions to help with structured data
 */
function generate_structured_data() {
	global $post;

	if ( get_post_type( $post ) === 'post' ) {
		$enabled = get_field( 'post_structured_data' ) ?: false;

		if ( ! $enabled ) return;

		$announcement_text = get_field( 'post_announcement_text' );
		$announcement_text = $announcement_text ?: get_the_excerpt( $post );

		$announcement_expiration = get_field( 'post_expiration_date' );

		$data = array(
			'@context' => 'https://schema.org',
			'@type' => 'SpecialAnnouncement',
			'name' => $post->post_title,
			'text' => $announcement_text,
			'datePosted' => $post->publish_date,
			'category' => 'https://www.wikidata.org/wiki/Q81068910'
		);

		if ( $announcement_expiration ) {
			$data['expires'] = $announcement_expiration;
		}

	?>
	<script type="application/ld+json">
		<?php echo json_encode( $data ); ?>
	</script>
	<?php
	}
}

add_action(  'wp_head', __NAMESPACE__ . '\generate_structured_data', 8, 0 );
