<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $woocommerce, $product;

?>
<div class="images">
<?php if ( $product->is_on_sale() ) : ?>

	<?php echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . __( 'Sale!', 'woocommerce' ) . '</span>', $post, $product ); ?>

<?php endif; ?>
	<?php
		$image_title = esc_attr( get_the_title( get_post_thumbnail_id() ) );
		$image_link  = wp_get_attachment_url( get_post_thumbnail_id() );
		$image       = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
			'title' => $image_title
			) );

		$attachment_count = count( $product->get_gallery_attachment_ids() );
		$images = $product->get_gallery_attachment_ids();?>
		
		<?php 
		if ( $attachment_count > 0 ) {?>
			<div class="is-carousel single-carousel post-gallery content-image carousel-has-control product-ct" id="post-gallery-<?php the_ID() ?>" data-navigation=1>
			<?php
				wp_enqueue_style( 'lightbox2', get_template_directory_uri() . '/js/colorbox/colorbox.css');
wp_enqueue_script( 'colorbox', get_template_directory_uri() . '/js/colorbox/jquery.colorbox-min.js', array('jquery'), '', true );

			foreach($images as $attachment_id){
				$image_custom = wp_get_attachment_image_src( $attachment_id, 'shop_single' ); ?>
				<div class="single-gallery-item single-gallery-item-<?php echo $attachment_id ?>">
					<a href="<?php echo get_permalink($attachment_id); ?>" class="colorbox-grid" data-rel="post-gallery-<?php the_ID() ?>" data-content=".single-gallery-item-<?php echo $attachment_id ?>">
					<img src='<?php echo $image_custom[0]; ?>'>
					</a>
					<div class="hidden">
						<div class="popup-data dark-div">
							<?php $thumbnail = wp_get_attachment_image_src($attachment_id,'full', true); ?>
							<img src="<?php echo $thumbnail[0] ?>" width="<?php echo $thumbnail[1] ?>" height="<?php echo $thumbnail[2] ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>">
							<div class="popup-data-content">
								<h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
								<div><?php the_excerpt(); ?></div>
								<a class="btn btn-default" href="javascript:void(0)" data-toggle="collapse" data-target="#share-in-popup-<?php echo $attachment_id;?>"><?php _e('SHARE','cactusthemes'); ?> <i class="fa fa-share"></i></a>
								<a href="<?php echo get_permalink($attachment_id); ?>#comment" class="btn btn-default popup-gallery-comment" title="<?php _e('View comments','cactusthemes'); ?>"><?php _e('COMMENTS','cactusthemes'); ?></a>
								<div id="share-in-popup-<?php echo $attachment_id;?>" class="popup-share collapse">
									<ul class="list-inline social-light">
										<?php cactus_social_share($attachment_id); ?>
									</ul>
								</div>
							</div>
						</div>
					</div><!--/hidden-->
				</div>
			<?php }//foreach attachments ?>
			</div><!--/is-carousel-->

			<?php
			//$gallery = '[product-gallery]';
		} elseif ( has_post_thumbnail() ) {
		$gallery = '';
		echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a>', $image_link, $image_title, $image ), $post->ID );

		} else {

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', wc_placeholder_img_src() ), $post->ID );

		}
	?>

	<?php //do_action( 'woocommerce_product_thumbnails' ); ?>

</div>
