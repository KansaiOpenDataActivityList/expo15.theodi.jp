<?php

abstract class Bootstrap
{
	protected $plugin_version;
	protected $plugins_url;

	public function __construct( $plugin_version, $plugins_url )
	{
		$this->plugin_version = $plugin_version;
		$this->plugins_url = untrailingslashit( $plugins_url );
	}

	public function register()
	{
		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ) );
		add_filter( 'admin_head', array( $this, 'admin_head') );
		add_filter( 'tiny_mce_before_init', array( $this, 'tiny_mce_before_init' ), 9999 );
		add_filter( 'mce_buttons_2', array( $this, 'mce_buttons_2' ) );
		add_filter( 'the_content', array( $this, 'the_content' ) );

		add_shortcode( 'label', array( $this, 'shortcode_label' ) );
		add_shortcode( 'badge', array( $this, 'shortcode_badge' ) );
		add_shortcode( 'icon', array( $this, 'shortcode_icon' ) );
	}

	public function shortcode_icon( $p )
	{
		$class = array();

		if ( isset( $p[0] ) && ( $icon = preg_replace( '/^icon-/', '', $p[0] ) ) ) {
			if ( 'bootstrap3' === Content_Bootstrap::get_bootstrap_version() ) {
				$class[] = esc_attr( 'glyphicon-'.$icon );
			} else {
				$class[] = esc_attr( 'icon-'.$icon );
			}
		}

		if ( isset( $p[1] ) && ('white' === preg_replace( '/^icon-/', '', $p[1] ) ) ) {
			$class[] = 'icon-white';
		}

		if ( 'bootstrap3' === Content_Bootstrap::get_bootstrap_version() ) {
			return sprintf(
				'<span class="glyphicon %s" aria-hidden="true"></span>',
				join( ' ', $class )
			);
		} else {
			return sprintf(
				'<i class="%s"></i>',
				join( ' ', $class )
			);
		}
	}

	public function shortcode_label( $p, $content )
	{
		if ( 'bootstrap3' === Content_Bootstrap::get_bootstrap_version() ) {
			$labels = array(
				'default',
				'primary',
				'success',
				'info',
				'warning',
				'danger',
			);

			$class = array( 'label' );
			if ( isset( $p['name'] ) && in_array( $p['name'], $labels ) ) {
				$class[] = 'label-' . $p['name'];
			} else {
				$class[] = 'label-default';
			}

			return sprintf(
				'<span class="%s">%s</span>',
				join( ' ', $class ),
				do_shortcode( $content )
			);
		} else {
			$class = array( 'label' );
			if ( isset( $p['name'] ) && preg_match( '/^[a-z]+$/', $p['name'] ) ) {
				$class[] = 'label-'.esc_attr( $p['name'] );
			}

			return sprintf(
				'<span class="%s">%s</span>',
				join( ' ', $class ),
				do_shortcode( $content )
			);
		}
	}

	public function shortcode_badge( $p, $content )
	{
		if ( 'bootstrap3' === Content_Bootstrap::get_bootstrap_version() ) {
			return sprintf(
				'<span class="badge">%s</span>',
				do_shortcode( $content )
			);
		} else {
			$class = array( 'badge' );
			if ( isset( $p['name'] ) && preg_match( '/^[a-z]+$/', $p['name'] ) ) {
				$class[] = 'badge-'.esc_attr( $p['name'] );
			}

			return sprintf(
				'<span class="%s">%s</span>',
				join( ' ', $class ),
				do_shortcode( $content )
			);
		}
	}

	public function the_content( $content )
	{
		$wrap = apply_filters( 'content_bootstrap_wrap', true );
		if ( 'bootstrap3' === Content_Bootstrap::get_bootstrap_version() ) {
			if ( $wrap ) {
				return '<div class="content-bootstrap-3-area">'.$content.'</div>';
			} else {
				return $content;
			}
		} else {
			if ( $wrap ) {
				return '<div class="content-bootstrap-area">'.$content.'</div>';
			} else {
				return $content;
			}
		}
	}

	public function mce_buttons_2( $buttons )
	{
		array_unshift( $buttons, 'styleselect' );
		return $buttons;
	}

	abstract public function tiny_mce_before_init( $init );

	abstract public function admin_head();

	public function wp_enqueue_scripts()
	{
		wp_enqueue_style(
			'content-bootstrap',
			$this->get_bootstrap_dir() . '/css/content-bootstrap.css',
			array(),
			$this->plugin_version
		);
	}

	protected function get_bootstrap_dir()
	{
		$dir = apply_filters(
			'content_bootstrap_dir',
			$this->plugins_url . '/bootstrap/' . Content_Bootstrap::get_bootstrap_version()
		);

		return untrailingslashit( $dir );
	}
}
