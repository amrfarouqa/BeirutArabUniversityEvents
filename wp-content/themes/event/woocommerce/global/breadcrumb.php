<?php
/**
 * Shop breadcrumb
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 * @see         woocommerce_breadcrumb()
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $breadcrumb ) {

	echo $wrap_before;
	echo '<ul class="breadcrumb">';

	foreach ( $breadcrumb as $key => $crumb ) {

		echo $before;

		if ( ! empty( $crumb[1] ) && sizeof( $breadcrumb ) !== $key + 1 ) {
			echo '<li><a href="' . esc_url( $crumb[1] ) . '">' . esc_html( $crumb[0] ) . '</a></li>';
		} else {
			echo '<li> <span class="current">' .esc_html( $crumb[0] ). '</span></li>';
		}

		echo $after;

		if ( sizeof( $breadcrumb ) !== $key + 1 ) {
			//echo $delimiter;
		}

	}
	echo '</ul>';
	echo $wrap_after;

}