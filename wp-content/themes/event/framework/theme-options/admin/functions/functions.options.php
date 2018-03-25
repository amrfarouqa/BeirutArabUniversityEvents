<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	
	function of_options()
	{
		//Access the WordPress Categories via an Array
		$of_categories 		= array();  
		$of_categories_obj 	= get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
			$of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
		$categories_tmp 	= array_unshift($of_categories, "Select a category:");    
		   
		//Access the WordPress Pages via an Array
		$of_pages 			= array();
		$of_pages_obj 		= get_pages('sort_column=post_parent,menu_order');    
		foreach ($of_pages_obj as $of_page) {
			$of_pages[$of_page->ID] = $of_page->post_name; }
		$of_pages_tmp 		= array_unshift($of_pages, "Select a page:");       
	
		//Ajax Style
		$ajax_style = array("style1" => "Style1","style2" => "Style2", "style3" => "Style3", "style4" => "Style4", "style5" => "Style5", "style6" => "Style6", "style7" => "Style7", "style8" => "Style8", "style9" => "Style9", "style10" => "Style10");

		//Ajax Animation Style
		$ajax_trans_in = array("fadeIn" => "Fade In", "fadeInUp" => "Fade In Up", "fadeInDown" => "Fade In Down", "fadeInLeft" => "Fade In Left", "fadeInRight" => "Fade In Right", "zoomIn" => "Zoom In", "zoomInUp" => "Zoom In Up", "zoomInDown" => "Zoom In Down", "zoomInLeft" => "Zoom In Left", "zoomInRight" => "Zoom In Right");
		$ajax_trans_out = array("fadeOut" => "Fade Out", "fadeOutUp" => "Fade Out Up", "fadeOutDown" => "Fade Out Down", "fadeOutLeft" => "Fade Out Left", "fadeOutRight" => "Fade Out Right", "zoomOut" => "Zoom Out", "zoomOutUp" => "Zoom Out Up", "zoomOutDown" => "Zoom Out Down", "zoomOutLeft" => "Zoom Out Left", "zoomOutRight" => "Zoom Out Right");

		//Preloader Animation Style
		$preloader_trans_in = array("fadeIn" => "Fade In", "fadeInUp" => "Fade In Up", "fadeInDown" => "Fade In Down", "fadeInLeft" => "Fade In Left", "fadeInRight" => "Fade In Right", "zoomIn" => "Zoom In", "zoomInUp" => "Zoom In Up", "zoomInDown" => "Zoom In Down", "zoomInLeft" => "Zoom In Left", "zoomInRight" => "Zoom In Right");

		//Single Portfolio
		$style = array("style1" => "Style1","style2" => "Style2", "style3" => "Style3", "style4" => "Style4", "style5" => "Style5", "style6" => "Style6");

		//Blog & Single Blog & Archives
		$sidebar = array("left_sidebar" => "Left Sidebar","right_sidebar" => "Right Sidebar","full_width" => "Full Width");
		$sidebar_styles = array("style1" => "Style1","style2" => "Style2");

		$animation = array("flash" => "flash", "bounce" => "bounce","shake" => "shake", "tada" => "tada", "swing" => "swing", "wobble" => "wobble", "pulse" => "pulse", "flip" => "flip", "flipInX" => "flipInX", "flipInY" => "flipInY", "fadeIn" => "fadeIn", "fadeInUp" => "fadeInUp", "fadeInDown" => "fadeInDown", "fadeInLeft" => "fadeInLeft", "fadeInRight" => "fadeInRight", "fadeInUpBig" => "fadeInUpBig", "fadeInDownBig" => "fadeInDownBig", "fadeInLeftBig" => "fadeInLeftBig", "fadeInRightBig" => "fadeInRightBig", "slideInDown" => "slideInDown", "slideInLeft" => "slideInLeft", "slideInRight" => "slideInRight", "bounceIn" => "bounceIn", "bounceInUp" => "bounceInUp", "bounceInDown" => "bounceInDown", "bounceInLeft" => "bounceInLeft", "bounceInRight" => "bounceInRight", "rotateIn" => "rotateIn", "rotateInDownLeft" => "rotateInDownLeft","rotateInDownRight" => "rotateInDownRight", "rotateInUpLeft" => "rotateInUpLeft", "rotateInUpRight" => "rotateInUpRight", "lightSpeedIn" => "lightSpeedIn", "hinge" => "hinge", "rollIn" =>"rollIn");

		$order_by = array("date" => "Date","title" => "Title", "rand" => "Random"); 
		$order = array("asc" => "Ascending","desc" => "Descending");
		$sub_header_size = array("small" => "Small","medium" => "Medium","large" => "Large");
		$sub_header_bg_style = array("color" => "Default Background Color","image" => "Background Image","customcolor" => "Custom Background Color");

		//Search Result
		if (class_exists('Woocommerce')) {
			$search_exclude = array("post" => "Post","page" => "Page","product" => "Product","pix_event" => "Event","pix_speaker" => "Speaker","pix_schedule" => "Schedule","pix_gallery" => "Gallery","pix_eventtv" => "Event Tv");
		}
		else {
			$search_exclude = array("post" => "Post","page" => "Page","pix_event" => "Event","pix_speaker" => "Speaker","pix_schedule" => "Schedule","pix_gallery" => "Gallery","pix_eventtv" => "Event Tv");
		}

		//Body & Footer Background Options
		$url =  ADMIN_DIR . 'assets/images/';

		

		//font sizes
		$font_sizes = array();
		for ($i = 9; $i < 50; $i++){ 
			$font_sizes[$i.'px'] = $i.'px'; 
		}

		//Header & Footer widget columns
		$columns = array("col3" => "Three","col4" => "Four");

		//Stylesheets Reader
		$alt_stylesheet_path = LAYOUT_PATH;
		$alt_stylesheets = array();
		
		if ( is_dir($alt_stylesheet_path) ) 
		{
			if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) 
			{ 
				while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) 
				{
					if(stristr($alt_stylesheet_file, ".css") !== false)
					{
						$alt_stylesheets[] = $alt_stylesheet_file;
					}
				}    
			}
		}


		//Background Images Reader
		$bg_images_path = get_stylesheet_directory(). '/images/bg/'; // change this to where you store your bg images
		$bg_images_url = get_template_directory_uri().'/images/bg/'; // change this to where you store your bg images
		$bg_images = array();
		
		if ( is_dir($bg_images_path) ) {
			if ($bg_images_dir = opendir($bg_images_path) ) { 
				while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
					if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
						natsort($bg_images); //Sorts the array into a natural order
						$bg_images[] = $bg_images_url . $bg_images_file;
					}
				}    
			}
		}
		

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr 		= wp_upload_dir();
		$all_uploads_path 	= $uploads_arr['path'];
		$all_uploads 		= get_option('of_uploads');
		$other_entries 		= array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat 		= array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos 			= array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post");

		$theme_color_url =  ADMIN_DIR . 'assets/images/color-bg/'; 

/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();

/*
 * ==================
 * GENERAL OPTIONS
 * ==================
 */

$of_options[] = array( "name" => __("General", "innwit"),
					"type" => "heading");

