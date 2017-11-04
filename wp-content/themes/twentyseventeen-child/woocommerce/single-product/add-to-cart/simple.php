<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product;
$product = wc_get_product($post->ID);

$heading = esc_html( apply_filters( 'woocommerce_product_description_heading', __( 'Description', 'woocommerce' ) ) );

$user_id = get_current_user_id();
$wishlist = get_user_meta($user_id, 'wishlist', true);

if ( ! $product->is_purchasable() ) {
	return;
}

echo wc_get_stock_html( $product );

if ( $product->is_in_stock() ) : ?>

	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	<form class="cart" method="post" enctype='multipart/form-data'>
		<?php
			/**
			 * @since 2.1.0.
			 */
			do_action( 'woocommerce_before_add_to_cart_button' );
		?>

		<?php if ( $heading ) : ?>
            <h2><?php echo $heading; ?></h2>
		<?php endif; ?>

		<?php the_content(); ?>

        <a rel="nofollow" href="/?add-to-cart=<?= get_the_ID(); ?>" class="single_add_to_cart_button button alt">
            Add to cart
        </a>

		<?php
			/**
			 * @since 2.1.0.
			 */
			do_action( 'woocommerce_after_add_to_cart_button' );
		?>
	</form>

	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>
