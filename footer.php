<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #main and all content after
 *
 * @package ceacw
 */
?>

					</main><!-- #main -->
				</div><!-- #primary -->

			<?php get_sidebar( 'primary' ); // Loads the sidebar-primary.php template. ?>
			
			</div><!-- .wrap-inside -->
		</div><!-- .wrap -->
	</div><!-- #content -->
	
	<?php //get_sidebar( 'subsidiary' ); // Loads the sidebar-subsidiary.php template. ?>

	<footer id="colophon" class="site-footer" role="contentinfo" <?php hybrid_attr( 'footer' ); ?>>
		
		<div class="site-info">
			&copy; 2016
			<span class="sep"><?php echo _x( '&middot;', 'Separator in site info.', 'toivo-lite' ); ?></span>
			<?php echo get_bloginfo( 'description' ); ?>
			<br/>
			<a href="<?php echo get_site_url().get_theme_mod('ceacw_contact_uri') ?>" title="contact">Contact</a>
                        &nbsp;|&nbsp;
			<a href="<?php echo get_site_url().get_theme_mod('ceacw_ml_uri'); ?>" title="Mentions Légales">Mentions Légales</a>
		</div><!-- .site-info -->
		
	</footer><!-- #colophon -->

	<!-- #Hook footer-->	
	<?php do_action( 'toivo_after_footer' ); // Hook after footer. ?>

</div><!-- #page -->


<?php wp_footer(); ?>

</body>
</html>
