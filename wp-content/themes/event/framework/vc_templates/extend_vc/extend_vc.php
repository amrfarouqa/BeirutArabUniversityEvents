<?php 


//Add new param to vc
function icon_field($settings, $value) {
	$dependency = vc_generate_dependencies_attributes($settings);
	return '<div class="icon_field menu-item-settings">'
	.'<input type="hidden" class="edit-menu-item-icon wpb_vc_param_value wpb-textinput '.$settings['param_name'].' '.$settings['type'].'_field" name="'.$settings['param_name'].'" value="'.$value.'" ' . $dependency . '/>

	<span class="pix-inserted-icon"></span>

	<a href="#" class="button pix-insert-menu-icon"><i class="fa fa-arrow-circle-o-down"></i> '. __('Insert Icon', 'pixel8es') .'</a>
	<a href="#" class="button pix-remove-menu-icon hidden"><i class="fa fa-times"></i> '. __('Remove Icon', 'pixel8es') .'</a>
</div>';
}
@add_shortcode_param('icon', 'icon_field', THEME_FUNCTIONS_URI .'/pix-menu-extend/js/dialog.js');

// Pie Chart
vc_remove_element("vc_pie");

// VC ROW
vc_add_param("vc_row", array(
	"type" => "textfield",
	"heading" => __("Anchor Id", "js_composer"),
	"param_name" => "anchor_id",
	"value" => "",
	"description" => "Enter the id if you like to use single page (or) Anchor navigation."
	));

//Theme primary colors as bg
vc_add_param("vc_row",array(
       "type" => "dropdown",
       "heading" => __("Use theme background color", "js_composer"),
       "param_name" => "theme_primary",
       "value" => array(  __('Custom', "js_composer") => "custom", __('Primary', "js_composer") => "primary", __('Secondary', "js_composer") => "secondary" ),
       "description" => __("Choose primary if you like to theme primary color as background color", "js_composer"),
       'group' => __( 'Design options', 'js_composer' )
));

//bg color opacity
vc_add_param("vc_row", array(
       "type" => "textfield",
       "heading" => __("Enter Alpha Value, if you like to use alpha transparency in bg (rgba)", "js_composer"),
       "param_name" => "theme_primary_alpha",
       "value" => "1",
       "description" => __("Enter alpha transparency value (should be inbetween 0.1 to 1 Ex: 0.7)", "js_composer"),
       'group' => __( 'Design options', 'js_composer' )
       ));

// VC ROW
vc_add_param("vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __("Row Type", "js_composer"),
	"param_name" => "type",
	"value" => array(__('Normal', "js_composer") => "normal", 
					 __('Full Width', "js_composer") => "full-width", 
					 __('Expandable', "js_composer") => "expandable"),
	"description" => __("Choose the Type of Row.<br> <b>Normal</b> => Just a normal section (boxed),<br> <b>Full Width</b> => Choose this if you want full background image / color or video background etc,<br> <b>Exapandable</b> => Choose this to Snaps the content to the edge of the screen (eg: Full width portfolio).", "js_composer"),
	));

//Color Style
vc_add_param("vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __("Text Color", "js_composer"),
	"param_name" => "color_style",
	"value" => array(__('Black', "js_composer") => "light",
					 __('White', "js_composer") => "dark"),
	"description" => __("Choose the font color you want to apply. <br> Alternatively you can choose your own color at the top of this section", "js_composer"),
	));

//Video
vc_add_param("vc_row", array(
	"type" => "checkbox",
	"class" => "",
	"heading" => __("Video background", "js_composer"),
	"param_name" => "video",
	"value" => array(__("Use video background?", "js_composer") => "video_bg" ),
	"description" => __("Do you like add video background for this section", "js_composer"),
	"dependency" => Array('element' => "type", 'value' => array('full-width'))
	));

vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => __("Video background url for (webm) file", "js_composer"),
	"param_name" => "video_webm",
	"value" => "",
	"description" => "",
	"dependency" => Array('element' => "video", 'value' => array('video_bg'))
	));

vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => __("Video background url for (mp4) file", "js_composer"),
	"param_name" => "video_mp4",
	"value" => "",
	"description" => "",
	"dependency" => Array('element' => "video", 'value' => array('video_bg'))
	));

vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => __("Video background url for (ogg) file", "js_composer"),
	"param_name" => "video_ogg",
	"value" => "",
	"description" => "",
	"dependency" => Array('element' => "video", 'value' => array('video_bg'))
	));

vc_add_param("vc_row", array(
	"type" => "attach_image",
	"class" => "",
	"heading" => __("Video preview image", "js_composer"),
	"value" => "",
	"param_name" => "video_image",
	"description" => __("This image will apply before video loads", "js_composer"),
	"dependency" => Array('element' => "video", 'value' => array('video_bg'))
	));

// Parallax Option
vc_add_param("vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __("Parallax", "js_composer"),
	"param_name" => "parallax",
	"value" => array(__('No', "js_composer") => "no", 
					 __('Yes', "js_composer") => "yes"),
	"description" => __("Do You like to enable Parallax Section? If yes don't forget to add background image", "js_composer"),
	"dependency" => Array('element' => "type", 'value' => array('full-width'))
	));

vc_add_param("vc_row", array(
	"type" => "textfield",
	"heading" => __("Parallax Ratio", "js_composer"),
	"param_name" => "parallax_ratio",
	"value" => "0.5",
	"description" => __("Enter the parallax ratio. This affect the parallax movement speed. The value should be in between 0.1 to 2. The ratio is relative to the natural scroll speed, so a ratio of 0.5 would cause the element to scroll at half-speed, a ratio of 1 would have no effect, and a ratio of 2 would cause the element to scroll at twice the speed. <strong>Default value is 0.5</strong>", "js_composer"),
	"dependency" => Array('element' => "parallax", 'value' => array('yes'))
	));

vc_add_param("vc_row", array(
	"type" => "textfield",
	"heading" => __("Parallax Offset", "js_composer"),
	"param_name" => "parallax_offset",
	"value" => "",
	"description" => __("<strong>Leave it empty to apply default.</strong> Enter the parallax offset. All elements will return to their original positioning when their offset parent meets the edge of the screen-plus or minus your own optional offset. This allows you to create intricate parallax patterns very easily.", "js_composer"),
	"dependency" => Array('element' => "parallax", 'value' => array('yes'))
	));

