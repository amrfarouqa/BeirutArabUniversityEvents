<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

<?php    
    global $smof_data;
    
    $favicon = ''; 
    $favicon = isset($smof_data['fav_icon'])? $smof_data['fav_icon'] : '';
    if (empty($favicon)){
        $favicon = get_template_directory_uri('template_url').'/favicon.png'; 
    }



    $apple_touch_icon = '';
    $apple_touch_icon = isset($smof_data['apple_touch_icon']) ? $smof_data['apple_touch_icon'] : '';

    if (empty($apple_touch_icon)) {
        $apple_touch_icon = get_template_directory_uri('template_url').'/apple-touch-icon.png'; 
    }
?>

	<head>
		<meta charset="utf-8">

		<?php // Google Chrome Frame for IE ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title><?php wp_title(''); ?></title>

		<?php // mobile meta (hooray!) ?>
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

		<?php // icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) ?>
		<link rel="apple-touch-icon" href="<?php echo $apple_touch_icon ?>">

        <link rel="shortcut icon" href="<?php echo $favicon ?>">
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<![endif]-->
		<?php // or, set /favicon.ico for IE10 win ?>
		<meta name="msapplication-TileColor" content="#f01d4f">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<?php // wordpress head functions ?>
		<?php wp_head(); ?>
		<?php // end of wordpress head ?>

		<?php // drop Google Analytics Here ?>
		<?php // end analytics ?>

	</head>

	<body <?php body_class(); ?>>

    <?php

        $custom_logo = isset($smof_data['custom_logo']) ? $smof_data['custom_logo'] : get_template_directory_uri().'/library/img/logo.png';
        if(empty($custom_logo)){
            $custom_logo = get_template_directory_uri().'/library/img/logo.png';
        }
        $logo2x = isset($smof_data['retina_logo']) ? $smof_data['retina_logo'] : '';
        $top_header = isset($smof_data['top_header']) ? $smof_data['top_header'] : 1;
        $top_email = isset($smof_data['top_email']) ? $smof_data['top_email'] : '';
        $top_tel = isset($smof_data['top_tel']) ? $smof_data['top_tel'] : '';
        $top_facebook = isset($smof_data['top_facebook']) ? $smof_data['top_facebook'] : '';
        $top_twitter = isset($smof_data['top_twitter']) ? $smof_data['top_twitter'] : '';
        $top_gplus = isset($smof_data['top_gplus']) ? $smof_data['top_gplus'] : '';
        $top_linkedin = isset($smof_data['top_linkedin']) ? $smof_data['top_linkedin'] : '';
        $top_dribbble = isset($smof_data['top_dribbble']) ? $smof_data['top_dribbble'] : '';
        $top_flickr = isset($smof_data['top_flickr']) ? $smof_data['top_flickr'] : '';
        $top_pinterest = isset($smof_data['top_pinterest']) ? $smof_data['top_pinterest'] : '';
        $top_tumblr = isset($smof_data['top_tumblr']) ? $smof_data['top_tumblr'] : '';
        $top_rss = isset($smof_data['top_rss']) ? $smof_data['top_rss'] : '';
        $top_header_cart = isset($smof_data['top_header_cart']) ? $smof_data['top_header_cart'] : 1;
        $header_search = isset($smof_data['header_search']) ? $smof_data['header_search'] : 1;
    ?>

         <header class="header-container">

            <?php

                if($top_header){
                    echo '<div class="header-top">
                        <div class="container">
                            <div class="row">';
                                echo '<div class="col-md-6">';
                                    echo '<ul class="contact-details clearfix">';
                                        if(!empty($top_email)) {
                                            echo '<li><i class="icon fa fa-paper-plane-o"></i><a href="mailto: '.$top_email.'">'.$top_email.'</a></li>';
                                        }
                                        if(!empty($top_tel)){
                                            echo '<li><i class="icon fa fa-phone"></i>'.$top_tel.'</li>';
                                        }

                                        // echo '<li data-type="login" class="signupBtn"><i class="icon fa fa-phone"></i><a href="#">Log In</a></li>';

                                        // echo '<li data-type="register" class="signupBtn"><i class="icon fa fa-phone"></i><a href="#">Register</a></li>';

                                    echo '</ul>';
                                    
                                echo '</div>';

                                echo '<div class="col-md-6">';
                                    echo '<div class="cart-social">';
                                        if(!empty($top_facebook) || !empty($top_twitter) || !empty($top_gplus) || !empty($top_linkedin) || !empty($top_dribbble) || !empty($top_flickr) || !empty($top_pinterest) || !empty($top_tumblr) || !empty($top_rss)){

                                            echo '<div class="social-icon">';
                                                if(!empty($top_facebook)){
                                                    echo '<a href="'.$top_facebook.'" class="facebook fa fa-facebook"></a>';
                                                }
                                                if(!empty($top_twitter)){
                                                    echo '<a href="'.$top_twitter.'" class="twitter fa fa-twitter"></a>';
                                                }
                                                if(!empty($top_gplus)){
                                                    echo '<a href="'.$top_gplus.'" class="googleplus fa fa-google-plus"></a>';
                                                }
                                                if(!empty($top_dribbble)){
                                                    echo '<a href="'.$top_dribbble.'" class="dribbble fa fa-dribbble"> </a>';
                                                }
                                                if(!empty($top_linkedin)){
                                                    echo '<a href="'.$top_linkedin.'" class="linkedin fa fa-linkedin"></a>';
                                                }
                                                if(!empty($top_flickr)){
                                                    echo '<a href="'.$top_flickr.'" class="flickr fa fa-flickr"></a>';
                                                }
                                                if(!empty($top_pinterest)){
                                                    echo '<a href="'.$top_pinterest.'" class="pinterest fa fa-pinterest"></a>';
                                                }
                                                if(!empty($top_tumblr)){
                                                    echo '<a href="'.$top_tumblr.'" class="tumblr fa fa-tumblr"></a>';
                                                }
                                                if(!empty($top_rss)){
                                                    echo '<a href="'.$top_rss.'" class="rss fa fa-rss"></a>';
                                                }
                                            echo '</div>';
                                        }

                                        if($top_header_cart){
                                            pix_woo_cart();  
                                        }
                                    echo '</div>';

                                echo '</div>';

                    echo '</div> 
                       </div>     
                    </div>';
                }
                
            ?>
        
           <div class="main-header affix clearfix">
                <div class="container">
                     <div class="inner-header">
                     <a href="<?php echo home_url(); ?>" id="logo"><img src="<?php echo $custom_logo ?>" data-at2x="<?php echo $logo2x; ?>" alt="<?php bloginfo('name'); ?>"></a>

                        <?php if($header_search){ ?>
                            <div id="sb-search" class="sb-search">
                                <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                                    <input class="sb-search-input" placeholder="Search" type="text" value="<?php echo get_search_query(); ?>" name="s" id="s">
                                    <input class="sb-search-submit" type="submit" id="searchsubmit" value="">
                                    <span class="sb-icon-search"></span>
                                </form>
                            </div>
                        <?php } ?>
                         
                            <div class="mobile-menu-icon">
                                <i class="fa fa-bars"></i>
                            </div> 
                     
                          <nav  class="main-nav mobile-menu" role="navigation">
                             <?php eventon_main_nav(); ?>
                         </nav>
                         <!-- NAV -->
                    </div>
                </div> 
          </div>
     </header>
      <!-- HEADER -->

