<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package ZoTheme
 * @subpackage Zo Theme
 * @since 1.0.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php global $smof_data; ?>
<?php zo_get_page_loading(); ?>
<div id="page" class="<?php zo_page_class(); ?>">
	<header id="masthead" class="site-header">
		<?php zo_header(); ?>
	</header>
    <?php zo_page_title(); ?>
	<div id="main">