// Blog
vc_map( array(
	"name" => __("Recent Blog", "js_composer"), //Title
	"base" => "blog", //Shortcode name
	"class" => "",
	"icon" => "icon-pixel8es",
	"category" => 'By Theme Innwit', //category
	"params" => array(

		array(
			"type" => "dropdown",
			"heading" => __("Insert Blog Post By", "js_composer"),
			"param_name" => "insert_type",
			"admin_label" => true,
			"value" => array(__('Blog Posts', "js_composer") => "posts", 
				__('Blog Post Id', "js_composer") => "id", __('Blog Post Category', "js_composer") => "category"),
			"description" => ''
			),

		array(
			"type" => "textfield",
			"heading" => __("No. of Recentblog", "js_composer"),
			"param_name" => "no_of_items",
			"value" => -1,
			"dependency" => Array('element' => "insert_type", 'value' => array('posts','category')),
			"description" => __("Enter the number of Posts you want to display (only numbers), Enter -1 for all posts", "js_composer")
			),

		array(
			"type" => "textfield",
			"heading" => __("Post Id", "js_composer"),
			"param_name" => "blog_post_id",
			"value" => "",
			"dependency" => Array('element' => "insert_type", 'value' => 'id'),
			"description" => __("Enter the blog post ids seperated by commas (,). Example: 2,54,8", "js_composer")
			),

		array(
			"type" => "textfield",
			"heading" => __("Exclude Post", "js_composer"),
			"param_name" => "exclude_blog_post",
			"value" => "",
			"dependency" => Array('element' => "insert_type", 'value' => array('posts','category')),
			"description" => __("Enter the exclude blog post ids seperated by commas (,). Example: 2,54,8", "js_composer")
			),

		array(
			"type" => "textfield",
			"heading" => __("Category Name", "js_composer"),
			"param_name" => "blog_post_category",
			"value" => "",
			"dependency" => Array('element' => "insert_type", 'value' => 'category'),
			"description" => __("Enter the blog post category seperated by commas (,). Example: design,illustration,print", "js_composer")
			),

		array(
			"type" => "dropdown",
			"heading" => __("Order By", "js_composer"),
			"param_name" => "order_by",
			"value" => array( __('Date', "js_composer") => "date",  
							  __('Rand', "js_composer") => "rand",
							  __('ID', "js_composer") => "ID", 
							  __('Title', "js_composer") => "title", 
							  __('Author', "js_composer") => "author",
							  __('Name', "js_composer") => "modified",
							  __('Parent', "js_composer") => "parent",
							  __('Date Modified', "js_composer") => "date",
							  __('Menu Order', "js_composer") => "menu_order",
							  __('None', "js_composer") => "none"),
			"dependency" => Array('element' => "insert_type", 'value' => 'posts'),
			"description" => __("Order posts By choosen order", "js_composer")
			),

		array(
			"type" => "dropdown",
			"heading" => __("Order", "js_composer"),
			"param_name" => "order",
			"value" => array( __('Ascending order', "js_composer") => "ASC",  
							  __('descending order', "js_composer") => "DESC"),
			"dependency" => Array('element' => "insert_type", 'value' => 'posts'),
			"description" => __("In which Order, you want to display posts", "js_composer")
			), 

		array(
			"type" => "dropdown",
			"heading" => __("Title Tag", "js_composer"),
			"param_name" => "title_tag",
			"value" => array('h2','h1','h3','h4','h5','h6'),
			"description" => __("Select title tag.", "js_composer")
			),

		array(
			"type" => "dropdown",
			"heading" => __("Display Date", "js_composer"),
			"param_name" => "display_date",
			"value" => array(__('Yes', "js_composer") => 1,  
							 __('No', "js_composer") => 0),
			"description" => __('Do you like to display date in post', "js_composer")
			),

		array(
			"type" => "dropdown",
			"heading" => __("Display Author", "js_composer"),
			"param_name" => "display_date",
			"value" => array(__('Yes', "js_composer") => 1,  
							 __('No', "js_composer") => 0),
			"description" => __('Do you like to display author in post', "js_composer")
			),

		array(
			"type" => "dropdown",
			"heading" => __("Number of Columns", "js_composer"),
			"param_name" => "columns",
			"value" => array(__('3 Columns', "js_composer") => "col3",
							 __('4 Columns', "js_composer") => "col4"),
			"description" => 'Selct the column'
			),

		array(
			"type" => "dropdown",
			"heading" => __("Blog Desc", "js_composer"),
			"param_name" => "blog_desc",
			"value" => array(__('Yes', "js_composer") => 1,  
							 __('No', "js_composer") => 0),
			"description" => __('Do you like to display short description', "js_composer")
			),

		array(
			"type" => "textfield",
			"heading" => __("Button Text", "js_composer"),
			"param_name" => "button_text",
			"value" => "Read More",
			"description" => __("Type the button text here", "js_composer")
			),

		) 
) );

