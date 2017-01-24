<?php
/**
 * The default template for displaying content.
 *
 * @package ceacw
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php hybrid_attr( 'post' ); ?>>

        <?php if ( is_single() ) :
          toivo_lite_post_thumbnail();
        else :
        ?>
	<div class="entry-thumbnail-cat-post">
          <?php if ( ! in_category(1) ) : //categorie aucune ?>
          <div class="entry-thumbnail-cat">
            <?php ceacw_post_terms( array( 'taxonomy' => 'category', 'text' => '%s' ) ); ?>
          </div>
          <?php endif; ?>
          <div class="entry-thumbnail-post">
             <?php ceacw_post_thumbnail(); ?>
          </div>
        </div>
	<?php endif; ?>

	<div class="entry-inner<?php if ( !is_single() ) { echo " inner-post";} ?>">

		<header class="entry-header">
	
			<?php
				if ( is_single() ) :
					the_title( '<h1 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '>', '</h1>' );
				else :
					the_title( sprintf( '<h2 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '><a title="%s" href="%s" rel="bookmark">', esc_attr(get_the_title()), esc_url( get_permalink() ) ), '</a></h2>' );
				endif;
			?>

                        <?php get_template_part( 'ceacw', 'meta' ); // Loads the entry-meta.php template. ?>
		
		</header><!-- .entry-header -->
		
		<div class="entry-content" <?php hybrid_attr( 'entry-content' ); ?>>
			<?php
				/* translators: %s: Name of current post */
				if ( is_single() ) :
                                  the_content( sprintf(
				    	  __( 'Read more %s', 'toivo-lite' ),
					  the_title( '<span class="screen-reader-text">', '</span>', false )
				  ) );
                                else :
                                  the_excerpt();
                                endif;
				
				wp_link_pages( array(
					'before'    => '<div class="page-links">' . __( 'Pages:', 'toivo-lite' ),
					'after'     => '</div>',
					'pagelink'  => '<span class="screen-reader-text">' . __( 'Page', 'toivo-lite' ) . ' </span>%',
					'separator' => '<span class="screen-reader-text">,</span> ',
				) );
			?>
		</div><!-- .entry-content -->
                <?php if ( is_single() ) : ?>
		<footer class="entry-footer">
			<?php if ( ! in_category(1)) { ceacw_post_terms( array( 'taxonomy' => 'category', 'text' => '%s' ) );} ?>
			<?php //tags: ceacw_post_terms( array( 'taxonomy' => 'post_tag', 'text' => '%s', 'before' => '<br />' ) ); ?>
		</footer><!-- .entry-footer -->
		<?php endif; ?>
	</div><!-- .entry-inner -->
	
</article><!-- #post-## -->
