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
        </div><!-- .post-category -->

        <div class="post-social">
            <a href="http://twitter.com/share?&url=<?php the_permalink(); ?>&text=<?php the_title(); ?>" target="_blank">TWEET</a>&nbsp;/&nbsp;
            <a href="javascript:void((function(){var%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)})());">PIN</a>&nbsp;/&nbsp;
            <a href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>:" target="_blank" >SHARE</a>
        </div><!-- .post-social -->

        <div class="comments-link">
            <?php comments_popup_link( 
                 __( 'Leave a comment', 'gracie' ), 
                 __( '1 comment', 'gracie' ), 
                 __( '% comments', 'gracie' ) ); 
            ?>
        </div><!-- .comments-link -->
    </footer><!-- #entry-meta -->

    <nav id="nav-below">
        <div class="nav-previous"><?php previous_post_link( get_the_post_thumbnail(), '%link', '%title' ); ?></div>
        <div class="nav-next"><?php next_post_link( get_the_post_thumbnail(), '%link', '%title' ); ?></div>
    </nav>

</article><!-- #post-<?php the_ID(); ?> -->


<?php previous_post_link( '<div class="nav-previous">' . get_the_post_thumbnail() . '%link</div>', _x( '%title', 'Previous post link', 'THEMENAME' ) ); ?>
