<?php
/**
 * Theme functions and definitions
 *
 * Sets up the theme and provides some helper functions including 
 * custom template tags, actions and filter hooks to change core functionality.
 *
 *
 * @package Gracie
 */

/**
 * Set the content width based on the theme design and stylesheet.
 */
if ( ! isset( $content_width ) ) :
    $content_width = 600;
endif;

/* Initial theme setup */
if ( ! function_exists( "go_go_gracie" ) ) ;
	function go_go_gracie () {
		//Let's start out by making Gracie available for translation.
    //Translations can be filed in the /languages/ directory.
    load_theme_textdomain( "gracie", get_template_directory() . "/languages" );

    //Add default posts and comments RSS feed links to  <head>
    add_theme_support( "automatic-feed-links" );

	  // Enable support for Post Thumbnails on posts and pages
	  add_theme_support( "post-thumbnails" )

	  // Enable support for Post Formats.
        add_theme_support( "post-formats", array( 
            "aside",
            "image",
            "video",
            "quote",
            "link"
        ) );

    // Enable support for HTML5 markup.
        add_theme_support( "html5", array(
            "comment-list",
            "search-form",
            "comment-form",
            "gallery",
        ) );


		// Enable support for editable menus via Appearance > Menus
		        register_nav_menus( array(
		            "primary" => __( "Primary Menu", "Gracie" ),
		        ) );


}
endif; //go_go_gracie setup
add_action( "after_setup_theme", "go_go_gracie" );

/* Register sidebars
** and widgetized areas.
**/

function gracie_widgets_init() {
    register_sidebar( array(
        "name" => __( "Sidebar", "Gracie" ),
        "id" => "firstsidebar",
        "before_widget" => "<aside id="%1$s" class="widget %2$s">",
        "after_widget" => "</aside>",
        "before_title" => "<h3 class="widget-title">",
        "after_title" => "</h3>",
    ) );
}
add_action( "gracie_widgets_init", "starter_theme_widgets_init" );

/* Scripts and Enqueueing!
** It's the WordPress way.
** For real.
*/

function gracie_scripts_method() {
		// comment reply code - moves comments form underneath the comment you're replying to
    if ( is_singular() && comments_open() && get_option( "thread_comments" ) ) {
        wp_enqueue_script( "comment-reply" );
    }

    // wp_enqueue_script(
    //  "theme",
    //  get_template_directory_uri() . "/assets/theme.js",
    //  array("jquery")
    // );
}    
add_action("wp_enqueue_scripts", "emitheme_scripts_method");





/* Cleanup time! The default WP head is a bit sloppy.
** Let's tidy it by removing everything we don't actually
** need. Taken from BONES - http://themble.com/bones
**/

function gracie_head_cleanup() {
	// EditURI link
	remove_action( 'wp_head', 'rsd_link' );
	// windows live writer
	remove_action( 'wp_head', 'wlwmanifest_link' );
	// index link
	remove_action( 'wp_head', 'index_rel_link' );
	// previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	// start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	// links for adjacent posts
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	// WP version
	remove_action( 'wp_head', 'wp_generator' );
	// remove WP version from css
	add_filter( 'style_loader_src', 'bones_remove_wp_ver_css_js', 9999 );
	// remove Wp version from scripts
	add_filter( 'script_loader_src', 'bones_remove_wp_ver_css_js', 9999 );

} 
add_action( 'init', 'gracie_head_cleanup' ); /* end Gracie head cleanup */

/* MORE CLEANUP! */
// remove WP version from RSS
function gracie_rss_version() { return ''; }

// remove WP version from scripts
function gracie_remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}

// remove injected CSS for recent comments widget
function gracie_remove_wp_widget_recent_comments_style() {
	if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
		remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
	}
}

// remove injected CSS from recent comments widget
function gracie_remove_recent_comments_style() {
	global $wp_widget_factory;
	if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
		remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
	}
}

// remove injected CSS from gallery
function gracie_gallery_style($css) {
	return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
}
add_filter( 'the_generator', 'gracie_rss_version' );
add_filter( 'wp_head', 'gracie_remove_wp_widget_recent_comments_style' );
add_action( 'wp_head', 'gracie_remove_recent_comments_style' );
add_filter( 'gallery_style', 'gracie_gallery_style' );


// Helpful bits and pieces

// Remove the admin bar for everybody, always, all the time.
show_admin_bar( false );

