<?php


class pix_import extends WP_Import{

	function apply_menus(){

		/* If register Menu name and create nav is equal then theme location will set automatically on import*/
		$pix_registered_nav = get_registered_nav_menus();
		$pix_menus  = wp_get_nav_menus();

		$nav_loc   = get_theme_mod('nav_menu_locations');


	    if(!empty($pix_registered_nav) && !empty($pix_menus)){

	    	foreach ($pix_registered_nav as $id => $nav) {
	    		foreach ($pix_menus as $pix_menu) {
	    			if($nav == $pix_menu->name){
	    				$key = (int)$pix_menu->term_id;
	    			}               
	    		}
	    		$nav_loc[$id] = $key;
	    		$key = '';
	    	}
	    }
	    
	    set_theme_mod( 'nav_menu_locations', $nav_loc);
	}

	function set_sidebar(){
		$widget_positions = get_option('sidebars_widgets');
		$widget_options = array();
		foreach($widget_positions as $sidebar_name => $widgets){
		    if(is_array($widgets)){
		        foreach($widgets as $widget_name){
		            $widget_name_strip = preg_replace('#-\d+$#','',$widget_name);
		            $widget_options[$widget_name_strip] = get_option('widget_'.$widget_name_strip);
		        }
		    }
		}
		print_r($widget_positions);
		print_r($widget_options);
	}

	function set_default_page(){

	    $home = get_page_by_title( 'Home' ); 
	    $blog = get_page_by_title( 'Blog' ); 

	    update_option( 'show_on_front', 'page');            
	    update_option( 'page_on_front', $home->ID);
	    update_option( 'page_for_posts', $blog->ID);
	   
	}

	function set_permalink(){
	   global $wp_rewrite;
	   $wp_rewrite->set_permalink_structure('%postname%/');
	   $wp_rewrite->flush_rules();
	}
}