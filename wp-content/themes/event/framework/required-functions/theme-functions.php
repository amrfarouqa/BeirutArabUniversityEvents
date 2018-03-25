<?php

/*  Enqueue Google Fonts */
function eventon_theme_fonts() {
	global $smof_data;
	if (!is_admin()) {
		$protocol = is_ssl() ? 'https' : 'http';

		//Body Font
		$body_font = (isset($smof_data['custom_font_body']['g_face'])) ? trim(str_replace(' ','+',$smof_data['custom_font_body']['g_face'])) : 'Lato';
		$body_font .= (isset($smof_data['custom_font_body']['style'])) ? 
						':'.$smof_data['custom_font_body']['style'].','.$smof_data['custom_font_body']['style'].'italic,700,,700italic' :
						':100,100italic,300,300italic,400,400italic,500,500italic,700,700italic,900,900italic,';	

		//Subset
		$raw_subsets = (isset($smof_data['subset'])) ? $smof_data['subset'] : array("latin" => 1);

		$font_subsets = '';
		foreach ($raw_subsets as $key => $value) {
			if($value){
				$font_subsets .= $key .',';
			}
		}
		$font_subsets = rtrim($font_subsets, ",");

			//Finally Enqueue Google webfonts With choosen subsets
			wp_enqueue_style( 'eventon-theme-fonts', "$protocol://fonts.googleapis.com/css?family=$body_font&subset=$font_subsets" );
	}
}
add_action( 'wp_enqueue_scripts', 'eventon_theme_fonts' );  


global $smof_data;
// Theme Primary Choosen Color
$theme_color = isset($smof_data['theme_color'])? $smof_data['theme_color'] : 'default';

$custom_styles = isset($smof_data['custom_styles'])? $smof_data['custom_styles'] : 0;

$primary_color = isset($smof_data['primary_color'])? $smof_data['primary_color'] : '';

$secondary_color = isset($smof_data['secondary_color'])? $smof_data['secondary_color'] : '';


if($custom_styles == 1 && (!empty($primary_color) || !empty($secondary_color))){	
	$pix_theme_primary_color = $primary_color;
	$pix_theme_secondary_color = $secondary_color;
}
else{
	if($theme_color == 'default'){
		$pix_theme_primary_color = '#5ab4e6';
		$pix_theme_secondary_color = '#735cb0';
	}

	elseif($theme_color == 'orange'){
		$pix_theme_primary_color = '#ed5f30';
		$pix_theme_secondary_color = '#DB6138';
	}

	elseif($theme_color == 'blumine-blue'){
		$pix_theme_primary_color = '#23C4BD';
		$pix_theme_secondary_color = '#17A0B3';
	}
	
	elseif($theme_color == 'copper-brown'){
		$pix_theme_primary_color = '#b07838';
		$pix_theme_secondary_color = '#997245';
	}

	elseif($theme_color == 'jelly-been-magenta'){
		$pix_theme_primary_color = '#28778e';
		$pix_theme_secondary_color = '#105569';
	}

	elseif($theme_color == 'persian-red'){
		$pix_theme_primary_color = '#cc3333';
		$pix_theme_secondary_color = '#A73636';
	}
}

//Menu Function
require_once (THEME_FUNCTIONS . '/pix-menu-extend/pix-menu-extend.php');
require_once (THEME_FUNCTIONS . '/PixIterator/Iterator.php');
require_once (THEME_FUNCTIONS . '/PixIterator/Icon.php');
require_once (THEME_FUNCTIONS . '/pix-like-me/like-me.php');
require_once (THEME_FUNCTIONS . '/pix-woocommerce-tickets/pix-woocommerce-tickets.php');

function pix_import_demo(){

	// if ( !wp_verify_nonce( $_REQUEST['security'], "pix_import_nonce")) {
	// 	exit("No naughty business please");
	// }

	require_once (THEME_FUNCTIONS . '/pix-importer/pix-importer.php');

	die('pix_demo_import');
}
add_action( 'wp_ajax_pix_import_demo', 'pix_import_demo' );

/* WOO Cart */

