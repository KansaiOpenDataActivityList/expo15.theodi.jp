<?php

if ( ! isset( $content_width ) )
	$content_width = 750;


add_action( 'after_setup_theme', function(){
	remove_action( 'after_setup_theme', 'twentythirteen_custom_header_setup', 11 );

	set_post_thumbnail_size( 960, 540, true );

	$args = array(
		'default-text-color'     => '220e10',
		'default-image'          => get_stylesheet_directory_uri() . '/img/header.jpg',
		'height'                 => 540,
		'width'                  => 960,
		'admin-head-callback'    => 'twentythirteen_admin_header_style',
		'admin-preview-callback' => 'twentythirteen_admin_header_image',
	);

	add_theme_support( 'custom-header', $args );
	register_default_headers( array() );
} );


add_action( 'widgets_init', function(){
	remove_action( 'widgets_init', 'twentythirteen_widgets_init' );

	register_sidebar( array(
		'name'          => __( 'Main Widget Area', 'twentythirteen' ),
		'id'            => 'home-widgets',
		'description'   => __( 'Appears in the top page of the site.', 'twentythirteen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="row">',
		'after_widget'  => '</div><div class="clearfix"></div></section>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}, 9 );
