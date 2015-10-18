<?php

/**
 * Register three ulysses widget areas.
 *
 * @since ulysses 1.0
 */
function ulysses_widgets_init()
{
	register_sidebar( array(
		'name'          => __( 'Content Sidebar', 'ulysses' ),
		'id'            => 'content_sidebar',
		'description'   => __( 'Appears in the Content section of the site.', 'ulysses' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<i class="ulysses_widget_icon"></i><h3 class="widget-title">',
		'after_title'   => '</h3><i class="bottom_border"></i>',
	));
	register_sidebar( array(
		'name'          => __( 'Woocommerce Sidebar', 'ulysses' ),
		'id'            => 'woocommerce_sidebar',
		'description'   => __( 'Appears in the Content section of the site.', 'ulysses' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<i class="ulysses_widget_icon"></i><h3 class="widget-title">',
		'after_title'   => '</h3><i class="bottom_border"></i>',
	));
}
add_action( 'widgets_init', 'ulysses_widgets_init' );