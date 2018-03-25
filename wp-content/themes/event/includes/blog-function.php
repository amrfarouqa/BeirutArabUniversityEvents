<?php
    
    //Meta Content

    if(!function_exists('pix_blog_meta')){

        function pix_blog_meta($meta_post_format , $meta_date, $meta_comment, $meta_author){

            $format = get_post_format();

            if($format == ''){
                $format = 'standard';
            }

            if ($format == 'gallery') {
                $post_icon = 'fa-picture-o';
                $format_text ='Gallery';
            }
            elseif ( $format == 'quote') {
                $post_icon = 'fa-quote-left';
                $format_text ='Quote';                                        
            }
            elseif ( $format == 'link') {
                $post_icon = 'fa-link';
                $format_text ='Link';
            }
            elseif ( $format == 'standard') {
                $post_icon = 'fa-pencil';
                $format_text ='Standard';
            }
            elseif ( $format == 'image') {
                $post_icon = ' fa-camera';
                $format_text ='Photo';
            }
            elseif ( $format == 'audio') {
                $post_icon = 'fa-music';
                $format_text ='Audio';
            }
            elseif ( $format == 'video') {
                $post_icon = ' fa-video-camera';
                $format_text ='Video';
            }
            elseif ( $format == 'standard') {
                $post_icon = 'pencil';
                $format_text ='standard';
            } 

            if($meta_post_format || $meta_date || $meta_comment || $meta_author){
                echo '<ul class="meta clearfix">';
                if($meta_post_format){
                    echo '<li><i class="icon fa '.$post_icon.'"></i>'.$format_text.'</li>';
                }
                if($meta_date){
                    echo '<li class="date"><i class="icon fa fa-calendar"></i>'.get_the_time('d M Y').'</li>';
                }
                if($meta_comment){
                    echo '<li><i class="icon fa fa-comment"></i>'.get_comments_number().' Comments</li>';
                }
                if($meta_author){
                    echo '<li><i class="icon fa fa-user"></i>'.get_the_author_link( get_the_author_meta( 'ID' ) ).'</li>';
                }
                echo '</ul>';
            }
        }
    }


    //Sidebar

    if(!function_exists('pix_sidebar')){

        function pix_sidebar($sidebar_name , $default, $style, $filter){

            global $wpdb;

            $event_cpt_ID = $wpdb->get_results("SELECT DISTINCT ID
            FROM $wpdb->posts WHERE post_type = 'pix_event' AND post_status = 'publish'", ARRAY_N);

                
                echo '<div class="col-md-3" role="complementary">';

                    if($filter){

                        echo '<aside  id="aside" class="clearfix no-border-bottom">

                            <div class="header">
                                <small>'.__('Find what you want','innwit').'</small>
                                <h2 class="title">'.__('event or conference','innwit').'</h2>
                                <span class="arrow-down"></span>
                            </div>

                            <div class="widget clearfix">
                                <div class="eventform-con clearfix">

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

                                                    echo '<option value="0">'.__('Select Venue','innwit').'</option>';

                                                    $i = 0;

                                                    foreach ( $event_cpt_ID as $value ){

                                                        $event_detail = get_post_meta($value[0],'event_details',false);
                                                        if( !empty($event_detail) )
                                                            extract($event_detail[0]);

                                                        if(!empty($venue_name)){
                                                            echo '<option value="'.$venue_name.'">'.$venue_name.'</option>';
                                                            $i = 0;
                                                        }
                                                        else{
                                                            $i++;
                                                        }               

                                                    }

                                                    if($i != 0){
                                                        echo '<option value="0">'.__('No Venue Found!!','innwit').'</option>';
                                                    }

                                                }
                                                else{
                                                    echo '<option value="0">'.__('No Events Found!!','innwit').'</option>';
                                                }

                                                echo '</select>
                                            </div>
                                        </div>


                                        <button name="event_search" value="1" type="submit" class="btn btn-md btn-pri">'.__('Fınd Event','innwit').'</button>

                                    </form>
                                </div>
                            </div>


                        </aside>';
                    }

            

                    echo '<div id="aside" class="sidebar '.$style.'">'; 

                        if ( is_active_sidebar( $sidebar_name )){
                            dynamic_sidebar( $sidebar_name );
                        }
                        elseif($sidebar_name == 0){

                            if ( is_active_sidebar( $default )){
                                dynamic_sidebar( $default );
                            }
                            else{
                                echo '<p class="sidebar-info">'.__('Please active sidebar widget or disable it from theme option.','innwit').'</p>';
                            }
                        }

                    echo '</div>';
                echo '</div>';

        }
    }


    //Event Meta Content

    if(!function_exists('pix_event_meta')){

        function pix_event_meta($date , $venue, $country){

            $event_details = get_post_meta(get_the_ID(),'event_details');
            if( !empty($event_details) && !empty($event_details[0])){
                extract($event_details[0]);
            }

            $meta = '';

            if(!empty($event_date_from) || !empty($event_date_to) || !empty($venue_name) || $select_country != 'Select a Country:' || !empty($state)){

                if($date || $venue || $country){


                    $meta = '<ul class="meta clearfix">';

                        if($date){

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
                        }

                        if($venue){
                            if(!empty($venue_name)){

                                $meta .= '<li><i class="icon fa fa-home"></i> '.$venue_name.'</li>';

                            }
                        }

                        if($country){


                            if($select_country != 'Select a Country:' || !empty($state)){

                                $meta .= '<li><i class="icon fa fa-map-marker"></i> ';

                                if(!empty($state)){
                                    $meta .= $state;            
                                }

                                if(!empty($state) && !empty($select_country) && ($select_country != 'Select a Country:')){
                                    $meta .= ' / ';
                                }

                                if(!empty($select_country) && ($select_country != 'Select a Country:')){
                                    $meta .= $select_country;
                                }

                                $meta .= '</li>';
                            }
                        }

                    $meta .= '</ul>';

                    echo $meta; 
                }

            }
        }
    }


    //Event Sort Function

    if(!function_exists('event_sort')){

        function event_sort($event_sort_filter, $sort_position){

            $output = '';

            $sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : '0';
            $no_of_events = isset($_GET['no_of_events']) ? $_GET['no_of_events'] : '10';
            $sort_method = isset($_GET['sort_method']) ? $_GET['sort_method'] : 'asc';
            $sort_style = isset($_GET['sort_style']) ? $_GET['sort_style'] : 'grid';

            global $event_template_id, $wpdb;

            $event_cpt_ID = $wpdb->get_results("SELECT DISTINCT ID
                FROM $wpdb->posts WHERE post_type = 'pix_event' AND post_status = 'publish'", ARRAY_N);

            if($event_sort_filter){
                if($sort_position == 'left_sidebar' || $sort_position == 'right_sidebar'){
                    $output = '<div class="fielder-left eventform-con  clearfix">

                        <form id="sort_form">

                            <input name="page_id" type="hidden" value="'.$event_template_id.'">

                            <div class="form-input">
                                <div class="styled-select">';
                                    $output .= '<select name="sort_by" class="sortSubmit">
                                        <option value="0">'.__('Sort by: Default Sorting','innwit').'</option>
                                        <option value="event_title" '.($sort_by == 'event_title' ? 'selected' : '') .'>'.__('Event Title','innwit').'</option>
                                        <option value="event_date" '.($sort_by == 'event_date' ? 'selected' : '') .'>'.__('Event Date','innwit').'</option>';
                                        if(class_exists('Woocommerce')){
                                            $output .= '<option value="event_price" '.($sort_by == 'event_price' ? 'selected' : '') .'>'.__('Event Price','innwit').'</option>';
                                        }
                                    $output .= '</select>
                                </div>
                            </div>

                            <div class="form-input sort_method_con arrow-up-down">
                                <input name="sort_method" type="hidden" value="'.$sort_method.'">
                                <a class="sort_method btn btn-solid btn-blue btn-md"><i class="fa '.($sort_method == 'asc' ? 'fa-arrow-up' : 'fa-arrow-down') .'"></i></a>
                            </div>

                            <div class="form-input">
                                <div class="styled-select">
                                    <select name="no_of_events" class="sortSubmit">
                                        <option value="10" '.($no_of_events == '10' ? 'selected' : '') .'>'.__('Show: 10 items / page','innwit').'</option>
                                        <option value="15" '.($no_of_events == '15' ? 'selected' : '') .'>'.__('Show: 15 items / page','innwit').'</option>
                                        <option value="20" '.($no_of_events == '20' ? 'selected' : '') .'>'.__('Show: 20 items / page','innwit').'</option>
                                    </select>
                                </div>
                            </div>

                            <noscript>

                                <div class="form-input arrow-up-down" id="event_sort_con">
                                    <button name="event_sort" value="1" type="submit" class="btn btn-md btn-pri">'.__('Sort','innwit').'</button>
                                </div>

                            </noscript>

                            <!-- Event Filter -->
                            <ul class="event-filter" id="sort_style_con">
                                <input name="sort_style" type="hidden" value="'.$sort_style.'">



                                <li class="sort_style filter stylelist '.($sort_style == 'list' ? 'active' : '') .'"><i class=" fa fa-th-list"></i></li>
                                <li class="sort_style filter stylegrid '.($sort_style == 'grid' ? 'active' : '') .'"><i class=" fa fa-th"></i></li>
                            </ul>
                        </form>
                        
                    </div> ';
                }
                else{

                    $output = '<div class="fielder-items eventform-con  clearfix">

                        <form id="sort_form"  method="get" action="' . home_url( '/' ) . '"> 

                          
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

                                        $output .= '<option value="0">'.__('Select Venue','innwit').'</option>';

                                        $i = 0;

                                        foreach ( $event_cpt_ID as $value ){

                                            $event_detail = get_post_meta($value[0],'event_details',false);
                                            if( !empty($event_detail) )
                                            extract($event_detail[0]);

                                            if(!empty($venue_name)){
                                                $output .= '<option value="'.$venue_name.'">'.$venue_name.'</option>';
                                                $i = 0;
                                            }
                                            else{
                                                $i++;
                                            }                               

                                        }

                                        if($i != 0){
                                            $output .= '<option value="0">'.__('No Venue Found!!','innwit').'</option>';
                                        }

                                    }
                                    else{
                                        $output .= '<option value="0">'.__('No Events Found!!','innwit').'</option>';
                                    }
                                        
                                        $output .= '</select>
                                </div>
                            </div>
                            <button name="event_search" value="1" type="submit" class="btn btn-md btn-pri">'.__('Fınd Event','innwit').'</button>

                            <noscript>

                                <div class="form-input arrow-up-down" id="event_sort_con">
                                    <button name="event_sort" value="1" type="submit" class="btn btn-md btn-pri">'.__('Sort','innwit').'</button>
                                </div>

                            </noscript>

                            <!-- Event Filter -->
                            <ul class="event-filter" id="sort_style_con">
                                <input name="sort_style" type="hidden" value="'.$sort_style.'">



                                <li class="sort_style filter stylelist '.($sort_style == 'list' ? 'active' : '') .'"><i class=" fa fa-th-list"></i></li>
                                <li class="sort_style filter stylegrid '.($sort_style == 'grid' ? 'active' : '') .'"><i class=" fa fa-th"></i></li>
                            </ul>
                        </form>
                        
                    </div> ';
                }

                echo $output; 
            }

            

        }
    }


    //Event Detail Sidebar

    if(!function_exists('pix_event_detail_sidebar')){

        function pix_event_detail_sidebar($sidebar_name , $default, $style, $filter, $venue , $counter, $show_organizer, $cart){

            global $wpdb;

            $event_cpt_ID = $wpdb->get_results("SELECT DISTINCT ID
            FROM $wpdb->posts WHERE post_type = 'pix_event' AND post_status = 'publish'", ARRAY_N);

                
                echo '<div class="col-md-3" role="complementary">';

                    //Event Search Filter
                    if($filter){

                        echo '<aside  id="aside" class="clearfix no-border-bottom">

                            <div class="header">
                                <small>'.__('Find what you want','innwit').'</small>
                                <h2 class="title">'.__('event or conference','innwit').'</h2>
                                <span class="arrow-down"></span>
                            </div>

                            <div class="widget clearfix">
                                <div class="eventform-con clearfix">

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

                                                    echo '<option value="0">'.__('Select Venue','innwit').'</option>';

                                                    $i = 0;

                                                    foreach ( $event_cpt_ID as $value ){

                                                        $event_detail = get_post_meta($value[0],'event_details',false);
                                                        if( !empty($event_detail) )
                                                            extract($event_detail[0]);

                                                        if(!empty($venue_name)){
                                                            echo '<option value="'.$venue_name.'">'.$venue_name.'</option>';
                                                            $i = 0;
                                                        }
                                                        else{
                                                            $i++;
                                                        }               

                                                    }

                                                    if($i != 0){
                                                        echo '<option value="0">'.__('No Venue Found!!','innwit').'</option>';
                                                    }

                                                }
                                                else{
                                                    echo '<option value="0">'.__('No Events Found!!','innwit').'</option>';
                                                }

                                                echo '</select>
                                            </div>
                                        </div>


                                        <button name="event_search" value="1" type="submit" class="btn btn-md btn-pri">'.__('Fınd Event','innwit').'</button>

                                    </form>
                                </div>
                            </div>
                        </aside>';
                    }


                    

            
                    //Custom Widget Area
                    echo '<div id="aside" class="sidebar '.$style.'">'; 

                        //Event Meta Values
                        $event_details = get_post_meta(get_the_ID(),'event_details');
                        if( !empty($event_details) && !empty($event_details[0])){
                            extract($event_details[0]);
                        }

                        //Event Date & Event Time
                        $event_date_from = isset($event_date_from) ? $event_date_from : '';
                        $event_time = isset($event_time) ? $event_time : '';

                        $now = time();

                        //YYYY/MM/DD hh:mm:ss

                        $date =  date("m/d/Y", strtotime($event_date_from));

                        $time = date(" H:i:s", strtotime($event_time));

                        $event_timestamp = strtotime($date.' '.$time);

                        if($cart && ($event_timestamp >= $now)){

                            if(class_exists('woocommerce')){    

                                global $product;                        

                                $woo_product_id = get_post_meta(get_the_ID(), 'woo_product_id', true);

                                $product = get_product($woo_product_id);

                                if(is_object($product) && !empty($product)){

                                    echo '<div class="cart widget clearfix">';
                                        
                                        echo '<h3 class="title">'.__('Buy Ticket','innwit').'</h3>';

                                        echo '<form class="cart" method="post" enctype="multipart/form-data">';

                                            do_action( 'woocommerce_before_add_to_cart_button' );

                                            echo '<div class="cart-ticket">';
                                                echo '<div class="cart-count">';
                                                    if ( ! $product->is_sold_individually() ){

                                                        if(isset($product)){
                                                            woocommerce_quantity_input( array(
                                                                'min_value' => apply_filters( 'woocommerce_quantity_input_min', 1, $product ),
                                                                'max_value' => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product )
                                                                ) );
                                                        }
                                                    }

                                                    echo '<input type="hidden" name="add-to-cart" value="'.esc_attr( $product->id ).'" />';
                                                echo '</div>';

                                                //if(!empty($product->get_price_html())){
                                                    echo '<p class="price">'.$product->get_price_html().'</p>';
                                                //}
                                                
                                            echo '</div>';
                                            if($product->is_in_stock()){
                                                echo '<button type="submit" class="single_add_to_cart_button button alt">'. $product->single_add_to_cart_text() .'</button>';                           
                                            }else{
                                                echo '<button class="button disabled">'. __('Sold Out', 'innwit') .'</button>';
                                            }

                                            do_action( 'woocommerce_after_add_to_cart_button' );
                                        echo '</form>';

                                                                                        

                                    echo '</div>';
                                }
                            }
                        }

                        //Check it is more the 99 days

                        $timeleft = $event_timestamp-$now;

                        $daysleft = round((($timeleft/24)/60)/60); 
                        

                        if($counter && !empty($event_date_from) && ($event_timestamp >= $now) && $daysleft <= 99){

                            echo '<script type="text/template" id="upcoming-events-template">

                                <div class="time-count-container">
                                    <div class="time days">
                                      <span class="count curr top"><%= curr.days %></span>
                                      <span class="count next top"><%= next.days %></span>
                                      <span class="count curr bottom"><%= curr.days %></span>
                                      <span class="count next bottom"><%= next.days %></span>
                                      <span class="label">days</span>
                                  </div>
                                  <span class="arrow">:</span>
                              </div>

                              <div class="time-count-container">
                                <div class="time hours">
                                  <span class="count curr top"> <%= curr.hours %></span>
                                  <span class="count next top"><%= next.hours %></span>
                                  <span class="count curr bottom"><%= curr.hours %></span>
                                  <span class="count next bottom"><%= next.hours %></span>
                                  <span class="label">hours</span>
                              </div>
                              <span class="arrow">:</span>
                            </div>
                            <div class="time-count-container">
                                <div class="time minutes">
                                  <span class="count curr top"><%= curr.minutes %></span>
                                  <span class="count next top"><%= next.minutes %></span>
                                  <span class="count curr bottom"><%= curr.minutes %></span>
                                  <span class="count next bottom"><%= next.minutes %></span>
                                  <span class="label">min</span>
                              </div>
                              <span class="arrow">:</span>
                            </div>
                            <div class="time-count-container">
                                <div class="time seconds">
                                  <span class="count curr top"><%= curr.seconds %></span>
                                  <span class="count next top"><%= next.seconds %></span>
                                  <span class="count curr bottom"><%= curr.seconds %></span>
                                  <span class="count next bottom"><%= next.seconds %></span>
                                  <span class="label">sec</span>
                              </div>

                            </div>
                            </script>';

                            echo '<div class="counter">';

                                    echo '<div class="timer" data-countdown="'.$date.' '.$time.'"></div>';
                                
                                    echo '<div class="clearfix">
                                            <div class="main-countdown">
                                                <div class="countdown-container" id="upcoming-events"></div>
                                            </div>';
                                    echo '</div>';

                            echo '</div>';
                        }


                        //Event Venue
                        $latitude = isset($latitude) ? $latitude : '';
                        $longitude = isset($longitude) ? $longitude : '';

                        if($venue && (!empty($latitude) && !empty($longitude))){

                                echo '<div class="venue widget">';
                                    
                                        echo do_shortcode('[googlemap lat="'.$latitude.'" lng="'.$longitude.'"]');

                                echo '</div>';
                        }


                        //Event Organizer
                        $organizer = isset($organizer) ? $organizer : '';
                        $about_organizer = isset($about_organizer) ? $about_organizer : ''; 
                        $organizer_facebook = isset($organizer_facebook) ? $organizer_facebook : '';
                        $organizer_twitter = isset($organizer_twitter) ? $organizer_twitter : '';
                        $organizer_email = isset($organizer_email) ? $organizer_email : '';
                        $organizer_ph_no = isset($organizer_ph_no) ? $organizer_ph_no : '';

                        if($show_organizer && (!empty($organizer) || !empty($about_organizer) || !empty($organizer_facebook) || !empty($organizer_twitter) || !empty($organizer_email) )){


                            echo '<div class="organizer widget">';
                                
                                    echo '<h3 class="title">'.__('Organizer','innwit').'</h3>';

                                        if(!empty($about_organizer)){
                                            echo '<p>'.$about_organizer.'</p>';
                                        }

                                        if(!empty($organizer_email)){
                                            $name = (!empty($organizer) ? $organizer : 'The Organizer');
                                            echo '<a href="mailto:'.$organizer_email.'" class="btn btn-black contact-button"><i class="button-icon fa fa-envelope-o"></i>Contact '.$organizer.'</a>';
                                        }

                                        if(!empty($organizer_facebook) || !empty($organizer_twitter)){

                                            echo '<ul class="social-icon">';

                                                if(!empty($organizer_facebook)){
                                                    echo '<li class="facebook"><a href="'.$organizer_facebook.'"><i class="icon fa fa-facebook"></i><div class="content">'.$organizer_facebook.'</div></a></li>';
                                                }
                                                if(!empty($organizer_twitter)){
                                                    echo '<li class="twitter"><a href="'.$organizer_twitter.'"><i class="icon fa fa-twitter"></i><div class="content">'.$organizer_twitter.'</div></a></li>';
                                                }
                                            echo '</ul>';

                                        }                                         

                            echo '</div>';
                        }

                        if ( is_active_sidebar( $sidebar_name )){
                            dynamic_sidebar( $sidebar_name );
                        }
                        elseif($sidebar_name == 0){

                            if ( is_active_sidebar( $default )){
                                dynamic_sidebar( $default );
                            }
                            else{
                                echo '<p class="sidebar-info">'.__('Please active sidebar widget or disable it from theme option.','innwit').'</p>';
                            }
                        }

                    echo '</div>';


                echo '</div>';

        }
    }



    //Feature Thumbnail

    if(!function_exists('pix_featured_thumbnail')){

        function pix_featured_thumbnail($width, $height){

            $img = '';

            if(has_post_thumbnail()){

                $image_id = get_post_thumbnail_id ();

                $image_thumb_url = wp_get_attachment_image_src( $image_id, 'full');

                $img = aq_resize($image_thumb_url[0], $width , $height, true, true); 

                if($img){
                    echo '<div class="eventsimg"><img src="' . $img . '" alt=""></div>';
                }
                else{
                    echo '<div class="eventsimg"><img src="' .  $image_thumb_url[0] . '" alt=""></div>';                                           
                }
            }

            else {

                $protocol = is_ssl() ? 'https' : 'http';
                echo '<div class="eventsimg"><img src="'.$protocol.'://placehold.it/'.$width.'x'.$height.'" alt=""></div>';
                    
            }                      

        }
    }


    //Share Like Comment

    if(!function_exists('pix_share_like_comment')){

        function pix_share_like_comment($share, $like, $comment){

            $like_count = get_post_meta( get_the_ID(), '_pix_like_me', true );
            $like_class = ( isset($_COOKIE['pix_like_me_'. get_the_ID()])) ? 'liked' : '';
            if($like_count == ''){
                $like_count = 0;
            }

            if($share || $like || $comment){
                $i = 'one';
            }
            if($share && $like || $share && $comment || $comment && $like){
                $i = 'two';
            }
            if($share && $like && $comment){
                $i = 'three';
            }

            if($share || $like || $comment){
                echo '<div class="'.$i.' links clearfix">
                    <ul>';
                    if($share){
                        echo '<li><a class="st_sharethis_large" displayText="ShareThis"><i class="icon fa fa-share"></i> Share</a></li>';
                    }
                    if($like){
                        echo '<li><a href="#void" class="portfolio-icon pix-like-me '.$like_class.'" data-id="'.get_the_ID().'"><i class="icon fa fa-heart"></i><span class="like-count">'.$like_count.'</span></a></li>';
                    }
                    if($comment){
                        echo '<li><i class="icon fa fa-comment"></i>'.get_comments_number().'</li>'; 
                    }
                        
                echo '</ul> 
                </div>';                      
            }
        }
    }
?>