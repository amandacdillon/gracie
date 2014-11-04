<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 
    <header class="entry-header">
        <h1 class="entry-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h1>
        <span class="entry-date"><?php echo get_the_date(); ?></span>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php the_content(); ?>
    </div><!-- .entry-content -->

    <footer class="entry-meta">
        <div class="post-category">
            <?php the_category( ' / '); ?>
        </div>
    

        <div class="comments-link">
            <?php comments_popup_link( 
                 __( 'Leave a comment', 'gracie' ), 
                 __( '1 comment', 'gracie' ), 
                 __( '% comments', 'gracie' ) ); 
            ?>
        </div>
    </footer><!-- #entry-meta -->

</article><!-- #post-<?php the_ID(); ?> -->
