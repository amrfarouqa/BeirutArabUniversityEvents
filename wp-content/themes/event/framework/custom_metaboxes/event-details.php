<?php

$countries = array( ""   => "Select a Country:",
					"US" => "United States",
					"AF" => "Afghanistan",
					"AL" => "Albania",
					"DZ" => "Algeria",
					"AS" => "American Samoa",
					"AD" => "Andorra",
					"AO" => "Angola",
					"AI" => "Anguilla",
					"AQ" => "Antarctica",
					"AG" => "Antigua And Barbuda",
					"AR" => "Argentina",
					"AM" => "Armenia",
					"AW" => "Aruba",
					"AU" => "Australia",
					"AT" => "Austria",
					"AZ" => "Azerbaijan",
					"BS" => "Bahamas",
					"BH" => "Bahrain",
					"BD" => "Bangladesh",
					"BB" => "Barbados",
					"BY" => "Belarus",
					"BE" => "Belgium",
					"BZ" => "Belize",
					"BJ" => "Benin",
					"BM" => "Bermuda",
					"BT" => "Bhutan",
					"BO" => "Bolivia",
					"BA" => "Bosnia And Herzegowina",
					"BW" => "Botswana",
					"BV" => "Bouvet Island",
					"BR" => "Brazil",
					"IO" => "British Indian Ocean Territory",
					"BN" => "Brunei Darussalam",
					"BG" => "Bulgaria",
					"BF" => "Burkina Faso",
					"BI" => "Burundi",
					"KH" => "Cambodia",
					"CM" => "Cameroon",
					"CA" => "Canada",
					"CV" => "Cape Verde",
					"KY" => "Cayman Islands",
					"CF" => "Central African Republic",
					"TD" => "Chad",
					"CL" => "Chile",
					"CN" => "China",
					"CX" => "Christmas Island",
					"CC" => "Cocos (Keeling) Islands",
					"CO" => "Colombia",
					"KM" => "Comoros",
					"CG" => "Congo",
					"CD" => "Congo, The Democratic Republic Of The",
					"CK" => "Cook Islands",
					"CR" => "Costa Rica",
					"CI" => "Cote D'Ivoire",
					"HR" => "Croatia (Local Name: Hrvatska)",
					"CU" => "Cuba",
					"CY" => "Cyprus",
					"CZ" => "Czech Republic",
					"DK" => "Denmark",
					"DJ" => "Djibouti",
					"DM" => "Dominica",
					"DO" => "Dominican Republic",
					"TP" => "East Timor",
					"EC" => "Ecuador",
					"EG" => "Egypt",
					"SV" => "El Salvador",
					"GQ" => "Equatorial Guinea",
					"ER" => "Eritrea",
					"EE" => "Estonia",
					"ET" => "Ethiopia",
					"FK" => "Falkland Islands (Malvinas)",
					"FO" => "Faroe Islands",
					"FJ" => "Fiji",
					"FI" => "Finland",
					"FR" => "France",
					"FX" => "France, Metropolitan",
					"GF" => "French Guiana",
					"PF" => "French Polynesia",
					"TF" => "French Southern Territories",
					"GA" => "Gabon",
					"GM" => "Gambia",
					"GE" => "Georgia",
					"DE" => "Germany",
					"GH" => "Ghana",
					"GI" => "Gibraltar",
					"GR" => "Greece",
					"GL" => "Greenland",
					"GD" => "Grenada",
					"GP" => "Guadeloupe",
					"GU" => "Guam",
					"GT" => "Guatemala",
					"GN" => "Guinea",
					"GW" => "Guinea-Bissau",
					"GY" => "Guyana",
					"HT" => "Haiti",
					"HM" => "Heard And Mc Donald Islands",
					"VA" => "Holy See (Vatican City State)",
					"HN" => "Honduras",
					"HK" => "Hong Kong",
					"HU" => "Hungary",
					"IS" => "Iceland",
					"IN" => "India",
					"ID" => "Indonesia",
					"IR" => "Iran (Islamic Republic Of)",
					"IQ" => "Iraq",
					"IE" => "Ireland",
					"IL" => "Israel",
					"IT" => "Italy",
					"JM" => "Jamaica",
					"JP" => "Japan",
					"JO" => "Jordan",
					"KZ" => "Kazakhstan",
					"KE" => "Kenya",
					"KI" => "Kiribati",
					"KP" => "Korea, Democratic People's Republic Of",
					"KR" => "Korea, Republic Of",
					"KW" => "Kuwait",
					"KG" => "Kyrgyzstan",
					"LA" => "Lao People's Democratic Republic",
					"LV" => "Latvia",
					"LB" => "Lebanon",
					"LS" => "Lesotho",
					"LR" => "Liberia",
					"LY" => "Libya",
					"LI" => "Liechtenstein",
					"LT" => "Lithuania",
					"LU" => "Luxembourg",
					"MO" => "Macau",
					"MK" => "Macedonia",
					"MG" => "Madagascar",
					"MW" => "Malawi",
					"MY" => "Malaysia",
					"MV" => "Maldives",
					"ML" => "Mali",
					"MT" => "Malta",
					"MH" => "Marshall Islands",
					"MQ" => "Martinique",
					"MR" => "Mauritania",
					"MU" => "Mauritius",
					"YT" => "Mayotte",
					"MX" => "Mexico",
					"FM" => "Micronesia, Federated States Of",
					"MD" => "Moldova, Republic Of",
					"MC" => "Monaco",
					"MN" => "Mongolia",
					"ME" => "Montenegro",
					"MS" => "Montserrat",
					"MA" => "Morocco",
					"MZ" => "Mozambique",
					"MM" => "Myanmar",
					"NA" => "Namibia",
					"NR" => "Nauru",
					"NP" => "Nepal",
					"NL" => "Netherlands",
					"AN" => "Netherlands Antilles",
					"NC" => "New Caledonia",
					"NZ" => "New Zealand",
					"NI" => "Nicaragua",
					"NE" => "Niger",
					"NG" => "Nigeria",
					"NU" => "Niue",
					"NF" => "Norfolk Island",
					"MP" => "Northern Mariana Islands",
					"NO" => "Norway",
					"OM" => "Oman",
					"PK" => "Pakistan",
					"PW" => "Palau",
					"PA" => "Panama",
					"PG" => "Papua New Guinea",
					"PY" => "Paraguay",
					"PE" => "Peru",
					"PH" => "Philippines",
					"PN" => "Pitcairn",
					"PL" => "Poland",
					"PT" => "Portugal",
					"PR" => "Puerto Rico",
					"QA" => "Qatar",
					"RE" => "Reunion",
					"RO" => "Romania",
					"RU" => "Russian Federation",
					"RW" => "Rwanda",
					"KN" => "Saint Kitts And Nevis",
					"LC" => "Saint Lucia",
					"VC" => "Saint Vincent And The Grenadines",
					"WS" => "Samoa",
					"SM" => "San Marino",
					"ST" => "Sao Tome And Principe",
					"SA" => "Saudi Arabia",
					"SN" => "Senegal",
					"RS" => "Serbia",
					"SC" => "Seychelles",
					"SL" => "Sierra Leone",
					"SG" => "Singapore",
					"SK" => "Slovakia (Slovak Republic)",
					"SI" => "Slovenia",
					"SB" => "Solomon Islands",
					"SO" => "Somalia",
					"ZA" => "South Africa",
					"GS" => "South Georgia, South Sandwich Islands",
					"ES" => "Spain",
					"LK" => "Sri Lanka",
					"SH" => "St. Helena",
					"PM" => "St. Pierre And Miquelon",
					"SD" => "Sudan",
					"SR" => "Suriname",
					"SJ" => "Svalbard And Jan Mayen Islands",
					"SZ" => "Swaziland",
					"SE" => "Sweden",
					"CH" => "Switzerland",
					"SY" => "Syrian Arab Republic",
					"TW" => "Taiwan",
					"TJ" => "Tajikistan",
					"TZ" => "Tanzania, United Republic Of",
					"TH" => "Thailand",
					"TG" => "Togo",
					"TK" => "Tokelau",
					"TO" => "Tonga",
					"TT" => "Trinidad And Tobago",
					"TN" => "Tunisia",
					"TR" => "Turkey",
					"TM" => "Turkmenistan",
					"TC" => "Turks And Caicos Islands",
					"TV" => "Tuvalu",
					"UG" => "Uganda",
					"UA" => "Ukraine",
					"AE" => "United Arab Emirates",
					"GB" => "United Kingdom",
					"UM" => "United States Minor Outlying Islands",
					"UY" => "Uruguay",
					"UZ" => "Uzbekistan",
					"VU" => "Vanuatu",
					"VE" => "Venezuela",
					"VN" => "Viet Nam",
					"VG" => "Virgin Islands (British)",
					"VI" => "Virgin Islands (U.S.)",
					"WF" => "Wallis And Futuna Islands",
					"EH" => "Western Sahara",
					"YE" => "Yemen",
					"ZM" => "Zambia",
					"ZW" => "Zimbabwe",
				);

