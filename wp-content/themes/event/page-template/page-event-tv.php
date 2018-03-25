<?php 
/*
	Template Name: Event Tv
*/

	global $smof_data;

	get_header(); 
?>

	<?php 
    	//Show/Hide event tv sub banner
    	$tv_sub_banner = isset($smof_data['tv_sub_banner']) ? $smof_data['tv_sub_banner'] : 1;
    	if($tv_sub_banner){
    		subBanner(get_the_title());
    	}    	
    ?>

	<section class="events  newsection">
 
		<div class="container">

			<div class="row">

				
				<div class="col-md-12">
				
					<?php

						$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

						$no_of_event_videos = isset($smof_data['tv_no_videos']) ? $smof_data['tv_no_videos'] : 8;

						$args = array(
								'post_type' => 'pix_eventtv',
								'orderby' => 'title',
								'order' => 'asc',
								'paged' => $paged,
								'posts_per_page' => $no_of_event_videos
								);

						query_posts( $args );

					?>	

					<div class="grid-list event-container clearfix">
           				<div class="row">  
		           			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		           				<article id="post-<?php the_ID(); ?>" <?php post_class( 'event-container event-border col-md-3 clearfix' ); ?> role="article">


    								<div class="event clearfix bg">

    									<?php pix_featured_thumbnail(515, 390); //Width, Height ?>

		           						<div class="entry-content cf event-content">
   											<h2 class="title"><a href="<?php the_permalink() ?>" title = "<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

   											<?php

		                						//Event TV Meta 

	   											$tv_meta = isset($smof_data['tv_meta']) ? $smof_data['tv_meta'] : 1;
	   											$tv_meta_date = isset($smof_data['tv_meta_date']) ? $smof_data['tv_meta_date'] : 1;
	   											
	   											$tv_meta_author = isset($smof_data['tv_meta_author']) ? $smof_data['tv_meta_author'] : 1;

	   											if($tv_meta){

	   												pix_blog_meta(NULL , $tv_meta_date, NULL, $tv_meta_author);

	   											}

   											?>

   											<span class="sep"></span>

    										<?php 

											    //Excerpt Limit
	    										$tv_limit = isset($smof_data['tv_limit']) ? $smof_data['tv_limit'] : 200;

	    										$content = strip_shortcodes(ShortenText(get_the_excerpt(),$tv_limit));

	    										if(!empty($content)){
	    											echo '<p>'.$content.'</p>';
	    										}
										    ?>          
    										
    										<?php
								                //Event TV Read More Button
								                $tv_btn = isset($smof_data['tv_btn']) ? $smof_data['tv_btn'] : 1;
								                $tv_btn_text = isset($smof_data['tv_btn_text']) ? $smof_data['tv_btn_text'] : 'Read More';
								                    
								                if($tv_btn){
								                    echo '<a href="'.get_permalink().'" class="btn btn-solid btn-grey btn-md">'.$tv_btn_text.'</a>';
								                }
								            ?>   										

										</div>

										<?php
											//Single Event TV Share and Like
								            $tv_share_like = isset($smof_data['tv_share_like']) ? $smof_data['tv_share_like'] : 1;
								            $tv_share = isset($smof_data['tv_share']) ? $smof_data['tv_share'] : 1;
								            $tv_like = isset($smof_data['tv_like']) ? $smof_data['tv_like'] : 1;

								            if($tv_share_like){
								                pix_share_like_comment($tv_share,$tv_like,0);
								            }
								        ?>

									</div>

								</article>

							<?php endwhile; ?>

									
								
							<?php else: ?>

							<?php endif; ?>

			   				
						</div>

						<?php

							if($no_of_event_videos != -1){
								if ( function_exists( 'bones_page_navi' ) ) {
									echo bones_page_navi(); 
								}
								else { 
									echo '<nav class="wp-prev-next ">
										<ul class="clearfix">
											<li class="prev-link">'.next_posts_link( __( '&laquo; Older Entries', 'innwit' )).'</li>
											<li class="next-link">'.previous_posts_link( __( 'Newer Entries &raquo;', 'innwit' )).'</li>
										</ul>
									</nav>';
								}
							}
							

						?>
					</div>


   				</div>

			</div>



		</div>
	
	</section>

	

	<?php

		wp_reset_query(); 

		get_footer();
	?>