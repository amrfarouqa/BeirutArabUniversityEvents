<?php
/**
 * Customer completed order email (plain text)
 *
 * @author		WooThemes
 * @package		WooCommerce/Templates/Emails/Plain
 * @version		2.0.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly?>

<?php echo "****************************************************\n"; ?>

<?php
	$event_id = get_post_meta( $product_id, '_event_post_id', true );
	$security = get_post_meta( $ticket_id, '_security', true );

	$event_details = get_post_meta($event_id,'event_details');
	if( !empty($event_details) && !empty($event_details[0])){
		extract($event_details[0]);
	}

	echo __(get_the_title($event_id), 'woocommerce' )."\n";

	if(!empty($event_date_from) || !empty($event_time)){
			if(!empty($event_date_from)){
				echo date("F d, Y", strtotime($event_date_from));
			}
			if(!empty($event_date_from)  && !empty($event_time)){
				echo ' ';
			}
			if(!empty($event_time)){
				echo date("H:i", strtotime($event_time));
			}
	}
	echo "\n\n****************************************************\n";

	echo __('Ticket Details:', 'woocommerce' )."\n";
	
	echo __('Ticket ID: ', 'woocommerce' ).$ticket_id."\n";

	echo __('Ticket Title: ', 'woocommerce' ).$ticket_product->post->post_title."\n";

	echo __('Purchaser: ', 'woocommerce' ).$order->billing_first_name."\n";

	echo __('Security Code: ', 'woocommerce' ).$security."\n\n";

	echo __('Venue:', 'woocommerce' )."\n";

	if(!empty($venue_name)){
		echo __($venue_name, 'woocommerce' )."\n";
	}
	if(!empty($state)){
		echo __($state, 'woocommerce' )."\n";
	}
	if($select_country != 'Select a Country:'){
		echo __($select_country, 'woocommerce' )."\n";
	}

	if(!empty($organizer)){

		echo "\n".__('Organizer:', 'woocommerce' )."\n";

		echo __($organizer, 'woocommerce' )."\n";
	
		if(!empty($organizer_email)){
			echo __($organizer_email, 'woocommerce' )."\n";
		}
	}
?>

<?php echo "****************************************************\n\n"; ?>

<?php

do_action( 'woocommerce_email_after_order_table', $order, $sent_to_admin, $plain_text );

echo apply_filters( 'woocommerce_email_footer_text', get_option( 'woocommerce_email_footer_text' ) );