<?php
/**
 * Main Template File
 * 
 * This is the main drag. This template displays content if a particular query isn't found -- 
 * i.e., if the reader isn't looking at an archive, page, or whatever!
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Gracie
 */

get_header(); ?>
<section id="primary" role="main">

    <?php if ( have_posts() ) : ?>

        <?php // START THE LOOP! ?>
        <?php while ( have_posts() ) : the_post(); ?>

            <?php get_template_part( 'templates/content', get_post_format() ); ?>

        <?php endwhile; ?>

        <?php get_template_part( 'inc/pagination' ); ?>

    <?php else : ?>
        <!-- there IS NOT content for this query -->

        <?php get_template_part( 'templates/content', 'none' ); ?>

    <?php endif; ?>

</section><!-- #primary -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>