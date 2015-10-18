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

global $product, $post, $woocommerce_loop;

$product_c = new WC_Product( get_the_ID() );
$price = $product_c->price;

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
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';

?>
<div <?php post_class( $classes ); ?>>
	<div class="col-md-4 col-sm-4">
		<div class="shop-item">
			<div class="item-image d-border-c">
				<div class="item-hover">
					<?php if ( ! $product->is_in_stock() ) : ?>
					<?php echo apply_filters( 'woocommerce_sold_out_flash', '<span class="item-sold">'.__( 'Sold', 'wc-sold-out-products' ).'</span>', $post, $product ); ?>
					<?php endif; ?>

					<?php if ( $product->is_on_sale() ) : ?>
					<?php echo apply_filters( 'woocommerce_sale_flash', '<span class="item-sale d-bg-c">' . __( 'Sale', 'woocommerce' ) . '</span>', $post, $product ); ?>
					<?php endif; ?>

					<?php do_action( 'woocommerce_new_item' ); ?>

					<div class="item-hover-bg d-bg-c"></div>
					<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
				</div>
				<?php
				if ( has_post_thumbnail() ) :
					echo get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
				else:
					echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );
				endif;
				?>
			</div>
			<div class="item-details">
				<a href="<?php esc_url(the_permalink()); ?>">
					<?php the_title('<h3>','</h3>'); ?>
				</a>
				<?php
				$terms = get_the_terms( $post->ID, 'product_cat' );
				if(!empty($terms)) :
					foreach ($terms as $term)
					{
						$product_cat_name = $term->name;
						break;
					}
					?>
					<h5><?php _e( 'Collection: ', 'ulysses' ) ?><?php echo esc_html( $product_cat_name ); ?></h5><?php
				endif; ?>
				<?php if(!empty($price)): ?><h6><?php _e( '$: ', 'ulysses' ) ?><?php echo esc_html( $price ); ?></h6><?php endif; ?>
			</div>
		</div> 
	</div>
</div>