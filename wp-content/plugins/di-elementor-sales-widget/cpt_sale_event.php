<?php
/**
 * This file add new cpt - sales events.
 *
 * @package WordPress
 */

/**
 * @param string $order_id contain id of current order.
 * Counter of purchases with included products ( from sale event).
 */
function purchases_counter( $order_id ) {
	$value = '1';
	$key = 'Sale_event_kol_purchases';

	$events = get_posts( array(
		'post_type'   => 'sales_events',
		'post_status' => 'publish',
		)
	);

	$order = wc_get_order( $order_id );

	// product_id & quantity_of_product from this phurechase.
	foreach ( $order->get_items() as $item_id => $item ) {

		// Get an instance of corresponding the WC_Product object.
		$product = $item->get_product();

		// contain id of products in order.
		$id_in_order = $product->get_id();

		// Not shure about this one.
		$item_quantity  = $item->get_quantity(); // Get the item quantity.

		foreach ( $events as $event ) {
			$event_id = $event->ID;

			// contain id of event product.
			$id_of_event_product = get_post_meta( $event_id, 'Included_products' );

			if ( intval( $id_of_event_product[0] ) === $id_in_order ) {

				if ( get_post_meta( $event_id, $key ) ) {
					$g = get_post_meta( $event_id, $key );

					// If the custom field already has a value, update it.
					update_post_meta( $event_id, $key, intval( $g[0] ) + 1 );
				} else {

					// If the custom field doesn't have a value, add it.
					add_post_meta( $event_id, $key, $value );
				}
			}
		}
	}
}
add_action( 'woocommerce_thankyou', 'purchases_counter', 10 );

/**
 * Updates prices with data from sale event
 */
function change_price_by_event() {
	$events = get_posts(
		array(
			'post_type'   => 'sales_events',
			'post_status' => 'publish',
		)
	);

	foreach ( $events as $event ) {
		$event_id = $event->ID;

		// contain id of event product.
		$id_of_event_product = get_post_meta( $event_id, 'Included_products' );

		// contain usual price of event product(from woo). need to update this.
		$price_of_event_product = get_post_meta( $id_of_event_product, '_price' );

		// special prices from event.

		// special price 1.
		$special_price_1 = get_post_meta( $event_id, 'Price' );

		// special price 2.
		$special_price_2 = get_post_meta( $event_id, 'A_Price' );

		// special price 3.
		$special_price_3 = get_post_meta( $event_id, 'B_Price' );

		// contain usual kol of event purchases.
		$kol_of_event_purchases = get_post_meta( $event_id, 'Sale_event_kol_purchases' );

		// special orders from event.

		// special orders 1.
		$special_orders_1 = get_post_meta( $event_id, 'Orders' );

		// special orders 2.
		$special_orders_2 = get_post_meta( $event_id, 'A_Orders' );

		// special orders 3.
		$special_orders_3 = get_post_meta( $event_id, 'B_Orders' );

		if ( intval( $kol_of_event_purchases[0] ) >= intval( $special_orders_2[0] ) && intval( $kol_of_event_purchases[0] ) < intval( $special_orders_3[0] ) ) {

			// change current price with price_2 from event.
			update_post_meta( $id_of_event_product[0], '_price', $special_price_2[0] );

		} elseif ( intval( $kol_of_event_purchases[0] ) >= intval( $special_orders_3[0] ) ) {

			// change current price with price_3 from event.
			update_post_meta( $id_of_event_product[0], '_price', $special_price_3[0] );
		} else {

			// change current price with price_1 from event to starting stats from event.
			update_post_meta( $id_of_event_product[0], '_price', $special_price_1[0] );

			// update usual kol of event purchases to starting stats from event.
			update_post_meta( $event_id, 'Sale_event_kol_purchases', $special_orders_1[0] );
		}
	}
}
add_action( 'woocommerce_thankyou', 'change_price_by_event', 20 );
add_action( 'save_post', 'change_price_by_event', 20 );

