<?php

/**
  * Building Menu and submenu array
  */
$pix_dialog = 	
'<div id="pix-dialog" class="pix-dialog">
	<div class="pix-content">
		<a class="close" href="#" title="Close"><span class="media-modal-icon"></span></a>
		<div class="title"><h2>Demo Title</h2></div>
		<div class="options"></div>
		<div class="footer">
			<a href="#" class="button media-button button-primary button-large media-button-insert">Insert Shortcode</a>
		</div>
	<div>
</div>';

//require_once(THEME_ADMIN_EDITOR . "/shortcodes/layouts.php");

$pix_menu = array();


$pix_menu[] = array( 	
				"title"		=> "Emphasis",	//Menu Title
				"name"		=> "emphasis",		//shortcode Name
				"insertType" => "popup"	
					);			
					
$pix_menu[] = array( 	
				"title"		=> "Dropcaps",	
				"name"		=> "dropcaps",		
				"insertType" => "popup"
					);	

$pix_menu[] = array( 	
				"title"		=> "BlockQuote",	//Menu Title
				"name"		=> "quote",		//shortcode Name
				"insertType" => "popup"	
					);

$pix_menu[] = array( 	
				"title"		=> "ToolTip",	//Menu Title
				"name"		=> "tooltip",		//shortcode Name
				"insertType" => "popup"	
					);

$pix_menu[] = array( 	
				"title"		=> "Highlight",	
				"name"		=> "highlight",		
				"insertType" => "instant",
				"selText" 	=> true
					);