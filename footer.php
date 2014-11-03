<?php
/**
 * The Footer Template
 *
 * Contains the closing of <div id="main"> and all content after.
 *
 * @package Gracie
 */
?>

	    </div><!-- #main -->

	</div><!-- #page -->

</div><!-- #container -->

<footer id="footer" role="contentinfo">
    <div id="copyright">
    	<?php // dynamic copyright ?>
        <?php echo gracie_copyright(); ?>

        <a href="http://yoursite.com" rel="nofollow">theme by YOU!</a>
    </div>
</footer><!-- #footer -->

<?php # the WP footer allows scripts and plugin info to be inserted in the footer when necessary. ?>
<?php wp_footer(); ?> 
</body>
</html>