function activate_event( $post_id ) {
	echo "activate";
	//$cur_time = 

	$post_id = 197;
	$start_date = get_post_meta( $post_id, 'Start_Date', true );
	$end_date = get_post_meta( $post_id, 'End_Date', true );
	$date1 = date('Y-m-d H:i:s', time());
	var_dump( $start_date);
echo $start_date." ";
echo $end_date." ";
echo $date1." ";



$days = get_post_meta( $id, 'Start_Date' );
		$days_of = get_post_meta( $id, 'End_Date' );
		$d1 = strtotime( $start_date );
		$d2 = strtotime( $days_of[0] );

		$date = date_create();
		$h= date_timestamp_set( $date, $d1 );
		$h1 = date_format( $date, 'U' );
		$dtestart = new \DateTime();
		$dtestart->setTimestamp( $h1 );
		//var_dump($h1);



//$interval =$dtestart->diff( $date1 );

//echo " " . $interval->format( '%a' ) . " ";

		// $days = get_post_meta( $id, 'Start_Date' );
		// $days_of = get_post_meta( $id, 'End_Date' );
		// $d1 = strtotime( $days[0] );
		// $d2 = strtotime( $days_of[0] );

		// $date = date_create();
		// $h= date_timestamp_set( $date, $d1 );
		// $h1 = date_format( $date, 'U' );
		// $dtestart = new \DateTime();
		// $dtestart->setTimestamp( $h1 );
		// //var_dump($h1);

		// $o = date_timestamp_set( $date, $d2 );
		// $o1 = date_format( $date, 'U' );
		// $dteEnd   = new \DateTime();
		// $dteEnd->setTimestamp( $o1 );
		// //var_dump($o1);

		// //$k = date( 'Y-m-d', $d1 );
		// //$j = date( 'Y-m-d', $d2 );
		// //var_dump( $k );
		// //var_dump( $days_of[0]);
		// $interval =$dtestart->diff( $dteEnd );

		// $this->$remaining_days = $interval->format( '%a' ) + 1;
		// //$this->$remaining_days = $days[0];
		// return $this->$remaining_days;
}
add_action( 'save_post_sales_events', 'activate_event', 20 );
//woocommerce_thankyou
//save_post_sales_events

/**
 * Describe custom post type sales events.
 */
function create_sales_events_posttype() {
	$labels = array(
		'name' => _x( 'sales events', 'post type sales events' ),
		'singular_name' => _x( 'sales events', 'post type sales events' ),
		'menu_name' => __( 'sales events' ),
		'all_items' => __( 'all sales events' ),
		'view_item' => __( 'review sales events' ),
		'add_new_item' => __( 'add new sales events' ),
		'add_new' => __( 'add new sales events' ),
		'edit_item' => __( 'edit sales events' ),
		'update_item' => __( 'update sales events' ),
		'search_items' => __( 'search sales events' ),
		'not_found' => __( 'not found sales events' ),
		'not_found_in_trash' => __( 'not found sales events in trash' ),
	);

	$args = array(
		'labels' => $labels,
		'hierarchical' => false,
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_in_admin_bar' => true,
		'menu_position' => 5,
		'can_export' => true,
		'has_archive' => true,
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'capability_type' => 'post',
		'register_meta_box_cb' => 'add_sales_events_metaboxes',
	);

	register_post_type( 'sales_events', $args );

}
add_action( 'init', 'create_sales_events_posttype', 0 );


/**
 *  Add custom fields.
 */
function add_sales_events_metaboxes() {
	add_meta_box(
		'sale_event_name',
		'Sale event name',
		'sale_event_name',
		'sales_events',
		'side',
		'default'
	);

	add_meta_box(
		'sales_events_start_date',
		'Start Date',
		'sales_events_start_date',
		'sales_events',
		'side',
		'default'
	);

	add_meta_box(
		'sales_events_end_date',
		'End Date',
		'sales_events_end_date',
		'sales_events',
		'side',
		'default'
	);

	add_meta_box(
		'sales_events_included_products',
		'included products',
		'sales_events_included_products',
		'sales_events',
		'side',
		'default'
	);

	add_meta_box(
		'sales_events_currency',
		'Currency',
		'sales_events_currency',
		'sales_events',
		'side',
		'default'
	);

	add_meta_box(
		'sales_events_starting_stats',
		'Starting stats',
		'sales_events_starting_stats',
		'sales_events',
		'side',
		'default'
	);

	add_meta_box(
		'sales_events_order_minutes_counter',
		'Order minutes counter',
		'sales_events_order_minutes_counter',
		'sales_events',
		'side',
		'default'
	);

	add_meta_box(
		'sales_events_goal_a',
		'Goal A',
		'sales_events_goal_a',
		'sales_events',
		'side',
		'default'
	);

	add_meta_box(
		'sales_events_goal_b',
		'Goal B',
		'sales_events_goal_b',
		'sales_events',
		'side',
		'default'
	);

	add_meta_box(
		'sale_event_kol_purchases',
		'Kol of purchases',
		'sale_event_kol_purchases',
		'sales_events',
		'side',
		'default'
	);

}