// Icon Box
vc_map( array(
	"name" => __("Icon Box", "js_composer"), //Title
	"base" => "icon_box", //Shortcode name
	"class" => "",
	"icon" => "icon-pixel8es",
	"category" => 'By Theme Innwit', //category
	"params" => array(

		array(
			"type" => "dropdown",
			"heading" => __("Do you want Icon Box background color?", "js_composer"),
			"param_name" => "display_icon_box_bg",
			"value" => array(__('Yes', "js_composer") => "yes",  
							 __('No', "js_composer") => "no"),
			"description" => __('Do you want Icon Box background color?', "js_composer"),
			"group"	=> __('General', 'js_composer')
			),

		array(
			"type" => "icon",
			"heading" => __("Insert Icon", "js_composer"),
			"param_name" => "icon_name",
			"value" => '',
			"description" => '',
			"group"	=> __('General', 'js_composer')
			),

		array(
			"type" => "dropdown",
			"heading" => __("Icon Style", "js_composer"),
			"param_name" => "icon_border",
			"value" => array(__('Round Border', "js_composer") => "round-border",  
							__('Square Border', "js_composer") => "square-border",
							__('Square Solid Background', "js_composer") => "square-solid",
							__('Round Solid Background', "js_composer") => "round-solid",
							__('Nothing', "js_composer") => "nothing"),
			"description" => __('Select icon style', "js_composer"),
			"group"	=> __('General', 'js_composer')
			),

		array(
			"type" => "dropdown",
			"heading" => __("Icon Color", "js_composer"),
			"param_name" => "icon_color",
			"value" => array(__('Theme Color', "js_composer") => "color",  
							__('Black', "js_composer") => "black",
							__('White', "js_composer") => "white"),
			"description" => __('Select icon color', "js_composer"),
			"group"	=> __('General', 'js_composer')
			),

		array(
			"type" => "dropdown",
			"heading" => __("Icon Size", "js_composer"),
			"param_name" => "icon_size",
			"value" => array(__('Small', "js_composer") => "sm",  
							__('Medium', "js_composer") => "md",
							__('Large', "js_composer") => "lg"),
			"description" => __("Select icon size here", "js_composer"),
			"group"	=> __('General', 'js_composer')
			),

		array(
			"type" => "textfield",
			"heading" => __("Title", "js_composer"),
			"param_name" => "title",
			"admin_label" => true,
			"value" => "Title",
			"description" => __("Enter the title.", "js_composer"),
			"group"	=> __('General', 'js_composer')
			),

		array(
			"type" => "dropdown",
			"heading" => __("Title Tag", "js_composer"),
			"param_name" => "title_tag",
			"value" => array('h2','h1','h3','h4','h5','h6'),
			"description" => __("Select title tag.", "js_composer"),
			"group"	=> __('General', 'js_composer')
			),

		array(
			"type" => "textarea_html",
			"class" => "",
			"heading" => __("Icon Box Content", "js_composer"),
			"param_name" => "content", 
			"value" => "", 
			"description" => __("Enter the Icon Box Content", "js_composer"),
			"group"	=> __('General', 'js_composer')
			),

		array(
			"type" => "dropdown",
			"heading" => __("Add Icon Box Background Hover", "js_composer"),
			"param_name" => "add_bg_hover",
			"value" => array(__('Yes', "js_composer") => "yes",  
							 __('No', "js_composer") => "no"),
			"description" => __('Do you want to add icon background hover?', "js_composer"),
			"group"	=> __('General', 'js_composer')
			),

		array(
			"type" => "dropdown",
			"heading" => __("Display Button", "js_composer"),
			"param_name" => "display_button",
			"value" => array(__('Yes', "js_composer") => "yes",  
							 __('No', "js_composer") => "no"),
			"description" => __('Do you want to display button?', "js_composer"),
			"group"	=> __('Button', 'js_composer')
			),

		array(
			"type" => "textfield",
			"heading" => __("Button Text", "js_composer"),
			"param_name" => "button_text",
			"admin_label" => true,
			"value" => "Read More",
			"description" => __("Enter the Button Text", "js_composer"),
			"dependency" => Array('element' => "display_button", 'value' => "yes"),
			"group"	=> __('Button', 'js_composer')
			),

		array(
			"type" => "vc_link",
			"heading" => __("Button URL", "js_composer"),
			"param_name" => "button_link",
			"value" => "#",
			"description" => __("Enter the button link", "js_composer"),
			"dependency" => Array('element' => "display_button", 'value' => "yes"),
			"group"	=> __('Button', 'js_composer')
			),

		array(
			"type" => "dropdown",
			"heading" => __("Button Style", "js_composer"),
			"param_name" => "button_style",
			"value" => array(__('Outline', "js_composer") => "border", 
							 __('Solid', "js_composer") => "solid", 
							 __('Simple (No Bg and No Border)', "js_composer") => "simple"),
			"description" => __("Select button style?", "js_composer"),
			"dependency" => Array('element' => "display_button", 'value' => "yes"),
			"group"	=> __('Button', 'js_composer')
			),

		array(
			"type" => "dropdown",
			"heading" => __("Button Color", "js_composer"),
			"param_name" => "button_color",
			"value" => array(__('Theme default color', "js_composer") => "btn-color", 
							 __('Grey', "js_composer") => "btn-grey",
							 __('Brown', "js_composer") => "btn-brown",
							 __('Blue', "js_composer") => "btn-blue"), 
			"description" => __("Please choose button color", "js_composer"),
			"dependency" => Array('element' => "display_button", 'value' => "yes"),
			"group"	=> __('Button', 'js_composer')
			),

		array(
			"type" => "dropdown",
			"heading" => __("Button Size", "js_composer"),
			"param_name" => "button_size",
			"value" => array(__('Medium', "js_composer") => "md", 
							 __('Small', "js_composer") => "sm", 
							 __('Large', "js_composer") => "lg"),
			"description" => __("Select button size?", "js_composer"),
			"dependency" => Array('element' => "display_button", 'value' => "yes"),
			"group"	=> __('Button', 'js_composer')
			),

		array(
			"type" => "dropdown",
			"heading" => __("Button Event", "js_composer"),
			"param_name" => "button_event",
			"value" => array(__('Active', "js_composer") => "active", 
							 __('Disabled', "js_composer") => "disabled"), 
			"description" => __("Please choose button color", "js_composer"),
			"dependency" => Array('element' => "display_button", 'value' => "yes"),
			"group"	=> __('Button', 'js_composer')
			),		

		array(
			"type" => "icon",
			"heading" => __("Button Icon", "js_composer"),
			"param_name" => "button_icon",
			"value" => '',
			"description" => __("choose button icon.", "js_composer"),
			"dependency" => Array('element' => "display_button", 'value' => "yes"),
			"group"	=> __('Button', 'js_composer')
			),

		array(
			"type" => "dropdown",
			"heading" => __("Button Icon Align", "js_composer"),
			"param_name" => "button_icon_align",
			"value" => array(__('Front', "js_composer") => "front", 
					 __('Back', "js_composer") => "back"), 
			"description" => __("Where you want to align Icon?", "js_composer"),
			"dependency" => Array('element' => "display_button", 'value' => "yes"),
			"group"	=> __('Button', 'js_composer')
			),
		)
) );

