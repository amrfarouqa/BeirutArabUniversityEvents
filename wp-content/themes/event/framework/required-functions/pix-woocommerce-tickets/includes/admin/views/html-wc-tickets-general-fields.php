<div class="options_group show_if_tickets">

<?php 
	    // Stock
	    /*woocommerce_wp_text_input( array( 'id' => '_ticket_stock', 'label' => __( 'Ticket Qty', 'woocommerce' ), 'desc_tip' => true, 'description' => __( 'Total Number Ticket.', 'woocommerce' ), 'type' => 'number', 'custom_attributes' => array(
	    	'step' 	=> 'any'
	    )  ) );*/

	    // Create a number field, for example for UPC
		woocommerce_wp_text_input(
			array(
				'id'                => '_event_post_id',
				'label'             => __( 'Event Post id', 'woocommerce' ),
				'placeholder'       => '',
				'desc_tip'    => 'true',
				'description'       => __( 'Enter the event post id. This will be automatically added, if you create ticket from Event Post page', 'woocommerce' ),
				'type'              => 'number'
				));
?>

<script>jQuery('.pricing').addClass('show_if_tickets');</script>
</div>
