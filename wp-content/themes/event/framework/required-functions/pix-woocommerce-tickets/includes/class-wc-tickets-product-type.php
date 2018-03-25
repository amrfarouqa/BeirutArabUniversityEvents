<?php

if ( ! defined( 'ABSPATH' ) )
	exit;

if ( !class_exists( 'WC_Product' ) )
    exit;

class WC_Product_Tickets extends WC_Product{
    public function __construct( $product ) {
    
       $this->product_type = 'tickets';
       parent::__construct( $product );
       // add additional functions here
    }

    /**
     * We want to sell bookings one at a time
     * @return boolean
     */
    public function is_sold_individually() {
    	return false;
    }

    /**
     * Bookings can always be purchased regardless of price.
     * @return boolean
     */
    public function is_purchasable() {
    	return true;
    }

    /**
     * Checks if a product needs shipping.
     *
     * @return bool
     */
    public function needs_shipping() {
    	return false;
    }

    /**
     * Returns whether or not the product is stock managed.
     *
     * @return bool
     */
    public function managing_stock() {
    	return true;
    }

}

