<?php
/**
* The Template for displaying all single posts
*
* @package WordPress
* @subpackage ulysses
* @since ulysses 1.0
*/
get_header();
?>
	<div class="path-section">
		<div class="bg-cover">
		</div>
	</div>
	<div class="blog-section index-page">
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					<?php
					if ( have_posts() ) :
						// Start the loop.
						while ( have_posts() ) : the_post();
							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'content', 'home' );

						// End the loop.
						endwhile;

						ulysses_paging_nav();
					else :
						// If no content, include the "No posts found" template.
						get_template_part( 'content', 'none' );
					endif;
					?>
				</div>
				<div class="col-md-3">
					<div class="sidebar wow bounceInRight">
						<?php get_sidebar(); ?>
					</div>
				</div>
				<!-- === END BLOG RIGHT SIDEBAR === -->
			</div>
		</div>
	</div>
	<?php
get_footer();