<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product, $woocommerce_loop;

if ( empty( $product ) || ! $product->exists() ) {
	return;
}

$related = $product->get_related( $posts_per_page );

if ( sizeof( $related ) == 0 ) return;

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'            => 'product',
	'ignore_sticky_posts'  => 1,
	'no_found_rows'        => 1,
	'posts_per_page'       => $posts_per_page,
	'orderby'              => $orderby,
	'post__in'             => $related,
	'post__not_in'         => array( $product->id )
) );

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = $columns;

if ( $products->have_posts() ) :
?>
<div class="shop-items">

		<div class="related products">
			<div class="site-title wow fadeInDown">
				<p><?php _e( 'Take a look at', 'ulysses' ) ?></p>
				<h1><?php _e( 'Related Products', 'woocommerce' ); ?></h1>
				<div class="site-dots d-text-c"><i class="fa fa-times-2"></i><i class="fa fa-times-2"></i></div>
			</div>
			<div class="row">
				<?php woocommerce_product_loop_start(); ?>
				<?php
				while ( $products->have_posts() ) : $products->the_post();
					$product = new WC_Product( get_the_ID() );
					$price = $product->price;
					?>
					<li class="col-md-3 col-sm-4">
						<div class="shop-item">
							<div class="item-image d-border-c">
								<div class="item-hover">

									<?php if ( ! $product->is_in_stock() ) : ?>
									<?php echo apply_filters( 'woocommerce_sold_out_flash', '<span class="item-sold">'.__( 'Sold', 'wc-sold-out-products' ).'</span>', $post, $product ); ?>
									<?php endif; ?>

									<?php if ( $product->is_on_sale() ) : ?>
										<?php echo apply_filters( 'woocommerce_sale_flash', '<span class="item-sale d-bg-c">' . __( 'Sale!', 'woocommerce' ) . '</span>', $post, $product ); ?>
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
								<a href="<?php echo esc_url(the_permalink()); ?>">
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
								<?php if(!empty($price)): ?><h6><?php _e( '£: ', 'ulysses' ) ?><?php echo esc_html( $price ); ?></h6><?php endif; ?>
							</div>
						</div>
					</li>
					<?php
				endwhile; // end of the loop. ?>
				<?php woocommerce_product_loop_end(); ?>
			</div>
		</div>

</div>
	<?php
endif;

wp_reset_postdata();
