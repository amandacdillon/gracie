<?php
/**
 * Main Template File
 * 
 * This file is used to display a page when nothing more specific matches a query.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Gracie
 */

get_header(); ?>
<section id="primary" role="main">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <?php get_template_part( 'templates/content', get_post_format() ); ?>

    <?php endwhile; ?>

        <nav id="nav-below">
            <div class="nav-previous"><?php next_posts_link( __( "Older Posts", "gracie" ) ); ?></div>
            <div class="nav-next"><?php previous_posts_link( __( "Newer Posts", "gracie" ) ); ?></div>
        </nav><!-- #nav-above -->

    <?php else : ?>
        <!-- there IS NOT content for this query -->

        <article id="post-0" class="hentry post no-results not-found">
            <header class="entry-header">
                <h1><?php _e( "Oops!", "gracie" ); ?></h1>
            </header><!-- .entry-header -->

            <p><?php _e( "We can&#039;t find content for this page!", "gracie" ); ?></p>
        </article><!-- #post-0 -->

    <?php endif; ?>

</section><!-- #primary -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>