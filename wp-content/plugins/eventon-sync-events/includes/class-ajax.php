<?php
/**
 * EventON Sync Ajax Handlers
 *
 * Handles AJAX requests via wp_ajax hook (both admin and front-end events)
 *
 * @author 		AJDE
 * @category 	Core
 * @version     0.1
 */

class evosy_ajax{
	// construct
		public function __construct(){
			$ajax_events = array(
				'function_name'=>'function_name',
			);
			foreach ( $ajax_events as $ajax_event => $class ) {
				
				add_action( 'wp_ajax_'.  $ajax_event, array( $this, $class ) );
				add_action( 'wp_ajax_nopriv_'.  $ajax_event, array( $this, $class ) );
			}
		}
	

}
new evosy_ajax();