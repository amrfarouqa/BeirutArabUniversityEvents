<?php

//Speakers Meta Box
function social_icons(){
	add_meta_box('pix_speaker_social', 'Social Links', 'pix_speaker_social_cb', 'pix_speaker', 'side','low');
}
add_action('add_meta_boxes', 'social_icons');

//Displaying Meta Box
function pix_speaker_social_cb($post)
{
	global $post;
	$meta = array();
	$facebook = $twitter = $gplus = $linkedin = $dribbble = $flickr = $vimeo = $speaker_email = '';
	$meta = get_post_meta($post->ID,'speaker_social_links',false);
	if( !empty($meta) )
	extract($meta[0]);
	wp_nonce_field(__FILE__, 'pix_nonce');
?>

<p>
	<label for="pix_speaker_facebook"><?php echo __('Facebook Link:','innwit') ?></label>
    <input type="text" class="widefat" name="pix_speaker_facebook" id="pix_speaker_facebook" value="<?php echo esc_url($facebook); ?>">
</p>

<p>
	<label for="pix_speaker_twitter"><?php echo __('Twitter Link:','innwit') ?></label>
    <input type="text" class="widefat" name="pix_speaker_twitter" id="pix_speaker_twitter" value="<?php echo esc_url($twitter); ?>">
</p>

<p>
	<label for="pix_speaker_gplus"><?php echo __('G Plus Link:','innwit') ?></label>
    <input type="text" class="widefat" name="pix_speaker_gplus" id="pix_speaker_gplus" value="<?php echo esc_url($gplus); ?>">
</p>

<p>
	<label for="pix_speaker_linkedin"><?php echo __('LinkedIn Link:','innwit') ?></label>
    <input type="text" class="widefat" name="pix_speaker_linkedin" id="pix_speaker_linkedin" value="<?php echo esc_url($linkedin); ?>">
</p>

<p>
	<label for="pix_speaker_dribbble"><?php echo __('Dribbble Link:','innwit') ?></label>
    <input type="text" class="widefat" name="pix_speaker_dribbble" id="pix_speaker_dribbble" value="<?php echo esc_url($dribbble); ?>">
</p>

<p>
	<label for="pix_speaker_flickr"><?php echo __('Flickr Link:','innwit') ?></label>
    <input type="text" class="widefat" name="pix_speaker_flickr" id="pix_speaker_flickr" value="<?php echo esc_url($flickr); ?>">
</p>

<p>
	<label for="pix_speaker_email"><?php echo __('Email:','innwit') ?></label>
	<input type="text" class="widefat" name="pix_speaker_email" id="pix_speaker_email" value="<?php echo esc_url($speaker_email); ?>">
</p>

<?php
}


//Saving Custom Meta Box Values
function saving_social(){
	global $post;
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
	
	$pix_nonce = isset($_POST['pix_nonce']) ? $_POST['pix_nonce'] : '';

	if($_POST && wp_verify_nonce($pix_nonce, __FILE__)){
		
		$values = array(
			'facebook' => $_POST['pix_speaker_facebook'], 
			'twitter' => $_POST['pix_speaker_twitter'], 
			'gplus' => $_POST['pix_speaker_gplus'], 
			'linkedin' => $_POST['pix_speaker_linkedin'], 
			'dribbble' => $_POST['pix_speaker_dribbble'],
			'flickr' => $_POST['pix_speaker_flickr'],
			'speaker_email' => $_POST['pix_speaker_email']
			);
		//Security Check Nonce		
		update_post_meta($post->ID, 'speaker_social_links', $values);
		
	}
	
	
}
add_action('save_post', 'saving_social');