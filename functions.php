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

/* Set Content Width
 ========================== */
if ( ! isset( $content_width ) ) :
    $content_width = 1140;
endif;


/* Initial theme setup
 ========================== */
if ( ! function_exists( "go_go_gracie" ) ) :
	function go_go_gracie () {
	//Let's start out by making Gracie available for translation.
    //Translations can be filed in the /languages/ directory.
    load_theme_textdomain( "Gracie", get_template_directory() . "/languages" );

    //Add default posts and comments RSS feed links to  <head>
    add_theme_support( "automatic-feed-links" );

	// Enable support for Post Thumbnails on posts and pages
	add_theme_support( "post-thumbnails" );

	// Enable support for Post Formats.
    add_theme_support( "post-formats", array( 
        "aside",
        "image",
        "video",
        "quote",
        "link",
        "gallery"
    ) );

    // Enable support for HTML5 markup.
    add_theme_support( "html5", array(
        "comment-list",
        "search-form",
        "comment-form",
        "gallery",
    ) );

    // Enable nice search, which is awesome
    add_theme_support('nice-search');


	// Enable support for editable menus via Appearance > Menus
	register_nav_menus( array(
	    "primary" => __( "Primary Menu", "Gracie" ), // The primary theme menu
	    "footer-menu" => __( "Footer Menu", "Gracie" ) // Optional secondary footer menu
	) );


}
endif; //go_go_gracie setup
add_action( "after_setup_theme", "go_go_gracie" );



/* Register sidebars and 
   widgetizable areas
 ========================== */

function gracie_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'Gracie' ),
		'id' => 'firstsidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'gracie_widgets_init' );

/* This code allows you to add a widgetable area to any part of your Theme code! Just uncomment the create_widget calls
** and place the appropriately corresponding PHP code wherever you want the widgetable area to appear. **/



// calling the create_widget function for all of the widgets that I want
/*create_widget( 'First Header Widget Area', "first_header_area", "Displays in the top left of the header" );
create_widget( 'Second Header Widget Area', "second_header_area", "Displays in the top right of the header" );
create_widget( 'First Footer Widget Area', "first_footer_area", "Displays in the top right of the footer" );
create_widget( 'Second Footer Widget Area', "second_footer_area", "Displays in the top left of the footer" );*/



/* Scripts and Enqueueing!
 ========================== */
// It's the wordpress way.
// For real.

function gracie_scripts() {
	// theme style.css file
	wp_enqueue_style( 'themeTextDomain-style', get_stylesheet_uri() );
	
	// threaded comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// set up the main script sheet
	wp_enqueue_script( "theme", get_template_directory_uri() . "/assets/theme.min.js", array("jquery"));

}    
add_action('wp_enqueue_scripts', 'gracie_scripts');



/* WP Head Cleanup
 ========================== */
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
	add_filter( 'style_loader_src', 'gracie_remove_wp_ver_css_js', 9999 );
	// remove Wp version from scripts
	add_filter( 'script_loader_src', 'gracie_remove_wp_ver_css_js', 9999 );

} 
add_action( 'init', 'gracie_head_cleanup' ); /* end Gracie head cleanup */

// Force JPEG quality to be perfect

function gracie_jpeg_quality() {
   return 100;
}
add_filter( 'jpeg_quality', 'gracie_jpeg_quality' );

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


function gracie_rel_canonical() { //taken from roots
  global $wp_the_query;

  if (!is_singular()) {
    return;
  }

  if (!$id = $wp_the_query->get_queried_object_id()) {
    return;
  }

  $link = get_permalink($id);
  echo "\t<link rel=\"canonical\" href=\"$link\">\n";
}

// Clean up language_attributes() used in <html> tag, remove dir="ltr"
function gracie_language_attributes() {
  $attributes = array();
  $output = '';

  if (is_rtl()) {
    $attributes[] = 'dir="rtl"';
  }

  $lang = get_bloginfo('language');

  if ($lang) {
    $attributes[] = "lang=\"$lang\"";
  }

  $output = implode(' ', $attributes);
  $output = apply_filters('exvitae_language_attributes', $output);

  return $output;
}
add_filter('language_attributes', 'gracie_language_attributes');