function pix_woo_cart(){

	global $smof_data;
	$show_cart_btn = isset($smof_data['show_cart_btn'])? $smof_data['show_cart_btn'] : 1;
	if($show_cart_btn){

		if (class_exists('Woocommerce')) {
			global $woocommerce; 
			echo '<div class="pix-cart">';
	?>      

			<div class="cart-trigger">
				<div class="pix-cart-contents-con">
					<span class="pix-no-items"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'innwit'), $woocommerce->cart->cart_contents_count);?></span> 
					<span class="pix-woo-price"><?php echo $woocommerce->cart->get_cart_total(); ?></span>
					
					<a class="pix-cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'innwit'); ?>"><span class="fa fa-shopping-cart"></span><span class="pix-item-icon"><?php echo $woocommerce->cart->cart_contents_count; ?></span></a>
				</div>

				<?php
					if( !is_cart() && !is_checkout()){
						//Dropwon widget 
						echo '<div class="woo-cart-dropdown">';
							the_widget('WC_Widget_Cart');
						echo '</div>';
					}
				?>

			</div>
			   
	<?php    
			echo '</div>';

		}

	}
}

/* =============================================================================
Icon Font Array
========================================================================== */
// use PixIterator\Iterator as PixIterator;

$pix_icons = new PixIterator(get_template_directory().'/library/css/font-awesome.css','fa');
$pix_icons_class_html = '';
//$pix_icons_class_html = '<i class="no-icon"></i>';
$pix_icons_class_array = array('none');

foreach ($pix_icons as $icon) {
	$pix_icons_class_array[] = $icon->class;
	$pix_icons_class_html .= '<i class="'.$icon->class.' fa"></i> ';
}

// functions run on activation –> important flush to clear rewrites
if ( is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' ) {
	$wp_rewrite->flush_rules();
}

