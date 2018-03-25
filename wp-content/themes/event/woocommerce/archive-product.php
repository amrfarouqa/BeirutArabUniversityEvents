<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header( 'shop' ); 

	$shop_page_id = wc_get_page_id( 'shop' );

	$woo_page_options = get_post_meta($shop_page_id,'electrify_page_options');
	if( !empty($woo_page_options)){
		extract($woo_page_options[0]);
	}

	//Layout Options
	$sidebar_position = (isset($sidebar_position) && ($sidebar_position != 'full_width')) ? $sidebar_position : "no_sidebar";

	$selected_sidebar_replacement = (isset($selected_sidebar_replacement) && $selected_sidebar_replacement != '0') ? $selected_sidebar_replacement : 'shop';

	$col_class = ( $sidebar_position == "right" || $sidebar_position == "left" ) ? ' col-md-9' : '';

	//Sub Header Options
	$pix_header_text = isset($pix_header_text) ? $pix_header_text : 'left';	
	$header_size = isset($header_size) ? $header_size : 'small';
	$pix_header_styles = isset($pix_header_styles) ? $pix_header_styles : 'color';
	$header_bg_image = isset($header_bg_image) ? $header_bg_image : '';
	$header_bg_color = isset($header_bg_color) ? $header_bg_color : 'f1f2f2';
	$header_text_color = isset($header_text_color) ? $header_text_color : '';
	$display_header = isset($display_header) ? $display_header : 'show';

	//rebuilding image
	$header_bg_image = htmlspecialchars_decode($header_bg_image);
	$header_bg_image = json_decode($header_bg_image,true);
	$header_bg_image = $header_bg_image[0]['full'];

?>
	
	<?php

		/* HEADER */
		global $smof_data;

		$color = $class_con = $class_left = $class_right = $style = '';

		if($pix_header_text == 'left'){
			$class_left = 'col-md-8';
			$class_right = 'col-md-4';
			$class_con = 'row';
		}
		
		if(($pix_header_styles == 'image' || $pix_header_styles == 'customcolor') && (!empty($header_bg_image) || !empty($header_bg_color) || !empty($header_text_color))){

			$style .= ' style="';

				if( $pix_header_styles == 'customcolor' && !empty($header_bg_color)){
					$style .= !empty($header_bg_color) ? 'background-color:'. $header_bg_color .';' : '';
				}

				if( $pix_header_styles == 'image' && !empty($header_bg_image)){
					$style .= 'background-image: url('.$header_bg_image.');';
					$style .= 'background-size: cover;';
					$style .= 'background-repeat: no-repeat;background-position: center center; background-attachment: fixed;';
				}

				if( $pix_header_styles != 'color' && !empty($header_text_color)){
					$color = !empty($header_text_color) ? 'style="color:'. $header_text_color .';"' : '';
				}

			$style .= '"';
		}
	?>

		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) && $display_header == "show" ) :

			echo '<div id="sub-header" class="clear clearfix align-'. $pix_header_text .' '. $header_size .' '. $pix_header_styles .'" '. $style .'>
			
			<div id="banner" class="sub-header-inner sub-banner">
			<div class="container">
				<header class="banner-header '. $class_left .'">
					<h2 '. $color .'>';
					woocommerce_page_title();
					echo '</h2>
				</header>
				<div class="'. $class_right .'" style="color:'. $color .'">';
					$breadcrumbs = isset($smof_data['breadcrumbs']) ? $smof_data['breadcrumbs'] : '1';
					$breadcrumbs_blog = isset($smof_data['breadcrumbs_blog']) ? $smof_data['breadcrumbs_blog'] : 'Blog';

					if($breadcrumbs == 1){  
						do_action( 'woo_custom_breadcrumb' );
					}

					echo '</div></div>
				</div>   
			</div>';

		 endif; 
?>
	
		<?php 
		 /**
		  * woocommerce_before_main_content hook
		  *
		  * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		  * (Removed by pixel8es - @hooked woocommerce_breadcrumb - 20 )
		  */
		 do_action( 'woocommerce_before_main_content' );
		 if($sidebar_position == "left" ){
		 	echo '<div class="woo-desc"></div>';
		 	get_sidebar();	
		 }

			if ( have_posts() ) : 
				
				woocommerce_product_loop_start(); 

				echo '<div class="woo-desc">';
				do_action( 'woocommerce_archive_description' );
				echo '</div>';

				/**
				 * woocommerce_before_shop_loop hook
				 *
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );
			?>



				<?php woocommerce_product_subcategories(); ?>
	<div class="woo-wrap row clearfix">
				<?php while ( have_posts() ) : the_post(); ?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>
</div>
			<?php
				/**
				 * woocommerce_after_shop_loop hook
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>

			<?php woocommerce_product_loop_end(); ?>

			

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php wc_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>

	<?php

		if($sidebar_position == "right" ){
			echo '<div class="woo-desc"></div>';
			get_sidebar();	
		}

		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		//do_action( 'woocommerce_sidebar' );
	?>

<?php get_footer( 'shop' ); ?>