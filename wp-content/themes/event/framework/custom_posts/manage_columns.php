<?php


require_once ('manage_columns_func.php');


//Manage Column in Custom Post Types

//adding column to testimonial posts type
add_filter( 'manage_edit-pix_testimonial_columns', 'my_edit_pix_testimonial_columns' ) ;

function my_edit_pix_testimonial_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'All Testimonial', 'innwit' ),
		'id' => __( 'Testimonial Id', 'innwit' ),
		'date' => __( 'Date', 'innwit' )
	);

	return $columns;
}


//adding values in th our custom columns
add_action( 'manage_pix_testimonial_posts_custom_column', 'my_manage_testimonial_columns', 10, 2 );
function my_manage_testimonial_columns( $column, $post_id ) {
	global $post;

	switch( $column ) {

		case 'id' :
		
				printf( $post_id );
				
			break;

		default :
			break;
	}
}


//adding column to testimonial posts type
add_filter( 'manage_edit-pix_event_columns', 'my_edit_pix_event_columns' ) ;

function my_edit_pix_event_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'All Event', 'innwit' ),
		'id' => __( 'Event Id', 'innwit' ),
		'event_date' => __( 'Event Date', 'innwit' ),
		'event_date' => __( 'Event Date', 'innwit' ),
		'event_country' => __( 'Country', 'innwit' ),
		'event_state' => __( 'State/Provinces', 'innwit' ),
		'thumb' => __( 'Event Image', 'innwit' ),
		'popular_event' => __( 'Popular Event', 'innwit' )
	);

	return $columns;
}


//adding values in th our custom columns
add_action( 'manage_pix_event_posts_custom_column', 'my_manage_event_columns', 10, 2 );

function my_manage_event_columns( $column, $post_id ) {
	global $post;

	$event_details = get_post_meta($post_id,'event_details');
	if( !empty($event_details) && !empty($event_details[0])){
		extract($event_details[0]);
	}

	switch( $column ) {

		case 'id' :
		
			printf( $post_id );
				
			break;

		case 'thumb' :
			$img = '';
			
			if (has_post_thumbnail()) {    
				$image_id = get_post_thumbnail_id ($post_id);  
				$image_thumb_url = wp_get_attachment_image_src( $image_id, 'full');
				if(!empty($image_thumb_url)){
					$img = aq_resize($image_thumb_url[0], 80, 80, true, true);
				}
				if($img){
					printf( '<img src="'.$img.'">' );
				}
			}		

			break;

		case 'event_date' :

			if(!empty($event_date_from)){
				$event_date_from = date("d M, Y", strtotime($event_date_from));
				printf( $event_date_from );
			}			
				
			break;

		case 'event_country' :

			if($select_country != 'Select a Country:'){
				printf( $select_country);
			}
				
			break;

		case 'event_state' :

			if(!empty($state)){
				printf( $state);
			}

			break;

		case 'popular_event' :



			$popular = get_post_meta( $post_id, 'popular', true );

			if(empty($popular)){
				$popular = 'no';
			}

			$url = wp_nonce_url( admin_url( 'admin-ajax.php?action=inline_save_post&post_id=' . $post_id ), 'inline-save-post' );

				echo '<a href="' . esc_url( $url ) . '" >';
				echo '<span class="">'.ucwords($popular).'</span>';
				echo '</a>';				
				
			break;

		default :
			break;
	}
}


//adding column to testimonial posts type
add_filter( 'manage_edit-pix_eventtv_columns', 'my_edit_pix_eventtv_columns' ) ;

function my_edit_pix_eventtv_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'All Event Videos', 'innwit' ),
		'id' => __( 'Video Id', 'innwit' ),
		'thumb' => __( 'Poster Image', 'innwit' ),
		'popular_video' => __( 'Popular Video', 'innwit' )
	);

	return $columns;
}


//adding values in th our custom columns
add_action( 'manage_pix_eventtv_posts_custom_column', 'my_manage_eventtv_columns', 10, 2 );

function my_manage_eventtv_columns( $column, $post_id ) {
	global $post;

	switch( $column ) {

		case 'id' :
		
				printf( $post_id );
				
			break;

		case 'thumb' :

			$img = '';

			if (has_post_thumbnail()) {    
				$image_id = get_post_thumbnail_id ($post_id);  
				$image_thumb_url = wp_get_attachment_image_src( $image_id, 'full');
				if(!empty($image_thumb_url)){
					$img = aq_resize($image_thumb_url[0], 80, 80, true, true);
				}
				if($img){
					printf( '<img src="'.$img.'">' );
				}
			}

			

			break;

		case 'popular_video' :

			$popular = get_post_meta( $post_id, 'popular', true );

			if(empty($popular)){
				$popular = 'no';
			}

			$url = wp_nonce_url( admin_url( 'admin-ajax.php?action=inline_save_post&post_id=' . $post_id ), 'inline-save-post' );

				echo '<a href="' . esc_url( $url ) . '" >';
				echo '<span class="">'.ucwords($popular).'</span>';
				echo '</a>';				
				
			break;

		default :
			break;
	}
}

//adding column to testimonial posts type
add_filter( 'manage_edit-post_columns', 'my_edit_post_columns' ) ;

