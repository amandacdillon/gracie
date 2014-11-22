<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Gracie
 */

get_header(); ?>

<section id="primary" role="main">

    <article id="post-0" class="404 not-found">
        <header class="entry-header">
            <h1 class="entry-title"><?php _e( '404. Dang, yo', 'gracie-theme' ); ?></h1>
        </header>

        <div class="entry-content">
            <p><?php _e( 'This isn&rsquo;t the page you&rsquo;re looking for. Perhaps a search would help?', 'gracie-theme' ); ?></p>

            <?php get_search_form(); ?>

        </div><!-- .entry-content -->
    </article><!-- #post-0 -->

</section><!-- #primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>?>
