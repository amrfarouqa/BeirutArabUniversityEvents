<?php
	//Other 3rd Party Plugins
    require_once (THEME_PLUGINS . '/twitter/twitter-feed-for-developers.php');//Twitter
	require_once (THEME_PLUGINS . '/aq_resizer.php');//Image Resize
	require_once (THEME_PLUGINS . '/multiple_sidebars.php');//Multiple Sidebar
	require_once (THEME_PLUGINS . '/selectivizr/selectivizr.php');//CSS3 selectors for IE support
	
	/* 
		Plugin Name: Themeforest Themes Update
		Plugin URI: https://github.com/bitfade/themeforest-themes-update
		Description: Updates all themes purchased from themeforest.net 
		Author: pixelentity
		Version: 1.0
		Author URI: http://pixelentity.com
	*/


	// to debug
	// set_site_transient('update_themes',null);
	global $smof_data;

	$themeforest_username = isset($smof_data['themeforest_username'])? $smof_data['themeforest_username'] : null;
	$themeforest_apikey = isset($smof_data['themeforest_apikey'])? $smof_data['themeforest_apikey'] : null;

	// USERNAME = buyer username on Envato
	define('THEMEFOREST_USERNAME','USERNAME');

	// APIKEY = buyer api key
	define('THEMEFOREST_APIKEY','APIKEY');

?>