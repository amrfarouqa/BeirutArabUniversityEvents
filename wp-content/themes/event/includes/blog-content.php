<?php
    global $smof_data;

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'event-container clearfix' ); ?> role="article">

    <div class="event clearfix bg">

        <?php pix_featured_thumbnail(515, 390); //Width, Height ?>

        <div class="entry-content cf event-content">
           <h2 class="title"><a href="<?php the_permalink() ?>" title = "<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

            <?php 
                //Blog Page Meta
                $b_meta = isset($smof_data['b_meta']) ? $smof_data['b_meta'] : 1;

                $b_meta_post_format = isset($smof_data['b_meta_post_format']) ? $smof_data['b_meta_post_format'] : 1;
                $b_meta_date = isset($smof_data['b_meta_date']) ? $smof_data['b_meta_date'] : 1;
                $b_meta_comment = isset($smof_data['b_meta_comment']) ? $smof_data['b_meta_comment'] : 1;
                $b_meta_author = isset($smof_data['b_meta_author']) ? $smof_data['b_meta_author'] : 1;
                
                if($b_meta){

                    pix_blog_meta($b_meta_post_format , $b_meta_date, $b_meta_comment, $b_meta_author);

                }
                
            ?>

            <?php
                //Get blog values from theme option
                $b_limit = isset($smof_data['b_limit']) ? $smof_data['b_limit'] : 200; 
                $content = strip_shortcodes(ShortenText(get_the_excerpt(),$b_limit));

                if(!empty($content)){
                    echo '<p>'.$content.'</p>';
                }
            ?> 

            <?php
                //Blog Read More Button
                $b_button = isset($smof_data['b_button']) ? $smof_data['b_button'] : 1;
                $b_button_text = isset($smof_data['b_button_text']) ? $smof_data['b_button_text'] : 'Read More';
                    
                if($b_button){
                    echo '<a href="'.get_permalink().'" class="btn btn-solid btn-grey btn-md">'.$b_button_text.'</a>';
                }
            ?>
        </div>


    </div> 
</article>