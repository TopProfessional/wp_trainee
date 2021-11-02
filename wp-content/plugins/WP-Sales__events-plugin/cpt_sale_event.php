<?php
/**
 * This file add new cpt - sales events.
 *
 * @package WordPress
 */

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
	global $wpdb;

	// Get the location data if it's already been entered.
	$included_products = get_post_meta( $post->ID, 'Included_products', true );

	$results = $wpdb->get_results( "SELECT ID, post_name FROM `wp_posts` WHERE post_type = 'product'" );

	if ( ! empty( $results ) ) {

		// Output the field.
		echo "<select name='Included_products' class='widefat'>";
		foreach ( $results as $result ) {
			$id = $result->ID;
			$name = $result->post_name;
			?>
				<option 
					<?php
					if ( $id === $included_products ) {
							echo " selected='selected'";
					}
					?>
					value="<?php echo( esc_textarea( $id ) ); ?>"> <?php echo( esc_textarea( $name ) ); ?> </option>;
			<?php
		}
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
