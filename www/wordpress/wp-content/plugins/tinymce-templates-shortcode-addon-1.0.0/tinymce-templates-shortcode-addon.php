<?php
/*
Plugin Name: Tinymce Templates Shortcode Add-On
Version: 1.0.0
Description: Shortcode Add-On for the TinyMCE Templates
Author: Takayuki Miyauchi
Author URI: http://miya0001.github.io/tinymce-templates/
Plugin URI: http://miya0001.github.io/tinymce-templates/
Text Domain: tinymce-templates-shortcode-addon
Domain Path: /languages
*/

add_filter( 'tinymce_templates_content', 'tinymce_templates_shortcode_addon', 10, 3 );

/*
* Filters tinymce_templates_content
*/
function tinymce_templates_shortcode_addon( $template, $attr, $content ){
	foreach ( $attr as $key => $value ) {
		$template = str_replace( '{$'.$key.'}', $value, $template );
	}

	$template = str_replace( '{$content}', $content, $template );
	return $template;
}
