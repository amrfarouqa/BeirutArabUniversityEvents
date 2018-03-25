<?php 

/*
 * Contact Form Widget
*/
class Pix_Map_Widget extends WP_Widget {

	function __construct() {
		$widget_options = array('classname' => 'map-widget', 'description' => __('Display Google Map','innwit'));
		parent::__construct('pix_map_widget',__('Innwit:: Google Map','innwit'),$widget_options);
	}

	function widget( $args, $instance ) {
		extract($args);
		
		$title = ($instance['title']) ? $instance['title'] : '';
		$height = isset($instance['height']) ? strip_tags($instance['height']) : '250';		
		$api_key = isset($instance['api_key']) ? strip_tags($instance['api_key']) : '';
		$lat = isset($instance['lat']) ? strip_tags($instance['lat']) : '-37.81731';
		$lng = isset($instance['lng']) ? strip_tags($instance['lng']) : '144.95432';
		$zoom = isset($instance['zoom']) ? strip_tags($instance['zoom']) : '13';
		$zoom_control = isset($instance['zoom_control']) ? strip_tags($instance['zoom_control']) : 'true';
		$pan_control = isset($instance['pan_control']) ? strip_tags($instance['pan_control']) : 'true';
		$map_type_control = isset($instance['map_type_control']) ? strip_tags($instance['map_type_control']) : 'true';
		$scale_control = isset($instance['scale_control']) ? strip_tags($instance['scale_control']) : 'true';
		$street_view_control = isset($instance['street_view_control']) ? strip_tags($instance['street_view_control']) : 'true';
		$overview_control = isset($instance['overview_control']) ? strip_tags($instance['overview_control']) : 'true';
		
		
			echo $before_widget;

			if(!empty($title)){
				echo $before_title . $title . $after_title;
			}

			if(!empty($lat)&&!empty($lng)){
				echo do_shortcode( '[googlemap width="100%" height="'.$height.'" api_key="'.$api_key.'" lat="'.$lat.'" lng="'.$lng.'" zoom="'.$zoom.'" zoomcontrol="'.$zoom_control.'" pancontrol="'.$pan_control.'" maptypecontrol="'.$map_type_control.'" scalecontrol="'.$scale_control.'" streetviewcontrol="'.$street_view_control.'" overviewmapcontrol="'.$overview_control.'"]' );
			}
			else{
				echo '<div>Please enter the Latitude and Longitude Value</div>';
			}
			

			echo $after_widget;
		
		
	}


	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );
		$title = isset($instance['title']) ? strip_tags($instance['title']) : '';
		$height = isset($instance['height']) ? strip_tags($instance['height']) : '250';
		$api_key = isset($instance['api_key']) ? strip_tags($instance['api_key']) : '';
		$lat = isset($instance['lat']) ? strip_tags($instance['lat']) : '-37.81731';
		$lng = isset($instance['lng']) ? strip_tags($instance['lng']) : '144.95432';
		$zoom = isset($instance['zoom']) ? strip_tags($instance['zoom']) : '13';
		$zoom_control = isset($instance['zoom_control']) ? strip_tags($instance['zoom_control']) : 'true';
		$pan_control = isset($instance['pan_control']) ? strip_tags($instance['pan_control']) : 'true';
		$map_type_control = isset($instance['map_type_control']) ? strip_tags($instance['map_type_control']) : 'true';
		$scale_control = isset($instance['scale_control']) ? strip_tags($instance['scale_control']) : 'true';
		$street_view_control = isset($instance['street_view_control']) ? strip_tags($instance['street_view_control']) : 'true';
		$overview_control = isset($instance['overview_control']) ? strip_tags($instance['overview_control']) : 'true';
