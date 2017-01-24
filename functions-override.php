<?php

function ceacw_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() && !is_page_template( 'pages/front-page.php' ) && !is_page_template( 'pages/child-pages.php' ) ) :
	?>

		<div class="post-thumbnail">
			<?php the_post_thumbnail('', array( 'alt' => get_the_title() )); ?>
		</div><!-- .post-thumbnail -->

	<?php else : ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" title="<?php echo esc_attr(get_the_title()); ?>" aria-hidden="true">
			<?php
				the_post_thumbnail( 'post-thumbnail', array( 'alt' => get_the_title() ) );
			?>
		</a>

	<?php endif; // End is_singular()
}

function ceacw_posted_on() {

	/* Set up entry date. */
	printf( '<span class="entry-date"><span class="screen-reader-text">%1$s </span><a href="%2$s" title="%5$s" rel="bookmark"><time class="entry-date" datetime="%3$s"' . hybrid_get_attr( 'entry-published' ) . '>%4$s</time></a></span>',
		_x( 'Posted on', 'Used before publish date.', 'toivo-lite' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
                esc_attr(get_the_title())
	);
	
	/* Set up byline. */
	printf( '<span class="byline"><span class="entry-author" ' . hybrid_get_attr( 'entry-author' ) . '><span class="screen-reader-text">%1$s </span><a class="entry-author-link" href="%2$s" rel="author" title="%4$s" itemprop="url"><span itemprop="name">%3$s</span></a></span></span>',
		_x( 'Author', 'Used before post author name.', 'toivo-lite' ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		get_the_author(),
                esc_attr( get_the_author() )
	);

}

function ceacw_search_bar(){
  $output = '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">';
  $output .= ' <div style="text-align:center">';
  $output .= '  <div style="display:inline-table;">';
  $output .= '    <label style="display: table-cell;">';
  $output .= '      <span class="screen-reader-text">'. _x( 'Search for:', 'label' ) .'</span>';
  $output .= '      <input class="search-field" style="margin-bottom:0px;padding:0 10px;height:50px;" placeholder="' . esc_attr_x( 'Search &hellip;', 'placeholder' ) . '" value="' . get_search_query() . '" name="s" type="search">';
  $output .= '    </label>';
  $output .= '';
  $output .= '    <div style="display: table-cell; position:relative;vertical-align: middle;">';
  $output .= '      <button style="margin-top:0px;height:50px;" title="'.__('Search').'" onclick="this.form.submit()">';
  $output .= '        <span class="_mi dashicons dashicons-search"></span>';
  $output .= '      </button>';
  $output .= '    </div>';
  $output .= '  </div>';
  $output .= ' </div>';
  $output .= '</form>';

  return $output;
}

add_filter( 'get_search_form', 'ceacw_search_bar' );