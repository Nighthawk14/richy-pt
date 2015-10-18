<?php
/*
	Template Name: Blog Template
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

	<!-- === START BLOG RIGHT SIDEBAR === -->
	<div class="blog-section">
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					<?php
					query_posts('posts_per_page='.get_option('posts_per_page').'&paged='. get_query_var('paged'));
					if ( have_posts() ) :
						while ( have_posts() ) : the_post();
							get_template_part( 'content', get_post_format() );
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
			</div>
		</div>
	</div>
	<!-- === END BLOG RIGHT SIDEBAR === -->
<?php get_footer(); ?>