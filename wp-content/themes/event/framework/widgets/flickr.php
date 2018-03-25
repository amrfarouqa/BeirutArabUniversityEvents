<?php
/*
Plugin Name: WPTuts Flickr
Plugin URI: http://wp.tutsplus.com
Description: Blah...
Version: 1.0
Author: George Gecewicz
Author URI: http://heyitsgeorge.com
*/

function wptuts_flickr_jquery() {
	wp_enqueue_script('jquery');
}
add_action('widgets_init','wptuts_flickr_jquery');

class WPTuts_Flickr extends WP_Widget {

	// constructor...
	function __construct() {
   		$widget_ops = array( 'classname' => 'wptuts-flickr', 'description' => __('Display your Flickr photo gallery','innwit') );
		$control_ops = array( 'width' => 85, 'height' => 85, 'id_base' => 'wptuts-flickr-widget' );
		parent::__construct('wptuts-flickr-widget', __('Pixel8es:: Flickr','innwit'), $widget_ops, $control_ops);
	}


	// displays/outputs the widgety goodness...
	function widget( $args, $instance ) {
 		extract($args);
?>
			<div class="widget clearfix">
			<?php
		$title = apply_filters('widget_title', $instance['title']);

		if(empty($title)){
			$title = 'Flickr Gallery';
		}

		$flickrid = $instance['flickrid'];
		$flickrcount = isset($instance['flickrcount']) ? $instance['flickrcount'] : '9';

		$length = 10;

		$randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);



		if ( $title )
			echo $before_title . $title . $after_title;

			// let's get into the javascript...

		?>
			<ul class="flickrwidget" id="<?php echo $randomString; ?>"></ul></div>

			<?php if(!empty($flickrid)) { ?>

				<script type="text/javascript">
					jQuery(document).ready(function($){
						$.getJSON("http://api.flickr.com/services/feeds/photos_public.gne?ids=<?php print $flickrid; ?>&lang=en-us&format=json&jsoncallback=?", function(data){
							window.a = (data);
					          $.each(data.items, function(index, item){

								  if(index < <?php echo $flickrcount;  ?>){
					                $("<img/>").attr("src", item.media.m).appendTo("<?php echo '#'.$randomString; ?>").wrap("<li><a href='" + item.link + "'></a></li>");
									 
								  }
								  else{
									   return;
									  }
					          });
					        });
					});
				</script>

			<?php } ?>

			<?php

  }

	// handles...updating the widget...
	function update($new_instance, $old_instance) {

		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title']);
		$instance['flickrid'] = strip_tags( $new_instance['flickrid']);
		$instance['flickrcount'] = $new_instance['flickrcount'];
		return $instance;

	}


	function form( $instance ) {
		?>

		<!-- widget title -->
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'innwit'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo isset($instance['title']) ? esc_attr($instance['title']) : '' ; ?>" />
		</p>

	 <p>
			<label for="<?php echo $this->get_field_id('flickrid'); ?>"><?php _e('Your Flickr User ID:', 'innwit'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('flickrid'); ?>" type="text" name="<?php echo $this->get_field_name('flickrid'); ?>" value="<?php echo isset($instance['flickrid']) ? esc_attr($instance['flickrid']) : '' ; ?>" />
	 		<small>Don't know your ID? Head on over to <a href="http://idgettr.com">idgettr</a> to find it.</small>
	 </p>

        <p><label for="<?php echo $this->get_field_id('flickrCount');?>">
        <?php _e('Flickr Image Count (Max 20):', 'innwit'); ?>
        <input class="widefat" id="<?php echo $this->get_field_id('flickrcount');?>" name="<?php echo $this->get_field_name('flickrcount');?>" value="<?php echo esc_attr( (isset($instance['flickrcount'])&&!empty($instance['flickrcount']) ? $instance['flickrcount'] : '9' )) ; ?>" type="number" style="width:50px;" min="1" max="20"></label></p>


		<?php

	}




}

add_action('widgets_init','load_wptuts_flickr');

function load_wptuts_flickr() {
	register_widget('WPTuts_Flickr');
}

?>