<?php
$output = $el_class = $bg_image = $bg_color = $bg_image_repeat = $font_color = $padding = $margin_bottom = $css = '';
extract(shortcode_atts(array(
    'el_class'        => '',
    'anchor_id'       => '',
    'bg_image'        => '',
    'bg_color'        => '',
    'bg_image_repeat' => '',
    'color_style'     => 'light',
    'video'           => '',
    'video_image'     => '',
    'video_webm'      => '',
    'video_mp4'       => '',
    'video_ogg'       => '',
    'font_color'      => '',
    'padding'         => '',
    'margin_bottom'   => '',
    'parallax'        => '',
    'parallax_ratio'  => '0.5',
    'parallax_offset' => '',
    'type'            => 'normal',
    'overlay'         => 'pattern',
    'pattern_style'   => 'style1',
    'pattern_opacity'   => 'style1',
    'overlay_color' => 'rgba(0,0,0,0.7)',
    'theme_primary' => 'custom',
    'theme_primary_alpha' => '1',
    'css' => ''
), $atts));

global $primary_color, $secondary_color;
$custom_class = $parallax_class = $parallax_div  = '';

wp_enqueue_style( 'js_composer_front' );
wp_enqueue_script( 'wpb_composer_front_js' );
wp_enqueue_style('js_composer_custom_css');

if($type == 'full-width' && $parallax == 'yes'){
    $parallax_class = ' parallax';
    $parallax_div = ' data-stellar-background-ratio="'. $parallax_ratio .'"';
    $parallax_div .= (isset($parallax_offset) && !empty($parallax_offset)) ? ' data-stellar-vertical-offset="'. $parallax_offset .'"' : '';
}
if(empty($video_image)){
    $video_image = "";
}
if(!empty($anchor_id)){
    $anchor_id = preg_replace('/\s+/', '', $anchor_id);
    $anchor_id = ' id="'. $anchor_id .'"';
}

$el_class = $this->getExtraClass($el_class);

$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_row pix-row '.get_row_css_class().$el_class.vc_shortcode_custom_css_class($css, ' '), $this->settings['base']);


// Choose default theme color as primary
if($theme_primary == 'primary' && $theme_primary_alpha == '1'){
    $bg_color = $primary_color .' !important';
}elseif($theme_primary == 'primary' && $theme_primary_alpha < 1){
    $bg_color = 'rgba(' . pix_hex2rgb($primary_color) .', '. $theme_primary_alpha .')';
}

// Choose default theme color as primary
if($theme_primary == 'secondary' && $theme_primary_alpha == '1'){
    $bg_color = $secondary_color .' !important';
}elseif($theme_primary == 'secondary' && $theme_primary_alpha < 1){
    $bg_color = 'rgba(' . pix_hex2rgb($secondary_color) .', '. $theme_primary_alpha .')';
}

$style = $this->buildStyle($bg_image, $bg_color, $bg_image_repeat, $font_color, $padding, $margin_bottom);

$output .= '<div'. $anchor_id .' class="'.$css_class.' '. $color_style .' '. esc_attr($type) .''. $parallax_class .'"'. $parallax_div .''.$style.'>';
$output .= '<div class="bg-pos-rel">';
$output .= '<div class="pix-con clearfix">';
if($type == 'full-width'){
    $output .= '<div class="pix-container">';
}elseif($type == 'normal'){
    $output .= "\n\t\t".'<div class="pix-container">';
}
$output .= wpb_js_remove_wpautop($content);
if($type == 'full-width'){
    $output .= '</div>';
}elseif($type == 'normal'){
    $output .= "\n\t".'</div>';
}
$output .= '</div>';
$output .= '</div>';

if($type == 'full-width'){

    //Addind overlay
    if($overlay != 'none'){
        if($overlay == 'pattern'){
            $output.= '<div class="pattern '. $pattern_style .'" style="opacity:'.$pattern_opacity.'"></div>';
        }elseif($overlay == 'color'){
            $output.= '<div class="pattern" style="background:'.$overlay_color.'"></div>';
        }
    }

    //Video Bg
    if($video == 'video_bg'){
        wp_enqueue_script( 'wp-mediaelement' );
        $vid_image = wp_get_attachment_url($video_image);
        $output .= '<div class="mobile-vid-image" style="background-image: url('.$vid_image.')"></div><div class="video-wrap"><video width="1920" height="800" poster="'. $vid_image .'" muted preload="auto" loop="true" autoplay="true">';
        if(!empty($video_mp4)) {
            $output .= '<source type="video/mp4" src="'. $video_mp4 .'" />';
        }
        if(!empty($video_webm)) {
            $output .= '<source type="video/webm" src="'. $video_webm .'" />';
        }
        if(!empty($video_ogg)) {
            $output .= '<source type="video/ogg" src="'. $video_ogg .'" />';
        }
        $output .= '<object width="1920" height="800" type="application/x-shockwave-flash" data="'.get_template_directory_uri().'/js/flashmediaelement.swf">        
            <param name="movie" value="'.get_template_directory_uri().'/js/flashmediaelement.swf" /> 
            <param name="flashvars" value="controls=false&file='.$video_mp4.'" /> 
            <img src="'. $vid_image .'" width="1920" height="800" alt="" />
        </object>   
    </video></div>';
    }
}
$output .= '</div>'.$this->endBlockComment('row');

echo $output;