/**
 *  This fuction - sale_event_name() calls from add_meta_box().
 *  Add new field (type = text) for cpt sales events.
 */
function sale_event_name() {
	global $post;

	// Nonce field to validate form request came from current site.
	wp_nonce_field( basename( __FILE__ ), 'sales_events_fields' );

	// Get the location data if it's already been entered.
	$sale_event_name = get_post_meta( $post->ID, 'Sale_event_name', true );

	// Output the field.
	echo '<input type="text" name="Sale_event_name" value="' . esc_textarea( $sale_event_name ) . '" class="widefat">';

}

/**
 *  This fuction - sales_events_start_date() calls from add_meta_box().
 *  Add new field (type = date) for cpt sales events.
 */
function sales_events_start_date() {
	global $post;

	// Nonce field to validate form request came from current site.
	wp_nonce_field( basename( __FILE__ ), 'sales_events_fields' );

	// Get the location data if it's already been entered.
	$start_date = get_post_meta( $post->ID, 'Start_Date', true );

	// Output the field.
	echo '<input type="date" name="Start_Date" value="' . esc_textarea( $start_date ) . '" class="widefat">';

}

/**
 *  This fuction - sales_events_end_date() calls from add_meta_box().
 *  Add new field (type = date) for cpt sales events.
 */
function sales_events_end_date() {
	global $post;

	// Nonce field to validate form request came from current site.
	wp_nonce_field( basename( __FILE__ ), 'sales_events_fields' );

	// Get the location data if it's already been entered.
	$end_date = get_post_meta( $post->ID, 'End_Date', true );

	// Output the field.
	echo '<input type="date" name="End_Date" value="' . esc_textarea( $end_date ) . '" class="widefat">';

}

/**
 *  This fuction - sales_events_included_products() calls from add_meta_box().
 *  Add new field (type = select) for cpt sales events.
 */
function sales_events_included_products() {
	global $post;
	//global $wpdb;

	// Get the location data if it's already been entered.
	$included_products = get_post_meta( $post->ID, 'Included_products', true );

	//$results = $wpdb->get_results( "SELECT ID, post_name FROM `wp_posts` WHERE post_type = 'product'" );
	$posts = get_posts( array(
		'post_type'   => 'product',
	) );

	if ( ! empty( $posts ) ) {
//var_dump( $posts );
		// Output the field.
		echo "<select name='Included_products' class='widefat'>";
		foreach ( $posts as $one_post ) {
			//setup_postdata( $post );
			$id   = $one_post->ID; //get_the_ID();
			$name = $one_post->post_name;
			?>
				<option 
					<?php
					if ( $id === $included_products ) {
							echo " selected='selected'";
					}
					?>
					value="<?php echo( esc_textarea( $id ) ); ?>"> <?php echo( esc_textarea( $name ) ); ?> </option>
			<?php
		}
		//wp_reset_postdata();
		echo '</select>';
	}

	// Nonce field to validate form request came from current site.
	wp_nonce_field( basename( __FILE__ ), 'sales_events_fields' );

}

/**
 *  This fuction - sales_events_currency() calls from add_meta_box().
 *  Add new field (type = text) for cpt sales events.
 */
function sales_events_currency() {
	global $post;

	// Nonce field to validate form request came from current site.
	wp_nonce_field( basename( __FILE__ ), 'sales_events_fields' );

	// Get the location data if it's already been entered.
	$currency = get_post_meta( $post->ID, 'Currency', true );

	// Output the field.
	echo '<input type="text" name="Currency" value="' . esc_textarea( $currency ) . '" class="widefat">';

}

