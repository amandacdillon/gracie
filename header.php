<?php
/**
 * The Header Template!
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Gracie
 */
?>

<!DOCTYPE html>

<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<!--[if lt IE 9]>
<html id="ie" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->

<head>
    <meta charset="<?php bloginfo( "charset" ); ?>" />
    <meta name="viewport" content="width=device-width">

    <?php // force Internet Explorer to use the latest rendering engine available ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?php wp_title( "|", true, "right" ); ?></title>

    <!-- favicon & links -->
    <link rel="pingback" href="<?php bloginfo( "pingback_url" ); ?>" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( "stylesheet_url" ); ?>" />

    <!-- stylesheet is enqueued in functions.php -->
    <!-- all other scripts (in theme.min.js) are enqueued via functions.php -->
    
    <!-- helper scripts -->
    <!--[if lt IE 9]>
        <script src="<?php echo get_template_directory_uri(); ?>/assets/js/vendor/modernizr-2.6.2.min.js" type="text/javascript"></script>
    <![endif]-->

    <?php // wordpress head functions - allows other wordpress files and plugins to hook into the theme
    wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<div id="container">
		<div id="page">
		    <header id="site-header" role="banner">            
		       <h1>
		       	<!-- // to use a image, replace the bloginfo('name') with: <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="<?php bloginfo("name"); ?>" /> -->
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                          <?php bloginfo('name'); ?>
                    </a>
                </h1>
		        
                <nav id="header-nav" role="navigation">
		            <?php wp_nav_menu( array( 'theme_location' => 'primary',
                                              'container' => false, //no container here
                                              'depth'     => 2,     // only two sub-menus allowed
                                              'link_before' => '',  //before each link 
                                              'link_after' => '',   //after each link
                    ) ); ?>
		        </nav><!-- #access -->  
		    </header><!-- #branding -->


		    <div id="main">