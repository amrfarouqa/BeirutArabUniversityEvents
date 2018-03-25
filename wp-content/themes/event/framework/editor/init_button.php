<?php

$pluginname = 'pixel8es_shortcodes_button';
$pix_base_dir = get_template_directory_uri() . '/framework/editor';

function pixel8es_shortcodes_button() 
{	
   // Only add hooks when the current user has permissions AND is in Rich Text editor mode
   if ( current_user_can('edit_posts') && current_user_can('edit_pages') && get_user_option('rich_editing') == 'true' )
	{
		//Loading necessary Files
		add_action( 'admin_enqueue_scripts'	, 'pixel8es_admin_enqueue' );

		add_filter('mce_external_plugins'	, 'pixel8es_add_shortcodes_tinymce_plugin');
		add_filter('mce_buttons'			, 'pixel8es_register_buttons');
		add_filter( 'admin_print_scripts'	, 'pixel8es_create_menu' ); 
		add_action('wp_ajax_pix_sc_options'	, 'pixel8es_sc_options');
	}
}

function pixel8es_admin_enqueue($hook_suffix){
	if( 'post.php' == $hook_suffix || 'post-new.php' == $hook_suffix ){
		//Shortcode Generator Required Files
		wp_enqueue_style('tinymce_style'	, THEME_ADMIN_EDITOR_URI ."/tinymce/css/style.css");
		wp_enqueue_script('pixel8es_tinymce', THEME_ADMIN_EDITOR_URI ."/tinymce/js/dialog.js", array('jquery'), '0.1');
	}
}

function pixel8es_create_menu(){
	require_once ('tinymce/init_menu.php');
	echo "<script type='text/javascript'>\n";
	echo "var pix_menu_globals = {}, pix_dialog_globals = {};\n";
	//echo "siteURL = ".site_url()."\n";
	echo "pix_dialog_globals = " . json_encode($pix_dialog) . ";\n";
	echo "pix_menu_globals = " . json_encode($pix_menu) . ";\n";
	echo "\n</script>";	
}
 
function pixel8es_register_buttons($buttons) {
   array_push($buttons, "separator", "pixel8es_shortcodes_button");
   return $buttons;
}
 
// Load the TinyMCE plugin
function pixel8es_add_shortcodes_tinymce_plugin($plugin_array) {
   global $pix_base_dir;
   global $wp_version;
	$suffix = '';
	if ( '3.9' <= $wp_version ) {
		$suffix = '_39';
	}
   $plugin_array['pixel8es_shortcodes_button'] = $pix_base_dir . '/tinymce/editor_plugin'. $suffix .'.js';
   return $plugin_array;
}

function pixel8es_sc_options(){
	$pix_options = 'Options Not Set';
	$sc_file_name = isset($_REQUEST['pix_sc']) ? $_REQUEST['pix_sc'] : 'Not set';
	require_once('shortcodes/' . $sc_file_name .'.php');	
	$pix_options = json_encode($pix_options);
    echo $pix_options;
	
	die();
}
 
// init process for button control
add_action('init', 'pixel8es_shortcodes_button');

?>