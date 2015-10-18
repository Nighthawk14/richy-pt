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
				<h3><?php _e( 'Not Found', 'ulysses' ); ?></h3>
			</div>
		</div>
	</div>
	<!-- === END PATH === -->

	<div class="blog-section search-page">
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'ulysses' ); ?></p>
					<?php get_search_form(); ?>
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