// Google Map
vc_map( array(
	"name" => __("Google Map", "js_composer"), //Title
	"base" => "googlemap", //Shortcode name
	"class" => "",
	"icon" => "icon-pixel8es",
	"category" => 'By Theme Innwit', //category
	"params" => array(

		array(
			"type" => "textfield",
			"heading" => __("Width", "js_composer"),
			"param_name" => "width",
			"value" => "100%",
			"description" => __("Enter the Width. Eg: 400 (or) 98%", "js_composer")
			),

		array(
			"type" => "textfield",
			"heading" => __("Height", "js_composer"),
			"param_name" => "height",
			"value" => "300",
			"description" => __("Enter the Height. Eg: 400", "js_composer")
			),

		array(
			"type" => "textfield",
			"heading" => __("API Key", "js_composer"),
			"param_name" => "api_key",
			"value" => "",
			"description" => __("Enter the Google Map API key", "js_composer")
			),

		array(
			"type" => "textfield",
			"heading" => __("Latitude", "js_composer"),
			"param_name" => "lat",
			"value" => "-37.81731",
			"description" => __("Enter the latitude value (from http://universimmedia.pagesperso-orange.fr/geo/loc.htm)", "js_composer")
			),

		array(
			"type" => "textfield",
			"heading" => __("Longitude", "js_composer"),
			"param_name" => "lng",
			"value" => "144.95432",
			"description" => __("Enter the longitude value (from http://universimmedia.pagesperso-orange.fr/geo/loc.htm)", "js_composer")
			),

		array(
			"type" => "textfield",
			"heading" => __("Zoom", "js_composer"),
			"param_name" => "zoom",
			"value" => "13",
			"description" => __("Enter the zoom level of the map(Ex: 9))", "js_composer")
			),

		array(
			"type" => "dropdown",
			"heading" => __("Zoom Control?", "js_composer"),
			"param_name" => "zoomcontrol",
			"value" => array( __('Yes', "js_composer") => "true",
							  __('No', "js_composer") => "false"),
			"description" => __("Do you want to display Zoom Control?", "js_composer")
			),

		array(
			"type" => "dropdown",
			"heading" => __("Pan Control", "js_composer"),
			"param_name" => "pancontrol",
			"value" => array( __('Yes', "js_composer") => "true",
							  __('No', "js_composer") => "false"),
			"description" => __("Do you want to display Pancontrol?", "js_composer")
			),

		array(
			"type" => "dropdown",
			"heading" => __("MapType Control", "js_composer"),
			"param_name" => "maptypecontrol",
			"value" => array( __('Yes', "js_composer") => "true",
							  __('No', "js_composer") => "false"),
			"description" => __("Do you want to display MapType Control?", "js_composer")
			),

		array(
			"type" => "dropdown",
			"heading" => __("Scale Control", "js_composer"),
			"param_name" => "scalecontrol",
			"value" => array( __('Yes', "js_composer") => "true",
							  __('No', "js_composer") => "false"),
			"description" => __("Do you want to display Scale Control?", "js_composer")
			),

		array(
			"type" => "dropdown",
			"heading" => __("Street View Control", "js_composer"),
			"param_name" => "streetviewcontrol",
			"value" => array( __('Yes', "js_composer") => "true",
							  __('No', "js_composer") => "false"),
			"description" => __("Do you want to display Street View Control?", "js_composer")
			),

		array(
			"type" => "dropdown",
			"heading" => __("Overview Map control", "js_composer"),
			"param_name" => "overviewmapcontrol",
			"value" => array( __('Yes', "js_composer") => "true",
							  __('No', "js_composer") => "false"),
			"description" => __("Do you want to display Overview Map control?", "js_composer")
			),

		array(
			"type" => "dropdown",
			"heading" => __("Do you want to show info on top of the map?", "js_composer"),
			"param_name" => "contact_info",
			"value" => array( __('Yes', "js_composer") => "yes",
							  __('No', "js_composer") => "no"),
			"description" => '',
			"group"	=> __('Contact Info', 'js_composer')
			),

		array(
			"type" => "textfield",
			"heading" => __("Email", "js_composer"),
			"param_name" => "email",
			"value" => "",
			"description" => __("Enter the email address.", "js_composer"),
			"dependency" => Array('element' => "contact_info", 'value' => array('yes')),
			"group"	=> __('Contact Info', 'js_composer')
			),

		array(
			"type" => "textfield",
			"heading" => __("Address Title", "js_composer"),
			"param_name" => "address_title",
			"value" => "Envato Headquarters",
			"description" => __("Title which display above address. Leave it empty if you don't want.", "js_composer"),
			"dependency" => Array('element' => "contact_info", 'value' => array('yes')),
			"group"	=> __('Contact Info', 'js_composer')
			),

		array(
			"type" => "textarea",
			"class" => "",
			"heading" => __("Address", "js_composer"),
			"param_name" => "address", 
			"value" => '121 King Street,<br>Melbourne Victoria 3000,<br>Australia', 
			"description" => __("Enter the address", "js_composer"),
			"dependency" => Array('element' => "contact_info", 'value' => array('yes')),
			"group"	=> __('Contact Info', 'js_composer')
			),

		array(
			"type" => "textfield",
			"heading" => __("Contact Number", "js_composer"),
			"param_name" => "contact_number",
			"value" => "+61 3 8376 6284",
			"description" => __("Enter the contact number.", "js_composer"),
			"dependency" => Array('element' => "contact_info", 'value' => array('yes')),
			"group"	=> __('Contact Info', 'js_composer')
			),

		)
) );


// Call Out Box
vc_map( array(
	"name" => __("Call Out", "js_composer"), //Title
	"base" => "callout", //Shortcode name
	"class" => "",
	"icon" => "icon-pixel8es",
	"category" => 'By Theme Innwit', //category
	"params" => array(

		array(
			"type" => "textfield",
			"heading" => __("Title", "js_composer"),
			"param_name" => "title",
			"value" => "",
			"admin_label" => true,
			"description" => __("Enter the title.", "js_composer"),
			),

		array(
			"type" => "dropdown",
			"heading" => __("Title Tag", "js_composer"),
			"param_name" => "title_tag",
			"value" => array('h2','h1','h3','h4','h5','h6'),
			"description" => __("Select title tag.", "js_composer")
			),

		array(
			"type" => "textarea",
			"class" => "",
			"heading" => __("Callout description", "js_composer"),
			"param_name" => "content", 
			"value" => '', 
			"description" => __("Enter the callout description", "js_composer"),
			),

		array(
			"type" => "dropdown",
			"heading" => __("Show Border?", "js_composer"),
			"param_name" => "border",
			"value" => array( __('Yes', "js_composer") => "yes",
				__('No', "js_composer") => "no"),
			"description" => 'Display callout enclose border'
			),

		array(
			"type" => "dropdown",
			"heading" => __("Callout Style", "js_composer"),
			"param_name" => "callout_style",
			"value" => array( __('Normal', "js_composer") => "normal",
								__('Show Dual Button', "js_composer") => "show_dual_btn",
								__('Show Event Search Form', "js_composer") => "show_event_search_form"
							),
			"description" => 'Select the call out style'
			),

		array(
			"type" => "textfield",
			"heading" => __("First Button Text", "js_composer"),
			"param_name" => "first_btn_txt",
			"value" => "Find Events",
			"description" => __("Enter the first button text here.", "js_composer"),
			"dependency" => Array('element' => "callout_style", 'value' => array('normal')),
			),

		array(
			"type" => "textfield",
			"heading" => __("First Button URL", "js_composer"),
			"param_name" => "first_btn_url",
			"value" => "",
			"description" => __("Enter the first button url here.", "js_composer"),
			"dependency" => Array('element' => "callout_style", 'value' => array('normal')),
			),

		array(
			"type" => "textfield",
			"heading" => __("Second Button Text", "js_composer"),
			"param_name" => "second_btn_txt",
			"value" => "Buy Tickets",
			"description" => __("Enter the second button text here.", "js_composer"),
			"dependency" => Array('element' => "callout_style", 'value' => array('normal')),
			),

		array(
			"type" => "textfield",
			"heading" => __("Second Button URL", "js_composer"),
			"param_name" => "second_btn_url",
			"value" => "",
			"description" => __("Enter the second button url here.", "js_composer"),
			"dependency" => Array('element' => "callout_style", 'value' => array('normal')),
			),

		array(
			"type" => "textfield",
			"heading" => __("Extra class name", "js_composer"),
			"param_name" => "el_class",
			"value" => "",
			"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
			),

		)
) );