/**
 *  This fuction - sales_events_starting_stats() calls from add_meta_box().
 *  Add new fields (type = text, type = text, type = checkbox) for cpt sales events.
 */
function sales_events_starting_stats() {
	global $post;

	// Nonce field to validate form request came from current site.
	wp_nonce_field( basename( __FILE__ ), 'sales_events_fields' );

	// Get the location data if it's already been entered.
	$price = get_post_meta( $post->ID, 'Price', true );

	// Output the field.
	echo '<input type="text" name="Price" placeholder="Price" value="' . esc_textarea( $price ) . '" class="widefat"><br/><br/>';

	// Get the location data if it's already been entered.
	$orders = get_post_meta( $post->ID, 'Orders', true );

	// Output the field.
	echo '<input type="text" name="Orders" placeholder="Orders" value="' . esc_textarea( $orders ) . '" class="widefat"><br/><br/>';

	// Get the location data if it's already been entered.
	$increase = get_post_meta( $post->ID, 'Increase', true );

	// Output the checkbox.
	echo '<p>increase to starting orders gradually</p><input type="checkbox" value="checked" ' . esc_textarea( $increase ) . ' name="Increase"  class="widefat">';

}

/**
 *  This fuction - sales_events_order_minutes_counter() calls from add_meta_box().
 *  Add new fields (type = number, type = number) for cpt sales events.
 */
function sales_events_order_minutes_counter() {
	global $post;

	// Nonce field to validate form request came from current site.
	wp_nonce_field( basename( __FILE__ ), 'sales_events_fields' );

	// Get the location data if it's already been entered.
	$order_counter = get_post_meta( $post->ID, 'Order_counter', true );

	// Output the field.
	echo '<input type="number" placeholder="count of orders" name="Order_counter" min="0" value="' . esc_textarea( $order_counter ) . '" class="widefat"><br/><br/>';

	// Get the location data if it's already been entered.
	$minute_counter = get_post_meta( $post->ID, 'Minute_counter', true );

	// Output the field.
	echo '<input type="number" placeholder="count of minutes" name="Minute_counter" min="0" value="' . esc_textarea( $minute_counter ) . '" class="widefat"><br/><br/>';

}

/**
 *  This fuction - sales_events_goal_a() calls from add_meta_box().
 *  Add new fields (type = text, type = text) for cpt sales events.
 */
function sales_events_goal_a() {
	global $post;

	// Nonce field to validate form request came from current site.
	wp_nonce_field( basename( __FILE__ ), 'sales_events_fields' );

	// Get the location data if it's already been entered.
	$goal_a_price = get_post_meta( $post->ID, 'A_Price', true );

	// Output the field.
	echo '<input type="text" name="A_Price" placeholder="Price" value="' . esc_textarea( $goal_a_price ) . '" class="widefat"><br/><br/>';

	// Get the location data if it's already been entered.
	$goal_a_orders = get_post_meta( $post->ID, 'A_Orders', true );

	// Output the field.
	echo '<input type="text" name="A_Orders" placeholder="Orders" value="' . esc_textarea( $goal_a_orders ) . '" class="widefat"><br/><br/>';

}

/**
 *  This fuction - sales_events_goal_b() calls from add_meta_box().
 *  Add new fields (type = text, type = text) for cpt sales events.
 */
function sales_events_goal_b() {
	global $post;

	// Nonce field to validate form request came from current site.
	wp_nonce_field( basename( __FILE__ ), 'sales_events_fields' );

	// Get the location data if it's already been entered.
	$goal_b_price = get_post_meta( $post->ID, 'B_Price', true );

	// Output the field.
	echo '<input type="text" name="B_Price" placeholder="Price" value="' . esc_textarea( $goal_b_price ) . '" class="widefat"><br/><br/>';

	// Get the location data if it's already been entered.
	$goal_b_orders = get_post_meta( $post->ID, 'B_Orders', true );

	// Output the field.
	echo '<input type="text" name="B_Orders" placeholder="Orders" value="' . esc_textarea( $goal_b_orders ) . '" class="widefat"><br/><br/>';

}

/**
 *  This fuction - sale_event_kol_purchases() calls from add_meta_box().
 *  Add new field (type = text) for cpt sales events.
 */
