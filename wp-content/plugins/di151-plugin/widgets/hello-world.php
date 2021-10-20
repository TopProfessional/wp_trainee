<?php
namespace ElementorHelloWorld\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Hello_World extends Widget_Base {

	// return  Widget name.
	public function get_name() {
		return 'di151-hello-world';
	}

	// return Widget title.
	public function get_title() {
		return __( 'Hello World', 'elementor-hello-world' );
	}

	//return  Widget icon.
	public function get_icon() {
		return 'eicon-product-title';
	}

	// Retrieve the list of categories the widget belongs to.
	public function get_categories() {
		return [ 'basic' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'elementor-hello-world' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'elementor-hello-world' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Hello world', 'elementor-hello-world' ),
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$this->add_inline_editing_attributes( 'title', 'none' );
		?>
		<h2 <?php echo $this->get_render_attribute_string( 'title' ); ?>>
			<?php echo $settings['title']; ?>
		</h2>
		
		<?php
	}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */
	protected function _content_template() {
		?>
		<#
		view.addInlineEditingAttributes( 'title', 'none' );
		
		#>
		<h2 {{{ view.getRenderAttributeString( 'title' ) }}}>{{{ settings.title }}}</h2>
		
		<?php
	}
}
