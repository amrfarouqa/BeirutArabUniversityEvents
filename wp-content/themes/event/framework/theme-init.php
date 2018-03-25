<?php
	
	/********************/
	/* Define Constants */
	/********************/
	define('THEME_DIR', get_template_directory());
	define('THEME_URI', get_template_directory_uri());
		
	define('THEME_FRAMEWORK',     THEME_DIR . '/framework');
	define('THEME_FRAMEWORK_URI', THEME_URI . '/framework');

	define('THEME_CUSTOM_STYLES',		THEME_FRAMEWORK . '/custom_styles');
	define('THEME_CUSTOM_STYLES_URI', 	THEME_FRAMEWORK_URI . '/custom_styles');
		
	define('THEME_PLUGINS', 		 THEME_FRAMEWORK . 	'/plugins');
	define('THEME_PLUGINS_URI', 	 THEME_FRAMEWORK_URI . 	'/plugins');
	define('THEME_FUNCTIONS', 			 THEME_FRAMEWORK . 	'/required-functions');
	define('THEME_FUNCTIONS_URI',	 THEME_FRAMEWORK_URI .  '/required-functions');
	define('THEME_WIDGETS', 		 THEME_FRAMEWORK . 	'/widgets');
	define('THEME_SHORTCODES', 		 THEME_FRAMEWORK . 	'/shortcodes');
	define('THEME_ADMIN_EDITOR', 	 THEME_FRAMEWORK . 	'/editor');
	define('THEME_ADMIN_EDITOR_URI', THEME_FRAMEWORK_URI . '/editor');
	define('THEME_ADMIN_OPTION',	 THEME_FRAMEWORK .	'/theme-options');
	define('THEME_CUSTOM_POSTS', 	 THEME_FRAMEWORK . 	'/custom_posts');
	define('THEME_CUSTOM_METABOXES', THEME_FRAMEWORK . 	'/custom_metaboxes');
	define('THEME_CUSTOM_METABOXES_URI', THEME_FRAMEWORK_URI . 	'/custom_metaboxes');
	
	require_once(THEME_FRAMEWORK. '/add-plugins.php'); //Install required plugins

	require_once (THEME_ADMIN_OPTION . 	'/theme-option.php'); //Theme Option Page
	
	require_once (THEME_FUNCTIONS . 	'/theme-functions.php'); //All Theme Function
	
	require_once (THEME_ADMIN_EDITOR . 	'/init_button.php'); //Shortcode Insert Button	
	
	require_once (THEME_SHORTCODES . 	'/shortcodes.php'); //All Shortcodes

	if (class_exists('WPBakeryVisualComposerAbstract')) {

		if(function_exists('vc_set_as_theme')) vc_set_as_theme();               

		vc_set_template_dir( THEME_FRAMEWORK . '/vc_templates/');

		require_once locate_template('/framework/vc_templates/extend_vc/extend_vc.php');
	}
	

	require_once (THEME_WIDGETS . '/widgets.php'); //All Widgets
	
	/***********************************/
	/* Custom Post types and metaboxes */
	/***********************************/
	
	require_once (THEME_CUSTOM_POSTS . '/post_type.php');
	require_once (THEME_CUSTOM_METABOXES . '/metabox.php');
	
	/*******************/
	/* Include Plugins */
	/*******************/
	require_once (THEME_PLUGINS . '/plugins.php');
