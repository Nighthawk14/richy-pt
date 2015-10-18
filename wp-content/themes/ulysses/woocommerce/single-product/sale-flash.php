<?php
/**
 * Single Product Sale Flash
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;
?>

<?php if ( ! $product->is_in_stock() ) : ?>
<?php echo apply_filters( 'woocommerce_sold_out_flash', '<span class="item-sold">'.__( 'Sold', 'wc-sold-out-products' ).'</span>', $post, $product ); ?>
<?php endif; ?>

<?php if ( $product->is_on_sale() ) : ?>
<?php echo apply_filters( 'woocommerce_sale_flash', '<span class="item-sale d-bg-c">' . __( 'Sale', 'woocommerce' ) . '</span>', $post, $product ); ?>
<?php endif; ?>

<?php do_action( 'woocommerce_new_item' ); ?>