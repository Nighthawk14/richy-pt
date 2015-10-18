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
				<h3><?php the_title(); ?></h3>
			</div>
		</div>
	</div>
	<!-- === END PATH === -->

	<div class="blog-section">
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					<?php
					while ( have_posts() ) : the_post();
						get_template_part( 'content', get_post_format() );

						// Previous/next post navigation.
						ulysses_post_nav();

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() )
						{
							comments_template();
						}
					endwhile;
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