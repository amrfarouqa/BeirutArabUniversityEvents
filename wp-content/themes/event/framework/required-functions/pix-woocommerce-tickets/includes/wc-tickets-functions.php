<?php

class Example_List_Table extends WP_List_Table {}


function pix_event_post_link( $actions, $post ) {

	if ( $post->post_type != 'pix_event' )
		return $actions;

	if ( ! current_user_can('view_woocommerce_reports') )
		return $actions;

	$woo_product_id = get_post_meta($post->ID, 'woo_product_id', true);

	if( !$woo_product_id )
		return $actions;

	$actions['tickets'] = '<a href="'. admin_url( 'edit.php?post_type=pix_tickets&page=tickets_list&amp;event_id=' . $post->ID ) .'">' . __( 'Tickets', 'innwit'  ) . '</a>';

	return $actions;
}

add_filter( 'page_row_actions', 'pix_event_post_link', 10, 2 );

add_action('admin_menu', 'pix_event_tickets_page', 10, 2);

function pix_event_tickets_page() {
   
   add_submenu_page( 'edit.php?post_type=pix_tickets', 'Tickets Lists' , 'Tickets lists', 'view_woocommerce_reports', 'tickets_list', 'pix_event_tickets_page_callback' );

}

function pix_event_tickets_page_callback() {
	global $wpdb;
	
	echo '<div class="wrap">';
		echo '<h2>'.__( 'Event and Ticket Details', 'innwit').'</h2>'; 

		$event_id = $_GET['event_id'];

		$event_post = get_post($event_id);
		
		?>
		<div class="postbox">			
			<div class="inside">
				<div class="panel-wrap">
					<div id="pix-tickets-list" class="panel">						
						<h2><?php echo $event_post->post_title; ?></h2>
						<div class="event-details">
							<h3><?php _e('Event Details','innwit'); ?></h3>
							<?php
								$meta = get_post_meta($event_id,'event_details',false);
								if( !empty($meta) )
									extract($meta[0]);

								if(!empty($event_date_from)){
									echo '<p>'.__('Event Start:','innwit').' '. date("d M, Y", strtotime($event_date_from)).'</p>';
								}

								if(!empty($event_date_to)){
									echo '<p>'.__('Event End:','innwit').' '. date("d M, Y", strtotime($event_date_to)).'</p>';
								}

								if(!empty($event_time)){
									echo '<p>'.__('Event Time:','innwit').' '. $event_time.'</p>';
								}

								if($select_country != 'Select a Country:'){
									echo '<p>'.__('Country:','innwit').' '. $select_country.'</p>';
								}

								if(!empty($state)){
									echo '<p>'.__('State:','innwit').' '. $state.'</p>';
								}

								if(!empty($venue_name)){
									echo '<p>'.__('Venue:','innwit').' '. $venue_name.'</p>';
								}

								if(!empty($organizer)){
									echo '<p>'.__('Organizer:','innwit').' '. $organizer.'</p>';
								}
							?>
						</div>

						<div class="ticket-details">
							<h3><?php _e('Ticket Details','innwit'); ?></h3>
							<?php 
								$ticket_product_id = get_post_meta($event_id, 'woo_product_id', true);
								$ticket = get_product($ticket_product_id);

								$total_ticket = $ticket->get_total_stock();
								$available_tickets = $ticket->get_stock_quantity();

								$tickets_sold = get_post_meta( $ticket->id, 'total_sales', true );

								echo '<p>'.__('Tickets Title:','innwit').' '. $event_post->post_title.'</p>';
								echo '<p>'.__('Total Tickets:','innwit').' '. $total_ticket.'</p>';
								echo '<p>'.__('Tickets Available:','innwit').' '. $available_tickets.'</p>';
								echo '<p>'.__('Tickets Sold:','innwit').' '. $tickets_sold.'</p>';
								echo '<p>'.__('Checked In:','innwit').' '. $event_post->post_title.'</p>';
							?>
						</div>

					</div>
				</div>
			</div>
		</div>
		<?php
		//var_dump($event_post);
		//var_dump($ticket);
		
		$row = $wpdb->get_results( "SELECT ID FROM $wpdb->posts WHERE post_type = 'pix_tickets' AND post_parent = '$ticket_product_id'", ARRAY_A );
		//var_dump($row);

		//Create an instance of our package class...
		$ticketsList = new Pix_WC_Tickets_List($ticket_product_id);
		//Fetch, prepare, sort, and filter our data...
		$ticketsList->prepare_items();
		
		?>
		<!-- Forms are NOT created automatically, so you need to wrap the table in one to use features like bulk actions -->
		<form id="ticket-filter" method="get">
			<!-- For plugins, we also need to ensure that the form posts back to our current page -->
			<input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
			<!-- Now we can render the completed list table -->
			<?php $ticketsList->display() ?>
		</form>
			
		<?php

	echo '</div>';

}
