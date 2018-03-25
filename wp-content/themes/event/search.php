<?php 
    global $smof_data;
    get_header();
?>
    <?php 
        //Show/Hide blog sub banner
        $search_sub_banner = isset($smof_data['search_sub_banner']) ? $smof_data['search_sub_banner'] : 1;
        if($search_sub_banner){
            subBanner("Search Result: ".get_search_query());
        }       
    ?>

    <section class="events  newsection">
 
        <div class="container">

            <div class="row">

                <?php
                    //Get blog values from theme option
                    $sidebar_position = isset($smof_data['search_sidebar_position']) ? $smof_data['search_sidebar_position'] : 'left_sidebar';

                    //Assign archive page column settings
                    if($sidebar_position == 'full_width'){
                        $columns = 'col-md-12';
                    }
                    else{
                        $columns = 'col-md-9';
                    }

                    $search_select_sidebar = isset($smof_data['search_select_sidebar']) ? $smof_data['search_select_sidebar'] : 0;
                    $search_styles = isset($smof_data['search_styles']) ? $smof_data['search_styles'] : 'style1';

                    if($search_styles == 'style2'){
                        $style = 'style-two';
                    }
                    else{
                        $style = '';
                    }


                    if($sidebar_position == 'left_sidebar'){

                        pix_sidebar($search_select_sidebar, 'blog-sidebar', $search_styles, 0);
                    }
                ?>
                       
                <div id="main" class="blog <?php echo $columns; ?>" role="main">
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                        

                        <article id="post-<?php the_ID(); ?>" <?php post_class( 'event-container clearfix' ); ?> role="article">

                            <div class="event clearfix">

                                <div class="entry-content cf event-content">
                                    <h2 class="title"><a href="<?php the_permalink() ?>" title = "<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

                                    <?php
                                        echo '<ul class="meta clearfix">';
                                            echo '<li class="date"><i class="icon fa fa-calendar"></i>'.get_the_time('d M Y').'</li>';
                                        echo '</ul>';
                                    ?>

                                    <?php 
                                        //Get blog values from theme option
                                        $search_limit = isset($smof_data['search_limit']) ? $smof_data['search_limit'] : 200;
                                        $content = strip_shortcodes(ShortenText(get_the_excerpt(),$search_limit));
                                        if($post->post_type != 'page'){
                                            if(!empty($content)){
                                                echo '<p>'.$content.'</p>';
                                            }
                                        }
                                    ?>
                                
                                </div>

                            </div> 
                        </article>

                    <?php endwhile; ?>

                        <?php bones_page_navi(); ?>

                    <?php else : ?>

                        <?php get_template_part( 'includes/blog', 'error' ); ?>

                    <?php endif; ?>


                </div>

                <?php

                    if($sidebar_position == 'right_sidebar'){

                        pix_sidebar($search_select_sidebar, 'blog-sidebar', $search_styles, 0);
                    }
                ?>

            </div>

        </div>
    </section>

<?php get_footer(); ?>
