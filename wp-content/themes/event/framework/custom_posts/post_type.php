<?php

require_once ('manage_columns.php');

/* Custom Post Type Class */

class pix_post_type{
	
	public function __construct($name, $singluar_name, $args){
		$this -> register_post_type($name, $singluar_name, $args);	
	}	
	
	//Registering Post Types
	public function register_post_type($name, $singluar_name, $args){ 

		$args = array_merge(
			array(
				'labels' => array(
					'name' 			=> $name,
					'singular_name' => $singluar_name,
					'add_new'		=> "Add New $singluar_name",
					'add_new_item' 	=> "Add New $singluar_name",
					'edit_item' 	=> "Edit $singluar_name",
					'new_item' 		=> "New $singluar_name",
					'view_item' 	=> "View $singluar_name",
					'search_items' 	=> "Search $name",
					'not_found' 	=> "No $name found",
					'all_items' => "All $name",
					'not_found_in_trash' 	=> "No $name found in Trash", 
					'parent_item_colon' 	=> '',
					'menu_name' 	=>  $name
					),
				'public' 	=> true,
				'query_var' => strtolower($singluar_name),
				'hierarchical' => true,
				'rewrite' 	=> array(
					'slug' => $name
					),
				'menu_icon' =>	admin_url().'images/media-button-video.gif',		 
				'supports' 	=> array('title','editor')
				),
			$args  
			);

		register_post_type('pix_' . strtolower($name), $args);
	}
	
	//Taxonomies
	public function taxonomies($post_types, $tax_arr)
	{		
		$taxonomies = array();

		foreach ($tax_arr as $name => $arr){
			
			$singular_name = $arr['singular_name'];
			
			$labels = array(
				'name' => $name,
				'singular_name' => $singular_name,
				'add_new' => "Add New $singular_name",
				'add_new_item' => "Add New $singular_name",
				'edit_item' => "Edit $singular_name",
				'new_item' => "New $singular_name",
				'view_item' => "View $singular_name",
				'update_item' => "Update $singular_name",
				'search_items' => "Search $name",
				'not_found' => "$name Not Found",
				'not_found_trash' => "$name Not Found in Trash",
				'all_items' => "All $name",
				'separate_items_with_comments' => "Separate tags with commas"
				);

			$defaultArr = array(
				'hierarchical' => true,
				'query_var' => true,
				'rewrite' => array('slug' => $name),
				'labels' => $labels	
				);
			
			$taxonomies[$name] =  array_merge($defaultArr, $arr);
			
		}
		
		$this -> register_all_taxonomies($post_types, $taxonomies);	
	}
	
	public function register_all_taxonomies($post_types, $taxonomies)
	{	
		foreach($taxonomies as $name => $arr){
			register_taxonomy('pix_'. strtolower($name), 'pix_' .strtolower($post_types), $arr);
		}
	}
}


//Initialize

function ini_post_type(){


    //Testimonial Post Type
	$testimonial_arr = array(
		'menu_icon' => 'dashicons-format-status',
		'supports' => array('title','editor'),
		'rewrite'   => array(
			'slug' => 'testimonial'
			)
		);

	$testimonial_tax_arr = array("Jobs"   => array('singular_name' => 'Job','query_var' => 'testimonial_cat'));

	$testimonial = new pix_post_type('Testimonial', 'testimonial', $testimonial_arr);

	$testimonial->taxonomies('Testimonial', $testimonial_tax_arr);


	//Event TV Post Type
	$eventtv_arr = array(
		'menu_icon' => 'dashicons-format-video',
		'supports' => array('title','editor','thumbnail'),
		'rewrite'   => array(
			'slug' => 'eventtv'
			),
		'labels' => array(
			'name' => 'Event Tv',
			'singular_name' => "Video",
			'add_new'		=> "Add New Video",
			'add_new_item' 	=> "Add New Video",
			'edit_item' 	=> "Edit Video",
			'new_item' 		=> "New Video",
			'view_item' 	=> "View Video",
			'search_items' 	=> "Search Videos",
			'not_found' 	=> "No Videos found",
			'all_items' => "All Videos",
			'not_found_in_trash' 	=> "No videos found in Trash", 
			'parent_item_colon' 	=> '',
			),
		);
	
	$eventtv = new pix_post_type('Event Tv', 'Event Tv', $eventtv_arr);


    //Event Post Type
	$event_arr = array(
		'menu_icon' =>'dashicons-calendar',
		'has_archive' => true,
		'supports' => array('title','editor','thumbnail','comments'), 
		'rewrite'   => array(
			'slug' => 'event'
			)
		
		);
	$event_tax_arr = array("Listings"   => array('singular_name' => 'Listing','query_var' => 'event_cat'));

	$event = new pix_post_type('Event', 'Event', $event_arr);
	$event->taxonomies('Event', $event_tax_arr);



    //Speaker Post Type
	$speaker_arr = array(
		'menu_icon' =>'dashicons-businessman',
		'supports' => array('title','editor','thumbnail'),
		'show_ui' => true,
		'show_in_menu' => 'edit.php?post_type=pix_event',
		'labels' => array('all_items' => 'Speaker'), 
		'rewrite'   => array(
			'slug' => 'speaker'
			)
		);

	$speaker_tax_arr = array("Professions"   => array('singular_name' => 'Profession','query_var' => 'speaker_cat'));

	$speaker = new pix_post_type('Speaker', 'Speaker', $speaker_arr);

	$speaker->taxonomies('Speaker', $speaker_tax_arr);

    //Schedule Post Type
	$schedule_arr = array(
		'menu_icon' =>'dashicons-businessman',
		'supports' => array('title','editor','thumbnail'),
		'show_ui' => true,
		'show_in_menu' => 'edit.php?post_type=pix_event',
		'labels' => array('all_items' => 'Schedule'), 
		'rewrite'   => array(
			'slug' => 'schedule'
			)
		);

	$schedule = new pix_post_type('Schedule', 'Schedule', $schedule_arr);


    //Event Gallery Post Type
	$gallery_arr = array(
		'menu_icon' =>'dashicons-businessman',
		'supports' => array('title','editor','thumbnail'),
		'show_ui' => true,
		'show_in_menu' => 'edit.php?post_type=pix_event',
		'labels' => array('all_items' => 'Gallery'), 
		'rewrite'   => array(
			'slug' => 'gallery'
			)
		);

	$gallery_tax_arr = array("Categories"   => array('singular_name' => 'Category','query_var' => 'gallery_cat'));

	$gallery = new pix_post_type('Gallery', 'Gallery', $gallery_arr);

	$gallery->taxonomies('Gallery', $gallery_tax_arr);


	//Ticket post type option
    $ticket_arr = array(
                'menu_icon' => 'dashicons-format-status',
                'supports' => array(''),
                'rewrite'   => array(
                        	'slug' => 'tickets'
                        ),
                'can_export' => false,
                'show_ui' => false,
                'publicly_queryable'  => false,
                'exclude_from_search' => true
                );
    
    $ticket = new pix_post_type('Tickets', 'ticket', $ticket_arr);
}

add_action('init', 'ini_post_type');