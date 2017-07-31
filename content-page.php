<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Toivo Lite
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php hybrid_attr( 'post' ); ?>>

	<?php ceacw_post_thumbnail('medium_large'); ?>

	<div class="entry-inner">

		<header class="entry-header">
			<?php
				if ( is_singular() ) :
					the_title( '<h3 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '>', '</h3>' );
				else :
					the_title( sprintf( '<h3 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
				endif;
			?>
		</header><!-- .entry-header -->
		
		<div class="entry-content" <?php hybrid_attr( 'entry-content' ); ?>>
			<?php
				/* translators: %s: Name of current post */
				the_content( sprintf(
					__( 'Read more %s', 'toivo-lite' ),
					the_title( '<span class="screen-reader-text">', '</span>', false )
				) );
				
				wp_link_pages( array(
					'before'    => '<div class="page-links">' . __( 'Pages:', 'toivo-lite' ),
					'after'     => '</div>',
					'pagelink'  => '<span class="screen-reader-text">' . __( 'Page', 'toivo-lite' ) . ' </span>%',
					'separator' => '<span class="screen-reader-text">,</span> ',
				) );
			?>
		</div><!-- .entry-content -->
		
	</div><!-- .entry-inner -->

</article><!-- #post-## -->
