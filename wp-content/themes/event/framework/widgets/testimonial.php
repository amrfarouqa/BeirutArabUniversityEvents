<?php 

/*
 * Testimonial Widget
*/
class Pix_Testimonial_Widget extends WP_Widget {

	function __construct() {
		$widget_options = array('classname' => 'testimonial-widget', 'description' => __('Display Testimonial','innwit'));
		parent::__construct('pix_testimonial',__('Innwit:: Testimonial','innwit'),$widget_options);
	}

	function widget( $args, $instance ) {
		extract($args);
		
		$title = ($instance['title']) ? $instance['title'] : __('Testimonial','innwit');
		$testimonialCount = isset($instance['testimonialCount']) ? $instance['testimonialCount'] : '5';
		$order = isset($instance['order']) ? $instance['order'] : 'ASC';
		$orderby = isset($instance['orderby']) ? $instance['orderby'] : 'date';

		
		echo $before_widget;

		echo $before_title . $title . $after_title;

	echo do_shortcode( '[testimonial insert_type="posts" no_of_testimonial="'.$testimonialCount.'" order_by="'.$orderby.'" order="'.$order.'" autoplay="4000" slide_speed="500" slide_arrow="false" pagination="true" stop_on_hover="true" mouse_drag="true" touch_drag="true"]' );

		echo $after_widget;
	}


	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );
		$title = strip_tags($instance['title']);
		$testimonialCount = isset($instance['testimonialCount']) ? $instance['testimonialCount'] : '5';
		$order = isset($instance['order']) ? $instance['order'] : 'ASC';
		$orderby = isset($instance['order']) ? $instance['order'] : 'date';
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'innwit'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('testimonialCount');?>">
        <?php _e( 'Testimonial Count (Max 20):','innwit' ) ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('testimonialCount');?>" name="<?php echo $this->get_field_name('testimonialCount');?>" value="<?php echo esc_attr( (isset($instance['testimonialCount'])&&!empty($instance['testimonialCount']) ? $instance['testimonialCount'] : '5' )) ; ?>" type="number" style="width:50px;" min="1" max="20"></label></p>
        
        <p><label for="<?php echo $this->get_field_id('order');?>">
        <?php _e( 'Order:','innwit' ) ?></label>
            <select id="<?php echo $this->get_field_id('order');?>" name="<?php echo $this->get_field_name('order');?>">
            	<?php $order = isset($instance['order']) ? $instance['order'] : 'ASC';?>
                <option value="ASC" <?php selected( $order, "ASC" ); ?>>ASC</option>
                <option value="DESC" <?php selected( $order, "DESC" ); ?>>DESC</option>
            </select>
		</p>
        
        <p><label for="<?php echo $this->get_field_id('orderby');?>">
        <?php _e( 'Order By:','innwit' ) ?></label>
            <select id="<?php echo $this->get_field_id('orderby');?>" name="<?php echo $this->get_field_name('orderby');?>">
            	<?php $orderby = isset($instance['orderby']) ? $instance['orderby'] : 'asc';?>
                <option value="date" <?php selected( $orderby, "date" ); ?>>Date</option>
                <option value="title" <?php selected( $orderby, "title" ); ?>>Title</option>
                <option value="rand" <?php selected( $orderby, "rand" ); ?>>Random</option>
            </select>
		</p>


<?php
	}
}

function pix_testimonial_widget_init(){
	register_widget('Pix_Testimonial_Widget');	
}
add_action('widgets_init','pix_testimonial_widget_init');