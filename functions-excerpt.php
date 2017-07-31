<?php

function ceacw_allowedtags() {
        return '<br>,<b>,<i>,<ul>,<ol>,<li>,<a>'; 
}

if ( ! function_exists( 'wpse_custom_wp_trim_excerpt' ) ) : 

    function wpse_custom_wp_trim_excerpt($wpse_excerpt) {
    $raw_excerpt = $wpse_excerpt;
        if ( '' == $wpse_excerpt ) {

            $wpse_excerpt = get_the_content('');
            $wpse_excerpt = strip_shortcodes( $wpse_excerpt );
            $wpse_excerpt = apply_filters('the_content', $wpse_excerpt);
            $wpse_excerpt = str_replace(']]>', ']]&gt;', $wpse_excerpt);
            $wpse_excerpt = strip_tags($wpse_excerpt, ceacw_allowedtags()); /*IF you need to allow just certain tags. Delete if all tags are allowed */

            //Set the excerpt word count and only break after sentence is complete.
                $excerpt_length = apply_filters( 'excerpt_length', 55 );
                $tokens = array();
                $excerptOutput = '';
                $count = 0;

                // Divide the string into tokens; HTML tags, or words, followed by any whitespace
                preg_match_all('/(<[^>]+>|[^<>\s]+)\s*/u', $wpse_excerpt, $tokens);

                foreach ($tokens[0] as $token) { 

                    if ($count >= $excerpt_length && preg_match('/[\,\;\?\.\!]\s*$/uS', $token)) { 
                    // Limit reached, continue until , ; ? . or ! occur at the end
                        $excerptOutput .= trim($token);
                        break;
                    }

                    // Add words to complete sentence
                    $count++;

                    // Append what's left of the token
                    $excerptOutput .= $token;
                }

            $wpse_excerpt = trim(force_balance_tags($excerptOutput));

            if ($count >= $excerpt_length) {

                $excerpt_end = ' <a href="'. esc_url( get_permalink() ) . '" title="'.esc_attr(get_the_title()).'">' . '&nbsp;&raquo;&nbsp;' . sprintf(__( 'Read more about: %s &nbsp;&raquo;', 'wpse' ), get_the_title()) . '</a>'; 
                $excerpt_more = apply_filters('excerpt_more', ' ' . $excerpt_end); 

                //$pos = strrpos($wpse_excerpt, '</');
                //if ($pos !== false)
                // Inside last HTML tag
                //$wpse_excerpt = substr_replace($wpse_excerpt, $excerpt_end, $pos, 0); /* Add read more next to last word */
                //else
                // After the content
                $wpse_excerpt .= $excerpt_more; /*Add read more in new paragraph */
            }
            return $wpse_excerpt;   

        }
        return apply_filters('wpse_custom_wp_trim_excerpt', $wpse_excerpt, $raw_excerpt);
    }

endif; 


function ceacw_excerpt_more() {

	/* Translators: The %s is the post title shown to screen readers. */
	$text = sprintf( __( 'Read more %s', 'toivo-lite' ), '<span class="screen-reader-text">' . get_the_title() . '</span>' );
	$more = sprintf( '&hellip; <p class="toivo-read-more"><a href="%s" class="more-link" title="'.esc_attr(__( 'Read more %s', 'toivo-lite' )).'">%s</a></p>', esc_url( get_permalink() ),esc_attr(get_the_title()), $text );

	return $more;

}

function ceacw_auto_add_link_titles( $content ) {

    if ( empty( $content ) ) {
        return $content;
    }

    $links = array();

    $html = new DomDocument;
    $html->loadHTML( $content );
    $html->preserveWhiteSpace = false;

    foreach( $html->getElementsByTagName( 'a' ) as $link ) {

        if ( ! empty( $link->getAttribute( 'title' ) ) ) {
            continue;
        }

        $link_text = utf8_decode($link->textContent);
	$hlink = $link->getAttribute( 'href' );
        if(!$link_text) $link_text= basename($hlink);

        if ( $link_text ) {
            $links[] = array('text' => $link_text, 'link' => $hlink);
        }

    }

    if ( ! empty( $links ) ) {
        foreach ( $links as $aLink ) {
            $link = $aLink['link'];
            $text = $aLink['text'];
            if ( $link && $text ) {
                $text    = esc_attr( $text );
                $replace = $link .'" title="'. $text .'"';
                $content = str_replace( $link .'"', $replace, $content );
            }

        }
    }

    return $content;

}
add_filter( 'the_content', 'ceacw_auto_add_link_titles' );
add_filter( 'get_custom_logo', 'ceacw_auto_add_link_titles' );

remove_filter('excerpt_more', 'toivo_lite_excerpt_more', 11);
add_filter( 'excerpt_more', 'ceacw_excerpt_more', 11 );
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'wpse_custom_wp_trim_excerpt'); 
