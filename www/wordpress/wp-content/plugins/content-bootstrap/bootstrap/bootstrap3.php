<?php

class Bootstrap3 extends Bootstrap
{
	public function __construct( $plugin_version, $plugins_url )
	{
		parent::__construct( $plugin_version, $plugins_url );
	}

	public function tiny_mce_before_init( $init )
	{
		$styles = array(
			array(
				'title' => 'Success',
				'block' => 'div',
				'classes' => 'alert alert-success',
				'wrapper' => true,
			),
			array(
				'title' => 'Info',
				'block' => 'div',
				'classes' => 'alert alert-info',
				'wrapper' => true,
			),
			array(
				'title' => 'Warning',
				'block' => 'div',
				'classes' => 'alert alert-warning',
				'wrapper' => true,
			),
			array(
				'title' => 'Danger',
				'block' => 'div',
				'classes' => 'alert alert-danger',
				'wrapper' => true,
			),
			array(
				'title' => 'Well',
				'block' => 'div',
				'classes' => 'well well-large',
				'wrapper' => true,
			),
			array(
				'title' => 'Well Small',
				'block' => 'div',
				'classes' => 'well well-small',
				'wrapper' => true,
			),
		);

		$styles = apply_filters( 'content_bootstrap_styles', $styles );
		$init['style_formats'] = json_encode( $styles );
		return $init;
	}

	public function admin_head()
	{
		// bootstrsap version should be statically in admin area.
		$editor_style = $this->plugins_url . '/bootstrap/bootstrap3/css/editor-style.css?ver=' . $this->plugin_version;
		add_editor_style( $editor_style );
	}
}