// Clients
vc_map( array(
	"name" => __("Clients", "js_composer"), //Title
	"base" => "clients", //Shortcode name
	"class" => "",
	"icon" => "icon-pixel8es",
	"category" => 'By Theme Innwit', //category
	"params" => array(

		array(
			"type" => "attach_images",
			"heading" => __("Images", "js_composer"),
			"param_name" => "images",
			"value" => "",
			"description" => __("Select images from media library.", "js_composer")
			),

		array(
			"type" => "dropdown",
			"heading" => __("Add Link client images?", "js_composer"),
			"param_name" => "link",
			"value" => array( __('Yes', "js_composer") => "yes",
				__('No', "js_composer") => "no"),
			"description" => 'Type the client links seperated with commas'
			),

		array(
			"type" => "textarea",
			"class" => "",
			"heading" => __("Enter links for each client here", "js_composer"),
			"param_name" => "custom_links", 
			"value" => '', 
			"description" => __("Enter links for each client here. Divide links with comma (,).", "js_composer"),
			"dependency" => Array('element' => "link", 'value' => array('yes'))
			),            
		)
) );

// Button
vc_map( array(
	"name" => __("Button", "js_composer"), //Title
	"base" => "button", //Shortcode name
	"class" => "",
	"icon" => "icon-pixel8es",
	"category" => 'By Theme Innwit', //category
	"params" => array(

		array(
			"type" => "textfield",
			"heading" => __("Button Text", "js_composer"),
			"param_name" => "button_text",
			"admin_label" => true,
			"value" => "Read More",
			"description" => __("Enter the Button Text", "js_composer")
			),

		array(
			"type" => "vc_link",
			"heading" => __("Button URL", "js_composer"),
			"param_name" => "button_link",
			"value" => "#",
			"description" => __("Enter the button link", "js_composer")
			),

		array(
			"type" => "dropdown",
			"heading" => __("Button Style", "js_composer"),
			"param_name" => "button_style",
			"value" => array(__('Outline', "js_composer") => "border", 
							 __('Solid', "js_composer") => "solid", 
							 __('Simple (No Bg and No Border)', "js_composer") => "simple"),
			"description" => __("Select button style?", "js_composer")
			),

		array(
			"type" => "dropdown",
			"heading" => __("Button Color", "js_composer"),
			"param_name" => "button_color",
			"value" => array(__('Theme default color', "js_composer") => "btn-color", 
							 __('Grey', "js_composer") => "btn-grey",
							 __('Brown', "js_composer") => "btn-brown",
							 __('Blue', "js_composer") => "btn-blue"), 
			"description" => __("Please choose button color", "js_composer")
			),

		array(
			"type" => "dropdown",
			"heading" => __("Button Size", "js_composer"),
			"param_name" => "button_size",
			"value" => array(__('Medium', "js_composer") => "md", 
							 __('Small', "js_composer") => "sm", 
							 __('Large', "js_composer") => "lg"),
			"description" => __("Select button size?", "js_composer")
			),

		array(
			"type" => "dropdown",
			"heading" => __("Button Event", "js_composer"),
			"param_name" => "button_event",
			"value" => array(__('Active', "js_composer") => "active", 
							 __('Disabled', "js_composer") => "disabled"), 
			"description" => __("Please choose button color", "js_composer")
			),

		array(
			"type" => "dropdown",
			"heading" => __("Custom Font Size?", "js_composer"),
			"param_name" => "custom_size",
			"value" => array(__('No', "js_composer") => "no",
							 __('Yes', "js_composer") => "yes"),
			"description" => __("Do you want to custom font size?", "js_composer")
			),

		array(
			"type" => "textfield",
			"heading" => __("Font Size", "js_composer"),
			"param_name" => "font_size",
			"value" => "",
			"description" => __("Enter the font size in px(Ex: 50px)", "js_composer"),
			"dependency" => Array('element' => "custom_size", 'value' => array('yes'))
			),

		array(
			"type" => "textfield",
			"heading" => __("Custom Padding", "js_composer"),
			"param_name" => "padding_custom",
			"value" => "",
			"description" => __("Enter the padding (in css format [top right bottom left]) in px(Ex: 50px 50px 50px 50px)", "js_composer"),
			"dependency" => Array('element' => "custom_size", 'value' => array('yes'))
			),

		array(
			"type" => "dropdown",
			"heading" => __("Button Align", "js_composer"),
			"param_name" => "button_align",
			"value" => array(__('Left', "js_composer") => "", 
							 __('Center', "js_composer") => "button-center", 
							 __('Right', "js_composer") => "button-right"),
			"description" => __("Select button Align?", "js_composer")
			),		

		array(
			"type" => "icon",
			"heading" => __("Button Icon", "js_composer"),
			"param_name" => "button_icon",
			"value" => '',
			"description" => __("choose button icon.", "js_composer")
			),

		array(
			"type" => "dropdown",
			"heading" => __("Button Icon Align", "js_composer"),
			"param_name" => "button_icon_align",
			"value" => array(__('Front', "js_composer") => "front", 
					 __('Back', "js_composer") => "back"), 
			"description" => __("Where you want to display Icon?", "js_composer")
			),
		)
) );

