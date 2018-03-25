<?php

if ( ! defined( 'ABSPATH' ) )
	exit;

if(!class_exists('WC_Order_Ticket_Email')){

	class WC_Order_Ticket_Email extends WC_Email {
	 	
	 	/**
	 	 * Set email defaults
	 	 *
	 	 * @since 0.1
	 	 */
	 	public function __construct() {
	 	 
	 	    // set ID, this simply needs to be a unique name
	 	    $this->id = 'wc_ordered_ticket_email';

			$this->product_id = '';

			$this->ticket_id = '';

			$this->ticket_product = new stdClass();
	 	 
			// this is the title in WooCommerce Email settings
			$this->title       = __('Ticket Email Settings', 'innwit');
			
			// this is the description in WooCommerce email settings
			$this->description = __('Ticket will sent as email to customers, once order completed', 'innwit');
			
			// these are the default heading and subject lines that can be overridden using the settings
			$this->heading     = __( 'Your order is complete', 'innwit' );
			$this->subject     = __( 'Your {site_title} order from {order_date} is complete', 'innwit' );
	 	 
	 	    // these define the locations of the templates that this email should use, we'll just use the new order template since this email is similar
	 	    $this->template_html  = 'emails/customer-completed-order.php';
	 	    $this->template_plain = 'emails/plain/customer-completed-order.php';
	 	 
			// Triggers for this email
			add_action( 'woocommerce_order_status_completed_notification', array( $this, 'trigger' ) );
	 	 
	 	    // Call parent constructor to load any other defaults not explicity defined here
	 	    parent::__construct();

	 	    $this->template_base = PIX_WC_TICKETS_TEMPLATE_PATH;
	 	 
	 	}

		/**
		 * trigger function.
		 *
		 * @access public
		 * @return void
		 */
		function trigger( $order_id ) {
			global $woocommerce;

			if ( $order_id ) {
				$this->object 		= wc_get_order( $order_id );
				$this->recipient	= $this->object->billing_email;

				$this->items = $this->object->get_items();
				//$this->find['product-title']    = '{product_title}';
				//$this->replace['product-title'] = $this->object->get_product()->get_title();

				$this->find['order-date']      = '{order_date}';
				$this->find['order-number']    = '{order_number}';

				$this->replace['order-date']   = date_i18n( wc_date_format(), strtotime( $this->object->order_date ) );
				$this->replace['order-number'] = $this->object->get_order_number();
			}

			//if ( ! $this->is_enabled() || ! $this->get_recipient() ) {

			if ( ! $this->get_recipient() ) {
				return;
			}

			foreach ( $this->items as $item ) {

				$this->product_id = $item['product_id'];

				$this->ticket_product = get_product( $this->product_id );

				if( is_object($this->ticket_product) && !empty($this->ticket_product) && $this->ticket_product->product_type == 'tickets' ){

					$qty = $item['qty'];

					if( array_key_exists('tickets', $item) ){
						$ticket_ids = unserialize($item['tickets']);
					}else{
						$ticket_ids = array();
					}

					if(!empty($ticket_ids)){

						for ( $i= 0; $i < $qty; $i++ ) {
							
							$this->ticket_id = $ticket_ids[$i]; //Set itcket id

							$this->send( $this->get_recipient(), $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments() ); //Send mail
							
							$this->ticket_id = '';

						}

					}				

				}

				$this->ticket_product = new stdClass();

			}

			

		}

		/**
		 * get_subject function.
		 *
		 * @access public
		 * @return string
		 */
		function get_subject() {
			return apply_filters( 'woocommerce_email_subject_customer_completed_order', $this->format_string( $this->subject ), $this->object );
		}

		/**
		 * get_heading function.
		 *
		 * @access public
		 * @return string
		 */
		function get_heading() {
			return apply_filters( 'woocommerce_email_heading_customer_completed_order', $this->format_string( $this->heading ), $this->object );
		}

		/**
		 * get_content_html function.
		 *
		 * @access public
		 * @return string
		 */
		function get_content_html() {
			ob_start();
			wc_get_template( $this->template_html, array(
				'order' 		=> $this->object,
				'product_id'	=> $this->product_id,
				'ticket_product'=> $this->ticket_product,
				'ticket_id'		=> $this->ticket_id,
				'email_heading' => $this->get_heading(),
				'sent_to_admin' => false,
				'plain_text'    => false
			), 'woocommerce-tickets/', $this->template_base );
			return ob_get_clean();
		}

		/**
		 * get_content_plain function.
		 *
		 * @access public
		 * @return string
		 */
		function get_content_plain() {
			ob_start();
			wc_get_template( $this->template_plain, array(
				'order' 		=> $this->object,
				'product_id'	=> $this->product_id,
				'ticket_product'=> $this->ticket_product,
				'ticket_id'		=> $this->ticket_id,
				'email_heading' => $this->get_heading(),
				'sent_to_admin' => false,
				'plain_text'    => true
			), 'woocommerce-tickets/', $this->template_base );
			return ob_get_clean();
		}

	    /**
	     * Initialise Settings Form Fields
	     *
	     * @access public
	     * @return void
	     */
	    function init_form_fields() {
	    	$this->form_fields = array(
				/*'enabled' => array(
					'title' 		=> __( 'Enable/Disable', 'woocommerce' ),
					'type' 			=> 'checkbox',
					'label' 		=> __( 'Enable this email notification', 'woocommerce' ),
					'default' 		=> 'yes'
				),*/
				'subject' => array(
					'title' 		=> __( 'Subject', 'woocommerce' ),
					'type' 			=> 'text',
					'description' 	=> sprintf( __( 'Defaults to <code>%s</code>', 'woocommerce' ), $this->subject ),
					'placeholder' 	=> '',
					'default' 		=> ''
				),
				'heading' => array(
					'title' 		=> __( 'Email Heading', 'woocommerce' ),
					'type' 			=> 'text',
					'description' 	=> sprintf( __( 'Defaults to <code>%s</code>', 'woocommerce' ), $this->heading ),
					'placeholder' 	=> '',
					'default' 		=> ''
				),
				'email_type' => array(
					'title' 		=> __( 'Email type', 'woocommerce' ),
					'type' 			=> 'select',
					'description' 	=> __( 'Choose which format of email to send.', 'woocommerce' ),
					'default' 		=> 'html',
					'class'			=> 'email_type',
					'options'		=> array(
						'plain'	 	=> __( 'Plain text', 'woocommerce' ),
						'html' 		=> __( 'HTML', 'woocommerce' )
					)
				)
			);
	    } 
	}
}