//Breadcrumbs
function breadcrumbs($color = '') {

$showOnHome = 1; // 1 - show breadcrumbs on the homepage, 0 - don't show
$delimiter = ''; // delimiter between crumbs
$home = 'Home'; // text for the 'Home' link
$showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
$before = '<span class="current" '. $color .'>'; // tag before the current crumb
$after = '</span>'; // tag after the current crumb

global $post;
$homeLink = home_url();

if (is_home() || is_front_page()) {

	if ($showOnHome == 1) echo '<ul class="breadcrumb"><li><a href="' . $homeLink . '">' . ucwords($home) . '</a></li></ul>';

} else {

	echo '<ul class="breadcrumb" itemprop="breadcrumb"><li><a href="' . $homeLink . '">' . ucwords($home) . '</a> ' . $delimiter . '</li>';

	if ( is_category() ) {
		global $wp_query;
		$cat_obj = $wp_query->get_queried_object();
		$thisCat = $cat_obj->term_id;
		$thisCat = get_category($thisCat);
		$parentCat = get_category($thisCat->parent);
		if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
		echo '<li>' .$before . 'Category: "' . single_cat_title('', false) . '"' . $after.'</li>';

	} elseif ( is_search() ) {
		echo '<li>' . $before . 'Search results: "' . get_search_query() . '"' . $after .'</li>';

	} elseif ( is_day() ) {
		echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . '</li>';
		echo '<li><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . '</li>';
		echo '<li>' . $before . get_the_time('d') . $after . '</li>';

	} elseif ( is_month() ) {
		echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . '</li>';
		echo '<li>' . $before . get_the_time('F') . $after . '</li>';

	} elseif ( is_year() ) {
		echo '<li>' . $before . get_the_time('Y') . $after . '</li>';

	} elseif ( is_single() && !is_attachment() ) {
		if ( get_post_type() != 'post' ) {
			$post_type = get_post_type_object(get_post_type());
			$slug = $post_type->rewrite;
//echo '<li><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . ucwords($post_type->labels->singular_name) . '</a></li>';
//if ($showCurrent == 1) echo '<li>' . $delimiter . ' ' . $before . ucwords(get_the_title()) . $after . '</li>';
			if ($showCurrent == 1) echo '<li> ' . $before . ucwords(get_the_title()) . $after . '</li>';
		} else {
			$cat = get_the_category(); $cat = $cat[0];
			$cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
			if ($showCurrent == 0) $cats = preg_replace("/^(.+)\s$delimiter\s$/", "$1", $cats);
			echo '<li>'. $before .$cats. $after . '</li>';
			if ($showCurrent == 1) echo '<li>'. $before . ucwords(ShortenText(get_the_title(),20)) . $after . '</li>';
		}

	} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
		$post_type = get_post_type_object(get_post_type());
		echo '<li>'. $before . ucwords($post_type->labels->singular_name) . $after.'</li>';

	} elseif ( is_attachment() ) {
		$parent = get_post($post->post_parent);
		$cat = get_the_category($parent->ID); 
		if(!empty($cat)){
			$cat = $cat[0];
			echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
		}
		echo '<li><a href="' . get_permalink($parent) . '">' . ucwords($parent->post_title) . '</a></li>';
		if ($showCurrent == 1) echo '<li>' . $delimiter . ' ' . $before . ucwords(get_the_title()) . $after . '</li>';

	} elseif ( is_page() && !$post->post_parent ) {
		if ($showCurrent == 1) echo '<li>' . $before . ucwords(get_the_title()) . $after .'</li>';

	} elseif ( is_page() && $post->post_parent ) {
		$parent_id  = $post->post_parent;
		$breadcrumbs = array();
		while ($parent_id) {
			$page = get_page($parent_id);
			$breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . ucwords(get_the_title($page->ID)) . '</a></li>';
			$parent_id  = $page->post_parent;
		}
		$breadcrumbs = array_reverse($breadcrumbs);
		for ($i = 0; $i < count($breadcrumbs); $i++) {
			echo $breadcrumbs[$i];
			if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
		}
		if ($showCurrent == 1) echo '<li>' . $delimiter . ' ' . $before . ucwords(get_the_title()) . $after . '<li>';

	} elseif ( is_tag() ) {
		echo '<li>' . $before . 'Posts Tag: "' . ucwords(single_tag_title('', false) . '"') . $after . '</li>';

	} elseif ( is_author() ) {
		global $author;
		$userdata = get_userdata($author);
		echo '<li>' .$before . 'Posted By: ' . ucwords($userdata->display_name) . $after .'</li>';

	} elseif ( is_404() ) {
		echo '<li>' .$before . 'Error 404' . $after .'</li>';
	}

	if ( get_query_var('paged') ) {
		if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
			echo __('Page', 'innwit') . ' ' . get_query_var('paged');
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
}

echo '</div>';

}
}

//New Excerpt
function new_excerpt_more($more) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

//New Excerpt
function eventon_custom_excerpt_length( $length ) {
	global $smof_data;
	$blog_description_length = isset($smof_data['blog_description_length']) ? $smof_data['blog_description_length'] : '';
	if(empty($blog_description_length)){
		$blog_description_length = 580;
	}
	return $blog_description_length;
}
add_filter( 'excerpt_length', 'eventon_custom_excerpt_length', 999 );

//ShortenText
function ShortenText($text , $no_of__limit)
{
	$chars_limit = $no_of__limit;
	$chars_text = strlen($text);
	$text = $text." ";
	$text = substr($text,0,$chars_limit);
	$text = substr($text,0,strrpos($text,' '));
	if ($chars_text > $chars_limit)
	{

		$text = $text."...";

	}
	return $text;
}

//Resizing slider image
function get_attachment_id_from_src($image_src) {
	global $wpdb;
	$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
	$id = $wpdb->get_var($query);
	return $id;
}

function subBanner($title){

	global $smof_data;

	echo '<section class="sub-banner newsection">
	    <div class="container">
	        <h2 class="title">' . $title . '</h2>';

			$b_breadcrumbs = isset($smof_data['b_breadcrumbs']) ? $smof_data['b_breadcrumbs'] : '1';
			$b_breadcrumbs_text = isset($smof_data['b_breadcrumbs_text']) ? $smof_data['b_breadcrumbs_text'] : 'Blog';

			if($b_breadcrumbs){

				if(function_exists('breadcrumbs')){
					if ( !is_home() ){
						breadcrumbs();
					}    
					elseif (is_home()){
						echo '<ul class="breadcrumb"><li><a href="' . home_url() . '">Home</a></li><li>'. $b_breadcrumbs_text .'</li></ul>';
					}       
				}
			}

	echo '</div>
	</section>';
}

