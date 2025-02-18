<?php
/**
 * Plugin Name: Conditional Polylang
 * Plugin URI:  https://github.com/demartis/conditional-polylang
 * Description: Provides a function and shortcodes to conditionally display content based on the current active language in Polylang.
 * Version:     1.1.1
 * Author:      Riccardo De Martis
 * Author URI:  https://www.linkedin.com/in/rdemartis
 * Text Domain: conditional-polylang
 * Domain Path: /languages
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Check if Polylang is active.
if ( ! class_exists( 'Polylang' ) ) {
	return;
}

/**
 * Main plugin class for Conditional Polylang.
 *
 * @package Conditional_Polylang
 */
final class Conditional_Polylang {

	/**
	 * The single instance of the class.
	 *
	 * @var Conditional_Polylang
	 */
	private static $_instance = null;

	/**
	 * Main Conditional_Polylang Instance.
	 *
	 * @return Conditional_Polylang
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Conditional_Polylang constructor.
	 */
	private function __construct() {
		$this->includes();
		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
	}

	/**
	 * Include required files.
	 */
	private function includes() {
		require_once plugin_dir_path( __FILE__ ) . 'includes/functions.php';
		require_once plugin_dir_path( __FILE__ ) . 'includes/shortcode.php';
	}

	/**
	 * Load plugin textdomain for translations.
	 */
	public function load_textdomain() {
		load_plugin_textdomain( 'conditional-polylang', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}
}

// Initialize the plugin.
Conditional_Polylang::instance();
