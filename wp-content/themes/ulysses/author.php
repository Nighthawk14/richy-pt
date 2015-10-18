<?php
/**
 * The template for displaying Author archive pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage ulysses
 * @since ulysses 1.0
 */

get_header(); ?>
	<section class="content-area single-template">
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					<?php
					if ( have_posts() ) : ?>
						<header class="archive-header">
							<h1 class="archive-title">
								<?php
									the_post();
									printf( __( 'All posts by %s', 'ulysses' ), get_the_author() );
								?>
							</h1>
							<?php if ( get_the_author_meta( 'description' ) ) : ?>
							<div class="author-description"><?php the_author_meta( 'description' ); ?></div>
							<?php endif; ?>
						</header><!-- .archive-header -->
						<?php
						/*
						 * Since we called the_post() above, we need to rewind
						 * the loop back to the beginning that way we can run
						 * the loop properly, in full.
						 */
						rewind_posts();

						// Start the Loop.
						while ( have_posts() ) : the_post();
							get_template_part( 'content', get_post_format() );
						endwhile;

						// Previous/next page navigation.
						ulysses_paging_nav();
					else :
						// If no content, include the "No posts found" template.
						get_template_part( 'content', 'none' );
					endif; ?>
				</div>
				<div class="content-sidebar col-md-3">
					<?php get_sidebar(); ?>
				</div>
			</div><!-- /.container -->
		</div><!-- /.row -->
	</section><!-- /.container fluid -->
	<?php
get_footer();