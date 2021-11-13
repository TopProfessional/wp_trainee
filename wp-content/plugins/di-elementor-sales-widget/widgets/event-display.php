<?php
namespace DIElementorSalesWidget\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

//$days_value = 14;
//$days_purchase = 694;

class Event_Display extends Widget_Base {

	public $remaining_days;
	public $purchases;

	public $starting_price;
	public $starting_orders;

	public $goal_a_price;
	public $goal_a_orders;

	public $goal_b_price;
	public $goal_b_orders;

	public $currency;
	//public $kol_purchases;

	public function change_day_value( $id ) {
		$days = get_post_meta( $id, 'Start_Date' );
		$days_of = get_post_meta( $id, 'End_Date' );
		$d1 = strtotime( $days[0] );
		$d2 = strtotime( $days_of[0] );

		$date = date_create();
		$h= date_timestamp_set( $date, $d1 );
		$h1 = date_format( $date, 'U' );
		$dtestart = new \DateTime();
		$dtestart->setTimestamp( $h1 );
		//var_dump($h1);

		$o = date_timestamp_set( $date, $d2 );
		$o1 = date_format( $date, 'U' );
		$dteEnd   = new \DateTime();
		$dteEnd->setTimestamp( $o1 );
		//var_dump($o1);

		//$k = date( 'Y-m-d', $d1 );
		//$j = date( 'Y-m-d', $d2 );
		//var_dump( $k );
		//var_dump( $days_of[0]);
		$interval =$dtestart->diff( $dteEnd );

		$this->$remaining_days = $interval->format( '%a' ) + 1;
		//$this->$remaining_days = $days[0];
		return $this->$remaining_days;
	}

	// public function change_day_value( $id ) {
	// 	$days = get_post_meta( $id, 'Start_Date' );
	// 	$days_of = get_post_meta( $id, 'End_Date' );
	// 	$d1 =date_create_from_format('d/m/Y:H:i:s', $days[0]);
	// 	$d2 =
	// 	$interval = $days[0]->diff( $days_of[0] );

	// 	$this->$remaining_days = $interval;
	// 	return $this->$remaining_days;
	// }
	
	// public function purchases_counter() {
	// 	$this->$purchases = "ododododododododododdodo";
	// 	return $purchases;
	// 	//$this->$purchases++;
	// 	//echo "ododododododododododdodo";
	// }

	public function display_purchases( $id ) {
		$current_purchase = get_post_meta( $id, 'Sale_event_kol_purchases' );
		$this->$purchases = $current_purchase[0];
		return $this->$purchases;
	}

	public function display_current_event_start_price( $id ) {
		$price = get_post_meta( $id, 'Price' );
		$this->$starting_price = $price[0];
		return $this->$starting_price;
	}

	public function display_current_a_price( $id ) {
		$price_a = get_post_meta( $id, 'A_Price' );
		$this->$goal_a_price = $price_a[0];
		return $this->$goal_a_price;
	}

	public function display_current_b_price( $id ) {
		$price_b = get_post_meta( $id, 'B_Price' );
		$this->$goal_b_price = $price_b[0];
		return $this->$goal_b_price;
	}

	public function display_current_currency( $id ) {
		$currency = get_post_meta( $id, 'Currency' );
		$this->$currency = $currency[0];
		return $this->$currency;
	}

	// public function display_current_event_data( $id ) {
	// 	$post_meta = get_post_meta( $id );
	// 	return var_dump( $post_meta );
	// 	//return ( $post_meta[0] );
	// 	//return $post_meta->Sale_event_name;
	// }

