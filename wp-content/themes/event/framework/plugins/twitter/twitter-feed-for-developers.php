<?php
/*
Plugin Name: oAuth Twitter Feed for Developers
Description: Twitter API 1.1 compliant plugin that provides a function to get an array of tweets from the auth'd users Twitter feed for use in themes.
Version: 2.0.3
License: MIT
License URI: http://opensource.org/licenses/MIT
Author: Storm Consultancy (Liam Gladdy)
Author URI: http://www.stormconsultancy.co.uk
*/


require('StormTwitter.class.php');


/* implement getTweets */
function getTweets($count = 20, $username = false, $options = false) {
  global $smof_data;
  $config['key'] 			= isset($smof_data['twitter_api_consumer_key']) ? $smof_data['twitter_api_consumer_key'] : '';
  $config['secret'] 		= isset($smof_data['twitter_api_consumer_secret_key']) ? $smof_data['twitter_api_consumer_secret_key'] : '';
  $config['token'] 			= isset($smof_data['twitter_api_access_token']) ? $smof_data['twitter_api_access_token'] : '';
  $config['token_secret'] 	= isset($smof_data['twitter_api_access_token_secret_key']) ? $smof_data['twitter_api_access_token_secret_key'] : '';
  $config['screenname'] 	= "envato";
  $config['cache_expire'] 	= intval(isset($smof_data['twitter_cache_duration']) ? $smof_data['twitter_cache_duration'] : 3600);

  if ($config['cache_expire'] < 1) $config['cache_expire'] = 3600;
  $config['directory'] = THEME_PLUGINS . '/twitter/';
  
  $obj = new StormTwitter($config);
  $res = $obj->getTweets($count, $username, $options);
  update_option('tdf_last_error',$obj->st_last_error);
  return $res;
  
}
