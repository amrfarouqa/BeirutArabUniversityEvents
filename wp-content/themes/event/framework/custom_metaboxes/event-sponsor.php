<?php

//Staffs Meta Box
function sponsor_logo(){
	add_meta_box('pix_sponsor_logo', 'Sponsor Logo', 'pix_sponsor_logo_cb', 'pix_event', 'normal','low');
}
add_action('add_meta_boxes', 'sponsor_logo');

//Displaying Meta Box
function pix_sponsor_logo_cb($post)
{
	global $post;
	$meta = array();
	$pix_images = isset($pix_images)? $pix_images : '';
	$sponsor_links = isset($sponsor_links)? $sponsor_links : '';
	
	$meta = get_post_meta($post->ID,'event_sponsor_logo',false);
	if( !empty($meta) )
	extract($meta[0]);
	wp_nonce_field(__FILE__, 'pix_sponsor_nonce');



		echo '<div class=" clearfix">';
			//Multiple Featured Image
			echo'<div class="pix-gallery clearfix">';

				echo '<div class="pix-pull-left">';
				echo '<h5 class="pix-sub-title">'.__('Gallery:','innwit'). '</h5>';
				echo '<p class="pix_image_select">';
				echo '<label for="pix_images">'.__('Select the images for gallery','innwit').'</label>
				</p></div>';
				echo '<div class="pix-container">';
				echo '<input type="hidden" class="widefat pix-saved-val" name="pix_images" value="'. esc_attr($pix_images).'">';
				echo '<a href="#" class="select-files" data-title="Insert Images"  data-file-type="image" data-multi-select="true" data-insert="true">Insert Images</a>';
				echo '</div>';
			echo '</div>';

		echo '</div>';

		echo '<div class="sep"></div>';

		//Sponsor Link
		echo '<p>
			<label for="sponsor_links">'.__('Sponsor Links:','innwit').'</label>
			<textarea type="text" class="widefat date_popup_from" name="sponsor_links" id="sponsor_links" >'. esc_textarea($sponsor_links).'</textarea>
		</p>';


}


//Saving Custom Meta Box Values
function saving_sponsor_logo(){
	global $post;
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
	
	$pix_sponsor_nonce = isset($_POST['pix_sponsor_nonce']) ? $_POST['pix_sponsor_nonce'] : '';

	if($_POST && wp_verify_nonce($pix_sponsor_nonce, __FILE__)){
		
		$values = array(
				'pix_images' => htmlspecialchars($_POST['pix_images']),
				'sponsor_links' => isset($_POST['sponsor_links']) ? $_POST['sponsor_links'] : '',
				);
		//Security Check Nonce		
		update_post_meta($post->ID, 'event_sponsor_logo', $values);
		
	}
	
	
}
add_action('save_post', 'saving_sponsor_logo');