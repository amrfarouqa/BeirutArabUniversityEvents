<?php 

    /* Body Custom Fonts */
    $body_font = isset($data['custom_font_body']) && !empty($data['custom_font_body']) ? $data['custom_font_body'] : array('size'  => '14px', 'g_face' => 'Lato', 'face'  => 'Arial, sans-serif', 'style' => 'regular' );
    
    $body_gf = $body_font['g_face']; //Choosen Google webfont
    //$body_fv = $body_font['style'];  //Google web font variant (eg; 300italic)
    //$body_fsize = $body_font['size']; //Font size
    $body_ff = $body_font['face']; // Fallback font

    //$body_fvs = pix_font_variant($body_fv); //Seperated font variation
    
    $custom_styles = isset($data['custom_styles']) ? $data['custom_styles'] : '0';
  ?>

    body{
        font-family: '<?php echo $body_gf; ?>', <?php echo $body_ff; ?>;
    }

<?php 

//Turnoff is custom style switch is 0.  
if($custom_styles == 1):
?>

    <?php if (!empty($data['selection_bg_color']) || !empty($data['selection_text_color'])){?>
    ::-moz-selection {
    <?php echo (!empty ( $data['selection_bg_color'])? 'background:' . $data['selection_bg_color'] : '');?>;
    <?php echo (!empty ( $data['selection_text_color'])? 'color:' . $data['selection_text_color'] : '');?>;
    }
    ::selection {
    <?php echo (!empty ( $data['selection_bg_color'])? 'background:' . $data['selection_bg_color'] : '');?>;
    <?php echo (!empty ( $data['selection_text_color'])? 'color:' . $data['selection_text_color'] : '');?>;
    }
    <?php } ?>


    <?php if (!empty($data['primary_color'])):?>
   a,.main-nav li.active > a,.login-details .pri-color,.login-details  a:hover,.main-nav a:hover,.event .links a:hover,.pri-color,.recent-content a:hover,.event-full-width h3 a:hover,.event-detail h3 a:hover,.meta a:hover,#aside .top-ppost .title a:hover,.speakers .speaker-content .meta a:hover,.search button:hover,#contactform span,.blog .event-content .title:hover a,.single-blog .title a:hover,.event .title a:hover,.itemlist .event-content .meta li a:hover,#aside .widget .widget-list a:hover,#aside .top-ppost .meta:hover,.recent-blog .title a:hover,.recent-content .comment a:hover,#aside .categories li a:hover, #aside .categories a:hover:before,.eventsicon.color,#aside li a:hover,.recentTweets li:before,#aside .recentTweets li a,.footer .widget.recentTweets li:before,.footer a:hover,.top-post .title a:hover,#wp-calendar tbody td a,.main-nav li.current-menu-item > a {
    	color: <?php echo $data['primary_color']; ?>;
    }

    .btn-solid.btn-blue,#aside .testimonials .testimonials-content,.ticket-resgister .btn-pri,.both-btn .find-events a,.bx-wrapper .bx-controls-direction a:hover,.btn-disabled:hover,#aside .categories a:hover .numbers,#aside .tag a:hover,.ui-slider-horizontal .ui-widget-header,.video-icon,.ui-state-default.ui-tabs-active a,.form-submit #submit,.event.bg.add_bg_hover:hover,.btn-solid.btn-grey:hover,.plus:hover, .minus:hover,.comments .comment-reply-link:hover,.eventform-con .event-filter li.active,#wp-calendar thead,.xdsoft_datetimepicker .xdsoft_calendar td.xdsoft_current,.btn-pri,#aside .cart button,.woocommerce-pagination .page-numbers li .page-numbers.current, .woocommerce-pagination .page-numbers li .page-numbers:hover,.summary .single_add_to_cart_button,.woocommerce-message .button,.button, .reset_variations, .form-submit #submit,.tagcloud a:hover,#wp-calendar tbody td#today,.mobile-menu-icon,.owl-theme .owl-controls .owl-buttons div:hover,.wpcf7 .wpcf7-submit{
        background: <?php echo $data['primary_color']; ?>;
    }

    #aside .testimonials-content .arrow-down{
        border-top-color: <?php echo $data['primary_color']; ?>;
    }

    .ui-tabs .ui-state-default.ui-tabs-active,.eventsicon.round-border.color, .eventsicon.square-border.color,.woocommerce-pagination .page-numbers li .page-numbers.current, .woocommerce-pagination .page-numbers li .page-numbers:hover,.mobile-menu-icon{
       border-color: <?php echo $data['primary_color']; ?>;
    }

    input:focus, textarea:focus{
        border: 1px solid <?php echo $data['primary_color']; ?>;
    }

    <?php endif;?>

    <?php if (!empty($data['secondary_color'])):?>
    .eventform .form-input input,.eventform input::-webkit-input-placeholder,.eventform .form-input .icon,.eventform .styled-select select,.eventform .styled-select:before {
        color: <?php echo $data['secondary_color']; ?>;
    }

    .eventform input:-ms-input-placeholder{
        color: <?php echo $data['secondary_color']; ?>;
    }
    .eventform input:-moz-input-placeholder{
        color: <?php echo $data['secondary_color']; ?>;
    }

    .xdsoft_datetimepicker .xdsoft_calendar td.xdsoft_current{
        box-shadow: none;
    }

    aside .header,.both-btn .but-ticket a,.sb-search.sb-search-open .sb-icon-search,.border-cover .btn,#aside .cart-ticket .price,.xdsoft_datetimepicker .xdsoft_calendar td:hover, .xdsoft_datetimepicker .xdsoft_timepicker .xdsoft_time_box >div >div:hover,.woocommerce-result-count,.staff-img:hover .staff-icons,.added_to_cart,.shop_table .coupon .button,.shop_table .button.checkout-button,#aside .widget_shopping_cart .button.checkout,.footer .widget_shopping_cart .button.checkout{
        background: <?php echo $data['secondary_color']; ?>;
    }

    <?php endif;?>



<?php endif; //Turnoff is custom style switch is 0. ?>