// Wrap embedded media as suggested by Readability
function gracie_embed_wrap($cache, $url, $attr = '', $post_ID = '') {
  return '<div class="entry-content-asset">' . $cache . '</div>';
}
add_filter('embed_oembed_html', 'gracie_embed_wrap', 10, 4);

// END WP cleaup!


/* Helpful bits and pieces!
 ========================== */

// Remove the admin bar for everybody, always, all the time.
show_admin_bar( false );


// loading Google analytics into the footer --> replace GOOGLE_ANALYTICS_ID with your own GA ID
/*function exvitae_google_analytics() { ?>
	<script>
	  (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
	  function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
	  e=o.createElement(i);r=o.getElementsByTagName(i)[0];
	  e.src='//www.google-analytics.com/analytics.js';
	  r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
	  ga('create','<?php echo GOOGLE_ANALYTICS_ID; ?>');ga('send','pageview');
	</script>

	<?php }
	if (GOOGLE_ANALYTICS_ID && !current_user_can('manage_options')) {
	  add_action('wp_footer', 'exvitae_google_analytics', 20);
}*/

// Allows us to show more articles on the Archives page (due to the grid layout!)
function gracie_custom_query( $query ) {
    if ( is_archive() && !is_admin() ) {
         $query->set( 'posts-per-page', 18 );
    }
    return $query;
}
add_filter( 'pre_get_posts', 'gracie_custom_query' );

// Nice Search! Redirects ?s=FOO search URLs to the nicer /search/FOO versions. src --> http://txfx.net/wordpress-plugins/nice-search/
function cws_nice_search_redirect() {
	global $wp_rewrite;
	if ( !isset( $wp_rewrite ) || !is_object( $wp_rewrite ) || !$wp_rewrite->using_permalinks() )
		return;

	$search_base = $wp_rewrite->search_base;
	if ( is_search() && !is_admin() && strpos( $_SERVER['REQUEST_URI'], "/{$search_base}/" ) === false ) {
		wp_redirect( home_url( "/{$search_base}/" . urlencode( get_query_var( 's' ) ) ) );
		exit();
	}
}

add_action( 'template_redirect', 'cws_nice_search_redirect' );

// Hotfix for http://core.trac.wordpress.org/ticket/13961 for WP versions less than 3.5
if ( version_compare( $wp_version, '3.5', '<=' ) ) {
	function cws_nice_search_urldecode_hotfix( $q ) {
		if ( $q->get( 's' ) && empty( $_GET['s'] ) && is_main_query() )
			$q->set( 's', urldecode( $q->get( 's' ) ) );
	}
	add_action( 'pre_get_posts', 'cws_nice_search_urldecode_hotfix' );
}
// END nice search

// Custom Gravitar
if ( !function_exists('gracie_addgravatar') ) {
	function gracie_addgravatar( $avatar_defaults ) {
		$myavatar = get_template_directory_uri() . '/images/avatar.png';
		$avatar_defaults[$myavatar] = 'avatar';
		return $avatar_defaults;
	}
	add_filter( 'avatar_defaults', 'cake_addgravatar' );
}


// Custom Read More
function gracie_excerpt_more($more) {
       global $post;
	return '...<br /><br /><a href="'. get_permalink($post->ID) . '" class="read_on">READ ON</a>';
}

add_filter('excerpt_more', 'gracie_excerpt_more');

// Dynamic copyright -- displays years, automatically updated
function gracie_copyright() {
global $wpdb;
	$copyright_dates = $wpdb->get_results("
		SELECT
		YEAR(min(post_date_gmt)) AS firstdate,
		YEAR(max(post_date_gmt)) AS lastdate
		FROM
		$wpdb->posts
		WHERE
		post_status = 'publish'
	");
	$output = '';
	if($copyright_dates) {
		$copyright = "&copy; " . $copyright_dates[0]->firstdate;
		if($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {
			$copyright .= '-' . $copyright_dates[0]->lastdate;
		}
		$output = $copyright;
	}
	return $output;
}


// Comments & pingbacks display template
include('inc/functions/comments.php');