$of_options[] = array(
					"id" => "introduction",
					"std" => __("<h3 style=\"margin: 0 0 10px;\">Welcome to the Eventon WordPress Responsive Theme.</h3>
					Adjust the options here and change the theme like you want","innwit"),
					"icon" => true,
					"type" => "info");									
					
					
$of_options[] = array( "name" => __("Upload Logo", "innwit"),
					"desc" => __("Upload a custom logo. Height should be within 116px.", "innwit"),
					"id" => "custom_logo",
					"std" => get_template_directory_uri().'/library/img/logo.png',
					"mod" => "min",
					"type" => "media");

$of_options[] = array( "name" => __("Upload Retina Logo", "innwit"),
					"desc" => __("Upload a retina logo. width and should be double size (width X 2 & height X 2) of above (original) logo.", "innwit"),
					"id" => "retina_logo",
					"std" => get_template_directory_uri().'/library/img/retina-logo.png',
					"mod" => "min",
					"type" => "media");


$of_options[] = array( "name" => __("Fav Icon", "innwit"),
					"desc" =>  __("Upload a 16px x 16px Png/Gif image that will represent your website's favicon.", "innwit"),
					"id" => "fav_icon",
					"std" => get_template_directory_uri().'/favicon.png',
					"mod" => "min",
					"type" => "media");
					
$of_options[] = array( "name" => __("Apple Touch Icon", "innwit"),
					"desc" => __("Size: 57x57 for older iPhones, 72x72 for iPads, 114x114 for iPhone4's retina display (IMHO, just go ahead and use the biggest one). Transparency is not recommended (iOS will put a black BG behind the icon)", "innwit"),
					"id" => "apple_touch_icon",
					"std" => get_template_directory_uri().'/library/img/apple-icon-touch.png',
					"mod" => "min",
					"type" => "media");

$of_options[] = array( "name" => __("Search Text", "innwit"),
					"desc" => __("Please Enter Search Text Here.", "innwit"),
					"id" => "search_text",
					"std" => "Search",
					"type" => "text"
					);


$of_options[] = array( "name" => __("Event Slug", "innwit"),
					"desc" => __("Please Enter the slug for Event", "innwit"),
					"id" => "slug_event",
					"std" => "event",
					"type" => "text"
					);

$of_options[] = array( "name" => __("Speaker Slug", "innwit"),
					"desc" => __("Please Enter the slug for Speaker", "innwit"),
					"id" => "slug_speaker",
					"std" => "speaker",
					"type" => "text"
					);

$of_options[] = array( "name" => __("Schedule Slug", "innwit"),
					"desc" => __("Please Enter the slug for Schedule", "innwit"),
					"id" => "slug_schedule",
					"std" => "schedule",
					"type" => "text"
					);


$of_options[] = array( "name" => __("Event TV Slug", "innwit"),
					"desc" => __("Please Enter the slug for Event TV", "innwit"),
					"id" => "slug_eventtv",
					"std" => "eventtv",
					"type" => "text"
					);


$of_options[] = array( "name" => __("Testimonial Slug", "innwit"),
					"desc" => __("Please Enter the slug for Testimonial", "innwit"),
					"id" => "slug_testimonial",
					"std" => "testimonial",
					"type" => "text"
					);

$of_options[] = array( 	"name" 		=> __("Show Go to Top Button", "innwit"),
						"desc" 		=> __("Show/Hide Go to Top Button in the page", "innwit"),
						"id" 		=> "go_to_top",
						"std" 		=> 1,
						"on" 		=> "Enable",
						"off" 		=> "Disable",
						"type" 		=> "switch"
				);
																		  
$of_options[] = array( "name" => __("Custom CSS", "innwit"),
					"desc" => __("Type your custom CSS rules.", "innwit"),
					"id" => "custom_css",
					"std" => "",
					"type" => "textarea");     

				
$of_options[] = array( "name" => __("Google Analytics ID", "innwit"),
					"desc" => __("Paste your Google Analytics ID. Ex:UA-XXXXXX-XX This will be added into the footer template of your theme.", "innwit"),
					"id" => "google_analytics",
					"std" => "",
					"type" => "text");							
													
$of_options[] = array( "name" => __("Tracking Code", "innwit"),
					"desc" => __("Paste your Other tracking code here. This will be added into the footer template of your theme.", "innwit"),
					"id" => "tracking_code",
					"std" => "",
					"type" => "textarea");


/*
 * ==============
 * HEADER OPTIONS
 * ==============
 */

$of_options[] = array( "name" => __("Header Options", "innwit"),
					"type" => "heading");

$of_options[] = array( 	"name" 		=> __("Enable Top Header", "innwit"),
						"desc" 		=> __("Do you want to display top header?", "innwit"),
						"id" 		=> "top_header",
						"std" 		=> 1,
						"on" 		=> "Enable",
						"off" 		=> "Disable",
						"type" 		=> "switch",
						"folds"		=> 1
				);

$of_options[] = array(
					"id" => "introduction",
					"std" => __("<h3 style=\"margin: 0 0 10px;\">Email and Phone Number in Top left</h3>
					Enter the value to display email and phone, Leave it empty if you don't want display","innwit"),
					"icon" => true,
					"type" => "info",
					"fold"		=> "top_header");									
					
					
$of_options[] = array( "name" => __("Email", "innwit"),
					"desc" => __("Please Enter Email address.", "innwit"),
					"id" => "top_email",
					"std" => "info@yoursite.com",
					"type" => "text",
					"fold"		=> "top_header"); 		
					
$of_options[] = array( "name" => __("Telephone", "innwit"),
					"desc" => __("Please Enter Telephone Number.", "innwit"),
					"id" => "top_tel",
					"std" => "+ (009) 123 4567",
					"type" => "text",
					"fold"		=> "top_header"); 									
					

$of_options[] = array( 
					"id" => "introduction",
					"std" => __("<h3 style=\"margin: 0 0 10px;\">Social Networking Icons.</h3>
					Enter the url to display social networking icons you want, Leave it empty if you don't want display", "innwit"),
					"icon" => true,
					"type" => "info",
					"fold"		=> "top_header");									
					
					
$of_options[] = array( "name" => __("Facebook URL", "innwit"),
					"desc" => __("Please Enter Facebook URL, This will display in header.", "innwit"),
					"id" => "top_facebook",
					"std" => "",
					"type" => "text",
					"fold"		=> "top_header"); 					

$of_options[] = array( "name" => __("Twitter", "innwit"),
					"desc" => __("Please Enter Twitter Username, This will display in header.", "innwit"),
					"id" => "top_twitter",
					"std" => "",
					"type" => "text",
					"fold"		=> "top_header");
										
$of_options[] = array( "name" => __("Google Plus URL", "innwit"),
					"desc" => __("Please Enter G+ URL, This will display in header.", "innwit"),
					"id" => "top_gplus",
					"std" => "",
					"type" => "text",
					"fold"		=> "top_header");
										
$of_options[] = array( "name" => __("LinkedIn URL", "innwit"),
					"desc" => __("Enter your full Linkedin URL, This will display in header.", "innwit"),
					"id" => "top_linkedin",
					"std" => "",
					"type" => "text",
					"fold"		=> "top_header");
										
$of_options[] = array( "name" => __("Dribbble URL", "innwit"),
					"desc" => __("Enter your full Dribbble URL, This will display in header.", "innwit"),
					"id" => "top_dribbble",
					"std" => "",
					"type" => "text",
					"fold"		=> "top_header");
										
$of_options[] = array( "name" => __("Flickr URL", "innwit"),
					"desc" => __("Enter your full Flickr URL, This will display in header.", "innwit"),
					"id" => "top_flickr",
					"std" => "",
					"type" => "text",
					"fold"		=> "top_header");
										
$of_options[] = array( "name" => __("Pinterest URL", "innwit"),
					"desc" => __("Enter your full Pinterest URL, This will display in header.", "innwit"),
					"id" => "top_pinterest",
					"std" => "",
					"type" => "text",
					"fold"		=> "top_header");
					
$of_options[] = array( "name" => __("Tumblr URL", "innwit"),
					"desc" => __("Enter your full Tumblr  URL, This will display in header.", "innwit"),
					"id" => "top_tumblr",
					"std" => "",
					"type" => "text",
					"fold"		=> "top_header");
										
$of_options[] = array( "name" => __("RSS URL", "innwit"),
					"desc" => __("Enter your full RSS URL, This will display in header.", "innwit"),
					"id" => "top_rss",
					"std" => "",
					"type" => "text",
					"fold"		=> "top_header");

$of_options[] = array( 	"name" 		=> __("Enable Top Header Cart", "innwit"),
						"desc" 		=> __("Do you want to display top header cart?", "innwit"),
						"id" 		=> "top_header_cart",
						"std" 		=> 1,
						"on" 		=> "Enable",
						"off" 		=> "Disable",
						"type" 		=> "switch"
				);

$of_options[] = array( 	"name" 		=> __("Enable Search Bar", "innwit"),
						"desc" 		=> __("Do you want to display search bar after the menu?", "innwit"),
						"id" 		=> "header_search",
						"std" 		=> 1,
						"on" 		=> "Enable",
						"off" 		=> "Disable",
						"type" 		=> "switch"
				);


/*
 * ============
 * BLOG OPTIONS
 * ============
 */

$of_options[] = array( 	"name" 		=> __("Blog", "innwit"),
						"type" 		=> "heading"
				);


$of_options[] = array( 	"name" 		=> __("Show/Hide Sub Banner in Blog Pages", "innwit"),
						"desc" 		=> __("Do you want to display sub banner in blog page", "innwit"),
						"id" 		=> "b_sub_banner",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"folds"		=> 1,
						"type" 		=> "switch"
				);

$of_options[] = array( 	"name" 		=> __("Blog Title", "innwit"),
						"desc" 		=> __("Type the blog title", "innwit"),
						"id" 		=> "b_title",
						"std" 		=> "Blog",
						"type" 		=> "text",
						"fold" 		=> 'b_sub_banner'
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Breadcrumbs in Blog Pages", "innwit"),
						"desc" 		=> __("Do you want to display breadcrumbs in blog page", "innwit"),
						"id" 		=> "b_breadcrumbs",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold" 		=> 'b_sub_banner'
				);

$of_options[] = array( 	"name" 		=> __("Blog Breadcrumbs", "innwit"),
						"desc" 		=> __("Type the blog breadcrumbs here", "innwit"),
						"id" 		=> "b_breadcrumbs_text",
						"std" 		=> "Blog",
						"type" 		=> "text",
						"fold" 		=> 'b_sub_banner'
				);	
								
$of_options[] = array(  "name" => __("Choose the Registered Sidebar", "innwit"),
						"desc" => __("Please choose the sidebar you have created", "innwit"),
						"id" => "b_select_sidebar",
						"std" => "0",
						"type" => "select_sidebar",
						"hide" => array('blog-sidebar')
				);

$of_options[] = array( 	"name" 		=> __("Sidebar Styles", "innwit"),
						"desc" 		=> __("Choose sidebar style, it applies blog page only.", "innwit"),
						"id" 		=> "b_styles",
						"std" 		=> "style1",
						"type" 		=> "select",
						"options" 	=> $sidebar_styles
				);

$of_options[] = array( 	"name" 		=> __("Blog Sidebar Position", "innwit"),
						"desc" 		=> __("Choose blog sidebar position, it applies blog page only.", "innwit"),
						"id" 		=> "b_sidebar",
						"std" 		=> "left_sidebar",
						"type" 		=> "select",
						"options" 	=> $sidebar
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Meta Section", "innwit"),
						"desc" 		=> __("Do you want to display meta section on blog pages", "innwit"),
						"id" 		=> "b_meta",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"folds" 	=> 1
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Post Format in Meta", "innwit"),
						"desc" 		=> __("Do you want to display post format in meta section", "innwit"),
						"id" 		=> "b_meta_post_format",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold" 		=> 'b_meta'
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Date in Meta", "innwit"),
						"desc" 		=> __("Do you want to display date in meta section", "innwit"),
						"id" 		=> "b_meta_date",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold" 		=> 'b_meta'
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Comments in Meta", "innwit"),
						"desc" 		=> __("Do you want to display comment count in meta section", "innwit"),
						"id" 		=> "b_meta_comment",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold" 		=> 'b_meta'
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Author in Meta", "innwit"),
						"desc" 		=> __("Do you want to display author in meta section", "innwit"),
						"id" 		=> "b_meta_author",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold" 		=> 'b_meta'
				);

$of_options[] = array( 	"name" 		=> __("Excerpt Text Limit", "innwit"),
						"desc" 		=> __("Type the numerical value for the excerpt text", "innwit"),
						"id" 		=> "b_limit",
						"std" 		=> "200",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Read More Button", "innwit"),
						"desc" 		=> __("Do you want to display read more button?", "innwit"),
						"id" 		=> "b_button",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"folds" 	=> 1
				);

$of_options[] = array( 	"name" 		=> __("Read More Button Text", "innwit"),
						"desc" 		=> __("Type the read more button text here", "innwit"),
						"id" 		=> "b_button_text",
						"std" 		=> "Read More",
						"type" 		=> "text",
						"fold" 		=> 'b_button'
				);


/*
 * ===================
 * SINGLE BLOG OPTIONS
 * ===================
 */

$of_options[] = array( 	"name" 		=> __("Single Blog", "innwit"),
						"type" 		=> "heading"
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Sub Banner in Single Post", "innwit"),
						"desc" 		=> __("Do you want to display sub banner in single post", "innwit"),
						"id" 		=> "s_sub_banner",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch"
				);
								
$of_options[] = array( "name" => __("Choose the Registered Sidebar", "innwit"),
					"desc" => __("Please choose the sidebar you have created", "innwit"),
					"id" => "s_select_sidebar",
					"std" => "0",
					"type" => "select_sidebar",
					"hide" => array('blog-sidebar')
				);

$of_options[] = array( 	"name" 		=> __("Sidebar Styles", "innwit"),
						"desc" 		=> __("Choose sidebar style, it applies single post only.", "innwit"),
						"id" 		=> "s_styles",
						"std" 		=> "style1",
						"type" 		=> "select",
						"options" 	=> $sidebar_styles
				);

$of_options[] = array( 	"name" 		=> __("Sidebar Position", "innwit"),
						"desc" 		=> __("Choose Single post sidebar position, it applies single post only.", "innwit"),
						"id" 		=> "s_sidebar",
						"std" 		=> "left_sidebar",
						"type" 		=> "select",
						"options" 	=> $sidebar
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Meta Section", "innwit"),
						"desc" 		=> __("Do you want to display meta section?", "innwit"),
						"id" 		=> "s_meta",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"folds" 	=> 1
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Post Format in Meta", "innwit"),
						"desc" 		=> __("Do you want to display post format in meta section", "innwit"),
						"id" 		=> "s_meta_post_format",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold" 		=> 's_meta'
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Date in Meta", "innwit"),
						"desc" 		=> __("Do you want to display date in meta section", "innwit"),
						"id" 		=> "s_meta_date",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold" 		=> 's_meta'
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Comments in Meta", "innwit"),
						"desc" 		=> __("Do you want to display comment count in meta section", "innwit"),
						"id" 		=> "s_meta_comment",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold" 		=> 's_meta'
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Author in Meta", "innwit"),
						"desc" 		=> __("Do you want to display author in meta section", "innwit"),
						"id" 		=> "s_meta_author",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold" 		=> 's_meta'
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Comments", "innwit"),
						"desc" 		=> __("Do you want to display Comments", "innwit"),
						"id" 		=> "s_comment",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"folds"		=> 1,
						"type" 		=> "switch"
				);

$of_options[] = array( 	"name" 		=> __("Comment Title", "innwit"),
						"desc" 		=> __("Type the comment title", "innwit"),
						"id" 		=> "s_comment_title",
						"std" 		=> "Comment",
						"type" 		=> "text",
						"fold" 		=> 's_comment'
				);

$of_options[] = array( 	"name" 		=> __("Leave a Comments", "innwit"),
						"desc" 		=> __("Type the Leave a comments title", "innwit"),
						"id" 		=> "s_leave_comment_title",
						"std" 		=> "Leave a Comments",
						"type" 		=> "text",
						"fold" 		=> 's_comment'
				);

$of_options[] = array( 	"name" 		=> __("Comment Button Text", "innwit"),
						"desc" 		=> __("Type the comment button text here", "innwit"),
						"id" 		=> "s_comment_button_text",
						"std" 		=> "Add Comment",
						"type" 		=> "text",
						"fold" 		=> 's_comment'
				);




/*
 * ================	
 * ARCHIVES OPTIONS
 * ================
 */

$of_options[] = array( 	"name" 		=> __("Archives", "innwit"),
						"type" 		=> "heading"
				);



$of_options[] = array( 	"name" 		=> __("Show/Hide Sub Banner in Archives Pages", "innwit"),
						"desc" 		=> __("Do you want to display sub banner in Archives page", "innwit"),
						"id" 		=> "a_sub_banner",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch"
				);
								
$of_options[] = array( "name" => __("Choose the Registered Sidebar", "innwit"),
					"desc" => __("Please choose the sidebar you have created", "innwit"),
					"id" => "a_select_sidebar",
					"std" => "0",
					"type" => "select_sidebar",
					"hide" => array('blog-sidebar')
				);

$of_options[] = array( 	"name" 		=> __("Sidebar Styles", "innwit"),
						"desc" 		=> __("Choose sidebar style, it applies Archives page only.", "innwit"),
						"id" 		=> "a_styles",
						"std" 		=> "style1",
						"type" 		=> "select",
						"options" 	=> $sidebar_styles
				);

$of_options[] = array( 	"name" 		=> __("Blog Sidebar Position", "innwit"),
						"desc" 		=> __("Choose Archives sidebar position, it applies Archives page only.", "innwit"),
						"id" 		=> "a_sidebar",
						"std" 		=> "left_sidebar",
						"type" 		=> "select",
						"options" 	=> $sidebar
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Meta Section", "innwit"),
						"desc" 		=> __("Do you want to display meta section on Archives pages", "innwit"),
						"id" 		=> "a_meta",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"folds" 	=> 1
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Post Format in Meta", "innwit"),
						"desc" 		=> __("Do you want to display post format in meta section", "innwit"),
						"id" 		=> "a_meta_post_format",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold" 		=> 'a_meta'
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Date in Meta", "innwit"),
						"desc" 		=> __("Do you want to display date in meta section", "innwit"),
						"id" 		=> "a_meta_date",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold" 		=> 'a_meta'
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Comments in Meta", "innwit"),
						"desc" 		=> __("Do you want to display comment count in meta section", "innwit"),
						"id" 		=> "a_meta_comment",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold" 		=> 'a_meta'
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Author in Meta", "innwit"),
						"desc" 		=> __("Do you want to display author in meta section", "innwit"),
						"id" 		=> "a_meta_author",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold" 		=> 'a_meta'
				);

$of_options[] = array( 	"name" 		=> __("Excerpt Text Limit", "innwit"),
						"desc" 		=> __("Type the numerical value for the excerpt text", "innwit"),
						"id" 		=> "a_limit",
						"std" 		=> "200",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Read More Button", "innwit"),
						"desc" 		=> __("Do you want to display read more button?", "innwit"),
						"id" 		=> "a_button",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"folds" 	=> 1
				);

$of_options[] = array( 	"name" 		=> __("Read More Button Text", "innwit"),
						"desc" 		=> __("Type the read more button text here", "innwit"),
						"id" 		=> "a_button_text",
						"std" 		=> "Read More",
						"type" 		=> "text",
						"fold" 		=> 'a_button'
				);

/*
 * ======================	
 *  SEARCH PAGE SETTING
 * ======================
 */

$of_options[] = array( 	"name" 		=> __("Search Page", "innwit"),
						"type" 		=> "heading"
				);

$of_options[] = array( 	"name" 		=> __("Search Exclude", "innwit"),
						"desc" 		=> __("Exclude Search result here", "innwit"),
						"id" 		=> "search_exclude",
						"std" 		=> array(),
						"type" 		=> "multicheck",
						"options" 	=> $search_exclude
				);	


$of_options[] = array( 	"name" 		=> __("Show/Hide Sub Banner in Archives Pages", "innwit"),
						"desc" 		=> __("Do you want to display sub banner in search page", "innwit"),
						"id" 		=> "search_sub_banner",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch"
				);
								
$of_options[] = array( "name" => __("Choose the Registered Sidebar", "innwit"),
					"desc" => __("Please choose the sidebar you have created", "innwit"),
					"id" => "search_select_sidebar",
					"std" => "0",
					"type" => "select_sidebar",
					"hide" => array('blog-sidebar')
				);

$of_options[] = array( 	"name" 		=> __("Sidebar Styles", "innwit"),
						"desc" 		=> __("Choose sidebar style, it applies search page only.", "innwit"),
						"id" 		=> "search_styles",
						"std" 		=> "style1",
						"type" 		=> "select",
						"options" 	=> $sidebar_styles
				);

$of_options[] = array( 	"name" 		=> __("Search Sidebar Position", "innwit"),
						"desc" 		=> __("Choose Archives sidebar position, it applies search page only.", "innwit"),
						"id" 		=> "search_sidebar",
						"std" 		=> "left_sidebar",
						"type" 		=> "select",
						"options" 	=> $sidebar
				);

$of_options[] = array( 	"name" 		=> __("Excerpt Text Limit", "innwit"),
						"desc" 		=> __("Type the numerical value for the excerpt text", "innwit"),
						"id" 		=> "search_limit",
						"std" 		=> "200",
						"type" 		=> "text"
				);


/*
 * ============
 *  EVENT TV
 * ============
 */

$of_options[] = array( 	"name" 		=> __("Event Tv", "innwit"),
						"type" 		=> "heading"
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Sub Banner in Event Tv Pages", "innwit"),
						"desc" 		=> __("Do you want to display sub banner in Event Tv page", "innwit"),
						"id" 		=> "tv_sub_banner",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch"
				);

$of_options[] = array( 	"name" 		=> __("Number of Videos per page", "innwit"),
						"desc" 		=> __("Type the numerical value for the excerpt text", "innwit"),
						"id" 		=> "tv_no_videos",
						"std" 		=> 8,
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Meta Section", "innwit"),
						"desc" 		=> __("Do you want to display meta section on Event Tv pages", "innwit"),
						"id" 		=> "tv_meta",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"folds" 	=> 1
				);


$of_options[] = array( 	"name" 		=> __("Show/Hide Date in Meta", "innwit"),
						"desc" 		=> __("Do you want to display date in meta section", "innwit"),
						"id" 		=> "tv_meta_date",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold" 		=> 'tv_meta'
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Author in Meta", "innwit"),
						"desc" 		=> __("Do you want to display author in meta section", "innwit"),
						"id" 		=> "tv_meta_author",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold" 		=> 'tv_meta'
				);

$of_options[] = array( 	"name" 		=> __("Excerpt Text Limit", "innwit"),
						"desc" 		=> __("Type the numerical value for the excerpt text", "innwit"),
						"id" 		=> "tv_limit",
						"std" 		=> 200,
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Read More Button", "innwit"),
						"desc" 		=> __("Do you want to display read more button?", "innwit"),
						"id" 		=> "tv_btn",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"folds" 	=> 1
				);

$of_options[] = array( 	"name" 		=> __("Read More Button Text", "innwit"),
						"desc" 		=> __("Type the read more button text here", "innwit"),
						"id" 		=> "tv_btn_text",
						"std" 		=> "Read More",
						"type" 		=> "text",
						"fold" 		=> "tv_btn",
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Share/Like and Comment", "innwit"),
						"desc" 		=> __("Do you want to display share/like and comment?", "innwit"),
						"id" 		=> "tv_share_like",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"folds" 	=> 1
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Share", "innwit"),
						"desc" 		=> __("Do you want to display share?", "innwit"),
						"id" 		=> "tv_share",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold" 		=> "tv_share_like"
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Like", "innwit"),
						"desc" 		=> __("Do you want to display like?", "innwit"),
						"id" 		=> "tv_like",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold" 		=> "tv_share_like"
				);


/*
 * ===================	
 *  SINGLE EVENT TV
 * ===================
 */

$of_options[] = array( 	"name" 		=> __("Single Event Tv", "innwit"),
						"type" 		=> "heading"
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Sub Banner in Event Tv Pages", "innwit"),
						"desc" 		=> __("Do you want to display sub banner in Single Event Tv page", "innwit"),
						"id" 		=> "s_tv_sub_banner",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch"
				);


$of_options[] = array( 	"name" 		=> __("Show/Hide Meta Section", "innwit"),
						"desc" 		=> __("Do you want to display meta section on Single Event Tv pages", "innwit"),
						"id" 		=> "s_tv_meta",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"folds" 	=> 1
				);


$of_options[] = array( 	"name" 		=> __("Show/Hide Date in Meta", "innwit"),
						"desc" 		=> __("Do you want to display date in meta section", "innwit"),
						"id" 		=> "s_tv_meta_date",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold" 		=> 's_tv_meta'
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Author in Meta", "innwit"),
						"desc" 		=> __("Do you want to display author in meta section", "innwit"),
						"id" 		=> "s_tv_meta_author",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold" 		=> 's_tv_meta'
				);

$of_options[] = array( 	"name" 		=> __("Description title", "innwit"),
						"desc" 		=> __("Type the description title http_get_request_body(oid)", "innwit"),
						"id" 		=> "s_tv_title",
						"std" 		=> "About Video",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> __("Excerpt Text Limit", "innwit"),
						"desc" 		=> __("Type the numerical value for the excerpt text", "innwit"),
						"id" 		=> "s_tv_limit",
						"std" 		=> "200",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Share", "innwit"),
						"desc" 		=> __("Do you want to display meta section on Single Event Tv pages", "innwit"),
						"id" 		=> "s_tv_share",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"folds" 	=> 1
				);

$of_options[] = array( 	"name" 		=> __("Share Title", "innwit"),
						"desc" 		=> __("Type the share title here", "innwit"),
						"id" 		=> "s_tv_share_title",
						"std" 		=> "Share",
						"type" 		=> "text",
						"fold" 		=> "s_tv_share"
				);

$of_options[] = array( 	"name" 		=> __("Show Facebook Share", "innwit"),
						"desc" 		=> __("Do you want to display facebook share option", "innwit"),
						"id" 		=> "s_tv_facebook",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold" 		=> "s_tv_share"
				);

$of_options[] = array( 	"name" 		=> __("Show Twitter Share", "innwit"),
						"desc" 		=> __("Do you want to display twitter share option", "innwit"),
						"id" 		=> "s_tv_twitter",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold" 		=> "s_tv_share"
				);

$of_options[] = array( 	"name" 		=> __("Show google plus Share", "innwit"),
						"desc" 		=> __("Do you want to display google plus share option", "innwit"),
						"id" 		=> "s_tv_google_plus",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold" 		=> "s_tv_share"
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Recent & popular Tab", "innwit"),
						"desc" 		=> __("Do you want to display recent and popular tabbed panel", "innwit"),
						"id" 		=> "s_tv_recent_popular",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"folds" 	=> 1
				);


$of_options[] = array( 	"name" 		=> __("Number of Videos", "innwit"),
						"desc" 		=> __("How many videos you want to show in the list", "innwit"),
						"id" 		=> "s_tv_no_videos",
						"std" 		=> 4,
						"type" 		=> "text",
						"fold" 		=> "s_tv_recent_popular"
				);


$of_options[] = array( 	"name" 		=> __("Show/Hide Recent & popular Tab Meta Section", "innwit"),
						"desc" 		=> __("Do you want to display meta section on Single Event Tv pages", "innwit"),
						"id" 		=> "s_tv_post_meta",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold" 		=> "s_tv_recent_popular"
				);


$of_options[] = array( 	"name" 		=> __("Show/Hide Author in Meta", "innwit"),
						"desc" 		=> __("Do you want to display author in meta section", "innwit"),
						"id" 		=> "s_tv_post_meta_author",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold" 		=> "s_tv_recent_popular"
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Date in Meta", "innwit"),
						"desc" 		=> __("Do you want to display date in meta section", "innwit"),
						"id" 		=> "s_tv_post_meta_date",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold" 		=> "s_tv_recent_popular"
				);


$of_options[] = array( 	"name" 		=> __("Excerpt Recent & popular Tab Text Limit", "innwit"),
						"desc" 		=> __("Type the numerical value for the excerpt text", "innwit"),
						"id" 		=> "s_tv_post_limit",
						"std" 		=> 200,
						"type" 		=> "text",
						"fold" 		=> "s_tv_recent_popular"
				);


$of_options[] = array( 	"name" 		=> __("Show/Hide Read More Button", "innwit"),
						"desc" 		=> __("Do you want to display read more button?", "innwit"),
						"id" 		=> "s_tv_post_button",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold" 		=> "s_tv_recent_popular"
				);

$of_options[] = array( 	"name" 		=> __("Recent & popular Tab Read More Button Text", "innwit"),
						"desc" 		=> __("Type the read more button text here", "innwit"),
						"id" 		=> "s_tv_post_button_text",
						"std" 		=> "Read More",
						"type" 		=> "text",
						"fold" 		=> "s_tv_recent_popular"
				);


$of_options[] = array( 	"name" 		=> __("Show/Hide Share/Like and Comment", "innwit"),
						"desc" 		=> __("Do you want to display share/like and comment?", "innwit"),
						"id" 		=> "s_tv_share_like",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch"
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Share", "innwit"),
						"desc" 		=> __("Do you want to display share?", "innwit"),
						"id" 		=> "s_tv_share",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold" 		=> "s_tv_recent_popular"
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Like", "innwit"),
						"desc" 		=> __("Do you want to display like?", "innwit"),
						"id" 		=> "s_tv_like",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold" 		=> "s_tv_recent_popular"
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide View All Video Button", "innwit"),
						"desc" 		=> __("Do you want to display read more button?", "innwit"),
						"id" 		=> "s_tv_view_all_button",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold" 		=> "s_tv_recent_popular"
				);

$of_options[] = array( 	"name" 		=> __("View All Video Button Text", "innwit"),
						"desc" 		=> __("Type the view all button text here", "innwit"),
						"id" 		=> "s_tv_view_all_button_text",
						"std" 		=> "View All Video",
						"type" 		=> "text",
						"fold" 		=> 's_tv_recent_popular'
				);

$of_options[] = array( 	"name" 		=> __("Event TV template URL", "innwit"),
						"desc" 		=> __("Type the Event TV template URL", "innwit"),
						"id" 		=> "event_tv_template_url",
						"std" 		=> "",
						"type" 		=> "text",
						"fold" 		=> 's_tv_recent_popular'
				);

/*
 * ========	
 *  EVENT
 * ========
 */

$of_options[] = array( 	"name" 		=> __("Event", "innwit"),
						"type" 		=> "heading"
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Sub Banner in Event Pages", "innwit"),
						"desc" 		=> __("Do you want to display sub banner in Event page", "innwit"),
						"id" 		=> "event_sub_banner",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch"
				);	

$of_options[] = array( "name" => __("Choose the Registered Sidebar", "innwit"),
						"desc" => __("Please choose the sidebar you have created", "innwit"),
						"id" => "event_select_sidebar",
						"std" => "0",
						"type" => "select_sidebar",
						"hide" => array('event-sidebar')
				);

$of_options[] = array( 	"name" 		=> __("Sidebar Styles", "innwit"),
						"desc" 		=> __("Choose sidebar style, it applies Event page only.", "innwit"),
						"id" 		=> "event_styles",
						"std" 		=> "style1",
						"type" 		=> "select",
						"options" 	=> $sidebar_styles
				);

$of_options[] = array( 	"name" 		=> __("Sidebar Position", "innwit"),
						"desc" 		=> __("Choose Single post sidebar position, it applies single post only.", "innwit"),
						"id" 		=> "event_sidebar",
						"std" 		=> "left_sidebar",
						"type" 		=> "select",
						"options" 	=> $sidebar
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Event Search Filter", "innwit"),
						"desc" 		=> __("Do you want to display Event Search filter in Event page", "innwit"),
						"id" 		=> "event_search_filter",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch"
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Event sort Filter", "innwit"),
						"desc" 		=> __("Do you want to display Event filter in Event page", "innwit"),
						"id" 		=> "event_sort_filter",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch"
				);

$of_options[] = array( 	"name" 		=> __("Excerpt Text Limit", "innwit"),
						"desc" 		=> __("Type the numerical value for the excerpt text", "innwit"),
						"id" 		=> "event_limit",
						"std" 		=> "200",
						"type" 		=> "text"
				);


$of_options[] = array( 	"name" 		=> __("Show/Hide Meta Section", "innwit"),
						"desc" 		=> __("Do you want to display meta section on Event page", "innwit"),
						"id" 		=> "event_meta",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"folds" 	=> 1
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Date in meta", "innwit"),
						"desc" 		=> __("Do you want to display date in meta section on Event page", "innwit"),
						"id" 		=> "event_meta_date",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold" 		=> "event_meta",
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Venue in meta", "innwit"),
						"desc" 		=> __("Do you want to display venue in meta section on Event page", "innwit"),
						"id" 		=> "event_meta_venue",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold" 		=> "event_meta",
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Country in meta", "innwit"),
						"desc" 		=> __("Do you want to display country in meta section on Event page", "innwit"),
						"id" 		=> "event_meta_country",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold" 		=> "event_meta",
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Read More Button", "innwit"),
						"desc" 		=> __("Do you want to display read more button?", "innwit"),
						"id" 		=> "event_btn",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"folds" 	=> 1
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Share/Like and Comment", "innwit"),
						"desc" 		=> __("Do you want to display share/like and comment?", "innwit"),
						"id" 		=> "event_share_like_comment",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"folds" 	=> 1
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Share", "innwit"),
						"desc" 		=> __("Do you want to display share?", "innwit"),
						"id" 		=> "event_share",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold" 		=> "event_share_like_comment"
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Like", "innwit"),
						"desc" 		=> __("Do you want to display like?", "innwit"),
						"id" 		=> "event_like",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold" 		=> "event_share_like_comment"
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Comment", "innwit"),
						"desc" 		=> __("Do you want to display comment?", "innwit"),
						"id" 		=> "event_comment",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold" 		=> "event_share_like_comment"
				);

/*
 * ================	
 * Single Event 
 * ================
 */

$of_options[] = array( 	"name" 		=> __("Single Event", "innwit"),
						"type" 		=> "heading"
				);


$of_options[] = array( 	"name" 		=> __("Show/Hide Sub Banner in Event Pages", "innwit"),
						"desc" 		=> __("Do you want to display sub banner in Single Event page", "innwit"),
						"id" 		=> "s_event_sub_banner",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch"
				);	

$of_options[] = array( "name" => __("Choose the Registered Sidebar", "innwit"),
						"desc" => __("Please choose the sidebar you have created", "innwit"),
						"id" => "s_event_select_sidebar",
						"std" => "0",
						"type" => "select_sidebar",
						"hide" => array('event-sidebar')
				);

$of_options[] = array( 	"name" 		=> __("Sidebar Styles", "innwit"),
						"desc" 		=> __("Choose sidebar style, it applies Single Event page only.", "innwit"),
						"id" 		=> "s_event_styles",
						"std" 		=> "style1",
						"type" 		=> "select",
						"options" 	=> $sidebar_styles
				);

$of_options[] = array( 	"name" 		=> __("Sidebar Position", "innwit"),
						"desc" 		=> __("Choose Single post sidebar position, it applies Single Event page only.", "innwit"),
						"id" 		=> "s_event_sidebar",
						"std" 		=> "left_sidebar",
						"type" 		=> "select",
						"options" 	=> $sidebar
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Event Search Filter", "innwit"),
						"desc" 		=> __("Do you want to display Event Search filter in Single Event page", "innwit"),
						"id" 		=> "s_event_search_filter",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch"
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Event Venue", "innwit"),
						"desc" 		=> __("Do you want to display venue in Single Event page", "innwit"),
						"id" 		=> "s_event_venue",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch"
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Event Counter", "innwit"),
						"desc" 		=> __("Do you want to display counter in Single Event page", "innwit"),
						"id" 		=> "s_event_counter",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch"
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Event Organizer", "innwit"),
						"desc" 		=> __("Do you want to display organizer in Single Event page", "innwit"),
						"id" 		=> "s_event_organizer",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch"
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Event Cart", "innwit"),
						"desc" 		=> __("Do you want to display cart in Single Event page", "innwit"),
						"id" 		=> "s_event_cart",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch"
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Meta Section", "innwit"),
						"desc" 		=> __("Do you want to display meta section on Single Event page", "innwit"),
						"id" 		=> "s_event_meta",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"folds" 	=> 1
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Date in meta", "innwit"),
						"desc" 		=> __("Do you want to display date in meta section on Single Event page", "innwit"),
						"id" 		=> "s_event_meta_date",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold" 		=> "s_event_meta",
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Venue in meta", "innwit"),
						"desc" 		=> __("Do you want to display venue in meta section on Single Event page", "innwit"),
						"id" 		=> "s_event_meta_venue",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold" 		=> "s_event_meta",
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Country in meta", "innwit"),
						"desc" 		=> __("Do you want to display country in meta section on Single Event page", "innwit"),
						"id" 		=> "s_event_meta_country",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold" 		=> "s_event_meta",
				);

$of_options[] = array( 	"name" 		=> __("Event Description Title", "innwit"),
						"desc" 		=> __("Type the event description title", "innwit"),
						"id" 		=> "s_event_description_title",
						"std" 		=> "Whats About",
						"type" 		=> "text",
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Share Options", "innwit"),
						"desc" 		=> __("Do you want to display share options?", "innwit"),
						"id" 		=> "s_event_share",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"folds"		=> 1
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Facebook Pages", "innwit"),
						"desc" 		=> __("Do you want to display Facebook page", "innwit"),
						"id" 		=> "s_event_facebook_page",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold" 		=> "s_event_share",
				);

$of_options[] = array( 	"name" 		=> __("Facebook Page Link", "innwit"),
						"desc" 		=> __("Type the facebook page link here", "innwit"),
						"id" 		=> "s_event_facebook_page_url",
						"std" 		=> "",
						"type" 		=> "text",
						"fold" 		=> "s_event_share",
				);


$of_options[] = array( 	"name" 		=> __("Show/Hide Facebook Share", "innwit"),
						"desc" 		=> __("Do you want to display facebook share", "innwit"),
						"id" 		=> "s_event_facebook",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold" 		=> "s_event_share",
				);	

$of_options[] = array( 	"name" 		=> __("Show/Hide Twitter Share", "innwit"),
						"desc" 		=> __("Do you want to display twitter share", "innwit"),
						"id" 		=> "s_event_twitter",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold" 		=> "s_event_share",
				);	

$of_options[] = array( 	"name" 		=> __("Show/Hide Google Plus Share", "innwit"),
						"desc" 		=> __("Do you want to display gplus share", "innwit"),
						"id" 		=> "s_event_gplus",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold" 		=> "s_event_share",
				);	

$of_options[] = array( 	"name" 		=> __("Show/Hide Schedule", "innwit"),
						"desc" 		=> __("Do you want to display Schedule", "innwit"),
						"id" 		=> "s_event_schedule",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch"
				);

$of_options[] = array( 	"name" 		=> __("Event Schedule Title", "innwit"),
						"desc" 		=> __("Type the event schedule title", "innwit"),
						"id" 		=> "s_event_schedule_title",
						"std" 		=> "Schedule with Speakers",
						"type" 		=> "text",
						"fold"		=> "s_event_schedule"
			);

$of_options[] = array( 	"name" 		=> __("Show/Hide Schedule Speaker", "innwit"),
						"desc" 		=> __("Do you want to display Schedule Speaker section", "innwit"),
						"id" 		=> "s_event_schedule_speaker",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold"		=> "s_event_schedule"
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Event Schedule Meta Time", "innwit"),
						"desc" 		=> __("Do you want to display event schedule time meta?", "innwit"),
						"id" 		=> "s_event_schedule_meta_time",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold"		=> "s_event_schedule"
			);

$of_options[] = array( 	"name" 		=> __("Show/Hide Event Schedule Meta Venue", "innwit"),
						"desc" 		=> __("Do you want to display event schedule venue meta?", "innwit"),
						"id" 		=> "s_event_schedule_meta_venue",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold"		=> "s_event_schedule"
			);

$of_options[] = array( 	"name" 		=> __("Excerpt Schedule Text Limit", "innwit"),
						"desc" 		=> __("Type the numerical value for the excerpt text", "innwit"),
						"id" 		=> "s_event_schedule_limit",
						"std" 		=> 200,
						"type" 		=> "text",
						"fold"		=> "s_event_schedule"
				);


$of_options[] = array( 	"name" 		=> __("Show/Hide Schedule Read More Button ", "innwit"),
						"desc" 		=> __("Do you want to display event schedule read more button?", "innwit"),
						"id" 		=> "s_event_single_schedule_btn",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold"		=> "s_event_schedule"
			);

$of_options[] = array( 	"name" 		=> __("Schedule Read More Button Text", "innwit"),
						"desc" 		=> __("Type the Read More button text here", "innwit"),
						"id" 		=> "s_event_single_schedule_btn_text",
						"std" 		=> "Read More",
						"type" 		=> "text",
						"fold" 		=> 's_event_schedule'
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Schedule About Speaker Button", "innwit"),
						"desc" 		=> __("Do you want to display about speaker button?", "innwit"),
						"id" 		=> "s_event_single_speaker_btn",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold"		=> "s_event_schedule"
			);

$of_options[] = array( 	"name" 		=> __("About Speakers Button Text", "innwit"),
						"desc" 		=> __("Type the About Speakers button text here", "innwit"),
						"id" 		=> "s_event_single_speaker_btn_text",
						"std" 		=> "About Speakers",
						"type" 		=> "text",
						"fold" 		=> 's_event_schedule'
				);


$of_options[] = array( 	"name" 		=> __("Show/Hide Break Text", "innwit"),
						"desc" 		=> __("Do you want to display break text in between the schedule?", "innwit"),
						"id" 		=> "s_event_schedule_break",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold"		=> "s_event_schedule"
			);

$of_options[] = array( 	"name" 		=> __("Schedule Break Text", "innwit"),
						"desc" 		=> __("Type the Schedule break text here", "innwit"),
						"id" 		=> "s_event_single_schedule_break_text",
						"std" 		=> "LETS HAVE A BREAK, ENJOY IT",
						"type" 		=> "text",
						"fold" 		=> 's_event_schedule'
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Event speaker", "innwit"),
						"desc" 		=> __("Do you want to display Event speaker", "innwit"),
						"id" 		=> "s_event_speakers",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"folds" 	=> 1
				);	

$of_options[] = array( 	"name" 		=> __("Speaker of Event Title", "innwit"),
						"desc" 		=> __("Type the about speaker of event title here", "innwit"),
						"id" 		=> "s_event_speakers_title",
						"std" 		=> "Speakers of Event",
						"type" 		=> "text",
						"fold" 		=> "s_event_speakers"
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Profession", "innwit"),
						"desc" 		=> __("Do you want to display Speaker Profession", "innwit"),
						"id" 		=> "s_event_speaker_job",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold"		=> "s_event_speakers"
				);

$of_options[] = array( 	"name" 		=> __("Excerpt Speakers Text Limit", "innwit"),
						"desc" 		=> __("Type the numerical value for the excerpt text", "innwit"),
						"id" 		=> "s_event_speakers_limit",
						"std" 		=> 150,
						"type" 		=> "text",
						"fold"		=> "s_event_speakers"
			);

$of_options[] = array( 	"name" 		=> __("Show/Hide Social Icons", "innwit"),
						"desc" 		=> __("Do you want to display Social icons", "innwit"),
						"id" 		=> "s_event_speaker_social",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold"		=> "s_event_speakers"
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Event Sponsored", "innwit"),
						"desc" 		=> __("Do you want to display event sponsored", "innwit"),
						"id" 		=> "s_event_sponsored",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"folds"		=> 1
				);

$of_options[] = array( 	"name" 		=> __("Sponsor Title", "innwit"),
						"desc" 		=> __("Type the event sponsor title here", "innwit"),
						"id" 		=> "s_event_sponsor_title",
						"std" 		=> "Sponsored By",
						"type" 		=> "text",
						"fold"		=> "s_event_sponsored"
			);

$of_options[] = array( 	"name" 		=> __("Show/Hide Event Gallery", "innwit"),
						"desc" 		=> __("Do you want to display event sponsored", "innwit"),
						"id" 		=> "s_event_gallery",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"folds"		=> 1
				);

$of_options[] = array( 	"name" 		=> __("Gallery Title", "innwit"),
						"desc" 		=> __("Type the event gallery title here", "innwit"),
						"id" 		=> "s_event_gallery_title",
						"std" 		=> "Gallery of Event",
						"type" 		=> "text",
						"fold"		=> "s_event_gallery"
			);	

$of_options[] = array( 	"name" 		=> __("Number of Event Gallery Item", "innwit"),
						"desc" 		=> __("How many items you want to display?", "innwit"),
						"id" 		=> "s_event_gallery_item",
						"std" 		=> 6,
						"type" 		=> "text",
						"fold"		=> "s_event_gallery"
			);


/*
 * ============
 * Event search
 * ============
 */

$of_options[] = array( 	"name" 	=>	 __("Event Search", "innwit"),
						"type" 	=>	 "heading"
				);	


$of_options[] = array( 	"name" 		=> __("Show/Hide Sub Banner in Event Pages", "innwit"),
						"desc" 		=> __("Do you want to display sub banner in Event Search page", "innwit"),
						"id" 		=> "s_event_search_sub_banner",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch"
				);	

$of_options[] = array( "name" => __("Choose the Registered Sidebar", "innwit"),
						"desc" => __("Please choose the sidebar you have created", "innwit"),
						"id" => "s_event_search_select_sidebar",
						"std" => "0",
						"type" => "select_sidebar",
						"hide" => array('blog-sidebar')
				);

$of_options[] = array( 	"name" 		=> __("Sidebar Styles", "innwit"),
						"desc" 		=> __("Choose sidebar style, it applies Event Search page.", "innwit"),
						"id" 		=> "s_event_search_styles",
						"std" 		=> "style1",
						"type" 		=> "select",
						"options" 	=> $sidebar_styles
				);

$of_options[] = array( 	"name" 		=> __("Sidebar Position", "innwit"),
						"desc" 		=> __("Choose Single post sidebar position, it applies Event Search page.", "innwit"),
						"id" 		=> "s_event_search_sidebar",
						"std" 		=> "left_sidebar",
						"type" 		=> "select",
						"options" 	=> $sidebar
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Event Search Filter", "innwit"),
						"desc" 		=> __("Do you want to display Event Search filter in  Event Search page", "innwit"),
						"id" 		=> "s_event_search_search_filter",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch"
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Event Search Meta", "innwit"),
						"desc" 		=> __("Do you want to display event search meta", "innwit"),
						"id" 		=> "s_event_search_meta",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Event Search Meta Date", "innwit"),
						"desc" 		=> __("Do you want to display event search meta date", "innwit"),
						"id" 		=> "s_event_search_date",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold"		=> "s_event_search_meta"
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Event Search Meta Venue", "innwit"),
						"desc" 		=> __("Do you want to display event search venue", "innwit"),
						"id" 		=> "s_event_search_venue",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold"		=> "s_event_search_meta"
				);

$of_options[] = array( 	"name" 		=> __("Show/Hide Event Search Meta Date", "innwit"),
						"desc" 		=> __("Do you want to display event search place", "innwit"),
						"id" 		=> "s_event_search_place",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"fold"		=> "s_event_search_meta"
				);

$of_options[] = array( 	"name" 		=> __("Excerpt Search Text Limit", "innwit"),
						"desc" 		=> __("Type the numerical value for the excerpt text", "innwit"),
						"id" 		=> "s_event_search_text_limit",
						"std" 		=> "200",
						"type" 		=> "text",				
				);


$of_options[] = array( 	"name" 		=> __("Show/Hide Read More Button", "innwit"),
						"desc" 		=> __("Do you want to display read more button?", "innwit"),
						"id" 		=> "s_event_search_button",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch"
				);


/*
 * ======================	
 * Twitter Api Settings        
 * ======================
 */

$of_options[] = array( 	"name" 	=>	 __("Twitter API Key", "innwit"),
						"type" 	=>	 "heading"
				);							
					
$of_options[] = array( 	"name" 	=>	 __("Consumer Key", "innwit"),
						"desc" 	=>	 __("Paste your Twitter API's Consumer Key", "innwit"),
						"id" 	=>	 "twitter_api_consumer_key",
						"std" 	=>	 "",
						"type" 	=>	 "text"
				);							

$of_options[] = array( 	"name" 	=>	 __("Consumer Secret Key", "innwit"),
						"desc" 	=>	 __("Paste your Twitter API's Consumer Secret Key", "innwit"),
						"id" 	=>	 "twitter_api_consumer_secret_key",
						"std" 	=>	 "",
						"type" 	=>	 "text"
				);							

$of_options[] = array( 	"name" 	=>	 __("Access Token", "innwit"),
						"desc" 	=>	 __("Paste your Twitter API's Access Token", "innwit"),
						"id" 	=>	 "twitter_api_access_token",
						"std" 	=>	 "",
						"type" 	=>	 "text"
				);							

$of_options[] = array( 	"name" 	=>	 __("Access Token Secret Key", "innwit"),
						"desc" 	=>	 __("Paste your Twitter API's Access Token Secret Key", "innwit"),
						"id" 	=>	 "twitter_api_access_token_secret_key",
						"std" 	=>	 "",
						"type" 	=>	 "text"
				);

$of_options[] = array( 	"name" 	=>	 __("Twitter Cache Duration (in seconds)", "innwit"),
						"desc" 	=>	 __("Set how often you want to check for new tweets? By default, results are cached for 1 hour to help you avoid hitting the API limits.", "innwit"),
						"id" 	=>	 "twitter_cache_expire",
						"std" 	=>	 3600,
						"type" 	=>	 "text"
				);


/*
 * ======================	
 * Footer Settings        
 * ======================
 */

$of_options[] = array( 	"name" 		=> __("Footer Options", "innwit"),
						"type" 		=> "heading"
				);


$of_options[] = array( 	"name" 		=> __("Show/Hide Footer Widget", "innwit"),
						"desc" 		=> __("Do you want to display the footer widget?", "innwit"),
						"id" 		=> "f_widget",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"folds"		=> 1,
						"type" 		=> "switch"
				);

$of_options[] = array( 	"name" 		=> __("Footer Widget Columns", "innwit"),
						"desc" 		=> __("Choose the footer widget columns", "innwit"),
						"id" 		=> "f_widget_col",
						"std" 		=> "col3",
						"fold" 		=> "f_widget",
						"type" 		=> "select",
						"options" 	=> $columns
				);

$of_options[] = array( "name" => __("Choose the Registered Sidebar", "innwit"),
					"desc" => __("Please choose the sidebar you have created", "innwit"),
					"id" => "f_select_sidebar",
					"std" => "0",
					"fold" => "f_widget",
					"type" => "select_sidebar",
					"hide" => array('footer-widgets')
					);

$of_options[] = array( 	"name" 		=> __("Show/Hide Small footer", "innwit"),
						"desc" 		=> __("Do you want to display the small footer?", "innwit"),
						"id" 		=> "f_small",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"folds"		=> 1,
						"type" 		=> "switch"
				);

$of_options[] = array( "name" => __("Copyright Text", "innwit"),
						"desc" => __("Type Copyright Text", "innwit"),
						"id" => "f_copyright_t",
						"std" => "<p>&copy; [year] [blog-link] , All Rights Reserved.</p>",
						"fold" => "f_small",
						"type" => "textarea"
				);

$of_options[] = array( 	"name" 		=> __("Show Footer Navigation or Social Links", "innwit"),
						"desc" 		=> __("Show footer navigation or social links in small footer", "innwit"),
						"id" 		=> "f_small_sl_nav",
						"std" 		=> 1,
						"on" 		=> "Social Links",
						"off" 		=> "Footer Navigation",
						"fold"		=> "f_small",
						"type" 		=> "switch"
				);

					
$of_options[] = array( "name" => __("Facebook URL", "innwit"),
						"desc" => __("Please Enter Facebook URL, This will display in footer.", "innwit"),
						"id" => "bottom_facebook",
						"std" => "",
						"fold" => "f_small",
						"type" => "text"
				); 					

$of_options[] = array( "name" => __("Twitter", "innwit"),
						"desc" => __("Please Enter Twitter Username, This will display in footer.", "innwit"),
						"id" => "bottom_twitter",
						"std" => "",
						"fold" => "f_small",
						"type" => "text"
				);
										
$of_options[] = array( "name" => __("Google Plus URL", "innwit"),
						"desc" => __("Please Enter G+ URL, This will display in footer.", "innwit"),
						"id" => "bottom_gplus",
						"std" => "",
						"fold" => "f_small",
						"type" => "text"
				);
										
$of_options[] = array( "name" => __("LinkedIn URL", "innwit"),
						"desc" => __("Enter your full Linkedin URL, This will display in footer.", "innwit"),
						"id" => "bottom_linkedin",
						"std" => "",
						"fold" => "f_small",
						"type" => "text"
				);
										
$of_options[] = array( "name" => __("Dribbble URL", "innwit"),
						"desc" => __("Enter your full Dribbble URL, This will display in footer.", "innwit"),
						"id" => "bottom_dribbble",
						"std" => "",
						"fold" => "f_small",
						"type" => "text"
				);
										
$of_options[] = array( "name" => __("Flickr URL", "innwit"),
						"desc" => __("Enter your full Flickr URL, This will display in footer.", "innwit"),
						"id" => "bottom_flickr",
						"std" => "",
						"fold" => "f_small",
						"type" => "text"
				);
										
$of_options[] = array( "name" => __("Pinterest URL", "innwit"),
						"desc" => __("Enter your full Pinterest URL, This will display in footer.", "innwit"),
						"id" => "bottom_pinterest",
						"std" => "",
						"fold" => "f_small",
						"type" => "text"
				);
					
$of_options[] = array( "name" => __("Tumblr URL", "innwit"),
						"desc" => __("Enter your full Tumblr  URL, This will display in footer.", "innwit"),
						"id" => "bottom_tumblr",
						"std" => "",
						"fold" => "f_small",
						"type" => "text"
				);
										
$of_options[] = array( "name" => __("RSS URL", "innwit"),
						"desc" => __("Enter your full RSS URL, This will display in footer.", "innwit"),
						"id" => "bottom_rss",
						"std" => "",
						"fold" => "f_small",
						"type" => "text"
				);



/*
 * ======================	
 * Typography        
 * ======================
 */
$of_options[] = array( "name" => __("Typography", "innwit"),
					"type" => "heading");

$of_options[] = array( 	"name" 		=> __("Body Fonts", "innwit"),
						"desc" 		=> __("Choose google webfont and Fallback fonts (incase google webfonts not loaded, fallback websafe fonts will apply). This font will for body texts", "innwit"),
						"id" 		=> "custom_font_body",
						"std" 		=> array(
											//'size'  => '14px',
											'g_face' => 'Source Sans Pro',
											'face'  => 'Arial, sans-serif',
											//'style' => 'regular',
											//'color' => '#3d3d3d'
										),
						"type" 		=> "select_google_font",
						"preview" 	=> array(
										"text" => "This is choosen google webfonts preview text!<br>0123456789", //this is the text from preview box
										"size" => "30px" //this is the text size from preview box
						)
				);


//Subset
$subset = array(
			'latin' => 'Latin',
			'cyrillic-ext' => 'Cyrillic Extended (cyrillic-ext) ',
			'greek-ext' => 'Greek Extended (greek-ext)',
			'greek' => 'Greek (greek)',
			'vietnamese' => 'Vietnamese (vietnamese)',
			'latin-ext' => 'Latin Extended (latin-ext)',
			'cyrillic' => 'Cyrillic (cyrillic)'
			);

$of_options[] = array( 	"name" 		=> __("Choose the character sets you want:", "innwit"),
						"desc" 		=> __("If you choose only the languages that you need, you'll help prevent slowness on your webpage.", "innwit"),
						"id" 		=> "subset",
						"std" 		=> array("latin"),
						"type" 		=> "multicheck",
						"options" 	=> $subset
				);



/*
 * ======================	
 * Styling Options
 * ======================
 */
$of_options[] = array( "name" => __("Styling Options", "innwit"),
					"type" => "heading");


$of_options[] = array( 	"name" 		=> __("Theme Color", "innwit"),
						"desc" 		=> __("Use radio buttons as Theme color.", "innwit"),
						"id" 		=> "theme_color",
						"std" 		=> "default",
						"type" 		=> "colorchooser",
						"options" 	=> array(											
							'default' => '#5ab4e6',
							'orange' => '#ed5f30',
							'blumine-blue' => '#23C4BD',
							'copper-brown' => '#b07838',
							'jelly-bean-magenta' => '#28778e',
							'persian-red' => '#cc3333',
						)
				);

$of_options[] = array( "name" => __("Custom Styles", "innwit"),
					"desc" => __("Do you like to use Custom Styles, Please enable it and choose the Background color, Primary color, Selection text color, selection background color, link hover color. If it's disabled, the default style will apply and custom styles are won't apply.", "innwit"),
					"id" => "custom_styles",
					"std" => 0,
					"on" => "Yes",
					"off" => "No",
					"type" => "switch"
				);
				
$of_options[] = array( 	"name" 		=> __("Primary Color", "innwit"),
						"desc" 		=> __("Pick a primary color for the theme (default: #5ab4e6).", "innwit"),
						"id" 		=> "primary_color",
						"std" 		=> "#5ab4e6",
						"fold"		=> "custom_styles",
						"type" 		=> "color"
				);

$of_options[] = array( 	"name" 		=> __("Secondary Color", "innwit"),
						"desc" 		=> __("Pick a secondary color for the theme (default: #735cb0).", "innwit"),
						"id" 		=> "secondary_color",
						"std" 		=> "#735cb0",
						"fold"		=> "custom_styles",
						"type" 		=> "color"
				);

$of_options[] = array( 	"name" 		=> __("Selection Text Color", "innwit"),
						"desc" 		=> __("This is the text color when selecting the text.", "innwit"),
						"id" 		=> "selection_text_color",
						"std" 		=> "",
						"fold"		=> "custom_styles",
						"type" 		=> "color"
				);
$of_options[] = array( 	"name" 		=> __("Selection Text Background Color", "innwit"),
						"desc" 		=> __("This is the text background color when selecting the text.", "innwit"),
						"id" 		=> "selection_bg_color",
						"std" 		=> "#735cb0",
						"fold"		=> "custom_styles",
						"type" 		=> "color"
				);

//Import Demo
$of_options[] = array( "name" => __("Import Demo", "innwit"),
					"type" => "heading");

/*$of_options[] = array( 	"name" 		=> __("Download attachments", "innwit"),
						"desc" 		=> __("Do you want to download demo attachement? (In order to speed up the import process, or in case of upload fail, Turn off the \"Download attachments\" switch off. That will give you all the pages and posts without the attachments. This is a good option because users will need to use their own images anyways.If you choose \"Yes\", wordpress download and upload all the files from demo including images, videos and audio. But depends on your connection it took more time to complete the import.)", "innwit"),
						"id" 		=> "download_attachments",
						"std" 		=> 0,
						"on" 		=> "Yes",
						"off" 		=> "No",
						"type" 		=> "switch"
				);*/

$pix_import_nonce = wp_create_nonce("pix_import_nonce");
$import_link = admin_url('admin-ajax.php?action=pix_import_demo&nonce='.$pix_import_nonce);

$of_options[] = array( "name" => __("Import Demo Data", "innwit"),
					"desc" => __("Click Here to start import the demo content.", "innwit"),
					"id" => "import_demo_data",
					"icon" => true,
					"type" => "demodata");


// Backup Options
$of_options[] = array( 	"name" 		=> __("Backup Options", "innwit"),
						"type" 		=> "heading",
						
				);
				
$of_options[] = array( 	"name" 		=> __("Backup and Restore Options", "innwit"),
						"desc" 		=> __("You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.", "innwit"),
						"id" 		=> "of_backup",
						"std" 		=> "",
						"type" 		=> "backup",
				);
				
$of_options[] = array( 	"name" 		=> __("Transfer Theme Options Data", "innwit"),
						"desc" 		=> __("You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click 'Import Options'.", "innwit"),
						"id" 		=> "of_transfer",
						"std" 		=> "",
						"type" 		=> "transfer",
						
				);




				
	}//End function: of_options()
}//End chack if function exists: of_options()
?>