function eventon_admin_scripts($hook_suffix) {	

	if( 'post.php' == $hook_suffix || 'post-new.php' == $hook_suffix ) {
		//styles
		wp_enqueue_style( 'metabox-css', THEME_CUSTOM_METABOXES_URI. '/css/metabox.css' );

		//Scripts
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'custom_admin_js',   THEME_FRAMEWORK_URI .'/admin-js/admin.js', array( 'jquery', 'wp-color-picker','jquery-ui-datepicker' ));


		wp_localize_script( 'custom_admin_js', 'pixTicket',
			array( 
				'btnTxtAdd' => __( 'Add Ticket', 'innwit' ), 
				'btnTxtUpdate'   => __( 'Update Ticket', 'innwit'),
				'wait'    => __('Please Wait...', 'innwit'),
				'error'   => __('Something went wrong, Refresh and try again', 'innwit')
			)
		);

		
		wp_enqueue_script( 'pix_media_manager', THEME_FRAMEWORK_URI .'/admin-js/media-upload.js', array( 'jquery','jquery-ui-sortable' ));
		
		//Load Icon fonts, Font css and icon inserter plugin
		//Loading Css
		wp_enqueue_style('menu_font_style'	, get_template_directory_uri() ."/library/css/font-awesome.css");
		wp_enqueue_style('menu_style', THEME_FUNCTIONS_URI ."/pix-menu-extend/css/style.css");
	}elseif(isset($_GET['vc_action']) && ($_GET['vc_action'] == 'vc_inline')){
		//Loading Css
		wp_enqueue_style('menu_font_style'	, get_template_directory_uri() ."/library/css/font-awesome.css");
		wp_enqueue_style('menu_style', THEME_FUNCTIONS_URI ."/pix-menu-extend/css/style.css");
		wp_enqueue_style('pix-vc-front-css', THEME_FRAMEWORK_URI ."/admin-js/vc-front-style.css");
		wp_enqueue_script( 'pix-front-waypoints', get_stylesheet_directory_uri() . '/library/js/waypoints.min.js', array( 'jquery' ), '2.0.4', true );
		wp_enqueue_script( 'pix-front-plugins-js', get_stylesheet_directory_uri() . '/library/js/plugins.js', array( 'jquery', 'underscore', 'backbone', 'wpb_js_composer_js_tools', 'vc_inline_shortcodes_builder_js', 'vc_inline_panels_js','pix-front-waypoints' ), '1.0', true );

		wp_enqueue_script( 'pixel8es-front-js', get_stylesheet_directory_uri() . '/library/js/vc-front-scripts.js', array( 'jquery', 'underscore', 'backbone', 'wpb_js_composer_js_tools', 'vc_inline_shortcodes_builder_js', 'vc_inline_panels_js','pix-front-waypoints','pix-front-plugins-js' ), '1.0', true );

		wp_enqueue_script( 'pix_inline_custom_view_js', THEME_FRAMEWORK_URI . '/admin-js/custom-views.js', array( 'jquery', 'underscore', 'backbone', 'wpb_js_composer_js_tools', 'vc_inline_shortcodes_builder_js', 'vc_inline_panels_js','pix-front-waypoints','pix-front-plugins-js' ), '1.0', true );
			
	}
}
add_action( 'admin_enqueue_scripts', 'eventon_admin_scripts' );


/************* CUSTOM LOGIN PAGE ****************

// calling your own login css so you can style it

//Updated to proper 'enqueue' method
//http://codex.wordpress.org/Plugin_API/Action_Reference/login_enqueue_scripts
function eventon_login_css() {
wp_enqueue_style( 'eventon_login_css', get_template_directory_uri() . '/library/css/login.css', false );
}

// changing the logo link from wordpress.org to your site
function eventon_login_url() {  return home_url(); }

// changing the alt text on the logo to show your site name
function eventon_login_title() { return get_option( 'blogname' ); }

// calling it only on the login page
add_action( 'login_enqueue_scripts', 'eventon_login_css', 10 );
add_filter( 'login_headerurl', 'eventon_login_url' );
add_filter( 'login_headertitle', 'eventon_login_title' );*/



