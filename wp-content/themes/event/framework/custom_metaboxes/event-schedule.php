<?php

//Staffs Meta Box
function event_schedule(){
	add_meta_box('pix_event_schedule', 'Event Schedule', 'pix_event_schedule_cb', 'pix_schedule', 'normal','low');
}
add_action('add_meta_boxes', 'event_schedule');

//Displaying Meta Box
function pix_event_schedule_cb($post)
{
	global $post,$wpdb;
	$meta = array();

	$schedule_time_from = $schedule_time_to = $schedule_place = $schedule_speaker =''; 

	$meta = get_post_meta($post->ID,'event_schedule',false);
	if( !empty($meta) )
	extract($meta[0]);
	wp_nonce_field(__FILE__, 'pix_nonce');

	$speaker_cpt_ID = $wpdb->get_results("SELECT ID
		FROM $wpdb->posts WHERE post_type = 'pix_speaker' AND post_status = 'publish'", ARRAY_N);

	$event_cpt_ID = $wpdb->get_results("SELECT ID
		FROM $wpdb->posts WHERE post_type = 'pix_event' AND post_status = 'publish'", ARRAY_N);

	
?>

<div id="meta-wrapper">

	<div>		
			<p>
				<label for="schedule_time_from"><?php echo __('Schedule Time From:','innwit') ?></label>
			
				<input type="text" class="widefat timepicker" name="schedule_time_from" id="schedule_time_from" value="<?php echo esc_attr($schedule_time_from); ?>" placeholder="">
			</p>

			<div class="sep"></div>
		
	</div>

	<div>		
			<p>
				<label for="schedule_time_to"><?php echo __('Schedule Time To:','innwit') ?></label>
				<input type="text" class="widefat timepicker" name="schedule_time_to" id="schedule_time_to" value="<?php echo esc_attr($schedule_time_to); ?>">
			</p>

			<div class="sep"></div>
		
	</div>

	<div>		
			<p>
				<label for="schedule_place"><?php echo __('Schedule Place:','innwit') ?></label>
				<input type="text" class="widefat" name="schedule_place" id="schedule_place" value="<?php echo esc_attr($schedule_place); ?>">
			</p>

			<div class="sep"></div>
		
	</div>

	<?php if(!empty($speaker_cpt_ID)) { ?>

		<div>

			<p>
				<label for="schedule_speaker"><?php echo __('Select Speaker:','innwit') ?></label>

				<select name="schedule_speaker" id="schedule_speaker">
					<?php
						foreach ( $speaker_cpt_ID as $value ){

							$title = get_the_title( $value[0] );

							echo '<option value="'.esc_attr($value[0]).'"'.(($schedule_speaker == $value[0]) ? ' selected="selected"' : ''). '>'.$title.'</option>';

						}
					?>			
				</select>
			</p>

			<div class="sep"></div>

		</div>

	<?php } ?>


	<?php if(!empty($event_cpt_ID)) { ?>

		<div>
			<p style="margin-bottom:0px;">
				<label for="event"><?php echo __('Select Event:','innwit') ?></label>

				<select name="event" id="event">
					<?php
						foreach ( $event_cpt_ID as $value ){

							$title = get_the_title( $value[0] );
							
							echo '<option value="'.esc_attr($value[0]).'"'.(($event == $value[0]) ? ' selected="selected"' : ''). '>'.$title.'</option>';
							

						}
					?>			
				</select>
			</p>
		
		

		</div>

	<?php } ?>

</div>



<?php
}


//Saving Custom Meta Box Values
function saving_event_schedule(){
	global $post;
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
	
	$pix_nonce = isset($_POST['pix_nonce']) ? $_POST['pix_nonce'] : '';

	if($_POST && wp_verify_nonce($pix_nonce, __FILE__)){
		
		$values = array(
				'schedule_time_from' => isset($_POST['schedule_time_from']) ? $_POST['schedule_time_from'] : '',
				'schedule_time_to' => isset($_POST['schedule_time_to']) ? $_POST['schedule_time_to'] : '',
				'schedule_place' => isset($_POST['schedule_place']) ? $_POST['schedule_place'] : '',
				'schedule_speaker' => isset($_POST['schedule_speaker']) ? $_POST['schedule_speaker'] : '',
				'event' => isset($_POST['event']) ? $_POST['event'] : '',
				);
		//Security Check Nonce		
		update_post_meta($post->ID, 'event_schedule', $values);
			
	}
	
	
}
add_action('save_post', 'saving_event_schedule');