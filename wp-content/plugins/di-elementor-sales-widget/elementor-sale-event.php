<?php
/**
 * Plugin Name: DI Elementor Sales Widget
 * Description: Elementor sample plugin.
 * Author:      David
 * Text Domain: di-elementor-sales
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

final class Elementor_Sale_Event {

	// Plugin Version.
	const VERSION = '1.0';

	// Minimum Elementor Version required to run the plugin.
	const MINIMUM_ELEMENTOR_VERSION = '3.0.0';

	// Minimum PHP Version required to run the plugin.
	const MINIMUM_PHP_VERSION = '7.0';

	public function __construct() {

		// Load translation
		add_action( 'init', array( $this, 'i18n' ) );

		// Init Plugin
		add_action( 'plugins_loaded', array( $this, 'init' ) );

		//test
		self::include_widgets_files();
	}

	/**
	 * Include Widgets files.
	 * This fuction - nclude_widgets_files() calls from __construct().
	 */
	private function include_widgets_files() {
		require_once( __DIR__ . '/cpt_sale_event.php' );
	}

	/**
	 * Load Textdomain.
	 * Load plugin localization files.
	 * Fired by `init` action hook.
	 */
	public function i18n() {
		load_plugin_textdomain( 'di-elementor-sales' );
	}

	/**
	 * Initialize the plugin
	 *
	 * Validates that Elementor is already loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed include the plugin class.
	 *
	 * Fired by `plugins_loaded` action hook.
	 */
	public function init() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_missing_main_plugin' ) );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_elementor_version' ) );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );
			return;
		}

		// Once we get here, We have passed all validation checks so we can safely include our plugin
		require_once( 'plugin.php' );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 */
	public function admin_notice_missing_main_plugin() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators:	1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'di-elementor-sales' ),
			'<strong>' . esc_html__( 'DI Elementor Sales Widget', 'di-elementor-sales' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'di-elementor-sales' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 */
	public function admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'di-elementor-sales' ),
			'<strong>' . esc_html__( 'DI Elementor Sales Widget', 'di-elementor-sales' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'di-elementor-sales' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 */
	public function admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'di-elementor-sales' ),
			'<strong>' . esc_html__( 'DI Elementor Sales Widget', 'di-elementor-sales' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'di-elementor-sales' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}
}

// Instantiate Elementor_Hello_World.
new Elementor_Sale_Event();
