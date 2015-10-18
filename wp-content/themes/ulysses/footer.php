<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage ulysses
 * @since ulysses 1.0
 */
	global $ulysses_option;
?>
		</div><!-- === END CONTENT === -->
		<!-- === START FOOTER === -->
		<footer class="footer">
			<div class="container">
				<div class="logo"><img src="<?php echo esc_url( $ulysses_option['opt_site_logo']['url'] ); ?>" alt="<?php echo esc_html( get_bloginfo('name') ); ?>"/></div>
				<?php
				if(!empty($ulysses_option['opt_icons_footer'])):
					?>
					<ul class="socials">
						<?php
						$opt_icons_items = $ulysses_option['opt_icons_footer'];
						foreach ( $opt_icons_items as $opt_icons_item ) :
							?>
							<li><a target="_blank" href="<?php echo esc_url($opt_icons_item['url']); ?>" class="d-text-c-h d-border-c-h"><img src="<?php echo esc_url($opt_icons_item['image']); ?>" alt="Social Icon"/></a></li>
							<?php
						endforeach;
						?>
					</ul>
					<?php 
				endif;
				if(!empty($ulysses_option['opt_copyright_text'])) :
				?>
				<p class="copywrite"><?php echo esc_html( $ulysses_option['opt_copyright_text'] ); ?></p>
				<?php endif; ?>
			</div>
		</footer><!-- === END FOOTER === -->
	</div><!-- === END Box Wide === -->
	<?php wp_footer(); ?>
</body>
</html>