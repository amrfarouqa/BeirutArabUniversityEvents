<?php 
$event_search = isset($_GET['event_search']) ? $_GET['event_search'] : '';

$evt_page_style = 'left_sidebar'; // left_sidebar, right_sidebar, full_width
if($evt_page_style == 'full_width'){
    $border = 'event-border'; // col-md-3
}

else{
    $border = 'event-border'; // col-md-4
}

if(!empty($event_search)){
    $border = '';
}

$sort_style = isset($_GET['sort_style']) ? $_GET['sort_style'] : 'grid';

?>

<?php
    if($sort_style == 'grid'){
        $columns = 'col-md-4';
    }
    else{
        $columns = 'col-md-12';
    }
?>

<?php
    if($event_search == 1){
        $columns = '';
    }
?>


<article id="post-<?php the_ID(); ?>" <?php post_class( 'event-container '. $border .' ' . $columns . ' clearfix' ); ?> role="article">


    <div class="event clearfix bg">

        <?php pix_featured_thumbnail(515, 390); //Width, Height ?>


        <div class="entry-content cf event-content">
           <h2 class="title"><a href="<?php the_permalink() ?>" title = "<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

            <?php

                global $smof_data;

                //Event Meta
                $event_meta = isset($smof_data['event_meta']) ? $smof_data['event_meta'] : 1;

                $event_meta_date = isset($smof_data['event_meta_date']) ? $smof_data['event_meta_date'] : 1;
                $event_meta_venue = isset($smof_data['event_meta_venue']) ? $smof_data['event_meta_venue'] : 1;
                $event_meta_country = isset($smof_data['event_meta_country']) ? $smof_data['event_meta_country'] : 1;

                if($event_meta){

                    pix_event_meta($event_meta_date , $event_meta_venue, $event_meta_country);

                }
            ?>

            <?php 
                //Get Event excerpt limit
                $event_limit = isset($smof_data['event_limit']) ? $smof_data['event_limit'] : 200; 
                $content = strip_shortcodes(ShortenText(get_the_content(),$event_limit));

                if(!empty($content)){
                    echo '<p>'.$content.'</p>';
                }
            ?>  

            <?php
                //Event Button
                $event_btn = isset($smof_data['event_btn']) ? $smof_data['event_btn'] : 1;
                    
                if($event_btn){

                    if(class_exists('Woocommerce')){

                        global $product;                        

                        $woo_product_id = get_post_meta(get_the_ID(), 'woo_product_id', true);

                        $product = get_product($woo_product_id);



                        if(is_object($product) && !empty($product) && ($product->get_price() > 0)){
                            if($product->is_in_stock()){
                                echo '<a href="'.get_permalink().'" class="btn btn-solid btn-blue btn-md">Buy Ticket</a>';                           
                            }else{
                                echo '<a href="'.get_permalink().'" class="btn disabled btn-solid btn-grey btn-md">Sold Out</a>';
                            }

                            
                        }
                        if(is_object($product) && !empty($product) && $product->get_price() <= 0){
                            echo '<a href="'.get_permalink().'" class="btn btn-solid btn-brown btn-md">Free Entry</a>';
                        }
                    }
                    if(empty($product)){
                        echo '<a href="'.get_permalink().'" class="btn btn-solid btn-blue btn-md">View Event</a>';
                    }
                }
            ?>

        </div>

        <?php

            //Event Share, Like and Comment
            $event_share_like_comment = isset($smof_data['event_share_like_comment']) ? $smof_data['event_share_like_comment'] : 1;
            $event_share = isset($smof_data['event_share']) ? $smof_data['event_share'] : 1;
            $event_like = isset($smof_data['event_like']) ? $smof_data['event_like'] : 1;
            $event_comment = isset($smof_data['event_comment']) ? $smof_data['event_comment'] : 1;

            if($event_share_like_comment){
                pix_share_like_comment($event_share,$event_like,$event_comment);
            }

            

        ?>


    </div> 
</article>