?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'innwit'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Height:', 'innwit'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo esc_attr($height); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('api_key'); ?>"><?php _e('Google Map API Key:', 'innwit'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('api_key'); ?>" name="<?php echo $this->get_field_name('api_key'); ?>" type="text" value="<?php echo esc_attr($api_key); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('lat'); ?>"><?php _e('Latitude:', 'innwit'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('lat'); ?>" name="<?php echo $this->get_field_name('lat'); ?>" type="text" value="<?php echo esc_attr($lat); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('lng'); ?>"><?php _e('Longitude:', 'innwit'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('lng'); ?>" name="<?php echo $this->get_field_name('lng'); ?>" type="text" value="<?php echo esc_attr($lng); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('zoom'); ?>"><?php _e('Zoom:', 'innwit'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('zoom'); ?>" name="<?php echo $this->get_field_name('zoom'); ?>" type="text" value="<?php echo esc_attr($zoom); ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('zoom_control');?>"></label>
        <?php _e( 'Zoom Control:','innwit' ) ?>
            <select id="<?php echo $this->get_field_id('zoom_control');?>" name="<?php echo $this->get_field_name('zoom_control');?>">
                <option value="true" <?php selected( $zoom_control, "true" ); ?>><?php _e('Yes', 'innwit'); ?></option>
                <option value="false" <?php selected( $zoom_control, "false" ); ?>><?php _e('No', 'innwit'); ?></option>
            </select>
		</p>

		<p><label for="<?php echo $this->get_field_id('pan_control');?>"></label>
        <?php _e( 'Pan Control:','innwit' ) ?>
            <select id="<?php echo $this->get_field_id('pan_control');?>" name="<?php echo $this->get_field_name('pan_control');?>">
                <option value="true" <?php selected( $pan_control, "true" ); ?>><?php _e('Yes', 'innwit'); ?></option>
                <option value="false" <?php selected( $pan_control, "false" ); ?>><?php _e('No', 'innwit'); ?></option>
            </select>
		</p>

		<p><label for="<?php echo $this->get_field_id('map_type_control');?>"></label>
        <?php _e( 'Map Type Control:','innwit' ) ?>
            <select id="<?php echo $this->get_field_id('map_type_control');?>" name="<?php echo $this->get_field_name('map_type_control');?>">
                <option value="true" <?php selected( $map_type_control, "true" ); ?>><?php _e('Yes', 'innwit'); ?></option>
                <option value="false" <?php selected( $map_type_control, "false" ); ?>><?php _e('No', 'innwit'); ?></option>
            </select>
		</p>

		<p><label for="<?php echo $this->get_field_id('scale_control');?>"></label>
        <?php _e( 'Scale Control:','innwit' ) ?>
            <select id="<?php echo $this->get_field_id('scale_control');?>" name="<?php echo $this->get_field_name('scale_control');?>">
                <option value="true" <?php selected( $scale_control, "true" ); ?>><?php _e('Yes', 'innwit'); ?></option>
                <option value="false" <?php selected( $scale_control, "false" ); ?>><?php _e('No', 'innwit'); ?></option>
            </select>
		</p>

		<p><label for="<?php echo $this->get_field_id('street_view_control');?>"></label>
        <?php _e( 'Street View Control:','innwit' ) ?>
            <select id="<?php echo $this->get_field_id('street_view_control');?>" name="<?php echo $this->get_field_name('street_view_control');?>">
                <option value="true" <?php selected( $street_view_control, "true" ); ?>><?php _e('Yes', 'innwit'); ?></option>
                <option value="false" <?php selected( $street_view_control, "false" ); ?>><?php _e('No', 'innwit'); ?></option>
            </select>
		</p>

		<p><label for="<?php echo $this->get_field_id('overview_control');?>"></label>
        <?php _e( 'Overview Control:','innwit' ) ?>
            <select id="<?php echo $this->get_field_id('overview_control');?>" name="<?php echo $this->get_field_name('overview_control');?>">
                <option value="true" <?php selected( $overview_control, "true" ); ?>><?php _e('Yes', 'innwit'); ?></option>
                <option value="false" <?php selected( $overview_control, "false" ); ?>><?php _e('No', 'innwit'); ?></option>
            </select>
		</p>

<?php
	}
}

function pix_map_widget_init(){
	register_widget('Pix_Map_Widget');	
}
add_action('widgets_init','pix_map_widget_init');