<?php
/**
 * Single Product tabs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>

<div id="accordion" class="woo">
  <div class="panel panel-default">
  	<?php 
  	$i = 1;
  	foreach ( $tabs as $key => $tab ) : 
  		
  		$text = ucwords(convertNumber($i));
  	?>
    <div class="panel-heading">
	      <h4 class="title">
		        <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $text; ?>">
		         <?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?>
		        </a>
	      </h4>
    </div>



    <div id="collapse<?php echo $text; ?>" class="panel-collapse collapse ">
      <div class="panel-body">
       <?php call_user_func( $tab['callback'], $key, $tab ) ?>
      </div>
    </div>
<?php $i++; endforeach; ?>
  </div>
</div>

<?php endif; ?>