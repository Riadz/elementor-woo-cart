<?php

/**
 * Plugin Name:       Elementor - Woocommerce Cart Widget
 * Description:       Adds Woocommerce Cart Widget to Elementor
 * Version:           1.0
 * Requires at least: 5.0.0
 * Tested up to:      5.5.3
 * Author:            Riad
 * Author URI:        https: //bit.ly/riad-dev
 *
 * @category Core
 */

if (!defined('ABSPATH')) exit;

final class Woocommerce_Cart
{
	const VERSION = '1.0.0';
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';
	const MINIMUM_PHP_VERSION = '7.0';

	private static $_instance = null;
	public static function instance()
	{
		if (is_null(self::$_instance))
			self::$_instance = new self();

		return self::$_instance;
	}

	public function __construct()
	{
		add_action('plugins_loaded', [$this, 'on_plugins_loaded']);
	}
	public function on_plugins_loaded()
	{
		if ($this->is_compatible())
			add_action('elementor/init', [$this, 'init']);
	}

	// Add Plugin actions
	public function init()
	{
		add_action('elementor/widgets/widgets_registered', [$this, 'init_widgets']);
		// add_action('elementor/controls/controls_registered', [$this, 'init_controls']);
	}

	// Register widget
	public function init_widgets()
	{
		require_once(__DIR__ . '/includes/widgets/woo-cart-widget.php');
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Woocommerce_Cart_Widget());
	}

	// Plugin compatible
	public function is_compatible()
	{
		// Check if Elementor installed and activated
		if (!did_action('elementor/loaded')) {
			add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);
			return false;
		}

		// Check for required Elementor version
		if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
			add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
			return false;
		}

		// Check for required PHP version
		if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
			add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
			return false;
		}

		return true;
	}

	// Admin notices
	public function admin_notice_missing_main_plugin()
	{
		if (isset($_GET['activate'])) unset($_GET['activate']);

		$message = sprintf(
			esc_html('"%1$s" requires "%2$s" to be installed and activated.'),
			'<strong>' . esc_html('Elementor Test Extension') . '</strong>',
			'<strong>' . esc_html('Elementor') . '</strong>'
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}
	public function admin_notice_minimum_elementor_version()
	{
		if (isset($_GET['activate'])) unset($_GET['activate']);

		$message = sprintf(
			esc_html('"%1$s" requires "%2$s" version %3$s or greater.'),
			'<strong>' . esc_html('Elementor Test Extension') . '</strong>',
			'<strong>' . esc_html('Elementor') . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}
	public function admin_notice_minimum_php_version()
	{
		if (isset($_GET['activate'])) unset($_GET['activate']);

		$message = sprintf(
			esc_html('"%1$s" requires "%2$s" version %3$s or greater.'),
			'<strong>' . esc_html('Elementor Test Extension') . '</strong>',
			'<strong>' . esc_html('PHP') . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}
}

Woocommerce_Cart::instance();
