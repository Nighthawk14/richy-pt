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
				<h3>
					<?php
					if ( is_day() ) :
						printf( __( 'Daily Archives: %s', 'ulysses' ), get_the_date() );
					elseif ( is_month() ) :
						printf( __( 'Monthly Archives: %s', 'ulysses' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'ulysses' ) ) );
					elseif ( is_year() ) :
						printf( __( 'Yearly Archives: %s', 'ulysses' ), get_the_date( _x( 'Y', 'yearly archives date format', 'ulysses' ) ) );
					else :
						_e( 'Archives', 'ulysses' );
					endif;
					?>
				</h3>
			</div>
		</div>
	</div>
	<!-- === END PATH === -->

	<div class="blog-section">
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					<?php
					if ( have_posts() ) :
						while ( have_posts() ) : the_post();
							get_template_part( 'content', get_post_format() );

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() )
							{
								comments_template();
							}
						endwhile;
						// Previous/next page navigation.
						ulysses_paging_nav();
					else:
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