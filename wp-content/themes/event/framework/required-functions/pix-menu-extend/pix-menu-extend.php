<?php
class Pix_Menu_Extend {

	/*--------------------------------------------*
	 * Constructor
	 *--------------------------------------------*/

	/**
	 * Initializes the plugin by setting localization, filters, and administration functions.
	 */
	function __construct() {

		// add custom menu fields to menu
		add_filter( 'wp_setup_nav_menu_item', array( $this, 'pix_add_custom_nav_fields' ) );
		
		// save menu custom fields
		add_action( 'wp_update_nav_menu_item', array( $this, 'pix_update_custom_nav_fields'), 10, 3 );
		
		// edit menu walker
		add_filter( 'wp_edit_nav_menu_walker', array( $this, 'pix_edit_walker'), 10, 2 );

		//adding required menu scripts
		add_action( 'admin_enqueue_scripts', array( $this,'pix_menu_admin_scripts') );

	} // end constructor


	/**
	 * Load Required Styles and scripts 
	 * only for Nav Menu page.
	 * 
	*/
	function pix_menu_admin_scripts($hook_suffix) {
		if('nav-menus.php' ==  $hook_suffix){
			//Loading Css
			wp_enqueue_style('menu_font_style'	, get_template_directory_uri() ."/library/css/font-awesome.css");
			wp_enqueue_style('menu_style', THEME_FUNCTIONS_URI ."/pix-menu-extend/css/style.css");
			//Load Insert Icon Plugin
			wp_enqueue_script( 'menu_js', THEME_FUNCTIONS_URI .'/pix-menu-extend/js/dialog.js', array( 'jquery' ));
		}
	}	
	

	/**
	 * Add custom fields to $item nav object
	 * in order to be used in custom Walker
	 *
	 * @access      public
	 * @since       1.0 
	 * @return      void
	*/
	function pix_add_custom_nav_fields( $menu_item ) {

		$menu_item->icon = get_post_meta( $menu_item->ID, '_menu_item_icon', true );
		$menu_item->megamenu = get_post_meta( $menu_item->ID, '_menu_item_megamenu', true );
		$menu_item->megamenucol = get_post_meta( $menu_item->ID, '_menu_item_megamenucol', true );
		$menu_item->megamenupos = get_post_meta( $menu_item->ID, '_menu_item_megamenupos', true );
		$menu_item->megamenutitle = get_post_meta( $menu_item->ID, '_menu_item_megamenutitle', true );
		return $menu_item;
	
	}
	
	
	/**
	 * Save menu custom fields
	 *
	 * @access      public
	 * @since       1.0 
	 * @return      void
	*/
	function pix_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {
	
		// Check if element is properly sent
		if ( isset($_REQUEST['menu-item-icon']) && is_array( $_REQUEST['menu-item-icon']) ) {
			$icon_value = (isset($_REQUEST['menu-item-icon'][$menu_item_db_id]) && $_REQUEST['menu-item-icon'][$menu_item_db_id])  ? $_REQUEST['menu-item-icon'][$menu_item_db_id] : '';
			update_post_meta( $menu_item_db_id, '_menu_item_icon', $icon_value );
		}

		if ( isset($_REQUEST['menu-item-megamenu']) && is_array( $_REQUEST['menu-item-megamenu']) && isset($_REQUEST['menu-item-megamenu'][$menu_item_db_id]) ){			
			update_post_meta( $menu_item_db_id, '_menu_item_megamenu', true );
		}else{
			update_post_meta( $menu_item_db_id, '_menu_item_megamenu', false );
		}

		if ( isset($_REQUEST['menu-item-megamenucol']) && is_array( $_REQUEST['menu-item-megamenucol']) ) {
			$megamenucol_value = (isset($_REQUEST['menu-item-megamenucol'][$menu_item_db_id]) && $_REQUEST['menu-item-megamenucol'][$menu_item_db_id])  ? $_REQUEST['menu-item-megamenucol'][$menu_item_db_id] : '';
			update_post_meta( $menu_item_db_id, '_menu_item_megamenucol', $megamenucol_value );
		}

		if ( isset($_REQUEST['menu-item-megamenupos']) && is_array( $_REQUEST['menu-item-megamenupos']) && isset($_REQUEST['menu-item-megamenupos'][$menu_item_db_id]) ){			
			update_post_meta( $menu_item_db_id, '_menu_item_megamenupos', true );
		}else{
			update_post_meta( $menu_item_db_id, '_menu_item_megamenupos', false );
		}

		if ( isset($_REQUEST['menu-item-megamenutitle']) && is_array( $_REQUEST['menu-item-megamenutitle']) && isset($_REQUEST['menu-item-megamenutitle'][$menu_item_db_id]) ){			
			update_post_meta( $menu_item_db_id, '_menu_item_megamenutitle', true );
		}else{
			update_post_meta( $menu_item_db_id, '_menu_item_megamenutitle', false );
		}
		
	}
	
	/**
	 * Define new Walker edit
	 *
	 * @access      public
	 * @since       1.0 
	 * @return      void
	*/
	function pix_edit_walker($walker,$menu_id) {
	
		return 'Pix_Walker_Nav_Menu_Edit_Custom';
	
	}

}

// instantiate class
$GLOBALS['pix_entend_menu'] = new Pix_Menu_Extend();

include_once( 'pix_edit_custom_walker.php' );
include_once( 'pix_custom_walker.php' );

function pix_load_icon_fonts(){
	//global $pix_icon_font;
	global $pix_icons_class_html;
	$pix_icon_font_json = json_encode($pix_icons_class_html);
    echo $pix_icon_font_json;
	
	die();
}
add_action('wp_ajax_pix_load_icon_fonts', 'pix_load_icon_fonts');