<?php

if ( ! defined( 'ABSPATH' ) )
	exit;

/**
 * Tickets Admin
 */

/*
	1. Register new product type in woocommerce
	2. Hide unneccessary tabs and options.
	3. Add Ticket Options.
	   - Total Number of Tickets.
	   - Regular Price.
	   - Ticket Sales With Ticket Sale Dates (Add these only in Events).
	   - Sales Price with Sale Price Dates 
	4. Cart setting and changes.
	5. Email tickets

	6. Create Manage Tickets page.
	7. Create Checkin Page.

 */
class Pix_WC_Tickets_Admin
{
	
	public function __construct()
	{
		
		add_action( 'admin_enqueue_scripts', array( $this, 'styles_and_scripts' ) );
		add_filter( 'product_type_selector' , array( $this, 'product_type_selector' ) );
		add_filter( 'product_type_options', array( $this, 'product_type_options' ) );
		//add_action( 'woocommerce_product_write_panel_tabs', array( $this, 'add_tab' ), 5 );
		//add_action( 'woocommerce_product_write_panels', array( $this, 'tickets_panels' ) );
		add_filter( 'woocommerce_product_data_tabs', array( $this, 'woocommerce_product_data_tabs' ) );	

		add_action( 'woocommerce_product_options_general_product_data', array( $this, 'pix_add_ticket_settings' ) );
		add_action( 'woocommerce_process_product_meta', array( $this,'pix_save_ticket_options'), 20 );
		add_action( 'wp_ajax_pix_add_ticket',  array( $this,'pix_add_ticket' ) );
		add_action( 'wp_ajax_pix_remove_ticket',  array( $this,'pix_remove_ticket' ) );

	}

	public function pix_remove_ticket(){

		if ( !wp_verify_nonce( $_REQUEST['nonce'], "add_ticket_nonce")) {
			exit("No naughty business please");
		}

		$post_id = isset( $_REQUEST['post_id'] ) ? $_REQUEST['post_id'] : '';
		$woo_product_id = isset( $_REQUEST['woo_product_id'] ) ? $_REQUEST['woo_product_id'] : '';

		//Update WooProduct id in current post
		update_post_meta( $post_id, 'woo_product_id', '' );

		//Remove Ticket
		$post = wp_delete_post( $woo_product_id, true );

		if( is_object($post)){

			$msg = __('Ticket Removed Sucessfully', 'innwit');
			$woo_product_id = -1;

		}else{
			$msg = __('Something went Wrong, please refresh and try again!', 'innwit');
		}

		$tck = array(
			'woo_product_id' 	=> $woo_product_id,
			'msg'				=> $msg,
		);

		die(json_encode($tck));

	}

