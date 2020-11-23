<?php
// updating cart dropdown
add_filter('woocommerce_add_to_cart_fragments', function ($fragments) {

	ob_start();

	?>
	<div class="woo-cart-dropdown">
		<?php woocommerce_mini_cart() ?>
	</div>
<?php

	$fragments['.woo-cart .woo-cart-dropdown'] = ob_get_clean();
	return $fragments;
});

// updating cart count
add_filter('woocommerce_add_to_cart_fragments', function ($fragments) {

	ob_start();

	?>
	<span class="count">
		<?= wc()->cart->get_cart_contents_count() ?>
	</span>
<?php

	$fragments['.woo-cart .count'] = ob_get_clean();
	return $fragments;
});
