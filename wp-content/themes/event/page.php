<?php get_header(); 
global $smof_data;

$page_options = get_post_meta(get_the_id(),'event_on_page_options');
if( !empty($page_options)){
	extract($page_options[0]);
}

//Layout Options
$sidebar_position = isset($sidebar_position) ? $sidebar_position : "no_sidebar";


if (class_exists('Woocommerce')) {
	if( (is_cart() || is_checkout() || is_account_page())  && $sidebar_position == "full_width"){
		$sidebar_position = "no_sidebar";
	}
}

$col_class = ( $sidebar_position == "right" || $sidebar_position == "left" ) ? ' col-md-9' : '';

//Sub Header Options

$display_header = isset($display_header) ? $display_header : 'show';

if(!is_front_page() && $display_header == "show"){
	subBanner(get_the_title());
}

if($sidebar_position != 'full_width'){

	if($sidebar_position == "left" || $sidebar_position == "right" ){
		$sidebar_class = 'with-sidebar';
	}
	else{
		$sidebar_class = 'without-sidebar';
	}
?>

<div class="container boxed <?php echo $sidebar_class; ?>">
	<div class="row">

<?php } ?>

		<?php
		if($sidebar_position == "left" ){
			get_sidebar();	
		}

		if (have_posts()) : while (have_posts()) : the_post(); 
		
		?>

		<section id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' . $col_class ); ?>>

			<section itemprop="articleBody">
				<?php the_content(); ?>
			</section>

		</section>

		<?php endwhile; else : ?>

				<article id="post-not-found" class="hentry clearfix">
					<header class="article-header">
						<h1><?php _e( 'Oops, Post Not Found!', 'innwit' ); ?></h1>
					</header>
				</article>

		<?php endif; 

		if($sidebar_position == "right" ){ 
			get_sidebar();
		} 

		if($sidebar_position != 'full_width'){
		
		?>


	</div>
</div>

<?php } 


get_footer(); ?>