	public function pix_add_ticket( ){

		if ( !wp_verify_nonce( $_REQUEST['nonce'], "add_ticket_nonce")) {
			exit("No naughty business please");
		}

		$ticket_title = isset( $_REQUEST['ticket_title'] ) ? $_REQUEST['ticket_title'] : '';
		$post_id = isset( $_REQUEST['post_id'] ) ? $_REQUEST['post_id'] : '';
		$woo_product_id = isset( $_REQUEST['woo_product_id'] ) ? $_REQUEST['woo_product_id'] : '';

		$ticket_desc = isset( $_REQUEST['ticket_desc'] ) ? $_REQUEST['ticket_desc'] : '';
		$_sku = isset( $_REQUEST['_sku'] ) ? $_REQUEST['_sku'] : '';
		$_regular_price = isset( $_REQUEST['_regular_price'] ) ? $_REQUEST['_regular_price'] : '';
		$_stock = isset( $_REQUEST['_stock'] ) ? $_REQUEST['_stock'] : '';

		$new_post_id = '';
		$msg = __('Something went Wrong, please refresh and try again!', 'innwit');

		if( !empty( $ticket_title ) ){

			$arg = array(
			  'ID'             => (( $woo_product_id != -1 ) ? $woo_product_id : ''), // Are you updating an existing post?
			  'post_content'   => $ticket_desc, 
			  'post_name'      => str_replace(' ', '-', $ticket_title), // The name (slug) for your post
			  'post_title'     => $ticket_title, 
			  'post_status'    => 'publish', 
			  'post_type'      => 'product',
			);

			$new_post_id = wp_insert_post( $arg );

			if( $new_post_id != 0 ) {

				//Update WooProduct id in current post
				update_post_meta( $post_id, 'woo_product_id', $new_post_id );

				//Set Product type as ticket
				wp_set_object_terms( $new_post_id, 'tickets', 'product_type' );

				// Update post meta
				if ( isset ($_regular_price) ) {
					update_post_meta( $new_post_id, '_regular_price', ( wc_format_decimal( $_regular_price ) ) );
					update_post_meta( $new_post_id, '_price', $_regular_price );
				}

				//Post Id
				update_post_meta( $new_post_id, '_event_post_id', $post_id );

				// Unique SKU
				$sku     = get_post_meta( $new_post_id, '_sku', true );
				$new_sku = wc_clean( stripslashes( $_sku ) );

				if ( '' == $new_sku ) {
					update_post_meta( $new_post_id, '_sku', '' );
				} elseif ( $new_sku !== $sku ) {

					if ( ! empty( $new_sku ) ) {

						$unique_sku = wc_product_has_unique_sku( $new_post_id, $new_sku );

						if ( ! $unique_sku ) {
							WC_Admin_Meta_Boxes::add_error( __( 'Product SKU must be unique.', 'woocommerce' ) );
						} else {
							update_post_meta( $new_post_id, '_sku', $new_sku );
						}
					} else {
						update_post_meta( $new_post_id, '_sku', '' );
					}
					
				}

				//Stock
				add_post_meta( $new_post_id, 'total_sales', '0', true );

				// Stock Data
				/*$stock_status = 'instock';

				if ( $stock_status ) {
					wc_update_product_stock_status( $post_id, $stock_status );
				}*/
				
				wc_update_product_stock( $new_post_id, wc_stock_amount( $_POST['_stock'] ) );

				if($woo_product_id == -1){
					$msg = __('Ticket Created Successfully','innwit');
				}else{
					$msg = __('Ticket Details Updated Successfully','innwit');
				}

				$woo_product_id = $new_post_id;
				
			}

		}else{

			$msg = __('Please enter Ticket Title','innwit');

		}

		$tck = array(
					'woo_product_id' 	=> $woo_product_id,
					'msg'				=> $msg
 					);

		die(json_encode($tck));

	}

	public function woocommerce_product_data_tabs( $tabs ){
		array_push($tabs['shipping']['class'], 'hide_if_tickets');
		array_push($tabs['inventory']['class'], 'show_if_tickets');
		array_push($tabs['linked_product']['class'], 'hide_if_tickets');
		array_push($tabs['attribute']['class'], 'hide_if_tickets');
		return $tabs;
	}

	public function styles_and_scripts(){
		
	}

	/**
	 * Add the ticket product type
	 */
	public function product_type_selector( $types ){
		$types[ 'tickets' ] = __( 'Tickets product', 'innwit' );
		return $types;
	}

	/**
	 * Tweak product type options
	 * @param  array $options
	 * @return array
	 */
	public function product_type_options( $options ) {
		//$options['pricing']['wrapper_class'] .= ' show_if_tickets';
		//echo '<pre>'.print_r($options).'</pre>';
		return $options;
	}

	/**
	 * Show the booking tab
	 */
	public function add_tab() {
		echo '<li class="tickets_option tickets_tab advanced_options show_if_tickets"><a href="#tickets_data">'. __( 'Tickets', 'innwit' ) .'</a></li>';
	}

	/**
	 * Add the ticket Settings fields
	 */
	public function pix_add_ticket_settings() {
	    global $woocommerce, $post;
	    $post_id = $post->ID;
	    include( 'views/html-wc-tickets-general-fields.php' );
	}

	/**
	 * Show the booking panels views
	 */
	public function tickets_panels() {
		global $post;
		$post_id = $post->ID;

		//include( 'views/html-wc-tickets-general-fields.php' );
	}

	/**
	 * Saving Ticket options
	 */
	function pix_save_ticket_options( $post_id ){

		$product_type = empty( $_POST['product-type'] ) ? 'simple' : sanitize_title( stripslashes( $_POST['product-type'] ) );

		if ( 'tickets' !== $product_type ) {
			return;
		}

		//Event Post id
		if ( isset( $_POST['_event_post_id'] ) ) {
			update_post_meta( $post_id, '_event_post_id', !empty( $_POST['_event_post_id'] ) ? absint( $_POST['_event_post_id'] ) : '' );

			if(!empty( $_POST['_event_post_id'] ) && is_int( $_POST['_event_post_id'] ) ){
				update_post_meta( $_POST['_event_post_id'], 'woo_product_id', $post_id );
			}
		}

	}

}

new Pix_WC_Tickets_Admin();
