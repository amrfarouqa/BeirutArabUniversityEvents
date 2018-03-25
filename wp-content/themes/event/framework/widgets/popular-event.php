<?php 

/*
 * Testimonial Widget
*/
class Pix_Popular_Event_Widget extends WP_Widget {

	function __construct() {
		$widget_options = array('classname' => 'popularevent', 'description' => __('Display Popular Events','innwit'));
		parent::__construct('pix_popular_event',__('Innwit:: Popular Events','innwit'),$widget_options);
	}

	function widget($args, $instance) {
		$cache = wp_cache_get('widget_popular_events', 'widget');

		if ( !is_array($cache) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();
		extract($args);

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Popular Events','innwit' );
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 10;
		if ( ! $number )
 			$number = 10;
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

		global $wpdb;

		$posts_cpt_ID = $wpdb->get_results("SELECT ID
                    FROM $wpdb->posts WHERE post_type = 'pix_event' AND post_status = 'publish'", ARRAY_N);

		$id = array();

        foreach ( $posts_cpt_ID as $value ){

            $popular = get_post_meta( $value[0], 'popular', true );

            if($popular == 'yes'){
            	$id[] = $value[0];
            }

        }


        if(!empty($id)){
            $args = array(
                'post_type'      => 'pix_event',
                'posts_per_page' => $number,
                'order_by' => 'post__in',
                'post__in' => $id, 
                'order' => 'DESC'        
                );
        }
		
		
		$r = new WP_Query( $args);
		if ($r->have_posts()) :
?>
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
		<div class="sidebar-post-widget">
			<?php 
				while ( $r->have_posts() ) : $r->the_post(); 

					$event_details = get_post_meta(get_the_ID(),'event_details');
					if( !empty($event_details) && !empty($event_details[0])){
						extract($event_details[0]);
					}
					
		       		echo '<div class="top-post clearfix">';
			       		if ( $show_date && !empty($event_date_from)){

			       			$day = date("d" , strtotime($event_date_from));
			       			$month = date("M", strtotime($event_date_from));
				       		echo '<div class="date">
				       			<p><span>'.$day.'</span>'.strtoupper($month).'</p>
				       		</div>';
			       		}
			       		echo '<div class="content">';
			       			echo '<h4  class="title"><a href="'.get_the_permalink().'">'.get_the_title().'</a></h4>';

			       			if($select_country != 'Select a Country:' || !empty($state)){

				       			$meta = '<p class="meta"><i class="icon fa fa-map-marker"></i>';
				       			if(!empty($state)){
				       				$meta .= $state;
				       			}
				       			if($select_country != 'Select a Country:' && !empty($state)){
				       				$meta .= ' / ';
				       			}
				       			if($select_country != 'Select a Country:'){
				       				$meta .= $country_code;
				       			}
				       			$meta .= '</p>';

				       			echo $meta;

				       		}

			       		echo '</div>';
			       	echo '</div>';
		        
				endwhile;
			?>
		</div>
		<?php echo $after_widget; ?>
<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		$instance['show_image'] = isset( $new_instance['show_image'] ) ? (bool) $new_instance['show_image'] : false;
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_popular_entries']) )
			delete_option('widget_popular_entries');

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete('widget_popular_events', 'widget');
	}

	function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : __( 'Popular Posts', 'innwit' );
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : true;
		$show_image = isset( $instance['show_image'] ) ? (bool) $instance['show_image'] : true;
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'innwit' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:', 'innwit' ); ?></label>
		<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo esc_attr($number); ?>" size="3" /></p>

		<p><input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?', 'innwit' ); ?></label></p>
        
        <p><input class="checkbox" type="checkbox" <?php checked( $show_image ); ?> id="<?php echo $this->get_field_id( 'show_image' ); ?>" name="<?php echo $this->get_field_name( 'show_image' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_image' ); ?>"><?php _e( 'Display post image?', 'innwit' ); ?></label></p>


<?php
	}
}

function pix_popular_event_widget_init(){
	register_widget('Pix_Popular_Event_Widget');	
}
add_action('widgets_init','pix_popular_event_widget_init');