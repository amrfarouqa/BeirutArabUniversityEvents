<?php
	get_header();
?>

<?php

	global $smof_data;

	$sidebar_position = isset($smof_data['s_sidebar']) ? $smof_data['s_sidebar'] : 'left_sidebar';

	//Assign blog style column settings
	if($sidebar_position == 'full_width'){
		$columns = 'col-md-12';
	}
	else{
		$columns = 'col-md-9';
	}

?>

	<?php 
    	//Show/Hide single post sub banner
    	$s_sub_banner = isset($smof_data['s_sub_banner']) ? $smof_data['s_sub_banner'] : 1;
    	if($s_sub_banner){
    		subBanner(get_the_title());
    	}    	
    ?>

	<section class="events  newsection">
	 
		<div class="container">

			<div class="row">
				<?php

		            //Get single blog values from theme option
					$s_select_sidebar = isset($smof_data['s_select_sidebar']) ? $smof_data['s_select_sidebar'] : 0;
					$s_styles = isset($smof_data['s_styles']) ? $smof_data['s_styles'] : 'style1';

					if($s_styles == 'style2'){
						$style = 'style-two';
					}
					else{
						$style = '';
					}

					if($sidebar_position == 'left_sidebar'){

						pix_sidebar($s_select_sidebar, 'blog-sidebar', $s_styles, 0);
					}
	        	?>

				<div id="main" class="single-blog <?php echo $columns; ?>" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class( 'event-container clearfix' ); ?> role="article">
							<div class="event clearfix">

								<?php 
									if($sidebar_position == 'full_width'){
										pix_featured_thumbnail(1140, 390); //Width, Height
									}
									else{
										pix_featured_thumbnail(870, 460); //Width, Height
									}
								?>

								<div class="entry-content cf event-content">
									<h2 class="title"><a href="<?php the_permalink() ?>" title = "<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

									<?php

	                					//Single Post Meta 

										$s_meta = isset($smof_data['s_meta']) ? $smof_data['s_meta'] : 1;
										$s_meta_post_format = isset($smof_data['s_meta_post_format']) ? $smof_data['s_meta_post_format'] : 1;
										$s_meta_date = isset($smof_data['s_meta_date']) ? $smof_data['s_meta_date'] : 1;
										$s_meta_comment = isset($smof_data['s_meta_comment']) ? $smof_data['s_meta_comment'] : 1;
										$s_meta_author = isset($smof_data['s_meta_author']) ? $smof_data['s_meta_author'] : 1;

										if($s_meta){

											pix_blog_meta($s_meta_post_format , $s_meta_date, $s_meta_comment, $s_meta_author);

										}

									?>

									<?php the_content(); ?>

								</div>


							</div>

							<?php 
								//Show/Hide comment section
								$s_comment = isset($smof_data['s_comment']) ? $smof_data['s_comment'] : 1;
								
								if($s_comment){
									comments_template();
								}
							?>

						</article>

					
					<?php endwhile; ?>

					<?php else : ?>

						<?php get_template_part( 'includes/post', 'error' ); ?>
					
					<?php endif; ?>

				</div>

				<?php
					if($sidebar_position == 'right_sidebar'){

						pix_sidebar($s_select_sidebar, 'blog-sidebar', $s_styles, 0);
					}
				?>

			</div>

		
		</div>
	</section>
<?php get_footer(); ?>