<div id="overlayBg" class="" ></div>

<div class="popupform not-visible">

    <div id="signup-form">

        <div class="register-form not-visible">

            <h2 class="title"><?php echo __('Register Form', 'innwit'); ?></h2>
            <p><?php echo __('Please fill up the form below:', 'innwit'); ?></p>

            <form method="post" autocomplete="off">
                <input type="text" value="" name="first_name" id="first_name" class="textfield" placeholder="<?php echo __('First Name', 'innwit'); ?>">
                <input type="text" value="" name="last_name" id="last_name" class="textfield" placeholder="<?php echo __('Last Name', 'innwit'); ?>">
                <input type="text" value="" name="email" id="email" class="textfield" placeholder="<?php echo __('Email', 'innwit'); ?>">
                <input type="text" value="" name="username" id="username" class="textfield" placeholder="<?php echo __('Username', 'innwit'); ?>">
                <input type="password" value="" name="pwd1" id="pwd1" class="textfield" placeholder="<?php echo __('Password', 'innwit'); ?>">
                <input type="password" value="" name="pwd2" id="pwd2" class="textfield" placeholder="<?php echo __('Repeat Password', 'innwit'); ?>">
                <button type="submit" name="btnregister" class="button" ><?php echo __('Register', 'innwit'); ?></button>
                <input type="hidden" name="task" value="register">
            </form>

        </div>

        <div class="login-form not-visible">

            <h2 class="title"><?php echo __('Log In Form', 'innwit'); ?></h2>
            <p><?php echo __('Please fill up the form below:', 'innwit'); ?></p>

            <form method="post" autocomplete="off">
                <input type="text" name="log" id="log" value="" class="textfield" placeholder="<?php echo __('Username', 'innwit'); ?>">
                <input type="password" name="pwd" id="pwd" value="" class="textfield" placeholder="<?php echo __('Password', 'innwit'); ?>">
                <button type="submit" name="btnregister" class="button" ><?php echo __('Log In', 'innwit'); ?></button>
                <input type="hidden" name="task" value="login">
            </form>
            
            <div data-type="register" class="signupBtn"><p class="register-text"><?php echo __('You don\'t have an account? Please', 'innwit'); ?> <a href="#"> <?php echo __('Register', 'innwit'); ?></a> <?php echo __('here', 'innwit'); ?></p></div>

            <p class="register-text"><?php echo __('I have an account? But', 'innwit'); ?> <a href="<?php echo wp_lostpassword_url(); ?>" title="Lost Password"><?php echo __('Lost Password', 'innwit'); ?></a></p>

            

        </div>

    </div>

</div>  