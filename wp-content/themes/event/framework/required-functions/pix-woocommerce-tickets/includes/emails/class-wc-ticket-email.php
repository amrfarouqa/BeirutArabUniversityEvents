<?php

if ( ! defined( 'ABSPATH' ) )
	exit;

if ( ! class_exists( 'WC_Order_Ticket_Email' ) ) :
	
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
			$this->title       = __('Ticket Email Settings', 'pixel8es');
			
			// this is the description in WooCommerce email settings
			$this->description = __('Ticket will sent as email to customers, once order completed', 'pixel8es');
			
			// these are the default heading and subject lines that can be overridden using the settings
			$this->heading     = __( 'Your order is complete', 'pixel8es' );
			$this->subject     = __( 'Your {site_title} order from {order_date} is complete', 'pixel8es' );
	 	 
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

	    /**
	     * Admin Options
	     *
	     * Setup the gateway settings screen.
	     * Override this in your gateway.
	     *
	     * @since 1.0.0
	     */
	    public function admin_options() {

	    	// Handle any actions
	    	if ( ! empty( $this->template_html ) || ! empty( $this->template_plain ) ) {

	    		if ( ! empty( $_GET['move_template'] ) && ( $template = esc_attr( basename( $_GET['move_template'] ) ) ) ) {

	    			if ( ! empty( $this->$template ) ) {

	    				if (  wp_mkdir_p( dirname( get_stylesheet_directory() . '/pix-woocommerce-tickets/' . $this->$template ) ) && ! file_exists( get_stylesheet_directory() . '/pix-woocommerce-tickets/' . $this->$template ) ) {

	    					// Locate template file
	    					$core_file		= $this->template_base . $this->$template;
	    					$template_file	= apply_filters( 'woocommerce_locate_core_template', $core_file, $this->$template, $this->template_base );

	    					// Copy template file
	    					copy( $template_file, get_stylesheet_directory() . '/pix-woocommerce-tickets/' . $this->$template );
	    					echo '<div class="updated fade"><p>' . __( 'Template file copied to theme.', 'woocommerce' ) . '</p></div>';
	    				}
	    			}
	    		}

	    		if ( ! empty( $_GET['delete_template'] ) && ( $template = esc_attr( basename( $_GET['delete_template'] ) ) ) ) {

	    			if ( ! empty( $this->$template ) ) {

	    				if ( file_exists( get_stylesheet_directory() . '/pix-woocommerce-tickets/' . $this->$template ) ) {
	    					unlink( get_stylesheet_directory() . '/pix-woocommerce-tickets/' . $this->$template );
	    					echo '<div class="updated fade"><p>' . __( 'Template file deleted from theme.', 'woocommerce' ) . '</p></div>';
	    				}
	    			}
	    		}

	    	}

	    	?>
	    	<h3><?php echo ( ! empty( $this->title ) ) ? $this->title : __( 'Settings','woocommerce' ) ; ?></h3>

	    	<?php echo ( ! empty( $this->description ) ) ? wpautop( $this->description ) : ''; ?>

	    	<table class="form-table">
	    		<?php $this->generate_settings_html(); ?>
	    	</table>

	    	<?php if ( ! empty( $this->template_html ) || ! empty( $this->template_plain ) ) { ?>
	    		<div id="template">
	    		<?php
	    			$templates = array(
	    				'template_html'     => __( 'HTML template', 'woocommerce' ),
	    				'template_plain'    => __( 'Plain text template', 'woocommerce' )
	    			);

	    			foreach ( $templates as $template => $title ) :

	    				if ( empty( $this->$template ) ) {
	    					continue;
	    				}

	    				$local_file     = get_stylesheet_directory() . '/pix-woocommerce-tickets/' . $this->$template;
	    				$core_file      = $this->template_base . $this->$template;
	    				$template_file  = apply_filters( 'woocommerce_locate_core_template', $core_file, $this->$template, $this->template_base );
	    				?>
	    				<div class="template <?php echo $template; ?>">

	    					<h4><?php echo wp_kses_post( $title ); ?></h4>

	    					<?php if ( file_exists( $local_file ) ) { ?>

	    						<p>
	    							<a href="#" class="button toggle_editor"></a>

	    							<?php if ( is_writable( $local_file ) ) : ?>
	    								<a href="<?php echo remove_query_arg( array( 'move_template', 'saved' ), add_query_arg( 'delete_template', $template ) ); ?>" class="delete_template button"><?php _e( 'Delete template file', 'woocommerce' ); ?></a>
	    							<?php endif; ?>

	    							<?php printf( __( 'This template has been overridden by your theme and can be found in: <code>%s</code>.', 'woocommerce' ), 'yourtheme/pix-woocommerce-tickets/' . $this->$template ); ?>
	    						</p>

	    						<div class="editor" style="display:none">
	    							<textarea class="code" cols="25" rows="20" <?php if ( ! is_writable( $local_file ) ) : ?>readonly="readonly" disabled="disabled"<?php else : ?>data-name="<?php echo $template . '_code'; ?>"<?php endif; ?>><?php echo file_get_contents( $local_file ); ?></textarea>
	    						</div>

	    					<?php } elseif ( file_exists( $template_file ) ) { ?>

	    						<p>
	    							<a href="#" class="button toggle_editor"></a>

	    							<?php if ( ( is_dir( get_stylesheet_directory() . '/pix-woocommerce-tickets/emails/' ) && is_writable( get_stylesheet_directory() . '/pix-woocommerce-tickets/emails/' ) ) || is_writable( get_stylesheet_directory() ) ) { ?>
	    								<a href="<?php echo remove_query_arg( array( 'delete_template', 'saved' ), add_query_arg( 'move_template', $template ) ); ?>" class="button"><?php _e( 'Copy file to theme', 'woocommerce' ); ?></a>
	    							<?php } ?>

	    							<?php printf( __( 'To override and edit this email template copy <code>%s</code> to your theme folder: <code>%s</code>.', 'woocommerce' ), plugin_basename( $template_file ) , 'yourtheme/pix-woocommerce-tickets/' . $this->$template ); ?>
	    						</p>

	    						<div class="editor" style="display:none">
	    							<textarea class="code" readonly="readonly" disabled="disabled" cols="25" rows="20"><?php echo file_get_contents( $template_file ); ?></textarea>
	    						</div>

	    					<?php } else { ?>

	    						<p><?php _e( 'File was not found.', 'woocommerce' ); ?></p>

	    					<?php } ?>

	    				</div>
	    				<?php
	    			endforeach;
	    		?>
	    		</div>
	    		<?php
	    		wc_enqueue_js("
	    			jQuery('select.email_type').change(function() {

	    				var val = jQuery( this ).val();

	    				jQuery('.template_plain, .template_html').show();

	    				if ( val != 'multipart' && val != 'html' )
	    					jQuery('.template_html').hide();

	    				if ( val != 'multipart' && val != 'plain' )
	    					jQuery('.template_plain').hide();

	    			}).change();

	    			var view = '" . esc_js( __( 'View template', 'woocommerce' ) ) . "';
	    			var hide = '" . esc_js( __( 'Hide template', 'woocommerce' ) ) . "';

	    			jQuery('a.toggle_editor').text( view ).toggle( function() {
	    				jQuery( this ).text( hide ).closest('.template').find('.editor').slideToggle();
	    				return false;
	    			}, function() {
	    				jQuery( this ).text( view ).closest('.template').find('.editor').slideToggle();
	    				return false;
	    			} );

	    			jQuery('a.delete_template').click(function(){
	    				var answer = confirm('" . esc_js( __( 'Are you sure you want to delete this template file?', 'woocommerce' ) ) . "');

	    				if (answer)
	    					return true;

	    				return false;
	    			});

	    			jQuery('.editor textarea').change(function(){
	    				var name = jQuery(this).attr( 'data-name' );

	    				if ( name )
	    					jQuery(this).attr( 'name', name );
	    			});
	    		");
	    	}
	    }

	} 

endif;