function my_edit_post_columns( $columns ) {

	/*$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'All Event Videos', 'innwit' ),
		'id' => __( 'Video Id', 'innwit' ),
		'thumb' => __( 'Poster Image', 'innwit' ),
		'popular_video' => __( 'Popular Video', 'innwit' )
	);*/

	$columns['popular_post'] = __( 'Popular Post', 'innwit' );

	return $columns;
}


//adding values in th our custom columns
add_action( 'manage_post_posts_custom_column', 'my_manage_post_columns', 10, 2 );

function my_manage_post_columns( $column, $post_id ) {
	global $post;

	switch( $column ) {

		case 'popular_post' :

			$popular = get_post_meta( $post_id, 'popular', true );

			if(empty($popular)){
				$popular = 'no';
			}

			$url = wp_nonce_url( admin_url( 'admin-ajax.php?action=inline_save_post&post_id=' . $post_id ), 'inline-save-post' );

				echo '<a href="' . esc_url( $url ) . '" >';
				echo '<span class="">'.ucwords($popular).'</span>';
				echo '</a>';				
				
			break;

		default :
			break;
	}
}

//adding column to speaker posts type
add_filter( 'manage_edit-pix_speaker_columns', 'my_edit_pix_speaker_columns' ) ;

function my_edit_pix_speaker_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'All Speakers', 'innwit' ),
		'id' => __( 'Speaker Id', 'innwit' ),
		'thumb' => __( 'Image', 'innwit' )
	);

	return $columns;
}


//adding values in th our custom columns
add_action( 'manage_pix_speaker_posts_custom_column', 'my_manage_speaker_columns', 10, 2 );

function my_manage_speaker_columns( $column, $post_id ) {
	global $post;

	switch( $column ) {

		case 'id' :
		
				printf( $post_id );
				
			break;

		case 'thumb' :

			$img = '';

			if (has_post_thumbnail()) {    
				$image_id = get_post_thumbnail_id ($post_id);  
				$image_thumb_url = wp_get_attachment_image_src( $image_id, 'full');
				if(!empty($image_thumb_url)){
					$img = aq_resize($image_thumb_url[0], 80, 80, true, true);
				}
				if($img){
					printf( '<img src="'.$img.'">' );
				}
			}

			break;

		

		default :
			break;
	}
}


//adding column to schedule posts type
add_filter( 'manage_edit-pix_schedule_columns', 'my_edit_pix_schedule_columns' ) ;

function my_edit_pix_schedule_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'All Schedules', 'innwit' ),
		'id' => __( 'Schedule Id', 'innwit' ),
		'schedule_time' => __( 'Schedule Time', 'innwit' ),
		'schedule_place' => __( 'Schedule Place', 'innwit' ),
		'schedule_speaker' => __( 'Schedule Speaker', 'innwit' ),
		'thumb' => __( 'Image', 'innwit' )
	);

	return $columns;
}


//adding values in th our custom columns
add_action( 'manage_pix_schedule_posts_custom_column', 'my_manage_schedule_columns', 10, 2 );

function my_manage_schedule_columns( $column, $post_id ) {
	global $post;

	$event_schedule = get_post_meta($post_id,'event_schedule');
	if( !empty($event_schedule) && !empty($event_schedule[0])){
		extract($event_schedule[0]);
	}

	switch( $column ) {

		case 'id' :
		
				printf( $post_id );
				
			break;

		case 'thumb' :

			$img = '';

			if (has_post_thumbnail()) {    
				$image_id = get_post_thumbnail_id ($post_id);  
				$image_thumb_url = wp_get_attachment_image_src( $image_id, 'full');
				if(!empty($image_thumb_url)){
					$img = aq_resize($image_thumb_url[0], 80, 80, true, true);
				}
				if($img){
					printf( '<img src="'.$img.'">' );
				}
			}

			break;

		case 'schedule_time' :			
			
			if(!empty($schedule_time_from)){
				printf( $schedule_time_from);
			}
			break;

		case 'schedule_time' :			
			
			if(!empty($schedule_place)){
				printf( $schedule_place);
			}

			break;

		case 'schedule_speaker' :			
			
			if(!empty($schedule_speaker)){
				printf( get_the_title($schedule_speaker));
			}

			break;		

		default :
			break;
	}
}


//adding column to gallery posts type
add_filter( 'manage_edit-pix_gallery_columns', 'my_edit_pix_gallery_columns' ) ;

function my_edit_pix_gallery_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'All Gallery', 'innwit' ),
		'id' => __( 'Gallery Id', 'innwit' ),
		'thumb' => __( 'Image', 'innwit' )
	);

	return $columns;
}


//adding values in th our custom columns
add_action( 'manage_pix_gallery_posts_custom_column', 'my_manage_gallery_columns', 10, 2 );

function my_manage_gallery_columns( $column, $post_id ) {
	global $post;

	switch( $column ) {

		case 'id' :
		
				printf( $post_id );
				
			break;

		case 'thumb' :

			$img = '';
			
			if (has_post_thumbnail()) {    
				$image_id = get_post_thumbnail_id ($post_id);  
				$image_thumb_url = wp_get_attachment_image_src( $image_id, 'full');
				if(!empty($image_thumb_url)){
					$img = aq_resize($image_thumb_url[0], 80, 80, true, true);
				}
				if($img){
					printf( '<img src="'.$img.'">' );
				}
			}

			break;

		

		default :
			break;
	}
}