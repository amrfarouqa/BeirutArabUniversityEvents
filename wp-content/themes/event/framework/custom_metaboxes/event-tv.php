<?php

//Staffs Meta Box
function event_tv(){
	add_meta_box('pix_event_tv', 'Event Tv Videos', 'pix_event_tv_cb', 'pix_eventtv', 'normal','low');
}
add_action('add_meta_boxes', 'event_tv');

//Displaying Meta Box
function pix_event_tv_cb($post)
{
	global $post;
	$meta = array();
	$pix_internal_vid_url = isset($pix_internal_vid_url)? $pix_internal_vid_url : '';
	$pix_external_vid_url = isset($pix_external_vid_url)? $pix_external_vid_url : '';
	
	$meta = get_post_meta($post->ID,'event_tv_video',false);
	if( !empty($meta) )
	extract($meta[0]);
	wp_nonce_field(__FILE__, 'pix_event_tv_nonce');

		echo '<div class=" clearfix">';
			echo '<div class="pix-pull-left">';
				echo '<h5 class="pix-sub-title">'.__('Internal Video URL:','innwit'). '</h5>';
				echo '<p><label for="vid_url">'.__('Choose or Upload video from Media Uploader','innwit').'</label></p>';
			echo '</div>';

			echo '<div class=" pix-container pix_video_select">';
				echo '<input type="hidden" class="widefat pix-saved-val" name="pix_internal_vid_url" id="pix_internal_vid_url" value="'. esc_attr($pix_internal_vid_url).'">';
				echo '<a href="#" class="select-files" data-title="Insert Video"  data-file-type="video" data-multi-select="false" data-insert="true">Insert Video</a>';
			echo '</div>';
		echo '</div>';


		echo '<div class="videourl">';
			echo '<h5 class="pix-sub-title">'.__('External Video URL:','innwit'). '</h5>';
			echo '<p>';
				echo '<label for="pix_external_vid_url">'.__('Type the External URL Here','innwit').'</label>';
				echo '<input type="text" class="widefat" name="pix_external_vid_url" id="pix_external_vid_url" value="'.esc_url($pix_external_vid_url).'">';
			echo '</p>';
		echo '</div>';

}


//Saving Custom Meta Box Values
function saving_event_tv(){
	global $post;
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
	
	$pix_event_tv_nonce = isset($_POST['pix_event_tv_nonce']) ? $_POST['pix_event_tv_nonce'] : '';

	if($_POST && wp_verify_nonce($pix_event_tv_nonce, __FILE__)){
		
		$values = array(
			'pix_internal_vid_url' => htmlspecialchars($_POST['pix_internal_vid_url']),
			'pix_external_vid_url' => $_POST['pix_external_vid_url'],
			);
		//Security Check Nonce		
		update_post_meta($post->ID, 'event_tv_video', $values);
		
	}
	
	
}
add_action('save_post', 'saving_event_tv');