// Title 
vc_map( array(
	"name" => __("Title", "js_composer"), //Title
	"base" => "title", //Shortcode name
	"class" => "",
	"icon" => "icon-pixel8es",
	"category" => 'By Theme Innwit', //category
	"params" => array(

		array(
			"type" => "textfield",
			"heading" => __("Title", "js_composer"),
			"param_name" => "title",
			"admin_label" => true,
			"value" => "Title",
			"description" => __("Enter the title.", "js_composer")
			),


		array(
			"type" => "dropdown",
			"heading" => __("Title Alignment", "js_composer"),
			"param_name" => "align",
			"value" => array(__('Align Left', "js_composer") => "", 
							 __('Align Center', "js_composer") => "center", 
							 __('Align Right', "js_composer") => "right"),
			"description" => __("Choose Title alignment.", "js_composer")
			),

		array(
			"type" => "dropdown",
			"heading" => __("Font Size", "js_composer"),
			"param_name" => "font_size",
			"value" => array(__('small', "js_composer") => "size-sm", 
							 __('Medium', "js_composer") => "size-md", 
							 __('Large', "js_composer") => "size-lg"),
			"description" => __("Select Font Size.", "js_composer")
			),

			array(
				"type" => "textfield",
				"heading" => __("Font weight", "js_composer"),
				"param_name" => "custom_font_weight",
				"value" => "",
				"description" => __("Enter the Custom title Font weight in (Ex : 300,400,500,600,700,800,900). Leave it empty to apply theme default.", "js_composer")
			),

            array(
				"type" => "textfield",
				"heading" => __("Custom Font Size", "js_composer"),
				"param_name" => "custom_font_size",
				"value" => "",
				"description" => __("Enter the Custom title Font Size in px (Ex : 30px). Leave it empty to apply theme default.", "js_composer")
			),

            array(
				"type" => "textfield",
				"heading" => __("Title Margin", "js_composer"),
				"param_name" => "title_margin",
				"value" => "",
				"description" => __("Value should be in css format top right bottom left in px (Ex: -10px 20px 30px 40px), Leave it empty to apply theme default.", "js_composer")
			),

		array(
			"type" => "dropdown",
			"heading" => __("Title Tag", "js_composer"),
			"param_name" => "title_tag",
			"value" => array('h2','h1','h3','h4','h5','h6'),
			"description" => __("Select title tag.", "js_composer")
			),

		array(
			"type" => "dropdown",
			"heading" => __("Do you want subtitle?", "js_composer"),
			"param_name" => "sub_title",
			"value" => array(__('No', "js_composer") => "no",
				         __('Yes', "js_composer") => "yes"), 
			"description" => __("Do you want subtitle?", "js_composer"),
			"dependency" => Array('element' => "style", 'value' => array('normal-title','box-title','box-small','title-sep','title-right-border'))
			),

		array(
			"type" => "dropdown",
			"heading" => __("Do you want sub_title_style?", "js_composer"),
			"param_name" => "sub_title_style",
			"value" => array(__('Normal', "js_composer") => "",
					 __('Italic', "js_composer") => "italic"), 
			"description" => __("Do you want subtitle?", "js_composer"),
			"dependency" => Array('element' => "sub_title", 'value' => array('yes'))
		),

		array(
			"type" => "textfield",
			"heading" => __("subtitle text", "js_composer"),
			"param_name" => "sub_title_text",
			"value" => "Title",
			"description" => __("Enter the sub title text.", "js_composer"),
			"dependency" => Array('element' => "sub_title", 'value' => array('yes'))
		),

		 array(
				"type" => "textfield",
				"heading" => __("Sub Title Margin Bottom", "js_composer"),
				"param_name" => "sub_title_margin",
				"value" => "",
				"description" => __("Margin bottom for sub title margin bottom in px (Ex: 20px), Leave it empty to apply theme default.", "js_composer"),
				"dependency" => Array('element' => "sub_title", 'value' => array('yes'))
			),

		array(
			"type" => "textfield",
			"heading" => __("Extra class name", "js_composer"),
			"param_name" => "el_class",
			"value" => "",
			"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
			),
		)
) );


// Progress Bar
vc_remove_param("vc_progress_bar", "bgcolor");

//remove animation from single image
vc_remove_param("vc_single_image", "css_animation");

// Spacer
vc_map( array(
	"name" => __("Spacer", "js_composer"), //Title
	"base" => "spacer", //Shortcode name
	"class" => "",
	"icon" => "icon-pixel8es",
	"category" => 'By Theme Innwit', //category
	"params" => array(

		array(
			"type" => "textfield",
			"heading" => __("Spacer", "js_composer"),
			"param_name" => "height",
			"value" => "30px",
			"description" => __("Enter the Space in px (Ex: 30px)", "js_composer")
			),

		)
	) );


// Speakers
vc_map( array(
	"name" => __("Speakers", "js_composer"), //Title
	"base" => "speakers", //Shortcode name
	"class" => "",
	"icon" => "icon-pixel8es",
	"category" => 'By Theme Innwit', //category
	"params" => array(

		array(
			"type" => "dropdown",
			"heading" => __("Insert Speaker by", "js_composer"),
			"param_name" => "insert_type",
			"admin_label" => true,
			"value" => array(__('Speaker Posts', "js_composer") => "posts", 
							 __('Speaker Id', "js_composer") => "id"),
			"description" => ''
			),

		array(
			"type" => "textfield",
			"heading" => __("No. of Speakers", "js_composer"),
			"param_name" => "no_of_speaker",
			"value" => '6',
			"dependency" => Array('element' => "insert_type", 'value' => 'posts'),
			"description" => __("Enter the number of speakers you want to display (only numbers), Enter -1 for all posts", "js_composer")
			),

		array(
			"type" => "dropdown",
			"heading" => __("Order By", "js_composer"),
			"param_name" => "order_by",
			"value" => array( __('Date', "js_composer") => "date",  
							__('Rand', "js_composer") => "rand",
							__('ID', "js_composer") => "ID", 
							__('Title', "js_composer") => "title", 
							__('Author', "js_composer") => "author",
							__('Name', "js_composer") => "modified",
							__('Parent', "js_composer") => "parent",
							__('Date Modified', "js_composer") => "date",
							__('Menu Order', "js_composer") => "menu_order",
							__('None', "js_composer") => "none"),
			"dependency" => Array('element' => "insert_type", 'value' => 'posts'),
			"description" => ''
			),

		array(
			"type" => "dropdown",
			"heading" => __("Order", "js_composer"),
			"param_name" => "order",
			"value" => array( __('Ascending order', "js_composer") => "ASC",  
							  __('descending order', "js_composer") => "DESC"),
			"dependency" => Array('element' => "insert_type", 'value' => 'posts'),
			"description" => __('Choose staffs posts Order', "js_composer")
			),

		array(
			"type" => "textfield",
			"heading" => __("Speaker Id", "js_composer"),
			"param_name" => "speaker_id",
			"value" => "",
			"dependency" => Array('element' => "insert_type", 'value' => 'id'),
			"description" => __("Enter the speaker ids seperated by commas (,). Example: 2,54,8", "js_composer")
			),

		array(
			"type" => "textfield",
			"heading" => __("Exclude Speakers", "js_composer"),
			"param_name" => "exclude_speakers",
			"value" => "",
			"description" => __("Enter the speaker id you don't want to display. Divide id with comma (,).", "js_composer")
			),

		array(
			"type" => "dropdown",
			"heading" => __("Number of Columns", "js_composer"),
			"param_name" => "columns",
			"value" => array( __('4 Columns', "js_composer") => "col4",  
							  __('3 Columns', "js_composer") => "col3"),
			"description" => ''
			),

		array(
			"type" => "dropdown",
			"heading" => __("HTML Tag for Staff Name", "js_composer"),
			"param_name" => "title_tag",
			"value" => array('h2','h3','h4','h5','h6','h1', 'p'),
			"description" => __("Choose which html tag you want use for staff name.", "js_composer")
			),

		array(
			"type" => "dropdown",
			"heading" => __("Speaker Description", "js_composer"),
			"param_name" => "speaker_desc",
			"value" => array(__('Yes', "js_composer") => "yes",  
							 __('No', "js_composer") => "no"),
			"description" => __("Do you like to show speaker description", "js_composer")
			) 

		)
) );


