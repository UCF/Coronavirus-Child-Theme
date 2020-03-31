<?php
/**
 * Functions that manage navigation-related functionality.
 */
namespace Coronavirus\Theme\Includes\Nav_Functions;


/**
 * Modifies standard wp_nav_menu() output to display
 * Home Icon Menu icons.
 *
 * @since 1.0.0
 * @author Jo Dickson
 * @param array $items The menu items, sorted by each menu item's menu order
 * @param object $args An object containing wp_nav_menu() arguments.
 * @return array Menu items
 */
function home_icon_nav_menu_objects( $items, $args ) {
	if ( $args->theme_location === 'home-icon-menu' ) {
		foreach ( $items as &$item ) {
			$item->title = '<div class="quicklink-label">' . $item->title . '</div>';

			// Set up markup for icons
			$icon_type   = get_field( 'icon_type', $item );
			$icon_markup = '<div class="quicklink-icon" aria-hidden="true">';

			switch ( $icon_type ) {
				case 'custom':
					$icon_img = get_field( 'icon', $item );
					$icon_markup .= '<img class="quicklink-icon-img" src="' . $icon_img['url'] . '">';
					break;
				case 'fontawesome':
				default:
					$icon_class = get_field( 'font_awesome_icon', $item );
					$icon_markup .= '<span class="quicklink-icon-fa fa ' . $icon_class . '"></span>';
					break;
			}

			$icon_markup .= '</div>';

			$item->title = $icon_markup . $item->title;
		}
	}

	return $items;
}

add_filter( 'wp_nav_menu_objects', __NAMESPACE__ . '\home_icon_nav_menu_objects', 10, 2 );


/**
 * Modifies CSS classes applied to the Home Icon Menu's
 * list items (<li> elems).
 *
 * @since 1.0.0
 * @author Jo Dickson
 * @param array $classes Array of the CSS classes that are applied to the menu item's `<li>` element
 * @param object $item The current menu item
 * @param object $args An object of wp_nav_menu() arguments
 * @param int $depth Depth of menu item
 * @return array Modified CSS classes
 */
function home_icon_nav_menu_css_class( $classes, $item, $args, $depth ) {
	if ( $args->theme_location === 'home-icon-menu' ) {
		return array( 'quicklinks-item' );
	}
}

add_filter( 'nav_menu_css_class', __NAMESPACE__ . '\home_icon_nav_menu_css_class', 10, 4 );


/**
 * Returns HTML markup for the Home Icon Menu.
 *
 * @since 1.0.0
 * @author Jo Dickson
 * @return string
 */
function display_home_icon_nav() {
	ob_start();
?>
	<nav aria-label="Featured links">
		<?php
		echo wp_nav_menu( array(
			'menu_class'     => 'quicklinks-grid',
			'container'      => '',
			'fallback_cb'    => false,
			'depth'          => 1,
			'theme_location' => 'home-icon-menu'
		) );
		?>
	</nav>
<?php
	return trim( ob_get_clean() );
}
