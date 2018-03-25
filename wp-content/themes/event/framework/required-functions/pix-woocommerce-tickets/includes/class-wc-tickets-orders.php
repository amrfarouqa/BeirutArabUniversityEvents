<?php
if ( ! defined( 'ABSPATH' ) )
	exit;

/**
 * Handles order status transitions and keeps tickets in sync
 */
class WC_Tickets_Orders {

	public $ticket_id = 0;

	public $tickets = array();

	/**
	 * Constructor sets up actions
	 */
	public function __construct() {

		// When an order is processed, on-hold or completed, we can mark publish the pending tickets
		add_action( 'woocommerce_order_status_completed', array( $this, 'create_tickets' ), 10, 1 );
		add_action( 'woocommerce_payment_complete', array( $this,'create_tickets' ), 10, 1 );

		// When an order is cancelled, cancel the tickets
		//add_action( 'woocommerce_order_status_cancelled', array( $this, 'cancel_tickets' ), 10, 1 );

	}

	/**
	 * Called when an order is paid
	 * @param  int $order_id
	 */
	
	/*global $wpdb;
	$bookings = array_merge( $bookings, $wpdb->get_col( $wpdb->prepare( "SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key = '_booking_order_item_id' AND meta_value = %d", $order_item_id ) ) );
	}*/

	public function create_tickets( $order_id ) {

		$this->object = new WC_Order( $order_id );
		$this->items = $this->object->get_items();

		foreach ( $this->items as $order_item_id => $item ) {

			if ( 'line_item' == $item['type'] ) {

				$this->product_id = $item['product_id'];

				$ticket_product = get_product( $item['product_id'] );

				if( is_object($ticket_product) && !empty($ticket_product) && $ticket_product->product_type == 'tickets' ){

					$qty = $item['qty'];

					if( array_key_exists('tickets', $item) ){
						$ticket_ids = unserialize($item['tickets']);
						$this->tickets = $ticket_ids;
					}else{
						$ticket_ids = array();
					}

					//Create Tickets
					for ( $i= 0; $i < $qty; $i++ ) {
						
						//Let's generate a totally random string using md5 
						$md5_hash = md5(rand(0,999));

						//We don't need a 32 character long string so we trim it down to 8 
						$security_code = substr( $md5_hash, 15, 8 );

						$ticket_id = !empty( $ticket_ids ) ? $ticket_ids[$i] : '';

						if($ticket_id == ''){

							$arg = array(
								'ID'		  => $ticket_id,
								'post_type'   => 'pix_tickets',
								'post_title'  => sprintf( __( 'Ticket &ndash; %s', 'innwit' ), strftime( _x( '%b %d, %Y @ %I:%M %p', 'Order date parsed by strftime', 'innwit' ) )),
								'post_status' => 'publish',
								'ping_status' => 'closed',
								'post_parent' => $this->product_id
								);

							$this->ticket_id = wp_insert_post( $arg );

							if( $this->ticket_id != 0 ){

								//Update WooProduct id in current post
								update_post_meta( $this->ticket_id, '_woo_product_id', $this->product_id );
								update_post_meta( $this->ticket_id, '_security', $security_code );
								update_post_meta( $this->ticket_id, '_order_item_id', $order_item_id );
								update_post_meta( $this->ticket_id, '_order_id', $order_id );

								array_push( $this->tickets, $this->ticket_id );
							}

						}

					}

					//add or update create ordermeta only once					
					wc_update_order_item_meta( $order_item_id, '_tickets', $this->tickets );

					$this->tickets = array();
					$this->ticket_id = 0;

				}

			}

			$this->product_id = '';

		}	

	}

}

new WC_Tickets_Orders();
