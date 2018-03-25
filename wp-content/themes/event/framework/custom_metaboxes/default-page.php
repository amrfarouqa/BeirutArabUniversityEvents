<?php

/***********************************************
	Portfolio (List) Page Metabox
*************************************************/

//Meta Box


function page_options(){
	add_meta_box('pix_page_options', 'Page Options', 'pix_page_options_cb', 'page', 'normal','low');	
}
add_action('add_meta_boxes', 'page_options');

//Displaying Meta Box
function pix_page_options_cb($post)
{
	global $post;
	$meta = array();

	$meta = get_post_meta($post->ID,'event_on_page_options',false);
	if( !empty($meta) )
		extract($meta[0]);
	
	//Set Defaults

	$sidebar_position = isset($sidebar_position) ? $sidebar_position : "full_width";
	$selected_sidebar_replacement = isset($selected_sidebar_replacement) ? $selected_sidebar_replacement : '0';

	//Sub Header
	$display_header = isset($display_header) ? $display_header : 'show';
	$header_breadcrumbs = isset($header_breadcrumbs) ? $header_breadcrumbs : 'show';

	//Nonce Field
	wp_nonce_field(__FILE__, 'pix_nonce');


	/**
	 * Sub Header Fields
	 */
	//Default Page Options - Header

echo '<div id="PageOptions" class="verticalTab">';
	echo '<ul class="resp-tabs-list">
		<li class="tab-subpage">'.__('Sub Page Header Options','innwit'). '</li>
		<li class="tab-pagelayout">'.__('Page Layout Options','innwit'). '</li>
	</ul>';

		echo '<div class="resp-tabs-container">';
			echo '<div class="clearfix">';

				echo '<div class="header-options">';


					//Sub Header hide
					echo '<div id="pix-header-size" class="float-clear">';
						echo '<div class="pix-pull-left">';
							echo '<h5 class="pix-sub-title">'.__('Sub Header:','innwit'). '</h5>';
							echo '<p>'.__('Changes this to hide/show sub header','innwit').'</p>';
						echo '</div>';

						echo '<div class="select-style on-off-switch">';
							echo '<select class="display-header pix-switch" name="display_header" id="display_header">';
								echo '<option selected value="show"'. (($display_header == "show") ? ' selected="selected"' : ''). '>' . 'Show'. '</option>';
								echo '<option value="hide"'. (($display_header == "hide") ? ' selected="selected"' : ''). '>' . 'Hide'. '</option>';
							echo '</select>';
						echo '</div>';
					echo '</div>';

					$sub_style = '';
					if ($display_header == 'hide'){
						$sub_style = ' style="display:none";';
					}

					
					echo '</div>';


				echo '</div>';


				echo '<div>';
				
					/* Layout Setting */
					
					echo '<div id="pix-layout-options">';
						//Layout Settings
						echo '<h5 class="pix-sub-title">'.__('Layout Settings:','innwit'). '</h5>';
						echo '<p>'.__('Choose Layout for this page','innwit');
						echo '<ul class="sidebar_position">';

							echo '<li>';
							echo '<input type="radio" name="sidebar_position"' . ((isset($sidebar_position) && $sidebar_position=="full_width") ? "checked" : '') .' value="full_width">';
							echo '<a href="#"><img src="'.THEME_CUSTOM_METABOXES_URI.'/img/full_width.png" alt="" />
								<i class="icon fa fa-check"></i>
							</a>';
							echo '</li>';

							echo '<li>';
							echo '<input type="radio" name="sidebar_position"' . ((isset($sidebar_position) && $sidebar_position=="no_sidebar") ? "checked" : '') .' value="no_sidebar">';
							echo '<a href="#"><img src="'.THEME_CUSTOM_METABOXES_URI.'/img/no_sidebar.png" alt="" />
								<i class="icon fa fa-check"></i>	
							</a>';
							echo '</li>';

							echo '<li>';
							echo '<input type="radio" name="sidebar_position"' . ((isset($sidebar_position) && $sidebar_position=="left") ? "checked" : '') .' value="left">';
							echo '<a href="#"><img src="'.THEME_CUSTOM_METABOXES_URI.'/img/left_sidebar.png" alt="" />
								<i class="icon fa fa-check"></i>
							</a>';
							echo '</li>';

							echo '<li>';
							echo '<input type="radio" name="sidebar_position"' . ((isset($sidebar_position) && $sidebar_position=="right") ? "checked" : '') .' value="right">';
							echo '<a href="#"><img src="'.THEME_CUSTOM_METABOXES_URI.'/img/right_sidebar.png" alt="" />
								<i class="icon fa fa-check"></i>
							</a>';
							echo '</li>';

						echo '</ul>';
						echo '</p>';

						//Multiple Sidebar
						echo '<div id="select_sidebar" class="float-clear">';
						echo '	<div class="pix-pull-left">';
							echo '<h5 class="pix-sub-title">'.__('Choose Sidebar for this page:','innwit'). '</h5>';
							echo "<p>";
							_e('Please select the sidebar you would like to display on this page. <strong>Note:</strong> You can create the sidebar under Appearance > Sidebars','innwit');
							echo "</p>";
						echo '</div>';

						echo '<div>';
						    global $wp_registered_sidebars;		
						    ?>
						  
							<div class="select-style">
								<select name="selected_sidebar_replacement" class="widefat">
									<option value="0"<?php if($selected_sidebar_replacement == '' && $selected_sidebar_replacement == '0'){ echo " selected";} ?>>Primary Sidebar</option>
									<?php
									
									$sidebar_replacements = $wp_registered_sidebars;//sidebar_generator::get_sidebars();
									
									if(is_array($sidebar_replacements) && !empty($sidebar_replacements)){
										foreach($sidebar_replacements as $sidebar){
											if ($sidebar['id'] != 'primary-sidebar'){
												if($selected_sidebar_replacement == $sidebar['id']){
													echo "<option value='{$sidebar['id']}' selected>{$sidebar['name']}</option>\n";
												}else{
													echo "<option value='{$sidebar['id']}'>{$sidebar['name']}</option>\n";
												}
											}
										}
									}
							
								echo '</select>';
							echo '</div>';
						echo '</div>';

					echo '</div>';

					
			echo '</div>';

		echo '</div>';


echo '</div> ';
}






//Saving Custom Meta Box Values
function saving_page_options(){
	global $post;
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
	
	$pix_nonce = isset($_POST['pix_nonce']) ? $_POST['pix_nonce'] : '';
	$values = array();
	//Security Check Nonce	
	if($_POST && wp_verify_nonce($pix_nonce, __FILE__)){

		if(	isset($_POST['sidebar_position']) || 
			isset($_POST['selected_sidebar_replacement']) || 
			isset($_POST['display_header']) ||
			isset($_POST['header_breadcrumbs'])){
			
				$values = array(					
					'sidebar_position' => $_POST['sidebar_position'],
					'selected_sidebar_replacement' => $_POST['selected_sidebar_replacement'],
					'display_header' => $_POST['display_header']
				);
		}

		update_post_meta($post->ID, 'event_on_page_options', $values);
	}


}
add_action('save_post', 'saving_page_options');