/**
* Retina images
*
* This function is attached to the 'wp_generate_attachment_metadata' filter hook.
*/
function retina_support_attachment_meta( $metadata, $attachment_id ) {
	foreach ( $metadata as $key => $value ) {
		if ( is_array( $value ) ) {
			foreach ( $value as $image => $attr ) {
				if ( is_array( $attr ) )
					retina_support_create_images( get_attached_file( $attachment_id ), $attr['width'], $attr['height'], true );
			}
		}
	}

	return $metadata;
}
add_filter( 'wp_generate_attachment_metadata', 'retina_support_attachment_meta', 10, 2 );

/**
* Create retina-ready images
*
* Referenced via retina_support_attachment_meta().
*/
function retina_support_create_images( $file, $width, $height, $crop = false ) {
	if ( $width || $height ) {
		$resized_file = wp_get_image_editor( $file );
		if ( ! is_wp_error( $resized_file ) ) {
			$filename = $resized_file->generate_filename( $width . 'x' . $height . '@2x' );

			$resized_file->resize( $width * 2, $height * 2, $crop );
			$resized_file->save( $filename );

			$info = $resized_file->get_size();

			return array(
				'file' => wp_basename( $filename ),
				'width' => $info['width'],
				'height' => $info['height'],
				);
		}
	}
	return false;
}


/**
* Delete retina-ready images
*
* This function is attached to the 'delete_attachment' filter hook.
*/
function delete_retina_support_images( $attachment_id ) {
	$meta = wp_get_attachment_metadata( $attachment_id );
	$upload_dir = wp_upload_dir();
	$path = pathinfo( $meta['file'] );
	foreach ( $meta as $key => $value ) {
		if ( 'sizes' === $key ) {
			foreach ( $value as $sizes => $size ) {
				$original_filename = $upload_dir['basedir'] . '/' . $path['dirname'] . '/' . $size['file'];
				$retina_filename = substr_replace( $original_filename, '@2x.', strrpos( $original_filename, '.' ), strlen( '.' ) );
				if ( file_exists( $retina_filename ) )
					unlink( $retina_filename );
			}
		}
	}
}
add_filter( 'delete_attachment', 'delete_retina_support_images' );


// convert hex to rgba
function pix_hex2rgb($hex) {
	$hex = str_replace("#", "", $hex);

	if(strlen($hex) == 3) {
		$r = hexdec(substr($hex,0,1).substr($hex,0,1));
		$g = hexdec(substr($hex,1,1).substr($hex,1,1));
		$b = hexdec(substr($hex,2,1).substr($hex,2,1));
	} else {
		$r = hexdec(substr($hex,0,2));
		$g = hexdec(substr($hex,2,2));
		$b = hexdec(substr($hex,4,2));
	}
	$rgb = array($r, $g, $b);
return implode(",", $rgb); // returns the rgb values separated by commas
//return $rgb; // returns an array with the rgb values
}

