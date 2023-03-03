<?php
// ------------------------------------------
// Don't edit this file, use custom.php only!
// ------------------------------------------

// Generate Pretty Menu
function site_menu( $name = '', $depth = 1 ) {
	if( $name ) {
		$menu = wp_nav_menu( "container_class=menu&echo=0&menu=$name&depth=$depth" );
	} else {
		$menu = wp_nav_menu( "container_class=menu&echo=0&depth=$depth" );
	}

	/* Remove the wrapper and the poorly used title element */
	$menu = str_replace( '<div class="menu">', '', $menu );
	$menu = str_replace( '<ul>', '', $menu );
	$menu = str_replace( '</ul></div>', '', $menu );
	$menu = preg_replace( '/<ul id=\"(.*?)\" class=\"(.*?)\">/', '', $menu );
	$menu = preg_replace( '/title=\"(.*?)\"/', '', $menu );
	echo $menu;
}

// Remove Generator
add_filter( 'the_generator', '__return_false' );

// Remove Gravity Forms TabIndex's
add_filter( 'gform_tabindex', '__return_false' );

// Editor Style
add_editor_style();

// Theme Support
function mr_theme_setup() {
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'nav-menus' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'mr_theme_setup' );

// Disable auto-linking to full size images
update_option( 'image_default_link_type', 'none' );