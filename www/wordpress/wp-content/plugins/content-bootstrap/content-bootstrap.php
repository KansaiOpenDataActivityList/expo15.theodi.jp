<?php
/*
Plugin Name: Content Bootstrap
Author: Takayuki Miyauchi
Plugin URI: https://github.com/miya0001/content-bootstrap
Description: Apply twitter bootstrap css under the content area only.
Author: Takayuki Miyauchi
Version: 1.0.2
Author URI: https://github.com/miya0001/
Domain Path: /languages
Text Domain: content-bootstrap
*/

$content_bootstrap = new Content_Bootstrap();
$content_bootstrap->register();

class Content_Bootstrap
{
	private $ver;

	public function register()
	{
		add_action( 'init', array( $this, 'init' ) );
	}

	public function init()
	{
		$plugin_info = get_file_data( __FILE__, array(
			'version' => 'Version',
			'text_domain' => 'Text Domain',
			'domain_path' => 'Domain Path',
		) );

		$this->ver = $plugin_info['version'];

		require_once( dirname( __FILE__ ) . '/includes/bootstrap.php' );

		$bootstrap_version = self::get_bootstrap_version();

		if ( 'bootstrap3' === $bootstrap_version ) {
			require_once( dirname( __FILE__ ) . '/bootstrap/bootstrap3.php' );
			$bootstrap3 = new Bootstrap3( $this->ver, plugins_url( '', __FILE__ ) );
			$bootstrap3->register();
		} elseif ( 'bootstrap2' === $bootstrap_version ) {
			require_once( dirname( __FILE__ ) . '/bootstrap/bootstrap2.php' );
			$bootstrap2 = new Bootstrap2( $this->ver, plugins_url( '', __FILE__ ) );
			$bootstrap2->register();
		}
	}

	public static function get_bootstrap_version()
	{
		if ( defined( 'CONTENT_BOOTSTRAP_ENABLE_VERSION_3' ) && CONTENT_BOOTSTRAP_ENABLE_VERSION_3 ) {
			return 'bootstrap3';
		} elseif ( apply_filters( 'content_bootstrap_enable_version_3', false ) ) {
			return 'bootstrap3';
		} else {
			return 'bootstrap2';
		}
	}
}
