<?php
/*
 Plugin Name: EventON - Subscriber
 Plugin URI: http://www.myeventon.com/
 Description: Subscribe to all calendar events
 Author: Ashan Jay
 Version: 1.0
 Author URI: http://www.ashanjay.com/
 Requires at least: 3.8
 Tested up to: 4.4
 */

 class eventon_sb{
 	public $version='1.0';
	public $eventon_version = '2.3.20';
	public $name = 'Subscriber';
	public $id = 'EVOSB';

	public $rss_slug;
	public $print_scripts_on = false;

 	// Construct
	public function __construct(){
		$this->super_init();
		add_action('plugins_loaded', array($this, 'plugin_init'));
	}

	function plugin_init(){
		if(class_exists('EventON')){
			include_once( 'includes/admin/class-admin_check.php' );
			$this->check = new addon_check($this->addon_data);
			$check = $this->check->initial_check();
			
			if($check){
				// initiate eventon addon
				$this->addon = new evo_addon($this->addon_data);

				$this->helper = new evo_helper();

				add_action( 'init', array( $this, 'init' ), 0 );
				// settings link in plugins page
				add_filter("plugin_action_links_".$this->plugin_slug, array($this,'plugin_links' ));
			}
		}else{
			add_action('admin_notices', array($this, '_eventon_warning'));
		}
	}
	function _eventon_warning(){
		?><div class="message error"><p><?php _e('EventON is required for this addon to work properly.', 'eventon'); ?></p></div><?php
	}
	
	// SUPER init
		function super_init(){
			// PLUGIN SLUGS			
			$this->addon_data['plugin_url'] = path_join(WP_PLUGIN_URL, basename(dirname(__FILE__)));
			$this->addon_data['plugin_slug'] = plugin_basename(__FILE__);
			list ($t1, $t2) = explode('/', $this->addon_data['plugin_slug'] );
	        $this->addon_data['slug'] = $t1;
	        $this->addon_data['plugin_path'] = dirname( __FILE__ );
	        $this->addon_data['evo_version'] = $this->eventon_version;
	        $this->addon_data['version'] = $this->version;
	        $this->addon_data['name'] = $this->name;

	        $this->plugin_url = $this->addon_data['plugin_url'];
	        $this->plugin_slug = $this->addon_data['plugin_slug'];
	        $this->slug = $this->addon_data['slug'];
	        $this->plugin_path = $this->addon_data['plugin_path'];
		}

	// INITIATE please
		function init(){				
			// Activation
			$this->addon->activate();	
			
			// Deactivation
			register_deactivation_hook( __FILE__, array($this,'deactivate'));

			include_once($this->plugin_path.'/includes/class-shortcodes.php');
			include_once($this->plugin_path.'/includes/class-post-type.php');
			include_once($this->plugin_path.'/includes/class-frontend.php');

			$this->frontend = new evosb_front();

			// RUN addon updater only in dedicated pages
			if ( is_admin() ){
				$this->addon->updater();
				include_once($this->plugin_path.'/includes/admin/class-admin-init.php');
				$this->admin = new evosb_admin();
			}

			//AJAX includes
			if ( defined('DOING_AJAX') ){
				include_once($this->plugin_path.'/includes/class-ajax.php');
			}	
	
		}
	
	
 	// Deactivate addon
		function deactivate(){
			$this->addon->remove_addon();
		}

	// plugin link in settings
		function plugin_links($links){
			$settings_link = '<a href="admin.php?page=eventon&tab=evcal_sb">'.__('Settings','eventon').'</a>'; 
			array_unshift($links, $settings_link); 
	 		return $links; 	
		}
	// language
		public function lang($variable, $default_text, $lang=''){
			return eventon_get_custom_language($this->frontend->evoOpt2, $variable, $default_text, $lang);
		}
		
 }

// Initiate this addon within the plugin
$GLOBALS['eventon_sb'] = new eventon_sb();