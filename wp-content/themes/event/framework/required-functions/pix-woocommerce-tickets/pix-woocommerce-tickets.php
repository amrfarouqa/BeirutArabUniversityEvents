<?php

if ( pix_is_woocommerce() ) {

    /**
    * WooCommerce Tickets
    */
    class Pix_WC_Tickets
    {
    	
    	public function __construct()
    	{
    		define( 'PIX_WC_TICKETS_VERSION', '1.0' ); 
            define( 'PIX_WC_TICKETS_TEMPLATE_PATH', THEME_FUNCTIONS. '/pix-woocommerce-tickets/templates/' );
             
            include( 'includes/class-wc-tickets-product-type.php' );
            include( 'includes/class-wc-tickets-order-emails.php' );
            include( 'includes/class-wc-tickets-orders.php' );
            
    		add_action( 'woocommerce_loaded', array( $this, 'pix_tickets_includes' ) );
    		add_action( 'wp_enqueue_scripts', array( $this, 'pix_tickets_styles' ) );
    		add_action( 'plugins_loaded', array( $this, 'emails' ), 0 );
            add_action( 'woocommerce_tickets_add_to_cart', array( $this, 'add_to_cart' ), 30 );           
            add_action( 'template_redirect', array($this, 'pix_ticket_redirect') );
           

    		//Init core classes
    		//include( 'includes/class-wc-bookings-cart.php' );
    		//include( 'includes/class-wc-bookings-checkout.php' );

    		//admin includes
    		if ( is_admin() ) {
				include( 'includes/admin/class-pix-wc-tickets-admin.php' );
                include( 'includes/admin/class-pix-wc-tickets-list.php' );
                include( 'includes/wc-tickets-functions.php' );
               
			}

    	}

        public function add_to_cart() {
            //wc_get_template( 'templates/add-to-cart/tickets.php', $args = array(), $template_path = '', THEME_FUNCTIONS.'/'); 
            $ticket_form = '';
            wc_get_template( 'single-product/add-to-cart/tickets.php', array( 'ticket_form' => $ticket_form ), 'woocommerce-tickets', PIX_WC_TICKETS_TEMPLATE_PATH );
        }

    	public function pix_tickets_includes(){    		
    		   		
    	}

    	/**
    	 * Frontend Ticket Scripts and Styles.
    	 */
    	public function pix_tickets_styles(){

    	}

    	/**
    	 * Load emails actions.
    	 */
    	public function emails() {
    		//include( 'includes/class-wc-bookings-emails.php' );
    	}

        /**
         * Handle redirects before content is output - hooked into template_redirect so is_page works.
         *
         * @return void
         */
        public function pix_ticket_redirect() {
            global $wp_query, $wp;
            
            if($wp_query->post->post_type != 'product'){
                return;
            }
            
             $product = get_product( $wp_query->post );
             
            // When default permalinks are enabled, redirect shop page to post type archive url
            if ( ! empty( $product->id ) && get_option( 'permalink_structure' ) == "" ) {
                //wp_safe_redirect( get_post_type_archive_link('product') );
                //exit;
                if ( $product->product_type != 'tickets'){
                    return;
                }


                $event_post_id = get_post_meta(  $product->id, '_event_post_id', true );
                if ( 'publish' == get_post_status ( $event_post_id ) && false != get_post_status ( $event_post_id )) {
                    wp_redirect( get_permalink($event_post_id));
                    exit;
                }else{
                    return;
                }
            }

        }

    }

    $GLOBALS['pix_wc_tickets'] = new Pix_WC_Tickets();

}