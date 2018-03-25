<?php
/**
 * Customer completed order email
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<?php do_action( 'woocommerce_email_header', $email_heading ); ?>

<?php do_action( 'woocommerce_email_before_order_table', $order, $sent_to_admin, $plain_text ); ?>

<?php
	$event_id = get_post_meta( $product_id, '_event_post_id', true );
	$security = get_post_meta( $ticket_id, '_security', true );

	$event_details = get_post_meta($event_id,'event_details');
	if( !empty($event_details) && !empty($event_details[0])){
		extract($event_details[0]);
	}

	echo '<h3>'.__(get_the_title($event_id), 'woocommerce' ).'</h3>';

	if(!empty($event_date_from) || !empty($event_time)){
		echo '<p>';
			if(!empty($event_date_from)){
				echo '<span>'.date("F d, Y", strtotime($event_date_from)).'</span> ';
			}
			if(!empty($event_time)){
				echo '<span>'.date("h:i A", strtotime($event_time)).'</span>';
			}
		echo '</p>';	
	}
	
?>

<table cellspacing="0" cellpadding="6" style="width: 100%; border: 1px solid #eee;" border="1" bordercolor="#eee">
	<thead>
		<tr>
			<th scope="col" style="text-align:left; border: 1px solid #eee;"><?php _e( 'Ticket ID', 'woocommerce' ); ?></th>
			<th scope="col" style="text-align:left; border: 1px solid #eee;"><?php _e( 'Ticket Title', 'woocommerce' ); ?></th>
			<th scope="col" style="text-align:left; border: 1px solid #eee;"><?php _e( 'Purchaser', 'woocommerce' ); ?></th>
			<th scope="col" style="text-align:left; border: 1px solid #eee;"><?php _e( 'Security Code', 'woocommerce' ); ?></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td scope="col" style="text-align:left; border: 1px solid #eee;"><?php echo $ticket_id; ?></td>
			<td scope="col" style="text-align:left; border: 1px solid #eee;"><?php echo $ticket_product->post->post_title; ?></td>
			<td scope="col" style="text-align:left; border: 1px solid #eee;"><?php echo $order->billing_first_name .' '. $order->billing_last_name; ?></td>
			<td scope="col" style="text-align:left; border: 1px solid #eee;"><?php echo $security; ?></td>
		</tr>
	</tbody>
</table>

<?php

	echo '<h4>'.__('Venue:', 'woocommerce' ).'</h4>';

	if(!empty($venue_name)){
		echo '<p>'.__($venue_name, 'woocommerce' ).'</p>';
	}
	if(!empty($state)){
		echo '<p>'.__($state, 'woocommerce' ).'</p>';
	}
	if($select_country != 'Select a Country:'){
		echo '<p>'.__($select_country, 'woocommerce' ).'</p>';
	}

	if(!empty($organizer)){

		echo '<h4>'.__('Organizer:', 'woocommerce' ).'</h4>';

		echo '<p>'.__($organizer, 'woocommerce' ).'</p>';
	
		if(!empty($organizer_email)){
			echo '<p>'.__($organizer_email, 'woocommerce' ).'</p>';
		}
	}
?>

<?php do_action( 'woocommerce_email_after_order_table', $order, $sent_to_admin, $plain_text ); ?>

<?php do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text ); ?>


<?php do_action( 'woocommerce_email_footer' ); ?>
