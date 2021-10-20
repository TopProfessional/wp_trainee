<?php
namespace ElementorHelloWorld;

use ElementorHelloWorld\PageSettings\Page_Settings;

// Main Plugin class
class Plugin {

	// The single instance of the class.
	private static $_instance = null;

	/**
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @return Plugin An instance of the class.
	 */

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}



	// Include Widgets files.
	private function include_widgets_files() {
		require_once( __DIR__ . '/widgets/hello-world.php' );
	}

	// Register new Elementor widgets. 
	public function register_widgets() {

		// Its is now safe to include Widgets files
		$this->include_widgets_files();

		// Register Widgets
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Hello_World() );
	}

	/*
	 * Add page settings controls
	 *
	 * Register new settings for a document page settings.
	 */
	private function add_page_settings_controls() {
		require_once( __DIR__ . '/page-settings/manager.php' );
		new Page_Settings();
	}

	/*
	 * Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 */
	public function __construct() {

		// Register widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
		
		$this->add_page_settings_controls();
	}
}

// Instantiate Plugin Class
Plugin::instance();
