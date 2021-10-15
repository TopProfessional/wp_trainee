<?php
/*
Plugin Name: Di141 Plugin
Description: This plugin dasplays 5 posts.
Version: 1.0
Author: David
License: GPL2
*/

class Di141_Widget extends WP_Widget {

    public function __construct() {
		$widget_options = array(
			'classname' => 'Di141_Widget',
			'description' => 'first widget',
		);
		parent::__construct( 'Di141_Widget', 'Di141 Widget', $widget_options );
	}

    // Displays custom widget.
    public function widget( $args, $instance ) {

		// Global variables. Required for the correct work of the code below.
		global $wpdb;
		global $post;

		$fives_posts = $wpdb->get_results( "SELECT * FROM $wpdb->posts WHERE post_status = 'publish' order by post_date desc limit 5");
		if( $fives_posts ) {
			foreach( $fives_posts as $post ) {

				// Provides access to the global functions( the_permalink(), the_title(), ... ) to the current post.
				setup_postdata($post);
				?>
					<h2>
						<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
							<?php the_title(); ?>
						</a>
					</h2>
				<?php
			}

			// Returns the global variable ( $post ) to its default state.
			wp_reset_postdata();
		}
		else {
			echo __('posts not found');
		}
    }
}

// Registration & activation of widget.
function di141_widget_register() {
    register_widget( 'Di141_Widget' );
}
add_action( 'widgets_init', 'di141_widget_register' );