<?php

define( 'TEXTDOMAIN', 'testwp');

add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );
function enqueue_parent_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}

add_action('pre_get_posts', 'custom_front_page');
function custom_front_page($wp_query){

	if(is_admin()) {
		return;
	}

	if(is_front_page()) {
		$wp_query->set('post_type', 'movie');
		$wp_query->set('page_id', '');

		$wp_query->is_page = 0;
		$wp_query->is_singular = 0;
		$wp_query->is_post_type_archive = 1;
		$wp_query->is_archive = 1;
	}
}

add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
function woo_remove_product_tabs( $tabs ) {

	unset( $tabs['description'] );

	return $tabs;
}

add_filter( 'body_class', 'add_body_class', 10, 2 );
function add_body_class( $wp_classes, $extra_classes )
{
	$blacklist = array( 'has-sidebar' );

	$wp_classes = array_diff( $wp_classes, $blacklist );

	return array_merge( $wp_classes, (array) $extra_classes );
}

require_once get_theme_file_path( '/inc/custom-posts.php' );

require_once get_theme_file_path( '/inc/registration.php' );

require_once get_theme_file_path( '/inc/payment-gateways.php' );

require_once get_theme_file_path( '/inc/wishlist.php' );