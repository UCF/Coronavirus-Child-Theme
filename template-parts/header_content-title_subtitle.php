<?php
$obj              = ucfwp_get_queried_object();
$title            = ucfwp_get_header_title( $obj );
$subtitle         = ucfwp_get_header_subtitle( $obj );
$h1               = ucfwp_get_header_h1_option( $obj );
$h1_elem          = ( is_home() || is_front_page() ) ? 'h2' : 'h1'; // name is misleading but we need to override this elem on the homepage
$title_elem       = ( $h1 === 'title' ) ? $h1_elem : 'span';
$subtitle_elem    = ( $h1 === 'subtitle' ) ? $h1_elem : 'p';
$title_classes    = 'cv-header-title mb-1 mb-sm-2';
$subtitle_classes = 'cv-header-subtitle mb-2';
?>

<?php if ( $title ): ?>
<div class="header-content-inner align-self-center py-5 pb-sm-4 mt-sm-5">
	<div class="container">
		<<?php echo $title_elem; ?> class="<?php echo $title_classes; ?>">
			<?php echo $title; ?>
		</<?php echo $title_elem; ?>>

		<?php if ( $subtitle ): ?>
			<<?php echo $subtitle_elem; ?> class="<?php echo $subtitle_classes; ?>">
				<?php echo $subtitle; ?>
			</<?php echo $subtitle_elem; ?>>
		<?php endif; ?>
	</div>
</div>
<?php endif; ?>
