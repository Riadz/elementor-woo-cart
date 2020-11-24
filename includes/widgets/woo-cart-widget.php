<?php
class Woocommerce_Cart_Widget extends \Elementor\Widget_Base
{
	function get_name()
	{
		return 'woo-cart-elementor-llosqld';
	}
	function get_title()
	{
		return 'Woocommerce Cart Widget';
	}
	function get_icon()
	{
		return 'fas fa-cart-plus';
	}
	function get_categories()
	{
		return ['general'];
	}

	function render()
	{ ?>

		<div class="woo-cart basic">
			<!-- Icon -->
			<a class="woo-cart-icon" href="<?= wc_get_cart_url() ?>">
				<i class="fas fa-shopping-cart"></i>
				<span class="count"><?= wc()->cart->get_cart_contents_count() ?></span>
			</a>

			<!-- Dropdown -->
			<div class="woo-cart-dropdown">
				<div class="woo-cart-header">
					<span>Cart</span>
					<a href="<?= wc_get_cart_url() ?>">
						<i class="fas fa-external-link-alt"></i>
					</a>
				</div>
				<div class="woo-cart-content">
					<?php woocommerce_mini_cart() ?>
				</div>
			</div>
		</div>

<?php
	}
}
