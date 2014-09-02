<article class="post no-results not-found">
	<header class="entry-header">
		<h1 class="entry-title"><?php _e( 'Nothing Found', 'Gracie' ); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php if ( is_archive() ) : ?>
		
			<p><?php _e( 'Sorry, there are no published posts for this archive. Try searching using keywords instead!', 'Gracie' ); ?></p>
			<?php get_search_form(); ?>

		<?php elseif ( is_search() ) : ?>

			<p><?php _e( 'Sorry, no matches were found for your search terms. Please try again with different keywords.', 'Gracie' ); ?></p>
			<?php get_search_form(); ?>

		<?php else : ?>

			<p><?php _e( 'Whoops! It seems we can&rsquo;t find what you&rsquo;re looking for. Bummer. Perhaps try another search?', 'Gracie' ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>
	</div><!-- .entry-content -->
</article>