<?php 
/**
* The Archive Template
* Which is part of the template heirarchy.
* Which is cool. Check it out: http://codex.wordpress.org/Template_Hierarchy
*
* @package Gracie
**/

get_header(); ?>

<section id="primary" role="main">

	<?php if ( have_posts() ) : ?>
			
			<?php get_template_part( 'inc/archive-header' ); ?>
			
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>

			<?php endwhile; ?>

			<?php get_template_part( 'inc/pagination' ); ?>

	<?php else : ?>

		<?php get_template_part( 'content', 'none' ); ?>

	<?php endif; ?>

</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>