function eventon_formsubmit(){

	if ( !wp_verify_nonce( $_REQUEST['nonce'], "eventon_ajax_form_nonce")) {
		exit("No naughty business please");
	}

	global $smof_data;

	$contact_success = isset($smof_data['contact_success']) ? $smof_data['contact_success'] : '';
	$contact_error = isset($smof_data['contact_error']) ? $smof_data['contact_error'] : '';

	if(empty($contact_success)){
		$contact_success = isset($smof_data['contact_success']) ? $smof_data['contact_success'] : '<strong>Email Successfully Sent!</strong><br>Thanks for contacting Us. Your email was successfully sent and we will be in touch with you soon.';
	}

	if(empty($contact_error)){
		$contact_error = __('Please check if you have filled all the fields with valid information and try again. Thank you.','innwit');
	}


$yourEmailAddress = (isset($_POST['sendto']) && !empty($_POST['sendto'])) ? $_POST['sendto']  : get_option( 'admin_email'); //Put your own email address here.

//Check to make sure that the name field is not empty
if(trim($_POST['contactname']) == '') {
	$hasError = true;
} else {
	$name = trim($_POST['contactname']);
}

//Check to make sure that the subject field is not empty
if(trim($_POST['subject']) == '') {
	$hasError = true;
} else {
	$subject = trim($_POST['subject']);
}

//Check to make sure sure that a valid email address is submitted
if(trim($_POST['email']) == '')  {
	$hasError = true;
} else if (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", trim($_POST['email']))) {
	$hasError = true;
} else {
	$email = trim($_POST['email']);
}

//Check to make sure comments were entered
if(trim($_POST['message']) == '') {
	$hasError = true;
} else {
	if(function_exists('stripslashes')) {
		$comments = stripslashes(trim($_POST['message']));
	} else {
		$comments = trim($_POST['message']);
	}
}

//If there is no error, send the email
if(!isset($hasError)) {
	$emailTo = $yourEmailAddress;
	$body = "Name: $name \n\nEmail: $email \n\nSubject: $subject \n\nMessage:\n $comments";
	$headers = 'From: eventon Template <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
	wp_mail($emailTo, $subject, $body, $headers);
	echo'<div id="success" class="sent success"><p>'.$contact_success.'.</p><br></div>';
} else { //If errors are found
	echo '<p class="error">'.$contact_error.'</p>';
}
die();
}

add_action("wp_ajax_eventon_submit_form", "eventon_formsubmit");
add_action("wp_ajax_nopriv_eventon_submit_form", "eventon_formsubmit");

/*
* Twitter Helper functions
*/
function make_twitter($tweet) {
	$tweet = preg_replace('/(^|\s)@(\w+)/','\1@<a href="http://www.twitter.com/\2">\2</a>',$tweet);
	return preg_replace('/(^|\s)#(\w+)/','\1#<a href="http://search.twitter.com/search?q=%23\2">\2</a>',$tweet);
	return $tweet;
}

function link_it($text)
{
	$text= preg_replace('@(https?://([-\w\.]+)+(/([\w/_\.]*(\?\S+)?(#\S+)?)?)?)@','<a href="$1">$1</a>', $text);
	return($text);
}

function get_elapsedtime($time) {

	$gap = time() - $time;

	if ($gap < 5) {
		return 'less than 5 seconds ago';
	} else if ($gap < 10) {
		return 'less than 10 seconds ago';
	} else if ($gap < 20) {
		return 'less than 20 seconds ago';
	} else if ($gap < 40) {
		return 'half a minute ago';
	} else if ($gap < 60) {
		return 'less than a minute ago';
	}

	$gap = round($gap / 60);
	if ($gap < 60)  { 
		return $gap.' minute'.($gap > 1 ? 's' : '').' ago';
	}

	$gap = round($gap / 60);
	if ($gap < 24)  { 
		return 'about '.$gap.' hour'.($gap > 1 ? 's' : '').' ago';
	}

//return date('h:i A M d, Y', $time);

	return date('M d', $time);

}

/*
* End of Twitter Helper functions
*/

/**
* Modifies WordPress's built-in comments_popup_link() function to return a string instead of echo comment results
*/
function get_comments_popup_link( $zero = false, $one = false, $more = false, $css_class = '', $none = false ) {
	global $wpcommentspopupfile, $wpcommentsjavascript;

	$id = get_the_ID();

	if ( false === $zero ) $zero = __( 'No Comments', 'innwit' );
	if ( false === $one ) $one = __( '1 Comment', 'innwit' );
	if ( false === $more ) $more = __( '% Comments', 'innwit' );
	if ( false === $none ) $none = __( 'Comments Off', 'innwit' );

	$number = get_comments_number( $id );

	$str = '';

	if ( 0 == $number && !comments_open() && !pings_open() ) {
		$str = '<span' . ((!empty($css_class)) ? ' class="' . esc_attr( $css_class ) . '"' : '') . '>' . $none . '</span>';
		return $str;
	}

	if ( post_password_required() ) {
		$str = __('Enter your password to view comments.', 'innwit');
		return $str;
	}

	$str = '<a href="';
	if ( $wpcommentsjavascript ) {
		if ( empty( $wpcommentspopupfile ) )
			$home = home_url();
		else
			$home = get_option('siteurl');
		$str .= $home . '/' . $wpcommentspopupfile . '?comments_popup=' . $id;
		$str .= '" onclick="wpopen(this.href); return false"';
} else { // if comments_popup_script() is not in the template, display simple comment link
	if ( 0 == $number )
		$str .= get_permalink() . '#respond';
	else
		$str .= get_comments_link();
	$str .= '"';
}

if ( !empty( $css_class ) ) {
	$str .= ' class="'.$css_class.'" ';
}
$title = the_title_attribute( array('echo' => 0 ) );

$str .= apply_filters( 'comments_popup_link_attributes', '' );

$str .= ' title="' . esc_attr( sprintf( __('Comment on %s', 'innwit'), $title ) ) . '">';
$str .= get_comments_number_str( $zero, $one, $more );
$str .= '</a>';

return $str;
}

