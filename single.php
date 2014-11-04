<?php
/**
 * Single post template
 *
 * This template controls what appears for a single post view!
 *
 * @package Gracie
 */

get_header(); ?>

<section id="primary" role="main">

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'templates/content', 'single' ); ?>

		<?php comments_template( '', true ); ?>

	<?php endwhile; // end of the loop. ?>

</section><!-- #primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>