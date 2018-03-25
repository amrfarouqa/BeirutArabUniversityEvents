<?php
/**
 * Sync third party events settings page content
 * @version 0.1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// for media upload
	require_once( ABSPATH . 'wp-admin/includes/file.php' );
	require_once( ABSPATH . 'wp-admin/includes/media.php' );

// include required files form Facebook SDK
	require __DIR__ . '/Facebook/facebook-php-sdk-v4-4.0.23/autoload.php';

	use Facebook\FacebookSession;
	use Facebook\FacebookRedirectLoginHelper;
	use Facebook\FacebookRequest;
	use Facebook\FacebookResponse;
	use Facebook\FacebookSDKException;
	use Facebook\FacebookRequestException;
	use Facebook\FacebookOtherException;
	use Facebook\FacebookAuthorizationException;
	use Facebook\FacebookJavaScriptLoginHelper;
	use Facebook\GraphObject;
	use Facebook\GraphUser;
	use Facebook\GraphSessionInfo;

class evosy_settings{
	function __construct(){
		$this->options = get_option('evcal_options_evosy_1');
		echo $this->content();
	}

	// settings page content
		function content(){

			global $eventon, $eventon_sy;

			// LOAD AJDE backender system
				$eventon->enqueue_backender_styles();
				$eventon->register_backender_scripts();
				$eventon->load_ajde_backender();

			// Settings Tabs array
				$evcal_tabs = array(
					'evosy_1'=>__('General Settings','eventon'), 
					'evosy_2'=>__('Sync','eventon'), 
				);	
			
			$focus_tab = (isset($_GET['tab']) )? sanitize_text_field( urldecode($_GET['tab'])):'evosy_1';	
		
			// Update or add options
			if( isset($_POST['evosy_noncename']) && isset( $_POST ) ){				
				if ( wp_verify_nonce( $_POST['evosy_noncename'], AJDE_EVCAL_BASENAME ) ){

					foreach($_POST as $pf=>$pv){
						$pv = (is_array($pv))? $pv: (htmlspecialchars ($pv) );
						$evcal_options[$pf] = $pv;					
					}
					update_option('evcal_options_'.$focus_tab, $evcal_options);
					$_POST['settings-updated']='Successfully updated values.';
				
				//nonce check	
				}else{
					die( __( 'Action failed. Please refresh the page and retry.', 'eventon' ) );
				}	
			}
			?>
			<div class="wrap" id='evcal_settings'>
				<div id='eventon'><div id="icon-themes" class="icon32"></div></div>
				<h2><?php _e('Sync Events Settings','eventon');?> </h2>
				<h2 class='nav-tab-wrapper' id='meta_tabs'>
					<?php					
						foreach($evcal_tabs as $nt=>$ntv){							
							$evo_notification='';
							echo "<a href='?page=evo-sync&tab=".$nt."' class='nav-tab ".( ($focus_tab == $nt)? 'nav-tab-active':null)."' evcal_meta='evosy_1'>".$ntv.$evo_notification."</a>";
						}			
					?>
				</h2>	
			<div class='evo_settings_box'>		
			<?php		
			$updated_code = (isset($_POST['settings-updated']))? '<div class="updated fade"><p>'.$_POST['settings-updated'].'</p></div>':null;
			echo $updated_code;
					
			//TABS	
			switch ($focus_tab):	
			case "evosy_1":		
			?>
			<form method="post" action=""><?php settings_fields('evosy_field_group'); 
				wp_nonce_field( AJDE_EVCAL_BASENAME, 'evosy_noncename' );
			?>
			<div id="evosy_1" class="evcal_admin_meta evcal_focus">		
				<div class="inside">
				<?php	

					$evcal_opt= get_option('evcal_options_evosy_1');
					$__evo_admin_email = get_option('admin_email');
					
				// ARRAY
					$cutomization_pg_array = array(
						array(
							'id'=>'evosy1',
							'name'=>__('Sync Settings','eventon'),
							'tab_name'=>__('Sync Events','eventon'),
							'display'=>'show',
							'icon'=>'random',
							'fields'=>array(
								array('id'=>'evosy_post_status','type'=>'dropdown','name'=>'Default status for imported events','width'=>'full',
									'options'=>array(
										'draft'=>'Draft',
										'publish'=>'Publish',
										'private'=>'Private')
									),								
						)),
						array(
							'id'=>'evosy_fb',
							'name'=>__('Sync Settings for Facebook','eventon'),
							'tab_name'=>__('Facebook','eventon'),
							'icon'=>'facebook-square',
							'fields'=>array(
								
								array('id'=>'evosy_notif','type'=>'note','name'=>'<b>INSTRUCTIONS:</b><br/><br/><b>STEP 1: </b> Create a facebook app on facebook developers page and capture <u>APP ID</u> and <u>secret keys</u> to perform syncing. <br/><a href="http://www.myeventon.com/documentation/how-to-create-a-facebook-app/" target="_blank">How to create a facebook app</a>, <a href="https://developers.facebook.com/apps/" target="_blank">Developer Facebook</a>  <br/><br/><b>STEP 2: </b> Find the facebook page username OR page ID OR even individual event ID to pull event data from. NOTE: The events do not have to be events you are attending or created by you, it can be any events. <br/><br/><b>STEP 3: </b>Switch over to sync tab and start importing events.',),
								array('id'=>'evosy_fb_appid','type'=>'text','name'=>'App ID','legend'=>'App ID from the facebook app'),
								array('id'=>'evosy_fb_secret','type'=>'text','name'=>'App Secret',),
								array('id'=>'evosy_fb_uids','type'=>'textarea','name'=>'Organization and page usernames/IDs to fetch events from  (NOTE: Separated by commas without blank spaces)', 'legend'=>'Facebook usernames or facebook page IDs only. Do not paste individual event IDs in here. These pages should be either, created by the above APP or public pages.'),
								array('id'=>'evosy_fb_eventids','type'=>'textarea','name'=>'Other event IDs to pull data on facebook events (NOTE: Separated by commas, MUST be created by above APP or Public event)','legend'=>'Facebook event ID can be found from the URL to the facebook event page. eg. https://www.facebook.com/ events/836033933132047/ The Event IDS MUST be either create by above APP or public events.'),
						)),
						array(
							'id'=>'evosy_gg',
							'name'=>__('Sync Settings for Google Calendar','eventon'),
							'tab_name'=>__('Google Calendar','eventon'),
							'icon'=>'google-plus-square',
							'fields'=>array(								
								array('id'=>'evosy_notif','type'=>'note','name'=>'<b>INSTRUCTIONS: <br/><br/>Step 1:</b> Use <a href="https://console.developers.google.com/start/api?id=calendar" target="_blank">this wizard</a> to create or select a project in the Google Developers Console and enable API.<br/><br/>
									<b>Step 2:</b> You can enable API from APIs & auth > Credentials > Create new Key in google developer console. Do not set IP limitations at this moment.<br/><br/>
									<b>Step 3:</b> Go to the google calendar settings you want to fetch events. Under sharing settings make sure PUBLIC sharing is <b>ENABLED</b>.<br/><br/>

									<b>IMPORTANT: If these instructions were not followed correctly it will throw errors and will NOT pull any events. This will NOT fetch any past events.</b>',),
								array('id'=>'evosy_gg_apikey','type'=>'text','name'=>'API Key','legend'=>'API Key for your google developer account'),
								array('id'=>'evosy_gg_calid','type'=>'text','name'=>'Calendar ID of the calendar to fetch events','legend'=>'Sometimes the calendar ID is something like email@gmail.com. Find this in calendar settings. All calendar events must be viewable in sharing settings to fetch events.'),	
						)),									
					);				
					
					$updated_code = (isset($_POST['settings-updated']) && $_POST['settings-updated']=='true')? '<div class="updated fade"><p>'.__('Settings Saved','eventon').'</p></div>':null;
					echo $updated_code;
						
					print_ajde_customization_form($cutomization_pg_array, $evcal_opt);
				?>				
				</div>				
			</div>	
			<div class='evo_diag'>
				<input type="submit" class="evo_admin_btn btn_prime" value="<?php _e('Save Changes','eventon') ?>" /><br/><br/>
				<a target='_blank' href='http://www.myeventon.com/support/'><img src='<?php echo AJDE_EVCAL_URL;?>/assets/images/myeventon_resources.png'/></a>
			</div>		
			</form>			
			<?php  
			break;
			// sync step
				case "evosy_2":
					echo "<div class='postbox'><div class='inside'>";
					echo $this->process();
					echo "</div></div>";
				break;
			endswitch;
			echo "</div>";

		} // end content()

	// process syncing
		function process(){

			$options = $this->options;

			// check if API information is provided
			$gg_good = (!empty($options['evosy_gg_apikey']) && !empty($options['evosy_gg_calid']) )? true: false;
			$fb_good = (!empty($options['evosy_fb_appid']) && !empty($options['evosy_fb_secret']) )? true: false;

			ob_start();
			
			// show fetched data from Facebook
			if(!empty($_REQUEST['actionx']) && $_REQUEST['actionx']=='sync' ){	

				if($fb_good){

					$fb_app_id = $options['evosy_fb_appid'];
					$fb_secret = $options['evosy_fb_secret'];
					$uids = $options['evosy_fb_uids'];
					
					$events= array();						
					// if facebook pages provided
					if(!empty($uids)){
						// process uids
						$uids = $this->process_ids($uids);	
						$events = $this->get_fb_events($fb_app_id, $fb_secret, $uids);
					}

					// get events using event IDS only
					if(!empty($options['evosy_fb_eventids'])){
						$events_withids = $this->fb_get_events_from_ids($fb_app_id, $fb_secret);

						if(!empty($events_withids) && count($events_withids)>0)
							$events = array_merge($events, $events_withids);
					}

					if(!empty($events))
						$this->display_events($events, 'fb');
				
				}else{
					echo "<p class='msg'>".__('Facebook App ID/ Secret Key missing!','eventon')."</p>";
				}

			// google fetch events
			}elseif(!empty($_REQUEST['actionx']) && $_REQUEST['actionx']=='syncGG'){
				if($gg_good){
					$this->get_gg_events();
				}else{
					echo "<p class='msg'>".__('Google App ID/ Cal ID missing!','eventon')."</p>";
				}				

			}elseif(!empty($_REQUEST['actionx']) && $_REQUEST['actionx']=='import'){
				$type = (!empty($_REQUEST['type'])? $_REQUEST['type']: 'fb');
				$this->import_events();
			}else{				
					
				?>
				<p><?php _e('Select the option below to start fetching events from external source. Prior to start fetching process, make sure required information in facebook & Google calendar API is filled under General Settings. Otherwise it will not pull events correctly.','eventon');?></p>
				<p><a id='process' href='<?php echo ($fb_good)? admin_url().'admin.php?page=evo-sync&tab=evosy_2&actionx=sync':'';?>' class="evo_admin_btn btn_prime"><?php _e('Fetch Events from Facebook','eventon');?></a> <?php echo (!$fb_good)? '<i>'.__('Required API Information Missing!','eventon').'</i>':'';?></p>
				
				<p><a id='processGG' href='<?php echo $gg_good? admin_url().'admin.php?page=evo-sync&tab=evosy_2&actionx=syncGG':'#';?>' class="evo_admin_btn btn_prime"><?php _e('Fetch Events from Google Calendar','eventon');?></a> <?php echo (!$gg_good)? '<i>'.__('Required API Information Missing!','eventon').'</i>':'';?></p>


			<?php }
			return ob_get_clean();
		}

	// display fetched events list
		function display_events($events, $type='fb'){
			global $eventon_sy;

			if(empty($events)){
				$thirdparty = ($type=='fb')? 'facebook':'google calendar';
				echo "<p>".__('We could not find any future events in the '.$thirdparty.' resources you specified. Please make sure future events exist in '.$thirdparty.'.','eventon')."</p>";
				?>
					<a href='<?php echo admin_url().'admin.php?page=evo-sync&tab=evosy_2';?>' class="evo_admin_btn btn_prime"><?php _e('Go Back','eventon');?></a>
				<?php
				return false;
			}

			// get saved event ids
			$saved_fb_events = $this->get_imported_event_ids();

			//print_r($saved_fb_events);

			echo "<h2>".__('Step 2: Select fetched events','eventon')."</h2>";
			echo "<p>".__('Select events to import to eventON calendar from the fetched events below.','eventon')."</p>";
			echo "<form action='".admin_url()."/admin.php?page=evo-sync&tab=evosy_2&actionx=import&type={$type}' method='post' enctype='multipart/form-data'>
				<div id='evosy_fetched_events'>";
				settings_fields('eventon_sy_field_grp'); 
				wp_nonce_field( $eventon_sy->plugin_path, 'eventon_sy_noncename' );
			echo "<table class='wp-list-table widefat'>
				<thead><tr>
					<th>".__('Status','eventon')."</th>
					<th>".__('Event Time','eventon')."</th>
					<th>".__('Event Name','eventon')."</th>
					</tr>
				</thead><tbody>";

			$count = 1;
			foreach($events as $event){
				// status 
				$status = 'ns'; $imported_event_id = false;

				if(!empty($saved_fb_events) && in_array($event['id'], $saved_fb_events)){
					$imported_event_id = array_search($event['id'], $saved_fb_events);
					$status = 'as';
				}

				echo "<tr class='row' data-status='{$status}'>";
				echo "<td><span class='status {$status}' title='".($status=='ns'?'Not Selected':'Already Imported')."'></span></td>";
				echo "<td><span class='time'>".$event['start_time']."</span></td>";
				echo "<td><span>".$event['name']."</span>";
				
				// pass all the data
				echo "<input class='input_status' type='hidden' name='event[{$count}][status]' value='{$status}'/>";
				echo "<input type='hidden' name='event[{$count}][id]' value='{$event['id']}'/>";
				echo ($imported_event_id)? "<input type='hidden' name='event[{$count}][importedid]' value='{$imported_event_id}'/>":'';
				foreach(array('start_time','end_time','event_picture_url') as $field){
					if(isset($event[$field]))
						echo " <input type='hidden' name='event[{$count}][{$field}]' value='".addslashes($event[$field])."'/>";
				}
				
				echo isset($event['description'])? "<textarea style='display:none' name='event[{$count}][description]' value=''/>".$event['description']."</textarea>":'';
				echo "<input type='hidden' name='event[{$count}][name]' value=\"".addslashes($event['name'])."\"/>";
				echo isset($event['place']->location)? "<input type='hidden' name='event[{$count}][place]' value='{$event['place']->name}'/>":'';
				echo isset($event['place']->location)? "<input type='hidden' name='event[{$count}][latitude]' value='{$event['place']->location->latitude}'/>":'';
				echo isset($event['place']->location)? "<input type='hidden' name='event[{$count}][longitude]' value='{$event['place']->location->longitude}'/>":'';
				echo isset($event['link'])? "<input type='hidden' name='event[{$count}][link]' value='{$event['link']}'/>":'';
				echo isset($event['organizer'])? "<input type='hidden' name='event[{$count}][organizer]' value='{$event['organizer']}'/>":'';
				
				echo "</td></tr>";

				$count ++;
			}
			echo "</tbody></table></div>";

			echo "<p class='yesno_leg_line'>";
			echo eventon_html_yesnobtn(array(
				'id'=>'sync_imported',
				'label'=>__('Sync already imported events','eventon'),
				'input'=>true,
				));
			echo "</p>";

			echo "<p><input type='submit' class='evo_admin_btn btn_tritiary' value='".__('next: Import Selected Events','eventon')."'/></p></form>";
		}

	// IMPORT events to wp
		function import_events($type='fb'){

			$skipped = 0;
			$imported = $synced = 0;
			$time_start = microtime(true);

			// verify nonce for the form
			if( !$this->csv_verify_nonce_post( 'eventon_sy_noncename')){
				_e('<h2>Not Imported</h2>','eventon');
				echo "<p>".__('No events were selected for importing.','eventon')."</p>";
				return false;
			}

			// verify event post data exists
			if(empty($_POST['event'])){	
				// Show the report on import process
				_e('<h2>Not Imported</h2>','eventon');
				echo "<p>".__('No events were selected for importing.','eventon')."</p>";

				return false;
			}else{
				// for each event data			
				foreach($_POST['event'] as $event){
					
					if(empty($event['status']) || $event['status']=='ns' )
						continue;

					// sync already imported events
					if(!empty($event['importedid']) && $event['status']=='as' && $_POST['sync_imported']=='yes'){
						$this->save_event_post_data($event['importedid'], $event, 'update');
						$synced ++;
					}

					if($event['status']=='as')
						continue;

					if($post_id = $this->create_post($event) ){
						$imported++;

						$this->save_event_post_data($post_id, $event);

						// import notice to event
						if($type=='fb'){
							$this->create_custom_fields($post_id, 'evosy_fb', $event['id']);
						}else{
							$this->create_custom_fields($post_id, 'evosy_gg', $event['id']);
						}
					}
				}

				// message after importing
					$exec_time = microtime(true) - $time_start;
					$this->log['notice'][] = sprintf("<b>Imported ({$imported}) events, Synced ($synced) event -- in %.2f seconds.</b>", $exec_time);
					$this->print_messages();

					// Show the report on import process
					_e('<h2>Complete!</h2>','eventon');

					echo "<p>Please go to <a href='".admin_url()."edit.php?post_type=ajde_events'>All Events</a> to further customize the events.</p>";
			}
		}

		// create new event post
		function create_post($data){
			$options = $this->options;
			$opt_draft = (!empty($options['evosy_post_status']))?$options['evosy_post_status']:'draft';        
	        $type = 'ajde_events';
	        $valid_type = (function_exists('post_type_exists') &&  post_type_exists($type));

	        if (!$valid_type) {
	            $this->log['error']["type-{$type}"] = sprintf(
	                'Unknown post type "%s".', $type);
	        }

	        $new_post = array(
	            'post_title'   => convert_chars(stripslashes($data['name'])),
	            'post_content' => (!empty($data['description'])? wpautop(convert_chars(stripslashes($data['description']))): ''),
	            'post_status'  => $opt_draft,
	            'post_type'    => $type,
	            'post_name'    => sanitize_title($data['name']),
	            'post_author'  => $this->get_author_id(),
	        );
	       
	        // create!
	        $id = wp_insert_post($new_post);
	       
	        return $id;
		}
		function get_author_id() {
			$current_user = wp_get_current_user();
	        return (($current_user instanceof WP_User)) ? $current_user->ID : 0;
	    }
	    function create_custom_fields($post_id, $field, $value, $type='add') {       
	        if($type=='add')
	        	add_post_meta($post_id, $field, $value);
	        else
	        	update_post_meta($post_id, $field, $value);
	    }
	    function get_imported_event_ids($type='fb'){
	    	$events = new WP_Query(array(
	    		'post_type'=>'ajde_events',
	    		'posts_per_page'=>-1,
	    		'meta_key'=>'evosy_'.$type,
	    	));

	    	$imported = array();
	    	if(!$events->have_posts())
	    		return false;

	    	while($events->have_posts()): $events->the_post();	    		
	    		$sy_fb = get_post_meta($events->post->ID,'evosy_'.$type,true);
	    		if(!empty( $sy_fb))
	    			$imported[$events->post->ID] = $sy_fb;
    		endwhile;
    		wp_reset_postdata();

    		return $imported;	    	
	    }

	    // save event custom post meta data
	    function save_event_post_data($post_id, $event, $type='add'){
	    	// save event time
			$event_time = $this->get_event_dates($event);
			if(!empty($event_time)){						
				// save required start time variables
				$this->create_custom_fields($post_id, 'evcal_srow', $event_time['unix_start'], $type);
				$this->create_custom_fields($post_id, 'evcal_erow', $event_time['unix_end'], $type);	
			}					

			// event image
				if(!empty($event['event_picture_url'])){
					$img = $this->upload_image($event['event_picture_url'], $event['name']);
					if($img && is_array($img)){
						$thumbnail = set_post_thumbnail($post_id, $img[0]);
					}
				}

			// event location
				if(isset($event['place'])){
					$this->create_custom_fields($post_id, 'evcal_location', $event['place'], $type);
				}
				if(isset($event['latitude'])){
					$this->create_custom_fields($post_id, 'evcal_lat', $event['latitude'], $type);
				}
				if(isset($event['longitude'])){
					$this->create_custom_fields($post_id, 'evcal_lon', $event['longitude'], $type);
				}

			// learn more link
				if(isset($event['link'])){
					$this->create_custom_fields($post_id, 'evcal_lmlink', $event['link'], $type);
				}
	    }

	    function get_event_dates($event){
	    	if(empty($event['start_time']))
	    		return false;

	    	$time_st1 = explode('T', $event['start_time']);
			
			$start_time_h = (int)substr($time_st1[1], 0, 2);
			$start_time_m = substr($time_st1[1], 2, 4);
			$start_time_h = ($start_time_h>=12)?
				$start_time_h:$start_time_h-12;
			$start_time_am = ($start_time_h>12)?'am':'pm';

			// end time
			$end_time = !empty($event['end_time'])? 
				$event['end_time']: $event['start_time'];

			$time_st2 = explode('T', $end_time);
			$end_time_h = (int)substr($time_st2[1], 0, 2);
			$end_time_m = substr($time_st2[1], 2, 4);
			$end_time_h = ($end_time_h>=12)?
				$end_time_h:$end_time_h-12;
			$end_time_am = ($end_time_h>12)?'am':'pm';

			$date_array = array(
				'evcal_start_date'=>$time_st1[0],
				'evcal_start_time_hour'=>$start_time_h,
				'evcal_start_time_min'=>$start_time_m,
				'evcal_st_ampm'=>$start_time_am,

				'evcal_end_date'=>$time_st2[0],
				'evcal_end_time_hour'=>$end_time_h,
				'evcal_end_time_min'=>$end_time_m,
				'evcal_et_ampm'=>$end_time_am,
			);
			
			return eventon_get_unix_time($date_array, 'Y-m-d');
	    }

	    // upload and return event featured image
	    function upload_image($url, $event_name){
	    	if(empty($url))
	    		return false;

	    	// Download file to temp location
		      $tmp = download_url( $url );

		      // Set variables for storage
		      // fix file filename for query strings
		      preg_match( '/[^\?]+\.(jpe?g|jpe|gif|png)\b/i', $url, $matches );
		      $file_array['name'] = basename($matches[0]);
		      $file_array['tmp_name'] = $tmp;

		      // If error storing temporarily, unlink
		      if ( is_wp_error( $tmp ) ) {
		         @unlink($file_array['tmp_name']);
		         $file_array['tmp_name'] = '';
		      }

		      // do the validation and storage stuff
		      $post_id=0;
		      $desc="Featured image for '$event_name'";
		      $id = media_handle_sideload( $file_array, $post_id, $desc );
		      // If error storing permanently, unlink
		      if ( is_wp_error($id) ) {
		         @unlink($file_array['tmp_name']);
		         return false;
		      }

		      $src = wp_get_attachment_url( $id );
		      return array(0=>$id,1=>$src);

	    }

	    /** function to verify wp nonce and the $_POST array submit values	 */
			function csv_verify_nonce_post($post_field){
				global $_POST, $eventon_sy;

				if(isset( $_POST ) && !empty($_POST[$post_field]) && $_POST[$post_field]  ){
					if ( wp_verify_nonce( $_POST[$post_field],  $eventon_sy->plugin_path )){
						return true;
					}else{	
						$this->log['error'][] =__("Could not verify submission. Please try again.",'eventon');
						$this->print_messages();
						return false;	}
				}else{	
					$this->log['error'][] =__("Could not verify submission. Please try again.",'eventon');
					$this->print_messages();
					return false;	
				}
			}

		/** Print the messages for the csv settings	 */
			function print_messages(){
				if (!empty($this->log)) {
					
					if (!empty($this->log['error'])): ?>
					
					<div class="error">
						<?php foreach ($this->log['error'] as $error): ?>
							<p class=''><?php echo $error; ?></p>
						<?php endforeach; ?>
					</div>			
					<?php endif; ?>
					
					
					<?php if (!empty($this->log['notice'])): ?>
					<div class="updated fade">
						<?php foreach ($this->log['notice'] as $notice): ?>
							<p><?php echo $notice; ?></p>
						<?php endforeach; ?>
					</div>
					<?php endif; 
								
					$this->log = array();
				}
			}

	// GOOGLE CALENDAR get events
		function get_gg_events(){
			$options = $this->options;

			include(__DIR__.'/google/Google/autoload.php');
			$client = new Google_Client();
			$client->setApplicationName('My Calendar');
			$client->setDeveloperKey($options['evosy_gg_apikey']);

			$cal = new Google_Service_Calendar($client);

			$calendar_id = $options['evosy_gg_calid'];
			$params = array(
				'singleEvents'=>true,
				'orderBy'=>'startTime',
				'timeMin'=> date(DateTime::ATOM),// only pull events starting today
				//'maxResults'=>7 // only use this to limit number of events pulled
			);

			$events = $cal->events->listEvents($calendar_id, $params);

			$calTimeZone = $events->timeZone;
			date_default_timezone_set($calTimeZone);

			$calendar_events = $events->getItems();

			if(empty($calendar_events))
				echo "<p class='msg'>No events available for fetching from google calendar!</p>";

			// attach event data to this array
			$_fetchedEvent = array();

			// for each event
			// data sources
			// https://developers.google.com/google-apps/calendar/v3/reference/events#resource
			$count = 0;
			foreach($calendar_events as $event){

				// append event data to array
					$_fetchedEvent[$count]['id'] = $event->id;
					$_fetchedEvent[$count]['name'] = $event->summary;
					
					if(isset($event->description))
						$_fetchedEvent[$count]['description'] = $event->description;
					
					if(isset($event->location))
						$_fetchedEvent[$count]['place'] = $event->location;

					$eventDateStr = $event->start->dateTime;
					$_fetchedEvent[$count]['start_time'] = (!empty($eventDateStr))?
						$eventDateStr : $event->start->date;

					if(isset($event->end)){
						$_fetchedEvent[$count]['end_time'] = (!empty($event->end->dateTime)? $event->end->dateTime: 
							$event->end->date);
					}

					$_fetchedEvent[$count]['link'] = $event->htmlLink;

					if(isset($event->organizer))
						$_fetchedEvent[$count]['organizer'] = $event->organizer->displayName;

				//print_r($event);
				$count++;
			}

			if(!empty($_fetchedEvent))
				$this->display_events($_fetchedEvent, 'gg');
		}

	// FACEBOOK get events
		// get events from event ids
			function fb_get_events_from_ids($fb_app_id, $fb_secret, $facebook_session=0){
				$ret = '';

				$options = $this->options;
				$event_ids = $options['evosy_fb_eventids'];

				if(empty($event_ids))
					return false;

				$events =  $this->process_ids($event_ids);

				foreach($events as $event_id){
					$event = $this->get_fb_event($fb_app_id, $fb_secret, $event_id, $facebook_session);

		            if ($event)
		               $ret[]=$event;
				}
				return $ret;
			}

		// get individual facebook event from event ID
			function get_fb_event($fb_app_id, $fb_secret, $event_id, $facebook_session=0){
				if (empty($fb_app_id) || empty($fb_secret) || empty($event_id))
		      		return false;

		      	FacebookSession::setDefaultApplication($fb_app_id,$fb_secret);

			   	if (!$facebook_session)
			      	$facebook_session = FacebookSession::newAppSession();

			    // accept both event id and https://www.facebook.com/events/<event_id>
			   		$event_id=preg_replace('/^.*facebook.com\/events\//','',$event_id);
			   		$event_id=preg_replace('/\/.*$/','',$event_id);


			   	$fields=array("fields"=>"id,name,place,start_time,end_time,description,cover");

			   	$__event_bok = '/'.$event_id;
			   	
			   	try{
			   		$event_sec = (new FacebookRequest( $facebook_session, 'GET', $__event_bok, $fields) )->execute();
			   	}catch (FacebookRequestException $ex) {
				  	//echo $ex->getMessage();
				  	echo "<p class='sync_msg'>Event ID: {$event_id} does not have proper permission for fetching data.</p>";
				} catch (\Exception $ex) {
				  	echo $ex->getMessage();
				}

				if(empty($event_sec)) return false;

			   	$event = $event_sec->getGraphObject()->asArray();

			   	if (isset($event['cover']) && !empty($event['cover'])) {
			      	$event['event_picture_url']=$event['cover']->source;
			   	} else {
			   		$picture_sec = new FacebookRequest( $facebook_session, 'GET', '/'.$event_id.'/picture', array ('redirect' => false,'type' => 'normal'));
			      	$picture = $picture_sec->execute()->getGraphObject()->asArray();
			      	if (!empty($picture) && is_object($picture) && $picture->url) {
			         	$event['event_picture_url']=$picture->url;
			      	}
			   	}

			   	$STRLEN = strlen($event['start_time']);
			   	$DATEFORMAT = ($STRLEN>10)? 'Y-m-d\TH:i:sO': 'Y-m-d';

			   	$myDateTime = DateTime::createFromFormat($DATEFORMAT, $event['start_time']);
			   	$eventstart = $myDateTime->format('U');

			   	$event['link'] = 'https://www.facebook.com/events/'.$event_id;

			   	if($eventstart > time())
			      	return $event;
			   	else
		      		return false;
			}
			function get_fb_events($api_id, $api_secret, $eme_sfe_uids, $facebook_session=0){
				if (empty($api_id) || empty($api_secret) || empty($eme_sfe_uids))
			      	return false;

			    // initialize
			   	FacebookSession::setDefaultApplication($api_id,$api_secret);

			   	if (!$facebook_session)
			      	$facebook_session = FacebookSession::newAppSession();

			   	$ret = array();
			   	foreach ($eme_sfe_uids as $key => $value) {
			      	if ($value!='') {
			      		$events_sec = new FacebookRequest( $facebook_session, 'GET', '/'.$value.'/events');
			         	$events = $events_sec->execute();
			         	foreach ($events->getGraphObjectList() as $graphobject) {

				            $event_id = $graphobject->getProperty('id');
				            
				            $event = $this->get_fb_event($api_id, $api_secret, $event_id, $facebook_session);

				            if ($event)
				               $ret[]=$event;
				           	
			         	}
			      	}
			   	}
			   	return $ret;
			}

	// SUPPRORTING
		//process string ids into an array
			function process_ids($ids){
				if(empty($ids))
					return false;

				$uids = str_replace(' ', '', $ids);
				if(strpos($uids, ',')=== false){
					$uids = array($uids);
				}else{
					$uids = explode(',', $uids);
				}
				return $uids;
			}
}
new evosy_settings();

?>