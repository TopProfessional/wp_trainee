<?php
/*
Plugin Name: Di140 Widget
Description: This plugin adds a custom widget.
Version: 1.0
Author: David
License: GPL2
*/

class Di140_Widget extends WP_Widget {

    public function __construct() {
		$widget_options = array(
			'classname' => 'Di140_Widget',
			'description' => 'first widget',
		);
		parent::__construct( 'Di140_Widget', 'Di140 Widget', $widget_options );
	}

    // Displays custom widget.
    public function widget( $args, $instance ) {
        $color = apply_filters( 'widget_title', $instance[ 'color' ] );
        ?>
            <p>
                <strong style='color: <?php echo $color; ?>'>
                    <?php echo __('Hello world!'); ?>
                </strong>
            </p>
        <?php
    }

    // Settings of custom widget.
    public function form( $instance ) {
        $color = ! empty( $instance['color'] ) ? $instance['color'] : '';
		?>
            <p>
                <label><?php echo __('Set color');?></label>
            </p>
            <select id="<?php echo $this->get_field_id( 'color' ); ?>" name="<?php echo $this->get_field_name( 'color' ); ?>" value='<?php echo $color; ?>'>
                <option value='green'><?php echo __('green'); ?></option>
                <option value='black'><?php echo __('black'); ?></option>
                <option value='red'><?php echo __('red'); ?></option>
                <option value='purple'><?php echo __('purple'); ?></option>
            </select>
        <?php
    }

    // Update widget data in the panel of admin.
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance[ 'color' ] = strip_tags( $new_instance[ 'color' ] );
        return $instance;
    }

}

// Registration & activation of widget.
function di140_widget_register() {
    register_widget( 'Di140_Widget' );
}
add_action( 'widgets_init', 'di140_widget_register' );
