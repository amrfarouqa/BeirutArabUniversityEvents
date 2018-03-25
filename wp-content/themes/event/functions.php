<?php

/*
Author: Eddie Machado
URL: htp://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, ect.
*/

add_action("after_switch_theme", "electrifyactivation", 10 ,  2); 

function electrifyactivation($oldname, $oldtheme=false) {

       //Add Ticket Product Type to WooCommerce Product Type
       if (class_exists('Woocommerce') && ( ! get_term_by( 'slug', sanitize_title( 'tickets' ), 'product_type' ) )) {
               // Product type
               wp_insert_term( 'tickets', 'product_type', array('slug' => 'tickets') );
       }

}

// LOAD BONES CORE (if you remove this, the theme will break)
require_once('framework/theme-init.php');

require_once( 'library/bones.php' );

require_once( 'includes/blog-function.php' );

// CUSTOMIZE THE WORDPRESS ADMIN (off by default)
// require_once( 'library/admin.php' );

/*********************
LAUNCH BONES
Let's get everything up and running.
*********************/

function bones_ahoy() {

  // let's get language support going, if you need it
  load_theme_textdomain( 'innwit', get_template_directory() . '/library/translation' );

  // launching operation cleanup
  // A better title
  add_filter( 'wp_title', 'rw_title', 10, 3 );
  // remove WP version from RSS
  add_filter( 'the_generator', 'bones_rss_version' );
  // clean up gallery output in wp
  add_filter( 'gallery_style', 'bones_gallery_style' );

  // enqueue base scripts and styles
  add_action( 'wp_enqueue_scripts', 'bones_scripts_and_styles', 999 );
  // ie conditional wrapper

  // launching this stuff after theme setup
  bones_theme_support();

  // adding sidebars to Wordpress (these are created in functions.php)
  add_action( 'widgets_init', 'bones_register_sidebars' );
  
  // cleaning up excerpt
  add_filter( 'excerpt_more', 'bones_excerpt_more' );

} /* end bones ahoy */

// let's get this party started
add_action( 'after_setup_theme', 'bones_ahoy' );


/************* OEMBED SIZE OPTIONS *************/

if ( ! isset( $content_width ) ) {
  $content_width = 640;
}

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'bones-thumb-600', 600, 150, true );
add_image_size( 'bones-thumb-300', 300, 100, true );


/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 300 sized image,
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 100 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

add_filter( 'image_size_names_choose', 'bones_custom_image_sizes' );

function bones_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'bones-thumb-600' => __('600px by 150px','innwit'),
        'bones-thumb-300' => __('300px by 100px','innwit'),
    ) );
}

