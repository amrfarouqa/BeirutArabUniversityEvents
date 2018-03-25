<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop, $col_class;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
if($col_class != ''){
	$classes = array('col-md-4');
}else{
	$classes = array('col-md-3');
}
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';
?>
<div <?php post_class( $classes ); ?>>

	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
		
		<!-- Woo Product Item -->
		<?php

			$temp_title = get_the_title($post->ID); //title
			$temp_link = get_permalink($post->ID); //permalink
			global $smof_data;
			$shop_width = isset($smof_data['shop_width'])? $smof_data['shop_width'] : '270';
			$shop_height = isset($smof_data['shop_height'])? $smof_data['shop_height'] : '290';

			$img = $image_thumb_url[0] = "";

			if (has_post_thumbnail()) {    
				$image_id = get_post_thumbnail_id ($post->ID );  
				$image_thumb_url = wp_get_attachment_image_src( $image_id, 'full');
				if(!empty($image_thumb_url)){
					$img = aq_resize($image_thumb_url[0], $shop_width, $shop_height, true, true); 
				}
				if($img){
					$temp_thumb = "<img src='$img' alt=''>";
				}else{
					$temp_thumb = "<img src='$image_thumb_url[0]' alt=''>";                                    
				}
			}
			else {
				$protocol = is_ssl() ? 'https' : 'http';
				$temp_thumb = '<img src="'.$protocol.'://placehold.it/'.$shop_width.'x'.$shop_height.'" alt="">';
			}

			echo '<div class="staff-container woo-product-item">'; //Staff Container

				//Staff Image
				echo '<div class="staff-img-con">';
				
					echo '<div class="staff-img">';
								echo $temp_thumb;
								if(!$product->is_in_stock()){
									_e("<span class='sold-out'>Sold Out</span>", "eventon");
								}
			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * (Removed by Pixel8es) @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' );


								echo '<div class="staff-icons clearfix">';

								//Permalink Icon										
								echo '<b href="#" class="staff-icon">'.__('Add to Cart','eventon').'</b>';
								//add-cart			
								woocommerce_template_loop_add_to_cart();

								echo '</div>';
					echo '</div>';
				
				echo '</div>';


				//Staff Name and content
				echo '<div class="staff-content clearfix">'; //Staff Contentent

					//Author name
					echo '<div class="content">';
					echo  '<h3 class="title"><a href="'. $temp_link .'">'.esc_html($temp_title).'</a></h3>'; //title




					 //seperator
				
			

			/**
			 * woocommerce_after_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_template_loop_rating - 5
			 * (Removed by pixel8es) @hooked woocommerce_template_loop_price - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item_title' );
echo '</div>';

				woocommerce_template_loop_price();

				echo '</div>'; //End of Staff Content

			echo '</div>'; //End of Staff Container

		
		?>


	<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>

</div>