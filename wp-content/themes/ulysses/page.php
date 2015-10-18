<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage ulysses
 * @since ulysses 1.0
 */
get_header();

	/* Enable/Disable Options */
	$page_sidebar_option = get_post_meta(get_the_ID(), 'page_sidebar_option', true);
	$page_title_option = get_post_meta(get_the_ID(), 'page_title_option', true);
	$page_layout = get_post_meta(get_the_ID(), 'page_layout', true);

	if( !is_front_page() ) :	
		?>
		<!-- === START PATH === -->
		<div class="path-section">
			<div class="bg-cover">
				<div class="container">
					<?php
					if( !empty($page_title_option) && $page_title_option != 'page_title_disabled' ):
							the_title('<h3>','</h3>');
					elseif(empty($page_title_option)):
						the_title('<h3>','</h3>');
					endif;
					?>
				</div>
			</div>
		</div>
		<!-- === END PATH === -->
		<?php
	endif;
	?>

	<!-- === START BLOG RIGHT SIDEBAR === -->
	<div class="blog-section">
		<div class="<?php if($page_layout != 'page_layout_boxed' && !empty($page_layout) ): echo 'container-fluid shortcode-view'; else: echo 'container'; endif; ?>">
			<div class="row">
				<div class="<?php if($page_sidebar_option == 'sidebar_disabled' ): echo 'col-md-12'; else: echo 'col-md-9'; endif; ?>">
					<?php
					// Start the loop.
					while ( have_posts() ) : the_post();

						// Include the page content template.
						get_template_part( 'content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					// End the loop.
					endwhile;
					?>
				</div>
				<?php if($page_sidebar_option != 'sidebar_disabled' ) : ?>
				<div class="col-md-3">
					<div class="sidebar wow bounceInRight">
						<?php get_sidebar(); ?>
					</div>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<!-- === END BLOG RIGHT SIDEBAR === -->
	<?php
get_footer();