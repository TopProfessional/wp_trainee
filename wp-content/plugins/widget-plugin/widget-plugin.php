<?php
/*
Plugin Name: My Widget Plugin
Description: This plugin adds a custom widget.
Version: 1.0
Author: David
License: GPL2
*/

class Hello_world_widget extends WP_Widget {

    public function __construct() {
		$widget_options = array(
			'classname' => 'Hello_world_widget',
			'description' => 'first widget',
		);
		parent::__construct( 'Hello_world_widget', 'Hello world Widget', $widget_options );
	}

    // Отображение
    public function widget( $args, $instance ) {
        $color = apply_filters( 'widget_title', $instance[ 'color' ] );
       
       ?>

       <p><strong style='color: <?php echo $color;?>'>Hello world!</strong></p>

        <?php 
    }

    // Редактирование
    public function form( $instance ) {
        $color = ! empty( $instance['color'] ) ? $instance['color'] : ''; 
		
		?>

        <p><label for="<?php echo $this->get_field_id( 'color' ); ?>">Set color</label></p>
		<select id="<?php echo $this->get_field_id( 'color' ); ?>" name="<?php echo $this->get_field_name( 'color' ); ?>" value="<?php echo $color; ?>">
			<option value="green">green</option>
			<option value="black">black</option>
			<option value="red">red</option>
			<option value="purple">purple</option>
		</select>

        <?php
    }

    // Обновление настроек виджета в админ-панели.
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance[ 'color' ] = strip_tags( $new_instance[ 'color' ] );
        return $instance;
    }

}

// Регистрация и активация виджета.
function hello_world_register_widget() {
    register_widget( 'Hello_world_widget' );
}
add_action( 'widgets_init', 'hello_world_register_widget' );
