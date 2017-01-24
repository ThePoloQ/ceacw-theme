<?php

function ceacw_get_the_term_list( $id, $taxonomy, $before = '', $sep = '', $after = '' ) {
	$terms = get_the_terms( $id, $taxonomy );
	if ( is_wp_error( $terms ) )
		return $terms;
	if ( empty( $terms ) )
		return false;
	$links = array();
	foreach ( $terms as $term ) {
		$link = get_term_link( $term, $taxonomy );
		if ( is_wp_error( $link ) ) {
			return $link;
		}
		$links[] = '<a href="' . esc_url( $link ) . '" title="'.esc_attr($term->name).'" rel="tag">' . $term->name . '</a>';
	}

	$term_links = apply_filters( "term_links-{$taxonomy}", $links );
	return $before . join( $sep, $term_links ) . $after;
}

function ceacw_get_post_terms( $args = array() ) {

        $html = '';

        $defaults = array(
                'post_id'    => get_the_ID(),
                'taxonomy'   => 'category',
                'text'       => '%s',
                'before'     => '',
                'after'      => '',
                'items_wrap' => '<span %s>%s</span>',
                /* Translators: Separates tags, categories, etc. when displaying a post. */
                'sep'        => _x( ', ', 'taxonomy terms separator', 'toivo-lite' )
        );

        $args = wp_parse_args( $args, $defaults );

        $terms = ceacw_get_the_term_list( $args['post_id'], $args['taxonomy'], '<span class="term">', '</span><span class="term">', '</span>' );

        if ( !empty( $terms ) ) {
                $html .= $args['before'];
                $html .= sprintf( $args['items_wrap'], 'class="entry-terms ' . $args['taxonomy'] . '" ' . hybrid_get_attr( 'entry-terms', $args['taxonomy'] ) . '', sprintf($args['text'], $terms ) );
                $html .= $args['after'];
        }

        return $html;
}

function ceacw_post_terms( $args = array() ) {
        echo ceacw_get_post_terms( $args );
}