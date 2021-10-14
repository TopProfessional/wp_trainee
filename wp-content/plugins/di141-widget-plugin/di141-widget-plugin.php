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
		if ( have_posts() ) {
			$params = array(
				'post_type' => 'post', 
				'numberposts' => 5, 
				'orderby' => 'date', 
				'order' => 'DESC'
			);
			$recent_posts_array = get_posts($params);
			$received_posts='';
			foreach( $recent_posts_array as $recent_post_single ) 
			{
				// Contains url of post.
				$received_posts = $received_posts. '<a href="' . get_permalink( $recent_post_single ) . '"> <br>' . $recent_post_single->post_title . '</a>'; 
			}
			// Displays url of post.
			echo $received_posts;
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