/**
* Modifies WordPress's built-in comments_number() function to return string instead of echo
*/
function get_comments_number_str( $zero = false, $one = false, $more = false, $deprecated = '' ) {
	if ( !empty( $deprecated ) )
		_deprecated_argument( __FUNCTION__, '1.3' );

	$number = get_comments_number();

	if ( $number > 1 )
		$output = str_replace('%', number_format_i18n($number), ( false === $more ) ? __('% Comments', 'innwit') : $more);
	elseif ( $number == 0 )
		$output = ( false === $zero ) ? __('No Comments', 'innwit') : $zero;
else // must be one
$output = ( false === $one ) ? __('1 Comment', 'innwit') : $one;

return apply_filters('comments_number', $output, $number);
}



//To keep the count accurate, lets get rid of prefetching

remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

/************* WooCommerce *****************/
if (class_exists('Woocommerce')) {
	// Disable woocommerce css
	add_filter( 'woocommerce_enqueue_styles', '__return_false' );

	//Reposition WooCommerce breadcrumb 
	function woocommerce_remove_breadcrumb(){
		remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
	}
	add_action('woocommerce_before_main_content', 'woocommerce_remove_breadcrumb');

	function woocommerce_custom_breadcrumb(){
		woocommerce_breadcrumb();
	}
	add_action( 'woo_custom_breadcrumb', 'woocommerce_custom_breadcrumb' );

	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

	remove_action( 'woocommerce_after_single_product', 'woocommerce_template_loop_add_to_cart', 10);
	
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );

	remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar',10);

	// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
	add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
	 
	function woocommerce_header_add_to_cart_fragment( $fragments ) {
		global $woocommerce;
		
		ob_start();
		
		?>
		<div class="pix-cart-contents-con">
			<span class="pix-no-items"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'innwit'), $woocommerce->cart->cart_contents_count);?></span> 
			<span class="pix-woo-price"><?php echo $woocommerce->cart->get_cart_total(); ?></span>
			
			<a class="pix-cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'innwit'); ?>"><span class="fa fa-shopping-cart"></span><span class="pix-item-icon"><?php echo $woocommerce->cart->cart_contents_count; ?></span></a>
		</div>
		<?php
		
		$fragments['div.pix-cart-contents-con'] = ob_get_clean();
		
		return $fragments;
		
	}
}

/*convertNumber*/

function convertNumber($num)  
{  
   //list($num, $dec) = explode(".", $num);  
  
   $output = "";  
  
   if($num{0} == "-")  
   {  
      $output = "negative ";  
      $num = ltrim($num, "-");  
   }  
   else if($num{0} == "+")  
   {  
      $output = "positive ";  
      $num = ltrim($num, "+");  
   }  
     
   if($num{0} == "0")  
   {  
      $output .= "zero";  
   }  
   else  
   {  
      $num = str_pad($num, 36, "0", STR_PAD_LEFT);  
      $group = rtrim(chunk_split($num, 3, " "), " ");  
      $groups = explode(" ", $group);  
  
      $groups2 = array();  
      foreach($groups as $g) $groups2[] = convertThreeDigit($g{0}, $g{1}, $g{2});  
  
      for($z = 0; $z < count($groups2); $z++)  
      {  
         if($groups2[$z] != "")  
         {  
            $output .= $groups2[$z].convertGroup(11 - $z).($z < 11 && !array_search('', array_slice($groups2, $z + 1, -1))  
             && $groups2[11] != '' && $groups[11]{0} == '0' ? " and " : ", ");  
         }  
      }  
  
      $output = rtrim($output, ", ");  
   }  
  
  
   return $output;  
}  
  
