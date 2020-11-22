<?php
class Woocommerce_Cart_Widget extends \Elementor\Widget_Base
{
	public function get_name()
	{
		return 'woo-cart';
	}
	public function get_title()
	{
		return 'Woocommerce Cart Widget';
	}
	public function get_icon()
	{
		return 'fas fa-cart-plus';
	}
	public function get_categories()
	{
		return ['general'];
	}
}
