<?php
class Woocommerce_Cart_Widget extends \Elementor\Widget_Base
{
	function get_name()
	{
		return 'woo-cart-elementor';
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

	function _register_controls()
	{
		// Content
		$this->start_controls_section(
			'content_section',
			[
				'label' => __('Content'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'cart_style',
			[
				'label'   => __('Cart Style'),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'basic'  => __('Basic'),
					'simple' => __('Simple'),
				],
				'default' => 'basic',
			]
		);
		$this->add_control(
			'icon',
			[
				'label' => __('Cart Icon'),
				'type' => \Elementor\Controls_Manager::ICONS,
			]
		);

		$this->end_controls_section();
	}

	function render()
	{
		$settings = $this->get_settings_for_display();

		$icon = $settings['icon'];
		$style = $settings['cart_style'];
		?>
		<div class="woo-cart <?= $style ?>">
			<!-- Icon -->
			<a class="woo-cart-icon" href="<?= wc_get_cart_url() ?>">
				<?php if ($icon['library'] != 'svg') : ?>
					<i class="<?= $icon['value'] ?>"></i>
				<?php else : ?>
					<img src="<?= $icon['value']['url'] ?>" alt="">
				<?php endif ?>

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

		function _content_template()
		{ ?>

		<div class="woo-cart {{{ settings.cart_style }}}">
			<!-- Icon -->
			<a class="woo-cart-icon" href="<?= wc_get_cart_url() ?>">
				<# if(settings.icon.library !='svg' ) { #>
					<i class="{{{ settings.icon.value }}}"></i>
					<# } else { #>
						<img src="{{{ settings.icon.value.url }}}" alt="">
						<# } #>

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
