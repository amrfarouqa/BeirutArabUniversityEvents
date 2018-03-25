<?php get_header(); ?>

<?php

	//Get values from Theme Options
	global $smof_data;

	//Blog 
    $sidebar_position = isset($smof_data['b_sidebar']) ? $smof_data['b_sidebar'] : 'left_sidebar';

	//Assign blog style column settings
	if($sidebar_position == 'full_width'){
		$columns = 'col-md-12';
	}
	else{
		$columns = 'col-md-9';
	}

?>

    <?php 
    	//Show/Hide blog sub banner
    	$b_sub_banner = isset($smof_data['b_sub_banner']) ? $smof_data['b_sub_banner'] : 1;
    	if($b_sub_banner){
    		//Blog Title
    		$b_title = isset($smof_data['b_title']) ? $smof_data['b_title'] : 'Blog';
    		subBanner($b_title );
    	}    	
    ?>

    <section class="events  newsection">
 
	    <div class="container">

			<div class="row">

                <?php

		            //Get blog values from theme option
	                $b_select_sidebar = isset($smof_data['b_select_sidebar']) ? $smof_data['b_select_sidebar'] : 0;
	                $b_styles = isset($smof_data['b_styles']) ? $smof_data['b_styles'] : 'style1';

	                if($b_styles == 'style2'){
	                	$style = 'style-two';
	                }
	                else{
	                	$style = '';
	                }

					if($sidebar_position == 'left_sidebar'){

						pix_sidebar($b_select_sidebar, 'blog-sidebar', $b_styles, 0);
					}
	        	?>
                       
				<div id="main" class="blog <?php echo $columns; ?>" role="main">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

						<?php get_template_part( 'includes/blog', 'content' ); ?>

					<?php endwhile; ?>

						<?php bones_page_navi(); ?>

					<?php else : ?>

						<?php get_template_part( 'includes/blog', 'error' ); ?>

					<?php endif; ?>


				</div>

				<?php
                    if($sidebar_position == 'right_sidebar'){
						pix_sidebar($b_select_sidebar, 'blog-sidebar', $b_styles, 0);
					}
                ?>

			</div>

		</div>
    </section>

<?php get_footer(); ?>
