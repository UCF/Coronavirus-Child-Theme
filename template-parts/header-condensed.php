<?php
/**
 * NOTE: this template part does NOT implement header_content
 * template parts.
 */

use Coronavirus\Theme\Includes\Header_Functions as Header_Functions;

$obj        = ucfwp_get_queried_object();
$title      = ucfwp_get_header_title( $obj );
$h1_elem    = ucfwp_get_header_h1_elem( $obj );
$breadcrumb = Header_Functions\get_breadcrumb();
?>

<div class="navbar navbar-light bg-faded mb-4 mb-sm-5">
	<div class="container px-0 px-sm-3 py-3">
		<?php echo $breadcrumb; ?>
	</div>
</div>
<div class="container pt-2 pt-sm-0">
	<<?php echo $h1_elem; ?> class="cv-header-condensed-title">
		<?php echo $title; ?>
	</<?php echo $h1_elem; ?>>
</div>
