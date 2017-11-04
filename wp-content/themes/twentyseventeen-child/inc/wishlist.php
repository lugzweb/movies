<?php
/**
 * Add wishlist page
 */
add_filter( 'woocommerce_account_menu_items', 'iconic_account_menu_items' );
function iconic_account_menu_items( $items ) {
	$items['wishlist'] = __( 'Wishlist', TEXTDOMAIN );

	return $items;
}

add_action( 'init', 'add_my_account_wishlist' );
function add_my_account_wishlist() {
	add_rewrite_endpoint( 'wishlist', EP_PAGES );
}

add_action( 'woocommerce_account_wishlist_endpoint', 'wishlist_endpoint_content' );
function wishlist_endpoint_content() {
	get_template_part('template-parts/wishlist');
}

add_filter('woocommerce_login_redirect', 'wc_login_redirect');
function wc_login_redirect( $redirect_to ) {
	return site_url('my-account/wishlist/');
}

/**
 * Add movie to wishlist
 */
add_filter( 'query_vars', 'add_query_vars_filter' );
function add_query_vars_filter( $vars ){
	$vars[] = 'add-to-wish';
	$vars[] = 'remove-wish';
	return $vars;
}

add_action( 'pre_get_posts', 'add_wishlist_product' );
function add_wishlist_product() {
	$wish_id = get_query_var('add-to-wish');

	$user_id = get_current_user_id();

	if($wish_id) {

		if($user_id) {

			$wishlist = get_user_meta($user_id, 'wishlist', true);

			if(empty($wishlist))
				$wishlist = array( $wish_id );
			else if( !in_array( $wish_id, $wishlist ) )
				$wishlist[] = $wish_id;

			update_user_meta($user_id, 'wishlist', $wishlist);

			wp_redirect(site_url('my-account/wishlist/'));
			exit;
		}
		else {

			wp_redirect(site_url('my-account/'));
			exit;
		}
	}
}

/**
 * Remove movie from wishlist
 */
add_action( 'pre_get_posts', 'remove_wishlist_product' );
function remove_wishlist_product() {
	$wish_id = get_query_var('remove-wish');

	$user_id = get_current_user_id();
	$key = false;

	if($wish_id && $user_id) {

		$wishlist = get_user_meta($user_id, 'wishlist', true);

		if(!empty($wishlist))
			$key = array_search($wish_id, $wishlist);

		if($key !== false) {

			unset($wishlist[$key]);

			$wishlist = array_values($wishlist);

			update_user_meta($user_id, 'wishlist', $wishlist);
		}

		wp_redirect(site_url('my-account/wishlist/'));
		exit;
	}
}