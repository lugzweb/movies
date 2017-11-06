<?php
$user_id = get_current_user_id();
$wishlist = get_user_meta($user_id, 'wishlist', true);
?>

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
    <a rel="nofollow" href="/?add-to-wish=<?= get_the_ID(); ?>" class="button product_type_simple add_to_wish">
		<?php if(is_array($wishlist) && in_array(get_the_ID(),$wishlist)) :?>
            <i class="fa fa-heart" aria-hidden="true"></i>
		<?php else: ?>
            <i class="fa fa-heart-o" aria-hidden="true"></i>
		<?php endif; ?>
    </a>
</li>