function sale_event_kol_purchases() {
	global $post;

	// Nonce field to validate form request came from current site.
	wp_nonce_field( basename( __FILE__ ), 'sales_events_fields' );

	// Get the location data if it's already been entered.
	$kol_purchases = get_post_meta( $post->ID, 'Sale_event_kol_purchases', true );

	// Output the field.
	echo '<input type="text" placeholder="0" name="Sale_event_kol_purchases" value="' . esc_textarea( $kol_purchases ) . '" class="widefat">';

}


/**
 *  This fuction - save_sales_events_meta() calls from add_meta_box().
 *  Save entered data for cpt sales events.
 *
 *  @param string $post_id contain id of current post.
 *  @param string $post contain data of current post.
 */
function save_sales_events_meta( $post_id, $post ) {

	// Return if the user doesn't have edit permissions.
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
	}

	// Verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times.
	if ( ! isset( $_POST['Sale_event_name'] ) || ! isset( $_POST['Start_Date'] ) || ! isset( $_POST['End_Date'] ) 
		|| ! isset( $_POST['Included_products'] ) || ! isset( $_POST['Currency'] ) || ! isset( $_POST['Price'] ) 
		|| ! isset( $_POST['Orders'] ) || ! isset( $_POST['A_Price'] ) || ! isset( $_POST['A_Orders'] ) 
		|| ! isset( $_POST['B_Price'] ) || ! isset( $_POST['B_Orders'] ) || ! wp_verify_nonce( $_POST['sales_events_fields'], basename(__FILE__) ) ) {
		return $post_id;
	}

	// This sanitizes the data from the field and saves it into an array $sale_event_meta.
	$sale_event_meta['Sale_event_name'] = esc_textarea( $_POST['Sale_event_name'] );
	$sale_event_meta['Start_Date'] = esc_textarea( $_POST['Start_Date'] );
	$sale_event_meta['End_Date'] = esc_textarea( $_POST['End_Date'] );
	$sale_event_meta['Included_products'] = esc_textarea( $_POST['Included_products'] );
	$sale_event_meta['Currency'] = esc_textarea( $_POST['Currency'] );
	$sale_event_meta['Price'] = esc_textarea( $_POST['Price'] );
	$sale_event_meta['Orders'] = esc_textarea( $_POST['Orders'] );
	$sale_event_meta['A_Price'] = esc_textarea( $_POST['A_Price'] );
	$sale_event_meta['A_Orders'] = esc_textarea( $_POST['A_Orders'] );
	$sale_event_meta['B_Price'] = esc_textarea( $_POST['B_Price'] );
	$sale_event_meta['B_Orders'] = esc_textarea( $_POST['B_Orders'] );

	// If checkbox( name = Increase ), field( name = Order_counter ) and field( name = Minute_counter ) were filled successfully - update data.
	if ( isset( $_POST['Increase'] ) && ( '' !== $_POST['Order_counter'] ) && ( '' !== $_POST['Minute_counter'] ) ) {
		$sale_event_meta['Increase'] = esc_textarea( $_POST['Increase'] );
		$sale_event_meta['Order_counter'] = esc_textarea( $_POST['Order_counter'] );
		$sale_event_meta['Minute_counter'] = esc_textarea( $_POST['Minute_counter'] );
	} else {
		update_post_meta( $post->ID, 'Increase', false );
	}

	// if ( isset( $_POST['Sale_event_kol_purchases'] ) ) {
	// 	$sale_event_meta['Sale_event_kol_purchases'] = esc_textarea( $_POST['Sale_event_kol_purchases'] );
	// }

	// Cycle through the $sale_event_meta array.
	foreach ( $sale_event_meta as $key => $value ) :

		// Don't store custom data twice.
		if ( 'revision' === $post->post_type ) {
			return;
		}

		if ( get_post_meta( $post_id, $key, false ) ) {

			// If the custom field already has a value, update it.
			update_post_meta( $post_id, $key, $value );
		} else {

			// If the custom field doesn't have a value, add it.
			add_post_meta( $post_id, $key, $value );
		}

		if ( ! $value ) {

			// Delete the meta key if there's no value.
			delete_post_meta( $post_id, $key );
		}

	endforeach;

}
add_action( 'save_post', 'save_sales_events_meta', 1, 2 );