// Event Counter
vc_map( array(
	"name" => __("Event Counter", "js_composer"), //Title
	"base" => "event_counter", //Shortcode name
	"class" => "",
	"icon" => "icon-pixel8es",
	"category" => 'By Theme Innwit', //category
	"params" => array(

		array(
			"type" => "dropdown",
			"heading" => __("Insert counter by", "js_composer"),
			"param_name" => "depends_on",
			"value" => array(__('Auto', "js_composer") => "auto",
			__('Manual', "js_composer") => "manual"), 
				
			"description" => ''
			),

		array(
			"type" => "textfield",
			"heading" => __("Date", "js_composer"),
			"param_name" => "date",
			"value" => "",
			"dependency" => Array('element' => "depends_on", 'value' => 'manual'),
			"description" => __("Enter the event date in this format (dd/mm/yyyy).", "js_composer")
			),

		array(
			"type" => "textfield",
			"heading" => __("Time", "js_composer"),
			"param_name" => "time",
			"value" => "",
			"dependency" => Array('element' => "depends_on", 'value' => 'manual'),
			"description" => __("Enter the event time in this format (hh:mm:ss).", "js_composer")
			),

		array(
			"type" => "dropdown",
			"heading" => __("Meridian", "js_composer"),
			"param_name" => "meridian",
			"value" => array(__('AM', "js_composer") => "AM", 
				__('PM', "js_composer") => "PM"),
			"dependency" => Array('element' => "depends_on", 'value' => 'manual'),
			"description" => __("Select the event time meridian", "js_composer")
			), 

		array(
    		"type" => "colorpicker",
    		"class" => "",
    		"heading" => __("Border Color", "js_composer"),
    		"param_name" => "color",
    		"value" => "#c4cbcf", 
    		"description" => __("Enter the counter border color", "js_composer"),
    		),

		)
) );


// Event Search Form
vc_map( array(
	"name" => __("Event Search Form", "js_composer"), //Title
	"base" => "event_search", //Shortcode name
	"class" => "",
	"icon" => "icon-pixel8es",
	"category" => 'By Theme Innwit', //category
	"params" => array(

		array(
			"type" => "textfield",
			"heading" => __("Main Title", "js_composer"),
			"param_name" => "main_title",
			"value" => "",
			"description" => __("Enter the main title here", "js_composer")
			),

		array(
			"type" => "textfield",
			"heading" => __("Sub Title", "js_composer"),
			"param_name" => "sub_title",
			"value" => "",
			"description" => __("Enter the sub title here", "js_composer")
			)

		)
) );


// Testimonial
vc_map( array(
	"name" => __("Testimonials", "js_composer"), //Title
	"base" => "testimonial", //Shortcode name
	"class" => "",
	"icon" => "icon-pixel8es",
	"category" => 'By Theme Innwit', //category
	"params" => array(

		array(
			"type" => "dropdown",
			"heading" => __("Insert testimonials by", "js_composer"),
			"param_name" => "insert_type",
			"value" => array(__('testimonials Posts', "js_composer") => "posts", 
				__('testimonial Id', "js_composer") => "id"),
			"description" => ''
			),

		array(
			"type" => "textfield",
			"heading" => __("No. of testimonials", "js_composer"),
			"param_name" => "no_of_testimonial",
			"value" => -1,
			"dependency" => Array('element' => "insert_type", 'value' => 'posts'),
			"description" => __("Enter the number of testimonials you want to display (only numbers), Enter -1 for all posts", "js_composer")
			),

		array(
			"type" => "dropdown",
			"heading" => __("Order By", "js_composer"),
			"param_name" => "order_by",
			"value" => array( __('Date', "js_composer") => "date",  
				__('Rand', "js_composer") => "rand",
				__('ID', "js_composer") => "ID", 
				__('Title', "js_composer") => "title", 
				__('Author', "js_composer") => "author",
				__('Name', "js_composer") => "modified",
				__('Parent', "js_composer") => "parent",
				__('Date Modified', "js_composer") => "date",
				__('Menu Order', "js_composer") => "menu_order",
				__('None', "js_composer") => "none"),
			"dependency" => Array('element' => "insert_type", 'value' => 'posts'),
			"description" => ''
			),

		array(
			"type" => "dropdown",
			"heading" => __("Order", "js_composer"),
			"param_name" => "order",
			"value" => array( __('Ascending order', "js_composer") => "ASC",  
				__('descending order', "js_composer") => "DESC"),
			"dependency" => Array('element' => "insert_type", 'value' => 'posts'),
			"description" => ''
			),

		array(
			"type" => "textfield",
			"heading" => __("testimonial Id", "js_composer"),
			"param_name" => "testimonial_id",
			"value" => "",
			"dependency" => Array('element' => "insert_type", 'value' => 'id'),
			"description" => __("Enter the testimonial ids seperated by commas (,). Example: 2,54,8", "js_composer")
			),

		array(
			"type" => "textfield",
			"heading" => __("Exclude Testimonials", "js_composer"),
			"param_name" => "exclude_testimonial",
			"value" => "",
			"description" => __("Enter the testimonial id you don't want to display. Divide id with comma (,).", "js_composer")
			),  

		)
) );

