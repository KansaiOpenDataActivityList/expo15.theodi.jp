<?php
/*
Plugin Name: Tinymce Templates Bootstrap Templates
Version: 1.0.0
Description: Bootstrap3 based templates for the TinyMCE Templates
Author: Takayuki Miyauchi
Author URI: http://miya0001.github.io/tinymce-templates/
Plugin URI: http://miya0001.github.io/tinymce-templates/
Text Domain: tinymce-templates-bootstrap-templates
Domain Path: /languages
*/

$tinymce_templates_bootstrap_templates = new Tinymce_Templates_Bootstrap_Templates();
$tinymce_templates_bootstrap_templates->register();

class Tinymce_Templates_Bootstrap_Templates
{
	private $style;
	private $version = 'v3.3.1';

	public function register()
	{
		$this->style   = plugins_url( 'css/bootstrap-custom.css', __FILE__ );
		add_action( 'plugins_loaded', array( $this, 'plugins_loaded' ) );
	}

	public function plugins_loaded()
	{
		add_filter( 'tinymce_templates_post_objects',
				array( $this, 'tinymce_templates_post_objects' ) );
		add_filter( 'tinymce_templates_content',
				array( $this, 'tinymce_templates_content' ), 9, 3 );

		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ) );
		add_action( 'admin_head-post.php', array( $this, 'admin_head' ) );
		add_action( 'admin_head-post-new.php', array( $this, 'admin_head' ) );
	}

	public function admin_head()
	{
		add_editor_style( add_query_arg( array( 'ver' => $this->version ), $this->style ) );
	}

	public function wp_enqueue_scripts()
	{
		wp_enqueue_style(
			'tinymce-templates-bootstrap',
			$this->style,
			array(),
			$this->version
		);
	}

	public function tinymce_templates_post_objects( $posts )
	{
		return $posts + $this->get_templates();
	}

	public function tinymce_templates_content( $template, $p, $content )
	{
		if ( $template ) {
			return $template;
		} else {
			$templates = $this->get_templates();
			if ( isset( $templates[ $p['id'] ] ) && $templates[ $p['id'] ] ) {
				return $templates[ $p['id'] ]['content'];
			}
		}
	}

	public function get_templates()
	{
		return array(
			// Alerts
			'alert-success' => array(
				'title'        => 'Alert Success',
				'is_shortcode' => true,
				'content'      => '<div class="tinymce-templates-bootstrap-wrap"><div class="alert alert-success" role="alert">{$content}</div></div>',
			),
			'alert-info' => array(
				'title'        => 'Alert Info',
				'is_shortcode' => true,
				'content'      => '<div class="tinymce-templates-bootstrap-wrap"><div class="alert alert-info" role="alert">{$content}</div></div>',
			),
			'alert-warning' => array(
				'title'        => 'Alert Warning',
				'is_shortcode' => true,
				'content'      => '<div class="tinymce-templates-bootstrap-wrap"><div class="alert alert-warning" role="alert">{$content}</div></div>',
			),
			'alert-danger' => array(
				'title'        => 'Alert Danger',
				'is_shortcode' => true,
				'content'      => '<div class="tinymce-templates-bootstrap-wrap"><div class="alert alert-danger" role="alert">{$content}</div></div>',
			),
			// Panels
			'panel-default' => array(
				'title'        => 'Panel',
				'is_shortcode' => true,
				'content'      => '<div class="tinymce-templates-bootstrap-wrap"><div class="panel panel-default"><div class="panel-heading"><h3 class="panel-title">{$title}</h3></div><div class="panel-body">{$content}</div></div></div>',
			),
			'panel-prmary' => array(
				'title'        => 'Panel Primary',
				'is_shortcode' => true,
				'content'      => '<div class="tinymce-templates-bootstrap-wrap"><div class="panel panel-primary"><div class="panel-heading"><h3 class="panel-title">{$title}</h3></div><div class="panel-body">{$content}</div></div></div>',
			),
			'panel-success' => array(
				'title'        => 'Panel Success',
				'is_shortcode' => true,
				'content'      => '<div class="tinymce-templates-bootstrap-wrap"><div class="panel panel-success"><div class="panel-heading"><h3 class="panel-title">{$title}</h3></div><div class="panel-body">{$content}</div></div></div>',
			),
			'panel-info' => array(
				'title'        => 'Panel Info',
				'is_shortcode' => true,
				'content'      => '<div class="tinymce-templates-bootstrap-wrap"><div class="panel panel-info"><div class="panel-heading"><h3 class="panel-title">{$title}</h3></div><div class="panel-body">{$content}</div></div></div>',
			),
			'panel-warning' => array(
				'title'        => 'Panel Warning',
				'is_shortcode' => true,
				'content'      => '<div class="tinymce-templates-bootstrap-wrap"><div class="panel panel-warning"><div class="panel-heading"><h3 class="panel-title">{$title}</h3></div><div class="panel-body">{$content}</div></div></div>',
			),
			'panel-danger' => array(
				'title'        => 'Panel Danger',
				'is_shortcode' => true,
				'content'      => '<div class="tinymce-templates-bootstrap-wrap"><div class="panel panel-danger"><div class="panel-heading"><h3 class="panel-title">{$title}</h3></div><div class="panel-body">{$content}</div></div></div>',
			),
			'btn-default' => array(
				'title'        => 'Button',
				'is_shortcode' => true,
				'content'      => '<div class="tinymce-templates-bootstrap-wrap"><a href="{$href}" class="btn btn-lg btn-default">{$text}</a></div>',
			),
			'btn-primary' => array(
				'title'        => 'Button Primary',
				'is_shortcode' => true,
				'content'      => '<div class="tinymce-templates-bootstrap-wrap"><a href="{$href}" class="btn btn-lg btn-primary">{$text}</a></div>',
			),
			'btn-success' => array(
				'title'        => 'Button Success',
				'is_shortcode' => true,
				'content'      => '<div class="tinymce-templates-bootstrap-wrap"><a href="{$href}" class="btn btn-lg btn-success">{$text}</a></div>',
			),
			'btn-info' => array(
				'title'        => 'Button Info',
				'is_shortcode' => true,
				'content'      => '<div class="tinymce-templates-bootstrap-wrap"><a href="{$href}" class="btn btn-lg btn-info">{$text}</a></div>',
			),
			'btn-warning' => array(
				'title'        => 'Button Warning',
				'is_shortcode' => true,
				'content'      => '<div class="tinymce-templates-bootstrap-wrap"><a href="{$href}" class="btn btn-lg btn-warning">{$text}</a></div>',
			),
			'btn-danger' => array(
				'title'        => 'Button Danger',
				'is_shortcode' => true,
				'content'      => '<div class="tinymce-templates-bootstrap-wrap"><a href="{$href}" class="btn btn-lg btn-danger">{$text}</a></div>',
			),
			'well' => array(
				'title'        => 'Well',
				'is_shortcode' => true,
				'content'      => '<div class="tinymce-templates-bootstrap-wrap"><div class="well">{$content}</div></div>',
			),
			'well-lg' => array(
				'title'        => 'Well Large',
				'is_shortcode' => true,
				'content'      => '<div class="tinymce-templates-bootstrap-wrap"><div class="well well-lg">{$content}</div></div>',
			),
			'well-sm' => array(
				'title'        => 'Well Small',
				'is_shortcode' => true,
				'content'      => '<div class="tinymce-templates-bootstrap-wrap"><div class="well well-sm">{$content}</div></div>',
			),
		);
	}
}