function convertGroup($index)  
{  
   switch($index)  
   {  
      case 11: return " decillion";  
      case 10: return " nonillion";  
      case 9: return " octillion";  
      case 8: return " septillion";  
      case 7: return " sextillion";  
      case 6: return " quintrillion";  
      case 5: return " quadrillion";  
      case 4: return " trillion";  
      case 3: return " billion";  
      case 2: return " million";  
      case 1: return " thousand";  
      case 0: return "";  
   }  
}  
  
function convertThreeDigit($dig1, $dig2, $dig3)  
{  
   $output = "";  
  
   if($dig1 == "0" && $dig2 == "0" && $dig3 == "0") return "";  
  
   if($dig1 != "0")  
   {  
      $output .= convertDigit($dig1)." hundred";  
      if($dig2 != "0" || $dig3 != "0") $output .= " and ";  
   }  
  
   if($dig2 != "0") $output .= convertTwoDigit($dig2, $dig3);  
   else if($dig3 != "0") $output .= convertDigit($dig3);  
  
   return $output;  
}  
  
function convertTwoDigit($dig1, $dig2)  
{  
   if($dig2 == "0")  
   {  
      switch($dig1)  
      {  
         case "1": return "ten";  
         case "2": return "twenty";  
         case "3": return "thirty";  
         case "4": return "forty";  
         case "5": return "fifty";  
         case "6": return "sixty";  
         case "7": return "seventy";  
         case "8": return "eighty";  
         case "9": return "ninety";  
      }  
   }  
   else if($dig1 == "1")  
   {  
      switch($dig2)  
      {  
         case "1": return "eleven";  
         case "2": return "twelve";  
         case "3": return "thirteen";  
         case "4": return "fourteen";  
         case "5": return "fifteen";  
         case "6": return "sixteen";  
         case "7": return "seventeen";  
         case "8": return "eighteen";  
         case "9": return "nineteen";  
      }  
   }  
   else  
   {  
      $temp = convertDigit($dig2);  
      switch($dig1)  
      {  
         case "2": return "twenty-$temp";  
         case "3": return "thirty-$temp";  
         case "4": return "forty-$temp";  
         case "5": return "fifty-$temp";  
         case "6": return "sixty-$temp";  
         case "7": return "seventy-$temp";  
         case "8": return "eighty-$temp";  
         case "9": return "ninety-$temp";  
      }  
   }  
}  
        
function convertDigit($digit)  
{  
   switch($digit)  
   {  
      case "0": return "zero";  
      case "1": return "one";  
      case "2": return "two";  
      case "3": return "three";  
      case "4": return "four";  
      case "5": return "five";  
      case "6": return "six";  
      case "7": return "seven";  
      case "8": return "eight";  
      case "9": return "nine";  
   }  
}


function pix_is_woocommerce(){
    if(is_multisite()){
        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        return is_plugin_active('woocommerce/woocommerce.php');
    }
    else{
        return in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );
    }
}

function search_filter($query) {
	
	global $smof_data;

	//Search Exclude
	$search_exclude = isset($smof_data['search_exclude']) ? $smof_data['search_exclude'] : '';
	if(!empty($search_exclude)){
		$array = array();

		foreach ($search_exclude as $key => $value) {
			if($value == 0){
				$array [] = $key;
			}
		}

		$arr = array_unique($array);

		if ( !is_admin() && $query->is_main_query() ) {
			if ($query->is_search) {
				$query->set('post_type', $arr );
			}
		}
	}
	
}

add_action('pre_get_posts','search_filter');


//Set Time Zone

$timezone = get_option('timezone_string');

if(!empty($timezone)){
  date_default_timezone_set($timezone);
}