<nav id="pagination">
	<?php
    global $wp_query;

    $big = 999999999; // need an unlikely integer

    echo paginate_links( 
    	array(
        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format' => '/page/%#%',
        'current' => max( 1, get_query_var('paged') ),
        'total' => $wp_query->max_num_pages,
        'end_size' => 5,
        'prev_text' => __('Older Posts &rarr;'),
    	'prev_text' => __('Newer Posts &rarr;'),
    	) );
	?>
</nav><!-- #pagination should be GO BACK etc. -->