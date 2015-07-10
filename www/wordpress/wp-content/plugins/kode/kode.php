<?php
/*
Plugin Name: Kode
Version: 0.1-alpha
Description: PLUGIN DESCRIPTION HERE
Author: YOUR NAME HERE
Author URI: YOUR SITE HERE
Plugin URI: PLUGIN SITE HERE
Text Domain: kode
Domain Path: /languages
*/

define( 'DISALLOW_FILE_EDIT', true );

add_filter( 'content_bootstrap_enable_version_3', '__return_true' );

add_action( 'wp_enqueue_scripts', function(){
    wp_enqueue_style( 'dashicons' );
} );

