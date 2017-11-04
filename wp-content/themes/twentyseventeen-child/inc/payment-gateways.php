<?php

add_action( 'woocommerce_add_to_cart', 'custom_add_to_cart', 10, 3 );
function custom_add_to_cart( $token, $product_id )
{
	global $woocommerce;

	$customer = $woocommerce->customer;

	if(!empty($customer->get_ID())) {

		$address = array(
			'first_name' => $customer->get_first_name(),
			'last_name'  => $customer->get_last_name(),
			'company'    => $customer->get_billing_company(),
			'email'      => $customer->get_email(),
			'phone'      => $customer->get_billing_phone(),
			'address_1'  => $customer->get_shipping_address_1(),
			'address_2'  => $customer->get_shipping_address_1(),
			'city'       => $customer->get_shipping_city(),
			'state'      => $customer->get_shipping_state(),
			'postcode'   => $customer->get_shipping_postcode(),
			'country'    => $customer->get_shipping_country()
		);

		$order = wc_create_order();

		$product = wc_get_product($product_id);
		$quantity = 1;
		$order->add_product($product, $quantity);

		$order->set_address( $address, 'billing' );
		$order->set_address( $address, 'shipping' );

		$order->calculate_totals();
		$order->update_status( 'processing' );

		WC()->cart->empty_cart();

		$paypal = new WC_Gateway_Paypal();

		$request = $paypal->process_payment($order->get_id());

		wp_redirect($request['redirect']);
		exit;
	}

	wp_redirect(site_url('my-account'));
}