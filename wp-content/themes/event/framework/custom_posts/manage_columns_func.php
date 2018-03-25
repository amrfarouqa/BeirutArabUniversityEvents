<?php

function inline_save_post() {

	$post_id = ! empty( $_GET['post_id'] ) ? (int) $_GET['post_id'] : '';

	$popular = get_post_meta( $post_id, 'popular', true );

	if ( 'yes' === $popular ) {
		update_post_meta( $post_id, 'popular', 'no' );
	} else {
		update_post_meta( $post_id, 'popular', 'yes' );
	}

	wp_safe_redirect( remove_query_arg( array( 'trashed', 'untrashed', 'deleted', 'ids' ), wp_get_referer() ) );

	die();
	

}

add_action('wp_ajax_inline_save_post', 'inline_save_post');