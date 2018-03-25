<?php
if ( !defined('WP_LOAD_IMPORTERS') ) {
	define('WP_LOAD_IMPORTERS', true);
}

// Load Importer API
require_once ABSPATH . 'wp-admin/includes/import.php';

//check if wp_importer class is available and include include it
if ( !class_exists( 'WP_Importer' ) ) {
	$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
	if ( file_exists( $class_wp_importer ) )
		require_once $class_wp_importer;
}

//check if wp_import class is available and include include it
if ( !class_exists( 'WP_Import' ) ) {
	$class_wp_import = THEME_FUNCTIONS . '/pix-importer/wordpress-importer.php';
	if ( file_exists( $class_wp_import ) )
		@require_once($class_wp_import);
}

$demo_file = get_template_directory(). '/demo_data/demo.xml';



if ( class_exists( 'WP_Import' )) 
{
	include_once('class.pix-importer.php');

	if(!is_file($demo_file)){
		echo "The demo XML file could be loaded, please try to set file permission to cmod 777. If it doesn't work, please upload demo xml using wordpress importer. Demo xml file should be available in theme package";
	}else{

		if(isset($_POST['pix_attach'])){
			$fetch_attachments = ($_POST['pix_attach'] == 'true') ? true : false;
		}else{
			$fetch_attachments = false;
		}
		
		set_time_limit(0);
		$pix_import = new pix_import();
		$pix_import->fetch_attachments = $fetch_attachments;
		$is_done = $pix_import->import( $demo_file );
		$pix_import->apply_menus(); // Set Default Menu
		$pix_import->set_default_page(); // Set Home and Blog Pages
		$pix_import->set_permalink(); // Set Permalink

		if(is_wp_error($is_done)){
			echo "An Error Occurred During Import.";
		}else{
			echo "Demo Sucessfully updated.";
		}
	}

}else{
	echo "Error loading Auto Importer files. Please  upload demo xml using wordpress importer";
}