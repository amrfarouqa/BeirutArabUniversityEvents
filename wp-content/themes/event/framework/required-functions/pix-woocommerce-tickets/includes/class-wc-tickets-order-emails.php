<?php

if ( ! defined( 'ABSPATH' ) )
	exit;

class WC_Order_Tickets {
    

    public function __construct() {

    	add_filter( 'woocommerce_email_classes', array( $this, 'add_ticket_order_email' ) );
        
        //add_action( 'woocommerce_order_status_completed', array($this, 'ticket_order_completed') );
    }

    /**
     *  Add a custom email to the list of emails WooCommerce should load
     *
     * @since 0.1
     * @param array $email_classes available email classes
     * @return array filtered available email classes
     */
    function add_ticket_order_email( $email_classes ) {
     
        // include our custom email class
        require( 'emails/class-wc-ticket-email.php' );
     
        // add the email class to the list of email classes that WooCommerce loads
        $email_classes['WC_Order_ticket_Email'] = new WC_Order_Ticket_Email();
     
        return $email_classes;
     
    }

    public function ticket_order_completed( $order_id ){

        // order object (optional but handy)
        $order = new WC_Order( $order_id );

    }

}

new WC_Order_Tickets();
