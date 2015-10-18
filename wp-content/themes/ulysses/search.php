<?php
/**
* The Template for displaying all single posts
*
* @package WordPress
* @subpackage ulysses
* @since ulysses 1.0
*/
get_header(); ?>
	<!-- === START PATH === -->
	<div class="path-section">
		<div class="bg-cover">
			<div class="container">
				<h3><?php printf( __( 'Search Results for: %s', 'ulysses' ), get_search_query() ); ?></h3>
			</div>
		</div>
	</div>
	<!-- === END PATH === -->

	<div class="blog-section">
		<div class="container">
			<div class="row">
				<div class="col-md-9 search-page">
					<?php
					if ( have_posts() ) :
						while ( have_posts() ) : the_post();
							get_template_part( 'content', get_post_format() );
						endwhile;
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
			</div>
		</div>
	</div>
	<!-- === END BLOG RIGHT SIDEBAR === -->
	<?php
get_footer();