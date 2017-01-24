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
			Club d'Education et d'Activités Canines de Wavrin
		</div><!-- .site-info -->
		
	</footer><!-- #colophon -->

	<!-- #Hook footer-->	
	<?php do_action( 'toivo_after_footer' ); // Hook after footer. ?>

</div><!-- #page -->


<?php wp_footer(); ?>

</body>
</html>
