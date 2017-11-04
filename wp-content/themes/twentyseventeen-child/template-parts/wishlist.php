<?php
$user_id = get_current_user_id();

$wishlist = get_user_meta($user_id, 'wishlist', true);

if( !empty( $wishlist ) ) :

	$query = new WP_Query(array(
		'per_page' => -1,
		'post_type' => 'movie',
		'post__in' => $wishlist
	));

	if($query->have_posts()) : ?>

		<ul class="products">
			<?php while ($query->have_posts()) : $query->the_post(); ?>

				<li <?php post_class('product'); ?>>
					<a href="<?= get_the_permalink(); ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
						<img width="300" height="300" src="<?= get_the_post_thumbnail_url(); ?>" class="attachment-shop_catalog size-shop_catalog wp-post-image" alt="<?= get_the_title(); ?>">
						<h2 class="woocommerce-loop-product__title"><?= get_the_title(); ?></h2>
						<span class="price">
				            <span class="woocommerce-Price-amount amount">
				                <?= wc_price(get_post_meta(get_the_ID(), '_price', true)); ?>
				            </span>
				        </span>
					</a>
					<a rel="nofollow" href="/?add-to-cart=<?= get_the_ID(); ?>" class="button product_type_simple add_to_cart_button">
						Add to cart
					</a>
					<a rel="nofollow" href="/?remove-wish=<?= get_the_ID(); ?>" class="button product_type_simple remove_wish">
						<i class="fa fa-times" aria-hidden="true"></i>
					</a>
				</li>

			<?php endwhile; ?>
		</ul>

	<?php else: ?>
		<p>Wishlist is empty</p>
	<?php endif; ?>

<?php else: ?>
	<p>Wishlist is empty</p>
<?php endif;