/*
The function above adds the ability to use the dropdown menu to select
the new images sizes you have just created from within the media manager
when you add media to your content blocks. If you add more image sizes,
duplicate one of the lines in the array and name it according to your
new image size.
*/

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {

  register_sidebar(array(
    'id' => 'event-sidebar',
    'name' => __( 'Event Sidebar', 'innwit' ),
    'description' => __( 'This is default sidebar for event page', 'innwit' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="title">',
    'after_title' => '</h3>',
  ));

  register_sidebar(array(
    'id' => 'blog-sidebar',
    'name' => __( 'Blog Sidebar', 'innwit' ),
    'description' => __( 'This is default sidebar for blog page', 'innwit' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="title">',
    'after_title' => '</h3>',
  ));


  register_sidebar(array(
    'id' => 'footer-widgets',
    'name' => __('Footer Widgets', 'innwit'),
    'description' => __('Add Widgets to display in footer.', 'innwit'),
    'before_widget' => '<div id="%1$s" class="widget %2$s clearfix ">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="title">',
    'after_title' => '<span class="border"></span></h2>',
    ));

  /*
  to add more sidebars or widgetized areas, just copy
  and edit the above sidebar code. In order to call
  your new sidebar just use the following code:

  Just change the name to whatever your new
  sidebar's id is, for example:

  register_sidebar(array(
    'id' => 'sidebar2',
    'name' => __( 'Sidebar 2', 'innwit' ),
    'description' => __( 'The second (secondary) sidebar.', 'innwit' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));

  To call the sidebar in your template, you can just copy
  the sidebar.php file and rename it to your sidebar's name.
  So using the above example, it would be:
  sidebar-sidebar2.php

  */
} // don't remove this bracket!

register_nav_menus(
    array(
      'main-nav' => __( 'The Main Menu', 'innwit' ),   // main nav in header
      'footer-nav' => __( 'Footer Navigation', 'innwit' ),   // main nav in header
    )
  );

function eventon_main_nav(){
     wp_nav_menu(array(
        'container' => false,                           // remove nav container
        'container_class' => 'menu cf',                 // class of container (should you choose to use it)
        'menu' => __( 'The Main Menu', 'innwit' ),  // nav name
        'menu_class' => 'nav top-nav cf',               // adding custom nav class
        'theme_location' => 'main-nav',                 // where it's located in the theme
        'before' => '',                                 // before the menu
        'after' => '',                                  // after the menu
        'link_before' => '',                            // before each link
        'link_after' => '',                             // after each link
        'depth' => 0,                                   // limit the depth of the nav
        'fallback_cb' => 'main_nav_cb',                 // fallback function (if there is one)
        'walker' => new Pix_Menu_Extend_Walker()
    ));   
}

function eventon_footer_nav(){
     wp_nav_menu(array(
        'container' => false,                           // remove nav container
        'container_class' => 'menu',                 // class of container (should you choose to use it)
        'menu' => __( 'Footer Navigation', 'innwit' ),  // nav name
        'menu_class' => 'nav',               // adding custom nav class
        'theme_location' => 'footer-nav',                 // where it's located in the theme
        'before' => '',                                 // before the menu
        'after' => '',                                  // after the menu
        'link_before' => '',                            // before each link
        'link_after' => '',                             // after each link
        'depth' => 0,                                   // limit the depth of the nav
        'fallback_cb' => 'main_nav_cb'                  // fallback function (if there is one)
    ));   
}



function main_nav_cb() {
  echo '<p><a href="'.home_url().'/wp-admin/nav-menus.php">'.__('Click Here to create/add Menu from Admin Page','pixel8es').'</a></p>';
}



/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
  <div id="comment-<?php comment_ID(); ?>" <?php comment_class('cf comment'); ?>>
    <article  class="cf clearfix">
      <header class="comment-author vcard ">
        <?php
        /*
          this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
          echo get_avatar($comment,$size='32',$default='<path_to_url>' );
        */
        ?>
        <?php // custom gravatar call ?>
        <?php
          // create variable
          $bgauthemail = get_comment_author_email();
        ?>
        <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=40" class="load-gravatar avatar avatar-48 photo" height="70" width="70" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
        <?php // end custom gravatar call ?>


      </header>

     
      <section class="comment-content cf">
        <?php if ($comment->comment_approved == '0') : ?>
            <div class="alert alert-info">
              <p><?php _e( 'Your comment is awaiting moderation.', 'innwit' ) ?></p>
            </div>
        <?php endif; ?>
        <?php printf(__( '<p class="author">%1$s <span class="date">%2$s</sapn></p>', 'innwit' ), get_comment_author_link(),get_comment_time(__( ' g:i a - F j, Y', 'innwit' )) ) ?>
       
        <?php comment_text() ?>
         <?php printf(__('%1$s' , 'innwit' ), edit_comment_link(__( '(Edit)', 'innwit' ),'  ','')  ) ?>

         <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
      </section>
     
    </article>
  <?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!


/************* SEARCH FORM LAYOUT *****************/

// Search Form
function pixel8es_wpsearch($form) {
  global $smof_data;
  $search_text = isset($smof_data['search_text'])? $smof_data['search_text'] : 'Search';

  $form = '<form role="search" method="get" class="searchform" action="' . home_url( '/' ) . '" >
  <input type="text" value="' . get_search_query() . '" name="s" class="s" placeholder="' . esc_attr__($search_text) . '" />
  <button type="submit" class="searchsubmit  fa fa-search">'.esc_attr__( '' ).'</button>
  </form>';
  return $form;
} // don't remove this bracket!




/*
This is a modification of a function found in the
twentythirteen theme where we can declare some
external fonts. If you're using Google Fonts, you
can replace these fonts, change it in your scss files
and be up and running in seconds.
*/
function bones_fonts() {
  wp_register_style('googleFonts', 'http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic');
  wp_enqueue_style( 'googleFonts');
}

add_action('wp_print_styles', 'bones_fonts');


/*-----------------------------------------------------------------------------------*/
/* WooCommerce Form
/*-----------------------------------------------------------------------------------*/
if (class_exists('Woocommerce')) {
    add_filter( 'get_product_search_form', 'pixel8es_productsearch' );
     function pixel8es_productsearch() {
      $form = '<form role="search" method="get" id="searchform" action="' . esc_url( home_url( '/'  ) ) . '">
      <div>
        <label class="screen-reader-text" for="s">' . __( 'Search for:', 'woocommerce' ) . '</label>
        <input type="text" value="' . get_search_query() . '" name="s" id="s" class="s" placeholder="' . __( 'Search for products', 'woocommerce' ) . '" />
        <button type="submit" class="searchsubmit  fa fa-search">'.esc_attr__( '' ).'</button>
        <input type="hidden" name="post_type" value="product" />
      </div>
    </form>';
      
      return $form;
    }
    
    add_filter( 'loop_shop_per_page', 'pix_products_per_page');
    function pix_products_per_page() {
      global $smof_data;
      $shop_count = isset($smof_data['shop_count'])? $smof_data['shop_count'] : '';

      return $shop_count;
    }
    
}

/*
* goes in theme functions.php or a custom plugin. Replace the image filename/path with your own :)
*
**/
add_action( 'init', 'custom_fix_thumbnail' );
 
function custom_fix_thumbnail() {
  add_filter('woocommerce_placeholder_img_src', 'custom_woocommerce_placeholder_img_src');
   
  function custom_woocommerce_placeholder_img_src( $src ) {
    $protocol = is_ssl() ? 'https' : 'http';
    $src = $protocol.'://placehold.it/540x600';
     
    return $src;
  }
}

//Register and Log in Form
$err = '';
$success = '';

add_action('template_redirect', 'signup_form');
function signup_form(){

    global $wpdb, $PasswordHash, $current_user, $user_ID, $err, $success;

    if( isset($_POST['task']) && $_POST['task'] == 'login' ){
        $username = esc_sql($_POST['log']);
        $password = esc_sql($_POST['pwd']);

        if( $username == "" || $password == "" ) {
            $err = 'Please don\'t leave the required field.';
        }
        else {
            $user_data = array();
            $user_data['user_login'] = $username;
            $user_data['user_password'] = $password;
            $user_data['remember'] = true; 


            $user = wp_signon( $user_data, false );

            if ( is_wp_error($user) ) {
                $err = strip_tags($user->get_error_message());
            } else {
                wp_set_current_user( $user->ID, $user->user_login );
                wp_set_auth_cookie( $user->ID );
                do_action( 'wp_login', $user->user_login );
            }
        }

    }

    if(isset($_POST['task']) && $_POST['task'] == 'register' ) {
        $pwd1 = esc_sql(trim($_POST['pwd1']));
        $pwd2 = esc_sql(trim($_POST['pwd2']));
        $first_name = esc_sql(trim($_POST['first_name']));
        $last_name = esc_sql(trim($_POST['last_name']));
        $email = esc_sql(trim($_POST['email']));
        $username = esc_sql(trim($_POST['username']));

        if( $email == "" || $pwd1 == "" || $pwd2 == "" || $username == "" || $first_name == "" || $last_name == "") {
            $err = 'Please don\'t leave the required fields.';
        } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $err = 'Invalid email address.';
        } else if(email_exists($email) ) {
            $err = 'Email already exist.';
        } 
        else if($pwd1 <> $pwd2 ){
            $err = 'Password do not match.';        
        }


        else {

            $user_id = wp_insert_user( array ('first_name' => apply_filters('pre_user_first_name', $first_name), 'last_name' => apply_filters('pre_user_last_name', $last_name), 'user_pass' => apply_filters('pre_user_user_pass', $pwd1), 'user_login' => apply_filters('pre_user_user_login', $username), 'user_email' => apply_filters('pre_user_user_email', $email), 'role' => 'contributor' ) );
            if( is_wp_error($user_id) ) {
                $err = 'Error on user creation.';
            } else {
                do_action('user_register', $user_id);

                $success = 'You\'re successfully register';
            }

        }

    }
}

/* DON'T DELETE THIS CLOSING TAG */ ?>