// upcoming
vc_map( array(
	"name" => __("Upcoming Popular Tab", "js_composer"), //Title
	"base" => "upcoming_popular_tab", //Shortcode name
	"class" => "",
	"icon" => "icon-pixel8es",
	"category" => 'By Theme Innwit', //category
	"params" => array(

		array(
			"type" => "textfield",
			"heading" => __("Tab One Title", "js_composer"),
			"param_name" => "tab_one_title",
			"value" => "Upcoming Events",
			"description" => __("Enter The Tab One Title.", "js_composer")
		),

		array(
			"type" => "textfield",
			"heading" => __("Tab Two Title", "js_composer"),
			"param_name" => "tab_two_title",
			"value" => "Popular Events",
			"description" => __("Enter The Tab Two Title.", "js_composer")
		),

		array(
			"type" => "dropdown",
			"heading" => __("Title Tag", "js_composer"),
			"param_name" => "title_tag",
			"value" => array('h2','h1','h3','h4','h5','h6'),
			"description" => __("Select title tag.", "js_composer")
		),

		array(
			"type" => "textfield",
			"heading" => __("Number of Events", "js_composer"),
			"param_name" => "no_of_event",
			"value" => 4,
			"description" => __("How many events you want to display?", "js_composer")
		),

		array(
			"type" => "textfield",
			"heading" => __("Limit", "js_composer"),
			"param_name" => "limit",
			"value" => 200,
			"description" => __("Enter The  Limit Value .", "js_composer")
		),

		array(
			"type" => "dropdown",
			"heading" => __("Show Meta", "js_composer"),
			"param_name" => "meta",
			"value" => array( __('Yes', "js_composer") => "yes",  
							  __('No', "js_composer") => "no"),
			"description" => __("Show meta value ..?", "js_composer")
		),


		array(
			"type" => "dropdown",
			"heading" => __("Show View All Event Button", "js_composer"),
			"param_name" => "display_button",
			"value" => array(__('Yes', "js_composer") => "yes",  
							 __('No', "js_composer") => "no"),
			"description" => __('Do you want to display view all event button?', "js_composer"),
			"group"	=> __('Button', 'js_composer')
			),

		array(
			"type" => "dropdown",
			"heading" => __("Target", "js_composer"),
			"param_name" => "target",
			"value" => array(__('Self', "js_composer") => "_self",  
							 __('Blank', "js_composer") => "_blank"),
			"description" => __('Do you want to display view all event button?', "js_composer"),
			"group"	=> __('Button', 'js_composer')
		),

		array(
			"type" => "textfield",
			"heading" => __("Button Text", "js_composer"),
			"param_name" => "button_text",
			"value" => "View All Event",
			"description" => __("Enter the Button Text", "js_composer"),
			"dependency" => Array('element' => "display_button", 'value' => "yes"),
			"group"	=> __('Button', 'js_composer')
			),


		array(
			"type" => "dropdown",
			"heading" => __("Button Style", "js_composer"),
			"param_name" => "button_style",
			"value" => array(__('Outline', "js_composer") => "border", 
							 __('Solid', "js_composer") => "solid", 
							 __('Simple (No Bg and No Border)', "js_composer") => "simple"),
			"description" => __("Select button style?", "js_composer"),
			"dependency" => Array('element' => "display_button", 'value' => "yes"),
			"group"	=> __('Button', 'js_composer')
			),

		array(
			"type" => "dropdown",
			"heading" => __("Button Color", "js_composer"),
			"param_name" => "button_color",
			"value" => array(__('Theme default color', "js_composer") => "btn-color", 
							 __('Grey', "js_composer") => "btn-grey",
							 __('Brown', "js_composer") => "btn-brown",
							 __('Blue', "js_composer") => "btn-blue"), 
			"description" => __("Please choose button color", "js_composer"),
			"dependency" => Array('element' => "display_button", 'value' => "yes"),
			"group"	=> __('Button', 'js_composer')
			),

		array(
			"type" => "dropdown",
			"heading" => __("Button Size", "js_composer"),
			"param_name" => "button_size",
			"value" => array(__('Medium', "js_composer") => "md", 
							 __('Small', "js_composer") => "sm", 
							 __('Large', "js_composer") => "lg"),
			"description" => __("Select button size?", "js_composer"),
			"dependency" => Array('element' => "display_button", 'value' => "yes"),
			"group"	=> __('Button', 'js_composer')
			),

		array(
			"type" => "textfield",
			"heading" => __("Extra class name", "js_composer"),
			"param_name" => "el_class",
			"value" => "",
			"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
			),

	)
) );


//Register "container" content element. It will hold all your inner (child) content elements
vc_map( array(
	"name" => __("Lists", "js_composer"),
	"base" => "list",
	"icon" => "icon-pixel8es",
	"category" => 'By Theme Innwit', //category
    "as_parent" => array('only' => 'li'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    "content_element" => true,
    "show_settings_on_create" => false,
    /*"params" => array(
        // add params same as with any other content element
    	array(
    		"type" => "dropdown",
    		"heading" => __("Style", "js_composer"),
    		"param_name" => "style",
    		"value" => array( __('default', "js_composer") => "default",
    			__('style1', "js_composer") => "style1",
    			__('style2', "js_composer") => "style2"),
    		"description" => __("Choose list style", "js_composer"),
    		)
    	),*/
    "js_view" => 'VcColumnView'
    ) );
vc_map( array(
	"name" => __("List Item", "js_composer"),
	"base" => "li",
	"icon" => "icon-pixel8es",
	"category" => 'By Theme Innwit', //category
	"content_element" => true,
    "as_child" => array('only' => 'list'), // Use only|except attributes to limit parent (separate multiple values with comma)
    "params" => array(
        // add params same as with any other content element
    	array(
    		"type" => "icon",
    		"heading" => __("Insert Icon", "js_composer"),
    		"param_name" => "icon_name",
    		"value" => '',
    		"description" => __("Choose icon if you to display icons before list", "js_composer")
    		),

    	/*content*/
    	array(
    		"type" => "textarea",
    		"holder" => "li",
    		"class" => "",
    		"heading" => __("Content", "js_composer"),
    		"param_name" => "content",
    		"value" => "Enter your list item text here",
    		"description" => __("Enter your list item content.", "js_composer")
    		),

    	array(
    		"type" => "dropdown",
    		"heading" => __("Icon Color", "js_composer"),
    		"param_name" => "icon_color",
    		"value" => array(__('black', "js_composer") => "",  
    			__('Theme Primary Color', "js_composer") => "color",
    			__('custom color', "js_composer") => "custom"),
    		"description" => ''
    		),

    	array(
    		"type" => "colorpicker",
    		"class" => "",
    		"heading" => __("Text color", "js_composer"),
    		"param_name" => "user_icon_color",
    		"value" => '', 
    		"description" => __("Choose text color", "js_composer"),
    		"dependency" => Array('element' => "icon_color", 'value' => array('custom'))
    		),
    	)
) );
//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_list extends WPBakeryShortCodesContainer {
	}
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_li extends WPBakeryShortCode {
	}
}