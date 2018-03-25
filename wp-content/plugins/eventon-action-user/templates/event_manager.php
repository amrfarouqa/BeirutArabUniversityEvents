<?php
/** 
 * Event Manager for frontend user submitted events
 * @version 0.1
 * @author  AJDE
 *
 * You can copy this template file and place it in ...wp-content/themes/<--your-theme-name->/eventon/actionuser/ folder 
 * and edit that file to customize this template.
 * This sub content template will use default page.php template from your theme and the below
 * content will be placed in content area of the page template.
 */
	echo "<h2>".__('My Eventon Events Manager','eventon')."</h2>";
	if(!is_user_logged_in()){
		echo "<p>Login required to manage your submitted events. <br/><a href='".wp_login_url($current_page_link)."' class='evcal_btn evoau'><i class='fa fa-user'></i> ".__('Login Now','eventon')."</a></p>";
		return;
	}

	$EVOAU_fcnt  = $eventon_au->frontend->functions;
?>

Hello <?php echo $current_user->display_name?>. From your event manager dashboard you can view your submitted events and manage them in here.

<?php
	if(isset($_REQUEST['action']) && $_REQUEST['action']=='edit' && !empty($_REQUEST['eid'])):
		$BACKLINK = str_replace('action=edit', '', $current_page_link);
		echo "<p><a class='evcal_btn evoau' href='".($BACKLINK)."'><i class='fa fa-angle-left'></i> ".__('Back to my events','eventon')."</a></p>";
		$eventon_au->frontend->get_submission_form($_REQUEST['eid']);
	else:

		// trash event
		if(isset($_REQUEST['action']) && $_REQUEST['action']=='delete' && !empty($_REQUEST['eid'])){
			$status =	$EVOAU_fcnt->trash_event($_REQUEST['eid']);
			$eventname = get_the_title($_REQUEST['eid']);
			echo "<h3 class='evoauem_del_msg' style='background-color: #B3D488;color: #fff;'>".( ($status)? $eventname.' Deleted!':'Could not delete event.')."</h3>";
		}
?>

<h3><?php _e('Submitted Events','eventon');?></h3>
<?php	
	$events = $eventon_au->frontend->get_user_events($current_user->ID);	

	if($events){
		echo "<div class='eventon_actionuser_eventslist'>";
		foreach($events as $eventid=>$evv){
			// edit button html
				$edit_html = (!$EVOAU_fcnt->can_edit_event($eventid))?'':"<a class='fa fa-pencil editEvent' href='{$current_page_link}?action=edit&eid={$eventid}'></a>";
			// delete button html
				$delete_html = (!$EVOAU_fcnt->can_delete_event())?'':"<a class='fa fa-trash deleteEvent' href='{$current_page_link}?action=delete&eid={$eventid}'></a>";

			echo "<p>".$evv[0]." {$edit_html} {$delete_html}<span>Status: {$evv[1]}</span></p>";
		}
		echo "</div>";
	}
	endif;
?>