//Event Details Meta Box
function event_details(){
	add_meta_box('pix_event_details', 'Event Details', 'pix_event_details_cb', 'pix_event', 'normal','low');
}
add_action('add_meta_boxes', 'event_details');

//Displaying Meta Box
function pix_event_details_cb($post)
{
	global $post,$wpdb;
	$meta = $first_day_schedule = $second_day_schedule = $third_day_schedule = $fourth_day_schedule = array();

 	$event_date_from = $event_date_to = $event_time = $first_schedule_date =  $second_schedule_date = $third_schedule_date = $fourth_schedule_date = $venue_name = $country_code = $select_country = $state = $latitude = $longitude = $organizer = $about_organizer = $organizer_facebook = $organizer_twitter = $organizer_email = $checked = '';

	$meta = get_post_meta($post->ID,'event_details',false);
	if( !empty($meta) )
	extract($meta[0]);
	wp_nonce_field(__FILE__, 'pix_event_details_nonce');

	$schedule_cpt_ID = $wpdb->get_results("SELECT ID
		FROM $wpdb->posts WHERE post_type = 'pix_schedule' AND post_status = 'publish'", ARRAY_N);

?>
	
<div id="meta-wrapper">

<div id="PageOptions" class="verticalTab">
<ul class="resp-tabs-list">
			<li><span class="dashicons dashicons-calendar"></span><?php echo __('Event Date','innwit') ?></li>
			<li><span class="dashicons dashicons-groups"></span><?php echo __('Schedule with Speakers','innwit') ?></li>
			<li><span class="dashicons dashicons-location-alt"></span><?php echo __('Event Location Details','innwit') ?></li>
			<li><span class="dashicons dashicons-businessman"></span><?php echo __('Event Organizer Details','innwit') ?></li>
			<?php if ( class_exists('Woocommerce') ) { ?>
				<li><span class="dashicons dashicons-businessman"></span><?php echo __('Event Ticket Details','innwit') ?></li>
			<?php } ?>
		</ul>
	<!-- TAB CONTAINER -->
	<div class="resp-tabs-container">

			<div>

				<p>
					<label for="event_date_from"><?php echo __('Date From:','innwit') ?></label>
					<input type="text" class="widefat date_popup_from" name="event_date_from" id="event_date_from" value="<?php echo esc_attr($event_date_from); ?>" placeholder="mm/dd/yyyy">
				</p>
				<div class="sep"></div>
				<p>
					<label for="event_date_to"><?php echo __('Date To:','innwit') ?></label>
					<input type="text" class="widefat date_popup_to" name="event_date_to" id="event_date_to" value="<?php echo esc_attr($event_date_to); ?>" placeholder="mm/dd/yyyy">
				</p>

				<div class="sep"></div>

				<p>
					<label for="event_time"><?php echo __('Event Start Time:','innwit') ?></label>
				
					<input type="text" class="widefat timepicker" name="event_time" id="event_time" value="<?php echo esc_attr($event_time); ?>" placeholder="">
				</p>

		</div>


		<div>
	
		<p>
			<label for="first_schedule_date"><?php echo __('First Day Schedule Date:','innwit') ?></label>
			<input type="text" class="widefat date_popup_from" name="first_schedule_date" id="first_schedule_date" value="<?php echo esc_attr($first_schedule_date); ?>" placeholder="mm/dd/yyyy">
		</p>

		<?php

			$i = 0;

			foreach ( $schedule_cpt_ID as $key => $value ){

				global $post;				

				$schedule = get_post_meta($value[0],'event_schedule');
				if( !empty($schedule) && !empty($schedule[0])){
					extract($schedule[0]);
				}

				$schedule_event_id = $schedule[0]['event'];


				if($schedule_event_id == $post->ID){
					$i++;
				}

			}
		?>

		
			<label for="first_event_schedule" class="shedulelabel"><?php echo __('Select Schedules:','innwit') ?></label>
		
			<?php
				if($i != 0){
					echo '<ul class="event_schedule_list clearfix">';
						foreach ( $schedule_cpt_ID as $key => $value ){

							global $post;

							$schedule = get_post_meta($value[0],'event_schedule');
								if( !empty($schedule) && !empty($schedule[0])){
									extract($schedule[0]);
								}

							$schedule_event_id = $schedule[0]['event'];

							$schedule_id = $value[0];

							$title = get_the_title( $value[0] );

							if(!empty($first_day_schedule)){
								if(in_array($schedule_id , $first_day_schedule)){
									$checked = 'checked';
								}
								else{
									$checked = '';
								}
							}
							else{
								$checked = '';
							}


							if($schedule_event_id == $post->ID){
								echo '<li><input type="checkbox" id="first_event_schedule" name="first_day_schedule[]" value="'.esc_attr($schedule_id).'" '.$checked.'><div>'.$title .'</div></li>';
							}

							

						}
					echo '</ul>';
				}
				else{
					echo '<p>No Schedule added to this event yet.</p>';
				}
			?>
		

		<div class="sep"></div>
		<!-- SECOND DAY SCHEDULE -->


		<p>
			<label for="second_schedule_date"><?php echo __('Second Day Schedule Date:','innwit') ?></label>
			<input type="text" class="widefat date_popup_from" name="second_schedule_date" id="second_schedule_date" value="<?php echo esc_attr($second_schedule_date); ?>" placeholder="mm/dd/yyyy">
		</p>

		
			<label for="second_event_schedule" class="shedulelabel"><?php echo __('Select Schedules:','innwit') ?></label>

		
			<?php
				if($i != 0){

					echo '<ul class="event_schedule_list clearfix">';
						foreach ( $schedule_cpt_ID as $key => $value ){

							global $post;

							$schedule = get_post_meta($value[0],'event_schedule');
								if( !empty($schedule) && !empty($schedule[0])){
									extract($schedule[0]);
								}

							$schedule_event_id = $schedule[0]['event'];

							$schedule_id = $value[0];

							$title = get_the_title( $value[0] );

							if(!empty($second_day_schedule)){
								if(in_array($schedule_id , $second_day_schedule)){
									$checked = 'checked';
								}
								else{
									$checked = '';
								}
							}
							else{
								$checked = '';
							}


							if($schedule_event_id == $post->ID){
								echo '<li><input type="checkbox" id="second_event_schedule" name="second_day_schedule[]" value="'.esc_attr($schedule_id).'" '.$checked.'><div>'.$title .'</div></li>';
							}

							

						}
					echo '</ul>';
				}
				else{
					echo '<p>No Schedule added to this event yet.</p>';
				}	
			?>
			


		<!-- THIRD DAY SCHEDULE -->
		<div class="sep"></div>


		<p>
			<label for="third_schedule_date"><?php echo __('Third Day Schedule Date:','innwit') ?></label>
			<input type="text" class="widefat date_popup_from" name="third_schedule_date" id="third_schedule_date" value="<?php echo esc_attr($third_schedule_date); ?>" placeholder="mm/dd/yyyy">
		</p>

		
			<label for="third_event_schedule" class="shedulelabel"><?php echo __('Select Schedules:','innwit') ?></label>

		
			<?php
				if($i != 0){

					echo '<ul class="event_schedule_list clearfix">';
						foreach ( $schedule_cpt_ID as $key => $value ){

							global $post;

							$schedule = get_post_meta($value[0],'event_schedule');
								if( !empty($schedule) && !empty($schedule[0])){
									extract($schedule[0]);
								}

							$schedule_event_id = $schedule[0]['event'];

							$schedule_id = $value[0];

							$title = get_the_title( $value[0] );

							if(!empty($third_day_schedule)){
								if(in_array($schedule_id , $third_day_schedule)){
									$checked = 'checked';
								}
								else{
									$checked = '';
								}
							}
							else{
								$checked = '';
							}


							if($schedule_event_id == $post->ID){
								echo '<li><input type="checkbox" id="third_event_schedule" name="third_day_schedule[]" value="'.esc_attr($schedule_id).'" '.$checked.'><div>'.$title .'</div></li>';
							}

							

						}
					echo '</ul>';
				}
				else{
					echo '<p>No Schedule added to this event yet.</p>';
				}	
			?>
				


		<!-- FOURTH DAY SCHEDULE -->
		<div class="sep"></div>


		<p>
			<label for="fourth_schedule_date"><?php echo __('Fourth Day Schedule Date:','innwit') ?></label>
			<input type="text" class="widefat date_popup_from" name="fourth_schedule_date" id="fourth_schedule_date" value="<?php echo esc_attr($fourth_schedule_date); ?>" placeholder="mm/dd/yyyy">
		</p>

		
			<label for="fourth_event_schedule" class="shedulelabel"><?php echo __('Select Schedules:','innwit') ?></label>

		
			<?php
				if($i != 0){
					echo '<ul class="event_schedule_list clearfix">';
						foreach ( $schedule_cpt_ID as $key => $value ){

							global $post;

							$schedule = get_post_meta($value[0],'event_schedule');
								if( !empty($schedule) && !empty($schedule[0])){
									extract($schedule[0]);
								}

							$schedule_event_id = $schedule[0]['event'];

							$schedule_id = $value[0];

							$title = get_the_title( $value[0] );

							if(!empty($fourth_day_schedule)){
								if(in_array($schedule_id , $fourth_day_schedule)){
									$checked = 'checked';
								}
								else{
									$checked = '';
								}
							}
							else{
								$checked = '';
							}


							if($schedule_event_id == $post->ID){
								echo '<li><input type="checkbox" id="fourth_event_schedule" name="fourth_day_schedule[]" value="'.esc_attr($schedule_id).'" '.$checked.'><div>'.$title .'</div></li>';
							}

							

						}
					echo '</ul>';
				}
				else{
					echo '<p>No Schedule added to this event yet.</p>';
				}		
			?>
				
		
	</div>

	<div>

		<!-- VENUE -->

		<p>
			<label for="venue_name"><?php echo __('Venue Name:','innwit') ?></label>
			<input type="text" class="widefat" name="venue_name" id="venue_name" value="<?php echo esc_attr($venue_name); ?>">
		</p>

		<div class="sep"></div>

		<?php
			global $countries;

			if($select_country != 'Select a Country:'){
				$country_code = array_search($select_country, $countries);
				echo '<input type="hidden" class="widefat" name="country_code" id="country_code" value="'.$country_code.'">';

			}
			
		?>
		


		<!-- SELECT COUNTRY -->

		<p>
			<label for="select_country"><?php echo __('Select Country:','innwit') ?></label>

			<select name="select_country" id="select_country">
				<?php

					global $countries;

					foreach ( $countries as $value ){


						echo '<option value="'.esc_attr($value).'"'.(($select_country == $value) ? ' selected="selected"' : ''). '>'.$value.'</option>';

					}
				?>			
			</select>
		</p>
		<div class="sep"></div>
		<!-- STATE -->

		<p>
			<label for="state"><?php echo __('State or Province:','innwit') ?></label>
			<input type="text" class="widefat" name="state" id="state" value="<?php echo esc_attr($state); ?>">
		</p>

		<div class="sep"></div>

		<!-- LATITUDE -->
		<p>
			<label for="latitude"><?php echo __('Latitude:','innwit') ?></label>
			<input type="text" class="widefat" name="latitude" id="latitude" value="<?php echo esc_attr($latitude); ?>">
		</p>

		<div class="sep"></div>

		<!-- LONGITUDE -->
		<p>
			<label for="longitude"><?php echo __('Longitude:','innwit') ?></label>
			<input type="text" class="widefat" name="longitude" id="longitude" value="<?php echo esc_attr($longitude); ?>">
		</p>



	</div>

	<div>

		<!-- ORGANIZER NAME -->
		<p>
			<label for="organizer"><?php echo __('Organizer Name:','innwit') ?></label>
			<input type="text" class="widefat" name="organizer" id="organizer" value="<?php echo esc_attr($organizer); ?>">
		</p>

		<div class="sep"></div>

		<!-- ABOUT ORGANIZER -->
		<p>
			<label for="about_organizer"><?php echo __('About Organizer:','innwit') ?></label>
			<textarea class="widefat" name="about_organizer" id="about_organizer"><?php echo esc_textarea($about_organizer); ?></textarea>
		</p>

		<div class="sep"></div>

		<!-- ORGANIZER FACEBOOK -->
		<p>
			<label for="organizer_facebook"><?php echo __('Organizer Facebook URL:','innwit') ?></label>
			<input type="text" class="widefat" name="organizer_facebook" id="organizer_facebook" value="<?php echo esc_attr($organizer_facebook); ?>">
		</p>

		<div class="sep"></div>

		<!-- ORGANIZER TWITTER -->
		<p>
			<label for="organizer_twitter"><?php echo __('Organizer Twitter URL:','innwit') ?></label>
			<input type="text" class="widefat" name="organizer_twitter" id="organizer_twitter" value="<?php echo esc_attr($organizer_twitter); ?>">
		</p>

		<div class="sep"></div>

		<!-- ORGANIZER EMAIL -->
		<p>
			<label for="organizer_email"><?php echo __('Organizer Email:','innwit') ?></label>
			<input type="email" class="widefat" name="organizer_email" id="organizer_email" value="<?php echo esc_attr($organizer_email); ?>">
		</p>


	</div>

	<?php if ( class_exists('Woocommerce') ) { ?>

		<div class="tickets-details" id="tickets-details">

			<!-- ORGANIZER NAME -->

			<noscript>JavaScript has been disbaled. Please Enable JavaScript, otherwise add ticket will not work.</noscript>

			

			<?php

				$woo_product_id = get_post_meta($post->ID, 'woo_product_id', true);

				$woo_product_id = (!empty ( $woo_product_id )) ? $woo_product_id : -1;
				$ticket_btn_text = ( $woo_product_id == -1 && $woo_product_id != '' ) ? __( 'Add Ticket', 'innwit' ) : __( 'Update Ticket', 'innwit' );						

				$ticket_nonce = wp_create_nonce("add_ticket_nonce");
				$actionUrl = admin_url('admin-ajax.php');

				$woo_post = new stdClass();

				if($woo_product_id != -1){
					$woo_post = get_post($woo_product_id);
				}

				$ticket_title = !empty ( $woo_post->post_title ) ? $woo_post->post_title : '';
				$ticket_desc = !empty ( $woo_post->post_content ) ? $woo_post->post_content : '';


				$_sku = !empty ( $_POST['_sku'] ) ? $_POST['_sku'] : '';
				$_regular_price = !empty ( $_POST['_regular_price'] ) ? $_POST['_regular_price'] : '';
				$_stock = !empty ( $_POST['_stock'] ) ? $_POST['_stock'] : '';

			?>

			<p>
				<label for="ticket_title"><?php echo __('Ticket Title:','innwit') ?></label>
				<input type="text" class="widefat" name="ticket_title" id="ticket_title" value="<?php echo esc_attr($ticket_title); ?>">
			</p>

			<div class="sep"></div>

			<p>
				<label for="ticket_desc"><?php echo __('Ticket Description:','innwit') ?></label>
				<textarea type="text" class="widefat" name="ticket_desc" id="ticket_desc"><?php echo esc_attr($ticket_desc); ?></textarea>
			</p>

			<div class="sep"></div>

			<?php 

				

				$GLOBALS['thepostid'] = $woo_product_id;
				
				// SKU
				if ( wc_product_sku_enabled() ) {
					woocommerce_wp_text_input( array( 'id' => '_sku', 'label' => '<abbr title="'. __( 'Stock Keeping Unit', 'woocommerce' ) .'">' . __( 'SKU', 'woocommerce' ) . '</abbr>', 'description' => __( 'SKU refers to a Stock-keeping unit, a unique identifier for each distinct product and service that can be purchased.', 'woocommerce' ) ) );
				} else {
					echo '<input type="hidden" name="_sku" value="' . esc_attr( get_post_meta( $thepostid, '_sku', true ) ) . '" />';
				}

				echo '<div class="sep"></div>';

				// Price
				woocommerce_wp_text_input( array( 
					'id' => '_regular_price',
					'label' => __( 'Regular Price', 'woocommerce' ) . ' (' . get_woocommerce_currency_symbol() . ')', 'data_type' => 'price' ) );

				echo '<div class="sep"></div>';

				// Stock
				woocommerce_wp_text_input( array(
					'id'                => '_stock',
					'label'             => __( 'Ticket Qty', 'innwit' ),
					'desc_tip'          => true,
					'description'       => __( 'Ticket Quantity. Enter the Total Number of tickets available for this event', 'innwit' ),
					'type'              => 'number',
					'custom_attributes' => array(
						'step' => 'any'
					),
					'data_type'         => 'stock'
				) );
			?>

			<div class="sep"></div>

			<span class="spinner hidden"></span><p id="ticket-msg" class="import-messages hidden"></p>

			<input type="hidden" class="widefat" name="woo_product_id" id="woo_product_id" value="<?php echo esc_attr($woo_product_id); ?>">

			<?php
				echo '<a id="pix-add-ticket" href="#" data-ticketid="'. $woo_product_id .'"  data-postid="'. get_the_id() .'" data-nonce="'. $ticket_nonce .'" class="button button-primary button-large">'. esc_html($ticket_btn_text) .'</a>';
								
				$removebtn = '';
				if( $woo_product_id == -1 ){
					$removebtn = ' hidden';
				}
				echo '<a id="pix-remove-ticket" href="#" class="button button-large'. $removebtn .'">'. __('Remove Ticket', 'innwit') .'</a>';
			?>

		</div>
	<?php } ?>


	</div>

</div>




	

</div>



<?php
}


//Saving Custom Meta Box Values
function saving_event_details(){
	global $post;
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
	
	$pix_event_details_nonce = isset($_POST['pix_event_details_nonce']) ? $_POST['pix_event_details_nonce'] : '';

	if($_POST && wp_verify_nonce($pix_event_details_nonce, __FILE__)){
		
		$values = array(
			'event_date_from' => isset($_POST['event_date_from']) ? $_POST['event_date_from'] : '',

			'event_date_to' => isset($_POST['event_date_to']) ? $_POST['event_date_to'] : '',

			'event_time' => isset($_POST['event_time']) ? $_POST['event_time'] : '',

			'first_day_schedule' => isset($_POST['first_day_schedule']) ? $_POST['first_day_schedule'] : '',

			'first_schedule_date' => isset($_POST['first_schedule_date']) ? $_POST['first_schedule_date'] : '',

			'second_day_schedule' => isset($_POST['second_day_schedule']) ? $_POST['second_day_schedule'] : '',

			'second_schedule_date' => isset($_POST['second_schedule_date']) ? $_POST['second_schedule_date'] : '',

			'third_day_schedule' => isset($_POST['third_day_schedule']) ? $_POST['third_day_schedule'] : '',

			'third_schedule_date' => isset($_POST['third_schedule_date']) ? $_POST['third_schedule_date'] : '',

			'fourth_day_schedule' => isset($_POST['fourth_day_schedule']) ? $_POST['fourth_day_schedule'] : '',

			'fourth_schedule_date' => isset($_POST['fourth_schedule_date']) ? $_POST['fourth_schedule_date'] : '',

			'venue_name' => isset($_POST['venue_name']) ? $_POST['venue_name'] : '',

			'country_code' => isset($_POST['country_code']) ? $_POST['country_code'] : '',

			'select_country' => isset($_POST['select_country']) ? $_POST['select_country'] : '',

			'state' => isset($_POST['state']) ? $_POST['state'] : '',

			'latitude' => isset($_POST['latitude']) ? $_POST['latitude'] : '',

			'longitude' => isset($_POST['longitude']) ? $_POST['longitude'] : '',

			'organizer' => isset($_POST['organizer']) ? $_POST['organizer'] : '',

			'about_organizer' => isset($_POST['about_organizer']) ? $_POST['about_organizer'] : '',

			'organizer_facebook' => isset($_POST['organizer_facebook']) ? $_POST['organizer_facebook'] : '',

			'organizer_twitter' => isset($_POST['organizer_twitter']) ? $_POST['organizer_twitter'] : '',

			'organizer_email' => isset($_POST['organizer_email']) ? $_POST['organizer_email'] : '',

		);
		
		update_post_meta($post->ID, 'event_details', $values);
			
	}
	
	
}
add_action('save_post', 'saving_event_details');