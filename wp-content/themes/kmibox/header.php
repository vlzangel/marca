<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?><!DOCTYPE html>
<html class="no-js no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- BEGIN Style - Plugins -->
	<link rel="stylesheet" href="<?php echo get_home_url(); ?>/plugins/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo get_home_url(); ?>/plugins/fontawesome/css/font-awesome.css">
	<!-- BEGIN Style - Plugins -->
	
	<!-- BEGIN Style -->
	<link rel="stylesheet" href="<?php echo get_home_url(); ?>/css/animate.css">
	<link rel="stylesheet" href="<?php echo get_home_url(); ?>/css/kmibox.css">
	<!-- END Style -->

	<!-- BEGIN Font -->
	<link href="https://fonts.googleapis.com/css?family=Lato:400,900" rel="stylesheet">
	<!-- END Font -->
	<link rel="stylesheet" href="<?php echo get_home_url(); ?>/css/CaviarDreams.css">
	<link rel="stylesheet" href="<?php echo get_home_url(); ?>/css/PoetsenOne.css">

	<?php #wp_head(); ?>
</head>

<body>
	<div id="content-primary" class="container-fluid">



