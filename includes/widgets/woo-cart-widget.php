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

		// Style
		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => __('Cart Icon'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'size',
			[
				'label' => __('Size'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 200,
					],
				],
				'default' => [
					'size' => 30,
				],
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .woo-cart-icon' => 'font-size: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->start_controls_tabs('tab_icon_color');
		$this->start_controls_tab('icon_color_normal', ['label' => __('Normal')]);
		$this->add_control(
			'icon_color',
			[
				'label'     => __('Color'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#000',
				'selectors' => [
					'{{WRAPPER}} .woo-cart-icon' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab('icon_color_hover', ['label' => __('Hover')]);
		$this->add_control(
			'icon_color:hover',
			[
				'label'     => __('Color'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woo-cart-icon:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_count',
			[
				'label' => __('Cart Item Count'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'count_left',
			[
				'label' => __('X axis'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['%', 'px'],
				'range' => [
					'%' => [
						'min' => -100,
						'max' => 200,
					],
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .woo-cart-icon .count' => 'left: {{SIZE}}{{UNIT}}',
				],
			]
		);
		$this->add_responsive_control(
			'count_top',
			[
				'label' => __('Y axis'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['%', 'px'],
				'default' => ['unit' => '%'],
				'range' => [
					'%' => [
						'min' => -100,
						'max' => 200,
					],
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .woo-cart-icon .count' => 'top: {{SIZE}}{{UNIT}}',
				],
			]
		);
		$this->add_control(
			'count_color',
			[
				'label'     => __('Number Color'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .woo-cart-icon .count' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'count_bg_color',
			[
				'label'     => __('Background Color'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default' => '#d9534f',
				'selectors' => [
					'{{WRAPPER}} .woo-cart-icon .count' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'count_size',
			[
				'label' => __('Size'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'default' => ['size' => '10'],
				'range' => [
					'px' => [
						'min' => 8,
						'max' => 30,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .woo-cart-icon .count' => 'font-size: {{SIZE}}{{UNIT}}',
				],
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
