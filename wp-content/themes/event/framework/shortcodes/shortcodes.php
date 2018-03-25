<?php


// Begin Shortcodes

global $pix_theme_pri_color, $gmap_count;

class Pixel8esShortcodes {

	function __construct() {
	  add_action( 'init', array( $this, 'pix_add_shortcodes' ) );
	  add_action( 'the_content', array( $this, 'pixel8es_fix_shortcodes' ) );
	}

	/*--------------------------------------------------------------------------------------
	  *
	  * pixel8es_fix_shortcodes
	  *
	  * @author Shahul Hameed
	  * @since 1.0
	  * @todo only remove p and br for our own shortcode defined in $block array()
	  *-------------------------------------------------------------------------------------*/



	function pixel8es_fix_shortcodes($content) {
		// array of custom shortcodes requiring the fix
		$block = join("|",array('h1','h2','h3','h4','h5','h6','title', 'blog-link', 'breadcrumb', 'row', 'column', 'section', 'emphasis', 'callout', 'icon', 'contact','list','li','social_icons','social_icon','spacer', 'button','speakers','blog', 'tweets', 'skills', 'portfolio', 'pricing_tables', 'clients', 'client', 'ul', 'li', 'line', 'social', 'video_popup', 'googlemap','event_gallery_slider','upcoming_popular_tab'));
	
		// opening tag
		$rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);
		// closing tag
		$rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);
		return $rep;
	}

	/*--------------------------------------------------------------------------------------
	  *
	  * pix_add_shortcodes
	  *
	  * @author Shahul Hameed
	  * @since 1.0
	  * @todo Adding Shortcodes
	  *-------------------------------------------------------------------------------------*/
	function pix_add_shortcodes() {

	  $pix_shortcodes = array(	
		'blog',
		'button',
		'callout',
		'clients',
		'counter',
		'dropcaps',
		'emphasis',
		'googlemap',
		'highlight',
		'icon',
		'icon_box',
		'list',
		'li',
		'line',
		'tooltip',
		'pie_chart',
		'process',
		'portfolio',
		'quote',
		'testimonial',
		'title',
		'tweets',
		'social',
		'spacer',
		'speakers',
		'video_popup',
		'event_gallery_slider',
		'upcoming_popular_tab',
		'event_counter',
		'event_search'
	  );

	  foreach ( $pix_shortcodes as $shortcode ) {

		$function = 'pix_' . str_replace( '-', '_', $shortcode );
		add_shortcode( $shortcode, array( $this, $function ) );
		
	  }

	}

	/* =============================================================================
		Blockquote Shortcodes
	========================================================================== */
	function pix_quote($atts, $content = null){

		$output = '<blockquote>';

		$output .= '<div class="icon-quote"><i class="fa fa-quote-left"></i></div>';

		$output .= '<p>'. do_shortcode($content) .'</p>';

		$output .='</blockquote><div class="clear"></div>';
		return $output;
	}

	/* =============================================================================
		Highlight Shortcodes
	========================================================================== */
	function pix_highlight($atts, $content = null, $code){   
	   $output = '<span class="highlight">'.trim($content).'</span>';	
	   return $output;
	}

	/* =============================================================================
		Tool-tip Shortcodes
	========================================================================== */
	//Tool-tip
	function pix_tooltip($atts, $content = null){	
		extract(shortcode_atts(array(
			'link'  => '#',
			'tooltip_title' => 'title',
			'tooltip_content' => 'content goes here',
			'align' => ''
		), $atts));
		
		$output  = '<a href="'. esc_url($link) .'" rel="tooltip" data-placement="'. esc_attr($align) .'" class="tool-tip" data-original-title="'. esc_attr($tooltip_content) .'">'. esc_html($tooltip_title) .'</a>';
		return $output;
	}

	/* =============================================================================
		Dropcaps Shortcodes
	========================================================================== */
	function pix_dropcaps($atts, $content = null, $code){
		extract(shortcode_atts(array(
		"style" => 'square',
		), $atts)); 
		return '<span class="dropcaps '. esc_attr($style) . '">' . esc_html($content) . '</span>';
	}



	/* =============================================================================
		 Button Shortcodes
	   ========================================================================== */

	function pix_button($atts, $content = null){	
		extract(shortcode_atts(array(
			'button_link'  => '',
			'title' => '',
			'button_style' => '',
			'button_size' => '',
			'button_text' => '',
			'button_color' => '',
			'button_event' => '',
			'button_align' => '',
			'button_icon' => '',
			'button_icon_align' => '',
			'custom_size' => 'no',
			'font_size' => '',
			'padding_custom' => '',
			'target' => '_self',
		), $atts));
		
		$btn_att = vc_build_link($button_link);
		$btn_att['href'] = (isset($btn_att['url'])) ? $btn_att['url'] : '';
		$btn_att['title'] = (isset($btn_att['title'])) ? $btn_att['title'] : '';
		$btn_att['target'] = (isset($btn_att['target'])) ? $btn_att['target'] : '';

		$icon_btn = $font = $font_class = $button_icon_front = $button_icon_back = $button_icon_class = "";

		if($button_icon != "" && $button_icon_align == 'front'){
			$button_icon_front = '<span class="btn-icon button-front '. $button_icon .'"></span> ';
			$button_icon_class = 'btn-front';
		}elseif($button_icon != "" && $button_icon_align == 'back'){
			$button_icon_back = ' <span class="btn-icon '. $button_icon .'"></span>';
			$button_icon_class = 'btn-front';
		}

		if($custom_size == "yes"){
			$font_class = " btn-custom";
			$font = 'style=';
			$font .= "font-size:". $font_size .";";
			$font .= "padding: ". $padding_custom .";'";
		}
		

		$output  = '<div class="pix_button '. esc_attr($button_align) .'"><a href="'. esc_attr($btn_att['href']) .'" title="'.esc_attr($btn_att['title']) .'" '. ((!empty($btn_att['target'])) ? ' target="'. $btn_att['target'] .'"' : '').' class="clear btn btn-'. esc_attr($button_style) .' '. $button_icon_class .' btn-'. esc_attr($button_size) .' '.$button_event.' '. esc_attr($button_color).''. $font_class .'"'.''. $font .'>'. esc_html($button_text) .'</a></div>';
		return $output;
	}

	/* =============================================================================
		Youtube and Vimeo Popup Shortcodes
	========================================================================== */
	function pix_video_popup($atts, $content = null){	
		extract(shortcode_atts(array(
			'url'  => '#',
			'title_format' => '',
			'text' => '',
			'icon_name' => '',
			'align' => ''
		), $atts));

		if($title_format=="icon" && !empty($icon_name)){
			$text_title = '<i class="'. $icon_name .'"></i>';
		}else{
			$text_title = $text;
		}
		
		$output  = '<div class="align-'. esc_attr($align) .' popup-'. esc_attr($title_format) .'"><a href="'. esc_url($url) .'" class="video-icon popup-video">'. esc_html($text_title) .'</a></div>';
		return $output;
	}

	

	/* =============================================================================
		Emphasis Shortcodes
	========================================================================== */
	function pix_emphasis($atts, $content = null, $code){
		return '<div class="emphasis">'. do_shortcode($content) .'</div>';
	}


	/* =============================================================================
		Spacer Shortcodes
	========================================================================== */

	function pix_spacer($atts, $content = null){	
		extract(shortcode_atts(array(
			'height'  => '30px'
		), $atts));
		
		$output  = '<div class="spacer" style="height: '. esc_attr($height) .'"></div>';
		return $output;
	}

	/* =============================================================================
		 Social Shortcodes
	   ========================================================================== */

	function pix_social($atts, $content = null){	
		extract(shortcode_atts(array(
			'style' => '',
			'facebook'  => '',
			'twitter' => '',
			'gplus' => '',
			'linkedin' => '',
			'dribble' => '',
			'flickr' => '',
			'pinterest' => '',
			'tumblr' => '',
			'instagrem' => '',		
			'rss' => '',
			'github' => ''
		), $atts));

		$facebook = isset($facebook) ? $facebook : '';
		$twitter = isset($twitter) ? $twitter : '';
		$gplus = isset($gplus) ? $gplus : '';
		$linkedin = isset($linkedin) ? $linkedin : '';
		$dribble = isset($dribble) ? $dribble : '';
		$flickr = isset($flickr) ? $flickr : '';
		$pinterest = isset($pinterest) ? $pinterest : '';
		$tumblr  = isset($tumblr) ? $tumblr : '';
		$instagrem  = isset($instagrem) ? $instagrem : '';
		$rss  = isset($rss) ? $rss : '';
		$github  = isset($github) ? $github : '';

		$social_icons = '<div class="full-width-icon '. esc_attr($style) .'"><div class="social-icons">';

		if( !empty($facebook)) {
			$social_icons .= '<a href="'.esc_attr(esc_url($facebook)).'" target="_blank" title="Facebook" class="facebook"><i class="pixicon-facebook"></i></a>';
		}

		if( !empty($twitter)) {
			$social_icons .= '<a href="'.esc_attr(esc_url($twitter)).'" target="_blank" title="Twitter" class="twitter"><i class="pixicon-twitter"></i></a>';
		}

		if( !empty($gplus)) {
			$social_icons .= '<a href="'. esc_attr(esc_url($gplus)).'" target="_blank" title="Gplus" class="google-plus"><i class="pixicon-fontawesome-webfont-145"></i></a>';
		}

		if( !empty($linkedin)) {
			$social_icons .= '<a href="'. esc_attr(esc_url($linkedin)).'" target="_blank" title="linkedin" class="linkedin"><i class="pixicon-linkedin"></i></a>';
		}

		if( !empty($dribble)) {
			$social_icons .= '<a href="'. esc_attr(esc_url($dribble)).'" target="_blank" title="Dribble" class="dribbble"><i class="pixicon-dribbble"></i></a>';
		}

		if( !empty($flickr)) {
			$social_icons .= '<a href="'. esc_attr(esc_url($flickr)).'" target="_blank" title="Flickr" class="flickr"><i class="pixicon-flickr"></i></a>';
		}

		if( !empty($pinterest)) {
			$social_icons .= '<a href="'. esc_attr(esc_url($pinterest)).'" target="_blank" title="Pinterest" class="pinterest"><i class="pixicon-pinterest"></i></a>';
		}

		if( !empty($tumblr )) {
			$social_icons .= '<a href="'. esc_attr(esc_url($tumblr)).'" target="_blank" title="Tumblr" class="tumblr"><i class="pixicon-tumblr"></i></a>';
		}

		if( !empty($instagrem )) {
			$social_icons .= '<a href="'. esc_attr(esc_url($instagrem)).'" target="_blank" title="instagrem" class="instagrem"><i class="pixicon-instagrem"></i></a>';
		}

		if( !empty($rss )) {
			$social_icons .= '<a href="'. esc_attr(esc_url($rss)).'" target="_blank" title="RSS" class="rss"><i class="pixicon-rss"></i></a>';
		}

		if( !empty($github )) {
			$social_icons .= '<a href="'. esc_attr(esc_url($github)).'" target="_blank" title="github" class="github"><i class="pixicon-github"></i></a>';
		}

		$social_icons .= '</div></div>';

		return $social_icons;
	}

	/* =============================================================================
	 Line Shortcodes
	 ========================================================================== */
	 function pix_line($atts, $content = null){	
	 	extract(shortcode_atts(array(
	 		'width'  => '75px',
		'align' => 'left', //left, right, center
		'thickness' => '1px',
		'color'	=> '',
		'line_style' => 'line-style1'
		), $atts));

	 	$line_border = $style = '';

	 	if($width != '50px' || $thickness != '1px' || !empty($color)){

	 		$style .= 'style="';

	 		$style .= ($width != '75px') ? 'width:'.$width.';' : '';

	 		$style .= ($thickness != '1px') ? 'height:'.$thickness.';' : '';

	 		$style .= (!empty($color)) ? 'background:'.$color.';' : '';

	 		$style .= '"';

	 	}

		//Title Backround Line
	 	if($line_style =='line-style1'){
	 		$line_border .= '<div class="line '. esc_attr($align) .'" '. esc_attr($style) .'></div>';

	 	}elseif ($line_style =='line-style2' ) {
	 		$line_border .= '<div class="'. esc_attr($align) .'" ><span class="line line-2"></span></div>';

	 	}elseif ($line_style =='line-style3' ) {
	 		$line_border .= '<div class="'. esc_attr($align) .'"><span class="line line-2 line-3"></span></div>';

	 	}elseif ($line_style =='line-style4' ) {
	 		$line_border .= '<div class="'. esc_attr($align) .'"><span class="line line-2 line-4"></span></div>';

	 	}elseif ($line_style =='line-style5' ) {
	 		$line_border .= '<div class="'. esc_attr($align) .'"><div class="line round-sep clearfix">
	 		<span class="round"></span>
	 		<span class="round"></span>
	 		<span class="round"></span>
	 		<span class="round"></span>
	 	</div></div>';  

	 }

	 return $line_border;
	}

	/* =============================================================================
		 Call Out Shortcodes
	   ========================================================================== */

	function pix_callout($atts, $content = null){
		extract(shortcode_atts(array(
				'el_class' => '',
				'callout_style' => 'show_event_search_form', //normal, show_dual_btn, show_event_search_form
				'title' => 'Section Title',
				'title_tag' => 'h2',
				'border' => 'yes',
				'first_btn_txt' => 'Find Events',
				'first_btn_url' => '',
				'second_btn_txt' => 'Buy Tickets',
				'second_btn_url' => '',
		), $atts));

		global $wpdb;
		
		$event_cpt_ID = $wpdb->get_results("SELECT DISTINCT ID
			FROM $wpdb->posts WHERE post_type = 'pix_event' AND post_status = 'publish'", ARRAY_N);

		$title_tag = !empty($title_tag) ? $title_tag : 'h2';

		$border = ($border == 'yes') ? 'border-cover' : '';



		$output = '<div class=" callout '.esc_attr($border).' '. esc_attr($el_class) .' '. esc_attr($callout_style) .'">';
		

		$output .= '<'. $title_tag .' class="title"><span>'. $title .'</span></'. $title_tag .'>';
		$output .= ' <div class="background-content clearfix">';
		$output .= '<p> '. wpb_js_remove_wpautop($content) .' </p>';

		if($callout_style == 'show_dual_btn'){

			$output .=' <div class="both-btn clearfix">
	            <div class="find-events">
	                <a href="'.esc_url($first_btn_url).'">'.esc_html($first_btn_txt).'</a>
	            </div>

	            <div class="but-ticket">
	                <a href="'.esc_url($second_btn_url).'">'.esc_html($second_btn_txt).'</a>
	            </div>

	            <span class="round">or</span>
	        </div>';

		}

		elseif($callout_style == 'show_event_search_form'){
			$output .=' <div class="eventform-con clearfix">
	       		<form method="get" action="' . home_url( '/' ) . '">

					<input name="post_type" type="hidden" value="pix_event">
					<div class="form-input search-location">
						<input name="keyword" type="text" value="" placeholder="Search Keyword">
						<i class="icon fa fa-search"></i>
					</div>

					<div class="form-input">
						<input name="date" placeholder="mm/dd/yy" class="date_timepicker_start">
						<i class="open icon fa fa-calendar"></i>
					</div>

					<div class="form-input">
						<div class="styled-select">
							<select name="loc">';

								if(!empty($event_cpt_ID)){

									$output .= '<option value="0">Select Venue</option>';

									$i = 0;

									foreach ( $event_cpt_ID as $value ){

										$event_detail = get_post_meta($value[0],'event_details',false);
										if( !empty($event_detail) )
										extract($event_detail[0]);

										if(!empty($venue_name)){
											$output .= '<option value="'.esc_attr($venue_name).'">'.$venue_name.'</option>';
											$i = 0;
										}
										else{
											$i++;
										}								

									}

									if($i != 0){
										$output .= '<option value="0">No Venue Found!!</option>';
									}

								}
								else{
									$output .= '<option value="0">No Events Found!!</option>';
								}
								
							$output .= '</select>';
					$output .= '</div>
						</div>

						
				<button name="event_search" value="1" type="submit" class="btn btn-md btn-pri"><i class="fa fa-search"></i></button>
					
				</form>

	        </div>';
		}


		$output .= '</div></div>';

      

		return $output;
	}

	/* =============================================================================
		 Icon Shortcodes
	   ========================================================================== */

	function pix_icon($atts, $content= null){
		extract(shortcode_atts(array(
			'align' => 'center',
			'icon_name' => '',
			'icon_style' => 'default',
			'icon_type' => 'default',
			'icon_color' => '',
			'icon_size' => '',
			'icon_bg_color' => '',
			'title' => '',
			'title_tag' => 'h2',
			'text_font' => '',
			'text_color' => '',
			'margin' => ''
		), $atts));

		$title_tag = !empty($title_tag) ? $title_tag : 'h2';

		$custom_text_style = '';
		if($text_font != '' || $text_color != '' || $margin != '' ){

			$custom_text_style .= ' style="';

			$custom_text_style .= ($text_font != '') ? 'font-size:'.esc_attr($text_font).';' : '';

			$custom_text_style .= ($text_color != '') ? 'color:'.esc_attr($text_color).';' : '';

			$custom_text_style .= ($margin != '') ? 'margin:'.esc_attr($margin).';' : '';

			$custom_text_style .= '"';

		}

		$custom_icon_style = '';
		if($icon_size != '' || $icon_color != '' ){

			$custom_icon_style .= ' style="';

			$custom_icon_style .= ($icon_size != '') ? 'font-size:'.esc_attr($icon_size).';' : '';

			$custom_icon_style .= ($icon_color != '') ? 'color:'.esc_attr($icon_color).';' : '';

			$custom_icon_style .= ($icon_bg_color != '') ? 'background:'.esc_attr($icon_bg_color).';' : '';

			$custom_icon_style .= '"';

		}

		$output = '<div class="pix-icons clearfix '. $align .'">';
		$output .= '<span class="icon '. esc_attr($icon_name) .' '. esc_attr($icon_style).' '. esc_attr($icon_type).'"'. $custom_icon_style .'></span>';

		if($title != '' && $title_tag != '' ){
			$output .= '<'. $title_tag .' class="title"'. $custom_text_style .'>'. esc_html($title) .'</'. $title_tag .'>';
		}

		$output .= '</div>';
		
		return $output;
	}


	/* =============================================================================
		 Latest Tweets Shortcodes
	   ========================================================================== */

	function pix_tweets($atts, $content = null){
		extract(shortcode_atts(array(
			'twtusr'		 => 'envato',
			'tweet_align'		 => 'center',
			'twtcount'  		 => '3',
			'no_of_col'		 => '',
			'style'			 => '',
			'slider'		 => 'yes',
			'autoplay'		 => '4000',
			'slide_speed'		 => '500',
			'slide_arrow'		 => 'true',
			'arrow_type'		 => '',
			'slider_height'		 => '',
			'pagination' 		 => 'true',
			'stop_on_hover'		 => 'true',
			'mouse_drag'		 => 'true',
			'touch_drag'		 => 'true'
		), $atts));

$page_class = '';

		if($no_of_col == '1'){
			$col = ' col1';
		}elseif($no_of_col == '2'){
			$col = ' col2';
		}else{
			$col = ' col3';
		}

	if($pagination == 'false'){
		$page_class = ' no-pagi-carousel';
	}

		$slider_data = $class = $output = '';	
		if (!empty($twtusr)){

			if($slider == 'yes'){
				$class = ' owl-carousel '. $style .' '. $tweet_align .''. $page_class .' '. $arrow_type;
				$slider_data = ' data-items="'. $no_of_col .'" data-auto-height="'. $slider_height .'" data-pagination="'. $pagination .'" data-touch-drag="'. $touch_drag .'" data-mouse-drag="'. $mouse_drag .'" data-stop-on-hover="'. $stop_on_hover .'" data-navigation="'. $slide_arrow .'" data-slide-speed="'. $slide_speed .'" data-auto-play="'. $autoplay. '" data-items-custom="[[0,1],[768,1],[991, '. $no_of_col .'],[1199, '. $no_of_col .']]"';
			}else{
				$class = ' no-slider '. $tweet_align .'';
			}
			$output .= '<div class="tweets'. $class .''. $col .' '. $style .'"'. $slider_data .'>';

			$tweets = getTweets(20, $twtusr);
			$i = 1;
			foreach($tweets as $tweet){
			   if(!empty($tweet['text']) && $tweet['text'] != "T" && $tweet['text'] != "M"){
					
					$output .= '<div class="twitter"><div class="tweet"><span class="tweet-icon pixicon-twitter"></span><div class="tweet-content">';
					$output .= make_twitter(link_it($tweet['text']));
					$output .= '<span class="tweetDate"> - ' . get_elapsedtime(strtotime($tweet['created_at'])) .'</span>';
					$output .= '</div></div></div>';
								
					if($i == $twtcount){ break; }
								
					$i++;
				}else{
					$output .= '<div>' . $tweets['error'] .'</div>';
				}
			}
			$output .= '</div>';

		}else{
			$output .= '<div>Please enter twitter username</div>';
		}

		return $output;
	}

	/* =============================================================================
		 Process Shortcodes
	   ========================================================================== */

	function pix_process($atts, $content = null){
		extract(shortcode_atts(array(
			'el_class' => '',
			'type' => 'default',
			'style' => 'default',
			'text' => '',
			'circle_text' => '00',
			'icon_name' => '',
			'title' => 'title',
			'process_style' => '',
			'process_content' => 'No'
		), $atts));

		$process_arrow = $arrow_left = $arrow_right = '';

		if($process_style == 'nav-style' || $process_style == 'nav-style straight'){
			$process_arrow = ' <div class="'. esc_attr($process_style) .'"><p class="center-arrow"></p></div>';
		}elseif($process_style == 'nav-style straight round'){
			$process_arrow = ' <div class="'. esc_attr($process_style) .'"><p class="center-arrow"></p></div>';
			$arrow_left = '<span class="round-left"></span>';
			$arrow_right = '<span class="round-right"></span>';
		}

		if($text == "icon"){
			$inner_text = '<span class="process-style '. esc_attr($icon_name) .'"></span>';
			$inner_style = $style;
		}elseif($text == "text"){
			$inner_text = '<span class="process-style inner-text">'. esc_html($title) .'</span>';
			$inner_style = $style;
		}else{
			$inner_text = '<span class="process-style">'. esc_html($circle_text) .'</span>';
			$inner_style = $style;
		}
		
		$output = '<div class="process '. esc_attr($el_class) .'><div class="process_circle '. esc_attr($inner_style) .' '. $type .'"><div class="text hi-icon">'. $arrow_left.' '. $inner_text .' '. $arrow_right.'</div>'. $process_arrow .'</div>';
		if($text != "text"){
			$output .= '<p class="title">'. esc_html($title) .'</p>';
		}
		if($process_content == 'yes'){
			$output .= '<p class="content">'.wpb_js_remove_wpautop($content).'</p>';
		}
		$output .= '</div>';
				
		return $output;
		
	}

	/* =============================================================================
	 Heading Shortcodes
	 ========================================================================== */

	 function pix_title($atts, $content = null, $code){
	 	extract(shortcode_atts(array(
	 		'el_class' => '',
	 		'title_tag' => 'h2',
	 		'style' => '',
	 		'title' => '',
	 		'sub_title'=> '',
	 		'sub_title_style' => '',
	 		'sub_title_text' =>'',
	 		'font_size' => '',
	 		'custom_font_size' => '',
	 		'custom_font_weight' => '',
	 		'uppercase' => 'No',
	 		'align' => 'left',
	        'title_margin' => '',
	        'sub_title_margin' => '', 
        ), $atts));

	 	$output = $sub_text = $sub_class = "";

		//Uppercase Yes or No
	 	$class = ($uppercase == 'yes') ? ' uppercase' : '';


		//Checking Title Style
	 	$css_style = 'style="';
	 	$css_style .= !empty($title_margin) ? 'margin: '. $title_margin .'; ' : '';
	 	$css_style .= !empty($custom_font_size) ? 'font-size: '. $custom_font_size .'; ' : '';
	 	$css_style .= !empty($custom_font_weight) ? 'font-weight: '. $custom_font_weight .'; ' : '';
	 	$css_style .= '"';

	 	if($sub_title == "yes" && $sub_title_text != ''){
	 		$sub_title_margin = (!empty($sub_title_margin)) ? 
	 							'style="margin-bottom:'. $sub_title_margin.'"' : 
	 							'';

	 		$sub_text = '<p class="sub-title '. esc_attr($sub_title_style) .'" '. esc_attr($sub_title_margin) .'>'. esc_html($sub_title_text) .'</p>';
	 		$sub_class = ' sub-title-con';
	 	}

	 	/* Font Size */
	 	if($font_size == "size-md"){
	 		$class .= ' size-md';
	 	}elseif ($font_size == 'size-lg') {
	 		$class .= ' size-lg';
	 	}else{
	 		$class .= ' size-sm';
	 	}


	//Check Alignment
	 	if ($align == 'right'){
	 		$class .= ' alignRight';
	 	}elseif ($align == 'center') {
	 		$class .= ' alignCenter';
	 	}

	 $output  .= '<'. $title_tag .' class="main-title title'. $sub_class .' '. $el_class .' '.$class.'" '. $css_style .'>';

	 $output .= $title;

	 $output .= '</'. $title_tag .'>';

	 $output .= $sub_text;

	 return $output;
	}


	/* =============================================================================
		 Blog Shortcodes
	   ========================================================================== */
	function pix_blog($atts, $content = null){
		extract(shortcode_atts(array(
			'no_of_items' 	=> 4,
			'insert_type'		 => 'posts',
			'blog_post_id' => '',
			'blog_post_category' => '',
			'exclude_blog_post' => '',
			'order_by'		=> 'date', //'none', ID', 'author' , 'title', 'name', 'date', 'modified', 'parent', 'rand'
			'order' 		=> 'asc', //desc, asc
			'columns' 		=> 'col4', // col3, col4
			'title_tag'		=> 'h3',
			'display_author'	=> 1,
			'display_date'	=> 1,
			'blog_desc'	=> 1,
			'button_text'	=> 'Read More'
		), $atts));

		$page_class = $cats = $category_name = $temp_thumb = '';

		if(!empty($exclude_blog_post)){
			$exclude_blog_post= explode(',', $exclude_blog_post);
		}
		else{
			$exclude_blog_post = '';
		}


		if(!empty($blog_post_category) && $insert_type == 'category'){
			$category_name = $blog_post_category;

		}

		else if(!empty($blog_post_id) && $insert_type == 'id'){
			$blog_post_id = explode(',', $blog_post_id);
		}


		else if($insert_type != 'id' && $insert_type != 'category'){

			$categories= get_the_category();
			$cats= array();

			foreach($categories as $category){	
				$cats[] = $category->term_id;
			}
		}
		

		$id = get_the_ID();

		$post_not_in = array_merge((array)$id, (array)$exclude_blog_post);


		if(($blog_post_id != "" && $insert_type == 'id') || ($insert_type == 'posts')){


			$args = array(				
				'order' => $order,
				'orderby' => $order_by,
				'posts_per_page' => ( !empty($no_of_items) && is_numeric($no_of_items)) ? $no_of_items : 6,
				'post__in' => $blog_post_id,
				'post__not_in' => $exclude_blog_post
			);
		}
		else{
			$args = array(
				'orderby' => $order_by,
				'order' => $order,
				'posts_per_page' => ( !empty($no_of_items) && is_numeric($no_of_items))   ? $no_of_items : 6,
				'post__not_in' => $post_not_in,
				'category__in' => $cats,
				'category_name' => $category_name
			);
		}

		$width = '515'; $height = '390';

		if($columns == 'col3'){
			$shorten_length = 160;
			$class = 'vc_col-sm-4';
		}else{
			$class = 'vc_col-sm-3';
			$shorten_length = 90;			
		}


		//VC_COLUMNS
		$output = '<div class="wpb_row vc_row-fluid row recent-post">';

		$the_query = new WP_Query( $args );

		if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();

			$temp_title = get_the_title($the_query->post->ID); //title
			if($blog_desc == 1){
				$temp_content = '<p>'. strip_tags(strip_shortcodes(ShortenText(get_the_content($the_query->post->ID),$shorten_length))).'</p>'; //content
			}else{
				$temp_content = '';
			}
			$temp_link = get_permalink($the_query->post->ID); //permalink

			$img = '';


			if (has_post_thumbnail()) {    
				$image_id = get_post_thumbnail_id ($the_query->post->ID );  
				$image_thumb_url = wp_get_attachment_image_src( $image_id, 'full');
				if(!empty($image_thumb_url)){
					$img = aq_resize($image_thumb_url[0], $width, $height, true, true); 
				}

				if($img){
					$temp_thumb = '<div class="eventsimg"><img src="'.$img.'" alt=""></div>';
				}else{
					$temp_thumb = '<div class="eventsimg"><img src="'.$image_thumb_url[0].'" alt=""></div>';
				}
			}
			
			else {

				$protocol = is_ssl() ? 'https' : 'http';
                $temp_thumb = '<div class="eventsimg"><img src="'.$protocol.'://placehold.it/'.$width.'x'.$height.'" alt=""></div>';
			}

			$output .= '<div class="'.$class.'">
                                <div class="event">';
            $output .= $temp_thumb ;

            $output .= '<div class="event-content">
                            <h3 class="title"><a href="'.$temp_link.'">'.$temp_title.'</a></h3>';

            if($display_author == 1 || $display_date == 1){

            	$output .= '<ul class="meta">';

            	if($display_author == 1){
            		$output .= '<li>by <a href="'.get_the_author_link().'">'.ucwords(get_the_author()).'</a> </li>';
            	}
            	if($display_date == 1){
            		$output .= '<li>'.get_the_time('d F, Y').'</li>';
            	}

	            $output .= '</ul>';
            }

            

            $output .= '<span class="sep"></span>';

            $output .= $temp_content;

            $output .= '<a href="'.$temp_link.'" class="btn btn-md btn-solid btn-grey">'.esc_html($button_text).'</a>
                        </div>';

            $output .= '</div>
                            </div>';

		endwhile; 
		
		else:
		  $output .= "<div>Post Not Found.</div>";
		endif;
	   
	   wp_reset_postdata();
	   $output .= '</div>';
	   return  $output;
	}

	/* =============================================================================
		 Speakers Shortcodes
	   ========================================================================== */

	//Speakers Loop
	function pix_speakers($atts, $content = null){
		extract(shortcode_atts(array(
			'no_of_speaker' 	=> -1,
			'exclude_speakers' 	=> '',
			'order_by'		=> 'date', //'none', ID', 'author' , 'title', 'name', 'date', 'modified', 'parent', 'rand', 'menu_order'
			'order' 		=> 'asc', //desc, asc
			'speaker_id'		=> '',
			'columns' 		=> 'col4', //col2, col3, col4
			'title_tag'		=> 'h3',
			'insert_type'	=> 'posts',
			'lightbox'		=> 'yes',
			'speaker_desc'	=> 'yes'
		), $atts));

		$page_class = '';
		
		if(!empty($exclude_speakers)){
			$exclude_speakers= explode(',', $exclude_speakers);
		}
		else{
			$exclude_speakers = '';
		}


		if($speaker_id != "" && $insert_type == 'id'){
			$speaker_id= explode(',', $speaker_id);

			$args = array(
				'post_type' => 'pix_speaker',
				'order' => $order,
				'orderby' => 'post__in',
				'post__in' => $speaker_id,
				'post__not_in' => $exclude_speakers
				
				);
		}else{
			$args = array(
				'post_type' => 'pix_speaker',
				'orderby' => $order_by,
				'order' => $order,
				'posts_per_page' => ( !empty($no_of_speaker) && is_numeric($no_of_speaker))   ? $no_of_speaker : -1,
				'post__not_in' => $exclude_speakers
				);
		}


		$width ='515'; $height ='390';
		   
		if($columns == 'col3'){
			$shorten_length = 170;
			$class = 'col-md-4';
		}
		else{
			$class = 'col-md-3';
			$shorten_length = 120;
		}
			

		$the_query = new WP_Query( $args );

		$output = '<div class="wpb_row row speaker">';

		if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();

			$temp_title = get_the_title($the_query->post->ID); //title
			$temp_content = ShortenText(get_the_content($the_query->post->ID),$shorten_length); //content
			$temp_link = get_permalink($the_query->post->ID); //permalink

			$img = "";

			if (has_post_thumbnail()) {    
				$image_id = get_post_thumbnail_id ($the_query->post->ID );  
				$image_thumb_url = wp_get_attachment_image_src( $image_id, 'full');
				if(!empty($image_thumb_url)){
					
					$img = aq_resize($image_thumb_url[0], $width, $height, true, true); 
					
				}
				if($img){
					$temp_thumb = "<img src='$img' alt=''>";
				}else{
					$temp_thumb = "<img src='$image_thumb_url[0]' alt=''>";                                    
				}
			}
			else {

				$protocol = is_ssl() ? 'https' : 'http';
                $temp_thumb = '<div class="eventsimg"><img src="'.$protocol.'://placehold.it/'.$width.'x'.$height.'" alt=""></div>';
			}

			$meta = get_post_meta(get_the_id(),'speaker_social_links');

			if( !empty($meta) && !empty($meta[0])){
				extract($meta[0]);
			}

			$i=1;

			$social_icons = '';

			if(!empty($speaker_email) || !empty($facebook) || !empty($twitter) || !empty($gplus) || !empty($linkedin) || !empty($dribbble) || !empty($flickr)){

				$j=0;

				if(!empty($speaker_email)){
					$j++;
				}
				if(!empty($facebook)){
					$j++;
				}
				if(!empty($twitter)){
					$j++;
				}
				if(!empty($gplus)){
					$j++;
				}
				if(!empty($linkedin)){
					$j++;
				}
				if(!empty($dribbble)){
					$j++;
				}
				if(!empty($flickr)){
					$j++;
				}

				if($j > 5){
					$j = 5;
				}

				$num = convertNumber($j);

				$social_icons .= '<div class="social-icon links clearfix '.$num.'">';

					$social_icons .= '<ul>';

					if(!empty($speaker_email)){
						$social_icons .= '<li><a href="'.esc_url($speaker_email).'" class="email fa fa-envelope-o"></a></li>';
						$i++;	
					}
					if(!empty($facebook)){
						$social_icons .= '<li><a href="'. esc_url($facebook) .'" class="facebook fa fa-facebook"></a></li>';
						$i++;	
					}
					if(!empty($twitter)){
						$social_icons .= '<li><a href="'. esc_url($twitter)  .'" class="twitter fa fa-twitter"></a></li>';
						$i++;	
					}
					if(!empty($gplus)){
						$social_icons .= '<li><a href="'. esc_url($gplus).'" class="googleplus fa fa-google-plus"></a></li>';
						$i++;	
					}
					if(!empty($linkedin)){
						$social_icons .= '<li><a href="'. esc_url($linkedin) .'" class="linkedin fa fa-linkedin"></a></li>';
						$i++;	
					}

					if(!empty($dribbble) && ($i <= 5)){
						$social_icons .= '<li><a href="'. esc_url($dribbble) .'" class="dribbble fa fa-dribbble"></a></li>';
						$i++;	
					}
					if(!empty($flickr)  && $i <= 5){
						$social_icons .= '<li><a href="'. esc_url($flickr) .'" class="flickr fa fa-flickr"></a></li>';
						$i++;	
					}

					$social_icons .= '</ul>';

				$social_icons .= '</div>';
			}

			$professions = get_the_term_list(get_the_id() , 'pix_professions','',', ');
			$professions = !empty($professions) ? '<p class="job">'.ucwords(strip_tags( $professions )).'</p>' : '';


			$output .= '<div class="'.$class.'">
				<div class="event bg">
					<div class="eventsimg">
						'.$temp_thumb.'
					</div>
					<div class="event-content">
						<'. $title_tag .' class="title">'.esc_html($temp_title).'</'. $title_tag .'>
						'.$professions.'
						<p>'.esc_html($temp_content).'[...] </p>

					</div>
					'.$social_icons.'
				</div>
            </div>';
		endwhile;
		
		else:
		  $output .= "<div>No Event Speakers Posts Found.</div>";
		endif;

		$output .= '</div>';
	   
	   	wp_reset_postdata();

	   	return  $output;
	}



	/* =============================================================================
		Icon Box Shortcode
	   ========================================================================== */

	//Staffs Loop
	function pix_icon_box($atts, $content = null){
		extract(shortcode_atts(array(
			'display_icon_box_bg' 	=> 'yes',
			'icon_name' 			=> 'fa-calendar',
			'icon_border' 			=> 'square-border',
			'icon_color' 			=> 'color',
			'icon_size' 			=> 'md',
			'title' 				=> 'Title',
			'title_tag' 			=> 'h3',
			'add_bg_hover' 		=> 'yes',
			'display_button' 		=> 'no',
			'button_text' 			=> 'Read More',
			'button_link' 			=> '',
			'button_style' 			=> 'border',
			'button_color' 			=> 'btn-color',
			'button_size' 			=> 'md',
			'button_event' 			=> 'active',
			'button_align' 			=> 'button-center',
			'button_icon' 			=> '',
			'button_icon_align' 	=> ''
		), $atts));

		$display_icon_box_bg = ($display_icon_box_bg == 'yes') ? $display_icon_box_bg = 'bg' : $display_icon_box_bg = '';

		$add_bg_hover = ($add_bg_hover == 'yes') ? $add_bg_hover = 'add_bg_hover' : $add_bg_hover = '';


		$output = '<div class="event icon-box '.$display_icon_box_bg.' '.$add_bg_hover.'">';

		$output .= '<div class="eventsicon '.esc_attr($icon_border).' '.esc_attr($icon_color).' '.esc_attr($icon_size).'">
						<i class="fa '.esc_attr($icon_name).'"></i>
					</div>';

		$output .= '<div class="event-content">
						<'.$title_tag.' class="title">'.$title.'</'.$title_tag.'>';

		if(!empty($content)){
			$output .= '<p>'.$content.'[...] </p>';
		}

		if($display_button == 'yes'){
			$output .= do_shortcode( '[button button_text="'.esc_attr($button_text).'" button_link="'.esc_url($button_link).'" button_style="'.esc_attr($button_style).'" button_color="'.esc_attr($button_color).'" button_size="'.esc_attr($button_size).'" button_event="'.esc_attr($button_event).'" custom_size="no" button_icon_align="'.esc_attr($button_icon_align).'"]' );
		}
		
		$output .= '</div>
			</div>';

	   return  $output;
	}


	/* =============================================================================
		 List Style
	   ========================================================================== */

	function pix_list($atts, $content = null, $code) {
		extract(shortcode_atts(array(
			'style' => ''
		),$atts));
		$output = '<ul class="list">'. wpb_js_remove_wpautop($content) .'</ul>';
		return $output;
	}

	function pix_li($atts, $content = null, $code) {
		extract(shortcode_atts(array(
			'icon_name' => '',
			'icon_color'	=> '',
			'user_icon_color' => '',
		),$atts));

		if($icon_color == 'custom'){
			$user_icon_color = 'style="color:'.$user_icon_color.';"';
		}

		if(!empty($icon_name)){
			$output = '<li class="icon-list"><i class="fa '. esc_attr($icon_name) .' '. esc_attr($icon_color) .'" '. esc_attr($user_icon_color) .'></i>'. wpb_js_remove_wpautop($content) .'</li>';
		}else{
			$output = '<li>'. wpb_js_remove_wpautop($content) .'</li>';
		}
		return $output;
	}

	/* =============================================================================
		 Testimonial Shortcodes
	   ========================================================================== */

	//Testimonial Loop
	function pix_testimonial($atts, $content = null){
		extract(shortcode_atts(array(
			'no_of_testimonial'      => -1,
			'exclude_testimonial'    => '',
			'order_by'		 => 'date', //'none', ID', 'author' , 'title', 'name', 'date', 'modified', 'parent', 'rand', 'menu_order'
			'order' 		 => 'desc', //desc, asc
			'testimonial_id'	 => '',
			'insert_type'		 => 'posts',
		), $atts));

$page_class = '';

		if(!empty($exclude_testimonial)){
			$exclude_testimonial= explode(',', $exclude_testimonial);
		}
		else{
			$exclude_testimonial = '';
		}

		if($testimonial_id != "" && $insert_type == 'id'){
			$testimonial_id= explode(',', $testimonial_id);

			$args = array(
				'post_type' => 'pix_testimonial',
				'order' => $order,
				'orderby' => 'post__in',
				'post__in' => $testimonial_id,
				'post__not_in' => $exclude_testimonial
				);
		}else{
			$args = array(
				'post_type' => 'pix_testimonial',
				'orderby' => $order_by,
				'order' => $order,
				'posts_per_page' => ( !empty($no_of_testimonial) && is_numeric($no_of_testimonial))   ? $no_of_testimonial : -1,
				'post__not_in' => $exclude_testimonial
				);
		}

		
		$output = '<div class="owl-testimonial">';
			

		$the_query = new WP_Query( $args ); 

		if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();

			$title = get_the_title(); //title
			$content = get_the_content(); //content
			
			if (has_post_thumbnail()) {    
				$image_id = get_post_thumbnail_id ($the_query->post->ID );  
				$image_thumb_url = wp_get_attachment_image_src( $image_id, 'full');
				if(!empty($image_thumb_url)){
					$img = aq_resize($image_thumb_url[0], 98, 98, true, true); 			
				}

				if($img){
					$temp_thumb = "<div class='testimonial-img'><img src='$img' alt=''></div>";
				}else{
					$temp_thumb = "<div class='testimonial-img'><img src='$image_thumb_url[0]' alt=''></div>";                                     
				}
			}
			else {
				$temp_thumb = '';
			}

			$jobs = get_the_term_list(get_the_id() , 'pix_jobs','',', ');
			$jobs = !empty($jobs) ? '<small>'.ucwords(strip_tags( $jobs )).'</small>' : '';


			
            $output .= '<div class="testimonials">';

	            if(!empty($content)){
	            	$output .= '<div class="testimonials-content"><p>'.$content.' </p>
	                    <span class="arrow-down"></span></div>';
	            }

	            if(!empty($title)){
	            	$output .= '<p class="name">by '.$title.'</p>';
	            }

	            $output .= $jobs;

            $output .= '</div>';
			
		endwhile; 
		
		else:
		  $output .= "<div>Testimonial posts not Found. Please add atleast one.</div>";
		endif;
	   

	   $output .= '</div>';

	   wp_reset_postdata();
	  
		return $output;
	}


	/* =============================================================================
		 Counters Shortcodes
	   ========================================================================== */
	function pix_counter( $atts, $content = null ){
		extract(shortcode_atts(array(
			'el_class' => '',
			'number'  => '5000',
			'text' => 'Pizzas ordered',
			'icon' => '',
			'icon_name' => '',
			'icon_align' => 'left',
			'icon_color' => '',
			'border'  =>  '',
			'text_font_size' => '',
			'number_font_size' => ''
		), $atts));

		$number_size = $text_size = '';
		
		if ($number_font_size != '') {
			$number_size = ' style="font-size: '. esc_attr($number_font_size) .'";';
		}

		if ($text_font_size != '') {
			$text_size = ' style="font-size: '. esc_attr($text_font_size) .'";';
		}

		$output ='<div class="counter '. $el_class .' '.esc_attr($border).' clearfix"><div class="absolute-center">';
		
		if($icon == 'yes' && $icon_name != ''){
			$output .=' <i class="'.esc_attr($icon_align).' pixicon '.esc_attr($icon_name).''. esc_attr($icon_color).'"></i>';
		}
			
		$output .= '<div class="counter-box '.esc_attr($icon_align).'">
					<span class="counter-value"'. esc_attr($number_size) .'>'. esc_html($number) .'</span>
					<span class="content"'. esc_attr($text_size) .'>'. esc_html($text) .'</span>
					</div></div>	
					</div>';
		return $output;
	}

	/* =============================================================================
		 Google Map API v3 Shortcodes
	   ========================================================================== */
	   function pix_googlemap( $atts ) {
	   	global $pix_theme_pri_color, $gmap_count;
	   	$gmap_count++;
	   	extract(shortcode_atts(array(
	   		'width' => '98%',
	   		'height' => '300',
	   		'api_key' => '',
	   		'lat' => '',
	   		'lng' =>'',
	   		'zoom' => '13',
	   		'pancontrol' => 'true',
	   		'zoomcontrol'=> 'true',
	   		'maptypecontrol'=> 'true',
	   		'scalecontrol'=> 'true',
	   		'streetviewcontrol'=> 'true',
	   		'overviewmapcontrol'=> 'true',
	   		'contact_info' => '',
	   		'email' => '',
	   		'address_title' => '',
	   		'address' => '',
	   		'contact_number' => ''
	   		), $atts));

	   	$pancontrol = ($pancontrol == 'true') ? 'true' : 'false';
	   	$zoomcontrol = ($zoomcontrol == 'true') ? 'true' : 'false';
	   	$maptypecontrol = ($maptypecontrol == 'true') ? 'true' : 'false';
	   	$scalecontrol = ($scalecontrol == 'true') ? 'true' : 'false';
	   	$streetviewcontrol = ($streetviewcontrol == 'true') ? 'true' : 'false';
	   	$overviewmapcontrol = ($overviewmapcontrol == 'true') ? 'true' : 'false';

	   	$rand = rand(1,100) * rand(1,100);

	   	$output = '<div class="pix-map">';  		   			

	   	$output .= '<div class="map_api" id="map_canvas_'.esc_attr($rand).'" style="width:'. $width .'; height:'. $height .'px"></div>';	   	

			if($contact_info == 'yes'){
				$output .= '<div class="map-contact"><div class="contact-wrap">';
					$output .= '<div class="address-wrap">';
				if($address_title != ''){
					$output .= '<h2 class="title"><span class="pixicon-marker"></span>'. $address_title .'</h2>';
				}
				if($address != ''){
					$output .= '<p class="address">'. $address .'</p>';
				}
				if($email != ''){
					$output .= '<a href="mailto:'. esc_url($email) .'" class="link"><span class="pixicon-mail"></span>'. $email .'</a>';
				}
				if($contact_number != ''){
					$output .= '<p class="number"><span class="pixicon-telephone"></span>'. $contact_number .'</p>';
				}
					$output .= '</div>';
				$output .= '</div></div>';
	   		}
	   
		$output .= '</div>';
		if($gmap_count == 1){
   			$output .= '<script src="http://maps.googleapis.com/maps/api/js?key='.esc_attr( $api_key ).'" type="text/javascript"></script>';
   		}
   		//wp_enqueue_script( 'jquery' );
   		$output .= '<script type="text/javascript">
   		 	function initialize'.$rand.'() {
	   			var myLatlng = new google.maps.LatLng('.$lat.','. $lng .');
	   			var styles = [
	   			    {
	   			      stylers: [
	   			        { hue: "'.$pix_theme_pri_color.'" },
	   			        { saturation: -20 }
	   			      ]
	   			    },{
	   			      featureType: "road",
	   			      elementType: "geometry",
	   			      stylers: [
	   			        { lightness: 100 },
	   			        { visibility: "simplified" }
	   			      ]
	   			    },{
	   			      featureType: "road",
	   			      elementType: "labels",
	   			      stylers: [
	   			        { visibility: "off" }
	   			      ]
	   			    }
	   			  ];  
	   			  
	   			var mapOptions = {
	   				center: myLatlng,
	   				zoom: '. $zoom .',
	   				panControl: '. $pancontrol .',
	   				zoomControl: '. $zoomcontrol .',
	   				mapTypeControl: '. $maptypecontrol .',
	   				scaleControl: '. $scalecontrol .',
	   				streetViewControl: '. $streetviewcontrol .',
	   				overviewMapControl: '. $overviewmapcontrol .',
	   				mapTypeId: google.maps.MapTypeId.ROADMAP,
	   				styles: styles
	   			};
	   			var map = new google.maps.Map(document.getElementById("map_canvas_'.$rand.'"),
	   				mapOptions);
				var marker = new google.maps.Marker({
					position: myLatlng
				});

				marker.setMap(map);        
			}
			
			initialize'.$rand.'();

   		</script>';
		return $output;
	}


	/* =============================================================================
		 Event Gallery Slider Shortcodes
	   ========================================================================== */
	function pix_event_gallery_slider( $atts, $content = null ){
		extract(shortcode_atts(array(
			'main_title' => 'Gallery of Event',
			'orderby' => 'rand',
			'order' => 'ASC',
			'no_of_items' => 6
		), $atts));

		$args = array(
			'post_type' => 'pix_gallery',
			'orderby' => $orderby,
			'order' => $order,
			'posts_per_page' => ( !empty($no_of_items) && is_numeric($no_of_items))   ? $no_of_items : -1
		);

		$the_query = new WP_Query( $args );

		$output = '<section class="event-gallery newsection clearfix">
                    <h2 class="title">'.$main_title.'</h2>
                    <div class="owl-team">';

		if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();

			$title = get_the_title(); //title
			
			$img = "";

			if (has_post_thumbnail()) {    
				$image_id = get_post_thumbnail_id ($the_query->post->ID );  
				$image_thumb_url = wp_get_attachment_image_src( $image_id, 'full');
				if(!empty($image_thumb_url)){
					
					$img = aq_resize($image_thumb_url[0], 515, 390, true, true); 
					
				}
				if($img){
					$feature_img = '<div class="gallery-event-img"><img src="'.esc_attr($img).'" alt=""></div>';
				}else{
					$feature_img = '<div class="gallery-event-img"><img src="'.$image_thumb_url[0].'" alt=""></div>';                                    
				}
			}
			else {
				$protocol = is_ssl() ? 'https' : 'http';
				$feature_img = '<div class="gallery-event-img"><img src="'.$protocol.'://placehold.it/515
					x390" alt=""></div>';
			}
			
			$categories = get_the_term_list($the_query->post->ID , 'pix_categories','',', ');
			$categories = !empty($categories) ? strip_tags( $categories ) : '';

		

            $output .= '<div class="event-gallery-content">
                            '.$feature_img.'
                            <div class="content">
                                <h3 class="title">'.esc_html($title).'</h3>';

            if(!empty($categories)){
            	$output .= '<p>'.ucwords($categories).'</p>';
            }
            

            $output .= '</div>
                        </div>';	

                        	

                    

        endwhile;

        $output .= '</div>
                	</section>';

        else:

        	$output = '';

        endif;
		return $output;
	}	


    /* =============================================================================
		 Upcoming and Popular Event Tab Shortcodes
	   ========================================================================== */

	function pix_upcoming_popular_tab($atts, $content = null){
		extract(shortcode_atts(array(
			'no_of_event' 	=> 4,
			'title_tag'		=> 'h3',
			'tab_one_title' => 'Upcoming Events',
			'tab_two_title' => 'Popular Events',
			'limit'			=> '200',
			'meta'			=> 'yes', 
			'display_button' => 'yes',
			'button_style' => '',
			'button_size' => '',
			'button_text' => 'View all Event',
			'button_color' => '',
			'target' => '_self'

		), $atts));

		$tab_one_id = rand();

		$tab_two_id = rand();

		$tabs = array($tab_one_id => $tab_one_title, $tab_two_id => $tab_two_title );

		$archive_link = get_post_type_archive_link( 'pix_event' );


		//Upcoming Event Arguement

        $now = time();

		global $wpdb;

		$event_cpt_ID = $wpdb->get_results("SELECT ID
                    FROM $wpdb->posts WHERE post_type = 'pix_event' AND post_status = 'publish'", ARRAY_N);

		$popular_id = $upcoming_id = $upcoming_arr = $popular_arr = array();

        foreach ( $event_cpt_ID as $value ){
        	$event_details = get_post_meta($value[0],'event_details');
			if( !empty($event_details) && !empty($event_details[0])){
				extract($event_details[0]);
			}

            $evt_date = date("d/m/Y", strtotime($event_date_from));

			$evt_time = date("H:i:s", strtotime($event_time));

			$get_date = $get_time = array();

			$get_date = explode('/', $evt_date); // dd/mm/yyyy

			$get_time = explode(':', $evt_time); // hh:mm:ss

			$timestamp = mktime($get_time[0], $get_time[1], $get_time[2], $get_date[1], $get_date[0], $get_date[2]); // Hour/Minute/Second/Month/Day/Year

            if(!empty($timestamp) && $now < $timestamp){
            	$upcoming_id[$timestamp] = $value[0];
            }

        }

        if(!empty($upcoming_id)){

        	ksort($upcoming_id);

            $upcoming_arr = array(
                'post_type'      => 'pix_event',
                'posts_per_page' => $no_of_event,
                'orderby' => 'post__in',
                'post__in' => $upcoming_id
                );
        }

		//Popular Event Arguements

        foreach ( $event_cpt_ID as $value ){

            $popular = get_post_meta( $value[0], 'popular', true );

            if($popular == 'yes'){
            	$event_details = get_post_meta($value[0],'event_details');
				if( !empty($event_details) && !empty($event_details[0])){
					extract($event_details[0]);
				}

	            $evt_date = date("d/m/Y", strtotime($event_date_from));

				$evt_time = date("H:i:s", strtotime($event_time));

				$get_date = $get_time = array();

				$get_date = explode('/', $evt_date); // dd/mm/yyyy

				$get_time = explode(':', $evt_time); // hh:mm:ss

				$timestamp = mktime($get_time[0], $get_time[1], $get_time[2], $get_date[1], $get_date[0], $get_date[2]); // Hour/Minute/Second/Month/Day/Year

	            if(!empty($timestamp) && $now < $timestamp){
	            	$popular_id[$timestamp] = $value[0];
	            }
            	
            }

        }


        if(!empty($popular_id)){

        	ksort($popular_id);

            $popular_arr = array(
                'post_type'      => 'pix_event',
                'posts_per_page' => $no_of_event,
                'orderby' => 'post__in',
                'post__in' => $popular_id
                );
        }

		$output = '<div class="tabs event-tab upcoming-popular-tab">';

		$output .= '<ul class="clearfix">';
            

		foreach ($tabs as $tab_id => $tab_title) {
			$output .= '<li><a href="#tabs'.$tab_id.'">'.esc_html($tab_title).'</a></li>';
		}

		$output .= '</ul>';

		foreach ($tabs as $tab_id => $tab_title) {

			if($tab_title == $tab_one_title){
				$the_query = new WP_Query( $upcoming_arr );
			}
			else{
				$the_query = new WP_Query( $popular_arr );
			}

			$output .= '<div id="tabs'.$tab_id.'">
	                <div class="event-container">
	                    <div class="row">';

	        $img = '';

			if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();

				$like_count = get_post_meta( get_the_ID(), '_pix_like_me', true );
				$like_class = ( isset($_COOKIE['pix_like_me_'. get_the_ID()])) ? 'liked' : '';
				if($like_count == ''){
					$like_count = 0;
				}

				$title =  get_the_title(); //title
				$content = strip_tags(strip_shortcodes(ShortenText(get_the_content(),$limit))); //content
				$link = get_permalink(); //link

				//feature thumbnail
				if (has_post_thumbnail()) {    
					$image_id = get_post_thumbnail_id ($the_query->post->ID );  
					$image_thumb_url = wp_get_attachment_image_src( $image_id, 'full');
					if(!empty($image_thumb_url)){
						$img = aq_resize($image_thumb_url[0], 263, 200, true, true); 			
					}

					if($img){
						$feature_img = "<div class='eventsimg'><img src='$img' alt=''></div>";
					}else{
						$feature_img = "<div class='eventsimg'><img src='$image_thumb_url[0]' alt=''></div>";                                     
					}
				}
				else {
					$feature_img = '';
					$protocol = is_ssl() ? 'https' : 'http';
                	$feature_img = '<div class="eventsimg"><img src="'.$protocol.'://placehold.it/263x200" alt=""></div>';
				}
				if(class_exists('Woocommerce')){

	                global $product;                        

	                $woo_product_id = get_post_meta(get_the_ID(), 'woo_product_id', true);

	                $product = get_product($woo_product_id);

	                if(is_object($product) && !empty($product) && ($product->get_price() > 0)){
	                    if($product->is_in_stock()){
	                        $button = '<a href="'.get_permalink().'" class="btn btn-solid btn-blue btn-md">Buy Ticket</a>';                           
	                    }else{
	                        $button = '<a href="'.get_permalink().'" class="btn disabled btn-solid btn-grey btn-md">Sold Out</a>';
	                    }
	                    
	                }
	                if(is_object($product) && !empty($product) && $product->get_price() <= 0){
	                    $button = '<a href="'.get_permalink().'" class="btn btn-solid btn-brown btn-md">Free Entry</a>';
	                }
	            }

                if(empty($product)){
                    $button = '<a href="'.get_permalink().'" class="btn btn-solid btn-blue btn-md">View Event</a>';
                }
				
	            if($tab_title == $tab_one_title){
					
					$output .= '<div class="col-md-3">
                            		<div class="event bg">
                                		'.$feature_img.'
                                		<div class="event-content">
	                                    	<h3 class="title">'.esc_html($title).'</h3>';

	                                    	$event_details = get_post_meta(get_the_ID(),'event_details');
								            if( !empty($event_details) && !empty($event_details[0])){
								                extract($event_details[0]);
								            }

								            $meta = '';

								            if(!empty($event_date_from) || !empty($event_date_to) || !empty($venue_name) || $select_country != 'Select a Country:' || !empty($state)){


							                    $meta = '<ul class="meta clearfix">';

						                            if(!empty($event_date_from) || !empty($event_date_to)){

						                                  $meta .= '<li class="date"><i class="icon fa fa-calendar"></i> ';

						                                    if(!empty($event_date_from)){
						                                        $meta .= date("d M Y", strtotime($event_date_from));
						                                    }

						                                    if(!empty($event_date_from) && !empty($event_date_to)){
						                                        $meta .= ' to ';
						                                    }

						                                    if(!empty($event_date_to)){
						                                        $meta .= date("d M Y", strtotime($event_date_to));
						                                    }

						                                    $meta .= '</li>';
						                            }
							                    $meta .= '</ul>';
							                    $meta .= '<span class="sep"></span>';

            								}

								            $output .= $meta;

						                    if(!empty($content)){
						                    	$output .= '<p>'.esc_html($content).' [...] </p>';
						                    }
	                    
	                    
	                    					$output .=  $button;

                    				$output .= '</div>';

			                    	if($meta == 'yes'){
			                    		 $output .= '<div class="links three clearfix">
			                                    <ul>
			                                        <li><a class="st_sharethis_large" displayText="ShareThis"><i class="icon fa fa-share"></i> share</a></li>
			                                        
			                                        <li><a href="#void" class="portfolio-icon pix-like-me '. $like_class .'" data-id="'. get_the_ID() .'"><i class="icon fa fa-heart"></i><span class="like-count">'. $like_count .'</span></a></li>
			                                        <li><i class="icon fa fa-comment"></i>'.get_comments_number().'</li> 
			                                    </ul> 
			                             </div>';
			                    	}
                 

                    $output .= '</div>
                        </div>';
		                				
					
	            	
	            }
	            if($tab_title == $tab_two_title){

        			$output .= '<div class="col-md-3">
                        		<div class="event bg">
                            		'.$feature_img.'
                            		<div class="event-content">
                                	<h3 class="title">'.esc_html($title).'</h3>';

                                	$event_details = get_post_meta(get_the_ID(),'event_details');
						            if( !empty($event_details) && !empty($event_details[0])){
						                extract($event_details[0]);
						            }

						            $meta = '';

						            if(!empty($event_date_from) || !empty($event_date_to) || !empty($venue_name) || $select_country != 'Select a Country:' || !empty($state)){


					                    $meta = '<ul class="meta clearfix">';

				                            if(!empty($event_date_from) || !empty($event_date_to)){

				                                  $meta .= '<li class="date"><i class="icon fa fa-calendar"></i> ';

				                                    if(!empty($event_date_from)){
				                                        $meta .= date("d M Y", strtotime($event_date_from));
				                                    }

				                                    if(!empty($event_date_from) && !empty($event_date_to)){
				                                        $meta .= ' to ';
				                                    }

				                                    if(!empty($event_date_to)){
				                                        $meta .= date("d M Y", strtotime($event_date_to));
				                                    }

				                                    $meta .= '</li>';
				                            }
					                    $meta .= '</ul>';
					                    $meta .= '<span class="sep"></span>';

    								}

						            $output .= $meta;

				                    if(!empty($content)){
				                    	$output .= '<p>'.esc_html($content).' [...] </p>';
				                    }                
                
                
                					$output .=  $button;

               					 $output .= '</div>';


	                    		if($meta =='yes'){

					                $output .= '<div class="links three clearfix">
					                    <ul>
					                    	<li><a class="st_sharethis_large" displayText="ShareThis"><i class="icon fa fa-share"></i> share</a></li>
					                    	<li><a href="#void" class="portfolio-icon pix-like-me '. $like_class .'" data-id="'. $the_query->post->ID .'"><i class="icon fa fa-heart"></i><span class="like-count">'. $like_count .'</span></a></li>
					                    	<li><i class="icon fa fa-comment"></i>'.get_comments_number().'</li> 
					                    </ul> 
					               	 </div>';
				          		}


                    $output .= '</div></div>'; 					
										
	            }
	                    
	            
			endwhile;			
			
			else:
			  $output .= "<div>No Events Found.</div>";
			endif;

			$output .= '</div>
	                </div>
	            </div>';
		}
		if($display_button == 'yes'){
			$output .= '<a href="'. $archive_link .'" target="'.$target.'" class="clear btn btn-'. esc_attr($button_style) .' btn-'. esc_attr($button_size) .' '. esc_attr($button_color).'">'. esc_html($button_text) .'</a>';
		}
			$output .= '</div>';
	   
	   wp_reset_postdata();

	   return  $output;
	}


	/* =============================================================================
		 Event Search Shortcodes
	   ========================================================================== */
	function pix_event_search( $atts, $content = null ){
		extract(shortcode_atts(array(
			'main_title' => 'Find what you want',
			'sub_title' => 'event or conference'
		), $atts));

		global $wpdb, $post, $wp, $countries;

		$current_url = esc_url( add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) );

		$event_cpt_ID = $wpdb->get_results("SELECT DISTINCT ID
				FROM $wpdb->posts WHERE post_type = 'pix_event' AND post_status = 'publish'", ARRAY_N);

		//$current_url .= '&loc=name';
		$archive_link = get_post_type_archive_link( 'pix_event' );

		$output = '<section class="eventform newsection">

			
			<div class="event-title">
				<small>'.$main_title.'</small>
				<h2 class="title">'.$sub_title.'</h2>
			</div>

		<div class="eventform-con">
			<form method="get" action="' . home_url( '/' ) . '">

			<input name="post_type" type="hidden" value="pix_event">
				<div class="form-input search-location">
					<input name="keyword" type="text" value="" placeholder="Search Keyword">
					<i class="icon fa fa-search"></i>
				</div>

				<div class="form-input">
					<input name="date" placeholder="mm/dd/yy" class="date_timepicker_start">
					<i class="open icon fa fa-calendar"></i>
				</div>

				<div class="form-input">
					<div class="styled-select">
						<select name="loc">';

						if(!empty($event_cpt_ID)){

							$output .= '<option value="0">Select Venue</option>';

							$i = 0;

							foreach ( $event_cpt_ID as $value ){

								$event_detail = get_post_meta($value[0],'event_details',false);
								if( !empty($event_detail) )
								extract($event_detail[0]);

								if(!empty($venue_name)){
									$output .= '<option value="'.esc_attr($venue_name).'">'.$venue_name.'</option>';
									$i = 0;
								}
								else{
									$i++;
								}								

							}

							if($i != 0){
								$output .= '<option value="0">No Venue Found!!</option>';
							}

						}
						else{
							$output .= '<option value="0">No Events Found!!</option>';
						}
							
							$output .= '</select>
						</div>
					</div>

					
					<button name="event_search" value="1" type="submit" class="btn btn-md btn-pri">fınd event</button>
					
				</form>
			</div>
	
	
</section>';

		return $output;
	}



	/* =============================================================================
		 Event Counter Shortcodes
	   ========================================================================== */
	function pix_event_counter( $atts, $content = null ){
		extract(shortcode_atts(array(
			'depends_on' => 'auto', //manual
			'date' => '', //15/12/2014
			'time' => '', //02:00:00
			'meridian' => '',//PM
			'color'	=> '#c4cbcf'
		), $atts));

		$timer = ''; $val =array();

		$now = time(); $auto_timestamp = '';

		if($depends_on == 'manual'){

			if(!empty($date)){

				$get_date = $get_time = array();

				if(empty($time)){

					$get_date = explode('/', $date); // dd/mm/yyyy

					$timer = mktime(0, 0, 0, $get_date[1], $get_date[0], $get_date[2]); // Hour/Minute/Second/Month/Day/Year
				}
				else{

					$get_date = explode('/', $date); // dd/mm/yyyy

					$get_time = explode(':', $time); // hh:mm:ss

					if($meridian == 'PM'){
						$get_time[0] = $get_time[0] + 12;
					}

					$timer = mktime($get_time[0], $get_time[1], $get_time[2], $get_date[1], $get_date[0], $get_date[2]); // Hour/Minute/Second/Month/Day/Year
				}			
			}
		}
		if($depends_on == 'auto'){
			global $wpdb;

			$event_cpt_ID = $wpdb->get_results("SELECT DISTINCT ID
				FROM $wpdb->posts WHERE post_type = 'pix_event' AND post_status = 'publish'", ARRAY_N);

			foreach ($event_cpt_ID as $key => $value) {

            	//Get Date
            	$event_details = get_post_meta($value[0],'event_details');
				if( !empty($event_details) && !empty($event_details[0])){
					extract($event_details[0]);
				}

				if(!empty($event_date_from)){

					$event_date = date("d/m/Y", strtotime($event_date_from));

						if(empty($event_time)){
							$event_date = date("d/m/Y", strtotime($event_date_from));

							$get_date = array();

							$get_date = explode('/', $event_date); // dd/mm/yyyy

							$timestamp = mktime(0, 0, 0, $get_date[1], $get_date[0], $get_date[2]); // Hour/Minute/Second/Month/Day/Year

							if($timestamp >= $now){
								$val[] = $timestamp;
							}
							
						}
						else{


							$evt_date = date("d/m/Y", strtotime($event_date_from));

							$evt_time = date("H:i:s", strtotime($event_time));

							$get_date = $get_time = array();

							$get_date = explode('/', $evt_date); // dd/mm/yyyy

							$get_time = explode(':', $evt_time); // hh:mm:ss

							$timestamp = mktime($get_time[0], $get_time[1], $get_time[2], $get_date[1], $get_date[0], $get_date[2]); // Hour/Minute/Second/Month/Day/Year

							if($timestamp >= $now){
								$val[] = $timestamp;
							}
						}
				}
				
			}
			if(!empty($val)){
				$timer = min($val);
			}

		}

		$output = '<div class="center-clock"><div class="countdown countdown-container container">
            <div class="clock clearfix" data-eventtimer="'.esc_attr($timer).'" data-color="'.esc_attr($color).'">

                <div class="clock-item clock-days" >
                    <div class="wrap">
                        <div class="inner">
                            <div id="canvas-days" class="clock-canvas"></div>

                            <div class="clock-content">
                                <p class="val">0</p>
                                <p class="typ type-days">'. esc_html__( 'DAYS', 'innwit' ) .'</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clock-item clock-hours ">
                    <div class="wrap">
                        <div class="inner">
                            <div id="canvas-hours" class="clock-canvas"></div>

                            <div class="clock-content">
                                <p class="val">0</p>
                                <p class="typ type-hours ">'. esc_html__( 'HOURS', 'innwit' ) .'</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clock-item clock-minutes ">
                    <div class="wrap">
                        <div class="inner">
                            <div id="canvas-minutes" class="clock-canvas"></div>

                            <div class="clock-content">
                                <p class="val">0</p>
                                <p class="typ type-minutes">'. esc_html__( 'MINUTES', 'innwit' ) .'</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clock-item clock-seconds ">
                    <div class="wrap">
                        <div class="inner">
                            <div id="canvas-seconds" class="clock-canvas"></div>

                            <div class="clock-content">
                                <p class="val">0</p>
                                <p class="typ type-seconds">'. esc_html__( 'SECONDS', 'innwit' ) .'</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div></div> ';

		return $output;
	}



	/* =============================================================================
		 Clients Shortcodes
	   ========================================================================== */

	function pix_clients( $atts, $content = null ){
		extract(shortcode_atts(array(
			'link' => 'yes',
			'custom_links' => '',
			'custom_links_target' => '_self',
			'images' => '',
		), $atts));

		if ( $link == 'yes' ) { $custom_links = explode( ',', $custom_links); }
		$images = explode( ',', $images);
		$i = -1;

		$output =	'<section class="sponsored newsection">';

		$output .= '<div class=" owl-sponsored">';

		foreach ($images as $attach_id ) {
			$i++;

			if ($attach_id > 0) {
				$image_thumb_url = wp_get_attachment_image_src( $attach_id, 'full');
				if(!empty($image_thumb_url)){
					$img = aq_resize($image_thumb_url[0], 120, 40, true, true); 
				}

				if(!$img){
					$img = $image_thumb_url[0];
				}

				$output .= '<div class="sponsored-logo">';

					if( $link == 'yes' && !empty($custom_links[$i])){
						$output .= '<a href="'. esc_url($custom_links[$i]) .'" target="_blank">';
					}

						$output .= '<img src="'. $img .'" alt="">';
					
					if( $link == 'yes' && !empty($custom_links[$i])){
						$output .= '</a>';
					}    		

				$output .= '</div>';

			}
		}
						
		$output .=	'</div>';
		$output .=	'</section>';
		return $output;		
	}

	/**
	 * The Gallery shortcode.
	 *
	 * This implements the functionapix_lity of the Gallery Shortcode for displaying
	 * WordPress images on a post.
	 *
	 * @since 2.5.0
	 *
	 * @param array $attr Attributes of the shortcode.
	 * @return string HTML content to display gallery.
	 */
	function pix_theme_gallery_shortcode($attr) {
		
		wp_enqueue_style('flexslider');
		wp_enqueue_script( 'flexslider-js' );
		wp_enqueue_script( 'gallery-script' );
		
		$post = get_post();

		static $instance = 0;
		$instance++;

		if ( ! empty( $attr['ids'] ) ) {
			// 'ids' is explicitly ordered, unless you specify otherwise.
			if ( empty( $attr['orderby'] ) )
				$attr['orderby'] = 'post__in';
			$attr['include'] = $attr['ids'];
		}

		// Allow plugins/themes to override the default gallery template.
		$output = apply_filters('post_gallery', '', $attr);
		if ( $output != '' )
			return $output;

		// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
		if ( isset( $attr['orderby'] ) ) {
			$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
			if ( !$attr['orderby'] )
				unset( $attr['orderby'] );
		}

		extract(shortcode_atts(array(
			'order'      => 'ASC',
			'orderby'    => 'menu_order ID',
			'id'         => $post->ID,
			'itemtag'    => 'li',
			'columns'    => 3,
			'size'       => 'large',
			'include'    => '',
			'exclude'    => ''
		), $attr));

		$id = intval($id);
		if ( 'RAND' == $order )
			$orderby = 'none';

		if ( !empty($include) ) {
			$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

			$attachments = array();
			foreach ( $_attachments as $key => $val ) {
				$attachments[$val->ID] = $_attachments[$key];
			}
		} elseif ( !empty($exclude) ) {
			$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		} else {
			$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		}

		if ( empty($attachments) )
			return '';

		if ( is_feed() ) {
			$output = "\n";
			foreach ( $attachments as $att_id => $attachment )
				$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
			return $output;
		}

		$itemtag = tag_escape($itemtag);
		$columns = intval($columns);
		$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
		$float = is_rtl() ? 'right' : 'left';

		$selector = "gallery-{$instance}";

		$gallery_style = $gallery_div = '';
			
		$size_class = sanitize_html_class( $size );
		$gallery_div = '<section class="gallery-container"><div id="'. $selector .'" class="flexslider gallery-slider"><ul class="slides">';
		$output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

		$i = 0;
		foreach ( $attachments as $id => $attachment ) {		
			add_filter('wp_get_attachment_image_attributes', 'unset', 10, 2);	
		
			$url = wp_get_attachment_url( $attachment->ID );
			$text = '';
			if ( trim( $text ) == '' )
				$text = $attachment->post_title;
			
			$crop = true; //resize but retain proportions
			$single = true; //return array
				
			if(!empty($url)){
				$url_resize = aq_resize($url, 817, 400, $crop, $single);
				if(!$url_resize){
					$url_resize = $url;
				}
			}
			$link = "$url_resize";

			$output .= "<{$itemtag}>";
			$output .= '<img src="'. $link .'"  alt="">';
			$output .= "</{$itemtag}>";
			if ( $columns > 0 && ++$i % $columns == 0 )
				$output .= '';
		}
		$output .= '</ul></div>';
		$output .= '<div class="carousel flexslider"><ul class="slides">';
		foreach ( $attachments as $id => $attachment ) {
			add_filter('wp_get_attachment_image_attributes', 'unsets', 10, 2);	
		
			$url = wp_get_attachment_url( $attachment->ID );
			if ( trim( $text ) == '' )
				$text = $attachment->post_title;
			
			$crop = true; //resize but retain proportions
			$single = true; //return array
				
			if(!empty($url)){
				$url_resize = aq_resize($url, 140, 100, $crop, $single);
				if(!$url_resize){
					$url_resize = $url;
				}
			}
			$link = "$url_resize";

			$output .= "<{$itemtag}>";
			$output .= '<img src="'. $link .'"  alt="">';
			$output .= "</{$itemtag}>";
			if ( $columns > 0 && ++$i % $columns == 0 )
				$output .= '';
		}

		$output .= '</ul></div><div class="sep"></div></section>';

		return $output;
	}

	function pix_unsets ($attr, $attachment){
		unset($attr['alt']); // Just deleting the alt attr
		return $attr;
	}
}
new Pixel8esShortcodes();

function shortcode_home_link() {
   return '<a href="'.home_url().'">'. get_bloginfo('name') .'</a>';
}
add_shortcode('blog-link', 'shortcode_home_link');

function current_year() {
   return date("Y");
}
add_shortcode('year', 'current_year');