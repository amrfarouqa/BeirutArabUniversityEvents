<?php
	global $smof_data;
	get_header();
?>

<?php
if (is_category()) {

	$arc_title = __("Posts Categorized:", "innwit") . ' ' . single_cat_title( $prefix = '', $display = false );

}
elseif (is_tag()) { 

	$arc_title = __("Posts Tagged:", "innwit") . ' ' . single_tag_title( $prefix = '', $display = false );

}
elseif (is_author()) { 
	global $post;
	$author_id = $post->post_author;

	$arc_title = __("Posts By:", "innwit") . ' ' . get_the_author_meta('display_name', $author_id);

}
elseif (is_day()) { 

	$arc_title = __("Daily Archives:", "innwit") . ' ' . get_the_time('l, F j, Y');

}
elseif (is_month()) {  

	$arc_title = __("Monthly Archives:", "innwit") . ' ' . get_the_time('F Y');

}
elseif (is_year()) {  

	$arc_title = __("Posts Categorized:", "innwit") . ' ' . get_the_time('Y');

}

//Show/Hide single post sub banner
$a_sub_banner = isset($smof_data['a_sub_banner']) ? $smof_data['a_sub_banner'] : 1;
if($a_sub_banner){
	subBanner($arc_title);
} 

?>
<div class="container newsection">

	<div class="row">

		<?php
			//Get blog values from theme option
			$sidebar_position = isset($smof_data['a_sidebar']) ? $smof_data['a_sidebar'] : 'left_sidebar';

			//Assign archive page column settings
			if($sidebar_position == 'full_width'){
				$columns = 'col-md-12';
			}
			else{
				$columns = 'col-md-9';
			}

			$a_select_sidebar = isset($smof_data['a_select_sidebar']) ? $smof_data['a_select_sidebar'] : 0;
			$a_styles = isset($smof_data['a_styles']) ? $smof_data['a_styles'] : 'style1';

			if($a_styles == 'style2'){
				$style = 'style-two';
			}
			else{
				$style = '';
			}
			

			if($sidebar_position == 'left_sidebar'){

				pix_sidebar($a_select_sidebar, 'blog-sidebar', $a_styles, 0);
	    	}
		?>

		<div id="main" class="blog <?php echo $columns; ?>" role="main">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( 'event-container' ); ?> role="article">

					<div class="event clearfix">

						<?php pix_featured_thumbnail(515, 390); //Width, Height ?>


						<div class="entry-content cf event-content">
							<h2 class="title"><a href="<?php the_permalink() ?> "><?php the_title(); ?></a></h2>

							<?php

								//Archive Meta 

							    $a_meta_post_format = isset($smof_data['a_meta_post_format']) ? $smof_data['a_meta_post_format'] : 1;
							    $a_meta_date = isset($smof_data['a_meta_date']) ? $smof_data['a_meta_date'] : 1;
							    $a_meta_comment = isset($smof_data['a_meta_comment']) ? $smof_data['a_meta_comment'] : 1;
							    $a_meta_author = isset($smof_data['a_meta_author']) ? $smof_data['a_meta_author'] : 1;

							    pix_blog_meta($a_meta_post_format , $a_meta_date, $a_meta_comment, $a_meta_author);
							?>


							<?php 
								//Get blog values from theme option
    							$a_limit = isset($smof_data['a_limit']) ? $smof_data['a_limit'] : 200;
								$content = strip_shortcodes(ShortenText(get_the_excerpt(),$a_limit));
								if(!empty($content)){
									echo '<p>'.$content.'</p>';
								}
							?> 
							         
							<?php
	                			//Archive Read More Button
								$a_button = isset($smof_data['a_button']) ? $smof_data['a_button'] : 1;
								$a_button_text = isset($smof_data['a_button_text']) ? $smof_data['a_button_text'] : 'Read More';

								if($a_button){
									echo '<a href="'.get_permalink().'" class="btn btn-solid btn-grey btn-md">'.$a_button_text.'</a>';
								}
							?>

						</div>


					</div> 

				</article>

			<?php endwhile; ?>

			<?php bones_page_navi(); ?>

		<?php else : ?>

			<?php get_template_part( 'includes/post', 'error' ); ?>

		<?php endif; ?>

	</div>

	<?php
		if($sidebar_position == 'right_sidebar'){

			pix_sidebar($a_select_sidebar, 'blog-sidebar', $a_styles, 0);
		}
	?>

</div>

</div>

<?php get_footer(); ?>