	public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );
		//wp_register_style( 'di-elementor-sales-widget-style', plugin_dir_url( __FILE__ ) . 'di-elementor-sales-widget-style.css' );
		wp_enqueue_style( 'di-elementor-sales-widget-style', plugin_dir_url( __FILE__ ) . 'di-elementor-sales-widget-style.css' );
	}

	public function get_style_depends() {
		return [ 'di-elementor-sales-widget-style' ];
	}

	// return  Widget name.
	public function get_name() {
		return 'sale-event-display';
	}

	// return Widget title.
	public function get_title() {
		return __( 'Event Display', 'di-elementor-sales' );
	}


	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'general' ];
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
				'label' => __( 'Content', 'di-elementor-sales' ),
			]
		);

	// 	$options = [];
	// 	global $wpdb;
	// 	$results = $wpdb->get_results( "SELECT id, post_title FROM `wp_posts` WHERE post_type = 'sales_events' and post_status='publish'" );
	// 	foreach ( $results as $result ) {
	// 		$options[ $result->id ] = $result->post_title;
	// 		//"'1'  => __( 'Solid', 'di-elementor-sales' ),";
	// 	}
	// 		$this->add_control(
	// 			'select_event',
	// 			[
	// 				'label' => __( 'select sale event', 'di-elementor-sales' ),
	// 				'type' => Controls_Manager::SELECT,
	// 				'default' => 'solid',
	// 				'options' => $options,
	// 			]
	// 		);

	// 	$this->end_controls_section();
	// }
	
	global $post;
	$options = [];
		$posts = get_posts( array(
			'post_type'   => 'sales_events',
		) );

		foreach ( $posts as $post ) {
			setup_postdata($post);
			$options[ get_the_ID() ] = get_the_title();
			//"'1'  => __( 'Solid', 'di-elementor-sales' ),";
		}
		wp_reset_postdata();
			$this->add_control(
				'select_event',
				[
					'label' => __( 'select sale event', 'di-elementor-sales' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'solid',
					'options' => $options,
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

		$this->add_inline_editing_attributes( 'select_event', 'none' );

		//$this->display_current_event_data( $settings['select_event'] );
		
		// Доработать пост, чтобы purchases_counter() из cpt... мог получать id.
		$_POST['current_event_id'] = $settings['select_event'];

		?>
		
		<h2 <?php echo $this->get_render_attribute_string( 'select_event' ); ?>><?php echo $settings['select_event']; ?></h2>
	<div class="father">
		<div class="full__progress-bar">
			<div class="progress">
				<div class="progress-value"></div>
			</div>
			<div class="steps">
				<div class="step" id="0"></div>
				<div class="step" id="1"></div>
				<div class="step" id="2"></div>
			</div>
			<div class="values">
				<div class="value" id="0">
					<?php
						echo( $this->display_current_b_price( $settings['select_event'] ) );
						echo( $this->display_current_currency( $settings['select_event'] ) );
					?>
				</div>
				<div class="value" id="1">
					<?php
						echo( $this->display_current_a_price( $settings['select_event'] ) );
						echo( $this->display_current_currency( $settings['select_event'] ) );
					?>
				</div>
				<div class="value" id="2">
					<?php
						echo( $this->display_current_event_start_price( $settings['select_event'] ) );
						echo( $this->display_current_currency( $settings['select_event'] ) );
					?>
				</div>
			</div>
		</div>
		
		<div class="important__values">
			<div class="important__value">
				<div class="important__value-number">
					<?php echo( $this->change_day_value( $settings['select_event'] ) ); ?>
				</div>
				<div class="important__value-description">
					Remaining days
				</div>
			</div>

			<div class="important__value">
				<div class="important__value-number">
					<?php echo( $this->display_purchases( $settings['select_event'] ) ); ?>
				</div>
				<div class="important__value-description">
					Purchases
				</div>
			</div>
		</div>
		
		<?php
	}


	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.1.0
	 *
	 * @access protected
	 */
	protected function _content_template() {
		
		?>
		<#
		view.addInlineEditingAttributes( 'select_event', 'none' );
		#>
		<h2 {{{ view.getRenderAttributeString( 'select_event' ) }}}>{{{ settings.select_event }}}</h2>
	<div class="father">
		<div class="full__progress-bar">
			<div class="progress">
				<div class="progress-value"></div>
			</div>
			<div class="steps">
				<div class="step" id="0"></div>
				<div class="step" id="1"></div>
				<div class="step" id="2"></div>
			</div>
			<div class="values">
				<div class="value" id="0">50$</div>
				<div class="value" id="1">79.7$</div>
				<div class="value" id="2">100$</div>
			</div>
		</div>

		<div class="important__values">
			<div class="important__value">
				<div class="important__value-number">
					4
				</div>
				<div class="important__value-description">
					Remaining days
				</div>
			</div>

			<div class="important__value">
				<div class="important__value-number">
					<?php //echo( $this->change_purchases() ); ?>
				</div>
				<div class="important__value-description">
					Purchases
				</div>
			</div>
		</div>

	</div>
		<?php
	}
}
